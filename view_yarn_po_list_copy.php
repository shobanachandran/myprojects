<?php 
include('includes/config.php');
include('includes/base_functions.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['name'])=='delete'){
	$id=$_REQUEST['id'];
	$delete=mysqli_query($zconn,"delete from yarns_po_details where po_id='$id'");
	$delete=mysqli_query($zconn,"delete from yarns_po_master where id='$id'");

	if ($delete){
		echo '<script> alert("Record has been delete successfully deleted!")</script>';
	}
	
}


//print_r($_REQUEST);
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
    <title><?php echo SITE_TITLE;?> - Yarn Po List </title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
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
                        <h4 class="page-title">Yarn Po List</h4>
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
				<form name="costing_list" id="costing_list" method="post">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body" >
								<div class="table-responsive" style="overflow:hidden;">
									<div class="row" style="float:right;">
									<div class="col-sm-12" style="float:right;" >
									<a  href="yarn_po.php"><button type="button" 
												class="btn btn-success">Add</button></a></div>
									</div> 
									</div>
									</div>

						<table id="example" class="table table-striped table-bordered display">
						<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;" >

											<tr>
												<th>S.No</th>
												<th>PO.NO</th>
												<th>TOTAL WEIGHT</th>
												<th>DATE</th>
												<th>Action</th>
											</tr>
									</thead>
									<tbody>
	<?php
			$costing_sql = mysqli_query($zconn,"select * from yarns_po_master where id='".$_GET['id']."' order by id desc");
			$c=1;
			 while($res_costing = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){

			// $style=$res_costing['style_no'];
 
			//   $buyer_sql = mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$style."'"));

			//  $costing_date = date_from_db($res_costing['costing_date']);
			?>
            
			<!-- <tr id="delete_<?php echo $c;?>"> -->
				<!-- <td><?php echo $c;?></td>
				<td><?php echo $res_costing['id'];?></td>
				<td><?php echo $res_costing['grant_total'];?></td>
				<td><?php echo $res_costing['date'];?></td>
				<td><a href="yarn_po_edit.php?id=<?php echo addslashes($res_costing['id']);?>">
				<i class="fas fa-edit"></i></a>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript:;" onclick="$('#view_<?php echo $c;?>').slideToggle();">
				<i class="fas fa-eye"></i></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="javascript:;" onclick="costing_sheet(<?php echo $c; ?>);"><i class="fa fa-print"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<a href="yarn_po_list.php?id=<?php echo $res_costing['id'];?>&name=<?="delete"?>"><i class="fas fa-trash"></i></a> -->
								 

			</td>
			</tr>
<!-- 
			<tr id="view_<?php echo $c;?>" style="background-color:#fff; display:none;"> -->
            <?php 	$id = $_GET['id']; ?>
				<td colspan="6">
				<table id="example" class="table table-striped table-bordered display">
					<tr>
												<th>S.NO</th>
												<th>STYLE NO</th>
												<th>ORDER NO</th>
												<th>COUNT</th>
												<!-- <th>CONSUMPTION</th> -->
												 <th>CUTTING QTY.</th> 
												<th>RATE</th>
												<th>WEIGHT</th>
					</tr>
					<?php
					$sql_details = mysqli_query($zconn,"select * from yarns_po_details where po_id='".$_GET['id']."'");
					$t=1;
					$tot_wgt=0;
					while($res_details = mysqli_fetch_array($sql_details,MYSQLI_ASSOC)){

					?>

					<tr>
						<td><?php echo $t;?></td>
						<td><?php echo $res_details['styleno'];?></td>
						<td><?php echo $res_details['order_no'];?></td>
						<td><?php echo $res_details['counts'];?></td>
						<!-- <td><?php echo $res_details['consumption'];?></td> -->
						 <td><?php echo $res_details['cutting_qty'];?></td>
						<td><?php echo $res_details['rate'];?></td>
						<td><?php echo $res_details['weight'];$tot_wgt+=$res_details['weight'];?></td>
						
					</tr>
					<?php 
                    $t++;
                } ?>
					<tr>
						<td colspan="6">Total</td>
						<td><?php echo $tot_wgt;?></td>
					</tr>
					</table>
			
			<!-- </tr>  -->
			<?php 
            // $c++;
            } ?>
					</tbody>
				</table>
			</div>
			</form>
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
	<!--datatables JavaScript -->
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
  		<script>
		function costing_sheet(order_no){
			 window.open("yarn_po_print.php?id="+order_no, "PO Order ", "width=800,height=700");
		}
	</script>
	<script>
		$(document).ready(function() {
			//$('#example').DataTable();
			$('.display').DataTable();
		});
	</script>

</body>
</html>