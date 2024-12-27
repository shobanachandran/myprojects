<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}
$id=$_GET['id'];
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
if(isset($_POST['save'])){
	extract($_POST);
	$sel_entry1 = mysqli_query($zconn,"delete from fabric_costing where costing_no='".$_GET['id']."'");
	if ($id!='') {
		$insert_fab_costing = mysqli_query($zconn,"update  fabric_costing_list set costing_no='".$costing_no."', order_no='".$_POST['order_no']."',style_no='".$_POST['style_no']."',total='".$_POST['total']."',created_by='".$_SESSION['userid']."',created_date=now(),buyer='".$_POST['buyer']."'  where costing_no='$id'");	
	}else{
	$insert_fab_costing = mysqli_query($zconn,"insert into fabric_costing_list(costing_no,order_no,style_no,total,created_by,created_date,buyer) values('".$costing_no."','".$_POST['order_no']."','".$_POST['style_no']."','".$_POST['total']."','".$_SESSION['userid']."',now(),'".$_POST['buyer']."')");
}
	$trows = count($_POST['fabric']);
	for($i=0;$i<$trows;$i++){
		$insert_fab_costing = mysqli_query($zconn,"insert into fabric_costing(costing_no,fabric_name,fab_content,fab_colour,fab_dia,fab_gsm,fab_uom,fab_consumption,fab_rate,fab_total,created_by,created_date) values('".$costing_no."','".$_POST['fabric'][$i]."','".$_POST['content'][$i]."','".$_POST['color'][$i]."','".$_POST['dia'][$i]."','".$_POST['gsm'][$i]."','".$_POST['uom'][$i]."','".$_POST['consumption'][$i]."','".$_POST['rate'][$i]."','".$_POST['total'][$i]."','".$_SESSION['userid']."',now())");
	}
	echo "<script>alert('Fabric cost Added successfully);</script>";
	echo "<script>window.location.href='fabric_costing_list.php';</script>";
}
$sel_entry1 = mysqli_fetch_array(mysqli_query($zconn,"select * from fabric_costing_list where costing_no='".$_GET['id']."'"),MYSQLI_ASSOC);
if(isset($_POST['costing_no'])){
	$sel_costing1= mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['costing_no']."'"),MYSQLI_ASSOC);
$sel_buyer = mysqli_fetch_array(mysqli_query($zconn,"select buyer_name from buyer_master where buyer_id='".$sel_costing1['buyer_id']."'"),MYSQLI_ASSOC);
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
    <title><?php echo SITE_TITLE;?> - Fabric Costing Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>   
</head>
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
                        <h4 class="page-title">Fabric Costing Entry</h4>
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
				<form method="post" name="fabric_costing">
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
													<select class="select2 form-control custom-select chosen-select" onchange="this.form.submit();" name="costing_no">
														<option value="<?php echo $id; ?>"><?php echo $id; ?></option>
										<option value="">Select</option>
										<?php $sel_costing = mysqli_query($zconn,"select * from costing_entry_master where cost_type='fabric'");
										while($res_costing = mysqli_fetch_array($sel_costing,MYSQLI_ASSOC)){
											if($res_costing['id']==$_REQUEST['costing_no']){
										?>
										<option selected value="<?php echo $res_costing['id'];?>"><?php echo $res_costing['costing_no'];?></option>
										<?php } else  { ?>
										<option value="<?php echo $res_costing['id'];?>">
										<?php echo $res_costing['costing_no'];?> - (<?php echo $res_costing['order_no'];?>)
									</option>
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

													<?php if($_REQUEST['costing_no']==''){?>
												<input type="text" class="form-control" readonly id="lname" name="order_no"  placeholder="" value="<?php echo $sel_entry1['order_no'];?>">
											<?php } else{
													?>
												<input type="text" class="form-control" value="<?php echo $sel_costing1['order_no'];?>" readonly id="order_no" name="order_no" placeholder="">
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
													<?php if($_REQUEST['costing_no']==''){?>
												<input type="text" class="form-control" readonly id="lname" name="buyer" value="<?php echo $sel_entry1['buyer'];?>">
											<?php } else{
													?>
													<input type="text" class="form-control" value="<?php echo $sel_buyer['buyer_name'];?>" readonly id="buyer_name" name="buyer" placeholder="">
											<?php } ?>	
													
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style Code</label>
												<div class="col-sm-6">

													<?php if($_REQUEST['costing_no']==''){?>
												<input type="text" class="form-control" readonly id="lname" name="style_no" value="<?php echo $sel_entry1['style_no'];?>">
											<?php } else{
													?>
													<input type="text" class="form-control" readonly name="style_no" id="style_no"  placeholder="" value="<?php echo $sel_costing1['style_no'];?>">
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

									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th>Fabric Name</th>
												<th>Content</th>
												<th>Fabric Colour</th>
												<th>Dia</th>
												<th>GSM</th>
												<th>UOM</th>
												<th>Pcs/weight</th>
												<th>Rate</th>
												<th>Total</th>
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
										<tbody>
											<?php if($_REQUEST['costing_no']==''){ $totfabric=0;
												$sel_fabric001 = mysqli_query($zconn,"select * from fabric_costing where costing_no='$id'");
												while($res_fabric01=mysqli_fetch_array($sel_fabric001,MYSQLI_ASSOC)){ ?>
													<tr id="delete_0" >
												<td style="padding:0px; margin:0px;">
							<select class="select2 form-control custom-select" name="fabric[]" style="width:150px;">
							<option value="<?php echo $res_fabric01['fabric_name'];?>"><?php echo $res_fabric01['fabric_name'];?></option>
							<option>Select</option>
							<?php $sel_fabric = mysqli_query($zconn,"select * from fabric_master");
							
							while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['fabric_name'];?>"><?php echo $res_fabric['fabric_name'];?></option>
							<?php } ?>
													</select>
												</td>
												<td style="padding:0px; margin:0px;">
													<select class="select2 form-control custom-select chosen-select" name="content[]" style="width:100px;"><option value="<?php echo $res_fabric01['fab_content'];?>"><?php echo $res_fabric01['fab_content'];?></option>
														<option>Select</option>
						<?php $sel_fabric = mysqli_query($zconn,"select * from content_master where status='0'");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['content_name'];?>"><?php echo $res_fabric['content_name'];?></option>
							<?php } ?>
													</select>
												</td>
												<td style="padding:0px; margin:0px;">
													<select class="select2 form-control custom-select chosen-select" name="color[]" style="width:100px;">
														<option value="<?php echo $res_fabric01['fab_colour'];?>"><?php echo $res_fabric01['fab_colour'];?></option>
														<option>Select</option>
<?php $sel_fabric = mysqli_query($zconn,"select * from color_master where status='0'");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['colour_name'];?>"><?php echo $res_fabric['colour_name'];?></option>
							<?php } ?>
							</select>
												</td>
												<td style="padding:0px; margin:0px;">
													<select class="select2 form-control custom-select chosen-select" name="dia[]" style="width:100px;">
														<option value="<?php echo $res_fabric01['fab_dia'];?>"><?php echo $res_fabric01['fab_dia'];?></option>
														<option>Select</option>
			<?php $sel_fabric = mysqli_query($zconn,"select * from dia_master where status='0'");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['dia_name'];?>"><?php echo $res_fabric['dia_name'];?></option>
							<?php } ?>
							</select>
													</select>
												</td>
												<td style="padding:0px; margin:0px;">
													<select class="select2 form-control custom-select chosen-select" name="gsm[]" style="width:100px;">
														<option value="<?php echo $res_fabric01['fab_gsm'];?>"><?php echo $res_fabric01['fab_gsm'];?></option>
														<option>Select</option>
<?php $sel_fabric = mysqli_query($zconn,"select * from gsm_master where status='0'");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['gsm_name'];?>"><?php echo $res_fabric['gsm_name'];?></option>
							<?php } ?>														
													</select>
												</td>
												<td style="padding:0px; margin:0px;">
													<select name="uom[]" class="select2 form-control custom-select chosen-select" style="width:100px;">
														<option value="<?php echo $res_fabric01['fab_uom'];?>"><?php echo $res_fabric01['fab_uom'];?></option>
														<option>Select</option>
										<?php $sel_fabric = mysqli_query($zconn,"select * from uom_master where status='0'");
									while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
							<?php } ?>
							</select>
							<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</td>
												<td style="padding:0px; margin:0px;">
														<input type="text" class="form-control" id="consumption0" name="consumption[]" onblur="cal_amt('0');" onkeyup="cal_amt('0');" value="<?php echo $res_fabric01['fab_consumption']; ?>"  placeholder="Consumption">
												</td>
												<td style="padding:0px; margin:0px;">
														<input type="text" class="form-control" id="rate0" name="rate[]" placeholder="Rate" onblur="cal_amt('0');" value="<?php echo $res_fabric01['fab_rate']; ?>" onkeyup="cal_amt('0');">
												</td>
												<td style="padding:0px; margin:0px;">
														<input type="text" class="form-control tramt" value="<?php echo $res_fabric01['fab_total'];$totfabric += $res_fabric01['fab_total']; ?>" id="total0" name="total[]" placeholder="Total" readonly>
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
											<?php } } else{ 
												
												
												$cost_det = mysqli_query($zconn, "SELECT * FROM costing_entry_details WHERE costing_id='" . $_REQUEST['costing_no'] . "'");
$rec = 1;

while ($res_cost_det = mysqli_fetch_array($cost_det, MYSQLI_ASSOC)) {
    $sel_cost_fab = mysqli_query($zconn, "SELECT * FROM costing_entry_details WHERE costing_id='" . $_REQUEST['costing_no'] . "' AND fabric_name='" . $res_cost_det['fabric_name'] . "'");
    
    $yarn_name = '';
    $yarn_type = '';
    $yarn_colour = '';
    $fab_type = '';
    $cons_value = [];
    $totpcs = 0;

    while ($res_cost = mysqli_fetch_array($sel_cost_fab, MYSQLI_ASSOC)) {
        $fabric_name = $res_cost['fabric_name'] ;
       $content = $res_cost['yarn_content'] ;
        $yarn_colour = $res_cost['f_color'] ;
        $fab_type = $res_cost['comp_id'] ;
        $gsm= $res_cost['gsm'] ;
        $gsm= $res_cost['gsm'] ;
        $pcs_weight= $res_cost['pcs_weight'] ;
		$yarn_rate = $res_cost['yarn_rate'] ;
		$yarn_total = $res_cost['yarn_total'] ;


        $cons_value[] = $res_cost['pcs_weight'];
		
    }

												
												
												?>
												<tr id="delete_0" >
												<td style="padding:0px; margin:0px;">

<select class="select2 form-control custom-select chosen-select" name="fabric[]" style="width:150px;">
    <?php 
    $sel_fabric = mysqli_query($zconn,"SELECT * FROM fabric_master");
    
    while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){
        $optionValue = $res_fabric['fabric_name'];
        // Check if the current option value matches $fabric_name and set 'selected' attribute
        $selected = ($optionValue === $fabric_name) ? 'selected' : '';
        ?>
        <option value="<?php echo $optionValue; ?>" <?php echo $selected; ?>><?php echo $optionValue; ?></option>
        <?php 
    }
    ?>
</select>
												</td>
												<td style="padding:0px; margin:0px;">
												<select class="select2 form-control custom-select chosen-select" name="content[]" style="width:150px;">
    <?php 
    $sel_fabric = mysqli_query($zconn,"SELECT * FROM content_master");
    
    while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){
        $optionValue = $res_fabric['content_name'];
        // Check if the current option value matches $fabric_name and set 'selected' attribute
        $selected = ($optionValue === $content) ? 'selected' : '';
        ?>
        <option value="<?php echo $optionValue; ?>" <?php echo $selected; ?>><?php echo $optionValue; ?></option>
        <?php 
    }
    ?>
</select>
												<td style="padding:0px; margin:0px;">
													<select class="select2 form-control custom-select chosen-select" name="color[]" style="width:100px;">
													<?php 
    $sel_fabric = mysqli_query($zconn,"SELECT * FROM color_master");
    
    while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){
        $optionValue = $res_fabric['colour_name'];
        // Check if the current option value matches $fabric_name and set 'selected' attribute
        $selected = ($optionValue === $yarn_colour) ? 'selected' : '';
        ?>
        <option value="<?php echo $optionValue; ?>" <?php echo $selected; ?>><?php echo $optionValue; ?></option>
        <?php 
    }
    ?>
</select>
												</td>
												
													<td style="padding:0px; margin:0px;">
													<select class="select2 form-control custom-select chosen-select" name="dia[]" style="width:100px;">
													<?php 
    $sel_fabric = mysqli_query($zconn,"SELECT * FROM dia_master");
    
    while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){
        $optionValue = $res_fabric['dia_name'];
        // Check if the current option value matches $fabric_name and set 'selected' attribute
        $selected = ($optionValue === $gsm) ? 'selected' : '';
        ?>
        <option value="<?php echo $optionValue; ?>" <?php echo $selected; ?>><?php echo $optionValue; ?></option>
        <?php 
    }
    ?>
</select>
												</td>
												<td style="padding:0px; margin:0px;">
													<select class="select2 form-control custom-select chosen-select" name="gsm[]" style="width:100px;">
													<?php 
    $sel_fabric = mysqli_query($zconn,"SELECT * FROM gsm_master");
    
    while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){
        $optionValue = $res_fabric['gsm_name'];
        // Check if the current option value matches $fabric_name and set 'selected' attribute
        $selected = ($optionValue === $gsm) ? 'selected' : '';
        ?>
        <option value="<?php echo $optionValue; ?>" <?php echo $selected; ?>><?php echo $optionValue; ?></option>
        <?php 
    }
    ?>
</select>
												</td>
												<td style="padding:0px; margin:0px;">
													<select name="uom[]" class="select2 form-control custom-select chosen-select" style="width:100px;">
														<?php 
    $sel_fabric = mysqli_query($zconn,"SELECT * FROM uom_master");
    
    while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){
        $optionValue = $res_fabric['uom_name'];
        // Check if the current option value matches $fabric_name and set 'selected' attribute
        $selected = ($optionValue === $gsm) ? 'selected' : '';
        ?>
        <option value="<?php echo $optionValue; ?>" <?php echo $selected; ?>><?php echo $optionValue; ?></option>
        <?php 
    }
    ?>
</select>
							<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</td>
												<td style="padding:0px; margin:0px;">
														<input type="text" class="form-control" id="consumption0" name="consumption[]" onblur="cal_amt(0);" onchange="cal_amt('0');" value="<?php echo $pcs_weight; ?>" placeholder="Consumption">
												</td>
												<td style="padding:0px; margin:0px;">
														<input type="text" class="form-control" id="rate0" name="rate[]" placeholder="Rate" onblur="cal_amt('0');" onkeyup="cal_amt('0');" value="<?php echo $yarn_rate?>">
												</td>
												<td style="padding:0px; margin:0px;">
														<input type="text" class="form-control tramt" id="total0" name="total[]" value="<?php echo $yarn_total;?>" placeholder="Total" readonly>
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
											 <?php 
											 
											 $consumption = floatval($_POST['consumption']); // Change $_POST['consumption'] to the appropriate form field name
    $rate = floatval($_POST['rate']); // Change $_POST['rate'] to the appropriate form field name

    // Calculate total for each row
    $total = $consumption * $rate;

    // Accumulate total for grand total
    $totfabric += $yarn_total;
											 
											 $rec++; } }
											 
											  ?>

											
										</tbody>
										<tbody>
											<tr id="delete_1">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>
													Fabric Total:
												</td>
												<td colspan="3">
														<input type="text" class="form-control" value="<?php echo $totfabric; ?>" readonly placeholder="" style="border: 1px solid #000;" >
												</td>
												
											</tr>
										</tbody>
									</table>
									<input type="hidden" name="tot_rows" id="tot_rows" value="1">
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" name="save" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="fabric_costing_list.php"><button type="button" class="btn btn-danger">Back</button></a>
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
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php');?>
            <!-- End footer -->
            <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap toghether Core JavaScript -->
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

	<?php 
	$sel_fabric = mysqli_query($zconn,"select * from fabric_master");
	$fabric_list='';
	while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
		$fabric_list .="<option value='".$res_fabric['fabric_name']."'>".$res_fabric['fabric_name']."</option>";
		} 

	$sel_content = mysqli_query($zconn,"select * from content_master");
	$content_list='';
	while($res_content=mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){ 
		$content_list .="<option value='".$res_content['content_name']."'>".$res_content['content_name']."</option>";
		} 

	$sel_color = mysqli_query($zconn,"select * from color_master");
	$color_list='';
	while($res_color=mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){ 
		$color_list .="<option value='".$res_color['colour_name']."'>".$res_color['colour_name']."</option>";
		} 
	$sel_dia = mysqli_query($zconn,"select * from dia_master");
	$dia_list='';
	while($res_color=mysqli_fetch_array($sel_dia,MYSQLI_ASSOC)){ 
		$dia_list .="<option value='".$res_color['dia_name']."'>".$res_color['dia_name']."</option>";
		}
	$sel_gsm = mysqli_query($zconn,"select * from gsm_master");
	$gsm_list='';
	while($res_color=mysqli_fetch_array($sel_gsm,MYSQLI_ASSOC)){ 
		$gsm_list .="<option value='".$res_color['gsm_name']."'>".$res_color['gsm_name']."</option>";
		}

	$sel_uom = mysqli_query($zconn,"select * from uom_master");
	$uom_list='';
	while($res_color=mysqli_fetch_array($sel_uom,MYSQLI_ASSOC)){ 
		$uom_list .="<option value='".$res_color['uom_name']."'>".$res_color['uom_name']."</option>";
		}
	?>
	<script type="text/javascript">
	function cal_amt(id){
		var cons = $('#consumption'+id).val();
		var rat = $('#rate'+id).val();
		var ctrws=0;
		if(rat){
			ctrws = parseFloat(cons)*parseFloat(rat);
		} 
		$('#total'+id).val(ctrws);

		var sum = 0;
		//$('.tramt').each(function(){
		//	sum += parseFloat($(this).val());
		//});
		//$('#grand_tot').val(sum);


		// Sample JavaScript calculation logic for multiple rows
$(document).ready(function() {
    $('.tramt').each(function() {
        calculateTotal($(this));
    });

    $('.tramt').on('input', function() {
        calculateTotal($(this));
    });

    function calculateTotal(input) {
        // Get the row containing the input field
        var row = input.closest('tr');

        // Fetch relevant values for calculation from the same row
        var consumption = parseFloat(row.find('[name="consumption[]"]').val());
        var rate = parseFloat(row.find('[name="rate[]"]').val());

        // Calculate the total for the current row
        var total = consumption * rate;

        // Update the total field for the current row
        row.find('[name="total[]"]').val(total.toFixed(2));
    }
	var grandTotal = 0;

        // Loop through each row total and accumulate for the grand total
        $('.tramt').each(function() {
            grandTotal += parseFloat($(this).val() || 0);
        });

        // Display the grand total in the appropriate input field
        $('#grand_tot').val(grandTotal.toFixed(2));
   
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
				//alert(data);
				data = data.split("~~");
				$('#order_no').val(data['0']);
				$('#style_no').val(data['1']);
				$('#buyer_name').val(data['2']);
				$('#order_date').val(data['0']);
			},
			error: function (textStatus, errorThrown) {
				//DO NOTHINIG
			}
		});
}

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		var trs = $('#tot_rows').val();
		var in_trs = parseInt(trs)+parseInt(1);
		$('#tot_rows').val(in_trs);
	//	$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
		var flist ="<?php echo $fabric_list;?>";
		var content_list ="<?php echo $content_list;?>";
		var color_list ="<?php echo $color_list;?>";
		var dia_list ="<?php echo $dia_list;?>";
		var gsm_list ="<?php echo $gsm_list;?>";
		var uom_list ="<?php echo $uom_list;?>";
        var row = '<tr>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="fabric[]"><option> Select</option>'+flist+'</select></td>'+
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="content[]"><option> Select</option>'+content_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="color[]"><option> Select</option>'+color_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="dia[]"><option> Select</option>'+dia_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="gsm[]"><option> Select</option>'+gsm_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="uom[]"><option> Select</option>'+uom_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><input type="text" class="form-control" id="consumption'+in_trs+'" placeholder="Consumption" name="consumption[]" onkeyup="cal_amt('+in_trs+');" onblur="cal_amt('+in_trs+');"></td>' +
            '<td style="padding:0px; margin:0px;"><input type="text" class="form-control" name="rate[]" id="rate'+in_trs+'" placeholder="Rate" onkeyup="cal_amt('+in_trs+');" onblur="cal_amt('+in_trs+');"></td>' +
            '<td style="padding:0px; margin:0px;"><input type="text" class="form-control tramt" id="total'+in_trs+'" placeholder="Total" name="total[]" readonly></td>' +
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +

        '</tr>';
    	$("table").append(row);

		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
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
    });
});
</script>
</body>
</html>