<?php
session_start();
include('includes/config.php');

function numberToWords($number) {
    // Define an array of words for numbers
    $words = array(
        0 => 'Zero',
        1 => 'One',
        2 => 'Two',
        3 => 'Three',
        4 => 'Four',
        5 => 'Five',
        6 => 'Six',
        7 => 'Seven',
        8 => 'Eight',
        9 => 'Nine',
        10 => 'Ten',
        11 => 'Eleven',
        12 => 'Twelve',
        13 => 'Thirteen',
        14 => 'Fourteen',
        15 => 'Fifteen',
        16 => 'Sixteen',
        17 => 'Seventeen',
        18 => 'Eighteen',
        19 => 'Nineteen',
        20 => 'Twenty',
        30 => 'Thirty',
        40 => 'Forty',
        50 => 'Fifty',
        60 => 'Sixty',
        70 => 'Seventy',
        80 => 'Eighty',
        90 => 'Ninety'
    );

    // Check if the number is valid and within the supported range
    if ($number < 0 || $number > 99999) {
        return 'Invalid';
    }

    // Convert the number to words
    if ($number < 21) {
        return $words[$number];
    } elseif ($number < 100) {
        $tens = $words[10 * (int)($number / 10)];
        $remainder = $number % 10;
        if ($remainder > 0) {
            return $tens . '-' . $words[$remainder];
        } else {
            return $tens;
        }
    } elseif ($number < 1000) {
        $hundreds = $words[(int)($number / 100)] . ' Hundred';
        $remainder = $number % 100;
        if ($remainder > 0) {
            return $hundreds . ' and ' . numberToWords($remainder);
        } else {
            return $hundreds;
        }
    } else {
        $thousands = numberToWords((int)($number / 1000)) . ' Thousand';
        $remainder = $number % 1000;
        if ($remainder > 0) {
            return $thousands . ' ' . numberToWords($remainder);
        } else {
            return $thousands;
        }
    }
}

// Usage example:
//$amount = 12345; // Replace with your actual amount
//$amountInWords = numberToWords($amount);
//echo $amountInWords;

if (isset($_REQUEST['id'])) {
    $id = $_REQUEST['id'];

    // Fetch data from the 'cheque_payments' table
    $query = "SELECT * FROM cheque_payments WHERE id = $id";
    $result = mysqli_query($zconn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $res = mysqli_fetch_object($result);
    }

    // Fetch data from 'cheque_master' based on the 'to' field (adjust the field name accordingly)
    $cust_res = mysqli_fetch_object(mysqli_query($zconn, "SELECT * FROM cheque_master WHERE id = $res->payee"));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <style type="text/css">
        @page {
            margin-top: 0px;
            margin-left: 30px;
            margin-right: 0px;
            margin-bottom: 0px;
        }

        body {
            width: 700px;
            height: 250px;
            vertical-align: middle;
          
            margin: 0px;
        }

        #ac_pay {
            width: 90px;
            height: 40px;
            font-size: 10px;
            margin-bottom: -10px;
        }
    </style>
    <script>
        window.print();
    </script>
<?php 
if(isset($_REQUEST['refresh'])){
	$refresh=$_REQUEST['refresh'];
	echo('<meta http-equiv="refresh" content="0;URL='.$refresh.'" />');
}
else{?>
<script type="text/javascript">
setTimeout("location.href = 'cheque2.php';",500);
</script>
<?php }?>

<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>Cheque Print</title>
</head>
<body>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td height="45" colspan="2" align="right" valign="middle">
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="72%" align="left">&nbsp;
        	
        </td>
        <td width="28%" height="35" align="right" style="letter-spacing:11.2px; padding-right:6px; padding-bottom: 5px;"><?php echo date("dmY",strtotime($res->date));?></td>
        </tr>
    </table></td>
  </tr>
               
        
    <tr>
        <td height="35" colspan="2">
            <?php if ($res->payee_type == 'A/C Payee') { ?>
                <div id="ac_pay">A/C Payee</div>
            <?php } ?>
			    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

            <?php echo $res->payee; ?>
        </td>
    </tr>
    <tr>
        <td height="38" colspan="2" style="text-transform: capitalize;">
           
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	
			<?php echo numberToWords($res->amount) . " Rupees Only"; ?>
          
		</td>
    </tr>
    <tr>
        <td width="78%" height="49" align="center" valign="middle">
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
        <td width="22%" align="left" valign="top">
			<?php echo $res->amount; ?>

            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        </td>
    </tr>
</table>
</body>
</html>
