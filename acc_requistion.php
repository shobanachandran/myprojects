<?php 
include('includes/config.php');

	if($_SESSION['userid']==''){
		echo "<script>window.location.href='login.php';</script>";
	}
	$id=$_GET['id'];

	$sel_acc = mysqli_fetch_array(mysqli_query($zconn,"select * from accessories_planning_list where id='".$_REQUEST['id']."'"),MYSQLI_ASSOC);
	
	$order_det = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master where order_no='".$sel_acc['order_no']."'"),MYSQLI_ASSOC);

if(isset($_POST['submit1'])){
	extract($_POST);
	$sel_entry1 = mysqli_query($zconn,"delete from accessories_planning where planning_id='".$_GET['id']."'");

		$insert_fab_costing = mysqli_query($zconn,"update  accessories_planning_list set costing_no='".$costing_no."', order_no='".$_POST['order']."',style_no='".$_POST['style_no']."',total='".$_POST['grand_tot']."',total_loss='".$_POST['grand_loss']."',created_by='".$_SESSION['userid']."',created_date=now(),buyer='".$_POST['buyer']."',accessor_group='".$accessor_group."'  where costing_no='$id'");	

	$trows = count($_POST['acc_name']);
	for($i=0;$i<$trows;$i++){
		$insert_fab_costing = mysqli_query($zconn,"insert into accessories_planning(costing_no,planning_id,acc_name,uom,consumption,descr,rate,total,acc_loss,created_by,created_date) values('".$costing_no."','".$_GET['id']."','".$_POST['acc_name'][$i]."','".$_POST['uom'][$i]."','".$_POST['consumption'][$i]."','".$_POST['descr'][$i]."','".$_POST['rate'][$i]."','".$_POST['total'][$i]."','".$_POST['acc_loss'][$i]."','".$_SESSION['userid']."',now())");
	}
		echo "<script>alert('Fabric Planning Added successfully);</script>";
		echo "<script>window.location.href='accessories_planning_list.php';</script>";
}

		$res_costing_dt= mysqli_fetch_array(mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['costing_no']."'"),MYSQLI_ASSOC);
		$sel_buyer = mysqli_fetch_array(mysqli_query($zconn,"select buyer_name from buyer_master where buyer_id='".$res_costing_dt['buyer_id']."'"),MYSQLI_ASSOC);

		$sel_entry1 = mysqli_fetch_array(mysqli_query($zconn,"select * from accessories_planning_list where costing_no='".$_GET['id']."'"),MYSQLI_ASSOC);
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
    <title><?php echo SITE_TITLE;?> - Accessories Requistion Entry</title>
    <!-- Custom CSS -->		<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
    <link href="dist/css/style.min.css" rel="stylesheet">

</head>

<body>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="POST">
    <div id="main-wrapper">
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
                        <h4 class="page-title">Accessories Requistion Edit</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="requistion.php">Accessories Requistion</a></li>
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
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
								<div class="card-body" style="width:100%">
		<div class="card-body" style="width:100%">
			<div class="card" style="width:50%; float:left; left: 50px; ">
			<div class="form-group row">
			<label for="lname" class="col-sm-3 text-right control-label col-form-label">Order No</label>
			<div class="col-sm-6">
		<select class="select2 form-control custom-select chosen-select" name="order" id="order" required onchange="this.form.submit();">
			<option value="">Select</option>
			<option selected value="<?php echo $sel_acc['order_no'];?>"><?php echo $sel_acc['order_no'];?></option>

		</select>
		
			</div>
		</div>

		<?php $sel_order = mysqli_query($zconn,"select * from order_entry_master where order_no='".$_POST['order']."'");
			$res_order = mysqli_fetch_array($sel_order,MYSQLI_ASSOC);
		?>
			<div class="form-group row">
				<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Style No</label>
				<div class="col-sm-6">
					<input type="text" class="form-control" readonly id="lname" name="style_no" value="<?php echo $sel_acc['style_no'];?>">
				</div>
			</div>

			</div>
		</div>
		<div class="card" style="width:50%; float:left; right: 50px;">
			<div class="form-group row">
				<label for="fname" class="col-sm-3 text-right control-label col-form-label">Buyer name</label>
				<div class="col-sm-6">
				<input type="text" class="form-control" readonly id="lname" name="buyer" value="<?php echo $order_det['buyer_name'];?>">
			</div>
			</div>
			<div class="form-group row">
			<?php 
				$created_arr = explode(" ",$order_det['created_date']);
				$created_arr1 = explode("-",$created_arr['0']);
				$cr_date = $created_arr1['2']."-".$created_arr1['1']."-".$created_arr1['0'];

			?>
				<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Order Date</label>
				<div class="col-sm-6">
				<input type="text" class="form-control"  value="<?php echo $cr_date; ?>" readonly id="order_date">
				</div>
			</div>
		</div>
	</div>
</div>

	<!-- <!div class="form-group row">
	<!label for="lname" class="col-sm-2 text-right control-label col-form-label"> Accessories Group<!/label> -->
	<!-- <div class="col-sm-3 text-left" >

	<!select class="select2 form-control custom-select chosen-select" name="accessor_group" id="accessor_group" onchange="this.form.submit();" required>
	<!option>Select<!/option>
	<!?php $accssor= mysqli_query($zconn,"select distinct(acc_group) as acc_group_name from accessories_group_details");
	while($assgroup=mysqli_fetch_array($accssor)){
		?>
		<!option value="<!?php echo $assgroup['acc_group_name'];?>" <!?php if ($assgroup['acc_group_name']==$sel_acc['accessor_group']) {
			echo "selected";
			}?> ><!?php echo $assgroup['acc_group_name'];?><!/option>
			<!?php } ?>
	<!/select>
	
	<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
	</div> -->
	</div>
	<!-- <!?php
		$check_cost = mysqli_query($zconn,"select * from costing_entry_master where order_no='".$_POST['order']."'");
		$row_cost = mysqli_num_rows($check_cost);
		?> -->

		<div class="form-group row">
				<h4 class="page-title"><b>Material Details</b></h4>

	<table id="example" class="table table-striped table-bordered">
		<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 12px;">
			<tr>
				<th>Accessories Name</th>
				<th>UOM</th>
				<th>Total Planed Pcs</th>
				<th>Consumption</th>
				<th>Total Qty</th>
				<!-- <th>Rate</th>
				<th>Total</th> -->
				<th>Loss</th>
				<!-- <!?php if($row_cost=="0"){?> -->
				<th><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
				<!-- <!?php } ?>	 -->
			</tr>
		</thead>
		<tbody>
		<?php 
		if ($_GET['id']!='' ) {
			$ass_group = mysqli_query($zconn,"select * from accessories_planning where planning_id='".$_GET['id']."'");
			$id=0;
			$tot_loss=0;
			while($assdata=mysqli_fetch_array($ass_group,MYSQLI_ASSOC)){ ?>
				<tr id="rowhide" value="<?php echo $id;?>" >
				<input type="hidden" name="rowid" id="rowid_<?php echo $id;?>" value="<?php echo $id;?>">
					<td>
						<select class="select2 form-control custom-select chosen-select" style="width:100px" name="acc_name[]" id="acc_name_<?php echo $id;?>">
						<option value="<?php echo $assdata['acc_name'];?>"><?php echo $assdata['acc_name'];?></option>
						<option>Select</option>
						<?php $sel_fabric = mysqli_query($zconn,"select * from accessories_master");
						while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
						if($res_fabric['acc_name']==$assdata['acc_name']){ ?>
						<option value="<?php echo $res_fabric['acc_name'];?>" selected><?php echo $res_fabric['acc_name'];?></option>
						<?php } else{?>
						<option value="<?php echo $res_fabric['acc_name'];?>"><?php echo $res_fabric['acc_name'];?></option>
						<?php } }?>
						</select>
						
					</td>
					<td>
						<select class="select2 form-control custom-select chosen-select" name="uom[]" style="width:120px;"> 
						<option value="<?php echo $assdata['uom'];?>"><?php echo $assdata['uom'];?></option>
						<option>Select</option>
						<?php $sel_fabric = mysqli_query($zconn,"select * from uom_master where status='0'");
					while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
					if($res_fabric['uom_name']==$assdata['uom']){ ?>
						<option selected="selected" value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
					<?php } else{?>
						<option value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
					<?php } } ?>
				</select>
				<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
						</td>
						<td>
    <input type="text" name="order_qty[]" class="form-control order_qty" value="<?php echo $assdata['order_qty'];?>" onkeyup="cal_total();" onblur="cal_total();">
</td>
<td>
    <input type="text" class="form-control consumption"  name="consumption[]" value="<?php echo $assdata['consumption'];?>" autocomplete="off" onkeyup="cal_total();" onblur="cal_total();">
</td>
						<!-- <td>
							<textarea name="descr[]" id="descr" readonly ><?php echo $assdata['descr'];?></textarea>
						</td> -->
						<td>
							<input type="text" class="form-control" readonly  value="<?php echo $assdata['total_qty'];?>" id="rate0" name="total_qty[]" placeholder="total_qty" autocomplete="off" onkeyup="cal_amt('0');"  readonlyonblur="cal_amt('0');">
						</td>
						<!-- <td>
							<input type="text" class="form-control tramt" readonly  value="<!?php echo $assdata['total']; $tot +=$assdata['total'];?>" name="total[]" id="total0" readonly placeholder="Total">
						</td>-->
						<td>
							<input type="text" class="form-control acc_loss"  value="<?php echo $assdata['acc_loss']; $tot_loss +=$assdata['acc_loss'];?>" name="acc_loss[]" id="acc_loss0" placeholder="Total" >
						</td>
						<td>
							<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
						</td>
					</tr>
					<?php } 
						} else{
		$ass_group = mysqli_query($zconn,"select * from accessories_group_details where acc_group='".$_REQUEST['accessor_group']."'");
		$id=0;
		while($assdata=mysqli_fetch_array($ass_group,MYSQLI_ASSOC)){ ?>
		<tr id="rowhide" value="<?php echo $id;?>" >
		<input type="hidden" name="rowid" id="rowid_<?php echo $id;?>" value="<?php echo $id;?>">
		<td>
			<select class="select2 form-control custom-select" name="acc_name[]" id="acc_name_<?php echo $id;?>">
				<option>Select</option>
				<?php $sel_fabric = mysqli_query($zconn,"select * from accessories_master");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
				if($res_fabric['acc_name']==$assdata['acc_name']){ ?>
			<option value="<?php echo $res_fabric['acc_name'];?>" selected><?php echo $res_fabric['acc_name'];?></option>
			<?php } else{?>
				<option value="<?php echo $res_fabric['acc_name'];?>"><?php echo $res_fabric['acc_name'];?></option>
			<?php } }?>
			</select>
		</td>
		<td>
			<select class="select2 form-control custom-select" name="uom[]" style="width:120px;"> 
				<option>Select</option>
					<?php $sel_fabric = mysqli_query($zconn,"select * from uom_master where status='0'");
						while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
							if($res_fabric['uom_name']==$assdata['uom']){ ?>
							<option selected="selected" value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
					<?php } else{?>
	<option value="<?php echo $res_fabric['uom_name'];?>"><?php echo $res_fabric['uom_name'];?></option>
	<?php } } ?>
	</select>
				</td>
				<td>
    <input type="text" name="order_qty[]" class="form-control order_qty" value="<?php echo $assdata['order_qty'];?>" onkeyup="cal_total();" onblur="cal_total();">
</td>
<td>
    <input type="text" class="form-control consumption"  name="consumption[]" value="<?php echo $assdata['consumption'];?>" autocomplete="off" onkeyup="cal_total();" onblur="cal_total();">
</td>
						<!-- <td>
							<textarea name="descr[]" id="descr" readonly ><?php echo $assdata['descr'];?></textarea>
						</td> -->
						<td>
							<input type="text" class="form-control" readonly  value="<?php echo $assdata['total_qty'];?>" id="rate0" name="total_qty[]" placeholder="total_qty" autocomplete="off" onkeyup="cal_amt('0');"  readonlyonblur="cal_amt('0');">
						</td>
						<!-- <td>
							<input type="text" class="form-control tramt" readonly  value="<!?php echo $assdata['total']; $tot +=$assdata['total'];?>" name="total[]" id="total0" readonly placeholder="Total">
						</td>-->
						<td>
							<input type="text" class="form-control acc_loss"  value="<?php echo $assdata['acc_loss']; $tot_loss +=$assdata['acc_loss'];?>" name="acc_loss[]" id="acc_loss0" placeholder="Total" >
						</td>
						<td>
							<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
						</td>			</tr>
		<?php } }?>

		</tbody>
		<tbody>
			<tr id="delete_0">
				<td></td>
				<td></td>
				<td></td>
				<td><?php
	$sel_fabric = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master where order_no='".$_REQUEST['order_no']."' or order_no='".$sel_entry1['order_no']."'"),MYSQLI_ASSOC);
	$order=$sel_fabric['order_qty']*$tot;
?>
<input type="hidden" class="form-control" id="order_tot" value="<?php echo $sel_fabric['order_qty']; ?>" readonly placeholder="" ></td>
				<td>
						Accessories Total:
				</td>
				<td>
					<input type="text" class="form-control" id="grand_tot" name="grand_tot" value="<?php echo $tot; ?>" readonly placeholder="" style="border: 1px solid #000;">
				</td>
				<td>
					<input type="text" class="form-control" id="grand_loss" name="grand_loss" value="<?php echo $tot_loss; ?>" readonly placeholder="" style="border: 1px solid #000;">
				</td>
			</tr>
		</tbody>
	</table>
							<div class="border-top">
								<div class="card-body" style="margin-left: 250px;">
									<button type="submit" name="submit1" value="save" class="btn btn-success">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="accessories_requistion_list.php"><button type="button" class="btn btn-danger">List</button></a>
								</div>
							</div>
                        </div>
                    </div>
                </div>
                <!-- Sales chart -->
            </div>
            <!-- End Container fluid  -->
        </div>
        </div>
        <!-- End Page wrapper  -->
    </div>
    </form>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php');?>
            <!-- End footer -->
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	<script type="text/javascript">
		

	function cal_loss(){
		var loss=0;

		$('.acc_loss').each(function(){
			loss += parseFloat($(this).val());
		});

		$('#grand_loss').val(loss.toFixed(2));
	}

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

		$('#grand_tot').val(sum);
			//planning_total();
	}

function planning_total(){

	var ord = $('#order_tot').val();
	var tot=$('#grand_tot').val();	
	$('#grand_tot').val(tot*ord);
}

	<?php
	$sel_fabric = mysqli_query($zconn,"select * from accessories_master");
	$acc_list='';
	while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ 
		$acc_list .="<option value='".$res_fabric['acc_name']."'>".$res_fabric['acc_name']."</option>";
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
	//	$(this).attr("disabled", "disabled");
		var acc_list ="<?php echo $acc_list;?>";
		var uom_list ="<?php echo $uom_list;?>";

		var index = $("table tbody tr:last-child").index();
		var id=parseInt(index)+parseInt(1);
        var row = '<tr>' +
            '<td><select class="select2 form-control custom-select chosen-select" name="acc_name[]"><option> Select</option>'+acc_list+'</select></td>' +
            '<td><select class="select2 form-control custom-select chosen-select" name="uom[]"><option> Select</option>'+uom_list+'</select></td>' +
            '<td><input type="text" class="form-control" id="consumption'+id+'" placeholder="consumption" onkeyup="cal_amt('+id+');" onblur="cal_amt('+id+');" name="consumption[]"></td>' +
            '<td><textarea name="descr[]"></textarea></td>' +
            '<td><input type="text" class="form-control" id="rate'+id+'" placeholder="Rate" name="rate[]" onkeyup="cal_amt('+id+');" onblur="cal_amt('+id+');"></td>' +
            '<td><input type="text" class="form-control tramt" id="total'+id+'" name="total[]" readonly placeholder="Total" ></td>' +
			'<td><input type="text" class="form-control acc_loss" value="0" name="acc_loss[]" id="acc_loss'+id+'" placeholder="Total" onkeyup="cal_loss();"></td>'+
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +

        '</tr>';
    	$("table").append(row);
		$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
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
