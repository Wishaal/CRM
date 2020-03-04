<?php
/**
 * Created by PhpStorm.
 * User: Wishaal
 * Date: 9/1/2016
 * Time: 9:25 AM
 */

session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL & ~E_NOTICE);
date_default_timezone_set('America/Paramaribo');

$currentDateTime = date('Y-m-d h:i:s a', time());

//========================================define constants=============================
define('APP_TITLE', 'CRM | Telesur ICT Facilities');
define('PATH', realpath(dirname(__FILE__)) . '/../../');
define('TEMPLATE_PATH', PATH . 'tmpl/');
define('ASSETS_PATH', PATH . 'crm/assets/');
define('PHP_PATH', PATH . 'php/');

define('BASE_HREF', 'http://' . $_SERVER['HTTP_HOST'].'/crm/');
define('APP_SECTION', NULL);

define('LIFETIME', (4 * 60 * 60)); //hours * minutes * seconds

if (empty($_SESSION['app']['user']) && !strstr($_SERVER['SCRIPT_NAME'], 'index.php')) {
    header('Location: ' . BASE_HREF . 'index.php');
} else {

    if (isset($_SESSION['timeout']) && ($_SESSION['timeout'] + LIFETIME) < time()) {
        header('Location: ' . BASE_HREF . 'logout.php');
    }
}

$_SESSION['timeout'] = time();

/**
 * @return mixed
 */
function getAppUserId()
{
    return $_SESSION['app']['user']['id'];
}

function getDateTime(){
    // Simply:
    $date = date('Y-m-d H:i:s');
    return $date;

}

/**
 * @return mixed
 */
function getAppUserName()
{
    return $_SESSION['app']['user']['username'];
}

try {
    //plain pdo connection
    $dbh = new PDO("odbc:Driver={IBM INFORMIX ODBC DRIVER};HOSTNAME=;service=9088;server=devshm;DATABASE=telesur;PROTOCOL=onsoctcp; UID=;PWD=;");
    $dbh->setAttribute(PDO::ATTR_CASE, PDO::CASE_UPPER);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);    	//smk 09112016
    $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
} catch (Exception $e) {

    $msg = $e->getMessage();
    echo $msg.'<br>Database (Telsur03) is down, Please contact helpdesk.mis@telesur.sr<br>';
}



/**
 * @param $db
 * @param $selectquery
 * @return array|mixed
 */
function querySelectPDO($db, $selectquery)
{
    // Define and perform the SQL SELECT query
    $query = $selectquery;
    $result = $db->query($query);
    $data = array();
    // Parse returned data, and displays them
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }
    if (count($data) == 1) {
        return $data[0];
    } else {
        return $data;
    }
}

function querySelect($db, $selectquery)
{
    // Define and perform the SQL SELECT query
    $query = $selectquery;
    $result = $db->query($query);
    $data = array();
    // Parse returned data, and displays them
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        $data[] = $row;
    }

    return $data;
}

function getUsergroups($userid){
    global $dbh;
    $data = querySelect($dbh,"select distinct(usergroups_name) from user_group,usergroups 
                                    where user_group.usergroup_id = usergroups.usergroups_id and user_group.user_id=".$userid);
    $role = array();
    foreach ($data as $r){
        $role[] = $r['USERGROUPS_NAME'];
    }

    $two = implode(',',$role);

    return $two;
}

function getNameLDAP($username){

    //check if it's a valid LDAP user
    $ldapconn = ldap_connect("") or die("Could not connect to LDAP server.");

    $ldaprdn	= '';
    $ldappass	= '';

    if ($ldapconn && !empty($ldappass)) {

        ldap_set_option($ldapconn, LDAP_OPT_PROTOCOL_VERSION, 3) or die('Unable to set LDAP protocol version');
        ldap_set_option($ldapconn, LDAP_OPT_REFERRALS, 0); // We need this for doing an LDAP search.

        $ldapbind = ldap_bind($ldapconn, $ldaprdn, $ldappass);

        if ($ldapbind) {
            //------------------------------------------------------------------------------
            // Get a list of all Active Directory users.
            //------------------------------------------------------------------------------
            $ldap_base_dn = 'DC=telesur,DC=COM';
            $search_filter = "(|(samaccountname=$username))";
            //$justthese = array('ou', 'sn', 'givenname', 'mail');
            $result = ldap_search($ldapconn, $ldap_base_dn, $search_filter);
            if (FALSE !== $result){
                $entries = ldap_get_entries($ldapconn, $result);
                if ($entries['count'] > 0){
                    $surname =  $entries[0]['sn'][0];
                    $givenname =  $entries[0]['givenname'][0];
                }
            }
        }
    }


    return $surname.' '.$givenname;
}

/**
 * @return array
 */
function getBrowser()
{
    $u_agent = $_SERVER['HTTP_USER_AGENT'];

    $bname = 'Unknown';
    $platform = 'Unknown';
    $version = "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    } elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    } elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if (preg_match('/MSIE/i', $u_agent) && !preg_match('/Opera/i', $u_agent)) {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    } elseif (preg_match('/Firefox/i', $u_agent)) {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    } elseif (preg_match('/Chrome/i', $u_agent)) {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    } elseif (preg_match('/Safari/i', $u_agent)) {
        $bname = 'Apple Safari';
        $ub = "Safari";
    } elseif (preg_match('/Opera/i', $u_agent)) {
        $bname = 'Opera';
        $ub = "Opera";
    } elseif (preg_match('/Netscape/i', $u_agent)) {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
        ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent, "Version") < strripos($u_agent, $ub)) {
            $version = $matches['version'][0];
        } else {
            $version = $matches['version'][1];
        }
    } else {
        $version = $matches['version'][0];
    }

    // check if we have a number
    if ($version == null || $version == "") {
        $version = "?";
    }

    return array(
        'userAgent' => $u_agent,
        'name' => $bname,
        'version' => $version,
        'platform' => $platform,
        'pattern' => $pattern
    );
}
