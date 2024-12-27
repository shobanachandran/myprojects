<?php 
include('includes/config.php');

if ($_SESSION['userid'] == '') {
    echo "<script>window.location.href='login.php';</script>";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save'])) {
	 $select = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as id from process_production1"));
    $id = $select['id']+1;
	

for ($i = 0; $i < count($_POST['style_no']); $i++) {
    $styleNo = $_POST['style_no'][$i];
    $orderNo = $_POST['order_no'][$i];
    $fabricName = $_POST['fabric_name'][$i];
    $color = $_POST['color'][$i];
    $dia = $_POST['dia'][$i];
    $gsm = $_POST['gsm'][$i];
    $fromAddr = $_POST['from_addr'][$i];
    $wgt = $_POST['wgt'][$i];
    $stock = $_POST['stock'][$i];
    $deliveryWgt = $_POST['delivery_wgt'][$i];
    $roll = $_POST['roll'][$i];
    $enteredWgt = $_POST['entered-wgt'][$i];
	$company_name = $_POST['company_name'];
    // Add sent_to, date, and created_at values
    $sentTo = $_POST['sent_to'];
    $date = $_POST['date'][$i];
	

    //$createdAt = date("Y-m-d H:i:s"); // Assuming you want to set the current date and time
    
 // Get the calculated stock value for this row based on data-row-id
    $rowId = "row" . $i;
    $calculatedStock = $_POST['stock'][$i]; // Replace this with the actual calculated value
 
$date = date("Y-m-d", strtotime($_POST['date'])); // Format the date

$sql = "INSERT INTO process_production1 (style_no, order_no, dc_no, sent_to, date, fabric_name, color, dia, gsm, from_addr, wgt, stock, delivery_wgt, rolls, entered_wgt, company_name, status)
        VALUES ('$styleNo', '$orderNo', '$id', '$sentTo', '$date', '$fabricName', '$color', '$dia', '$gsm', '$fromAddr', '$wgt', '$enteredWgt', '$deliveryWgt', '$roll', '$enteredWgt', '$company_name', 'open')";


    // Execute the INSERT querysoumee
    
    if ($zconn->query($sql) === TRUE) {
        echo "Record inserted successfully.";
    } else {
        echo "Error: " . $sql . "<br>" . $zconn->error;
    }
}
 // Redirect to a new page to avoid form resubmission
    header("Location: cutting_dc_copy.php"); // Replace with your desired success page
    exit(); // Exit to prevent further execution
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
    <title><?php echo SITE_TITLE;?> - YARN TO PRODUCTION</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<style>
	th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
	</style>
</head>

<body>
    <div id="main-wrapper">
  
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
		<?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ================================ ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- =========================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">FABRIC TO PRODUCTION</h4>
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
								<form method="post" id="dataFilterForm" action="">
								<div class="row">
							<div class="col-sm-12" >
								<div class="col-sm-6" style="float:left; left: 50px;">
                                
											<div class="form-group row">
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Order No</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="order_no" id="order_no" onchange="this.form.submit();">
								<option>Select</option>
								<?php $sel_buyer = mysqli_query($zconn,"SELECT DISTINCT po_no FROM fabric_inward ;
");
								while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ 
								$sel_orders = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `fabric_inward` where po_no='".$res_buyer['po_no']."' "));
														
														?>
								<option value="<?php echo $sel_orders['order_no'];?>" <?php if($_REQUEST['order_no']==$sel_orders['order_no']){ echo "selected";}?>><?php echo $sel_orders['order_no'];?></option>
								<?php } ?>
								</select>
												</div>
												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Style No</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="style_no" id="style_no" onchange="this.form.submit();">
											<option>Select</option>
		<?php $sel_buyer = mysqli_query($zconn,"SELECT * FROM `fabric_inward` where order_no='".$_REQUEST['order_no']."' ");
  //$sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
							while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
								<option value="<?php echo $res_buyer['style_no'];?>" <?php if($_REQUEST['style_no']==$res_buyer['style_no']){ echo "selected"; }?>><?php echo $res_buyer['style_no'];?></option>
													<?php } ?>
													</select>
												</div>
												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Send To</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="sent_to" id="sel_buyer" onchange="$('#costing_list').submit();">
													<option>Select</option>
										<option value="To_Production">To Production</option>
									    <option value="To_Stock">To Stock</option>
										<option value="Direct_DC">Direct DC</option>
													</select>
												</div>
											</div>
										</div>
										<div class="col-sm-6" style="float:left; right: 50px;">
											<div class="form-group row">
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Date</label>
												<div class="col-sm-6">
													<input type="date" autocomplete="off" name="date" required class="form-control" id="costing_date"   >
												</div>
												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Company Name</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="company_name" id="sel_buyer" onchange="$('#costing_list').submit();">
													<option>Select</option>
													<?php $sel_buyer = mysqli_query($zconn,"select * from suppliers");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
													<option value="<?php echo $res_buyer['supplier_name'];?>"><?php echo $res_buyer['supplier_name'];?></option>
													<?php } ?>
													</select>
												</div>
											<br>
												<br>
												<br>
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Dc No</label>
                                    <div class="col-sm-6">
                                        <?php $select = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as id from process_production1")); 

                                        $id=$select['id']+1;?>
                                        <input type="text" name="dc_no" class="form-control" value="<?php echo $id;?>">
                                    </div>
                               
											</div>
										</div>
									</div>
								</div>
									
								<br><br>
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered text-center">
    <thead>
        <tr>
            <th style="width:2%"></th>
            <th style="width:11%">STYLE NO</th>
            <th style="width:11%">ORDER NO</th>
            <th style="width:4%">FABRIC</th>
            <!-- <th style="width:4%">COLOUR</th>
            <th style="width:3%">DIA</th>
            <th style="width:3%">GSM</th> -->
            <!--th style="width:11%" data-toggle="tooltip" title="Previous Process Weight">PREV. PRO.</th-->
            <th style="width:3%" data-toggle="tooltip" title="Received">REC.</th>
            <th style="width:8%" data-toggle="tooltip" title="In Stock">IN STK</th>
            <th style="width:10%" data-toggle="tooltip" title="Delivered">DEL.</th>
            <th style="width:8%">ROLLS</th>
            <th style="width:11%">SENT KGS</th>
        </tr>
    </thead>
    <tbody>
        <!--?php
		$sno=1;
// Check if a specific "Style No" is selected in the dropdown
if (isset($_REQUEST['style_no']) && !empty($_REQUEST['style_no'])) {
    // Get the selected "Style No"
    $selectedStyleNo = $_REQUEST['style_no'];

 
    // Query to retrieve data filtered by "Style No" and "from_addr" equals "COMPACT"
    $query = "SELECT * FROM process_dc_in WHERE style_no = '$selectedStyleNo' AND from_addr = 'COMPACT'";
} else {
    // If no specific "Style No" is selected, retrieve all data where "from_addr" equals "COMPACT"
    $query = "SELECT * FROM process_dc_in WHERE from_addr = 'COMPACT'";
}

$result = mysqli_query($zconn, $query);

if (mysqli_num_rows($result) > 0) {
	$i = 0;
    while ($row = mysqli_fetch_assoc($result)) {
		
		   $i++; 
		?-->
			
	<?php
											$i=1;
		$sno=1;

											$sectBrnQry = "SELECT * FROM fabric_inward where style_no='".$_REQUEST['style_no']."' ";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
												// $order_no=$coldata['order_no'];
												// $style_no=$coldata['style_no'];
												// $fabric_name=$coldata['fabric_name'];
												// $processs;
//print_r($coldata);
											
					$inward_query = mysqli_query($zconn, "SELECT * FROM process_production1 WHERE order_no='" . $coldata['order_no'] . "' AND style_no='" . $coldata['style_no'] . "'");


    $inward= mysqli_fetch_assoc($inward_query);
    
//print_r($inward_data);
//}
											//	exit;
											?>

        <tr>
            <td><?= $sno; ?></td>
             <td><?php echo $coldata['style_no'];?><input type="hidden" name="style_no[]" value="<?php echo $coldata["style_no"] ?>"></td>
            <td><?php echo $coldata['order_no'] ?><input type="hidden" name="order_no[]" value="<?php echo $coldata["order_no"] ?>"></td>
            <td><?php echo $coldata['fabric_name'] ?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata["fabric_name"] ?>"></td>
            <!-- <td><?php echo $coldata['color'] ?><input type="hidden" name="color[]" value="<?php echo $coldata["color"] ?>"></td>
            <td><?php echo $coldata['dia'] ?><input type="hidden" name="dia[]" value="<?php echo $coldata["dia"] ?>"></td>
            <td><?php echo $coldata['gsm'] ?><input type="hidden" name="gsm[]" value="<?php echo $coldata["gsm"] ?>"></td> -->
            <!--td><?= $row['from_addr'] ?><input type="hidden" name="from_addr[]" value="<?= $row["from_addr"] ?>"></td!-->
         <td>
			 <input type="hidden" name="from_addr[]" value="<?php echo $coldata["from_addr"] ?>">
    <span class="wgt-display"><?php echo $coldata['wgt'] ?> </span>
   <?php echo $coldata['wgt'] ?> <input type="hidden" name="wgt[]" value="<?php echo $coldata["wgt"] ?>">
</td>
<td><?php
$totalDeliveryWgt = 0;

// Calculate the total sum of 'delivery_wgt' for the same 'style_no'
foreach ($inward_query as $row) {
    $totalDeliveryWgt += $row["delivery_wgt"];
}
//echo $totalDeliveryWgt;
// Calculate the difference between 'wgt' and the total sum of 'delivery_wgt'
$calculatedStock = $inward["wgt"] - $row["delivery_wgt"];
echo $calculatedStock; 
// Display the calculated stock in your input field
echo '<input type="hidden" min="0" class="form-control calculated_stock" name="stock[]" data-row-id="some-id" value="' . $calculatedStock . '">';
?>


</td>

		  <td> <?php echo $totalDeliveryWgt ;?>
        <!--span class="delivery-wgt"></span-->
        <input type="hidden" min="0" class="form-control delivery-wgt" name="delivery_wgt[]" data-row-id="row<?= $i ?>" value="<?php echo $inward["delivery_wgt"]; ?>">
    </td>
			 <td>
        <input type="text"  class="form-control roll" name="roll[]"  value="">
    </td>
    <td>
        <input type="text" min="0" class="form-control entered-wgt" name="entered-wgt[]" data-row-id="row<?= $i ?>" value="">
    </td>

        </tr>
<?php
   $sno++;  
	//}
}
//mysqli_close($conn);
?>
</tbody>

</table>

<script>
    // Find all input elements with class 'entered-wgt' and 'delivery-wgt'
    const enteredWgtInputs = document.querySelectorAll('input.entered-wgt');
    const deliveryWgtInputs = document.querySelectorAll('input.delivery-wgt');

    // Add input event listeners to automatically copy the value
    enteredWgtInputs.forEach(function (enteredWgtInput) {
        enteredWgtInput.addEventListener('input', function () {
            // Find the corresponding delivery-wgt input field with the same data-row-id
            const dataRowId = enteredWgtInput.getAttribute('data-row-id');
            const deliveryWgtInput = document.querySelector(`input.delivery-wgt[data-row-id="${dataRowId}"]`);

            // Copy the value from entered-wgt to delivery-wgt
            if (deliveryWgtInput) {
                deliveryWgtInput.value = enteredWgtInput.value;
            }
        });
    });
</script>
								
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Add an input event listener to each input field with class 'entered-wgt'
    const enteredWeightInputs = document.querySelectorAll('.entered-wgt');

    enteredWeightInputs.forEach(input => {
        input.addEventListener('input', () => {
            // Get the parent row of the input field
            const parentRow = input.closest('tr');

            // Get the elements within the same row
            const wgtCell = parentRow.querySelector('.wgt-display');
            const calculatedStockCell = parentRow.querySelector('.calculated_stock');

            // Get the original weight (wgt) from the 'wgt-display' cell
            const originalWeight = parseFloat(wgtCell.textContent);

            // Get the entered weight as a float, or 0 if it's not a valid number
            const enteredWeight = parseFloat(input.value) || 0;

            // Calculate the balance weight (balance_wgt)
            const balanceWeight = originalWeight - enteredWeight;

            // Update the 'calculated_stock' cell with balance_wgt
            calculatedStockCell.textContent = balanceWeight.toFixed(2);
            calculatedStockCell.setAttribute('data-total-weight', balanceWeight.toFixed(2));

            // Debugging: Log the entered and calculated values
            console.log('Entered Weight:', enteredWeight);
            console.log('Original Weight:', originalWeight);
            console.log('Balance Weight:', balanceWeight);
        });
    });
});


</script>


								</div>
								<div class="card" style="width:100%">
								
	<div class="border-top">
										<div class="card-body" style="margin-left: 400px;">
											<button type="submit" name="save" class="btn btn-success" >Save</button>
											<button type="reset" class="btn btn-primary">Reset</button>
										</div>
		
									</div>
									
								</div>
								</form>
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
	});

	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
		if(UsrStatus){
			$('#delete_'+ID).hide();
		}
	  }
	</script>

</body>
</html>