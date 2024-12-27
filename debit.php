<?php
include('includes/config.php');

if ($_SESSION['userid'] == '') {
    echo "<script>window.location.href='login.php';</script>";
}
?>
<?php
$recipt_data = mysqli_fetch_object(mysqli_query($mysqli, "SELECT * FROM `debit_note` ORDER BY `debit_note`.`i` DESC"));
$credit_no = $recipt_data->receipt_no + 1;
$credit_date = date("d-m-Y");

if (isset($_REQUEST['save_debit_note'])) {
    $customer_code = $_REQUEST['did'];
    $main_amount = $_REQUEST['total_amount'];
    $bill_no = $_REQUEST['bill_no'];
    $bill_no1 = explode("#", $bill_no);
    $bill_date1 = $_REQUEST['bill_date'];
    $bill_amount1 = $_REQUEST['bill_amount'];
    $sessid = $_REQUEST['sessid'];
    $remarks = $_REQUEST['remarks'];
    $credit_date = date("Y-m-d", strtotime($_REQUEST['receipt_date']));
    $update_rows = count($_REQUEST['sno']);
    for ($sno = 0; $sno < $update_rows; $sno++) {
        $get_my_datas = mysqli_fetch_object(mysqli_query($mysqli, "SELECT * FROM `debit_note_session` WHERE `i` = '" . $_REQUEST['sno'][$sno] . "'"));
        $bill_nos = $get_my_datas->invoice_no;
        $bill_no = explode("#", $bill_nos);
        $bill_date = $get_my_datas->invoice_date;
        $bill_amount = $get_my_datas->amount;
        mysqli_query($mysqli, "INSERT INTO `debit_note` (`i`, `receipt_no`, `receipt_date`, `sessid`, `customer_code`, `main_amount`, `invoice_no`, `invoice_date`, `amount`,`remarks`) VALUES (NULL, '$credit_no', '$credit_date', '$sessid', '$customer_code', '$main_amount', '$bill_no[0]', '$bill_date', '$bill_amount','$remarks')");

        //$inv_data = mysqli_fetch_object(mysqli_query($mysqli, "SELECT * FROM `invoice` WHERE `invoice_no` = $bill_no[0]"));
        //$inv_paid = $inv_data->amount_paid - $bill_amount1;
        //mysqli_query($mysqli, "UPDATE `invoice` SET `amount_paid` = '$inv_paid' WHERE `invoice`.`invoice_no` = $bill_no[0]");

    }
    if ($bill_amount1 > '0') {
        mysqli_query($mysqli, "INSERT INTO `debit_note` (`i`, `receipt_no`, `receipt_date`, `sessid`, `customer_code`, `main_amount`, `invoice_no`, `invoice_date`, `amount`,`remarks`) VALUES (NULL, '$credit_no', '$credit_date', '$sessid', '$customer_code', '$main_amount', '" . $bill_no1[0] . "', '$bill_date1', '$bill_amount1','$remarks')");

        //$inv_data = mysqli_fetch_object(mysqli_query($mysqli, "SELECT * FROM `invoice` WHERE `invoice_no` = '" . $bill_no1[0] . "'"));
        //$inv_paid = $inv_data->amount_paid - $bill_amount1;
        //mysqli_query($mysqli, "UPDATE `invoice` SET `amount_paid` = '$inv_paid' WHERE `invoice`.`invoice_no` = '" . $bill_no1[0] . "'");

    }
    echo '<script>alert("Debit Added Successfully");</script>';
    echo '<meta http-equiv="refresh" content="0;URL=debit_note.php?sessid=' . $random . '">';
}
if (isset($_REQUEST['delete'])) {
    $delete = $_REQUEST['delete'];
    $sessid = $_REQUEST['sessid'];
    mysqli_query($mysqli, "DELETE FROM `debit_note_session` WHERE `debit_note_session`.`i` = $delete") or die(mysqli_error($mysqli));
    echo '<script>alert("Deleted Successfully");</script>';
    echo '<meta http-equiv="refresh" content="0;URL=debit_note.php?sessid=' . $sessid . '">';
}
if (isset($_REQUEST['add_row'])) {
    $sessid = $_REQUEST['sessid'];
    $did = $_REQUEST['did'];
    $bill_no = $_REQUEST['bill_no'];
    $bill_date = $_REQUEST['bill_date'];
    $bill_amount = $_REQUEST['bill_amount'];
    $main_amount = $_REQUEST['total_amount'];
    $remarks = $_REQUEST['remarks'];
    if (isset($_REQUEST['sno'])) {
        $update_rows = count($_REQUEST['sno']);
        for ($sno = 0; $sno < $update_rows; $sno++) {
            $bill_amount1 = $_REQUEST['bill_amount1'][$sno];
            mysqli_query($mysqli, "UPDATE `debit_note_session` SET `amount` = '$bill_amount1' WHERE `debit_note_session`.`i` = '" . $_REQUEST['sno'][$sno] . "'") or die(mysqli_error($mysqli));
        }
    }
    $check = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM `debit_note_session` WHERE `sessid` = '$sessid' AND `invoice_no` = '$bill_no'"));
    if ($check == '0') {
        if ($bill_no != '') {
            mysqli_query($mysqli, "INSERT INTO `debit_note_session` (`i`, `sessid`,  `customer_code`, `main_amount`, `invoice_no`, `invoice_date`,`amount`) VALUES (NULL, '$sessid',  '$did','$main_amount', '$bill_no', '$bill_date', '$bill_amount')") or die(mysqli_error($mysqli));
        } else {
            echo '<script>alert("Choose Any Bill");</script>';
        }
    } else {
        echo '<script>alert("Already Exists, please add another receipt no");</script>';
    }
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
    <title><?php echo SITE_TITLE; ?> - Debit Note</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include('includes/header.php'); ?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php include('includes/sidebar.php'); ?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Debit Note</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Debit Note</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                        <form name="debit_entry" id="debit" method="post">
                                <div class="row" style="padding-top: 0px;">
                                    <div class="col-md-12">
                                        <div class="card-body">
                                            <div class="card-body">
                                                <table class="table table-striped table-bordered" width="100%" border="1" cellspacing="0" cellpadding="0">
                                                    <tr>
                                                        <td width="20%" height="35" align="right"><strong>Debit Receipt no&nbsp;:&nbsp;</strong></td>
                                                        <td width="22%" align="left"><input type="text" name="receipt_no" value="<?php echo $credit_no; ?>" class="form-control" readonly /></td>
                                                        <td width="8%" align="right"><strong>Date&nbsp;:&nbsp;</strong></td>
                                                        <td width="16%" align="left"><input type="text" name="receipt_date" class="form-control datepicker" value="<?php echo $credit_date; ?>" readonly="readonly"></td>
                                                        <td width="13%" align="left">&nbsp;</td>
                                                        <td width="21%" align="left">&nbsp;</td>
                                                    </tr>
                                                    <tr>
                                                        <td height="35" align="right"><strong>&nbsp;&nbsp;Party&nbsp;:&nbsp;</strong></td>
                                                        <td><select name="did" class="form-control" data-rel="chosen" onchange="this.form.submit()">
                                                                <option value="">----Select----</option>
                                                                <?php
                                                                $select_name = mysqli_query($mysqli, "SELECT * FROM  `master_customer`");
                                                                while ($select_name1 = mysqli_fetch_object($select_name)) { ?>
                                                                    <option value="<?php echo $select_name1->customercode; ?>"<?php
                                                                    if ($select_name1->customercode == $_REQUEST['did']) {
                                                                        echo ' selected="selected"';
                                                                        $direct = 'false';
                                                                        $select_name1distributorcode = $select_name1->customercode;
                                                                        $agent = $select_name1->typeofcustomer;
                                                                    } ?>><?php echo $select_name1->customername; ?></option>
                                                                <?php } ?>
                                                            </select></td>
                                                        <td align="right"><strong>Amount&nbsp;&nbsp;:&nbsp;</strong></td>
                                                        <td><input type="number" name="total_amount" id="total_amount" required value="<?php echo $_REQUEST['total_amount']; ?>" class="form-control" onkeyup="calculation_sc()" /></td>
                                                        <td><strong>Balance Amount</strong></td>
                                                        <td><input type="text" name="balance" id="balance" value="0" style="background-color:#fff; border:none;" class="form-control" readonly /></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">
                                                            <table class="table table-striped table-bordered" width="100%" border="1" cellspacing="0" cellpadding="0">
                                                                <tr>
                                                                    <td height="31" align="center"><strong>Ref No</strong></td>
                                                                    <td align="center"><strong>Ref / Date</strong></td>
                                                                    <td align="center"><strong>Amount</strong></td>
                                                                    <td align="center"><input type="submit" name="add_row" class="btn btn-inverse" value="Add me" /></td>
                                                                </tr>
                                                                <?php
                                                                $sql = mysqli_query($mysqli, "SELECT * FROM `debit_note_session` where `sessid` = '" . $_REQUEST['sessid'] . "'");
                                                                while ($res = mysqli_fetch_array($sql)) {
                                                                    ?>
                                                                    <tr><input type="hidden" name="sno[]" value="<?php echo $res['i']; ?>" />
                                                                        <td align="left"><?php echo $res['invoice_no']; ?></td>
                                                                        <td align="center"><input type="text" name="bill_date1[]" readonly id="bill_date1" value="<?php echo $res['invoice_date']; ?>" class="form-control" /></td>
                                                                        <td align="center"><input type="text" name="bill_amount1[]" id="bill_amount1_<?php echo $res['i']; ?>" value="<?php echo $res['amount']; ?>" class="form-control" onkeyup="calculation_sc()" /></td>
                                                                        <td align="center"><a href="?sessid=<?php echo $_REQUEST['sessid']; ?>&delete=<?php echo $res['i']; ?>" class="btn btn-danger">Remove</a></td>
                                                                    </tr>
                                                                <?php } ?>
                                                                <tr>
                                                                    <td align="left"><select name="bill_no" id="bill_no" class="form-control" data-rel="chosen" onchange="fill_amount()">
                                                                            <option value="">----Select----</option>
                                                                            <?php
                                                                            $sql = mysqli_query($mysqli, "SELECT * FROM `invoice` WHERE `customer_code` LIKE '" . $_REQUEST['did'] . "' ORDER BY `customer_code` ASC");
                                                                            while ($res = mysqli_fetch_object($sql)) {
                                                                                $inv_data = $res->invoice_no . ' # ' . $res->date . ' # ' . round($res->grand_total);
                                                                                ?>
                                                                                <option value="<?php echo $inv_data; ?>"><?php echo "A" . $inv_data; ?></option>
                                                                            <?php } ?>
                                                                        </select></td>
                                                                    <td align="center"><input type="text" name="bill_date" id="bill_date" value="" class="form-control" onkeyup="calculation_sc()" /></td>
                                                                    <td align="center"><input type="text" name="bill_amount" id="bill_amount" value="0" class="form-control" onkeyup="calculation_sc()" /></td>
                                                                    <td align="center">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" align="left" valign="top">&nbsp;</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" align="left" valign="top"><strong>Remarks</strong>&nbsp;&nbsp;&nbsp;<br />&nbsp;&nbsp;&nbsp;&nbsp;<textarea name="remarks" class="form-control" cols="4" rows="3"><?php echo $remarks; ?></textarea></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" align="center" class="form-actions">
                                                                        <input type="submit" name="save_debit_note" value="Save Changes" class="btn btn-primary" onClick="return check_me_balance()" />
                                                                        <input type="reset" name="cancel" value="Cancel" class="btn" />
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Page wrapper  -->
            <!-- ============================================================== -->
            <!-- End Wrapper -->
            <!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php'); ?>
            <!-- End footer -->
        </div>
    </div>
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
        function fill_amount() {
            var first_val = document.getElementById('bill_no').value;
            var str_array = first_val.split('#');
            document.getElementById('bill_date').value = str_array[1];
            document.getElementById('bill_amount').value = str_array[2];
        }

        function calculation_sc() {
            var main_amount = document.getElementById('total_amount').value;
            var hello = parseInt(document.getElementById('bill_amount').value);
            <?php $sql = mysqli_query($mysqli, "SELECT * FROM `debit_note_session` where `sessid` = '" . $_REQUEST['sessid'] . "'");
            while ($res = mysqli_fetch_array($sql)) { ?>
                var bill_session_<?php echo $res['i']; ?> = parseInt(document.getElementById('bill_amount1_<?php echo $res['i']; ?>').value);
            <?php } ?>

            var total_amount = <?php $sql = mysqli_query($mysqli, "SELECT * FROM `debit_note_session` where `sessid` = '" . $_REQUEST['sessid'] . "'");
                                while ($res = mysqli_fetch_array($sql)) { ?>bill_session_<?php echo $res['i']; ?>+<?php } ?>hello;
            //alert(total_amount);

            document.getElementById('balance').value = parseInt(main_amount - total_amount);
        }

        function check_me_balance() {
            var balancee = parseInt(document.getElementById('balance').value);
            if (balancee == '0') {
                var r = confirm("To confirm this amount Debit note..!");
                if (r == true) {
                    return true;
                } else {
                    return false;
                }
            } else {
                alert('Sorry Amount mismatch');
                return false;
            }
        }
        calculation_sc();
    </script>
</body>

</html>