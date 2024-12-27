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
    <title><?php echo SITE_TITLE;?> - YARN - DC PROGRAM CHANGE</title>
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
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">YARN - DC PROGRAM CHANGE</h4>
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
										<div class="col-sm-6" style="float:left; left: 50px;">
											<div class="form-group row">
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">From</label>
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
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">DC No</label>
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
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Process</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
													<option>process</option>
													<option>kniting</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6" style="float:left; right: 50px">
											<div class="form-group row">
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">To Company</label>
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
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">To Process</label>
												<div class="col-sm-6">
													<input type="date" autocomplete="off" required class="form-control" id="costing_date" name="costing_date" value="<?php echo $cost_date;?>" >
												</div>
											</div>
										</div>
									</div>
								</div>
								<br><br>
								<div class="table-responsive">
									<div class="col-12 d-flex no-block align-items-center">
										<h4 class="page-title">OUTPUT</h4>
									</div>
									<table id="example" class="table table-striped table-bordered text-center">
										<thead>
											<tr>
												<th style="width: 2%">S.NO</th>
												<th style="width: 10%">STYLE NO</th>
												<th style="width: 10%">FABRIC NAME</th>
												<th style="width: 4%">DIA</th>
												<th style="width: 4%">GSM</th>
												<th style="width: 4%">COLOUR</th>
												<th style="width: 6%">ROLL</th>
												<th style="width: 6%" data-toggle="tooltip" title="Delivered Weight">DEL. WGT</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sectBrnQry = "SELECT * FROM company_info ORDER BY id";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
											?>
											<tr>
												<td style="width: 2%">01</td>
												<td style="width: 10%">QQQ</td>
												<td style="width: 10%">QQQ</td>
												<td style="width: 4%">12</td>
												<td style="width: 4%">12</td>
												<td style="width: 4%">12</td>
												<td style="width: 6%"><div class="col-sm-12">
														<input type="text" class="form-control" id="" name="" autocomplete="off" required placeholder="style no" value="0">
													</div>
												</td>
												<td style="width: 6%"><div class="col-sm-12">
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
								<BR><BR>
								<div class="table-responsive">
									<div class="col-12 d-flex no-block align-items-center">
										<h4 class="page-title">PROGRAM</h4>
									</div>
									<table id="example" class="table table-striped table-bordered text-center">
										<thead>
											<tr>
												<th style="width: 2%">S.NO</th>
												<th style="width: 10%">STYLE NO</th>
												<th style="width: 10%">FABRIC NAME</th>
												<th style="width: 4%">DIA</th>
												<th style="width: 4%">GSM</th>
												<th style="width: 4%">COLOUR</th>
												<th style="width: 4%">QTY</th>
												<th style="width: 4%">PRICE</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$sectBrnQry = "SELECT * FROM company_info ORDER BY id";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
											?>
											<tr>
												<td style="width: 2%">01</td>
												<td style="width: 10%">
													<div class="col-sm-12">
														<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
														<option>Select</option>
														<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
														while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
														<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
														<?php } ?>
														</select>
													</div>
												</td>
												<td style="width: 10%">
													<div class="col-sm-12">
														<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
														<option>Select</option>
														<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
														while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
														<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
														<?php } ?>
														</select>
													</div>
												</td>
												<td style="width: 4%">
													<div class="col-sm-12">
														<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
														<option>Select</option>
														<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
														while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
														<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
														<?php } ?>
														</select>
													</div>
												</td>
												<td style="width: 4%">
													<div class="col-sm-12">
														<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
														<option>Select</option>
														<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
														while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
														<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
														<?php } ?>
														</select>
													</div>
												</td>
												<td style="width: 4%">
													<div class="col-sm-12">
														<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
														<option>Select</option>
														<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
														while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
														<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
														<?php } ?>
														</select>
													</div>
												</td>
												
												<td style="width: 6%"><div class="col-sm-12">
														<input type="text" class="form-control" id="" name="" autocomplete="off" required placeholder="style no" value="0">
													</div>
												</td>
												<td style="width: 6%"><div class="col-sm-12">
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
								<div class="card" style="width:100%">
									<div class="border-top">
										<div class="card-body" style="margin-left: 400px;">
											<button type="submit" name="save_costing" class="btn btn-success" value="<?php echo $action;?>">Save</button>
											<button type="reset" class="btn btn-primary">Reset</button>
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