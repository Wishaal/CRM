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
	
	switch($action){
		
		default:
		case 'overview':
			
			//logic goes here

			$dataquery = 'SELECT * FROM usergroupstvg';
			$dataresultset = $dbh->query($dataquery);
			$data = array();
			// Parse returned data, and displays them
			while($row = $dataresultset->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
		
			require_once('tmpl/usergroupstvg.tpl.php');
			
		break;
		
		case 'new':
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$active = 0;
				if($_POST['active']) $active = 1;
				$query = "INSERT INTO usergroupstvg (usergroups_id, vergz_code,taaknaam, sysuser, sysdate) 
								VALUES ('" . $_POST['usergroups_id'] . "', '" . $_POST['vergz_code'] . "','" . $_POST['taaknaam'] . "','" . getAppUserId() . "', TODAY )";
				$dataresultset = $dbh->query($query);
				
				header('Location: usergroupstvg.php?msg=saved');
			}
			
			require_once('tmpl/usergroupstvg_new.tpl.php');
			
		break;
		
		case 'update':
			
			if(isset($_GET['id'])){

                $usergroups = querySelectPDO($dbh, 'SELECT * FROM usergroups');

				$query = "SELECT * FROM usergroupstvg WHERE ugtid='". $_GET['id'] . "'";
				$resultset = $dbh->query($query);
				$data = $resultset->fetch();
				
			}
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$active = 0;
				if($_POST['active']) $active = 1;		
				$query = "	UPDATE usergroupstvg SET 
									usergroups_id = '" . $_POST['usergroups_id'] . "' ,
									vergz_code = '" . $_POST['vergz_code'] . "',
									taaknaam = '" . $_POST['taaknaam'] . "',
									sysuser = '" . getAppUserId() . "',
									sysdate = TODAY
								WHERE ugtid = '" .   $_GET['id'] . "'";
				$resultset = $dbh->query($query);	
				
				header('Location: usergroupstvg.php?msg=updated');
				exit();
			}
			
			require_once('tmpl/usergroupstvg_edit.tpl.php');
			
		break;
		
		case 'delete':
			
			if(isset($_GET['id'])) {

                $query = "DELETE FROM usergroupstvg WHERE ugtid='" . $_GET[id] . "'";
                $resultset = $dbh->query($query);

                header('Location: usergroupstvg.php?msg=deleted');
                exit();
            }
		break;
		
	}
	
?>