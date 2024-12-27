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
    <title><?php echo SITE_TITLE;?> - Component</title>
    <!-- Custom CSS -->
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
							<h4 class="page-title">Component</h4> &nbsp;&nbsp;&nbsp;&nbsp;
							<a href="product_master.php"> <button type="button" class="btn btn-info">Product Master</button></a>
							<div class="ml-auto text-right">
								<nav aria-label="breadcrumb">
									<ol class="breadcrumb">
										<li class="breadcrumb-item"><a href="javascript:;" onclick="div_pop();"><button type="button" class="btn btn-success">Add</button></a></li>
									</ol>
								</nav>
							</div>
						</div>
					</div>
				</div>
				<!-- End Bread crumb and right sidebar toggle -->
				<!-- ============================================================== -->
				<!-- ============================================================== -->
				<form id="user_department">
				<div class="card-body" style="width:80%; padding-left:20px; margin:10px;  border:1px solid #20A8D8; border-radius:10px; display:none;" id="add_div">
				<div class="row" >
				<input type="hidden" name="dept_id" id="dept_id" >
						<div class="col-md-4">
							<div class="form-group">
								<label for="cono1" class="control-label col-form-label">Component</label>
								<input type="text"  class="form-control" name="dt_name" id="dt_name"  placeholder="department" required>
							</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
								<label for="lname" class="control-label col-form-label">Description	</label>
								<textarea class="form-control" required placeholder="description" name="dept_descr" id="dept_descr"></textarea>
							</div>
						</div>
						<div class="col-md-4">
						<div class="form-group">
							<label for="email1" class="control-label col-form-label">Status</label>
							<input type="radio" id="stat-act" value="0" checked name="status" class="form-group" > Active
							<input type="radio" id="stat-inact" value="1" name="status" class="form-group"> Inactive
						</div>
						<div class="form-group">
						<button type="button" class="btn btn-success" onclick="save_dept();">Save</button>
						<button type="reset" class="btn btn-primary">Reset</button>
						<button type="reset" class="btn btn-primary" onclick="div_pop();">Cancel</button>
						</div>
						</div>
					</div>
						</div>
				</form>
				<!-- Container fluid  -->
				<div class="container-fluid">
					<!-- ============================================================== -->
					<!-- Sales chart -->
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="table-responsive">
									<div id="infoMsg" style="dont-size:10px; color:red; font-weight:bold; text-align:center;"></div>
									<div id="dept_list"><?php echo component_list1();?></div>
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

		  function div_pop(){
			  $('#user_department').trigger('reset');
			  $('#add_div').slideToggle();
		  }

			
		  function save_dept(){
			  var formdata = $('#user_department').serialize();
			  $.ajax({
				url : 'ajax/products.php',
				type: 'POST',
				data: formdata+'&action=saveComponent',
				success: function( data ) {
					data = data.split('~~~');
					if($.trim(data[0])=="0"){
						alert("Failed to add");
					}
					if($.trim(data[0])=="1"){
						$('#dept_list').html(data[1]);
						$('#example').DataTable();
						$('#user_department').trigger('reset');
						$('#dept_id').val('');
						$('#add_div').slideToggle();
						$('#infoMsg').fadeIn(5000);
						$('#infoMsg').html("Department successfully updated!!!");
						$('#infoMsg').fadeOut(5000);
					}
					if($.trim(data['0'])=="2"){
						$('#user_department').trigger('reset');
						$('#add_div').slideToggle();
						$('#infoMsg').fadeIn(3000);
						$('#infoMsg').html("Department Exist in the Data(s)!!");
						$('#infoMsg').fadeOut(3000);
					}
				},
				error: function (textStatus, errorThrown) {
					//DO NOTHINIG
				}
			});
		  }

		  function edit_dept(dept_id){
			  $('#add_div').show();
			  $('#dept_id').val(dept_id);
			  var dname= $('#dname_'+dept_id).html();
			  var ddesc= $('#ddesc_'+dept_id).html();
			  var dstatus = $('#status_'+dept_id).val();
			  $('#dt_name').val(dname);
			  $('#dept_descr').html(ddesc);
			  if(dstatus=='0'){
				  $('#stat-act').prop('checked', true);
				  $('#stat-inact').prop('checked', false);
			  } else {
				  $('#stat-inact').prop('checked', true);
				  $('#stat-act').prop('checked', false);
			  }
			  document.documentElement.scrollTop = 0;
		  }

		  function Deletecomp(ID){
		  var UsrStatus = confirm("Are you sure to delete this details ?");
		  if(UsrStatus){
			  $('#user_department').trigger('reset');
			  $('#dept_id').val('');
			  $('#add_div').hide();
			$.ajax({
				url : 'ajax/products.php',
				data: {
				   action: 'compDelete',
				   typeid: ID
				},
				success: function( data ) {
					alert(data);
					if($.trim(data)=="error"){
						alert("Deleted Failed Kindly. Try again");
					}
					if($.trim(data)=="1"){
						$('#infoMsg').fadeIn(3000);
						$('#infoMsg').html("Deleted successfully!!");
						$('#infoMsg').fadeOut(3000);
						document.getElementById("delete_"+ID).style.display = "none";
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