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

if(isset($_POST['save'])=='save'){

    $order=$_POST['order'];
    $style=$_POST['style_no'];

    $ins_details_master = mysqli_query($zconn,"insert into dyeing_planning_master
    (fabric_name,order_no,style_no,order_qty,grand_total,tot_loss) values('".$_POST['fabric_name']."',
    '".$order."','".$_POST['style_no']."','".$_POST['order_qty']."','".$_POST['grand_total']."',
    '".$_POST['total_dye_loss']."')");
    $dye_id = mysqli_insert_id($zconn);

    $trows = count($_POST['fabric_name']);
    for($tr=0;$tr<$trows;$tr++){
        $ins_details = mysqli_query($zconn, "insert into dyeing_planning(fabric_name,color,dia,
        lab_no,wgt,grand_total,order_no,style_no,component_group,dye_loss,dye_id) 
        values('".$_POST['fabric_name'][$tr]."','".$_POST['ycolor'][$tr]."',
        '".$_POST['dia'][$tr]."','".$_POST['lab'][$tr]."',
        '".$_POST['pcs_weight'][$tr]."','".$_POST['grand_total']."',
        '".$order."','".$_POST['style_no']."','".$_POST['component']."',
        '".$_POST['dye_loss'][$tr]."','".$dye_id."')");
    }
}

if($ins_details){
    echo "<script>alert('Added Successfully!!!');</script>";
    echo "<script>window.location.href='dyeing_planning_list.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - Dyeing Planning Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">
    <link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
    <style>
    .table td, .table th{padding:0px !important; font-size:14px;}
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
                        <h4 class="page-title"></h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="planning.php"> <button type="button" class="btn btn-info">Process Planning</button></a>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item " aria-current="page">Merch</li>
									
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
               <input type="hidden" name="cost_id" id="cost_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                                <div class="card-body" style="width:100%">
                                    <div class="card-body" style="width:100%">
                                <div class="card" style="width:50%; float:left; left: 50px; ">
                                <div class="form-group row">
                                        <label for="fname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
                                        <div class="col-sm-6">
                                        <select class="select2 form-control custom-select chosen-select" name="order" id="order"  required>
                                        <option value="">Select</option>
                                        <?php

									  $order = mysqli_query($zconn,"select * from order_entry_master where (`order_no`,`style_no`) NOT IN(select order_no,style_no from dyeing_planning_master) and (`order_no`,`style_no`) IN (select order_no,style_no from process_planning_flow)");

										while($res_buyer = mysqli_fetch_array($order,MYSQLI_ASSOC)){
											if($res_cost['buyer_id']==$res_buyer['order_no']){  ?>
											<option selected value="<?php echo $res_buyer['order_no'];?>"><?php echo $res_buyer['order_no'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_buyer['order_no'];?>"><?php echo $res_buyer['order_no'];?></option>
											<?php } ?>
										<?php } ?>
									</select>
                                    
                                        </div>
                                    </div>
									<div class="form-group row">
                                        <label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
                                        <div class="col-sm-6" id="style_no">
                                            <select class="select2 form-control custom-select chosen-select" name="style_no" id="style" onchange=" myFunction()">
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

                <!-- Sales chart -->
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
    
<script type="text/javascript">
$(document).ready(function(){
    //$('.left-sidebar').slideToggle();
});


    $(document).ready(function(){
                $('#order').change(function(){
                     var order=document.getElementById('order').value;
                    $.ajax({
                        type: "POST",
                        url:  "select_dying.php",
                        data: {order: $('#order').val()},
                        success: function(data){
                            $("#style").html(data);
                        }
                    });
                });
            });



</script>



<script>
	function checkval(){
		var tw = $('#totweight').val();
		var gr = $('#grand_total').val();
		if(tw!=gr && tw>0 && gr>0){
			alert("Planning Total must be equal to Total Weight");
			return false;
		} else {
			document.getElementById("dye_planning").submit();
		}
	}

function myFunction() {
    var s = document.getElementById("style").value;
    var b = document.getElementById("order").value;
       $.ajax({
         type:'POST',
         url:'planing_dyeing_table.php',
         data:{s:s,b:b}, 
         success:function(data){
		//	 alert(data);
             $("#demo").html(data);
            }
          });
    // document.getElementById("demo").innerHTML = "You selected: " + c;
}
</script>


</body>
</html>