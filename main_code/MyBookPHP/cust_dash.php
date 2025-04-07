<?php 
    include("global.php");
    include("header.php");

    if (empty($_SESSION['customer_id'])) {
        session_unset(); 
        session_destroy(); 
        header("Location: login.php"); 
        exit();
    }  
?>
<main>
    <div class="container-fluid px-4">
    <h1 class="mt-4">Dashboard</h1>
        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card bg-primary text-white mb-4">
                    <div class="card-body">Connect with Company</div>
                        <div class="card-footer d-flex align-items-center justify-content-between">
                            <a class="small text-white stretched-link" href="connect.php">Add New</a>
                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                    </div>
                </div>
            </div>
        <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">
                        <div class="card-body">Select Company</div>
                        <div class="card-footer">
                            <form action="view_comp.php" method="POST" id="my_company_id">
                                <div class="mb-3">
                                    <select name="my_company_id" id="my_company_id" class="form-select">
                                        <?php
                                        $sql = "SELECT companies.company_id, companies.company_name FROM companies 
                                                INNER JOIN relationships ON relationships.company_id = companies.company_id 
                                                INNER JOIN customers ON relationships.customer_id = customers.customer_id
                                                WHERE customers.customer_id = $user_id;";

                                        $query = mysqli_query($connection, $sql);
                                        if (!$query) {
                                            die("Query failed: " . mysqli_error($connection));
                                        }

                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $my_company_id = $row['company_id'];
                                            $company_name = $row['company_name'];
                                            echo "<option value='$my_company_id'>$company_name</option>";
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
