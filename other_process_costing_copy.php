<?php
include('includes/config.php');

if ($_SESSION['userid'] == '') {
    echo "<script>window location.href='login.php';</script>";
}

if ($_GET['id'] != '') {
    $id = $_GET['id'];
} else {
    $id = $_REQUEST['costing_no'];
}

if (isset($_POST['save'])) {
    $id = $_REQUEST['costing_no'];

    extract($_POST);

    // Delete existing data related to the costing entry
    $deleteQuery = mysqli_query($zconn, "DELETE FROM other_costing WHERE costing_no = '$id'");
    $deleteListQuery = mysqli_query($zconn, "DELETE FROM other_costing_list WHERE costing_no = '$id'");

    // Insert data into other_costing_list
    $insertListQuery = mysqli_query($zconn, "INSERT INTO other_costing_list (costing_no, order_no, style_no, total, created_by, created_date, buyer)
        VALUES ('$costing_no', '$order_no', '$style_no', '$total_amount', '$_SESSION[userid]', NOW(), '$buyer')");

    $fabric_name_count = count($fabric_name); // Get the number of sets

    // Loop through each unique combination of costing_no, fabric_name, and process_name
for ($i = 0; $i < $fabric_name_count; $i++) {
    $current_costing_no = $costing_no;
    $current_fabric_name = $fabric_name[$i];
    $current_process_name = $process_name[$i];
    $current_wgt = $wgt[$i];
    $current_rate = $rate[$i];
    $current_total = $total[$i];
	
	echo "Current Rate: " . $current_rate;


    // Get the weight based on your conditions
    $selCostQuery = mysqli_query($zconn, "SELECT 
	consumption_percent, 
	pcs_weight 
        FROM costing_entry_details 
        WHERE fabric_name = '$current_fabric_name' AND costing_id = '$current_costing_no'");

    $selCost = mysqli_fetch_array($selCostQuery, MYSQLI_ASSOC);
    $weight = $selCost['pcs_weight'];

    // Check if a record with the same combination of costing_no, fabric_name, and process_name already exists
    $sel_check = mysqli_query($zconn, "SELECT * FROM other_costing 
        WHERE fabric_name = '$current_fabric_name' AND process_name = '$current_process_name' AND costing_no = '$current_costing_no'");

    $count = mysqli_num_rows($sel_check);
	    $current_id = $count['id'];


    if ($count == 0) {
        // Insert a new record into other_costing
        $insert_fab_costing = mysqli_query($zconn, "INSERT INTO other_costing (costing_no, process_name, subprocess_name, weight, rate, rate_pcs, total, created_by, created_date, fabric_name, process_loss)
            VALUES ('$current_costing_no', '$current_process_name', '...', '$weight', '$current_rate', '" . ($current_rate * $weight) . "', '" . ($current_rate * $weight) . "', '$_SESSION[userid]', NOW(), '$current_fabric_name', '...')");
    } 
	else {
        // Update the existing record in other_costing
        $updateQuery = mysqli_query($zconn, "UPDATE other_costing SET 
            subprocess_name = '...', 
            weight = '$weight', 
            rate = '$current_rate', 
            rate_pcs = '" . ($current_rate * $weight) . "', 
            total = '" . ($current_rate * $weight) . "', 
            created_by = '$_SESSION[userid]', 
            created_date = NOW(), 
            process_loss = '...'
            WHERE  fabric_name = '$current_fabric_name' AND process_name = '$current_process_name'");
    }
}
	header('Location: other_costing_list.php'); 

}

$sel_entry1 = mysqli_fetch_array(mysqli_query($zconn, "SELECT * FROM `costing_entry_master` where id = '$id'"), MYSQLI_ASSOC);
$costing_date_arr = explode("-", $sel_entry1['costing_date']);
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
    <title><?php echo SITE_TITLE;?> - Other Process Costing Entry</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">

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
        <?php  include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- Bread crumb and right sidebar toggle -->
                          <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Other Process Costing Entry</h4>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="costing.php"> <button type="button" class="btn btn-info">Costing Process</button></a>
						<div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item " aria-current="page">Merch</li>
									<li class="breadcrumb-item " aria-current="page"><a href="costing.php">Costing</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="other_costing_list.php" >Other Process Costing List</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Sales chart -->
				<form name="other_process" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
								<div class="card-body" style="width:100%">
									<div class="card-body" style="width:100%">
										<div class="card" style="width:50%; float:left; left: 50px; ">
											<div class="form-group row">
												<label for="fname" class="col-sm-3 text-right control-label col-form-label">Costing No</label>
												<div class="col-sm-6">
													<select data-placeholder="Begin typing a name to filter..." 
											
											class="select2 form-control custom-select chosen-select" 
													onchange="this.form.submit();" name="costing_no" id="costing_no">
													<!--	<option value="<?php echo $id;?>"><?php echo $id;?></option>-->
										<option>Select</option>
										
												<?php if($_REQUEST['id']==''){
						$sel_costing = mysqli_query($zconn,"select * from costing_entry_master where id NOT IN(select costing_no from other_costing_list) ");
												} else {
							$sel_costing = mysqli_query($zconn,"select * from costing_entry_master where id IN(select costing_no from other_costing_list) ");						
												}
														
														
														
										while($res_costing = mysqli_fetch_array($sel_costing,MYSQLI_ASSOC)){

											if($_REQUEST['costing_no']!=''){
												 $cost_id = $_REQUEST['costing_no'];
											} else {
												$cost_id = $_REQUEST['id'];
											}
											
											if($res_costing['id']==$cost_id){
										?>
										<option selected value="<?php echo $res_costing['id'];?>"><?php echo $res_costing['costing_no'];?></option>
										<?php } else  { ?>
										<option value="<?php echo $res_costing['id'];?>">
										<?php echo $res_costing['costing_no'];?> - (<?php echo $res_costing['order_no'];?>)</option>
										<?php } ?>
										<?php } ?>
											</select>
											<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</div>
											</div>
											<div class="form-group row">
												<?php
												$sel_c = mysqli_fetch_array(mysqli_query($zconn,"select * FROM `costing_entry_master` where id='".$id."'"),MYSQLI_ASSOC);
												?>
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Indent No</label>
												<div class="col-sm-6">

											<?php if($_REQUEST['costing_no']!=''){?>
												<input type="text" class="form-control" readonly id="lname" name="order_no"  placeholder="" value="<?php echo $sel_entry1['order_no'];?>">
											<?php } else{
													?>
													<input type="text" class="form-control" readonly id="lname" name="order_no" placeholder="" value="<?php echo $sel_c['order_no'];?>">
											<?php } ?>
												</div>
											</div>
											<div class="form-group row">
												<h4 class="page-title"><b>Component Details:</b></h4>
											</div>
										</div>
										<div class="card" style="width:50%; float:left; right: 50px;">
											<div class="form-group row">
												<label for="fname" class="col-sm-3 text-right control-label col-form-label">Buyer name</label>
												<div class="col-sm-6">
													<?php 
													$sel_cos = mysqli_fetch_array(mysqli_query($zconn,"select * FROM `costing_entry_master` where id='".$id."'"),MYSQLI_ASSOC);
													$buyer_id=$sel_cos['buyer_id'];
													$buyer_sql = mysqli_fetch_array(mysqli_query($zconn,"select * from buyer_master where buyer_id='".$buyer_id."'"));
													?>
													<?php if($_REQUEST['costing_no']!=''){
														$sel_buyer = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM  `buyer_master` where buyer_id='".$sel_entry1['buyer_id']."'"),MYSQLI_ASSOC);

														?>
												<input type="text" class="form-control" readonly id="lname" name="buyer" value="<?php echo $sel_buyer["buyer_name"];?>">
											<?php } else{
													?>
													<input type="text" class="form-control" readonly id="lname" name="buyer" value="<?php echo $buyer_sql['buyer_name'];?>">
											<?php } ?>
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style Code</label>
												<div class="col-sm-6">
													<?php if($_REQUEST['costing_no']!=''){?>
												<input type="text" class="form-control" readonly id="lname" name="style_no" value="<?php echo $sel_entry1['style_no'];?>">
											<?php } else { ?>
													<input type="text" class="form-control" readonly id="lname" name="style_no" value="<?php echo $sel_c['style_no'];?>">
											<?php } ?>
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Order Date</label>
												<div class="col-sm-6">
											<input type="date" class="form-control" id="cono1" value="<?php echo date('Y-m-d'); ?>">
												</div>
											</div>

										</div>
										<table  class="table">
											<thead style="background-color: #351a1aa6; color: #fff; padding: 0px; font-size: 16px;">
												<tr>
													<th>Fabric Name</th>
													<th>Component</th>
													<th>Pcs
														/Weight</th>	
													<th>UOM</th>
												</tr>
											</thead>
										<tbody>
								<?php
if ($_REQUEST['costing_no'] != "") {
    $cos_no = $_REQUEST['costing_no'];
} else {
    $cos_no = $id;
}
$sel_cost = mysqli_query($zconn, "SELECT * FROM costing_entry_details WHERE costing_id='" . $cos_no . "'");
while ($res_costing = mysqli_fetch_array($sel_cost, MYSQLI_ASSOC)) {
    ?>
    <tr id="example2">
        <td>
            <input type="text" class="form-control" id="fname" readonly value="<?php echo $res_costing['fabric_name']; ?>">
        </td>
        <td>
            <input type="text" class="form-control" id="fname" readonly value="<?php echo $res_costing['comp_id']; ?>">
        </td>
        <td>
            <input type="text" class="form-control" id="fname" readonly value="<?php echo number_format($res_costing['pcs_weight'], 3); ?>">
        </td>
        <td>
            <input type="text" class="form-control" id="fname" readonly value="<?php echo $res_costing['uom_id']; ?>">
        </td>
    </tr>
<?php
}
?>

											</tbody>
										</table>
									</div>
									<h4 class="page-title"><b>Material Details</b></h4>
										<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th style="width: 15%">Fabric Name</th>
												<th style="width: 15%">Process Name</th>
												<th style="width: 15%">Subproces Name</th>
												<th style="width: 11%">Weight</th>
												<th style="width: 11%">Rate/Kg</th>
												<th style="width: 11%">Rate/PC</th>
												<th style="width: 11%">Total</th>
												<!--<th style="width: 10%;">Process Loss</th>-->
												<th style="width: 10%;"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
									<tbody>

									<?php 
										$totalwgt=0;
										$total_rate = 0;
										$totalloss=0;
	
$sel_costing1 = mysqli_query($zconn, "SELECT costing_no, process_name, subprocess_name, GROUP_CONCAT(fabric_name)
 as fabric_name, SUM(weight) as weight, MAX(rate) as rate, SUM(rate_pcs) as rate_pcs, SUM(total) as total, 
 MAX(process_loss) as process_loss FROM `other_costing` WHERE costing_no = '$id' GROUP BY costing_no,process_name,fabric_name");
										$rows_costing1 = mysqli_num_rows($sel_costing1);

										if($rows_costing1>0){ ?>
										<?php 
										$f = 0;
										while($res_costing1 = mysqli_fetch_array($sel_costing1,MYSQLI_ASSOC)){

									?>
											<tr id="delete_1">
												<td>
													<select  data-placeholder="Begin typing a name to filter..." 
											 
											class="select2 form-control custom-select chosen-select"  data-no="<?php echo $f; ?>" name="fabric_name[]" id="fabric_name<?php echo $f; ?>" onchange="fabric(this);">
														<?php $fabrics = explode(",",$res_costing1['fabric_name']); ?>

														<?php 
												$sel_cost_details1 = mysqli_query($zconn,"select distinct(fabric_name)as fabric_name from costing_entry_details WHERE `costing_id` ='".$id."'");
												while($res_det1 = mysqli_fetch_array($sel_cost_details1,MYSQLI_ASSOC)) {
													if(in_array($res_det1['fabric_name'], $fabrics)) 
													{
														$selected = "selected";
													} else {
														$selected = "";
													}
												?>
														<option value="<?php echo $res_det1['fabric_name'];?>" <?php echo $selected; ?>><?php echo $res_det1['fabric_name'];?></option>
														<?php } ?>
													</select>
												</td>

												<td>
													<select data-placeholder="Begin typing a name to filter..." 
											 
											class="form-control  custom-select" id="process_name<?php echo $f; ?>" data-no="<?php echo $f; ?>" name="process_name[]" onchange="sel_sub(this);">
														<option value="">Select</option>
													<?php $sel_process = mysqli_query($zconn,"select * from process_master where status='0'"); 

													while($res_process = mysqli_fetch_array($sel_process,MYSQLI_ASSOC)){
														if( $res_process['process_name'] == $res_costing1["process_name"]) {
                                                             $process_selected = "selected";
														} else {
															$process_selected  = "";
														}
													?>
													<option value="<?php echo $res_process['process_name'];?>" <?php echo $process_selected; ?>><?php echo $res_process['process_name'];?></option>
													<?php } ?>
													</select>
													<?php 
													if(count($fabrics) > 1) {
													?>
													<select style="display:none" data-placeholder="Begin typing a name to filter..." 
											
											class="select2 form-control custom-select chosen-select" id="process_name_hidden<?php echo $f; ?>" data-no="<?php echo $f; ?>" name="process_name[]" onchange="sel_sub(this);">
													<?php  
	$sel_process = mysqli_query($zconn,"select * from process_master where status='0'"); 
	while($result_process = mysqli_fetch_array($sel_process,MYSQLI_ASSOC)){
	if( $result_process['process_name'] == $res_costing1["process_name"]) {
		$process_selected = "selected";
	} else {
		$process_selected  = "";
	}
		?>
		<option value="">Select</option>
		<option value="<?php echo $result_process['process_name'];?>" <?php echo $process_selected; ?>><?php echo $result_process['process_name'];?></option>
		<?php } ?>
		</select>
		<?php
		}
		?>
	</td>
	<td>
	<span>
	<?php
		$sel_sub=mysqli_query($zconn,"select * from sub_process where process_name='".$res_costing1["process_name"]."'");
		while($res_sub = mysqli_fetch_array($sel_sub,MYSQLI_ASSOC)){
		$sub_id = $res_sub['id'];
		$sub_name = $res_sub['sub_process_name'];
		if($res_costing1['subprocess_name'] == $sub_id) {
		$sel_sub = "selected";
		} else {
		$sel_sub = "";
		}

	$sublist ="<option value='".$sub_id."'  ".$sel_sub." >".$sub_name."</option>";
	}
	?>
	<select data-placeholder="Begin typing a name to filter..." 
											 
											class="select2 form-control custom-select chosen-select" id="sub_list<?php echo $f; ?>" name="subprocess_name[]"   data-no="<?php echo $f; ?>" style="">
	<option value="">Select</option>
		<?php echo $sublist; ?>
	</select>
							<?php
							if(count($fabrics) > 1) {
							?>
							<select style="display:none" class="select2 form-control custom-select chosen-select" id="sub_list_hidden<?php echo $f; ?>" name="subprocess_name[]"   data-no="<?php echo $f; ?>" style="">
							<option value="">Select</option>
							<?php echo $sublist; ?>
							</select>
							<?php } $sublist = ""; ?>
						
						</span>
					</td>
					<td>
						<?php
						if($_REQUEST['id']!=''){
							$ro = "readonly";
						} else {
							$ro = "";
						}
						?>
							<input type="text" readonly class="form-control wgt" value="<?php  echo  number_format($res_costing1['weight'],2); $totalwgt+= $res_costing1['weight']; ?>"  data-no="<?php echo $f; ?>" id="wgt_<?php echo $f; ?>" name="wgt[]" <?php echo $ro;?> placeholder="Weight" onkeyup="rate_cal(<?php echo $f; ?>);" onblur="rate_cal(<?php echo $f; ?>);">
							<?php
							if(count($fabrics) > 1) {
							?>
							<input type="text" style="display:none" readonly class="form-control wgt" value="<?php  echo $res_costing1['weight']; $totalwgt;?>"  data-no="<?php echo $f; ?>" id="wgt_hidden<?php echo $f; ?>" name="wgt[]" <?php echo $ro;?> placeholder="Weight" onkeyup="rate_cal(<?php echo $f; ?>);" onblur="rate_cal(<?php echo $f; ?>);">
							<?php } ?>
					</td>
					<td>
						   <input type="text" class="form-control rate"  value="<?php  echo $res_costing1['rate'];?>" placeholder="Rate/Kg" id="rate<?php echo $f; ?>" name="rate[]"  onkeyup="rate_cal(<?php echo $f; ?>);" onblur="rate_cal(<?php echo $f; ?>);" >
						   <?php if(count($fabrics) > 1) {
							?>
						   <input type="text" style="display:none" class="form-control rate"  value="<?php  echo $res_costing1['rate'];?>" placeholder="Rate/Kg" id="rate_hidden<?php echo $f; ?>" name="rate[]"  onkeyup="rate_cal(<?php echo $f; ?>);" onblur="rate_cal(<?php echo $f; ?>);" >
						   <?php } ?>
					</td>
					<td>
					<input type="text" class="form-control" value="<?php  echo $res_costing1['rate_pcs'];?>" data-no="<?php echo $f; ?>" id="rate_pcs<?php echo $f; ?>" name="rate_pcs[]" placeholder="Rate/Pcs">

					<?php if(count($fabrics) > 1) { ?>
							<input type="text" style="display:none"  class="form-control" value="<?php  echo $res_costing1['rate_pcs'];?>" data-no="<?php echo $f; ?>" id="rate_pcs_hidden<?php echo $f; ?>" name="rate_pcs[]" placeholder="Rate/Pcs">
							<?php } ?>
					</td>
					<td>
					<input type="text" class="form-control total" data-no="<?php echo $f; ?>" id="total<?php echo $f; ?>" value="<?php  echo $res_costing1['total'];$total_rate +=$res_costing1['total'];?>" name="total[]" readonly placeholder="Total">

					<?php if(count($fabrics) > 1) { ?>

							<input type="text" style="display:none"  class="form-control total" data-no="<?php echo $f; ?>" id="total_hidden<?php echo $f; ?>" value="<?php  echo $res_costing1['total'];$total_rate;?>" name="total[]" readonly placeholder="Total">
							<?php } ?>
					
					</td>
					<!--<td>
					<input type="text" class="form-control proloss" value="<?php  echo $res_costing1['process_loss'];$totalloss +=$res_costing1['process_loss'];?>" onkeyup="proloss();" id="process_loss<?php echo $f; ?>" name="process_loss[]" placeholder="Process Loss" >
					<?php if(count($fabrics) > 1) { ?>

							<input type="text" style="display:none" class="form-control proloss" value="<?php  echo $res_costing1['process_loss'];$totalloss +=$res_costing1['process_loss'];?>" onkeyup="proloss();" id="process_loss_hidden<?php echo $f; ?>" name="process_loss[]" placeholder="Process Loss" >
							<?php } ?>
					
					</td>-->
					<td>
						<a class="delete-row" title="Delete"><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a>
					</td>
				</tr>

			<?php $f++; } ?>
			<?php } ?>
			</tbody>
										</table>
						<table id="example1" class="table table-striped table-bordered">
											<tr id="delete_0">
<td style="width: 15%" >&nbsp;</td><td style="width: 15%">&nbsp;</td><td style="width: 15%">&nbsp;</td><td style="width: 11%">&nbsp;</td><td style="width: 11%">&nbsp;</td>

												
												<td style="width: 11%"><h6 class="page-title">Total Rate:</h6></td>
												<td style="width: 11%"><input type="text" name="total_amount" class="form-control" id="total_rate" value="<?php echo $total_rate;?>" readonly placeholder="" style="border: 1px solid #000;"></td>
												<td style="width: 10%">&nbsp;</td>
											</tr>

									</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 450px;">
									<button type="submit" name="save" class="btn btn-success">Save</button>
									<button type="submit" class="btn btn-primary">Reset</button>
									<a href="other_costing_list.php"><button type="button" class="btn btn-danger">List</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
            </div>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
			</form>
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
		<br>
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
	<link rel="stylesheet" href="assets/extra-libs/bootstrap-multiselect/dist/css/bootstrap-multiselect.css" type="text/css">
	<script type="text/javascript" src="assets/extra-libs/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<script src="dist/js/bootstrap-datepicker.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

	

<script>
	function fabric(id){
		var datano = $(id).data('no');
		var	fabric_name =$(id).val();
		var	costing_no =$("#costing_no").val();
		var index = $("#example tbody tr:last-child").index();
		var id=parseInt(index)+parseInt(1);

		$.ajax({
			type: 'POST',
			url:'ajax/dye_weight.php',
			data: {fabric_name:fabric_name,costing_no:costing_no},
			success:function(data){
				alert(data);
			$('#wgt_'+datano).val(data);
			}
		});

	}

	function proloss(obj){

		loss=0;
		$('.proloss').each(function(){
			if($(obj).val() != "" && $(obj).is(":visible")) {
				loss += parseFloat($(obj).val());
			}
		});
		$("#process_loss_hidden"+$(obj).attr('id').slice(-1)).val(obj.value);

		$('#tot_loss').val(loss);		
	}



	function rate_cal(id){
		var weig = 0;
		var sm=0;
		var cons = $('#wgt_'+id).val();
		var rat = $('#rate'+id).val();
		var ctrws=0;
		if(rat){
			ctrws = parseFloat(cons)*parseFloat(rat);
		} 
		$('#rate_pcs'+id).val(ctrws);
		$('#total'+id).val(ctrws);

		$('.wgt').each(function(e){
			if($(this).attr('style') != "display:none"){
				weig = parseFloat($(this).val());
			}
		 });

		 $('.total').each(function(){
			if($(this).attr('style') != "display:none"){
				sm = parseFloat($(this).val());
			}
		 });
		$('#total_wgt').val(weig.toFixed(2));
		$('#total_rate').val(sm.toFixed(2));

		if($("#fabric_name"+id).val().length > 1) {
			if($("#process_name_hidden"+id).length) {
				$("#process_name_hidden"+id).remove();
			}
			$("#process_name"+id).clone().prependTo("#process_name"+id).hide().prop('id', 'process_name_hidden'+id ).val($("#process_name"+id).val());

			if($("#sub_list_hidden"+id).length) {
				$("#sub_list_hidden"+id).remove();
			}
			$("#sub_list"+id).clone().prependTo("#sub_list"+id).hide().prop('id', 'sub_list_hidden'+id ).val($("#sub_list"+id).val());
			if($("#wgt_hidden"+id).length) {
				$("#wgt_hidden"+id).remove();
			}
			$("#wgt_"+id).clone().prependTo("#wgt_"+id).hide().prop('id', 'wgt_hidden'+id );
			
			if($("#rate_hidden"+id).length) {
				$("#rate_hidden"+id).remove();
			}
			$("#rate"+id).clone().prependTo("#rate"+id).hide().prop('id', 'rate_hidden'+id );
			
			if($("#rate_pcs_hidden"+id).length) {
				$("#rate_pcs_hidden"+id).remove();
			}
			$("#rate_pcs"+id).clone().prependTo("#rate_pcs"+id).hide().prop('id', 'rate_pcs_hidden'+id );
			
			if($("#total_hidden"+id).length) {
				$("#total_hidden"+id).remove();
			}
			$("#total"+id).clone().prependTo("#total"+id).hide().prop('id', 'total_hidden'+id );
			
			if($("#process_loss_hidden"+id).length) {
				$("#process_loss_hidden"+id).remove();
			}
			$("#process_loss"+id).clone().prependTo("#process_loss"+id).hide().prop('id', 'process_loss_hidden'+id ).val($("#process_loss"+id).val());
	
		}
	}
</script>
	<script type="text/javascript">
	function sel_sub(pname){
		 var data_no = $(pname).data('no');
		 var pr_name = $(pname).val();
	 $.ajax({
		url : 'ajax/process.php',
		type: 'POST',
		data: '&pr_name='+pr_name+'&action=list_subprocess',
		success: function(data){
			$('#sub_list'+data_no).html(data);
			$('#sub_list_hidden'+data_no).html(data);
		}
		});
	}

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#example td:last-child").html();
	$('.mdb-select').multiselect();


	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		// $.getScript("https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js", function() {    
		// });
	//	$(this).attr("disabled", "disabled");	
		var index = $("#example tbody tr:last-child").index();
		if($("#example tbody tr").length == 0) {
			var id=parseInt(index)+parseInt(1);
		} else {
			var id = parseInt($("#example tbody tr:last-child td select").data('no')) + 1;
		}
        var row = '<tr>' +'<td><select multiple="multiple" data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select" data-no="'+id+'" name="fabric_name[]" id="fabric_name'+id+'" onchange="fabric(this);"> <?php if ($_REQUEST['costing_no']=='') { echo "gjgjgj";  $sel_cos1 = mysqli_fetch_array(mysqli_query($zconn,"select * FROM `costing_entry_master` where id='".$id."'"),MYSQLI_ASSOC);$sel_cost_details1 = mysqli_query($zconn,"select distinct(fabric_name)as fabric_name from costing_entry_details WHERE `costing_id` ='".$sel_cos1['id']."'");while($res_det1 = mysqli_fetch_array($sel_cost_details1,MYSQLI_ASSOC)){ ?><option value="<?php echo $res_det1['fabric_name'];?>"><?php echo $res_det1['fabric_name'];?></option><?php } }else{ $sel_cos1 = mysqli_fetch_array(mysqli_query($zconn,"select * FROM `costing_entry_master` where id='".$_REQUEST['costing_no']."'"),MYSQLI_ASSOC);$sel_cost_details1 = mysqli_query($zconn,"select distinct(fabric_name)as fabric_name from costing_entry_details WHERE `costing_id` ='".$sel_cos1['id']."'");while($res_det1 = mysqli_fetch_array($sel_cost_details1,MYSQLI_ASSOC)) { ?><option value="<?php echo $res_det1['fabric_name'];?>"><?php echo $res_det1['fabric_name'];?></option><?php } }?></select> </td>'+'<td><select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select" name="process_name[]" data-no="'+id+'" id="process_name'+id+'" onchange="sel_sub(this);"><option value="">Select</option><?php $sel_process = mysqli_query($zconn,"select * from process_master where status='0'"); while($res_process = mysqli_fetch_array($sel_process,MYSQLI_ASSOC)){?><option value="<?php echo $res_process['process_name'];?>"><?php echo $res_process['process_name'];?></option><?php } ?></select></td>' +'<td><span><select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select" id="sub_list'+id+'" name="subprocess_name[]" style=""><option>Select</option></select></span></td>' +
				
			'<td><input type="text" class="form-control"  id="wgt_'+id+'" placeholder="Weight" name="wgt[]" onkeyup="rate_cal('+id+');" onblur="rate_cal('+id+');"></td>' +
            '<td><input type="text" class="form-control" id="rate'+id+'" name="rate[]" placeholder="Rate" onkeyup="rate_cal('+id+');" onblur="rate_cal('+id+');"></td>' +
            '<td><input type="text" class="form-control" id="rate_pcs'+id+'" name="rate_pcs[]" placeholder="Rate/Pcs"></td>' +
            '<td><input type="text" class="form-control total" id="total'+id+'" name="total[]" readonly placeholder="Total"></td>' +
            // '<td><input type="text" class="form-control proloss " id="process_loss'+id+'" onkeyup="proloss(this);" name="process_loss[]"  placeholder="Process Loss"></td>'+
			'<td><a class="delete-row" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a></td>' +'</tr>';
			
			$("#example").append(row);
		$("#example tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
		$('.mdb-select').multiselect();
		$(".chosen-select").chosen({no_results_text: "Oops, nothing found!"})
	
    });
	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
		//	if(!$(this).val()){
		//		$(this).addClass("error");
		//		empty = true;
		//	} else{
        //        $(this).removeClass("error");
        //    }
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});			
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete-row", function(){
		// $(this).closest("tr.mdb-select").remove();

        $(this).closest("tr").remove();
		$(".add-new").removeAttr("disabled");
    });
});

$('#order_date').datepicker({
	format:'dd-mm-yyyy',
      autoclose: true
    })
</script>
</body>
</html>