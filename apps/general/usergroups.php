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
			$dataquery = 'SELECT * FROM usergroups';
			$dataresultset = $dbh->query($dataquery);
			$data = array();
			// Parse returned data, and displays them
			while($row = $dataresultset->fetch(PDO::FETCH_ASSOC)) {
				$data[] = $row;
			}
		
			require_once('tmpl/usergroups.tpl.php');
			
		break;
		
		case 'new':
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$active = 0;
				if($_POST['active']) $active = 1;
				$query = "INSERT INTO usergroups (usergroups_name, usergroups_description, created_at, created_by) 
								VALUES ('" . $_POST['name'] . "', '" . $_POST['description'] . "', TODAY, '" . getAppUserId() . "')";
				$dataresultset = $dbh->query($query);
				
				header('Location: usergroups.php?msg=saved');
			}
			
			require_once('tmpl/usergroups_new.tpl.php');
			
		break;
		
		case 'update':
			
			if(isset($_GET['id'])){
				$query = "SELECT * FROM usergroups WHERE usergroups_id='". $_GET['id'] . "'";
				$resultset = $dbh->query($query);
				$data = $resultset->fetch();
				
			}
			
			if($_SERVER['REQUEST_METHOD'] == 'POST'){
				
				$active = 0;
				if($_POST['active']) $active = 1;		
				$query = "	UPDATE usergroups SET 
									usergroups_name = '" . $_POST['name'] . "' ,
									usergroups_description = '" . $_POST['description'] . "',
									updated_at = TODAY,
									updated_by = '" . getAppUserId() . "'
								WHERE usergroups_id = '" .   $_GET['id'] . "'";
				$resultset = $dbh->query($query);	
				
				header('Location: usergroups.php?msg=updated');
				exit();
			}
			
			require_once('tmpl/usergroups_edit.tpl.php');
			
		break;
		
		case 'delete':
			
			if(isset($_GET['id'])){
				
				$usergroupdata = querySelectPDO($dbh,'SELECT * FROM user_group WHERE usergroup_id = \'' . $_GET['id'] . '\'');
				if(!empty($usergroupdata)){
					header('Location: usergroups.php?msg=delete-failed');
					exit();
				} else {

					$query1 = "DELETE FROM permission WHERE usergroup_id='". $_GET[id]. "'";
					$resultset1 = $dbh->query($query1);
										
					$query = "DELETE FROM usergroups WHERE usergroups_id='". $_GET[id]. "'";
					$resultset = $dbh->query($query);

					header('Location: usergroups.php?msg=deleted');
					exit();
				}
				
			}
			
		break;
		
	}
	
?>