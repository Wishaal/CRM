<?php
$session=session_id();
$time=time();
$time_check=$time-1800; //SET TIME 10 Minute

try {
    $sthandler = $dbh->prepare('SELECT * FROM ba_online_users WHERE ou_session=?');
    $sthandler->execute(array($session));
} catch (Exception $e) {

    $msgx = $e->getMessage();
    echo $msgx;
}



$ua=getBrowser();
$yourbrowser= " | browser: " . $ua['name'] . " " . $ua['version'] . " on " .$ua['platform'];
if ($row = $sthandler->fetch())
{
  $dataquery_update = "UPDATE ba_online_users SET ou_username='" . $_SESSION['app']['user']['username'] . "', ou_time='$time', ou_activity='".$_SERVER['SERVER_NAME'].' | '.$_SERVER['PHP_SELF'].' | '. $yourbrowser ."', ou_date='".getDateTime()."' WHERE ou_session = '$session'";
  $result_update = $dbh->query($dataquery_update);

  $dataquery_log = "INSERT INTO log_users
  (lu_username, lu_session, lu_time,lu_ip_address,lu_refurl, lu_activity,lu_date) VALUES ('" . $_SESSION['app']['user']['username'] . "', '" . $session . "', '" . $time. "', '".$_SERVER['REMOTE_ADDR']."', '".  $_SERVER['HTTP_REFERER']."', '".$_SERVER['SERVER_NAME'].' | '.$_SERVER['PHP_SELF'].' | '. $yourbrowser ."','".getDateTime()."')";
  $result_log = $dbh->query($dataquery_log);

  //echo $dataquery_log;
  }
else
{
  $dataquery = "INSERT INTO ba_online_users
  (ou_username, ou_session, ou_time,lu_ip_address, ou_refurl,ou_activity,ou_date) VALUES ('" . $_SESSION['app']['user']['username'] . "', '" . $session . "', '" . $time. "', '".$_SERVER['REMOTE_ADDR']."', '".  $_SERVER['HTTP_REFERER']."', '".$_SERVER['SERVER_NAME'].' | '.$_SERVER['PHP_SELF'].' | '. $yourbrowser ."','".getDateTime()."')";
  //echo $dataquery;
  $result = $dbh->query($dataquery);

  $dataquery_log = "INSERT INTO log_users
  (lu_username, lu_session, lu_time,lu_ip_address,lu_refurl, lu_activity,lu_date) VALUES ('" . $_SESSION['app']['user']['username'] . "', '" . $session . "', '" . $time. "', '".$_SERVER['REMOTE_ADDR']."', '".  $_SERVER['HTTP_REFERER']."', '".$_SERVER['SERVER_NAME'].' | '.$_SERVER['PHP_SELF'].' | '. $yourbrowser ."','".getDateTime()."')";
  $result_log = $dbh->query($dataquery_log);
}
$dataquery_delete = "DELETE FROM ba_online_users WHERE ou_time<$time_check";
$result_delete = $dbh->query($dataquery_delete);
?>