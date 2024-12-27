
<!doctype html>
<html>
<head><meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">

<title>Sankar knitts Delivery Challen</title>
<style type="text/css">
table.curvedEdges {border:1px groove black;}
table.curvedEdges1 {border-bottom:1px groove black;font-size: 16px;}
.curvedEdges TR #header H2 {color: #FFF; }
body{margin: 0px;font-family:"calibri", monospace;font-size: 16px;letter-spacing:1px;}
</style>
<?php

function convertNumber($number)
{
    list($integer, $fraction) = explode(".", (string) $number);

    $output = "";

    if ($integer{0} == "-")
    {
        $output = "negative ";
        $integer    = ltrim($integer, "-");
    }
    else if ($integer{0} == "+")
    {
        $output = "positive ";
        $integer    = ltrim($integer, "+");
    }

    if ($integer{0} == "0")
    {
        $output .= "zero";
    }
    else
    {
        $integer = str_pad($integer, 36, "0", STR_PAD_LEFT);
        $group   = rtrim(chunk_split($integer, 3, " "), " ");
        $groups  = explode(" ", $group);

        $groups2 = array();
        foreach ($groups as $g)
        {
            $groups2[] = convertThreeDigit($g{0}, $g{1}, $g{2});
        }

        for ($z = 0; $z < count($groups2); $z++)
        {
            if ($groups2[$z] != "")
            {
                $output .= $groups2[$z] . convertGroup(11 - $z) . (
                        $z < 11
                        && !array_search('', array_slice($groups2, $z + 1, -1))
                        && $groups2[11] != ''
                        && $groups[11]{0} == '0'
                            ? " and "
                            : ", "
                    );
            }
        }

        $output = rtrim($output, ", ");
    }

    if ($fraction > 0)
    {
        $output .= " point";
        for ($i = 0; $i < strlen($fraction); $i++)
        {
            $output .= " " . convertDigit($fraction{$i});
        }
    }

    return $output;
}

function convertGroup($index)
{
    switch ($index)
    {
        case 11:
            return " decillion";
        case 10:
            return " nonillion";
        case 9:
            return " octillion";
        case 8:
            return " septillion";
        case 7:
            return " sextillion";
        case 6:
            return " quintrillion";
        case 5:
            return " quadrillion";
        case 4:
            return " trillion";
        case 3:
            return " billion";
        case 2:
            return " million";
        case 1:
            return " thousand";
        case 0:
            return "";
    }
}

function convertThreeDigit($digit1, $digit2, $digit3)
{
    $buffer = "";

    if ($digit1 == "0" && $digit2 == "0" && $digit3 == "0")
    {
        return "";
    }

    if ($digit1 != "0")
    {
        $buffer .= convertDigit($digit1) . " hundred";
        if ($digit2 != "0" || $digit3 != "0")
        {
            $buffer .= " and ";
        }
    }

    if ($digit2 != "0")
    {
        $buffer .= convertTwoDigit($digit2, $digit3);
    }
    else if ($digit3 != "0")
    {
        $buffer .= convertDigit($digit3);
    }

    return $buffer;
}

function convertTwoDigit($digit1, $digit2)
{
    if ($digit2 == "0")
    {
        switch ($digit1)
        {
            case "1":
                return "ten";
            case "2":
                return "twenty";
            case "3":
                return "thirty";
            case "4":
                return "forty";
            case "5":
                return "fifty";
            case "6":
                return "sixty";
            case "7":
                return "seventy";
            case "8":
                return "eighty";
            case "9":
                return "ninety";
        }
    } else if ($digit1 == "1")
    {
        switch ($digit2)
        {
            case "1":
                return "eleven";
            case "2":
                return "twelve";
            case "3":
                return "thirteen";
            case "4":
                return "fourteen";
            case "5":
                return "fifteen";
            case "6":
                return "sixteen";
            case "7":
                return "seventeen";
            case "8":
                return "eighteen";
            case "9":
                return "nineteen";
        }
    } else
    {
        $temp = convertDigit($digit2);
        switch ($digit1)
        {
            case "2":
                return "twenty-$temp";
            case "3":
                return "thirty-$temp";
            case "4":
                return "forty-$temp";
            case "5":
                return "fifty-$temp";
            case "6":
                return "sixty-$temp";
            case "7":
                return "seventy-$temp";
            case "8":
                return "eighty-$temp";
            case "9":
                return "ninety-$temp";
        }
    }
}

function convertDigit($digit)
{
    switch ($digit)
    {
        case "0":
            return "zero";
        case "1":
            return "one";
        case "2":
            return "two";
        case "3":
            return "three";
        case "4":
            return "four";
        case "5":
            return "five";
        case "6":
            return "six";
        case "7":
            return "seven";
        case "8":
            return "eight";
        case "9":
            return "nine";
    }
}

 
 $test = convertNumber($num);

 echo $test;

?>
<link rel="stylesheet" href="css files/dcstyle.css"/>
</head>

<meta http-equiv="refresh" content="0;URL=<?php echo $refresh;?>" />
<script>window.print();</script>

<body>

<div class="container"  style="border:0px solid black;width:760px;height:500px;">


<table width="100%"  height="" border="0"  cellpadding="0" cellspacing="0" style="margin-bottom:0px;border:1px solid black;margin-top:0px; border-bottom:0px solid black;font-family:Arial, sans-serif; ">
  <tbody style="">
    <tr style="">
	
     <!--td  align="left" style="font-size:14px;"><strong>GST NO.  33AAJFR3200L1ZE</strong></td-->
	
      <td align="left" style="font-size:20px;text-align:center;padding-left:0px;"><strong>Sankar Knits [ General PO DC ]</strong></td>
      
      <td align="right" style="font-size:14px; text-align:right;"> &nbsp;</td>
      

     
    </tr>
  </tbody>
  </table>
  
      <td height="39" colspan="5" align="center" valign="middle" id="header" >
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="curvedEdges">
	
	<tr>
	<td height="39" colspan="5" align="center" valign="middle" id="header" >
	        <img src="assets/images/sankar_knits_new_logo.jpeg" alt="Your Company Logo" style="padding:5px;max-width: 200px; height: auto;"><br>

	</td>
	<td height="39" colspan="5" align="center" valign="middle" id="header" >
	 Sri Sankar Knits Pvt Ltd<br> 
SF NO: 307/1B & 2A, Kanthampalayam road, 
		M.Nathampalayam pirivu, Neagr Tamara Texnit,
		Sembianallur post, Covai Bye Pass,  <br>                         
		Avinashi-641654,<br> Tiruppur DT.<br>
		04296-272400 ,04296-272500 , 04296-272600
	</td>
	</tr>
	</table>
	</td>
  <table width="100%"  height="" border="0"  cellpadding="0" cellspacing="0" style="margin-bottom:0px;border:1px solid black;margin-top:0px; border-bottom:none;border-top:none;font-family:Arial, sans-serif; ">
  <tbody style="">
  
  
  
  
  
  
   <tr style="">
   <?php
	   include('includes/config.php');
$fetch=mysqli_fetch_object(mysqli_query($zconn,"select * from  general_po_dc where dc_no='".$_GET['dc_no']."' "));
	   //var_dump($fetch);
?>
      <td  style="padding:10px;width:35%;font-size:14px;" valign="top">
      <span style="margin-top:0px;" >TO:</span><br><br>
		<?php echo $fetch->party_name ?>
	
         </td>
         
         
         
<td  style="border-left:1px solid black;border-top:0px solid black;font-size:12px;padding:10px;" valign="top">
	<span style="font-size:14px;">
Date:<strong><?php echo $fetch->dc_date ?></strong></span><br><br>
<span style="font-size:14px;" valign="top">Dc No:<strong><?php echo $fetch->dc_no ?></strong></span><br>

</td>
    </tr>
    
</table>
<table    border="0"  cellpadding="0" cellspacing="0" style="border:1px solid black;font-family:calibri; " >
    <tr style="text-align:center;line-height: 22%;">
      <td colspan="1" height="30px" width="3%" style="border-right:1px solid black;border-bottom:1px solid black;font-size:16px;  font-weight:bold;">S.no </td>
      
      <td colspan="8" height="30px" 
      style="border-right:1px solid black;border-bottom:1px solid black;font-size:16px; font-weight:bold;">Particulars</td>
      <td colspan="1" height="30px" width="11%" 
      style="border-right:0px solid black;border-bottom:1px solid black;text-align:center;font-size:16px; font-weight:bold;">
      Qty / Kg</td>
      
    </tr>
 
<?php
// Perform a query
$query = "SELECT * FROM general_po_dc where dc_no='".$_GET['dc_no']."'";
$result = mysqli_query($zconn, $query);

// Fetch data and store it in an array
$fetchData = [];
while ($row = mysqli_fetch_assoc($result)) {
    $fetchData[] = (object) $row; // Converting associative array to object
}
?>


	<?php
	$serialNumber = 1;
	foreach ($fetchData as $fetch): ?>
		
    <tr style="text-align:center;">
      <td  height="30px" style="border-right:1px solid black;font-size:16px;"><?php echo $serialNumber; ?></td>
      <td height="30px" colspan="8" style="border-right:1px solid black;font-size:16px;"><?php echo $fetch->desc ?></td>
      <td  height="30px" style="border-right:0px solid black;text-align:center;font-size:16px;"><?php echo $fetch->received_wgt;  $totalReceivedWeight += $fetch->received_wgt;?></td>
    </tr>
 <?php
    // Increment serial number for the next iteration
    $serialNumber++;
    ?>
<?php endforeach; ?>
				 <tr height="30px" 
                 style="font-family:Palatino linotype; border-top: white; border-right: white; border-bottom: white;">		
		<td style="border-right:1px solid black;border-left:0px solid black;"></td>	
		<td colspan="8" style="border-right:1px solid black;"></td>	
		<td style="border-right:0px solid black;"></td>	
        </tr>

    <tr style="font-size:14px;">
      <td colspan="8" height="20px" 
      style="border-right:1px solid black;border-bottom:0px solid black;font-size:14px;border-top:1px solid black;"> 
      <?php echo strtoupper(convertNumber("$totalReceivedWeight"));?>&nbsp;&nbsp;&nbsp;</td>
      <td width="10%" height="20px" 
      style="text-align:center;border-right:1px solid black;border-bottom:0px solid black;font-size:16px; border-top:1px solid black;"><strong>Total</strong></td>
      <td  height="20px" style="text-align:center;border-bottom:0px solid black;border-right:0px solid black;font-size:16px;border-top:1px solid black;"><strong><?php echo $totalReceivedWeight; ?>
      	</strong></td>
		
		
    </tr>
	  </tbody>
	  </table>
	  <table width="100%" border="0"  height="60px"  style="border-left:1px solid black;border-right:1px solid black;border-bottom:1px solid black;font-family:Arial, sans-serif;font-size:14px;">
    <tbody>
	<tr>
      <td colspan="10" height="50px">&nbsp;</td>
   </tr>
<tr>
      <td colspan="10" valign="bottom" style="font-size:16px;">Received in good condition</td>
      <td valign="bottom" style="margin-left:100px;font-size:16px;">Prepared By</td>
	  <td valign="bottom" align="right" style="font-size:16px;">For Sri Sankar Knits Pvt Ltd</td>
   </tr>
<tr>
      
    </tr>
 </tbody>
</table>


</div>

</body>
</html>