<?php

include_once "../../Model/Admin.php";
include_once "../../Model/fooditem.php";
include_once "../../Model/Category.php";
session_start();
$ID       = $_SESSION['GroupID'];
$CategoryTable = "categories";
if ($_POST OR @$_GET['action']) {
    
    if (isset($_GET['action']) AND $_GET['action'] == "add item") {
        $catdata = Category::listCategories();
        $_SESSION['catdate'] = $catdata;   
        include "../../Viewer/Admin/Admin_views/Admin_subViews/Add Food Item.php";        
    }

    
    if (isset($_POST['submit']) && $_POST['submit'] == "Add") {

        $FoodItem = new fooditem($_POST);
        $result = fooditem::SearchItemByName($FoodItem->Name); // checks if it exists or not

        if($result == 1){ // if that food item exist it will increase its amount only

            $currentAmount = fooditem::getItemAmount($FoodItem->Name);
            $currentAmount['Amount'] += $FoodItem->Amount;
            fooditem::setItemAmount($currentAmount['Amount'],$FoodItem->Name);
           //  we need to notify that item is alredy exists
            header('Location:../../Controller/Admin/Admin Dashboard Controller.php?action=v_FoodItems');
        }else{
           
            $main['Name'] = $FoodItem->Name; 
            $main['Amount'] = $FoodItem->Amount; 
            $main['CATID'] = $FoodItem->CATID; 
            $main['Price'] = $FoodItem->Price;
            $date  =$_POST['year'];
            $date .='-'.$_POST['month'];
            $date .='-'.$_POST['day'];
            $exdate  =$_POST['exyear'];
            $exdate .='-'.$_POST['exmonth'];
            $exdate .='-'.$_POST['exday'];
            $main['Visibility'] = $FoodItem->Visibility;
            $main['ExpireDate'] = $exdate;
            $main['ProductDate'] = $date ;
            $main['Description'] = $FoodItem->Description;
            //print_r($main);
            try {
                
                $dd = $FoodItem->AddNewItem ($main);
                if($dd == true){
                    header('Location:../../Controller/Admin/Admin Dashboard Controller.php?action=v_FoodItems');
                }
                

            } catch (Exception $exc) {
                echo $exc->getMessage();
            } 
       }
        
    }
}