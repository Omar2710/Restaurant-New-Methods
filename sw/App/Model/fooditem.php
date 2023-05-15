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