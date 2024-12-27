<?php 
include('includes/config.php');
extract($_REQUEST);
if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

	$action = 'supplieradd';
	$breadcrumb = 'Add';
	$sucessMsg = 'Supplier Information Added Successfully';
	if(isset($colid)){
		$sucessMsg = 'Supplier Information Updated Successfully';
		$action = 'supplieredit';
		$breadcrumb = 'Edit';
		$edtColQry = "SELECT * FROM suppliers WHERE supplier_id='".$colid."'";
		$edtColResource = mysqli_query($zconn,$edtColQry);
		$colData = mysqli_fetch_array($edtColResource,MYSQLI_ASSOC);
		$colid = $colData['supplier_id'];
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
    <title><?php echo SITE_TITLE;?> - Accessories Entry</title>
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
                        <h4 class="page-title">Accessories Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="supplier.php">Users Info</a></li>
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
			<form name="supplier_info" id="supplier_info" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
									<div class="form-group row">
										<label for="scode" class="col-sm-3 text-right control-label col-form-label">Po Number</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="scode"  name="scode" value="<?php echo $supplier_code;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">To Address</label>
										<div class="col-sm-6">
                                        <input type="text" class="form-control" id="scode"  name="scode" value="<?php echo $supplier_code;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Yarn Po Date</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" required id="sname" name="sname" placeholder="Supplier name" value="<?php echo $colData['supplier_name'];?>" autocomplete="off">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">SGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" required name="txt_add1" id="txt_add1" autocomplete="off" value="<?php echo $colData['supplier_address1'];?>" placeholder="Address">
										</div>
									</div>


								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Received Date</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" autocomplete="off" id="smobile" value="<?php echo $colData['supplier_mobile'];?>" name="smobile" placeholder="mobile">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Comments</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" autocomplete="off" id="sphone" value="<?php echo $colData['supplier_phone'];?>" name="sphone" placeholder="Telephone">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">CGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="semail" name="semail" autocomplete="off" value="<?php echo $colData['supplier_email'];?>" placeholder="email">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">IGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" autocomplete="off" name="span_card" value="<?php echo $colData['supplier_pancard'];?>" id="span_card" placeholder="Pancard">
										</div>
									</div>

								</div>
							</div>
							<div class="border-top">
								<div class="card-body" style="text-align: center;">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="accessories_po.php"><button type="button" class="btn btn-danger">Back</button></a>
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
        </div>
        <!-- End Page wrapper  -->
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
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<script>
	$(function () {
		$("form#supplier_info").submit(function(e) {
			e.preventDefault();
			var formData = new FormData(this);

			$.ajax({
				url: "ajax/suppliers.php",
				type: 'POST',
				data: formData,
				success: function (data) {
				//alert(data);
					if($.trim(data)=='1'){
						alert("<?php echo $sucessMsg; ?>");
						window.location.href="supplier.php";
					} 
					if($.trim(data)=='2'){
						alert("Supplier Name already exists!!");
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
	 
	 function sel_dist(st_id){
		$.ajax({
				url: "ajax/area.php?action=display_dist&state_id="+st_id,
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
	
	
	function disp_area(dist_id){
		//alert(dist_id);
		$.ajax({
				url: "ajax/area.php?action=disp_area&dist_id="+dist_id,
				type: 'POST',
				data: "action=disp_area&dist_id="+dist_id,
				success: function (data) {
				//	alert(data);
					$("#area_list").html(data);
				},
				cache: false,
				contentType: false,
				processData: false
			});
	}
	</script>
</body>
</html>