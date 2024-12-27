<?php
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}
$tot_wgt='';
$id = $_GET['id'];
											// $sectBrnQry = "SELECT * FROM yarns_po_details where po_id='$id'";
											// $secBrnResource = mysqli_query($zconn,$sectBrnQry);
											// $total_weight=0;
										  //   $sno=1;
											// while($coldata = mysqli_fetch_array($secBrnResource,MYSQLI_ASSOC)){
											// 	$id=$coldata['po_id'];
											// 	$idd=$coldata['id'];
											// 	$grant_total=$coldata['grant_total'];
                      // }

                      function amountInWord($no){   
                        $words = array('0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten','11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen','16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty','30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy','80' => 'eighty','90' => 'ninty','100' => 'hundred and','1000' => 'thousand','100000' => 'lakh','10000000' => 'crore');
                         if($no == 0){
                           return ' ';
                         }else {
                           $novalue='';
                           $highno=$no;
                           $remainno=0;
                           $value=100;
                           $value1=1000;       
                           while($no>=100){
                             if(($value <= $no) &&($no  < $value1)){
                               $novalue=$words["$value"];
                               $highno = (int)($no/$value);
                               $remainno = $no % $value;
                               break;
                             }
                             $value= $value1;
                             $value1 = $value * 100;
                           }       
                           if(array_key_exists("$highno",$words)){
                             return ucwords($words["$highno"]." ".$novalue." ".amountInWord($remainno).' ');
                           }else {
                              $unit=$highno%10;
                              $ten =(int)($highno/10)*10;            
                              return ucwords($words["$ten"]." ".$words["$unit"]." ".$novalue." ".amountInWord($remainno));
                           }
                         }
                       }

  ?>

  
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

<title>Yarn Purchase Order No - 
</title>
<style type="text/css">
table.curvedEdges th { border-bottom:1px groove black; border-left:1px groove black; background-color:#D6D6D6; font-weight:bold;}
table.curvedEdges td { border-bottom:1px groove black; border-left:1px groove black; background-color:#FFF }
body{text-transform:uppercase; margin:0px;}
	.container-fluid {
    margin: 0 auto;
    max-width: 1000px; /* Adjust this width as needed */
  }
img.images {
    height: 50px;
    width: 110px;
}
	@page {
  size: A4;
  margin: 0;
}

</style>
<? 
if($_REQUEST['refresh'] == 'close'){
  ?>
   <script language="JavaScript">window.print();</script>  
  <? }
  else{
  ?>
   <!-- <script>window.print()</script> 
   <meta http-equiv="refresh" content="0;URL=yarn_po_list.php" /> -->
  <? }?>
<link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

</head>

<body>
	 <div class="container-fluid">
	<div class="col-md-12">
                    <div class="card">
						<div class="card-body" style="width:100%; padding:0px;">
							<br>
							<br>
<table width="1000" height="1327" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="20" colspan="2" align="center" valign="middle" bgcolor="" style="border:1px groove black; color: black;background-color:#FABF8F;"><h3>Purchase Order
    </h3></td>
  </tr>
	<tr>
    <td width="40%" align="left" valign="top"
        style="padding-left:10px; padding-top:10px; padding-bottom:10px; font-size:17px;border:1px groove black; border-right: none;">
        <img src="assets/images/LOGO VAMAN EXPORTS .png" alt="Your Company Logo" style="max-width: 250px; height: auto;"><br>
    </td>
    <td width="60%" align="center" valign="top"
        style="padding-left:0px; padding-top:10px; padding-bottom:10px; font-size:17px;text-align:center;border:1px groove black;border-left: none;">
		<strong style="font-size:20px;">VAMAN EXPORTS</strong><br> 
<p style="font-size:16px;">SF.NO.285, DOOR NO.1 WARD NO.51, UOORGOUNDER NAGAR, DHARAPURAM ROAD,   <br>                         
		TIRUPUR,641 608.,<br>
	04296-272400 ,04296-272500 , 04296-272600 </p>

    
    </td>
</tr>



<tr>
    <td height="20" align="left" valign="middle" 
    style="border-left:1px groove black;border-right:1px groove black;border-bottom:1px groove black; padding-left:10px;">
    <strong>
    <?php
    $master = mysqli_query($zconn, "SELECT * FROM yarns_po_master WHERE id='" . $_GET['id'] . "' ORDER BY id DESC");

    // Check if there are any results
    if ($master && $res_master = mysqli_fetch_array($master, MYSQLI_ASSOC)) {
        $id = $res_master['id'];

        $costing = mysqli_query($zconn, "SELECT * FROM yarns_po_details WHERE po_id='" . $id . "' ORDER BY id DESC");

        // Check if there are any results
        if ($costing && $res_costing = mysqli_fetch_array($costing, MYSQLI_ASSOC)) {
            $order = $res_costing['po_id'];
    ?>
            PO No : <?php echo $order; ?>
        </strong>
        </td>
        <td align="left" valign="top" style="border-right:1px groove black;border-bottom:1px groove black; padding-left:10px">
        <strong>
          PO Date : <?php echo date('Y-m-d', strtotime($res_costing['date'])); ?>

          <!-- Receive Date: You can add this field if it exists in your database -->
        </strong>
        </td>
    </tr>
    <?php
        } else {
            echo "No data found for yarns_po_details"; // Display a message if no data is found for the details
        }
    } else {
        echo "No data found for yarns_po_master"; // Display a message if no data is found for the master
    }
    ?>
 
  
  <tr>

  <?php 
  
  // $sql=mysql_fetch_object(mysql_query("SELECT * FROM  `yarns_po` WHERE  `yarns_po`.`id` =  '$pono'"));$vat1=$sql->vat;
  // $customer_data=mysql_fetch_object(mysql_query("SELECT * FROM  `master_supplier` WHERE  `master_supplier`.`customercode` =  '$sql->to'"));

$id = $_GET['id'];

$po=mysqli_fetch_array(mysqli_query($zconn,"select * from yarns_po_master where id='$id'"));

$buyer=$po['buyer'];
$deliver_to=$po['deliver_to'];
$grant_total=$po['grant_total'];
$cgst=$po['cgst'];
$sgst=$po['sgst'];
$igst=$po['igst'];
$date=$po['date'];
$receive_date_arr = explode("-",$po['receive_date']);


$receive_date=$receive_date_arr['2']."-".$receive_date_arr['1']."-".$receive_date_arr['0'];//$po['receive_date'];
$kg_bag=$po['kg_bag'];
$total_bag=$po['total_bag'];
$comments=$po['comments'];
?>
    <td width="50%" height="134" align="left" valign="middle" 
    style="border-left:1px groove black;border-right:1px groove black;border-bottom:1px groove black; padding-left:10px;">
    <strong style="text-transform:uppercase; font-weight:bolder; font-size:20px;">TO: <br>
		 <span style="text-transform:uppercase; font-weight:bolder; font-size:20px;">
      <?php echo $buyer;
      $tocompe = mysqli_query($zconn,"SELECT * FROM  `suppliers` where supplier_name='$buyer'");
					 while($tocompe_res=mysqli_fetch_object($tocompe)){ ?>
 </span></strong><br>
    
    
<?php
             echo $tocompe_res->supplier_address1;
						 echo '<br>';
						// echo 'Tiruppur';
           }
            ?>

   
        
    <br> 
       <!-- <?php
//        print '<pre>'; 
// print $buyer;
// print '<pre>'; 
?> -->
    </td>
    <td width="50%" align="left" valign="top" style="border-right:1px groove black;border-bottom:1px groove black; padding-left:10px;">
    <span style="text-transform:uppercase;  font-size:16px;">DELIVERY TO :</span> <br>
      <strong style="text-transform:uppercase;  font-size:16px;">
      <?php echo $deliver_to;
      $tocompe = mysqli_query($zconn,"SELECT * FROM  `process_customer` where party_name='$deliver_to'");
					 while($tocompe_res=mysqli_fetch_object($tocompe)){ ?>
 </strong><br>
    
    
<?php
             echo $tocompe_res->party_address1;
						 echo '<br>';
						// echo 'Tiruppur';
           }
            ?>

   
        
    <br> 
    </td>
  </tr>
  <tr>
    <td height="36" colspan="2" align="left" valign="middle" 
    style="border-right:1px groove black;border-bottom:1px groove black;border-left:1px groove black; padding-left:10px;"><strong>Dear Sir,</strong></td>
  </tr>
  <tr>
    <td height="33" colspan="2" align="left" valign="middle" 
    style="padding-left:55px;border-right:1px groove black;border-bottom:1px groove black;border-left:1px groove black;">
    <strong>We release this Purchase Order For Fabric to be Supplied by you as per the details given as below:</strong></td>
  </tr>
  <tr>
    <td height="800" colspan="2" align="center" valign="top" 
    style="border-right:1px groove black;border-bottom:1px groove black;border-left:1px groove black;">
    <table width="1000" border="0" cellspacing="0" cellpadding="0" class="curvedEdges">
      <tr style="font-size:15px;background-color:#FABF8F;">
        <td width="91"  align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;" ><strong>S.NO</strong></td>
        <!--td width="91" align="center" valign="middle"  style="font-size:15px;background-color:#FABF8F;" ><strong>STYLE NO</strong></td-->
        <td width="131" align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;" ><strong>YARN NAME</strong></td>
        <td width="75" align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;" ><strong>COUNTS</strong></td>
        <td width="75" align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;" ><strong>CONTENT</strong></td>
		       <!--td width="75" align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;"><strong>YARN TYPE</strong></td--> 
        <td width="75" align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;" ><strong>COLOUR</strong></td>
       
		  
        <td width="87" align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;" ><strong>WEIGHT</strong></td>
        <td width="60" align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;" ><strong>RATE </strong></td>      
        <td width="53" align="center" valign="middle" style="font-size:15px;background-color:#FABF8F;" ><strong>TOTAL AMOUNT</strong></td>
      </tr>
     <?php
$master = mysqli_query($zconn, "SELECT * FROM yarns_po_master WHERE id='" . $_GET['id'] . "' ORDER BY id DESC");

// Check if there are any results
if ($master && $res_master = mysqli_fetch_array($master, MYSQLI_ASSOC)) {
    $id = $res_master['id'];
    $sno = 1;
    $tot_wgt = 0;
    $costing = mysqli_query($zconn, "SELECT * FROM yarns_po_details WHERE po_id='" . $id . "' ");
    $data = array(); // Store data to merge

    // Check if there are any results
	// $res_costing['styleno'] . '-' . 
    while ($costing && $res_costing = mysqli_fetch_array($costing, MYSQLI_ASSOC)) {
        $key = $res_costing['po_id'] . '-' . $res_costing['yarn_name'] . '-' . $res_costing['counts'];
        if (!isset($data[$key])) {
            $data[$key] = array(
              //  'styleno' => $res_costing['styleno'],
                'yarn_name' => $res_costing['yarn_name'],
                'counts' => $res_costing['counts'],
                'yarn_content' => $res_costing['yarn_content'],
                'yarn_type' => $res_costing['yarn_type'],
                'yarn_colour' => !empty($res_costing['yarn_colour']) ? $res_costing['yarn_colour'] : "--",
                'weight' => $res_costing['weight'],
                'rate' => $res_costing['rate'],
                'total_amount' => $res_costing['weight'] * $res_costing['rate'],
            );
        } else {
            // Add to existing data
            $data[$key]['weight'] += $res_costing['weight'];
            $data[$key]['total_amount'] += $res_costing['weight'] * $res_costing['rate'];
        }
    }

    // Display merged and totaled data
    foreach ($data as $row) {
        ?>
        <tr style="font-size:13px;">
            <td height="35" align="center" valign="middle">
                <strong><?php echo $sno; ?></strong>
            </td>
            <!--td align="center" valign="middle">
                <strong><?php echo $row['styleno']; ?></strong>
            </td-->
            <td align="center" valign="middle">
                <strong><?php echo $row['yarn_name']; ?></strong>
            </td>
            <td align="center" valign="middle">
                <strong><?php echo $row['counts']; ?></strong>
            </td>
            <td align="center" valign="middle">
                <strong><?php echo $row['yarn_content']; ?></strong>
            </td>
            <!--td align="center" valign="middle">
                <strong><?php echo $row['yarn_type']; ?></strong>
            </td-->
            <td align="center" valign="middle">
                <strong><?php echo $row['yarn_colour']; ?></strong>
            </td>
            <td align="center" valign="middle">
                <strong><?php echo $row['weight']; ?></strong>
            </td>
            <td align="center" valign="middle">
                <strong><?php echo $row['rate']; ?></strong>
            </td>
            <td align="right" valign="middle" style="padding-right:5px;text-align:center;">
                <strong><?php echo $row['total_amount']; $total_amount1 += $row['total_amount']; ?></strong>
            </td>
        </tr>
        <?php
        $sno++;
    }
}
?>

    <tr>
  <!-- ... Empty cells ... -->
  <td height="25" colspan="6" align="center" valign="middle" style="text-transform:uppercase;text-align:center;">&nbsp;</td>
  <td style="text-transform:uppercase;text-align:center;"><strong>Total</strong></td>
  <td align="right" valign="middle" style="padding-right:5px;text-align:center;"><strong>
    <div>
      <?php echo number_format($total_amount1); // Format the total without tax with 2 decimal places ?>
    </div>
  </strong></td>
</tr>
<tr>
  <?php if (!empty($res_master['cgst'])) { ?>
    <td height="25" colspan="6" align="center" valign="middle" style="text-transform:uppercase;text-align:center;border-bottom:0px;">&nbsp;</td>
    <td style="text-transform:uppercase;text-align:center;"><strong style="font-size:12px;">CGST (<?php echo $res_master['cgst']; ?>%)</strong></td>
    <td align="right" valign="middle" style="font-size:15px; background-color:#FABF8F; padding-right:5px;text-align:center;"><strong>
      <?php
      $cgst_percentage = $res_master['cgst'];
      $total_cgst_amount = ($total_amount1 * $cgst_percentage / 100);
      echo number_format($total_cgst_amount);
      ?>
    </strong></td>
  </tr>
  <?php } ?>
  <tr>
    <?php if (!empty($res_master['sgst'])) { ?>
      <td height="25" colspan="6" align="center" valign=middle" style="text-transform:uppercase;text-align:center;" >&nbsp;</td>
      <td style="text-transform:uppercase;text-align:center;"><strong style="font-size:12px;">SGST (<?php echo $res_master['sgst']; ?>%)</strong></td>
      <td align="right" valign="middle" style="font-size:15px; background-color:#FABF8F; padding-right:5px;text-align:center;"><strong>
        <?php
        $sgst_percentage = $res_master['sgst'];
        $total_sgst_amount = ($total_amount1 * $sgst_percentage / 100);
        echo number_format($total_sgst_amount);
        ?>
      </strong></td>
    </tr>
    <?php } ?>
    <tr>
      <?php if (!empty($res_master['igst'])) { ?>
        <td height="25" colspan="6" align="center" valign="middle" style="text-transform:uppercase;text-align:center;">&nbsp;</td>
        <td style="text-transform:uppercase;text-align:center;"><strong>IGST (<?php echo $res_master['igst']; ?>%)</strong></td>
        <td align="right" valign="middle" style="font-size:20px; background-color:#FABF8F; padding-right:5px;text-align:center;"><strong>
          <?php
          $igst_percentage = $res_master['igst'];
          $total_igst_amount = ($total_amount1 * $igst_percentage / 100);
          echo number_format($total_igst_amount);
          ?>
        </strong></td>
      </tr>
      <?php } ?>
      <tr>
        <td height="50" colspan="6" align="center" valign="middle" style="text-transform:uppercase;text-align:center;">&nbsp;</td>
        <td style="text-transform:uppercase;text-align:center;"><strong>INCL.TAX</strong></td>
        <td align="right" valign="middle" style="padding-right:5px;text-align:center;"><strong>
          <div>
            <?php
            $total_amount_with_tax = $total_amount1 + $total_cgst_amount + $total_sgst_amount + $total_igst_amount;
				$total_amount_with_tax1 = 	round($total_amount_with_tax);
					//echo 	$total_amount_with_tax; ?>
																					  
																					  <?php
           // echo '<span style="font-size:10px;">('.$total_amount_with_tax.')</span><br>'.$total_amount_with_tax1;
            echo $total_amount_with_tax1;
																					  
            ?>
          </div>
        </strong></td>
      </tr>
    </table>
    <br><br><br>
    

    
    </td>
  </tr>
										   <tr>
										   <td height="100" colspan="2" align="left" valign="top" style="border-right:1px groove black;border-bottom:1px groove black;border-left:1px groove black;padding:10px;"><strong>REMARKS : </strong><br>
										     <?php   
  $id = $_GET['id'];
                        $sql_details = mysqli_query($zconn,"select * from yarns_po_master where po_no='".$_GET['id']."'");
                        
                        $tot_wgt=0;
                        while($res_details = mysqli_fetch_array($sql_details,MYSQLI_ASSOC)){
                         echo $res_details['comments']
                         // $tot_wgt+=$res_details['weight'];
                        // print_r($coldata);
                      
											?>
                      <?php } ?>
										   <td>
										   </tr>
  <tr>

    <td height="25" colspan="2" align="left" valign="top" style="border-right:1px groove black;border-bottom:1px groove black;border-left:1px groove black;padding:10px;">
    <span ><span style="text-transform:uppercase;"><strong>
    <?php   
  $id = $_GET['id'];
                        $sql_details = mysqli_query($zconn,"select * from yarns_po_details where po_id='".$_GET['id']."'");
                        
                        $tot_wgt=0;
                        while($res_details = mysqli_fetch_array($sql_details,MYSQLI_ASSOC)){
                         
                          $tot_wgt+=$res_details['weight'];
                        // print_r($coldata);
                      
											?>
                      <?php } ?>
    RUPEES IN WORDS : &nbsp;<?php 
                          $total_amount1=$total_amount1; echo amountInWord($total_amount_with_tax1)."Rupees Only" ; ?>
     
  </strong></span></span></td> 
  </tr>
  <tr>
    <td height="60" colspan="2" align="left" valign="bottom" style="border-right:1px groove black;border-left:1px groove black;">
    <table width="100%" border="0" class="curvedEdges" cellspacing="0" cellpadding="0">
      <tr>
        <td width="33%" height="60" align="center" valign="bottom" style="font-size:13px;"><strong>Prepared By</strong></td>



        <td width="33%" align="center" valign="bottom" style="font-size:13px;"><strong><br>
          <strong>For Merchandiser</strong></strong></td>





        <td width="33%" align="center" valign="bottom" style="font-size:13px;">
<?php 
// if ($sql->admin_status == 'A' ) {?>
	<!-- <img src="images/<?php echo 'admin.png'; ?>"  class="images"> -->

  <!-- <br><strong>For Merchandiser</strong> -->
<?php //}
?>
    <div>
																	 
																																	 </div>

 <strong> Authorized Signature</strong></td>
      </tr>
    </table></td>
  </tr>
</table>
	
	</div>
</div>
</div>
</body>
</html> 
