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
								<input type="checkbox" name="'.$value['id'].'" value="'.$value['id'].'" id="'.$value['id'].'" class="parentCheckbox">
								<label for="'.$value['id'].'"></label>
						</span>';
						
						if($this->db->haveChild($value['id'])==1 || $value['id']==1193){
							$return .= '<div class="isExpandable">';
							$return .= '<a href="getSubSegment.php?pid='.$value['id'].'"  id="'.$value['id'].'" class="isClosed" >'.$value['name'].'</a></div>';
							if($value['id']==1193){
								$return .= '<div class="clear"></div>';
								$return .= $this->getSubRoot('1193');
							}
							$return .= '</li>';
						} else {
							$return .= '<a href="getSubSegment.php?pid='.$value['id'].'" id="'.$value['id'].'" class="'.$value['id'].'" >'.$value['name'].'</a>';
							//if($value['id']=1193) $return .= $this->getSubRoot('1193');
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
			


			if($id==1193){
				$return = '<ul class="subRoot" id="customListLeft">';
			} else {
				$return = '<ul class="subRoot" id="'.$id.'">';	
			}

			foreach ($children as $k => $v) {

				$return .= '<li>
								<span id="" class="segmentCheck">
									<input type="checkbox" name="" value="'.$v['id'].'" id="'.$id.'-'.$v['id'].'" class="">
									<label for="'.$id.'-'.$v['id'].'"></label>
								</span>';
			

				if($db->haveChild($v['id'])==1){
					$return .= '<div class="isExpandable">';
					$return .= '<a href="#" class="isClosed" id="'.$v['id'].'">'.$v['name'].'</a>';
					$return .= '</div>';
					
				} else {
					$return .= '<a href=""  id="'.$v['id'].'">'.$v['name'].'</a></li>';
				}
				
			}//end of foreach


			
				
			$return .= '</ul><!-- end 2 child ul -->';
			return $return;

		}//end of getSubRoot()


	}//end of class


