<?php
include('includes/config.php');
include('includes/base_functions.php');

$sel_costing = mysqli_query($zconn,"select * from costing_entry_master where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'");
$costing_row = mysqli_num_rows($sel_costing);

if(isset($_REQUEST['s']) && $_REQUEST['s']!='---Select---'){

 ?>
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
        	<?php
        	 $coso = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
			 $cost_ido=$coso['id'];
			 if ($cost_ido!='') {
			 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
			
			 $sel_c = mysqli_query($zconn,"SELECT *  FROM `costing_entry_details` where costing_id='".$cos['id']."'");
			 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);	
			 }
			 else{
			 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
			 $sel_0 = mysqli_query($zconn,"SELECT * FROM `order_quantity_details` where yarn_id='".$cos['id']."'");

			 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
			 }

			if ($sel_c!='') {
				$sel=$sel_c;
				$tb="costing_entry_details";
				$cond="costing_id";
			} else {
				$sel=$sel_0;
				$tb="yarn_entry_details";
				$cond="yarn_id";
			}
			$tow =0;
			while($resc=mysqli_fetch_array($sel)){ 
			 	$pcs = mysqli_fetch_array(mysqli_query($zconn,"SELECT  pcs_weight FROM $tb where  $cond='".$cos['id']."'"),MYSQLI_ASSOC);

				//var_dump($resc);

			//	$exc_cal = ($order['excess_percent']*$order['order_qty'])/100;
				$exc_cal = ($order['excess_percent']*$order['cutting_qty'])/100;
				$excess_cal = $order['cutting_qty'];

			//	$print_order_qty = $order['order_qty']*$order['excess_percent'];
			$pcsweight = number_format($resc['pcs_weight'], 2, '.', "");
			$tow =$pcsweight*$excess_cal;
			 	?>
				<tr>
					<td><?php echo $_REQUEST['b'];?></td>
					<td><?php echo $_REQUEST['s'];?></td>
					<td><?php echo $pcsweight;?><input type="hidden" name="pcs_weight" class="form-control" value="<?php echo $resc['pcs_weight'];?>"></td>
					<td><?php echo $excess_cal;?><input type="hidden" name="order_qty" class="form-control"  value="<?php echo $excess_cal;?>"></td>
					<td><?php echo number_format($tow, 2, '.', "");?><input type="hidden" name="totweight[]" class="form-control" value="<?php echo number_format($tow, 2, '.', "");?>" id="totweight"></td>
				</tr>
			<?php }
			 ?>
    </table>
<?php } ?>
    <br />
	<hr>
	<legend><h4> Knitting Planning Details</h4></legend>

<table id="example1" class="table table-striped table-bordered">
 <thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
			<tr>
				<th style="width:15%;">Fabric Name</th>
				<th style="width:15%;">Content</th>
				<th style="width:10%;">Colour</th>
				<th style="width:6%;">DIA</th>
				<th style="width:6%;">GSM</th>
				<th style="width:7%;">F DIA</th>
				<th style="width:6%;">F GSM</th>
				<th style="width:5%;">Gauge</th>
				<th style="width:6%;">L.Length</th>
				<th style="width:6%;">Pcs.wgt</th>
				<th style="width:10%;">WGT</th>
				<th style="width:6%;">K.Loss</th>
				<th style="width:2%;"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
			</tr>
		</thead>

		 <?php
	$cos0 = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
	$cost_id0=$cos0['id'];
			if ($cost_id0!='') {
				 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
				 $cost_id=$cos['id'];
				 $get_cos = mysqli_query($zconn,"SELECT *FROM `costing_entry_details` where costing_id='".$cos['id']."'");
				 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
			} else {
				$cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
				$cost_id=$cos['id'];
				$get_cos1 = mysqli_query($zconn,"SELECT * FROM `order_quantity_details` where yarn_id='".$cos['id']."'");
				$order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
			}

			if ($get_cos!='') {
				$get=$get_cos;
				$tbl="costing_entry_details";
				$cond="costing_id";
			} else {
				$get=$get_cos1;
				$tbl="costing_entry_details";
				$cond="yarn_id";
			}

		while($resc = mysqli_fetch_array($get,MYSQLI_ASSOC)){
			$pcs = mysqli_fetch_array(mysqli_query($zconn,"SELECT  * FROM $tbl where  $cond ='".$cos['id']."'"),MYSQLI_ASSOC);
	 		$people = $resc['fabric_name'];

			$exc_cal = ($order['excess_percent']*$order['cutting_qty'])/100;
			$excess_cal = $order['cutting_qty'];
?>


		<tbody>
			<tr id="delete_0">
				<td>
					<input type="text" class="form-control totl" id="fabric_name" name="fabric_name[]"  value="<?php echo $resc['fabric_name'];?>" readonly>
				</td>
			   <td>
			   <?php 

			    $count=1;
				$y=$count;
				$contentlist='';
				for ($x = 1; $x <= $y; $x++) {
					$cos123456 = mysqli_query($zconn, "SELECT * FROM $tbl where $cond='".$cost_id."'  order by id asc");
					 while($cos1236 = mysqli_fetch_array($cos123456,MYSQLI_ASSOC)){
						$ycont = $cos1236['yarn_content'].",";
					}
					$contentlist= substr($ycont,0,-1);
				}

				?>
			   	<input name="content[]" id="content0" class="form-control" readonly value="<?php echo $contentlist;?>">

				</td>
				<td>
				<?php 
				$count=1;
				$y=$count;
				for ($x = 1; $x <= $y; $x++) {
					$cos12345 = mysqli_query($zconn, "SELECT * FROM $tbl where $cond='".$cost_id."'  order by id asc");
					 while($cos123=mysqli_fetch_array($cos12345,MYSQLI_ASSOC)){
						$clr=$cos123['yarn_colour'].",";
				}
				$clr=substr($clr,0,-1);
			}
			?>
	<?php if($clr!=''){ ?>
			<input class="form-control" name="ycolor[]" id="ycolor0" value="<?php echo $clr;?>">
	<?php } else { ?>
			<select class="form-control" name="ycolor[]" id="ycolor0">
			<option value="">--Select--</option>
			<?php
				   $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
	   $color_list='';
		while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
			$color_list .='<option value="'.$res_ycolor['colour_name'].'">'.$res_ycolor['colour_name'].'</option>';
		}
			echo $color_list;
			?>

			</select>
	<?php } ?>
			</td>
			<td>
				<select class="select2 form-control custom-select" id="dia" name="dia[]">
				<option value="">Select</option>
				<?php $sel_ycounts = mysqli_query($zconn,"select * from dia_master where status='0'");
				while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
				<option value="<?php echo $res_ycounts['dia_name'];?>"><?php echo $res_ycounts['dia_name'];?></option>
				<?php } ?>
				</select>
				</td>
				
			<td>
				<select class="select2 form-control custom-select" id="gsm" name="gsm[]">
				<option value="">Select</option>
				<?php $sel_ycounts = mysqli_query($zconn,"select * from gsm_master where status='0'");
				while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
				<option value="<?php echo $res_ycounts['gsm_name'];?>"><?php echo $res_ycounts['gsm_name'];?></option>
				<?php } ?>
				</select> 
			</td>
			
				<td>
			<select class="select2 form-control custom-select" id="f_dia" name="f_dia[]">
				<option value="">Select</option>
				<?php $sel_ycounts = mysqli_query($zconn,"select * from dia_master where status='0'");
				while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
				<option value="<?php echo $res_ycounts['dia_name'];?>"><?php echo $res_ycounts['dia_name'];?></option>
				<?php } ?>
				</select>
		</td>
		<td>
		<select class="select2 form-control custom-select" id="f_gsm" name="f_gsm[]">
				<option value="">Select</option>
				<?php $sel_ycounts = mysqli_query($zconn,"select * from gsm_master where status='0'");
				while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
				<option value="<?php echo $res_ycounts['gsm_name'];?>"><?php echo $res_ycounts['gsm_name'];?></option>
				<?php } ?>
				</select> 
		</td>
		<td>
		<input type="text" class="form-control" id="gauge" name="gauge[]" autocomplete="off">
		</td>
		<td>
		<input type="text" class="form-control" id="loop" name="loop[]" autocomplete="off">
		</td>
		<td>
		<?php $pcsweight = number_format($resc['pcs_weight'], 2, '.', "");?>
		<input type="text" class="form-control" readonly id="pcs_weight" name="pcs_weight[]" autocomplete="off" value="<?php echo $pcsweight;?>">
		</td>
		<td>
		
		<input type="text" class="form-control weight" readonly id="weight" required value="<?php // $pcsweight*$excess_cal;
			$totwgt +=($pcsweight*$excess_cal); echo number_format($pcsweight*$excess_cal,2);?>" name="weight[]" onKeyUp="multiply()" autocomplete="off">
		</td>
		<td><input type="text" name="knit_loss[]"  class="form-control knit_loss" id="knit_loss" onKeyUp="multiplykl()" required></td>
		<td>
			<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
		</td>
				</tr>
		<?php } ?>
</tbody>
<tfoot>
				<tr id="1">
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td></td>
					<td>
					  <h6 class="page-title">Yarn Total:</h6></td>
					<td colspan="">
				<input type="text" class="form-control" id="grand_total" value="<?php echo number_format($totwgt,2);?>" name="grand_total" readonly placeholder="" style="border: 1px solid #000;">
					</td>
					<td><input type="text" class="form-control" id="tot_knit_loss" value="<?php ?>" name="tot_knit_loss" readonly placeholder="" style="border: 1px solid #000;">
					
				</tr>
			</tfoot>
		</table>
		<div class="border-top">
			<div class="card-body" style="margin-left: 250px;">
				<button type="submit" name="save" class="btn btn-success" value="<?php echo $action;?>">Save</button>
				<button type="reset" class="btn btn-primary">Reset</button>
				<a href="knitting_planning_list.php"><button type="button" class="btn btn-danger">List</button></a>
			</div>
		</div>
	</tbody>
</table>
<?php } ?>
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