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
                                    <div class="text-center card-header"><h3 class="text-center font-weight-light my-4">Connect with New Company</h3>
                                        <ol class="text-center breadcrumb mb-4">
                                            <li class="breadcrumb-item active">Ask intended company for their company code</li>
                                        </ol>
                                        <div class="card-body">
                                        <form action="connect_confirm.php" method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input class="form-control" id="company_code" name="company_code" type="text" placeholder="Enter the company code" />
                                                        <label for="company_code">Company Code</label>
                                                        <div class="mt-4 mb-0">
                                                            <div class="d-grid">
                                                                    <input class="btn btn-primary btn-block" type="submit" value="Connect">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>  
                                        </form>
                                        </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="cust_dash.php">Back</a></div>
                                        </div>
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
