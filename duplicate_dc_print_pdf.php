<?php


	include('includes/config.php');
	if($_SESSION['userid']==''){
		echo "<script>window.location.href='login.php';</script>";
	}
	$gid=$_GET['id'];
	$to0=$_GET['to'];	
	$from0=$_GET['from'];
	$order0=$_GET['order'];
	$style0=$_GET['style'];
	
	// $sel1 = mysqli_query($zconn,"select * from process_dc_out where dc_no='$gid'");
	// while($data=mysqli_fetch_array($sel1)){
	// 	$style=$data['style_no'];
	// 	$from_addr=$data['from_addr'];	
	// 	$to_process=$data['to_process'];
	// 	$date=$data['dc_date'];	
	// 	$dc_no=$data['dc_no'];
	
	// }

	$sql_master = "SELECT * FROM process_production1 WHERE id='$gid'";
$result_master = mysqli_query($zconn, $sql_master);
$row_master = mysqli_fetch_assoc($result_master);

// Get the dc_no from the master data.
$dc_no = $row_master['dc_no'];
$process = $row_master['to_process'];
$order = $row_master['order_no'];
$style =$row_master['style_no'];


// Retrieve data from process_dc_out based on dc_no.
$sql_out1 = "SELECT * FROM process_production1 WHERE dc_no='$dc_no'";
$result_out1 = mysqli_query($zconn, $sql_out1);
$row1 = mysqli_fetch_assoc($result_out1);
	//  exit();

?>
      
	  <!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>Yarn Duplicate Dc =<?php echo $dc_no; ?></title>
    <style type="text/css">
        table.curvedEdges {border: 1px solid black; border-collapse: collapse;}
        table.curvedEdges1 {border: 1px solid black; border-collapse: collapse;}
        .curvedEdges TR #header H2 {color: #FFF;}
        body {margin: 0px; font-family: "calibri", monospace; font-size: 16px; letter-spacing: 1px;}
    </style>
</head>
<body>

<div class="container" style="border: 0px solid black; width: 780px; height: 580px;">
    <div class="container" style="border:0px solid black;width:780px;height:580px;">
        <table width="100%" height="50%" border="0" align="center" cellpadding="0" cellspacing="0" class="curvedEdges" style="border: none;">
        <tr>
                <td colspan="3" valign="top">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges" >
               <tr>
    <td width="25%" align="left" valign="top"
        style="padding-left:10px; padding-top:10px; padding-bottom:10px; font-size:17px;">
        <img src="assets/images/LOGO VAMAN EXPORTS .png" alt="Your Company Logo" style="max-width: 200px; height: auto;"><br>
    </td>
    <td width="75%" align="center" valign="top"
        style="padding-left:0px; padding-top:10px; padding-bottom:10px; font-size:17px;">
             VAMAN EXPORTS<br> 
SF.NO.285, DOOR NO.1 WARD NO.51, UOORGOUNDER NAGAR, DHARAPURAM ROAD,   <br>                         
		TIRUPUR,641 608.,<br>
		04296-272400 ,04296-272500 , 04296-272600
    </td>
</tr>
</table>
</td>
</tr>
<tr>
                <td colspan="3" valign="top">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges" style="border-top: none; border-bottom:none;" >
<td  align="center" valign="middle" 
        style="padding-left:0px; padding-top:2px; padding-bottom:2px; font-size:17px;">
       <strong>Production Process Delivery</strong>
    </td>
</table>
</td>
</tr>

            <tr>
                <td colspan="3" valign="top">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges">
    <td width="7%" align="left" valign="top" 
        style="padding-left:10px; padding-top:5px; padding-bottom:5px; height:0px;  font-size: 17px;">
        <div style="border-left: 0px dotted #000; padding-left: 0px;">
            <strong>To:</strong>
        </div>
    </td>
    <td width="43%" align="left" valign="top"
        style="height:0px; padding-top:5px; padding-bottom:5px;  font-size:17px;">
        <div style="border-left: 0px dotted #000; padding-left: 0px;">
            <?php echo $row_master['company_name']; ?>
        </div>
    </td>

<td width="50%" align="left" valign="top" style="padding-left:10px; height:0px; padding-top:5px; padding-bottom:5px;border-top: none; border-bottom:none; border-left:1px solid black; font-size:17px;">
    <table>
		   <tr>
            <td style="vertical-align: middle;"><strong>Dc No</strong></td>
            <td style="vertical-align: middle;">:&nbsp;<?php echo $dc_no; ?></td>
        </tr>
        <tr>
            <td style="vertical-align: middle;"><strong>Date</strong></td>
            <td style="vertical-align: middle;">:&nbsp;<?php echo $row_master['date']; ?></td>
        </tr>
        <tr>
            <td style="vertical-align: middle;"><strong>Indent No</strong></td>
            <td style="vertical-align: middle;">:&nbsp;<?php echo $row_master['order_no']; ?></td>
        </tr>
        <tr>
            <td style="vertical-align: middle;"><strong>Style Code</strong></td>
            <td style="vertical-align: middle;">:&nbsp;<?php echo $row_master['style_no']; ?></td>
        </tr>
     
		 <tr>
            <td style="vertical-align: middle;"><strong>Process</strong></td>
            <td style="vertical-align: middle;">:&nbsp;<?php echo $row_master['sent_to']; ?></td>
        </tr>
        
       
    </table>
</td>

</table>
<tr>
                <td colspan="3" align="left" valign="top" style="border-right:0px solid black; border-top: none; border-bottom:none;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1" style="border-top: none; border-bottom:none;">
                        <tr>
                            <td width="6%" height="25" align="center" valign="middle"
                                style="border-top:0px solid black; font-size: 17px;"><strong>S.no</strong></td>
                            <!--td width="15%" align="center" valign="middle"
                                style="border-left:1px solid black;border-top:0px solid black;font-size: 17px;">
                                <strong>Process</strong></td-->
                            
                            <td width="19%" align="center" valign="middle"
                                style="border-left:1px solid black;border-top:0px solid black;font-size: 17px;">
                                <strong>Fabric Name</strong></td>
                            <td width="10%" align="center" valign="middle"
                                style="border-left:1px solid black;border-top:0px solid black;font-size: 17px;">
                                <strong>Color</strong></td>
                            <!--td width="10%" align="center" valign="middle"
                                style="border-left:1px solid black;border-top:0px solid black;font-size: 17px;">
                                <strong>DIA</strong></td-->
                            <td width="10%" align="center" valign="middle"
                                style="border-left:1px solid black;border-top:0px solid black;font-size: 17px;">
                                <strong>FDIA</strong></span></td>
                                <td width="8%" align="center" valign="middle"
                                style="border-left:1px solid black;border-top:0px solid black;font-size: 17px;">
                                <strong>GSM</strong></span></td>
                                <td width="8%" align="center" valign="middle"
                                style="border-left:1px solid black;border-top:0px solid black;font-size: 17px;">
                                <strong>ROLLS</strong></span></td>
                                <td width="14%" align="center" valign="middle"
                                style="border-left:1px solid black;border-top:0px solid black;font-size: 17px;">
                                <strong>QTY/KG</strong></span></td>
                                
                               
                        </tr>
                        <?php
                        $sql_out = "SELECT * FROM  process_production1  WHERE dc_no='$dc_no'";
                        $result_out = mysqli_query($zconn, $sql_out);
                        


                        $sno = 1;
                        $total = 0;

                        while ($sqlaa = mysqli_fetch_array($result_out, MYSQLI_ASSOC) ) {
					   $style_no = $sqlaa['style_no'];
    // Fetching data for each row of the outer query
    $sql_out1 =mysqli_fetch_array(mysqli_query($zconn,"SELECT DISTINCT fe.fabric_name, fe.dia, fe.gsm, fe.color 
                 FROM fabric_entry AS fe 
                 WHERE fe.style_no = '$style_no'"));
						// 	print_r($sql_out1);
                            $sum = $sqlaa['wgt'];
                            $prepared = $sqlaa['prepared_by'];
                            $driver=$sqlaa['driver_no'];

                            ?>
                            <tr>
                                <td height="19" align="center" valign="middle"
                                    style="border-top:1px solid black; font-size: 17px;">
                                    <?php echo $sno; ?>
                                </td>
                                <!--td align="center" valign="middle"
                                    style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                    <?php echo $sqlaa['sent_to']; ?>
                                </td-->
                                
                               
                                <td align="center" valign="middle"
                                    style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                    <?php echo $sqlaa['fabric_name']; ?>
                                </td>
                                <td align="center" valign="middle"
                                    style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                    <?php echo $sql_out1['color']; ?>
                                </td>
                                <!--td align="center" valign="middle"
                                    style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                    <?php echo $sqlaa['dia']; ?>
                                </td-->
                                <td align="center" valign="middle"
                                    style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                    <?php echo $sql_out1['dia']; ?>

                                </td>
                                <td align="center" valign="middle"
                                    style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                    <?php echo $sql_out1['gsm']; ?>
                                </td>
                               
                                <td align="center" valign="middle"
                                    style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                    <?php echo $sqlaa['rolls']; $total_roll += $sqlaa['rolls']; ?>
                                </td>
                                <td align="center" valign="middle"
                                    style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                    <?php echo $sqlaa['entered_wgt']; $totalDeliveredWeight += $sqlaa['entered_wgt']; ?>
                                </td>
                                
                            </tr>
                           
            
<?php
                            $sno = $sno + 1;
                            $total += $sum;
                        }
                        ?>
                    </table>

                </td>
            </tr>


            <tr>
                <td colspan="3" align="left" valign="top" style="border-right:0px solid black; border-top: none; border-bottom:none;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges1" style="border-top: none; border-bottom:none;">
            <tr>
    <td width="63%" height="25" align="right" valign="middle"
        style="border-top:1px solid black; font-size: 17px;"><strong>Total:</strong></td>
       
    <td width="8%" align="center" valign="middle"
        style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
        <?php echo $total_roll; ?> <!-- Display total rolls -->
    </td>
    <td  width="14%"align="center" valign="middle"
        style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
        <?php echo $totalDeliveredWeight; ?> <!-- Display total delivered weight -->
    </td>
   
                                  
    
</tr>
                    </table>
                    </td>
                    </tr>

            
<tr>
                <td colspan="3" valign="top">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0" class="curvedEdges" style=" border-bottom:none;">
                        
                            <!-- <td width="50%" height="18" align="left" valign="middle"
                                style="padding-left:10px; border-bottom:1px solid black; font-size:17px;"><strong>From: </strong>
                                <strong style="font-size:16px;"></strong></td> -->
                                <!-- <td width="50%" align="left" valign="top"
        style="height:100px; padding-top:5px; padding-bottom:5px; border-left:1px solid black; font-size:17px;">
        <div style="border-left: 1px dotted #000; padding-left: 10px;">
            <strong>DELIVERY TO:</strong>
            &nbsp;&nbsp;&nbsp;&nbsp;Iorange Innovations<br>
            &nbsp;&nbsp;&nbsp;&nbsp;Old busstand,<br>
            &nbsp;&nbsp;&nbsp;&nbsp;Tirupur
        </div>
    </td> -->
                    
    <!-- <td width="17%" align="left" valign="top"
        style="height:50px; padding-top:5px; padding-bottom:5px; border-left:0px solid black; font-size:17px;">
        <div style="border-left: 0px dotted #000; padding-left: 10px;">
            <strong>DELIVERY TO:</strong>
        </div>
    </td>
    <td width="33%" align="left" valign="top"
        style="height:50px; padding-top:5px; padding-bottom:5px; border-left:0px solid black; font-size:17px;">
        <div style="border-left: 0px dotted #000; padding-left: 0px;">
            Iorange Innovations<br>
            Old busstand,
            Tirupur
        </div>
    </td> -->
    
    
    <!-- <td colspan="2" align="left" valign="middle"
                                style="border-left:1px solid black; border-bottom:1px solid black; font-size: 17px;">
                                <strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_master['to_comp']; ?></strong>
                            </td> -->
                    
                    
                            <!-- <td rowspan="4" align="left" valign="top"
                                style="padding-left:40px; font-size:17px; height:100px;"><strong>
                                    Iorange Innovations<br />
                                    Old busstand,
                                    Tirupur<br />
                                </td> -->
                            <!-- <td rowspan="4" align="left" valign="top"
                                style="padding-left:40px; border-left:1px solid black">
                                
                            </td> -->



                           
                                <!-- <td width="50%" align="left" valign="top"
                                style="padding-left:10px;  height:100px; padding-top:5px; padding-bottom:5px; border-left:1px solid black; font-size:17px;">
                                <strong>Order NO&nbsp;&nbsp;&nbsp;&nbsp;:</strong>
                                <!?php echo $row_master['order_no']; ?><br>
                                <strong>Dc
                                    No&nbsp;&nbsp;&nbsp;&nbsp;:</strong><!?php echo $dc_no; ?><br>
                                    <strong>Style NO&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong>
                                <!?php echo $row_master['style_no']; ?><br>
                                <strong>Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</strong><!?php echo $row_master['date']; ?></td>

                            </td> -->


                            <td width="100%" align="left" valign="top" style="padding-left:10px; height:25px; padding-top:5px; padding-bottom:5px;border-top: none; border-bottom:none; border-left:1px solid black; font-size:17px;">
    
                            <strong>Remark:</strong>
        
            <!-- <td  style="vertical-align: middle; ">    <strong>Remark:</strong></td> -->
            
        
        <!-- <tr width="100%">
        <td  width="15%" style=" border-top:1px solid black;"><strong>Driver</strong></td>
            <td  width="30%" style="border-top:1px solid black;">: <?php echo $row1['driver_name']; ?></td>

            <td  width="25%" style="border-top:1px solid black;border-left:1px solid black;"><strong>VehicleNo</strong></td>
            <td   width="30%" style="border-top:1px solid black;">: <?php echo $row1['vehicle_no']; ?></td>
        </tr> -->
        
        
       
    
</td>

                    </table>
                    </td>
                    </tr>

                            
                            <!-- <td width="50%" height="50px" align="left" valign="top" style="padding-left:0px; padding-top:5px; padding-bottom:5px; border-left:1px solid black; font-size:17px;">
    <strong>Remark:</strong><br>
    <table width="100%" >
        <tr>
        <td  width="15%" style="vertical-align: middle;"><strong>Driver</strong></td>
            <td  width="25%" style="vertical-align: middle;">: <?php echo $row1['driver_name']; ?></td>

            <td  width="25%" style="vertical-align: middle;"><strong>Vehicle NO</strong></td>
            <td   width="35%" style="vertical-align: middle;">: <?php echo $row1['vehicle_no']; ?></td>
        </tr>
    </table>
</td>
                    </table>
                    </td>
            </tr> -->
            <tr>
                <td colspan="3" align="left" valign="top" style="border-right:0px solid black;">
                    <table width="100%" border="0" cellpadding="0" cellspacing="0"  class="curvedEdges1">
            <tr>
          
                            <td width="24.9%"  align="center" valign="bottom"
                                style="border-top:0px solid black; font-size: 17px;">
                                
                                <div><?php echo $prepared; ?></div>
                                Prepared By</td>
            
                            <td width="25%" align="center" valign="bottom"
                                style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                Received By</td>
                            <td width="25%" align="center" valign="bottom"
                                style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                Verified By</td>
                            <td width=25%" align="center" valign="bottom"
                                style="border-left:1px solid black;border-top:1px solid black;font-size: 17px;">
                                Authorized By</td>
                    </tr>
                    </td>
                    </tr>

                    

        </table>
    </div>
                    </div>


                    






					</body>
					</html>