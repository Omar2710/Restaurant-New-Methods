
<?php


include_once "../../Model/User.php";
include_once "../../Model/Category.php";
include_once "../../Model/fooditem.php";
include_once "../../Model/Visitor.php";
include_once "../../Model/OrderFoodItem.php";
include_once "../../Model/Order.php";
session_start();

$ID       = $_SESSION['GroupID'];

$table = "fooditmes";


if ($_POST OR @$_GET['action']) {

    if (isset($_GET['action']) AND $_GET['action'] == "display") {
        
        try {
            $id = $_GET['id'];
            $joindata =  fooditem::displayItemByID($id);
             foreach($joindata as $join){
             
             $dataPro['Name'] = $join[0];
             $dataPro['Catigiories'] = $join['Name'];
             $dataPro['Price'] = $join['Price'];
             $dataPro['Image'] = $join['Image'];
             $dataPro['Description'] = $join['Description'];
             $dataPro['Visibility'] = $join['Visibility'];
             }

             include "../../Viewer/Visitor/Visitor_views/Visitor_subViews/display Item.php";
        
           
            
        } catch (Exception $exc) {
            echo $exc->getMessage();
        }
        
    }
    

    if (isset($_GET['action']) AND $_GET['action'] == "search_category") {
        
        include "../../Viewer/Visitor/Visitor_views/Visitor_subViews/Search Category.php";
        
    }

    if(isset($_POST['submit']) && ($_POST['submit'] == 'search_category2')){

        $result = Category::searchCategory($_POST['name']);
        if($result != null){ 
          include "../../Viewer/Visitor/Visitor_views/Visitor_subViews/display Searched Category.php"; 
        }else{
            include "../../Viewer/Visitor/Visitor_views/Visitor_Categories View.php";
        }
       
    }

    if (isset($_GET['action']) AND $_GET['action'] == "getIntersectMeals") {
        
       $data = User::getIntersectMeals($_GET['id'],$_SESSION['GroupID']);
       
       include "../../Viewer/Visitor/Visitor_views/Visitor_subViews/Category Meals.php";
        
    }
/////////////////////////////////////////////

    
}else{
    include "../../Viewer/Visitor/Visitor View.php";
}
?>

