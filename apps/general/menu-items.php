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
        $dataquery = 'SELECT * FROM menuitem';
        $result = $dbh->query($dataquery);
        $data = array();
        // Parse returned data, and displays them
        while($row = $result->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        require_once('tmpl/menu-items.tpl.php');

        break;

    case 'new':

        $menuitem = 'SELECT * FROM menuitem';
        $menuitemresultset = $dbh->query($menuitem);
        $menuitemdata = array();
        // Parse returned data, and displays them
        while($row = $menuitemresultset->fetch(PDO::FETCH_ASSOC)) {
            $menuitemdata[] = $row;
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $MENUACTIVE = 0;
            if($_POST['MENUACTIVE']) $MENUACTIVE = 1;
            $query = "INSERT INTO menuitem (MENUTITLE, MENULINK, PARENTID, MENUACTIVE, MENUICON, CREATED_AT, CREATED_BY) 
						  VALUES ('" . $_POST['MENUTITLE'] . "', '" . $_POST['MENULINK'] . "', '" . $_POST['PARENTID'] . "', '" . $MENUACTIVE . "', 'MENUICON-list.png', TODAY, '" . getAppUserId() . "')";
            $resultset = $dbh->query($query);


            header('Location: menu-items.php?msg=saved');
        }

        require_once('tmpl/menu-items_new.tpl.php');

        break;

    case 'update':
        //logic goes here
        $menuitem = 'SELECT * FROM menuitem';
        $menuitemresultset = $dbh->query($menuitem);
        $menuitemdata = array();
        // Parse returned data, and displays them
        while($row = $menuitemresultset->fetch(PDO::FETCH_ASSOC)) {
            $menuitemdata[] = $row;
        }

        if(isset($_GET['id'])){
            $data = array();
            $query = "SELECT * FROM menuitem WHERE MENUITEMID='". $_GET['id'] . "'";
            $resultset = $dbh->query($query);
            $data = $resultset->fetch();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST'){

            $MENUACTIVE = 0;
            if($_POST['MENUACTIVE']) $MENUACTIVE = 1;

            $query_menu_update = "UPDATE menuitem SET 
									MENUTITLE = '" . $_POST['MENUTITLE'] . "' ,
									MENULINK = '" . $_POST['MENULINK'] . "',
									PARENTID = '" . $_POST['PARENTID'] . "',
									MENUACTIVE = '" . $MENUACTIVE . "',
									UPDATED_AT = TODAY,
									UPDATED_BY = '" . getAppUserId() . "'
								WHERE MENUITEMID = '" .   $_GET['id'] . "'";
            $resultset_menu_update = $dbh->query($query_menu_update);

            header('Location: menu-items.php?msg=updated');
            exit();
        }

        require_once('tmpl/menu-items_edit.tpl.php');

        break;

    case 'delete':

        if(isset($_GET['id'])){
            $query = "DELETE FROM menuitem WHERE MENUITEMID='". $_GET[id]. "'";
            $resultset = $dbh->query($query);
        }

        header('Location: menu-items.php?msg=deleted');

        break;

}