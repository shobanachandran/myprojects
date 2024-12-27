<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_REQUEST['save_fabric'])){
$date2= date('Y-m-d', strtotime($_REQUEST['receive_date']));
$po_sql=mysqli_fetch_array(mysqli_query($zconn,"select max(id) as id from fabric_po_master"));
	$po_no=$po_sql['id']+1;


	// echo "update `fabric_po_master` set `to_address`='".$_REQUEST['to_address']."',`delivery`='".$_REQUEST['delivery']."',`comments`='".$_REQUEST['comments']."',`po_date`='".$_REQUEST['po_date']."',`receve_date`='".$_REQUEST['receve_date']."',`total_weight`='".$_REQUEST['total_weight']."',`status`='update' where po_no='".$_GET['id']."'";

	// exit;
	 $sql1 = mysqli_query($zconn,"update `fabric_po_master` set `to_address`='".$_REQUEST['to_address']."',`delivery`='".$_REQUEST['delivery']."',`comments`='".$_REQUEST['comments']."',`po_date`='".$_REQUEST['po_date']."',`receve_date`='".$_REQUEST['receve_date']."',`total_weight`='".$_REQUEST['total_weight']."',`status`='update' where po_no='".$_GET['id']."'");

				for($i=0;$i<count($_REQUEST['now']);$i++){
					if ($_REQUEST['now'][$i] >0 ) {
						$now_qty=$_REQUEST['now'][$i];
					 	$id=$_REQUEST['fdid'][$i];
						$fabric_name=$_REQUEST['fabric_name'][$i];
						$style_no=$_REQUEST['style_no'][$i];
						$order_no=$_REQUEST['order_no'][$i];
						$sql1 = mysqli_query($zconn,"update `fabric_po_details` set `fabric_name`='".$_REQUEST['fabric_name'][$i]."',`styleno`='$style_no', `order_no`='$order_no', `weight`='$now_qty',`grant_total`='".$_REQUEST['total_weight']."',`date`=Now() where id ='$id' and styleno='$style_no' and order_no='$order_no' and po_id='".$_REQUEST['fabric_po']."'");

			
				}
				if ($sql1) {
		echo '<script> alert("Record has been Update successfully !")</script>';
		header('location:fabric_po_list.php');
	}
			}
}

if (isset($_REQUEST['name'])=='delete'){
$del=mysqli_query($zconn,"delete from fabric_po_details where id='".$_REQUEST['id']."' and po_id='".$_REQUEST['po_id']."' ");
}
if ($del) {
		echo '<script> alert("Record has been delete successfully deleted!")</script>';
		header('location:fabric_po_list.php');
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
    <title><?php echo SITE_TITLE;?> - FABRIC PO EDIT</title>
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
                        <h4 class="page-title">FABRIC PO EDIT</h4>
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
								<!-- <div class="row">
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
												<?php  foreach($style_no1 as $style_no){
												?>			 
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
												<?php  foreach($order_no1 as $order_no){
												?>			 
												 <option value="<?php echo $order_no?>"<?php if(in_array($order_no,$_REQUEST['order'],true)){?> selected="selected"<?php }?>><?php echo $order_no;?></option>
												<?php }  ?>
											</select>
											
										</div>
										</div>
									</div> -->
									<!-- <div class="col-sm-6" style="float:left;">
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
												<?php  foreach($fabric as $fabric_name){
												?>			 
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
									</div>-->
								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered" style="width:100%">
										<thead style="background-color: #626F80; color: #fff; font-size: 16px;">
											<tr>
												<th></th>
												<th>STYLE NO</th>
												<th>ORDER NO</th>
												<th>FABRIC NAME</th>
												<th>COLOR</th>
												<th>ORDER QTY.</th>
												<th>TOTAL WEIGHT</th>
												<!-- <th>REQUIRED QTY.</th>
												<th>BALANCE QTY.</th> -->
												<th>NOW WANTED
												(weight)</th>
												<th>DELETE</th>
											</tr>
										</thead>
										<tbody> 
											<?php
											$id=$_GET['id'];
											$total_weight=0;
											$result= "SELECT * FROM fabric_po_details where po_id='$id'";
											
									    $secBrnResource = mysqli_query($zconn,$result."order by id asc");
									    while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
									    	$fab=$coldata['fab_id'];

									    	// echo "select * from fabric_entry where id='$fab' and style_no='".$coldata['styleno']."' and order_no='".$coldata['order_no']."'";
									    	$fabric=mysqli_fetch_array(mysqli_query($zconn,"select * from fabric_entry where id='$fab' and style_no='".$coldata['styleno']."' and order_no='".$coldata['order_no']."'"));
											?>
											<tr>
												<td><input type="checkbox" name="" id=""></td>
												<td><?php echo $coldata['styleno'];?><input type="hidden" name="fdid[]" id="fdid" value="<?php echo $coldata['id'];?>"> <input type="hidden" name="style_no[]" id="style_no" value="<?php echo $coldata['styleno'];?>"></td>
												<td><?php echo $coldata['order_no'];?> <input type="hidden" name="order_no[]" id="order_no" value="<?php echo $coldata['order_no'];?>"></td>
												<td><?php echo $coldata['fabric_name'];?> <input type="hidden" name="fabric_name[]" id="fabric_name" value="<?php echo $coldata['fabric_name'];?>"></td> 
												<td><?php echo $coldata['color'];?><input type="hidden" name="cons[]" id="cons" class=" form-control"  value="<?php echo  $coldata['color'];?>" /></td>
												<td><?php echo $fabric['order_qty'];?> </td>
												<td><?php echo $fabric['total'];?></td>
											<!-- 	<td><input type="text" name="excess[]" id="excess" class=" form-control" /></td> -->
										<!-- 		<td><input type="text" name="balance[]" id="balance" class=" form-control"  /></td> -->
												<td><input type="text" name="now[]" id="now<?php echo $coldata['id'];?>" onkeyup="now_wanted(<?php echo $coldata['id'];?>)" class=" form-control now" value="<?php echo  $coldata['weight'];$total_weight+=$coldata['weight'];?>" /></td>
												<td><a href="fabric_po_edit.php?id=<?php echo $coldata['id'];?>&name=<?="delete"?>&po_id=<?php echo $coldata['po_id'];?>"><i class="fas fa-trash"></i></a></td>
												<!-- <td><input type="text" name="rate[]" id="rate" class=" form-control"  /></td> -->
												<!-- 
												
												
												<td><?php echo $coldata['color'];?></td>
												<td><?php echo $coldata['total'];?></td> -->
											</tr>
											<?php
												}
											?>
											<tr>
											<td colspan="7">TOTAL</td>
										
											<td><input type="text" name="total_weight" id="total_weight" value="<?php echo $total_weight;?>" class=" form-control"  /></td>
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
											$po=mysqli_fetch_array(mysqli_query($zconn,"select * from fabric_po_master where po_no='$id'"));
											$to_address=$po['to_address'];
											$delivery=$po['delivery'];
										
											$po_date=$po['po_date'];
											$receve_date=$po['receve_date'];
									
											$comments=$po['comments'];
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


									<input type="text" autocomplete="off" required class="form-control" id="po_date" readonly name="po_date" value="<?php echo $po_date; ?>">
								</div>
							</div>
							<div class="form-group row">
								<label for="lname" class="col-sm-3 text-right control-label col-form-label">To Address</label>
								<div class="col-sm-6">

									<select class="form-control" required placeholder="Supplier" id="to_address" name="to_address">
										<option value="<?php echo $to_address;?>"><?php echo $to_address;?></option>
										<option>Select</option>
										<?php 
										      $tocompe=mysqli_query($zconn,"SELECT * FROM  `suppliers` where status='0'");
											 while($tocompe_res=mysqli_fetch_object($tocompe)){
											 	?>
										     <option value="<?php echo $tocompe_res->supplier_name;?>"><?php echo $tocompe_res->supplier_name;?></option>
										     <?php }?>
									</select>
									<a href="supplier.php"><button type="button" class="btn btn-info">New Supplier Add</button></a>
								</div>
							</div>
													
						</div>
						<div class="card" style="width:50%; float:left; right: 50px;">
							<div class="form-group row">
								<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Recieved Date</label>
								<div class="col-sm-6">
									<input type="date" class="form-control" id="receve_date" name="receve_date" value="<?php echo $receve_date;?>" autocomplete="off" required >
								</div>
							</div>
							
							<div class="form-group row">
								<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Comments</label>
								<div class="col-sm-6">
									<input type="text" class="form-control" id="comments" name="comments" autocomplete="off" value="<?php echo $comments;?>" required placeholder="comments">
								</div>
							</div>	
							<div class="form-group row">
								<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Deleivery To</label>
								<div class="col-sm-6">
									<select class="select2 form-control custom-select" name="delivery" id="delivery">
									<option value="<?php echo $delivery;?>"><?php echo $delivery;?></option>
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
	$(document).ready(function() {
    $('#example').DataTable();
	} );
	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
	  $('#delete_'+ID).hide();
	  }
	  }


	 $('.now').keyup(function () {
    var sum = 0;
    $('.now').each(function() {
        sum += Number($(this).val());
    });
     
    $('#total_weight').val(sum);
     
});


	</script>	

</body>
</html>