<?php
	class DataBase {


		private $con;

		function __construct(){
			$this->con = getConnection();
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




	}// end of DataBase classs
	
	

?>