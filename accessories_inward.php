<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['save']))
{
	$count = count($_REQUEST['wgt']);

for($i=0;$i<$count;$i++)
	{ 
	if ($_REQUEST['wgt'][$i]>0) {
			$wgt=$_REQUEST['wgt'][$i];
			$fabrics0=mysqli_fetch_object(mysqli_query($zconn,"select 
            sum(weight) 
            as weight from  store_po_details where
             `po_id`='".$_REQUEST['po_no']."' 
            and id='".$_REQUEST['id'][$i]."' 
            and order_no= '".$_REQUEST['order_no'][$i]."'"));
			 $fwgt=$fabrics0->weight;
			$fabrics=mysqli_fetch_object(mysqli_query($zconn,"select 
            sum(wgt) 
            as wgt from  accessories_inward where `po_no`='".$_REQUEST['po_no']."' 
            and old_id='".$_REQUEST['id'][$i]."' and 
            order_no= '".$_REQUEST['order_no'][$i]."'"));
			$new=$_REQUEST['wgt'][$i];
			$fwgt2=$fabrics->wgt+$new;
			$tcom=$fwgt-$fwgt2;

			if ($tcom==0) {
				mysqli_query($zconn,"UPDATE  `store_po_details` SET  `status` =  'complete' where `po_id`='".$_REQUEST['po_no']."' and id='".$_REQUEST['id'][$i]."' and order_no= '".$_REQUEST['order_no'][$i]."'")or die(mysqli_error());
			}

			$sql = mysqli_query($zconn,"INSERT INTO `accessories_inward` ( `po_no`,`style_no`,`order_no`,`wgt`, `roll`,`date`,old_id,fabric_name) VALUES ('".$_REQUEST['po_no']."','".$_REQUEST['style_no'][$i]."','".$_REQUEST['order_no'][$i]."','".$_REQUEST['wgt'][$i]."','".$_REQUEST['roll'][$i]."',Now(),'".$_REQUEST['id'][$i]."','".$_REQUEST['yarn_name'][$i]."')")or die(mysqli_error());
		}
	}

		if(isset($sql)){
			echo("<script>alert('Store Inwarded Successfuly');</script>");
		} else {
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
    <title><?php echo SITE_TITLE;?> - ACCESSORIES PO INWARD</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">

	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
	<style>
	th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
	</style>
</head>

<body>
    <div id="main-wrapper">
        <!-- Topbar header - style you can find in pages.scss -->
        <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
		<?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">ACCESSORIES PO INWARD</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
			<form name="accessories_inward" id="accessories_inward" method="post">
                <!-- Sales chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
							<div class="row">
								<div class="col-sm-12" >
								<div class="col-sm-6" style="float:left;">
								<div class="form-group row">
								<label for="fname" class="col-sm-4 text-right control-label col-form-label">PO No</label>
								<div class="col-sm-6">
								<select class="select2 form-control custom-select chosen-select" name="po_no" id="po_no" onchange="$('#accessories_inward').submit();"> <option>Select</option>
								<?php $sel_po = mysqli_query($zconn,"select distinct po_id,styleno  from  store_po_details where status!='complete'");
									while($res_po = mysqli_fetch_array($sel_po,MYSQLI_ASSOC)){ 
										if($_REQUEST['po_no']==$res_po['po_id']){ ?>
											<option selected value="<?php echo $res_po['po_id'];?>"><?php echo $res_po['po_id'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_po['po_id'];?>"><?php echo $res_po['po_id'];?> - (<?php echo $res_po['styleno'];?>)</option>
											<?php } ?>
											<?php } ?>
								</select>
								<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
								</div>
												<br>
											</div>

										</div>

									</div>

								</div>
								<br><br>

			<div class="form-group row">
			<div class="col-sm-2"><strong> Party Name</strong></div>
				<div class="col-sm-3">
			<?php
				$sel_buyer = mysqli_fetch_object(mysqli_query($zconn,"select * from store_po_master where po_no='".$_REQUEST['po_no']."'"));
				$buyer=$sel_buyer->buyer;
				$date=$sel_buyer->date;
			?>
				<input type="text" name="party" readonly class="form-control" value="<?php echo $buyer;?>">
			</div>
			<div class="col-sm-2"></div>
			<div class="col-sm-2"> <strong> Date</strong></div>
				<div class="col-sm-3">
					<input type="text" name="party_date" readonly class="form-control" value="<?php echo $date;?>">
					</div>
				</div>
				<br>
		<hr>
			<div class="table-responsive">
				<div class="col-12 d-flex no-block align-items-center">
					<h5 class="page-title" style="margin-left: 390px;">ACCESSORIES DETAILS</h5>
				</div>
				<div class="row">
					<div class="col-sm-2"> Filter By Order No</div>
					<div class="col-sm-3">
						 <select class="select2 form-control custom-select" name="order" id="order" onchange="this.form.submit();">
								<option value="0">Select</option>
								<?php $sel_buyer = mysqli_query($zconn,"select * from store_po_details where po_id='".$_REQUEST['po_no']."' group by order_no");
								while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
								<option value="<?php echo $res_buyer['order_no'];?>" <?php if ($res_buyer['order_no']==$_REQUEST['order']) {?> selected="selected" <?php
								} ?>><?php echo $res_buyer['order_no'];?></option>
								<?php } ?>
						</select>
					</div>
					<div class="col-sm-2"></div>
					<div class="col-sm-2"> Filter By Style No</div>
					<div class="col-sm-3">
						 <select class="select2 form-control custom-select" name="style" id="style" onchange="this.form.submit();">
								<option value="0">Select</option>
								<?php $sel_buyer = mysqli_query($zconn,"select * from store_po_details where po_id='".$_REQUEST['po_no']."' and order_no='".$_REQUEST['order']."' group by order_no,styleno");
								while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
								<option value="<?php echo $res_buyer['styleno'];?>" <?php if ($res_buyer['styleno']==$_REQUEST['style']) {?> selected="selected" <?php

								} ?>><?php echo $res_buyer['styleno'];?></option>
								<?php } ?>
						</select> 
					</div>
				</div>
				<br>
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead style="background-color: #626F80; color: #fff; font-size: 16px;">
						<tr>
							<th style="width: 2%">S.NO</th>
							<th style="width: 10%">ORDER NO</th>
							<th style="width: 10%">STYLE NO</th>
							<th style="width: 10%">NAME</th>

							<th style="width: 9%" data-toggle="tooltip" title="Total Weight">TOTAL QTY</th>
							<th style="width: 7%" data-toggle="tooltip" title="Already Received">ALREADY RECEIVED</th>
							<th style="width: 3%" data-toggle="tooltip" title="Balance Quantity">BALANACE</th>
							<th style="width: 6%" data-toggle="tooltip" title="Received Bags">QTY</th>
							<!-- <th style="width: 8%" data-toggle="tooltip" title="Received Weight">REC.WEIGHT</th> -->
						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT * FROM store_po_details where po_id='".$_REQUEST['po_no']."' and status!='complete'";

						if (isset($_REQUEST['order']) && $_REQUEST['order']!='0') {
							$query.="and order_no in('".$_REQUEST['order']."')";
						}

						if (isset($_REQUEST['style'])&& $_REQUEST['style']!='0') {
							$query.="and styleno in('".$_REQUEST['style']."')";
						}

						// echo $query;
						$secBrnResource = mysqli_query($zconn,$query);
						$sno=1;
						while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
							$id=$coldata['id'];
							$fetch=mysqli_fetch_object(mysqli_query($zconn,"select sum(wgt) as wgt,sum(roll) as roll from  accessories_inward where po_no='".$_REQUEST['po_no']."' and old_id=$id"));

	?>
	<tr>
		<td style="width:2%"><?php echo $sno;?><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"></td>
		<td style="width:10%"><?php echo $coldata['order_no'];?><input type="hidden" name="order_no[]" value="<?php echo $coldata['order_no'];?>"></td>
		<td style="width:10%"><?php echo $coldata['styleno'];?><input type="hidden" name="style_no[]" value="<?php echo $coldata['styleno'];?>"></td>
        <td style="width:7%"><?php echo $coldata['yarn_name'];?><input type="hidden" name="yarn_name[]" value="<?php echo $coldata['yarn_name'];?>"></td>
		<td style="width:7%"><?php echo $coldata['weight'];?></td>
		<td style="width:7%"><?php echo $fetch->wgt;?></td>
		<td style="width:3%"><?php echo $coldata['weight']-$fetch->wgt;?></td>
		<!-- <td style="width:6%"><div class="col-sm-12">
		<input type="text" class="rolls form-control" id="roll<?php echo $sno;?>" name="roll" autocomplete="off" onkeyup="cal_bags();">
		</div>
	</td> -->
		<td style="width: 8%"><div class="col-sm-12">
			<input type="number" class="wgt form-control" id="wgt" name="wgt[]"  autocomplete="off" onkeyup="cal_wgt();" >
			</div>
		</td>
	</tr>

	<?php
		$sno++;}
	?>

	</tbody>
	<tfoot>
	<tr>
		<td style="width:2%"></td>
		<td style="width:10%"></td>
		<td style="width:10%"></td>
		<td style="width:7%"></td>
		<td style="width:7%"></td>
        <td style="width:7%"></td>
		<td style="width:3%"><b>Total</b></td>
		<!-- <td style="width:6%"><div class="col-sm-12">
			<input type="text" class="form-control" name="tot_bags" id="tot_bags" autocomplete="off" required value="0">
			</div>
		</td> -->
			<td style="width: 8%"><div class="col-sm-12">
				<input type="text" class="form-control" id="tot_weight" name="tot_weight" autocomplete="off" required value="0">
				</div>
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
						<div class="card-body" style="margin-left: 400px;">
							<button type="submit" name="save" class="btn btn-success">Save</button>
							<button type="reset" class="btn btn-primary">Reset</button>
						</div>
					</div>
				</div>
                <!-- Sales chart -->
            </div>
			</form>
            <!-- End Container fluid  -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
    <!-- End Wrapper -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
	<script src="dist/js/bootstrap-datepicker.js"></script>
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
	function cal_bags(){
		var sum=0;
		$('.rolls').each(function(index, element){
			if($(element).val()!="")
				sum += parseFloat($(element).val());
			});	
		$('#tot_bags').val(sum);
	}

	function cal_wgt(){
		var sum=0;
		$('.wgt').each(function(index, element){
			if($(element).val()!="")
					sum += parseFloat($(element).val());
			});	
		$('#tot_weight').val(sum);
	}

	$(document).ready(function(){
		$('#example').DataTable();
	});

	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
		  if(UsrStatus){
			$('#delete_'+ID).hide();
		  }
	  }

$('#bill_date').datepicker({
	format:'dd-mm-yyyy',
      autoclose: true
    })
	</script>
</body>
</html>