<?php
/**
 * Created by PhpStorm.
 * User: Wishaal
 * Date: 8/31/2016
 * Time: 2:44 PM
 */
require_once('php/config/app.php');

if (!empty($_SESSION['app']['user'])){
    header('Location: main.php');
}

//logic goes here
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $query = "SELECT * FROM unixusers WHERE sysuser='". $_POST['username'] . "'";
    $resultset = $dbh->query($query);
    $data = $resultset->fetch();


    $sthandler = $dbh->prepare('SELECT * FROM user_group WHERE user_id=?');
    $sthandler->execute(array($data['SYSID']));
    if ($row = $sthandler->fetch()) {


        //check if it's a valid LDAP user
        $ldapconn = ldap_connect("192.99");
		if (empty($ldapconn)) {
			$ldapconn = ldap_connect("192.168") or die("Could not connect to LDAP server.");
		}

        $ldaprdn = $_POST['username'] . '@domain.com';
        $ldappass = $_POST['password'];

        if ($ldapconn && !empty($ldappass)) {

            $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

            if ($ldapbind) {
                $_SESSION['userName'] = $_POST['username'];
                $_SESSION['app']['user']['id'] = $data['SYSID'];
                $_SESSION['app']['user']['username'] = $_POST['username'];
                $_SESSION['app']['name'] = getNameLDAP($_POST['username']);
                header('location: main.php');
            } else {
                $error['msg'] = 'Uw password is incorrect!';
            }
        }
        ldap_unbind($ldapconn);
    }else{
        $error['msg'] = 'Gebruiker niet gevonden! Uw account moet aangemaakt worden.';
    }
}
include 'tmpl/core/header.php';
require_once(TEMPLATE_PATH . 'login.tpl.php');
include 'tmpl/core/footer.begin.php';
include 'tmpl/core/footer.end.php';