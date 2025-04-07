<?php
include("global.php");
include("header.php");

if (empty($_SESSION['customer_id'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}  

$my_company_id = intval($_POST['my_company_id'] ?? $_GET['my_company_id']);
$sql="SELECT company_name FROM companies WHERE company_id='$my_company_id';";
$query=mysqli_query($connection,$sql);
$row=mysqli_fetch_assoc($query);
$company_name=$row['company_name'];
?> 
    <main>
        <div class="container-fluid px-4">
            <h1 class="mt-4"><?php echo $company_name; ?></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item"><a href="cust_dash.php">Dashboard</a></li>
                <li class="breadcrumb-item active"><?php echo $company_name; ?></li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">View Paid</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <form action="cust_view_paid.php" method="POST">
                                <input type="hidden" name="my_company_id" value="<?php echo $my_company_id; ?>">
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
                            <form action="cust_view_unpaid.php" method="POST">
                                <input type="hidden" name="my_company_id" value="<?php echo $my_company_id; ?>">
                                <input type="submit" value="View" class="btn btn-primary text-white">
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