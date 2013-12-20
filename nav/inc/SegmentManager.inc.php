<?php
	

	class SegmentManager {
		private $db;
		private $seg = array();

		function __construct($db){
			$this->db = $db;
			$this->seg[] = $this->db->getAllSegments();
		}
		
		

		function getParentSegments(){
			$restful = array();
			$seg = $this->seg;
			$return = '<ul class="root">';
			//var_dump($seg);
			foreach ($seg as $k => $v ) {
				foreach ($v as $key => $value) {
					//so that only parent categories are returned
					if($value['parent'] <1) {
						$return .= '<li class="">

						<span id="" class="segmentCheck">
								<!-- input id and label takes the corresponding ID of segment in database -->
								<input type="checkbox" name="'.$value['id'].'" value="" id="'.$value['id'].'" class="parentCheckbox">
								<label for="'.$value['id'].'"></label>
						</span>';
						
						if($this->db->haveChild($value['id'])==1){
							$return .= '<div class="isExpandable">';
							$return .= '<a href="getSubSegment.php?pid='.$value['id'].'" class="isClosed" >'.$value['name'].'</a></div>';
							$return .= '</li>';
						} else {
							$return .= '<a href="getSubSegment.php?pid='.$value['id'].'" class="'.$value['id'].'" >'.$value['name'].'</a>';
							$return .= '</li>';
						}
					}//end of if
				}//end of first foreach
			}//end of second foreach
			$return .= "</ul>";
			return $return;
		}//end of getParentSegments() function

		function getSubRoot($id){

			$db = $this->db;
			$children = $db->getChildren($id);

			$return = '<ul class="subRoot" id="'.$id.'">';
			foreach ($children as $k => $v) {
				$return .= '<li>
								<span id="" class="segmentCheck">
									<input type="checkbox" name="" value="" id="'.$id.'-'.$v['id'].'" class="">
									<label for="'.$id.'-'.$v['id'].'"></label>
								</span>';

				if($db->haveChild($v['id'])==1){
					$return .= '<div class="isExpandable">';
					$return .= '<a href="">'.$v['name'].'</a>';
					$return .= '</div>';
				} else {
					$return .= '<a href="">'.$v['name'].'</a>
							</li>';
				}
				
			}


			
				
			$return .= '</ul><!-- end 2 child ul -->';
			return $return;

		}//end of getSubRoot()


	}//end of class


