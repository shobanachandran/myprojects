<?php 
include('includes/config.php');

if(empty($_SESSION['userid'])){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_POST['save'])){
	$count = count($_POST['wgt']);

	for($i = 0; $i < $count; $i++){ 
		if ($_POST['wgt'][$i] > 0) {
			$wgt = $_POST['wgt'][$i];
			$fabrics0 = mysqli_fetch_object(mysqli_query($zconn, "SELECT sum(weight) as weight FROM fabric_po_details WHERE `po_id`='" . $_POST['po_no'] . "' AND id='" . $_POST['id'][$i] . "' AND order_no='" . $_POST['order'][$i] . "'"));
			$fwgt = $fabrics0->weight;
			$fabrics = mysqli_fetch_object(mysqli_query($zconn, "SELECT sum(wgt) as wgt FROM fabric_inward WHERE `po_no`='" . $_POST['po_no'] . "' AND old_id='" . $_POST['id'][$i] . "' AND order_no='" . $_POST['order'][$i] . "'"));
			$new = $_POST['wgt'][$i];
			$fwgt2 = $fabrics->wgt + $new;
			$tcom = $fwgt - $fwgt2;
			if ($tcom == 0) {
				mysqli_query($zconn, "UPDATE `fabric_po_details` SET `status` = 'complete' WHERE `po_id`='" . $_POST['po_no'] . "' AND id='" . $_POST['id'][$i] . "' AND order_no='" . $_POST['order'][$i] . "'") or die(mysqli_error());
			}

			$sql = mysqli_query($zconn, "INSERT INTO `fabric_inward` (`po_no`, `style_no`, `order_no`, `fabric_name`, `wgt`, `roll`, `date`, old_id) VALUES ('" . $_POST['po_no'] . "', '" . $_POST['style'][$i] . "', '" . $_POST['order'][$i] . "', '" . $_POST['fabric_name'][$i] . "', '" . $_POST['wgt'][$i] . "', '" . $_POST['roll'][$i] . "', NOW(), '" . $_POST['id'][$i] . "')") or die(mysqli_error());
		}
	}

	if(isset($sql)){
		echo("<script>alert('Fabric Inwarded Successfully');</script>");
	} else {
		$error = 'Error';
	}
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
	// Check if the form was submitted with an "Accept" button click
	if (isset($_POST['accept_id'])) {
		$id = $_POST['accept_id'];
		echo $id;

		// Update the status in the process_production table
		$updateQuery = "UPDATE process_production1 SET status = 'Accept' WHERE id = '$id'";
		$updateResult = mysqli_query($zconn, $updateQuery);

		if ($updateResult) {
			// Check how many rows were affected
			$affectedRows = mysqli_affected_rows($zconn);
			if ($affectedRows === 1) {
				echo 'Status updated successfully.';
			} else {
				echo 'No records were updated.';
			}
		} else {
			echo 'Failed to update status: ' . mysqli_error($zconn);
		}
	}
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
	<title><?php echo SITE_TITLE;?> - FABRIC PO INWARD</title>
	<!-- Custom CSS -->
	<!--  datatables CSS -->
	<link href="dist/css/bootstrap.css" rel="stylesheet">    
	<link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
	<!-- Custom CSS -->
	<link href="dist/css/style.min.css" rel="stylesheet"> 
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
	<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

	
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
						<h4 class="page-title">FABRIC INWARD</h4>
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
				<form action="" method="post">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-body">
									<div class="row">
										<div class="col-sm-12">
											<div class="row">
												<label for="fname" class="col-sm-6 text-center control-label col-form-label" style="margin-right: 0;">Style No</label>
												<div class="col-sm-4" style="margin-left: -15px;"> <!-- Adjust margin-left as needed -->
											<select class="select2 form-control custom-select" name="styleno" id="style_no" >

														<option value="0">Select</option>
														<?php
														$sel_buyer = mysqli_query($zconn, "SELECT DISTINCT style_no FROM process_production1 WHERE status='open'");
														while ($res_buyer = mysqli_fetch_array($sel_buyer, MYSQLI_ASSOC)) {
														?>
														<option value="<?php echo $res_buyer['style_no']; ?>"><?php echo $res_buyer['style_no']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<br><br>
									<div class="table-responsive">
										<br>
										<div id="styleDetails">
											<!-- Details for the selected style will be displayed here -->
										</div>
										 
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				<!-- End Container fluid  -->
			</div>
			<!-- End Page wrapper  -->
				
		</div>
		<?php include('includes/footer.php');?>
		</div>
		<!-- End Wrapper -->
		<!-- ============================================================== -->
		<!-- All Jquery -->
		<script src="assets/libs/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap tether Core JavaScript -->
		<script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
		<!-- Wave Effects -->
		<!-- Menu sidebar -->
		<script src="dist/js/sidebarmenu.js"></script>
		<!-- Custom JavaScript -->
		<script src="dist/js/custom.min.js"></script>
		<!-- Datatables JavaScript -->
		<script src="dist/js/jquery.dataTables.min.js"></script>
		<script src="dist/js/dataTables.bootstrap4.min.js"></script>
		<script>
			$(document).ready(function() {
				$('#example').DataTable();
			});
			function DeleteUsrId(ID){
				var UsrStatus = confirm("Are you sure to delete this company details ?");
				if(UsrStatus){
					$('#delete_'+ID).hide();
				}
			}
		</script>
	 <script>
    $(document).ready(function() {
        // Initially, display all data
        loadAllData();

        // Handle style_no selection
        $('#style_no').change(function() {
            var selectedStyle = $(this).val();

            if (selectedStyle !== '0') {
                // If a style is selected, load its details using the defined function
                loadStyleDetails(selectedStyle);
            } else {
                // If 'Select' is chosen, clear the details
                $('#styleDetails').html('');
            }
        });

        function loadAllData() {
            // AJAX request to load all data
            $.ajax({
                url: 'fetch_all_data.php', // Replace with the actual URL
                method: 'POST',
                success: function (response) {
                    $('#styleDetails').html(response);
                },
                error: function (error) {
                    console.error('Error:', error);
                }
            });
        }
  function loadStyleDetails(selectedStyle) {
        // AJAX request to load style details with selected style_no
        $.ajax({
            url: 'fetch_style_details.php', // Replace with the actual URL
            method: 'POST',
            data: { style_no: selectedStyle },
            success: function (response) {
                $('#styleDetails').html(response);
            },
            error: function (error) {
                console.error('Error:', error);
            }
        });
    }

     
    });
</script>

	</body>
	</html>
