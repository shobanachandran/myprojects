<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Garments ERP">
    <meta name="author" content="Iorange Innovation">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>CLEVER ERP - Accounts Master</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">    
</head>

<body>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
 <?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dashboard</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-md-flex align-items-center">
                                    <div>
                                        <h4 class="card-title"><b>Accounts Master Menu</b></h4>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                <!-- Sales Cards  -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <!-- Column -->
                                    
                                    <!-- Column -->
									<!-- Column -->
                                   <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-danger text-center">
                                                <a href="cash.php"><h1 class="font-light text-white"><i class="mdi mdi-currency-inr"></i></h1>
                                                <h6 class="text-white">Cash Entries</h6></a>
                                            </div>
                                        </div>
                                    </div>
									<!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-primary text-center">
                                                <a href="expenses.php"><h1 class="font-light text-white"><i class="mdi mdi-credit-card-scan"></i></h1>
                                                <h6 class="text-white">Expenses</h6></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
									<!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-info text-center">
                                                <a href="banking.php"><h1 class="font-light text-white"><i class="mdi mdi-credit-card-multiple"></i></h1>
                                                <h6 class="text-white">Banking</h6></a>
                                            </div>
                                        </div>
                                    </div>
									<!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-warning text-center">
                                                <a href="gst.php"><h1 class="font-light text-white"><i class="mdi mdi-decimal-increase"></i></h1>
                                                <h6 class="text-white">GST</h6></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
									<!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-success text-center">
                                                <a href="investors.php"><h1 class="font-light text-white"><i class="mdi mdi-account-multiple-plus"></i></h1>
                                                <h6 class="text-white">Investors</h6></a>
                                            </div>
                                        </div>
                                    </div>
									<!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-cyan text-center">
                                                <a href="employees.php"><h1 class="font-light text-white"><i class="mdi mdi-account-switch"></i></h1>
                                                <h6 class="text-white">Employees</h6></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
									<!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-warning text-center">
                                                <a href="staffs.php"><h1 class="font-light text-white"><i class="mdi mdi-account-multiple-outline"></i></h1>
                                                <h6 class="text-white">Staffs</h6></a>
                                            </div>
                                        </div>
                                    </div>
									<!-- Column -->
                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-success text-center">
                                                <a href="employee_salary.php"><h1 class="font-light text-white"><i class="mdi mdi-account-switch"></i></h1>
                                                <h6 class="text-white">Employee Salary</h6></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                      <!-- Column -->
                                      <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-warning text-center">
                                                <a href="staffs_salary.php"><h1 class="font-light text-white"><i class="mdi mdi-account-switch"></i></h1>
                                                <h6 class="text-white">Staffs Salary</h6></a>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Column -->
                                </div>
                        </div>
                        </div>
                    </div>
                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
                <!-- ============================================================== -->
            </div>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
</body>
</html>