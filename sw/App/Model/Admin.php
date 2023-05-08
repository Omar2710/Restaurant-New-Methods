<?php

class Admin{
	private $Id;
	private static $db;

	public static function ConnectToDB(){
		include_once "../../Model/Database2.php";
        include_once "../../../Global/vars.php";
        //$var = "../../../Global/vars.php";
        $var = vars::getVars();
		self::$db = new Database($var);
		self::$db = self ::$db->db;
	
	}
}

?>