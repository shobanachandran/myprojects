<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['save']))
{
	$count=count($_REQUEST['wgt']);

for($i=0;$i<$count;$i++)
	{ 
	if ($_REQUEST['wgt'][$i]>0) {
			$wgt=$_REQUEST['wgt'][$i];
			$fabrics0=mysqli_fetch_object(mysqli_query($zconn,"select sum(weight) as weight from  fabric_po_details where `po_id`='".$_REQUEST['po_no']."' and id='".$_REQUEST['id'][$i]."' and order_no= '".$_REQUEST['order'][$i]."'"));
			$fwgt=$fabrics0->weight;
			$fabrics=mysqli_fetch_object(mysqli_query($zconn,"select sum(wgt) as wgt from  fabric_inward where `po_no`='".$_REQUEST['po_no']."' and old_id='".$_REQUEST['id'][$i]."' and order_no= '".$_REQUEST['order'][$i]."'"));
			$new=$_REQUEST['wgt'][$i];
			$fwgt2=$fabrics->wgt+$new;
			$tcom=$fwgt-$fwgt2;
				if ($tcom==0) {
						 mysqli_query($zconn,"UPDATE  `fabric_po_details` SET  `status` =  'complete'   where `po_id`='".$_REQUEST['po_no']."' and id='".$_REQUEST['id'][$i]."' and order_no= '".$_REQUEST['order'][$i]."'")or die(mysqli_error());
					}

					$sql=mysqli_query($zconn,"INSERT INTO `fabric_inward` ( `po_no`,`style_no`,`order_no`, `fabric_name`,`wgt`, `roll`,`date`,old_id) VALUES ('".$_REQUEST['po_no']."','".$_REQUEST['style'][$i]."','".$_REQUEST['order'][$i]."','".$_REQUEST['fabric_name'][$i]."','".$_REQUEST['wgt'][$i]."','".$_REQUEST['roll'][$i]."',Now(),'".$_REQUEST['id'][$i]."')")or die(mysqli_error());
		}
	}
if(isset($sql)){

	echo("<script>alert('Fabric Inwarded Successfuly');</script>");
}
else
{
	$error='Error';
}


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
    <title><?php echo SITE_TITLE;?> - FABRIC PO INWARD</title>
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
                        <h4 class="page-title">FABRIC PO INWARD</h4>
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
												<label for="fname" class="col-sm-6 text-right control-label col-form-label">&nbsp;PO No</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="po_no" id="po_no" onchange='this.form.submit()'>
													<option>Select</option>
													<?php $sel_buyer = mysqli_query($zconn,"select distinct po_id from fabric_po_details where status!='complete' ");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>

													


													 <option value="<?php echo $res_buyer['po_id'];?>"<?php if ($res_buyer['po_id'] == $_REQUEST['po_no']) echo ' selected'; ?>><?php echo $res_buyer['po_id'];?></option>


													<?php } ?>

													</select>
												</div>
												<br>
												<br>
											<!-- 	<br> -->
												
												<!-- <br>
												<br>
												<br> -->
												<!-- <label for="fname" class="col-sm-6 text-right control-label col-form-label">&nbsp;Style No</label>
												<div class="col-sm-6">
					
													<select class="select2 form-control custom-select" name="styleno" id="styleno" onchange="this.form.submit()">
													<option>Select</option>
													<?php $sel_buyer = mysqli_query($zconn,"select * from  fabric_po_details where po_id='".$_REQUEST['po_no']."' and order_no='".$_REQUEST['order_no']."'");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
													 ?>
													<option value="<?php echo $res_buyer['styleno'];?>" <?php if ($res_buyer['styleno']==$_REQUEST['styleno']) echo 'selected' ?>><?php echo $res_buyer['styleno'];?></option>
													<?php } ?>
													</select>
												</div> -->
												<!-- <br>
												<br>
												<br>
												<label for="fname" class="col-sm-6 text-right control-label col-form-label">&nbsp;Fabric choose</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
													<option>Select</option>
													<option>4</option>
													<option>45</option>
													</select>
													<br>
													<a href="#"><button type="button" class="btn btn-info">New Fabric Add</button></a>
												</div> -->
											</div>
										</div>									
									</div>
								</div>
								<br><br>




								<div class="table-responsive">
									<div class="col-12 d-flex no-block align-items-center">
										<h3 class="page-title" style="margin-left: 390px;">FABRIC DETAILS</h3>
									</div>


	<div class="row">
		<div class="col-sm-2">
			<span class="control-label col-form-label">&nbsp; Filter By Order No</span>
		</div>
		<div class="col-sm-3">
			<select class="select2 form-control custom-select" name="order_no" id="order_no" onchange="this.form.submit()">
				<option value="0">Select</option>
					<?php $sel_buyer = mysqli_query($zconn,"select * from  fabric_po_details where po_id='".$_REQUEST['po_no']."'");
						while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
							
							<option value="<?php echo $res_buyer['order_no'];?>" <?php if ($res_buyer['order_no']==$_REQUEST['order_no']) echo 'selected' ?>><?php echo $res_buyer['order_no'];?>
				</option>
					<?php } ?>
			</select>
		</div>
		<div class="col-sm-2"></div>
		<div class="col-sm-2">
			<span class="control-label col-form-label">&nbsp; Filter By Style No</span>
		</div>
		<div class="col-sm-3">
			<select class="select2 form-control custom-select" name="styleno" id="styleno" onchange="this.form.submit()">
				<option value="0">Select</option>
					<?php $sel_buyer = mysqli_query($zconn,"select * from  fabric_po_details where po_id='".$_REQUEST['po_no']."' and order_no='".$_REQUEST['order_no']."'");
						while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){?>
							
				<option value="<?php echo $res_buyer['styleno'];?>" <?php if ($res_buyer['styleno']==$_REQUEST['styleno']) echo 'selected' 	?>><?php echo $res_buyer['styleno'];?>	
				</option>
				<?php } ?>
		    </select>
		</div>
	</div>
	<br>
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead style="background-color: #626F80; color: #fff; font-size: 16px;">
											<tr>
												<th style="width: 5%">S.NO</th>
												<th style="width: 15%">ORDER NO</th>
												<th style="width: 15%">STYLE NO</th>
												<th style="width: 10%">FABRIC</th>
												<th style="width: 10%">TOTAL(wgt)</th>
												<th style="width: 10%">RECVD(wgt)</th>
												<th style="width: 10%">BALANCE</th>
												<th style="width: 10%">ROLLS</th>
												<th style="width: 15%">WEIGHT</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$s=1;
											$query ="select * from  fabric_po_details where po_id='".$_REQUEST['po_no']."' and status!='complete'";

											if (isset($_REQUEST['order_no']) && $_REQUEST['order_no']!='0') {
											$query.="and order_no in('".$_REQUEST['order_no']."')";	
											}

											if (isset($_REQUEST['styleno']) && $_REQUEST['styleno']!='0') {
												$query.="and styleno in('".$_REQUEST['styleno']."')";
											}
											
								 			// $query;
											$secBrnResource = mysqli_query($zconn,$query);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
												$id=$coldata['id'];
												$fetch=mysqli_fetch_array(mysqli_query($zconn,"select sum(wgt) as wgt,sum(roll) as roll from  fabric_inward where po_no='".$_REQUEST['po_no']."' and old_id=$id"));
												 $tot_wgt=$fetch['wgt'];
											?>
											<tr>
												<td><?php echo $s;?><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"></td></td>
												<td><?php echo $coldata['order_no'];?><input type="hidden" name="order[]" value="<?php echo $coldata['order_no'];?>"></td>
												<td><?php echo $coldata['styleno'];?><input type="hidden" name="style[]" value="<?php echo $coldata['styleno'];?>"></td>
												<td><?php echo $coldata['fabric_name'];?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name'];?>"></td>
												<td><?php echo $coldata['weight'];?></td>
												<td><?php echo $tot_wgt;?></td>
												<td><?php echo $coldata['weight']-$tot_wgt;?></td>
												<td><div class="col-sm-12">
														<input type="text" class="form-control roll" id="roll" name="roll[]" autocomplete="off"  >
													</div>
												</td>
												<td><div class="col-sm-12">
														<input type="number" class="form-control wgt" id="wgt" name="wgt[]" min="0" max="<?php echo $coldata['weight']-$tot_wgt; ?>" autocomplete="off"  >
													</div>
												</td>
											</tr>
											

											<?php
											$s++;	}
											?>
											
										</tbody>
										<tfoot>
										<tr>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
											<!-- 	<td></td> -->
												<td></td>
												<td><b>Total</b></td>
												<td><div class="col-sm-12">
												
    <input type="text" class="form-control totalRoll" id="totalRoll" readonly>
</td>													</div>
												
												<td><div class="col-sm-12">
												<input type="text" class="form-control totalWgt" id="totalWgt" readonly>													</div>
												</td>
											</tr>
										
										</tfoot>
									</table>
								</div>
							</div>
                        </div>
                    </div>
                </div>				
				<div class="card" style="width:100%">
					<div class="border-top">
						<div class="card-body" style="margin-left: 450px;">
							<button type="submit" name="save" class="btn btn-success" value="<?php echo $action;?>">Save</button>
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
        </form>
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
	} );
	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
	  $('#delete_'+ID).hide();
	  }
	  }

// Execute calculation when any of the roll input fields change
$('.roll').on('keyup', function () {
    var total = 0;

    // Loop through each roll field and sum up their values
    $('.roll').each(function () {
        var value = parseFloat($(this).val()) || 0;
        total += value;
    });

    // Display the total in the totalRoll input field
    $('#totalRoll').val(total);
});

// Execute calculation when any of the wgt input fields change
$('.wgt').on('keyup change', function () {
    var total = 0;

    // Loop through each wgt field and sum up their values
    $('.wgt').each(function () {
        var value = parseFloat($(this).val()) || 0;
        total += value;
    });

    // Display the total in the totalWgt input field
    $('#totalWgt').val(total);
});


	  
	</script>	

</body>
</html>