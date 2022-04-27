<?php 

class connection {

	private static $conn;

	protected function openConnection(){
		if (!isset(self::$conn)){
			if(DRIVER == 'MSSQL'){
				self::$conn = new PDO("sqlsrv:server=".HOST."; Database=".DB, UID, PASSWORD);
			} elseif(DRIVER == 'MySQL'){
				self::$conn = new PDO("mysql:host=".HOST.";dbname=".DB,UID,PASSWORD);
			} else {
				echo"ERROR: undefined or wrong driver";
			}
		}
		return self::$conn;
	}

	public function closeConnection(){
		self::$conn = null;
	}

	public function showConnection(){
		if(self::$conn){
			echo"<br>CONNECTION COMPLETE<br>";
		} else {
			echo"<br>CANNOT CONNECT TO SERVER<br>";
		}
	}
}

?>