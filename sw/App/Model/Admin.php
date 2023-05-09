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
}
//View Update Profile :
if (isset($_GET['action']) AND $_GET['action'] == "UpdateProfile")
{
	$date = User::DisplayProfile($_SESSION['GroupID']); // either visitor or admin
   include '../../../Global/Profile.php';
}

//Edit Profile
if (isset($_POST['submit']) && $_POST['submit'] == "Edit profile")
{
  
   $main['ID'] = $_POST['ID']; 

   if(empty($_POST['username'])){

   }else{
	   $main['Username'] = $_POST['username']; 
   }
   
   if(empty($_POST['newpassword'])){
	   
   }else{
	   $main['Password'] = $_POST['newpassword']; 
   } 

   if(empty($_POST['fullname'])){

   }else{
	   $main['Fullname'] = $_POST['fullname']; 
   }
   
   if(empty($_POST['email'])){

   }else{
	   $main['Email'] = $_POST['email']; 
   }

   if(empty($_POST['phone'])){

   }else{
	   $main['Phone'] = $_POST['phone']; 
   }

   if(empty($_POST['address'])){

   }else{
	   $main['Address'] = $_POST['address']; 
   }

   try {
	   $ID = $main['ID'];
	   $dd = $user->UpdateProfile($main,$ID);
   
	   if($dd == true){
		   header("Refresh:0");
		   header('Location:../../../Global/redirect.php');
	   }
	   

   } catch (Exception $exc) {
	   echo $exc->getMessage();
   }    
}

else {
header("Refresh:0");
header('Location:../../../Global/redirect.php');
}
?>
