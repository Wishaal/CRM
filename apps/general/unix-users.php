<?php
/**
 * Created by PhpStorm.
 * User: Wishaal
 * Date: 9/1/2016
 * Time: 2:12 PM
 */


$menuid = 1;
//global includes
require_once('../../php/config/app.php');

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);

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
        $dataquery = 'SELECT * FROM unixusers where sysid  in (select distinct(user_id) user_id from user_group) order by sysuser';
        $result = $dbh->query($dataquery);
        $data = array();
        // Parse returned data, and displays them
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        require_once('tmpl/unix-users.tpl.php');

        break;

    case 'new':

        $usergroups = querySelectPDO($dbh, 'SELECT * FROM usergroups');
        $users = querySelectPDO($dbh, 'SELECT * FROM unixusers where sysid not in (select distinct(user_id) user_id from user_group) order by sysuser');
        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $active = 0;
            if($_POST['active']) $active = 1;

            if($_POST['usergroup']){
                $lastId = $_POST['username'];
                foreach($_POST['usergroup'] as $group_id){
                    $groupquery = "INSERT INTO user_group (user_id, usergroup_id) VALUES ('" . $lastId . "', '" . $group_id . "')";
                    $resultset_group = $dbh->query($groupquery);
                }
            }

            header('Location: unix-users.php?msg=saved');
        }

        require_once('tmpl/users_new.tpl.php');

        break;

    case 'update':
        if(isset($_GET['id'])){
            $users = querySelectPDO($dbh, 'SELECT * FROM unixusers order by sysuser');
            $query = "SELECT * FROM unixusers WHERE sysid='". $_GET['id'] . "'";
            $resultset = $dbh->query($query);
            $data = $resultset->fetch();

            $usergroups = querySelectPDO($dbh, 'SELECT * FROM usergroups');

            $selectedgroups = querySelectPDO($dbh, 'SELECT usergroup_id FROM user_group WHERE user_id = \'' . $_GET['id'] . '\'');
            $selectedgroupsArr = array();
            if(count($selectedgroups) == 1){
                $selectedgroupsArr[] = $selectedgroups['USERGROUP_ID'];
            } else {
                foreach($selectedgroups as $group){ $selectedgroupsArr[] = $group['USERGROUP_ID']; }
            }
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $active = 0;
            if($_POST['active']) $active = 1;

            $delquery = "DELETE FROM user_group WHERE user_id='". $_GET[id]. "'";
            $resultset = $dbh->query($delquery);

            if($_POST['usergroup']){
                $lastId = $_GET['id'];
                foreach($_POST['usergroup'] as $group_id){
                    $groupquery = "INSERT INTO user_group (user_id, usergroup_id) VALUES ('" . $lastId . "', '" . $group_id . "')";
                    $resultset = $dbh->query($groupquery);
                }
            }

            header('Location: unix-users.php?msg=updated');
            exit();
        }

        require_once('tmpl/users_edit.tpl.php');

        break;

    case 'delete':

        if(isset($_GET['id'])){
            $query0 = "DELETE FROM user_group WHERE user_id='". $_GET[id]. "'";
            $resultset = $dbh->query($query0);
        }

        header('Location: unix-users.php?msg=deleted');

        break;

}