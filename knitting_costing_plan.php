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
	$action="saveCosting";
} 

if($_REQUEST['id']!='' ){
	$action="updateCosting";
	$cost_sql = mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['id']."'");
	$res_cost = mysqli_fetch_array($cost_sql,MYSQLI_ASSOC);
	$cost_no = $res_cost['costing_no'];
	$res_cost['costing_date'];
	$cost_date = date_from_db($res_cost['costing_date']);
}

if($_POST['save_costing']=='saveCosting'){
	$cost_no = get_max_costno();
	$costing_date_arr = date_to_db($costing_date);

	$sel_buyer_det = explode("~~",$_POST['sel_buyer']);
	$sel_insert = mysqli_query($zconn,"insert into costing_entry_master(buyer_id,costing_no,order_no,style_no,total_value,costing_date,created_by,created_date) values('".$sel_buyer_det[1]."','".$cost_no."','".$orer_no."','".$style_no."','".$grand_total."','".$costing_date."','".$_SESSION['userid']."',now())");

	$costing_id = mysqli_insert_id($zconn);

	if($sel_insert){
		$trows = count($_POST['yname']);
		for($tr=0;$tr<$trows;$tr++){
			$ins_details = mysqli_query($zconn,"insert into costing_entry_details(costing_id,yarn_name,yarn_count,yarn_type,yarn_colour,yarn_content,comp_group,comp_id,consumption_value,consumption_percent,pcs_weight,uom_id,yarn_rate,yarn_total) values('".$costing_id."','".$_POST['yname'][$tr]."','".$_POST['ycount'][$tr]."','".$_POST['ytype'][$tr]."','".$_POST['ycolor'][$tr]."','".$_POST['content'][$tr]."','".$_POST['comp_group'][$tr]."','".$_POST['ycomp'][$tr]."','".$_POST['consumption_val'][$tr]."','".$_POST['consumption_per'][$tr]."','".$_POST['pcs_weight'][$tr]."','".$_POST['uom'][$tr]."','".$_POST['yrate'][$tr]."','".$_POST['ytotal'][$tr]."')");
		}
	}
}


if($_POST['save_costing']=='updateCosting'){
	$sel_buyer_det = explode("~~",$_POST['sel_buyer']);
	$sel_update = mysqli_query($zconn,"update costing_entry_master set buyer_id='".$sel_buyer_det[1]."',order_no='".$orer_no."', style_no='".$style_no."',total_value='".$grand_total."' where id='".$cost_id."'");

if($sel_update){
		$trows = count($_POST['yname']);
		$del_datas = mysqli_query($zconn,"delete from costing_entry_details where costing_id='".$cost_id."'");
		if($del_datas){
		for($tr=0;$tr<$trows;$tr++){
			$ins_details = mysqli_query($zconn,"insert into costing_entry_details(costing_id,yarn_name,yarn_count,yarn_type,yarn_colour,yarn_content,comp_group,comp_id,consumption_value,consumption_percent,pcs_weight,uom_id,yarn_rate,yarn_total) values('".$cost_id."','".$_POST['yname'][$tr]."','".$_POST['ycount'][$tr]."','".$_POST['ytype'][$tr]."','".$_POST['ycolor'][$tr]."','".$_POST['content'][$tr]."','".$_POST['comp_group'][$tr]."','".$_POST['ycomp'][$tr]."','".$_POST['consumption_val'][$tr]."','".$_POST['consumption_per'][$tr]."','".$_POST['pcs_weight'][$tr]."','".$_POST['uom'][$tr]."','".$_POST['yrate'][$tr]."','".$_POST['ytotal'][$tr]."')");
		}
		}
	}

	if($sel_update){
		echo "<script>alert('Updated Successfully!!!');</script>";
		echo "<script>window.location.href='costing_list.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - Knitting Process Costing</title>
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
                        <h4 class="page-title">Knitting Process Costing</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Costing Info</a></li>
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
				<form name="costing_entry" id="costing_entry" method="post">
				<input type="hidden" name="cost_no" id="cost_no" value="<?php echo $cost_no;?>">
				<input type="hidden" name="cost_id" id="cost_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
							</div>
								<div class="card-body" style="width:100%">
									<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="order_no" name="orer_no" autocomplete="off" required placeholder="order no" value="<?php echo $res_cost['order_no'];?>">
										</div>
									</div>
									<div class="form-group row">
										<h4 class="page-title"><b>Material Details</b></h4>
									</div>
								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style Code</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="style_no" name="style_no" autocomplete="off" required placeholder="style no" value="<?php echo $res_cost['style_no'];?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Date</label>
										<div class="col-sm-6">
											<input type="date" autocomplete="off" required class="form-control" id="costing_date" name="costing_date" value="<?php echo $cost_date;?>" >
										</div>
									</div>
								</div>
							</div>
									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
											<tr>
												<th>Yarn Name</th>
												<th style="width:70px;">Count</th>
												<th style="width:90px;">Type</th>
												<th>Colour</th>
												<th>Content</th>
												<th>Comp.Group</th>
												<th>Component</th>
												<th>Consumption</th>
												<th>Consumption(%)</th>
												<th>PCs.Weight</th>
												<th>UOM</th>
												<th>Rate</th>
												<th>Total</th>
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
										<tbody>
					<?php 
					
					if($_REQUEST['id']!=''){
					$cost_det = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$res_cost['id']."'");
					$rec=0;
					while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){
					?>
					<tr id="delete_<?php echo $rec;?>">
								<td>
									<select class="select2 form-control custom-select"  id="yname0" name="yname[]">
										<option>Select</option>
										<?php 
							$sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
							while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
											if($res_yname['id']==$res_cost_det['yarn_name']){
											?>
												<option selected="selected" value="<?php echo $res_yname['id'];?>"><?php echo $res_yname['yarn_name'];?></option>
											<?php } else { ?>
												<option value="<?php echo $res_yname['id'];?>"><?php echo $res_yname['yarn_name'];?></option>
											<?php } ?>
										<?php } ?>
									 </select>
								   </td>
								  <td>
									<select class="select2 form-control custom-select"  id="ycount0" name="ycount[]">
										<option>Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
										if($res_ycounts['counts_id']==$res_cost_det['yarn_count']){
										?>
											<option selected='selected' value="<?php echo $res_ycounts['counts_id'];?>"><?php echo $res_ycounts['counts_name'];?></option>
										<?php } else { ?>
											<option value="<?php echo $res_ycounts['counts_id'];?>"><?php echo $res_ycounts['counts_name'];?></option>
										<?php } ?>
										<?php } ?>
									 </select>
												</td>
												<td>
										<select class="select2 form-control custom-select" id="ytype0" name="ytype[]">
										<option value="">Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
									if($res_ycounts['id']==$res_cost_det['yarn_type']){
											?>
									<option selected value="<?php echo $res_ycounts['id'];?>"><?php echo $res_ycounts['yarn_type_name'];?></option>
									<?php } else { ?>
									<option value="<?php echo $res_ycounts['id'];?>"><?php echo $res_ycounts['yarn_type_name'];?></option>
									<?php } ?>
										<?php } ?>
										</select>
										</td>
										<td>
											<select class="select2 form-control custom-select" name="ycolor[]" id="ycolor0">
											<option>Select</option>
					<?php $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
							while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
										if($res_ycolor['id']==$res_cost_det['yarn_colour']){
											?>
											<option selected='selected' value="<?php echo $res_ycolor['id'];?>"><?php echo $res_ycolor['colour_name'];?></option>
										<?php } else { ?>
											<option value="<?php echo $res_ycolor['id'];?>"><?php echo $res_ycolor['colour_name'];?></option>

										<?php } ?>
										<?php } ?>
											</select>
												</td>
												<td>
									<select name="content[]" id="content0" class="select2 form-control custom-select">
									<option>Select</option>
									<?php $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
									while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
										if($res_content['id']==$res_cost_det['yarn_content']){
									?>
									<option selected value="<?php echo $res_content['id'];?>"><?php echo $res_content['content_name'];?></option>
									<?php } else { ?>
									<option value="<?php echo $res_content['id'];?>"><?php echo $res_content['content_name'];?></option>
									<?php } ?>
									<?php } ?>
									</select>
												</td>
									<td>
									<input type="text" name="comp_group[]" id="comp_group0" value="<?php echo $res_cost_det['comp_group'];?>" class="form-control">
									</td>
									<td>
										<select class="select2 form-control custom-select" name="ycomp[]" id="ycomp0">
										<option>Select</option>
										<?php $selcomp = mysqli_query($zconn,"select * from components where status='0'");
										while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
										if($res_comp['id']==$res_cost_det['comp_id']){
										?>
										<option selected value="<?php echo $res_comp['id'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } else { ?>
										<option value="<?php echo $res_comp['id'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } } ?>
										</select>
										</td>
										<td>
										<input type="text" class="form-control" id="consumption_val0" name="consumption_val[]" autocomplete="off" value="<?php echo $res_cost_det['consumption_value'];?>" onkeyup="cal_yarn_pcs('0');">
										</td>
										<td>
										<input type="text" class="form-control" id="consumption_per0" name="consumption_per[]" placeholder="in percentage" onkeyup="cal_yarn_pcs('0');" value="<?php echo $res_cost_det['consumption_percent'];?>" autocomplete="off">
										</td>
										<td>
										<input type="text" class="form-control" id="pcs_weight0" name="pcs_weight[]" placeholder="Pcs Weight" value="<?php echo $res_cost_det['pcs_weight'];?>" autocomplete="off">
										</td>
										<td>
										<select class="select2 form-control custom-select" name="uom[]" id="uom0">
										<option value="">Select</option>
										<?php 
										$sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
										while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
												if($res_uom['id']==$res_cost_det['uom_id']){
												?>
												<option value="<?php echo $res_uom['id'];?>" selected><?php echo $res_uom['uom_name'];?></option>
												<?php }else {?>
												<option value="<?php echo $res_uom['id'];?>"><?php echo $res_uom['uom_name'];?></option>
												<?php } ?>
												<?php } ?>
												</select>
												</td>
												<td>
													<input type="text" class="form-control" id="yrate0" name="yrate[]" placeholder="Rate" autocomplete="off" onkeyup="cal_amount('0');" value="<?php echo $res_cost_det['yarn_rate'];?>">
												</td>
												<td>
													<input type="text" class="form-control totl" id="ytotal0" name="ytotal[]" placeholder="Total" autocomplete="off" value="<?php echo $res_cost_det['yarn_total'];?>">
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
					<?php $rec++;}
					} else {
							?>
							<tr id="delete_0">
								<td>
									<select class="select2 form-control custom-select"  id="yname0" name="yname[]">
										<option value="">Select</option>
										<?php
										$sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
										while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_yname['id'];?>"><?php echo $res_yname['yarn_name'];?></option>
										<?php } ?>
									 </select>
								   </td>
								  <td>
									<select class="select2 form-control custom-select" id="ycount0" name="ycount[]">
										<option value="">Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_ycounts['counts_id'];?>"><?php echo $res_ycounts['counts_name'];?></option>
										<?php } ?>
									 </select>
												</td>
												<td>
										<select class="select2 form-control custom-select" id="ytype0" name="ytype[]">
										<option value="">Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_ycounts['id'];?>"><?php echo $res_ycounts['yarn_type_name'];?></option>
										<?php } ?>
										</select>
										</td>
										<td>
											<select class="select2 form-control custom-select" name="ycolor[]" id="ycolor0">
											<option value="">Select</option>
									<?php
										$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
										while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_ycolor['id'];?>"><?php echo $res_ycolor['colour_name'];?></option>
										<?php } ?>
											</select>
												</td>
												<td>
												<select name="content[]" id="content0" class="select2 form-control custom-select">
												<option>Select</option>
									<?php $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
									while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){ ?>
									<option value="<?php echo $res_content['id'];?>"><?php echo $res_content['content_name'];?></option>
									<?php } ?>
									</select>
												</td>
									<td>
										<input type="text" name="comp_group[]" id="comp_group0" class="form-control">
									</td>
									<td>
										<select class="select2 form-control custom-select" name="ycomp[]" id="ycomp0">
										<option value="">Select</option>
										<?php $selcomp = mysqli_query($zconn,"select * from components where status='0'");
										while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
										?>
										<option value="<?php echo $res_comp['id'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } ?>
										</select>
										</td>
										<td>
										<input type="text" class="form-control" id="consumption_val0" name="consumption_val[]" autocomplete="off" onkeyup="cal_yarn_pcs('0');">
										</td>
										<td>
										<input type="text" class="form-control" id="consumption_per0" name="consumption_per[]" placeholder="in percentage" onkeyup="cal_yarn_pcs('0');" autocomplete="off">
										</td>
										<td>
										<input type="text" class="form-control" id="pcs_weight0" name="pcs_weight[]" placeholder="Pcs Weight" autocomplete="off">
										</td>
										<td>
										<select class="select2 form-control custom-select" name="uom[]" id="uom0">
												<option value="">Select</option>
												<?php $sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
												while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
												?>
												<option value="<?php echo $res_uom['id'];?>"><?php echo $res_uom['uom_name'];?></option>
												<?php } ?>
										</select>
												</td>
												<td>
													<input type="text" class="form-control" id="yrate0" name="yrate[]" placeholder="Rate" autocomplete="off" onkeyup="cal_amount('0');">
												</td>
												<td>
													<input type="text" class="form-control totl" id="ytotal0" name="ytotal[]" placeholder="Total" autocomplete="off" value="0">
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
											
					<?php } ?>
										</tbody>
										<tbody>
											<tr id="">
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
												  <h6 class="page-title">Yarn Total:</h6></td>
												<td>
											<input type="text" class="form-control" id="grand_total" name="grand_total" readonly placeholder="" style="border: 1px solid #000;">
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
									<a href="costing_list.php"><button type="button" class="btn btn-danger">List</button></a>
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
	<?php
		 $sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
		 $ynamelist= '';
		 while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
		  $ynamelist .='<option value="'.$res_yname['id'].'">'.$res_yname['yarn_name'].'</option>';
		  } 

		 $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
		 $ycountlist= '';
		 while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ycountlist .='<option value="'.$res_ycounts['counts_id'].'">'.addslashes($res_ycounts['counts_name']).'</option>';
		 }

		$sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
		$ytypes ='';
		while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ytypes ='<option value="'.$res_ycounts['id'].'">'.$res_ycounts['yarn_type_name'].'</option>';
		}

	   $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
	   $color_list='';
		while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
			$color_list .='<option value="'.$res_ycolor['id'].'">'.$res_ycolor['colour_name'].'</option>';
		}

		$sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
		$content_list='';
		while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
			$content_list .='<option value="'.$res_content['id'].'">'.$res_content['content_name'].'</option>';
		 }

		$selcomp = mysqli_query($zconn,"select * from components where status='0'");
		$comp_list='';
		while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
			$comp_list .='<option value="'.$res_comp['id'].'">'.$res_comp['comp_name'].'</option>';
		}

		$sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
		$uom_list ='';
		while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
			$uom_list .='<option value="'.$res_uom['id'].'">'.$res_uom['uom_name'].'</option>';
		}
		  ?>
<script type="text/javascript">
$(document).ready(function(){
	//$('.left-sidebar').slideToggle();
});

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		var index = $("table tbody tr:last-child").index();
		var newc = parseInt(index)+parseInt(1);
        var row = '<tr >' +
            '<td><select class="select2 form-control custom-select" id="yname'+newc+'" name="yname[]"><option>Select</option><?php echo $ynamelist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="ycount'+newc+'" name="ycount[]"><option> Select</option><?php echo $ycountlist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="ytype'+newc+'" name="ytype[]"><option>Select</option><?php echo $ytypes;?></select></td>' +
            '<td><select class="select2 form-control custom-select" name="ycolor[]" id="ycolor'+newc+'"><option>Select</option><?php echo $color_list;?></select></td>' +
            '<td><select class="select2 form-control custom-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $content_list;?></select></td>' +
            '<td><input type="text" name="comp_group[]" id="comp_group'+newc+'" class="form-control"></td>' +
			'<td><select class="select2 form-control custom-select" name="ycomp[]" id="ycomp'+newc+'"><option>Select</option><?php echo $comp_list;?></select></td>'+
            '<td><input type="text" class="form-control" name="consumption_val[]" id="consumption_val'+newc+'"></td>' +
            '<td><input type="text" class="form-control" name="consumption_per[]" id="consumption_per'+newc+'" placeholder="in percentage" onkeyup="cal_yarn_pcs('+newc+');"></td>' +
            '<td><input type="text" class="form-control" id="pcs_weight'+newc+'" name="pcs_weight[]" placeholder="Pcs.Weight"></td>' +
            '<td><select class="select2 form-control custom-select" name="uom[]" id="uom'+newc+'"><option>Select</option><?php echo $uom_list;?></select></td>' +
            '<td><input type="text" class="form-control" id="yrate'+newc+'" name="yrate[]" placeholder="Rate" onkeyup="cal_amount('+newc+');"></td>' +
            '<td><input type="text" class="form-control totl" id="ytotal'+newc+'" placeholder="Total" name="ytotal[]" value="0"></td>' +
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
    	$("table").append(row);
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
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
		$('#grand_total').val(sum);
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
    var t3 = ((parseFloat(t1))*(parseFloat(t2)/100));
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

</script>
</body>
</html>