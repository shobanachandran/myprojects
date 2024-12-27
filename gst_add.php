<?php 
include('includes/config.php');
extract($_REQUEST);
if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}
$action = 'gstadd';
	$breadcrumb = 'Add';
	$sucessMsg = 'GST Added Successfully';
	if(isset($typeid)){
		$sucessMsg = 'GST Updated Successfully';
		$action = 'gstedit';
		$breadcrumb = 'Edit';
		$edtUsrQry = "SELECT * FROM gst WHERE gst_id='".$typeid."'";
		$edtUsrResource = mysqli_query($zconn,$edtUsrQry);
		$usertypeData = mysqli_fetch_array($edtUsrResource,MYSQLI_ASSOC);
		$typeid = $usertypeData['gst_id'];
		$gst_name = $usertypeData['gst_name'];
		$gst_value = $usertypeData['gst_value'];
		$status = $usertypeData['status'];
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
    <title><?php echo SITE_TITLE;?> - - GST add<</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
		<?php include("includes/header.php");?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php include("includes/sidebar.php");?>
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
                        <h4 class="page-title">User Type Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="gst.php">GST Info</a></li>
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
						<form name="usertypeInfo" id="usertypeInfo" method="post" enctype="multipart/form-data" action="">
                        <div class="card">
							<div class="card-body">
							</div>
								<div class="card-body" style="width:100%">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">GST Name</label>
										<div class="col-sm-3">
                <input type="text" value="<?php echo $gst_name; ?>" class="form-control" tabindex="1" name="gst_name" id="gst_name" placeholder="GST Name">
										</div>
									</div>
                                    
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">GST Value</label>
										<div class="col-sm-3">
               <input type="text" name="gst_value"  class="form-control" tabindex="2" id="gst_value" placeholder="GST Value" value="<?php echo $gst_value; ?>">
										</div>
									</div>
                                 
                                    
									<div class="form-group row">
										<label class="col-sm-3 text-right control-label col-form-label">Status</label>
					<div>
					<label>
					  <input type="radio" id="stat-act"  value="Active" <?php if(isset($status)){ if($status=='Active'){ ?> checked <?php } }else{ ?> checked <?php } ?>  name="status" class="flat-red" > Active
					</label>
					<label>
					  <input type="radio" id="stat-inact"  value="In active" <?php if($status=='In active'){ ?> checked <?php } ?> name="status" class="flat-red"> In Active
					</label>
				 </div>
									</div>
								</div>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<input type="submit" class="btn btn-success" value="Save">
									<input type="reset" class="btn btn-primary" value="Reset">
									<a href="user_type.php"><input type="button" class="btn btn-danger" value="Back"></a>
								</div>
							</div>
                        </div>
						<input type="hidden" name="action" id="action" value="<?php echo $action ?>" />
	  <?php if(isset($typeid)){ ?>
		<input type="hidden" name="typeid" id="typeid" value="<?php echo $typeid ?>" />
	  <?php  } ?>
						</form>
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
            <?php include("includes/footer.php");?>
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
		$("form#usertypeInfo").submit(function(e) {
			//$('.loader').show();
			e.preventDefault();    
			var formData = new FormData(this);
			if($('#gst_name').val()==''){
				alert("Please enter GST Name");
				$('#gst_name').focus();
				//$('.loader').hide();
				return false;
			}
		//	$("#save").hide();
			$.ajax({
				url: "ajax/gst_curd.php",
				type: 'POST',
				data: formData,
				success: function (data) {
					//alert(data);
					if($.trim(data)=="exist"){
						//alert("User Type name Already Exist");
						//$('.loader').hide();
					}
					if($.trim(data)==true){
						alert("<?php echo $sucessMsg; ?>");
						<?php if(!isset($typeid)){ ?>
						document.getElementById("usertypeInfo").reset();
					   <?php } ?>
						//$('.loader').hide();
						window.location.href='gst.php';
					}
					if($.trim(data)=="error"){
						alert("Process Failed Kindly. Try again");
						document.getElementById("usertypeInfo").reset();
						//$('.loader').hide();
					}
				},
				cache: false,
				contentType: false,
				processData: false
			});
		});
	 });
</script>
</body>
</html>