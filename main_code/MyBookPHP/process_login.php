<?php  
$G_NO_LOGIN=true;
include("global.php");

$email = mysqli_real_escape_string($connection, $_POST["email"]);
$pass = mysqli_real_escape_string($connection, $_POST["pass"]);
unset($_SESSION['company_id']);
unset($_SESSION['customer_id']);
unset($_SESSION['user_id']);
$errormsg = "";

if($email == ""){
    $errormsg = $errormsg . "Please enter your email address <br>";
}

if($pass == ""){
    $errormsg = $errormsg . "Please enter your password <br>";
}

if($errormsg != ""){
    echo $errormsg;
    include("login.php");
    die();
}


$sql="SELECT customer_id, email, password FROM customers WHERE email='$email'";   
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);
if(mysqli_num_rows($query)>0){
    if(password_verify($pass, $row['password'])){
        $_SESSION['customer_id'] = $row['customer_id']; 
        header("Location: cust_dash.php");
        exit();   
    }
}

$sql2="SELECT company_id, email, password FROM companies WHERE email='$email'";   
$query2 = mysqli_query($connection, $sql2);
$row2 = mysqli_fetch_assoc($query2);
if(mysqli_num_rows($query2)>0){
    if(password_verify($pass, $row2['password'])){
        $_SESSION['company_id'] = $row2['company_id']; 
        header("Location: comp_dash.php");
        exit();   
    }
}


$errormsg = $errormsg . 'Username or password incorrect';
echo $errormsg;
include("login.php");
die();

?>
