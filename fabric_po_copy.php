<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['save_fabric'])){

$date2= date('Y-m-d', strtotime($_REQUEST['receive_date']));
$po_sql=mysqli_fetch_array(mysqli_query($zconn,"select max(id) as id from fabric_po_master"));
$po_no=$po_sql['id']+1;

// INSERT QUERY IN fabric_po_master TABLE

$sql1 = mysqli_query($zconn, "INSERT INTO `fabric_po_master` (`to_address`,`delivery`,`comments`,`po_date`,`receve_date`,`total_weight`,`status`)
VALUES('".$_REQUEST['to_address']."','".$_REQUEST['delivery']."','".$_REQUEST['comments']."','".$_REQUEST['po_date']."', '".$_REQUEST['receve_date']."','".$_REQUEST['total_weight']."','waiting')") or die(mysqli_error($zconn));

// Obtain the last inserted ID
$last_id = mysqli_insert_id($zconn);
	
	echo "<script>alert('" . count($_REQUEST['now']) . "')</script>";
	 // INSERT  QUERY IN fabric_po_details
	for ($i = 0; $i < count($_REQUEST['now']); $i++) {
	

    if ($_REQUEST['now'][$i] > 0 && isset($_REQUEST['checkbox'][$i])) {
        // Retrieve data for insertion using the correct index $i
        $now_qty = $_REQUEST['now'][$i];
        $fabric_name = $_REQUEST['fabric_name'][$i];
        $style_no = $_REQUEST['style_no'][$i];
        $order_no = $_REQUEST['order_no'][$i];
        $color = $_REQUEST['color'][$i];
		 $total = $_REQUEST['total'][$i];
        $fab_id = $_REQUEST['fab_id'][$i];
         $current_qty=$_REQUEST['required_qty'][$fab_id];
		 $bal_qty=$_REQUEST['balqty'][$fab_id];
		
        // Insert the details into fabric_po_details table using $last_id obtained from fabric_po_master insertion
        $sql1 = mysqli_query($zconn, "INSERT INTO `fabric_po_details` (`po_id`, `fabric_name`, `styleno`, `order_no`, `weight`, `grant_total`, `date`, `color`, `fab_id`,`current_qty`) VALUES ('$last_id', '$fabric_name', '$style_no', '$order_no', '$total', '$bal_qty', NOW(), '$color', '$fab_id',' $now_qty')") or die(mysqli_error($zconn));
		  $form_processing_successful = ($sql1) ? true : false;
		
    }
}

  if ($form_processing_successful) {
        // Redirect the user after successful form processing
        header("Location: fabric_po.php"); // Redirect to the same page (fabric_po.php) or another appropriate page
        exit(); // Ensure that subsequent code does not execute after the redirect
    }


	
	// for($i=0;$i<count($_REQUEST['now']);$i++){
	// 	if ($_REQUEST['now'][$i] >0 ) {
	// 		$now_qty=$_REQUEST['now'][$i];
	// 		$id=$_REQUEST['fabric_po'];
	// 		$fabric_name=$_REQUEST['fabric_name'][$i];
	// 		$style_no=$_REQUEST['style_no'][$i];
	// 		$order_no=$_REQUEST['order_no'][$i];	

	// 		$sql1 = mysqli_query($zconn,"INSERT INTO `fabric_po_details` (`po_id`,`fabric_name`,`styleno`, `order_no`, `weight`,`grant_total`,`date`,`color`,`fab_id`)VALUES('$last_id','".$_REQUEST['fabric_name'][$i]."', '$style_no', '$order_no', '$now_qty','".$_REQUEST['total_weight']."',Now(),'".$_REQUEST['color'][$i]."','".$_REQUEST['fab_id'][$i]."')")or die(mysqli_error());
	// 	}
	// }
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
    <title><?php echo SITE_TITLE;?> - FABRIC PO</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
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
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">FABRIC PO</h4>
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
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12" >
									<div class="col-sm-6" style="float:left;">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Style No</label>
										<div class="col-sm-3">
											<?php
											$sectBrnQry = "SELECT * FROM fabric_entry ORDER BY id";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
												$style_no1[]=$coldata['style_no']; }
											?>
										
											<select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select" name="Style[]" id="Style" onchange="this.form.submit()">
												<option>Select</option>	
												<?php  foreach($style_no1 as $style_no){ ?>
												 <option value="<?php echo $style_no?>"<?php if(in_array($style_no,$_REQUEST['Style'],true)){?> selected="selected"<?php }?>><?php echo $style_no;?></option>
												<?php }  ?>
											</select>
										</div>
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Order No</label>
										<div class="col-sm-3">
											<?php
											$sectBrnQry = "SELECT * FROM fabric_entry ORDER BY id";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
												$order_no1[]=$coldata['order_no']; }
											?>
											<select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select" name="order[]" id="order" onchange="this.form.submit()">
												<option>Select</option>	
												<?php  foreach($order_no1 as $order_no){ ?>
												 <option value="<?php echo $order_no?>"<?php if(in_array($order_no,$_REQUEST['order'],true)){?> selected="selected"<?php }?>><?php echo $order_no;?></option>
												<?php }  ?>
											</select>
										</div>
										</div>
									</div>
									<div class="col-sm-6" style="float:left;">
										<div class="form-group row">
											<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Fabric Name</label>
											<div class="col-sm-3">
											<?php
											$sectBrnQry = "SELECT * FROM fabric_entry ORDER BY id";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
												$fabric[]=$coldata['fabric_name']; }
											?>

											<select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select" name="fabric[]" id="fabric" onchange="this.form.submit()">
												<option>Select</option>	
												<?php  foreach($fabric as $fabric_name){ ?>
												 <option value="<?php echo $fabric_name?>"<?php if(in_array($fabric_name,$_REQUEST['fabric'],true)){?> selected="selected"<?php }?>><?php echo $fabric_name;?></option>
												<?php }  ?>
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
									</div>
								<div class="table-responsive" style="overflow-x: auto;">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead style="background-color: #626F80; color: #fff; font-size: 16px;">
											<tr>
												<!-- <th></th> -->
												<th></th>
												<th>STYLE NO</th>
												<th>ORDER NO</th>
												<th>FABRIC NAME</th>
												<th>COLOR</th>
												<th>ORDER QTY.</th>
												<th>TOTAL WEIGHT</th>
												 <th>DELIVERED QTY.</th>
												<th>BALANCE QTY.</th>
												<th>NOW WANTED(weight)</th>
												<!-- <th>RATE</th> -->
											</tr>
										</thead>
										<tbody> 
											
											<?php
											$result= "SELECT * FROM fabric_entry where status=''";
											if (isset($_REQUEST['Style'])&& $_REQUEST['Style']!='') {
												$result.= "and style_no in('";
												foreach ($_REQUEST['Style'] as $style ) {
													$result.=$style;
													if (end($_REQUEST['Style']) !=$style) {
													$result.="','";
													}
												}
												$result.="')";
											}

											if (isset($_REQUEST['order']) && $_REQUEST['order']!='') {
												$result.="and `order_no` in('";
												foreach($_REQUEST['order'] as $order){
												$result.=$order; 
												if (end($_REQUEST['order'])!=$order ){
													$result.="','";
												}
											}
											$result.="')";
										}

										if (isset($_REQUEST['fabric']) && $_REQUEST['fabric']!='') {
										$result.="and `fabric_name` in ('";
										foreach ($_REQUEST['fabric'] as $fab) {
										$result.=$fab;
										if (end($_REQUEST['fabric'])!=$fab) {
											$result.="','";
										}
										}
										$result.="')";
										}
									   // $result."order by id asc";
									  // echo $result;
									    $secBrnResource = mysqli_query($zconn,$result." order by id asc");
									    while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
											$result1 = "SELECT 
    (SELECT SUM(current_qty) FROM fabric_po_details WHERE fab_id='".$coldata['id'] . "') as total_qty,
    (SELECT grant_total FROM fabric_po_details WHERE fab_id='".$coldata['id'] . "' ORDER BY date DESC LIMIT 1) as grant_total";
											
											$secBrnResource1 = mysqli_query($zconn,$result1);
											$coldata1 = mysqli_fetch_array($secBrnResource1,MYSQLI_ASSOC)
											?>
										
											<tr>
												  <td><input type="checkbox" name="checkbox[]" id="checkbox_<?php echo $coldata['id']; ?>">                                                      </td>
												<td><?php echo $coldata['style_no'];?><input type="hidden" name="fab_id[]" id="fab_id" value="<?php echo $coldata['id'];?>"> <input type="hidden" name="style_no[]" id="style_no" value="<?php echo $coldata['style_no'];?>"></td>
												<td><?php echo $coldata['order_no'];?> <input type="hidden" name="order_no[]" id="order_no" value="<?php echo $coldata['order_no'];?>"></td>
												<td><?php echo $coldata['fabric_name'];?> <input type="hidden" name="fabric_name[]" id="fabric_name" value="<?php echo $coldata['fabric_name'];?>"></td> 
												<td><?php echo  $coldata['color'];?><input type="hidden" name="color[]" id="color" class=" form-control"  value="<?php echo  $coldata['color'];?>" /></td>
												<td><?php echo $coldata['order_qty'];?><input type="hidden" name="order_qty[]" id="order_qty" class=" form-control"  value="<?php echo  $coldata['order_qty'];?>" /> </td>
												<td><?php echo $coldata['total'];?><input type="hidden" name="total[]" id="total" class=" form-control"  value="<?php echo  $coldata['total'];?>" /></td>

												<td>
        <input type="hidden" name="required_qty[]" id="required_qty<?php echo $coldata['id'];?>" value="">
      
    <input type="text" name="required_qty[]" class="form-control" id="required_qty_<?php echo $coldata['id'];?>" 
    value="<?php echo $coldata1['total_qty'];?>" readonly>

    </td>
												
												<td style=""><input type="hidden" name="balqty[]" 
                                                id="balqty<?php echo $coldata['id'];?>" value="">
<input type="text" name="balqty[]" class="form-control" id="balqty_<?php echo $coldata['id'];?>" 
value="<?php echo $coldata1['grant_total'];?>" readonly></td>

												

												<td>
        <input type="text" name="now[]" id="now<?php echo $coldata['id'];?>" onkeyup="now_wanted(<?php echo $coldata['id'];?>)" 
        class="form-control now" />
    </td>
											</tr>
											<?php
												}
											?>
											<tr>
											<td colspan="9">TOTAL</td>
											<td><input type="text" name="total_weight" id="total_weight" class=" form-control"  /></td>
										</tr>
										</tbody>
									</table>
								</div>
							</div>
                        </div>
                    </div>
                </div>
				<div class="card" style="width:100%">
					<div class="card-body" style="width:100%">
						<div class="card" style="width:50%; float:left; left: 50px; ">

											<?php 
											$po=mysqli_fetch_array(mysqli_query($zconn,"select max(po_no) as id from fabric_po_master"));
											$id=$po['id']+1;
											?>
							<div class="form-group row">
								<label for="fname" class="col-sm-3 text-right control-label col-form-label">PO No</label>
								<div class="col-sm-6">
									<input type="text" autocomplete="off" required class="form-control" id="fabric_po" readonly name="fabric_po" value="<?php echo $id;?>" >
								</div>
							</div>
							<div class="form-group row">
								<label for="cono1" class="col-sm-3 text-right control-label col-form-label">PO Date</label>
								<div class="col-sm-6">


									<input type="text" autocomplete="off" required class="form-control" id="po_date" readonly name="po_date" value="<?php echo date("d/m/Y"); ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="lname" class="col-sm-3 text-right control-label col-form-label">To Address</label>
								<div class="col-sm-6">

									<select class="form-control" required placeholder="Supplier" id="to_address" name="to_address">
										<option>Select</option>
										<?php 
										      $tocompe=mysqli_query($zconn,"SELECT * FROM  `suppliers` where status='0'");
											 while($tocompe_res=mysqli_fetch_object($tocompe)){
											 	?>
										     <option value="<?php echo $tocompe_res->supplier_name;?>"><?php echo $tocompe_res->supplier_name;?></option>
										     <?php }?>
									</select>
								</div>
							</div>
						</div>
						<div class="card" style="width:50%; float:left; right: 50px;">
							<div class="form-group row">
								<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Recieved Date</label>
								<div class="col-sm-6">
									<input type="date" class="form-control" id="receve_date" name="receve_date" autocomplete="off" required >
								</div>
							</div>
							<div class="form-group row">
								<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Comments</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="comments" name="comments" autocomplete="off" required placeholder="comments">
								</div>
							</div>	
							<div class="form-group row">
								<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Deleivery To</label>
								<div class="col-sm-6">
									<select class="select2 form-control custom-select" name="delivery" id="delivery">
									<option>select</option>
											<?php 
										      $tocompe=mysqli_query($zconn,"SELECT * FROM  `suppliers` where status='0'");
											 while($tocompe_res=mysqli_fetch_object($tocompe)){
											 	?>
										     <option value="<?php echo $tocompe_res->supplier_name;?>"><?php echo $tocompe_res->supplier_name;?></option>
										     <?php } ?>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="border-top">
						<div class="card-body" style="margin-left: 500px;">
							<button type="submit" name="save_fabric" class="btn btn-success" value="<?php echo $action;?>">Save fabric po</button>
							<button type="reset" class="btn btn-primary">Reset</button>								
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
</form>
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
	
    $(document).ready(function () {
        $('#example').DataTable();
    });

    function DeleteUsrId(ID) {
        var UsrStatus = confirm("Are you sure to delete this company details ?");
        if (UsrStatus) {
            $('#delete_' + ID).hide();
        }
    }

//  function now_wanted(id) {
   
//     var total_weight = parseFloat($('input[name="total[]"]').eq(id).val()) || 0;
//     var now_wanted = parseFloat($('#now' + id).val()) || 0;
//     var required_qty = now_wanted;
//     var balance_qty = parseFloat(total_weight - now_wanted) || 0;
//     document.getElementById('required_qty'+id).value = required_qty;
// 	 document.getElementById('balqty'+id).value = balance_qty;
// 	 document.getElementById('required_qty_'+id).value = required_qty;
// 	 document.getElementById('balqty_'+id).value = balance_qty;

// }

function now_wanted(id) {
    var total_weight = parseFloat($('input[name="total[]"]').eq(id).val()) || 0;
    var delivered_qty = parseFloat($('input[name="required_qty[]"]').eq(id).val()) || 0;
    var now_wanted = parseFloat($('#now' + id).val()) || 0;

    var required_qty = delivered_qty + now_wanted;
    var balance_qty = total_weight - required_qty;

    // Set values to corresponding fields
    $('#required_qty_' + id).val(required_qty);
    $('#balqty_' + id).val(balance_qty);

    // Set 'Required Qty' field to the value entered in 'Now Wanted'
    $('#required_qty' + id).val(now_wanted);
   document.getElementById('balqty'+id).value = balance_qty;
    // Recalculate total weight function if needed
    recalculateTotalWeight();
}

    function recalculateTotalWeight() {
        var sum = 0;
        $('.now').each(function () {
            sum += parseFloat($(this).val()) || 0;
        });

        $('#total_weight').val(sum);
    }
</script>

</body>
</html>