<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
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
    <title><?php echo SITE_TITLE;?> - Cheque Generation</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>
<body>
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <?php include('includes/sidebar.php');?>
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
                        <h4 class="page-title">Generate Cheque</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Generate Cheque</a></li>
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
							<div class="col-md-12">
							<div class="card-body">
							<div class="card-body" style="width:100%">
			<table class="table table-striped table-bordered" width="100%" height="auto" border="0" align="center" cellpadding="0" cellspacing="0">
				<tr>
				<td align="right"><strong>Cheque By</strong></td>
				<td align="center">&nbsp;</td>
				<td><select name="company[]" data-rel="chosen" class="span10" onchange="this.form.submit()">
				<option value="">----Select----</option>
				<option value="volvo">SUPPLIER</option>
				<option value="saab">PROCESS</option>
				<option value="fiat">JOBWORK</option>
                        <?php
                     /*   $dccc=mysqli_query("SELECT DISTINCT(supplier_id) as id FROM  `bill_pass_purchase`");
						while($dccs=mysqli_fetch_object($dccc)){
						$supply_name=mysqli_fetch_object(mysqli_query("SELECT *  FROM `master_supplier` WHERE `customercode` = '$dccs->id'"));
						?>
                <option value="<?php echo $dccs->id;?>" <?php if(in_array($dccs->id,$_REQUEST['company'],true)){?> selected="selected"<?php }?>><?php echo $supply_name->customername;?></option>
                        <?php
                        }
						*/?>
                        </select>
						</td>
				</tr>
				<tr>
				<td align="right"><strong>Choose Company</strong></td>
				<td align="center">&nbsp;</td>
				<td><select name="company[]" data-rel="chosen" class="span10" onchange="this.form.submit()">
				<option value="">----Select----</option>
                        <?php
                        $dccc=mysqli_query("SELECT DISTINCT(supplier_id) as id FROM  `bill_pass_purchase`");
						while($dccs=mysqli_fetch_object($dccc)){
						$supply_name=mysqli_fetch_object(mysqli_query("SELECT *  FROM `master_supplier` WHERE `customercode` = '$dccs->id'"));
						?>
                <option value="<?php echo $dccs->id;?>" <?php if(in_array($dccs->id,$_REQUEST['company'],true)){?> selected="selected"<?php }?>><?php echo $supply_name->customername;?></option>
                        <?php
                        }
						?>
                        </select></td>
				</tr>
				<form name="" action="" method="post">
				<div class="row" style="padding-top:0px;">
					<div class="col-md-12">
						<div class="card-body">
				
    <!--<tr>
      <td width="49%" align="right"><strong>Choose Bill No</strong></td>
      <td width="3%" align="center"><strong>:</strong></td>
      <td width="48%"><select name="dcno[]" multiple data-rel="chosen" class="span10" onchange="this.form.submit()">
                        <?php
                        $dccc=mysqli_query("SELECT DISTINCT(prime_id) as id FROM  `bill_pass_purchase` where `supplier_id` = '".$_REQUEST['company'][0]."' and `mode` =''");
						while($dccs=mysqli_fetch_object($dccc)){
						?>
                <option value="<?php echo $dccs->id;?>" <?php if(in_array($dccs->id,$_REQUEST['dcno'],true)){?> selected="selected"<?php }?>><?php echo $dccs->id;?></option>
                        <?php
                        }
						?>
                        </select></td>
    </tr>-->
    <tr>
	</div>
	</div>
	</div>
	</form>
      <td colspan="3" align="center">
      <form name="" action="" method="post">
  			<table width="100%" border="1" cellspacing="0" cellpadding="0">
    <tr>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center"><strong>Customer Name</strong></td>
      <td align="center">&nbsp;        <?php  
	  foreach($_REQUEST['dcno'] as $dcno){
		  $sql=mysqli_fetch_object(mysqli_query("SELECT * FROM  `bill_pass_purchase` WHERE  `prime_id` = '$dcno'"));
		  $supplier_id[]=$sql->supplier_id;
	  }
	  $supplier_id=array_unique($supplier_id);
	  foreach($_REQUEST['company'] as $supplier_ids){//echo $supplier_ids.'<br>';
		$company_namess=mysqli_fetch_object(mysqli_query("select * from `master_supplier` where `customercode` = '$supplier_ids'"));
		  echo $company_namess->customername.'<br>';
	  }
	  ?></td>
      <td align="left">
      <label><input name="mode" type="radio" required="required" value="cash">Cash</label>
      <label><input name="mode" type="radio" required="required" value="cheque">Cheque</label>
      </td>
    </tr>
    <tr>
      <td align="center"><strong>&nbsp;</strong></td>
      <td align="center"><strong>Bill No</strong></td>
      <td align="center"><strong>Date</strong></td>
      <td align="center"><strong>Customer Bill No</strong></td>
      <td align="center"><strong>Pay Amount</strong></td>
    </tr>
    <?php
	foreach($_REQUEST['company'] as $dcno){
	$datas=mysqli_query("SELECT * FROM  `bill_pass_purchase` WHERE  `supplier_id` ='$dcno' and `mode` = ''");
	while($data=mysqli_fetch_object($datas)){
	?>
    <tr>
      <td align="center"><input type="checkbox" name="direct_id[]" value="<?php echo $data->prime_id;?>"></td>
      <td align="center"><?php echo $data->prime_id;?></td>
      <td align="center"><?php echo date("d-m-Y",strtotime($data->date));?></td>
      <td align="center"><?php echo $data->bill_no;?></td>
      <td align="center"><?php echo $data->pay_amount;$pay+=$data->pay_amount;?></td>
    </tr>
    <?php }}?>
    <tr>
      <td align="center"><input type="hidden" name="type" value="general"></td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center">&nbsp;</td>
      <td align="center"><?php echo $pay;?></td>
    </tr>
    <tr>
      <td colspan="5" align="center" class="form-actions">
      <input type="submit" name="create_cheque" value="Create Cheque" class="btn btn-primary">
      <input type="reset" name="cancel" value="Cancel" class="btn">
      </td>
      </tr>
</table>

	  </form>
      </td>
      </tr>
	 
</table>
</div>
</div>
</div>
 </div>
	</div>
	</div>  
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
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
    </script>
</body>
</html>