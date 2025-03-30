<?php 
    include("global.php");
    include("header.php");

    if (empty($_SESSION['company_id'])) {
        session_unset(); 
        session_destroy(); 
        header("Location: login.php"); 
        exit();
    }  
    $my_customer_id = intval($_POST['my_customer_id'] ?? $_GET['my_customer_id']);
    $sql="SELECT first_name, last_name FROM customers WHERE customer_id='$my_customer_id';";
    $query=mysqli_query($connection,$sql);
    $row=mysqli_fetch_assoc($query);
    $first_name=$row['first_name'];
    $last_name=$row['last_name'];

?>

    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3"><?php echo $company_name?></a>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="small" id="logout" href="login.php" role="button">Logout<i class="fas fa-user fa-fw"></i></a>
                </li>
            </ul>
                </li>
            </ul>
        </nav>
        
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $first_name . " " . $last_name; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="comp_dash.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><?php echo $first_name . " " . $last_name; ?></li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">View Paid</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <form action="comp_view_paid.php" method="POST">
                                <input type="hidden" name="my_customer_id" value=<?php echo $my_customer_id; ?>>
                                <input type="submit" value="View" class="btn btn-primary text-white">
                                <i class="fas fa-angle-right"></i>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">View Unpaid</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <form action="comp_view_unpaid.php" method="POST">
                                <input type="hidden" name="my_customer_id" value=<?php echo $my_customer_id; ?>>
                                <input type="submit" value="View" class="btn btn-primary text-white">
                                <i class="fas fa-angle-right"></i>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">New Invoice</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <form action="input_invoice.php" method="POST">
                                <input type="hidden" name="my_customer_id" value=<?php echo $my_customer_id; ?>>
                                <input type="submit" value="Input New" class="btn btn-primary text-white">
                                <i class="fas fa-angle-right"></i>
                            </form>
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