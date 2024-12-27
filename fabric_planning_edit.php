<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

$id=$_GET['id'];
if (isset($_REQUEST['save_fabric'])) {

$ins=mysqli_query($zconn,"update fabric_entry set `order_no`='".$_REQUEST['order_no']."',`style_no`='".$_REQUEST['style_no']."',`fabric_name`='".$_REQUEST['fabric']."',`color`='".$_REQUEST['color']."',`dia`='".$_REQUEST['dia']."',`gsm`='".$_REQUEST['gsm']."',`order_qty`='".$_REQUEST['order_qty']."',`req_qty`='".$_REQUEST['req_qty']."',`date`=Now(),`total`='".$_REQUEST['total']."' where id='$id'" );

if (isset($ins)) {
 echo '<script>alert("Fabric Planning update has been Sucessfully !!!")</script>';
 header('location:fabric_entry_list.php');
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
    <title><?php echo SITE_TITLE;?> - EDIT FABRIC PLANNING</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<style>
	th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
	</style>
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
                        <h4 class="page-title">EDIT FABRIC PLANNING</h4>
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
                <?php 
                $select=mysqli_query($zconn,"select * from fabric_entry where id='$id'");
                while($dta=mysqli_fetch_object($select)){
                	$fabric_name=$dta->fabric_name;
                	$style_no=$dta->style_no;
                	$orderno=$dta->order_no;
                	$color=$dta->color;
                	$dia=$dta->dia;
                	$gsm=$dta->gsm;
                	$order_qty=$dta->order_qty;
                	$req_qty=$dta->req_qty;
                	$total=$dta->total;
                }
                ?>
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12" >
										<div class="col-sm-6" style="float:left; left: 50px;">

											<div class="form-group row">
												<!-- <label for="fname" class="col-sm-4 text-right control-label col-form-label">&nbsp;Buyer Name</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="buyer" id="buyer">
													<option>Select</option>
													<?php $sel_buyer = mysqli_query($zconn,"select * from buyer_master where 1 group by buyer_id");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
													<option value="<?php echo $res_buyer['buyer_name'];?>"><?php echo $res_buyer['buyer_name'];?></option>
													<?php } ?>
													</select>
												</div>
												<br>
												<br>
												<br> -->
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">&nbsp;Order No</label>
												<div class="col-sm-6">

													<input type="text" name="order_no" class="form-control" value="<?php echo $orderno;?>" >
													<!-- <select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
													<option>Select</option>
													<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
													<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['order_no'];?></option>
													<?php } ?>
													</select> -->
												</div>
												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">&nbsp;Style No</label>
												<div class="col-sm-6">
													<input type="text" name="style_no" class="form-control" value="<?php echo $style_no;?>" >
													<!-- <select class="select2 form-control custom-select" name="sel_buyer" id="sel_buyer" onchange="$('#costing_list').submit();">
													<option>Select</option>
													<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
													<option value="<?php echo $res_buyer['id'];?>"><?php echo $res_buyer['style_no'];?></option>
													<?php } ?>
													</select> -->
												</div>

												
											</div>
										</div>									
									</div>
								</div>
								<br><br>
								<div class="table-responsive">
									<div class="col-12 d-flex no-block align-items-center">
										<h5 class="page-title" style="margin-left: 400px;">EDIT FABRIC PLANNING</h5>
									</div>
									<table id="example" class="table table-striped table-bordered text-center">
										<thead>
											<tr>
												<th style="width: 8%;">FABRIC NAME</th>
												<th style="width: 8%;">COLOUR</th>
												<!-- <th style="width: 4%;" data-toggle="tooltip" title="Consumption">CONS.</th> -->
											<!-- 	<th style="width: 4%;" data-toggle="tooltip" title="Unit of Measurement">UOM</th> -->
												<th style="width: 4%;">DIA</th>
												<th style="width: 4%;">GSM</th>
												<th style="width: 6%;">ORDER QTY.</th>
												<th style="width: 6%;" data-toggle="tooltip" title="Required Quantity">PCS WEIGHT.</th>
												<!-- <th style="width: 4%;" data-toggle="tooltip" title="Excess in %">EX.(%)</th> -->
												<th style="width: 6%;" data-toggle="tooltip" title="Total Quantity">TOTAL. QTY.</th>
												<!-- <th style="width: 4%;">RATE</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											$sectBrnQry = "SELECT * FROM company_info ORDER BY id";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
											?>
											<tr>
												<td style="width: 8%;">
													<select class="select2 form-control" name="fabric">
														<option value="<?php echo $fabric_name;?>"><?php echo $fabric_name;?></option>
														<option>Select</option>
														<?php $select=mysqli_query($zconn,"select * from fabric_master where status='0' ");
														while($data=mysqli_fetch_array($select,MYSQLI_ASSOC)){
															?>
															<option value="<?php echo $data['fabric_name']; ?>"><?php echo $data['fabric_name']; ?></option>
														<?php } ?>
													</select>
												</td>
												<td style="width: 8%;">
													<select class="form-select2 form-control" name="color">
														<option value="<?php echo $color;?>"><?php echo $color;?></option>
														<option>select</option>
														<?php $color=mysqli_query($zconn,"select * from color_master where status='0' ");
														while($codata=mysqli_fetch_array($color,MYSQLI_ASSOC)){?>
														<option value="<?php echo $codata['colour_name'];?>"><?php echo $codata['colour_name'];?></option>
													<?php } ?>
													</select>
												</td>
												<!-- <td style="width: 4%;"><input type="text" class="form-control" name="cons"></td>
												<td style="width: 4%;"><input type="text" class="form-control" name="uom"></td> -->
												<td style="width: 4%;"><input type="text" class="form-control" name="dia" value="<?php echo $dia;?>"></td>
												<td style="width: 4%;"><input type="text" class="form-control" name="gsm" value="<?php echo $gsm;?>"></td>
												<td style="width: 6%;"><input type="text" class="form-control" name="order_qty" id="order_qty" value="<?php echo $order_qty;?>"></td>
												<td style="width: 6%;"><input type="text" class="form-control" name="req_qty" value="<?php echo $req_qty;?>" id="req_qty" onkeyup="pcsweight()"></td>
												<!-- <td style="width: 4%;"><input type="text" class="form-control" name="excess"></td> -->
												<td style="width: 6%;"><input type="text" class="form-control" name="total" id="total" value="<?php echo $total;?>"></td>
												<!-- <td style="width: 4%;"><input type="text" class="form-control" name="rate"></td> -->
											</tr>
											<?php
												}
											?>
										</tbody>
									</table>
								</div>
								<div class="card" style="width:100%">
									<div class="border-top">
										<div class="card-body" style="margin-left: 400px;">
											<button type="submit" name="save_fabric" class="btn btn-success" value="<?php echo $action;?>">Update</button>
											<div class="btn-group-vertical">
                <a href="fabric_entry_list.php"><button type="button" class="btn btn-danger">Back</button></a>

				</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>				
				</form>
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
    	function pcsweight(){
    		var order=document.getElementById('order_qty').value;
    		var pcs=document.getElementById('req_qty').value;

    		var total=order*pcs;
    		document.getElementById('total').value=total;
    	}
	$(document).ready(function() {
    $('#example').DataTable();
	} );
	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
	  $('#delete_'+ID).hide();
	  }
	  }
	</script>	

</body>
</html>