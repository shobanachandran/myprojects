<?php
include('includes/config.php');

// Check if the user is logged in
if ($_SESSION['userid'] == '') {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

// Initialize variables
$payee = $date = $cheque_date = $bill_no = $amount = $bank = $payee_type = $desc = "";
$edit_id = 0; // Default value for edit_id

// Check if the "Edit" button was clicked
if (isset($_GET['action']) && $_GET['action'] == 'edit' && isset($_GET['id'])) {
    // Get the record ID from the query parameters
    $edit_id = intval($_GET['id']); // Ensure it's an integer
}


// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Extract form data
    $payee = $_POST['payee'];
    $date = $_POST['date'];
    $cheque_date = $_POST['cheque_date'];
    $bill_no = $_POST['bill_no'];
    $amount = $_POST['amount'];
    $bank = $_POST['bank'];
    $payee_type = isset($_POST['payee_type']) ? "A/C Payee" : ""; // Checkbox value
    $desc = $_POST['desc'];

    // Validate and sanitize input data to prevent SQL injection

    // Check if it's an update or insert operation
    if (!empty($_POST['edit_id'])) {
        $edit_id = (int)$_POST['edit_id'];
        // Update operation
        $updateSql = "UPDATE cheque_payments SET
            payee = '$payee',
            date = '$date',
            cheque_date = '$cheque_date',
            bill_no = '$bill_no',
            amount = '$amount',
            bank = '$bank',
            payee_type = '$payee_type',
            description = '$desc'
            WHERE id = $edit_id";

        // Execute the update query
        if (mysqli_query($zconn, $updateSql)) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record: " . mysqli_error($zconn);
        }
    } else {
        // Insert operation

        // Create your SQL query to insert a new record
        $insertSql = "INSERT INTO cheque_payments (payee, date, cheque_date, bill_no, amount, bank, payee_type, description) VALUES ('$payee', '$date', '$cheque_date', '$bill_no', '$amount', '$bank', '$payee_type', '$desc')";

        // Execute the insert query
        if (mysqli_query($zconn, $insertSql)) {
            echo "Record inserted successfully.";
        } else {
           echo "Error: " . $insertSql . "<br>" . mysqli_error($zconn);

        }
    }
}

// Retrieve the data for the record from the database if editing
if (!empty($_POST['edit_id'])) {
    $edit_id = (int)$_POST['edit_id'];
    $query = "SELECT * FROM cheque_payments WHERE id = $edit_id";
    $result = mysqli_query($zconn, $query);

    if (mysqli_num_rows($result) > 0) {
        // Record with edit_id exists, proceed with the update or display the data for editing
        $row = mysqli_fetch_assoc($result);
        // Extract data from $row and use it in your HTML form for editing
    } else {
        echo "No record found with edit_id: " . $edit_id;
    }
}



// Retrieve the data for the record from the database if editing
if ($edit_id > 0) {
    $query = "SELECT * FROM cheque_payments WHERE id = $edit_id";
    $result = mysqli_query($zconn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        // Populate the form fields with the retrieved data for editing
        $payee = $row['payee'];
        $date = $row['date'];
        $cheque_date = $row['cheque_date'];
        $bill_no = $row['bill_no'];
        $amount = $row['amount'];
        $bank = $row['bank'];
        $payee_type = $row['payee_type'];
        $desc = $row['description'];
    }
}
?>

<!-- Your HTML form goes here, and make sure the form action includes the 'id' parameter when editing -->
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
    <title><?php echo SITE_TITLE; ?> - Jobwork Create Cheque</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
  <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="dist/js/jquery.min.js"></script>
    <script src="dist/js/chosen.jquery.min.js"></script>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <div id="main-wrapper">
            <!-- Topbar header - style you can find in pages.scss -->
            <?php include('includes/header.php'); ?>
            <!-- End Topbar header -->
            <!-- Left Sidebar - style you can find in sidebar.scss  -->
            <?php include('includes/sidebar.php'); ?>
            <!-- End Left Sidebar - style you can find in sidebar.scss  -->
            <!-- Page wrapper  -->
            <div class="page-wrapper" style="min-height: 100%; height: auto;">

                <!-- Bread crumb and right sidebar toggle -->
                <div class="page-breadcrumb">
                    
                </div>
                <!-- End Bread crumb and right sidebar toggle -->
                <!-- Container fluid  -->
                <div class="container-fluid">
                    <div class="row-fluid sortable">
                        <div class="box span12">
                            <div class="box-header well" data-original-title>
                                <h2><i class="icon-edit"></i> Cheque Payment</h2>
                                <div class="box-icon">
                                    <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                                    <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                                    <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
                                </div>
                            </div>
							<div class="card">
    <div class="card-header">
        <h5 class="card-title">Cheque Payment</h5>
    </div>
    <div class="card-body">
                            <div class="box-content">
                                <form name="" action="" method="post">
                                    <table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td height="35" align="right" valign="middle"><strong>Payee Name</strong></td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                            <td valign="middle"><input type="text" style="width: 500px;" class="form-control form-control-sm" name="payee" value="<?php echo $payee; ?>" required></td>
                                        </tr>
                                        <tr>
                                            <td height="35" align="right" valign="middle"><strong>Date</strong></td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                            <td valign="middle"><input type="date" style="width: 500px;" class="form-control" name="date" class="datepicker" id="date" value="<?php echo date('Y-m-d'); ?>"  />
                                                </td>
                                        </tr>
										 <tr>
                                            <td height="35" align="right" valign="middle"><strong>Cheque Date</strong></td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                            <td valign="middle"><input type="date" style="width: 500px;" class="form-control" name="cheque_date" class="datepicker" value="<?php echo date('Y-m-d'); ?>" id="cheque_date" required/>
                                               </td>
                                        </tr>
                                        <tr>
                                            <td height="35" align="right" valign="middle"><strong>Bill No</strong></td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                            <td valign="middle"><input type="text" style="width: 500px;" class="form-control" name="bill_no" id="bill_no" value="<?php echo $bill_no; ?>" /></td>
                                        </tr>
                                        <tr>
                                            <td height="35" align="right" valign="middle"><strong>Amount</strong></td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                            <td valign="middle"><input type="text" style="width: 500px;" class="form-control" name="amount" id="amount" value="<?php echo $amount; ?>" required/></td>
                                        </tr>
                                        <tr>
                                            <td height="35" align="right" valign="middle"><strong>Bank Name</strong></td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                            <td valign="middle">
          <select name="bank" class="form-control" style="width: 500px;" required>
        <option value="">Choose Option</option>

        <?php
        // Select bank names from the banking table
        $result1 = mysqli_query($zconn, "SELECT bank_name FROM banking");

        if (mysqli_num_rows($result1) > 0) {
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $bank = $row1['bank_name'];
                $selected = ($bank_name == $bank) ? 'selected="selected"' : '';

                echo '<option value="' . $bank . '" ' . $selected . '>' . $bank . '</option>';
            }
        }
        ?>
    </select>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td height="35" align="right" valign="middle"><strong>If Account Payee(Tick)</strong></td>
                                            <td align="center" valign="middle"><strong>:</strong></td>
                                           <td valign="middle"><input type="checkbox"   name="payee_type" value="A/C Payee" checked /></td>

                                        </tr>
                                        <tr>
                                            <td width="21%" align="right" valign="top"><strong>Description</strong></td>
                                            <td width="3%" align="center" valign="top"><strong>:</strong></td>
                                            <td width="76%"><textarea name="desc" style="width: 500px;" class="form-control" class="cleditor" id="textarea" cols="45" rows="5" required><?php echo $desc; ?></textarea></td>
                                        </tr>
                                        <tr>
                                           <td colspan="3" align="center" valign="middle" class="form-actions">
    <?php
    if (isset($_REQUEST['action']) && $_REQUEST['action'] == 'edit') {
   ?>
    <input type="hidden" name="edit_id" value="<?php echo $edit_id;?>">
											   <br>
    <input name="update"  type="submit"  class="btn btn-primary" id="Save Changes" value="Update Changes" />
    <?php
    } else {
    ?>
    <br>
    <input name="submit" type="submit" class="btn btn-primary" id="Save Changes" value="Save Changes" />
    <?php } ?>
    <input name="Cancel" type="submit" class="btn" id="Cancel" value="Cancel" />
</td>

                                        </tr>
                                    </table>
                                </form>
<br>
                            			<div class="table-responsive">
									<table id="example" class="table table-striped table-bordered">
      

                                    										<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">

                                        <tr>
                                            <th><strong>Id</strong></th>
                                            <th>Date</th>
                                            <th>Cheque Date</th>
                                            <th><strong>Payee Name</strong></th>
                                            <th>Bank</th>
                                            <th>Desc</th>
                                            <th>Amount</th>
                                            <th><strong>Action</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       
    <?php
    $query = "SELECT * FROM cheque_payments ORDER BY id DESC";
    $result = mysqli_query($zconn, $query);

    if ($result) {
		$sn=1;
        while ($res = mysqli_fetch_assoc($result)) {
    ?>
        <tr>
            <td><?php echo $res['id']; ?></td>
            <td><?php echo date('Y-m-d', strtotime($res['date'])); ?></td>
            <td><?php echo date('Y-m-d', strtotime($res['cheque_date'])); ?></td>
			
            <td><?php echo $res['payee']; ?></td>
            <td><?php echo $res['bank']; ?></td>
            <td><?php echo $res['description']; ?></td>
            <td><?php echo $res['amount']; ?></td>
            <td>
                <a href="?id=<?php echo $res['id']; ?>&action=edit" class="btn btn-info"><i class="icon-edit"></i> Edit</a>
                <a href="cheque_print.php?id=<?php echo $res['id']; ?>" class="btn btn-info"><i class="icon-print"></i> Print</a>
            </td>
        </tr>
    <?php
        }
    } else {
        echo "Error: " . mysqli_error($zconn);
    }
    ?>
</tbody>
		 </table>
</div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
			</div>
		</div>
    </form>
    <?php include('include/footer.php'); ?>
</body>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
	<!-- Include jQuery -->
<!--datatables JavaScript -->
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
    <script>
$(document).ready(function() {
    $('#example').DataTable({
        "language": {
        }
    });
});



</script>


</html>
