<?php
session_start();

// Define the current page title
//$current = 'Jobwork Create Cheque';

include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

if (isset($_POST['create_cheque'])) {
    $join = '';
    $mode = $_POST['mode'];
    if ($mode == 'cash') {
        foreach ($_POST['direct_id'] as $direct_id) {
            mysql_query("UPDATE `bill_pass` SET  `mode` =  'cash' WHERE `i`='$direct_id'");
        }
    }
    if ($mode == 'cheque') {
        foreach ($_POST['direct_id'] as $direct_id) {
            $join .= "direct_id%5B%5D=" . $direct_id . '&';
        }
        $join .= 'type=jobwork';
        header("Location: cheque2.php?" . $join);
        exit();
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
    <title><?php echo SITE_TITLE;?> - Cheque Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">

	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
</head>

<body>
	 <div id="main-wrapper">
        <!-- Topbar header - style you can find in pages.scss -->
        <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
      <?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper" style="min-height: 100%; height: auto;">

            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Cheque Creation</h4>
						<h4 class="page-title"></h4> &nbsp;&nbsp;&nbsp;&nbsp;
						<a href="planning.php"> <button type="button" class="btn btn-info">Cheque Creation</button></a>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="planning.php">Cheque Creation</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i> <?php echo $current;?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					
					<div class="card">
    <div class="card-header">
        <h5 class="card-title">Jobwork Create Cheque</h5>
    </div>
    <div class="card-body">
					<div class="box-content">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
    <form name="" action="" method="post">
    <tr>
      <td align="right"><strong>Choose Company</strong></td>
      <td align="center">&nbsp;</td>
      <td><select name="company[]" data-rel="chosen" class="span10" onchange="this.form.submit()">
      <option value="">----Select----</option>
                        <?php
                        $dccc=mysql_query("SELECT DISTINCT(contid) as id FROM  `bill_pass`");
						while($dccs=mysql_fetch_object($dccc)){
						$supply_name=mysql_fetch_object(mysql_query("SELECT *  FROM `persondetail` WHERE `id` = '$dccs->id'"));
						?>
                <option value="<?php echo $dccs->id;?>" <?php if(in_array($dccs->id,$_REQUEST['company'],true)){ ?> selected="selected"<?php }?>><?php echo $supply_name->name;?></option>
                        <?php
                        }
						?>
                        </select></td>
    </tr>
    <!--<tr>
      <td width="49%" align="right"><strong>Choose Bill No</strong></td>
      <td width="3%" align="center"><strong>:</strong></td>
      <td width="48%"><select name="dcno[]" multiple data-rel="chosen" class="span10" onchange="this.form.submit()">
                        <?php
                        $dccc=mysql_query("SELECT DISTINCT(i) as id FROM  `bill_pass` where `mode` ='' and `contid` = '".$_REQUEST['company'][0]."'");
						while($dccs=mysql_fetch_object($dccc)){
						?>
                <option value="<?php echo $dccs->id;?>" <?php if(in_array($dccs->id,$_REQUEST['dcno'],true)){ ?> selected="selected"<?php } ?>><?php echo $dccs->id;?></option>
                        <?php
                        }
						?>
                        </select></td>
    </tr>-->
    </form>
    <div class="row">
    <div class="col-12">
        <h4 class="page-title">Cheque Creation</h4>
        <a href="planning.php">
            <button type="button" class="btn btn-info">Cheque Creation</button>
        </a>
    </div>
</div>

<form name="" action="" method="post">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label for="company">Choose Company</label>
               <select name="company[]" data-rel="chosen" class="span10" onchange="this.form.submit()">
    <option value="">----Select----</option>
    <?php
    $query = "SELECT DISTINCT contid as id FROM bill_pass";
    $result = mysqli_query($zconn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($zconn));
    }

    while ($row = mysqli_fetch_assoc($result)) {
        $supplyId = $row['id'];

        $supplyNameQuery = "SELECT name FROM persondetail WHERE id = '$supplyId'";
        $supplyNameResult = mysqli_query($zconn, $supplyNameQuery);

        if (!$supplyNameResult) {
            die("Query failed: " . mysqli_error($zconn));
        }

        if (mysqli_num_rows($supplyNameResult) > 0) {
            $supplyNameRow = mysqli_fetch_assoc($supplyNameResult);
    ?>
        <option value="<?php echo $supplyId; ?>" <?php if (in_array($supplyId, $_REQUEST['company'], true)) { ?> selected="selected" <?php } ?>><?php echo $supplyNameRow['name']; ?></option>
    <?php
        }
    }
    ?>
</select>

            </div>
        </div>
        <div class="col-md-8">
            <div class="form-group">
                <label for="mode">Payment Mode</label>
                <label class="radio-inline">
                    <input type="radio" name="mode" required="required" value="cash"> Cash
                </label>
                <label class="radio-inline">
                    <input type="radio" name="mode" required="required" value="cheque"> Cheque
                </label>
            </div>
        </div>
    </div>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th></th>
                <th>Bill No</th>
                <th>Date</th>
                <th>Customer Bill No</th>
                <th>Pay Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($_REQUEST['company'] as $dcno) {
                $datas = mysql_query("SELECT * FROM  `bill_pass` WHERE  `contid` = '$dcno' and `mode` = ''");
                while ($data = mysql_fetch_object($datas)) {
            ?>
                    <tr>
                        <td><input type="checkbox" name="direct_id[]" value="<?php echo $data->i; ?>"></td>
                        <td><?php echo $data->i; ?></td>
                        <td><?php echo date("d-m-Y", strtotime($data->date)); ?></td>
                        <td><?php echo $data->bill_no; ?></td>
                        <td><?php echo $data->pay_amount; $pay += $data->pay_amount; ?></td>
                    </tr>
            <?php
                }
            }
            ?>
            <tr>
                <td colspan="5" align="center"><input type="hidden" name="type" value="general"></td>
            </tr>
            <tr>
                <td colspan="5" align="center" class="form-actions">
                    <input type="submit" name="create_cheque" value="Create Cheque" class="btn btn-primary">
                    <input type="reset" name="cancel" value="Cancel" class="btn">
                </td>
            </tr>
        </tbody>
    </table>
</form>

				  </div>
				</div><!--/span-->

			</div>
					</div>
	</div>
            				
<?php include('include/footer.php'); ?>
	
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

<script>

</script>
</body>
</html>



