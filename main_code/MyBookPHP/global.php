<?php
session_start();

$connection = mysqli_connect("localhost", "root", "root", "mybooks") or die("Unable to connect to database");

if (intval(isset($_SESSION['customer_id']))){
    $G_NO_LOGIN=false;
    $user_id = $_SESSION['customer_id'];
    $first_name = $_SESSION['first_name'];
    $last_name = $_SESSION['last_name'];

}
else if (intval(isset($_SESSION['company_id']))) {
    $G_NO_LOGIN=false;
    $user_id = $_SESSION['company_id'];
    $company_name =  $_SESSION['company_name'];
    $company_code = $_SESSION['company_code'];
   
}
else if($G_NO_LOGIN!=true){
    header("Location: login.php");
    exit();
}

?>
