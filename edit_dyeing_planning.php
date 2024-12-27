<?php 
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);

if($_SESSION['userid']==''){
    echo "<script>window.location.href='login.php';</script>";
}
/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/


if($_REQUEST['id']!=''){
		$sel_dye_plan = mysqli_fetch_array(mysqli_query($zconn,"select * from dyeing_planning_master where id='".$_REQUEST['id']."'"),MYSQLI_ASSOC);
		$dye_order_no = $sel_dye_plan['order_no'];
		$dye_style_no = $sel_dye_plan['style_no'];
		$_REQUEST['b'] = $dye_order_no;
		$_REQUEST['s'] = $dye_style_no;
		
}

if (isset($_POST['save'])  == 'save') {
    $knit_loss = 0;
    $fabcount = count($_POST['fabric_name']);

    

    $order = $_POST['order_no'];
    $style_no = $_POST['style_no'];

    // Update data in dyeing_planning_master
    $updateMaster = mysqli_query($zconn, "UPDATE dyeing_planning_master SET  grand_total = '".$_POST['grand_total']."'
     WHERE id = '".$_POST['id']."' AND order_no = '$order' AND style_no = '$style_no'");

	if ($updateMaster) {
        $trows = count($_POST['ycolor']);

        // Update data in dyeing_planning
        $success = true; // Variable to track whether all updates were successful

        for ($tr = 0; $tr < $trows; $tr++) {
            $id = $_POST['ddi'][$tr];
            $fabric_name = $_POST['fabric_name'][$tr];
            $ycolor = $_POST['ycolor'][$tr];
            $content = $_POST['content'][$tr];
            $dia = $_POST['dia'][$tr];
            $gsm = $_POST['gsm'][$tr];
            $ycomp = $_POST['ycomp'][$tr];
            $gram_component = $_POST['gram_component'][$tr];
            $excess_cal = $_POST['excess_cal'][$tr];
            $weight = $_POST['weight'][$tr];
            $dye_loss = $_POST['dye_loss'][$tr];

            $updateDetails = mysqli_query($zconn, "UPDATE dyeing_planning SET
                fabric_name = '$fabric_name',
                ycolor = '$ycolor',
                content = '$content',
                dia = '$dia',
                gsm = '$gsm',
                ycomp = '$ycomp',
                gram_component = '$gram_component',
                excess_cal = '$excess_cal',
                weight = '$weight',
                dye_loss = '$dye_loss'
                WHERE id = '$id'");

            if (!$updateDetails) {
                die("SQL Error: " . mysqli_error($zconn));
            }
        }

        if ($success) {
            echo "<script>alert('Updated Successfully!!!');</script>";
            echo "<script>window.location.href='dyeing_planning_list.php';</script>";
        } else {
            echo "<script>alert('Failed to update dyeing_planning details.');</script>";
        }
    } else {
        echo "<script>alert('Failed to update dyeing_planning_master details.');</script>";
    }
}


if($_REQUEST['id']==''){
    //$cost_no = get_max_costno();

    $sel_costing = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as COSTNO from costing_entry_master"));
    if($sel_costing['COSTNO']=='' || $sel_costing['COSTNO']==NULL){
        $cost_no ='001';
    } else {
        $cost_no = $sel_costing['COSTNO']+1;
    }
    $cost_no = "00".$cost_no;
    $action="saveCosting";
} 

?><!DOCTYPE html>
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
    <title><?php echo SITE_TITLE;?> - Dyeing Planning Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
    <style>
    .table td, .table th{padding:0px !important; font-size:14px;}
    </style>
</head>
<body>
    <div id="main-wrapper" data-sidebartype="mini-sidebar" class="mini-sidebar">
        <!-- Topbar header - style you can find in pages.scss -->
        <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Dyeing Planning Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="planning.php">Process Palnning</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- Sales chart -->
                <form action="" method="POST" onsubmit="return checkval();"  id="dye_planning">
                <input type="hidden" name="cost_no" id="cost_no" value="<?php echo $cost_no;?>">
                <input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-body" style="width:100%">
                                    <div class="card-body" style="width:100%">
                                <div class="card" style="width:50%; float:left; left: 50px; ">
                                <div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
										<div class="col-sm-6">
                                        <?php
                                          $id=$_GET['id'];
                                          $style=$sel_buyer['order_no'];
                                          $select=mysqli_fetch_array(mysqli_query($zconn,"select * from dyeing_planning_master where id='$id'"));
										
                                        ?>
								<select class="select2 form-control custom-select chosen-select" name="order_no" id="order_no" onchange="buyer_costing(this.value);" required>
                                 <option  value="<?php echo $select['order_no'];?>" selected="selected"><?php echo $select['order_no'];?></option>
								<!--  <option value="">Select</option>
										<?php $sel_buyer =mysqli_query($zconn,"select * from costing_entry_master");
										while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){

										if($res_cost['id']==$res_buyer['id']){	?>
										<option selected value="<?php echo $res_buyer['order_no']."~~".$res_buyer['id'];?>"><?php echo $res_buyer['order_no'];?></option>
										<?php } else { ?>
										<option value="<?php echo $res_buyer['order_no']."~~".$res_buyer['id'];?>"><?php echo $res_buyer['order_no'];?></option>
										<?php } ?>
										<?php } ?> -->
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
										<div class="col-sm-6">
                                            <select class="select2 form-control custom-select chosen-select" name="style_no" id="style" onChange="style_no()">
                                            <option  value="<?php echo $select['style_no'];?>" selected="selected"><?php echo $select['style_no'];?></option>
                                            </select>
                                            <script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
										</div>
                    									</div>
                    			<!-- 	<div class="form-group row">
                    				    <label for="fname" class="col-sm-3 text-right control-label col-form-label" >Component Group</label>
                        				<div class="col-sm-6">
                                            <select class="form-control" name="component" id="component" onchange="myFunction()" >
                                            <?php 
                                                 $sel_comp = mysqli_query($zconn,"select * from costing_entry_details group by comp_group");
                        						 while($res_comp = mysqli_fetch_array($sel_comp,MYSQLI_ASSOC)){
                        							 if($sel_knitting['comp_group']==$res_comp['comp_group']){
                                               ?>
                        							<option value="<?php echo $res_comp['comp_group'];?>" selected="selected"><?php echo $res_comp['comp_group'];?></option>
                        							 <?php } else { ?>
                         							<option  value="<?php echo $res_comp['comp_group'];?>" ><?php echo $res_comp['comp_group'];?></option>
                        						 <?php }
                        						 } ?>
                                               </select>
                        				</div>
                    			   </div>
                    		 <br> -->
				</div>
							</div>
                <!-- Sales chart -->
                <!-- ============================================================== --></div>
				 <div class="row">
				 <div class="col-md-12">

                 <?php if ($_GET['id']!='') {?>
<?php if($costing_row>0){ ?>


	<div class="form-group">
		<h4 class="page-title"><b>Component Details</b></h4>
	</div>
	<table id="example" class="table table-striped table-bordered">
		<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
			<tr>
				<th>Order No</th>
				<th>Style No</th>
				<th>Pcs Weight</th>
				<th>Order Quantity + Excess</th>
				<th>Total Weight [KGS]</th>
			</tr>
		</thead>
        <tbody>

        <?php
                   $yarnDet=mysqli_query($zconn,"select * from dyeing_planning_master WHERE id = '".$_REQUEST['id']."' order by id asc ");
                        $cnt=1;
                        while($Det = mysqli_fetch_object($yarnDet)) {
                            $fabric_name=$Det->fabric_name;

                            ?>
                            <tr class="form-group has-success">
                                <td><?php  echo $select['order_no'];?></td>
                                <td><?php  echo $select['style_no'];?></td>
         <?php
 		//$id=explode("~~",$_REQUEST['s']);
		$id = $dye_style_no;

        	 $coso = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$dye_order_no."' and style_no='".$dye_style_no."'"),MYSQLI_ASSOC);
			 $cost_ido=$coso['id'];
			 if ($cost_ido!='') {
				 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$dye_order_no."' and style_no='".$dye_style_no."'"),MYSQLI_ASSOC);
				 $sel_c = mysqli_query($zconn,"SELECT distinct(costing_id)  FROM `costing_entry_details` where costing_id='".$cos['id']."'");
				 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$dye_style_no."'"),MYSQLI_ASSOC);	
			 } else {
				 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$dye_style_no."'"),MYSQLI_ASSOC);
				 $sel_0 = mysqli_query($zconn,"SELECT distinct(yarn_id)  FROM `order_quantity_details` where yarn_id='".$cos['id']."'");
				 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$dye_style_no."'"),MYSQLI_ASSOC);
			 }

			if ($sel_c!='') {
				$sel=$sel_c;
				$tb="costing_entry_details";
				$cond="costing_id";
			}
			else{
				$sel=$sel_0;
				$tb="order_entry_master";	
				$cond="yarn_id";
			}

			while($resc=mysqli_fetch_array($sel)){ 
			 	$pcs = mysqli_fetch_array(mysqli_query($zconn,"SELECT sum(pcs_weight) as pcs_weight FROM $tb where  $cond='".$cos['id']."'"),MYSQLI_ASSOC);
			 	
                 $exc_cal = ($order['excess_percent']*$order['order_qty'])/100;
                 $excess_cal = $order['order_qty']+$exc_cal;
                 
                 //	$print_order_qty = $order['order_qty']*$order['excess_percent'];
             $pcsweight = number_format($pcs['pcs_weight'], 2, '.', "");
             $tow =$pcsweight*$excess_cal;
                
                ?> 
				
				<td><?php echo $_REQUEST['b'];?><input type="hidden" name="order_no" class="form-control" value="<?php echo $_REQUEST['b'];?>"></td>
					<td><?php echo $dye_style_no;?><input type="hidden" name="style_no" class="form-control" value="<?php echo $dye_style_no;?>"></td>
					<td><?php echo number_format($pcs['pcs_weight'],2);?><input type="hidden" name="pcs_weight" class="form-control" value="<?php echo $pcs['pcs_weight'];?>"></td>
					<td><?php echo  $excess_cal;?><input type="hidden" name="order_qty" class="form-control"  value="<?php echo $excess_cal;?>"></td>
					<td><?php echo ($pcs['pcs_weight']*$excess_cal);?><input type="hidden" name="totweight" id="totweight" class="form-control" value="<?php echo ($pcs['pcs_weight']*$order['order_qty']);?>"></td>
                    </tr>
                                <?php
                        $cnt++;
                        } ?>
        </tbody>
    </table>
<?php }}  ?>
    <br />
	<hr>
	<legend><h4> Dyeing Planning Details</h4></legend>

<table id="example1" class="table table-striped table-bordered">
	
		<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
			<tr>
			<th style="display: none;">Id</th>
            <th>Fabric Name</th>
				<th>Colour</th>
				<th>Content</th>
				
				<th>Dia</th>
				<th>Gsm</th>
				<th>Component</th>
				<th>gram/component</th>
				<th>Order qty</th>
				<th>WGT</th>
			
				<th>Dye Loss</th>
				<th style="width:20px;"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
			</tr>
		</thead>
        <tbody>
		<?php 
		
		
		$sel_dye_plan1 = mysqli_query($zconn,"select * from dyeing_planning where dye_id='".$_GET['id']."'");
		$p=0;
		while($res_dye_plan =mysqli_fetch_array($sel_dye_plan1,MYSQLI_ASSOC))
		
		{
			$id=$res_dye_plan['id'];
		?>

        
<tr id="delete_<?php echo $p;?>">

<td style="display: none;"><input type="hidden" name="ddi[]"  class="form-control" id="ddi" autocomplete="off" value="<?php echo $res_dye_plan['id'];?>"></td>

				<td>
						<!--<input type="text" class="form-control totl" id="fabric_name" name="fabric_name[]"  value="<?php echo $resc['fabric_name'];?>" readonly>-->

					<?php $sel_fabric = mysqli_query($zconn,"select * from fabric_master where status='0'");?>
						<select name="fabric_name[]" id="fabric_name0" style="width:150px" class="select2 form-control custom-select chosen-select">
							<option value="">--Select--</option>
							 <?php
									while($res_fabric = mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){
										if($res_dye_plan['fabric_name'] == $res_fabric['fabric_name']){
						 ?>
						  <option selected value="<?php echo $res_fabric['fabric_name'];?>"><?php echo $res_fabric['fabric_name'];?></option>
						<?php } else { ?>
						 <option value="<?php echo $res_fabric['fabric_name'];?>"><?php echo $res_fabric['fabric_name'];?></option>
					<?php } } ?>
									</option>
		</select>
				</td>

									<td>

							 <select class="select2 form-control custom-select" name="ycolor[]" id="ycolor0">
								<option value="">Select</option>
				<?php
						$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
						while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
							
							if($res_dye_plan['ycolor']== $res_ycolor['colour_name']){?>
							<option value="<?php echo $res_ycolor['colour_name'];?>" selected><?php echo $res_ycolor['colour_name'];?></option>
							<?php } else { ?>
							<option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
							<?php } ?>
						<?php } ?>
					</select> 
                    <script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
									</td>
										

										<!-- <td><input type="text" name="pcs_weight[]"  class="form-control pcs_weight" id="pcs_weight" onKeyUp="multiply()" value="<?php echo $res_dye_plan['wgt'];?>" required></td> -->
					 	
                                        <td>
				<select class="select2 form-control custom-select" name="content[]" id="content">
					<option value="">Select</option>
					<?php
					$sel_ycolor1 = mysqli_query($zconn,"select * from content_master where status='0'");
					while($res_ycolor1 = mysqli_fetch_array($sel_ycolor1,MYSQLI_ASSOC)){
						if($res_dye_plan['content']==$res_ycolor1['content_name']){	?>
						<option selected  value="<?php echo $res_ycolor1['content_name'];?>"><?php echo $res_ycolor1['content_name'];?></option>
						<?php } else { ?>
						<option value="<?php echo $res_ycolor1['content_name'];?>"><?php echo $res_ycolor1['content_name'];?></option>
						<?php } ?>
					<?php } ?>
				</select> 
			</td>
			<td><input type="text" name="dia[]"  class="form-control" id="dia"  onKeyUp="multiply()" required autocomplete="off" value="<?php echo $res_dye_plan['dia'];?>"></td>
				<td>
					<input type="text" name="gsm[]"  class="form-control " id="gsm" required onKeyUp="multiply_loss()"  value="<?php echo $res_dye_plan['gsm'];?>">
				</td>
				
				<td>
										<select class="select2 form-control custom-select chosen-select" name="ycomp[]" id="ycomp<?php echo $co;?>">
										<option value="">Select</option>
										<?php $selcomp = mysqli_query($zconn,"select * from components where status='0'");
										while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
											if($res_dye_plan['ycomp']==$res_comp['comp_name']){
										?>
										<option selected value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } 
										} ?>
										</select>
										</td>
										<td>
            <input type="text" name="gram_component[]" class="form-control gram_component" onKeyUp="calculateWeight(this)" required autocomplete="off" value="<?php echo $res_dye_plan['gram_component'];?>">
        </td>
        <td>
           
            <input type="text" name="excess_cal[]" class="form-control"  value="<?php echo $res_dye_plan['excess_cal'];?>">
        </td>
        <td>
            <input type="text" name="weight[]" class="form-control weight" readonly autocomplete="off" value="<?php echo $res_dye_plan['weight'];?>">
        </td>
			<td>
					<input type="text" name="dye_loss[]"  class="form-control dye_loss" id="dye_loss" required onKeyUp="multiply_loss()">
									</td>
									<td>
					<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
				</td>
				

		<?php $p++; } 
		$sel_master = mysqli_fetch_array(mysqli_query($zconn,"select * from dyeing_planning_master where id='".$_REQUEST['id']."'"),MYSQLI_ASSOC);;

		?>
        </tbody>

	<tr id="">
	<td></td>
	<td></td>
    <td></td>
	<td></td>
    <td></td>
	<td></td>
    <td></td>

	<td>
	  <h6 class="page-title">Total:</h6></td>
	<td>
	<input type="text" class="form-control" id="grand_total" name="grand_total" readonly placeholder="" style="border: 1px solid #000;" value="<?php echo $sel_master['grand_total'];?>">
	</td>
	<td></td>
											</tr>
										
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" name="save" class="btn btn-success" value="<?php echo $action;?>">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="dyeing_planning_list.php"><button type="button" class="btn btn-danger">List</button></a>
								</div>
							</div>
                            </tbody>
									</table>
				 </div>
				 </div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body"> </div>
                            <div class="container-fluid">
                                <div class="form-group row1">
                                     <div id="demo"></div>
                                 </div>
                             </div>
                        </div>
                    </div>
                 </div>

                 <?php } ?>
                </form>
            <!-- End Container fluid  -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->
    <!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php');?>
            <!-- End footer -->
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

    <script src="dist/js/custom.min.js"></script>
	<?php

		$sel_fabrics = mysqli_query($zconn,"select * from fabric_master where status='0'");
		$fabslist= '';
		while($res_fabrics = mysqli_fetch_array($sel_fabrics,MYSQLI_ASSOC)){
			$fabslist .='<option value="'.$res_fabrics['fabric_name'].'">'.addslashes($res_fabrics['fabric_name']).'</option>';
		}

	    $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
	    $color_list='';
		while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
			$color_list .='<option value="'.$res_ycolor['colour_name'].'">'.$res_ycolor['colour_name'].'</option>';
		}

		$selcomp = mysqli_query($zconn,"select * from components where status='0'");
		$comp_list='';
		while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
			$comp_list .='<option value="'.$res_comp['comp_name'].'">'.$res_comp['comp_name'].'</option>';
		}

        $sel_ycolor1 = mysqli_query($zconn,"select * from content_master where status='0'");
        $cont_list='';
        while($res_ycolor1 = mysqli_fetch_array($sel_ycolor1,MYSQLI_ASSOC)){
        $cont_list .='<option value="'.$res_ycolor1['content_name'].'">'.$res_ycolor1['content_name'].'</option>';
    }
?>
<script type="text/javascript">
$(document).ready(function(){
	//$('.left-sidebar').slideToggle();
});

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#example1 td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		var index = $("table tbody tr:last-child").index();
		var newc = parseInt(index)+parseInt(1);
        var row = '<tr >' +
            '<td><select class="select2 form-control custom-select" name="fabric_name[]" id="fabric_name'+newc+'"><option>Select</option><?php echo $fabslist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="ycolor'+newc+'" name="ycolor[]"><option> Select</option><?php echo $color_list;?></select></td>' +
			'<td><select class="select2 form-control custom-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $cont_list;?></select></td>' +
			'<td><input type="text" name="dia[]"  class="form-control" id="dia"  onKeyUp="multiply()" required autocomplete="off"></td>' +
			'<td><input type="text" name="gsm[]"  class="form-control " id="gsm" required onKeyUp="multiply_loss()"></td>' +
			'<td><select class="select2 form-control custom-select chosen-select" name="ycomp[]" id="ycomp'+newc+'"><option>Select</option><?php echo $comp_list;?></select></td>' +
			'<td><input type="text" name="gram_component[]" class="form-control gram_component" onKeyUp="calculateWeight(this)" required autocomplete="off"></td>' +
			'<td><?php echo $excess_cal; ?> <input type="hidden" name="excess_cal[]" class="form-control" value="<?php echo $order['order_qty'] + $exc_cal; ?>"></td>' +
			'<td> <input type="text" name="weight[]" class="form-control weight" readonly autocomplete="off"></td>'+
			'<td><input type="text" name="dye_loss[]"  class="form-control dye_loss" id="dye_loss" required onKeyUp="multiply_loss()"></td>'+
			'<td><a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
    	$("#example1").append(row);
		$("#example1 tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });

	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		$(".add-new").removeAttr("disabled");
    });
});




// To get buyer short name for costing number
function sum_grand(){
	var sum = 0;
	$('.totl').each(function(){
		sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
	});
	if(sum==NaN){
		$('#grand_total').val('0');	
	} else {
		$('#grand_total').val(sum.toFixed(2));
	}
}

function buyer_costing(sh_name){
	var sname = sh_name.split('~~');
	var cno = $('#cost_no').val();
	var nc = sname['0']+"-"+cno;
	$('#costing_no').val(nc);
	sum_grand();
}

function cal_yarn_pcs(id){
    var t1 = document.getElementById('consumption_val'+id).value;
	var t2 = document.getElementById('consumption_per'+id).value;
    var t3 = ((parseFloat(t1))*(parseFloat(t2)/100));
	document.getElementById('pcs_weight'+id).value=parseFloat(t3).toFixed(3);
	//input_sum_calculate_yarn_amount(id);
	sum_grand();
}

function cal_amount(id) {
    var t1 = document.getElementById('pcs_weight'+id).value;
    var t2 = document.getElementById('yrate'+id).value;
    var t3 = parseFloat(t1)*parseFloat(t2);
	document.getElementById('ytotal'+id).value = parseFloat(t3).toFixed(2);
  //  input_sum_calculate_yarn();
  sum_grand();
}


	
	

	
	
	
	function multiply_loss(){
	var sum=0;
	var twgt = $('#totweight').val();
	$('.dye_loss').each(function(index, element){
		if($(element).val()!="")
			sum += parseFloat($(element).val());
	});
	 $('#total_dye_loss').val(sum.toFixed(2));
}
	
	function multiply(){
	var sum=0;
	var twgt = $('#totweight').val();
	$('.pcs_weight').each(function(index, element){
		if($(element).val()!="")
			sum += parseFloat($(element).val());
	});

	if(parseFloat(sum)>parseFloat(twgt)){
		$('#grand_total').css('border-color', 'red');
	 } else {
		 $('#grand_total').css('border-color', '#000');
	 }
		 $('#grand_total').val(sum.toFixed(2));
}
	
function calculatePercentageLoss() {
  // Calculate the total pcs weight and total dye loss
  var totalPcsWeight = 0;
  var totalDyeLoss = 0;

  // Calculate the total pcs weight and total dye loss
  $('.pcs_weight').each(function(index, element) {
    var pcsWeight = parseFloat($(element).val()) || 0;
    totalPcsWeight += pcsWeight;
  });

  $('.dye_loss').each(function(index, element) {
    var dyeLoss = parseFloat($(element).val()) || 0;
    totalDyeLoss += dyeLoss;
  });

  console.log("Total Pcs Weight: " + totalPcsWeight); // Log total pcs weight
  console.log("Total Dye Loss: " + totalDyeLoss); // Log total dye loss
  
  // Calculate the percentage loss
  var percentageLoss = (totalDyeLoss /100 ) * totalPcsWeight || 0;
  
  console.log("Percentage Loss: " + percentageLoss.toFixed(2) ); // Log percentage loss
  
  // Calculate the adjusted Total Pcs Weight
  var adjustedTotalPcsWeight = totalPcsWeight - percentageLoss ;
  
  console.log("Adjusted Total Pcs Weight: " + adjustedTotalPcsWeight); // Log adjusted total pcs weight

  // Set the Percentage Loss value as the result string
  $('.percentage_loss').val(adjustedTotalPcsWeight.toFixed(2) );
  
  // Display the adjusted Total Pcs Weight
  $('.adjusted_total_pcs_weight').val(adjustedTotalPcsWeight.toFixed(2));
}

// Call the calculatePercentageLoss function when inputs change
$('.pcs_weight, .dye_loss').on('input', calculatePercentageLoss);




</script>









<script type="text/javascript">
    function calculateWeight(input) {
        var row = input.closest('tr');
        var gramComponentInput = row.querySelector(".gram_component");
        var excessCalInput = row.querySelector("input[name='excess_cal[]']");
        var weightInput = row.querySelector(".weight");

        var gramComponentValue = parseFloat(gramComponentInput.value);
        var excessCalValue = parseFloat(excessCalInput.value);

        if (!isNaN(gramComponentValue) && !isNaN(excessCalValue)) {
            var result = gramComponentValue * excessCalValue;
            weightInput.value = result;
        } else {
            weightInput.value = "";
        }
    }
</script>






<script type="text/javascript">

// function checkval(){
// 			var tw = $('#totweight').val();
// 			var gr = $('#grand_total').val();
// 			if(tw!=gr){
// 				alert("Planning Total must be equal to Total Weight");
// 				return false;
// 			} else {
// 				document.getElementById("dye_planning").submit();
// 			}
// 		}
// $(document).ready(function(){
//     //$('.left-sidebar').slideToggle();
// });


    $(document).ready(function(){
                $('#sel_buyer').change(function(){
                     var sel_buyer=document.getElementById('sel_buyer').value;
                    $.ajax({
                        type: "POST",
                        url:  "select_styleno.php",
                        data: {sel_buyer: $('#sel_buyer').val()},
                        success: function(data){
                            $("#style").html(data);
                        }
                    });
                });
            });

    $(document).ready(function(){
                $('#style').change(function(){
                     var style=document.getElementById('style').value;
					 var ord = document.getElementById('sel_buyer').value;
                    $.ajax({
                        type: "POST",
                        url:  "combogroup.php",
                        data: {style: $('#style').val(),ord:ord},
                        success: function(data){
                            $("#component").html(data);
                        }
                    });
                });
            });

function myFunction(){
    var form = document.manu;
    var dataString = $(form).serialize();

    alert(dataString);
    $('#suggestion').html('<img src="ajax_entry/loader.gif" width="214" height="138">');
    $.ajax({
        type:'POST',
        url:'planing_dyeing_table.php',
        data: dataString,
        success: function(data){
            $('#suggestion').html(data);
        }
    });
    return false;
    }

function myFunction() {
    var c = document.getElementById("component").value;
    var s = document.getElementById("style").value;
    var b = document.getElementById("sel_buyer").value;
       $.ajax({
         type:'POST',
         url:'planing_dyeing_table.php',
         data:{ c:c,s:s,b:b}, 
         success:function(data){
			// alert(data);
             $("#demo").html(data);
            }
          });
    // document.getElementById("demo").innerHTML = "You selected: " + c;
}

function multiply() {
  var sum = 0;
  var twgt = $('#totweight').val();
  var loss = 0; // Initialize the loss variable
  
  // Calculate the sum of "pcs_weight" inputs
  $('.pcs_weight').each(function(index, element) {
    if ($(element).val() != "") {
      sum += parseFloat($(element).val());
    }
  });
  
  // Calculate the sum of "dye_loss" inputs
  $('.dye_loss').each(function(index, element) {
    if ($(element).val() != "") {
      loss += parseFloat($(element).val());
    }
  });
  
  // Add the loss to the sum
  sum += loss;

  if (parseFloat(sum) > parseFloat(twgt)) {
    $('#grand_total').css('border-color', 'red');
  } else {
    $('#grand_total').css('border-color', '#000');
  }

  // Set the grand_total value
  $('#grand_total').val(sum);
}

</script>


</body>
</html>