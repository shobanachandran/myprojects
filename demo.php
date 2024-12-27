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
    <title><?php echo SITE_TITLE;?> - Advance Entry</title>
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
                        <h4 class="page-title">Advance Details</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Order Info</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
			<div class="container-fluid">
			<form name="debit_entry" id="debit" method="post">
				<div class="row" style="padding-top:0px;">
					<div class="col-md-12">
						<div align="middle" class="card-body">
							<div class="card-body" style="width:100%">
							<div class="card-body" style="width:100%">
<!--	<div class="box-header well" data-original-title>
            <h2><i class="icon-edit"></i> <?php echo $current;?></h2>
            <div class="box-icon">
                <a href="#" class="btn btn-setting btn-round"><i class="icon-cog"></i></a>
                <a href="#" class="btn btn-minimize btn-round"><i class="icon-chevron-up"></i></a>
                <a href="#" class="btn btn-close btn-round"><i class="icon-remove"></i></a>
            </div>
    </div>-->
        <table class="table table-striped table-bordered" width="100%" border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="20%" height="35" align="right"><strong>Debit Receipt no&nbsp;:&nbsp;</strong></td>
    <td width="22%" align="left"><input type="text" name="receipt_no" value="<?php echo $credit_no;?>" class="span7" readonly /></td>
    <td width="8%" align="right"><strong>Date&nbsp;:&nbsp;</strong></td>
    <td width="16%" align="left"><input type="text" name="receipt_date" class="span7 datepicker" value="<?php echo $credit_date;?>" / readonly="readonly"></td>
    <td width="13%" align="left">&nbsp;</td>
    <td width="21%" align="left">&nbsp;</td>
  </tr>
  <tr>
    <td height="35" align="right"><strong>&nbsp;&nbsp;Party&nbsp;:&nbsp;</strong></td>
    <td><select name="did" class="span7" data-rel="chosen" onchange="this.form.submit()">
              <option value="">----Select----</option>
            	<?php 
               $select_name = mysql_query("SELECT * FROM  `master_customer`");
               while($select_name1=mysql_fetch_object($select_name))
               { ?>	
               <option value="<?php echo $select_name1->customercode;?>"<? if($select_name1->customercode == $_REQUEST['did']){?> selected="selected"<? $direct='false';$select_name1distributorcode=$select_name1->customercode;$agent=$select_name1->typeofcustomer;}?>><?php echo $select_name1->customername;?></option>
        	<? }  ?> 
          </select></td>
    <td align="right"><strong>Amount&nbsp;&nbsp;:&nbsp;</strong></td>
    <td><input type="number" name="total_amount" id="total_amount" required value="<?php echo $_REQUEST['total_amount'];?>" class="span7" onkeyup="calculation_sc()"/></td>
    <td><strong>Balance Amount</strong></td>
    <td><input type="text" name="balance" id="balance" value="0" style="background-color:#fff; border:none;" class="span8" readonly /></td>
  </tr>
  <tr>
    <td colspan="6"><table class="table table-striped table-bordered" width="100%" border="1" cellspacing="0" cellpadding="0">
      <tr>
        <td height="31" align="center"><strong>Ref No</strong></td>
        <td align="center"><strong>Ref / Date</strong></td>
        <td align="center"><strong>Amount</strong></td>
        <td align="center"><input type="submit" name="add_row" class="btn btn-inverse" value="Add me" /></td>
      </tr>
      <?php
	  $sql=mysql_query("SELECT * FROM `debit_note_session` where `sessid` = '".$_REQUEST['sessid']."'");
	  while($res=mysql_fetch_array($sql)){
	  ?>
      <tr><input type="hidden" name="sno[]" value="<?php echo $res['i'];?>" />
        <td align="left"><?php echo $res['invoice_no'];?></td>
        <td align="center"><input type="text" name="bill_date1[]" readonly id="bill_date1" value="<?php echo $res['invoice_date'];?>" class="span8" /></td>
        <td align="center"><input type="text" name="bill_amount1[]" id="bill_amount1_<?php echo $res['i'];?>" value="<?php echo $res['amount'];?>" class="span8" onkeyup="calculation_sc()"/></td>
        <td align="center"><a href="?sessid=<?php echo $_REQUEST['sessid'];?>&delete=<?php echo $res['i'];?>" class="btn btn-danger">Remove </a></td>
      </tr>
      <?php }?>
      <tr>
        <td align="left"><select name="bill_no" id="bill_no" class="span8" data-rel="chosen" onchange="fill_amount()">
        <option value="">----Select----</option>
        <?php
        $sql=mysql_query("SELECT * FROM `invoice` WHERE `customer_code` LIKE '".$_REQUEST['did']."' ORDER BY `customer_code` ASC");
		while($res=mysql_fetch_object($sql)){
		$inv_data=$res->invoice_no.' # '.$res->date.' # '.round($res->grand_total);
		?>
			<option value="<?php echo $inv_data;?>"><?php echo "A".$inv_data;?></option>
		<?php }	?>
        </select></td>
        <td align="center"><input type="text" name="bill_date" id="bill_date" value="" class="span8" onkeyup="calculation_sc()" /></td>
        <td align="center"><input type="text" name="bill_amount" id="bill_amount" value="0" class="span8" onkeyup="calculation_sc()" /></td>
        <td align="center">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="top">&nbsp;</td>
      </tr>
      <tr>
        <td colspan="4" align="left" valign="top"><strong>Remarks</strong>&nbsp;&nbsp;&nbsp;<br />          &nbsp;&nbsp;&nbsp;&nbsp;<textarea name="remarks" cols="12" rows="5"><?php echo $remarks;?></textarea></td>
        </tr>
      <tr>
        <td colspan="4" align="center" class="form-actions">
        <input type="submit" name="save_debit_note" value="Save Changes" class="btn btn-primary" onClick="return check_me_balance()" />
        <input type="reset" name="cancel" value="Cancel" class="btn" />
        </td>
        </tr>
      
    </table></td>
  </tr>
 </table>
 </div>
  </div>
 </div>
 </div>
 </div>
 </form>
 </div>
			
			
			
			</div>
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
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
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	 <script>
   $(document).ready(function() {
    $('#example').DataTable();
	} );
	function DeletejwId(ID){
	   var UsrStatus = confirm("Are you sure to delete this details ?");
	  if(UsrStatus){
		$.ajax({
			url : 'ajax/advan.php',
			data: {
			   action: 'buyerdelete',
			   typeid: ID
			},
			success: function( data ) {
				if($.trim(data)=="error"){
					alert("Deleted Failed Kindly. Try again");
				}
				if($.trim(data)=='1'){
					alert("Deleted Successfully");
					document.getElementById("delete_"+ID).style.display = "none";
				}
			},
			error: function (textStatus, errorThrown) {
				//DO NOTHINIG
			}
		});
	  }
	  }
    </script>
</body>
</html>