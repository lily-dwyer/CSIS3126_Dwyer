<?php  
include("global.php");
require_once("connection_manager.php");

$cm = new connection_manager(mysqli_real_escape_string($connection, $_POST["company_id"]));
$x = $cm->connect($connection, $cm->new_company_id, $user_id);
if($x==0){
    $errormsg = "Connection already established.";
    include("connect.php");
    die();
}elseif($x==1){
    header("Location: cust_dash.php");
    exit();
}else{
    $errormsg = "Could not connect. Please try again Later.";
    include("connect.php");
    die;
}
?>
