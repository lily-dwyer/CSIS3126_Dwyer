<?php
$G_NO_LOGIN=true;
if(isset($_SESSION['company_id']) or isset($_SESSION['customer_id'])){
    session_unset();
    session_destroy();
}
include("global.php");
include("header.php");
if(isset($errormsg)){
    $display = true;
}
else{
    $display = false;
}
?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-5">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header">
                                        <h3 class="text-center font-weight-light my-4">
                                            Login</h3>
                                            <p style="color:Tomato;" class="text-center">
                                            <?php
                                                if($display==true){
                                                    echo $errormsg;
                                                }
                                            ?>
                                        </p>
                                        </div>
                                    <div class="card-body">
                                        <form action="process_login.php" method="POST">
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="email" type="text" name="email" />
                                                <label for="email">Email address</label>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input class="form-control" id="pass" type="password" name="pass" />
                                                <label for="pass">Password</label>
                                            </div>
                                            <div class="d-flex align-items-center justify-content-between mt-4 mb-0">
                                                <input class="btn btn-primary" type="submit" value="Login">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small">
                                            <a href="register.php">Need an account? Sign up!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
<?php
include("footer.php");
?>
