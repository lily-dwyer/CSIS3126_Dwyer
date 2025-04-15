<?php 
    $G_NO_LOGIN=true;
    include("global.php");
    include("header.php");
    if(isset($errormsg)){
        $display = true;
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Create Account</h3></div>
                                    <div class="card-body">
                                        <p style="color:Tomato;" class="text-center">
                                            <?php
                                                if($display==true){
                                                    echo $errormsg;
                                                }
                                            ?>
                                        </p>
                                        <form action="cus_or_comp.php" method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input class="form-control" id="first_name" type="text" name="first_name"/>
                                                        <label for="first_name">First name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="last_name" type="text" name="last_name"/>
                                                    <label for="last_name">Last name</label>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" type="email" name="email"/>
                                                <label for="email">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="phone" type="text" name ="phone" />
                                                <label for="phone">Phone Number</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="pass" type="password" name="pass"/>
                                                    <label for="pass">Password</label>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating">
                                                    <input class="form-control" id="pass_confirm" type="password" name="pass_confirm"/>
                                                    <label for="pass_confirm">Confirm Password</label>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="address" type="text" name="address" />
                                                <label for="address">Street Address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="city" type="text" name="city" />
                                                <label for="city">City</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="state" type="text" name="state" />
                                                <label for="state">State</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="zip" type="number" name="zip" minlength=5 maxlength=5/>
                                                <label for="zip">Zip Code</label>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <input type="submit" class="btn btn-primary btn-block" value="Continue">
                                            </div>
                                        </div>
                                        <div class="card-footer text-center py-3">
                                        <div class="small"><a href="login.php">Have an account? Go to login</a></div>
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