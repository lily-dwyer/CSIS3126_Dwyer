<?php  
include("global.php");
require_once("connection_manager.php");

$cm = new connection_manager(mysqli_real_escape_string($connection, $_POST["company_id"]));
$cm->connect($connection, $cm->new_company_id, $user_id);
?>
