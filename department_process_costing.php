<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}
$id=$_GET['id'];
if(isset($_POST['save'])){
	extract($_POST);
	$sel_entry1 = mysqli_query($zconn,"delete from department_costing where costing_no='".$_GET['id']."'");
	if ($id!='') {
		$insert_fab_costing = mysqli_query($zconn,"update  department_costing_list set costing_no='".$costing_no."', order_no='".$_POST['order_no']."',style_no='".$_POST['style_no']."',total='".$_POST['total']."',created_by='".$_SESSION['userid']."',created_date=now(),buyer='".$_POST['buyer']."'  where costing_no='$id'");	
	}else{
	$insert_fab_costing = mysqli_query($zconn,"insert into department_costing_list(costing_no,order_no,style_no,total,created_by,created_date,buyer) values('".$costing_no."','".$_POST['order_no']."','".$_POST['style_no']."','".$_POST['total']."','".$_SESSION['userid']."',now(),'".$_POST['buyer']."')");
}
	$trows = count($_POST['department']);
	for($i=0;$i<$trows;$i++){
		$insert_fab_costing = mysqli_query($zconn,"insert into department_costing(costing_no,dept_name,uom_name,descr,rate,created_by,created_date) values('".$costing_no."','".$_POST['department'][$i]."','".$_POST['uom'][$i]."','".$_POST['descr'][$i]."','".$_POST['rate'][$i]."','".$_SESSION['userid']."',now())");
	}
	echo "<script>alert('Department cost Added successfully');</script>";
	echo "<script>window.location.href='department_costing_list.php';</script>";
}
$sel_entry1 = mysqli_fetch_array(mysqli_query($zconn,"select * from department_costing_list where costing_no='".$_GET['id']."'"),MYSQLI_ASSOC);
if(isset($_POST['costing_no'])){
	$sel_costing1= mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['costing_no']."'"),MYSQLI_ASSOC);
$sel_buyer = mysqli_fetch_array(mysqli_query($zconn,"select buyer_name from buyer_master where buyer_id='".$sel_costing1['buyer_id']."'"),MYSQLI_ASSOC);
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
    <title><?php echo SITE_TITLE;?> - Department Process Costing Entry</title>
    <!-- Custom CSS -->
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
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Department Process Costing Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="costing.php"> Costing Info</a></li>
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
				<form name="department_costing" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
							</div>
								<div class="card-body" style="width:100%">
									<div class="card-body" style="width:100%">
										<div class="card" style="width:50%; float:left; left: 50px; ">
											<div class="form-group row">
												<label for="fname" class="col-sm-3 text-right control-label col-form-label">Costing No</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select chosen-select" onchange="this.form.submit();" id="costing_no" name="costing_no">
														<option value="<?php echo $id;?>"><?php echo $id;?></option>
										<option value="">Select</option>
										<?php $sel_costing = mysqli_query($zconn,"select * from costing_entry_master");
										while($res_costing = mysqli_fetch_array($sel_costing,MYSQLI_ASSOC)){
											if($res_costing['id']==$_REQUEST['costing_no']){
										?>
										<option selected value="<?php echo $res_costing['id'];?>"><?php echo $res_costing['costing_no'];?></option>
										<?php } else  { ?>
										<option value="<?php echo $res_costing['id'];?>">
										<?php echo $res_costing['costing_no'];?> - (<?php echo $res_costing['order_no'];?>)
									</option>
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
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Indent No</label>
												<div class="col-sm-6">
													 <?php if($_REQUEST['costing_no']==''){?>
												<input type="text" class="form-control" readonly id="lname" name="order_no"  placeholder="" value="<?php echo $sel_entry1['order_no'];?>">
											<?php } else{
													?>
												<input type="text" class="form-control" value="<?php echo $sel_costing1['order_no'];?>" readonly id="order_no" name="order_no" placeholder="">
											<?php } ?> 	
												</div>
											</div>
											<div class="form-group row">
											</div>	
											<div class="form-group row">
												<h4 class="page-title"><b>Material Details</b></h4>
											</div>		
										</div>
										<div class="card" style="width:50%; float:left; right: 50px;">
											<div class="form-group row">
												<label for="fname" class="col-sm-3 text-right control-label col-form-label">Buyer name</label>
												<div class="col-sm-6">

													<?php if($_REQUEST['costing_no']==''){?>
												<input type="text" class="form-control" readonly id="lname" name="buyer" value="<?php echo $sel_entry1['buyer'];?>">
											<?php } else{
													?>
													<input type="text" class="form-control" value="<?php echo $sel_buyer['buyer_name'];?>" readonly id="buyer_name" name="buyer" placeholder="">
											<?php } ?>	
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style Code</label>
												<div class="col-sm-6">

													<?php if($_REQUEST['costing_no']==''){?>
												<input type="text" class="form-control" readonly id="lname" name="style_no" value="<?php echo $sel_entry1['style_no'];?>">
											<?php } else{
													?>
													<input type="text" class="form-control" readonly name="style_no" id="style_no"  placeholder="" value="<?php echo $sel_costing1['style_no'];?>">
											<?php } ?>
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Order Date</label>
											<input type="date" class="form-control" id="cono1" value="<?php echo date('Y-m-d'); ?>">
											</div>

										</div>
									</div>
									<table id="example" class="table table-striped table-bordered">

										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th>Department Name</th>
												<th>UOM</th>
												<th>Qty</th>
												<th>Rate</th>
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
										<tbody><?php 
											$totwgt=0;
										if($_REQUEST['costing_no']==''){
											 $sel_entry1 = mysqli_query($zconn,"select * from department_costing where costing_no='".$_GET['id']."'");
										while($sel_entry11=mysqli_fetch_array($sel_entry1,MYSQLI_ASSOC)){
										?>
											<tr id="delete_0">
												<td>
													<select class="select2 form-control custom-select chosen-select" name="department[]">
														<option value="<?php echo $sel_entry11['dept_name']?>"><?php echo $sel_entry11['dept_name']?></option>
														<option>Select</option>
															<?php $sel_fabric = mysqli_query($zconn,"select * from 	department_master");
															while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){  ?>
																<option value="<?php echo $res_fabric['dept_name'];?>"><?php echo $res_fabric['dept_name'];?></option> <?php } ?>
													</select>
												</td>
												<td>
													<select class="select2 form-control custom-select chosen-select" name="uom[]">
														<option value="<?php echo $sel_entry11['uom_name']?>"><?php echo $sel_entry11['uom_name']?></option>
														<option>Select</option>
														<?php $sel_fabric = mysqli_query($zconn,"select * from 	uom_master");
														while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
														<option value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
														<?php } ?>
														</select>
														<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</td>
												<td>
														<textarea class="form-control" id="descr" name="descr[]"><?php echo $sel_entry11['descr']?></textarea>
												</td>
												<td>
														<input type="text" class="form-control tamout" value="<?php echo $sel_entry11['rate'];$totwgt += $sel_entry11['rate'];?>" id="fname" placeholder="Rate" name="rate[]" autocomplete="off" onkeyup="cal_amt();">
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
 										<?php } } else { ?> 
								 			<tr id="delete_0">
												<td>
													<select class="select2 form-control custom-select chosen-select" name="department[]">
														<option>Select</option>
															<?php $sel_fabric = mysqli_query($zconn,"select * from 	department_master where status= '0' ");
															while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
															<option value="<?php echo $res_fabric['dept_name'];?>"><?php echo $res_fabric['dept_name'];?></option>
															<?php } ?>
																					</select>
																				</td>
																				<td>
															<select class="select2 form-control custom-select chosen-select" name="uom[]">
															<option>Select</option>
															<?php $sel_fabric = mysqli_query($zconn,"select * from 	uom_master");
															while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
															<option value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
															<?php } ?>
														</select>
														<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</td>
												<td>
														<textarea class="form-control" id="descr" name="descr[]"></textarea>
												</td>
												<td>
														<input type="text" class="form-control tamout" id="fname" placeholder="Rate" name="rate[]" autocomplete="off" onkeyup="cal_amt();">
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
											 <?php } ?> 
										</tbody>
										<tbody>
											<tr id="delete_1">
												<td></td>
												<td></td>
												<td>
													Department Total:
												</td>
												<td>
														<input type="text" class="form-control" id="grand_tot" value="<?php echo $totwgt;?>" readonly placeholder="" style="border: 1px solid #000;">
												</td>
											</tr>
										</tbody>
									</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 450px;">
									 <button type="submit" name="save" value="Save" class="btn btn-success">Save</button> 
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="department_costing_list.php"><button type="button" class="btn btn-danger">Back</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
                <!-- ============================================================== -->
            </div>
			</form>
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
		 
    
		<br>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>

    <!--Wave Effects -->
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<script type="text/javascript">
// 	function sel_details(costing_id){
// 	$.ajax({
// 			url : 'ajax/costing.php',
// 			data: {
// 			   action: "get_cost_details",
// 			   costing_id: $("#costing_no").val();
// 			},
// 			success: function( data ) {
// 				//alert(data);
// 				data = data.split("~~");
// 				$('#order_no').val(data['0']);
// 				$('#style_no').val(data['1']);
// 				$('#buyer_name').val(data['2']);
// 				$('#order_date').val(data['0']);
// 			},
// 			error: function (textStatus, errorThrown) {
// 				//DO NOTHINIG
// 			}
// 		});
// }
<?php 
	$sel_fabric = mysqli_query($zconn,"select * from department_master where status='0'");
	$dept_list='';
	while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
		$dept_list .="<option value='".$res_fabric['dept_name']."'>".$res_fabric['dept_name']."</option>";
		} 
	$sel_fabric = mysqli_query($zconn,"select * from uom_master");
	$uom_list='';
	while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
		$uom_list .="<option value='".$res_fabric['uom_name']."'>".$res_fabric['uom_name']."</option>";
		} 		
		?>
		
		
		function cal_amt(id) {
    var sum = 0;
    $('.tamout').each(function () {
        sum += parseFloat($(this).val());
    });

    // Round the sum to two decimal places
    $('#grand_tot').val(sum.toFixed(2));
}

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
	//	$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
		var id=parseInt(index)+parseInt(1);
		var dept_list="<?php echo $dept_list;?>";
		var uom_list="<?php echo $uom_list;?>";
        var row = '<tr>' +
            '<td><select class="select2 form-control custom-select chosen-select" name="department[]"><option> Select</option>'+dept_list+'</select></td>' +
            '<td><select class="select2 form-control custom-select chosen-select" name="uom[]"><option> Select</option>'+uom_list+'</select></td>' +
            '<td><textarea class="form-control" id="descr" name="descr[]"></textarea></td>' +
            '<td><input type="text" class="form-control tamout" id="rate'+id+'" placeholder="Rate" autocomplete="off" name="rate[]" onkeyup="cal_amt();" ></td>' +
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +

        '</tr>';
    	$("table").append(row);		
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
		$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
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
</script>
</body>
</html>