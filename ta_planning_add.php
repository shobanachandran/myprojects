<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}
if(isset($_POST['submit1'])){
	extract($_POST);
	$trows = count($_POST['ta_name']);
	$delete= mysqli_fetch_array(mysqli_query($zconn,"delete  from ta_planning where ta_group='".$_REQUEST['id']."'"),MYSQLI_ASSOC);
	for($i=0;$i<$trows;$i++){

		$insert_fab_costing = mysqli_query($zconn,"insert into ta_planning(ta_group,ta_name,commitment_days,particulars,assignee,created_by,created_date)
		 values('".$_REQUEST['accessor_group']."','".$_POST['ta_name'][$i]."','".$_POST['commitment_days'][$i]."','".$_POST['particulars'][$i]."','".$_POST['assignee'][$i]."','".$_SESSION['userid']."',now())");
		//  print '<pre>';
		//  print $insert_fab_costing ;
		//  print '<pre>';
	}
	echo "<script>alert('Group Added successfully);</script>";
	echo "<script>window.location.href='ta_planning.php';</script>";
}

			// $res_costing_dt= mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['costing_no']."'"),MYSQLI_ASSOC);
			// $sel_buyer = mysqli_fetch_array(mysqli_query($zconn,"select buyer_name from buyer_master where buyer_id='".$res_costing_dt['buyer_id']."'"),MYSQLI_ASSOC);
 			$id=$_GET['id'];
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
    <title><?php echo SITE_TITLE;?> - T & A Process Group Entry</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
   
</head>

<body>
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
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
                        <h4 class="page-title"> T & A Process Group Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#"> T & A Process Group Info</a></li>
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
				
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
							</div>
								<div class="card-body" style="width:100%">
									<div class="card-body" style="width:100%">
										<div class="card" style="width:50%; float:left; left: 50px; ">
											<div class="form-group row">
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">T & A Group</label>
												<div class="col-sm-6">
													
													
												<select class="select2 form-control custom-select" name="accessor_group" id="accessor_group" onchange="this.form.submit();" required>
												<option><?php echo $id;?></option>
												<option>Select</option>		
                                                   
															
															<?php $accssor= mysqli_query($zconn,"select * from ta_grouping");
															while($assgroup=mysqli_fetch_array($accssor)){

																if ($assgroup['ta_group_name']==$id) {
																
																?>
																<option value="<?php echo $assgroup['ta_group_name'];?>"  >
																<?php echo $assgroup['ta_group_name'];?></option>	
															<?php }  else{?>
																<option value="<?php echo $assgroup['ta_group_name'];?>"
																 <?php if ($assgroup['ta_group_name']==$_REQUEST['accessor_group']) {
																	echo "selected";
																}?> ><?php echo $assgroup['ta_group_name'];?></option>
															<?php } }
															?>
														</select>
												</div>
											</div>
											

											
											<!-- <div class="form-group row">
											</div>	
											<div class="form-group row">
												<h4 class="page-title"><b>Material Details</b></h4>
											</div> -->

											
										</div>

										
										
									</div>
								</div>
								
												<!-- <div class="form-group row">
													<label for="lname" class="col-sm-2 text-right control-label col-form-label"> Accessories Group</label>
													<div  class="col-sm-3 text-left" >
											
															<select class="select2 form-control custom-select" name="accessor_group" id="accessor_group" onchange="this.form.submit();" required>

															<option>Select</option>
															<?php $accssor= mysqli_query($zconn,"select * from accessories_group");
															while($assgroup=mysqli_fetch_array($accssor)){
																?>
																<option selected value="<?php echo $assgroup['ta_group_name'];?>"><?php echo $assgroup['ta_group_name'];?></option>
															<?php }
															?>
														</select>
													</div>
												</div>
 -->
									

								
  <?php
	

?>


									<table id="example" class="table table-striped table-bordered">
										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
												<th>T & A Name</th>
												<th>commitment_days</th>
												<th>Particulars</th>
												<th>Assignee</th>
												<!-- <th>Rate</th>
												<th>Total</th> -->
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
										<tbody>

												<?php 
											$id=$_GET['id'];
												if ($id!='' && $id!='0'){
													//if ($_REQUEST['accessor_group']!='' && $_REQUEST['accessor_group']!='0'){
													$select=mysqli_query($zconn,"select * from ta_planning where 
													ta_group='$id' or ta_group='".$_REQUEST['accessor_group']."'");

													$idd=0;
													while($data=mysqli_fetch_array($select,MYSQLI_ASSOC)){?>

											<tr id="delete_0">	
												<td>
													<select class="select2 form-control custom-select" name="ta_name[]" id="ta_name_<?php echo $id;?>">
													<option><?php echo  $value;?></option>
														<option>Select</option>
														<?php $sel_fabric = mysqli_query($zconn,"select * from ta_manage");
															while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){

																if ($res_fabric['ta_name']== $data['ta_name']) {?>
																	<option selected value="<?php echo $res_fabric['ta_name'];?>"><?php echo $res_fabric['ta_name'];?></option>
																<?php } else{
															 ?>
															<option value="<?php echo $res_fabric['ta_name'];?>"><?php echo $res_fabric['ta_name'];?></option>
														<?php } }?>
													</select>
												</td>
												<td>
														<input type="text" class="form-control" id="commitment_days<?php echo $idd;?>" name="commitment_days[]" placeholder="commitment_days" value="<?php echo $data['commitment_days'];?>" autocomplete="off" onkeyup="cal_amt(<?php echo $idd;?>);" onblur="cal_amt(<?php echo $idd;?>);">
												</td>
												<td>
														<input type="text" class="form-control" id="particulars<?php echo $idd;?>" name="particulars[]" placeholder="particulars" value="<?php echo $data['particulars'];?>" autocomplete="off" onkeyup="cal_amt(<?php echo $idd;?>);" onblur="cal_amt(<?php echo $idd;?>);">
												</td>
												<td>
														<select class="select2 form-control custom-select" name="assignee[]" style="width:120px;">

								
															<option>Select</option>
															<?php $sel_fabric = mysqli_query($zconn,"SELECT * FROM department_master  ORDER BY dept_id  desc ");
														while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ if ($res_fabric['dept_name']== $data['assignee']) {?>
															<option selected value="<?php echo $res_fabric['dept_name'];?>"><?php echo $res_fabric['dept_name'];?></option>
														<?php } else{ ?>
														<option value="<?php echo $res_fabric['dept_name'];?>"><?php echo $res_fabric['dept_name'];?></option>	
														<?php } }  ?>
														</select>
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
													<?php $idd++;  }	
											}

											else{							
							$ass_group = mysqli_fetch_array(mysqli_query($zconn,"select * from ta_grouping where ta_group_name='".$_REQUEST['accessor_group']."'"),MYSQLI_ASSOC);
							$ass=$ass_group['ta_names'];
							$ass1=explode(",", $ass);
							$id=0;
							foreach ($ass1 as  $value) {  ?>
								

											<tr id="delete_0"  >
												
												<td>
													<select class="select2 form-control custom-select" name="ta_name[]" id="ta_name_<?php echo $id;?>">
													<option><?php echo  $value;?></option>
													<option>Select</option>	
                                                    
														
														<?php $sel_fabric = mysqli_query($zconn,"select * from ta_manage");
							
							while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['ta_name'];?>"><?php echo $res_fabric['ta_name'];?></option>
							<?php } ?>
							
													</select>
												</td>
												
												<td>
														<input type="text" class="form-control" id="commitment_days<?php echo $id;?>" name="commitment_days[]" placeholder="commitment_days" autocomplete="off" onkeyup="cal_amt(<?php echo $id;?>);" onblur="cal_amt(<?php echo $id;?>);">
												</td>
												<td>
														<input type="text" class="form-control" id="particulars<?php echo $id;?>" name="particulars[]" placeholder="particulars" autocomplete="off" onkeyup="cal_amt(<?php echo $id;?>);" onblur="cal_amt(<?php echo $id;?>);">
												</td>
												<td>
														<select class="select2 form-control custom-select" name="assignee[]" style="width:120px;">
															<option>Select</option>
															<?php $sel_fabric = mysqli_query($zconn,"SELECT * FROM department_master  ORDER BY dept_id  desc");
														while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
															<option value="<?php echo $res_fabric['dept_name'];?>"><?php echo $res_fabric['dept_name'];?></option>
														<?php } ?>
														</select>
												</td>
												<td>
													<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
												</td>
											</tr>
										<?php $id++; } } ?>
										</tbody>
									
									</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" name="submit1" value="save" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="ta_planning.php"><button type="button" class="btn btn-danger">Back</button></a>
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
        </div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>

    </form>
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
	function cal_amt(id){

		var cons = $('#consumption'+id).val();

		var rat = $('#rate'+id).val();
		var ctrws=0;
		if(rat){
			ctrws = parseFloat(cons)*parseFloat(rat);
		} 
		$('#total'+id).val(ctrws);

		var sum = 0;
		$('.tramt').each(function(){
			sum += parseFloat($(this).val());
		});

		$('#grand_tot').val(sum).toFixed(2);
	}

// 	function sel_details(costing_id){
// 	$.ajax({
// 			url : 'ajax/costing.php',
// 			data: {
// 			   action: "get_cost_details",
// 			   costing_id: costing_id
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
	$sel_fabric = mysqli_query($zconn,"select * from ta_manage");
	$acc_list='';
	while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
		$acc_list .="<option value='".$res_fabric['ta_name']."'>".$res_fabric['ta_name']."</option>";
		} 
		
		$sel_uom = mysqli_query($zconn,"SELECT * FROM department_master  ORDER BY dept_id  desc");
	$uom_list='';
	while($res_color=mysqli_fetch_array($sel_uom,MYSQLI_ASSOC)){ 
		$uom_list .="<option value='".$res_color['dept_name']."'>".$res_color['dept_name']."</option>";
		} 
		?>
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
	//	$(this).attr("disabled", "disabled");
		var acc_list ="<?php echo $acc_list;?>";
		var uom_list ="<?php echo $uom_list;?>";

		var index = $("table tbody tr:last-child").index();
		var id=parseInt(index)+parseInt(1);
        var row = '<tr >' +
            '<td style="padding:0px;"><select class="select2 form-control custom-select" name="ta_name[]"><option> Select</option>'+acc_list+'</select></td>' +
            '<td style="padding:0px;"><input type="text" class="form-control" id="commitment_days'+id+'" placeholder="commitment_days" onkeyup="cal_amt('+id+');" onblur="cal_amt('+id+');" name="commitment_days[]"></td>' +          
            '<td style="padding:0px;"><input type="text" class="form-control" id="particulars'+id+'" placeholder="particulars" onkeyup="cal_amt('+id+');" onblur="cal_amt('+id+');" name="particulars[]"></td>' +
			'<td style="padding:0px;"><select class="select2 form-control custom-select" name="assignee[]"><option> Select</option>'+uom_list+'</select></td>' +
			
			'<td style="padding:0px;"><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +

        '</tr>';
    	$("table").append(row);
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
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
</script>
