<?php 

include("global.php");
require_once("invoice_manager.php");

$im = new invoice_manager(mysqli_real_escape_string($connection, $_POST["my_customer_id"]));

$errormsg = "";

$invoice_id = $im->create_invoice($connection, $user_id, $im->my_customer_id, mysqli_real_escape_string($connection, $_POST["due_date"]), 
    $im->get_invoice_num($connection, $im->my_customer_id, $user_id));
$invoice_id=(int)$invoice_id;
$item_title = $_POST['item_title'];
$item_titles=array();
$rate = $_POST['rate'];
$rates = array();
$quantity = $_POST['quantity'];
$quantities = array();
$description = $_POST['description'];
$descs = array();
foreach ($item_title as $index => $value) {
    $title = mysqli_real_escape_string($connection, $item_title[$index]);
    array_push($item_titles, $title);
    $rate = intval($rate[$index]);
    array_push($rates, $rate);
    $quantity = intval($quantity[$index]);
    array_push($quantities, $quantity);
    $description = mysqli_real_escape_string($connection, $description[$index]);
    array_push($descs, $description);
}
if($invoice_id!=false){
    if(($im->add_items($connection, $invoice_id, $item_titles, $rates, $quantities, $descs)==false)){
        $errormsg = $errormsg . "Please input all fields";
        include("input_invoice.php");
        die();
    }
    else{
        header("Location: comp_dash.php");
        exit();
    }
}else{
    echo "Could not connect to database";
    include("input_invoice.php");
    die();
}

?>
