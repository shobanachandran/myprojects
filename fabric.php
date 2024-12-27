<?php 
include('includes/config.php');
include('includes/functions.php');

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
	<title>
		<?php echo SITE_TITLE;?> - Fabric details
	</title>
	<!-- Custom CSS -->
	<link href="assets/libs/flot/css/float-chart.css" rel="stylesheet">
	<!--  datatables CSS -->
	<link href="dist/css/bootstrap.css" rel="stylesheet">
	<link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
						<h4 class="page-title">Fabric Components </h4>&nbsp;&nbsp;&nbsp;&nbsp;
						<a href="admin_master.php"> <button type="button" class="btn btn-info">Admin
								Master</button></a>
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
								<!-- accoridan part -->
								<div class="accordion" id="accordionExample">
									<div class="card m-b-0">
										<div class="card-header" id="headingOne">
											<h5 class="mb-0">
												<a href="javascript:;" data-toggle="collapse" data-target="#collapseOne"
													aria-expanded="true" aria-controls="collapseOne">
													<i class="m-r-5 fa fa-magnet" aria-hidden="true"></i>
													<span>Fabric Name</span>
												</a>
											</h5>
										</div>
										<div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
											data-parent="#accordionExample">
											<form id="fabric_department" method="post">
												<div class="card-body"
													style="width:80%; padding-left:20px; margin:10px;  border:1px solid #20A8D8; border-radius:10px; display:none;"
													id="fabric_div">
													<div class="row">
														<input type="hidden" name="fabric_id" id="fabric_id">
														<div class="col-md-4">
															<div class="form-group">
																<label for="cono1"
																	class="control-label col-form-label">Fabric
																	Name</label>
																<input type="text" class="form-control"
																	name="fabric_name" id="fabric_name"
																	placeholder="Fabric Name" required>
															</div>
														</div>
														<div class="col-md-4" style="margin-top:40px;">
															<div class="form-group">
																<button type="button" class="btn btn-success"
																	onclick="save_dept1();">Save</button>
																<button type="reset" class="btn btn-primary"
																	onclick="div_pop1('fabric');">Cancel</button>
															</div>
														</div>
													</div>
												</div>
											</form>

											<div class="card-body">
												<div class="table-responsive">
													<div style="float:right;"><a href="javascript:;"
															onclick="div_pop1('fabric');"><button type="button"
																class="btn btn-success">Add</button></a></div>
													<div id="infoMsg1"
														style="font-size:10px; color:red; font-weight:bold; text-align:center;">
													</div>
													<div id="fab_list">
														<?php echo fabric_dept();?>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="card m-b-0 border-top">
										<div class="card-header" id="headingTwo">
											<h5 class="mb-0">
												<a href="javascript:;" class="collapsed" data-toggle="collapse"
													data-target="#collapseTwo" aria-expanded="false"
													aria-controls="collapseTwo">
													<i class="m-r-5 fa fa-magnet" aria-hidden="true"></i>
													<span>Colour</span>
												</a>
											</h5>
										</div>
										<div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
											data-parent="#accordionExample">
											<form id="color_department">
												<div class="card-body"
													style="width:80%; padding-left:20px; margin:10px;  border:1px solid #20A8D8; border-radius:10px; display:none;"
													id="color_div">
													<div class="row">
														<input type="hidden" name="color_id" id="color_id">
														<div class="col-md-4">
															<div class="form-group">
																<label for="cono1"
																	class="control-label col-form-label">Colour
																	Name</label>
																<input type="text" class="form-control"
																	name="colour_name" id="colour_name"
																	placeholder="Colour Name" required>
															</div>
														</div>
														<div class="col-md-4" style="margin-top:40px;">
															<div class="form-group">
																<button type="button" class="btn btn-success"
																	onclick="save_dept2();">Save
																</button>
																<button type="reset" class="btn btn-primary"
																	onclick="div_pop1('color');">Cancel
																</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<div class="card-body">
												<div class="table-responsive">
													<div style="float:right;"><a href="javascript:;"
															onclick="div_pop1('color');"><button type="button"
																class="btn btn-success">Add</button></a></div>
													<div id="infoMsg1"
														style="font-size:10px; color:red; font-weight:bold; text-align:center;">
													</div>
													<div id="colour_list">
														<?php echo color_dept();?>
													</div>
												</div>
											</div>
										</div>
									</div>

									<div class="card m-b-0 border-top">
										<div class="card-header" id="headingThree">
											<h5 class="mb-0">
												<a href="javascript:;" class="collapsed" data-toggle="collapse"
													data-target="#collapseThree" aria-expanded="false"
													aria-controls="collapseThree">
													<i class="m-r-5 fa fa-magnet" aria-hidden="true"></i>
													<span>Style No</span>
												</a>
											</h5>
										</div>
										<div id="collapseThree" class="collapse" aria-labelledby="headingThree"
											data-parent="#accordionExample">
											<form id="style_department">
												<div class="card-body"
													style="width:80%; padding-left:20px; margin:10px;  border:1px solid #20A8D8; border-radius:10px; display:none;"
													id="style_div">
													<div class="row">
														<input type="hidden" name="style_id" id="style_id">
														<div class="col-md-4">
															<div class="form-group">
																<label for="cono1"
																	class="control-label col-form-label">Style
																	No</label>
																<input type="text" class="form-control"
																	name="style_no" id="style_no"
																	placeholder="style No" required>
															</div>
														</div>
														<div class="col-md-4" style="margin-top:40px;">
															<div class="form-group">
																<button type="button" class="btn btn-success"
																	onclick="save_dept5();">Save
																</button>
																<button type="reset" class="btn btn-primary"
																	onclick="div_pop1('style');">Cancel
																</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<div class="card-body">
												<div class="table-responsive">
													<div style="float:right;"><a href="javascript:;"
															onclick="div_pop1('style');"><button type="button"
																class="btn btn-success">Add</button></a></div>
													<div id="infoMsg1"
														style="font-size:10px; color:red; font-weight:bold; text-align:center;">
													</div>
													<div id="style_list">
														<?php echo style_dept();?>
													</div>
												</div>
											</div>
										</div>
									</div>

									

									<div class="card m-b-0 border-top">
										<div class="card-header" id="headingFour">
											<h5 class="mb-0">
												<a href="javascript:;" class="collapsed" data-toggle="collapse"
													data-target="#collapseFour" aria-expanded="false"
													aria-controls="collapseFour">
													<i class="m-r-5 fa fa-magnet" aria-hidden="true"></i>
													<span>NIK ID</span>
												</a>
											</h5>
										</div>
										<div id="collapseFour" class="collapse" aria-labelledby="headingFour"
											data-parent="#accordionExample">
											<form id="nikid_department">
												<div class="card-body"
													style="width:80%; padding-left:20px; margin:10px;  border:1px solid #20A8D8; border-radius:10px; display:none;"
													id="nikid_div">
													<div class="row">
														<input type="hidden" name="nikid_id" id="nikid_id">
														<div class="col-md-4">
															<div class="form-group">
																<label for="cono1"
																	class="control-label col-form-label">NIK ID</label>
																<input type="text" class="form-control"
																	name="nik_id" id="nik_id"
																	placeholder="nik id" required>
															</div>
														</div>
														<div class="col-md-4" style="margin-top:40px;">
															<div class="form-group">
																<button type="button" class="btn btn-success"
																	onclick="save_dept6();">Save
																</button>
																<button type="reset" class="btn btn-primary"
																	onclick="div_pop1('nikid');">Cancel
																</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<div class="card-body">
												<div class="table-responsive">
													<div style="float:right;"><a href="javascript:;"
															onclick="div_pop1('nikid');"><button type="button"
																class="btn btn-success">Add</button></a></div>
													<div id="infoMsg1"
														style="font-size:10px; color:red; font-weight:bold; text-align:center;">
													</div>
													<div id="nikid_list">
														<?php echo nikid_dept();?>
													</div>
												</div>
											</div>
										</div>
									</div>


									
									<div class="card m-b-0 border-top">
										<div class="card-header" id="headingFive">
											<h5 class="mb-0">
												<a href="javascript:;" class="collapsed" data-toggle="collapse"
													data-target="#collapseFive" aria-expanded="false"
													aria-controls="collapseFive">
													<i class="m-r-5 fa fa-magnet" aria-hidden="true"></i>
													<span>NIK No</span>
												</a>
											</h5>
										</div>
										<div id="collapseFive" class="collapse" aria-labelledby="headingFive"
											data-parent="#accordionExample">
											<form id="nikno_department">
												<div class="card-body"
													style="width:80%; padding-left:20px; margin:10px;  border:1px solid #20A8D8; border-radius:10px; display:none;"
													id="nikno_div">
													<div class="row">
														<input type="hidden" name="nikno_id" id="nikno_id">
														<div class="col-md-4">
															<div class="form-group">
																<label for="cono1"
																	class="control-label col-form-label">NIK
																	No</label>
																<input type="text" class="form-control"
																	name="nik_no" id="nik_no"
																	placeholder="Nik No" required>
															</div>
														</div>
														<div class="col-md-4" style="margin-top:40px;">
															<div class="form-group">
																<button type="button" class="btn btn-success"
																	onclick="save_dept7();">Save
																</button>
																<button type="reset" class="btn btn-primary"
																	onclick="div_pop1('nikno');">Cancel
																</button>
															</div>
														</div>
													</div>
												</div>
											</form>
											<div class="card-body">
												<div class="table-responsive">
													<div style="float:right;"><a href="javascript:;"
															onclick="div_pop1('nikno');"><button type="button"
																class="btn btn-success">Add</button></a></div>
													<div id="infoMsg1"
														style="font-size:10px; color:red; font-weight:bold; text-align:center;">
													</div>
													<div id="nikno_list">
														<?php echo nikno_dept();?>
													</div>
												</div>
											</div>
										</div>
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
		function div_pop1(dt_name) {
			$('#' + dt_name + '_department').trigger('reset');
			$('#' + dt_name + '_div').slideToggle();
		}

		$(document).ready(function () {
			$('#example').DataTable();
		});

		// For fabrics
		function save_dept1() {
			var cl = $('#fabric_name').val();
			if (cl == '') {
				return false;
			}

			var formdata = $('#fabric_department').serialize();
			$.ajax({
				url: 'ajax/components.php',
				type: 'POST',
				data: formdata + '&action=saveFabDept',
				success: function (data) {
					data = data.split('~~~');
					if ($.trim(data[0]) == "0") {
						alert("Failed to add");
					}
					if ($.trim(data[0]) == "1") {
						$('#fab_list').html(data[1]);
						$('#example').DataTable();
						$('#fabric_department').trigger('reset');
						$('#fabric_id').val('');
						$('#fabric_div').slideToggle();
						$('#infoMsg1').fadeIn(5000);
						$('#infoMsg1').html("Successfully updated!!!");
						$('#infoMsg1').fadeOut(5000);
					}
					if ($.trim(data['0']) == "2") {
						$('#fabric_department').trigger('reset');
						$('#fabric_div').slideToggle();
						$('#infoMsg1').fadeIn(3000);
						$('#infoMsg1').html("Already Exist in the Data(s)!!");
						$('#infoMsg1').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
			return false;
		}

		// For colors 
		function save_dept2() {
			var cl = $('#colour_name').val();
			if (cl == '') {
				return false;
			}
			var formdata = $('#color_department').serialize();
			$.ajax({
				url: 'ajax/components.php',
				type: 'POST',
				data: formdata + '&action=saveColorDept',
				success: function (data) {
					data = data.split('~~~');
					if ($.trim(data[0]) == "0") {
						alert("Failed to add");
					}
					if ($.trim(data[0]) == "1") {
						$('#colour_list').html(data[1]);
						$('#example').DataTable();
						$('#color_department').trigger('reset');
						$('#color_id').val('');
						$('#color_div').slideToggle();
						$('#infoMsg1').fadeIn(5000);
						$('#infoMsg1').html("Successfully updated!!!");
						$('#infoMsg1').fadeOut(5000);
					}
					if ($.trim(data['0']) == "2") {
						$('#color_department').trigger('reset');
						$('#color_div').slideToggle();
						$('#infoMsg1').fadeIn(3000);
						$('#infoMsg1').html("Already Exist in the Data(s)!!");
						$('#infoMsg1').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
		}

		// for Dia

		function save_dept3() {
			var cl = $('#dia_name').val();
			if (cl == '') {
				return false;
			}
			var formdata = $('#dia_department').serialize();
			$.ajax({
				url: 'ajax/components.php',
				type: 'POST',
				data: formdata + '&action=saveDiaDept',
				success: function (data) {
					data = data.split('~~~');
					if ($.trim(data[0]) == "0") {
						alert("Failed to add");
					}
					if ($.trim(data[0]) == "1") {
						$('#dia_list').html(data[1]);
						$('#example').DataTable();
						$('#dia_department').trigger('reset');
						$('#dia_id').val('');
						$('#dia_div').slideToggle();
						$('#infoMsg1').fadeIn(5000);
						$('#infoMsg1').html("Successfully updated!!!");
						$('#infoMsg1').fadeOut(5000);
					}
					if ($.trim(data['0']) == "2") {
						$('#dia_department').trigger('reset');
						$('#dia_div').slideToggle();
						$('#infoMsg1').fadeIn(3000);
						$('#infoMsg1').html("Already Exist in the Data(s)!!");
						$('#infoMsg1').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
		}

		// for GSM
		function save_dept4() {
			var cl = $('#gsm_name').val();
			if (cl == '') {
				return false;
			}
			var formdata = $('#gsm_department').serialize();
			$.ajax({
				url: 'ajax/components.php',
				type: 'POST',
				data: formdata + '&action=saveGsmDept',
				success: function (data) {
					data = data.split('~~~');
					if ($.trim(data[0]) == "0") {
						alert("Failed to add");
					}
					if ($.trim(data[0]) == "1") {
						$('#gsm_list').html(data[1]);
						$('#example').DataTable();
						$('#gsm_department').trigger('reset');
						$('#gsm_id').val('');
						$('#gsm_div').slideToggle();
						$('#infoMsg1').fadeIn(5000);
						$('#infoMsg1').html("Successfully updated!!!");
						$('#infoMsg1').fadeOut(5000);
					}
					if ($.trim(data['0']) == "2") {
						$('#gsm_department').trigger('reset');
						$('#gsm_div').slideToggle();
						$('#infoMsg1').fadeIn(3000);
						$('#infoMsg1').html("Already Exist in the Data(s)!!");
						$('#infoMsg1').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
		}

		// for Content
		function save_dept5() {
			var cl = $('#content_name').val();
			if (cl == '') {
				return false;
			}
			var formdata = $('#content_department').serialize();
			$.ajax({
				url: 'ajax/components.php',
				type: 'POST',
				data: formdata + '&action=saveContentDept',
				success: function (data) {
					data = data.split('~~~');
					if ($.trim(data[0]) == "0") {
						alert("Failed to add");
					}
					if ($.trim(data[0]) == "1") {
						$('#content_list').html(data[1]);
						$('#example').DataTable();
						$('#conent_department').trigger('reset');
						$('#content_id').val('');
						$('#content_div').slideToggle();
						$('#infoMsg1').fadeIn(5000);
						$('#infoMsg1').html("Successfully updated!!!");
						$('#infoMsg1').fadeOut(5000);
					}
					if ($.trim(data['0']) == "2") {
						$('#conent_department').trigger('reset');
						$('#content_div').slideToggle();
						$('#infoMsg1').fadeIn(3000);
						$('#infoMsg1').html("Already Exist in the Data(s)!!");
						$('#infoMsg1').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
		}
// For Style
        function save_dept5() {
			var cl = $('#style_no').val();
			if (cl == '') {
				return false;
			}
			var formdata = $('#style_department').serialize();
			$.ajax({
				url: 'ajax/components.php',
				type: 'POST',
				data: formdata + '&action=savestyleDept',
				success: function (data) {
					data = data.split('~~~');
					if ($.trim(data[0]) == "0") {
						alert("Failed to add");
					}
					if ($.trim(data[0]) == "1") {
						$('#style_list').html(data[1]);
						$('#example').DataTable();
						$('#style_department').trigger('reset');
						$('#style_id').val('');
						$('#style_div').slideToggle();
						$('#infoMsg1').fadeIn(5000);
						$('#infoMsg1').html("Successfully updated!!!");
						$('#infoMsg1').fadeOut(5000);
					}
					if ($.trim(data['0']) == "2") {
						$('#style_department').trigger('reset');
						$('#style_div').slideToggle();
						$('#infoMsg1').fadeIn(3000);
						$('#infoMsg1').html("Already Exist in the Data(s)!!");
						$('#infoMsg1').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
		}


// For NikId
function save_dept6() {
			var cl = $('#nik_id').val();
			if (cl == '') {
				return false;
			}
			var formdata = $('#nikid_department').serialize();
			$.ajax({
				url: 'ajax/components.php',
				type: 'POST',
				data: formdata + '&action=savenikidDept',
				success: function (data) {
					data = data.split('~~~');
					if ($.trim(data[0]) == "0") {
						alert("Failed to add");
					}
					if ($.trim(data[0]) == "1") {
						$('#nikid_list').html(data[1]);
						$('#example').DataTable();
						$('#nikid_department').trigger('reset');
						$('#nikid_id').val('');
						$('#nikid_div').slideToggle();
						$('#infoMsg1').fadeIn(5000);
						$('#infoMsg1').html("Successfully updated!!!");
						$('#infoMsg1').fadeOut(5000);
					}
					if ($.trim(data['0']) == "2") {
						$('#nikid_department').trigger('reset');
						$('#nikid_div').slideToggle();
						$('#infoMsg1').fadeIn(3000);
						$('#infoMsg1').html("Already Exist in the Data(s)!!");
						$('#infoMsg1').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
		}
// For Nik No
function save_dept7() {
			var cl = $('#nik_no').val();
			if (cl == '') {
				return false;
			}
			var formdata = $('#nikno_department').serialize();
			$.ajax({
				url: 'ajax/components.php',
				type: 'POST',
				data: formdata + '&action=saveniknoDept',
				success: function (data) {
					data = data.split('~~~');
					if ($.trim(data[0]) == "0") {
						alert("Failed to add");
					}
					if ($.trim(data[0]) == "1") {
						$('#nikno_list').html(data[1]);
						$('#example').DataTable();
						$('#nikno_department').trigger('reset');
						$('#nikno_id').val('');
						$('#nikno_div').slideToggle();
						$('#infoMsg1').fadeIn(5000);
						$('#infoMsg1').html("Successfully updated!!!");
						$('#infoMsg1').fadeOut(5000);
					}
					if ($.trim(data['0']) == "2") {
						$('#nikno_department').trigger('reset');
						$('#nikno_div').slideToggle();
						$('#infoMsg1').fadeIn(3000);
						$('#infoMsg1').html("Already Exist in the Data(s)!!");
						$('#infoMsg1').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
		}


		function edit_color(fab_id) {
			$('#color_div').show();
			$('#color_id').val(fab_id);
			var dname = $('#cname_' + fab_id).html();
			$('#colour_name').val(dname);
			document.documentElement.scrollTop = 0;
		}

		function edit_fabric(fab_id) {
			$('#fabric_div').show();
			$('#fabric_id').val(fab_id);
			var dname = $('#dname_' + fab_id).html();
			$('#fabric_name').val(dname);
			document.documentElement.scrollTop = 0;
		}

		function edit_dia(fab_id) {
			$('#dia_div').show();
			$('#dia_id').val(fab_id);
			var dname = $('#dianame_' + fab_id).html();
			$('#dia_name').val(dname);
			document.documentElement.scrollTop = 0;
		}

		function edit_gsm(fab_id) {
			$('#gsm_div').show();
			$('#gsm_id').val(fab_id);
			var dname = $('#gsmname_' + fab_id).html();
			$('#gsm_name').val(dname);
			document.documentElement.scrollTop = 0;
		}

		function edit_content(fab_id) {
			$('#content_div').show();
			$('#content_id').val(fab_id);
			var dname = $('#conentname_' + fab_id).html();
			$('#content_name').val(dname);
			document.documentElement.scrollTop = 0;
		}

		function edit_style(fab_id) {
			$('#style_div').show();
			$('#style_id').val(fab_id);
			var dname = $('#style_' + fab_id).html();
			$('#style_no').val(dname);
			document.documentElement.scrollTop = 0;
		}

		function edit_nikno(fab_id) {
			$('#nikno_div').show();
			$('#nikno_id').val(fab_id);
			var dname = $('#nikno_' + fab_id).html();
			$('#nik_no').val(dname);
			document.documentElement.scrollTop = 0;
		}

		function edit_nikid(fab_id) {
			$('#nikid_div').show();
			$('#nikid_id').val(fab_id);
			var dname = $('#nikid_' + fab_id).html();
			$('#nik_id').val(dname);
			document.documentElement.scrollTop = 0;
		}

		function fabricDelete(ID, dp_name, delname) {
			var UsrStatus = confirm("Are you sure to delete this details ?");

			if (UsrStatus) {
				$('#' + dp_name + '_department').trigger('reset');
				$('#' + dp_name + '_id').val('');
				$('#' + dp_name + '_div').hide();
				$.ajax({
					url: 'ajax/components.php',
					data: {
						action: delname,
						typeid: ID
					},
					success: function (data) {
						//alert(data);
						if ($.trim(data) == "error") {
							alert("Deleted Failed Kindly. Try again");
						}
						if ($.trim(data) == "1") {
							document.getElementById("delete_" + ID).style.display = "none";
							$('.infoMsg1').fadeIn(3000);
							$('.infoMsg1').html("Deleted successfully!!");
							$('.infoMsg1').fadeOut(3000);
						}
					},
					error: function (textStatus, errorThrown) {
						//DO NOTHINIG
					}
				});
			}
		}
	</script>

</body>

</html>