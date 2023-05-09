
<?php

class Admin{
	private $Id;
	private static $db;

	public static function ConnectToDB(){
		include_once "../../Model/Database2.php";
        include_once "../../../Global/vars.php";
        $var = "../../../Global/vars.php";
        $var = vars::getVars();
		self::$db = new Database($var);
		self::$db = self ::$db->db;
	
	}
  
public static function searchUser($name){
        self::ConnectToDB();
        $tableName = "users";
        if($name != 'admin'){

                $query = "SELECT * FROM $tableName WHERE Username = '$name' ";
                $stmt = self::$db->prepare($query);
                $stmt->execute();
                $cont = $stmt->rowCount();
                $row  = $stmt->fetch();
                if($cont > 0){
                    return $row;
                }
                else{
                  return 0;
                }
            }else{
                return 0;
            }
            
         
    }

    public static function DisplayAllUsers(){ // gets table name and display all its datas
        self::ConnectToDB();
        $tablename = "users";
        $sql = "SELECT * from $tablename where ID != 1";
        $stmt = self::$db->prepare($sql);
        $stmt->execute();
        $rows=$stmt->fetchAll();
        return $rows;
    }
}


?>

