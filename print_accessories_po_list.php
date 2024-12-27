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
img.images {
    height: 50px;
    width: 110px;
}
</style>
<? 
if($_REQUEST['refresh'] == 'close'){
  ?>
  <script language="JavaScript">window.print();</script> 
  <? }
  else{
  ?>
   <script>window.print()</script> 
   <meta http-equiv="refresh" content="0;URL=accessories_po_list.php" />
  <? }?>
<link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

</head>

<body>
<table width="1000" height="1327" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td height="50" colspan="2" align="center" valign="middle" bgcolor="#333333" style="border:1px groove black; color: #FFF;"><h2>Purchase Order : 
    </h2></td>
  </tr>
  <tr>
    <td height="20" align="left" valign="middle" 
    style="border-left:1px groove black;border-right:1px groove black;border-bottom:1px groove black; padding-left:10px;">
    <strong>
      
    </strong></td>
    <td align="left" valign="top" style="border-right:1px groove black;border-bottom:1px groove black; padding-left:10px">
    <strong>
      <!-- Order Date : 
        Receive Date : -->
      </strong>
    </td>
  </tr>
  <tr>
  <?php 
  
  // $sql=mysql_fetch_object(mysql_query("SELECT * FROM  `yarns_po` WHERE  `yarns_po`.`id` =  '$pono'"));$vat1=$sql->vat;
  // $customer_data=mysql_fetch_object(mysql_query("SELECT * FROM  `master_supplier` WHERE  `master_supplier`.`customercode` =  '$sql->to'"));

$id = $_GET['id'];

$po=mysqli_fetch_array(mysqli_query($zconn,"select * from store_po_master where id='$id'"));

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
    style="border-left:1px groove black;border-right:1px groove black;border-bottom:1px groove black; padding-left:10px;"></div>
    <div class="row">
    <div class="col"><img src="assets\images\iorangelogo1.jpg" width="200" height="100" alt=""></div>
    <div class="col"><strong style="font-size:20px;">IOrange Innovation</strong><br />
       Old Market Street<br /> Tiruppur<br>641604</div></div>
       <!-- <?php
//        print '<pre>'; 
// print $buyer;
// print '<pre>'; 
?> -->
    </td>
    <td width="50%" align="left" valign="top" style="border-right:1px groove black;border-bottom:1px groove black; padding-left:10px;">
    <strong style="text-transform:uppercase; font-weight:bolder; font-size:20px;">TO :</strong> <br>
      <span style="text-transform:uppercase; font-weight:bolder; font-size:20px;">
      <?php echo $buyer;
      $tocompe = mysqli_query($zconn,"SELECT * FROM  `suppliers` where supplier_name='$buyer'");
					 while($tocompe_res=mysqli_fetch_object($tocompe)){ ?>
 </span><br>
  
<?php
             echo $tocompe_res->supplier_address1;
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
      <tr style="font-size:20px;background-color:#D6D6D6;">
        <td width="91"  align="center" valign="middle"><strong>S.NO</strong></td>
        <td width="91" align="center" valign="middle"><strong>STYLE NO</strong></td>
        <td width="131" align="center" valign="middle"><strong>ACCESSORIES NAME</strong></td>
        <td width="75" align="center" valign="middle"><strong>COUNT</strong></td>
        <td width="87" align="center" valign="middle"><strong>WEIGHT</strong></td>
        <td width="60" align="center" valign="middle"><strong>RATE </strong></td>      
        <td width="53" align="center" valign="middle"><strong>TOTAL AMOUNT</strong></td>
      </tr>
      <?php
			$costing_sql = mysqli_query($zconn,"select * from store_po_master where id='".$_GET['id']."' order by id desc");
			$c=1;
			 while($res_costing = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){

											$id = $_GET['id'];
                      $sql_details = mysqli_query($zconn,"select * from store_po_details where po_id='".$_GET['id']."'");
                      $sno=1;
                      $tot_wgt=0;
                      while($res_details = mysqli_fetch_array($sql_details,MYSQLI_ASSOC)){
                        // print_r($coldata);
                        //yarn_entry_details`(`id`, `yarn_id`, `costing_no`, `yarn_name`, 
                        //`yarn_count`, `yarn_type`, `yarn_colour`, `yarn_content`, `fabric_name`, `comp_group`, `comp_id`, `consumption_value`, `consumption_percent`, `pcs_weight`, 
                        //`uom_id`, `yarn_rate`, `yarn_total`, `rate_perkg`, `rate_total`
											$po=mysqli_fetch_array(mysqli_query($zconn,"select * from store_po_master where id='$id'"));
                     
										
											?>
      <tr style="font-size:13px;">
        <td height="35" align="center" valign="middle">
          <strong><?php echo $sno;?>
        </strong></td>
        <td align="center" valign="middle">
          
          <strong>
          <?php echo $res_details['styleno'];?>
        </strong></td>
        <td align="center" valign="middle">
          <strong>
          <div><?php echo $res_details['yarn_name'];?></div>
           
            
          </strong></td>
        <td align="center" valign="middle"><strong>
            <div><?php echo $res_details['counts'];?></div>
           
          </strong></td>
          
        <td align="center" valign="middle"><strong>
  
        <div>
          <!-- <?php echo $res_details['pcs_weight'];?> -->
        <?php echo $res_details['weight'];$tot_wgt+=$res_details['weight'];?>
      </div>
           
   
        
        </strong></td>
        <td align="center" valign="middle"><strong>
          
        <div><?php echo $res_details['rate'];?></div>
           
        
          </strong></td>
        <td align="right" valign="middle" style="padding-right:5px;"><strong>
        <div>
          <?php echo   $total_amount=$tot_wgt*$res_details['rate'];$total_amount1+=$total_amount?></div>
        <div>
      </td>
</div>
          
      </strong></td>
    <?php $sno++; } } ?>
      <tr>
        <td height="50" colspan="4" align="center" 
        valign="middle" style="text-transform:uppercase;">&nbsp;</td>
        <td></td>
        <!-- <td align="center" valign="middle" 
         style="font-size:20px; "><strong>
         <?php echo $total_weight;?>
        </strong></td> -->
        <td align="center" valign="middle">&nbsp;</td>
        <td align="right" valign="middle" bgcolor="#333333" 
        style="font-size:20px; color:#FFF; background-color:#333; padding-right:5px;"><strong>
        <?php echo  $total_amount1;?>
        </strong></td>
      </tr>
    </table>
    <br><br><br>
    <table width="1000" border="0" cellspacing="0" cellpadding="0" class="curvedEdges">
  <thead>
  <tr>
  <td colspan="9" align="center" valign="middle"><h2>Summary Details</h2></td>
  </tr>
  <!-- <tr>
    <td height="800" colspan="2" align="center" valign="top" 
    style="border-right:1px groove black;border-bottom:1px groove black;border-left:1px groove black;"> -->
    <tr style="font-size:20px;background-color:#ffff;text-align:center">
    <td width="91" align="center" valign="middle"><strong>S.NO </strong></td>

    <td width="91" align="center" valign="middle"><strong>STYLE NO </strong></td>
    <td width="91" align="center" valign="middle"><strong>ORDER NO </strong></td>

    <td width="131" align="center" valign="middle"><strong>PO</strong></td>
    <!-- <th width="136" align="center" valign="middle">YARN TYPE</th> 
    <th width="51" align="center" valign="middle">YARN COLOUR</th> -->
    <td width="75" align="center" valign="middle"><strong>UOM</strong></td>
    <!-- <th width="87" align="center" valign="middle">EXTRA + OrderQty</th> -->
    <!-- <th width="60" align="center" valign="middle">PCS WT </th> -->
    
    <td width="53" align="center" valign="middle"><strong><strong>Qty</strong></td>
    </thead>
 
  <tbody>
  <?php
			$costing_sql = mysqli_query($zconn,"select * from store_po_master where id='".$_GET['id']."' order by id desc");
			$c=1;
			 while($res_costing = mysqli_fetch_array($costing_sql,MYSQLI_ASSOC)){

												$id = $_GET['id'];
                        $sql_details = mysqli_query($zconn,"select * from store_po_details where po_id='".$_GET['id']."'");
                        $sno=1;
                        $tot_wgt=0;
                        while($res_details = mysqli_fetch_array($sql_details,MYSQLI_ASSOC)){
                        // print_r($coldata);
                      
											?>
    <tr style="font-size:13px;">
    <td align="center" valign="middle">
    <strong><?php echo $sno;?>
  </td>
    <td align="center" valign="middle">
    <strong><?php echo $res_details['styleno'];?>
  </td>
  <td align="center" valign="middle">
    <strong><?php echo $res_details['order_no'];?>
  </td>
    <td align="center" valign="middle">
    <strong><?php echo $res_details['po_id'];?>

  </td>
  <!-- <td align="center" valign="middle">

<strong><?php echo $res_details['yarn_type'];?>

</td>
  <td align="center" valign="middle">

<strong><?php echo $res_details['yarn_color'];?>

</td> -->
    <td align="center" valign="middle">

    <strong><?php echo $res_details['counts'];?>

  </td>
    <td align="center" valign="middle">
    <strong><?php echo $res_details['weight'];$tot_wgt+=$res_details['weight'];?>


      
    <!-- <?php echo $res_details['balance_qty'];?> -->
  </td>
    <!-- <td align="center" valign="middle">
    <?php echo $res_details['balance'];?>
  </td> -->
    
    <!-- <td align="center" valign="middle">
  </td> -->
  <?php
												$sno++; }	}
											?>
    </tbody>
  <?
 // }
  ?>
</table>

    
    </td>
  </tr>
  <tr>

    <td height="25" colspan="2" align="left" valign="top" style="border-right:1px groove black;border-bottom:1px groove black;border-left:1px groove black;">
    <span style="border-right:1px groove black;border-left:1px groove black;"><span style="text-transform:uppercase;"><strong>
    <?php   
  $id = $_GET['id'];
                        $sql_details = mysqli_query($zconn,"select * from store_po_details where po_id='".$_GET['id']."'");
                        
                        $tot_wgt=0;
                        while($res_details = mysqli_fetch_array($sql_details,MYSQLI_ASSOC)){
                         
                          $tot_wgt+=$res_details['weight'];
                        // print_r($coldata);
                      
											?>
                      <?php } ?>
    RUPEES IN WORDS :<?php 
                          $total_amount1=$total_amount1; echo amountInWord($total_amount1)."Rupees Only" ; ?>
     
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
    <div><img src="assets\images\logo1.png" width="45" height="50" alt=""></div>

 <strong> Authorized Signature</strong></td>
      </tr>
    </table></td>
  </tr>
</table>
</body>
</html> 
