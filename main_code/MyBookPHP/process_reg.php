<?php 
$G_NO_LOGIN=true;
include("global.php");
function generate($connection){
    do{
    $company_code= rand(1000000, 9999999);
    $sql="SELECT company_id FROM companies WHERE company_code='$company_code';";
    $query=(mysqli_query($connection, $sql));
    }while(mysqli_num_rows($query)>0);
    
    return $company_code;
}
$role = mysqli_real_escape_string($connection, $_POST["role"]);
$email = mysqli_real_escape_string($connection, $_POST["email"]);
$phone = mysqli_real_escape_string($connection, $_POST["phone"]);
$pass = password_hash($_POST["pass"], PASSWORD_DEFAULT);
$address = mysqli_real_escape_string($connection, $_POST["address"]);
$city = mysqli_real_escape_string($connection, $_POST["city"]);
$state = mysqli_real_escape_string($connection,$_POST["state"]);
$zip = mysqli_real_escape_string($connection, $_POST["zip"]);

$errormsg = "";

if ($role=="company"){
    $comp_name = mysqli_real_escape_string($connection, $_POST["comp_name"]);
    if (empty($comp_name)) {
        $errormsg = $errormsg . "Company Name is required <br>";
        include("comp_name.php");
        die();
    }
    $sql="SELECT company_id, email FROM companies WHERE email='$email';";   
    $check_email = mysqli_query($connection, $sql);
    if (mysqli_num_rows($check_email) > 0) {
        $errormsg = $errormsg . "This email is already in use <br>";
    }
}

else{
    $first_name = mysqli_real_escape_string($connection,$_POST["first_name"]);
    $last_name = mysqli_real_escape_string($connection, $_POST["last_name"]);
    $sql="SELECT customer_id, email FROM customers WHERE email='$email';";   
    $check_email = mysqli_query($connection, $sql);
    if(mysqli_num_rows($check_email)>0){
        $errormsg = $errormsg . "This email is already in use <br>";
    }
}

if($errormsg != ""){
    include("register.php");
    die();
}

if($role=="company"){
    $company_code = generate($connection);
    $sql = "INSERT INTO Companies (Company_Name, Company_Code, Street_Address, 
    City, State, Zip, Email, Phone_Num, Password)
    VALUES ('$comp_name', '$company_code', '$address', '$city', '$state', '$zip', '$email', '$phone', '$pass');";
}
else{
    $sql = "INSERT INTO Customers (First_Name, Last_Name, Street_Address, 
    City, State, Zip, Email, Phone_Num, Password) 
    VALUES ('$first_name', '$last_name', '$address', '$city', '$state', '$zip', '$email', '$phone', '$pass');";
}

if(mysqli_query($connection,$sql)){
    header("Location: confirm_reg.php");
    exit();
}
else{
    $errormsg = $errormsg . "Database error, please try again later.<br>";
}
?>

