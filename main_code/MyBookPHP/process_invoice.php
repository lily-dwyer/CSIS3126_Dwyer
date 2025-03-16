<?php 
include("global.php");

$my_customer_id = mysqli_real_escape_string($connection, $_POST["my_customer_id"]);
$item_title = mysqli_real_escape_string($connection, $_POST["item_title"]);
$rate = mysqli_real_escape_string($connection, $_POST["rate"]);
$quantity = mysqli_real_escape_string($connection, $_POST["quantity"]);
$description = mysqli_real_escape_string($connection,$_POST["description"]);
$invoice_num = mysqli_real_escape_string($connection, $_POST["invoice_num"]);
$final = isset($_POST['add_and_preview']) ? "true" : "false";

$errormsg = "";

if (empty($item_title)) {
    $errormsg = $errormsg . "Item title is required <br>";
}
if (empty($rate)) {
    $errormsg = $errormsg . "Item rate is required <br>";
}
if (empty($quantity)) {
    $errormsg = $errormsg . "Item quantity is required <br>";
}
if (empty($description)) {
    $errormsg = $errormsg . "Description is required <br>";
}

if($errormsg != ""){
    echo $errormsg;
    include("input_invoice_items.php");
    die();
}

$sql = "SELECT invoice_id FROM invoices WHERE invoice_num=$invoice_num;";
    $query = mysqli_query($connection, $sql);
    $result=mysqli_fetch_assoc($query);
    $invoice_id = $result["invoice_id"];


$sql = "INSERT INTO Invoice_Items (Invoice_ID, Title, Rate, Quantity, Description) VALUES
('$invoice_id', '$item_title', '$rate', '$quantity', '$description');";

if($final=="true"){
    if(mysqli_query($connection,$sql)){
        include("invoice_preview.php");
    }
    else{
        die("Could not connect to database");
    }
}
if($final=="false"){
    if(mysqli_query($connection,$sql)){
        include("input_invoice_items.php");
    }
    else{
        die("Could not connect to database");
    }
}

?>

