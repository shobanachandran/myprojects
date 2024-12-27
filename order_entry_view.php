<?php
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);
date_default_timezone_set('UTC');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_REQUEST);
print_r($_FILES);
echo "</pre>";*/
$order_id1 = $_GET['order_id'];
$sel_order1 = mysqli_fetch_array(mysqli_query($zconn, "SELECT ce.*, oem.*
          FROM costing_entry_details ce
          JOIN order_entry_master oem ON ce.costing_id = oem.costing_no
          WHERE oem.order_id = '".$order_id1."'"), MYSQLI_ASSOC);
 $brand=$sel_order1['brand'];
 $sub_brand=$sel_order1['sub_brand'];
//var_dump($sel_order1); // This will display the fetched data from both tables


if($_GET['order_id']!=''){
	$sel_order = mysqli_fetch_array(mysqli_query($zconn,"select * from order_entry_master where order_id='".$_GET['order_id']."'"),MYSQLI_ASSOC);
	$costing_no = $sel_order['costing_no'];
	$sel_combo  = $sel_order['combo_colour'];
	$size_group = $sel_order['size_group'];
	$buyer_name = $sel_order['buyer_name'];
	$orer_no 	= $sel_order['order_no'];
	$style_no 	= $sel_order['style_no'];
	$pono		= $sel_order['po_no'];
	$season_name = $sel_order['season'];
	$order_qty = $sel_order['order_qty'];
	$cutting_qty = $sel_order['cutting_qty'];
	$excess_per = $sel_order['excess_percent'];
     $desc=$sel_order['description'];
	// $excess_pcs = $sel_order['excess_pcs'];
	$shipment_date = $sel_order['shipment_date'];
$created_at = $sel_order['created_date'];
$date_only = date("d-m-Y", strtotime($created_at));

//echo $date_only; // This will display the date in dd-mm-yyyy format

$uom=$sel_order['uom'];
	// $ship_date_arr = explode("/",$sel_order['shipment_date']);
	// $shipment_date = $ship_date_arr['2']."-".$ship_date_arr['1']."-".$ship_date_arr['0'];
	// $del_date_arr = explode("/",$sel_order['factory_delivery']);
	// $delivery_date = $del_date_arr['2']."-".$del_date_arr['1']."-".$del_date_arr['0'];	
	$delivery_date = $sel_order['factory_delivery'];
} else {
	$costing_no = $_REQUEST['costing_no'];
	$sel_combo  = $_REQUEST['color'];
	$size_group = $_REQUEST['size_group_name'];
	$buyer_name = $_REQUEST['buyer_name'];
	$style_no 	= $_REQUEST['style_no'];
	$pono		= $_REQUEST['po_no'];
	$season_name = $_REQUEST['season_name'];
	// $ship_date_arr = explode("/",$_REQUEST['shipment_date']);
	// $shipment_date = $ship_date_arr['2']."-".$ship_date_arr['1']."-".$ship_date_arr['0'];
	$shipment_date = $_REQUEST['shipment_date'];
	$order_qty = $_REQUEST['order_qty'];
	$cutting_qty = $_REQUEST['cutting_qty'];
	$excess_per = $_REQUEST['excess_per'];
	// $excess_pcs = $_REQUEST['excess_pcs'];
	// $del_date_arr = explode("/",$_REQUEST['delivery_date']);
	// $delivery_date = $del_date_arr['2']."-".$del_date_arr['1']."-".$del_date_arr['0'];
	$delivery_date = $_REQUEST['delivery_date'];
    $desc=$_REQUEST['description'];
}
//var_dump($sel_order);


if(isset($_POST['save_costing'])){
	// $ship_date_arr = explode("/",$_POST['shipment_date']);
	// $shipment_date = $ship_date_arr['2']."-".$ship_date_arr['1']."-".$ship_date_arr['0'];
	$shipment_date = $_POST['shipment_date'];
	// $del_date_arr = explode("/",$_POST['delivery_date']);
	// $delivery_date = $del_date_arr['2']."-".$del_date_arr['1']."-".$del_date_arr['0'];
	$delivery_date = $_POST['delivery_date'];
	$update_order_id = $_REQUEST['edit_order_id'];
	if($_POST['cutting_quantity_type'] == "Percentage") {
		$excess_per = $_REQUEST['excess_per'];
	} else if ($_POST['cutting_quantity_type'] == "Value") {
		$excess_per = '';
	} else {
		$excess_per = '';
	}
	




	echo "<script>alert('Order updated successfully!!!');</script>";
	echo "<script>window.location.href='order_entry.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - Order Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<head>

    <style>
        body {
            font-family: Arial, sans-serif;
        }

        @media print {
            @page {
                size: A4; /* Set the paper size */
                margin: 1cm; /* Adjust the margin as needed */
            }
            body {
                margin: 0; /* Remove any default margin */
            }
            .card {
                page-break-after: always; /* Start each card on a new page */
            }
        }

        .container-fluid {
            display: flex;
            flex-wrap: wrap;
        }

        .card {
            margin: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            background-color: #fff;
            width: 100%;
        }

        .card-half {
            width: 50%;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: none;
            padding: 2px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <!--?php include('includes/header.php');?-->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!--?php include('includes/sidebar.php');?-->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
    
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
         
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Sales chart -->
	<form name="costing_entry" id="costing_entry" method="post" novalidate enctype="multipart/form-data">
		<input type="hidden" name="edit_order_id" id="edit_order_id" value="<?php echo $_GET['order_id'];?>">
                <div class="row">
                    <div class="col-md-12">
						 <div class="card" style="border:none">
							 
				<table style=" border: 1px groove black;">
					<tr>
    <td height="20" width="100%" colspan="2" align="center" valign="middle" bgcolor="" style="border:1px groove black; color: black;text-align: center"><h3>Order Report
    </h3></td>
  </tr>
					<table style="border: 1px groove black;border-top : none;">
			 <tr>
             <td width="40%" align="left" valign="top"
        style="padding-left:10px; padding-top:5px; padding-bottom:5px; font-size:17px;">
        <img src="assets/images/LOGO VAMAN EXPORTS .png
" alt="Your Company Logo" style="max-width: 500px; height: 100px;"><br>
    </td>
    <td width="60%" align="center" valign="top"
        style="padding-left:0px; padding-top:10px; padding-bottom:10px; font-size:17px;text-align:center;">
       2	SF NO.355/B1 - A, VIVID GARDEN,  Dharapuram Tiruppur Road, Government Adi Dravidar Welfare High School, KOVIL VAZHI, K Chettipalayam, Tiruppur, <br>Tamil Nadu, 641606
 

    
    </td>
</tr>
</table>	
					<table style="border-top:none;">
		<tr>
    <td style="border-left: 1px groove black; border-right: 1px groove black; padding-left: 10px; text-align: left; width:50%;">
        <strong>Costing No :</strong>&nbsp;<?php echo $costing_no; ?><br>
    </td>
    <td style="border-left: 1px groove black; border-right: 1px groove black; padding-left: 10px; text-align: left; width: 50%;">
        <strong>Order Date :</strong>&nbsp;<?php echo $date_only; ?><br>
    </td>
</tr>
 </table>	
			
	<table style="border-top:1px groove black;">
    <tr>
        <!-- First column (Buyer Name and Season) -->
        <td style="border-left: 1px groove black; border-right: 1px groove black; padding-left: 10px; text-align: left; width: 50%;">
            <strong>Buyer Name:</strong>&nbsp;<?php echo $buyer_name; ?><br>
            <strong>Season:</strong>&nbsp;<?php echo $season_name; ?><br>
            <strong>Brand:</strong>&nbsp;<?php echo $brand; ?><br>
            <strong>Sub Brand:</strong>&nbsp;<?php echo $sub_brand; ?><br>
			
			<strong>Indent No:</strong>&nbsp;<?php echo $orer_no; ?><br>
			  <strong>Style Code:</strong>&nbsp;<?php echo $style_no; ?><br>
            <strong>Shipment Date:</strong>&nbsp;<?php echo date('d-m-Y', strtotime($shipment_date)); ?>
			

        </td>

        <!-- Second column (Order No, Shipment Date, Style No, and Delivery Date) -->
        <td style="border-left: 1px groove black; border-right: 1px groove black; padding-left: 10px; text-align: left; width: 40%;">
            
          
            <strong>Factory Delivery Date:</strong>&nbsp;<?php echo date('d-m-Y', strtotime($delivery_date)); ?><br>
			   <strong>PO No:</strong>&nbsp;<?php echo $pono; ?><br>
            <strong>Order Qty:</strong>&nbsp;<?php echo $order_qty. ' ' .$uom; ?><br>
			<strong>Cutting Qty:</strong>&nbsp;<?php echo $cutting_qty. ' ' .$uom; ?><br>
            <strong>Size Group:</strong>&nbsp;<?php echo $size_group; ?><br>
			
			<strong>Excess:</strong>&nbsp;<?php echo $excess_per;?>
			<?php	if($excess_per != "") {
	 echo "%";
												$per_selected = "checked";
												$man_selected = "";
												$per_input_style = "";
												$man_input_style = "display:none";
												$cutting_style = "readonly";
											} else {
	 echo "Manual)";
												$per_selected = "";
												$man_selected = "checked";
												$man_input_style = "";
												$per_input_style = "display:none";
												$cutting_style = "";
											}
			
			?><br>
            <strong>Description:</strong>&nbsp;<?php echo $desc; ?><br>

        </td>

       
     <!-- Third column (PO No, Order Qty, Size Group, and Image) -->
<td style="border: 1px groove black; padding: 5px; text-align: left; width: 10%;">
    <?php
    // Replace with your code to retrieve and display the image
    $orderID = $_GET['order_id']; // Replace with the actual order_id you want to fetch

    // Prepare a SQL query to fetch the image source based on the order ID
    $query = "SELECT order_image FROM order_entry_master WHERE order_id = ?";

    // Use prepared statement to prevent SQL injection
    if ($stmt = $zconn->prepare($query)) {
        $stmt->bind_param("s", $orderID); // Assuming order_id is a string, use "i" for integer
        $stmt->execute();
        $stmt->bind_result($imageSrc);

        // Fetch the result
        $stmt->fetch();

        // Close the statement
        $stmt->close();
    }

    // Debugging
    if (isset($imageSrc)) {
        // echo 'Image Source: ' . $imageSrc;
        echo '<img src="' . $imageSrc . '" alt="Image Description" style="max-width: 100%; height: auto; border: none;">';
    } else {
        echo 'Image not found for this order.';
    }
    ?>
</td>


    </tr>
    <tr>
        <!-- Cell for the third column with the image -->
        <td colspan="3" align="center" valign="top" style="border: 1px groove black;">
         
        </td>
    </tr>
</table>
<table style="border:none;">				
								
        <tr style="border:none; color: black;">
           <td height="20" colspan="2" align="center" valign="middle" bgcolor="" style="border:1px groove black;border-top:none;  color: black;">
    <!--div class="col-md-9" style="float:left;">
        <h3>Order Quantity</h3>
    </div>
    <table id="example" class="" border="1px groove black" style="width:100%;">
        <thead style="background-color: #626F80; color: black; padding: 5px; font-size: 16px;">
            <tr>
                <th style="width:50px;">Colour</th>
                <?php
                $size_sql = mysqli_query($zconn, "select * from size_groups where size_group_name='" . $size_group . "'");
                $res_size = mysqli_fetch_array($size_sql, MYSQLI_ASSOC);
                $sizeids = explode(",", $res_size['size_ids']);
                for ($ij = 0; $ij < count($sizeids); $ij++) { ?>
                    <th style="width:50px;">
                        <input type="hidden" name="size_ids1[]" style="width:100px;" value="<?php echo $sizeids[$ij]; ?>">
                        <input type="text" value="<?php echo $sizeids[$ij]; ?>" name="sizes1[]" style="border:none; width:50px; background-color:#27A9E3; color:#fff; font-weight:bold;" readonly>
                    </th>
                <?php } ?>
                <th style="width:50px;">Total</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sel_order_det = mysqli_query($zconn, "SELECT * 
                FROM  `order_quantity_details` WHERE  `order_id` ='" . $_GET['order_id'] . "' GROUP BY row_id");
            while ($res_order_det = mysqli_fetch_array($sel_order_det, MYSQLI_ASSOC)) {
            ?>
                <tr>
                    <td>
                        <input type="text" readonly name="order_colour[]"  value="<?php echo $res_order_det['color']; ?>">
                    </td>
                    <?php
                    $size_sql = mysqli_query($zconn, "select * from size_groups where size_group_name='" . $size_group . "'");
                    $res_size = mysqli_fetch_array($size_sql, MYSQLI_ASSOC);
                    $sizeids = explode(",", $res_size['size_ids']);
                    $rowTotal = 0;
                    for ($ij = 0; $ij < count($sizeids); $ij++) {
                        $sel_details = mysqli_fetch_array(mysqli_query($zconn, "select * from order_quantity_details where order_id='" . $_GET['order_id'] . "' and row_id='" . $res_order_det['row_id'] . "' and size_id='" . $sizeids[$ij] . "'"), MYSQLI_ASSOC);
                        $qty_val = $sel_details['qty_val'];
                        $rowTotal += $qty_val;
                    ?>
                        <td>
                            <input type="text" class="orderqty" onkeyup="cal_orderqty(this);" name="order_sizes<?php echo $sizeids[$ij]; ?>[]" style="width:100px;" value="<?php echo $qty_val; ?>">
                        </td>
                    <?php } ?>
                    <td>
                        <input type="text" class="rowTotal orderTotal" style="width:100px;" value="<?php echo $rowTotal; ?>" readonly>
                    </td>
                </tr>
            <?php 
			 $grandTotalCutting += $rowTotal; // Update grand total
			} ?>
        </tbody>
		<tfoot>
        <tr>
            <td colspan="<?php echo count($sizeids) ; ?>"></td> 
            <td>Grand Total</td>
            <td>
                <input type="text" class="grandTotal cuttingGrandTotal" style="width:100px;" value="<?php echo $grandTotalCutting; ?>" readonly>
            </td>
        </tr>
    </tfoot>
    </table-->
    <div class="col-md-9" style="float:left;">
        <h3>Cutting Quantity</h3>
    </div>
<table id="example1" class="cutting_quantity_details" border="0" style="width:100%;border:1px groove black;">
    <thead style="background-color: #626F80; color: black; padding: 5px; font-size: 16px;">
        <tr>
            <th style="width:50px;">Colour</th>
            <?php
            $size_sql = mysqli_query($zconn, "select * from size_groups where size_group_name='" . $size_group . "'");
            $res_size = mysqli_fetch_array($size_sql, MYSQLI_ASSOC);
            $sizeids = explode(",", $res_size['size_ids']);
            for ($ij = 0; $ij < count($sizeids); $ij++) {
            ?>
                <th style="width:50px;">
                    <input type="hidden" name="size_ids2[]" style="width:100px;" value="<?php echo $sizeids[$ij]; ?>">
                    <input type="text" value="<?php echo $sizeids[$ij]; ?>" style="border:none; width:50px; background-color:#27A9E3; color:#fff; font-weight:bold;" readonly>
                </th>
            <?php } ?>
            <th style="width:50px;">Total</th> <!-- New Total Column -->
        </tr>
    </thead>
    <tbody>
        <?php
        $grandTotalCutting = 0; // Initialize grand total
        $sel_cutting_det = mysqli_query($zconn, "SELECT * FROM  `cutting_quantity_details` WHERE  `order_id` ='" . $_GET['order_id'] . "' GROUP BY row_id");
        while ($res_cutting_det = mysqli_fetch_array($sel_cutting_det, MYSQLI_ASSOC)) {
            $rowTotalCutting = 0; // Initialize row total for cutting
        ?>
            <tr>
                <td>
                    <input type="text" readonly name="cutting_colour[]" value="<?php echo $res_cutting_det['color']; ?>">
                </td>
                <?php
                $size_sql = mysqli_query($zconn, "select * from size_groups where size_group_name='" . $size_group . "'");
                $res_size = mysqli_fetch_array($size_sql, MYSQLI_ASSOC);
                $sizeids = explode(",", $res_size['size_ids']);
                for ($ij = 0; $ij < count($sizeids); $ij++) {
                    $sel_cut_details = mysqli_fetch_array(mysqli_query($zconn, "select * from cutting_quantity_details where order_id='" . $_GET['order_id'] . "' and row_id='" . $res_cutting_det['row_id'] . "' and size_id='" . $sizeids[$ij] . "'"), MYSQLI_ASSOC);
                    $qty_val = $sel_cut_details['qty_val'];
                    $rowTotalCutting += $qty_val;
                ?>
                    <td><input type="text" class="cuttingqty" <?php echo $cutting_style; ?> name="cutting_sizes<?php echo $sizeids[$ij]; ?>[]" style="width:100px;" value="<?php echo $qty_val; ?>" readonly></td>
                <?php } ?>
                <td>
                    <input type="text" class="rowTotal cuttingTotal" style="width:100px;" value="<?php echo $rowTotalCutting; ?>" readonly>
                </td>
            </tr>
        <?php
            $grandTotalCutting += $rowTotalCutting; // Update grand total
        }
        ?>
	
    </tbody>
    
	<tfoot>
        <tr>
            <td colspan="<?php echo count($sizeids) ; ?>"></td> <!-- Empty cell for alignment -->
            <td>Grand Total</td>
            <td>
                <input type="text" class="grandTotal cuttingGrandTotal" style="width:100px;" value="<?php echo $grandTotalCutting; ?>" readonly>
            </td>
        </tr>
    </tfoot>
	
</table>


</td>

        </tr>
		                
		
    </table>
					<!--td colspan="3" align="left" valign="top" style="border-right:1px groove black;"-->
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1" style="border-top:none;">
            <tr>
                            <td width="25%" height="70px" align="center" valign="bottom"
                                style="border:1px groove black;border-top: none; font-size: 17px; padding:10px;text-align:center;">Prepared By</td>
                            <td width="25%" align="center" valign="bottom"
                                style="border:1px groove black;border-top: none;font-size: 17px;text-align:center;">
                                Received By</td>
                            <td width="25%" align="center" valign="bottom"
                                style="border:1px groove black;border-top: none;font-size: 17px;text-align:center;">
                                Verified By</td>
                            <td width="25%" align="center" valign="bottom"
                                style="border:1px groove black;border-top: none;font-size: 17px;text-align:center;">
                                Authorized By</td>
                    </tr>
                    <!--/td-->
                  


							
								</table>
					
                    </div>
                </div>
                <!-- Sales chart-->
                <!-- ============================================================== --></div>
				</form>
            <!-- End Container fluid-->
            <!-- ============================================================== -->
      
        <!-- End Page wrapper-->
        <!-- ============================================================== -->
    </div>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer-->
            <!--?php include('includes/footer.php');?-->
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
	<script>
// Calculate and update row totals
$(".cutting_quantity_details tbody").on("input", ".cuttingqty", function() {
    var row = $(this).closest("tr");
    var total = 0;
    row.find(".cuttingqty").each(function() {
        var qty = parseFloat($(this).val()) || 0;
        total += qty;
    });
    row.find(".rowTotal").val(total);
});
</script>
	<script type="text/javascript">
	function sel_details(costing_id){
	$.ajax({
			url : 'ajax/costing.php',
			data: {
			   action: "get_cost_details",
			   costing_id: costing_id
			},
			success: function( data ) {
				//alert(data);
				data = data.split("~~");
				$('#order_no').val(data['0']);
				$('#style_no').val(data['1']);
				$('#buyer_name').val(data['2']);
			},
			error: function (textStatus, errorThrown) {
				//DO NOTHINIG
			}
		});
}
$(document).ready(function(){
	//$('.left-sidebar').slideToggle();
});

<?php
		$sel_color = mysqli_query($zconn,"select * from color_master");
		$color_list='';
		while($res_color = mysqli_fetch_array($sel_color,MYSQLI_ASSOC)){ 
			$col_name = $res_color['colour_name'];
			$color_list .='<option value='.$col_name.'>'.$res_color['colour_name'].'</option>';
		} 
		$size_list='';
		$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_group."'");
		$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
		$sizeids = explode(",",$res_size['size_ids']);
		for($ij=0;$ij<count($sizeids);$ij++){
			$size_list .= "<td><input type='text' name='order_sizes".$sizeids[$ij]."[]' style='width:100px;' ></td>";
		}
		
		$size_list1='';
		$size_sql = mysqli_query($zconn,"select * from size_groups where size_group_name='".$size_group."'");
		$res_size = mysqli_fetch_array($size_sql,MYSQLI_ASSOC);	
		$sizeids = explode(",",$res_size['size_ids']);
		for($ij=0;$ij<count($sizeids);$ij++){
			$size_list1 .= "<td><input type='text' name='cutting_sizes".$sizeids[$ij]."[]' style='width:100px;' ></td>";
		}
	?>

	function cal_cuttingqty(){
		var sumval = 0;
		var itmval=0;
		$('.cuttingqty').each(function(){
		itmval = $(this).val();
		if(itmval!=''){
			sumval += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
		}
		});
		$('#cutting_qty_value').val(sumval);
		
	}

	function cal_orderqty(obj){
		
		if ($("#percentage").prop("checked")) {
			var percent = $("#excess_per").val();
			var cutting_value =  parseFloat($(obj).val()) + (parseFloat($(obj).val()) * parseFloat(percent)/100);
			
			$('.cuttingqty').eq($(obj).index('.orderqty')).val(Math.round(cutting_value));
		}
		cal_total_order_qty();
	}
	function cal_total_order_qty() {
		var sumval = 0;
		var itmval=0;
		$('.orderqty').each(function(){
		itmval = $(this).val();
			if(itmval!=''){
				sumval += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
			}

		});
		$('#order_qty').val(sumval);
	}

	function cal_cutting_quantity(obj) {
		$('.orderqty').each(function(){
		itmval = $(this).val();
			if(itmval!=''){
				var cutting_value =  parseFloat(itmval) + (parseFloat(itmval) * parseFloat($(obj).val())/100);
				// console.log($(this).index('.orderqty'));
				$('.cuttingqty').eq($(this).index('.orderqty')).val(Math.round(cutting_value));
			}
		});
	}
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("#example td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		var index = $("table tbody tr:last-child").index();
		var newc = parseInt(index)+parseInt(1);
		var size_list ="<?php echo $size_list;?>";
		var color_list ="<?php echo $color_list;?>";
        var row = '<tr>'+
            '<td><select name="order_colour[]" class="form-control"><option value="">--Select--</option>'+color_list+'</select></td>'+size_list+'<td style="width:50px;"><a class="delete" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
    	$("#example").append(row);
		$("#example tbody tr").eq(index + 1).find(".add, .edit").toggle();
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
		cal_total_order_qty();
    });
	// Delete row on delete button click
	$(document).on("click", ".delete1", function(){
        $(this).parents("tr").remove();
		$(".add-new1").removeAttr("disabled");
		cal_cuttingqty();
    });
		var actions = $("#example1 td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new1").click(function(){
		var index = $("table tbody tr:last-child").index();
		var newc = parseInt(index)+parseInt(1);
		var size_list ="<?php echo $size_list1;?>";
		var color_list ="<?php echo $color_list;?>";
        var row = '<tr>'+
            '<td><select name="cutting_colour[]" class="form-control"><option value="">--Select--</option>'+color_list+'</select></td>'+size_list+'<td style="width:50px;"><a class="delete1" title="Delete" ><button type="button" class="btn btn-info"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
    	$("#example1").append(row);
		$("#example1 tbody tr").eq(index + 1).find(".add, .edit").toggle();
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
			$(".add-new1").removeAttr("disabled");
		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new1").attr("disabled", "disabled");
    });

});
	function show_cutting_quantity(obj) {
		if($(obj).val() == "Percentage") {
			$("#excess_per").show();
			$("#cutting_qty_value").hide();
			$(".cutting_quantity_details").find("input:text").each(function() {
				$(this).attr('readonly', true);
			});
		} else if($(obj).val() == "Value") {
			// $("#cutting_qty_value").show();
			$("#excess_per").hide();
			$(".cutting_quantity_details").find("input:text").each(function() {
				$(this).attr('readonly', false);
			});
		} else {

		}
	}
</script>
</body>
</html>


