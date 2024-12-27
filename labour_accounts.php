<?php 
include('includes/config.php');

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}
// if(isset($_REQUEST['sdate'])){
// 	$sdate=date("d-m-Y",strtotime($_REQUEST['sdate']));
// 	$sdate1=date("Y-m-d",strtotime($_REQUEST['sdate']));

// }
// else{
// 	$sdate="01-".date("m-Y");
// 	$sdate1=date("Y-m")."-01";
// }
// if(isset($_REQUEST['edate'])){
// 	$edate=date("d-m-Y",strtotime($_REQUEST['edate']));
// 	$edate1=date("Y-m-d",strtotime($_REQUEST['edate']));
// }
// else{
// 	$edate="30-".date("m-Y");
// 	$edate1=date("Y-m")."-30";
// }

// if (isset($_REQUEST["frmflag1"])) { $frmflag1 = $_REQUEST["frmflag1"]; } else { $frmflag1 = ""; }
// //$frmflag1 = $_REQUEST[frmflag1];
// if ($frmflag1 == 'frmflag1')
// {
// 	$searchdoctor = $_REQUEST['searchdoctor'];
// 	$status = $_REQUEST['status'];
// }

// $indiatimecheck = date('d-M-Y-H-i-s');
// $foldername = "dbexcelfiles";
// //$checkfile = $foldername.'/DoctorList.xls';
// //if(!is_file($checkfile))
// //{
// $tab = "\t";
// $cr = "\n";

// //$data = "BILL Number: " . $tab .$billnumber. $tab . $tab . $tab ."BILL PARTICULARS". $tab. $cr. $cr;

// $data .= "Labour Id".$tab."Date" . $tab . "Name" . $tab . "Section" . $tab . "Total Shift" . $tab."Per Shift". $tab . "Total Wages" . $tab . "Debit" . $tab . "Paid Wages" .$tab . $cr;

// $i=0;


// $query2 = "SELECT * FROM  `dummy_labour` where `status`='paid' and `date` >= '$sdate1' and `date` <= '$edate1' and `id` = '".$_REQUEST['id']."'  ORDER BY  `dummy_labour`.`i` ASC  ";// desc limit 0, 100";

// $sql="SELECT * FROM  `dummy_labour` where `status`='paid' and `date` >= '$sdate1' and `date` <= '$edate1'";
// if(isset($_REQUEST['dept']) && $_REQUEST['dept'] != ''){
// 	$sql.="and `dept` = '".$_REQUEST['dept']."'";
// }
// if(isset($_REQUEST['id']) && $_REQUEST['id'] != ''){
// 	$sql.="and `id` = '".$_REQUEST['id']."'";
// }
// //echo $sql;
// $sql.="ORDER BY  `dummy_labour`.`i` ASC";

// $exec2 = mysqli_query($sql) or die ("Error in Query2".mysqli_error());
// while ($res2 = mysqli_fetch_array($exec2))
// {

// $res2id = $res2['id'];
// $res2date = $res2['name'];
// $res2name = $res2['dept'];
// $res2section = $res2['date'];
// $res2total_shift = $res2['total_shift'];
// $res2per_shift = $res2['total_wages']/ $res2['total_shift'];
// $res2total_wages = $res2['total_wages'] ;
// $res2debit = $res2['debit'];
// $res2salary = $res2['salary'];

// $data .= $res2id. $tab . $res2date . $tab . $res2name . $tab . $res2section . $tab . $res2total_shift . $tab . $res2per_shift . $tab . $res2total_wages . $tab . $res2debit . $tab . $res2salary . $cr;		

// }

// $data=preg_replace( '/\r\n/', ' ', trim($data) ); //to trim line breaks and enter key strokes.

// $fp = fopen($foldername.'/labour.xls', 'w+');
// fwrite($fp, $data);
// fclose($fp);



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
                                           
<input onClick="javascript:excelexport1();" type="button" value="Export To Excel" name="Submit2" class="button" style="border: 1px solid #001E6A" />
<table width="1016" align="center">
<tr>
<td>
	<form id="form1" name="form1" method="post" action="">
    <table width="500" border="1" align="center" cellpadding="0" cellspacing="0">
  <tbody>
    <tr>
      <td width="232" height="35" align="right"><strong>Start Date</strong></td>
      <td width="23">&nbsp;</td>
      <td width="237"><span class="rig"><strong>
        <input type="text" name="sdate" class="datepicker" id="sdate"  onChange="this.form.submit()" value="<?php $sdate?>"  />
      </strong></span></td>
    </tr>
    <tr>
      <td height="35" align="right"><strong>End date</strong></td>
      <td>&nbsp;</td>
      <td><span class="rig"><strong>
        <input type="text" name="edate" class="datepicker" id="edate" onChange="this.form.submit()" value="<?php $edate?>" />
      </strong></span></td>
    </tr>
    <tr>
      <td height="35" align="right"><strong>Department</strong></td>
      <td>&nbsp;</td>
      <td><select name="dept" onchange="this.form.submit()">
   				<option value="">----Select----</option>
                 <?php
                 $fabric=mysqli_query("select DISTINCT(dept) as dept from dummy_labour ORDER BY  `dummy_labour`.`id` ASC ");
				 while($fabric_res=mysqli_fetch_object($fabric)){
				?>
    <option value="<?php=$fabric_res->dept?>"<?php if(isset($_REQUEST['dept']) && $_REQUEST['dept'] == $fabric_res->dept){?> selected="selected"<?php }?>>
      <?php=$fabric_res->dept?>
      </option>
    <?php }?>
  </select></td>
    </tr>
    <tr>
      <td height="35" align="right"><strong>Labour Id Or Name</strong></td>
      <td>&nbsp;</td>
      <td><select name="id"  data-rel="chosen" onChange="this.form.submit()">
          <option value="">----Select----</option>
          <?php $sql=mysqli_query("SELECT  * FROM  `persondetail` where `possion` =  'Labor'");
           while($res=mysqli_fetch_object($sql)){ ?>
          <option value="<?php=$res->id?>"<?php if($_REQUEST['id'] == $res->id){?> selected="selected"<?php }?>>
            <?php=$res->name." - ".$res->id?>
            </option>
          <?php }?>
        </select></td>
    </tr>
  </tbody>
</table>

    </form> </td>
</tr>
</table>
<?php if(isset($_REQUEST['id']) && $_REQUEST['id'] != '----Select----') {?>
<table class="table table-striped table-bordered bootstrap-datatable datatable">
<thead>
  <tr>
    <th align="center" valign="middle"><strong>Sno</strong></th>
    <th align="center" valign="middle"><strong>Date</strong></th>
    <th align="center" valign="middle"><strong>Name</strong></th>
    <th align="center" valign="middle"><strong>Section</strong></th>
    <th align="center" valign="middle"><strong>Total Shift</strong></th>
    <th align="center" valign="middle"><strong>Per Shift(Rs)</strong></th>
    <th align="center" valign="middle"><strong>Total Wages</strong></th>
    <th align="center" valign="middle"><strong>Debit</strong></th>
    <th align="center" valign="middle"><strong>Paid Wages </strong></th>
    </tr>
  </thead>
  <tbody>
<?php
$sql="SELECT * FROM  `dummy_labour` where `status`='paid' and `date` >= '$sdate1' and `date` <= '$edate1'";
if(isset($_REQUEST['dept']) && $_REQUEST['dept'] != ''){
	$sql.="and `dept` = '".$_REQUEST['dept']."'";
}
if(isset($_REQUEST['id']) && $_REQUEST['id'] != ''){
	$sql.="and `id` = '".$_REQUEST['id']."'";
}
//echo $sql;
$sql.="ORDER BY  `dummy_labour`.`i` ASC";
$sql=mysqli_query($sql);
while($sqla=mysqli_fetch_object($sql))
{
	$id=$sqla->id;
	$dates=$sqla->date;
	$payadv=$sqla->pay_adv;
	$debit=$sqla->loss_pay;
	$balance=$namws->advance_balance;
	$advance=$namws->advance;
	$name=mysqli_query("select dept,name from `persondetail` where `id`='$id'");
	while($namws=mysqli_fetch_object($name))
	{
		$names=$namws->name;
		$dept=$namws->dept;
	}
		$debit=$sqla->debit;
		$abs=$sqla->total_shift;
		$new=$sqla->new_advance;
		$net=$sqla->salary;
		$wages=$sqla->total_wages;
		$sift=$sqla->salary/$abs;
	if($new==''){$new=0;}
    ?>
  <tr>
    <td align="center" valign="middle"><?php echo($id); ?></td>
    <td align="center" valign="middle"><?php echo(date("d-m-Y",strtotime($dates)));?></td>
    <td align="center" valign="middle"><?php echo($names);?></td>
    <td align="center" valign="middle"><?php echo($dept);?></td>
    <td align="center" valign="middle"><?php echo($abs); ?></td>
    <td align="center" valign="middle"><?php echo(number_format($sift));?></td>
    <td align="center" valign="middle"><?php echo($wages);?></td>
    <td align="center" valign="middle"><?php echo($debit);?></td>
    <td align="center" valign="middle"><?php echo($net);?></td>
    </tr>
  <?php
}
?>
</tbody>
</table>  
<?php }?>
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
    <script>
  $(function() {
    $( "#sdate" ).datepicker({
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#edate" ).datepicker( "option", "minDate", selectedDate );
      }
    });
    $( "#edate" ).datepicker({
      changeMonth: true,
      numberOfMonths: 1,
      onClose: function( selectedDate ) {
        $( "#sdate" ).datepicker( "option", "maxDate", selectedDate );
      }
    });
  });
  </script>


<script language="javascript">
function excelexport1()
{
	window.location = "dbexcelfiles/labour.xls"
}
</script>
    
</body>
</html>