
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

   public static function searchItemByName($name){
        self::ConnectToDB();
        $tableName = "fooditems";
        $query = "SELECT * FROM $tableName WHERE Name = '$name' ";
        
        $stmt = self::$sdb->prepare($query);
        $stmt->execute();
        $cont = $stmt->rowCount();
        $row  = $stmt->fetch();
        if($cont > 0){
            return 1;
        }
        else{
          return 0;
        }
         
    }

    public static function setItemAmount($amount,$name){
        self::ConnectToDB();
        $tableName = "fooditems";
        $query = "Update $tableName set Amount = '$amount' WHERE Name = '$name' ";
       
        $stmt = self::$sdb->prepare($query);
        $stmt->execute();
    }
    public static function getItemAmount($name=0,$id=0){
        self::ConnectToDB();
        $tableName = "fooditems";
        if($name ==0){
            $query = "SELECT Amount FROM $tableName WHERE ID = $id ";
        }else{
            $query = "SELECT Amount FROM $tableName WHERE Name = '$name' ";
        }
        
       
        $stmt = self::$sdb->prepare($query);
        $stmt->execute();
        $cont = $stmt->rowCount();
        $row  = $stmt->fetch();
        if($cont > 0){
            return $row;
        }
        else{
          return 0;
        }

    }

    public static function setDisable($itemid){
        start_session();
        self::ConnectToDB();
        $tableName = "fooditems";
        $query = "UPDATE $tableName SET Visibility = 0 where ID = $itemid ";
       
        $stmt = self::$sdb->prepare($query);
        return $stmt->execute();
       
    }

    public static function setEnable($itemid){
        start_session();
        self::ConnectToDB();
        $tableName = "fooditems";
        $query = "UPDATE $tableName SET Visibility = 1 where ID = $itemid ";
       
        $stmt = self::$sdb->prepare($query);
        return $stmt->execute();
        
    }
}




 
?>


