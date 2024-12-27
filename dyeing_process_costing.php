<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}
$id=$_GET['id'];
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

if($_REQUEST['costing_no']!=''){
		$sel_costing = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM  `costing_entry_master` where id='".$_REQUEST['costing_no']."'"),MYSQLI_ASSOC);


		$sel_buyer = mysqli_fetch_array(mysqli_query($zconn,"select buyer_name from buyer_master where buyer_id='".$sel_costing['buyer_id']."'"),MYSQLI_ASSOC);
		$costing_date_arr = explode("-",$sel_costing['costing_date']);
		$costing_date = $costing_date_arr['2']."-".$costing_date_arr['1']."-".$costing_date_arr['0'];
		$comp_list ='';

		$sel_cost_details = mysqli_query($zconn,"select * from costing_entry_details WHERE  `costing_id` =  '".$_REQUEST['costing_no']."'");
		while($res_det = mysqli_fetch_array($sel_cost_details,MYSQLI_ASSOC))
		{
			$comp_list .="<option value='".$res_det['comp_group']."'>".$res_det['comp_group']."</option>";
		}
}

if(isset($_POST['save'])){
	extract($_POST);
	$sel_buyer1 = mysqli_fetch_array(mysqli_query($zconn,"delete from dyeing_costing where costing_no='".$id."'"),MYSQLI_ASSOC);
	if ($id!='') {
		$insert_fab_costing = mysqli_query($zconn,"update  dyeing_costing_list set(order_no='".$_POST['order_no']."',style_no='".$_POST['style_no']."',total='".$_POST['total']."',created_by='".$_SESSION['userid']."',created_date=now(),buyer='".$_POST['buyer']."'  where costing_no='$id'");
	}else{
	$insert_fab_costing = mysqli_query($zconn,"insert into dyeing_costing_list(costing_no,order_no,style_no,total,created_by,created_date,buyer) values('".$costing_no."','".$_POST['order_no']."','".$_POST['style_no']."','".$_POST['total']."','".$_SESSION['userid']."',now(),'".$_POST['buyer']."')");
}
	$trows = count($_POST['colour']);
	for($i=0;$i<$trows;$i++){
		$insert_fab_costing = mysqli_query($zconn,"insert into dyeing_costing(costing_no,color_name,weight,rate,rate_pcs,total,created_by,created_date,fabric_name,fabric_type) values('".$costing_no."','".$_POST['colour'][$i]."','".$_POST['weight'][$i]."','".$_POST['rate'][$i]."','".$_POST['rate_pcs'][$i]."','".$_POST['total'][$i]."','".$_SESSION['userid']."',now(),'".$_POST['fabric_name'][$i]."','".$_POST['fabric_type'][$i]."')");
	}
	if($insert_fab_costing){
	echo "<script>alert('Dyeing cost Added successfully');</script>";
	echo "<script>window.location.href='dyeing_costing_list.php';</script>";
	}
}
$sel_buyer1 = mysqli_fetch_array(mysqli_query($zconn,"select * from dyeing_costing_list where costing_no='".$id."'"),MYSQLI_ASSOC);
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
    <title><?php echo SITE_TITLE;?> - Dyeing Process Costing Entry</title>
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
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dyeing Process Costing Entry</h4>
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
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
				<form name="dye_process_costing" method="post" id="form">
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
											 style="width:150px" class="select2 form-control custom-select chosen-select"
											 onchange="this.form.submit();" name="costing_no" id="costing_no">
										<option value="">Select</option>
										<?php  if($_REQUEST['id']==''){
						$sel_costing1 = mysqli_query($zconn,"select * from costing_entry_master where id NOT IN(select costing_no from dyeing_costing_list) AND cost_type = 'yarn' ");
												} else {
							$sel_costing1 = mysqli_query($zconn,"select * from costing_entry_master where id IN(select costing_no from dyeing_costing_list) AND cost_type = 'yarn'");						
												}
										
										
										
					
										while($res_costing = mysqli_fetch_array($sel_costing1,MYSQLI_ASSOC)){
											if($_REQUEST['id']!=''){
												$costing_id = $_REQUEST['id'];
											} else {
												$costing_id = $_REQUEST['costing_no']; 
											}
											
											if($res_costing['id']==$costing_id){
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
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Indent No</label>
												<div class="col-sm-6">
													<?php 
													if($_REQUEST['costing_no']==''){ ?>
														<input type="text" class="form-control" name="order_no" readonly id="lname" value="<?php echo $sel_buyer1['order_no'];?>">

														<?php } else{ ?>

													<input type="text" class="form-control" name="order_no" readonly id="lname" value="<?php echo $sel_costing['order_no'];?>">
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
													if($_REQUEST['costing_no']==''){ ?>
														<input type="text" class="form-control"  name="buyer" readonly id="lname" value="<?php echo $sel_buyer1['buyer_name'];?>">

														<?php } else{ ?>

													<input type="text" class="form-control"  name="buyer" readonly id="lname" value="<?php echo $sel_buyer['buyer_name'];?>">
												<?php } ?>



													
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style Code</label>
												<div class="col-sm-6">
													<?php 
													if($_REQUEST['costing_no']==''){ ?>
														<input type="text" class="form-control" name="style_no" readonly id="lname" value="<?php echo $sel_buyer1['style_no'];?>">

														<?php } else{ ?>

													<input type="text" class="form-control" name="style_no" readonly id="lname" value="<?php echo $sel_costing['style_no'];?>">
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


										<table class="table">
											<thead style="background-color: #351a1aa6; color: #fff; padding: 0px; font-size: 16px;">
												<tr>
													<!-- <th>Yarn Name</th> -->
													<th>Fabric Name</th>
													<th>Fabric Colour</th>
													<th>Type</th>
													<th>UOM</th>
													<th>PCs/Weight</th>
												</tr>
											</thead>
											<?php

											if ($_REQUEST['costing_no']=='') {

												$sel_cost_details1 = mysqli_query($zconn,"select * from costing_entry_details WHERE  `costing_id` =  '".$id."'");
												while($res_det1 = mysqli_fetch_array($sel_cost_details1,MYSQLI_ASSOC)) { 
												$sel_cost = mysqli_fetch_array(mysqli_query($zconn,"select  consumption_percent, pcs_weight  from costing_entry_details WHERE fabric_name ='".$res_det1['fabric_name']."' and `costing_id` =  '".$id."'"));
											 ?>
												<tr id="example2">
												<td>
														<input type="text" class="form-control" id="fname" readonly value="<?php echo $res_det1['yarn_name'];?>">
													</td> 
													<td>
														<input type="text" class="form-control" id="yname" readonly value="<?php echo $res_det1['fabric_name'];?>">
														<input type="text" class="form-control" id="yname" readonly value="<?php echo $res_det1['comp_id'];?>">

													</td>
													<td>

														
														<input type="text" class="form-control" id="fname" readonly value="<?php 
														$totclr=mysqli_query($zconn,"select * from costing_entry_details WHERE fabric_name ='".$res_det1['fabric_name']."' and `costing_id` =  '".$id."'");
														while($clr=mysqli_fetch_array($totclr)){
														echo $clr['f_color'].",";	
														}
														?>">
													</td>
													<td>
														<input type="text" class="form-control" id="fname" readonly value="<?php 
														$totclr=mysqli_query($zconn,"select * from costing_entry_details WHERE fabric_name ='".$res_det1['fabric_name']."' and `costing_id` =  '".$id."'");
														while($clr=mysqli_fetch_array($totclr)){
														echo $clr['yarn_type'].",";	
														}
														?>">
													</td>
												<!--	<td>
														<input type="text" class="form-control" id="fname" readonly value="<?php //echo $sel_cost['consumption_percent'];?>">
													</td>-->
													<td>
														<input type="text" class="form-control" id="fname" readonly value="<?php echo number_format($sel_cost['pcs_weight'],2);?>">
													</td>
												</tr>
											<?php } ?>
											
										</table>
									</div>
									<h4 class="page-title"><b>Material Details</b></h4>

									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th>Fabric Name</th>
												<th>Colour</th>
												<th>Weight</th>
												<th>Rate/Kg</th>
												<th>Rate/PC</th>
												<th>Total</th>
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"  onclick = "CountRows()"></i></button></th>
											</tr>
										</thead>
										<div id="tott"></div>
										<tbody>
											<?php 
                                                
												$sel_cost_details11 = mysqli_query($zconn,"select * from dyeing_costing WHERE  `costing_no` ='".$id."' and `costing_no` !=''");
												while($res_det11 = mysqli_fetch_array($sel_cost_details11,MYSQLI_ASSOC)) { 
												 ?>
											<tr id="delete_0">
												<td>
        <select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select chosen-select" data-no="0" name="fabric_name[]" id="fabric_name" onchange="fabric(this);">
            <?php
            $selected_fabric_name = $res_det11['fabric_name'];
            echo '<option value="' . $selected_fabric_name . '" selected>' . $selected_fabric_name . '</option>';
            echo '<option>--Select--</option>';
            
            $sel_cost_details1 = mysqli_query($zconn, "SELECT DISTINCT(fabric_name) AS fabric_name FROM costing_entry_details WHERE `costing_id` = '" . $id . "'");
            while ($res_det1 = mysqli_fetch_array($sel_cost_details1, MYSQLI_ASSOC)) {
                $fabric_name = $res_det1['fabric_name'];
                if ($fabric_name != $selected_fabric_name) {
                    echo '<option value="' . $fabric_name . '">' . $fabric_name . '</option>';
                }
            }
            ?>
        </select>
    </td>

    <td>
        <select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select" name="colour[]">
            <?php
            $selected_color_name = $res_det11['color_name'];
            echo '<option value="' . $selected_color_name . '" selected>' . $selected_color_name . '</option>';
            echo '<option>Select</option>';
            
            $sel_fab = mysqli_query($zconn, "SELECT * FROM `color_master`");
            while ($res_fab = mysqli_fetch_array($sel_fab, MYSQLI_ASSOC)) {
                $colour_name = $res_fab['colour_name'];
                if ($colour_name != $selected_color_name) {
                    echo '<option value="' . $colour_name . '">' . $colour_name . '</option>';
                }
            }
            ?>
        </select>
        <script type="text/javascript">
            $(".chosen-select").chosen({
                no_results_text: "Oops, nothing found!"
            })
        </script>
    </td>
												<td>
													<!-- <span id="weight_0"></span> -->
													<input type="text" name="weight[]" value="<?php echo $res_det11['weight'];?>" id="weight_0" class="form-control wei" autocomplete="off"  >
												<!-- 	<input type="text" name="weight[]" id="weight0" class="form-control wei" autocomplete="off" onkeyup="cal_amt('0');" onkeyup="cal_amt('0');"> -->
												</td>
												<td>
														<input type="text" class="form-control" value="<?php echo $res_det11['rate'];?>"  id="rate0" placeholder="Rate" name="rate[]" autocomplete="off" onkeyup="cal_amt('0');" onkeyup="cal_amt('0');">
												</td>
												<td>
														<input type="text" class="form-control single" value="<?php echo number_format($res_det11['rate_pcs'],2);?>" id="rate_pcs0" name="rate_pcs[]" placeholder="Rate/Pcs" readonly>
												</td>
												<td>
														<input type="text" class="form-control totl" id="total0" value="<?php echo $res_det11['total'];?>" readonly name="total[]">
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new" onclick = "CountRowsn()"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
										<?php } ?>
										</tbody>
										<div id="weiht"></div>
										<tbody>
											<tr id="delete_0">
												<td></td>
												<td><!-- <input type="text" class="form-control" id="rowtot" value="1" readonly placeholder="" style="border: 1px solid #000;">
												</td> --></td>
												<td>
													 <!--  <h6 class="page-title">Pcs Rate :</h6> -->

												</td>
												<td>
														<!-- <input type="text" class="form-control" id="single_pcs" readonly placeholder="" style="border: 1px solid #000;"> -->
												</td>
												<td>
													 <!--  <h6 class="page-title">Total Cost:</h6> -->

												</td>
												<td>
														<!-- <input type="text" class="form-control" value="0" id="total_cost" readonly placeholder="" style="border: 1px solid #000;"> -->
												</td>
												<td>
													
												</td>
											</tr>
										</tbody>
									</table>
											<?php } else{ 
											$sel_cost_details1 = mysqli_query($zconn, "SELECT id, fabric_name,f_color, GROUP_CONCAT(yarn_colour) AS all_colours, GROUP_CONCAT(yarn_type) AS all_types, GROUP_CONCAT(uom_id) AS all_uom, SUM(pcs_weight) AS total_pcs_weight,comp_id FROM costing_entry_details WHERE `costing_id` = '".$_REQUEST['costing_no']."' GROUP BY fabric_name, id");

while ($res_det1 = mysqli_fetch_array($sel_cost_details1, MYSQLI_ASSOC)) {
    // Rest of your code to display the data


?>
    <tr id="example2">
        <td>
            <input type="text" class="form-control" id="yname" readonly value="<?php echo $res_det1['fabric_name']; ?>">
        </td>
        <td>
            <input type="text" class="form-control" id="fname" readonly value="<?php echo $res_det1['f_color']; ?>">
            <input type="hidden" class="form-control" id="fname" name="fabric_type[]" readonly value="<?php echo $res_det1['comp_id']; ?>">

        </td>
        <td>
            <input type="text" class="form-control" id="fname" readonly value="<?php echo $res_det1['all_types']; ?>">
        </td>
        <td>
            <input type="text" class="form-control" id="fname" readonly value="<?php echo $res_det1['all_uom']; ?>">
        </td>
        <td>
            <input type="text" class="form-control" id="fname" value="<?php echo number_format($res_det1['total_pcs_weight'], 2); ?>">
        </td>
    </tr>
<?php
}
?>

										</table>
									</div>
									<h4 class="page-title"><b>Material Details</b></h4>

									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th>Fabric Name</th>
												<th>Colour</th>
												<th>Weight</th>
												<th>Rate/Kg</th>
												<th>Rate/PC</th>
												<th>Total</th>
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"  onclick = "CountRows()"></i></button></th>
											</tr>
										</thead>
										<div id="tott"></div>
										<tbody>
											<tr id="delete_0">
												<td>
													<select  
											class="select2 form-control custom-select chosen-select" data-no="0" name="fabric_name[]" id="fabric_name" onchange="fabric(this);">
														<option>--Select--</option>
														<?php $sel_cost_details1 = mysqli_query($zconn,"select distinct(fabric_name)as fabric_name from costing_entry_details WHERE  `costing_id` =  '".$_REQUEST['costing_no']."'");
												while($res_det1 = mysqli_fetch_array($sel_cost_details1,MYSQLI_ASSOC)) { 
												?>
														<option value="<?php echo $res_det1['fabric_name'];?>"><?php echo $res_det1['fabric_name'];?></option>
														<?php } ?>
													</select>
												</td>

												<td>
													<select 
											class="select2 form-control custom-select chosen-select" name="colour[]">
														<option>Select</option>
													<?php $sel_fab= mysqli_query($zconn,"SELECT * FROM `color_master`");
													while($res_fab = mysqli_fetch_array($sel_fab,MYSQLI_ASSOC)){
													?>	
													<option value="<?php echo $res_fab['colour_name'];?>"><?php echo $res_fab['colour_name'];?></option>
													<?php } ?>
													</select>
													<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</td>
												<td>
													<!-- <span id="weight_0"></span> -->
													<input type="text" name="weight[]" id="weight_0" class="form-control wei" autocomplete="off"  >
												<!-- 	<input type="text" name="weight[]" id="weight0" class="form-control wei" autocomplete="off" onkeyup="cal_amt('0');" onkeyup="cal_amt('0');"> -->
												</td>
												<td>
														<input type="text" class="form-control" id="rate0" placeholder="Rate" name="rate[]" autocomplete="off" onkeyup="cal_amt('0');" onkeyup="cal_amt('0');">
												</td>
												<td>
														<input type="text" class="form-control single" id="rate_pcs0" name="rate_pcs[]" placeholder="Rate/Pcs" readonly>
												</td>
												<td>
														<input type="text" class="form-control totl" id="total0" readonly name="total[]">
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new" onclick = "CountRowsn()"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
										</tbody>
										<div id="weiht"></div>
										<tbody>
											<tr id="delete_0">
												<td></td>
												<td><!-- <input type="text" class="form-control" id="rowtot" value="1" readonly placeholder="" style="border: 1px solid #000;">
												</td> --></td>
												<td>
													 <!--  <h6 class="page-title">Pcs Rate :</h6> -->

												</td>
												<td>
														<!-- <input type="text" class="form-control" id="single_pcs" readonly placeholder="" style="border: 1px solid #000;"> -->
												</td>
												<td>
													 <!--  <h6 class="page-title">Total Cost:</h6> -->

												</td>
												<td>
														<!-- <input type="text" class="form-control" value="0" id="total_cost" readonly placeholder="" style="border: 1px solid #000;"> -->
												</td>
												<td>
													
												</td>
											</tr>
										</tbody>
									</table>

									<?php } ?>
							<div class="border-top">
								<div class="card-body" style="margin-left: 450px;">
									<button type="submit" name="save" class="btn btn-primary">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="dyeing_costing_list.php"><button type="button" class="btn btn-danger">List</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
                <!-- ============================================================== -->
            </div>
			</form>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
	<br>
	<br>
	<br>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <?php  include('includes/footer.php');?>
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
<?php 

	$sel_color = mysqli_query($zconn,"select * from color_master");
	$color_list='';
	while($res_color=mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){ 
		$color_list .="<option value='".$res_color['colour_name']."'>".$res_color['colour_name']."</option>";
		}


		$sel_fabric = mysqli_query($zconn,"select distinct(fabric_name)as fabric_name from costing_entry_details WHERE  `costing_id` =  '".$_REQUEST['costing_no']."'");
	$fabric_name='';
	while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
		$fabric_name .="<option value='".$res_fabric['fabric_name']."'>".$res_fabric['fabric_name']."</option>";
		}



?>

function fabric(id){
	var datano = $(id).data('no');
	var	fabric_name =$(id).val();
	var	costing_no =$("#costing_no").val();
 $.ajax({
	type: 'POST',
	url:'ajax/dye_weight.php',
	data: {fabric_name:fabric_name,costing_no:costing_no},
	success:function(data){
	//	alert(data);
    $('#weight_'+datano).val(data);
	}
});

// alert(fabric);
}


    function CountRows111() {
    //     var totalRowCount = 0;
    //     var rowCount = 0;
    //     var table = document.getElementById("example");
    //     var rows = table.getElementsByTagName("tr")

    //     for (var i = 0; i < rows.length; i++) {
    //         totalRowCount++;
    //         if (rows[i].getElementsByTagName("td").length > 0) {
    //             rowCount++;
    //         }
    //     }
    //      $('#rowtot').val(rowCount); 
       
var row=$("#rowtot").val();
totcount=parseInt(row)+parseInt(1)
 $('#rowtot').val(totcount); 
    }

    function CountRowsn() {
		var sm=0;
		$('.totl').each(function(){
			sm += parseFloat($(this).val());
			//alert(sm);
		});
		$('#total_cost').val(sm);
// alert(sm);
		/*$('#total_cost').val(sm);

		var mn = $('#rowtot').val();
		var single=sm/mn;
		$('#single_pcs').val(single);*/	
    }
function cal_amt(id) {
    var weig = 0;
    var tot = 0;
    var sm = 0;
    var cons = parseFloat($('#weight_' + id).val());
    var rat = parseFloat($('#rate' + id).val());
    var ctrws = 0;

    $('.weight').each(function () {
        weig += parseFloat($(this).val());
    });

    if (!isNaN(rat)) {
        ctrws = cons * rat;
        $('#rate_pcs' + id).val(ctrws.toFixed(2));
    } else {
        $('#rate_pcs' + id).val(''); // Clear the rate_pcs if 'rat' is not a number
    }

    $('#total' + id).val(ctrws.toFixed(2));

    $('.totl').each(function () {
        sm += parseFloat($(this).val());
    });

    $('#total_cost').val(sm.toFixed(2));

    var mn = parseInt($('#rowtot').val());
    if (mn > 0) {
        var single = sm / mn;
        $('#single').val(single.toFixed(2));
    } else {
        $('#single').val('');
    }
}
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#example td:last-child").html();
	
$.getScript("https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js", function() {    
		});
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
	//	$(this).attr("disabled", "disabled");
		var color_list ="<?php echo $color_list;?>";
		var index = $("#example tbody tr:last-child").index();
				var id=parseInt(index)+parseInt(1);

        var row = '<tr>' +
            '<td><select  class="select2 form-control custom-select chosen-select" data-no="'+id+'" name="fabric_name[]" id="fabric_name'+id+'" onchange="fabric(this);"><option>--Select--</option><?php if($_REQUEST['costing_no']==''){ $sel_cost_details1 = mysqli_query($zconn,"select distinct(fabric_name)as fabric_name from costing_entry_details WHERE  `costing_id` =  '".$id."'");while($res_det1 = mysqli_fetch_array($sel_cost_details1,MYSQLI_ASSOC)) {?>
				<option value="<?php echo $res_det1['fabric_name'];?>"><?php echo $res_det1['fabric_name'];?>
				</option><?php } }else{ $sel_cost_details1 = mysqli_query($zconn,"select distinct(fabric_name)as fabric_name from costing_entry_details WHERE  `costing_id` =  '".$_REQUEST['costing_no']."'");while($res_det1 = mysqli_fetch_array($sel_cost_details1,MYSQLI_ASSOC)) {?>
					<option value="<?php echo $res_det1['fabric_name'];?>"><?php echo $res_det1['fabric_name'];?></option><?php } }?>
			 </select></td>'+'<td><select   class="select2 form-control custom-select chosen-select" name="colour[]"><option> Select</option>'+color_list+'</select></td>' + '<td><input type="text" class="form-control wei"  id="weight_'+id+'" placeholder="Weight" name="weight[]" autocomplete="off" onkeyup="cal_amt('+id+');" onkeyup="cal_amt('+id+');"></td>' +
            '<td><input type="text" class="form-control" id="rate'+id+'" placeholder="Rate" autocomplete="off" name="rate[]" onkeyup="cal_amt('+id+');" onkeyup="cal_amt('+id+');"></td>' +
            '<td><input type="text" class="form-control single" id="rate_pcs'+id+'" readonly placeholder="Rate/Pcs" autocomplete="off" name="rate_pcs[]"></td>' +
            '<td><input type="text" class="form-control totl" id="total'+id+'" readonly placeholder="Total" name="total[]"></td>' +
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new" onclick = "CountRowsn()"><i class="fa fa-minus"></i></button></a></td>' +

        '</tr>';
    	$("#example").append(row);	
		var sh = $('#rowtot').val();
		var mn = parseInt(sh)+parseInt('1');
		$('#rowtot').val(mn);

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
		var sh = $('#rowtot').val();
		var mn = parseInt(sh)-parseInt('1');
		$('#rowtot').val(mn);
		CountRowsn();
		
    });
});
</script>
</body>
</html>