<?php
session_start();

$connection = mysqli_connect("localhost", "root", "root", "mybooks") or die("Unable to connect to database");

if (isset($_SESSION['customer_id'])){
    $G_NO_LOGIN!=false;
    $user_id = $_SESSION['customer_id'];
    $sql="SELECT first_name, last_name FROM customers WHERE customer_id='$user_id'";  
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($query);
    $first_name = $row['first_name'];
    $last_name = $row['last_name']; 
}
else if (isset($_SESSION['company_id'])) {
    $G_NO_LOGIN!=false;
    $user_id = $_SESSION['company_id'];
    $sql="SELECT company_name , company_code FROM companies WHERE company_id='$user_id'";  
    $query = mysqli_query($connection, $sql);
    $row = mysqli_fetch_assoc($query);
    $company_name = $row['company_name'];
    $company_code = $row['company_code'];
}
else if($G_NO_LOGIN!=true && $user_id=null){
    session_unset();
    session_destroy();
    header("Location: login.php");
    exit();
}

?>
