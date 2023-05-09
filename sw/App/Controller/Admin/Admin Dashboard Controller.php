
<?php
//session_start();
  //  include_once '../../Model/User.php';
    //include_once '../../Model/Order.php'; 
    //include_once '../../Model/OrderFoodItem.php';

    $username = $_SESSION['username'];
    $password = $_SESSION['password'];
    
    $user  = new User($username,$password);

if ($_POST OR @$_GET['action']) {


    if (isset($_GET['action']) AND $_GET['action'] == "v_orders") {
        include "../../Viewer/Admin/Admin_views/Admin_Orders View.php";
    }


     if (isset($_GET['action']) AND $_GET['action'] == "v_user") {
        include "../../Viewer/Admin/Admin_views/Admin_Users View.php";
    }

    if (isset($_GET['action']) AND $_GET['action'] == "v_item") {
        include "../../Viewer/Admin/Admin_views/Admin_FoodItems View.php";
    }
    
    if (isset($_GET['action']) AND $_GET['action'] == "v_category") {
        include "../../Viewer/Admin/Admin_views/Admin_Categories View.php";
    }
   
    if (isset($_GET['action']) AND $_GET['action'] == "v_FoodItems") {
        include "../../Viewer/Admin/Admin_views/Admin_FoodItems View.php";

    }
    
//////////////////////////////////////////////////////////////////////////////
}
?>