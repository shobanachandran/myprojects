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
    <title><?php echo SITE_TITLE;?> - General DC 	</title>
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
                        <h4 class="page-title">General DC </h4>
                    <!--    <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">							
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a href="add_party.php"><button type="button" class="btn btn-success">Add Party</button></a></li>
                                </ol>
                            </nav>
                        </div>-->
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
	<h4><i class="icon-edit"></i>General DC Entry Form</h4>
	<div class="box-icon">
	<a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
	<a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
	<a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
	</div>
	</div>
	<div class="box-content">
	<form name="" action="" method="post">
	<table class="table table-striped table-bordered" width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
	<tr style="margin-top:25px;">
	<td width="12%" height="35" align="center" valign="top"><strong>Choose Dc</strong></td>
	<td width="29%" align="left" valign="top"><select name="dc_no" data-rel="chosen" class="span10" onchange="this.form.submit()" >
	<option value="">----Select----</option>
	<?php  
	$fabric=mysqli_query("select DISTINCT(`prime_id`) as prime_id from `general_dc`");
	while($fabrics=mysqli_fetch_object($fabric))
	{
	?>
	<option value="<?php echo $fabrics->prime_id;?>"<?php if($_REQUEST['dc_no']==$fabrics->prime_id){?> selected="selected"<?php }?>><?php echo $fabrics->prime_id;?></option>
	<?php  } ?>
	</select></td>
	<td height="35" align="center"><strong>Date </strong></td>                        
	<td align="left"><input type="text" name="date" class="datepicker" value="<?php echo date("d-m-Y",strtotime($f->date));?>" /></td>
	<td align="center">&nbsp;</td>
	<td width="37%" align="left">&nbsp;</td>
	</tr>
	
	<tr style="margin-top:25px;">
	<td width="12%" height="35" align="center" valign="top"><strong>To Address</strong></td>
	<td width="25%" align="left" valign="top"><select name="master" data-rel="chosen" class="span10" >

	<?php 
    $dc_no=$_REQUEST['dc_no'];
    $d=mysqli_fetch_object(mysqli_query("select * from `general_dc` where `prime_id`='$dc_no'"));	
	$fabric=mysqli_query("select * from `master_supplier` where `customercode`='$d->company_name'");
	while($fabrics=mysqli_fetch_object($fabric))
	{
	?>
	<option value="<?php echo $fabrics->customercode;?>"<?php if($_REQUEST['company']==$fabrics->customercode){?> selected="selected"<?php }?>><?php echo $fabrics->customername;?></option>
	<?php  } ?>
	</select></td>
	<td width="22%" align="center" valign="top"><strong>Remarks</strong></td>
	<td width="37%" align="left" valign="top"><textarea name="remarks" cols="25" rows="7" value="<?php echo $f->remarks;?>"><?php echo $f->remarks;?></textarea></td>
	<td align="center">&nbsp;</td>
	<td width="37%" align="left">&nbsp;</td>
	</tr>
<!--	<tr>
	<td height="35" align="center"><strong>Date </strong></td>                        
	<td align="left"><input type="text" name="date" class="datepicker" value="<?php echo date("d-m-Y",strtotime($f->date));?>" /></td>
	<td align="center">&nbsp;</td>
	<td width="37%" align="left">&nbsp;</td>
	<td align="center">&nbsp;</td>
	<td width="37%" align="left">&nbsp;</td>
	</tr>-->
	<tr>
	<td height="35" align="center"><strong>If Return </strong></td>                       
	<td align="left"><label><input type="checkbox" name="return" id="return" value="return" <?php  if($f->return == 'yes'){?> checked <?php  } ?> /> Return</label></td>
	<?php  if($f->return == 'yes'){?>
	<td align="center"><strong><div class="red1" >Return date</div></strong></td>
	<td width="37%" align="left"><div class="red1" ><input type="text" name="return_date" class="datepicker" value="<?php if($f->return_date_org=='0000-00-00'){echo date("d-m-Y");}else{ echo date("d-m-Y",strtotime($f->return_date_org));}?>" /></div></td>
	<?php  }else{ ?>
	<td align="center"><strong><div class="red1" style="display:none;">Return date</div></strong></td>
	<td width="37%" align="left"><div class="red1" style="display:none;"><input type="text" name="return_date" class="datepicker" /></div></td>
	<?php  } ?>
	<td align="center">&nbsp;</td>
	<td width="37%" align="left">&nbsp;</td>
	</tr>
	
	 <tr>
							  <td height="35" align="center"><strong>Driver Name</strong> </td>                        
							  <td align="left"><input type="text" name="driver_name" id="driver_name" class="span8" value="<?php echo $f->driver_name;?>"></td>
							  <td align="center"><strong>Mobile No</strong></td>
							  <td width="37%" align="left"><input type="text" name="vehicle_no" id="vehicle_no" value="<?php echo $f->vehicle_no;?>" class="span8"></td>
							  <td align="center"><strong>Vehicle No</strong></td>
							  <td width="37%" align="left"><input type="text" name="vehicle_no" id="vehicle_no" value="<?php echo $f->vehicle_no;?>" class="span8"></td>
					      </tr>
						
	
	
	</table>
	<br /><br />
	<table class="table table-striped table-bordered" width="100%" border="1" cellspacing="0" cellpadding="0" id="tblPets">
	<tr>
	<td width="20%" align="left"><strong>Style No</strong></td>
	<td width="20%" height="32" align="left"><strong>Particular</strong></td>
	<td width="20%" align="left"><strong>Sent Qty</strong></td>
	<td width="20%" align="left"><strong>Received Qty</strong></td>
	<td width="10%" align="left"><strong>UOM</strong></td>
	<td width="10%" align="left"><a href="#" onclick="addRow('tblPets')"><i class="icon32 icon-red icon-add"></i> </a></td>
	</tr>
	<?php  
	$g=mysqli_query("select * from `general_dc` where `prime_id`='".$_REQUEST['dc_no']."'");
	while($g1=mysqli_fetch_object($g)){
	?>
	<tr>
	<td><input type="hidden" name="rowid[]" id="rowid" value="<?php echo $g1->i; ?>"><select name="styleno[]">
	
	<option value="<?php echo $g1->styleno;?>"><?php echo $g1->styleno;?></option>
	<?php
	$sql=mysqli_query("select DISTINCT(styleno) as styleno from `product`");
	while($res=mysqli_fetch_object($sql)){
	?>
	<option value="<?=$res->styleno?>"><?=$res->styleno?></option>
	<?php
	}
	?>
	</select></td>
	<td><textarea name="particular[]" id="particular[]" cols="10" rows="3" value="<?php echo $g1->particular;?>"><?php echo $g1->particular;?></textarea></td>
	<td><input type="text" name="qty[]" id="qty[]" class="span5" value="<?php echo $g1->qty;?>"></td>
	<td><input type="text" name="qty[]" id="qty[]" class="span5" value="<?php echo $g1->qty;?>"></td>
	<td><input type="text" name="uom[]" id="uom[]" class="span5" value="<?php echo $g1->uom;?>"></td>
	<td><a href="?id_remove=<?php echo $g1->i;?>&change_id=<?php echo $g1->prime_id;?>&removed=color"><i class="icon32 icon-red icon-cross"></i> </a></td>
	</tr>
    <?php  } ?>
	</table>
	<br />
	<br><br>
	<div class="form-actions" align="right">
	<button type="submit" class="btn btn-primary" name="submit123">Save changes</button>
	<button class="btn">Cancel</button>
	</div>
	</form>
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