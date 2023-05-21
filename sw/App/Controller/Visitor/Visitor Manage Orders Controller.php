<?php
session_start();

//var_dump($_SESSION);
    include_once '../../Model/Visitor.php';
    include_once '../../Model/User.php';
    include_once '../../Model/Order.php';
    include_once '../../Model/OrderFoodItem.php';

if ($_POST OR @$_GET['action']) {

    $result = User::getUserDataByName($_SESSION['username']);
    $visitor = new Visitor();
        

    if (isset($_GET['action']) AND $_GET['action'] == "v_CurrentOrders") {

        $orderData = Order::getOrderData($_SESSION['GroupID']);
        include "../../Viewer/Visitor/Visitor_views/Visitor_subViews/Pending Orders.php";
    }

}