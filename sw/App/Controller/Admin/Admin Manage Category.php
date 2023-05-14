<?php

include_once "../../Model/Admin.php";
include_once "../../Model/User.php";
include_once "../../Model/Category.php";
session_start();

$tableName = "categories";

if ($_POST OR @$_GET['action']) {
}else{
    header('Location:../../../Global/redirect.php');
}
    ?>