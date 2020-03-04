<?php
/**
 * Created by PhpStorm.
 * User: Wishaal
 * Date: 9/1/2016
 * Time: 10:52 AM
 */

//get the active menu item
if (!empty($taakid)) {
	$activemenuitem = querySelectPDO($dbh, 'SELECT * FROM menuitem WHERE MENUITEMID=\'' . $taakid . '\'');
} else {
	$url_segments = array_reverse(explode('/', $_SERVER['PHP_SELF']));
	$pageurl = $url_segments[1] . '/' . $url_segments[0];

	if(strstr($_SERVER['PHP_SELF'], 'aob_native')){
		$pageurl = array_pop(explode('/', $_SERVER['PHP_SELF'])) . (!empty($_SERVER['QUERY_STRING']) ? '?' : '' ) . $_SERVER['QUERY_STRING'];
	}
	$activemenuitem = querySelectPDO($dbh, 'SELECT * FROM menuitem WHERE MENULINK LIKE (\'%' . $pageurl . '%\')');
}
$parentItem = querySelectPDO($dbh, 'SELECT * FROM menuitem WHERE MENUITEMID = \'' . $activemenuitem['PARENTID'] . '\'');
$appItem = querySelectPDO($dbh, 'SELECT * FROM menuitem WHERE MENUITEMID = \'' . $parentItem['PARENTID'] . '\'');

//load the items for the breadcrumb
$breadcrumbArray = array();
$breadcrumbArray[] = array( 'title' => 'Home', 'url' => '../../main.php' );
$breadcrumbArray[] = array( 'title' => $appItem['MENUTITLE'], 'url' => '../../'. $appItem['MENULINK'] );
$breadcrumbArray[] = array( 'title' => $parentItem['MENUTITLE'], 'url' => '../../'. $parentItem['MENULINK'] );
$breadcrumbArray[] = array( 'title' => $activemenuitem['MENUTITLE'], 'url' => '../../'. $activemenuitem['MENULINK'] );

$query = '	SELECT *
				FROM menuitem
				WHERE
				PARENTID = \''. $menuid .'\'
				AND menuitemid IN (SELECT p.menunr FROM permission AS p WHERE usergroup_id IN 
				( SELECT x.usergroup_id FROM user_group AS x WHERE user_id = \''. $_SESSION['app']['user']['id'] .'\' ) AND permission_select = \'1\')
				AND MENUACTIVE = \'1\'
				ORDER BY ORDERING ASC';

$result = $dbh->query($query);

$sidebar_items = array();
// Parse returned data, and displays them
while($row = $result->fetch(PDO::FETCH_ASSOC)) {
    $sidebar_items[] = $row;
}

//get subitems
$count = 0;

foreach($sidebar_items as $i){

    $subquery = '	SELECT *
				FROM menuitem
				WHERE
				PARENTID = \''. $i['MENUITEMID'] .'\'
				AND menuitemid IN (SELECT p.menunr FROM permission AS p WHERE usergroup_id IN 
				( SELECT x.usergroup_id FROM user_group AS x WHERE user_id = \''. $_SESSION['app']['user']['id'] .'\' ) AND permission_select = \'1\')
				AND MENUACTIVE = \'1\'
				ORDER BY ORDERING ASC';

    $result1 = $dbh->query($subquery);

    // Parse returned data, and displays them
    while($row = $result1->fetch(PDO::FETCH_ASSOC)) {
        $row['selectpermissie'] = 1;
        //permission check for native menu.
        $sidebar_items[$count]['sub'][] = $row;
    }
    $count++;
}