<?php
include("global.php");
include("header.php");

$item_id = intval($_GET["item_id"]);
$sql = "SELECT title, rate, quantity, description FROM invoice_items WHERE item_id='$item_id';";
$query = mysqli_query($connection,$sql);
$row = mysqli_fetch_assoc($query);
$edit_title = $row['title'];
$edit_rate = $row['rate'];
$edit_quantity = $row['quantity'];
$edit_description = $row['description'];

$sql = "DELETE FROM invoice_items WHERE item_id='$item_id';";
    if(mysqli_query($connection,$sql)){
        include("invoice_preview.php");
    }
    else{
        die("Could not connect to database");
    }
    
include("input_invoice_items")

include("footer.php");
?>