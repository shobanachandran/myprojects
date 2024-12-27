<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}
if(isset($_GET['date']) && ($_GET['id']))
{
	mysqli_query("UPDATE `dummy_staff` SET  `status` =  'PAID' WHERE `dummy_staff`.`id` = '".$_GET['id']."' AND `dummy_staff`.`salary_month` = '".$_GET['date']."' LIMIT 1")or die(mysql_error());
	echo("<script>alert('Remove successfully')</script>");
//	echo "<meta http-equiv='refresh' content='0;URL=staff_unpaid_accounts.php' />";
	
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
    <title><?php echo SITE_TITLE;?> - Staff Attendence 	</title>
    <!-- Custom CSS -->
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">
      

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
                        <h4 class="page-title">Staff Attendance </h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="#">Staff Attendance</a></li>
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
    <h2>Attendance Table</h2>
   
    <form name="" action="" method="post">
<?php  $fabrics=mysqli_fetch_object(mysqli_query("select * from dummy_labour where `status`='pending'"));?>
<table width="100%" border="0" cellspacing="0" cellpadding="0" id="non-printable">
  <tr>
    <td width="8%" align="center" valign="middle"><strong>Filter</strong></td>
<td width="42%" align="center" valign="middle"><strong>
  <select name="dept" onchange="this.form.submit()">
    <?php
                 $fabric=mysqli_query("select DISTINCT(dept) as dept from dummy_labour where `status`='pending' ORDER BY  `dummy_labour`.`id` ASC ");
				 while($fabric_res=mysqli_fetch_object($fabric)){
				?>
    <option value="<?php=$fabric_res->dept?>"<?php if(isset($_REQUEST['dept']) && $_REQUEST['dept'] == $fabric_res->dept){?> selected="selected"<?php }?>>
      <?php=$fabric_res->dept?>
      </option>
    <?php }?>
  </select>
</strong></td>
    <td width="6%" align="center" valign="middle"><strong>Date</strong></td>
    <td width="44%" align="center" valign="middle"><strong><font size="-2">(<?php echo date("d-m-Y",strtotime($fabrics->date));?>)</font></strong></td>
  </tr>
</table>            	
</form>
<style type="text/css">
.table th, .table td {padding:0px;}
</style>
<!--<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" class="curvedEdges">
  <tr>
    <th width="5%" align="center" valign="middle" id="non-printable">&nbsp;</th>
    <th width="11%" align="center" valign="middle">Id</th>
    <th width="11%" align="center" valign="middle">Name</th>
    <th width="14%" align="center" valign="middle">Dept</th>
    <th width="10%" align="center" valign="middle">Date</th>
    <th width="6%" align="center" valign="middle">Total shift </th>
    <th width="5%" align="center" valign="middle">Per Sift</th>
    <th width="5%" align="center" valign="middle">Total Wages</th>
    <th width="4%" align="center" valign="middle">Debit</th>
    <th width="5%" align="center" valign="middle">Salary</th>
    <th width="8%" align="center" valign="middle">Paying salary</th>
    <!--<th width="9%" align="center" valign="middle" bgcolor="#D6D6D6" id="non-printable">&nbsp;</th>
    <th width="7%"  id="non-printable">&nbsp;</th>--
  </tr>
<form name="" action="" method="get" enctype="multipart/form-data" > 
  <?php
  $fabric="select * from dummy_labour where `status`='pending'";
  if(isset($_REQUEST['dept'])){$fabric.="and `dept`='".$_REQUEST['dept']."'";}
  $fabric.="ORDER BY  `dummy_labour`.`id` ASC";	
  $fabric=mysqli_query($fabric);
  while($fabrics=mysqli_fetch_object($fabric))
  { 
  $way=$fabrics->i;
  ?>

  <tr height="18">
    <td width="5%" height="15"  align="center" valign="middle">
    <input type="checkbox" name="formDoor[]" onclick="selectall()" value="<?php echo($way); ?>" />
    </td>
    <td width="11%" height="15"  align="center" valign="middle" ><?php echo($fabrics->id);?></td>
    <td width="11%" height="15"  align="center" valign="middle" ><?php echo($fabrics->name);?></td>
    <td width="14%" height="15"  align="center" valign="middle" ><?php echo($fabrics->dept);?></td>
    <td width="10%" height="15"  align="center" valign="middle" ><?php echo date("d-m-Y",strtotime($fabrics->date));?></td>
    <td width="6%" height="15"  align="center" valign="middle" ><?php echo($fabrics->total_shift);?></td>
    <td width="5%" height="15"  align="center" valign="middle" ><?php echo($fabrics->total_wages/$fabrics->total_shift);?></td>
    <td width="5%" height="15"  align="center" valign="middle" ><?php echo($fabrics->total_wages);?></td>
    <td width="4%" height="15"  align="center" valign="middle" ><?php echo($fabrics->debit);?></td>
    <td width="5%" height="15"  align="center" valign="middle" ><?php echo($fabrics->salary);?></td>
    <td width="8%" height="15"  align="center" valign="middle" ><?php=$fabrics->salary?></td>
    <!--<td width="9%" height="15"  align="center" valign="middle" bgcolor="#FFFFFF" id="non-printable">&nbsp;</td>
  <td height="15" align="center" valign="middle"  id="non-printable"><a href="demo_accounts.php?delete=<?php=$fabrics->i?>&labour=" class="btn btn-danger">Delete</a></td>--
  </tr>
   <?php $lab_salary_total+=($fabrics->salary);
   }?>
   	<tr>
   		<td colspan="11"><input type="submit" /></td>
    </tr>
 </form>
</table>-->
<form name="" action="demo_accounts.php" method="get">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="table table-bordered bootstrap-datatable datatables">
      <thead>
        <tr>
        <th width="3%" height="32" align="center" valign="middle" id="non-printable">&nbsp;</th>
        <th width="11%" align="center" valign="middle">Id</th>
        <th width="10%" align="center" valign="middle">Date</th>
        <th width="12%" align="center" valign="middle">Name</th>
        <th width="8%" align="center" valign="middle"> Dept</th>
        <th width="11%" align="center" valign="middle">Total Shift</th>
        <th width="10%" align="center" valign="middle">Per Shift</th>
        <th width="10%" align="center" valign="middle">Paying Salary</th>
       <!-- <th width="10%" align="center" valign="middle">Total Wages</th>
        <th width="10%" align="center" valign="middle">Debit</th>
        <th width="10%" align="center" valign="middle">Salary</th>-->
        <th width="10%" align="center" valign="middle" id="non-printable">Paying Salary</th>
        <th width="10%" align="center" valign="middle" id="non-printable">Action</th>
        <th width="10%" align="center" valign="middle">Signature</th>
        </thead><tbody>
      <?php
	  $fabric="select * from dummy_labour where `status`='pending'";
	  if(isset($_REQUEST['dept'])){$fabric.="and `dept`='".$_REQUEST['dept']."'";}
	  $fabric.="ORDER BY  `dummy_labour`.`id` ASC";	
	  $fabric=mysqli_query($fabric);
	  while($fabrics=mysqli_fetch_object($fabric))
	  { 
	  $way=$fabrics->i;
      ?>
      
        <tr>
    <td align="center" valign="middle" id="non-printable"><input type="checkbox" name="formDoor[]" value="<?php echo($way); ?>" onclick="selectall()" /></td>
    <td width="11%" height="15"  align="center" valign="middle" ><?php echo($fabrics->id);?></td>
    <td width="4%" align="center" valign="middle"><?php echo date("d-m-Y",strtotime($fabrics->date)); ;?></td>
    <td width="11%" height="15"  align="center" valign="middle" ><?php echo($fabrics->name);?></td>
    <td width="14%" height="15"  align="center" valign="middle" ><?php echo($fabrics->dept);?></td>
    <td width="6%" height="15"  align="center" valign="middle" ><?php echo($fabrics->total_shift);?></td>
    <td width="5%" height="15"  align="center" valign="middle" ><?php echo($fabrics->total_wages/$fabrics->total_shift);?></td>
    <td width="8%"  align="center" valign="middle"><?php echo $fabrics->salary;$total_salary+=$fabrics->salary;?></td>
    <!--<td width="5%" height="15"  align="center" valign="middle" ><?php echo($fabrics->total_wages);?></td>
    <td width="4%" height="15"  align="center" valign="middle" ><?php echo($fabrics->debit);?></td>
    <td width="5%" height="15"  align="center" valign="middle" ><?php echo($fabrics->salary);?></td>-->
    <td width="8%" height="15"  align="center" valign="middle" id="non-printable"><input type="number" name="pay[]" style="width:50px;" readonly="readonly" value="<?php echo $fabrics->salary;?>" />&nbsp;</td>
    <td align="center" valign="middle" id="non-printable"><a href="demo_accounts.php?delete=<?php=$fabrics->i?>&labour=" class="btn btn-danger">Delete</a>&nbsp;</td>
    <td align="center" valign="middle">&nbsp;</td>
        <?php
      }
      ?>
        <tr>
          <td align="center" valign="middle" id="non-printable">&nbsp;</td>
          <td height="15"  align="center" valign="middle" >&nbsp;</td>
          <td height="15"  align="center" valign="middle" >&nbsp;</td>
          <td height="15"  align="center" valign="middle" >&nbsp;</td>
          <td height="15"  align="center" valign="middle" >&nbsp;</td>
          <td height="15"  align="center" valign="middle" >&nbsp;</td>
          <td height="15"  align="center" valign="middle" >&nbsp;</td>
          <td  align="center" valign="middle"><h3><?php echo $total_salary; ?></h3></td>
        <!--  <td height="15"  align="center" valign="middle" >&nbsp;</td>
          <td height="15"  align="center" valign="middle" >&nbsp;</td>-->
          <td height="15"  align="center" valign="middle">&nbsp;</td>
          <td align="center" valign="middle" id="non-printable">&nbsp;</td>
          <td align="center" valign="middle" id="non-printable">&nbsp;</td>
        </tbody>  
</table>
<div class="form-actions" id="non-printable">
	<input type="submit" name="submit_pay" class="btn btn-primary" value="Save Changes" />
    <input type="reset" name="reset" class="btn" value="Cancel" />
</div>
</form>
</div>
</div>
        </div>
        </div>
        </div>

        </div>
        </div>
                <!--/row-->		
    <!-- End Wrapper -->
	<!-- ============================================================== -->
            <!-- footer -->
            <?php include('includes/footer.php');?>
        </div>
        </div>
            <!-- End footer -->
            <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
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