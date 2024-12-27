<?php
include('includes/config.php');
include('includes/base_functions.php'); 

$sel_costing = mysqli_query($zconn,"select * from costing_entry_master where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'");
$costing_row = mysqli_num_rows($sel_costing);


if(isset($_REQUEST['s']) && $_REQUEST['s']!='---Select---'){

if($costing_row>0){	?>
	<div class="form-group">
		<h4 class="page-title"><b>Component Details</b></h4>
	</div>
	<table id="example" class="table table-striped table-bordered">
		<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
			<tr>
				<th>Indent No</th>
				<th>Style Code</th>
				<th>Pcs Weight</th>
				<th>Order Quantity + Excess</th>
				<th>Total Weight [KGS]</th>
			</tr>
		</thead>
        <tbody>
	 <?php
			$id = $_REQUEST['s'];

        	$coso = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);

			$cost_ido = $coso['id'];
			if ($cost_ido!='') {
				 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);
				 $sel_c = mysqli_query($zconn,"SELECT *  FROM `costing_entry_details` where costing_id='".$cos['id']."'");
				 $order = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `order_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'"),MYSQLI_ASSOC);	
			} else {
				 $cos = mysqli_fetch_array(mysqli_query($zconn,"SELECT * FROM `yarn_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$id[1]."'"),MYSQLI_ASSOC);

				 $sel_0 = mysqli_query($zconn,"SELECT *  FROM `yarn_entry_details` where yarn_id='".$cos['id']."'");
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

			while($resc = mysqli_fetch_array($sel,MYSQLI_ASSOC)){ 
			 	$pcs = mysqli_fetch_array(mysqli_query($zconn,"SELECT  pcs_weight FROM $tb where  $cond='".$coso['id']."'"),MYSQLI_ASSOC);

				$exc_cal = ($order['excess_percent']*$order['order_qty'])/100;
				$excess_cal = $order['order_qty']+$exc_cal;
				
				//	$print_order_qty = $order['order_qty']*$order['excess_percent'];
			$pcsweight = number_format($pcs['pcs_weight'], 2, '.', "");
			$tow =$pcsweight*$excess_cal;

			 	?>
				<tr>
					<td><?php echo $_REQUEST['b'];?><input type="hidden" name="order_no" class="form-control" value="<?php echo $_REQUEST['b'];?>"></td>
					<td><?php echo $_REQUEST['s'];?><input type="hidden" name="style_no" class="form-control" value="<?php echo $_REQUEST['s'];?>"></td>
					<td><?php echo $resc['pcs_weight'];?><input type="hidden" name="pcs_weight" class="form-control" value="<?php echo $resc['pcs_weight'];?>"></td>
					<td><?php echo $excess_cal;?><input type="hidden" name="order_qty" class="form-control"  value="<?php echo $order['order_qty'];?>"></td>
					<td><?php $ag = $pcs['pcs_weight']*$excess_cal;echo number_format($ag,2);?><input type="hidden" name="totweight" id="totweight" class="form-control" value="<?php  echo number_format($ag,2);?>"></td>
				</tr>
			<?php } ?>

        </tbody>
    </table>
<?php } ?>
    <br />
	
	  
	<hr>
	<legend><h4> Dyeing Planning Details</h4></legend>
	<div class="table-responsive">
    <div class="scroll-container" style="width: 100%; overflow-x: auto; max-height: 300px;">
<table id="example1" class="table table-striped table-bordered">
		<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
			<tr>
				<th>Fabric Name</th>
				<th>Colour</th>
				<th>Content</th>
				
				<th>Dia</th>
				<th>Gsm</th>
				<th>Component</th>
				<th>gram/component</th>
				<th>Order qty</th>
				<th>WGT</th>
			
				<th>Dye Loss</th>
				<th><button type="button"  class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
				<?php 
				$cost = mysqli_query($zconn,"SELECT * FROM `costing_entry_master` where order_no='".$_REQUEST['b']."' and style_no='".$_REQUEST['s']."'");
				$cos_rows = mysqli_num_rows($cost); ?>
				<th style="width:20px;"> <?php if($cos_rows==0){
				?>

				<?php } ?></th>
			</tr>
		</thead>
			<tbody>
		<?php

				$rows_costing=mysqli_fetch_array($cost);

				if($cos_rows>0){
					$cost_details = mysqli_query($zconn,"select * from dyeing_costing  where costing_no='".$rows_costing['id']."'");
					$cs=0;
					while($res_costing = mysqli_fetch_array($cost_details)){
?>

		<tr id="delete_<?php echo $cs;?>">
			<td>
					<?php 
					 $sel_fabrics = mysqli_query($zconn,"select * from fabric_master where status='0'");
					 $fabslist= '';
					 while($res_fabrics = mysqli_fetch_array($sel_fabrics,MYSQLI_ASSOC)){
						 if($res_costing['fabric_name']==$res_fabrics['fabric_name']){
							$fabslist .='<option selected value="'.$res_fabrics['fabric_name'].'">'.addslashes($res_fabrics['fabric_name']).'</option>';
						 } else {
							 $fabslist .='<option value="'.$res_fabrics['fabric_name'].'">'.addslashes($res_fabrics['fabric_name']).'</option>';
						 }
					 }
			?>
				<select class="select2 form-control custom-select" name="fabric_name[]"><option>Select</option>+++<?php echo $fabslist;?></select>
			</td>
			<td>
				<select class="select2 form-control custom-select" name="ycolor[]" id="ycolor0">
					<option value="">Select</option>
					<?php
					$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
					while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
						if($res_costing['color_name']==$res_ycolor['colour_name']){	?>
						<option selected  value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
						<?php } else { ?>
						<option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
						<?php } ?>
					<?php } ?>
				</select> 
			</td>

			<td>
				<select class="select2 form-control custom-select" name="content[]" id="content">
					<option value="">Select</option>
					<?php
					$sel_ycolor1 = mysqli_query($zconn,"select * from content_master where status='0'");
					while($res_ycolor1 = mysqli_fetch_array($sel_ycolor1,MYSQLI_ASSOC)){
						if($res_costing1['content_name']==$res_ycolor1['content_name']){	?>
						<option selected  value="<?php echo $res_ycolor1['content_name'];?>"><?php echo $res_ycolor1['content_name'];?></option>
						<?php } else { ?>
						<option value="<?php echo $res_ycolor1['content_name'];?>"><?php echo $res_ycolor1['content_name'];?></option>
						<?php } ?>
					<?php } ?>
				</select> 
			</td>
			<!-- <td><input type="text" name="dia[]"  class="form-control" id="dia"  onKeyUp="multiply()" required autocomplete="off"></td> -->
			<td>
				<select class="select2 form-control custom-select" id="dia" name="dia[]">
				<option value="">Select</option>
				<?php $sel_ycounts = mysqli_query($zconn,"select * from dia_master where status='0'");
				while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
				<option value="<?php echo $res_ycounts['dia_name'];?>"><?php echo $res_ycounts['dia_name'];?></option>
				<?php } ?>
				</select>
				</td>
				<!-- <td>
					<input type="text" name="gsm[]"  class="form-control " id="gsm" required onKeyUp="multiply_loss()">
				</td> -->

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
										<select class="select2 form-control custom-select chosen-select" name="ycomp[]" id="ycomp<?php echo $co;?>">
										<option value="">Select</option>
										<?php $selcomp = mysqli_query($zconn,"select * from components where status='0'");
										while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
											if($res_costing['comp_id']==$res_comp['comp_name']){
										?>
										<option selected value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
											<?php } else { ?>
											<option value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } 
										} ?>
										</select>
										</td>
										<td>
            <input type="text" name="gram_component[]" class="form-control gram_component" onKeyUp="calculateWeight(this)" required autocomplete="off">
        </td>
        <td>
            <?php echo $excess_cal; ?>
            <input type="hidden" name="excess_cal[]" class="form-control" value="<?php echo $order['order_qty'] + $exc_cal; ?>">
        </td>
        <td>
            <input type="text" name="weight[]" class="form-control weight"  onKeyUp="calculateTotalWeight(this)" readonly autocomplete="off">
        </td>
			<td>
					<input type="text" name="dye_loss[]"  class="form-control dye_loss" id="dye_loss" required onKeyUp="multiply_loss()">
									</td>
									<td>
					<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
				</td>
				
		</tr>
			<?php } ?>
			<?php } else { ?>
			<tr id="delete_0">
				<td>
					<input type="text" class="form-control totl" id="fabric_name" name="fabric_name[]"  value="<?php echo $resc['fabric_name'];?>" readonly>
					<?php 
					 $sel_fabrics = mysqli_query($zconn,"select * from fabric_master where status='0'");
					 $fabslist= '';
					 while($res_fabrics = mysqli_fetch_array($sel_fabrics,MYSQLI_ASSOC)){
						 if($res_costing['fabric_name']==$res_fabrics['fabric_name']){
							$fabslist .='<option selected value="'.$res_fabrics['fabric_name'].'">'.addslashes($res_fabrics['fabric_name']).'</option>';
						 } else {
							 $fabslist .='<option value="'.$res_fabrics['fabric_name'].'">'.addslashes($res_fabrics['fabric_name']).'</option>';
						 }
					 }
			?>
				<select class="select2 form-control custom-select" name="fabric_name[]"><option>Select</option><?php echo $fabslist;?></select>
				</td>
				<td>
					<select class="select2 form-control custom-select" name="ycolor[]" id="ycolor0">
					<option value="">Select</option>
						<?php
						$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
						while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){?>
							<option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
						<?php } ?>
					</select> 
				</td>
				<td>
					<input type="text" class="form-control" id="lab" name="lab[]" autocomplete="off">
				</td>
				<td>
<input type="text" name="pcs_weight[]" class="form-control pcs_weight" id="pcs_weight" onChange="calculatePercentageLoss(this); multiply();" required>
				</td>
				<td>
					<input type="text" name="dye_loss[]"  class="form-control dye_loss" id="dye_loss" required  onKeyUp="multiply_loss()">
				</td>
				<!--td>
					<input type="text" id="percentage_input" onKeyUp="calculateTotal()" required>
				</td-->
				<td>
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
            <input type="text" class="form-control " id="grandTotal"  name="grand_total" readonly placeholder="" style="border: 1px solid #000;" >
			<!-- <div id="grandTotal">Grand Total: 0</div> -->
        </td>
        <td width="8%">
            <input type="text" class="form-control" id="total_dye_loss" name="total_dye_loss" readonly placeholder="" style="border: 1px solid #000;">
        </td>
					<td width="7%">		<!--td>
        <input type="text" class="form-control percentage_loss" readonly style="border: 1px solid #000;">
      </td-->
				</tr>
			</table>

						

			<div class="border-top">
				<div class="card-body" style="margin-left: 250px;">
					<button type="submit" name="save" class="btn btn-success" value="<?php echo $action;?>">Save</button>
					<button type="reset" class="btn btn-primary">Reset</button>
					<a href="dyeing_planning_list.php"><button type="button" class="btn btn-danger">List</button></a>
				</div>
			</div>
	</tbody>
</table>
						
<?php } ?>
<script src="dist/js/custom.min.js"></script>
	<?php

		$sel_fabrics = mysqli_query($zconn,"select * from fabric_master where status='0'");
		$fabslist= '';
		while($res_fabrics = mysqli_fetch_array($sel_fabrics,MYSQLI_ASSOC)){
			$fabslist .='<option value="'.$res_fabrics['fabric_name'].'">'.addslashes($res_fabrics['fabric_name']).'</option>';
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


		
		$sel_ycounts = mysqli_query($zconn,"select * from dia_master where status='0'");
		$ycountlist= '';
		while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
		   $ycountlist .='<option value="'.$res_ycounts['dia_name'].'">'.addslashes($res_ycounts['dia_name']).'</option>';
		}

		$sel_ycoun = mysqli_query($zconn,"select * from gsm_master where status='0'");
		$ygsm ='';
		while($res_ycoun = mysqli_fetch_array($sel_ycoun,MYSQLI_ASSOC)){
			$ygsm .='<option value="'.$res_ycoun['gsm_name'].'">'.addslashes($res_ycoun['gsm_name']).'</option>';
		}

		$selcomp = mysqli_query($zconn,"select * from components where status='0'");
		$comp_list='';
		while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
			$comp_list .='<option value="'.$res_comp['comp_name'].'">'.$res_comp['comp_name'].'</option>';
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
        var row = '<tr >' +
            '<td><select class="select2 form-control custom-select" name="fabric_name[]" id="fabric_name'+newc+'"><option>Select</option><?php echo $fabslist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="ycolor'+newc+'" name="ycolor[]"><option> Select</option><?php echo $color_list;?></select></td>' +
			'<td><select class="select2 form-control custom-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $content_list;?></select></td>' +
			'<td><select class="select2 form-control custom-select" id="dia'+newc+'" name="dia[]"><option> Select</option><?php echo $ycountlist;?></select></td>' +
			'<td><select class="select2 form-control custom-select" id="gsm'+newc+'" name="gsm[]"><option> Select</option><?php echo $ygsm;?></select></td>' +

			//'<td><input type="text" name="dia[]"  class="form-control" id="dia"  onKeyUp="multiply()" required autocomplete="off"></td>' +
			//'<td><input type="text" name="gsm[]"  class="form-control " id="gsm" required onKeyUp="multiply_loss()"></td>' +
			'<td><select class="select2 form-control custom-select chosen-select" name="ycomp[]" id="ycomp'+newc+'"><option>Select</option><?php echo $comp_list;?></select></td>' +
			'<td><input type="text" name="gram_component[]" class="form-control gram_component" onKeyUp="calculateWeight(this)" required autocomplete="off"></td>' +
			'<td><?php echo $excess_cal; ?> <input type="hidden" name="excess_cal[]" class="form-control" value="<?php echo $order['order_qty'] + $exc_cal; ?>"></td>' +
			'<td> <input type="text" name="weight[]" class="form-control weight" readonly autocomplete="off"></td>'+
			'<td><input type="text" name="dye_loss[]"  class="form-control dye_loss" id="dye_loss" required onKeyUp="multiply_loss()"></td>'+
			'<td><a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
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
	//input_sum_calculate_yarn_amount(id);
	sum_grand();
}

function cal_amount(id) {
    var t1 = document.getElementById('pcs_weight'+id).value;
    var t2 = document.getElementById('yrate'+id).value;
    var t3 = parseFloat(t1)*parseFloat(t2);
	document.getElementById('ytotal'+id).value = parseFloat(t3).toFixed(2);
  //  input_sum_calculate_yarn();
  sum_grand();
}


	
	

	
	
	
	function multiply_loss(){
	var sum=0;
	var twgt = $('#totweight').val();
	$('.dye_loss').each(function(index, element){
		if($(element).val()!="")
			sum += parseFloat($(element).val());
	});
	 $('#total_dye_loss').val(sum.toFixed(2));
}
	
	function multiply(){
	var sum=0;
	var twgt = $('#totweight').val();
	$('.weight').each(function(index, element){
		if($(element).val()!="")
			sum += parseFloat($(element).val());
	});

	if(parseFloat(sum)>parseFloat(twgt)){
		$('#grand_total').css('border-color', 'red');
	 } else {
		 $('#grand_total').css('border-color', '#000');
	 }
		 $('#grand_total').val(sum.toFixed(2));
}
	
function calculatePercentageLoss() {
  // Calculate the total pcs weight and total dye loss
  var totalPcsWeight = 0;
  var totalDyeLoss = 0;

  // Calculate the total pcs weight and total dye loss
  $('.pcs_weight').each(function(index, element) {
    var pcsWeight = parseFloat($(element).val()) || 0;
    totalPcsWeight += pcsWeight;
  });

  $('.dye_loss').each(function(index, element) {
    var dyeLoss = parseFloat($(element).val()) || 0;
    totalDyeLoss += dyeLoss;
  });

  console.log("Total Pcs Weight: " + totalPcsWeight); // Log total pcs weight
  console.log("Total Dye Loss: " + totalDyeLoss); // Log total dye loss
  
  // Calculate the percentage loss
  var percentageLoss = (totalDyeLoss /100 ) * totalPcsWeight || 0;
  
  console.log("Percentage Loss: " + percentageLoss.toFixed(2) ); // Log percentage loss
  
  // Calculate the adjusted Total Pcs Weight
  var adjustedTotalPcsWeight = totalPcsWeight - percentageLoss ;
  
  console.log("Adjusted Total Pcs Weight: " + adjustedTotalPcsWeight); // Log adjusted total pcs weight

  // Set the Percentage Loss value as the result string
  $('.percentage_loss').val(adjustedTotalPcsWeight.toFixed(2) );
  
  // Display the adjusted Total Pcs Weight
  $('.adjusted_total_pcs_weight').val(adjustedTotalPcsWeight.toFixed(2));
}

// Call the calculatePercentageLoss function when inputs change
$('.pcs_weight, .dye_loss').on('input', calculatePercentageLoss);




</script>









<script type="text/javascript">
    function calculateWeight(input) {
        var row = input.closest('tr');
        var gramComponentInput = row.querySelector(".gram_component");
        var excessCalInput = row.querySelector("input[name='excess_cal[]']");
        var weightInput = row.querySelector(".weight");
		

        var gramComponentValue = parseFloat(gramComponentInput.value);
        var excessCalValue = parseFloat(excessCalInput.value);

        if (!isNaN(gramComponentValue) && !isNaN(excessCalValue)) {
            var result = gramComponentValue * excessCalValue;
            weightInput.value = result;
        } else {
            weightInput.value = "";
        }



		
        // Calculate individual weight
        var gramComponentValue = parseFloat(gramComponentInput.value);
        var excessCalValue = parseFloat(excessCalInput.value);

        if (!isNaN(gramComponentValue) && !isNaN(excessCalValue)) {
            var result = gramComponentValue * excessCalValue;
            weightInput.value = result;

            // Calculate grand total
            var allWeights = document.querySelectorAll(".weight");
            var grandTotal = 0;

            allWeights.forEach(function(weight) {
                if (weight.value !== "") {
                    grandTotal += parseFloat(weight.value);
                }
            });

            // Display grand total in the input field
            var grandTotalInput = document.getElementById("grandTotal");
            grandTotalInput.value = grandTotal.toFixed(2); // Set the total with two decimal places
        } else {
            weightInput.value = "";
        }
    }
   

</script>
<script src="dist/js/custom.min.js"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('.weight').on('input', calculateTotalWeight);
    });

    function calculateTotalWeight() {
        var totalWeight = 0;
        $('.weight').each(function() {
            var weightValue = parseFloat($(this).val()) || 0;
            totalWeight += weightValue;
        });

        $('#grand_total1').val(totalWeight.toFixed(2));
    }
</script>






