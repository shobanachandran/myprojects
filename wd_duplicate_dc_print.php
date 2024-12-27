<?php
include('includes/config.php');

if(isset($_REQUEST['filter_date'])){
    $date = date("Y-m-d", strtotime($_REQUEST['filter_date']));
}
else{
    $date = date("Y-m-d");
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Garments ERP">
    <meta name="author" content="Iorange Innovation">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title><?php echo SITE_TITLE;?> - Work assign</title>
    <link href="dist/css/style.min.css" rel="stylesheet">  
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <link href="dist/css/style.min.css" rel="stylesheet">
    <style>
        th { font-size: 12px; font-weight: bold; background-color: #626F80; color: #fff; text-align: center; }
        .scroll-container { width: 100%; overflow-x: auto; }
    </style>  
</head>

<body>
    <div id="main-wrapper">
        <?php include('includes/header.php');?>
        <?php include('includes/sidebar.php');?>
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="width:100%">
                            <table width="100%" border="0" cellpadding="0" cellspacing="0">
                                <td width="10%">Filter Style</td>
                                <td width="1%">&nbsp;</td>
                                <td width="23%">
                                    <form name="" action="" method="get">
                                        <select name="style" data-rel="chosen" class="span10" onChange="this.form.submit()">
                                            <?php
                                            $query = "SELECT DISTINCT `style_no` FROM `dc`";
                                            $result = mysqli_query($zconn, $query);

                                            if (!$result) {
                                                die("Query error: " . mysqli_error($zconn));
                                            }

                                            while ($row = mysqli_fetch_assoc($result)) {
                                                $style_no = $row['style_no'];
                                            ?>
                                                <option value="<?php echo $style_no; ?>" <?php if ($_REQUEST['style'] == $style_no) { ?>selected="selected"<?php } ?>><?php echo $style_no; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </td>

                                <td>
                                    <form name="" action="" method="get">
                                        <label for="to_contractor">Filter by Contractor:</label>
                                        <select name="to_contractor" data-rel="chosen" class="span10" onChange="this.form.submit()">
                                            <?php
                                            $conNameQuery = "SELECT DISTINCT `to_contractor` FROM `dc`";
                                            $conNameResult = mysqli_query($zconn, $conNameQuery);

                                            if (!$conNameResult) {
                                                die("Query error: " . mysqli_error($zconn));
                                            }

                                            while ($conNameRow = mysqli_fetch_assoc($conNameResult)) {
                                                $con_name = $conNameRow['to_contractor'];
                                            ?>
                                                <option value="<?php echo $con_name; ?>" <?php if ($_REQUEST['to_contractor'] == $con_name) { ?>selected="selected"<?php } ?>><?php echo $con_name; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </td>

                                <td>
                                    <form name="" action="" method="get">
                                        <label for="from_department">Filter by Department:</label>
                                        <select name="from_department" data-rel="chosen" class="span10" onChange="this.form.submit()">
                                            <?php
                                            $fromDepartmentQuery = "SELECT DISTINCT `from` FROM `dc`";
                                            $fromDepartmentResult = mysqli_query($zconn, $fromDepartmentQuery);

                                            if (!$fromDepartmentResult) {
                                                die("Query error: " . mysqli_error($zconn));
                                            }

                                            while ($fromDepartmentRow = mysqli_fetch_assoc($fromDepartmentResult)) {
                                                $from_department = $fromDepartmentRow['from'];
                                            ?>
                                                <option value="<?php echo $from_department; ?>" <?php if ($_REQUEST['from_department'] == $from_department) { ?>selected="selected"<?php } ?>><?php echo $from_department; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </form>
                                </td>

                                <td>
                                    <form name="" action="" method="get">
                                        <label for="filter_date">Filter by Date:</label>
                                        <input type="text" name="filter_date" value="<?php echo date("d-m-Y", strtotime($date)); ?>" class="datepicker span10" onChange="this.form.submit()" />
                                    </form>
                                </td>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body" style="width:100%">
                            <?php
                            if (isset($_REQUEST['style'])) {
                                $selectedStyle = $_REQUEST['style'];
                                echo "Selected Style: $selectedStyle"; // Debugging statement
                                $productionQuery = "SELECT * FROM dc WHERE style_no = '$selectedStyle'";
                            } elseif (isset($_REQUEST['to_contractor'])) {
                                $selectedConName = $_REQUEST['to_contractor'];
                                echo "Selected Contractor: $selectedConName"; // Debugging statement
                                $productionQuery = "SELECT * FROM dc WHERE to_contractor = '$selectedConName'";
                            } elseif (isset($_REQUEST['from_department'])) {
                                $selectedDepartment = $_REQUEST['from_department'];
                                echo "Selected Department: $selectedDepartment"; // Debugging statement
                                $productionQuery = "SELECT * FROM dc WHERE `from` = '$selectedDepartment'";
                            } else {
                                if (isset($_REQUEST['filter_date'])) {
                                    $date = date("Y-m-d", strtotime($_REQUEST['filter_date']));
                                    $productionQuery = "SELECT * FROM dc WHERE dc_out_date = '$date'";
                                } else {
                                    $date = date("Y-m-d");
                                    $productionQuery = "SELECT * FROM dc WHERE dc_out_date = '$date'";
                                }
                            }

                            $productionResult = mysqli_query($zconn, $productionQuery);

                            if ($productionResult) {
                            ?>
                                <table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered bootstrap-datatable datatable">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>DC No</th>
											
                                            <th>Style No</th>
                                            <th>Contractor</th>
                                            <th>Department</th>
                                            <th>Action</th>
											
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        while ($productionRow = mysqli_fetch_assoc($productionResult)) {
                                        ?>
                                            <tr>
                                                <td><?php echo $productionRow['dc_out_date']; ?></td>
                                                <td><?php echo $productionRow['dc_no']; ?></td>
												
                                                <td><?php echo $productionRow['style_no']; ?></td>
                                                <td><?php echo $productionRow['to_contractor']; ?></td>
                                                <td><?php echo $productionRow['from']; ?></td>
												                    <td><button onclick="printRow('<?php echo $productionRow['dc_no']; ?>')">Print</button></td>

                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                            } else {
                                echo "Query error: " . mysqli_error($zconn);
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php include('includes/footer.php');?>

        <script src="assets/libs/jquery/dist/jquery.min.js"></script>
        <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
        <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
        <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
        <script src="assets/extra-libs/sparkline/sparkline.js"></script>
        <script src="dist/js/waves.js"></script>
        <script src="dist/js/sidebarmenu.js"></script>
        <script src="dist/js/custom.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/chosen/1.8.7/chosen.jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
		  <script>
        function printRow(dcNo) {
            // Redirect to the workdone_print.php page with the DC No
            window.location.href = 'workdone_print.php?dc_no=' + dcNo;
        }
    </script>
        <script>
            // Datepicker initialization
            $('.datepicker').datepicker({
                format: 'dd-mm-yyyy',
                autoclose: true,
                todayHighlight: true
            });
        </script>
    </body>
</html>
