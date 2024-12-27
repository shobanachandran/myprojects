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
    <title><?php echo SITE_TITLE;?> - Duplicate Bill 	</title>
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
                        <h4 class="page-title">Duplicate Bill </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Duplicate Bill </a></li>
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
                <form method="post" action="">	
					<div class="box-content">
                   
                    <table width="100%">
                      <tr>
                        <td colspan="6"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                          <tbody>
                            <tr>
                              <td width="25%" height="35" align="center" valign="middle"><a href="job_work_report.php" class="btn btn-info">Production Jobwork</a></td>
                              <td width="25%" align="center" valign="middle"><a href="supplier_duplicate_bill.php" class="btn btn-info">Supplier Jobwork</a></td>
                              <td width="25%" align="center" valign="middle"><a href="process_duplicate_bill.php" class="btn btn-info">Process Jobwork</a></td>
                              <td width="25%" align="center" valign="middle"><a href="general_duplicate_bill.php" class="btn btn-info">General Jobwork</a></td>
                            </tr>
                          </tbody>
                        </table></td>
                      </tr>
                      <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="10%">Filter Status</td>
                        <td width="17%"><form name="" action="" method="get"><input type="text" name="filter_date" value="<?=date("d-m-Y",strtotime($date))?>" class="datepicker span10" onchange="this.form.submit()" /></form>                         </td>
                        <td width="10%">Filer Status</td>
                        <td width="25%"><form name="" action="" method="get"><select name="style" data-rel="chosen" class="span10" onchange="this.form.submit()">
                            <option value="select">-select-</option>
                        <option value="W" <? if($_REQUEST['style'] == "W"){?> selected="selected"<? }?>>Waiting approval</option>                        <option value="C" <? if($_REQUEST['style'] == "C"){?> selected="selected"<? }?>>Cancel PO</option>                        		
                        <option value="A" <? if($_REQUEST['style'] == "A"){?> selected="selected"<? }?>>Approval</option>
                        </select></form></td>
                        <td width="10%">Filter PO</td>
                        <td width="25%"> <form name="" action="" method="get"> <select name="dcno" data-rel="chosen" class="span10" onchange="this.form.submit()">
                        <option>Select</option>
						
                        <option value="All">All</option>
                        <?
                        $dccc=mysql_query("SELECT DISTINCT(prime_id) as id FROM  `bill_pass_process`");
						while($dccs=mysql_fetch_object($dccc)){
						?>
                        <option value="<?=$dccs->id?>" <? if($_REQUEST['dcno'] == $dccs->id){?> selected="selected"<? }?>><? echo $dccs->id;?></option>
                        <?
                        }
						?>
                        </select> </form>                        </td>
                      </tr>
                    </table>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="table table-striped table-bordered bootstrap-datatable datatable">
 <thead>
  <tr>
    <th width="103"></th>
    <th width="103">Bill NO</th>
    <th width="149">Date</th>
    <th width="330">To </th>
    <th width="317">Bill No</th>
    <th width="317">Amount</th>
    <th width="317">status</th>
    <th width="332">Action</th>
  </tr>
  </thead>
  <tbody>
  <?  
 
  $sqlasa="SELECT DISTINCT(prime_id) as id FROM  `bill_pass_general`";
  
  if(isset($_REQUEST['filter_date'])){
  	$sqlasa.="where `date`='$date'";
  }
  elseif(isset($_REQUEST['dcno'])){
	  if($_REQUEST['dcno']=="All"){
			$sqlasa.="";
		}
		else{
  			$sqlasa.="where `prime_id` = '".$_REQUEST['dcno']."'";
		}
  }
  elseif(isset($_REQUEST['style'])){
  	  	$sqlasa.="where `status` = '".$_REQUEST['style']."'";
  }	
  else{
    	$sqlasa.="where `date`='$date'";
  }
  //echo  $sqlasa;
  $sqla=mysql_query($sqlasa);
  while($sql=mysql_fetch_object($sqla)){ 
  $id=$sql->id;
  $getch=mysql_fetch_object(mysql_query("select * from `bill_pass_general` where `prime_id`='$id'"));
  $dates=$getch->date;
  $to=$getch->supplier_id;
  $desc=$getch->pay_amount;
  $styleno=$getch->bill_no;
  $status=$getch->status;
  $get_my_id=$getch->receive_ids.'0';
  $employye=mysql_fetch_object(mysql_query("select * from `general_dc` where `bill_id` ='$id'"));
  $check_me_cheque=mysql_query("SELECT * FROM  `cheque` WHERE  `bill` =  '$styleno'");  
  ?>
  <tr>
   <td align="center" valign="middle">
  <? if($status!='OK' && $status !='C' && $status !='A'&& $status !=''){?>
  <input type="checkbox" name="formDoor[]" value="<? echo($id); ?>" onclick="selectall()" />
  <? }?>
  </td>
  
    <td height="25" align="center" valign="middle"><?php echo $id;?></td>
    <td align="center" valign="middle"><?php echo date("d-m-Y",strtotime($dates));?></td>
    <td align="center" valign="middle"><? echo $employye->company_name;?></td>
    <td align="center" valign="middle"><?php echo $styleno;?></td>
    <td align="center" valign="middle"><?php echo $desc;?></td>
	
			<td align="center" valign="middle"><?
    if($status==''){echo('<span class="label label-info">Waiting For Approval</span>');}
    elseif($status=='W'){echo('<span class="label label-warning">Waiting For Approval</span>');}
	elseif($status=='C'){echo('<span class="label label-danger">Cancel This PO</span>');}
	elseif($status=='A'){echo('<span class="label label-success">Accept Admin</span>');}	
    elseif($status=='R'){echo('<span class="label label-danger">Reject Admin</span>');}	
    elseif($status=='OK'){echo('<span class="label label-success">Send Successufully</span>');}		
    ?></td>
	
    <td align="center" valign="middle">
    <a href="iframe_accounts.php?bill_pass_general=<?php echo $id;?>&redirect=general_duplicate_bill.php" class="btn btn-success"><i class="icon-print"> </i> Print</a>
    <!--<? if($status!='OK' && $status !='C' && $status !='A'){?>
    <a href="?accept=true&id=<?=$id?>" class="btn btn-success"><i class="icon icon-white icon-check"></i> Approve</a>
    <?
  }
	?>-->
    
  <? if($status!='OK' && $status !='C' && $status !='A'){ ?>
    <a href="?cancel=true&id=<?=$id?>" class="btn  btn-danger"><i class="icon icon-white icon-check"></i> Cancel</a>
    <?
  }
	?>
    </td>
  </tr>
  <? $get_my_received_pono='';
  }
  ?>
  </tbody>
</table>
                    
                  </div>
				  
				  <? if($status!='OK' && $status !='C' && $status !='A'&& $status !=''){?>
					<div class="form-actions" style="background-color: #b94d35;text-align-last: center;">
                            <input name="accept" type="submit" class="btn btn-primary" value="Multiple Po Approve"/>
							  
							  <button type="reset" class="btn">Cancel</button>
							</div><? }	?>
</form>
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