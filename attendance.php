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
    <title><?php echo SITE_TITLE;?> - Attendance Entry</title>
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
                        <h4 class="page-title">Attendance Details</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Attendance Info</a></li>
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
							<div class="card-body">
							<div class="panel panel-default card-view">
							<!--	<div class="panel-heading">
									<div class="pull-left">
										<h6 class="panel-title txt-dark">Labour Shift</h6>
									</div>
									<div class="clearfix"></div>
								</div>-->
								<div class="panel-wrapper collapse in">
									<div class="panel-body">
										<div class="form-wrap">
<form name="" action="" method="post" class="form-group">
    <table class="table table-striped table-bordered" width="100%" border="1" cellspacing="0" cellpadding="0">
       	<tr>
       		<td>
				<label class="control-label mb-10 col-sm-2" for="email_hr"><strong>Filter By</strong></label>
					<div class="col-md-4 col-sm-12 col-xs-12 form-group">  
						   
						<select name="filter"  data-rel="chosen" class="select2 form-control" onchange="this.form.submit()">
                           	<option>----Select----</option>
                               <?php //$sql=mysql_query("SELECT DISTINCT(dept) as id FROM  `labour_day_attandance` where status = '' ");
								//while($res=mysql_fetch_object($sql)){ ?>
                            <option value="<?php //echo $res->id;?>"<?php //if(isset($_REQUEST['filter']) && $_REQUEST['filter'] ==$res->id){?> selected="selected"<?php //}?>>
                                 <?php //echo $res->id;?>
                            </option>
                               <?php //}?>
                          </select>
					</div>
			</td>
       		<td>&nbsp;</td>
   		</tr>
                       
    </table>
</form>
<div class="table-wrap">
										<div class="table-responsive">
											<form name="" action="" method="post" class="form-group has-success">
	<table border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered" id="table">
      <tr>
        <th width="0" height="30" align="center" valign="middle"><strong>Id</strong></th>
        <th width="0" height="30" align="center" valign="middle"><strong>Name</strong></th>
        <th width="0" align="center" valign="middle"><strong>Friday</strong></th>
        <th width="0" align="center" valign="middle"><strong>Saturday</strong></th>
        <th width="0" align="center" valign="middle"><strong>Sunday</strong></th>
        <th width="0" align="center" valign="middle"><strong>Monday</strong></th>
        <th width="0" align="center" valign="middle"><strong>Tuesday</strong></th>
        <th width="0" align="center" valign="middle"><strong>Wednesday</strong></th>
        <th width="0" align="center" valign="middle"><strong>Thursday</strong></th>
        <th width="0" align="center" valign="middle"><strong>Total</strong></th>
        <th width="0" align="center" valign="middle" class="white">Per Shift<font size="-2" class="red"><strong>(Rs)</strong></font></th>
        <th width="0" align="center" valign="middle" class="white"><strong>Amount</strong></th>
        <th width="0" align="center" valign="middle" class="white" id="non-printable"><strong>&nbsp;</strong></th>
      </tr>
      <tbody>
   <?php
    $sql_join="select * from labour_day_attandance where status ='' and `dept`='".$_REQUEST['filter']."'";
      
	$_SESSION['sql_session']=$sql_join;
	$sql=mysql_query($sql_join);
	while($res=mysql_fetch_object($sql))
	{
    $sql_isset=mysql_query("select * from labour_day_attandance where `labour_id`='".$res->labour_id."' and status =''");
	$num_rows=mysql_num_rows($sql_isset);
	$name_sql=mysql_fetch_object(mysql_query("select * from persondetail where id='".$res->labour_id."'"));
	$_SESSION['department']=$_REQUEST['filter'];
	$sql_isset_count=mysql_fetch_object($sql_isset); ?>
      <tr>
        <td height="51" align="center" valign="middle" style="text-transform:uppercase"><input type="hidden" value="<?php echo $res->labour_id;?>" name="id[]" checked="checked" /><?php echo $res->labour_id;?></td>
        <td align="center" valign="middle"><?php echo $name_sql->name;?></td>
        <td align="center" valign="middle" data-rel="tooltip" title="Friday"><strong><?php if($sql_isset_count->friday=='0' || $sql_isset_count->friday==''){	?>
          <select name="friday[]" id="friday[]" onfocus="return checkForm()" class="select2 form-control">
            <option value="0" selected="selected">0</option>
            <option value="0.25">0.25</option>
            <option value="0.50">0.50</option>
            <option value="0.75">0.75</option>
            <option value="1">1</option>
            <option value="1.25">1.25</option>
            <option value="1.50">1.50</option>
            <option value="1.75">1.75</option>
            <option value="2">2</option>
            <option value="2.25">2.25</option>
            <option value="2.50">2.50</option>
            <option value="2.75">2.75</option>
            <option value="3">3</option>
            <option value="A">A</option>
            </select>
          <?php }else{?><input name="friday[]" type="text" class="form-control" id="friday[]" value="<?php echo $sql_isset_count->friday;?>" size="5" /><?php }?>
          </strong></td>
        <td align="center" valign="middle" data-rel="tooltip" title="Saturday"><strong><?php if($sql_isset_count->saturday=='0' || $sql_isset_count->saturday==''){?>
          <select name="saturday[]" id="saturday[]" class="select2 form-control" onfocus="return checkForm()">
            <option value="0" selected="selected">0</option>
            <option value="0.25">0.25</option>
            <option value="0.50">0.50</option>
            <option value="0.75">0.75</option>
            <option value="1">1</option>
            <option value="1.25">1.25</option>
            <option value="1.50">1.50</option>
            <option value="1.75">1.75</option>
            <option value="2">2</option>
            <option value="2.25">2.25</option>
            <option value="2.50">2.50</option>
            <option value="2.75">2.75</option>
            <option value="3">3</option>
            <option value="A">A</option>
            </select>
          <?php }else{?><input name="saturday[]" type="text" class="form-control" id="saturday[]" value="<?php echo $sql_isset_count->saturday;?>" size="5" /><?php }?>
          </strong></td>
        <td align="center" valign="middle" data-rel="tooltip" title="Sunday"><strong><?php if($sql_isset_count->sunday=='0' || $sql_isset_count->sunday==''){?>
          <select name="sunday[]" id="sunday[]" onfocus="return checkForm()" class="select2 form-control">
            <option value="0" selected="selected">0</option>
            <option value="0.25">0.25</option>
            <option value="0.50">0.50</option>
            <option value="0.75">0.75</option>
            <option value="1">1</option>
            <option value="1.25">1.25</option>
            <option value="1.50">1.50</option>
            <option value="1.75">1.75</option>
            <option value="2">2</option>
            <option value="2.25">2.25</option>
            <option value="2.50">2.50</option>
            <option value="2.75">2.75</option>
            <option value="3">3</option>
            <option value="A">A</option>
            </select>
          <?php }else{?><input name="sunday[]" type="text" class="form-control" id="sunday[]" value="<?php echo $sql_isset_count->sunday;?>" size="5"/><?php }?>
          </strong></td>
        <td align="center" valign="middle" data-rel="tooltip" title="Monday"><strong><?php if($sql_isset_count->monday=='0' || $sql_isset_count->monday==''){?>
          <select name="monday[]" id="monday[]" onfocus="return checkForm()" class="select2 form-control">
            <option value="0" selected="selected">0</option>
            <option value="0.25">0.25</option>
            <option value="0.50">0.50</option>
            <option value="0.75">0.75</option>
            <option value="1">1</option>
            <option value="1.25">1.25</option>
            <option value="1.50">1.50</option>
            <option value="1.75">1.75</option>
            <option value="2">2</option>
            <option value="2.25">2.25</option>
            <option value="2.50">2.50</option>
            <option value="2.75">2.75</option>
            <option value="3">3</option>
            <option value="A">A</option>
            </select>
          <?php }else{?><input name="monday[]" type="text" id="monday[]" class="form-control" value="<?php echo $sql_isset_count->monday;?>" size="5" /><?php }?>
          </strong></td>
        <td align="center" valign="middle" data-rel="tooltip" title="Tuesday"><strong><?php if($sql_isset_count->tuesday=='0' || $sql_isset_count->tuesday==''){?>
          <select name="tuesday[]" id="tuesday[]" onfocus="return checkForm()" class="select2 form-control">
            <option value="0" selected="selected">0</option>
            <option value="0.25">0.25</option>
            <option value="0.50">0.50</option>
            <option value="0.75">0.75</option>
            <option value="1">1</option>
            <option value="1.25">1.25</option>
            <option value="1.50">1.50</option>
            <option value="1.75">1.75</option>
            <option value="2">2</option>
            <option value="2.25">2.25</option>
            <option value="2.50">2.50</option>
            <option value="2.75">2.75</option>
            <option value="3">3</option>
            <option value="A">A</option>
            </select>
          <?php }else{?><input name="tuesday[]" type="text" class="form-control" id="tuesday[]" value="<?php echo $sql_isset_count->tuesday;?>" size="5" /><?php }?>
          </strong></td>
        <td align="center" valign="middle" data-rel="tooltip" title="Wenesday"><strong><?php if($sql_isset_count->wednesday=='0' || $sql_isset_count->wednesday==''){?>
          <select name="wednesday[]" id="wednesday[]" onfocus="return checkForm()" class="select2 form-control">
            <option value="0" selected="selected">0</option>
            <option value="0.25">0.25</option>
            <option value="0.50">0.50</option>
            <option value="0.75">0.75</option>
            <option value="1">1</option>
            <option value="1.25">1.25</option>
            <option value="1.50">1.50</option>
            <option value="1.75">1.75</option>
            <option value="2">2</option>
            <option value="2.25">2.25</option>
            <option value="2.50">2.50</option>
            <option value="2.75">2.75</option>
            <option value="3">3</option>
            <option value="A">A</option>
            </select>
          <?php }else{?><input name="wednesday[]" type="text" class="form-control" id="wednesday[]" value="<?php echo $sql_isset_count->wednesday;?>" size="5" /><?php }?>
          </strong></td>
        <td align="center" valign="middle" data-rel="tooltip" title="Thursday"><strong><?php if($sql_isset_count->thursday=='0' || $sql_isset_count->thursday==''){	?>
          <select name="thursday[]" id="thursday[]" onfocus="return checkForm()" class="select2 form-control">
            <option value="0" selected="selected">0</option>
            <option value="0.25">0.25</option>
            <option value="0.50">0.50</option>
            <option value="0.75">0.75</option>
            <option value="1">1</option>
            <option value="1.25">1.25</option>
            <option value="1.50">1.50</option>
            <option value="1.75">1.75</option>
            <option value="2">2</option>
            <option value="2.25">2.25</option>
            <option value="2.50">2.50</option>
            <option value="2.75">2.75</option>
            <option value="3">3</option>
            <option value="A">A</option>
            </select>
          <?php }else{?><input name="thursday[]" type="text" class="form-control" id="thursday[]" value="<?php echo $sql_isset_count->thursday;?>" size="5" /><?php }?>
          </strong></td>
        <td align="center" valign="middle"> <strong><?php $total='';
    $total+=$sql_isset_count->friday;
    $total+=$sql_isset_count->saturday;
    $total+=$sql_isset_count->sunday;
    $total+=$sql_isset_count->monday;
    $total+=$sql_isset_count->tuesday;
    $total+=$sql_isset_count->wednesday;
    $total+=$sql_isset_count->thursday;
	echo($total);	
	?></strong></td>
        <td align="center" valign="middle"><strong><?php
        $pershift_sql=mysql_fetch_object(mysql_query("select * from `lab1` where `id`='$res->labour_id'"));
		$pershit=$pershift_sql->siftsal;
		echo $pershit;
		?></strong></td>
        <td align="center" valign="middle"><strong><?php echo $total*$pershit;$grand_total+=$total*$pershit;?></strong></td>
        <td align="center" valign="middle" id="non-printable"><?php 
    if($total!='0')
    { ?>
          <a href="demo_accounts.php?id=<?php echo $sql_isset_count->id;?>" class="btn btn-primary" id="non-printable" >Send</a>
          <?php }if($sql_isset_count->thursday == 'A'){  ?>
          <a href="?id=<?php echo $res->id;?>&delete=true" class="btn btn-warning" onclick="return confirmBox()">Remove</a><?php }?></td>
      </tr>
      <?php $total='0';
	}
	?>
    </tbody>
    <tfoot>
      <tr>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle">&nbsp;</td>
        <td align="center" valign="middle"><input name="button" type="submit" class="btn btn-primary" id="non-printable" value="Submit" /></td>
        <td colspan="3" align="center" valign="middle"><h3><strong>Grand Total</strong></h3></td>
        <td colspan="2" align="center" valign="middle"><h3>
          <?php echo $grand_total;?>
        </h3></td>
        </tr>
    </tfoot>
</table>
</form>
</div>
</div>
</div>
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