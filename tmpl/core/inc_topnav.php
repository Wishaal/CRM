<?php
/**
 * Created by PhpStorm.
 * User: Wishaal
 * Date: 9/1/2016
 * Time: 10:52 AM
 */

$query = '	SELECT *
				FROM menuitem
				WHERE 
				menuitemid 
				IN (SELECT p.menunr FROM permission AS p 
				WHERE usergroup_id IN ( SELECT x.usergroup_id FROM user_group AS x 
				WHERE user_id = \''. $_SESSION['app']['user']['id'] .'\' ) AND permission_select = \'1\')
				AND PARENTID = \'0\'
				AND MENUACTIVE = \'1\' order by ORDERING desc';
$result = $dbh->query($query);
$topnav_items = array();
// Parse returned data, and displays them
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $topnav_items[] = $row;
}