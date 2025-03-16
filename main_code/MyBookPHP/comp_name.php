<?php 
    $G_NO_LOGIN=true;
    include("global.php");
    include("header.php");
   
$email = mysqli_real_escape_string($connection, $_POST["email"]);
$phone = mysqli_real_escape_string($connection, $_POST["phone"]);
$pass = mysqli_real_escape_string($connection, $_POST["pass"]);
$address = mysqli_real_escape_string($connection, $_POST["address"]);
$city = mysqli_real_escape_string($connection, $_POST["city"]);
$state = mysqli_real_escape_string($connection,$_POST["state"]);
$zip = mysqli_real_escape_string($connection, $_POST["zip"]);
$role = "company";
?>
 <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">What is your Company Name</h3>
                                        <p></p>
                                
                                    <div class="card-body">
                                    <form action="process_reg.php" method="POST">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input type="hidden" name="phone" value="<?php echo $phone; ?>">
                                                    <input type="hidden" name="email" value="<?php echo $email; ?>">
                                                    <input type="hidden" name="pass" value="<?php echo $pass; ?>">
                                                    <input type="hidden" name="address" value="<?php echo $address; ?>">
                                                    <input type="hidden" name="city" value="<?php echo $city; ?>">
                                                    <input type="hidden" name="state" value="<?php echo $state; ?>">
                                                    <input type="hidden" name="zip" value="<?php echo $zip; ?>">
                                                    <input type="hidden" name="role" value="<?php echo $role; ?>">
                                                    <input class="form-control" name="comp_name" id="comp_name" type="text"/>
                                                    <label for="comp_name">Company Name</label>
                                                    <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                        <input type="submit" value="Create Account">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    </div>
                                </div>
</div>



<?php 
    include("footer.php");
?>