<?php 
include("global.php");
require_once("payment_manager.php");

$pm=new payment_manager(intval($_POST["invoice_id"]), intval($_POST["amount"]));

$pm->pay($connection, $pm->invoice_id, $pm->amount);
?>