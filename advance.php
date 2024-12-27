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
    <title><?php echo SITE_TITLE;?> - Advance Entry</title>
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
                        <h4 class="page-title">Advance Details</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Order Info</a></li>
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
								<div class="btn-group">
									 <a class="dropdown-item" href="advance1.php" class="btn btn-success dropdown-toggle" style="background-color:green; color:#fff;">
									New Advance Entry</a>
								</div><!-- /btn-group -->
							</div>
								<div class="card-body" style="width:100%">
									<table  id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
											<tr>
												<th align="center">SNO</th>
												<th nowrap>ID</th>
												<th>STAFF</th>
												<th>ADVANCE AMOUNT</th>
											<!--	<th>COSTING NO</th>-->
												<th>ADVANCE DATE</th>
												<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
										<?php $sel_orders = mysqli_query($zconn,"select * from advance");
										$i=1;
										while($res_orders = mysqli_fetch_array($sel_orders,MYSQLI_ASSOC)){
										?>
											<tr>
												<td><?php echo $i;?></td>
												<td nowrap><?php echo $res_orders['sta_id'];?></td>
												<td><?php echo $res_orders['st_name'];?></td>
												<td><?php echo $res_orders['ad_amnt'];?></td>
										<!--		<td><?php //echo $res_orders['costing_no'];?></td>-->
												<td><?php echo $res_orders['doa'];?></td>
												<td><a href='advance1.php?order_id=<?php echo $res_orders['st_id']; ?>'><i class='fas fa-edit'></i></a>
												&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeletejwId("<?php echo $res_orders['st_id'] ?>");'>
												<i class='fas fa-window-close'></i></a></td>
											</tr>
									 <?php $i++; } ?>
										</tbody>
									</table>
							<!--	<div class="border-top">
									<div class="card-body" style="margin-left: 250px;">
										<button type="submit" class="btn btn-success">Save</button>
										<button type="submit" class="btn btn-primary">Reset</button>
										<a href="costing_report.php"><button type="submit" class="btn btn-danger">List</button></a>
									</div>
								</div>-->
							</div>
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
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
	</div>
		</div>
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
	 <script>
   $(document).ready(function() {
    $('#example').DataTable();
	} );
	function DeletejwId(ID){
	   var UsrStatus = confirm("Are you sure to delete this details ?");
	  if(UsrStatus){
		$.ajax({
			url : 'ajax/advan.php',
			data: {
			   action: 'buyerdelete',
			   typeid: ID
			},
			success: function( data ) {
				if($.trim(data)=="error"){
					alert("Deleted Failed Kindly. Try again");
				}
				if($.trim(data)=='1'){
					alert("Deleted Successfully");
					document.getElementById("delete_"+ID).style.display = "none";
				}
			},
			error: function (textStatus, errorThrown) {
				//DO NOTHINIG
			}
		});
	  }
	  }
    </script>
</body>
</html>