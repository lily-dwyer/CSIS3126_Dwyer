<?php 
include("global.php");
require_once("payment_manager.php");

$pm=new payment_manager(intval($_POST["invoice_id"]), intval($_POST["amount"]));

if($pm->pay($connection)){
    header("Location: comp_dash.php");
    exit();
}else{
    echo "Could not connect to database";
    include("payment.php");
    die();
}
?>