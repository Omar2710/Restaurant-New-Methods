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