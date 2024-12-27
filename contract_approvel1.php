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
    <title><?php echo SITE_TITLE;?> - Contractor Approvel</title>
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
                        <h4 class="page-title">Contractor Approvel</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Contractor Approvel</a></li>
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
			<table class="table table-striped table-bordered">
<thead>
  <tr>
    <th align="center" valign="middle">Id</th>
    <th height="32" align="center" valign="middle">Contractor Id</th>
    <th align="center" valign="middle">Date</th>
    <th align="center" valign="middle">Name</th>
    <th align="center" valign="middle">Dept</th>
    <th align="center" valign="middle">Aproved By</th>
    <th align="center" valign="middle">Total Salary</th>
    <th align="center" valign="middle">Paid</th>
    <th align="center" valign="middle">&nbsp;</th>
  </tr>
  </thead>
  <tbody>
  <?php $lab_salary_total='';
  $fabric=mysqli_query("select * from dummy_contractor where status = 'show' || status='pending' ORDER BY  `dummy_contractor`.`id` ASC ");
   while($fabrics=mysqli_fetch_object($fabric))
  { 
  $sql=mysqli_query("SELECT * FROM  `persondetail` where `id`='$fabrics->contid'");$res=mysqli_fetch_object($sql);
  ?><form name="" action="salary_session.php?data=contractor" method="post">
    <tr height="24">
      <td width="48"  align="center" valign="middle" bgcolor="#FFFFFF" style="text-transform:uppercase;" ><input name="id" type="text" value="<?php=$fabrics->id;?>" class="span12" readonly="readonly" /></td>
      
      <td width="76"  align="center" valign="middle" bgcolor="#FFFFFF" style="text-transform:uppercase;" ><?php echo($fabrics->contid);?></td>
      <td width="127"  align="center" valign="middle" bgcolor="#FFFFFF" ><span style="text-transform:uppercase;"><?php echo(date("d-m-Y",strtotime($fabrics->date)));?></span></td>
      <td width="165"  align="center" valign="middle" bgcolor="#FFFFFF" ><?php
    $text = $res->name;
	$newtext = wordwrap($text, 10,"\n",TRUE);
	echo $newtext;
	?></td>
      <td width="227"  align="center" valign="middle" bgcolor="#FFFFFF" ><?php echo($fabrics->dept);?></td>
      <td width="118"  align="center" valign="middle" bgcolor="#FFFFFF" ><?php echo($fabrics->approved_by);?></td>
      <td width="118"  align="center" valign="middle" bgcolor="#FFFFFF" ><?php echo($fabrics->net_amount);?></td>
      <td width="176"  align="center" valign="middle" bgcolor="#FFFFFF" ><?php if($fabrics->status=='show'){ ?>
      <input type="text" name="salary_paying" value="<?php=$fabrics->net_amount;?>" class="span10" />
        <?php }
		else{
			echo "You Need Approve";
			}?>
      </td>
      <td width="63"  align="center" valign="middle" bgcolor="#FFFFFF" >
        <?php if($fabrics->status=='show'){ ?>
        <input name="Submit" class="btn btn-primary" type="submit" value="Submit" onclick="return confirmBox1()"/>
        <?php }
		else{
	 ?>
        <span class="label label-warning">Pending</span>
        <?php }?>
        </td>
    </form>
    <?php
  	$lab_salary_total+=($fabrics->net_amount);	}
  ?>
  <tr height="24">
    <td height="28" colspan="5"  align="center" valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
    <td  align="center" valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
    <td height="28"  align="center" valign="middle" bgcolor="#FFFFFF" ><strong><?php echo $lab_salary_total;?></strong></td>
    <td colspan="2"  align="center" valign="middle" bgcolor="#FFFFFF" >&nbsp;</td>
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