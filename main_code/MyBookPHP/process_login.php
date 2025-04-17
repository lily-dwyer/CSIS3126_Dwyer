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

$x=$lm->login($connection);
if($x==true){
    if($x[0] == 'Customer'){
        $_SESSION['customer_id'] = $x[1];
        $_SESSION['first_name'] = $x[2];
        $_SESSION['last_name'] = $x[3];  
        header("Location: cust_dash.php");
        exit();  
    }elseif($x[0]=="Company"){
        $_SESSION['company_id'] = $x[1]; 
        $_SESSION['company_name'] = $x[2];
        $_SESSION['company_code'] = $x[3];
        header("Location: comp_dash.php");
        exit();  
    }
}else{
    $errormsg = $errormsg . 'Username or password incorrect';
    include("login.php");
    die();
}


?>
