
=======
<?php
include_once 'PatternObserver.php';
include_once 'Admin.php';
include_once 'PatternSubject.php';
class fooditem{
	public $ID;
	public $Name;
	public $Amount;
	public $Price;
	public $Description;
	public $Visibility;
	public $CATID;
	//public $ExpireData;
	//public $ProductDate:
	public $db;
	public static $sdb;
	public $tableName ;

    function __construct($data){
		include_once "Database2.php";
		include_once "../../../Global/vars.php";
		 $var = vars::getVars();
		//$this->$ID = $data['id']; get accessed in db
		$this->Name = $data['name'];
		$this->Amount = $data['amount'];
		$this->Price = $data['price'];
		$this->Description = $data['desc'];
		$this->Visibility = $data['vis'];
		$this->CATID = $data['catid'];
        
		$this->db = new Database($var);
		$this->tableName ="fooditems";


	}

    public static function ConnectToDB(){
		include_once "../../Model/Database2.php";
        include_once "../../../Global/vars.php";
        $var = vars::getVars();
		self::$sdb = new Database($var);
		self::$sdb = self::$sdb->db;
	}

    public static function listFoodItems(){
    	self::ConnectToDB();
    	$tablename = "fooditems";
        $sql = "SELECT * from $tablename ";
	    $stmt = self::$sdb->prepare($sql);
	    $stmt->execute();
	    $rows=$stmt->fetchAll();
	    return $rows;
    }
  public function AddNewItem($main){
    	include_once "../../Model/Database2.php";
        include_once "../../../Global/vars.php";
        $var = vars::getVars();

		$this->db = new Database($var);
		$this->db = $this->db->db;
	    
	    $tblName = 'fooditems';
	    $col = 'Name';
	    
	    $keys=array();
	    $values=array(); 
	    foreach($main as $key => $value){
	        
	        $val="'$value'";
	        array_push($keys,$key);
	        array_push($values,$val);
	    }
	    
	    $tblkeys = implode($keys , ',');
	    $datavalues = implode($values , ',') ;
	    $stmt = $this->db->prepare("INSERT INTO $tblName ($tblkeys) VALUES($datavalues)");
        $stmt->execute();
        //observ

        return $this->alarm();
   }
}
?>

