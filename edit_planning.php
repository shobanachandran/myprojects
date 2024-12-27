<?php 
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);


if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

$sel_knit = mysqli_fetch_array(mysqli_query($zconn,"select * from knitting_planning_master where id='".$_REQUEST['id']."'"),MYSQLI_ASSOC);
	$sel_costing = mysqli_query($zconn,"select * from costing_entry_master where order_no='".$sel_knit['order_no']."' and style_no='".$sel_knit['style_no']."'");
$costing_row = mysqli_num_rows($sel_costing);


if(isset($_POST['save'])=='save'){
    $knit_loss=0;
    $fabcount = count($_POST['fabric_name']);
    for($i=0;$i<$fabcount;$i++){
       $knit_loss +=$_REQUEST['knit_loss'][$i];
    }

    $order =$_POST['order_no'];
    $style_no=$_POST['style_no'];
    $ins_details_master = mysqli_query($zconn,"update  knitting_planning_master set knit_loss='".$knit_loss."',grand_total='".$_REQUEST['grand_total']."' where id='".$_REQUEST['id']."' and order_no='".$order."' and style_no='".$style_no."'");

    $trows = count($_POST['fabric_name']);
	// $del_old = mysqli_query($zconn,"delete from knitting_planning where order_no='".$order."' and style_no='".$style_no."'");
    for($tr=0;$tr<$trows;$tr++){
		        // $ins_details = mysqli_query($zconn,"update set knitting_planning(fabric_name,knitt_id,content,color,dia,gsm,f_dia,f_gsm,Gauge,Loop_Length,wgt,grand_total,order_no,style_no,component_group,knit_loss,pcs_weight,total_weight) values('".$_POST['fabric_name'][$tr]."','".$_REQUEST['id']."','".$_POST['content'][$tr]."','".$_POST['ycolor'][$tr]."','".$_POST['dia'][$tr]."','".$_POST['gsm'][$tr]."','".$_POST['f_dia'][$tr]."','".$_POST['f_gsm'][$tr]."','".$_POST['gauge'][$tr]."','".$_POST['loop'][$tr]."','".$_POST['weight'][$tr]."','".$_POST['grand_total']."','".$order."','". $style_no."','".$_POST['component']."','".$_POST['knit_loss'][$tr]."','".$_POST['pcs_weight'][$tr]."','".$_POST['totweight'][$tr]."')");
        $ins_details = mysqli_query($zconn,"update  knitting_planning set fabric_name='".$_POST['fabric_name'][$tr]."',knitt_id='".$_REQUEST['id']."',content='".$_POST['content'][$tr]."',color='".$_POST['ycolor'][$tr]."',dia='".$_POST['dia'][$tr]."',gsm='".$_POST['gsm'][$tr]."',f_dia='".$_POST['f_dia'][$tr]."',f_gsm='".$_POST['f_gsm'][$tr]."',Gauge='".$_POST['gauge'][$tr]."',Loop_Length='".$_POST['loop'][$tr]."',wgt='".$_POST['weight'][$tr]."',grand_total='".$_POST['grand_total']."',order_no='".$order."',style_no='". $style_no."',component_group='".$_POST['component']."',knit_loss='".$_POST['knit_loss'][$tr]."',pcs_weight='".$_POST['pcs_weight'][$tr]."',knit_loss='".$_POST['knit_loss'][$tr]."'where knitt_id='".$_REQUEST['id']."' and order_no='".$order."' and style_no='".$style_no."' and id='".$_REQUEST['kid'][$tr]."'");
    }

		if($ins_details){
			echo "<script>alert('Updated Successfully!!!');</script>";
			echo "<script>window.location.href='knitting_planning_list.php';</script>";
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

     $sel_knitting =mysqli_fetch_array(mysqli_query($zconn,"select * from knitting_planning_master where id='$id' "));


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
    <title><?php echo SITE_TITLE;?> - Knitting Planning Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
	<style>
	.table td, .table th{padding:0px !important; font-size:14px;}
	</style>
    <style>
        /* CSS for the container */
        .scroll-container {
            width: 100%; /* Set the width as needed */
            overflow-x: auto; /* Enable horizontal scrolling */
        }
		.hidden {
    display: none;
}
.table-container {
            width: 100%; /* Set the width as needed */
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Prevent text wrapping */
        }

        th {
            font-size: 12px;
            font-weight: bold;
            background-color: #626F80;
            color: #fff;
            text-align: center;
        }

    </style>
</head>
<body>
    <div id="main-wrapper" data-sidebartype="mini-sidebar" class="mini-sidebar">
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
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Knitting Planning Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item " aria-current="page">Merch</li>
									
									<li class="breadcrumb-item active" aria-current="page"><a href="planning.php">Process Palnning</a></li>
                                </ol>
                            </nav>
                        </div>
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
			<form action="" method="POST" >
			  <input type="hidden" name="cost_no" id="cost_no" value="<?php echo $cost_no;?>">
				<input type="hidden" name="edit_id" id="edit_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
								<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
										<div class="col-sm-6">
                                        <?php
                                          $id=$_GET['id'];
                                          $style=$sel_buyer['order_no'];
                                          $select=mysqli_fetch_array(mysqli_query($zconn,"select * from knitting_planning_master where id='$id'"));
										
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
                <th>Pcs weight</th>
                <th>Order Quantity + Excess</th>
                <th>Total Weight [KGS]</th>
        <!-- <th>Total knitting Loss</th> -->
            </tr>
        </thead>
        
             <?php
                   $yarnDet=mysqli_query($zconn,"select * from knitting_planning_master WHERE id = '".$_REQUEST['id']."' order by id asc ");
                        $cnt=1;
                        while($Det = mysqli_fetch_object($yarnDet)) {
                            $fabric_name=$Det->fabric_name;

                            // echo "SELECT * FROM `knitting_planning` WHERE `knitt_id`='".$_REQUEST['id']."'";
                            // $Name = mysqli_fetch_object(mysqli_query($zconn,"SELECT * FROM `knitting_planning` WHERE `knitt_id`='".$_REQUEST['id']."'"));
                            ?>
                                <tr class="form-group has-success">
                                    <td><?php  echo $select['order_no'];?></td>
                                    <td><?php  echo $select['style_no'];?></td>
                                    <!-- <td class="w-150&quot;">
                                        <input type="text" name="fabric" id="fabric" autocomplete="off" class="form-control" value="<?php echo $fabric_name;?>" readonly="">
                                    </td> -->
                                    <td class="w-250&quot;">
                                        <input type="text" name="yarn_pcs_weight[]" id="yarn_color_0" autocomplete="off" class="form-control" value="<?php echo number_format($Det->pcs_weight,2);?>" readonly=""> 
                                    </td>
                                    <td class="w-150">
                                        <input type="text" name="yarn_qty_total[]" id="yarn_grp_0" autocomplete="off" class="form-control" value="<?php echo $Det->order_qty;?>" readonly=""> 
                                    </td>
                                    <td class="w-150">
                                        <input type="text" name="yarn_total_weight[]" id="yarn_comp_0" autocomplete="off" class="form-control" value="<?php echo $Det->grand_total;?>" readonly=""> 
                                    </td>
                                  <!--  <td class="w-150">
                                        <input type="text" readonly autocomplete="off" class="form-control" value="<?php echo $Det->knit_loss;?>"  required /> 
                                    </td>-->
                                </tr>
                                <?php
                        $cnt++;
                        } ?>
        
    </table>
<?php } ?>
    <br />
    <hr>
    <legend><h4> Knitting Planning Details</h4></legend>
    <div class="table-container" >
<table id="example1" style="width:200%">

        <thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
            <tr>
                <th style="width:10%">Fabric Name</th>
                <th style="width:10%">Content</th>
                <th style="width:10%">Colour</th>
                <th style="width:10%">DIA</th>
                <th style="width:10%">GSM</th>
                <th style="width:10%">F DIA</th>
                <th style="width:10%">F GSM</th>
                <th style="width:10%">Gauge</th>
                <th style="width:10%">L.Length</th>
				<th style="width:10%">Pcs.wgt</th>
                <th style="width:10%">WGT</th>
                <th style="width:10%">K.Loss</th>

                 <th style="width:10%"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th> 
            </tr>
        </thead>
        <tbody>
		<?php 
		$sel_planning= mysqli_query($zconn,"select * from knitting_planning where knitt_id='".$_GET['id']."'");
		$list_id=0;
		$tot_knit_loss=0;
		while($res_planning = mysqli_fetch_array($sel_planning,MYSQLI_ASSOC)){
			$tot_knit_loss = $tot_knit_loss+$res_planning['knit_loss'];
		?>
        
        <tr >
        <td  style="width:10%">
        <input type="hidden" name="kid[]" value="<?php echo $res_planning['id'];?>">
			<?php $sel_fabric = mysqli_query($zconn,"select * from fabric_master where status='0'");?>
					 <select name="fabric_name[]" id="fabric_name0" class="select2 form-control custom-select chosen-select">
					 <option value="">--Select--</option>
					 
					 <?php
							while($res_fabric = mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){
								if($res_planning['fabric_name'] == $res_fabric['fabric_name']){
					 ?>
					  <option selected value="<?php echo $res_fabric['fabric_name'];?>"><?php echo $res_fabric['fabric_name'];?></option>
					<?php } else { ?>
					 <option value="<?php echo $res_fabric['fabric_name'];?>"><?php echo $res_fabric['fabric_name'];?></option>
					<?php } } ?>
				</select>
                                   </td>
                                   <td  style="width:10%">
                                     <select name="content[]" id="content0" class="select2 form-control custom-select chosen-select">
                                            <option>Select</option>
								<?php $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
								while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
								if($res_content['content_name']==$res_planning['content']){
									?>
									<option  value="<?php echo $res_content['content_name'];?>" selected><?php echo $res_content['content_name'];?></option>
								<?php } else { ?>
									<option value="<?php echo $res_content['content_name'];?>"><?php echo $res_content['content_name'];?></option>

								<?php } }?>
								</select>
                                <script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
								</td>

                                    <td  style="width:10%">
                                         <!--<input type="text" class="form-control" name="ycolor[]" readonly id="ycolor0" value="<?php echo $res_planning['color'] ?>"> -->
                                        <select class="select2 form-control custom-select" name="ycolor[]" id="ycolor0">
                                            <option value="">Select</option>
                                            <?php
                                            $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
                                            while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
												if($res_ycolor['colour_name']==$res_planning['color']){ ?>
                                                <option selected value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
												<?php } else { ?>
												<option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
												<?php }?>
                                            <?php } ?>
                                        </select>
                                    </td>
                                  <td  style="width:10%">
                                    <select class="select2 form-control custom-select" id="dia" name="dia[]">
                                        <?php $sel_ycounts = mysqli_query($zconn,"select * from dia_master where status='0'");
                                        while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
											if($res_ycounts['dia_name']==$res_planning['dia']){ ?>
                                            <option value="<?php echo $res_ycounts['dia_name'];?>" selected ><?php echo $res_ycounts['dia_name'];?></option>
											<?php } else { ?>
												<option value="<?php echo $res_ycounts['dia_name'];?>"><?php echo $res_ycounts['dia_name'];?></option>

                                        <?php } }?>
                                     </select>
                                  </td>
                                  <td  style="width:10%">
                                    <select class="select2 form-control custom-select" id="gsm" name="gsm[]">
                                        <?php $sel_ycounts = mysqli_query($zconn,"select * from gsm_master where status='0'");
                                        while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
											if($res_ycounts['gsm_name']==$res_planning['gsm']){ ?>
                                            <option value="<?php echo $res_ycounts['gsm_name'];?>" selected ><?php echo $res_ycounts['gsm_name'];?></option>
											<?php } else { ?>
												<option value="<?php echo $res_ycounts['gsm_name'];?>"><?php echo $res_ycounts['gsm_name'];?></option>

                                        <?php } }?>
                                     </select>
                                  </td>
                                  <td  style="width:10%">
                                        <select class="select2 form-control custom-select" id="f_dia" name="f_dia[]">
                                        <?php $sel_ycounts = mysqli_query($zconn,"select * from dia_master");
                                        while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
											if($res_ycounts['dia_name']==$res_planning['dia']){ ?>
												<option selected value="<?php echo $res_ycounts['dia_name'];?>"><?php echo $res_ycounts['dia_name'];?></option>
											<?php  } else { ?>
											<option value="<?php echo $res_ycounts['dia_name'];?>"><?php echo $res_ycounts['dia_name'];?></option>

                                        <?php } } ?>
                                        </select>
                                        </td>
                                   <td  style="width:10%">
                                        <select class="select2 form-control custom-select" name="f_gsm[]" id="f_gsm">
                                             <option value="<?php echo $res_planning['f_gsm'];?>"><?php echo $res_planning['f_gsm'];?></option>
                                            <option value="">Select</option>
                                                <?php
                                                    $sel_ycolor = mysqli_query($zconn,"select * from  gsm_master");
                                                    while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
													if($res_ycolor['gsm_name']==$res_planning['gsm']){ ?>
														<option selected value="<?php echo $res_ycolor['gsm_name'];?>"><?php echo $res_ycolor['gsm_name'];?></option>
													<?php } else { ?>
														<option value="<?php echo $res_ycolor['gsm_name'];?>"><?php echo $res_ycolor['gsm_name'];?></option><?php } ?>
                                                    <?php } ?>
                                        </select>
                                    </td>
                                        <td  style="width:10%">
                                        <input type="text" class="form-control" id="gauge" name="gauge[]" autocomplete="off" value="<?php echo $res_planning['Gauge'];?>">
                                        </td>
                                        <td  style="width:10%">
                                        <input type="text" class="form-control" id="loop" name="loop[]" autocomplete="off" value="<?php echo $res_planning['Loop_Length'];?>">
                                        </td>
										<td  style="width:10%">
<?php  $ronly='';if($costing_row>0){ $ronly='readonly';} else {$ronly='';}?>
										<input type="text" class="form-control" id="pcs_weight" <?php echo $ronly;?> name="pcs_weight[]" autocomplete="off" value="<?php echo number_format($res_planning['pcs_weight'],2);?>">
										</td>
                                        <td  style="width:10%">
										
                                        <input type="text" class="form-control weight" <?php echo $ronly;?> id="weight" name="weight[]" onKeyUp="multiply()" autocomplete="off" value="<?php echo $res_planning['wgt'];$totwgt+=$res_planning['wgt'];?>">
                                        </td>
                                       <td  style="width:10%">
                                        <input type="text" class="form-control knit_loss"  id="knit_loss" name="knit_loss[]" onKeyUp="multiplykl()" autocomplete="off" value="<?php echo $res_planning['knit_loss'];?>">
                                        </td>
                                        <td  style="width:10%">
			<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
		</td>
                                        
        </tr>            
								<?php } ?>
                               

                                                    </tbody>
                                                    </table>
                                                    </div>
						</div>
                                                

                                                    <table class="table table-striped table-bordered">
				<tr id="">
					<td width="50%">&nbsp;</td>
					<td width="15%"> </td>
					<td width="15%">
					  <h6 class="page-title">Total:</h6></td>
					  <td width="8%">
                                                
                                            <input type="text" class="form-control" id="grand_total" name="grand_total" readonly placeholder="" value="<?php echo number_format($totwgt,2);?>" style="border: 1px solid #000;">
                                                </td>
                                                <td>
													 <input type="text" class="form-control" id="tot_knit_loss" name="tot_knit_loss" readonly placeholder="" value="<?php echo number_format($tot_knit_loss,2);?>" style="border: 1px solid #000;">
                                                </td>
					<td width="7%">		

                                            </tr>
			</table>
                                            
                                    </table>
                            <div class="border-top">
                                <div class="card-body" style="margin-left: 250px;">
                                    <button type="submit" name="save"  class="btn btn-success" value="<?php echo $action;?>">Save</button>
                                    <button type="reset" class="btn btn-primary">Reset</button>
                                    <a href="knitting_planning_list.php"><button type="button" class="btn btn-danger">List</button></a>
                                </div>
                            </div>
                                                    </tbody>
</table>
                                                    </div>
                                                    </div>
                                                    </div>
                                                    </div>
                 <?php } ?>

				</form>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <br>
    <br>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php');?>


            <!-- End footer -->
    <!-- ============================================================== -->
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
	<script src="dist/js/custom.min.js"></script>
	<?php
		 $sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
		 $ynamelist= '';
		 while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
		  $ynamelist .='<option value="'.$res_yname['yarn_name'].'">'.$res_yname['yarn_name'].'</option>';
		  }

		 $sel_ycounts = mysqli_query($zconn,"select * from dia_master where status='0'");
		 $ycountlist= '';
		 while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ycountlist .='<option value="'.$res_ycounts['dia_name'].'">'.addslashes($res_ycounts['dia_name']).'</option>';
		 }

		$sel_ycount = mysqli_query($zconn,"select * from dia_master where status='0'");
		$ytype ='';
		while($res_ycount = mysqli_fetch_array($sel_ycount,MYSQLI_ASSOC)){
			$ytype ='<option value="'.$res_ycount['f_dia'].'">'.$res_ycount['f_dia'].'</option>';
		}

		$sel_ycoun = mysqli_query($zconn,"select * from gsm_master where status='0'");
		$ygsm ='';
		while($res_ycoun = mysqli_fetch_array($sel_ycoun,MYSQLI_ASSOC)){
			$ygsm .='<option value="'.$res_ycoun['gsm_name'].'">'.addslashes($res_ycoun['gsm_name']).'</option>';
		}

	   $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
	   $color_list='';
		while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
			$color_list .='<option value="'.$res_ycolor['colour_name'].'">'.$res_ycolor['colour_name'].'</option>';
		}

		$sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
		$content_list='';
		while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
			$content_list .='<option value="'.$res_content['content_name'].'">'.$res_content['content_name'].'</option>';
		 }

		$selcomp = mysqli_query($zconn,"select * from fgsm_master");
		$comp_list='';

		while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
			$fgsm .='<option value="'.$res_comp['f_gsm'].'">'.$res_comp['f_gsm'].'</option>';
		}
		if($costing_row>0){
			$cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);

			$get_cos = mysqli_query($zconn,"SELECT distinct(fabric_name) FROM `costing_entry_details` where costing_id='".$cos['id']."'");

				while($resc = mysqli_fetch_array($get_cos,MYSQLI_ASSOC)){
				  $fabric .='<option value="'.$resc['fabric_name'].'">'.$resc['fabric_name'].'</option>';
				}
		}  else {
				$sel_fab = mysqli_query($zconn,"SELECT * FROM `fabric_master`
where status='0'");
				while($resc = mysqli_fetch_array($sel_fab,MYSQLI_ASSOC)){
				  $fabric .='<option value="'.$resc['fabric_name'].'">'.$resc['fabric_name'].'</option>';
				}
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
        var row = '<tr>' +
            '<td><select class="select2 form-control custom-select" name="fabric_name[]" id="fabric_name'+newc+'"><option>Select</option><?php echo $fabric;?></select> </td>' + 
			'<td><select class="select2 form-control custom-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $content_list;?></select></td>'+ 
            '<td><select class="select2 form-control custom-select" name="ycolor[]" id="ycolor'+newc+'"><option>Select</option><?php echo $color_list;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="dia'+newc+'" name="dia[]"><option> Select</option><?php echo $ycountlist;?></select></td>' +
			'<td><select class="select2 form-control custom-select" id="gsm'+newc+'" name="gsm[]"><option> Select</option><?php echo $ygsm;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="f_dia'+newc+'" name="f_dia[]"><option>Select</option><?php echo $ycountlist;?></select></td>'  +
           '<td><select class="select2 form-control custom-select" name="f_gsm[]" id="f_gsm'+newc+'"><option>Select</option><?php echo $ygsm;?></select></td>' +
		   '<td><input type="text" class="form-control" name="gauge[]" id="gauge'+newc+'"></td>' +
            '<td><input type="text" class="form-control" name="loop[]" id="loop'+newc+'" ></td>' +
			'<td><input type="text" class="form-control" id="pcs_weight" name="pcs_weight[]" autocomplete="off"></td>'+
	        '<td><input type="text" class="form-control weight" id="weight'+newc+'" name="weight[]" onKeyUp="multiply()" ></td>' +
			'<td><input type="text" name="knit_loss[]"  class="form-control knit_loss" id="knit_loss'+newc+'" onKeyUp="multiplykl()" required></td>'+
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
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
		//	if(!$(this).val()){
		//		$(this).addClass("error");
		//		empty = true;
		//	} else{
        //        $(this).removeClass("error");
        //    }
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
		$('#grand_total').val(sum);
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
	document.getElementById('weight'+id).value=parseFloat(t3).toFixed(3);
	//input_sum_calculate_yarn_amount(id);
	sum_grand();
}

function cal_amount(id) {
    var t1 = document.getElementById('weight'+id).value;
    var t2 = document.getElementById('yrate'+id).value;
    var t3 = parseFloat(t1)*parseFloat(t2);
	document.getElementById('ytotal'+id).value = parseFloat(t3).toFixed(2);
  //  input_sum_calculate_yarn();
  sum_grand();
}

function multiply(){
	var sum=0;
	$('.weight').each(function(index, element){
	if($(element).val()!="")
	    sum += parseFloat($(element).val());
	});
	$('#grand_total').val(sum);
}
// function multiply(){
// 	var sum=0;
// 	$('.knit_loss').each(function(index, element){
// 	if($(element).val()!="")
// 	    sum += parseFloat($(element).val());
// 	});
// 	$('#grand_total').val(sum);
// }

</script>

</body>
</html>