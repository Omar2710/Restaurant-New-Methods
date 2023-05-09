

<?php

include_once "../Model/user.php";


if($_POST){
    if(isset($_POST['submit']) && ($_POST['submit'] == 'Login')){
        $username = $_POST['username'];
        $password = $_POST['password'];

        try
        {
             echo '1';
            include_once '../Model/User.php';
            echo '2';
            $log = User::login($username,$password);
            echo '3';
            $x = User::getActiveStateforLogin($username,$password);
            echo '4';
            if($log == true &&  $x[0] != 0){
                echo '5';
                session_start();
                
                $_SESSION['username'] = $username;

                $_SESSION['password'] = $password;
                $_SESSION['GroupID'] = User::getGroupID($username,$password);
                
                $_SESSION['logout'] = '';
                $_SESSION['active'] = User::getActiveState($_SESSION['GroupID']);
          
                header('Location:../../Global/redirect.php');

            }else if($x[0] == 0){
                echo '6';
                header('Location:../../Global/Login View.php?msg=You Are blocked by the admin !!');
               
            }
            
        }
        catch(Exception $EXC)
        {
            header('Location:../../Global/Login View.php?msg='.$EXC);
   
        }
    }

}

if(isset($_GET['action']) AND $_GET['action'] == "forget"){
    
        include '../../Global/EnterEmail.php';
}


if(isset($_POST['submit']) && ($_POST['submit'] == 'recover_email')){

    $pass = User::getPassword($_POST['Email']);
    if($pass == -1){ // user not exist
        header('Location:LoginController.php?action=forget&msg=notexist');
    }else{
        $email = $_POST['Email'];
        include '../../Global/Mail.php';
        header('Location:LoginController.php?action=forget&msg=message has been sent right now check your Gmail');
    }
 
}



?>