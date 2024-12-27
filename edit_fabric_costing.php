<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}




if ($_REQUEST['id'] != '') {
    $cost_sql = mysqli_query($zconn, "select * from fabric_costing_list where id='" . $_REQUEST['id'] . "'");
    $res_cost = mysqli_fetch_array($cost_sql, MYSQLI_ASSOC);
    $cost_no = $res_cost['costing_no'];
    $order = $res_cost['order_no'];
    $style = $res_cost['style_no'];
    $buyer = $res_cost['buyer'];
    $create = $res_cost['created_date'];
}


if (isset($_POST['save'])) {
	$order_no = $_POST['order_no'];
    $style_no = $_POST['style_no'];


    $process_sql = mysqli_query($zconn, "UPDATE  fabric_costing_list SET total ='" .$_POST['grand_tot']."'
        WHERE   order_no = '$order_no' AND style_no = '$style_no'");

    if ($process_sql) {
        $trows = count($_POST['fabric_name']);

		$success = true; // Variable to track whether all updates were successful

		for ($tr = 0; $tr < $trows; $tr++) {
			$ddi = $_POST['ddi'][$tr];
			$fabric_name = $_POST['fabric_name'][$tr];
			$fab_content = $_POST['fab_content'][$tr];
			$fab_colour = $_POST['fab_colour'][$tr];
			$fab_dia = $_POST['fab_dia'][$tr];
            $fab_gsm = $_POST['fab_gsm'][$tr];
			$fab_uom = $_POST['fab_uom'][$tr];
			$fab_consumption = $_POST['fab_consumption'][$tr];
			$fab_rate = $_POST['fab_rate'][$tr];
		
			$updateDetails = mysqli_query($zconn, "UPDATE fabric_costing SET
				fabric_name = '$fabric_name',
				fab_content ='$fab_content',
				fab_colour = '$fab_colour',
				fab_dia ='$fab_dia',
                fab_gsm = '$fab_gsm',
				fab_uom ='$fab_uom',
				fab_consumption = '$fab_consumption',
				fab_rate ='$fab_rate'
				WHERE id = '$ddi'");
		
			if (!$updateDetails) {
				$success = false;
				echo "Failed to update department costing record with ID: $ddi<br>";
				echo "Error: " . mysqli_error($zconn) . "<br>";
			} else {
				echo "Updated department costing record with ID: $ddi<br>";
			}
		}
		
		if ($success) {
			echo "<script>alert('Updated Successfully!!!');</script>";
			echo "<script>window.location.href='fabric_costing_list.php';</script>";
		} else {
			echo "<script>alert('Failed to update department costing records.');</script>";
		}

	}
}

// if (isset($_POST['save'])) {
//     $order_no = $_POST['order_no'];
//     $style_no = $_POST['style_no'];
// 	$cost_no = $res_cost['costing_no']; 

//     $sel_update = mysqli_prepare($zconn, "UPDATE department_costing_list SET order_no=?, style_no=? WHERE costing_no=?");

//     if (!$sel_update) {
//         die("Error in department_costing_list update: " . mysqli_error($zconn));
//     }

//     mysqli_stmt_bind_param($sel_update, "sss", $order_no, $style_no, $cost_no);

//     if (!mysqli_stmt_execute($sel_update)) {
//         die("Error executing department_costing_list update: " . mysqli_error($zconn));
//     }

//     mysqli_stmt_close($sel_update);

//     $trows = count($_POST['dept_name']);
//     for ($tr = 0; $tr < $trows; $tr++) {
//         $department = $_POST['department'][$tr];
//         $uom = $_POST['uom'][$tr];
//         $descr = $_POST['descr'][$tr];
//         $rate = $_POST['rate'][$tr];

//         $ins_details = mysqli_prepare($zconn, "UPDATE deparment_costing SET dept_name=?, uom_name=?, rate=?, descr=? WHERE costing_no=? and id=?");

//         if (!$ins_details) {
//             die("Error in deparment_costing update: " . mysqli_error($zconn));
//         }

//         mysqli_stmt_bind_param($ins_details, "sssss", $department, $uom, $rate, $descr, $cost_no, $ddi);

//         if (!mysqli_stmt_execute($ins_details)) {
//             die("Error executing deparment_costing update: " . mysqli_error($zconn));
//         }

// 	}


//     echo "<script>alert('Updated Successfully!!!');</script>";
//     echo "<script>window.location.href='department_costing_list.php';</script>";
// }

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
    <title><?php echo SITE_TITLE;?> - Fabric Costing Entry</title>
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
                        <h4 class="page-title">Fabric Costing Entry</h4>
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
												<input type="text" class="form-control" readonly id="lname" name="costing_no"  value="<?php echo $cost_no;?>">
												</div>
											</div>
											<div class="form-group row">
												<label for="lname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
												<div class="col-sm-6">
													 
												<input type="text" class="form-control" readonly id="lname" name="order_no"  placeholder="" value="<?php echo $order;?>">
											
											
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

													
												<input type="text" class="form-control" readonly id="lname" name="buyer" value="<?php echo $buyer;?>">
										
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
												<div class="col-sm-6">

													
												<input type="text" class="form-control" readonly id="lname" name="style_no" value="<?php echo $style;?>">
											
												</div>
											</div>
											<div class="form-group row">
												<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Order Date</label>
												<div class="col-sm-6">

													
												<input type="date" class="form-control"  value="<?php echo $create ?>"  id="order_date">
												
												</div>
											</div>

										</div>
									</div>
									<table id="example" class="table table-striped table-bordered">

										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
											<tr>
											<th style="display:none;">id</th>
												<th>Fabric Name</th>
												<th>Content</th>
												<th>Color</th>
												<th>Dia</th>
                                                <th>Gsm</th>
												<th>Uom</th>
												<th>Pcs/weight</th>
												<th>Rate</th>
                                                <th>Total</th>
												<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
											</tr>
										</thead>
										<tbody><?php 
											$totwgt=0;
										
											 $sel_entry1 = mysqli_query($zconn,"select * from fabric_costing where costing_no='".$cost_no."'");
                                            
										while($sel_entry11=mysqli_fetch_array($sel_entry1,MYSQLI_ASSOC)){
										?>
											<tr id="delete_0">
												<td style="display: none;">
												<input type="hidden" class="form-control tamout" value="<?php echo $sel_entry11['id'];$totwgt += $sel_entry11['id'];?>" id="ddi" placeholder="Rate" name="ddi[]" autocomplete="off">
										</td>	
                                        <td>
                                        <select class="select2 form-control custom-select" name="fabric_name[]" style="width:150px;">
							<option value="<?php echo $res_fabric01['fabric_name'];?>"><?php echo $res_fabric01['fabric_name'];?></option>
							<option>Select</option>
							<?php $sel_fabric = mysqli_query($zconn,"select * from fabric_master");
							
							while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
                                if($res_fabric['fabric_name']==$sel_entry11['fabric_name']){ ?>
                               <option selected="selected" value="<?php echo $res_fabric['fabric_name'];?>"><?php echo $res_fabric['fabric_name'];?></option>
                               <?php } else { ?>
                               <option value="<?php echo $res_fabric['fabric_name'];?>"><?php echo $res_fabric['fabric_name'];?></option>
                               <?php } ?>
                       
                           
                               <?php } ?>
													</select>
												</td>

                                                <td>
                                                <select class="select2 form-control custom-select" name="fab_content[]" id="fab_content">
					<option value="">Select</option>
					<?php
					$sel_ycolor1 = mysqli_query($zconn,"select * from content_master where status='0'");
					while($res_ycolor1 = mysqli_fetch_array($sel_ycolor1,MYSQLI_ASSOC)){
						if($res_ycolor1 ['content_name']==$sel_entry11['fab_content']){	?>
						<option selected  value="<?php echo $res_ycolor1['content_name'];?>"><?php echo $res_ycolor1['content_name'];?></option>
						<?php } else { ?>
						<option value="<?php echo $res_ycolor1['content_name'];?>"><?php echo $res_ycolor1['content_name'];?></option>
						<?php } ?>
					<?php } ?>
				</select> 
												</td>
                                                <td>
                                                <select class="select2 form-control custom-select" name="fab_colour[]" id="fab_colour0">
   <option value="">Select</option>
<?php
$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){

if($sel_entry11['fab_colour']== $res_ycolor['colour_name']){?>
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
                                                <td>
														<input type="text" class="form-control" id="fab_dia" name="fab_dia[]" value="<?php echo $sel_entry11['fab_dia']?>"></input>
												</td>
                                                <td>
														<input type="text" class="form-control" id="fab_gsm" name="fab_gsm[]" value="<?php echo $sel_entry11['fab_gsm']?>"></input>
												</td>
												
												<td>
													<select class="select2 form-control custom-select chosen-select" name="fab_uom[]">
														<option value="<?php echo $sel_entry11['uom_name']?>"><?php echo $sel_entry11['uom_name']?></option>
														<option>Select</option>
														<?php $sel_fabric = mysqli_query($zconn,"select * from 	uom_master");
														while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
														if($res_fabric['uom_name']==$sel_entry11['fab_uom']){ ?>
                               <option selected="selected" value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
                               <?php } else { ?>
                               <option value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
                               <?php } ?>
                       
                           
                               <?php } ?>
														</select>
														<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
												</td>
                                                <td>
														<input type="text" class="form-control" id="fab_consumption" name="fab_consumption[]" value="<?php echo $sel_entry11['fab_consumption']?>"  onblur="cal_amt('0');" onkeyup="cal_amt('0');">
									
                                                    </td>
												<td>
														<input type="text" class="form-control" id="fab_rate" name="fab_rate[]" value="<?php echo $sel_entry11['fab_rate']?>"  onblur="cal_amt('0');" onkeyup="cal_amt('0');">
												</td>
												<td>
														<input type="text" class="form-control tramt" value="<?php echo $sel_entry11['fab_total'];$totfabric +=$sel_entry11['fab_total']; ?>" id="fab_total" placeholder="Rate" name="fab_total[]" autocomplete="off" readonly >
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
                                                <td></td>
												<td></td><td></td>
												<td></td><td></td>
												
												<td>
													Total:
												</td>
												<td>
														<input type="text" class="form-control" name="grand_tot"  id="grand_tot"  value="<?php echo $totfabric; ?>"  readonly placeholder="" style="border: 1px solid #000;">
												</td>
												<td></td>
											</tr>
										</tbody>
									</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									 <button type="submit" name="save" value="Save" class="btn btn-success">Save</button> 
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="fabric_costing_list.php"><button type="button" class="btn btn-danger">Back</button></a>
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
		 
    </div>
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


function cal_amt(id) {
    var cons = $('#fab_consumption' + id).val();
    var rat = $('#fab_rate' + id).val();
    var ctrws = 0;
    if (rat) {
        ctrws = parseFloat(cons) * parseFloat(rat);
    }
    $('#fab_total' + id).val(ctrws);

    var sum = 0;
    $('.tramt').each(function () {
        sum += parseFloat($(this).val());
    });
    $('#grand_tot').val(sum);
}
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
	$sel_fabric = mysqli_query($zconn,"select * from fabric_master");
	$fabric_list='';
	while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
		$fabric_list .="<option value='".$res_fabric['fabric_name']."'>".$res_fabric['fabric_name']."</option>";
		} 

	$sel_content = mysqli_query($zconn,"select * from content_master");
	$content_list='';
	while($res_content=mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){ 
		$content_list .="<option value='".$res_content['content_name']."'>".$res_content['content_name']."</option>";
		} 

	$sel_color = mysqli_query($zconn,"select * from color_master");
	$color_list='';
	while($res_color=mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){ 
		$color_list .="<option value='".$res_color['colour_name']."'>".$res_color['colour_name']."</option>";
		} 
	$sel_dia = mysqli_query($zconn,"select * from dia_master where status='0'");
	$dia_list='';
	while($res_color=mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){ 
		$dia_list .="<option value='".$res_color['dia_name']."'>".$res_color['dia_name']."</option>";
		}
	$sel_gsm = mysqli_query($zconn,"select * from gsm_master");
	$gsm_list='';
	while($res_color=mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){ 
		$gsm_list .="<option value='".$res_color['gsm_name']."'>".$res_color['gsm_name']."</option>";
		}

	$sel_uom = mysqli_query($zconn,"select * from uom_master");
	$uom_list='';
	while($res_color=mysqli_fetch_array($sel_uom,MYSQLI_ASSOC)){ 
		$uom_list .="<option value='".$res_color['uom_name']."'>".$res_color['uom_name']."</option>";
		}
	?>
	

	
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		var trs = $('#tot_rows').val();
		var in_trs = parseInt(trs)+parseInt(1);
		$('#tot_rows').val(in_trs);
	//	$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
		var flist ="<?php echo $fabric_list;?>";
		var content_list ="<?php echo $content_list;?>";
		var color_list ="<?php echo $color_list;?>";
		var dia_list ="<?php echo $dia_list;?>";
		var gsm_list ="<?php echo $gsm_list;?>";
		var uom_list ="<?php echo $uom_list;?>";
        var row = '<tr>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="fabric[]"><option> Select</option>'+flist+'</select></td>'+
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="content[]"><option> Select</option>'+content_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="color[]"><option> Select</option>'+color_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="dia[]"><option> Select</option>'+dia_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="gsm[]"><option> Select</option>'+gsm_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><select class="select2 form-control custom-select chosen-select" name="uom[]"><option> Select</option>'+uom_list+'</select></td>' +
            '<td style="padding:0px; margin:0px;"><input type="text" class="form-control" id="consumption'+in_trs+'" placeholder="Consumption" name="consumption[]" onkeyup="cal_amt('+in_trs+');" onblur="cal_amt('+in_trs+');"></td>' +
            '<td style="padding:0px; margin:0px;"><input type="text" class="form-control" name="rate[]" id="rate'+in_trs+'" placeholder="Rate" onkeyup="cal_amt('+in_trs+');" onblur="cal_amt('+in_trs+');"></td>' +
            '<td style="padding:0px; margin:0px;"><input type="text" class="form-control tramt" id="total'+in_trs+'" placeholder="Total" name="total[]" readonly></td>' +
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