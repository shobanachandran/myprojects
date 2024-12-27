<?php 
include('includes/config.php');
$colid = $_GET['id'];
if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

	$action = 'buyeradd';
	$breadcrumb = 'Add';
	$sucessMsg = 'Buyer Information Added Successfully';
	if(isset($colid)){
		$sucessMsg = 'Buyer Information Updated Successfully';
		$action = 'buyeredit';
		$breadcrumb = 'Edit';
		$edtColQry = "SELECT * FROM buyer_master WHERE buyer_id='".$colid."'";
		$edtColResource = mysqli_query($zconn,$edtColQry);
		$colData = mysqli_fetch_array($edtColResource,MYSQLI_ASSOC);
		$colid = $colData['buyer_id'];
		$buyer_name = $colData['buyer_name'];
		$buyer_short_name = $colData['buyer_short_name'];
		$buyer_desc = $colData['buyer_desc'];
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
    <title><?php echo SITE_TITLE;?> - Party add</title>
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
                        <h4 class="page-title">Party Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Party Add</a></li>
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
				<form name="buyer_info" id="buyer_info" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
							</div>
								<div class="card-body" style="width:100%">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Party Name</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" id="buyer_name" required name="buyer_name" placeholder="Party Name" autocomplete="off" value="<?php echo $buyer_name;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Mobile Number</label>
										<div class="col-sm-3">
											<input type="text" class="form-control" id="short_name" required name="short_name" placeholder="Mobile Number" autocomplete="off"  value="<?php echo $buyer_short_name;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Address	</label>
										<div class="col-sm-3">
											<textarea required class="form-control" placeholder="Address" id="buyer_desc" name="buyer_desc" ><?php echo $buyer_desc;?></textarea>
										</div>
									</div>
								<!--	<div class="form-group row">
										<label for="email1" class="col-sm-3 text-right control-label col-form-label">Status</label>
										<div class="col-sm-6" style="margin-top:10px;">
					  <input type="radio" id="stat-act"  value="0" <?php if(isset($status)){ if($status=='0'){ ?> checked <?php } }else{ ?> checked <?php } ?>  name="status" class="flat-red" > Active
					  <input type="radio" id="stat-inact"  value="1" <?php if($status=='1'){ ?> checked <?php } ?> name="status" class="flat-red"> In Active
										</div>
									</div>-->
								</div>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="general_dc.php"><button type="button" class="btn btn-danger">Back</button></a>
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
		$("form#buyer_info").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: "ajax/buyer.php",
				type: 'POST',
				data: formData,
				success: function (data) {
				//	alert(data);
					if($.trim(data)=='1'){
						alert("<?php echo $sucessMsg; ?>");
						window.location.href="buyer.php";
					} 
					if($.trim(data)=='2'){
						alert("Buyer Name already exists!!");
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
	</script>
</body>
</html>