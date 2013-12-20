<?php
	if(!empty($_REQUEST['id'])) $id = $_REQUEST['id'];
	
	require_once('SegmentManager.inc.php');
	require_once('DataBase.inc.php');
	$db = new DataBase();
	$sm = new SegmentManager($db);

	echo $sm->getSubRoot($id);




	