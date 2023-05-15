<?php

include_once "../../Model/Admin.php";
include_once "../../Model/User.php";
include_once "../../Model/Category.php";
session_start();

$tableName = "categories";

if ($_POST OR @$_GET['action']) {
    if(isset($_POST['submit']) && ($_POST['submit'] == 'search_category')){
        $result = Category::searchCategory($_POST['name']);
        include "../../Viewer/Admin/Admin_views/Admin_subViews/display Searched Category.php";
    }

    if (isset($_GET['action']) AND $_GET['action'] == "getIntersectMeals"){

       $data = User::getIntersectMeals($_GET['id']);
       
       include "../../Viewer/Admin/Admin_views/Admin_subViews/Category Meals.php";
    }

}else{
    header('Location:../../../Global/redirect.php');
}
    ?>