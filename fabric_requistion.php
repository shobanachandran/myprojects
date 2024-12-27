<?php 
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if(isset($_POST['save'])=='save'){
    $knit_loss=0;
    $fabcount = count($_POST['fabric_name']);
    for($i=0;$i<$fabcount;$i++){
        $fabric.=$_REQUEST['fabric_name'][$i].",";
       $knit_loss +=$_REQUEST['knit_loss'][$i];
    }
    $style = explode("~~",$_POST['sel_buyer']);
    $order = $_POST['sel_order'];
    $selected=mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='$order'"));
    $style_no=$_POST['style_no'];
    $ins_details_master = mysqli_query($zconn,"insert into knitting_planning_master(fabric_name,order_no,style_no,component_group,grand_total,knit_loss,order_qty,pcs_weight) values('".$fabric."','".$order."','". $style_no."','".$_POST['component']."','".$_POST['grand_total']."','".$knit_loss."','".$_REQUEST['order_qty']."','".$_REQUEST['pcs_weight']."')");
    $knitt_id = mysqli_insert_id($zconn);
    $trows = count($_POST['fabric_name']);
    for($tr=0;$tr<$trows;$tr++){
        $ins_details = mysqli_query($zconn,"insert into knitting_planning(fabric_name,knitt_id,content,color,dia,gsm,f_dia,f_gsm,Gauge,Loop_Length,wgt,grand_total,order_no,style_no,component_group,knit_loss,pcs_weight,total_weight) values('".$_POST['fabric_name'][$tr]."','".$knitt_id."','".$_POST['content'][$tr]."','".$_POST['ycolor'][$tr]."','".$_POST['dia'][$tr]."','".$_POST['gsm'][$tr]."','".$_POST['f_dia'][$tr]."','".$_POST['f_gsm'][$tr]."','".$_POST['gauge'][$tr]."','".$_POST['loop'][$tr]."','".$_POST['weight'][$tr]."','".$_POST['grand_total']."','".$order."','". $style_no."','".$_POST['component']."','".$_POST['knit_loss'][$tr]."','".$_POST['pcs_weight'][$tr]."','".$_POST['totweight'][$tr]."')");
        }
    }
	if($ins_details){
		echo "<script>alert('Added Successfully!!!');</script>";
		echo "<script>window.location.href='knitting_planning_list.php';</script>";
    }

if($_REQUEST['id']==''){

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
    <title><?php echo SITE_TITLE;?> - Fabric Requistion Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">

	
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
	<style>
	.table td,.table th{padding:0px !important; font-size:14px;}
	</style>
</head>
<body>
<!-- <div id="main-wrapper" data-sidebartype="full"> -->

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
                        <h4 class="page-title">Fabric Requistion Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Fabric Requistion Info</a></li>
									<li class="breadcrumb-item active" aria-current="page"><a href="requistion.php">Fabric requistion</a></li>

                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
<!--==============================================================-->
<!--==============================================================-->
            <!-- Container fluid  -->
	<div class="container-fluid">
			<!--==============================================================-->
            <!-- Sales chart -->
	<form action="" method="POST" onsubmit="return chkval();" id="knit_plan">
		<input type="hidden" name="cost_no" id="cost_no" value="<?php echo $cost_no;?>">
		<input type="hidden" name="cost_id" id="cost_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body" style="width:100%">
							<div class="card" style="width:50%; float:left; left: 50px; ">
								<div class="form-group row">
									<label for="fname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
									<div class="col-sm-6">
									<select class="select2 form-control  chosen-select" name="sel_order" id="sel_buyer" required onchange="sel_styles(this.value);">
										<option value="0">--Select--</option>
										  <?php
									  $sel_buyer = mysqli_query($zconn,"select * from order_entry_master where (`order_no`,`style_no`) NOT IN(select order_no,style_no from knitting_planning_master) and (`order_no`,`style_no`) IN (select order_no,style_no from process_planning_flow)");
									while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
										if($res_cost['order_id']==$res_buyer['order_no']){	?>
										   <option selected value="<?php echo $res_buyer['order_no'];?>"><?php echo $res_buyer['order_no'];?></option>
										   <?php } else { ?>
										   <option value="<?php echo $res_buyer['order_no'];?>"><?php echo $res_buyer['order_no'];?></option>
										   <?php } ?>
										   <?php } ?>
									</select>
									<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
									</div>
				</div>

				<div class="form-group row">
					<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
					<div class="col-sm-6" id="style_list">
					</div>
				</div>
				</div>
			</div>

                <!-- Sales chart -->
                <!-- ============================================================== -->
				</div>
                  <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="container-fluid">
                                <div class="form-group row1">
                                     <div id="demo"></div>
                                 </div>
                             </div>
                        </div>
                    </div>
                 </div>

				</form>
            <!-- End Container-fluid-->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper-->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php');?>
            <!-- End footer -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap toghether Core JavaScript -->
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
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

	<script type="text/javascript">
		$(document).ready(function() {
		$('#example').DataTable();
	});
	</script>
	<!-- <?php
		 $sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
		 $ynamelist= '';
		 while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
		  $ynamelist .='<option value="'.$res_yname['yarn_name'].'">'.$res_yname['yarn_name'].'</option>';
		  } 

		 $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
		 $ycountlist= '';
		 while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ycountlist .='<option value="'.$res_ycounts['counts_name'].'">'.addslashes($res_ycounts['counts_name']).'</option>';
		 }

		$sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
		$ytypes ='';
		while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ytypes ='<option value="'.$res_ycounts['yarn_type_name'].'">'.$res_ycounts['yarn_type_name'].'</option>';
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

		$selcomp = mysqli_query($zconn,"select * from components where status='0'");
		$comp_list='';
		while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
			$comp_list .='<option value="'.$res_comp['comp_name'].'">'.$res_comp['comp_name'].'</option>';
		}

		$sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
		$uom_list ='';
		while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
			$uom_list .='<option value="'.$res_uom['uom_name'].'">'.$res_uom['uom_name'].'</option>';
		}
		  ?> -->
<script type="text/javascript">
		function chkval(){
			var tw = $('#totweight').val();
			var gr = $('#grand_total').val();
			if(tw!=gr && tw <'0'){
				alert("Planning Total must be equal to Total Weight");
				return false;
			} else {
				document.getElementById("knit_plan").submit();
			}
		}

		$(document).ready(function(){
			//$('.left-sidebar').slideToggle();
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
			sum_grand();
		}

		function cal_amount(id) {
			var t1 = document.getElementById('pcs_weight'+id).value;
			var t2 = document.getElementById('yrate'+id).value;
			var t3 = parseFloat(t1)*parseFloat(t2);
			document.getElementById('ytotal'+id).value = parseFloat(t3).toFixed(2);
		  sum_grand();
		}

		function sel_styles(ordno){
			 $.ajax({
				type: "POST",
				url:  "select_styleno.php",
				data: {sel_buyer: ordno},
				success: function(data){
					$("#style_list").html(data);
				}
			});
		}

		function sel_comp(styleno){
			var ordid = $('#sel_buyer').val();
			$.ajax({
					url : 'combogroup.php',
					data: {
					   ord: ordid,
					   style: styleno
					},
					success: function( data ) {
						$("#component").html(data);
					},
					error: function (textStatus, errorThrown) {
						//DO NOTHINIG
					}
				});
		}

		function myFunction123(){
			var form = document.manu;
			var dataString = $(form).serialize();
			alert(dataString);
			$('#suggestion').html('<img src="ajax_entry/loader.gif" width="214" height="138">');
			$.ajax({
				type:'POST',
				url:'planing_knittting_table.php',
				data: dataString,
				success: function(data){
					$('#suggestion').html(data);
				}
			});
			return false;
			}

		function myFunction() {
			var s = document.getElementById("style").value;
			var b = document.getElementById("sel_buyer").value;
			   $.ajax({
				 type:'POST',
				 url:'planing_knittting_table.php',
				 data:{ s:s,b:b}, 
				 success:function(data){
					 $("#demo").html(data);
					}
				  });
		}
</script>

<script>
	document.getElementById('k.loss').addEventListener('input', function() {
    calculateTotalWeight();
});

// Function to calculate total_weight
function calculateTotalWeight() {
    var knitLoss = parseFloat(document.getElementById('k.Loss').value);
    var wgt = parseFloat(document.getElementById('wgt').value);

    if (!isNaN(knitLoss) && !isNaN(wgt)) {
        // Calculate total_weight after subtracting knit_loss percentage
        var totalWeight = wgt - (wgt * (knitLoss / 100));
        document.getElementById('Yarn Total').value = parseFloat(totalWeight).toFixed(3);
    } else {
        // Handle the case where knitLoss or wgt is not a valid number
        document.getElementById('Yarn Total').value = '';
    }
}

</script>






</body>
</html>