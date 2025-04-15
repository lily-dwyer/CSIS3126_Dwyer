<?php  
$G_NO_LOGIN=true;

include("global.php");
require_once("login_manager.php");

unset($_SESSION['company_id']);
unset($_SESSION['customer_id']);
unset($_SESSION['user_id']);

$lm = new login_manager(mysqli_real_escape_string($connection, $_POST["email"]), mysqli_real_escape_string($connection, $_POST["pass"]));

$errormsg = "";

if($lm->email == ""){
    $errormsg = $errormsg . "Please enter your email address <br>";
}

if($lm->pass == ""){
    $errormsg = $errormsg . "Please enter your password <br>";
}

if($errormsg != ""){
    include("login.php");
    die();
}

$lm->login($connection, $lm->email, $lm->pass, $errormsg);

?>
