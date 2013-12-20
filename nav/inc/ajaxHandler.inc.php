<?php
	if(!empty($_REQUEST['id'])) $id = $_REQUEST['id'];
	if(!empty($_REQUEST['customid'])) $customid = $_REQUEST['customid'];
	if(!empty($_REQUEST['title'])) $title = $_REQUEST['title'];
	if(!empty($_REQUEST['orgid'])) {
		$orgid = $_REQUEST['orgid'];
	} else {
		$orgid = 0;
	}

	

	require_once('SegmentManager.inc.php');
	require_once('DataBase.inc.php');
	$db = new DataBase($orgid);
	$sm = new SegmentManager($db);
	

	if(!empty($customid) && !empty($title)){
		echo $db->setCustomSegment($customid,$title);
	} else if(!empty($id)){
		echo $sm->getSubRoot($id);
	}
	
	




	