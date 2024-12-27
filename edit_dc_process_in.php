<?php 
// Start the session
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

$gid=$_GET['id'];
$party_dc=$_GET['party_dc'];
$from0=$_GET['from'];
$order0=$_GET['order'];
$style0=$_GET['style'];

if (isset($_REQUEST['save'])) {
	 // $select=mysqli_fetch_array(mysqli_query($zconn,"select max(id) as id from process_dcin_master"));
	 // $id=$select['id']+1;

	$count=count($_REQUEST['wgt']);

	for($i=0; $i<$count; $i++) {
		if ($_REQUEST['delivery_wgt'][$i]>0) {
			
				$order.=$_REQUEST['order_no'][$i].",";
				$style_no.=$_REQUEST['style_no'][$i].",";
				//$fabric_name.=$_REQUEST['fabric_name'][$i].",";
				
		
			

		}
	}

$sql=mysqli_query($zconn,"UPDATE  process_dcin_master set order_no='".$order."',style_no='".$style_no."',dc_no='".$_REQUEST['dc_no']."',date=Now(),total='".$_REQUEST['total']."',from_addr='".$_REQUEST['from']."',party_dc='".$_REQUEST['party_dc']."',party_date='".$_REQUEST['party_date']."' where dc_no='$gid' and party_dc='$party_dc'");
	for($i=0; $i<$count; $i++) {
		if ($_REQUEST['delivery_wgt'][$i]>0) {
			$delivery=$_REQUEST['delivery_wgt'][$i];
		$sql=mysqli_query($zconn,"UPDATE  process_dc_in set order_no='".$_REQUEST['order_no'][$i]."',style_no='".$_REQUEST['style_no'][$i]."',dc_no='".$_REQUEST['dc_no']."',date=Now(),fabric_name='".$_REQUEST['fabric_name'][$i]."',content='".$_REQUEST['content'][$i]."',color='".$_REQUEST['color'][$i]."',dia='".$_REQUEST['dia'][$i]."',gsm='".$_REQUEST['gsm'][$i]."',gauge='".$_REQUEST['gauge'][$i]."',loop_length='".$_REQUEST['loop_length'][$i]."',lab_no='".$_REQUEST['lab_no'][$i]."',wgt='".$_REQUEST['delivery_wgt'][$i]."',from_addr='".$_REQUEST['from']."',party_dc='".$_REQUEST['party_dc']."',party_date='".$_REQUEST['party_date']."',inward_id='".$_REQUEST['id']."' where dc_no='$gid' and party_dc='$party_dc' and fabric_name='".$_REQUEST['fabric_name'][$i]."' ");
		}
	}
	if($sql) {

		echo '<script>alert("The Record has been Successfully Updated...")</script>';
		header('location:process_dc_in_list.php');
	}
	else{
	 echo '<script>alert("The Record Not Added Please Fill all The correct Detail...");</script>';
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
    <title><?php echo SITE_TITLE;?> - YARN - PROCESS DC IN</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<style>
	th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
	</style>
		  <style>
        /* CSS for the container */
        .scroll-container {
            width: 100%; /* Set the width as needed */
            overflow-x: auto; /* Enable horizontal scrolling */
        }
    </style>
</head>

<body>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <!--?php include('includes/header.php');?-->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
		<!--?php include('includes/sidebar.php');?-->
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
                        <h4 class="page-title">YARN - PROCESS DC IN</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <form method="post">
            <div class="container-fluid">               
                <!-- ============================================================== -->
                <!-- Sales chart -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12" >
										<div class="col-sm-6" style="float:left; left: 50px; ">
											<div class="form-group row">
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">DC No</label>
												<div class="col-sm-6">
													<input type="text" class="form-control" name="dc_no" id="dc_no" value="<?php echo $gid;?>">
												
												</div>
												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Process</label>
												<div class="col-sm-6">
													<input type="text" name="from" readonly class="form-control" value="<?php echo $from0;?>" >
													<!-- <?php 

													 $sel_buyer = mysqli_query($zconn,"select * from process_dcout_master where dc_no='".$_REQUEST['dc_no']."' ");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
														$processs=$res_buyer['to_process'];}
														?> -->
													<!-- <input type="text" name="from" readonly class="form-control" value="<?php echo $processs;?>"> -->
												</div>
											</div>
										</div>
										<div class="col-sm-6" style="float:left; right: 50px; ">
											<div class="form-group row">
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Party DC No</label>
												<div class="col-sm-6">
													<input type="text" name="party_dc"  class="form-control" value="<?php echo $party_dc; ?>" required>
												</div>
												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">Party DC Date</label>
												<div class="col-sm-6">
													<?php 
													 $sel_buyer = mysqli_query($zconn,"select * from process_dcin_master where dc_no='".$gid."' and party_dc='$party_dc' ");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
														$date=$res_buyer['date'];}
														?>
													<input type="date" autocomplete="off" required class="form-control" value="<?php echo $date;?>" id="party_date" name="party_date"  >
												</div>
											</div>
										</div>
									</div>
								</div>
								<br><br>
								<div class="table-responsive">
									<div class="col-12 d-flex no-block align-items-center">
										<h5 class="page-title" style="margin-left: 390px;">PROCESS DC IN</h5>
									</div>
									<div class="scroll-container">
									<table id="example" class="table table-striped table-bordered text-center">
										<thead>
											<tr>
												<th style="width: 5%">S.NO</th>
												<th style="width: 10%">ORDER NO</th>
												<th style="width: 10%">STYLE NO</th>
												<th style="width: 10%">FABRIC NAME</th>
												<th style="width: 5%">DIA</th>
												<th style="width: 5%">GSM</th>
												<th style="width: 10%"  data-toggle="tooltip" title="Quantity">TOTAL WEIGHT</th>
												<!-- <th style="width: 4%"  data-toggle="tooltip" title="Unit of Measurement">UOM</th> -->
												<th style="width: 10%"  data-toggle="tooltip" title="Already Received">ALR. REC.</th>
												<th style="width: 5%"  data-toggle="tooltip" title="Balance">BAL.</th>
												<th style="width: 5%">ROLLS</th>
												<th  style="width: 20%" data-toggle="tooltip" title="Received">WGT</th>
											</tr>
										</thead>
										<tbody>
											<?php
											$i=1;


											$sectBrnQry = "SELECT * FROM process_dc_in where dc_no='25' and from_addr='KNITT' and party_dc='0005'";
										//	print_r($sectBrnQry);
												
											
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											
											//print_r($secBrnResource);
											while($coldata1 = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
												print_r($coldata1);
												//exit();
												//echo $coldata1;

											$sectBrnQry = "SELECT * FROM process_dc_out where dc_no='".$gid."' and to_process='$from0'";
											  // Print the entire row as an associative array
   // print_r($coldata1);

    // Or, print specific columns from the row
    echo "Order No: " . $coldata1['order_no'] . "<br>";
    echo "Style No: " . $coldata1['style_no'] . "<br>";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
												// $order_no=$coldata['order_no'];
												// $style_no=$coldata['style_no'];
												// $fabric_name=$coldata['fabric_name'];
												// $processs;



												$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_in where dc_no='".$_REQUEST['id']."' and order_no='".$coldata['order_no']."' and style_no='".$coldata['style_no']."' and fabric_name='".$coldata['fabric_name']."' and from_addr= '".$from0."' "));

													$in=$coldata1['wgt'];
											?>
											<tr>
												<td style="width: 2%"><?php echo $i;?></td> 
												<td style="width: 5%"><?php echo $coldata1['order_no']?><input type="text" name="id[]" value="<?php echo $coldata['inward_id']?>"><input type="hidden" name="order_no[]" value="<?php echo $sectBrnQry['order_no']?>"> </td>
												<td style="width: 10%"><?php echo $coldata1['style_no']?><input type="text" name="style_no[]" value="<?php echo $coldata['style_no']?>"></td>
												<td style="width: 10%"><?php echo $coldata['fabric_name']?><input type="text" name="fabric_name[]" value="<?php echo $coldata['fabric_name']?>"></td>
												<td style="width:5%"><?php echo $coldata['dia']?><input type="text" name="dia[]" value="<?php echo $coldata['dia']?>"></td>
												<td style="width: 4%"><?php echo $coldata['gsm']?><input type="text" name="gsm[]" value="<?php echo $coldata['gsm']?>"></td>
												<td style="width: 8%"><?php echo $in;?></td>
												<td style="width: 4%"><?php echo $coldata1['wgt']?><input type="text" name="wgt[]" value="<?php echo $coldata['wgt']?>"></td>
												<!-- <td style="width: 4%"><?php echo $coldata['style_no']?></td> -->
												
												<td style="width: 8%"><?php echo $coldata1['wgt']-$in;?></td>
											
												<td style="width: 8%"><div class="col-sm-12">
														<input type="text" class="form-control" id="roll" name="roll[]" autocomplete="off"  >
													</div>
												</td>
												<td style="width: 20%"><div class="col-sm-12">
														<input type="text" class="form-control delivery_wgt"  value="<?php echo $coldata1['wgt'];?>"   id="delivery_wgt" name="delivery_wgt[]" autocomplete="off"  >
													</div>
												</td>
											</tr>
											

											<?php
											$i++;	}  }
											?>

											<tr>
												<td colspan="10">TOTAL</td>
												<td><input type="text" name="total" id="total" class="form-control"> </td>
											</tr>
											
										</tbody>
										
									</table>
										</div>
								</div>
								<div class="card" style="width:100%">
									<div class="border-top">
										<div class="card-body" style="margin-left: 400px;">
											<button type="submit" name="save" class="btn btn-success">Save</button>
											<button type="reset" class="btn btn-primary">Reset</button>
							<a href="process_dc_in_list.php"><button type="button" class="btn btn-danger">Back</button></a>

										</div>
									</div>
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
    	$('.delivery_wgt').keyup(function () {
    var sum = 0;
    $('.delivery_wgt').each(function() {
        sum += Number($(this).val());
    });
     
 
    $('#total').val(sum);
     
});

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