<?php
include_once 'User.php';
include_once 'Database2.php';
include_once "../../Model/Database2.php";
include_once "../../../Global/vars.php";

class Visitor extends User{


	private $order ;
	public $dbo;
	
	function __construct(){
		//parent::__construct($data);
		
		// $x = new User($x);
		//return $x;
	}
 
	public function register($data){
		// access and add to db
		include_once "Database2.php";
		include_once "../../Global/vars.php"; 
        $var = vars::getVars();
		$db = new Database($var);
		$state = $db->add($data,'users');
		return $state;

	}	

	public function ConnectToDB(){
		include_once "../../Model/Database2.php";
        include_once "../../../Global/vars.php";
        $var = vars::getVars();
		$this->dbo = new Database($var);
		$this->dbo = $this->dbo->db;
	
	}   

}
?>