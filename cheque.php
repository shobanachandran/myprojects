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
    <title><?php echo SITE_TITLE;?> - Generate Cheque 	</title>
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
                        <h4 class="page-title">Generate Cheque </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Generate Cheque </a></li>
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
                <!-- ============================================================== -->
                <!-- Sales chart -->
				
                <form class="form-horizontal" name="salary" method="post" action="">	
					<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
					<tr>
				<td width="25%" style="text-align:center;">Cheque By :</td>
				<td width="25%"><select name="party" id="party" data-rel="chosen" onchange="this.form.submit()">
						<option value="">--select--</option>
						<option value="volvo">SUPPLIER</option>
				<option value="saab">PROCESS</option>
				<option value="fiat">JOBWORK</option>
</td>
</tr>
						<tr>
						<td width="25%" style="text-align:center;">Choose Party :</td>					
						<td width="25%"><select name="party" id="party" data-rel="chosen" onchange="this.form.submit()">
						<option value="">--select--</option>
<?php 
/*$t=mysql_query("select DISTINCT(`to`) from `cheque` where `type`='supplier'");
while($t1=mysql_fetch_object($t)){
?>
<option value="<?php echo $t1->to;?>" <?php if($_REQUEST['party']==$t1->to){?>selected<?php } ?>><?php echo $t1->to;?></option>
<?php } */?>
</select>
</td>					
<td width="25%" style="text-align:center;">&nbsp;</td>						
<td width="25%"><!--
<select name="style" id="style" data-rel="chosen" onchange="this.form.submit()">
<?php 
/*$y=mysql_query("select distinct(`bill`) as bill_no  from `cheque`");
while($y1=mysql_fetch_object($y)){
$bill_no=$y1->bill_no;
$rt=explode(",",$bill_no);
foreach($rt as $rt1){
$pur=mysql_query("select distinct(`receive_ids`) as receive_ids,supplier_id from `bill_pass_purchase` where `prime_id`='$rt1'");
while($pur1=mysql_fetch_object($pur)){
$rec=$pur1->receive_ids;
$recv=explode(",",$rec);
foreach($recv as $rc){
$supp=$pur1->supplier_id;
$ty=mysql_fetch_object(mysql_query("select * from `master_supplier` where `customercode`='$supp'"));
$typeofcustomer=$ty->typeofcustomer;
if($typeofcustomer=='Fabric'){
	$fr=mysql_query("select distinct(`styleno`) as styleno from `fabric_received` where `id`='$rc'");
}
elseif($typeofcustomer=='Store'){
    $fr=mysql_query("select distinct(`styleno`) as styleno from `store_received` where `id`='$rc'");
}
elseif($typeofcustomer=='Yarn'){
	$fr=mysql_query("select distinct(`styleno`) as styleno from `yarn_received` where `id`='$rc'");
}
else{
   $fr=mysql_query("select distinct(`styleno`) as styleno from `fabric_received` where `id`='$rc'");
}
while($fr1=mysql_fetch_object($fr)){*/
?>

<option value="<?php echo $styleno;?>" <?php if($styleno==$_REQUEST['style']){?>selected<?php } ?>><?php echo $styleno;?></option>


<?php //}}}}} ?>
</select>-->
</td>					
</tr>								
</table>
</form>
<div class="box-content">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table">
<thead>
  <tr>
    <th><strong>Cheque Id</strong></th>
    <th>Date</th>
    <th><strong>Payee Name</strong></th>
    <th><strong>Ac No</strong></th>
    <th>Bank</th>
    <th>Desc</th>
    <th>Amount</th>
    <th>Bill No</th>
    <th>Amount</th>
	
  </tr>
  <thead>
  <tbody>
  <?
  //$sql=mysql_query("select * from `cheque` where `to`='".$_REQUEST['party']."' ");
  //while($res=mysql_fetch_object($sql)){
	  
	  
	  
  ?>
  <tr>
    <td height="30"><?php //echo $res->i;?></td>
    <td><?php //echo dmy($res->date);?></td>
    <td><?php //echo $res->to;?></td>
    <td><?php //echo $res->ac_no;?></td>
    <td><?php //echo $res->bank;?></td>
    <td><?php //echo $res->desc;?></td>
    <td><?php //echo $res->amount;?></td>
    <td><?php 
       
	/*   $rt=mysql_fetch_object(mysql_query("select * from `cheque` where `to`='".$_REQUEST['party']."' and `i`='$res->i' "));
       
       echo "select * from `bill_pass_purchase` where `prime_id` in ('".str_replace(",", "','", $rt->bill)."')";
       
	  $t=mysql_query("select * from `bill_pass_purchase` where `prime_id` in ('".str_replace(",", "','", $rt->bill)."')");
	  while($t12=mysql_fetch_object($t)){
		  
		  echo $t12->prime_id.',';
		  
	  }*/
	  
	  
	  ?></td>
 
 
 <td><?php 
       
	/*   $rt1=mysql_fetch_object(mysql_query("select * from `cheque` where `to`='".$_REQUEST['party']."' and `i`='$res->i' "));
        
       // echo "select sum(`pay_amount`) as pay_amount from `bill_pass_purchase` where `prime_id` in ('".str_replace(",", "','", $rt1->bill)."')";
        
	  $t123=mysql_query("select sum(`pay_amount`) as pay_amount from `bill_pass_purchase` where `prime_id` in ('".str_replace(",", "','", $rt1->bill)."')");
	  $t12=mysql_fetch_object($t123);
		  
		  echo number_format($t12->pay_amount,2);*/
		  
	  
	  
	  
	  ?></td>
 
 
  </tr>
  <? //}?>
  </tbody>
</table>
</div>
	</div>
	 </div>
	</div>
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php');?>
            <!-- End footer -->
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