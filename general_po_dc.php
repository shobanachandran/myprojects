<?php
	include('includes/config.php');
	if($_SESSION['userid']==''){
		echo "<script>window.location.href='login.php';</script>";
	}
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
	

if(isset($_REQUEST['save']))
{
	$count = count($_REQUEST['received_wgt']);

for($i=0;$i<$count;$i++)
	{ 
	if ($_REQUEST['received_wgt'][$i]>0) {
			$wgt=$_REQUEST['received_wgt'][$i];
			
		//print_r($wgt);
	

			
$sql = mysqli_query($zconn, "INSERT INTO `general_po_dc` (`po_no`, `style_no`, `desc`,`dc_no`,`dc_date`, `pcs_wgt`, `received_wgt`, `balance_wgt`, `price`,`party_name`, `to_process`,`created_at`) VALUES ('".$_REQUEST['po_no']."', '".$_REQUEST['style_no'][$i]."', '".$_REQUEST['desc'][$i]."', '".$_REQUEST['dc_no']."', '".$_REQUEST['dc_date']."', '".$_REQUEST['pcs_wgt'][$i]."', '".$_REQUEST['received_wgt'][$i]."', '".$_REQUEST['balance_wgt'][$i]."', '".$_REQUEST['price']."', '".$_REQUEST['party_name']."', '".$_REQUEST['to_process']."', NOW())") ;

	
		}

	}
//echo $sql;
	  if($sql) {
                echo("<script>alert('Yarn Inwarded Successfully');</script>");
            } else {
                $error = 'Error: ' . mysqli_error($zconn); // Capture and store the error message
                echo "<script>alert('$error');</script>"; // Display the error message
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
    <title><?php echo SITE_TITLE;?> - GENERAL PO DC</title>
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
                        <h4 class="page-title">General PO DC</h4>
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
							<div class="card" style="width:50%; float:left; left: 50px; ">


								<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Po No</label>
			<div class="col-sm-6">
			<select class="select2 form-control custom-select chosen-select" name="po_no" id="po_no" onchange="$('#accessories_inward').submit();"> <option>Select</option>
								<?php $sel_po = mysqli_query($zconn,"select distinct po_no,style_no  from  general_po where status ='Approved'");
									while($res_po = mysqli_fetch_array($sel_po,MYSQLI_ASSOC)){ 
										if($_REQUEST['po_no']==$res_po['po_no']){ ?>
											<option selected value="<?php echo $res_po['po_no'];?>"><?php echo $res_po['po_no'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_po['po_no'];?>"><?php echo $res_po['po_no'];?> - (<?php echo $res_po['style_no'];?>)</option>
											<?php } ?>
											<?php } ?>
								</select>
								<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
											</div></div>
											
								<div class="form-group row">

											<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Party Name</label>

			<div class="col-sm-6">
			
			    <?php
				$sel_buyer = mysqli_fetch_object(mysqli_query($zconn,"select * from general_po where po_no='".$_REQUEST['po_no']."'"));
				$buyer=$sel_buyer->to_address;
				$price=$sel_buyer->price;
				$to_process=$sel_buyer->to_process;
				
			     ?>
				<input type="hidden" name="price"  class="form-control" value="<?php echo $price;?>"> 
				<input type="hidden" name="to_process"  class="form-control" value="<?php echo $to_process;?>"> 
				
				<input type="text" name="party_name" readonly class="form-control" value="<?php echo $buyer;?>"> 
				</div>
							</div>
				
							<div class="form-group row">
		<div class="col-sm-6">

										</div>
									</div>
								</div>

								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Dc No</label>
										<div class="col-sm-6">
											<?php $select = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as id from general_po_dc")); 

											$id=$select['id']+1;?>
											<input type="text" name="dc_no" class="form-control" value="<?php echo $id;?>">
										</div>
									</div>

									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">DC Date</label>
										<div class="col-sm-6">
											<input type="date" class="form-control" id="dc_date" name="dc_date" autocomplete="off" required>
										</div>
									</div>

									<div class="form-group row">
										<div class="col-sm-6">
							
				</div>
			</div>
			
		</div>
			<div class="table-responsive">
				
				
				<br>
				<table id="example" class="table table-striped table-bordered" style="width:100%">
					<thead style="background-color: #626F80; color: #fff; font-size: 16px;">
						<tr>
						<th style="width: 10%">S.NO</th>

							<th style="width: 10%">STYLE NO</th>
							<th style="width: 10%">PARTICULARS</th>

							<th style="width: 3%" data-toggle="tooltip" title="Fabric Dia">QTY</th>
							<!-- <th style="width: 3%">DIA</th> -->
							<th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">AL. REC QTY</th>
							<th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">BALANCE QTY</th>
							<th style="width: 10%">RECEIVE QTY</th>

						</tr>
					</thead>
					<tbody>
						<?php
						$query = "SELECT DISTINCT style_no FROM general_inward WHERE po_no='".$_REQUEST['po_no']."'
  ";

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
							$fetch1=mysqli_fetch_object(mysqli_query($zconn,"select sum(received_wgt) as wgt from  general_inward
							 where po_no='".$_REQUEST['po_no']."' "));
							$qty=$fetch1->wgt;
							
							$fetch=mysqli_fetch_object(mysqli_query($zconn,"select sum(received_wgt) as wgt from  general_po_dc
							 where po_no='".$_REQUEST['po_no']."' "));
							$desc=$sel_buyer->desc;
						
						
// 

				

	?>
	<tr>
		<td style="width:2%"><?php echo $sno;?><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"></td>
		<td style="width:10%"><?php echo $coldata['style_no'];?><input type="hidden" name="style_no[]" value="<?php echo $coldata['style_no'];?>"></td>
		<td style="width:10%"><?php echo $desc;?><input type="hidden" name="desc[]" value="<?php echo $desc;?>"></td>
        <td style="width:7%"><?php echo $qty;?><input type="hidden" name="pcs_wgt[]" value="<?php echo $qty;?>"></td>
		<td style="width:7%"><?php echo $fetch->wgt;?></td>
		<td style="width:7%;text-align:center;"><?php 
							
		//echo $bal_wgt += $coldata['received_wgt'];
		echo $bal=$qty-$fetch->wgt;
			?><input type="hidden" name="balance_wgt[]" value="<?php echo $bal;?>"></td>
		<!--td style="width:3%"><?php echo $coldata['weight']-$fetch->wgt;?></td-->
	
		<td style="width: 8%"><div class="col-sm-12">
			<input type="number" class="wgt form-control" id="wgt" name="received_wgt[]"  autocomplete="off" onkeyup="cal_wgt();" >
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
        <!--td style="width:7%"></td-->
		<td style="width:3%"><b>Total</b></td>
		
			<td style="width: 8%"><div class="col-sm-12">
				<input type="text" class="form-control" id="tot_weight" name="total" autocomplete="off" required value="0">
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

<script>
	function cal_tweight1(rw){
		//delwgt_
		//planwgt_
		//balwgt_
		var pw = $('#planwgt_'+rw).val();
		var nw = $('#delwgt_'+rw).val();
		var dl = $('#del_wgt'+rw).val();
		var bw = $('#balwgt1_'+rw).val();
		if(bw=='0' || bw==''){
			 bw = parseFloat(pw)-parseFloat(nw);
		} else {
			 bw = parseFloat(bw)-parseFloat(nw);
		}
		$('#balwgt_'+rw).val(bw);
		
		var sum = 0;
		$('.tweight').each(function() {
			sum += Number($(this).val());
		});
		$('#total_weight1').val(sum);
	}

	$('.delivery_wgt').keyup(function () {
		var sum = 0;
		$('.delivery_wgt').each(function() {
			sum += Number($(this).val());
		});
		$('#total').val(sum);
	});

	$(document).ready(function() {
		$('#example').DataTable();
	});
	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
		$('#delete_'+ID).hide();
	  }
	  }
	</script>

</body>
</html>