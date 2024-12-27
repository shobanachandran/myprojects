<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

$action = 'areaadd';
	$breadcrumb = 'Add';
	$sucessMsg = 'Area Information Added Successfully';
	if(isset($colid)){
		$sucessMsg = 'Area Information Updated Successfully';
		$action = 'areaedit';
		$breadcrumb = 'Edit';
		$edtColQry = "SELECT * FROM area WHERE id='".$colid."'";
		$edtColResource = mysqli_query($zconn,$edtColQry);
		$colData = mysqli_fetch_array($edtColResource,MYSQLI_ASSOC);
		$colid = $colData['id'];
		$state_id = $colData['state_id'];
		$dist_id = $colData['dist_id'];
		$colname = $colData['area_name'];
		$status = $colData['status'];
	}
?><!DOCTYPE html>
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
    <title><?php echo SITE_TITLE;?> - Area add</title>
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
                        <h4 class="page-title">Area Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="area.php">Area Info</a></li>
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
			<form name="colInfo" id="colInfo" method="post" enctype="multipart/form-data" action="">

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
							</div>
								<div class="card-body" style="width:100%">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">State</label>
										<div class="col-sm-3">
                                        <select class="form-control" name="state_id" id="state_id" onchange="sel_dist(this.value);">
				<option value="">--Select--</option>
				<?php $sel_state = mysqli_query($zconn,"select * from states where status='Active'");
					while($res_state = mysqli_fetch_array($sel_state,MYSQLI_ASSOC)){
						if($state_id==$res_state['state_id']){
				?>
				<option selected='selected' value="<?php echo $res_state['state_id'];?>"><?php echo $res_state['state_name'];?></option>
				<?php } else {?>
				<option value="<?php echo $res_state['state_id'];?>"><?php echo $res_state['state_name'];?></option>
				<?php } ?>
				<?php } ?>
				</select>
										</div>
									</div><div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">District</label>
										<div class="col-sm-3">
										<span id="dist_list">
                                        <select class="form-control" name="dist_id" id="dist_id">
				<option value="">--Select--</option>
				<?php $sel_dist = mysqli_query($zconn,"select * from districts where status='Active' and state_id='".$state_id."'");
					while($res_dist = mysqli_fetch_array($sel_dist,MYSQLI_ASSOC)){
						if($dist_id==$res_dist['dist_id']){
				?>
				<option selected='selected' value="<?php echo $res_dist['dist_id'];?>"><?php echo $res_dist['dist_name'];?></option>
				<?php } else {?>
				<option value="<?php echo $res_dist['dist_id'];?>"><?php echo $res_dist['dist_name'];?></option>
				<?php } ?>
				<?php } ?>
				</select>
				</span>
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Area</label>
										<div class="col-sm-3">
                <input type="text" value="<?php echo $colname; ?>" class="form-control" tabindex="1" name="colname" id="colname" placeholder="Enter Area name">
										</div>
									</div>
									<div class="form-group row">
										<label for="email1" class="col-sm-3 text-right control-label col-form-label">Status</label>
										<div class="col-sm-6" style="margin-top:10px;">
					  <input type="radio" id="stat-act"  value="Active" <?php if(isset($status)){ if($status=='Active'){ ?> checked <?php } }else{ ?> checked <?php } ?>  name="status" class="flat-red" > Active
					  <input type="radio" id="stat-inact"  value="In active" <?php if($status=='In active'){ ?> checked <?php } ?> name="status" class="flat-red"> In Active
										</div>
									</div>
								</div>
									
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="area.php"><button type="button" class="btn btn-danger">Back</button></a>
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
	<script>
	$(function () {
		
		$("form#colInfo").submit(function(e) {
			$('.loader').show();
			e.preventDefault();    
			var formData = new FormData(this);
			if($('#colname').val()==''){
				alert("Please enter Area Name");
				$('#colname').focus();
				$('.loader').hide();
				return false;
			}
			$("#save").hide();
			$.ajax({
				url: "ajax/area.php",
				type: 'POST',
				data: formData,
				success: function (data) {
					if($.trim(data)=="exist"){
						alert("Area name Already Exist");
						$('.loader').hide();
					}
					if($.trim(data)==true){
						
						alert("<?php echo $sucessMsg; ?>");
						$('.loader').hide();
						window.location.href="arealist.php";
					}
					if($.trim(data)=="error"){
						alert("Process Failed Kindly. Try again");
						document.getElementById("colInfo").reset();
						$('.loader').hide();
					}
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});
	 });
	
	function sel_dist(st_id){
		$.ajax({
				url: "ajax/area.php?action=disp_dist&state_id="+st_id,
				type: 'POST',
				data: "action=disp_dist&state_id="+st_id,
				success: function (data) {
				//	alert(data);
					$("#dist_list").html(data);
				},
				cache: false,
				contentType: false,
				processData: false
			});
		
	}
	</script>
</body>
</html>