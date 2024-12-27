<?php
include('includes/config.php');
	extract($_REQUEST);
	if($_SESSION['userid']==''){
		echo "<script>window.location.href='login.php';</script>";
	}

	$action = 'contractoradd';
	$breadcrumb = 'Add';
	$sucessMsg = 'Information Added Successfully';
	if(isset($colid)){
		// print '<pre>';
		// print $colid;
		// print '<pre>';
		$sucessMsg = 'Information Updated Successfully';
		$action = 'contractoredit';
		$breadcrumb = 'Edit';
		$edtColQry = "SELECT * FROM contractors WHERE con_id='".$colid."'";
		
		$edtColResource = mysqli_query($zconn,$edtColQry);
		$colData = mysqli_fetch_array($edtColResource,MYSQLI_ASSOC);
		extract($colData);
		
		$colid = $colData['con_id'];
		
		$con_join_arr = explode("-",$doj);
		$con_join_date = $con_join_arr['2']."-".$con_join_arr['1']."-".$con_join_arr['0'];
		$status = $colData['status'];
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
    <title><?php echo SITE_TITLE;?> - Contractor add</title>
    <!-- Custom CSS -->
    <link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
       <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Contractor Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="contractor.php">Contractor Info</a></li>
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
                <!-- Sales chart -->
			<form name="con_info" id="con_info" method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
							</div>
								<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
									<div class="form-group row">
										<label for="fname" class="col-sm-4 text-right control-label col-form-label">Contractor Code</label>
									<?php
										if($colid==''){
$sel_code = mysqli_fetch_array(mysqli_query($zconn,"select max(con_id) as SID from contractors"),MYSQLI_ASSOC);
										$scode = $sel_code['SID'];
										if($scode=='' || $scode==NULL){
											$scode_disp='1000';
										} else {
											$scode_disp = $scode+1;
										}
										$con_code = CON_CODE.$scode_disp;
										} else {
											$con_code = $colData['con_code'];
										}
										?>
										<div class="col-sm-6">
											<input type="text" class="form-control" readonly name="con_code"  id="con_code" placeholder="Contractor code" value="<?php echo $con_code;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-4 text-right control-label col-form-label">Contractor Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" name="con_name" id="con_name" placeholder="Contractor name" autocomplete="off" value="<?php echo $con_name;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-4 text-right control-label col-form-label">Mobile No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="con_mobile" name="con_mobile" placeholder="Contractor Number" autocomplete="off" value="<?php echo $con_number;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-4 text-right control-label col-form-label">Join Date</label>
										<div class="col-sm-6">
    <input type="text" class="form-control" name="doj" id="costing_date" autocomplete="off" 
    value="<?php echo date('Y-m-d'); ?>">
</div>

									</div>
		

<div class="form-group row">
    <label class="col-sm-4 text-right control-label col-form-label">Bill</label>
    <div class="col-sm-6" style="margin-top:10px;">
        <label class="radio-inline">
            <input type="radio" name="bill_status"   id="delivered" value="<?php echo 'delivered';?>">
            Delivered
        </label>
        
            <input type="radio" name="bill_status"  id="received" value="<?php echo 'received';?>">
            Received
        
    </div>
</div>


								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="fname" class="col-sm-4 text-right control-label col-form-label">Department</label>
										<div class="col-sm-6">
											<select name="dept_id" id="dept_id" class="select2 form-control custom-select" > 
											<option value="">--Select--</option>
								<?php $sel_dept = mysqli_query($zconn,"select * from department_master where status='0'");
								while($res_dept = mysqli_fetch_array($sel_dept,MYSQLI_ASSOC)){
								if($dept_id==$res_dept['dept_id']){
								?>
								<option selected="selected" value="<?php echo $res_dept['dept_id'];?>"><?php echo $res_dept['dept_name'];?></option>
								<?php } else { ?>
								<option value="<?php echo $res_dept['dept_id'];?>"><?php echo $res_dept['dept_name'];?></option>
								<?php } } ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-4 text-right control-label col-form-label">Address	</label>
										<div class="col-sm-6">
											<textarea class="form-control" placeholder="description" id="con_address" name="con_address" ><?php echo $con_address;?></textarea>
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-4 text-right control-label col-form-label">Upload Photo</label>
										<div class="col-sm-6">
											<input type="file" class="form-control" id="con_photo" name="con_photo">
										
										<img align="middle" src="uploads/contractors/<?php echo $con_photo;?>" width="100" height="100">
									</div></div>
									<div class="form-group row">
										<label for="email1" class="col-sm-4 text-right control-label col-form-label">Status</label>
								<div class="col-sm-6" style="margin-top:10px;">
								<input type="radio" id="stat-act"  value="0" <?php if(isset($status)){ if($status=='0'){ ?> checked <?php } }else{ ?> checked <?php } ?>  name="status" class="flat-red" > Active
								<input type="radio" id="stat-inact"  value="1" <?php if($status=='1'){ ?> checked <?php } ?> name="status" class="flat-red"> In Active
							</div>
					</div>
				</div>
							</div>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="contractor.php"><button type="button" class="btn btn-danger">Back</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
				<input type="hidden" name="action" id="action" value="<?php echo $action ?>" />
	  <?php if(isset($colid)){ ?>
		<input type="hidden" name="colid" id="colid" value="<?php echo $colid ?>" />
	  <?php  } ?>
				</form>
                <!-- Sales chart -->
            </div>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->
            <!-- footer -->
            <?php include('includes/footer.php');?>
            <!-- End footer -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
	<script src="dist/js/bootstrap-datepicker.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<script>
	$(function () {
		$("form#con_info").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: "ajax/contractors.php",
				type: 'POST',
				data: formData,
				success: function (data) {
				//alert(data);
					if($.trim(data)=='1'){
						alert("<?php echo $sucessMsg; ?>");
						window.location.href="contractor.php";
					} 
					if($.trim(data)=='2'){
						alert("Contractor Name already exists!!");
					} 
					if($.trim(data)=='0'){
						alert("Query Failed");
					}
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});
	 });
	 $('#costing_date').datepicker({
	format:'dd-mm-yyyy',
      autoclose: true
    })
	 </script>
</body>
</html>