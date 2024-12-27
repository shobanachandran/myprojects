<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}



if (isset($_POST['submit'])) {
    // Capture form data
    $entryName = $_POST['entry_name'];
    $type = $_POST['type'];
    $status = $_POST['status'];

    // Connect to the database (assuming $zconn is the database connection)
    // Make sure to establish a database connection as per your configuration.

    // Construct the INSERT query
    $insertQuery = "INSERT INTO cash (entry_name, type, status) VALUES ('$entryName', '$type', '$status')";

    // Execute the INSERT query
    $result = mysqli_query($zconn, $insertQuery);

    if ($result) {
        // Insert was successful
        echo "Data inserted successfully.";
    } else {
        // Insert failed
        echo "Error: " . mysqli_error($zconn);
    }
}
?>
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
    <title><?php echo SITE_TITLE;?> - UOM add</title>
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
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Cash Entry Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="uom.php">Cash Entry Info</a>
									</li>
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
							</div>
							       <!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <!-- ... Your existing head content ... -->
</head>

<body>
    <div id="main-wrapper">
        <!-- ... Your existing content ... -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">
            <!-- ... Your existing content ... -->
            <!-- ============================================================== -->
            <!-- Sales chart -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <!-- ... Your existing content ... -->
                        <div class="card-body" style="width:100%">
                            <form method="post" action=""> <!-- Add the 'action' attribute with your PHP script's file name -->
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Entry Name</label>
                                    <div class="col-sm-3">
                                        <input type="text" name="entry_name" class="form-control" id="fname" placeholder="entry name">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="lname" class="col-sm-3 text-right control-label col-form-label">Type</label>
                                    <div class="col-sm-3">
                                        <select class="form-control" name="type">
                                            <option value="select">Select</option>
                                            <option value="Cash">Cash</option>
                                            <option value="Bank">Bank</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="email1" class="col-sm-3 text-right control-label col-form-label">Status</label>
                                    <div class="col-sm-6" style="margin-top:10px;">
                                        <input type="radio" id="stat-act" value="Active" checked name="status" class="form-group"> Active
                                        <input type="radio" id="stat-inact" value="Inactive" name="status" class="form-group"> Inactive
                                    </div>
                                </div>
                                <!-- ... Other form elements ... -->
                                <div class="border-top">
                                    <div class="card-body" style="margin-left: 250px;">
                                        <button type="submit" name="submit" class="btn btn-success">Save</button>
                                        <button type="reset" class="btn btn-primary">Reset</button>
                                        <a href="cash.php"><button type="button" class="btn btn-danger">Back</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales chart -->
        </div>
        <!-- End Container fluid  -->
    </div>
    <!-- End Wrapper -->
    <!-- ... Your existing content ... -->
</body>
</html>

                    </div>
                </div>
                <!-- Sales chart -->
                <!-- ============================================================== -->                
            </div>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
		 
    </div>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php');?>
            <!-- End footer -->
            <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
</body>
</html>