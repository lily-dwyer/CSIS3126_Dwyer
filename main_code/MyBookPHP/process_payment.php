<?php 
include("global.php");

$invoice_id = intval($_POST["invoice_id"]);
$amount = intval($_POST["amount"]);


$sql="INSERT INTO Payments (Invoice_ID, Amount, Date_Paid) VALUES ('$invoice_id', '$amount', NOW());";
    if(mysqli_query($connection, $sql)){
        header("Location: comp_dash.php");
        exit();
    }
    else{
        echo "Could not connect to database";
        include("payment.php");
        die();
    }
?>