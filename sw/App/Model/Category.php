<?php
class Category{

	public $Name;
	public $ID;
    public $foodItem;
	public static $sdb;
	function __construct($data){
		$this->Name = $data['name'];
        //$foodItem = new fooditem();
	}

	public static function ConnectToDB(){
		include_once "../../Model/Database2.php";
        include_once "../../../Global/vars.php";
        $var = vars::getVars();
		self::$sdb = new Database($var);
		self::$sdb = self::$sdb->db;
	}
    public static function listCategories(){
        //connect to datebase
            self::ConnectToDB();
            $tablename = "categories";
            $sql = "SELECT * from $tablename ";
            $stmt = self::$sdb->prepare($sql);
            $stmt->execute();
            $rows=$stmt->fetchAll();
            return $rows;
        }

}


?>