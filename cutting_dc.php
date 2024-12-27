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
    <title><?php echo SITE_TITLE;?> - CUTTING DC</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
</head>

<body>
<div id="main-wrapper" data-sidebartype="mini-sidebar" class="mini-sidebar">

    <!-- <div id="main-wrapper"> -->
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
                        <h4 class="page-title">FABRIC GUDOWN OUTWARD</h4>
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
								<div class="row">
									<div class="col-sm-12" >
										<div class="col-sm-6" style="float:left;">
											<div class="form-group row">			
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Style No</label>
												<div class="col-sm-6">
							<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
									<option>Select</option>
											<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
													<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
													<?php } ?>
													</select>
												</div>
												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Send To</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
													<option>Select</option>
														<option value="to_production">To Production</option>
														<option value="to_stock">To Stock</option>
														<option value="direct_dc">Direct DC</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6" style="float:left;">
											<div class="form-group row">
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Date</label>
												<div class="col-sm-6">
													<input type="date" autocomplete="off" required class="form-control" id="costing_date" name="costing_date" value="<?php echo $cost_date;?>" >
												</div>
												
												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Contractor Name</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
													<option>Select</option>
													<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
													<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
													<?php } ?>
													</select>
													<br>
													<a href="supplier.php"><button type="button" class="btn btn-info">New Contractor Add</button></a>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br><br>
								<div class="table-responsive" style="overflow-x:auto;">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead style="background-color: #626F80; color: #fff; font-size: 16px;">
											<tr>
												<th></th>
												<th>STYLE NO</th>
												<th>FABRIC<br>COLOUR<br>DIA<br>GSM</th>
												<th>PCS WEIGHT</th>
												<th>WEIGHT</th>
												<th>IN ROLL</th>
												<th>RECEIVED</th>
												<th>IN STOCK</th>
												<th>DELIVERED</th>
												<th>ROLLS</th>
												<th>SENT KGS</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sectBrnQry = "SELECT * FROM company_info ORDER BY id";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
											?>
											<tr>
												<td><input type="checkbox" name="" id=""></td>
												<td>123</td>
												<td>123</td>
												<td>FABRIC<!--<br>COLOUR<br>DIA<br>GSM--></td>
												<td>123</td>
												<td>123</td>
												<td>123</td>
												<td>123</td>
												<td>123</td>
												<td><div class="col-sm-12">
														<input type="text" class="form-control" id="" name="" autocomplete="off" required placeholder="style no" value="0">
													</div>
												</td>
												<td><div class="col-sm-12">
														<input type="text" class="form-control" id="" name="" autocomplete="off" required placeholder="style no" value="0">
													</div>
												</td>
											</tr>
											<?php
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
                        </div>
                    </div>
                </div>				
				<div class="card" style="width:100%">
					<div class="border-top">
						<div class="card-body" style="margin-left: 450px;">
							<button type="submit" name="save_costing" class="btn btn-success" value="<?php echo $action;?>">Save</button>
							<button type="reset" class="btn btn-primary">Reset</button>
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