<?php 
include("global.php");

$my_customer_id = mysqli_real_escape_string($connection, $_POST["my_customer_id"]);
$due_date = mysqli_real_escape_string($connection, $_POST["due_date"]);
$item_title = array_map(fn($item) => mysqli_real_escape_string($connection, $item), $_POST['item_title']);
$rate = array_map(fn($item) => mysqli_real_escape_string($connection, $item), $_POST['rate']);
$quantity = array_map(fn($item) => mysqli_real_escape_string($connection, $item), $_POST['quantity']);
$description = array_map(fn($item) => mysqli_real_escape_string($connection, $item), $_POST['description']);


$errormsg = "";

foreach ($item_title as $count => $value) {
    if (empty($item_title[$count])) {
        $errormsg .= "Item name is required for item " . ($count + 1) . "<br>";
    }
    if (empty($rate[$count]) || !is_numeric($rate[$count])) {
        $errormsg .= "Valid rate is required for item " . ($count + 1) . "<br>";
    }
    if (empty($quantity[$count]) || !is_numeric($quantity[$count])) {
        $errormsg .= "Valid quantity is required for item " . ($count + 1) . "<br>";
    }
    if (empty($description[$count])) {
        $errormsg .= "Description is required for item " . ($count + 1) . "<br>";
    }
}

if($errormsg != ""){
    include("input_invoice_items.php");
    die();
}

$sql = "SELECT MAX(invoice_num) AS max FROM invoices WHERE customer_id=$my_customer_id AND company_id=$user_id;";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);
if(is_null($row["max"])){
    $invoice_num=1;
}
else{
    $invoice_num = intval($row["max"]) + 1;
}

$sql="INSERT INTO Invoices (Company_ID, Customer_ID, Charge_Date, Due_Date, Invoice_Num) VALUES
('$user_id', '$my_customer_id', NOW(), '$due_date', '$invoice_num');";
    if(mysqli_query($connection, $sql)){
        echo "";
    }
    else{
        echo "Could not connect to database";
        include("input_invoice.php");
        die();
    }
  
$sql = "SELECT invoice_id FROM invoices WHERE invoice_num=$invoice_num AND customer_id=$my_customer_id AND company_id=$user_id;";
    $query = mysqli_query($connection, $sql);
    $result=mysqli_fetch_assoc($query);
    $invoice_id = $result["invoice_id"];

foreach ($item_title as $count => $value) {
    $sql = "INSERT INTO Invoice_Items (Invoice_ID, Title, Rate, Quantity, Description) VALUES
    ('$invoice_id', '{$item_title[$count]}', '{$rate[$count]}', '{$quantity[$count]}', '{$description[$count]}');";
    if(mysqli_query($connection, $sql)){
        echo "";
    }
    else{
        $errormsg = $errormsg . "Database error. Please try again later.";
        include("input_invoice.php");
        die();
    }
}
header("Location: comp_dash.php");
exit();

?>

