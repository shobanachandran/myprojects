<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if($_REQUEST['act']=='confirm_po'){
	$update_po = mysqli_query($zconn,"update fabric_po_master set status='Approved' where po_no='".$_REQUEST['id']."'");
	if($update_po){
		echo "<script>alert('PO Approved successfully!!');</script>";
		echo "<script>window.location.href='fabric_po_list.php';</script>";
	}
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
    <title><?php echo SITE_TITLE;?> - FABRIC PO APPROVAL</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
                        <h4 class="page-title">FABRIC PO APPROVAL</h4>
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
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead style="background-color: #626F80; color: #fff; font-size: 16px;">
											<tr>
												<th>S.No</th>
												<th>PO.NO</th>
												<th>DATE</th>
												<th>TO ADDRESS</th>
												<th>TOTAL WEIGHT</th>
												<th>RECEIVE WEIGHT</th>
												<th>STATUS</th>
												<!-- <th>ACTION</th> -->
												<th>ACTION</th>
											</tr>
										</thead>
										<tbody>
			<?php
			$costing_sql = mysqli_query($zconn,"select * from fabric_po_master");
			$c=1;
			while($res_costing = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){

			$style=$res_costing['style_no'];
 
					?>
					<tr id="delete_<?php echo $c;?>">
					   <td><?php echo $c;?></td>
					   <td><?php echo $res_costing['po_no'];?></td>
					   <td><?php echo $res_costing['po_date']; ?></td>
					   <td><?php echo $res_costing['to_address']; ?></td>
					   <td><?php echo '100'; ?></td>
					   <td><?php echo $res_costing['total_weight'];?></td>
					  <!--<td><?php echo $res_costing['status']; ?></td>-->
					   <td>
							<?php
								$pono = $res_costing['po_no'];
								$status=$res_costing['status'];
								if($status=='waiting'){
									echo '<a class="btn btn-outline-warning" href="javascript:;" onclick="approvea('.$pono.');">waiting for approval</a>';
								} else {
									echo '<button type="button" class="btn btn-success">Approved</button>';
								}
							?>
						</td>
					<td><a href="fabric_po_edit.php?id=<?php echo addslashes($res_costing['po_no']);?>"><i class="fas fa-edit"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="fabric_po_list.php?id=<?php echo $res_costing['po_no'];?>&name=<?="delete"?>"><i class="fas fa-trash"></i></a></td>
				</tr>
				<tr id="view_<?php echo $c;?>" style="background-color:#fff; display:none;">
					<td colspan="6">
						<table id="test" class="table table-striped table-bordered display">
							<tr>
								<th>S.NO</th>
								<th>FABRIC NAME</th>
								<th>STYLE NO</th>
								<th>ORDER NO</th>
							<!--<th>CONSUMPTION</th>
								<th>CUTTING QTY.</th>
								<th>RATE</th> -->
								<th>WEIGHT</th>
							</tr>
					<?php
					$sql_details = mysqli_query($zconn,"select * from fabric_po_details where po_id='".$res_costing['po_no']."'");
					$t=1;
					$tot_wgt=0;
					while($res_details = mysqli_fetch_array($sql_details,MYSQLI_ASSOC)){

					?>

					<tr>
						<td><?php echo $t;?></td>
						<td><?php echo $res_details['fabric_name'];?></td>
						<td><?php echo $res_details['styleno'];?></td>
						<td><?php echo $res_details['order_no'];?></td>
					<!--<td><?php echo $res_details['consumption'];?></td>
						<td><?php echo $res_details['cutting_qty'];?></td>
						<td><?php echo $res_details['rate'];?></td> -->
						<td><?php echo $res_details['weight'];$tot_wgt+=$res_details['weight'];?></td>
					</tr>
					<?php $t++;} ?>
					<tr>
						<td colspan="4">Total</td>
						<td><?php echo $tot_wgt;?></td>
					</tr>
				</table>
			</td>
			</tr>
			<?php $c++;} ?>

										</tbody>
									</table>
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
    <!--Wave Effects -->
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<!--datatables JavaScript -->
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
    <script>
	function approvea(po_id){
		window.location.href="fabric_po_list.php?act=confirm_po&id="+po_id;
	}

	$(document).ready(function() {
		$('#example').DataTable();
	});

	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
		$('#delete_'+ID).hide();
	  }
	}
	</script>

</body>
</html>