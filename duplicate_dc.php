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
    <title><?php echo SITE_TITLE;?> - Duplicate DC</title>
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
                        <h4 class="page-title">Duplicate DC </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">General DC </a></li>
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
			<div class="row-fluid sortable">
				<div class="box span12">
					<div class="box-header well" data-original-title>
						<h2><i class="icon-edit"></i><?php=$current?></h2>
						<div class="box-icon">
							<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
							<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
							<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
						</div>
					</div>
					<div class="box-content">
                   
                    <table class="table table-striped table-bordered" width="100%">
                      <tr>
                        <td width="10%"><strong>Filter Date</strong></td>
                        <td width="25%"><form name="" action="" method="get">
                        <input type="text" name="filter_date" value="<?php date("d-m-Y",strtotime($date))?>" class="datepicker span10" onchange="this.form.submit()" />
						</form></td>
                       <td><strong>Company</strong></td>
                        <td><form name="" action="" method="get">
                        <select name="company" data-rel="chosen" class="span10" onchange="this.form.submit()">
                        <?php
                        $dccc=mysqli_query("SELECT DISTINCT(company_name) as id FROM  `general_dc`");
						while($dccs=mysqli_fetch_object($dccc)){$to=$dccs->id;
						$employye=mysqli_fetch_object(mysqli_query("select * from `master_supplier` where `customercode` ='$to'"));
						?>
                        <option value="<?php $dccs->id ?>" <?php if($_REQUEST['company'] == $dccs->id){ ?> selected="selected"<?php } ?>><?php echo $employye->customername;?></option>
                        <?php 
                        }
						?>
                        </select> </form></td>
                        <td width="10%"><strong>Filter DC</strong></td>
                        <td width="25%"> <form name="" action="" method="get"><select name="dcno" data-rel="chosen" class="span10" onchange="this.form.submit()">
                        <?php
                        $dccc=mysqli_query("SELECT DISTINCT(prime_id) as id FROM  `general_dc`");
						while($dccs=mysqli_fetch_object($dccc)){
						?>
                        <option value="<?php=$dccs->id?>" <?php if($_REQUEST['dcno'] == $dccs->id){ ?> selected="selected"<?php }?>><?php echo $dccs->id;?></option>
                        <?php
                        }
						?>
                        </select></form></td>
                      </tr></table>
                    <table class="table table-striped table-bordered" width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered bootstrap-datatable datatable">
                    <thead>
  <tr>
    <th width="103">DC NO</th>
    <th width="149">Date</th>
    <th width="330">To </th>
    <th width="317">Qty</th>
    <th width="317">Remarks</th>
    <th width="332">Action</th>
  </tr>
  </thead>
  <tbody>
  <?php  
  
  $sqlasa="SELECT DISTINCT(prime_id) as id FROM  `general_dc`";
  if(isset($_REQUEST['filter_date'])){
  	$sqlasa.="where `date`='$date'";
  }
  elseif(isset($_REQUEST['dcno'])){
  	$sqlasa.="where `prime_id` = '".$_REQUEST['dcno']."'";
  }
  elseif(isset($_REQUEST['company'])){
	  $sqlasa.="where `company_name` = '".$_REQUEST['company']."'";
  }
  else{
  	$sqlasa.="where `date`='$date'";
  }

//   $sqla=mysqli_query($sqlasa);
//   while($sql=mysqli_fetch_object($sqla)){ 
//   $id=$sql->id;
//   $sqladdr=mysqli_fetch_object(mysqli_query("SELECT * FROM  `general_dc` WHERE  `prime_id` = '$id'"));
//   $sqladdr_qty=mysqli_fetch_object(mysqli_query("SELECT SUM(qty) as qty FROM  `general_dc` WHERE  `prime_id` = '$id'"));
  
//   $dates=$sqladdr->date;
//   $to=$sqladdr->company_name;
  
  
//   $desc=$sqladdr->remarks;
//   $sum=$sqladdr_qty->qty;
//   $sq=mysqli_fetch_object(mysqli_query("SELECT * FROM  `master_supplier` WHERE  `customercode` = '$to' or `customername`='$to'"));
//   $to1=$sq->customername;
//   if($to1!=''){
//   $to2=$to1;}
//   else{
//   $to2=$to;}
  
  
  
  ?>
  <tr>
    <td height="25" align="center" valign="middle"><?php echo $id;?></td>
    <td align="center" valign="middle"><?php echo date("d-m-Y",strtotime($dates));?></td>
    <td align="center" valign="middle"><?php echo $to2;?></td>
    <td align="center" valign="middle"><?php echo $sum;?></td>
    <td align="center" valign="middle"><?php echo $desc;?></td>
    <td align="center" valign="middle">
	<a href="#" onClick="window.open('general_dccom.php?id=<?php echo $id;?>&refresh=general_dccom.php?id=<?php echo $id;?>', 'Sample','toolbar=no,left=500,top=200,status=no,scrollbars=no,resize=no');return false" title="View This Pdf" class="btn btn-success"><i class="icon-print"> </i> Print</a>
	
	<!--<a href="general_dccom.php?id=<?php echo $id;?>&refresh=duplicate_general_dc.php" class="btn btn-success"><i class="icon-print"> </i> Print</a>--></td>
  </tr>
  <?php
  
  ?>
  </tbody>
</table>
                    
                  </div>
				</div><!--/span-->

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
    
</body>
</html>