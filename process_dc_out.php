<?php
include('includes/config.php');
if($_SESSION['userid']==''){
    echo "<script>window.location.href='login.php';</script>";
}
/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/
if(isset($_REQUEST['save'])) {
    $select = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as id from process_dcout_master"));
    $id = $select['id']+1;

    $count = count($_REQUEST['delivery_wgt']);
    $sql = mysqli_query($zconn,"INSERT INTO process_dcout_master(order_no,style_no,to_process,to_company,dc_no,date,total,from_addr)values('".$_REQUEST['order']."','".$_REQUEST['style']."','".$_REQUEST['to_process']."','".$_REQUEST['to_company']."','".$id."','".$_REQUEST['dc_date']."','".$_REQUEST['total']."','".$_REQUEST['from']."')");
	

    $chk_flow1 = mysqli_fetch_array(mysqli_query($zconn,"select max(process_no) as MAX_PROCESS from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);
    $mx_pr_no = $chk_flow1['MAX_PROCESS']+1;
    $sel_dc = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as DCNO from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."' and from_addr='".$_REQUEST['from']."' and to_process='".$_REQUEST['to_process']."' "),MYSQLI_ASSOC);


for($i=0; $i<$count; $i++) {
//	if ($_REQUEST['delivery_wgt'][$i]>0) {
    $delivery=$_REQUEST['delivery_wgt'][$i];
    $balance_wgt = $_REQUEST['wgt'][$i]-$_REQUEST['delivery_wgt'][$i];
    $dweigt =0;
    $chk_wgts = mysqli_fetch_array(mysqli_query($zconn,"select * from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$_REQUEST['fabric_name'][$i]."' and dc_no='".$sel_dc['DCNO']."' "),MYSQLI_ASSOC);
    $dweigt = $chk_wgts['delivered_wgt']+$_REQUEST['delivery_wgt'][$i];

    $sql = mysqli_query($zconn,"INSERT INTO process_dc_out (order_no,style_no,to_process,to_company,dc_no,dc_date,
    fabric_name,content,color,dia,fdia,gsm,fgsm,gauge,loop_length,lab_no,planning_wgt,inward_wgt,delivered_wgt,
    balance_wgt,wgt,process_no,from_addr,inward_id,rolls,total_weight) 
    values('".$_REQUEST['order']."','".$_REQUEST['style']."','".$_REQUEST['to_process']."','".$_REQUEST['to_company']."','".$id."',
    '".$_REQUEST['dc_date']."','".$_REQUEST['fabric_name'][$i]."','".$_REQUEST['content'][$i]."','".$_REQUEST['color'][$i]."',
    '".$_REQUEST['dia'][$i]."','".$_REQUEST['fdia'][$i]."','".$_REQUEST['gsm'][$i]."','".$_REQUEST['fgsm'][$i]."',
    '".$_REQUEST['gauge'][$i]."','".$_REQUEST['loop_length'][$i]."','".$_REQUEST['lab_no'][$i]."','".$_REQUEST['planning_wgt'][$i]."',
    '".$_REQUEST['inward_wgt'][$i]."','".$dweigt."','".$_REQUEST['balance_wgt'][$i]."',
    '".$_REQUEST['wgt'][$i]."','".$mx_pr_no."','".$_REQUEST['from']."','".$_REQUEST['id'][$i]."',
	'".$_REQUEST['rolls'][$i]."','".$_REQUEST['total_weight'][$i]."')");
//	}
	
	    $new_inward_wgt = $_REQUEST['inward_wgt'][$i] - $_REQUEST['delivery_wgt'][$i];
	
      //if ($new_inward_wgt != 0) {
        // Update the yarn_inward table
        $update_sql = "UPDATE yarn_inward SET inward_wgt = $new_inward_wgt WHERE style_no = '".$_REQUEST['style']."'";
	
	
      $update_result = mysqli_query($zconn, $update_sql);

if (!$update_result) {
    $error_message = mysqli_error($zconn);
    echo "Error updating inward_wgt in yarn_inward table: " . $error_message;
}
    //}
//}
}
if($sql) {
    echo '<script>alert("The Record has been Successfully Added...")</script>';
} else {
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
<link href="assets/images/favicon.png" rel="icon" type="image/png" sizes="16x16" >
<title><?php echo SITE_TITLE;?> - YARN - PROCESS DC OUT</title>
<!-- Custom CSS -->
<!-- datatables CSS -->
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
                    <h4 class="page-title">YARN - PROCESS DC OUT</h4>
                </div>
            </div>
        </div>
        <!-- End Bread crumb and right sidebar toggle -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Container fluid  -->
        <div class="container-fluid">  
            <form name="process_dc_out" method="post" >
            <!-- ============================================================== -->
            <!-- Sales chart -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="width:100%">
                            <div class="card" style="width:50%; float:left; left: 50px; ">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Order No</label>
        <div class="col-sm-6">
            <select class="select2 form-control custom-select" name="order" id="order" onchange="this.form.submit();">
                <option>Select</option>
                <?php $sel_buyer = mysqli_query($zconn,"select distinct order_no from yarn_inward where 1 group by id");
                while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
                    $order[]=$res_buyer['order_no'];
                    $chk_process = mysqli_query($zconn,"select * from process_dc_out where order_no='".$res_buyer['order_no']."' and style_no='".$res_buyer['style_no']."'");
                 ?>
                <option value="<?php echo $res_buyer['order_no'];?>" <?php if ( $res_buyer['order_no']==$_REQUEST['order']){?> selected="selected" <?php } ?>
                ><?php echo $res_buyer['order_no'];?></option>
                <?php } ?>
            </select>
            </div>
        </div>

    <div class="form-group row">
        <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Style No</label>
            <div class="col-sm-6">
                <select class="select2 form-control custom-select" name="style" id="style" onchange="this.form.submit();">
                <option>Select</option>
                <?php $sel_buyer = mysqli_query($zconn,"select * from yarn_inward where order_no='".$_REQUEST['order']."'");
                while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ $fabrc=$res_buyer['style_no']; ?>
                    <option value="<?php echo $res_buyer['style_no'];?>" <?php if ($res_buyer['style_no']==$_REQUEST['style']) {?> selected="selected" <?php } ?> ><?php echo $res_buyer['style_no'];?></option>
                <?php } ?>
                </select>
            </div>
    </div>
<div class="form-group row">
    <label for="from" class="col-sm-3 text-right control-label col-form-label">&nbsp;From Process</label>
    <div class="col-sm-6">
        <select class="select2 form-control custom-select" name="from" id="from" onchange="this.form.submit();">
        <option value="0">Select</option>
<?php 

    $chk_flow = mysqli_fetch_array(mysqli_query($zconn,"select max(process_no) as MAX_PROCESS from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"));
    //$count_flow = mysqli_num_rows($chk_flow);
    if($chk_flow['MAX_PROCESS']>0 || $chk_flow['MAX_PROCESS']!=NULL){
        $from_flow=$chk_flow['MAX_PROCESS']+1;
        $to_flow=$chk_flow['MAX_PROCESS']+2;
    } else {
        $from_flow=0;
        $to_flow=1;
    }

    $sel_pro_flow = mysqli_fetch_array(mysqli_query($zconn,"select * from process_planning_flow where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);

    $flow_id = $sel_pro_flow['process_flow'];
    $sel_flow = mysqli_query($zconn,"SELECT * FROM `process_groups` where process_name='".$flow_id."'");
    $res_flow = mysqli_fetch_array($sel_flow,MYSQLI_ASSOC);
    $process_flows = explode(",",$res_flow['process_flow']);
    //print_r($process_flows);
    $pcount = count($process_flows);
    for($pr=0;$pr<$pcount;$pr++){
        if($process_flows[$pr]==$_REQUEST['from']){
    //if($from_flow==$pr){
        ?>
        <option value="<?php echo $process_flows[$pr];?>" selected><?php echo $process_flows[$pr];?></option>
        <?php }  else { ?>
            <option><?php echo $process_flows[$pr];?></option>
        <?php } } ?>

                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card" style="width:50%; float:left; right: 50px;">
                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;Dc No</label>
                                    <div class="col-sm-6">
                                        <?php $select = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as id from process_dcout_master")); 

                                        $id=$select['id']+1;?>
                                        <input type="text" name="dc_no" class="form-control" value="<?php echo $id;?>">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="cono1" class="col-sm-3 text-right control-label col-form-label">DC Out Date</label>
                                    <div class="col-sm-6">
                                        <input type="date" class="form-control" id="dc_date" name="dc_date"  autocomplete="off" required>
                                    </div>
                                </div>
								
								<script>
    // Get the current date in YYYY-MM-DD format
    var currentDate = new Date().toISOString().slice(0, 10);

    // Set the input field's value to the current date
    document.getElementById('dc_date').value = currentDate;
</script>

                                <div class="form-group row">
                                    <label for="fname" class="col-sm-3 text-right control-label col-form-label">&nbsp;To Process</label>
                                    <div class="col-sm-6">
                                        <select class="select2 form-control custom-select" name="to_process" id="to_process" onchange="this.form.submit();">
                                        <option value="0">Select</option>
                                            <?php 
                                        $sel_pro_flow = mysqli_fetch_array(mysqli_query($zconn,"select * from process_planning_flow where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);

                                        $flow_id = $sel_pro_flow['process_flow'];
                                        $sel_flow = mysqli_query($zconn,"SELECT * FROM `process_groups` where process_name='".$flow_id."'");
                                        $res_flow = mysqli_fetch_array($sel_flow,MYSQLI_ASSOC);
                                            $process_flows = explode(",",$res_flow['process_flow']);
                                            //print_r($process_flows);
                                            $pcount = count($process_flows);
                                            for($pr=0;$pr<$pcount;$pr++){
                                                if($process_flows[$pr]==$_REQUEST['to_process']){
                                                //if($to_flow==$pr){
                                                //	$_REQUEST['to_process'] = $process_flows[$pr]; 
                                        ?>
                                                <option selected value="<?php echo $process_flows[$pr];?>"><?php echo $process_flows[$pr];?></option>
                                                <?php } else { ?>
                                                <option><?php echo $process_flows[$pr];?></option>
                                                <?php } ?>

                                            <?php } ?>
                                        </select>
            </div>
        </div>
        <div class="form-group row">
            <label for="cono1" class="col-sm-3 text-right control-label col-form-label">To Company</label>
            <div class="col-sm-6">
                <select name="to_company" id="to_company" class="form-control">
                    <option>--Select--</option>
                    <?php 
                    $sel_comp = mysqli_query($zconn,"select * from process_customer"); 
                    while($res_comp = mysqli_fetch_array($sel_comp)){  ?>
                        <option value="<?php echo $res_comp['party_name'];?>"><?php echo $res_comp['party_name'];?></option>
                    <?php } ?>
                </select>
            </div>
        </div>
    </div>
						<style>
    /* CSS for the container */
    .table-container {
        width: 100%; /* Set the width as needed */
        overflow-x: auto; /* Enable horizontal scrolling */
        white-space: nowrap; /* Prevent text wrapping */
    }
</style>

							<div class="table-container">
<?php 
if ($_REQUEST['to_process']!='' && $_REQUEST['to_process']!='0'){
        if ($_REQUEST['to_process']=='knitting'){?>
        <div class="table-responsive">
            <div class="col-12 d-flex no-block align-items-center">
                <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['to_process']); ?>&nbsp;PLANNING PROGRAM</h5>
            </div>
            <table id="example" class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width:10%">FABRIC NAME</th>
                        <th style="width:10%">CONTENT</th>
                        <th style="width:5%">COLOUR</th>
                        <th style="width:5%">DIA</th>
                        <th style="width:5%" data-toggle="tooltip" title="Fabric Dia">FDIA</th>
                        <th style="width:5%">F GSM</th>
                        <th style="width:5%">GUAGE</th>
                        <th style="width:5%" data-toggle="tooltip" title="Weight">LOOP LENGTH</th>
                        <th style="width:5%" data-toggle="tooltip" title="PLANNING Weight">PLANNING WGT</th>
                        <th style="width:5%" data-toggle="tooltip" title="PLANNING Weight">INWARD WGT</th>
                        <th style="width:5%" data-toggle="tooltip" title="PLANNING Weight">DELIVERY WGT</th>
                        <th style="width:5%" data-toggle="tooltip" title="PLANNING Weight">BALANCE WGT</th>
                        <th style="width:10%">ENTER.WGT</th>
                    </tr>
                </thead>
                <tbody>
                <?php $sel_buyer = mysqli_query($zconn,"select * from yarn_inward where  order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'");
                while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ 
                $fabric_name=$res_buyer['fabric_name']; 

                $sectBrnQry = "SELECT * FROM knitting_planning where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='$fabric_name'";
                $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                while($coldate = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){

                if($_REQUEST['from']=='yarn Inward') {
                    $tbl='yarn_inward';
                    $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='$fabric_name'"));
                    $in=$inward['wgt'];
                    $out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and fabric_name='$fabric_name' and from_addr='".$_REQUEST['from']."'"));
                    $out=$out['wgt'];
                    $wgt=$in-$out;
                } else {
                    $tbl='process_dc_out';
                    $inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_in where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='".$_REQUEST['from']."' and fabric_name='$fabric_name'"));
                    $in=$inward['wgt'];

                    $out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='".$_REQUEST['from']."' and fabric_name='$fabric_name'"));
                    $out=$out['wgt'];

                    $wgt=$in-$out;
                }

                    ?>
                    <tr>
                        <td style="width:10%"><?php echo $coldate['id'];?><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"><input type="hidden" name="fabric_name[]" value="<?php echo $coldate['fabric_name'];?>"></td>
                        <td style="width:10%"><?php echo $coldate['content'];?><input type="hidden" name="content[]" value="<?php echo $coldate['content'];?>"></td>
                        <td style="width:11%"><?php echo $coldate['color'];?><input type="hidden" name="color[]" value="<?php echo $coldate['color'];?>"></td>
                        <td style="width:5%"><?php echo $coldate['dia'];?><input type="hidden" name="dia[]" value="<?php echo $coldate['dia'];?>"></td>
                        <td style="width:4%"><?php echo $coldate['f_dia'];?><input type="hidden" name="fdia[]" value="<?php echo $coldate['f_dia'];?>"></td>
                        <td style="width:4%"><?php echo $coldate['f_gsm'];?><input type="hidden" name="gsm[]" value="<?php echo $coldate['f_gsm'];?>"></td>
                        <td style="width:8%"><?php echo $coldate['Gauge'];?><input type="hidden" name="gauge[]" value="<?php echo $coldate['Gauge'];?>"></td>
                        <td style="width:4%"><?php echo $coldate['Loop_Length'];?><input type="hidden" name="loop_length[]" value="<?php echo $coldate['Loop_Length'];?>"></td>
                        <td style="width:8%"><?php echo $coldate['wgt'];?><input type="hidden" name="wgt[]" value="<?php echo $coldate['wgt'];?>"></td>
                        <td style="width:8%"><?php echo $in;?></td>
                        <td style="width:8%"><?php echo $out;?></td>
                        <td style="width:8%"><?php echo $wgt;?></td>
                        <td style="width:10%"><input type="number" max="<?php echo $wgt;?>" min='0' class="form-control delivery_wgt" id="delivery_wgt" name="delivery_wgt[]"></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                    <tr>
                        <td colspan="12"><strong>TOTAL WEIGHT</strong></td>
                        <td>
                            <input type="text" name="total" id="total" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
								</div>
								<br>
			<br>

            <div class="card" style="width:100%">
                <div class="border-top">
                    <div class="card-body" style="margin-left: 400px;">
                        <button type="submit" name="save" class="btn btn-success" >Save</button>
                        <button type="reset" class="btn btn-primary">Reset</button>
                    </div>
                </div>
            </div>
        </div>
        <?php }
else if($_REQUEST['to_process']=='DYEING' || $_REQUEST['to_process']=='DYEING'){?>
        <div class="table-responsive">
            <div class="col-12 d-flex no-block align-items-center">
                <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['to_process']); ?>&nbsp;++++++PROGRAM</h5>
            </div>
            <table id="example" class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width:15%" data-toggle="tooltip" title="Fabric NAME">FABRIC NAME</th>
                        <th style="width:15%" data-toggle="tooltip" title="Fabric COLOR">COLOR</th>
                        <th style="width:5%">DIA</th>
                        <th style="width:12%">GSM</th>
                        <th style="width:12%" data-toggle="tooltip" title="PLANNING Weight">PLANNING WGT</th>
                        <th style="width: 5%" data-toggle="tooltip" title="INWARD Weight">STOCK</th>
                        <th style="width:12%" data-toggle="tooltip" title="DELIVERY Weight">DELIVERY WGT</th>
                        <th style="width:12%" data-toggle="tooltip" title="BALANCE Weight">BALANCE WGT</th>
                        <th style="width:15%">ENTER.WGT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                 /*	$sel_buyer = mysqli_query($zconn,"select * from yarn_inward where  order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'");
					while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ */

                    $sectBrnQry = "SELECT * FROM dyeing_planning where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
                    $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                    $frst_rw=1;
                    while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
    $order_details = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);

                      $plan_wgt_det = ($order_details['cutting_qty']*$order_details['excess_percent'])/100;
                      $pan_wgt1 = $order_details['cutting_qty']+$plan_wgt_det;
                      $plan_wgt = $coldata['wgt'];

                      $sel_dc = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as DCNO from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."' and from_addr='".$_REQUEST['from']."' and to_process='".$_REQUEST['to_process']."' "),MYSQLI_ASSOC);

                      $sel_pro = mysqli_fetch_array(mysqli_query($zconn,"select * from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."' and from_addr='".$_REQUEST['from']."' and to_process='".$_REQUEST['to_process']."' and dc_no='".$sel_dc['DCNO']."' "),MYSQLI_ASSOC);
							$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_in where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and from_addr='".$_REQUEST['from']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];

                       /*if($_REQUEST['from']=='yarn Inward') {
								$tbl='yarn_inward';
								$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];
								$out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'and from_addr='".$_REQUEST['from']."'"));
								$out=$out['wgt'];
								$wgt=$in-$out;
							} else {
								$tbl='process_dc_in';
								$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and from_addr='".$_REQUEST['from']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];
								$out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='".$_REQUEST['from']."'and fabric_name='".$coldata['fabric_name']."'"));
								$out=$out['wgt'];
								$wgt=$in-$out;
							}*/
                    ?>
                    <tr>
                        <td style="width:4%"><?php echo $coldata['fabric_name'];?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name'];?>"><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"></td>
                        <td style="width:4%"><?php echo $coldata['ycolor'];?><input type="hidden" name="color[]" value="<?php echo $coldata['ycolor'];?>"></td>
                        <td style="width:4%"><?php echo $coldata['dia'];?><input type="hidden" name="dia[]" value="<?php echo $coldata['dia'];?>"></td>
                        <td style="width:8%"><?php echo $coldata['gsm'];?><input type="hidden" name="gsm[]" value="<?php echo $coldata['gsm'];?>"></td>
                        <td style="width:4%"><?php echo $coldata['weight'];?><input type="hidden" name="planning_wgt" value="<?php echo $coldata['weight'];?>" id=""></td>
                        <td style="width:8%"><?php echo $in;?><input type="hidden" readonly  size="8" style="border:none;" value="<?php echo $in;?>" id="planwgt_<?php echo $frst_rw;?>" name="wgt[]"></td>
                        <td style="width:8%"><input type="text" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['delivered_wgt'];?>" id="del_wgt<?php echo $frst_rw;?>" name="del_wgt[]"></td>
                        <td style="width:8%"><input type="text" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['balance_wgt'];?>" id="balwgt_<?php echo $frst_rw;?>" name="balance_wgt[]"><input type="hidden" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['balance_wgt'];?>" id="balwgt1_<?php echo $frst_rw;?>"></td>
                        <td style="width:4%"><input type="text" min="0" max="<?php //echo $wgt;?>" class="form-control tweight" name="delivery_wgt[]" autocomplete="off" onkeyup="cal_tweight1('<?php echo $frst_rw;?>');" id="delwgt_<?php echo $frst_rw;?>"></td>
                    </tr>
					
                    <?php
                    $frst_rw++;
                    }
                // }
                    ?>
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
						 </script>
                    <tr>
                        <td colspan="8"><strong>TOTAL WEIGHT</strong></td>
                        <td>
                            <input type="text" name="total" id="total_weight1" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
								</div>
								<br>
			<br>
			
            <div class="card" style="width:100%">
        <div class="border-top">
            <div class="card-body" style="margin-left: 400px;">
                <button type="submit" name="save" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </div>
    </div>
        </div>
    <?php } 
	else if($_REQUEST['to_process']=='biowash' || $_REQUEST['to_process']=='WASHING & BIO WASH
    '){?>
        <div class="table-responsive">
            <div class="col-12 d-flex no-block align-items-center">
                <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['to_process']); ?>&nbsp;++++++PROGRAM</h5>
            </div>
			<div class="scroll-container">
			
            <table id="example" class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width:15%" data-toggle="tooltip" title="Fabric NAME">FABRIC NAME</th>
                        <th style="width:15%" data-toggle="tooltip" title="Fabric COLOR">COLOR</th>
                         <th style="width: 3%">DIA</th>
								<th style="width:5%" data-toggle="tooltip" title="Fabric Dia">FDIA</th>
						<th style="width:5%">GSM</th>
							<th style="width:5%">F GSM</th>

                        <th style="width: 5%" data-toggle="tooltip" title="INWARD Weight">STOCK</th>
                        <th style="width:12%" data-toggle="tooltip" title="DELIVERY Weight">DELIVERY WGT</th>
                        <th style="width:12%" data-toggle="tooltip" title="BALANCE Weight">BALANCE WGT</th>
                        <th style="width:15%">ENTER.WGT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                 /*	$sel_buyer = mysqli_query($zconn,"select * from yarn_inward where  order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'");
					while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ */
						

                    $sectBrnQry = "SELECT * FROM dyeing_planning where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
                    $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                    $frst_rw=1;
                    while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
    $order_details = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);

                      $plan_wgt_det = ($order_details['cutting_qty']*$order_details['excess_percent'])/100;
                      $pan_wgt1 = $order_details['cutting_qty']+$plan_wgt_det;
                      $plan_wgt = $coldata['wgt'];
															      
                      $sel_dc = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as DCNO from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."' and from_addr='".$_REQUEST['from']."' and to_process='".$_REQUEST['to_process']."' "),MYSQLI_ASSOC);

                      $sel_pro = mysqli_fetch_array(mysqli_query($zconn,"select * from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."' and from_addr='".$_REQUEST['from']."' and to_process='".$_REQUEST['to_process']."' and dc_no='".$sel_dc['DCNO']."' "),MYSQLI_ASSOC);
							$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_in where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and from_addr='".$_REQUEST['from']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];
 $order_details = mysqli_query($zconn,"select * from knitting_planning where knitt_id='".$sel_orders['id']."'");
                       /*if($_REQUEST['from']=='yarn Inward') {
								$tbl='yarn_inward';
								$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];
								$out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'and from_addr='".$_REQUEST['from']."'"));
								$out=$out['wgt'];
								$wgt=$in-$out;
							} else {
								$tbl='process_dc_in';
								$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and from_addr='".$_REQUEST['from']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];
								$out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='".$_REQUEST['from']."'and fabric_name='".$coldata['fabric_name']."'"));
								$out=$out['wgt'];
								$wgt=$in-$out;
							}*/
                    ?>
                    <tr>
                        <td style="width:4%"><?php echo $coldata['fabric_name'];?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name'];?>"><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"></td>
                        <td style="width:4%"><?php echo $coldata['ycolor'];?><input type="hidden" name="color[]" value="<?php echo $coldata['ycolor'];?>"></td>
						<?php $sel_orders = mysqli_fetch_array(mysqli_query($zconn,"select * from knitting_planning_master where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);

    $order_details = mysqli_query($zconn,"select * from knitting_planning where knitt_id='".$sel_orders['id']."'");
    
        while($res_orders = mysqli_fetch_array($order_details,MYSQLI_ASSOC)){
			//print_r($res_orders); ?>
			 <td style="width:3%"><input type="text" name="dia[]" value="<?php echo $res_orders['dia'];?>" readonly style="border:none;" size="7"></td>
	<?php	} ?>
                        
		<td style="width:3%">
    <select name="fdia[]">
        <?php
        // Assuming you have fetched options from the dia_master table
			$diaQuery = "SELECT dia_name FROM dia_master";
$diaResult = mysqli_query($zconn, $diaQuery);
			
        while ($diaOption = mysqli_fetch_assoc($diaResult)) {
            $selected = ($coldata['f_dia'] == $diaOption['dia_name']) ? 'selected' : '';
            echo '<option value="' . $diaOption['dia_name'] . '" ' . $selected . '>' . $diaOption['dia_name'] . '</option>';
        }
        ?>
    </select>
</td>
						<td style="width:3%"><input type="text" name="gsm[]" value="<?php echo $res_orders['gsm'];?>" readonly style="border:none;" size="7"></td>
						<?php
// Assuming you have a database connection established as $zconn

// Query to fetch options from the gsm_master table
$gsmQuery = "SELECT gsm_name FROM gsm_master";
$gsmResult = mysqli_query($zconn, $gsmQuery); ?>

							<td style="width:3%"> <select name="fgsm[]">
        <?php
        // Iterate through the fetched options
        while ($gsmOption = mysqli_fetch_assoc($gsmResult)) {
            $selected = ($coldata['f_gsm'] == $gsmOption['gsm_name']) ? 'selected' : '';
            echo '<option value="' . $gsmOption['gsm_name'] . '" ' . $selected . '>' . $gsmOption['gsm_name'] . '</option>';
        }
        ?>
    </select></td>

             
                        <td style="width:8%"><?php echo $in;?><input type="hidden" readonly  size="8" style="border:none;" value="<?php echo $in;?>" id="planwgt_<?php echo $frst_rw;?>" name="wgt[]"></td>
                        <td style="width:8%"><input type="text" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['delivered_wgt'];?>" id="del_wgt<?php echo $frst_rw;?>" name="del_wgt[]"></td>
                        <td style="width:8%"><input type="text" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['balance_wgt'];?>" id="balwgt_<?php echo $frst_rw;?>" name="balance_wgt[]"><input type="hidden" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['balance_wgt'];?>" id="balwgt1_<?php echo $frst_rw;?>"></td>
                        <td style="width:4%"><input type="text" min="0" max="<?php //echo $wgt;?>" class="form-control tweight" name="delivery_wgt[]" autocomplete="off" onkeyup="cal_tweight1('<?php echo $frst_rw;?>');" id="delwgt_<?php echo $frst_rw;?>"></td>
                    </tr>
					
                    <?php
                    $frst_rw++;
                    }
                // }
                    ?>
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
						 </script>
                    <tr>
                        <td colspan="12"><strong>TOTAL WEIGHT</strong></td>
                        <td>
                            <input type="text" name="total" id="total_weight1" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
			</div>
			<br>
			<br>

            <div class="card" style="width:100%">
        <div class="border-top">
            <div class="card-body" style="margin-left: 400px;">
                <button type="submit" name="save" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </div>
    </div>
        </div>
        <?php } 
	else if($_REQUEST['to_process']=='compact' || $_REQUEST['to_process']=='COMPACTING
    '){?>
        <div class="table-responsive">
            <div class="col-12 d-flex no-block align-items-center">
                <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['to_process']); ?>&nbsp;++++++PROGRAM</h5>
            </div>
			<div class="scroll-container">
			
            <table id="example" class="table table-striped table-bordered text-center">
                <thead>
                    <tr>
                        <th style="width:15%" data-toggle="tooltip" title="Fabric NAME">FABRIC NAME</th>
                        <th style="width:15%" data-toggle="tooltip" title="Fabric COLOR">COLOR</th>
                         <th style="width: 3%">DIA</th>
								<th style="width:5%" data-toggle="tooltip" title="Fabric Dia">FDIA</th>
						<th style="width:5%">GSM</th>
							<th style="width:5%">F GSM</th>          				
                        <th style="width: 5%" data-toggle="tooltip" title="INWARD Weight">STOCK</th>
                        <th style="width:12%" data-toggle="tooltip" title="DELIVERY Weight">DELIVERY WGT</th>
                        <th style="width:12%" data-toggle="tooltip" title="BALANCE Weight">BALANCE WGT</th>
                        <th style="width:15%">ENTER.WGT</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                 /*	$sel_buyer = mysqli_query($zconn,"select * from yarn_inward where  order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'");
					while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ */
						

                    $sectBrnQry = "SELECT * FROM dyeing_planning where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'";
                    $secBrnResource = mysqli_query($zconn,$sectBrnQry);
                    $frst_rw=1;
                    while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
    $order_details = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);

                      $plan_wgt_det = ($order_details['cutting_qty']*$order_details['excess_percent'])/100;
                      $pan_wgt1 = $order_details['cutting_qty']+$plan_wgt_det;
                      $plan_wgt = $coldata['wgt'];
															      
                      $sel_dc = mysqli_fetch_array(mysqli_query($zconn,"select max(dc_no) as DCNO from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."' and from_addr='".$_REQUEST['from']."' and to_process='".$_REQUEST['to_process']."' "),MYSQLI_ASSOC);

                      $sel_pro = mysqli_fetch_array(mysqli_query($zconn,"select * from process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."' and from_addr='".$_REQUEST['from']."' and to_process='".$_REQUEST['to_process']."' and dc_no='".$sel_dc['DCNO']."' "),MYSQLI_ASSOC);
							$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_in where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and from_addr='".$_REQUEST['from']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];
 $order_details = mysqli_query($zconn,"select * from knitting_planning where knitt_id='".$sel_orders['id']."'");
                       /*if($_REQUEST['from']=='yarn Inward') {
								$tbl='yarn_inward';
								$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];
								$out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and fabric_name='".$coldata['fabric_name']."'and from_addr='".$_REQUEST['from']."'"));
								$out=$out['wgt'];
								$wgt=$in-$out;
							} else {
								$tbl='process_dc_in';
								$inward =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM $tbl where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'and from_addr='".$_REQUEST['from']."' and fabric_name='".$coldata['fabric_name']."'"));
								$in=$inward['wgt'];
								$out =  mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(wgt) as wgt FROM process_dc_out where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."' and from_addr='".$_REQUEST['from']."'and fabric_name='".$coldata['fabric_name']."'"));
								$out=$out['wgt'];
								$wgt=$in-$out;
							}*/
                    ?>
                    <tr>
                        <td style="width:4%"><?php echo $coldata['fabric_name'];?><input type="hidden" name="fabric_name[]" value="<?php echo $coldata['fabric_name'];?>"><input type="hidden" name="id[]" value="<?php echo $coldata['id'];?>"></td>
                        <td style="width:4%"><?php echo $coldata['ycolor'];?><input type="hidden" name="color[]" value="<?php echo $coldata['color'];?>"></td>
						<?php $sel_orders = mysqli_fetch_array(mysqli_query($zconn,"select * from knitting_planning_master where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);

    $order_details = mysqli_query($zconn,"select * from knitting_planning where knitt_id='".$sel_orders['id']."'");
    
        while($res_orders = mysqli_fetch_array($order_details,MYSQLI_ASSOC)){
			//print_r($res_orders); ?>
			 <td style="width:3%"><input type="text" name="dia[]" value="<?php echo $res_orders['dia'];?>" readonly style="border:none;" size="7"></td>
	<?php	} ?>
                        
		<td style="width:3%">
    <select name="fdia[]">
        <?php
        // Assuming you have fetched options from the dia_master table
			$diaQuery = "SELECT dia_name FROM dia_master";
$diaResult = mysqli_query($zconn, $diaQuery);
			
        while ($diaOption = mysqli_fetch_assoc($diaResult)) {
            $selected = ($coldata['f_dia'] == $diaOption['dia_name']) ? 'selected' : '';
            echo '<option value="' . $diaOption['dia_name'] . '" ' . $selected . '>' . $diaOption['dia_name'] . '</option>';
        }
        ?>
    </select>
</td>
						
						<td style="width:3%"><input type="text" name="gsm[]" value="<?php echo $res_orders['gsm'];?>" readonly style="border:none;" size="7"></td>
						<?php
// Assuming you have a database connection established as $zconn

// Query to fetch options from the gsm_master table
$gsmQuery = "SELECT gsm_name FROM gsm_master";
$gsmResult = mysqli_query($zconn, $gsmQuery); ?>

							<td style="width:3%"> <select name="fgsm[]">
        <?php
        // Iterate through the fetched options
        while ($gsmOption = mysqli_fetch_assoc($gsmResult)) {
            $selected = ($coldata['f_gsm'] == $gsmOption['gsm_name']) ? 'selected' : '';
            echo '<option value="' . $gsmOption['gsm_name'] . '" ' . $selected . '>' . $gsmOption['gsm_name'] . '</option>';
        }
        ?>
    </select></td>

                        <td style="width:8%"><?php echo $in;?><input type="hidden" readonly  size="8" style="border:none;" value="<?php echo $in;?>" id="planwgt_<?php echo $frst_rw;?>" name="wgt[]"></td>
                        <td style="width:8%"><input type="text" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['delivered_wgt'];?>" id="del_wgt<?php echo $frst_rw;?>" name="del_wgt[]"></td>
                        <td style="width:8%"><input type="text" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['balance_wgt'];?>" id="balwgt_<?php echo $frst_rw;?>" name="balance_wgt[]"><input type="hidden" readonly  size="8" style="border:none;" value="<?php echo $sel_pro['balance_wgt'];?>" id="balwgt1_<?php echo $frst_rw;?>"></td>
                        <td style="width:4%"><input type="text" min="0" max="<?php //echo $wgt;?>" class="form-control tweight" name="delivery_wgt[]" autocomplete="off" onkeyup="cal_tweight1('<?php echo $frst_rw;?>');" id="delwgt_<?php echo $frst_rw;?>"></td>
                    </tr>
					
                    <?php
                    $frst_rw++;
                    }
                // }
                    ?>
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
						 </script>
                    <tr>
                        <td colspan="10"><strong>TOTAL WEIGHT</strong></td>
                        <td>
                            <input type="text" name="total" id="total_weight1" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
			</div>
			<br>
			<br>
		
            <div class="card" style="width:100%">
        <div class="border-top">
            <div class="card-body" style="margin-left: 400px;">
                <button type="submit" name="save" class="btn btn-success">Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </div>
    </div>
        </div>
    <?php } else { ?>
        <div class="table-responsive" >
            <div class="col-12 d-flex no-block align-items-center">
                <h5 class="page-title"  style="margin-left: 390px;"><?php echo strtoupper($_REQUEST['to_process']); ?>&nbsp;.........PROGRAM</h5>
            </div>
			<div class="scroll-container">
            <table id="example" class="table table-striped table-bordered text-center" style="width:100%">
                <thead>
                    <tr>
                        <th style="width: 10%">FABRIC NAME</th>
                        <th style="width: 3%" data-toggle="tooltip" title="Fabric Dia">COLOR</th>
                        <th style="width: 3%">DIA</th>
								<th style="width:5%" data-toggle="tooltip" title="Fabric Dia">FDIA</th>
						<th style="width:5%">GSM</th>
							<th style="width:5%">F GSM</th>
							<th style="width:5%">GUAGE</th>
			                            				<th style="width:5%" data-toggle="tooltip" title="Weight">LOOP LENGTH</th>
                        <th style="width: 5%" data-toggle="tooltip" title="PLANNING Weight">INWARD WGT</th>
                        <th style="width: 15%" data-toggle="tooltip" title="PLANNING Weight">DELIVERED WGT</th>
                        <th style="width: 15%" data-toggle="tooltip" title="PLANNING Weight">BALANCE STOCK</th>
                        <th style="width: 15%">ENTER WGT NOW</th>
                    </tr>
                </thead>
                <tbody>
    <?php 
    $sel_orders = mysqli_fetch_array(mysqli_query($zconn,"select * from knitting_planning_master where order_no='".$_REQUEST['order']."' and style_no='".$_REQUEST['style']."'"),MYSQLI_ASSOC);

    $order_details = mysqli_query($zconn,"select * from knitting_planning where knitt_id='".$sel_orders['id']."'");
    $cj=0;
    $balance_wgt=0;
    while ($res_orders = mysqli_fetch_array($order_details, MYSQLI_ASSOC)) {
        $knitt_id = $res_orders['id'];
    
        $yarn_sql = mysqli_query($zconn, "SELECT * FROM yarn_inward WHERE old_id = '$knitt_id'");
    
        if ($yarn_sql) {
            while ($yarn_det = mysqli_fetch_array($yarn_sql, MYSQLI_ASSOC)) {
                
                $yarn_wgt=$yarn_det['wgt'];
                $yarn_iwgt=$yarn_det['wgt'];

            }
        } else {
            echo "Query failed: " . mysqli_error($zconn);
        }
    //}
    
$sel_dc = mysqli_fetch_array(mysqli_query($zconn, "SELECT * FROM process_dc_out WHERE style_no = '".$_REQUEST['style']."' AND order_no = '".$_REQUEST['order']."' AND fabric_name = '".$res_orders['fabric_name']."' ORDER BY id DESC LIMIT 1"), MYSQLI_ASSOC);
$last_dc_no = $sel_dc['dc_no'];
$last_dc_date = $sel_dc['dc_date'];
//$balance_wgt=-$sel_dc['balance_wgt'];
            if($sel_dc['balance_wgt']!=''){
                $balance_wgt = $sel_dc['balance_wgt'];
            } 
    ?>
                    <tr>
                            <td style="width:10%"><input type="text" name="fabric_name[]" value="<?php echo $res_orders['fabric_name'];?>" readonly style="border:none;" size="10"></td>
                        <td style="width:3%" data-toggle="tooltip" title="Fabric Dia"><input type="text" name="color[]" value="<?php echo $res_orders['color'];?>" readonly style="border:none;" size="7"></td>
                        <td style="width:3%"><input type="text" name="dia[]" value="<?php echo $res_orders['dia'];?>" readonly style="border:none;" size="7"></td>
		<td style="width:3%">
    <select name="fdia[]">
        <?php
        // Assuming you have fetched options from the dia_master table
			$diaQuery = "SELECT dia_name FROM dia_master";
$diaResult = mysqli_query($zconn, $diaQuery);
			
        while ($diaOption = mysqli_fetch_assoc($diaResult)) {
            $selected = ($coldata['f_dia'] == $diaOption['dia_name']) ? 'selected' : '';
            echo '<option value="' . $diaOption['dia_name'] . '" ' . $selected . '>' . $diaOption['dia_name'] . '</option>';
        }
        ?>
    </select>
</td>
						<?php
// Assuming you have a database connection established as $zconn

// Query to fetch options from the gsm_master table
$gsmQuery = "SELECT gsm_name FROM gsm_master";
$gsmResult = mysqli_query($zconn, $gsmQuery); ?>

							<td style="width:3%"> <select name="gsm[]">
        <?php
        // Iterate through the fetched options
        while ($gsmOption = mysqli_fetch_assoc($gsmResult)) {
            $selected = ($res_orders['gsm'] == $gsmOption['gsm_name']) ? 'selected' : '';
            echo '<option readyonly value="' . $gsmOption['gsm_name'] . '" ' . $selected . '>' . $gsmOption['gsm_name'] . '</option>';
        }
        ?>
    </select></td>
						
						<?php
// Assuming you have a database connection established as $zconn

// Query to fetch options from the gsm_master table
$gsmQuery = "SELECT gsm_name FROM gsm_master";
$gsmResult = mysqli_query($zconn, $gsmQuery); ?>

							<td style="width:3%"> <select name="fgsm[]">
        <?php
        // Iterate through the fetched options
        while ($gsmOption = mysqli_fetch_assoc($gsmResult)) {
            $selected = ($coldata['f_gsm'] == $gsmOption['gsm_name']) ? 'selected' : '';
            echo '<option value="' . $gsmOption['gsm_name'] . '" ' . $selected . '>' . $gsmOption['gsm_name'] . '</option>';
        }
        ?>
    </select></td>
							<td style="width:3%"><input type="text" name="gauge[]" value="<?php echo $res_orders['Gauge'];?>" size="7"></td>
							<td style="width:4%"><input type="text" name="loop_length[]" value="<?php echo $res_orders['Loop_Length'];?>" size="7"></td>
                        
     <td style="width:10%" data-toggle="tooltip" title="PLANNING Weight">
    <input type="hidden" id="inward_wgt<?php echo $cj; ?>" name="inward_wgt[]" value="<?php echo $yarn_iwgt; ?>" style="border:none;" size="10">
		 <input type="text" id="inward_wgt<?php echo $cj; ?>"  value="<?php echo $yarn_wgt; ?>" style="border:none;" size="10">
</td> 
						<?php
// Perform a database query to calculate the total delivered weight for the specific style_no
$style_no = $_REQUEST['style']; // Replace this with your variable or input
$query = "SELECT SUM(delivered_wgt) AS total_delivered_weight FROM  process_dc_out WHERE style_no = '$style_no'";
$result = mysqli_query($zconn, $query);

if ($result) {
    $row = mysqli_fetch_assoc($result);
    $total_delivered_weight = $row['total_delivered_weight'];
} else {
    $total_delivered_weight = 0; // Set a default value in case of an error or no records found
}
?>
<td style="width:10%" data-toggle="tooltip" title="PLANNING Weight">
    <!-- Display the sum of delivered weights from the database -->
    <input type="text" class="form-control delivery_wgt" id="delivery_wgt<?php echo $cj; ?>" name="delivery_wgt[]" readonly value="<?php echo $total_delivered_weight; ?>">
</td>

<td style="width:10%" data-toggle="tooltip" title="PLANNING Weight">
    <input id="" type="text" class="form-control balance_wgt" name="balance_wgt[]" readonly value="<?php echo $yarn_det['inward_wgt']; ?>">
</td>
<td style="width:15%">
    <input type="text" class="form-control enter_wgt" name="enter_wgt[]" data-cj="<?php echo $cj; ?>" onkeyup="calc_wgt(this);">
                    </tr>
            <?php $cj++;} ?>
                    <tr>
                        <td colspan="9"></td>
						 <td>
                           <strong>TOTAL WEIGHT</strong>
                        </td>
                        <td>
                            <input type="text" name="total" id="total" class="form-control">
                        </td>
                    </tr>
                </tbody>
            </table>
			</div>
			<br>
			<br>
		
			
            <div class="card" style="width:100%">
        <div class="border-top">
            <div class="card-body" style="margin-left: 400px;">
                <button type="submit" name="save" class="btn btn-success " >Save</button>
                <button type="reset" class="btn btn-primary">Reset</button>
            </div>
        </div>
				</div>
    </div>
        </div>
            <?php }
     }
     ?>
							
							 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Sales chart -->
            <!-- ============================================================== -->
        </div>
        <!-- End Container fluid  -->
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
<!-- JavaScript code at the end of your HTML file -->
<script>
// Function to calculate and update weights
function calc_wgt(inputElement) {
    var cj = $(inputElement).data('cj'); // Assuming you have a data attribute 'data-cj' for identifying elements
    var entered_wgt = parseFloat($(inputElement).val()) || 0;
    
    // Calculate the sum of delivered_wgt values for the same data-cj value
    var delivered_wgt = 0;
    $('.delivery_wgt[data-cj="' + cj + '"]').each(function() {
       delivered_wgt += parseFloat($(this).val()) || 0;
    });
    
    // Add the entered_wgt value to the sum of delivered_wg
    delivered_wgt += entered_wgt;
    
    // Update the corresponding delivery_wgt input element
    $('#delivery_wgt' + cj).val(delivered_wgt);

    // Calculate and update balance weight
    var inward_wgt = parseFloat($('#inward_wgt' + cj).val()) || 0;
    var balance_wgt = inward_wgt - delivered_wgt;
    $('#balance_wgt' + cj).val(balance_wgt);

    // Calculate and update the total weight
    var totalWeight = 0;
    $('.delivery_wgt').each(function() {
        totalWeight += parseFloat($(this).val()) || 0;
    });
    $('#total').val(totalWeight);
}

// Bind the keyup event to all enter_wgt inputs
$(document).on('keyup', '.enter_wgt', function() {
    calc_wgt(this);
});


</script>

<script>
    function validateForm() {
        var totalBalanceWeight = 0;
        var balanceInputs = document.querySelectorAll('.balance_wgt');
        
        balanceInputs.forEach(function(input) {
            totalBalanceWeight += parseFloat(input.value);
        });

        if (totalBalanceWeight == 0) {
            alert('Stock is 0. Your Cannot continue this process');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>



</body>
</html>

