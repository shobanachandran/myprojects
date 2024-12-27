    
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Vaman Experts Challan</title>
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
        return ucwords(strtolower($number_to_words_string)." Only.");
    }
?>
<link rel="stylesheet" href="css files/dcstyle.css"/>
</head>

	
	<?php
include('includes/config.php');

if (isset($_SESSION['userid']) && $_SESSION['userid'] != '') {
    // User is logged in
    // Check if dc_no is set in the URL
    if (isset($_GET['dc_no'])) {
        $dc_no = mysqli_real_escape_string($zconn, $_GET['dc_no']);

        // Fetch data from production_dc table
        $query_production = "SELECT * FROM production_dc WHERE dc_no = '$dc_no'";
        $result_production = mysqli_query($zconn, $query_production);

        // Fetch data from workassign_dc table
        $query_workassign = "SELECT * FROM workassign_dc WHERE (style_no, id) IN (SELECT style_no, MIN(id) FROM workassign_dc WHERE dc_no = '$dc_no' GROUP BY style_no)";
        $result_workassign = mysqli_query($zconn, $query_workassign);

        // Check if the queries were successful
        if ($result_production && $result_workassign) {
            // Process and display your data here
            // You can use mysqli_fetch_assoc to fetch rows from the result sets

            if (mysqli_num_rows($result_production) > 0) {
                // Display Production DC Data
                echo "<table border='1'>";
                //echo "<caption>Production DC Data</caption>";
                //echo "<tr><th>ID</th><th>DC_NO</th><th>DC_DATE</th><th>CON_NAME</th><th>STYLE_NO</th><th>ORDER_NO</th><th>FABRIC_NAME</th><th>FROM</th><th>WGT</th><th>ROLL</th><th>STOCK</th><th>DIA</th><th>GSM</th><th>COLOR</th><th>DELIVERY_WGT</th><th>CREATED_AT</th></tr>";

                while ($row = mysqli_fetch_assoc($result_production)) {
                    echo "<tr>";
//foreach ($row as $value) {
//echo "<td>$value</td>";
									
				echo '<p>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="curvedEdges">
  <tr>
    <td height="39" colspan="5" align="center" valign="middle" id="header"><h2 style="color:black">  Delivery Challan</h2></td>
	
  </tr>
    <tr>
    <td height="39" colspan="5" align="center" valign="middle" id="header" >
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" class="curvedEdges">
	
	<tr>
	<td height="39" colspan="5" align="center" valign="middle" id="header" >
	        <img src="assets/images/LOGO VAMAN EXPORTS .png" alt="Your Company Logo" style="max-width: 200px; height: auto;"><br>

	</td>
	<td height="39" colspan="5" align="center" valign="middle" id="header" >
	SF.NO.285, DOOR NO.1 WARD NO.51, UOORGOUNDER NAGAR, DHARAPURAM ROAD,
TIRUPUR,641 608.,
04296-272400 ,04296-272500 , 04296-272600
	</td>
	</tr>
	</table>
	</td>
	
  </tr>
  <tr>
    <td height="1" colspan="5" style="background-color:#333333;"></td>
</tr>
  <tr>
    <td colspan="4" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges" style="border-top:none;">
        <tr>
      
          <td width="32%" align="left" valign="middle" style="border-left:1px groove black; border-bottom:1px groove black; font-size: 18px;"><strong>To:</strong></td>
          <td width="30%" align="left" valign="middle" style="border-left:1px groove black; border-bottom:1px groove black; font-size: 18px;"><strong>Date:&nbsp;' . $row['dc_date'] . '
              
          </strong><strong> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Dc No: </strong><strong>&nbsp;' . $row['dc_no'] . '</strong></td>
        </tr>';
   // Assuming $con_name holds the contractor's name
$con_name = $row['con_name']; // Replace this with your actual value

// Query to fetch con_address based on con_name
$query = "SELECT con_address, con_number, doj, status FROM contractors WHERE con_name = '".$row['con_name']."'";
				//	echo $query;
$result = mysqli_query($zconn, $query);

if ($result && mysqli_num_rows($result) > 0) {
    $address_row = mysqli_fetch_assoc($result);
    $con_address = $address_row['con_address'];
    $con_number = $address_row['con_number'];

//echo $address_row['con_address'];
    // Output the HTML with the fetched address
    echo '<tr>
            <td height="71" align="left" valign="top" style="padding-left:40px;">
              <strong>' . $row['con_name'] . '</strong><br />
              ' . $con_address . '<br />
			  
              Telephone : '.$con_number.',<br />
           
            </td>
            <td colspan="2" align="left" valign="top" style="padding-left:30px; border-left:1px groove black">
              <strong></strong>
            </td>
          </tr>';
} else {
    // Output placeholder or handle error if address is not found
    echo '<tr>
            <td height="71" align="left" valign="top" style="padding-left:40px;">
              Address not found
            </td>
            <td colspan="2" align="left" valign="top" style="padding-left:30px; border-left:1px groove black">
              <strong></strong>
            </td>
          </tr>';
}

	echo '			
      </table></td>
  </tr>
  <tr>
    <td height="27" colspan="3" align="center" valign="middle"style="border-right:1px groove black; font-size: 18px;"><strong>Particulars</strong></td>
    <td width="70" colspan="2" align="center" valign="middle"style="border-right:1px groove black; border-top:1px groove black; font-size: 18px;"><strong>Remarks</strong></td>
  </tr>
  <tr>
    <td height="250" colspan="3" align="left" valign="top"style="border-right:1px groove black;"><table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1">
      <tr>
       
        <td width="12%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong><strong>Style Code: </strong></span></strong></td>
        <td width="12%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Fabric name</strong></td>
        <td width="9%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Color</strong></td>
        <td width="9%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>GSM</strong></td>
        <td width="6%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong><strong>Roll</strong></strong></td>
        <td width="11%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Pcs(wgt)</strong></td>
        <td width="5%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Dia</strong></td>
        <td width="15%" align="center" valign="middle" style="border-left:1px groove black;border-top:1px groove black;font-size: 18px;"><strong>Qty / Kg</strong></span></td>
        </tr>
     
      <tr>
      
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong> ' . $row['style_no'] . '</strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong> ' . $row['fabric_name'] . '</strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong> ' . $row['color'] . '</strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong> ' . $row['gsm'] . '</strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong> ' . $row['roll'] . '</strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong>  ' . $row['delivery_wgt'] . '</strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><strong> ' . $row['dia'] . '</strong></td>
        <td align="center" valign="middle"style="border-left:1px groove black;border-top:1px groove black;font-size: 16px;"><STRONG> ' . $row['delivery_wgt'] . '</STRONG></td>
        </tr>
      
  </table></td>
    <td colspan="2" valign="top"style="border-top:1px groove black;">&nbsp;</td>
  </tr>
  <tr>
    <td width="723" height="55" valign="top"style="border-right:1px groove black; border-top:1px groove black; font-size: 18px;"><strong>Grand Total:</strong>
      <div id="total" style="padding-left:100px;"><strong></strong></div></td>
    <td width="94" height="55" align="center" valign="middle"style="border-right:1px groove black; border-top:1px groove black; font-size: 18px;"><strong>Total</strong></td>
    <td width="111" align="center" valign="middle" style="border-right:1px groove black; border-top:1px groove black; font-size: 18px;">
    <strong>
      ' . $row['delivery_wgt'] . '
    </strong></td>
    <td colspan="2" valign="top">&nbsp;</td>
  </tr>
  <tr>
    <td height="100" colspan="5" valign="bottom"style="border-top:1px groove black; font-size: 18px;">
    <div align="left"><strong>Received in good condition</strong></div>
    <br />
    <br />
    <br />
<div align="right"><strong>For Experts</strong></div>
</td>
  </tr>
</table>
<p>&nbsp;</p>
</p>
';
                    }
                    echo "</tr>";
               // }

                echo "</table>";
				
	
				
				
				
				
            } elseif (mysqli_num_rows($result_workassign) > 0) {
                // Display Work Assign DC Data
            

				
		echo '
		 
    <p>
    <table width="1000" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="curvedEdges">
      <tr>
        <td height="23" colspan="4" align="center" valign="middle" style="font-size:20px;border-bottom:1px groove black;"><strong> Delivery Challan</strong></td>
		
      </tr>
	  <tr>
	  		
	         <td height="23" width="20%" colspan="" align="center" valign="middle" style="font-size:20px;">
			         <img src="assets/images/LOGO VAMAN EXPORTS .png" alt="Your Company Logo" style="max-width: 200px; height: auto;"><br>

			 </td>
        <td height="" width="75%" colspan="" align="center" valign="middle" style="font-size:15px;"> <br> 
SF.NO.285, DOOR NO.1 WARD NO.51, UOORGOUNDER NAGAR, DHARAPURAM ROAD,
TIRUPUR,641 608.,
04296-272400 ,04296-272500 , 04296-2726000</strong></td>
		      </tr>
	  ';
				              

         while ($row = mysqli_fetch_assoc($result_workassign)) {
          $con_name=$row['to_contractor'];
          $query = "SELECT *  FROM contractors WHERE con_name = '".$con_name."'";
          //var_export($query);
          $result = mysqli_query($zconn, $query);
          //var_export($result);
          if ($result && mysqli_num_rows($result) > 0) {
              $address_row = mysqli_fetch_assoc($result);
              $con_address = $address_row['con_address'];
              $con_number = $address_row['con_number'];
              
              // Echoing to_contractor, con_address, and con_number
             // echo "To Contractor: " . $row['to_contractor'] . "<br>";
            //  echo "Contractor Address: " . $con_address . "<br>";
            //  echo "Contractor Number: " . $con_number . "<br>";
          }
   
    echo '<tr>
        <td width="70%" rowspan="2" valign="top">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges">
          <tr>
            <td width="60%" align="left" valign="middle" style="border-left:1px groove black; border-bottom:1px groove black; font-size: 18px;"><strong>To:</strong></td>
          </tr>
          <tr>
            <td width="60%" height="50" align="left" valign="top" style="padding-left:30px;font-size:14px;border-left:1px groove black">
            ' . $con_name . ' <br>
            '. $con_address .'<br>
            '.$con_number.'<br>
                </strong></td>
          </tr>
        </table></td>
        <td width="100%" height="10" align="center" valign="middle" style=" border-top:1px groove black; font-size: 18px;">
		 
		      <span style="float: left;"><strong>Dc No:</strong>&nbsp; ' . $row['dc_no'] . '</span>
        <span style="float: right;"> <strong>Date: </strong>&nbsp;' . $row['dc_date'] . '</span>
   
        <div style="clear: both;"></div>
   </td>
        <!--td width="100%" align="center" valign="middle" style="border-right:none; border-top:1px groove black; font-size: 14px;"></td-->
      </tr>
      <tr>
	  
	  
        <td height="27" align="left" valign="middle" style="padding:10px;border-top:1px groove black; font-size:14px;"><strong>Style Code : </strong>&nbsp; ' . $row['style_no'] . '<br>
        <strong>Department :</strong>&nbsp; ' . $row['from'] . '
		</td>
        <!--td width="30%" align="left" valign="middle" style="padding:10px;border-right:1px groove black;border-top:1px groove black; font-size:14px;"></td-->
      </tr>';
	   }
         
     echo '<tr>
        <td height="21" align="center" valign="middle" style="border-right:1px groove black; font-size: 14px;"><strong>Particulars</strong></td>
        <td height="21" align="center" valign="middle" style=" border-top:1px groove black; font-size: 14px;"><strong>Quantity</strong></td>
        <!--td colspan="2" align="center" valign="middle" style="border-right:1px groove black; border-top:1px groove black; font-size: 14px;"><strong>Remarks</strong></td-->
      </tr>
      <tr>
        <td height="157" align="left" valign="top" style="border-right:1px groove black;">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1">';

// Retrieve unique size IDs for the selected order_no
$uniqueSizeIds = array();

$sectBrnQry = "SELECT DISTINCT size_id FROM workassign_dc WHERE dc_no='" . $_GET['dc_no'] . "'";
$secBrnResource = mysqli_query($zconn, $sectBrnQry);

while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
    $uniqueSizeIds[] = $coldata['size_id'];
}

// Create table headers for color names
echo '<tr>
            <!--td style="width: 3%">S. No.</td-->
            <td width="13%" height="25" align="center" valign="middle" style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;"><strong>Color</strong></td>';

// Create table headers for each size ID
foreach ($uniqueSizeIds as $sizeId) {
    echo '<td width="13%" height="25" align="center" valign="middle" style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;"><strong>' . $sizeId . '</strong></td>';

}
echo '<td width="13%" height="25" align="center" valign="middle" style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;"><strong>Total</strong></td>';

echo '
        </tr>
    </thead>
    <tbody>';

$i = 1;

// Initialize arrays to store color-wise totals
$colorTotals = array();

// Retrieve unique colors for the selected order_no
$uniqueColors = array();

$sectBrnQry = "SELECT DISTINCT color FROM workassign_dc WHERE dc_no='" . $_GET['dc_no'] . "'";
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
$sectBrnQry = "SELECT * FROM workassign_dc WHERE dc_no='" . $_GET['dc_no'] . "'";
$secBrnResource = mysqli_query($zconn, $sectBrnQry);

while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
    $colorQuantities[$coldata['size_id']][$coldata['color']] = $coldata['qty_val'];
}

// Loop through the colors and display quantities for each size ID in rows
foreach ($uniqueColors as $color) {
    echo '<tr>
           <!--td style="width: 3%">' . $i . '</td-->
            <td width="13%" height="30" align="center" valign="middle" style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;">' . $color . '</td>';

    // Initialize the color-wise total for this row
    $colorTotal = 0;

    // Loop through unique size IDs and display quantities for each color
    foreach ($uniqueSizeIds as $sizeId) {
        $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;
        echo '<td width="13%" height="19" align="center" valign="middle" style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;">' . $quantity . '</td>';

        // Add the quantity to the color-wise total for this row
        $colorTotal += $quantity;
       
	
   
    }
    echo '<td width="13%" height="19" align="center" valign="middle" style="border-top:1px groove black;border-left:1px groove black; font-size: 12px;">' . $colorTotal . '</td>';
    // Display the color-wise total for this row
    $colorTotal1 += $colorTotal;

$amountInWords = convertNumberToWordsForIndia($colorTotal1);
    echo '
        </tr>';
    $i++;
    
}

echo '</tbody>
    </table>
    </td>';

echo '<td height="157" align="center" valign="top" style=""><table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1">
            <tr>
              <td height="30" align="center" valign="middle"style="border-top:1px groove black; font-size: 14px;">&nbsp;</td>
            </tr>
            
            <tr>
              <td height="30" align="center" valign="middle"style="border-top:1px groove black;font-size: 12px;"><strong>' . $colorTotal1 . '</strong></td>
              
            </tr>
           
            
           
        </table></td>
        <td colspan="2" valign="top"style="border-top:1px groove black;"></td>
      </tr>
      <tr>
	 
        <td height="21" valign="top"style="border-right:1px groove black; border-top:1px groove black; font-size: 14px;"><strong>Grand Total:</strong>&nbsp;&nbsp;' . $amountInWords . '
        </td>
        <td height="21" width="100%" align="center" valign="middle" style=" border-top:1px groove black; font-size: 14px;width:100%;"><strong>Total Values : &nbsp;' . $colorTotal1 . '</strong></td>
        <td colspan="2" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" valign="bottom"style="border-top:1px groove black; font-size: 14px;">
        <div align="left"><strong>Received in good condition</strong></div>
        <br />
        <div align="right" style="font-size:14px;"><strong>For Vaman Experts</strong></div>
        </td>
      </tr>
    </table> 
    </p>';
            } else {
                echo "No data available for the specified dc_no.";
            }
        } else {
            // Handle the case where queries failed
            echo "Error in queries: " . mysqli_error($zconn);
        }
    } else {
        // Handle the case where dc_no is not set in the URL
        echo "Error: dc_no parameter not provided in the URL.";
    }
} else {
    // User is not logged in, redirect to login page
    echo "<script>window.location.href='login.php';</script>";
}
?>


   

</body>
</html>
