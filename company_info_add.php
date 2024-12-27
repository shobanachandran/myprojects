<?php 
include('includes/config.php');
extract($_REQUEST);
if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

$action = 'generaladd';
	$breadcrumb = 'Add';
	$sucessMsg = 'Company Information Added Successfully';
	if(isset($colid)){
		$sucessMsg = 'Company Information Updated Successfully';
		$action = 'generaledit';
		$breadcrumb = 'Edit';
		$edtColQry = "SELECT * FROM company_info WHERE id='".$colid."'";
		$edtColResource = mysqli_query($zconn,$edtColQry);
		$colData = mysqli_fetch_array($edtColResource,MYSQLI_ASSOC);
		$colid = $colData['id'];
		$company_name = $colData['company_name'];
		$company_unit = $colData['company_unit'];
		$com_phone = $colData['company_phone'];
		$com_email = $colData['company_email'];
		$com_address = $colData['company_address'];
		$com_gstn = $colData['company_GSTIN'];
		$com_pan =  $colData['company_pan'];
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
    <title><?php echo SITE_TITLE;?> - Company Details</title>
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
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Company Info Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="company_info.html">Company Info</a></li>
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
					<form name="colInfo" id="colInfo" method="post" enctype="multipart/form-data" action="">
                        <div class="card">
							<div class="card-body">
							</div>
							<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Company Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="company_name" name="company_name" placeholder="company name" value="<?php echo $company_name;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Unit / Office</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="unit_office" name="unit_office" placeholder="office name" value="<?php echo $company_unit;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="email1" class="col-sm-3 text-right control-label col-form-label">Email Id</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="email1" name="email1" value="<?php echo $com_email;?>" placeholder="mail id">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Address</label>
										<div class="col-sm-6">
											<textarea class="form-control" id="txtr_address" name="txtr_address"><?php echo $com_address;?></textarea>
										</div>
									</div>
								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="txt_phone" class="col-sm-3 text-right control-label col-form-label">Phone Number</label>
										<div class="col-sm-6">
											<input type="text" name="txt_phone" class="form-control" id="txt_phone" value="<?php echo $com_phone;?>" placeholder="mobile">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">GST No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="txt_gst" name="txt_gst" value="<?php echo $com_gstn;?>" placeholder="gst No">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Pancard No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="txt_pancard" value="<?php echo $com_pan;?>" name="txt_pancard" placeholder="pancard No">
										</div>
									</div>
								</div>
							</div>
							<div class="border-top">
								<div class="card-body" style="text-align: center;">
								 <input type="submit" class="btn btn-success" value="Submit">
								 <input type="reset" class="btn btn-primary" value="Reset" name="reset">
								 <a href="company_info.php"><button type="submit" class="btn btn-danger">Back</button></a>
								</div>
							</div>
                        </div>
							  <input type="hidden" name="action" id="action" value="<?php echo $action ?>" />
	  <?php if(isset($colid)){ ?>
		<input type="hidden" name="colid" id="colid" value="<?php echo $colid ?>" />
	  <?php  } ?>

						</form>
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
	<script>
	$(function () {
		
		$("form#colInfo").submit(function(e) {
		//	$('.loader').show();
			e.preventDefault();    
			var formData = new FormData(this);
			if($('#company_name').val()==''){
				alert("Please enter Colour Name");
				$('#company_name').focus();
				//$('.loader').hide();
				return false;
			}
			$.ajax({
				url: "ajax/general.php",
				type: 'POST',
				data: formData,
				success: function (data) {
					alert(data);
					if($.trim(data)==true){
						alert("<?php echo $sucessMsg; ?>");
						window.location.href='company_info.php';
					}
					if($.trim(data)=="error"){
						alert("Process Failed Kindly. Try again");
						document.getElementById("colInfo").reset();
					//	$('.loader').hide();
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