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
	<title><?php echo SITE_TITLE;?> - Accessories Inward</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="" href="assets/images/favicon.png">
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
        <!-- Page wrapper-->
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
           <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">STORE RECEIVED
</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Accessories Inward</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
           <!-- ============================================================== -->
           <!-- ============================================================== -->
            <!-- container-fluid  -->
			<div class="container-fluid">
                <!-- Sales chart -->
                <div class="row">
                    <div class="col-md-12">
					
					<table id="example" class="table table-striped table-bordered">
						<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
							<tr>
								<th>S.No</th>
								<th>Order No</th>
								<th>Style No</th>
								<th>Name</th>
								<th>Total Qty</th>
								<th>Already received</th>
								<th>Balance</th>
								<th>Qty</th>
							</tr>
							</thead>
							<tbody>
								<tr id="delete_<?php echo $process_id;?>">
									<td><?php echo $sgl;?></td>
									<td><?php echo $process_name;?></td>
									<td><?php echo $sizes;?> </td>
									<td><?php echo $supp_status;?></td>
									<td><?php echo $supp_status;?></td>
									<td><?php echo $supp_status;?></td>
									<td><?php echo $supp_status;?></td>
									<td><a href='process_group_add.php?colid=<?php echo $process_id; ?>'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteSgId("<?php echo $process_id; ?>");'><i class='fas fa-window-close'></i></a></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>
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
<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"> </script>
<script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
<script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
<script src="dist/js/sidebarmenu.js"></script>
</body>
</html>