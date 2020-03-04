<?php
$menuid = 1;
//global includes
require_once('../../php/config/app.php');
require_once('../../tmpl/core/inc_topnav.php');
require_once('../../tmpl/core/inc_subnav.php');

$action = 'overview';
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}
	
	function ruleExists($usergroupid, $menuid){
        $dbh = new PDO("odbc:Driver={IBM INFORMIX ODBC DRIVER};HOSTNAME=telsur11;service=9088;server=devshm;DATABASE=telesur;PROTOCOL=onsoctcp; UID=itisso;PWD=aobso04;");
        $dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$usermenu_query = 'SELECT * FROM permission WHERE menunr = '. $menuid .' AND usergroup_id = '. $usergroupid .'';
		$usermenu_res = $dbh->query($usermenu_query);
		$data = array();
		// Parse returned data, and displays them
		while($row = $usermenu_res->fetch(PDO::FETCH_ASSOC)) {
			$data[] = $row;
		}
		
		if($data){
			return true;
		} else {
			return false;
		}	
	}
	
	$permissionquery = 'SELECT * FROM permission';
	$permissionresultset = $dbh->query($permissionquery);
	$permissiondata = array();
	// Parse returned data, and displays them
	while($row = $permissionresultset->fetch(PDO::FETCH_ASSOC)) {
		$permissiondata[] = $row;
	}
	
	/* function getPermission($permissiondata, $usergroupid, $menuid, $permission){
		
		foreach($permissiondata as $item){
			if($item['usergroup_id'] == $usergroupid && $item['menunr'] == $menuid && $item['permission_' . $permission] == 1){
				return true;
			} 
		}
		return false;
	} */
	
	function getPermission($permissiondata, $usergroupid, $menuid, $permission){
		
		for ($i = 0; $i < count($permissiondata); ++$i) {
		//foreach($permissiondata as $item){
			if($permissiondata[$i]['USERGROUP_ID'] == $usergroupid && $permissiondata[$i]['MENUNR'] == $menuid && $permissiondata[$i]['PERMISSION_' . $permission] == 1){
				return true;
			} 
		}
		return false;
	}
	
	/*echo '<pre>';
	//print_r($permissiondata);
	print_r(getPermission($permissiondata, 16, 1, 'update'));
	echo '</pre>';
	exit();*/
	
	switch($action){
		
		default:
		case 'overview':
			$dataquery = 'SELECT * FROM usergroups';
			$dataresultset = $dbh->query($dataquery);
			$data = array();
			// Parse returned data, and displays them
			while($row = $dataresultset->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
		
			require_once('tmpl/permissies.tpl.php');
			
		break;
		
		case 'update':

			$menus = querySelectPDO($dbh, 'SELECT menuitemid,menutitle FROM menuitem where parentid=0');
			
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				$menuitem = "select * from menuitem where menuitemid = '".$_POST['menuid']."' or parentid in
							(select menuitemid from menuitem where menuitemid = '".$_POST['menuid']."' or parentid='".$_POST['menuid']."')";
				//echo $menuitem;
				$menuitemresultset = $dbh->query($menuitem);
				$menuitemdata = array();
				// Parse returned data, and displays them
				while($row = $menuitemresultset->fetch(PDO::FETCH_ASSOC)) {
					$menuitemdata[] = $row;
				}

				$usergroup_id = $_GET['id'];
				
				if($_POST['permission']){
					foreach($_POST['permission'] as $key => $menupermission){
						
						$menuid = $key;
						
						//check if user-menu record exists
						
						if(ruleExists($usergroup_id, $menuid)){
							
							$query = "UPDATE permission SET
											permission_select = '" . $menupermission['select'] . "' ,
											permission_insert = '" . $menupermission['insert'] . "',
											permission_update = '" . $menupermission['update'] . "',
											permission_delete = '" . $menupermission['delete'] . "',
											permission_other = '" . $menupermission['other'] . "',
											updated_at = TODAY,
											updated_by = '" . getAppUserId() . "'
										WHERE usergroup_id = '" .   $usergroup_id . "' AND menunr = '" .   $menuid . "'";
							$menuitemresultset = $dbh->query($query);
						} else {
							
							$query = "INSERT INTO permission (menunr, usergroup_id, permission_select, permission_insert, permission_update, permission_delete, permission_other, created_at, created_by) VALUES ('" .   $menuid . "', '" .   $usergroup_id . "', '" . $menupermission['select'] . "', '" . $menupermission['insert'] . "', '" . $menupermission['update'] . "', '" . $menupermission['delete'] . "', '" . $menupermission['other'] . "', TODAY, '" . getAppUserId() . "')";
							$menuitemresultset = $dbh->query($query);
						}
					}

					header('Location: permissies.php?msg=updated');
					exit();
				}
				

			}
			
			require_once('tmpl/permissies_edit.tpl.php');
			
		break;
		
	}
	
?>