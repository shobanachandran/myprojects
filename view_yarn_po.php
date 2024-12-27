<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}


if(isset($_REQUEST['save'])){
$date2= date('Y-m-d', strtotime($_REQUEST['receive_date']));
$sql1 = mysqli_query($zconn,"update `yarns_po_master`set `buyer`='".$_REQUEST['to_address']."',`deliver_to`='".$_REQUEST['delivery']."',`cgst`='".$_REQUEST['cgst']."',`sgst`='".$_REQUEST['sgst']."',`igst`='".$_REQUEST['igst']."',`grant_total`='".$_REQUEST['grant_total']."',`status`='Update',`date`='".$_REQUEST['po_date']."',`kg_bag`='".$_REQUEST['bag']."',`total_bag`='".$_REQUEST['total_bag']."',`comments`='".$_REQUEST['comments']."',`receive_date`= '".$_REQUEST['receive_date']."' where id ='".$_GET['id']."'");
				for($i=0;$i<count($_REQUEST['now']);$i++){
					if ($_REQUEST['now'][$i] >0 ) {
						$now_qty=$_REQUEST['now'][$i];
					 	$id=$_REQUEST['po_id'][$i];
						$pcs_rate=$_REQUEST['rate'][$i];
						$style_no=$_REQUEST['style_no'][$i];
						$order_no=$_REQUEST['order_no'][$i];
			$sql1 = mysqli_query($zconn,"update `yarns_po_details` set `id`='$id',`styleno`= '$style_no', `order_no`='$order_no', `weight`='$now_qty', `rate`='$pcs_rate',`grant_total`='".$_REQUEST['grant_total']."',`date`=Now(),`cutting_qty`='".$_REQUEST['cutting_qty'][$i]."',`counts`='".$_REQUEST['counts'][$i]."',`consumption`='".$_REQUEST['consumption'][$i]."' where id ='".$id."' and po_id='".$_REQUEST['po']."' and `styleno`= '$style_no' and `order_no`='$order_no' ");
				}
				if ($sql1) {
		echo '<script> alert("Record has been Update successfully !")</script>';
		header('location:view_yarn_po.php');
	}
			}
		}
if(isset($_REQUEST['name'])=='delete'){
	$id=$_REQUEST['id'];
	$po=$_REQUEST['po'];
	$delete=mysqli_query($zconn,"delete from yarns_po_details where po_id='$po'and id='$id'");
	if ($delete) {
		echo '<script> alert("Record has been delete successfully deleted!")</script>';
		header('location:yarn_po_list.php');
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
    <title><?php echo SITE_TITLE;?> - YARN PO EDIT</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<style>
		th{font-size:12px; font-weight:bold; background-color:#626F80; text-align:center;}
	</style>
	<script type="text/javascript" src="highslide/highslide-with-html.js"></script>
<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />

<script type="text/javascript">

hs.graphicsDir = 'highslide/graphics/';
hs.outlineType = 'rounded-white';
hs.wrapperClassName = 'draggable-header';

</script>
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
                        <h4 class="page-title">YARN PO EDIT</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">   
            <form name="costing_list" id="costing_list" method="post">            
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
								<!-- <div class="row">
									<div class="col-sm-12" > -->
									<!-- <div class="col-sm-6" style="float:left;">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Style No</label>
										<div class="col-sm-3">
											<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
												<option>Select</option>
												<?php $select=mysqli_query($zconn,"select * from order_entry_master order by order_id");
													while($data=mysqli_fetch_object($select)){
												?>											
												<option value="<?php echo $data->order_id;?>"><?php echo $data->order_id;?></option>
											<?php } ?>
											</select>
										</div>

										<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Order No</label>
										<div class="col-sm-3">
											<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
											<option>Select</option>
											<?php $sel_buyer = mysqli_query($zconn,"select * from order_entry_master where 1 group by order_id");
											while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
											<option value="<?php echo $res_buyer['order_no'];?>"><?php echo $res_buyer['order_no'];?></option>
											<?php } ?>
											</select>
										</div>
										</div>
									</div> -->

									<!-- <div class="col-sm-6" style="float:left;">
									<div class="form-group row">
										
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Yarn Name</label>
										<div class="col-sm-3">
											<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
											<option>Select</option>
											<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
											while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
											<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
											<?php } ?>
											</select>
										</div>
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Counts</label>
										<div class="col-sm-3">
											<select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
											<option>Select</option>
											<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
											while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
											<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['costing_no'];?></option>
											<?php } ?>
											</select>
										</div>
										</div>
									</div>
									 -->
									<!-- </div> -->
									<!-- </div> -->
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead style="background-color: #626F80; color: #fff; font-size: 16px;">
											<tr>
												<th>S.NO</th>
												<th>STYLE NO</th>
												<th>ORDER NO</th>
												<th>YARN NAME</th>
												<th>COUNT</th>
												<th>PCS.WGT</th>
												<th>CUTTING QTY.</th>
												<!-- <th>SHIPMENT QTY.</th> -->
												<th>BALANCE QTY.</th>
												<th>NOW WANTED
												(weight)</th>
												<th>RATE</th>
												<!-- <th>DELETE</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											$id=$_GET['id'];
											$sectBrnQry = "SELECT * FROM yarns_po_details where po_id='$id'";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											$total_weight=0;
										    $sno=1;
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
												$id=$coldata['po_id'];
												$idd=$coldata['id'];
												$grant_total=$coldata['grant_total'];
								
											?>
											<tr>
												<td><?php echo $sno;?></td>

												<td><?php echo $coldata['styleno'];?><input type="hidden" name="style_no[]" id="style_no" value="<?php echo $coldata['styleno'] ?>" class="form-control">
													<input type="hidden" name="po_id[]" id="po_id" value="<?php echo $coldata['id'] ?>" class="form-control"></td>
												<td><?php echo $coldata['order_no'];?><input type="hidden" name="order_no[]" id="yarn_name" value="" class="form-control"></td>
												<td><?php echo $coldata['yarn_name'];?><input type="hidden" name="order_no[]" id="order_no" value="<?php echo $coldata['order_no'] ?>" class="form-control"></td>
												<td><input type="text" name="counts[]" id="counts" class="form-control"  value="<?php echo $coldata['counts'] ?>"></td>
												<td><input type="text" name="consumption[]" class="form-control" id="consumption"  value="<?php echo $coldata['consumption'] ?>"></td>
												<td><?php echo $coldata['cutting_qty'];?></td>
												<!-- <td><?php echo $coldata['style_no'];?></td> -->
												<td>
												<input type="text" name="balance" id="balance[]" class="form-control"></td>
												<td
												><input type="text" name="now[]" id="now<?php echo $id;?>" value="<?php echo $coldata['weight'];$total_weight+=$coldata['weight']; ?>"  class="form-control now_total" onkeyup="now('<?php echo $id;?>')"></td>
<!-- 
												<input type="text" name="now" id="now" class="form-control now_wanted" value="<?php echo 10 * $coldata['cutting_qty'];?>"></td> -->

												<td><input type="text" name="rate[]" value="<?php echo $coldata['rate'] ?>" class="form-control"></td>
												<!-- <td><a href="yarn_po_edit.php?id=<?=$idd;?>&name=<?="delete"?>&po=<?=$id;?>"><i class="fas fa-trash"></i></a>
</td> -->
											</tr>
											<?php
												$sno++; }	
											?>


											<tr>
												<td>Total</td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
										<!-- 		<td></td> -->
												
												<td><input type="text" name="grant_total" id="grant_total"  value="<?php echo $total_weight;?>" class="form-control"></td>
												<td></td>
												<td></td>
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
							<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">PO No</label>
										<div class="col-sm-6">

											<?php 

											$po=mysqli_fetch_array(mysqli_query($zconn,"select * from yarns_po_master where id='$id'"));
											$buyer=$po['buyer'];
											$deliver_to=$po['deliver_to'];
											$grant_total=$po['grant_total'];
											$cgst=$po['cgst'];
											$sgst=$po['sgst'];
											$igst=$po['igst'];
											$date=$po['date'];
											$receive_date=$po['receive_date'];
											$kg_bag=$po['kg_bag'];
											$total_bag=$po['total_bag'];
											$comments=$po['comments'];
											?>
											<input type="text" autocomplete="off" required class="form-control" id="po" name="po" readonly name="costing_date" value="<?php echo $id;?>" >
										</div>
									</div>
									
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Yarn PO Date</label>
										<div class="col-sm-6">
											<input type="text" autocomplete="off" required class="form-control" id="po_date" readonly name="po_date" value="<?php 
												if($date!=''){
													echo $date;
												}
												else{
												echo date('d/m/Y');
												}
												?>" >
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">To Address</label>
										
										<div class="col-sm-6">

											<select class="select2 form-control custom-select" id="to_address" name="to_address">
												<option value="<?php echo $buyer;?>"><?php echo $buyer;?></option>
											<option>selection</option>
											<?php 
										      $tocompe=mysqli_query($zconn,"SELECT * FROM  `supplier_types` where status='0'");
											 while($tocompe_res=mysqli_fetch_object($tocompe)){
											 	?>
										     <option value="<?php echo $tocompe_res->supplier_type;?>"><?php echo $tocompe_res->supplier_type;?></option>
										     <?php }?>
										 </select>


											<!--<a href="supplier.php"><button type="button" class="btn btn-info">New Supplier Add</button></a>
											<a href="javascript:;" onclick='window.open("supplier_popup.php", "hello", "width=1000,height=700");'>Click Here</a>-->

										</div>
									</div>
									
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >KGs Per Bag</label>
										<div class="col-sm-6">
								<input type="text" class="form-control" id="bag" name="bag" value="<?php echo $kg_bag;?>"  required autocomplete="off" onkeyup="bagcalcultaion()">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Total Bags</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="total_bag" value="<?php echo $total_bag;?>" name="total_bag" required autocomplete="off"  value="0">
										</div>
									</div>
													
						</div>
						<div class="card" style="width:50%; float:left; right: 50px;">
							<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Recieved Date</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="receive_date" name="receive_date"  value="<?php echo $receive_date;?>" autocomplete="off" required >
										</div>
									</div>
									
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Comments</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="comments" name="comments" autocomplete="off" required placeholder="comments" value="<?php echo $comments; ?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Deleivery To</label>
										<div class="col-sm-6">
											<select class="select2 form-control custom-select" name="delivery" id="delivery">
												<option value="<?php echo $deliver_to;?>"><?php echo $deliver_to;?></option>
											<option>selection</option>
											<?php 
										      $tocompe=mysqli_query($zconn,"SELECT * FROM  `suppliers` where status='0'");
											 while($tocompe_res=mysqli_fetch_object($tocompe)){
											 	?>
										     <option value="<?php echo $tocompe_res->supplier_name;?>"><?php echo $tocompe_res->supplier_name;?></option>
										     <?php }?>
										 </select>
										</div>
									</div><div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">CGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="cgst"  value="<?php echo $cgst;?>" name="cgst" autocomplete="off" required placeholder="style no" value="0">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">SGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="sgst" name="sgst" value="<?php echo $sgst;?>" autocomplete="off" required placeholder="style no" value="0">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">IGST(%)</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="igst" name="igst" value="<?php echo $igst;?>" autocomplete="off" required placeholder="style no" value="0">
										</div>
									</div>
									
																		
						</div>
					</div>
					<div class="border-top">
						<div class="card-body" style="margin-left: 500px;">
							<button type="submit" name="save" class="btn btn-success">Update</button>
							<button type="reset" class="btn btn-primary">Reset</button>	
							<a href="yarn_confirm_po.php"><button type="button" class="btn btn-danger">Back</button></a>
				
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
	$(document).ready(function() {
    $('#example').DataTable();
	} );
	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
	  $('#delete_'+ID).hide();
	  }
	  }

	 
	function now(sno){
		var now = document.getElementById('now'+sno).value;
		grant_total();
		}


function now(){
	var sum=0;
	$('.now_total').each(function(index, element){
	if($(element).val()!="")
            sum += parseFloat($(element).val());
        });
    $('#grant_total').val(Math.round(sum));
}


function bagcalcultaion(){
	var bag=document.getElementById('bag').value;
	var total=document.getElementById('grant_total').value;
	var tot_bag=(total/bag);

	var total_bag=tot_bag.toFixed(1);


    if(parseInt(total_bag) == total_bag){
    	document.getElementById('total_bag').value=total_bag;	 
    }
    else if(parseFloat(total_bag) == total_bag){
        var mystr = total_bag.toString()
        var myarr = mystr.split(".");
    	  var explode=myarr[1];
    	  if (explode>4) {
    	  	var total_bag=Math.round(tot_bag.toFixed(1));
    	  	document.getElementById('total_bag').value=total_bag;
    	  }

    	  else{
    	  	var total_bag0=Math.round(tot_bag.toFixed(1));

			var total_bag=total_bag0+1;
			document.getElementById('total_bag').value=total_bag;
    	  }
    }
    
     else{
        alert('Invalid');
    } 


//expode()
	//console.log(total_bag);

	// document.write('<br />');
	// var_dump(total_bag);

	//void var_dump (total_bag);



// var var_dump= var_dump($total_bag)

// alert(var_dump);

	//document.getElementById('total_bag').value=total_bag;




}

 </script>	
</body>
</html>