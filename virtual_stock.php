<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['name'])=='delete'){
    $id=$_REQUEST['id'];
    $party_dc=$_REQUEST['party_dc'];
    $delete=mysqli_query($zconn,"delete from fabric_dc_in where dc_no='$id' and party_dc='$party_dc'");
    $delete=mysqli_query($zconn,"delete from fabric_dcin_master where dc_no='$id' and party_dc='$party_dc'");

    if ($delete){
        echo '<script> alert("Record has been delete successfully deleted!")</script>';
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
    <title><?php echo SITE_TITLE;?> - VIRTUAL STOCK</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<style>
	th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
	</style>
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
			 <form method="post" name="frm_stock">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">VIRTUAL STOCK</h4>
						<div class="form-group row" style="width:700px;">
						<label for="fname" class="col-sm-4 text-right control-label col-form-label">&nbsp;Stock Type</label>
						<div class="col-sm-3">
						<select class="form-control" name="stock_type" id="stock_type" onchange="this.form.submit()" >
							<option value="">--Select--</option>
							<option value="Yarn" <?php if($_POST['stock_type']=='Yarn'){echo 'selected';}?>>Yarn</option>
							<option value="Fabric" <?php if($_POST['stock_type']=='Fabric'){echo 'selected';}?>>Fabric</option>
							<option value="Store" <?php if($_POST['stock_type']=='Store'){echo 'selected';}?>>Store</option>
						</select>

										</div>
										</div>
                    </div>
                </div>
				</form>
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
								<?php if($_POST['stock_type']=='Yarn'){?>
									<table id="example" class="table table-striped table-bordered text-center">
										<thead>
											<tr>
                                                <th style="width: 10%">S. NO</th>
                                                <th style="width: 15%">STYLE NO</th>
												<th style="width: 10%">YARN NAME</th>
												<th style="width: 20%">COUNT</th>
                                                <th style="width: 10%">COLOUR</th>
												<th style="width: 20%">CURRENT STOCK</th>
												<th style="width: 15%">RATE</th>
												<th style="width: 15%">AMOUNT</th>
											</tr>
										</thead>
									</table>
								<?php } else if($_POST['stock_type']=='Fabric'){ ?>
								<table id="example" class="table table-striped table-bordered text-center">
										<thead>
											<tr>
                                                <th style="width: 10%">S. NO</th>
												<th style="width: 10%">STYLE NO</th>
                                                <th style="width: 15%">FABRIC NAME</th>
                                                <th style="width: 15%">GSM</th>
												<th style="width: 10%">COLOUR</th>
												<th style="width: 20%">CURRENT STOCK</th>
                                                <th style="width: 10%">RATE</th>
												<th style="width: 15%">AMOUNT</th>
											</tr>
										</thead>
									</table>
								
								<?php } else if($_POST['stock_type']=='Store'){ ?>
								<table id="example" class="table table-striped table-bordered text-center">
										<thead>
											<tr>
                                                <th style="width: 10%">S. NO</th>
												<th style="width: 10%">STYLE NO</th>
                                                <th style="width: 15%">ACCESSORY NAME</th>
                                                <th style="width: 15%">CURRENT STOCK</th>
                                                <th style="width: 10%">RATE</th>
												<th style="width: 15%">AMOUNT</th>
											</tr>
										</thead>
									</table>
								<?php } ?>
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
	$(document).ready(function() {
    $('#example').DataTable();
	} );
	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
	  $('#delete_'+ID).hide();
	  }
	  }
	</script>	

</body>
</html>