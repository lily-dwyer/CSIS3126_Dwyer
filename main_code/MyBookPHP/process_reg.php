<?php 

$G_NO_LOGIN=true;
include("global.php");
require_once("register_manager.php");

$rm = new register_manager(
    mysqli_real_escape_string($connection, $_POST["role"]),
    mysqli_real_escape_string($connection, $_POST["email"]),
    mysqli_real_escape_string($connection, $_POST["phone"]),
    mysqli_real_escape_string($connection, $_POST["pass"]),
    mysqli_real_escape_string($connection, $_POST["address"]),
    mysqli_real_escape_string($connection, $_POST["city"]),
    mysqli_real_escape_string($connection, $_POST["state"]),
    intval($_POST["zip"])
);


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
    $comp_name = mysqli_real_escape_string($connection, $_POST["comp_name"]);
    if($comp_name==''){
        $errormsg = $errormsg . "Company Name is required <br>";
        include("comp_name.php");
        die();
    }
}
else{
    $first_name = mysqli_real_escape_string($connection, $_POST['first_name']);
    $last_name = mysqli_real_escape_string($connection, $_POST['last_name']);
}

if($errormsg != ""){
    include("register.php");
    die();
}
if($rm->role=="company"){
    if($rm->insertion($connection, $comp_name, null)){
        header("Location: confirm_reg.php");
        exit();
    }else{
        $errormsg = $errormsg . "Database error, please try again later.<br>";
    }
}
else{
    if($rm->insertion($connection, $first_name, $last_name)){
        header("Location: confirm_reg.php");
        exit();
    }else{
        $errormsg = $errormsg . "Database error, please try again later.<br>";
    }
}

?>

