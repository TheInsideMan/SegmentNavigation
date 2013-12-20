<?php
	class DataBase {


		private $con;

		function __construct(){
			$this->con = $this->getConnection();
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
			$result = mysqli_query($this->con, "select * from segs");
			while($row = mysqli_fetch_array($result)){
				$seg[] = $row;
			}
			return $seg;
		}//end of getAllSegments

		function haveChild($id){
			$result = mysqli_query($this->con, "SELECT * FROM segs WHERE parent='$id' AND id!='$id'");
			$l = array();
			foreach ($result as $key => $value) {
				$l[] = $value['id'];
			}
			$num = count($l);
			if($num > 0){ return 1;} else { return 0;}
		}

		function getChildren($id){
			$id = mysqli_real_escape_string($this->con,$id);
			return $result = mysqli_query($this->con, "SELECT * FROM segs WHERE parent='$id' AND id!='$id'");
		}//end of getChildren()

		function setCustomSegment($customid,$title){
			$customid = mysqli_real_escape_string($this->con,$customid);
			$title = mysqli_real_escape_string($this->con,$title);
			mysqli_query($this->con, "INSERT INTO segs (id,name,parent) VALUES ('$customid','$title','1193')");

		}


	}// end of DataBase classs
	
	