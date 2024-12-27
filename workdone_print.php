<?php
// Start the session if it hasn't been started already.
include('includes/config.php');
?>
      
   <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>SankarKnitts Challan</title>
<style type="text/css">
table.curvedEdges {border:1px groove black;}
table.curvedEdges1 {border-bottom:1px groove black;font-size: 16px;}
.curvedEdges TR #header H2 {color: #FFF;}
</style>
<?php
 function convertNumberToWordsForIndia($number){
        //A function to convert numbers into Indian readable words with Cores, Lakhs and Thousands.
        $words = array(
        '0'=> '' ,'1'=> 'one' ,'2'=> 'two' ,'3' => 'three','4' => 'four','5' => 'five',
        '6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine','10' => 'ten',
        '11' => 'eleven','12' => 'twelve','13' => 'thirteen','14' => 'fouteen','15' => 'fifteen',
        '16' => 'sixteen','17' => 'seventeen','18' => 'eighteen','19' => 'nineteen','20' => 'twenty',
        '30' => 'thirty','40' => 'fourty','50' => 'fifty','60' => 'sixty','70' => 'seventy',
        '80' => 'eighty','90' => 'ninty');
        
        //First find the length of the number
        $number_length = strlen($number);
        //Initialize an empty array
        $number_array = array(0,0,0,0,0,0,0,0,0);        
        $received_number_array = array();
        
        //Store all received numbers into an array
        for($i=0;$i<$number_length;$i++){    $received_number_array[$i] = substr($number,$i,1);    }

        //Populate the empty array with the numbers received - most critical operation
        for($i=9-$number_length,$j=0;$i<9;$i++,$j++){ $number_array[$i] = $received_number_array[$j]; }
        $number_to_words_string = "";        
        //Finding out whether it is teen ? and then multiplying by 10, example 17 is seventeen, so if 1 is preceeded with 7 multiply 1 by 10 and add 7 to it.
        for($i=0,$j=1;$i<9;$i++,$j++){
            if($i==0 || $i==2 || $i==4 || $i==7){
                if($number_array[$i]=="1"){
                    $number_array[$j] = 10+$number_array[$j];
                    $number_array[$i] = 0;
                }        
            }
        }
        
        $value = "";
        for($i=0;$i<9;$i++){
            if($i==0 || $i==2 || $i==4 || $i==7){    $value = $number_array[$i]*10; }
            else{ $value = $number_array[$i];    }            
            if($value!=0){ $number_to_words_string.= $words["$value"]." "; }
            if($i==1 && $value!=0){    $number_to_words_string.= "Crores "; }
            if($i==3 && $value!=0){    $number_to_words_string.= "Lakhs ";    }
            if($i==4 && $value!=0){    $number_to_words_string.= "Thousand "; }
            if($i==5 && $value!=0){    $number_to_words_string.= "Thousand "; }
            if($i==6 && $value!=0){    $number_to_words_string.= "Hundred &amp; "; }
        }
        if($number_length>9){ $number_to_words_string = "Sorry This does not support more than 99 Crores"; }
        return ucwords(strtolower($number_to_words_string)."Pcs Only.");
    }
?>
<link rel="stylesheet" href="css files/dcstyle.css"/>
</head>


    <p>
    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="curvedEdges">
      <tr>
        <td height="23" colspan="4" align="center" valign="middle" style="font-size:20px;"><strong>Sankarknitts  Delivery Challan</strong></td>
      </tr>
	    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="curvedEdges">

		          <tr>
    <td width="25%" align="left" valign="top"
        style="padding-left:10px; padding-top:10px; padding-bottom:10px; font-size:17px;">
        <img src="assets/images/sankar_knits_new_logo.jpeg" alt="Your Company Logo" style="max-width: 200px; height: auto;"><br>
    </td>
    <td width="75%" align="center" valign="top"
        style="padding-left:0px; padding-top:10px; padding-bottom:10px; font-size:17px;">
      Sri Sankar Knits Pvt Ltd<br> 
SF NO: 307/1B & 2A, Kanthampalayam road, 
		M.Nathampalayam pirivu, Neagr Tamara Texnit,
		Sembianallur post, Covai Bye Pass,  <br>                         
		Avinashi-641654,<br> Tiruppur DT.<br>
		04296-272400 ,04296-272500 , 04296-272600
    </td>
</tr>
	</table>
      <tr>
	    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="curvedEdges">
		  
        <td width="774" rowspan="2" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges">
			
          <tr>
            <!--td width="58%" height="21" align="left" valign="middle"style="border-bottom:1px groove black; font-size: 14px;"><strong>From:</strong></td-->
            <td width="42%" align="left" valign="middle" style=" groove black;  font-size: 14px;"><strong>To:</strong></td>
          </tr>
          <tr>
            <td height="34" align="left" valign="top" style="padding-left:40px;font-size:14px;"><strong>No: 6 ,Ramabiran Colony , Dharapuram Road ,Tirupur - 641 608. Telephone : 0421-4352423<br/>GSTIN NO : 33AAJFR3200L1ZE</strong></td>
            <td width="42%" align="left" valign="top" style="padding-left:30px;font-size:14px;"><strong>
                </strong></td>
          </tr>
        </table></td>
        <td width="168" height="10" align="center" valign="middle" style="border-right:1px groove black; border-top:1px groove black; font-size: 14px;"><strong>Date:</strong></td>
        <td width="175" align="center" valign="middle" style="border-right:1px groove black; border-top:1px groove black; font-size: 14px;"><strong>Dc No:
            </strong></td>
      </tr>
      <tr>
        <td height="27" align="center" valign="middle" style="border-right:1px groove black;border-top:1px groove black; font-size:14px;"><strong>Style No :&nbsp;</strong></td>
        <td width="175" align="center" valign="middle" style="border-right:1px groove black;border-top:1px groove black; font-size:14px;"><strong>Department :</strong></td>
      </tr>
      <tr>
        <td height="21" align="center" valign="middle" style="border-right:1px groove black; font-size: 14px;"><strong>Particulars</strong></td>
        <td height="21" align="center" valign="middle" style="border-right:1px groove black; border-top:1px groove black; font-size: 14px;"><strong>Quantity</strong></td>
        <td colspan="2" align="center" valign="middle" style="border-right:1px groove black; border-top:1px groove black; font-size: 14px;"><strong>Remarks</strong></td>
      </tr>
      <tr>
        <td height="157" align="left" valign="top" style="border-right:1px groove black;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1">
        
          <tr>
            <!--td width="13%" height="19" align="center" valign="middle"style="border-top:1px groove black; font-size: 12px;" ><strong>Color / Size</strong></td-->
  
			
			
			
			
			
			
			<!-- Row for Size IDs heading -->
<?php

// Retrieve unique size IDs for the selected order_no
$uniqueSizeIds = array();

$sectBrnQry = "SELECT DISTINCT size_id FROM dc WHERE dc_no='" . $_GET['dc_no'] . "'";
$secBrnResource = mysqli_query($zconn, $sectBrnQry);

while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
    $uniqueSizeIds[] = $coldata['size_id'];
}

// Create table headers for color names
echo '<td width="13%" height="19" align="center" valign="middle"style="border-top:1px groove black;border-left:; font-size: 12px;"><strong>Color</strong</td>';

// Create table headers for each size ID
foreach ($uniqueSizeIds as $sizeId) {
    echo '<td width="13%" height="19" align="center" valign="middle"style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;"><strong>' . $sizeId . '</strong></td>';
}

// Add total column header
//echo '<th>Total</th>
     //   </tr>
    //</thead>
  //  <tbody>';

$i = 1;

// Initialize arrays to store color-wise totals
$colorTotals = array();

// Retrieve unique colors for the selected order_no
$uniqueColors = array();

$sectBrnQry = "SELECT DISTINCT color FROM dc WHERE dc_no='" . $_GET['dc_no'] . "'";
$secBrnResource = mysqli_query($zconn, $sectBrnQry);

while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
    $uniqueColors[] = $coldata['color'];
}

// Create an array to store color-wise quantities for each size ID
$colorQuantities = array();

foreach ($uniqueSizeIds as $sizeId) {
    $colorQuantities[$sizeId] = array();
}

// Retrieve and organize the color-wise quantities for each size ID
$sectBrnQry = "SELECT * FROM dc WHERE dc_no='" . $_GET['dc_no'] . "'";
$secBrnResource = mysqli_query($zconn, $sectBrnQry);

while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
    $colorQuantities[$coldata['size_id']][$coldata['color']] = $coldata['qty_val'];
}

// Loop through the colors and display quantities for each size ID in rows
foreach ($uniqueColors as $color) {
    echo '<tr>';
   // echo '<td style="width: 5%">' . $i . '</td>';
    echo '<td width="13%" height="19" align="center" valign="middle"style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;">' . $color . '</td>';

    // Initialize the color-wise total for this row
    $colorTotal = 0;

    // Loop through unique size IDs and display quantities for each color
    foreach ($uniqueSizeIds as $sizeId) {
        $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;
        echo '<td width="13%" height="19" align="center" valign="middle"style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;">' . $quantity . '</td>';

        // Add the quantity to the color-wise total for this row
        $colorTotal += $quantity;
    }

    // Display the color-wise total for this row
    //echo '<td>' . $colorTotal . '</td>';
    echo '</tr>';
    $i++;
}

echo '</tbody>
</table>';
?>

</tr>
			
        <!--td height="157" align="center" valign="top" style="border-right:1px groove black;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1--">
            <!--tr>
              <td height="21" align="center" valign="middle"style="border-top:1px groove black; font-size: 14px;">&nbsp;</td>
            </tr>
            
            <tr>
              <td height="19" align="center" valign="middle"style="border-top:1px groove black;font-size: 12px;"><strong></strong></td>
            </tr-->
            
           
        <!--/table></td-->
        <td colspan="2" valign="top"style="border-top:1px groove black;"></td>
      </tr>
      <tr>
        <td height="21" valign="top"style="border-right:1px groove black; border-top:1px groove black; font-size: 14px;"><strong>Grand Total:</strong>&nbsp;&nbsp;
        </strong></td>
        <td height="21" align="center" valign="middle" style="border-right:1px groove black; border-top:1px groove black; font-size: 14px;"><strong>
        
          </strong></td>
        <td colspan="2" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" valign="bottom"style="border-top:1px groove black; font-size: 14px;">
        <div align="left"><strong>Received in good condition</strong></div>
        <br />
    <div align="right" style="font-size:14px;"><strong>For Sankarknitts</strong></div>
    </td>
      </tr>
	</table>
  
	    <!--table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="curvedEdges">

<p>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="curvedEdges">
  <tr>
    <td height="39" colspan="5" align="center" valign="middle" bgcolor="#333333" id="header"><h2 style="color:#FFF">Sankarknitts  Delivery Challan</h2></td>
  </tr>
	           <tr>
    <td width="25%" align="left" valign="top"
        style="padding-left:10px; padding-top:10px; padding-bottom:10px; font-size:17px;">
        <img src="assets/images/sankar_knits_new_logo.jpeg" alt="Your Company Logo" style="max-width: 200px; height: auto;"><br>
    </td>
    <td width="75%" align="center" valign="top"
        style="padding-left:0px; padding-top:10px; padding-bottom:10px; font-size:17px;">
      Sri Sankar Knits Pvt Ltd<br> 
SF NO: 307/1B & 2A, Kanthampalayam road, 
		M.Nathampalayam pirivu, Neagr Tamara Texnit,
		Sembianallur post, Covai Bye Pass,  <br>                         
		Avinashi-641654,<br> Tiruppur DT.<br>
		04296-272400 ,04296-272500 , 04296-272600
    </td>
</tr>
  <tr>
    <td colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges">
        <tr>
          <td width="38%" height="41" align="left" valign="middle"style="border-bottom:1px groove black; font-size: 18px;"><strong>From:</strong></td>
          <td width="32%" align="left" valign="middle" style="border-left:1px groove black; border-bottom:1px groove black; font-size: 18px;"><strong>To:</strong></td>
          <td width="30%" align="left" valign="middle" style="border-left:1px groove black; border-bottom:1px groove black; font-size: 18px;"><strong>Date:
              
          </strong><strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dc No: </strong><strong>&nbsp;</strong></td>
        </tr>
        <tr>
          <td height="71" align="left" valign="top" style="padding-left:40px;"><strong>No: 6 ,Ramabiran Colony , <br />
            Dharapuram Road ,Tirupur - 641 608<br />
            Telephone : 0421-4352423, <br />
            Tele-Fax : 0421-4352423<br />
            info@rootsimpex.in <br />
            GSTIN NO : 33AAJFR3200L1ZE
            </strong></td>
          <td colspan="2" align="left" valign="top" style="padding-left:30px; border-left:1px groove black">
          <strong></strong></td>
        </tr>
      </table></td>
  </tr>
  <tr>
    <td height="27" colspan="3" align="center" valign="middle"style="border-right:1px groove black; font-size: 18px;"><strong>Particulars</strong></td>
    <td width="70" colspan="2" align="center" valign="middle"style="border-right:1px groove black; border-top:1px groove black; font-size: 18px;"><strong>Remarks</strong></td>
  </tr>
  <tr>
    <td height="250" colspan="3" align="left" valign="top"style="border-right:1px groove black;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1">
      <tr>
        <td width="5%" height="45" align="center" valign="middle"style="border-top:1px groove black; font-size: 18px;" ><strong>S.no</strong></td>
        <td width="12%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong><strong>Style </strong></span></strong></td>
        <td width="12%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Fabric name</strong></td>
        <td width="9%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Color</strong></td>
        <td width="9%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>GSM</strong></td>
        <td width="6%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong><strong>Roll</strong></strong></td>
        <td width="11%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Pcs(wgt)</strong></td>
        <td width="5%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Dia</strong></td>
        <td width="15%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Qty / Kg</strong></span></td>
        </tr>
     
      <tr>
        <td height="30" align="center" valign="middle" style="border-top:1px groove black; font-size: 16px;"><strong></strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong></strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong></strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong></strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong></strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong></strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong> g</strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong></strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><STRONG></STRONG></td>
        </tr>
      
  </table></td>
    <td colspan="2" valign="top"style="border-top:1px groove black;">&nbsp;</td>
  </tr>
  <tr>
    <td width="723" height="55" valign="top"style="border-right:1px groove black; border-top:1px groove black; font-size: 18px;"><strong>Grand Total:</strong>
      <div id="total" style="padding-left:100px;"><strong></strong></div></td>
    <td width="94" height="55" align="center" valign="middle"style="border-right:1px groove black; border-top:1px groove black; font-size: 18px;"><strong>Total</strong></td>
    <td width="111" align="center" valign="middle" bgcolor="#333333"style="border-right:1px groove black; border-top:1px groove black; font-size: 18px;">
    <strong style="color:#FFF">
      
    </strong></td>
    <td colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="100" colspan="5" valign="bottom"style="border-top:1px groove black; font-size: 18px;">
    <div align="left"><strong>Received in good condition</strong></div>
    <br />
    <br />
    <br />
<div align="right"><strong>For RootsImpex</strong></div>
</td>
  </tr>
</table-->
<p>&nbsp;</p>
</p>

</body>
</html>
