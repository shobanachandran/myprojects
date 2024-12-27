<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
	include("includes/config.php");
	extract($_REQUEST);
	$currentFile = $_SERVER["SCRIPT_NAME"];
	$parts = explode('/', $currentFile);
	$currentFile = $parts[count($parts) - 1];


//$rights = check_rights($zconn,$currentFile);

	if($_SESSION['userid'] == '') { ?>
		<script>window.location='logout.php';</script>
	<?php exit();
	}
	$action = 'staffadd';
	$breadcrumb = 'Add';
	$sucessMsg = 'User Added Successfully';
	if(isset($userid)){
		$sucessMsg = 'User Updated Successfully';
		$action = 'staffedit';
		$breadcrumb = 'Edit';
		$edtUsrQry = "SELECT * FROM hv_fabric_master WHERE id='".$userid."'";
		$edtUsrResource = mysqli_query($zconn,$edtUsrQry);
		$userData = mysqli_fetch_array($edtUsrResource,MYSQLI_ASSOC);
		$userid = $userData['staff_id'];
		$staff_name = $userData['staff_name'];
		$staff_code = $userData['staff_code'];
		 $staff_mobile = $userData['staff_mobile'];
		 $staff_position = $userData['staff_position'];

		$typeid = $userData['TYPEID'];
		$dept_id = $userData['dept_id'];
		$team_id = $userData['team_id'];
		$status = $userData['status'];
		$staff_address = $userData['staff_address'];
		$staff_salary = $userData['staff_salary'];
		$staff_bloodgroup = $userData['staff_bloodgroup'];
		$staff_econtact = $userData['staff_econtact'];
		$staff_relation = $userData['staff_relation'];
	}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Garments ERP">
    <meta name="author" content="Iorange Innovation">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title>
        <?php echo SITE_TITLE;?> - Fabric add
    </title>
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper">
        <?php include('includes/header.php');?>
        <?php include('includes/sidebar.php');?>

        <div class="page-wrapper" style="min-height: 100%; height: auto;padding-bottom: 50px; overflow-y: auto;">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Fabric Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="hv_fabric.php">Fabric Info</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

               
                <form name="userInfo" id="userInfo" method="post" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nik_no">NIK NO:</label>
                                                <!--input type="text" class="form-control" id="nik_no" name="nik_no" placeholder="Enter NIK No"-->
                                                <select class="form-control select2"  tabindex="6"  name="nik_no" id="nik_no" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                       $typQuery = "SELECT * FROM nik_no";
                                                       $typResource = mysqli_query($zconn,$typQuery);
                                                       while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
                                                    ?>
                                                     <option value="<?php echo $typdata['id']; ?>" <?php if($typeid==$typdata['id']){ ?> selected <?php } ?>><?php echo $typdata['nik_no']; ?></option>
                                                     <?php
                                                      }
                                                     ?>
                                                   </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="photo">PHOTO REF:</label>
                                                <input type="file" id="photo" class="form-control" name="photo" accept="image/*">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="style">STYLE:</label>
                                                <input type="text" id="style" class="form-control" name="style" placeholder="Enter Style">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="style-number">STYLE NUMBER:</label>
                                                 <!--input type="text" class="form-control" id="nik_no" name="nik_no" placeholder="Enter NIK No"-->
                                                 <select class="form-control select2"  tabindex="6"  name="style_no" id="style_no" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                       $typQuery = "SELECT * FROM style_code";
                                                       $typResource = mysqli_query($zconn,$typQuery);
                                                       while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
                                                    ?>
                                                     <option value="<?php echo $typdata['id']; ?>" <?php if($typeid==$typdata['id']){ ?> selected <?php } ?>><?php echo $typdata['style_no']; ?></option>
                                                     <?php
                                                      }
                                                     ?>
                                                   </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nik-id">NIK ID:</label>
                                                <select class="form-control select2"  tabindex="6"  name="nik_id" id="nik_id" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                       $typQuery = "SELECT * FROM nik_id";
                                                       $typResource = mysqli_query($zconn,$typQuery);
                                                       while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
                                                    ?>
                                                     <option value="<?php echo $typdata['id']; ?>" <?php if($typeid==$typdata['id']){ ?> selected <?php } ?>><?php echo $typdata['nik_id']; ?></option>
                                                     <?php
                                                      }
                                                     ?>
                                                   </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="color">COLOR:</label>
                                                <select class="form-control select2"  tabindex="6"  name="color" id="color" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                       $typQuery = "SELECT * FROM color_master";
                                                       $typResource = mysqli_query($zconn,$typQuery);
                                                       while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
                                                    ?>
                                                     <option value="<?php echo $typdata['id']; ?>" <?php if($typeid==$typdata['id']){ ?> selected <?php } ?>><?php echo $typdata['colour_name']; ?></option>
                                                     <?php
                                                      }
                                                     ?>
                                                   </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="qty">QTY:</label>
                                                <input type="number" id="qty" class="form-control" name="qty" placeholder="Enter Quantity">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cut-qty">Cut Qty:</label>
                                                <input type="number" id="cut_qty" class="form-control" name="cut_qty" placeholder="Enter Cut Quantity">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="merch">Merch</label>
                                                <select id="merch" class="form-control" name="merch">
                                                    <option value="merch1">Merch1</option>
                                                    <option value="merch2">Merch2</option>
                                                    <option value="merch3">Merch3</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="strike-off">Delivery Date</label>
                                                <input type="date" id="strike_off_date" class="form-control" name="strike_off_date" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>
                                    </div>


                                    <!--div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="tech-pack">Tech Pack Date:</label>
                                                <input type="date" id="tech_pack_date" class="form-control" name="tech_pack_date" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="strike-off">Strike Off Date:</label>
                                                <input type="date" id="strike_off_date" class="form-control" name="strike_off_date" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>
                                    </div-->

                                    <!--div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="strike-off-lead-time">Strike Off Lead Time:</label>
                                                <input type="number" id="strike_off_lead_time" class="form-control" name="strike_off_lead_time" placeholder="Enter Lead Time">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="plan">Plan:</label>
                                                <input type="date" id="plan_date" class="form-control" name="plan_date" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>
                                    </div-->

                                    <!--div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="lookup-date">Lookup Date:</label>
                                                <input type="date" id="lookup_date" class="form-control" name="lookup_date" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="actual">Actual:</label>
                                                <input type="date" id="actual_date" class="form-control" name="actual_date" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>
                                    </div-->

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="hv_fabric_report.php" class="btn btn-danger">Back</a>
                        </div>
                        <input type="hidden" name="action" id="action" value="<?php echo $action ?>" />
                        <?php if (isset($userid)) { ?>
                            <input type="hidden" name="userid" id="userid" value="<?php echo $userid ?>" />
                        <?php } ?>
                        </div>

                </form>

            </div>
        </div>
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
	<script src="dist/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

	<script>
$("form#userInfo").submit(function (e) {
    e.preventDefault(); // Prevent default form submission
    var formData = new FormData(this);

    $.ajax({
        url: "ajax/hv_fabric.php",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log("Response Data:", data); // Log response for debugging
            data = data.trim(); // Ensure response is trimmed

          if (data === "true") {
                alert("<?php echo $sucessMsg; ?>");
                <?php if (!isset($userid)) { ?>
                    document.getElementById("userInfo").reset();
                <?php } ?>
                window.location.href = 'staffs.php';
            } else if (data === "error") {
                alert("Process Failed. Kindly Try Again.");
                document.getElementById("userInfo").reset();
            } else {
                alert("Unexpected response: " + data);
            }
        },
        error: function (xhr, status, error) {
            console.error("AJAX Error:", status, error);
            alert("An error occurred during form submission. Please try again.");
        },
    });
});


	</script>

</body>
</html>
