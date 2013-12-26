<?php
	class DataBase {


		private $con;
		private $orgid;

		function __construct($orgid){
			$this->con = $this->getConnection();
			if(!is_string($orgid)){
				$orgid =  $orgid->orgid;
			}
			$this->orgid = mysqli_real_escape_string($this->con,$orgid);
		}//end of constructor

		function getConnection() {
			$con=mysqli_connect("localhost","root","root","segments");
			// Check connection
			if (mysqli_connect_errno()){
				echo "Failed to connect to MySQL: " . mysqli_connect_error();
			} else {
				return $con;
			}//end of if connection
		}//end of getConnection


		function getAllSegments(){
			$orgid = $this->orgid;
			if($orgid==0) {
				$result = mysqli_query($this->con, "select * FROM segs WHERE orgid=0 ");
			} else if($orgid!=0){
				$result = mysqli_query($this->con, "select * FROM segs WHERE orgid='$orgid' OR orgid=0 ");
			}
			
			while($row = mysqli_fetch_array($result)){
				$seg[] = $row;
			}
			return $seg;
		}//end of getAllSegments

		function haveChild($id){
			$orgid = $this->orgid;
			$id = mysqli_real_escape_string($this->con,$id);
			$result = mysqli_query($this->con, "SELECT * FROM segs WHERE parent='$id' AND id!='$id'");
			
			$l = array();
			foreach ($result as $key => $value) {
				$l[] = $value['id'];
			}
			$num = count($l);
			if($num > 0){ return 1;} else { return 0;}
		}

		function getChildren($id){

			/**
			* 
			* Please bear in mind that this function
			* works on the basis that client organizaion segments 
			* will only ever appear under the 1193 custom segment.
			* 
			*/


			$id = mysqli_real_escape_string($this->con,$id);
			
			$orgid = $this->orgid;
			if($id==1193){
				if($orgid==0){
					return $result = mysqli_query($this->con, "SELECT * FROM segs WHERE parent='$id' AND id!='$id' AND orgid='0' ");
				} else {
					return $result = mysqli_query($this->con, "SELECT * FROM segs WHERE parent='$id' AND id!='$id' AND orgid='0' OR orgid='$orgid'");
				}
				
			} else {
				return $result = mysqli_query($this->con, "SELECT * FROM segs WHERE parent='$id' AND id!='$id' ");
			}
			
		}//end of getChildren()

		function setCustomSegment($customid,$title){
			$customid = mysqli_real_escape_string($this->con,$customid);
			$title = mysqli_real_escape_string($this->con,$title);
			$orgid = $this->orgid;
			mysqli_query($this->con, "INSERT INTO segs (name,parent,orgid) VALUES ('$title','1193','$orgid')");
			return mysqli_insert_id($this->con);
		}


	}// end of DataBase classs
	
	