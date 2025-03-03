<?php 

error_reporting(E_ALL);
ini_set('display_errors', 1);
print_r($_POST);
die(); 


include("global.php");
if(isset($_POST["id"])){
    $id = intval($_POST["id"]);
}
else{
    $id = 0;
}
$first_name = mysqli_real_escape_string($connection,$_POST["first_name"]);
$last_name = mysqli_real_escape_string($connection, $_POST["last_name"]);
$email = mysqli_real_escape_string($connection, $_POST["email"]);
$phone = mysqli_real_escape_string($connection, $_POST["phone"]);
$password = password_hash($_POST["password"], PASSWORD_DEFAULT);
$pass_confirm = password_hash($_POST["pass_confirm"], PASSWORD_DEFAULT);
$address = mysqli_real_escape_string($connection, $_POST["address"]);
$city = mysqli_real_escape_string($connection, $_POST["city"]);
$state = mysqli_real_escape_string($connection,$_POST["state"]);
$zip = mysqli_real_escape_string($connection, $_POST["zip"]);
$comp_name = mysqli_real_escape_string($connection, $_POST["comp_name"]);
$running = mysqli_real_escape_string($connection, $_POST["running"]);
$cus_or_comp = mysqli_real_escape_string($connection, $_POST["cus_or_comp"]);

$errormsg = "";
if($running==false){
    if($first_name == ""){
        $errormsg = $errormsg . "First name required <br>";
    }
    if($last_name == ""){
        $errormsg = $errormsg . "Last name required <br>";
    }
    if($email == ""){
        $errormsg = $errormsg . "Email required <br>";
    }
    if($phone == ""){
        $errormsg = $errormsg . "Phone number required <br>";
    }
    if($password == ""){
        $errormsg = $errormsg . "Password required <br>";
    }
    if($pass_confirm != $password){
        $errormsg = $errormsg . "Passwords do not match <br>";
    }
    if($address == ""){
        $errormsg = $errormsg . "Street address required <br>";
    }
    if($city == ""){
        $errormsg = $errormsg . "City required <br>";
    }
    if($state == ""){
        $errormsg = $errormsg . "State required <br>";
    }
    if($zip == ""){
        $errormsg = $errormsg . "Zip required <br>";
    }
    if($cus_or_comp == ""){
        $errormsg = $errormsg . "Selection required <br>";
    }
    if($errormsg != ""){
        echo $errormsg;
        include("welcome.php");
        die();
    }
    if($cus_or_comp=="company"){
        include("comp_name.php");
        die();
    }
}
else{
    if($cus_or_comp == ""){
        $errormsg = $errormsg . "Company Name is required <br>";
    }
    if($errormsg != ""){
        echo $errormsg;
        include("comp_name.php");
        die();
    }
}

    if($id != 0){
        if($cus_or_comp=="company")
        {
            $sql = "UPDATE Companies SET Company_Name = '$comp_name', 
            Street_Address='$address', City = '$city', State = '$state',
            Zip='$zip', Email = '$email', Phone_Num = '$phone', Password = '$password'
            WHERE Company_ID = $id";
        }
        else{
            $sql = "UPDATE Customers SET First_Name = '$first_name', 
            Last_Name='$last_name', Street_Address = '$address', City = '$city', State = '$state',
            Zip='$zip', Email = '$email', Phone_Num = '$phone', Password = '$password'
            WHERE Customer_ID = $id";
        }
    }
    else{
        if($cus_or_comp=="company")
        {
            $sql = "INSERT INTO Companies (Company_Name, Company_Code, Street_Address, 
            City, State, Zip, Email, Phone_Num, Password) 
            VALUES ('$comp_name', 'ZZZZZZZ', '$address', '$city', '$state', '$zip', '$email', '$phone', '$password')";
        }
        else{
            $sql = "INSERT INTO Customers (First_Name, Last_Name, Street_Address, 
            City, State, Zip, Email, Phone_Num, Password) 
            VALUES ('$first_name', '$last_name', '$address', '$city', '$state', '$zip', '$email', '$phone', '$password')";
        }
    }

    if(mysqli_query($connection,$sql)){
        header("Location: login.php");
    }
    else{
        die("Could not connect to database");
    }
?>

