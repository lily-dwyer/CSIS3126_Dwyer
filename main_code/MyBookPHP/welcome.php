<?php
    include("global.php");
    include("header.php");
?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Welcome</h3>
                                        <p></p>
                                        <h6 class="text-center font-weight-light my-4">Register or sign in so we can do the hard part for you</h6></div>
                                
                                    <div class="card-body">
                                    <form action="process_reg.php" method="POST">

                                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="first_name" id="first_name" type="text" placeholder="Enter your first name" value="<?php echo $first_name;?>"/>
                                                        <label for="first_name">First name</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" name="last_name" id="last_name" type="text" placeholder="Enter your last name" value="<?php echo $last_name;?>"/>
                                                        <label for="inputLastName">Last name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" name="email" id="email" type="email" placeholder="name@example.com" value="<?php echo $email;?>"/>
                                                <label for="email">Email address</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" name="phone" id="phone" type="text" placeholder="Enter your phone number" value="<?php echo $phone;?>"/>
                                                    <label for="phone">Phone Number</label>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="password" id="password" type="password" placeholder="Create a password" value="<?php echo $password;?>" />
                                                        <label for="password">Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="pass_confirm" id="pass_confirm" type="password" placeholder="Confirm password" value="<?php echo $pass_confirm;?>"/>
                                                        <label for="pass_confirm">Confirm Password</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="address" id="address" type="text" placeholder="Enter your street address" value="<?php echo $address;?>"/>
                                                        <label for="address">Street Address</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="city" id="city" type="text" placeholder="Enter your city" value="<?php echo $city;?>"/>
                                                        <label for="city">City</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="state" id="state" type="text" placeholder="Enter your state" value="<?php echo $state;?>"/>
                                                        <label for="state">State</label>
                                                    </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" name="zip" id="zip" type="text" placeholder="Enter your zip code" value="<?php echo $zip;?>"/>
                                                        <label for="inputZip">Zip Code</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                <div class="col-xl-3 col-md-6">
                                                <div class="card mb-4">
                                                    <div class="card-body">Is this a customer or company account?</div>
                                                    <select class="dropdown card mb-4" name="cus_or_comp">
                                                        <option class="small" value="company">Company</option>
                                                        <option class="small" value="customer">Customer</option>
                                                    </select>

                                                </div>
                                                <input type="hidden" for="running" id="running" value="false">
                                            </div>
                                                </div>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid"><input type="submit"></div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
                                        <div class="small"><a href="about.php">Learn more in About Us</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
           <?php 
            include("footer.php");
            ?>