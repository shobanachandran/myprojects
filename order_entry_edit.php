<?php
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);
date_default_timezone_set('UTC');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_REQUEST);
print_r($_FILES);
echo "</pre>";*/

if($_GET['order_id']!=''){
	$sel_order = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master where order_id='".$_GET['order_id']."'"),MYSQLI_ASSOC);
	$costing_no = $sel_order['costing_no'];
	$sel_combo  = $sel_order['combo_colour'];
	$size_group = $sel_order['size_group'];
	$buyer_name = $sel_order['buyer_name'];
	$orer_no 	= $sel_order['order_no'];
	$style_no 	= $sel_order['style_no'];
	$pono		= $sel_order['po_no'];
	$season_name = $sel_order['season'];
	$order_qty = $sel_order['order_qty'];
	$cutting_qty = $sel_order['cutting_qty'];
	$excess_per = $sel_order['excess_percent'];
	// $excess_pcs = $sel_order['excess_pcs'];
	$shipment_date = $sel_order['shipment_date'];

	// $ship_date_arr = explode("/",$sel_order['shipment_date']);
	// $shipment_date = $ship_date_arr['2']."-".$ship_date_arr['1']."-".$ship_date_arr['0'];
	// $del_date_arr = explode("/",$sel_order['factory_delivery']);
	// $delivery_date = $del_date_arr['2']."-".$del_date_arr['1']."-".$del_date_arr['0'];	
	$delivery_date = $sel_order['factory_delivery'];
} else {
	$costing_no = $_REQUEST['costing_no'];
	$sel_combo  = $_REQUEST['color'];
	$size_group = $_REQUEST['size_group_name'];
	$buyer_name = $_REQUEST['buyer_name'];
	$style_no 	= $_REQUEST['style_no'];
	$pono		= $_REQUEST['po_no'];
	$season_name = $_REQUEST['season_name'];
	// $ship_date_arr = explode("/",$_REQUEST['shipment_date']);
	// $shipment_date = $ship_date_arr['2']."-".$ship_date_arr['1']."-".$ship_date_arr['0'];
	$shipment_date = $_REQUEST['shipment_date'];
	$order_qty = $_REQUEST['order_qty'];
	$cutting_qty = $_REQUEST['cutting_qty'];
	$excess_per = $_REQUEST['excess_per'];
	// $excess_pcs = $_REQUEST['excess_pcs'];
	// $del_date_arr = explode("/",$_REQUEST['delivery_date']);
	// $delivery_date = $del_date_arr['2']."-".$del_date_arr['1']."-".$del_date_arr['0'];
	$delivery_date = $_REQUEST['delivery_date'];
}

if(isset($_POST['save_costing'])){
	// $ship_date_arr = explode("/",$_POST['shipment_date']);
	// $shipment_date = $ship_date_arr['2']."-".$ship_date_arr['1']."-".$ship_date_arr['0'];
	$shipment_date = $_POST['shipment_date'];
	// $del_date_arr = explode("/",$_POST['delivery_date']);
	// $delivery_date = $del_date_arr['2']."-".$del_date_arr['1']."-".$del_date_arr['0'];
	$delivery_date = $_POST['delivery_date'];
	$update_order_id = $_REQUEST['edit_order_id'];
	if($_POST['cutting_quantity_type'] == "Percentage") {
		$excess_per = $_REQUEST['excess_per'];
	} else if ($_POST['cutting_quantity_type'] == "Value") {
		$excess_per = '';
	} else {
		$excess_per = '';
	}
	$order_master = mysqli_query($zconn,"update order_entry_master set 
								order_no = '".$_REQUEST['orer_no']."',
								costing_no='".$_REQUEST['costing_no']."',
								combo_colour='".$_REQUEST['color']."',
								buyer_name='".$_REQUEST['buyer_name']."',
								style_no='".$_REQUEST['style_no']."',
								po_no='".$_REQUEST['po_no']."',
								season='".$_REQUEST['season_name']."',
								shipment_date='".$shipment_date."',
								factory_delivery='".$delivery_date."',
								order_qty='".$_REQUEST['order_qty']."',
								cutting_qty='".$_REQUEST['cutting_qty']."',
								excess_percent='".$excess_per."',
								excess_pcs='',
								last_updated_by='".$_SESSION['userid']."',
								last_updated_date=now() where order_id='".$update_order_id."'");


	if($order_master){
		$del_order_qty = mysqli_query($zconn,"delete from order_quantity_details where order_id='".$update_order_id."'");
		$del_cutting_qty = mysqli_query($zconn,"delete from cutting_quantity_details where order_id='".$update_order_id."'");
		
		$source1 = $_FILES['order_image']['tmp_name'];
			$upload1 =$_FILES['order_image']['name'];
			$original_complogos1 = "uploads/orders/".$upload1;
			$enqUpload = move_uploaded_file($source1, $original_complogos1);
			$filepath = "uploads/orders/".$upload1;
			if($enqUpload){
				$updatestatus = mysqli_query($zconn,"UPDATE order_entry_master SET order_image = '".$filepath."' WHERE order_id = '".$update_order_id."'");
			}

		$order_qty_count = count($_REQUEST['order_colour']);
		$order1_sizes = count($_REQUEST['size_ids1']);
			for($ts=0;$ts<$order_qty_count;$ts++){
				for($tb=0;$tb<$order1_sizes;$tb++){
					$szeid = $_REQUEST['size_ids1'][$tb];
					$order_child = mysqli_query($zconn,"insert into order_quantity_details(order_id,row_id,po_no,order_no,color,size_id,qty_val) values('".$update_order_id."','".$ts."','".$_REQUEST['po_no']."','".$_REQUEST['orer_no']."','".$order_colour[$ts]."','".$szeid."','".$_REQUEST['order_sizes'.$szeid][$ts]."')");
				}
			}

		$order_qty_count = count($_REQUEST['cutting_colour']);
		$order2_sizes = count($_REQUEST['size_ids2']);
		$total_cutting_qty_value = 0;
			for($ts=0;$ts<$order_qty_count;$ts++){
				for($tb=0;$tb<$order2_sizes;$tb++){
					$szeid = $_REQUEST['size_ids2'][$tb];
					$total_cutting_qty_value += $_REQUEST['cutting_sizes'.$szeid][$ts];			
					$order_child = mysqli_query($zconn,"insert into cutting_quantity_details(order_id,row_id,po_no,order_no,color,size_id,qty_val) values('".$update_order_id."','".$ts."','".$_REQUEST['po_no']."','".$_REQUEST['orer_no']."','".$order_colour[$ts]."','".$szeid."','".$_REQUEST['cutting_sizes'.$szeid][$ts]."')");
				}
			}
	
		$updatestatus = mysqli_query($zconn,"UPDATE order_entry_master SET cutting_qty = ".$total_cutting_qty_value." WHERE order_id = '".$update_order_id."'");
	}

	echo "<script>alert('Order updated successfully!!!');</script>";
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
		<input type="hidden" name="edit_order_id" id="edit_order_id" value="<?php echo $_GET['order_id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
								<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
								<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Costing No</label>
										<div class="col-sm-6">
											<select class="select2 form-control custom-select" onchange="sel_details(this.value);" name="costing_no">
										<option value="">Select</option>
										<?php 
					$sel_costing = mysqli_query($zconn,"select * from costing_entry_master");
						while($res_costing = mysqli_fetch_array($sel_costing,MYSQLI_ASSOC)){
								if($res_costing['id']==$costing_no){ ?>
									<option selected value="<?php echo $res_costing['id'];?>"><?php echo $res_costing['costing_no'];?></option>
									<?php } else  { ?>
									<option value="<?php echo $res_costing['id'];?>"><?php echo $res_costing['costing_no'];?></option>
									<?php } ?>
								<?php } ?>
							</select>
										</div>
									</div>

									<!--<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Select Combo</label>
										<div class="col-sm-6">
											<select name="color" class="form-control">
											<option value="">--Select--</option>
											<?php $sel_color = mysqli_query($zconn,"select * from color_master");
											while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){
												if($res_color['colour_name']==$sel_combo){
											?>
											<option selected value="<?php echo $res_color['colour_name'];?>"><?php echo $res_color['colour_name'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_color['colour_name'];?>"><?php echo $res_color['colour_name'];?></option>

											<?php } } ?>
											</select>
										</div>
									</div>-->
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Size Group</label>
										<div class="col-sm-6">
											<select name="size_group" class="form-control" onchange="this.form.submit();">
											<option value="">--Select--</option>
											<?php $sel_color = mysqli_query($zconn,"select * from size_groups");
											while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){
												if($res_color['size_group_name']==$size_group){
											?>
											<option selected value="<?php echo $res_color['size_group_name'];?>"><?php echo $res_color['size_group_name'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_color['size_group_name'];?>"><?php echo $res_color['size_group_name'];?></option>
											<?php } }?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Buyer Name</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="buyer_name" name="buyer_name" autocomplete="off" required placeholder="Buyer Name" value="<?php echo $buyer_name;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Order Number</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="order_no" name="orer_no" autocomplete="off" required placeholder="Order Number" value="<?php echo $orer_no;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="style_no" name="style_no" autocomplete="off" required placeholder="Style No" value="<?php echo $style_no;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">PO No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="po_no" name="po_no" autocomplete="off" required placeholder="PO No" value="<?php echo $pono;?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Order Image</label>
										<div class="col-sm-6">
											<input type="file" class="form-control" id="order_image" name="order_image" autocomplete="off" placeholder="Order Image">
											<?php if($sel_order['order_image']!=''){ ?>
											<img src="<?php echo $sel_order['order_image'];?>" width="100" height="100">
												
											<?php }?>
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Season</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="season_name" name="season_name" autocomplete="off"  placeholder="Season" value="<?php echo $season_name;?>">
										</div>
									</div>
								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Shipment Date</label>
										<div class="col-sm-6">
											<input type="date" autocomplete="off"  class="form-control" id="shipment_date" name="shipment_date" value="<?php echo $shipment_date;?>" >
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Factory Delivery Date</label>
										<div class="col-sm-6">
											<input type="date" autocomplete="off"  class="form-control" id="delivery_date" name="delivery_date" value="<?php echo $delivery_date;?>" >
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Order Quantity</label>
										<div class="col-sm-6">
										<input type="text" autocomplete="off" required class="form-control" id="order_qty" name="order_qty" value="<?php echo $order_qty;?>" placeholder="Order Quantity">
										</div>
									</div>
									<!-- <div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Cutting Quantity</label>
										<div class="col-sm-6">
											<input type="text" autocomplete="off" required class="form-control" id="cutting_qty" name="cutting_qty" value="<?php echo $cutting_qty;?>" >
										</div>
									</div> -->
									<!-- <div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Excess(%)</label>
										<div class="col-sm-6">
											<input type="text" autocomplete="off" required class="form-control" id="excess_per" name="excess_per" value="<?php echo $excess_per;?>" >
										</div>
									</div> -->
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Cutting Quantity</label>
										<div class="col-sm-6">
										<?php
											if($excess_per != "") {
												$per_selected = "checked";
												$man_selected = "";
												$per_input_style = "";
												$man_input_style = "display:none";
												$cutting_style = "readonly";
											} else {
												$per_selected = "";
												$man_selected = "checked";
												$man_input_style = "";
												$per_input_style = "display:none";
												$cutting_style = "";
											}
											?>
											<input type="radio" <?php echo $per_selected; ?> onchange="show_cutting_quantity(this)" id="percentage" name="cutting_quantity_type" value="Percentage">
											<label for="male">Percentage(%)</label>
											<input type="radio" <?php echo $man_selected; ?> onchange="show_cutting_quantity(this)" id="value" name="cutting_quantity_type" value="Value">
											<label for="value">Manual</label>
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label"></label>
										<div class="col-sm-6">
										<!-- <input type="text" placeholder="Cutting Quantity in Value" style="<?php echo $man_input_style; ?>" autocomplete="off" required class="form-control" id="cutting_qty_value" name="cutting_qty" value="<?php echo $_REQUEST['cutting_qty'];?>" > -->
										<input type="text" placeholder="Cutting Quantity in percentage"style="<?php echo $per_input_style; ?>" autocomplete="off" required class="form-control" id="excess_per" name="excess_per" onkeyup=cal_cutting_quantity(this) value="<?php echo $excess_per;?>" >
										</div>
									</div>

									<!-- <div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Excess Pcs</label>
										<div class="col-sm-6">
											<input type="text" autocomplete="off" required class="form-control" id="excess_pcs" name="excess_pcs" value="<?php echo $excess_pcs;?>" >
										</div>
									</div> -->
									<!--<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Repeat Order</label>
										<div class="col-sm-6">
											<input type="checkbox" class="form-control" id="repeat" name="repeat" value="1" >
										</div>
									</div>-->
								</div>
							</div>
							<div class="col-md-9" style="float:left;"><h3>Enter Order Quantity</h3></div>
						<table id="example" class="" border="0" style="width:100%;">
							<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
								<tr>
									<!--<th style="width:50px;">P.O.No</th>-->
									<th style="width:50px;">Colour</th>
			<?php 
					$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_group."'");

				 	//while($res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC)){
					$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
					$sizeids = explode(",",$res_size['size_ids']);
					for($ij=0;$ij<count($sizeids);$ij++){ ?>
						<th style="width:50px;">
							<input type="hidden" name="size_ids1[]" style="width:100px;" value="<?php echo $sizeids[$ij];?>">
							<input type="text" value="<?php echo $sizeids[$ij];?>" name="sizes1[]" style="border:none; width:50px; background-color:#27A9E3; color:#fff; font-weight:bold;" readonly>
						</th>
					<?php } ?>
						<th style="width:50px;">
						<!-- <button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button> -->
						</th>
							</tr>
										</thead>
										<tbody>
										<tr>
										<?php

											$sel_order_det = mysqli_query($zconn,"SELECT * 
										FROM  `order_quantity_details` WHERE  `order_id` ='".$_GET['order_id']."' GROUP BY row_id");
											while($res_order_det = mysqli_fetch_array($sel_order_det,MYSQLI_ASSOC)){
										?>
									
										<td>
										<input type="text" readonly name="order_colour[]"  value="<?php echo $res_order_det['color'];?>"></td>
										</td>
										<!-- <select name="order_colour[]" class="form-control"> -->
										<!-- <option value="">--Select--</option> -->
											<?php //$sel_color = mysqli_query($zconn,"select * from color_master"); 
										// while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){
											// if($res_color['colour_name']==$res_order_det['color']){
										?>
										<!-- <option value="<?php //echo $res_color['colour_name'];?>" selected><?php //echo $res_color['colour_name'];?></option> -->
										<?php  // } else { ?>
										<!-- <option value="<?php //echo $res_color['colour_name'];?>"><?php //echo $res_color['colour_name'];?></option> -->
			
										<?php // } ?>
										<?php   //} ?>
										<!-- </select>? -->
										
										<?php 
											
										$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_group."'");
										$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
										$sizeids = explode(",",$res_size['size_ids']);
										for($ij=0;$ij<count($sizeids);$ij++){
													$sel_details = mysqli_fetch_array(mysqli_query($zconn,"select * from order_quantity_details where order_id='".$_GET['order_id']."' and row_id='".$res_order_det['row_id']."' and size_id='".$sizeids[$ij]."'"),MYSQLI_ASSOC);

												?>
														<td>
														<!-- <input type="hidden" name="size_ids2[]" style="width:100px;" value="<?php echo $sizeids[$ij];?>"> -->
														<input type="text" class="orderqty" onkeyup="cal_orderqty(this);" name="order_sizes<?php echo $sizeids[$ij];?>[]" style="width:100px;" value="<?php echo $sel_details['qty_val'];?>"></td>
															<?php } ?>
														<td style="width:50px;"><a class="delete" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a>
														</td>
														</tr>
											<?php } ?>
					</tbody>
			</table>
			<div class="col-md-9" style="float:left;"><h3>Enter Cutting Quantity</h3></div>
				<table id="example1" class="cutting_quantity_details" border="0" style="width:100%;">
						<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
					<tr>
						<th style="width:50px;">Colour</th>
		<?php
			$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_group."'");
			$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
			$sizeids = explode(",",$res_size['size_ids']);
			for($ij=0;$ij<count($sizeids);$ij++){
		?>
				<th style="width:50px;">
				<input type="hidden" name="size_ids2[]" style="width:100px;" value="<?php echo $sizeids[$ij];?>">
			<input type="text" value="<?php echo $sizeids[$ij];?>" style="border:none; width:50px; background-color:#27A9E3; color:#fff; font-weight:bold;" readonly ></th>
			<?php } ?>
				<th style="width:50px;">
				<!-- <button type="button" class="btn btn-info add-new1"><i class="fa fa-plus"></i></button> -->
				</th>
			</tr>
		</thead>
		<tbody>
		<?php $sel_cutting_det = mysqli_query($zconn,"SELECT * 
FROM  `cutting_quantity_details` WHERE  `order_id` ='".$_GET['order_id']."' GROUP BY row_id");
	while($res_cutting_det = mysqli_fetch_array($sel_cutting_det,MYSQLI_ASSOC)){ ?>
			<tr>
				<td>
				<input type="text" readonly name="cutting_colour[]"  value="<?php echo $res_cutting_det['color'];?>"></td>

				<!-- <select name="cutting_colour[]" class="form-control"> -->
					<!-- <option value="">--Select--</option> -->
					<?php 
					//$sel_color = mysqli_query($zconn,"select * from color_master");
					// while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){
						//if($res_color['colour_name']==$res_cutting_det['color']){
					?>
					<!-- <option selected value="<?php //echo $res_color['colour_name'];?>"><?php echo $res_color['colour_name'];?></option> -->
					<?php // } else { ?>
					<!-- <option value="<?php echo $res_color['colour_name'];?>"><?php echo $res_color['colour_name'];?></option> -->
					<?php //} ?>
					<?php //} ?>
					<!-- </select> -->
				</td>
	<?php 
							$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_group."'");
							$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
							$sizeids = explode(",",$res_size['size_ids']);

			for($ij=0;$ij<count($sizeids);$ij++){ 
				$sel_cut_details = mysqli_fetch_array(mysqli_query($zconn,"select * from cutting_quantity_details where order_id='".$_GET['order_id']."' and row_id='".$res_cutting_det['row_id']."' and size_id='".$sizeids[$ij]."'"),MYSQLI_ASSOC);

							?>
							<td><input type="text" class="cuttingqty" <?php echo $cutting_style; ?> name="cutting_sizes<?php echo $sizeids[$ij];?>[]" style="width:100px;" value="<?php echo $sel_cut_details['qty_val'];?>" ></td>
							<?php } ?>
							<td style="width:50px;"><a class="delete1" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a></td>
							</tr>
	<?php } ?>
								</tbody>
						</table>
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
	<script type="text/javascript">
	function sel_details(costing_id){
	$.ajax({
			url : 'ajax/costing.php',
			data: {
			   action: "get_cost_details",
			   costing_id: costing_id
			},
			success: function( data ) {
				//alert(data);
				data = data.split("~~");
				$('#order_no').val(data['0']);
				$('#style_no').val(data['1']);
				$('#buyer_name').val(data['2']);
			},
			error: function (textStatus, errorThrown) {
				//DO NOTHINIG
			}
		});
}
$(document).ready(function(){
	//$('.left-sidebar').slideToggle();
});

<?php
		$sel_color = mysqli_query($zconn,"select * from color_master");
		$color_list='';
		while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){ 
			$col_name = $res_color['colour_name'];
			$color_list .='<option value='.$col_name.'>'.$res_color['colour_name'].'</option>';
		} 
		$size_list='';
		$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_group."'");
		$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
		$sizeids = explode(",",$res_size['size_ids']);
		for($ij=0;$ij<count($sizeids);$ij++){
			$size_list .= "<td><input type='text' name='order_sizes".$sizeids[$ij]."[]' style='width:100px;' ></td>";
		}
		
		$size_list1='';
		$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_group."'");
		$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
		$sizeids = explode(",",$res_size['size_ids']);
		for($ij=0;$ij<count($sizeids);$ij++){
			$size_list1 .= "<td><input type='text' name='cutting_sizes".$sizeids[$ij]."[]' style='width:100px;' ></td>";
		}
	?>

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
				// console.log($(this).index('.orderqty'));
				$('.cuttingqty').eq($(this).index('.orderqty')).val(Math.round(cutting_value));
			}
		});
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
            '<td><select name="order_colour[]" class="form-control"><option value="">--Select--</option>'+color_list+'</select></td>'+size_list+'<td style="width:50px;"><a class="delete" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a></td>' +
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
            '<td><select name="cutting_colour[]" class="form-control"><option value="">--Select--</option>'+color_list+'</select></td>'+size_list+'<td style="width:50px;"><a class="delete1" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a></td>' +
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
</script>
</body>
</html>