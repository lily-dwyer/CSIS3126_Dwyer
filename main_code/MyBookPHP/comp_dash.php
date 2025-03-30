<?php 
    include("global.php");
    include("header.php");
    if (empty($_SESSION['company_id'])) {
        session_unset(); 
        session_destroy(); 
        header("Location: login.php"); 
        exit();
    }  
?>
    <nav>
    <body>
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <p class="navbar-brand ps-3"><?php echo $company_name ?></p>
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
                        <h1 class="mt-4">Dashboard</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Share Company Code: <?php echo $company_code ?></li>
                        </ol>
                        <div class="row">
                                            <div class="col-xl-3 col-md-6">
                                                <div class="card bg-primary text-white mb-4">
                                                    <div class="card-body">View my Stats</div>
                                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                                        <a class="small text-white stretched-link" href="stats.php">View Details</a>
                                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Select Customer</div>
                        <div class="card-footer">
                            <form action="view_cust.php" method="POST" id="my_customer_id">
                                <div class="mb-3">
                                    <select name="my_customer_id" id="my_customer_id" class="form-select">
                                        <?php
                                        $sql = "SELECT customers.customer_id, customers.first_name, customers.last_name FROM customers 
                                                INNER JOIN relationships ON relationships.customer_id = customers.customer_id 
                                                INNER JOIN companies ON relationships.company_id = companies.company_id
                                                WHERE companies.company_id = $user_id;";

                                        $query = mysqli_query($connection, $sql);
                                        if (!$query) {
                                            die("Query failed: " . mysqli_error($connection));
                                        }

                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $my_customer_id = $row['customer_id'];
                                            $first_name = $row['first_name'];
                                            $last_name = $row['last_name'];
                                            echo "<option value='$my_customer_id'>" . $first_name . " " . $last_name . "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-light w-100">Continue</button>
                            </form>
                        </div>
                    </div>
                </div>

                        
                </main>
<?php 
    include("footer.php");
?>