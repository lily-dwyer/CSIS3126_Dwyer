<?php
include('global.php');
include('header.php');

if (empty($_SESSION['customer_id'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}  

$my_company_id = intval($_POST["my_company_id"]);
$sql = "SELECT company_name FROM Companies WHERE company_id='$my_company_id';";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);
$company_name = $row['company_name'];
?>
<body >
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
         <!-- Not displaying for some reason: revisit-->
        <p class='navbar-brand ps-3'><?php echo $first_name . " " . $last_name; ?></p>
        <!-- Navbar-->
        <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="small" id="logout" href="login.php" role="button">Logout<i class="fas fa-user fa-fw"></i></a>
                </li>
        </ul>
    </nav>

            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Unpaid Invoices</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="cust_dash.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">
                            <a href="view_comp.php?my_company_id=<?php echo urlencode($my_company_id); ?>">
                                <?php echo htmlspecialchars($company_name); ?>
                            </a>
                        </li>
                    </ol>

                    <div class="card mb-4">
                        <div class="card-body">
                            <?php
                            $sql = "SELECT invoices.invoice_num, invoices.invoice_id,
                                invoices.charge_date, 
                                SUM(invoice_items.rate * invoice_items.quantity) AS total_cost, 
                                (SUM(invoice_items.rate * invoice_items.quantity) - COALESCE(SUM(payments.amount), 0)) AS balance_due, 
                                invoices.due_date
                                FROM invoices
                                INNER JOIN invoice_items ON invoices.invoice_id = invoice_items.invoice_id
                                LEFT JOIN payments ON invoices.invoice_id = payments.invoice_id
                                WHERE invoices.customer_id = '$user_id'
                                AND invoices.company_id = '$my_company_id'
                                GROUP BY invoices.invoice_num, invoices.charge_date, invoices.due_date, invoices.invoice_id
                                HAVING balance_due > 0;";
                            $query = mysqli_query($connection, $sql);
                            echo "<table border='1' width='80%' align='center' cellpadding='10' cellspacing='0'>";
                            echo "<thead bgcolor='#007BFF' style='color: white; font-weight: bold;'>";
                                echo"<tr>";
                                    echo"<th>Invoice Number</th>";
                                    echo"<th>Date Charged</th>";
                                    echo"<th>Total Cost</th>";
                                    echo"<th>Balance Due</th>";
                                    echo"<th>Due Date</th>";
                                    echo"<th></th>";
                                echo"</tr>";
                            echo"</thead>";
                            echo"<tbody>";
                            if(mysqli_num_rows($query) > 0){
                                while($row = mysqli_fetch_assoc($query)){
                                    echo"<tr bgcolor='#f2f2f2'>";
                                    echo "<td>" . $row['invoice_num'] . "</td>";
                                    echo "<td>" . $row['charge_date'] . "</td>";
                                    echo "<td>" . $row['total_cost'] . "</td>";
                                    echo "<td>" . $row['balance_due'] . "</td>";
                                    echo "<td>" . $row['due_date'] . "</td>";
                                    echo "<td><a href='cust_view_invoice_items.php?invoice_id=" . urlencode($row['invoice_id']) . "'>View Items</a></td>";
                                    echo"</tr>";
                                }
                            }
                            else{
                                echo "<tr><td colspan='4'>No Stats Available</td></tr>";
                            }
                            echo"</table>";
                            ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

<?php
include("footer.php");
?>
