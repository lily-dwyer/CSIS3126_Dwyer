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
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search for..." aria-describedby="btnNavbarSearch" />
                    <button class="btn btn-primary" id="btnNavbarSearch" type="button"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="#!">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="index.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Pages
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading">Addons</div>
                            <a class="nav-link" href="charts.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                                Charts
                            </a>
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as: <?php echo $first_name . " " . $last_name; ?></div>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
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