<?php 
include('includes/config.php');
extract($_REQUEST);
if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_REQUEST);
echo "/pre>";*/
if(isset($_REQUEST['save'])){

	

$date2= date('Y-m-d', strtotime($_REQUEST['receive_date']));
$po_sql = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as id from yarns_po_master"));
	$po_no=$po_sql['id']+1;

	$orderNo = $_REQUEST['order_no'];
    $styleNo = $_REQUEST['style_no'];

	$sql1 = mysqli_query($zconn,"INSERT INTO `yarns_po_master` (`po_no`,`style_no`,`order_no`,`buyer`,
	`deliver_to`,`cgst`,`sgst`,`igst`,`grant_total`,`status`,`date`,`kg_bag`,`total_bag`,`comments`,`receive_date`)	
	VALUES('".$po_no."','$styleNo','$orderNo','".$_REQUEST['to_address']."',
	'".$_REQUEST['delivery']."','".$_REQUEST['cgst']."','".$_REQUEST['sgst']."', '".$_REQUEST['igst']."',
	'".$_REQUEST['grant_total']."','SEND','".$_REQUEST['po_date']."','".$_REQUEST['bag']."',
	'".$_REQUEST['total_bag']."','".$_REQUEST['comments']."','".$_REQUEST['receive_date']."')")or die(mysqli_error());
				$last_id = mysqli_insert_id($zconn);
				for($i=0;$i<count($_REQUEST['now']);$i++){
					if ($_REQUEST['now'][$i] >0 ) {
						$now_qty=$_REQUEST['now'][$i];
					 	$id=$_REQUEST['po'];
						$pcs_rate=$_REQUEST['rate'][$i];
						$style_no=$_REQUEST['style_no'][$i];
						$order_no=$_REQUEST['order_no'][$i];

						$sql = mysqli_query($zconn,"INSERT INTO `yarns_po_details` (`po_id`,`styleno`,
						 `order_no`, `weight`, `rate`,`grant_total`,`date`,`cutting_qty`,`balance_qty`,`counts`,
						 `yarn_name`,`yarn_colour`,`yarn_content`,`yarn_type`,`pcs_weight`,`consumption`)VALUES('$last_id', '$style_no', '$order_no',
						  '$now_qty','$pcs_rate','".$_REQUEST['grant_total']."',Now(),'".$_REQUEST['cutting_qty'][$i]."',
						  '".$_REQUEST['balance'][$i]."','".addslashes($_REQUEST['yarn_count'][$i])."',
						  '".$_REQUEST['yarn_name'][$i]."','".$_REQUEST['yarn_colour'][$i]."','".$_REQUEST['yarn_content'][$i]."','".$_REQUEST['yarn_type'][$i]."','".$_REQUEST['yarn_pcs_weight'][$i]."',
						  '".$_REQUEST['consumption'][$i]."')")or die(mysqli_error());
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
    <title><?php echo SITE_TITLE;?> - YARN PO</title>
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
	<style>
		th{font-size:12px; font-weight:bold; background-color:#626F80; text-align:center;}
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
                        <h4 class="page-title">YARN PO</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
            <form name="costing_list" id="costing_list" method="post">
<!--==============================================================-->
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
			<?php $sel_buyer = mysqli_query($zconn,"select * from yarn_entry_master where 1 group by order_no");
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
										<!-- <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Style No</label>
										<div class="col-sm-3">
												<?php $select=mysqli_query($zconn,"select * from yarn_entry_master group by order_no");
													while($data=mysqli_fetch_object($select)){
	$style_no1[]=$data->style_no;
} 
												?>
	<select data-placeholder="Begin typing a name to filter..." multiple class="chosen-select" class="select2 form-control custom-select" name="Style[]" id="Style" onchange="this.form.submit()">
	<option value="">Select</option>
	<?php  foreach($style_no1 as $style_no){ ?>
		<option value="<?php echo $style_no?>"<?php if(in_array($style_no,$_REQUEST['Style'],true)){?> selected="selected"<?php }?>><?php echo $style_no;?></option>
	<?php }  ?>
	</select> -->
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
		<!--<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Yarn Name</label>
		<div class="col-sm-3">
			<select class="select2 form-control custom-select" name="yarn" id="yarn" onchange="this.form.submit()">
			<option value="">Select</option>
			<?php $sel_buyer = mysqli_query($zconn,"select * from costing_entry_master where 1 group by costing_no");
			while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
			<option value="<?php echo $res_buyer['id'];?>" <?php if ($res_buyer['id'] == $_REQUEST['yarn']) echo ' selected="selected"'; ?>><?php echo $res_buyer['costing_no'];?></option>
			<?php } ?>
			</select>
		</div>
		<label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Counts</label>
		<div class="col-sm-3">
			<select class="select2 form-control custom-select" name="count" id="count" onchange="this.form.submit()">
			<option value="">Select</option>
			<?php $sel_buyer = mysqli_query($zconn,"select * from counts_master where status='0'");
			while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
			<option value="<?php echo $res_buyer['counts_name'];?>" <?php if ($res_buyer['counts_name'] == $_REQUEST['count']) echo ' selected="selected"'; ?>><?php echo $res_buyer['counts_name'];?></option>
			<?php } ?>
			</select>
		</div>-->
		</div>
	</div>
	</div>
	</div>
<div class="table-responsive">
<div class="scroll-container">
<table id="example" class="table table-striped table-bordered text center" style="width:150%">
    <thead style="background-color: #626F80; color: #fff; font-size: 16px;">
        <tr>
            <th style="width:2%"></th>
            <th style="width:10%">STYLE NO</th>
            <th style="width:10%">ORDER NO</th>
            <th style="width:10%">YARN NAME</th>
            <th style="width:10%">CONTENT</th>
            <th style="width:10%">COUNT</th>
            <th style="width:10%">YARN TYPE</th>
            <th style="width:10%">COLOR</th>
            <th style="width:5%">Pcs.Weight</th>
            <th style="width:5%">ORDER QTY(Pcs)</th>
            <th style="width:5%">TOTAL YARN QTY(Kgs)</th>
            <th style="width:5%">BALANCE QTY(Kgs)</th>
            <th style="width:5%">KGS PER BAG</th>
            <th style="width:5%">TOTAL BAG</th>
            <th style="width:5%">NOW WANTED (Weight)</th>
            <th style="width:5%">RATE</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $result = "SELECT * FROM yarn_entry_master where 1 ";
        if (isset($_REQUEST['Style']) && $_REQUEST['Style'] != '') {
            $result .= "AND `style_no` in (";
            foreach ($_REQUEST['Style'] as $syr) {
                $syr1 .= "'" . $syr . "',";
            }
            $syr = substr($syr1, 0, -1);
            $result .= $syr . ")";
        }
        if (isset($_REQUEST['order']) && $_REQUEST['order'] != '') {
            $result .= "and order_no in ('";
            foreach ($_REQUEST['order'] as $odr) {
                $result .= $odr;
                if (end($_REQUEST['order']) != $odr) {
                    $result .= "','";
                }
            }
            $result .= "')";
        }

        $sto = mysqli_query($zconn, $result . "ORDER BY yarn_entry_master.order_no ASC");
        $rw = 1;
        while ($coldata = mysqli_fetch_array($sto, MYSQLI_ASSOC)) {
            $order = mysqli_fetch_array(mysqli_query($zconn, "SELECT * FROM `order_entry_master` where order_no='" . $coldata['order_no'] . "' and style_no='" . $coldata['style_no'] . "'"), MYSQLI_ASSOC);
            $sel_yarns = mysqli_query($zconn, "select * from yarn_entry_details where yarn_id='" . $coldata['id'] . "'");
            while ($res_yarns = mysqli_fetch_array($sel_yarns, MYSQLI_ASSOC)) {
                $sel_wgt = mysqli_fetch_array(mysqli_query($zconn, "select * from yarns_po_details
				 where order_no='" . $coldata['order_no'] . "' and styleno='" . $coldata['style_no'] . "'
				  and yarn_name='" . $res_yarns['yarn_name'] . "' ORDER BY id DESC LIMIT 1 "), MYSQLI_ASSOC);
				if ($sel_wgt) {
					$bal = $sel_wgt['balance_qty'];
				} else {
					$bal = ''; // If no "PO" balance quantity, set it to an empty string
				}
					
        ?>
        <tr>
            <td style="padding:0px;"><input type="checkbox" name="" id="chk_<?php echo $rw; ?>"
                    value="<?php echo $rw; ?>" onclick="fill_qty('<?php echo $rw; ?>')"><input type="hidden"
                    name=""></td>
            <td style="padding:0px;"><input type="text" name="style_no[]" id="style_no<?php echo $rw; ?>"
                    value="<?php echo $coldata['style_no'] ?>" class="form-control"></td>
            <td style="padding:0px;"><input type="text" name="order_no[]" id="order_no<?php echo $rw; ?>"
                    value="<?php echo $coldata['order_no'] ?>" class="form-control"></td>
            <td style="padding:0px;"><input type="text" name="yarn_name[]" id="yarn_name<?php echo $rw; ?>"
                    class="form-control" value="<?php echo $res_yarns['yarn_name']; ?>" readonly></td>
            <td style="padding:0px;"><input type="text" name="yarn_content[]"
                    class="form-control" id="yarn_content" value="<?php echo $res_yarns['yarn_content']; ?>"
                    readonly></td>
            <td style="padding:0px;"><input type="text" name="yarn_count[]" class="form-control"
                    id="yarn_count" value="<?php echo $res_yarns['yarn_count']; ?>" readonly></td>
            <td style="padding:0px;"><input type="text" name="yarn_type[]" class="form-control" id="yarn_type"
                    value="<?php echo $res_yarns['yarn_type']; ?>" readonly></td>
            <td style="padding:0px;"><input type="text" name="yarn_colour[]" class="form-control"
                    id="yarn_colour" value="<?php echo $res_yarns['yarn_colour']; ?>" readonly></td>
            <td style="padding:0px;"><input type="text" name="yarn_pcs_weight[]" class="form-control"
                    id="yarn_count" value="<?php echo $res_yarns['pcs_weight']; ?>" readonly></td>
            <td style="padding:0px;"><?php echo $order['cutting_qty']; ?><input type="hidden"
                    name="cutting_qty[]" id="cutting_qty<?php echo $rw; ?>"
                    value="<?php echo $order['cutting_qty']; ?>" class="form-control"></td>
            <td style="padding:0px;"><?php echo $order['cutting_qty'] * $res_yarns['pcs_weight']; ?><input
                    type="hidden" name="total_qty[]" id="total_qty<?php echo $rw; ?>" class="form-control"></td>
            <td style="padding:0px;">
                <input type="text" name="balqty" id="balqty<?php echo $rw; ?>" value="<?php echo $bal; ?>">
                <input type="text" name="balance[]" id="balance<?php echo $rw; ?>" class="form-control"
                    value="<?php echo $bal; ?>" readonly>
            </td>
            <td style="padding:0px;">
                <input type="text" class="form-control" id="bag<?php echo $rw; ?>" name="bag" value=""
                     autocomplete="off" onkeyup="calculateWeight(<?php echo $rw; ?>)">
            </td>
            <td style="padding:0px;">
                <input type="text" class="form-control" id="total_bag<?php echo $rw; ?>" name="total_bag"
                 autocomplete="off" value="" onkeyup="calculateWeight(<?php echo $rw; ?>)">
            </td>
            <td style="padding:0px;">
                <input type="text" name="now[]" id="now<?php echo $rw; ?>" class="form-control now_total"
                    onchange="now('<?php echo $rw; ?>'); calculateWeight(<?php echo $rw; ?>)" autocomplete="off">
            </td>
            <td style="padding:0px;">
                <input type="text" onkeyup="check_rate('<?php echo $rw; ?>');" name="rate[]" id="rate<?php echo $rw; ?>"
                    class="form-control" autocomplete="off" value="<?php echo $res_yarns['yarn_rate']; ?>">
                <input type="hidden" id="rate1<?php echo $rw; ?>" class="form-control" autocomplete="off"
                    value="<?php echo $res_yarns['yarn_rate']; ?>">
            </td>
        </tr>
        <?php
            $rw++;
        }
        }
        ?>
        <tfoot>
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
				<td><?php
$grant_total = 0; // Initialize the grant_total variable

// Loop through your rows to calculate the total
for ($i = 0; $i < count($_POST['now']); $i++) {
    $nowValue = (float)$_POST['now'][$i]; // Assuming "now" inputs have names like "now[]"
    $grant_total += $nowValue; // Sum up the values
}
?>

<input type="text" name="grant_total" id="grant_total" value="<?php echo $grant_total; ?>" class="form-control"></td>
                <td></td>
            </tr>
        </tfoot>
    </tbody>
</table>
		</div>
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
							$po = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as id from yarns_po_master"));
							$id=$po['id']+1;
							?>
							<input type="text" autocomplete="off" required class="form-control" id="po" name="po" readonly name="costing_date" value="<?php echo $id;?>" >
						</div>
						</div>
					<div class="form-group row">
						<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Yarn PO Date</label>
						<div class="col-sm-6">
							<input type="text" autocomplete="off" required class="form-control" id="po_date" readonly name="po_date" value="<?php echo date('d/m/Y');?>" >
						</div>
					</div>
					<div class="form-group row">
					<div id="supp_msg" class="col-sm-6 text-right" style="color:red; font-size:12px;"></div></div>
						<div class="form-group row">
								<label for="lname" class="col-sm-3 text-right control-label col-form-label">To Address</label>
								<div class="col-sm-6" >
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
										
									</div>
									<div class="form-group row">
										
									</div>
						</div>
						<div class="card" style="width:50%; float:left; right: 50px;">
							<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Received Date</label>
										<div class="col-sm-6">
											<input type="date" class="form-control" id="receive_date" name="receive_date" autocomplete="off" required>
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Comments</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="comments" name="comments" autocomplete="off" placeholder="Comments" >
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Deleivery To</label>
										<!-- <div class="col-sm-6">
											<select class="select2 form-control custom-select" name="delivery" id="delivery">
											<option value="">selection</option>
											<?php 
												$knit_sql = mysqli_fetch_array(mysqli_query($zconn,
												"SELECT * FROM `supplier_types` where supplier_type='Knitting'"),MYSQLI_ASSOC);
											$knitters_id = $knit_sql['supplier_type_id'];	
												
										      $tocompe = mysqli_query($zconn,"SELECT * FROM  `suppliers` where status='0' and supplier_type_id='".$knitters_id."'");
											 while($tocompe_res = mysqli_fetch_object($tocompe)){
											 	?>
										     <option value="<?php echo $tocompe_res->supplier_name;?>"><?php echo $tocompe_res->supplier_name;?></option>
										     <?php }?>
										 </select>
										</div> -->
										<div class="col-sm-6" >
									<span id="supp_list">
									<select class="select2 form-control custom-select chosen-select" id="delivery" name="delivery" required>
									<option value="">--Select--</option>
									<?php 
				$tocompe = mysqli_query($zconn,"SELECT * FROM  `process_customer` where status='0'");
					 while($tocompe_res=mysqli_fetch_object($tocompe)){ ?>
						<option value="<?php echo $tocompe_res->party_name;?>">
						<?php echo $tocompe_res->party_name;?></option>
					<?php }?>
										 </select>
										 <script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
										</span>

										</div>
										
									</div>
									<div id="div1" style="display: none;">
									<?php 
									$state = mysqli_query($zconn,"SELECT * FROM  `suppliers` where state_id='21'");
									?>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">CGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" id="cgst" name="cgst" autocomplete="off" required placeholder="style no" value="0"> -->
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
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">SGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" id="sgst" name="sgst" autocomplete="off" required placeholder="style no" value="0"> -->
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
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">IGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" id="igst" name="igst" autocomplete="off" required placeholder="style no" value="0"> -->
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
					<?php

	
		//if($bal!=0){

				
	?>
					<div class="border-top">
						<div class="card-body" style="margin-left: 500px;">
							<!-- <button type="submit" name="save" class="btn btn-success">Save</button> -->
							<button type="submit" name="save" class="btn btn-success">Save
								<!-- <a href="javascript:;" onclick="costing_sheet(<?php echo $coldata['id']; ?>);">Print</a> -->
							</button>
							<button type="reset" class="btn btn-primary">Reset</button>
							<a href="yarn_po_list.php"><button type="button" class="btn btn-danger">Back</button></a>
						</div>
						
					</div>

					<?php
			//}
				//} ?>
				</div>
                <!-- Sales chart -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
</form>
<br>
<br>
<br>
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
	<script src="dist/js/bootstrap-datepicker.js"></script>
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>

	
		<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});

	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
	  $('#delete_'+ID).hide();
	  }
	}

	function fill_qty(rw){
		if($('#chk_'+rw).is(":checked")){
			$('#counts'+rw).attr("required", "required");
			$('#now'+rw).attr("required", "required");
			$('#rate'+rw).attr("required", "required");
		} else {
			$('#counts'+rw).removeAttr("required");
			$('#now'+rw).removeAttr("required");
			$('#rate'+rw).removeAttr("required");
		}
		var tq = document.getElementById('counts'+rw).value;
		var bal = document.getElementById('consumption'+rw).value;
	}

	
// 	function calculateWeight(rowId) {
//     var bagValue = parseFloat(document.getElementById("bag"+ rowId).value) || 0;
//     var totalBagValue = parseFloat(document.getElementById("total_bag"+ rowId).value) || 0;
// 	var totalQuantity = bagValue * totalBagValue;

// // Update the "now" input fields with the calculated total quantity
// $('.now_total'+ rowId).each(function(index, element) {
// 	element.value = totalQuantity;
// });

//     var grandTotal = 0;
//     var allValid = true;

//     $('.now_total'+ rowId).each(function(index, element) {
//         var nowValue = parseFloat(element.value);
//         var balQty = parseFloat(document.getElementById('balqty' + rowId).value);
		


// 		if (!isNaN(nowValue)) {
//   if ((nowValue) <= (balQty)) {
//     var remainingBalance = balQty - nowValue;
//     $('#balance' + rowId).val(remainingBalance);
//     grandTotal += nowValue;
//   } else {
//     // Set the balance to 0 if nowValue is greater than balQty
//     {$('#balance' + rowId).val(0);
// 	grandTotal += nowValue;}
// 	{alert("Enter po qty excess than planning qty " + rowId);
//   element.value = grandTotal.toFixed(2); }
//   }

//         } 
//     });

//     if (allValid) {
//         document.getElementById("grant_total").value = grandTotal;
//     } else {
//         document.getElementById("grant_total").value = "";
//         // Handle the case where input is invalid (e.g., now value exceeds balance)
//     }
// }

function calculateWeight(rowId) {
    var bagValue = parseFloat(document.getElementById("bag" + rowId).value) || 0;
    var totalBagValue = parseFloat(document.getElementById("total_bag" + rowId).value) || 0;
    var totalQuantity = bagValue * totalBagValue;

    // Update the "now" input field for the current row with the calculated total quantity
    var nowTotalInput = document.getElementById('now' + rowId);
    nowTotalInput.value = totalQuantity;

    // Initialize variables for the row's total and the grand total
    var rowTotal = 0;
    var grandTotal = 0;

    var nowValue = parseFloat(nowTotalInput.value);
    var balQty = parseFloat(document.getElementById('balqty' + rowId).value);

    if (!isNaN(nowValue)) {
        if (nowValue <= balQty) {
            var remainingBalance = balQty - nowValue;
            $('#balance' + rowId).val(remainingBalance);
            rowTotal += nowValue; // Calculate the row's total
        } else {
            // Set the balance to 0 if nowValue is greater than balQty
            $('#balance' + rowId).val(0);
            alert("Warning , Enter po qty excess than planning qty for row " + rowId);
            nowTotalInput.value = nowValue.toFixed(2); // Set the "now" input to the current row's value
        }
    }

    // Loop through all rows to calculate the grand total
    $('input[name^="now"]').each(function(index, element) {
        var inputValue = parseFloat(element.value) || 0;
        grandTotal += inputValue;
    });

    // Update the "grant_total" input field for the grand total
    document.getElementById("grant_total").value = grandTotal;

    // Here, you can return the row's total if needed.
    return rowTotal;
}



	
		function check_rate(id){
			var or_price = $('#rate1'+id).val();
			var nw_price = $('#rate'+id).val();
			if(parseFloat(nw_price)>parseFloat(or_price)){
				alert("Rate less then or equal to "+or_price);
				$('#rate'+id).val(or_price);
				return false;
			}
		}

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

// function updateBalanceQty(rowId) {
//     $.ajax({
//         url: 'update_balance_qty.php',
//         type: 'POST',
//         data: { rowId: rowId },
//         success: function(data) {
//             // Update the balance quantity in the frontend
//             var updatedBalanceQty = parseFloat(data.balance_qty);
//             var balanceInput = document.getElementById('balance' + rowId);
//             balanceInput.value = updatedBalanceQty;
//         },
//         error: function(error) {
//             console.error('Failed to update balance_qty:', error);
//         }
//     });
// }

 </script>
</body>
</html>