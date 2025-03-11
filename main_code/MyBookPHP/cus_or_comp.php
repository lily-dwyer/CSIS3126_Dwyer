<?php 
    include("global.php");
    include("header.php");

$first_name = mysqli_real_escape_string($connection,$_POST["first_name"]);
$last_name = mysqli_real_escape_string($connection, $_POST["last_name"]);
$email = mysqli_real_escape_string($connection, $_POST["email"]);
$phone = mysqli_real_escape_string($connection, $_POST["phone"]);
$pass = mysqli_real_escape_string($connection, $_POST["pass"]);
$pass_confirm = mysqli_real_escape_string($connection, $_POST["pass_confirm"]);
$address = mysqli_real_escape_string($connection, $_POST["address"]);
$city = mysqli_real_escape_string($connection, $_POST["city"]);
$state = mysqli_real_escape_string($connection,$_POST["state"]);
$zip = mysqli_real_escape_string($connection, $_POST["zip"]);

$errormsg = "";

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
if($pass == ""){
    $errormsg = $errormsg . "Password required <br>";
}
else if ($pass_confirm != $pass){
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
    
if($errormsg != ""){
    echo $errormsg;
    include("register.php");
    die();
}

?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Are you a Customer or a Company?</h3></div>
                                    <div class="card-body">
                                        <form action="process_reg.php" method="POST">      
                                            <div class="mt-4 mb-0">
                                                <input type="hidden" name="first_name" value="<?php echo $first_name; ?>">
                                                <input type="hidden" name="last_name" value="<?php echo $last_name; ?>">
                                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                                                <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                                                <input type="hidden" name="pass" value="<?php echo $pass; ?>">
                                                <input type="hidden" name="address" value="<?php echo $address; ?>">
                                                <input type="hidden" name="city" value="<?php echo $city; ?>">
                                                <input type="hidden" name="state" value="<?php echo $state; ?>">
                                                <input type="hidden" name="zip" value="<?php echo $zip; ?>">
                                                <div class="d-grid">
                                                    <input type="submit" class="btn btn-primary btn-block" name="role" id="role" value="Customer">
                                                </div>
                                            </div>
                                        </form>
                                    
                                        <form action="comp_name.php" method="POST"> 
                                            <div class="mt-4 mb-0">     
                                                <input type="hidden" name="email" value="<?php echo $email; ?>">
                                                <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                                                <input type="hidden" name="pass" value="<?php echo $pass; ?>">
                                                <input type="hidden" name="address" value="<?php echo $address; ?>">
                                                <input type="hidden" name="city" value="<?php echo $city; ?>">
                                                <input type="hidden" name="state" value="<?php echo $state; ?>">
                                                <input type="hidden" name="zip" value="<?php echo $zip; ?>">
                                                <div class="d-grid">
                                                    <input type="submit" class="btn btn-primary btn-block" name="role" id="role" value="Company">
                                                </div>
                                            </div>      
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
            <div id="layoutAuthentication_footer">
                <footer class="py-4 bg-light mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-between small">
                              
<?php
include("footer.php");
?>