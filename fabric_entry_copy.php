<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if (isset($_REQUEST['save_fabric'])) {

	$insert=mysqli_query($zconn,"insert into fabric_entry_master (order_no,style_no,fabric_name,
	total_value,created_date) 
	values('".$_REQUEST['order_no']."','".$_REQUEST['style_no']."','".$_REQUEST['fabric']."','".$_REQUEST['total']."',Now())");

	$fabric_id = mysqli_insert_id($zconn); 

	$ins=mysqli_query($zconn,"insert into fabric_entry (fabric_id,order_no,style_no,fabric_name,color,dia,gsm,order_qty,
	req_qty,date,total,fab_type) 
	values('".$fabric_id ."','".$_REQUEST['order_no']."','".$_REQUEST['style_no']."','".$_REQUEST['fabric']."','".$_REQUEST['color']."',
	'".$_REQUEST['dia']."','".$_REQUEST['gsm']."','".$_REQUEST['order_qty']."',
	'".$_REQUEST['req_qty']."',Now(),'".$_REQUEST['total']."','".$_REQUEST['fab_type']."')");

	if (isset($ins)) {
		echo '<script>alert("Fabric Planning Added has been Sucessfully !!!")</script>';
		echo "<script>window.location.href='fabric_entry.php';</script>";
	
	}
}

// if (isset($_POST['save_fabric'])) {
//     // Ensure that a valid database connection ($zconn) is established.

//     // Process the form data and insert it into the "fabric_entry_master" table.
//     $order_no = $_POST['order_no'];
//     $style_no = $_POST['style_no'];
//     $fabric = $_POST['fabric'];
//     $color = $_POST['color'];
//     $dia = $_POST['dia'];
//     $gsm = $_POST['gsm'];
//     $order_qty = $_POST['order_qty'];
//     $req_qty = $_POST['req_qty'];
//     $total = $_POST['total'];
//     $fab_type = $_POST['fab_type'];

//     // Perform the insertion into the "fabric_entry_master" table and retrieve the generated ID.
//     $insert_master_query = "INSERT INTO fabric_entry_master (order_no, style_no, fabric_name, total_value, created_by, created_at) VALUES (?, ?, ?, ?, ?, NOW())";

//     if ($insert_master_stmt = $zconn->prepare($insert_master_query)) {
//         $insert_master_stmt->bind_param("sssss", $order_no, $style_no, $fabric, $total, $_SESSION['userid']);

//         if ($insert_master_stmt->execute()) {
//             $fabric_entry_master_id = $zconn->insert_id; // Get the generated ID.
//         } else {
//             echo '<script>alert("Error: Fabric Planning could not be added to fabric_entry_master.")</script>';
//         }

//         $insert_master_stmt->close();
//     }

//     if (isset($fabric_entry_master_id)) {
//         // Insertion into "fabric_entry_master" was successful, proceed to insert into "fabric_entry."

//         $insert_entry_query = "INSERT INTO fabric_entry (fabric_id, order_no, style_no, fabric_name, color, dia, gsm, order_qty, req_qty, date, total, fab_type) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";

//         if ($insert_entry_stmt = $zconn->prepare($insert_entry_query)) {
//             $insert_entry_stmt->bind_param("ssssssssss", $fabric_entry_master_id, $order_no, $style_no, $fabric, $color, $dia, $gsm, $order_qty, $req_qty, $total, $fab_type);

//             if ($insert_entry_stmt->execute()) {
//                 echo '<script>alert("Fabric Planning has been added successfully!")</script>';
//             } else {
//                 echo '<script>alert("Error: Fabric Entry could not be added.")</script>';
//             }

//             $insert_entry_stmt->close();
//         }
//     }

//     // Redirect to the desired page after processing the form.
//     header("Location: fabric_entry.php");
//     exit; // Exit the script to prevent further execution.
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
    <title><?php echo SITE_TITLE;?> - FABRIC PLANNING</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<style>
	th{font-size:12px; font-weight:bold; background-color:#626F80; color: #fff; text-align:center;}
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
                        <h4 class="page-title">FABRIC PLANNING</h4>
						&nbsp;&nbsp;&nbsp;&nbsp;<a href="planning.php"> <button type="button" class="btn btn-info">Planning Process</button></a>
						<div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item " aria-current="page">Merch</li>
									<!-- <li class="breadcrumb-item " aria-current="page"><a href="costing.php">Costing</a></li> -->
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
                <form action="" method="post">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
							<div class="card-body">
								<div class="row">
									<div class="col-sm-12" >
										<div class="col-sm-6" style="float:left; left: 50px;">
											<div class="form-group row">
												<!-- <label for="fname" class="col-sm-4 text-right control-label col-form-label">&nbsp;Buyer Name</label>
												<div class="col-sm-6">
													<select class="select2 form-control custom-select" name="buyer" id="buyer">
													<option>Select</option>
													<?php $sel_buyer = mysqli_query($zconn,"select * from buyer_master where 1 group by buyer_id");
													while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ ?>
													<option value="<?php echo $res_buyer['buyer_name'];?>"><?php echo $res_buyer['buyer_name'];?></option>
													<?php } ?>
													</select>
												</div>
												<br>
												<br>
												<br> -->
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">&nbsp;Indent No</label>
												<div class="col-sm-6">

													<div class="form-group row">
				<div class="col-sm-6">
				<select class="form-control" name="order_no" id="order_no" onchange="this.form.submit();">
					<option>Select</option>
					<?php $sel_buyer = mysqli_query($zconn,"select * from order_entry_master where (`order_no`,`style_no`) NOT IN(select order_no,style_no from fabric_entry_master) and (`order_no`,`style_no`) IN (select order_no,style_no from process_planning_flow  where process_flow='Ready Fabric')");
					while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
						$order[]=$res_buyer['order_no'];
					 ?>
					<option value="<?php echo $res_buyer['order_no'];?>" <?php if ( $res_buyer['order_no']==$_REQUEST['order_no']){?> selected="selected" <?php } ?>
					><?php echo $res_buyer['order_no'];?></option>
					<?php } ?>
				</select>
				</div>
			</div>
				</div>
				<br>
				<br>
				<br>
				<label for="fname" class="col-sm-4 text-right control-label col-form-label">&nbsp;Style Code</label>
				<div class="col-sm-6">
					<div class="form-group row">
						<div class="col-sm-6">
							<select class="select2 form-control custom-select" name="style_no" id="style_no" onchange="this.form.submit();">
							<option>Select</option>
							<?php $sel_buyer = mysqli_query($zconn,"select * from process_planning_flow where order_no='".$_REQUEST['order_no']."'");
							while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){ 
								$fabrc=$res_buyer['style_no']; ?>
								<option value="<?php echo $res_buyer['style_no'];?>" <?php if ($res_buyer['style_no']==$_REQUEST['style_no']) {?> selected="selected" <?php } ?> ><?php echo $res_buyer['style_no'];?></option>
							<?php } ?>
							</select>
						</div>
					</div>
												</div>

												<br>
												<br>
												<br>
												<label for="fname" class="col-sm-4 text-right control-label col-form-label">&nbsp;Fabric Type</label>
												<div class="col-sm-6" >
													<select class="form-control" name="fab_type" required>
														<option>Select</option>
														<option value="ready">Ready</option>
														<option value="cora">Cora</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>
								<br><br>
								<div class="table-responsive">
									<div class="col-12 d-flex no-block align-items-center">
										<h5 class="page-title" style="margin-left: 400px;">FABRIC PLANNING</h5>
									</div>
									<table id="example" class="table table-striped table-bordered text-center">
										<thead>
											<tr>
												<th style="width: 8%;">FABRIC NAME</th>
												<th style="width: 8%;">COLOUR</th>
											<!-- <th style="width: 4%;" data-toggle="tooltip" title="Consumption">CONS.</th> -->
											<!--<th style="width: 4%;" data-toggle="tooltip" title="Unit of Measurement">UOM</th> -->
												<th style="width: 4%;">DIA</th>
												<th style="width: 4%;">GSM</th>
												<th style="width: 6%;">ORDER QTY.</th>
												<th style="width: 6%;" data-toggle="tooltip" title="Required Quantity">PCS WEIGHT.</th>
												<!-- <th style="width: 4%;" data-toggle="tooltip" title="Excess in %">EX.(%)</th> -->
												<th style="width: 6%;" data-toggle="tooltip" title="Total Quantity">TOTAL WEIGHT</th>
												<th style="width:2%;"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
												<!-- <th style="width: 4%;">RATE</th> -->
											</tr>
										</thead>
										<tbody>
											<?php
											$sectBrnQry = "SELECT * FROM company_info ORDER BY id";
											$secBrnResource = mysqli_query($zconn,$sectBrnQry);
											while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
											?>
											<tr>
												<td style="width: 8%;">
													<select class="select2 form-control" name="fabric">
														<option>Select</option>
														<?php $select=mysqli_query($zconn,"select * from fabric_master where status='0' ");
														while($data=mysqli_fetch_array($select,MYSQLI_ASSOC)){ ?>
															<option value="<?php echo $data['fabric_name']; ?>"><?php echo $data['fabric_name']; ?></option>
														<?php } ?>
													</select>
												</td>
												<td style="width: 8%;">
													<select class="form-select2 form-control" name="color">
														<option>select</option>
														<?php $color=mysqli_query($zconn,"select * from color_master where status='0' ");
														while($codata=mysqli_fetch_array($color,MYSQLI_ASSOC)){?>
														<option value="<?php echo $codata['colour_name'];?>"><?php echo $codata['colour_name'];?></option>
													<?php } ?>
													</select>
												</td>
												<td style="width:4%;"><input type="text" class="form-control" name="dia"></td>
												<td style="width:4%;"><input type="text" class="form-control" name="gsm"></td>
												<td style="width:6%;"><input type="text" class="form-control" name="order_qty" id="order_qty"></td>
												<td style="width:6%;"><input type="text" class="form-control" name="req_qty" id="req_qty" onkeyup="pcsweight()"></td>
												<td style="width:6%;"><input type="text" class="form-control" name="total" id="total"></td>
											</tr>
											<?php
												}
											?>
										</tbody>
									</table>
								</div>
								<div class="card" style="width:100%">
									<div class="border-top">
										<div class="card-body" style="margin-left: 400px;">
											<button type="submit" name="save_fabric" class="btn btn-success" value="<?php echo $action;?>">Save style</button>
											<button type="reset" class="btn btn-primary">Reset</button>
											<div class="btn-group-vertical">
                <a href="fabric_entry_list.php"><button type="button" class="btn btn-danger">Back</button></a>

				</div>
										</div>
									</div>
								</div>
							</div>
                        </div>
                    </div>
                </div>				
				</form>
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
    <script>
    	function pcsweight(){
    		var order=document.getElementById('order_qty').value;
    		var pcs=document.getElementById('req_qty').value;

    		var total=order*pcs;
    		document.getElementById('total').value=total;
    	}

		$(document).ready(function() {
		$('#example').DataTable();
		});
	
		function DeleteUsrId(ID){
		  var UsrStatus = confirm("Are you sure to delete this company details ?");
			  if(UsrStatus){
				$('#delete_'+ID).hide();
			  }
		}
		
		
		
		
		$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#example1 td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		var index = $("table tbody tr:last-child").index();
		var newc = parseInt(index)+parseInt(1);
        var row = '<tr>' +
            '<td><select class="select2 form-control custom-select" name="fabric_name[]" id="fabric_name'+newc+'"><option>Select</option><?php echo $fabric;?></select> </td>' + '<td><select class="select2 form-control custom-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $content_list;?></select></td>'+ 
            '<td><select class="select2 form-control custom-select" name="ycolor[]" id="ycolor'+newc+'"><option>Select</option><?php echo $color_list;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="dia'+newc+'" name="dia[]"><option> Select</option><?php echo $ycountlist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="f_dia'+newc+'" name="f_dia[]"><option>Select</option><?php echo $ytypes;?></select></td>'  +
           '<td><select class="select2 form-control custom-select" name="f_gsm[]" id="f_gsm'+newc+'"><option>Select</option><?php echo $fgsm;?></select></td>' +'<td><input type="text" class="form-control" name="gauge[]" id="gauge'+newc+'"></td>' +
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
	</script>

</body>
</html>