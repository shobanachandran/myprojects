<?php
// Assuming this is your expenses_costing_edit.php

include('includes/config.php');

// Check if the ID is provided in the URL
if (!isset($_GET['id'])) {
    // Handle the case where ID is not provided
    // Redirect the user or show an error message
    header("Location: expense_costing_list.php");
    exit();
}


$id = $_GET['id'];

// Fetch entry details from the database based on ID
$expense_entry = mysqli_query($zconn, "SELECT * FROM expenses_costing WHERE id = '$id'");
$expense_data = mysqli_fetch_assoc($expense_entry);

// Check if the entry exists
if (!$expense_data) {
    // Handle the case where entry does not exist
    // Redirect the user or show an error message
    header("Location: expense_costing_list.php");
    exit();
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Assuming you've retrieved and sanitized form data here
	
	  $costing_no = mysqli_real_escape_string($zconn, $_POST['costing_no']);
    $order_no = mysqli_real_escape_string($zconn, $_POST['order_no']);
    $descr = mysqli_real_escape_string($zconn, $_POST['descr']);
    $compos = mysqli_real_escape_string($zconn, $_POST['compos']);
    $process_loss = mysqli_real_escape_string($zconn, $_POST['process_loss']);
    $others = mysqli_real_escape_string($zconn, $_POST['others']);
    $buyer = mysqli_real_escape_string($zconn, $_POST['buyer']);
    $style_no = mysqli_real_escape_string($zconn, $_POST['style_no']);
    $order_date = mysqli_real_escape_string($zconn, $_POST['order_date']);
    $rejection = mysqli_real_escape_string($zconn, $_POST['rejection']);
    $over_head = mysqli_real_escape_string($zconn, $_POST['over_head']);
    
    // Update query to modify the existing data in the database
    $update_query = "UPDATE expenses_costing SET costing_id = '$costing_no', order_no = '$order_no', descr = '$descr', compo = '$compos', process_loss = '$process_loss', others = '$others', buyer = '$buyer', style_no = '$style_no', order_date = '$order_date', rejection = '$rejection', overhead = '$over_head' WHERE id = '$id'";

    // Execute the update query
    $result = mysqli_query($zconn, $update_query);

    if ($result) {
        // Redirect to a success page or display a success message
        header("Location: expense_costing_list.php?success=1");
        exit();
    } else {
        // Handle the case where the update query fails
        echo "Update failed: " . mysqli_error($zconn);
    }
}



// Assuming you have fetched all the necessary data from the database, now build the HTML form

// Fill form fields with fetched data
$costing_no = $expense_data['costing_id'];
$order_no = $expense_data['order_no'];
$descr = $expense_data['descr'];
$compos = $expense_data['compo'];
$process_loss = $expense_data['process_loss'];
$others = $expense_data['others'];
$buyer = $expense_data['buyer'];
$style_no = $expense_data['style_no'];
$order_date = $expense_data['order_date'];
$rejection = $expense_data['rejection'];
$over_head = $expense_data['overhead'];

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
    <title><?php echo SITE_TITLE;?> - Expenses Costing Entry</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>   
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
            <!-- Breadcrumb and other elements -->
			
			  <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
			 
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Expenses Costing Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="costing.php"> Costing Info</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                <form method="post" name="expense_costing">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
							</div>
								<div class="card-body" style="width:100%">
									<div class="card-body" style="width:100%">
										<div class="card" style="width:50%; float:left; left: 50px; ">
											<div class="form-group row">
												<label for="fname" class="col-sm-3 text-right control-label col-form-label">Costing No</label>
												<div class="col-sm-6">
							
<select class="select2 form-control custom-select chosen-select" onchange="sel_details(this.value);" name="costing_no" id="costing_no">
    <option value="">Select</option>
    <?php 
    $sel_costing = mysqli_query($zconn, "SELECT * FROM costing_entry_master");
    
    while ($res_costing = mysqli_fetch_array($sel_costing, MYSQLI_ASSOC)) {
        if ($res_costing['id'] == $id) {
            ?>
            <option selected value="<?php echo $res_costing['id']; ?>"><?php echo $res_costing['costing_no']; ?></option>
            <?php 
        } else {
            ?>
            <option value="<?php echo $res_costing['id']; ?>"><?php echo $res_costing['costing_no'] . " - (" . $res_costing['order_no'] . ")"; ?></option>
            <?php 
        }
    }
    ?>
</select>


											<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</div>
											</div>
											<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
												<div class="col-sm-6">
							
													<input type="text" class="form-control"  id="order_no" name="order_no" placeholder="" value="<?php echo $order_no; ?>">
												</div>
											</div>

											<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Description</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  id="descr" name="descr"placeholder="" value="<?php echo $descr; ?>">
												</div>
											</div>

											<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Composition</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  id="compos" name="compos"placeholder="" value="<?php echo $compos; ?>">
												</div>
											</div>

											<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Proces loss (%)</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  id="process_loss" name="process_loss" placeholder="" value="<?php echo $process_loss; ?>">
												</div>
											</div>
												<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">others(%)</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  id="process_loss" name="others" placeholder="" value="<?php echo $others; ?>">
												</div>
											</div>

											<div class="form-group row">
											</div>	

											<!--div class="form-group row">
												<h4 class="page-title"><b>Material Details</b></h4>
											</div-->


										</div>
										<div class="card" style="width:50%; float:left; right: 50px;">
											<div class="form-group row">
												<label for="fname" class="col-sm-3 text-right control-label col-form-label">Buyer name</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  id="buyer_name" name="buyer" placeholder="" value="<?php echo $buyer; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  name="style_no" id="style_no" placeholder="" value="<?php echo $style_no; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Order Date</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  id="order_date" name="order_date" value="<?php echo $order_date; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Rejection (%)</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  id="process_loss" name="rejection" placeholder="" value="<?php echo $rejection; ?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Over head (%)</label>
												<div class="col-sm-6">
													<input type="text" class="form-control"  id="process_loss" name="over_head" placeholder="" value="<?php echo $over_head; ?>">
												</div>
											</div>
											
										</div>
									</div>
										
							</div>
							<div class="border-top">
									<div class="card-body" style="margin-left: 250px;">
										<button type="submit" name="submit" class="btn btn-success">Save</button>
										<button type="reset" class="btn btn-primary">Reset</button>
										<a href="expense_costing_list.php"><button type="button" class="btn btn-danger">List</button></a>
									</div>
								</div>
						</div>
					</div>
					<!-- Sales chart -->
					<!-- ============================================================== -->
				</div>
				</form>

            </div>
        </div>

        <!-- Footer and other common elements -->

        <!-- JavaScript imports and custom scripts -->
    </div>
</body>

</html>
