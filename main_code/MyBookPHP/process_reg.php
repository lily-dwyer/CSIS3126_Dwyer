<?php 
$G_NO_LOGIN=true;
include("global.php");
require_once("register_manager.php");

$rm = new register_manager((mysqli_real_escape_string($connection, $_POST["role"])), (mysqli_real_escape_string($connection, $_POST["email"])),
(mysqli_real_escape_string($connection, $_POST["phone"])), (password_hash($_POST["pass"], PASSWORD_DEFAULT)),
(mysqli_real_escape_string($connection, $_POST["address"])), (mysqli_real_escape_string($connection, $_POST["city"])), 
(mysqli_real_escape_string($connection,$_POST["state"])),(intval($_POST["zip"])));

$errormsg = "";

$sql="SELECT company_id FROM companies WHERE email='" . $rm->email . "';";   
$check_email = mysqli_query($connection, $sql);
if (mysqli_num_rows($check_email) > 0){
    $errormsg = $errormsg . "This email is already in use <br>";
}  

$sql2="SELECT customer_id, email FROM customers WHERE email='" . $rm->email . "';";   
$check_email2 = mysqli_query($connection, $sql2);
if(mysqli_num_rows($check_email2)>0){
     $errormsg = $errormsg . "This email is already in use <br>";
}
    
if ($rm->role=="company"){
    $comp_name = $rm->get_comp_name($connection, $errormsg);
}
else{
    $cus = $rm->get_cus_name($connection);
    $first_name = $cus["first_name"];
    $last_name = $cus["last_name"];
}

if($errormsg != ""){
    include("register.php");
    die();
}
if($rm->role=="company"){
    $rm->insertion($connection, $comp_name, null, $errormsg);
}
else{
    $rm->insertion($connection, $first_name, $last_name, $errormsg);
}

?>

