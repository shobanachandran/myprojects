<?php 
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/

if($_REQUEST['id']==''){
	$cost_no = get_max_costno();
	/*$sel_costing = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as COSTNO from costing_entry_master"));
	if($sel_costing['COSTNO']=='' || $sel_costing['COSTNO']==NULL){
		$cost_no ='001';
	} else {
		$cost_no = $sel_costing['COSTNO']+1;
	}
	$cost_no = "00".$cost_no;*/
	$action="saveCosting";
}

if($_REQUEST['id']!='' ){
	$action="updateCosting";

	$cost_sql = mysqli_query($zconn,"select * from yarn_entry_master where id='".$_REQUEST['id']."'");
	$res_cost = mysqli_fetch_array($cost_sql,MYSQLI_ASSOC);
	$cost_no = $res_cost['id'];
	$order_no = $res_cost['order_no'];
	$style_no=$res_cost['style_no'];
	$fabric_name=$res_cost['fabric_name'];
	$costing_noe = $res_cost['costing_no'];
	
	$res_cost['yarn_date'];
	$cost_date = date_from_db($res_cost['yarn_date']);
}

if($_POST['save_costing']=='saveCosting'){
	$cost_no = get_max_costno();
	$costing_date = date_to_db($costing_date);

	// $sel_buyer_det = explode("~~",$_POST['costing_no']);
	$sel_insert = mysqli_query($zconn,"insert into yarn_entry_master(buyer_id,costing_no,order_no,style_no,fabric_name,total_value,yarn_date,created_by,created_date) values('".$_REQUEST['costing_no']."','".$_REQUEST['costing_no']."','".$order_no."','".$style_no."','".$fabric_name."','".$grand_total."','".$costing_date."','".$_SESSION['userid']."',now())");

	$yarn_id = mysqli_insert_id($zconn);

	if($sel_insert){
		$trows = count($_POST['yname']);
		for($tr=0;$tr<$trows;$tr++){
			// $sel_buyer_det = explode("~~",$_POST['costing_no']);
			$ins_details = mysqli_query($zconn,"insert into yarn_entry_details(costing_no,yarn_id,yarn_name,yarn_count,yarn_type,yarn_colour,yarn_content,fabric_name,comp_id,consumption_value,consumption_percent,pcs_weight,uom_id,yarn_rate,yarn_total) values('".$_REQUEST['costing_no']."','".$yarn_id."','".$_POST['yname'][$tr]."','".addslashes($_POST['ycount'][$tr])."','".$_POST['ytype'][$tr]."','".$_POST['ycolor'][$tr]."','".$_POST['content'][$tr]."','".$_POST['fabric_name'][$tr]."','".$_POST['ycomp'][$tr]."','".$_POST['consumption_val'][$tr]."','".$_POST['consumption_per'][$tr]."','".$_POST['pcs_weight'][$tr]."','".$_POST['uom'][$tr]."','".$_POST['yrate'][$tr]."','".$_POST['ytotal'][$tr]."')");
		}
	}

	echo "<script>alert('Added Successfully!!!');</script>";
	echo "<script>window.location.href='yarn_planning_list.php';</script>";
}


if($_POST['save_costing']=='updateCosting'){

	$sel_update = mysqli_query($zconn,"update yarn_entry_master set buyer_id='',costing_no='".$_REQUEST['costing_no']."',order_no='".$order_no."', style_no='".$style_no."',total_value='".$grand_total."' where id='".$cost_id."'");
if($sel_update){
		$trows = count($_POST['yname']);

		$del_data = mysqli_fetch_array(mysqli_query($zconn,"select * from yarn_entry_master where id='".$cost_id."'"),MYSQLI_ASSOC);
		$del_datas = mysqli_query($zconn,"delete from yarn_entry_details where yarn_id='".$cost_id."' and costing_no='".$del_data['costing_no']."' ");
		$del_datas = mysqli_query($zconn,"delete from yarn_entry_master where id='".$cost_id."'");

	$sel_insert = mysqli_query($zconn,"insert into yarn_entry_master(buyer_id,costing_no,order_no,style_no,fabric_name,total_value,yarn_date,created_by,created_date) values('".$_REQUEST['costing_no']."','".$_REQUEST['costing_no']."','".$order_no."','".$style_no."','".$fabric_name."','".$grand_total."','".$costing_date."','".$_SESSION['userid']."',now())");

	$yarn_id = mysqli_insert_id($zconn);

	if($sel_insert){
		for($tr=0;$tr<$trows;$tr++){
			$id=$_POST['yid'][$tr];

			$ins_details = mysqli_query($zconn,"insert into yarn_entry_details(costing_no,yarn_id,yarn_name,yarn_count,yarn_type,yarn_colour,yarn_content,fabric_name,comp_id,consumption_value,consumption_percent,pcs_weight,uom_id,yarn_rate,yarn_total) values('".$_REQUEST['costing_no']."','".$yarn_id."','".$_POST['yname'][$tr]."','".addslashes($_POST['ycount'][$tr])."','".$_POST['ytype'][$tr]."','".$_POST['ycolor'][$tr]."','".$_POST['content'][$tr]."','".$_POST['fabric_name'][$tr]."','".$_POST['ycomp'][$tr]."','".$_POST['consumption_val'][$tr]."','".$_POST['consumption_per'][$tr]."','".$_POST['pcs_weight'][$tr]."','".$_POST['uom'][$tr]."','".$_POST['yrate'][$tr]."','".$_POST['ytotal'][$tr]."')");

		 }
		}
	}

	if($sel_update){
	//	echo "<script>alert('Updated Successfully!!!');</script>";
//		echo "<script>window.location.href='yarn_planning_list.php';</script>";
	}
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
    <title><?php echo SITE_TITLE;?> - Yarn Requistion</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">	
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>



	<style>
	.table td, .table th{padding:0px !important; font-size:14px;}
	</style>
</head>
<body>
<!-- <div id="main-wrapper" data-sidebartype="full"> -->
	
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
                        <h4 class="page-title">Yarn Requistion</h4>
						<h4 class="page-title"></h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="requistion.php"> <button type="button" class="btn btn-info">Requistion</button></a>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item " aria-current="page">Merch</li>
									<!-- <li class="breadcrumb-item " aria-current="page"><a href="costing.php">Costing</a></li> -->
									<li class="breadcrumb-item active" aria-current="page"><a href="requistion.php">Yarn Reauistion</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
			<form name="costing_entry" id="costing_entry" method="post" onsubmit="return chkweight(); ">
			   <input type="hidden" name="cost_no" id="cost_no" value="<?php echo $cost_no;?>">
				<input type="hidden" name="cost_id" id="cost_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row" style="padding-top:20px;">
                    <div class="col-md-12">
                        <div class="card">
								<div class="card-body" style="width:100%">
									<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">

									<div class="form-group row">

										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
										<div class="col-sm-6">

											<select class="select2 form-control custom-select chosen-select" name="order_no" id="order_no" onchange="buyer_costing(this.form.submit());" required>
												  <?php if($_REQUEST['costing_no']!='0'){?>
												<option value="<?php echo $order_no;?>"><?php echo $order_no;?></option>
											<?php }  ?>
											<option value="">Select</option>
										<?php 
												
									  $sql = mysqli_query($zconn,"select * from order_entry_master where (`order_no`,`style_no`) NOT IN(select order_no,style_no from yarn_entry_master) and (`order_no`,`style_no`) IN (select order_no,style_no from process_planning_flow)");
								
										while($res_sql = mysqli_fetch_array($sql,MYSQLI_ASSOC)){ ?>
										<option value="<?php echo $res_sql['order_no'];?>" <?php if($res_sql['order_no']==$_REQUEST['order_no']) {
											echo "selected";
										}?> ><?php echo $res_sql['order_no'];?></option>
										<?php }  ?>
											</select>
											<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>

											 <?php $sql=mysqli_query($zconn,
											 "select * from order_entry_master where order_no='".$_REQUEST['order_no']."'");
													while($res_cost=mysqli_fetch_array($sql,MYSQLI_ASSOC)){
														$style_no=$res_cost['style_no'];
													}
												?> 
										</div>
									</div>
									
								<?php
								
								$sel_costing = mysqli_query($zconn,"select * from costing_entry_master where order_no='".$_REQUEST['order_no']."' and style_no='".$_REQUEST['style_no']."'");
$costing_row = mysqli_num_rows($sel_costing);


 ?>
<?php if($costing_row>0){ ?>
	<div class="form-group">
		<h4 class="page-title"><b>Component Details</b></h4>
	</div>
	<table id="" class="table table-striped table-bordered">
		<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
			<tr>
				<th>Order No</th>
				<th>Style No</th>
				<th>Pcs Weight</th>
				<th>Order Quantity + Excess</th>
				<th>Total Weight [KGS]</th>
			</tr>
		</thead>
        	<?php
        	 $coso = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['order_no']."' and style_no='".$_REQUEST['style_no']."'"),MYSQLI_ASSOC);
			 $cost_ido=$coso['id'];
			 if ($cost_ido!='') {
			 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['order_no']."' and style_no='".$_REQUEST['style_no']."'"),MYSQLI_ASSOC);
			 $sel_c = mysqli_query($zconn,"SELECT distinct(costing_id)  FROM `costing_entry_details` where costing_id='".$cos['id']."'");
			 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['order_no']."' and style_no='".$_REQUEST['style_no']."'"),MYSQLI_ASSOC);	
			 }
			 else{
			 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['order_no']."' and style_no='".$_REQUEST['style_no']."'"),MYSQLI_ASSOC);
			 $sel_0 = mysqli_query($zconn,"SELECT distinct(yarn_id) FROM `order_quantity_details` where yarn_id='".$cos['id']."'");

			 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['order_no']."' and style_no='".$_REQUEST['style_no']."'"),MYSQLI_ASSOC);
			 }

			if ($sel_c!='') {
				$sel=$sel_c;
				$tb="costing_entry_details";
				$cond="costing_id";
			} else {
				$sel=$sel_0;
				$tb="yarn_entry_details";
				$cond="yarn_id";
			}
			$tow =0;
			while($resc=mysqli_fetch_array($sel)){ 
			 	$pcs = mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(pcs_weight) as pcs_weight FROM $tb where  $cond='".$cos['id']."'"),MYSQLI_ASSOC);

				$exc_cal = ($order['excess_percent']*$order['cutting_qty'])/100;
				$excess_cal = $order['cutting_qty'];

			$pcsweight = number_format($pcs['pcs_weight'], 2, '.', "");
			$tow =$pcsweight*$excess_cal;
			 	?>
				<tr>
					<td><?php echo $_REQUEST['order_no'];?></td>
					<td><?php echo $_REQUEST['style_no'];?></td>
					<td><?php echo $pcsweight;?><input type="hidden" name="pcs_weight" class="form-control" value="<?php echo $pcs['pcs_weight'];?>"></td>
					<td><?php echo $excess_cal;?><input type="hidden" name="order_qty" class="form-control"  value="<?php echo $excess_cal;?>"></td>
					<td><?php echo number_format($tow, 2, '.', "");?>
					<input type="hidden" name="totweight[]" class="form-control" value="<?php echo number_format($tow, 2, '.', "");?>" id="totweight"></td>
				</tr>
			<?php }
			 ?>
    </table>
<?php } ?>
								
							</div>
							

							

									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Style No</label>
										<div class="col-sm-6">
							<select name="style_no" id="style_no" class="select2 form-control custom-select chosen-select" onchange="this.form.submit();">	
								<option value=''>--Select--</option>
								<?php $sql_order = mysqli_query($zconn,"select * from order_entry_master where order_no='".$_REQUEST['order_no']."'");
									while($res_order = mysqli_fetch_array($sql_order,MYSQLI_ASSOC)){
										if($_REQUEST['style_no']==$res_order['style_no']){
											?>
								<option selected value="<?php echo $res_order['style_no'];?>"><?php echo $res_order['style_no'];?></option>
								<?php } else { ?>
								<option value="<?php echo $res_order['style_no'];?>"><?php echo $res_order['style_no'];?></option>
								<?php  } } ?>
											</select>
											<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
										</div>
									</div>
							

								</div>
							</div>
							
						
			<table id="example" class="table table-striped table-bordered">
				<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
				<tr align="center" valign="middle">
					<th style="width: 10%">Yarn Name</th>
					<th style="width: 8%;">Count</th>
					<th style="width: 8%">Type</th>
					<th style="width: 10%">Colour</th>
					<th style="width: 10%">Content</th>
					<!-- th>Comp.Group</th> -->
					<th style="width: 10%">Fabric Name</th>
					<th style="width: 10%">Component</th>
					<th style="width: 5%">Consumption</th>
					<th style="width: 5%">Consump(%)</th>
					<th style="width: 5%">Pcs.Weight</th>
					<th style="width: 5%">UOM</th>
					<th style="width: 5%">Rate</th>
					<th style="width: 5%">Total</th>
					<th style="width: 2%"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
				</tr>
				</thead>
				<tbody>
					<?php
					$selcost_master =mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where order_no='".$_REQUEST['order_no']."' and style_no='".$_REQUEST['style_no']."'"),MYSQLI_ASSOC);
					$selcosting = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$selcost_master['id']."'");
					$co=0;
					$yantot=0;
					while($res_costing = mysqli_fetch_array($selcosting,MYSQLI_ASSOC)){
							?>
							<tr id="delete_<?php echo $co;?>">
								<td>
									<select class="select2 form-control custom-select chosen-select"  id="yname<?php echo $co;?>" name="yname[]">
										<option value="">Select</option>
										<?php
										$sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
										while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
										if($res_costing['yarn_name']==$res_yname['yarn_name']){
										?>
										<option selected value="<?php echo $res_yname['yarn_name'];?>"><?php echo $res_yname['yarn_name'];?></option>
										<?php } else { ?>
											<option value="<?php echo $res_yname['yarn_name'];?>"><?php echo $res_yname['yarn_name'];?></option>
										<?php }  } ?>
									 </select>
								   </td>
								  <td>
									<select class="select2 form-control custom-select chosen-select" id="ycount<?php echo $co;?>" name="ycount[]">
										<option value="">Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
										if($res_costing['yarn_count']==$res_ycounts['counts_name']){
										?>
										<option selected value="<?php echo $res_ycounts['counts_name'];?>"><?php echo $res_ycounts['counts_name'];?></option>
										<?php } else { ?>
										<option value="<?php echo $res_ycounts['counts_name'];?>"><?php echo $res_ycounts['counts_name'];?></option>
										<?php } ?>
										<?php } ?>
									 </select>
												</td>
												<td>
										<select class="select2 form-control custom-select " id="ytype<?php echo $co;?>" name="ytype[]" onchange="sel_ytype(this.value,'0');">
										<option value="">Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
											if($res_costing['yarn_type']==$res_ycounts['yarn_type_name']){
											?>
								<option selected value="<?php echo $res_ycounts['yarn_type_name'];?>"><?php echo $res_ycounts['yarn_type_name'];?></option>
										<?php } else { ?>
											<option value="<?php echo $res_ycounts['yarn_type_name'];?>"><?php echo $res_ycounts['yarn_type_name'];?></option>
										<?php } } ?>
										</select>
										</td>
										<td>
											<select class="select2 form-control custom-select " name="ycolor[]" id="ycolor<?php echo $co;?>">
											<option value="">Select</option>
									<?php
										$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
										while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){ 
											if($res_costing['yarn_colour']==$res_ycolor['colour_name']){
												?>
											<option selected value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
												<?php } else { ?>
											<option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
										<?php } 
												
										} ?>
											</select>
												</td>
												<td>
												<select name="content[]" id="content<?php echo $co;?>" class="select2 form-control custom-select chosen-select">
												<option>Select</option>
									<?php $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
									while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
									if($res_costing['yarn_content']==$res_content['content_name']){
													?>
									<option selected value="<?php echo $res_content['content_name'];?>"><?php echo $res_content['content_name'];?></option>
													<?php } else { ?>
									<option value="<?php echo $res_content['content_name'];?>"><?php echo $res_content['content_name'];?></option>
									<?php }  } ?>
									</select>
												</td>
									<td>
										<select name="fabric_name[]" name="fabric_name<?php echo $co;?>" class="select2 form-control custom-select chosen-select">
											<option>Select</option>
										<?php $sel_fabs = mysqli_query($zconn,"select * from fabric_master where status='0'");
										while($res_fab = mysqli_fetch_array($sel_fabs,MYSQLI_ASSOC)){
											if($res_costing['fabric_name']==$res_fab['fabric_name']){
											?>
										<option selected  value="<?php echo $res_fab['fabric_name'];?>"><?php echo $res_fab['fabric_name'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_fab['fabric_name'];?>"><?php echo $res_fab['fabric_name'];?></option>
											<?php } ?>
										<?php } ?>
										</select>
									</td>

									<td>
										<select class="select2 form-control custom-select chosen-select" name="ycomp[]" id="ycomp<?php echo $co;?>">
										<option value="">Select</option>
										<?php $selcomp = mysqli_query($zconn,"select * from components where status='0'");
										while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
											if($res_costing['comp_id']==$res_comp['comp_name']){
										?>
										<option selected value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } 
										} ?>
										</select>
										</td>
										<td>
										<input type="text" class="form-control" id="consumption_val<?php echo $co;?>" name="consumption_val[]" autocomplete="off" onkeyup="cal_yarn_pcs('0');" value="<?php echo $res_costing['consumption_value'];?>">
										</td>
										<td>
										<input type="text" class="form-control" id="consumption_per<?php echo $co;?>" name="consumption_per[]" placeholder="(%)" onkeyup="cal_yarn_pcs('0');" autocomplete="off" value="<?php echo $res_costing['consumption_percent'];?>">
										</td>
										<td>
										<input type="text" class="form-control" id="pcs_weight<?php echo $co;?>" name="pcs_weight[]" placeholder="Pcs.Wt" autocomplete="off" value="<?php echo $res_costing['pcs_weight'];?>">
										</td>
										<td>
										<select class="select2 form-control custom-select " name="uom[]" id="uom<?php echo $co;?>">
												<option value="">Select</option>
												<?php $sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
												while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
													if($res_costing['uom_id']==$res_uom['uom_name']){
												?>
												<option selected value="<?php echo $res_uom['uom_name'];?>"><?php echo $res_uom['uom_name'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_uom['uom_name'];?>"><?php echo $res_uom['uom_name'];?></option>
											<?php } ?>
												<?php } ?>
										</select>
										<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</td>
												<td>
													<input type="text" class="form-control" id="yrate<?php echo $co;?>" name="yrate[]" placeholder="Rate" autocomplete="off" onkeyup="cal_amount('<?php echo $co;?>');" value="<?php echo $res_costing['yarn_rate'];?>">
												</td>
												<td>
<?php // $yantot = $yantot + $res_costing['yarn_total'];
	$yantot += $res_costing['pcs_weight']*$excess_cal;
													?>
<input type="text" class="form-control totl" id="ytotal<?php echo $co;?>" name="ytotal[]" placeholder="Total" autocomplete="off" value="<?php echo number_format($res_costing['pcs_weight']*$excess_cal,2);?>">
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
					<?php $co++; } ?>

				</tbody>
										<tbody>
											<tr align="center" id="">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>
												  <h6  valign="middle" class="page-title">Yarn Total:</h6></td>
												<td>
											<input type="text" class="form-control" id="grand_total" name="grand_total" readonly placeholder="" style="border: 1px solid #000;" value="<?php echo number_format($yantot,2);?>">
												</td>
												<td>
												</td>
											</tr>
										</tbody>
									</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" name="save_costing" class="btn btn-success" value="<?php echo $action;?>">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="yarn_requistion_list.php"><button type="button" class="btn btn-danger">List</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
         <!-- ============================================================== --></div>
				</form>
            <!-- End Container fluid  -->
         <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
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
	<script src="dist/js/bootstrap-datepicker.js"></script>
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

	<?php
		 $sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
		 $ynamelist= '';
		 while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
		  $ynamelist .='<option value="'.$res_yname['yarn_name'].'">'.$res_yname['yarn_name'].'</option>';
		  } 

		 $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
		 $ycountlist= '';
		 while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ycountlist .='<option value="'.addslashes($res_ycounts['counts_name']).'">'.addslashes($res_ycounts['counts_name']).'</option>';
		 }

		$sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
		$ytypes ='';
		while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ytypes .='<option value="'.$res_ycounts['yarn_type_name'].'">'.$res_ycounts['yarn_type_name'].'</option>';
		}

	   $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
	   $color_list='';
		while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
			$color_list .='<option value="'.$res_ycolor['colour_name'].'">'.$res_ycolor['colour_name'].'</option>';
		}

		$sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
		$content_list='';
		while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
			$content_list .='<option value="'.$res_content['content_name'].'">'.$res_content['content_name'].'</option>';
		 }

		$selcomp = mysqli_query($zconn,"select * from components where status='0'");
		$comp_list='';
		while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
			$comp_list .='<option value="'.$res_comp['comp_name'].'">'.$res_comp['comp_name'].'</option>';
		}

		$sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
		$uom_list ='';
		while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
			$uom_list .='<option value="'.$res_uom['uom_name'].'">'.$res_uom['uom_name'].'</option>';
		}

		$sql_uom1 = mysqli_query($zconn,"select * from color_master where status='0'");
		$uom_list1 ='';
		while($res_uom1 =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
			$fabric .='<option value="'.$res_uom1['colour_name'].'">'.$res_uom1['colour_name'].'</option>';
		}


		  ?>
<script type="text/javascript">
$(document).ready(function(){
	//$('.left-sidebar').slideToggle();
});

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#example td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		var index = $("#example tbody tr:last-child").index();
		var newc = parseInt(index)+parseInt(1);
        var row = '<tr >' +
            '<td><select class="select2 form-control custom-select chosen-select" id="yname'+newc+'" name="yname[]"><option>Select</option><?php echo $ynamelist;?></select></td>' +
            '<td><select class="select2 form-control custom-select chosen-select" id="ycount'+newc+'" name="ycount[]"><option> Select</option><?php echo $ycountlist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="ytype'+newc+'" name="ytype[]" onchange="sel_ytype(this.value,\''+newc+'\');"><option>Select</option><?php echo $ytypes;?></select></td>' +
            '<td><select class="select2 form-control custom-select" name="ycolor[]" id="ycolor'+newc+'"><option>Select</option><?php echo $color_list;?></select></td>' +
            '<td><select class="select2 form-control custom-select chosen-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $content_list;?></select></td>' +
            '<td><select class="select2 form-control custom-select chosen-select" id="fabric_name'+newc+'" name="fabric_name[]"><option> Select</option><?php echo $fabric;?></select></td>' +
			'<td><select class="select2 form-control custom-select chosen-select" name="ycomp[]" id="ycomp'+newc+'"><option>Select</option><?php echo $comp_list;?></select></td>'+
            '<td><input type="text" class="form-control" name="consumption_val[]" id="consumption_val'+newc+'"></td>' +
            '<td><input type="text" class="form-control" name="consumption_per[]" id="consumption_per'+newc+'" placeholder="(%)" onkeyup="cal_yarn_pcs('+newc+');"></td>' +
            '<td><input type="text" class="form-control" id="pcs_weight'+newc+'" name="pcs_weight[]" placeholder="PCs.Wt"></td>' +
            '<td><select class="select2 form-control custom-select" name="uom[]" id="uom'+newc+'"><option>Select</option><?php echo $uom_list;?></select></td>' +
            '<td><input type="text" class="form-control" id="yrate'+newc+'" name="yrate[]" placeholder="Rate" onkeyup="cal_amount('+newc+');"></td>' +
            '<td><input type="text" class="form-control totl" id="ytotal'+newc+'" placeholder="Total" name="ytotal[]" value="0"></td>' +
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
    	$("#example").append(row);
		$(".chosen-select").chosen({
		no_results_text: "Oops, nothing found!"
		})
		$("#example tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
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
			sum_grand();
		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
		sum_grand();
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		//$(".add-new").removeAttr("disabled");
		sum_grand();
    });
});

// To get buyer short name for costing number
function sum_grand(){
	var sum = 0;
	$('.totl').each(function(){
		sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
	});
	if(sum==NaN){
		$('#grand_total').val('0');	
	} else {
		$('#grand_total').val(sum.toFixed(2));
	}
}

function buyer_costing(sh_name){
	var sname = sh_name.split('~~');
	var cno = $('#cost_no').val();
	var nc = sname['0']+"-"+cno;
	$('#costing_no').val(nc);
	sum_grand();
}

function cal_yarn_pcs(id){
    var t1 = document.getElementById('consumption_val'+id).value;
	var t2 = document.getElementById('consumption_per'+id).value;
    var t3 = ((parseFloat(t1))*(parseFloat(t2)));
	document.getElementById('pcs_weight'+id).value=parseFloat(t3).toFixed(3);
	//input_sum_calculate_yarn_amount(id);
	sum_grand();
}
function cal_amount(id) {
    var t1 = document.getElementById('pcs_weight'+id).value;
    var t2 = document.getElementById('yrate'+id).value;
    var t3 = parseFloat(t1)*parseFloat(t2);
	document.getElementById('ytotal'+id).value = parseFloat(t3).toFixed(2);
  //  input_sum_calculate_yarn();
  sum_grand();
}

$('#costing_date').datepicker({
	format:'dd-mm-yyyy',
      autoclose: true
    })

function sel_ytype(yt,rw){
	if(yt=='Cora'){
		$('#ycolor'+rw).attr('disabled',true);
	} else {
		$('#ycolor'+rw).attr('disabled',false);
	}
}
	
	function chkweight(){
			var tw = $('#totweight').val();
			var gr = $('#grand_total').val();
			if(tw!=gr && tw <'0'){
				alert("Planning Total must be equal to Total Weight");
				return false;
			} else {
				document.getElementById("knit_plan").submit();
			}
		}
</script>
</body>
</html>