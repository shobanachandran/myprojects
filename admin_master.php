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
    <title><?php echo SITE_TITLE;?> - Admin Master</title>
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
        <aside class="left-sidebar" data-sidebarbg="skin5">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
               <?php include('includes/sidebar.php');?>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
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
                        <h4 class="page-title">Admin Master Dashboard</h4>
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
                                        <h4 class="card-title"><b>Admin Master Menu</b></h4>
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
                                 <!--    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-info text-center">
                                                <a href="user_type.php"><h1 class="font-light text-white"><i class="mdi mdi-account-multiple"></i></h1>
                                                <h6 class="text-white">User Type</h6></a>
                                            </div>
                                        </div>
                                    </div> -->
									<!-- Column 
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-secondary text-center">
                                                <a href="user_department.php"><h1 class="font-light text-white"><i class="mdi mdi-account-switch"></i></h1>
                                                <h6 class="text-white">User Department</h6></a>
                                            </div>
                                        </div>
                                    </div> -->
                                   <!-- <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover"> -->
                                            <!-- Modify the background color class below -->
                                          <!--  <div class="box bg-primary text-center">
                                                <a href="users.php"><h1 class="font-light text-white"><i class="mdi mdi-account-check"></i></h1>
                                                <h6 class="text-white">Users</h6></a>
                                            </div>
                                        </div>
                                        </div>-->

									<!-- Column -->
                                 <!--   <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-danger text-center">
                                                <a href="rights.php"><h1 class="font-light text-white"><i class="mdi mdi-account-key"></i></h1>
                                                <h6 class="text-white">User Rights </h6></a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- Column -->
                                    <!--<div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-success text-center">
                                                <a href="state.php"><h1 class="font-light text-white"><i class="mdi mdi-flag"></i></h1>
                                                <h6 class="text-white">State </h6></a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- Column -->
                                  <!--  <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-warning text-center">
                                                <a href="district.php"><h1 class="font-light text-white"><i class="mdi mdi-flag-checkered"></i></h1>
                                                <h6 class="text-white">District </h6></a>
                                            </div>
                                        </div>
                                    </div> -->
									<!-- Column -->
                                    <!--div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-warning text-center">
                                                <a href="area.php"><h1 class="font-light text-white"><i class="mdi mdi-flag-triangle"></i></h1>
                                                <h6 class="text-white">Area </h6></a>
                                            </div>
                                        </div>
                                    </div-->
                                    <!-- Column -->
                                    <!--div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-success text-center">
                                                <a href="buyer.php"><h1 class="font-light text-white"><i class="mdi mdi-shopping"></i></h1>
                                                <h6 class="text-white">Buyer </h6></a>
                                            </div>
                                        </div>
                                    </div-->
                                   
                                 
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-info text-center">
                                                <a href="fabric.php"><h1 class="font-light text-white"><i class="mdi mdi-snowflake"></i></h1>
                                                <h6 class="text-white">Fabric</h6></a>
                                            </div>
                                        </div>
                                    </div>
                                   
                                         <!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-danger text-center">
                                                <a href="colour.php"><h1 class="font-light text-white"><i class="mdi mdi-spotlight-beam"></i></h1>
                                                <h6 class="text-white">Colour </h6></a>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Column -->
                                     <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-success text-center">
                                                <a href="style.php"><h1 class="font-light text-white"><i class="mdi mdi-shopping"></i></h1>
                                                <h6 class="text-white">Style No</h6></a>
                                            </div>
                                        </div>
                                    </div>
                                     <!-- Column -->
                                     <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-warning text-center">
                                                <a href="nikno.php"><h1 class="font-light text-white"><i class="mdi mdi-shopping"></i></h1>
                                                <h6 class="text-white">NIK No</h6></a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Column -->
                                    <div class="col-md-6 col-lg-2 col-xlg-3">
                                        <div class="card card-hover">
                                            <div class="box bg-warning text-center">
                                                <a href="nikid.php"><h1 class="font-light text-white"><i class="mdi mdi-shopping"></i></h1>
                                                <h6 class="text-white">NIK ID</h6></a>
                                            </div>
                                        </div>
                                    </div>
                                   
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