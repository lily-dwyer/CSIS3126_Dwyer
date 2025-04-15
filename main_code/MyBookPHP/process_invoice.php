<?php 
include("global.php");
require_once("invoice_manager.php");

$im = new invoice_manager(mysqli_real_escape_string($connection, $_POST["my_customer_id"]));

$errormsg = "";

$im->add_items($connection, 
    $im->create_invoice($connection, $user_id, $im->my_customer_id, mysqli_real_escape_string($connection, $_POST["due_date"]), 
        $im->get_invoice_num($connection, $im->my_customer_id, $user_id)),
    $_POST['item_title'], $_POST['rate'], $_POST['quantity'], $_POST['description'], $errormsg);

header("Location: comp_dash.php");
exit();

?>

