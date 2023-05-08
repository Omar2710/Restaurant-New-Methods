<?php

include_once "../../Model/Admin.php";

session_start();

$table = "users";

if ($_POST OR @$_GET['action']) {
    
    if (isset($_GET['action']) AND $_GET['action'] == "search_user") {
        include "../../Viewer/Admin/Admin_views/Admin_subViews/Search User";          
    }
    // post for search user
    if (isset($_POST['submit']) && $_POST['submit'] == "search") {

     		$result = Admin::searchUser($_POST['name']);
 			
 			if($result != 0){
 				
 				include "../../Viewer/Admin/Admin_views/Admin_subViews/display Searched User.php";
 			}else{
 				include "../../Viewer/Admin/Admin_views/Admin_subViews/Search User";
 			}


    }
}else{
    header('Location:../../../Global/redirect.php');
}