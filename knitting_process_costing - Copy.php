<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if($_REQUEST['costing_no']!=''){
	$sel_entry = mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['costing_no']."'"),MYSQLI_ASSOC);
}

/*echo "<pre>";
print_r($_POST);
echo "</pre>";*/

if(isset($_POST['save'])){
	extract($_POST);
	$row_count = count($_POST['yarn_rate']);
	for($r=0;$r<$row_count;$r++){
		if($_POST['yarn_rate'][$r]!=''){
			$sel_entry = mysqli_query($zconn,"insert into knit_costing(costing_no,yarn_type,fabric_name,yarn_colour,comp_group,fabric_type,total_weight,rate_per_kg,rate_per_pc,total_per_row,created_by,created_date) values('".$costing_no."','".$yarn_type[$r]."','".$fab_name[$r]."','".$colour_name[$r]."','".$comp_group[$r]."','".$fab_type[$r]."','".$yarn_weight[$r]."','".$yarn_rate[$r]."','".$pcs_weight[$r]."','".$yarn_total[$r]."','".$_SESSION['user_id']."',now())");
		}
	}

	echo "<script>alert('Updated successfully!!!');</script>";
	echo "<script>window.location.href='knitting_process_costing.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - Knitting Process Costing Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<style>
	.table td, .table th{padding:0px !important; font-size:14px;}
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
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Knitting Process Costing Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Knitting Process Costing Info</a></li>
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
			<form name="knit_process_costing" method="post">
			<input type="hidden" id="groups" name="grouping_id">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
								<div class="card-body" style="width:100%">
								<div class="card" style="width:50%; float:left; left: 50px; ">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Costing No</label>
										<div class="col-sm-6">
											<select class="select2 form-control custom-select" onchange="this.form.submit();" name="costing_no" id="costing_no">
										<option value="">Select</option>
										<?php $sel_costing = mysqli_query($zconn,"select * from costing_entry_master");
										while($res_costing = mysqli_fetch_array($sel_costing,MYSQLI_ASSOC)){
											if($res_costing['costing_no']==$_REQUEST['costing_no']){
										?>
										<option selected value="<?php echo $res_costing['costing_no'];?>"><?php echo $res_costing['costing_no'];?></option>
										<?php } else  { ?>
										<option value="<?php echo $res_costing['costing_no'];?>"><?php echo $res_costing['costing_no'];?></option>
										<?php } ?>
										<?php } ?>
											</select>
										</div>
									</div>
									<div class="form-group row">
										<label for="lname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" readonly id="lname" value="<?php echo $sel_entry['order_no'];?>" >
										</div>
									</div>
								</div>
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Buyer name</label>
										<div class="col-sm-6">
										<?php $buyer_sql = mysqli_fetch_array(mysqli_query($zconn,"select * from buyer_master where buyer_id='".$sel_entry['buyer_id']."'"));?>
											<input type="text" class="form-control" readonly id="lname" value="<?php echo $buyer_sql['buyer_name'];?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" readonly id="lname" value="<?php echo $sel_entry['style_no'];?>">
										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Order Date</label>
										<div class="col-sm-6">
											<input type="date" class="form-control" readonly id="cono1" value="<?php echo $sel_entry['costing_date'];?>">
										</div>
									</div>
								</div>
							<table id="example" class="table table-striped table-bordered">
							<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
							<tr>
								<th>Grouping</th>
								<th>Yarn Type</th>
								<th>Fabric Name</th>
								<th>Yarn Colour</th>
								<th nowrap>Group Name</th>
								<th>Fabric Type</th>
								<th>Total Weight</th>
								<th>Rate/KG	</th>
								<th>Rate/PC</th>
								<th>Total</th>
							</tr>
						</thead>
						<tbody>
					<?php
					$group_id = implode(",",$_POST['chk_ytype']);
					if(isset($_POST['grouping'])){
						$cost_det1 = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$_REQUEST['costing_no']."' and id in ($group_id)");
						$yarn_type=array();
						$yarn_color=array();
						$fab_type = array();
						$comp = array();
						$con_value=0;
		while($res_cost_det = mysqli_fetch_array($cost_det1,MYSQLI_ASSOC)){ 
			$yarn_type[] = $res_cost_det['yarn_type'];
			$yarn_color[] = $res_cost_det['yarn_colour'];
			$comp[] = $res_cost_det['comp_id'];
			$con_value = $con_value+$res_cost_det['consumption_value'];
		}
		$ytype = array_unique($yarn_type);
		$yarn_type = implode(",",$ytype);
		$ycolor = array_unique($yarn_color);
		$ycolour = implode(",",$ycolor);
		$comp_group = array_unique($comp);
		$comp_groups = implode(",",$comp_group);
					?>

				<tr id="delete_0">
					<td><!--<a href="javascript:;" title="Delete Group"><img src="dist/images/icons/delete.png" width="30" height="30"></a>--></td>
						<td>
							<input type="text" name="yarn_type[]" value="<?php echo $yarn_type;?>" class="form-control" readonly >
						</td>
						<td>
						<select name="fab_name[]" class="form-control">
							<option value="0">--Select--</option>
						<?php 
					$fab_sql= mysqli_query($zconn,"SELECT * FROM  `fabric_master` where status='0'");
					while($res_fab=mysqli_fetch_array($fab_sql,MYSQLI_ASSOC)){ ?>
						<option value="<?php echo $res_fab['fabric_name'];?>"><?php echo $res_fab['fabric_name'];?></option>
					<?php } $rec=0; ?>
					</select>
										</td>
										<td>
									<input type="text" name="colour_name[]" value="<?php echo $ycolour;?>" class="form-control" readonly>
									</td>
									<td>
									<input type="text" name="comp_group[]" id="comp_group0" value="<?php echo $res_cost_det['comp_group'];?>" class="form-control">
									</td>
									<td><input type="text" name="fab_type[]" value="<?php echo $comp_groups;?>" style="border:none;">
										</td>
										<td>
										<input type="text" class="form-control" id="<?php echo 'yarn_wgt_'.$rec; ?>" name="yarn_weight[]" autocomplete="off" value="<?php echo $con_value;?>" readonly  >
										</td>
										<td>
										<input type="text" class="form-control" id="<?php echo 'yarn_rate_'.$rec; ?>" name="yarn_rate[]"  autocomplete="off" onkeyup="yarn_rate(<?php echo $rec; ?>)" onkeydown="yarn_rate(<?php echo $rec; ?>)" onkeypress="yarn_rate(<?php echo $rec; ?>)">
										</td>
										<td>
										<input type="text" class="form-control" id="<?php echo 'yarn_pcs_rate_'.$rec; ?>" name="pcs_weight[]" readonly value="0" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control yarn_total" id="<?php echo 'yarn_total_'.$rec; ?>" name="yarn_total[]" placeholder="Rate" autocomplete="off" readonly onkeyup="yarn_total(<?php echo $rec; ?>)" onkeydown="yarn_total(<?php echo $rec; ?>)" onkeypress="yarn_total(<?php echo $rec; ?>)" v value="0">
										</td>
									</tr>

					<?php }
					if($group_id!=''){
						$sql_con = " and id not in ($group_id)";
					}
						$cost_det = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$_REQUEST['costing_no']."' ".$sql_con." ");

					$rec=1;
					while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){ ?>
					<tr id="delete_<?php echo $rec;?>">
					<td><input type="checkbox" class="form-control" name="chk_ytype[]" value="<?php echo $res_cost_det['id'];?>" style="margin-top:5px;"></td>
						<td>
							<input type="text" name="yarn_type[]" value="<?php echo $res_cost_det['yarn_type'];?>" class="form-control" readonly >
						</td>
						<td>
							<select name="fab_name[]" class="form-control">
							<option value="0">--Select--</option>
							<?php 
								$fab_sql= mysqli_query($zconn,"SELECT * FROM  `fabric_master` where status='0'");
								while($res_fab=mysqli_fetch_array($fab_sql,MYSQLI_ASSOC)){
										?>
										<option value="<?php echo $res_fab['fabric_name'];?>"><?php echo $res_fab['fabric_name'];?></option>
										<?php } ?>
										</select>
										</td>
										<td>

									<input type="text" name="colour_name[]" value="<?php echo $res_cost_det['yarn_colour'];?>" class="form-control" readonly>
									</td>
									<td>
									<input type="text" name="comp_group[]" id="comp_group0" value="<?php echo $res_cost_det['comp_group'];?>" class="form-control" >
									</td>
									<td>
										<select class="select2 form-control custom-select" name="fab_type[]">
										<option>Select</option>
										<?php $selcomp = mysqli_query($zconn,"select * from components where status='0'");
										while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
										if($res_comp['comp_name']==$res_cost_det['comp_id']){
										?>
										<option selected value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } else { ?>
										<option value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } } ?>
										</select>
										</td>
										<td>
										<input type="text" class="form-control" id="<?php echo 'yarn_wgt_'.$rec; ?>" name="yarn_weight[]" autocomplete="off" value="<?php echo $res_cost_det['consumption_value'];?>" readonly  >
										</td>
										<td>
										<input type="text" class="form-control" id="<?php echo 'yarn_rate_'.$rec; ?>" name="yarn_rate[]"  autocomplete="off" onkeyup="yarn_rate(<?php echo $rec; ?>)" onkeydown="yarn_rate(<?php echo $rec; ?>)" onkeypress="yarn_rate(<?php echo $rec; ?>)">
										</td>
										<td>
										<input type="text" class="form-control" id="<?php echo 'yarn_pcs_rate_'.$rec; ?>" name="pcs_weight[]" readonly value="0" autocomplete="off">
										</td>
										<td>
											<input type="text" class="form-control yarn_total" id="<?php echo 'yarn_total_'.$rec; ?>" name="yarn_total[]" placeholder="Rate" autocomplete="off" readonly onkeyup="yarn_total(<?php echo $rec; ?>)" onkeydown="yarn_total(<?php echo $rec; ?>)" onkeypress="yarn_total(<?php echo $rec; ?>)" v value="0">
										</td>
									</tr>
					<?php $rec++;}  ?>
										</tbody>
				<tbody>
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td><h6 class="page-title">Yarn Total:</h6></td>
						<td>
							<input type="text" class="form-control" name="yarn_total_sum"  id="yarn_total_sum" readonly placeholder="" style="border: 1px solid #000;">
						</td>
						<td>
						</td>
					</tr>
				</tbody>
			</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" name="save" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="costing_report.php"><button type="button" class="btn btn-danger">List</button></a>
									<button type="submit" name="grouping" class="btn btn-danger">Group It</button>
									<button type="submit" name="ungrouping" class="btn btn-danger">Un Group It</button>
								</div>
							</div>
                        </div>
                    </div>
                </div>
            </div>
		</form>
        </div>
    </div>
    <?php include('includes/footer.php');?>
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
	function group(){
		var chval ='';
		var list = $("input[name='chk_ytype[]']:checked").map(function () {
			chval = chval+$(this).val()+",";
		});
		var costing_no = $('#costing_no').val();
		var newStr = chval.substring(0, chval.length-1);
		window.open("grouping_entry.php?id="+newStr+"&costing_no="+costing_no, "Grouping", "width=1000,height=500");
	}
	
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
	//	$(this).attr("disabled", "disabled");
		var index = $("table tbody tr:last-child").index();
        var row = '<tr>' +
            '<td><select class="select2 form-control custom-select" style=""><option> Select</option></select></td>' +
            '<td><select class="select2 form-control custom-select" style=""><option> Select</option></select></td>' +
            '<td><select class="select2 form-control custom-select" style=""><option> Select</option></select></td>' +
            '<td><select class="select2 form-control custom-select" style=""><option> Select</option></select></td>' +
            '<td><select class="select2 form-control custom-select" style=""><option> Select</option></select></td>' +
            '<td><select class="select2 form-control custom-select" style=""><option> Select</option></select></td>' +
            '<td><input type="text" class="form-control" id="fname" placeholder="in percentage"></td>' +
            '<td><input type="text" class="form-control" id="fname" placeholder="Pcs. Weight"></td>' +
            '<td><select class="select2 form-control custom-select" style=""><option>Select</option></select></td>' +
            '<td><input type="text" class="form-control" id="fname" placeholder="Rate"></td>' +
            '<td><input type="text" class="form-control" id="fname" placeholder="Total "></td>' +
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +

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


function yarn_rate(id)
{
    var t1 = document.getElementById('yarn_rate_'+id).value;
	var t2 = document.getElementById('yarn_wgt_'+id).value;
	var t3 = ((parseFloat(t1).toFixed(2))*(parseFloat(t2).toFixed(2)));
	//alert(t3);
	document.getElementById('yarn_pcs_rate_'+id).value=parseFloat(t3).toFixed(2);
    yarn_pcs_rate(id);
}


function yarn_pcs_rate(id)
{
    var t1 = document.getElementById('yarn_pcs_rate_'+id).value;
	var t2 = document.getElementById('yarn_wgt_'+id).value;
    var t3 = ((parseFloat(t1).toFixed(2))* 1 );
	document.getElementById('yarn_total_'+id).value=parseFloat(t3).toFixed(2);
    yarn_total(id);
}


function yarn_total(id) {
    var total = 0;
    var ele = document.getElementsByClassName('yarn_total');
    for (var i = 0; i < ele.length; ++i) {
    if (!isNaN((ele[i].value)) )
   	 total += parseFloat(ele[i].value);
    }
    document.getElementById('yarn_total_sum').value=total.toFixed(2);
}

</script>
</body>
</html>