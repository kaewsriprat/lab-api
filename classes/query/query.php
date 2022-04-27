<?php 

class query extends connection{

	private static $conn;

	public function __construct(){
		self::$conn = new connection;
		$this->openconn = self::$conn->openConnection();
	}
	
    public function execute($sql){
        $this->stmt = $this->openconn->prepare($sql);
        $this->stmt->execute();
        $this->arr = array();
		while($row = $this->stmt->fetchAll(PDO::FETCH_ASSOC)){
			$this->arr = $row;
		}
		return $this->arr;
	}
}

?>