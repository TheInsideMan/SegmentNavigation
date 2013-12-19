<?php
	

	class SegmentManager {
		require_once('./DataBase.inc.php');
		private $restful = array();
		private $db = new DataBase();
		private $seg[] = $db->GetAllSegments();

		function getParentSegments(){
			$seg[] = $this->seg;
			foreach ($seg as $k => $v ) {
				if($v['parent'] <1) {
					$id =$v['id'];
					$restful[$id] = $v['name'];
				}//end of if
			}//end of foreach
			$return = "<ul class="root">";
			foreach ($restful as $key => $value) {
				$return .= '<li class=""><a href="getSubSegment.php?pid='.$key.'" class="'.$key.'" ">'.$value.'</a></li>';
			}
			$return .= "</ul>";
			return $return;

		}







	}








	//
	
	

	
	

		
?>