<?php
include("global.php");
include("header.php");

if (empty($_SESSION['customer_id'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}  

$invoice_id = intval($_GET["invoice_id"]);

$sql = "SELECT companies.company_id, companies.company_name, invoices.invoice_num FROM invoices
INNER JOIN companies ON companies.company_id=invoices.company_id
WHERE invoice_id='$invoice_id';";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);
$company_name = $row['company_name'];
$invoice_num = $row['invoice_num'];
$my_company_id = $row['company_id'];
?>
    <body >
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <!-- Navbar Brand-->
            <a class="navbar-brand ps-3" href="cust_dash.php"><?php echo $first_name . " " . $last_name; ?></a>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="small" id="logout" href="login.php" role="button">Logout<i class="fas fa-user fa-fw"></i></a>
                </li>
            </ul>
         
        </nav>
                <main>
                    <div class="container-fluid px-4">
                    <h1 class="mt-4">View Invoice Items</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active"><a href="cust_dash.php">Dashboard</a></li>
                        <li class="breadcrumb-item active">
                            <a href="view_comp.php?my_company_id=<?php echo urlencode($my_company_id); ?>">
                                <?php echo htmlspecialchars($company_name); ?>
                            </a>
                        </li>
                        <li class="breadcrumb-item active">Invoices Items</li>
                    </ol>
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-table me-1"></i>
        <h1>Invoice# <?php echo $invoice_num; ?> </h1>
    </div>
    <div class="card-body">
    <?php
    $sql = "SELECT invoices.invoice_num, invoice_items.title, invoice_items.rate, invoice_items.quantity, 
        ROUND((invoice_items.rate * invoice_items.quantity),2) AS total, invoice_items.description 
        FROM invoice_items 
        INNER JOIN invoices ON invoices.invoice_id=invoice_items.invoice_id
        WHERE invoices.invoice_id='$invoice_id';";
    $query = mysqli_query($connection, $sql);
    echo "<table border='1' width='80%' align='center' cellpadding='10' cellspacing='0'>";
    echo "<thead bgcolor='#007BFF' style='color: white; font-weight: bold;'>";
        echo"<tr>";
            echo"<th>Invoice Number</th>";
            echo"<th>Item Title</th>";
            echo"<th>Rate</th>";
            echo"<th>Quantity</th>";
            echo"<th>Item Total</th>";
            echo"<th>Description</th>";
            echo"<th></th>";
        echo"</tr>";
    echo"</thead>";
    echo"<tbody>";
    if(mysqli_num_rows($query) > 0){
        while($row = mysqli_fetch_assoc($query)){
            echo"<tr bgcolor='#f2f2f2'>";
            echo "<td>" . $row['invoice_num'] . "</td>";
            echo "<td>" . $row['title'] . "</td>";
            echo "<td>" . $row['rate'] . "</td>";
            echo "<td>" . $row['quantity'] . "</td>";
            echo "<td>" . $row['total'] . "</td>";
            echo "<td>" . $row['description'] . "</td>";
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