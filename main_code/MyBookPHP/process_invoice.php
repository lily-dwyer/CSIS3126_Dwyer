<?php 

include("global.php");
require_once("invoice_manager.php");

$im = new invoice_manager(mysqli_real_escape_string($connection, $_POST["my_customer_id"]));

$errormsg = "";

$invoice_id = $im->create_invoice($connection, $user_id, $im->my_customer_id, mysqli_real_escape_string($connection, $_POST["due_date"]), 
    $im->get_invoice_num($connection, $im->my_customer_id, $user_id));
$invoice_id=(int)$invoice_id;
$item_titles = $_POST['item_title'];
$item_titles_array=array();
$rates = $_POST['rate'];
$rates_array = array();
$quantities = $_POST['quantity'];
$quantities_array = array();
$descs = $_POST['description'];
$descs_array = array();
foreach ($item_titles as $index => $value) {
    $title = mysqli_real_escape_string($connection, $item_titles[$index]);
    array_push($item_titles_array, $title);
    $rate = intval($rates[$index]);
    array_push($rates_array, $rate);
    $quantity = intval($quantities[$index]);
    array_push($quantities_array, $quantity);
    $description = mysqli_real_escape_string($connection, $descs[$index]);
    array_push($descs_array, $description);
}
if($invoice_id!=false){
    if(($im->add_items($connection, $invoice_id, $item_titles_array, $rates_array, $quantities_array, $descs_array)==false)){
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
