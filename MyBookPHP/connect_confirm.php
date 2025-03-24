<?php 
    include("global.php");
    include("header.php");

    $company_code = mysqli_real_escape_string($connection, $_POST["company_code"]);
    $sql = "SELECT company_id, company_name FROM companies WHERE company_code='$company_code' LIMIT 1;";
    $query=mysqli_query($connection, $sql);
    if(mysqli_num_rows($query)==0){
        echo "Invalid Company Code";
        include("connect.php");
        die();
    }

    $row = mysqli_fetch_assoc($query);
    $company_name = $row['company_name'];
    $company_id=$row['company_id'];
?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="text-center card-header"><h3 class="text-center font-weight-light my-4">You intend to connect with <?php echo $company_name; ?></h3>
                                        <ol class="text-center breadcrumb mb-4">
                                            <li class="text-center breadcrumb-item active" >Is this correct?</li>
                                        </ol>
                                    <div class="card-body">
                                        <form action="process_connect.php" method="POST">
                                                <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <input type="hidden" name="company_id" value="<?php echo $company_id; ?>">
                                                    <input class="btn btn-primary btn-block" type="submit" value="Proceed"></div>
                                                </div>
                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        <div class="small"><a href="connect.php">Back</a></div>
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
