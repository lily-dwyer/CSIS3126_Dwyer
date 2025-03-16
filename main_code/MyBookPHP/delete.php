<?php
include("global.php");
include("header.php");

$item_id = intval($_GET["item_id"]);
$invoice_num = mysqli_real_escape_string($connection, $_POST['invoice_num']);

if($item_id!=null){
    $sql = "DELETE FROM invoice_items WHERE item_id='$item_id';";
    if(mysqli_query($connection,$sql)){
        include("invoice_preview.php");
    }
    else{
        die("Could not connect to database");
    }
}

if($invoice_num!=null){
    $sql="SELECT invoice_id FROM invoices WHERE invoice_num=$invoice_num;";
    $query = mysqli_query($connection, $sql);
    $result=mysqli_fetch_assoc($query);
    $invoice_id = $result["invoice_id"];

    $sql="DELETE FROM Invoices WHERE invoice_id='$invoice_id';";
    if(mysqli_query($connection,$sql)){
        header(location: 'comp_dash.php');
        exit();
    }
    else{
        die("Could not connect to database");
    }
}

include("footer.php");
?>