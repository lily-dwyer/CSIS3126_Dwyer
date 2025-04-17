<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$connection = mysqli_connect("localhost", "root", "root", "mybooks") or die("Unable to connect to database");

mysqli_query($connection, "DELETE FROM customers WHERE email = 'customer@email.com'");
mysqli_query($connection, "DELETE FROM companies WHERE email = 'company@email.com'");

require_once("register_manager.php");
require_once("login_manager.php");
require_once("connection_manager.php");
require_once("invoice_manager.php");
require_once("payment_manager.php");

$company_name = 'Test Script Co';
$first_name = 'Test';
$last_name = 'Script';
$comp_rm = new register_manager('company', 'company@email.com', '8888888888', 'password', '123 Street', 'City', 'State', '12617');
$cus_rm = new register_manager('customer', 'customer@email.com', '8888888888', 'password', '123 Street', 'City', 'State', '12617');

echo "Test 1: Create a new company account ";
if($comp_rm->insertion($connection, $company_name, null)){
    echo "Test 1: Passed " . "<br>";
}else{
    echo "Test 1: Failed" . "<br>";
    die();
}

echo "Test 2: Create a new customer account ";
if($cus_rm->insertion($connection, $first_name, $last_name)){
    echo "Test 2: Passed" . "<br>";
}else{
    echo "Test 2: Failed" . "<br>";
    die();
}

echo "Test 3: Can I create 2 accounts on one email? ";
if($cus_rm->insertion($connection, $first_name, $last_name)){
    echo "Test 3: Failed" . "<br>";
}else{
    echo "Test 3: Passed" . "<br>";
}

$comp_lm = new login_manager('company@email.com', 'password');
echo "Test 4: Company Login ";
$x = $comp_lm->login($connection);
if($x!=false){
    $test_comp_id = $x[1];
    echo "Test 4: Passed " . "<br>";
}else{
    echo "Test 4: Failed" . "<br>";
    die();
}

$cus_lm = new login_manager('customer@email.com', 'password');
echo "Test 5: Customer Login ";
$x = $cus_lm->login($connection);
if($x!=false){
    $test_cus_id = $x[1];
    echo "Test 5: Passed " . "<br>";
}else{
    echo "Test 5: Failed" . "<br>";
    die();
}

echo "Test 6: Connecting with new company ";
$cm = new connection_manager($test_comp_id);
$x=$cm->connect($connection, $test_comp_id, $test_cus_id);
if($x==1){
    echo "Test 6: Passed " . "<br>";
}
else{
    echo "Test 6: Failed" . "<br>";
}

echo "Test 7: Adding new invoices ";
$im = new invoice_manager($test_cus_id);
$test_invoice_id = $im->create_invoice($connection, $test_comp_id, $test_cus_id, '2025-12-31', 
    $im->get_invoice_num($connection, $test_cus_id, $test_comp_id));
$test_invoice_id=intval($test_invoice_id);
$test_titles = ['test item 1', 'test item 2'];
$test_rates = array(1, 2);
$test_quantities = array(1, 2);
$test_descs = ['test item 1 for test', 'test item 2 for test'];
if($im->add_items($connection, $test_invoice_id, $test_titles, $test_rates, $test_quantities, $test_descs)){
    echo "Test 7: Passed" . "<br>";
}else{
    echo "Test 7: Failed" . "<br>";
}

echo "Test 8: Input payments ";
$pm = new payment_manager($test_invoice_id, 5);
if($pm->pay($connection)){
    echo "Test 8: Passed " . "<br>";
}else{
    echo "Test 8: Failed" . "<br>";
}


?>