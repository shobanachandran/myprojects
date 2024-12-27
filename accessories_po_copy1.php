<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}


if(isset($_REQUEST['save'])){
	$date2= date('Y-m-d', strtotime($_REQUEST['receive_date']));
	$po_sql = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as id from accessories_po_master"));
		$po_no=$po_sql['id']+1;
		//(`id`, `po_no`, `style_no`, `order_no`, `buyer`, `deliver_to`, `grand_total`, `rate`, `cgst`
		//, `sgst`, `igst`, `status`, `date`, `kg_bag`, `total_bag`, `comments`, `receive_date`, `created_at`) 
		$sql1 = mysqli_query($zconn,"INSERT INTO `accessories_po_master` 
		(`po_no`, `style_no`, `order_no`, `buyer`,
		`deliver_to`,`cgst`,`sgst`,`igst`,`grant_total`,`rate`,`status`,
		`date`,`kg_bag`,`total_bag`,`comments`,`receive_date`)	
		VALUES('".$po_no."','".$_REQUEST['style_no']."',
		'".$_REQUEST['style_no']."',
		'".$_REQUEST['to_address']."','".$_REQUEST['delivery']."',
		'".$_REQUEST['cgst']."','".$_REQUEST['sgst']."',
		 '".$_REQUEST['igst']."',
		'".$_REQUEST['grant_total']."','SEND','".$_REQUEST['po_date']."',
		'".$_REQUEST['bag']."','".$_REQUEST['total_bag']."','".$_REQUEST['comments']."',
		'".$_REQUEST['receive_date']."')")or die(mysqli_error());
	
					$last_id = mysqli_insert_id($zconn);
					for($i=0;$i<count($_REQUEST['now']);$i++){
						if ($_REQUEST['now'][$i] >0 ) {
							$now_qty=$_REQUEST['now'][$i];
							 $id=$_REQUEST['po'];
							$pcs_rate=$_REQUEST['rate'][$i];
							$style_no=$_REQUEST['style_no'][$i];
							$order_no=$_REQUEST['order_no'][$i];
	

							//INSERT INTO `accessories_po_details`(`id`, `po_id`, `styleno`, `order_no`, `acc_name`, 
							//`uom`, `consumption`, `descr`, `rate`, `total`, `acc_loss`, 
							//`status`, `created_at`) VALUES
							// ([value-1],[value-2],[value-3],[value-4],[value-5],[value-6],[value-7],[value-8],[value-9],[value-10],[value-11],[value-12],[value-13])
							$sql1 = mysqli_query($zconn,"INSERT INTO 
							
							`accessories_po_details` (`po_id`,`styleno`,
							 `order_no`, `acc_name`, `uom`,
							 `consumption`,`descr`,`date`,`rate`,
							 `total`,`acc_loss`)VALUES
							 ('$last_id', 
							 
							 '$style_no', '$order_no', 
							 '$now_qty','$pcs_rate',
							 '".$_REQUEST['grant_total'].
							 "',Now(),'".$_REQUEST['descr'][$i]."',
							 '".$_REQUEST['uom'][$i]."',
							 '".addslashes($_REQUEST['yarn_count'][$i])."',
							 '".$_REQUEST['acc_name'][$i]."',
							
							 '".$_REQUEST['rate'][$i]."'),
							 '".$_REQUEST['total'][$i]."'),
							 '".$_REQUEST['acc_loss'][$i]."')")or 
							 die(mysqli_error());
						}
					}
	
				if($last_id){
					echo "<script>alert('Added Successfully!!!');</script>";
					echo "<script>window.location.href='yarn_po_list.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - Accessories PO</title>
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
                        <h4 class="page-title">Accessories PO</h4>&nbsp;&nbsp;&nbsp;&nbsp;
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

							<div class="row">
									<div class="col-sm-12" >
									<div class="col-sm-6" style="float:left;">
									<div class="form-group row">
										<label for="fname" class=" text-right control-label col-form-label">&nbsp;Order No</label>
		<div class="col-sm-3">
			<?php $sel_buyer = mysqli_query($zconn,"select * from accessories_planning_list where 1 group by order_no");
			while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
			$order_no1[]=$res_buyer['order_no']; } ?>
			<select  data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" name="order[]" id="order"  onchange="this.form.submit()">
			<option value="">Select</option>
			<?php foreach($order_no1 as  $order_no){?>
			<option value="<?php echo $order_no;?>"<?php if (in_array($order_no,$_REQUEST['order'],true)){?> selected="selected"; <?php }?>>
			<?php echo $order_no;?></option>
			<?php } ?>
			</select>

			
			
		</div>
										
	<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
</div>
	
		</div>
	</div>
	<div class="col-sm-6" style="float:left;">
	<div class="form-group row">
		
		</div>
	</div>
	</div>
	</div>

								<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
											<th style="width:2%"></th>

												<th>STYLE NO</th>
												<th>ORDER NO</th>
												<th>ACCESSORY NAME</th>
												<th>CONTENT</th>
												<th>UOM</th>
												<th>CONSUMPTION</th>
												<th>ORDER QTY</th>
												<th>Balance Qty	</th>
												<th>Now Wanted</th>
												<th>Rate</th>
											</tr>
										</thead>
										<tbody>
										<?php
	$result="SELECT * FROM accessories_planning_list where 1 ";
	if(isset($_REQUEST['Style']) && $_REQUEST['Style'] != '' ){
	$result.="AND `style_no` in (";
		foreach($_REQUEST['Style'] as $syr){
				$syr1.="'".$syr."',";
		}
		$syr = substr($syr1,0,-1);
			$result.=$syr.")";
		}
	if (isset($_REQUEST['order']) && $_REQUEST['order']!='') {
		$result.="and order_no in ('";
		foreach($_REQUEST['order'] as $odr){
			$result.=$odr;
			if (end($_REQUEST['order']) != $odr) {
			$result.="','";
			}
		}
		$result.="')";
	}

	$sto = mysqli_query($zconn,$result."ORDER BY accessories_planning_list.order_no ASC");
	$rw=0;
	while($coldata=mysqli_fetch_array($sto,MYSQLI_ASSOC)){
			 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$coldata['order_no']."' and style_no='".$coldata['style_no']."'"),MYSQLI_ASSOC);

	$id=$coldata['order_no'];
	
		//if($bal!=0){
			
		$sel_yarns = mysqli_query($zconn,"select * from accessories_planning where 	planning_id='".$coldata['id']."'");
			while($res_yarns = mysqli_fetch_array($sel_yarns,MYSQLI_ASSOC)){
					
	$sel_wgt = mysqli_fetch_array(mysqli_query($zconn,"select * from accessories_po_details where order_no='".$coldata['order_no']."' and 
	styleno='".$coldata['style_no']."' and yarn_name='".$res_yarns['yarn_name']."' "),MYSQLI_ASSOC);
		
		$bal=0;
		$bal = $sel_wgt['balance_qty'];
				
		if($bal!=''){
			$bal = $sel_wgt['balance_qty'];
		} else {
			$bal = $order['cutting_qty']*$res_yarns['pcs_weight'];
		}
				
		
				
	?>
<tr>

											<!-- <tr id="delete_<?php echo $process_id;?>">
												<td><?php echo $sgl;?></td>
												<td><?php echo $process_name;?></td>
												<td><?php echo $sizes;?> </td>
												<td><?php echo $supp_status;?></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td> -->
												<!-- <td><a href='process_group_add.php?colid=<?php echo $process_id; ?>'><i class='fas fa-edit'></i></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href='javascript:;' onclick='DeleteSgId("<?php echo $process_id; ?>");'><i class='fas fa-window-close'></i></a></td> -->
												<td style="padding:0px;"><input type="checkbox" name="" id="chk_<?php echo $id;?>" value="<?php echo $id;?>" onclick="fill_qty('<?php echo $id;?>')"><input type="hidden" name=""></td>
		<td style="padding:0px;"><?php echo $coldata['style_no'];?><input type="hidden" name="style_no[]" id="style_no" value="<?php echo $coldata['style_no'] ?>" class="form-control"></td>
		<td style="padding:0px;"><?php echo $coldata['order_no'];?><input type="hidden" name="order_no[]" id="order_no" value="<?php echo $coldata['order_no'] ?>" class="form-control"></td>
		<td style="padding:0px;"><input type="text" name="acc_name[]" id="acc_name<?php echo $id;?>" class="form-control" value="<?php echo $res_yarns['acc_name'];?>" readonly></td>
		<td style="padding:0px;"><input type="text" name="descr[]" class="form-control" id="descr" value="<?php echo $res_yarns['descr'];?>" readonly></td>
	<td style="padding:0px;"><input type="text" name="uom[]" class="form-control" id="uom" value="<?php echo $res_yarns['uom'];?>" readonly></td>
	<td style="padding:0px;"><input type="text" name="consumption[]" class="form-control" id="consumption" value="<?php echo $res_yarns['consumption'];?>" readonly></td>

		<!-- <td style="padding:0px;"><?php echo $order['cutting_qty'];?><input type="hidden" name="cutting_qty[]" id="cutting_qty" value="<?php echo $order['cutting_qty']; ?>" class="form-control"></td> -->
		<td style="padding:0px;"><?php echo $order['cutting_qty']*$res_yarns['pcs_weight'];?></td>
		<td style="padding:0px;">
		<!-- <input type="hidden" name="balqty" id="balqty<?php echo $rw;?>" 
	value="<?php echo $bal;?>"> -->
		<input type="text" 
		name="acc_loss[]" id="balance<?php echo $rw;?>" 
		class="form-control" value="<?php echo $bal;?>" readonly></td>
		<td style="padding:0px;"> <input type="text" name="now[]" id="now<?php echo $rw;?>" class="form-control now_total" onkeyup="now('<?php echo $rw;?>')" autocomplete="off"></td>
		<td style="padding:0px;"><input type="text" onkeyup="check_rate('<?php echo $rw;?>');" name="rate[]" id="rate<?php echo $rw;?>" class="form-control" autocomplete="off" 
		 value="<?php echo $res_yarns['yarn_rate'];?>"><input type="hidden"  id="rate1<?php echo $rw;?>" class="form-control" autocomplete="off"  value="<?php echo $res_yarns['yarn_rate'];?>"></td>
 	</tr>
	<?php
	$rw++; 
			}
	//		}
	
	?>
	<?php } ?>
		<tr>
			<td>Total</td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
			<td></td>
				<td><input type="text" name="grant_total" id="grant_total" class="form-control"></td>
			<td></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
                        </div>
                    </div>
                </div>
				
				 <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
									<div class="form-group row">
										<label for="scode" class="col-sm-3 text-right control-label col-form-label">Po Number</label>
										<div class="col-sm-6">
							<?php
							$po = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as id from accessories_po_master"));
							$id=$po['id']+1;
							?>
							<input type="text" autocomplete="off" required class="form-control" id="po" name="po" readonly name="costing_date" value="<?php echo $id;?>" >
						</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">To Address</label>
										<div class="col-sm-6">
                                        <!-- <input type="text" class="form-control" id="scode"  name="scode" value="<?php echo $supplier_code;?>"> -->
										<span id="supp_list">
									<select class="select2 form-control custom-select " id="to_address" name="to_address" required>
									<option value="">--Select--</option>
									<?php 
				$tocompe = mysqli_query($zconn,"SELECT * FROM  `suppliers` where status='0'");
					 while($tocompe_res=mysqli_fetch_object($tocompe)){ ?>
						<option value="<?php echo $tocompe_res->supplier_name;?>"><?php echo $tocompe_res->supplier_name;?></option>
					<?php }?>
										 </select>
										
										</span>
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Po Date</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" required id="sname" name="sname" placeholder="Supplier name" value="<?php echo $colData['supplier_name'];?>" autocomplete="off"> -->
							<input type="text" autocomplete="off" required class="form-control" id="po_date" readonly name="po_date" value="<?php echo date('d/m/Y');?>" >

										</div>
									</div>
									


								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Received Date</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" autocomplete="off" id="smobile" value="<?php echo $colData['supplier_mobile'];?>" name="smobile" placeholder="mobile"> -->
											<input type="text" class="form-control" id="receive_date" name="receive_date" autocomplete="off" required>

										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Comments</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" autocomplete="off" id="sphone" value="<?php echo $colData['supplier_phone'];?>" name="sphone" placeholder="Telephone"> -->
											<input type="text" class="form-control" id="comments" name="comments" autocomplete="off" placeholder="Comments" >

										</div>
									</div>
									<div id="div1" style="display: none;">

									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">CGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" id="semail" name="semail" autocomplete="off" value="<?php echo $colData['supplier_email'];?>" placeholder="email"> -->
											<select class="select2 form-control custom-select" id="cgst" name="cgst" >
									<option value="0">--Select--</option>
									<?php 
				$tocompe1 = mysqli_query($zconn,"SELECT * FROM  `gst` where gst_name='cgst'");
					 while($tocompe_res1=mysqli_fetch_object($tocompe1)){ ?>
						<option value="<?php echo $tocompe_res1->gst_value;?>">
						<?php echo $tocompe_res1->gst_value;?></option>
					<?php }?>
										 </select>
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">SGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" required name="txt_add1" id="txt_add1" autocomplete="off" value="<?php echo $colData['supplier_address1'];?>" placeholder="Address"> -->
											<select class="select2 form-control custom-select" id="sgst" name="sgst" >
									<option value="0">--Select--</option>
									<?php 
				$tocompe2 = mysqli_query($zconn,"SELECT * FROM  `gst` where gst_name='sgst'");
					 while($tocompe_res2=mysqli_fetch_object($tocompe2)){ ?>
						<option value="<?php echo $tocompe_res2->gst_value;?>">
						<?php echo $tocompe_res2->gst_value;?></option>
					<?php }?>
										 </select>
										</div>
									</div>
</div>
<div id="div2" style="display: none;">

									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">IGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" autocomplete="off" name="span_card" value="<?php echo $colData['supplier_pancard'];?>" id="span_card" placeholder="Pancard"> -->
											<select class="select2 form-control custom-select" id="igst" name="igst" >
									<option value="0">--Select--</option>
									<?php 
				$tocompe3 = mysqli_query($zconn,"SELECT * FROM  `gst` where gst_name='igst'");
					 while($tocompe_res3=mysqli_fetch_object($tocompe3)){ ?>
						<option value="<?php echo $tocompe_res3->gst_value;?>">
						<?php echo $tocompe_res3->gst_value;?></option>
					<?php }?>
										 </select>
										</div>
									</div>
</div>

								</div>
							</div>
							<div class="border-top">
								<div class="card-body" style="text-align: center;">
									<button type="submit" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="accessories_po.php"><button type="button" class="btn btn-danger">Back</button></a>
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
	<!--datatables JavaScript -->
	<script src="dist/js/bootstrap-datepicker.js"></script>

    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
    <script>
	$(document).ready(function() {
    $('#example').DataTable();
	} );
	function DeleteSgId(ID){
	 var UsrStatus = confirm("Are you sure to delete this details ?");
	  if(UsrStatus){
		$.ajax({
			url : 'ajax/products.php',
			data: {
			   action: 'processgroupdelete',
			   typeid: ID
			},
			success: function( data ) {
				if($.trim(data)=="error"){
					alert("Deleted Failed Kindly. Try again");
				}
				if($.trim(data)=='1'){
					alert("Deleted Successfully");
					document.getElementById("delete_"+ID).style.display = "none";
				}
			},
			error: function (textStatus, errorThrown) {
				//DO NOTHINIG
			}
		});
	  }
	  }
	  $('#receive_date').datepicker({
		format:'dd-mm-yyyy',
		autoclose: true
    })
	</script>	
 <script>
	$(document).ready(function() {
  $('#to_address').on('change', function() {
    var selectedOption = $(this).val();

    // Send AJAX request to PHP script
    $.ajax({
      url: 'gst_show.php',
      type: 'POST',
      data: { option: selectedOption },
      success: function(response) {
		//alert(response)
        // Handle the response from the PHP script
        if (response === 'div1') {
          $('#div1').show();
          $('#div2').hide();
        } else if (response === 'div2') {
          $('#div1').hide();
          $('#div2').show();
        } else {
          $('#div1').hide();
          $('#div2').hide();
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  });
});

 </script>
</body>
</html>