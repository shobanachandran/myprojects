<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if($_GET['id']) { // edit 
	$edit_page = true;
	$costing_id =$_GET['id'];
	$new_page = false;
} elseif($_GET['id'] && $_REQUEST['accessor_group']) { // edit
	$costing_id = $_REQUEST['costing_no'];
	$edit_page = false;
	$new_page = true;
	$access_group = $_REQUEST['accessor_group'];
}
elseif ($_REQUEST['costing_no']) { // new
	$costing_id = $_REQUEST['costing_no'];
	$edit_page = false;
	$new_page = true;
} elseif ($_REQUEST['costing_no'] && $_REQUEST['accessor_group']) { // new
	$edit_page = false;
	$costing_id = $_REQUEST['costing_no'];
	$new_page = true;
} else {
	$edit_page = false;
	$new_page = true;
	$costing_id = "";
}
if(isset($_POST['submit1'])){
	extract($_POST);
	$del_entry1 = mysqli_query($zconn,"delete from accessories_costing_list where costing_no='".$costing_id."'");

	$sel_entry1 = mysqli_query($zconn,"delete from accessories_costing where costing_no='".$costing_id."'");


	$insert_fab_costing = mysqli_query($zconn,"insert into accessories_costing_list
	(costing_no,order_no,style_no,total,created_by,created_date,buyer,accessor_group) values
	('".$costing_id."','".$_POST['order_no']."','".$_POST['style_no']."','".$_POST['grand_total']."',
	'".$_SESSION['userid']."',now(),'".$_POST['buyer']."','".$accessor_group."')");




	$trows = count($_POST['acc_name']);
	for($i=0;$i<$trows;$i++){
		$insert_fab_costing = mysqli_query($zconn,"insert into accessories_costing(costing_no,
		acc_name,uom,consumption,descr,rate,total,created_by,created_date) values('".$costing_id."',
		'".$_POST['acc_name'][$i]."','".$_POST['uom'][$i]."','".$_POST['consumption'][$i]."',
		'".$_POST['descr'][$i]."','".$_POST['rate'][$i]."','".$_POST['total'][$i]."','".$_SESSION['userid']."',now())");
	}
	echo "<script>alert('Accessories cost Added successfully);</script>";
	echo "<script>window.location.href='accessories_costing_list.php';</script>";
}


if($edit_page || $new_page) {
	$res_costing_dt= mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$costing_id."'"),MYSQLI_ASSOC);
	$sel_buyer = mysqli_fetch_array(mysqli_query($zconn,"select buyer_name from buyer_master where buyer_id='".$res_costing_dt['buyer_id']."'"),MYSQLI_ASSOC);
		$sel_entry1 = mysqli_fetch_array(mysqli_query($zconn,"select * from accessories_costing_list where costing_no='".$costing_id."'"),MYSQLI_ASSOC);	

}
	$sel_entry_new = mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['costing_no']."'"),MYSQLI_ASSOC);	


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
    <title><?php echo SITE_TITLE;?> - Accessories Process Costing Entry</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
   
</head>

<body>
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
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
                        <h4 class="page-title">Accessories Process Costing Entry</h4>
                        &nbsp;&nbsp;&nbsp;&nbsp; <a href="costing.php"> <button type="button" class="btn btn-info">Costing Process</button></a>
					   
						<div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a style="background-color:#626F80; color:#fff; color:#fff; margin:10px; padding:10px;" href="accessories_costing_list.php">Back  </a></li>
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
												<?php 
												if($edit_page) {
													$costing_read_only = "disabled";
												} else {
													$costing_read_only = "";
												}
												?>
													<select <?php echo $costing_read_only; ?> 
													data-placeholder="Begin typing a name to filter..." 
											 class="select2 form-control custom-select chosen-select" onchange="this.form.submit();" name="costing_no">
											<!-- <option value="<?php echo $id;?>"><?php echo $id;?></option> -->
										<option value="">Select</option>
										<?php 
										if($new_page) {
											$sel_costing = mysqli_query($zconn,"select cem.id,cem.buyer_id,cem.costing_no,ac.order_no,cem.style_no,cem.total_value,cem.costing_date,cem.order_no from costing_entry_master cem left outer join accessories_costing_list ac on ac.costing_no = cem.id where ac.costing_no is NULL");	
										} else {
											$sel_costing = mysqli_query($zconn,"select * from costing_entry_master ");	
										}
										while($res_costing = mysqli_fetch_array($sel_costing,MYSQLI_ASSOC)){
										if($res_costing['id']==$costing_id){
										?>
										<option selected value="<?php echo $costing_id;?>"><?php echo $res_costing['costing_no'];?> - (<?php echo $res_costing['order_no'];?>)</option>
										<?php } else  { ?>
										<option value="<?php echo $res_costing['id'];?>">
										<?php echo $res_costing['costing_no'];?> - (<?php echo $res_costing['order_no'];?>)</option>
										<?php } ?>
										<?php } ?>
											</select>
											
												</div>
											</div>
											

											<div class="form-group row">

												<label for="lname" class="col-sm-3 text-right control-label col-form-label">
													Intent No</label>
												<div class="col-sm-6">

													<?php if($costing_no ==''){ ?>
												<!-- <input type="text" class="form-control" readonly id="order_no" name="order_no"  
												placeholder="" value="<?php echo $sel_entry_new['order_no'];?>"> -->
													 <input type="text" class="form-control" readonly id="order_no" name="order_no"  
												placeholder="" value="<?php echo $res_costing_dt['order_no'];?>"> 
											<?php } else{
													?>
												<input type="text" class="form-control" readonly id="order_no" 
												value="<?php echo $res_costing_dt['order_no']; ?>" name="order_no" placeholder="">
											<?php } ?>


													
												</div>
											</div>
											<div class="form-group row">
											</div>	
											<div class="form-group row">
												<h4 class="page-title"><b>Material Details</b></h4>
											</div>

											
										</div>

										
										<div class="card" style="width:50%; float:left; right: 50px;">
											<div class="form-group row">
												<label for="fname" class="col-sm-3 text-right control-label col-form-label">Buyer name</label>
												<div class="col-sm-6">

													<?php if($costing_id==''){?>
												<input type="text" class="form-control" readonly id="lname" name="buyer" value="<?php echo $sel_entry1['buyer'];?>">
											<?php } else{
													?>
													<input type="text" class="form-control" readonly id="buyer_name" value="<?php echo $sel_buyer['buyer_name']; ?>" name="buyer_name" placeholder="">
											<?php } ?>

													
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style Code</label>
												<div class="col-sm-6">

													<?php if($costing_id==''){?>
												<input type="text" class="form-control" readonly id="lname" name="style_no" value="<?php echo $sel_entry1['style_no'];?>">
											<?php } else{
													?>
													<input type="text" class="form-control" readonly name="style_no" 
													value="<?php echo $res_costing_dt['style_no']; ?>" id="style_no"  placeholder="">
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
									</div>
								</div>
								
												<div class="form-group row">
													<label for="lname" class="col-sm-2 text-right control-label col-form-label"> Accessories Group</label>
													<div  class="col-sm-3 text-left" >
															<?php 
															if($costing_id == "" || $edit_page) {
																$group_read_only = "disabled";
															} else {
																$group_read_only = "";
															}
															
															?>
															<select <?php echo $group_read_only; ?> data-placeholder="Begin typing a name to filter..." class="select2 form-control custom-select chosen-select" name="accessor_group" id="accessor_group" onchange="this.form.submit();" required>
															<option value="<?php echo $sel_entry1['accessor_group'];?>"><?php echo $sel_entry1['accessor_group'];?></option>
															<option>Select</option>
															<?php $accssor= mysqli_query($zconn,"select distinct(acc_group_name) as acc_group_name from accessories_group");
															while($assgroup=mysqli_fetch_array($accssor)){
																?>
																<option value="<?php echo $assgroup['acc_group_name'];?>" <?php if ($assgroup['acc_group_name']==$_REQUEST['accessor_group']) {
																	echo "selected";
																}?> ><?php echo $assgroup['acc_group_name'];?></option>
															<?php }
															?>
														</select>
														<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
													</div>
												</div>

									

								
  


									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th style="width:15%;">Accessories Name</th>
												<th style="width:15%;">UOM</th>
												<th style="width:15%;">Consumption</th>
												<th style="width:15%;">Description</th>
												<th style="width:15%;">Rate</th>
												<th style="width:15%;">Total</th>
												<th  style="width:5%;"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
										<tbody>

												<?php 
												if ($costing_id==''){
													// show nothing
													// new screen
												}
												if($costing_id!='') {
													// new entry with costing chosen
													$ass_group = mysqli_query($zconn,"select * from accessories_costing where costing_no='".$costing_id."'");
													$id=0;
													while($assdata=mysqli_fetch_array($ass_group,MYSQLI_ASSOC)){ ?>

													<tr id="rowhide" value="<?php echo $id;?>" >
														<input type="hidden" name="rowid" id="rowid_<?php echo $id;?>" value="<?php echo $id;?>">
														<td>
															<select data-placeholder="Begin typing a name to filter..." class="select2 form-control custom-select chosen-select" name="acc_name[]" id="acc_name_<?php echo $id;?>">
																<option value="<?php echo $assdata['acc_name'];?>"><?php echo $assdata['acc_name'];?></option>
																<option>Select</option>
																<?php $sel_fabric = mysqli_query($zconn,"select * from accessories_master");
															while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
																if($res_fabric['acc_name']==$assdata['acc_name']){ ?>
															<option value="<?php echo $res_fabric['acc_name'];?>" selected><?php echo $res_fabric['acc_name'];?></option>
															<?php } else{?>
																<option value="<?php echo $res_fabric['acc_name'];?>"><?php echo $res_fabric['acc_name'];?></option>
															<?php  } }?>
															</select>
														</td>
														<td>
															<select data-placeholder="Begin typing a name to filter..." class="select2 form-control custom-select chosen-select" name="uom[]" style="width:120px;"> 
																<option value="<?php echo $assdata['uom'];?>"><?php echo $assdata['uom'];?></option>
																<option>Select</option>
																	<?php $sel_fabric = mysqli_query($zconn,"select * from uom_master where status='0'");
																		while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
																			if($res_fabric['uom_name']==$assdata['uom']){ ?>
																			<option selected="selected" value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
																		<?php } else{?>
																<option value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
																		<?php } } ?>
															</select>
															<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
														</td>
														<td>
																<input type="text" class="form-control" id="consumption<?php echo $id; ?>" value="<?php echo $assdata['consumption'];?>"  name="consumption[]" placeholder="consumption" autocomplete="off" onkeyup="cal_amt(<?php echo $id; ?>);" onblur="cal_amt(<?php echo $id; ?>);">
														</td>
														<td>
																<textarea name="descr[]" id="descr"  ><?php echo $assdata['descr'];?></textarea>
														</td>
														<td>
																<input type="text" class="form-control"   value="<?php echo $assdata['rate'];?>" id="rate<?php echo $id; ?>" name="rate[]" placeholder="Rate" autocomplete="off" onkeyup="cal_amt(<?php echo $id; ?>);"  onblur="cal_amt(<?php echo $id; ?>);">
														</td>
														<td>
																<input type="text" class="form-control tramt"   value="<?php echo $assdata['total']; $tot +=$assdata['total'];?>" name="total[]" id="total<?php echo $id; ?>" readonly placeholder="Total">
														</td>
														<td>
															<a class="delete" title="Delete"><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a>
														</td>
													</tr>
													<?php $id++;
													} 
												}
												if($costing_id!='' && $_REQUEST['accessor_group']!='' ) {
												$ass_group = mysqli_query($zconn,"select * from accessories_group_details where acc_group='".$_REQUEST['accessor_group']."'");
												$id=0;
											//	while($assdata=mysqli_fetch_array($ass_group,MYSQLI_ASSOC)){ 
											// $assdata=mysqli_fetch_array($ass_group,MYSQLI_ASSOC);
											// $acc_names_arr = explode(",",$assdata['acc_names']);
											// $acc_count = mysqli_num_rows($ass_group);
													while($assdata=mysqli_fetch_array($ass_group,MYSQLI_ASSOC)){
											?>
											<tr id="rowhide" value="<?php echo $id;?>" >
												<input type="hidden" name="rowid" id="rowid_<?php echo $id;?>" value="<?php echo $id;?>">
												<td>
													<!-- <input type="text" name="acc_name[]" value="<?php echo $assdata['acc_name'];?>" style="border:none;"> -->
													<select class="select2 form-control custom-select" name="acc_name[]" id="acc_name_<?php echo $id;?>">
														<option>Select</option>
														<?php $sel_fabric = mysqli_query($zconn,"select * from accessories_master");
													while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
														if($res_fabric['acc_name']==$assdata['acc_name']){ ?>
													<option value="<?php echo $res_fabric['acc_name'];?>" selected><?php echo $res_fabric['acc_name'];?></option>
													<?php } else {?>
														<option value="<?php echo $res_fabric['acc_name'];?>"><?php echo $res_fabric['acc_name'];?></option>
													<?php } }?>
													</select>
												</td>
												<td>
													<select class="select2 form-control custom-select chosen-select" name="uom[]" style="width:120px;"> 
														<option>Select</option>
															<?php $sel_fabric = mysqli_query($zconn,"select * from uom_master where status='0'");
																while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
																	if($res_fabric['uom_name']==$assdata['uom']){ ?>
																	<option selected="selected" value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
																<?php } else{?>
														<option value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
																<?php } } ?>
													</select>
													<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</td>
												<td>
														<input type="text" class="form-control" id="consumption<?php echo $id;?>" value="<?php echo $assdata['consumption'];?>"  name="consumption[]" placeholder="consumption" autocomplete="off" onkeyup="cal_amt('<?php echo $id;?>');" onblur="cal_amt('<?php echo $id;?>');">
												</td>
												<td>
														<textarea name="descr[]" id="descr"  ><?php echo $assdata['descr'];?></textarea>
												</td>
												<td>
														<input type="text" class="form-control"  value="<?php echo $assdata['rate'];?>" id="rate<?php echo $id;?>" name="rate[]" placeholder="Rate" autocomplete="off" onkeyup="cal_amt('<?php echo $id;?>');" onblur="cal_amt('<?php echo $id;?>');">
												</td>
												<td>
														<input type="text" class="form-control tramt" readonly  value="<?php echo $assdata['total']; $tot +=$assdata['total'];?>" name="total[]" id="total<?php echo $id; ?>" readonly placeholder="Total">
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
										<?php $id++;
									  } }?>
										</tbody>
							</table>
							<table id="aacces" class="table table-striped table-bordered">
											<tr>
												<td style="width:15%;">&nbsp;</td>
												<td style="width:15%;">&nbsp;</td>
												<td style="width:15%;">&nbsp;</td>
												<td style="width:15%;">&nbsp;</td>
												
												<td style="width:15%;">
														Accessories Total:
												</td>
												<td style="width:15%;">
														<input type="text" class="form-control" name ="grand_total" id="grand_tot" value="<?php echo $tot; ?>" readonly placeholder="" style="border: 1px solid #000;">
												</td>
												<td style="width:5%;">&nbsp;</td>
											</tr>
							</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 450px;">
									<button type="submit" name="submit1" value="save" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="accessories_costing_list.php"><button type="button" class="btn btn-danger">List</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
                <!-- ============================================================== -->
            </div>
			
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
   
<br>
			<br>
			
<br>
	<br>
  <?php include('includes/footer.php');?>
	
    </form>
	
	
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
           
	
	
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>


    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<script type="text/javascript">
	function cal_amt(id) {
    var cons = parseFloat($('#consumption' + id).val());
    var rat = parseFloat($('#rate' + id).val());
    var ctrws = 0;
    
    if (!isNaN(cons) && !isNaN(rat)) {
        ctrws = (cons * rat).toFixed(2);
    }
    
    $('#total' + id).val(ctrws);

    var sum = 0;
    $('.tramt').each(function () {
        sum += parseFloat($(this).val());
    });

    $('#grand_tot').val(sum.toFixed(2));
}
// 	function sel_details(costing_id){
// 	$.ajax({
// 			url : 'ajax/costing.php',
// 			data: {
// 			   action: "get_cost_details",
// 			   costing_id: costing_id
// 			},
// 			success: function( data ) {
// 				//alert(data);
// 				data = data.split("~~");
// 				$('#order_no').val(data['0']);
// 				$('#style_no').val(data['1']);
// 				$('#buyer_name').val(data['2']);
// 				$('#order_date').val(data['0']);
// 			},
// 			error: function (textStatus, errorThrown) {
// 				//DO NOTHINIG
// 			}
// 		});
// }
	<?php
	$sel_fabric = mysqli_query($zconn,"select * from accessories_master");
	$acc_list='';
	while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
		$acc_list .="<option value='".$res_fabric['acc_name']."'>".$res_fabric['acc_name']."</option>";
		} 
		
		$sel_uom = mysqli_query($zconn,"select * from uom_master");
	$uom_list='';
	while($res_color=mysqli_fetch_array($sel_uom,MYSQLI_ASSOC)){ 
		$uom_list .="<option value='".$res_color['uom_name']."'>".$res_color['uom_name']."</option>";
		} 
		?>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#example td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
	//	$(this).attr("disabled", "disabled");
		var acc_list ="<?php echo $acc_list;?>";
		var uom_list ="<?php echo $uom_list;?>";

		var index = $("#example tbody tr:last-child").index();
		var id=parseInt(index)+parseInt(1);
        var row = '<tr>' +
            '<td style="padding:0px;"><select class="select2 form-control custom-select chosen-select" name="acc_name[]"><option> Select</option>'+acc_list+'</select></td>' +
            '<td style="padding:0px;"><select class="select2 form-control custom-select chosen-select" name="uom[]"><option> Select</option>'+uom_list+'</select></td>' +
            '<td style="padding:0px;"><input type="text" class="form-control" id="consumption'+id+'" placeholder="consumption" onkeyup="cal_amt('+id+');" onblur="cal_amt('+id+');" name="consumption[]"></td>' +
            '<td style="padding:0px;"><textarea name="descr[]"></textarea></td>' +
            '<td style="padding:0px;"><input type="text" class="form-control" id="rate'+id+'" placeholder="Rate" name="rate[]" onkeyup="cal_amt('+id+');" onblur="cal_amt('+id+');"></td>' +
            '<td style="padding:0px;"><input type="text" class="form-control tramt" id="total'+id+'" name="total[]" readonly placeholder="Total" ></td>' +
			'<td style="padding:0px;"><a class="delete" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a></td>' +

        '</tr>';
    	$("#example").append(row);
		$("#example tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
		$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
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
		var sum = 0;
		$('.tramt').each(function(){
			sum += parseFloat($(this).val());
		});
		$('#grand_tot').val(sum);
    });
});
</script>
