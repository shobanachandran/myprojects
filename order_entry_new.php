<?php
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_REQUEST);
print_r($_FILES);
echo "</pre>";*/

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(0);
if(isset($_POST['save_costing'])){
	// var_dump($_POST);
	// exit;
	$shipment_date = $_POST['shipment_date'];
	// $shipment_date = $ship_date_arr['2']."-".$ship_date_arr['1']."-".$ship_date_arr['0'];

	$delivery_date = $_POST['delivery_date'];
	// $delivery_date = $del_date_arr['2']."-".$del_date_arr['1']."-".$del_date_arr['0'];
	if($_POST['cutting_quantity_type'] == "Percentage") {
		// $cutting_quantity = $_REQUEST['order_qty'] + ($_REQUEST['order_qty'] * $_REQUEST['excess_per']/100);
		$excess_per = $_REQUEST['excess_per'];
	} else if ($_POST['cutting_quantity_type'] == "Value") {
		// $cutting_quantity = $_POST['cutting_qty'];
		$excess_per = '';
	} else {
		$excess_per = '';
		// $cutting_quantity = '';
	}
	//print_r($_POST);
	//exit();
$order_master = mysqli_query($zconn, "INSERT INTO order_entry_master (
    order_no, costing_no, combo_colour, size_group, buyer_name, style_no,
    po_no, season, shipment_date, factory_delivery, order_qty, excess_percent,
    excess_pcs, created_by, created_date, uom, description
) VALUES (
    '" . $_REQUEST['orer_no'] . "', '" . $_REQUEST['costing_no'] . "', '', 
    '" . $_REQUEST['size_group'] . "', '" . $_REQUEST['buyer_name'] . "',
    '" . $_REQUEST['style_no'] . "', '" . $_REQUEST['po_no'] . "',
    '" . $_REQUEST['season_name'] . "', '" . $shipment_date . "',
    '" . $_REQUEST['factory_delivery'] . "', '" . $_REQUEST['order_qty'] . "',
    '" . $excess_per . "', '', '" . $_SESSION['userid'] . "', NOW(),
    '" . $_REQUEST['uom'] . "', '" . $_REQUEST['description'] . "'
)");


	if($order_master){
		$last_insert_id = mysqli_insert_id($zconn);
 if (!empty($_FILES['order_image']['tmp_name'])) {
			$source1 = $_FILES['order_image']['tmp_name'];
			$upload1 =$_FILES['order_image']['name'];
			$original_complogos1 = "uploads/orders/".$upload1;
			$enqUpload = move_uploaded_file($source1, $original_complogos1);
			$filepath = "uploads/orders/".$upload1;
			if($enqUpload){
				$updatestatus = mysqli_query($zconn,"UPDATE order_entry_master SET order_image = '".$filepath."' WHERE order_id = '".$last_insert_id."'");
			}
 }

		$order_qty_count = count($_REQUEST['order_colour']);
		$order_colour = $_REQUEST['order_colour'];
		$order1_sizes = count($_REQUEST['size_ids1']);
		for($ts=0;$ts<$order_qty_count;$ts++){
			for($tb=0;$tb<$order1_sizes;$tb++){
				$szeid = $_REQUEST['size_ids1'][$tb];
				$order_child = mysqli_query($zconn,"insert into order_quantity_details(order_id,order_no,po_no,row_id,color,size_id,qty_val) values('".$last_insert_id."','".$_REQUEST['orer_no']."','".$_REQUEST['po_no']."','".$ts."','".$order_colour[$ts]."','".$szeid."','".$_REQUEST['order_sizes'.$szeid][$ts]."')");
			}
		}

		$cutting_qty_count = count($_REQUEST['cutting_colour']);
		$cutting_colour = $_REQUEST['cutting_colour'];

		$order2_sizes = count($_REQUEST['size_ids2']);
		$total_cutting_qty_value = 0;
		for($ts=0;$ts<$cutting_qty_count;$ts++){
			for($tb=0;$tb<$order2_sizes;$tb++){
				$szeid = $_REQUEST['size_ids2'][$tb];
				$total_cutting_qty_value += $_REQUEST['cutting_sizes'.$szeid][$ts];			
				$order_child = mysqli_query($zconn,"insert into cutting_quantity_details(order_id,order_no,po_no,
				row_id,color,size_id,qty_val) values('".$last_insert_id."','".$_REQUEST['orer_no']."','".$_REQUEST['po_no']."',
				'".$ts."','".$cutting_colour[$ts]."','".$szeid."','".$_REQUEST['cutting_sizes'.$szeid][$ts]."')");
			}
		}
		$updatestatus = mysqli_query($zconn,"UPDATE order_entry_master SET 
		cutting_qty = ".$total_cutting_qty_value." WHERE order_id = '".$last_insert_id."'");

	}

	echo "<script>alert('Order entered successfully!!!');</script>";
	echo "<script>window.location.href='order_entry.php';</script>";

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
    <title><?php echo SITE_TITLE;?> - Order Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
	
	<style>
	.table td, .table th{padding:0px !important; font-size:14px;}
	</style>
</head>
<body>
    <div id="main-wrapper" data-sidebartype="mini-sidebar" class="mini-sidebar">
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
                        <h4 class="page-title">Order Entry Details</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
								<li class="breadcrumb-item"><a style="background-color:#626F80; color:#fff; color:#fff; margin:10px; padding:10px;" href="order_entry.php">Back  </a></li>
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Order Info</a></li>
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
	<form name="costing_entry" id="costing_entry" method="post" novalidate enctype="multipart/form-data">
		<input type="hidden" name="cost_no" id="cost_no" value="<?php echo $cost_no;?>">
		<input type="hidden" name="cost_id" id="cost_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
								<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px;">
								<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Costing No</label>
										<div class="col-sm-6">
											<select class="select2 form-control custom-select chosen-select" onchange="sel_details(this.value);" name="costing_no">
										<option value="">Select</option>
										<?php 
					$sel_costing = mysqli_query($zconn,"select * from costing_entry_master");
						while($res_costing = mysqli_fetch_array($sel_costing,MYSQLI_ASSOC)){
								if($res_costing['id']==$_REQUEST['costing_no']){ ?>
									<option selected value="<?php echo $res_costing['id'];?>"><?php echo $res_costing['costing_no'];?></option>
									<?php } else  { ?>
									<option value="<?php echo $res_costing['id'];?>">
									<?php echo $res_costing['costing_no'];?> - (<?php echo $res_costing['order_no'];?>)
								
								</option>
									<?php } ?>
								<?php } ?>
							</select>
										</div>
									</div>

									<!-- <div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Select Combo</label>
										<div class="col-sm-6" id="sel_combo_list">
											<select name="color" class="form-control">
											<option value="">--Select--</option>
											<?php //$sel_color = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$_REQUEST['costing_no']."'");
											// while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){
											// 	if($res_color['comp_group']==$_REQUEST['color']){
											?>
											<option selected value="<?php //echo $res_color['comp_group'];?>"><?php echo $res_color['comp_group'];?></option>
											<?php //} else { ?>
											<option value="<?php //echo $res_color['comp_group'];?>"><?php echo $res_color['comp_group'];?></option>

											<?php //} } ?>
											</select>
										</div>
									</div> -->
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Size Group</label>
										<div class="col-sm-6">
											<select name="size_group" class="select2 form-control custom-select chosen-select" onchange="this.form.submit();">
											<option value="">--Select--</option>
											<?php $sel_color = mysqli_query($zconn,"select * from size_groups");
											while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){
												if($res_color['size_group_name']==$_REQUEST['size_group']){
											?>
											<option selected value="<?php echo $res_color['size_group_name'];?>"><?php echo $res_color['size_group_name'];?></option>
												<?php } else { ?>
											<option value="<?php echo $res_color['size_group_name'];?>"><?php echo $res_color['size_group_name'];?></option>
											<?php } }?>
											</select>
										</div>
									</div>
									
									
		
    <!--div class="form-group row" id="colorFields">
		
        <label for="lname" class="col-sm-3 text-right control-label col-form-label">Colors</label>
		
        <div class="col-sm-6" id="colorInputs">
            <div class="input-group">
                <input type="text" class="form-control color-input" name="color" autocomplete="off" required placeholder="Enter color">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary add-color" type="button">+</button>
                </div>
            </div>
        </div>
   
</div-->
										


									<!--div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Colour Group</label>
										<div class="col-sm-6">
											<select name="color_group" class="select2 form-control custom-select chosen-select" onchange="this.form.submit();">
											<option value="">--Select--</option>
											<?php $sel_color = mysqli_query($zconn,"select * from color_groups");
											while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){
											if($res_color['color_group']==$_REQUEST['color_group']){
											?>
											<option selected value="<?php echo $res_color['color_group'];?>"><?php echo $res_color['color_group'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_color['color_group'];?>"><?php echo $res_color['color_group'];?></option>
											<?php  }
											} ?>
											</select>
											<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
										</div>
									</div-->
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Buyer Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="buyer_name" name="buyer_name" autocomplete="off" required placeholder="Buyer Name" value="<?php echo $_REQUEST['buyer_name'];?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Indent Number</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="order_no" name="orer_no" autocomplete="off" required placeholder="Indent Number" value="<?php echo $_REQUEST['orer_no'];?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style Code</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="style_no" name="style_no" autocomplete="off" required placeholder="Style Code" value="<?php echo $_REQUEST['style_no'];?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">PO No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="po_no" name="po_no" autocomplete="off" required placeholder="PO No" value="<?php echo $_REQUEST['po_no'];?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Order Image</label>
										<div class="col-sm-6">
											<input type="file" class="form-control" id="order_image" name="order_image" autocomplete="off" placeholder="Order Image">
										</div>
									</div>
								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
										<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Unit</label>
										<div class="col-sm-6">
									<select class="select2 form-control custom-select" name="uom" id="uom">
    <option value="">Select</option>
    <?php 
    $sql_uom = mysqli_query($zconn, "SELECT uom_name FROM uom_master WHERE status='0'");
    while ($res_uom = mysqli_fetch_array($sql_uom, MYSQLI_ASSOC)) {
        $selected = ($res_uom['uom_name'] == $res_cost_det['uom_id']) ? 'selected' : '';
    ?>
        <option value="<?php echo $res_uom['uom_name']; ?>" <?php echo $selected; ?>>
            <?php echo $res_uom['uom_name']; ?>
        </option>
    <?php } ?>
</select>

										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Season</label>
										<div class="col-sm-6">
										<select id="season" name="season" class="form-control">
												<option value="">Select</option>
    <option value="SS24">SS24</option>
	   <option value="SS24 ECOM">SS24 ECOM</option>
	   <option value="SS24 ECOM">AW24</option>
	   <option value="SS24 ECOM">SS23</option>
	   <option value="SS24 ECOM">AW23</option>
											</select>
										</div>
									</div>
									
									<div class="form-group row">
    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Description</label>
    <div class="col-sm-6">
        <textarea autocomplete="off" class="form-control" id="desc" name="description"></textarea>
</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Shipment Date</label>
										<div class="col-sm-6">
											<input type="date" autocomplete="off" class="form-control" id="shipment_date" name="shipment_date" value="<?php echo date('Y-m-d'); ?>" >

										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Factory Delivery Date</label>
										<div class="col-sm-6">
										<input type="date" autocomplete="off" class="form-control" id="delivery_date" name="factory_delivery" value="<?php echo date('Y-m-d'); ?>" >

										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Order Quantity</label>
										<div class="col-sm-6">
											
										<input type="text" autocomplete="off" required class="form-control" id="order_qty" name="order_qty" value="<?php echo $_REQUEST['order_qty'];?>" placeholder="Order Quantity">
											</div>
									</div>
												<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Cutting Quantity</label>
										<div class="col-sm-6">
													<input type="text" autocomplete="off" required class="form-control total-cutting-qty" id="cutting_qty" name="cutting_qty" value="<?php echo $_REQUEST['cutting_qty'];?>" placeholder="Cutting Quantity">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label"></label>
										<div class="col-sm-6">
											<input type="radio" onchange="show_cutting_quantity(this)" id="percentage" name="cutting_quantity_type" value="Percentage">
											<label for="male">Percentage(%)</label>
											<input type="radio" onchange="show_cutting_quantity(this)" id="value" name="cutting_quantity_type" value="Value">
											<label for="value">Manual</label>
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label"></label>
										<div class="col-sm-6">
										<input type="text" placeholder="Cutting Quantity in Value" style="display:none" autocomplete="off" required class="form-control" id="cutting_qty_value" name="cutting_qty" value="<?php echo $_REQUEST['cutting_qty'];?>" > 
										<input type="text" placeholder="Cutting Quantity in percentage"style="display:none" autocomplete="off" required class="form-control" id="excess_per" name="excess_per" onkeyup=cal_cutting_quantity(this) value="<?php echo $_REQUEST['excess_per'];?>" >
										</div>
									</div>
									
								</div>
							</div>
							
							
							
							<?php
							if($_REQUEST['size_group'] ) {
							?>
							<div class="col-md-9" style="float:left;"><h3>Enter Order Quantity</h3></div>
							<table id="example" class="order-table" border="0" style="width:100%;">
							<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												
												<th style="width:50px;">Colour</th>
							<?php 
								$size_sql = mysqli_query($zconn,"select * from size_groups where 
								size_group_name='".$_REQUEST['size_group']."'");

								//while($res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC)){
								$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
								$sizeids = explode(",",$res_size['size_ids']);
								for($ij=0;$ij<count($sizeids);$ij++){ ?>
									<th style="width:50px;">
										<input type="hidden" name="size_ids1[]" style="width:100px;" value="<?php echo $sizeids[$ij];?>">
										<input type="text" value="<?php echo $sizeids[$ij];?>" name="sizes1[]" 
										style="border:none; width:50px; background-color:#626F80; color:#fff; font-weight:bold;" readonly>
										
									</th>
												
								<?php } ?>
												
									<th style="width:50px;">
									 <button type="button" class="btn btn-info add-new-row"><i class="fa fa-plus"></i></button> 
									</th>
									
										</tr>
										</thead>
										<tbody>

											
											<?php 
												$sel_color = mysqli_query($zconn,"select * from color_groups where color_group='".$_REQUEST['color_group']."'");
												$res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC);
												$color_arr = explode(",",$res_color['color_ids']);
												$color_len = count($color_arr);
												for($co=0;$co<$color_len;$co++){
												$sql_color1 = mysqli_fetch_array(mysqli_query($zconn,"select * from color_master where id='".$color_arr[$co]."'"),MYSQLI_ASSOC);
												?>
												<tr><td>
													<!--input type="text"  name="order_colour[]"  value="<?php echo $sql_color1['colour_name'];?>"-->
												<select name="order_colour[]" class="select2 form-control custom-select chosen-select" style="width:100px;">

												<option value="">--Select--</option>
    <?php
    // Assuming you have a database connection established

    // Replace 'your_database_name' with your actual database name
    $sql = "SELECT * FROM color_master WHERE status = '0'";
    $result = mysqli_query($zconn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Fetch color_name from the database and set the option value
            $colorName = $row['colour_name'];
            echo "<option value=\"$colorName\">$colorName</option>";
        }
    } else {
        echo "<option value=\"\">No colors found</option>";
    }
    ?>
</select>
</td>
												
													<?php
													for($ij=0;$ij<count($sizeids);$ij++){	?>
														<td>
					
														<input type="text" name="order_sizes<?php echo $sizeids[$ij];?>[]" style="width:100px;" class="orderqty" onkeyup="cal_orderqty(this);cal_orderqty2(this);cal_total_cutting_qty();" onchange="">

														</td>
														
													<?php } ?>
												
													<td class="total-sum1"></td>
													<!--input type="number" name="total_sum_value<?php echo $sizeids[$ij];?>[]" id="" class="form-control order-total-sum"  readonly /-->

													</td>
														<td style="width:50px;"><a class="delete" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a>
														</td>
														<script>
				function cal_orderqty2(input) {
    // Logic to calculate the sum of cutting sizes for this row
    var row = input.parentNode.parentNode; // Get the parent row of the input field
    var inputs = row.querySelectorAll('.orderqty'); // Select all cutting size input fields in this row
    var sum = 0;
    
    inputs.forEach(function(inputField) {
        // Assuming the cutting size input fields contain numerical values
        var value = parseFloat(inputField.value) || 0; // Get the numerical value or default to 0
        sum += value; // Sum up the values
    });
    
    // Update the total-sum cell in this row with the calculated sum
    row.querySelector('.total-sum1').textContent = sum;
}

			</script>
																				<script>
				function cal_orderqty4(input) {
    // Logic to calculate the sum of cutting sizes for this row
    var row = input.parentNode.parentNode; // Get the parent row of the input field
    var inputs = row.querySelectorAll('.cuttingqty'); // Select all cutting size input fields in this row
    var sum = 0;
    
    inputs.forEach(function(inputField) {
        // Assuming the cutting size input fields contain numerical values
        var value = parseFloat(inputField.value) || 0; // Get the numerical value or default to 0
        sum += value; // Sum up the values
    });
    
    // Update the total-sum cell in this row with the calculated sum
    row.querySelector('.total-sum4').textContent = sum;
}

			</script>
															
												</tr>
		

											<?php } ?>
										
					</tbody>
			</table>
			<div  class="col-md-9" style="float:left;"><h3>Enter Cutting Quantity</h3></div>
				<table id="example1" class="cutting_quantity_details cutting-table" border="0" style="width:100%;">
						<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
					<tr>
						<th style="width:50px;">Colour</th>
		<?php
			$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$_REQUEST['size_group']."'");
			$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
			$sizeids = explode(",",$res_size['size_ids']);
			for($ij=0;$ij<count($sizeids);$ij++){
		 ?>
				<th style="width:50px;">
				<input type="hidden" name="size_ids2[]" style="width:100px;" value="<?php echo $sizeids[$ij];?>">
				<input type="text" value="<?php echo $sizeids[$ij];?>" style="border:none; width:50px; background-color:#626F80; color:#fff; font-weight:bold;" readonly ></th>
			<?php } ?>
				<th style="width:50px;">
				
				</th>
				<th style="width:50px;">
			
				</th>
			</tr>
		</thead>
		<tbody>
		<?php $sel_color = mysqli_query($zconn,"select * from color_groups where color_group='".$_REQUEST['color_group']."'");
			$res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC);
			$color_arr = explode(",",$res_color['color_ids']);
			$color_len = count($color_arr);
			for($co=0;$co<$color_len;$co++){
			$sql_color1 = mysqli_fetch_array(mysqli_query($zconn,"select * from color_master where id='".$color_arr[$co]."'"),MYSQLI_ASSOC);
			?>
			<tr><td><!--input type="text"  name="cutting_colour[]"  value="<?php echo $sql_color1['colour_name'];?>"-->
				
				<select  name="cutting_colour[]" class="select2 form-control custom-select chosen-select" style="width:100px;">
					<option value="">--Select--</option>
    <?php
    // Assuming you have a database connection established

    // Replace 'your_database_name' with your actual database name
    $sql = "SELECT * FROM color_master WHERE status = '0'";
    $result = mysqli_query($zconn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            // Fetch color_name from the database and set the option value
            $colorName = $row['colour_name'];
            echo "<option value=\"$colorName\">$colorName</option>";
        }
    } else {
        echo "<option value=\"\">No colors found</option>";
    }
    ?>
</select>
				</td>
					
				<?php
				for($ij=0;$ij<count($sizeids);$ij++){	?>
					<td>
			
					<input type="text"  name="cutting_sizes<?php echo $sizeids[$ij];?>[]" style="width:100px;" class="cuttingqty" onkeyup="cal_orderqty1(this);cal_orderqty3(this);" >
					</td>
					
				<?php } ?>
				<td class="total-sum"></td>
				
					<td style="width:50px;"><a class="delete1" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a>
					</td>
			</tr>
			<script>
				function cal_orderqty1(input) {
    // Logic to calculate the sum of cutting sizes for this row
    var row = input.parentNode.parentNode; // Get the parent row of the input field
    var inputs = row.querySelectorAll('.cuttingqty'); // Select all cutting size input fields in this row
    var sum = 0;
    
    inputs.forEach(function(inputField) {
        // Assuming the cutting size input fields contain numerical values
        var value = parseFloat(inputField.value) || 0; // Get the numerical value or default to 0
        sum += value; // Sum up the values
    });
    
    // Update the total-sum cell in this row with the calculated sum
    row.querySelector('.total-sum').textContent = sum;
}

			</script>
				<script>
				function cal_orderqty5(input) {
    // Logic to calculate the sum of cutting sizes for this row
    var row = input.parentNode.parentNode; // Get the parent row of the input field
    var inputs = row.querySelectorAll('.cuttingqty'); // Select all cutting size input fields in this row
    var sum = 0;
    
    inputs.forEach(function(inputField) {
        // Assuming the cutting size input fields contain numerical values
        var value = parseFloat(inputField.value) || 0; // Get the numerical value or default to 0
        sum += value; // Sum up the values
    });
    
    // Update the total-sum cell in this row with the calculated sum
    row.querySelector('.total-sum5').textContent = sum;
}

			</script>
			<script>
function cal_orderqty3(input) {
  var total = 0;
  var cuttingSizesInputs = document.getElementsByClassName('cuttingqty');
  for (var i = 0; i < cuttingSizesInputs.length; i++) {
    var value = parseFloat(cuttingSizesInputs[i].value) || 0;
    total += value;
  }
  // Display the total in the 'total-sum' cell
  document.querySelector('.total-sum').textContent = total;
  
  // Update the overall total in the 'cutting_qty' input field
  document.getElementById('cutting_qty').value = total;
}
</script>
			

			<?php } ?>
		</tbody>
						</table>

		
    <!-- Remaining HTML for the cutting quantity table -->
<?php } ?>

 
					
											<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" name="save_costing" class="btn btn-success" value="<?php echo $action;?>">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="order_entry.php"><button type="button" class="btn btn-danger">List</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart-->
                <!-- ============================================================== --></div>
				</form>
            <!-- End Container fluid-->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper-->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer-->
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


	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>


	<script>



<?php
$color_list = '';

$sql_color = mysqli_query($zconn, "SELECT * FROM color_master");
while ($row_color = mysqli_fetch_array($sql_color, MYSQLI_ASSOC)) {
    $color_list .= '<option value="' . $row_color['colour_name'] . '">' . $row_color['colour_name'] . '</option>';
}

//echo $color_list; // Output the list of color options
?>


$(".add-new-row").on('click', function() {



    var orderRow = '<tr>';
    var cuttingRow = '<tr>';
    
	//orderRow += '<td><input type="text"  name="order_colour[]" value="<?php echo $sql_color1['colour_name'];?>"></td>';

	orderRow += '<td><select name="order_colour[]" style="width:100%;"class="select2 form-control custom-select chosen-select"><option value="">--Select--</option><?php echo $color_list; ?></select></td>';

    <?php
    for ($ij = 0; $ij < count($sizeids); $ij++) { ?>
        orderRow += '<td><input type="text" name="order_sizes<?php echo $sizeids[$ij];?>[]" style="width:100px;"  class="orderqty" onkeyup="cal_orderqty(this);cal_total_cutting_qty();cal_orderqty4(this)"></td>';
    <?php } ?>
    orderRow += '<td class="order-total-sum4"></td>';
    orderRow += '<td><button type="button" class="btn btn-info remove-row"><i class="fa fa-minus"></i></button></td></tr>';
	
    
    // Code for adding rows in the cutting quantity table
	//cuttingRow += '<td><input type="text"  name="cutting_colour[]" value="<?php echo $sql_color1['colour_name'];?>"></td>';

	cuttingRow += '<td><select name="cutting_colour[]" class="select2 form-control custom-select chosen-select"><option value="">--Select--</option><?php echo $color_list; ?></select></td>';


    <?php
    for ($ij = 0; $ij < count($sizeids); $ij++) { ?>
        cuttingRow += '<td><input type="text" name="cutting_sizes<?php echo $sizeids[$ij];?>[]" style="width:100px;" class="cuttingqty" onkeyup="cal_cuttingqty();cal_orderqty1(this);cal_orderqty3(this);"></td>';
    <?php } ?>
    cuttingRow += '<td class="total-sum5">';
    cuttingRow += '<td><button type="button" class="btn btn-info remove-row"><i class="fa fa-minus"></i></button></td></tr>';
	

    $("table.order-table").find("tbody").append(orderRow); // Append the new order quantity row to its table
    $("table.cutting-table").find("tbody").append(cuttingRow); // Append the new cutting quantity row to its table
	$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
});


// Code for calculating totals for order quantity
$("table.order-table").on('input', '.orderqty', function() {
    var row = $(this).closest('tr');
    var totalOrder = 0;

    row.find('.orderqty').each(function() {
        var val = parseFloat($(this).val()) || 0;
        totalOrder += val;
    });

    row.find('.order-total-sum').text(totalOrder); // Update the total in the corresponding cell
});

// Code for calculating totals for cutting quantity
$("table.cutting-table").on('input', '.cuttingqty', function() {
    var row = $(this).closest('tr');
    var totalCutting = 0;

    row.find('.cuttingqty').each(function() {
        var val = parseFloat($(this).val()) || 0;
        totalCutting += val;
    });

    row.find('.cutting-total-sum').text(totalCutting); // Update the total in the corresponding cell
});

	
	
	// Remove row functionality
$("table").on('click', '.remove-row', function() {
    $(this).closest('tr').remove(); // Remove the row when the remove button is clicked
});
	


</script>
							

	<script type="text/javascript">
		
		function cal_total_cutting_qty() {
    var totalCuttingQty = 0;

    $('.cuttingqty').each(function() {
        var val = $(this).val();
        if (!isNaN(val) && val !== '') {
            totalCuttingQty += parseFloat(val);
        }
    });

    // Display the total cutting quantity in the designated field with class .total-cutting-qty
    $('.total-cutting-qty').val(totalCuttingQty);
}
	function cal_cuttingqty(){
		var sumval = 0;
		var itmval=0;
		$('.cuttingqty').each(function(){
		itmval = $(this).val();
		if(itmval!=''){
			sumval += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
		}
		});
		$('#cutting_qty_value').val(sumval);
	}

	function cal_orderqty(obj){
		if ($("#percentage").prop("checked")) {
			var percent = $("#excess_per").val();
			var cutting_value =  parseFloat($(obj).val()) + (parseFloat($(obj).val()) * parseFloat(percent)/100);
			$('.cuttingqty').eq($(obj).index('.orderqty')).val(Math.round(cutting_value));
		}
		
		
		cal_total_order_qty();
		
		
	}
	function cal_total_order_qty() {
		var sumval = 0;
		var itmval=0;
		$('.orderqty').each(function(){
		itmval = $(this).val();
			if(itmval!=''){
				sumval += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
			}

		});
		$('#order_qty').val(sumval);
	}
function cal_cutting_quantity(obj) {
		$('.orderqty').each(function(){
		itmval = $(this).val();
			if(itmval!=''){
				var cutting_value =  parseFloat(itmval) + (parseFloat(itmval) * parseFloat($(obj).val())/100);
				console.log($(this).index('.orderqty'));

				$('.cuttingqty').eq($(this).index('.orderqty')).val(Math.round(cutting_value));
			}
		});
	}



	function sel_details(costing_id){
	$.ajax({
			url : 'ajax/costing.php',
			data: {
			   action: "get_cost_details",
			   costing_id: costing_id
			},
			success: function( data ) {
		//		alert(data);
				data = data.split("~~");
				$('#order_no').val(data['0']);
				$('#style_no').val(data['1']);
				$('#buyer_name').val(data['2']);
				$("#sel_combo_list").html(data['4']);
			},
			error: function (textStatus, errorThrown) {
				//DO NOTHINIG
			}
		});
	}
	function show_cutting_quantity(obj) {
		if($(obj).val() == "Percentage") {
			$("#excess_per").show();
			$("#cutting_qty_value").hide();
			$(".cutting_quantity_details").find("input:text").each(function() {
				$(this).attr('readonly', true);
			});
		} else if($(obj).val() == "Value") {
			// $("#cutting_qty_value").show();
			$("#excess_per").hide();
			$(".cutting_quantity_details").find("input:text").each(function() {
				$(this).attr('readonly', false);
			});
		} else {

		}
	}


$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#example td:last-child").html();
	// Append table with add row form on add new button click
     $(".add-new").click(function(){
	 	var index = $("table tbody tr:last-child").index();
	 	var newc = parseInt(index)+parseInt(1);
	 	var size_list ="<?php echo $size_list;?>";
	 	var color_list ="<?php echo $color_list;?>";
         var row = '<tr>'+
             '<td><select name="order_colour[]" class="form-control"><option value="">--Select--</option>'+size_list+'</select></td>'+size_list+'<td style="width:50px;"><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
         '</tr>';
     	$("#example").append(row);
	 	$("#example tbody tr").eq(index + 1).find(".add, .edit").toggle();
         $('[data-toggle="tooltip"]').tooltip();
     });

	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
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
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
		cal_total_order_qty();
    });
	// Delete row on delete button click
	$(document).on("click", ".delete1", function(){
        $(this).parents("tr").remove();
		$(".add-new1").removeAttr("disabled");
		cal_cuttingqty();
    });
		var actions = $("#example1 td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new1").click(function(){
		var index = $("table tbody tr:last-child").index();
		var newc = parseInt(index)+parseInt(1);
		var size_list ="<?php echo $size_list1;?>";
		var color_list ="<?php echo $color_list;?>";
        var row = '<tr>'+
            '<td><select name="cutting_colour[]" class="form-control"><option value="">--Select--</option>'+color_list+'</select></td>'+size_list+'<td style="width:50px;"><a class="delete1" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
    	$("#example1").append(row);
		$("#example1 tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });

	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new1").removeAttr("disabled");
		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new1").attr("disabled", "disabled");
    });

});

</script>

	<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
</body>
</html>