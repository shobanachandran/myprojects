<?php 
include('includes/config.php');

if(!isset($_SESSION['userid']) || $_SESSION['userid'] === '') {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}
?>

<!DOCTYPE html>
<html dir="ltr" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Garments ERP">
    <meta name="author" content="Iorange Innovation">
    <link rel="icon" type="image/png" sizes="16x16" href="assets/images/favicon.png">
    <title><?php echo SITE_TITLE;?> - Attendance Entry</title>
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>
<body>
    <div id="main-wrapper">
        <?php include('includes/header.php');?>
        <?php include('includes/sidebar.php');?>
        <div class="page-wrapper" style="min-height: 100%; height: auto;">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Attendance Entry</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="attendance1.php">Attendance Entry</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="col-md-12">
                                <div class="card-body">
                                    <div class="card-body" style="width:100%">
                                        <form name="" action="" method="post" class="form-group">
                                            <table class="table table-striped table-bordered" width="100%" border="1" cellspacing="0" cellpadding="0">
                                                <tr>
                                                    <td>
                                                        <label class="control-label mb-10 col-sm-2" for="email_hr"><strong>Filter By</strong></label>
                                                        <div class="col-md-4 col-sm-12 col-xs-12 form-group">  
                                                            <select name="filter"  data-rel="chosen" class="select2 form-control" onchange="this.form.submit()">
                                                                <option>----Select----</option>
                                                           
                                                                <?php
$sql = mysqli_query($zconn, "SELECT DISTINCT(dept) as id FROM `labour_day_attandance` WHERE status = ''");
while ($res = mysqli_fetch_array($sql)) {
    $dept = $res['id'];
?>
    <option value="<?php echo $dept; ?>" <?php if ($dept == $_REQUEST['filter']) { ?>selected="selected"<?php } ?>>
        <?php echo $dept; ?>
    </option>
<?php
}
?>                                                               
                                                            
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
                                                            $sql_join = "SELECT * FROM labour_day_attandance WHERE status = '' AND `dept`='" . $_REQUEST['filter'] . "'";
                                                            $_SESSION['sql_session'] = $sql_join;
                                                            $sql_result = mysqli_query($zconn, $sql_join);
                                                            $grand_total = 0;
                                                            
                                                            while ($res = mysqli_fetch_assoc($sql_result)) {
                                                                $sql_isset = mysqli_query($zconn, "SELECT * FROM labour_day_attandance WHERE `labour_id`='" . $res['labour_id'] . "' AND status = ''");
                                                                $num_rows = mysqli_num_rows($sql_isset);
                                                                $name_sql = mysqli_fetch_array(mysqli_query($zconn, "SELECT * FROM persondetail WHERE id='" . $res['labour_id'] . "'"));
                                                                $_SESSION['department'] = $_REQUEST['filter'];
                                                                $sql_isset_count = mysqli_fetch_array($sql_isset);
                                                                
                                                                // Calculate total for each labour
                                                                $total = 0;
                                                                $total += $sql_isset_count->friday;
                                                                $total += $sql_isset_count->saturday;
                                                                $total += $sql_isset_count->sunday;
                                                                $total += $sql_isset_count->monday;
                                                                $total += $sql_isset_count->tuesday;
                                                                $total += $sql_isset_count->wednesday;
                                                                $total += $sql_isset_count->thursday;
                                                                $grand_total += $total * $sql_isset_count->siftsal;
                                                            ?>
                                                            <tr>
                                                                <td height="51" align="center" valign="middle" style="text-transform:uppercase"><input type="hidden" value="<?php echo $res['labour_id'];?>" name="id[]" checked="checked" /><?php echo $res['labour_id'];?></td>
                                                                <td align="center" valign="middle"><?php echo $name_sql->name;?></td>
                                                                <td align="center" valign="middle" data-rel="tooltip" title="Friday"><strong><?php if($sql_isset_count->friday=='0' || $sql_isset_count->friday==''){ ?>
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
                                                                <?php } else { ?>
                                                                    <input name="friday[]" type="text" class="form-control" id="friday[]" value="<?php echo $sql_isset_count->friday;?>" size="5" />
                                                                <?php } ?></strong></td>
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
                                                                <?php } else { ?>
                                                                    <input name="saturday[]" type="text" class="form-control" id="saturday[]" value="<?php echo $sql_isset_count->saturday;?>" size="5" />
                                                                <?php } ?></strong></td>
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
                                                                <?php } else { ?>
                                                                    <input name="sunday[]" type="text" class="form-control" id="sunday[]" value="<?php echo $sql_isset_count->sunday;?>" size="5" />
                                                                <?php } ?></strong></td>
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
                                                                <?php } else { ?>
                                                                    <input name="monday[]" type="text" id="monday[]" class="form-control" value="<?php echo $sql_isset_count->monday;?>" size="5" />
                                                                <?php } ?></strong></td>
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
                                                                <?php } else { ?>
                                                                    <input name="tuesday[]" type="text" class="form-control" id="tuesday[]" value="<?php echo $sql_isset_count->tuesday;?>" size="5" />
                                                                <?php } ?></strong></td>
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
                                                                <?php } else { ?>
                                                                    <input name="wednesday[]" type="text" class="form-control" id="wednesday[]" value="<?php echo $sql_isset_count->wednesday;?>" size="5" />
                                                                <?php } ?></strong></td>
                                                                <td align="center" valign="middle" data-rel="tooltip" title="Thursday"><strong><?php if($sql_isset_count->thursday=='0' || $sql_isset_count->thursday==''){ ?>
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
                                                                <?php } else { ?>
                                                                    <input name="thursday[]" type="text" class="form-control" id="thursday[]" value="<?php echo $sql_isset_count->thursday;?>" size="5" />
                                                                <?php } ?></strong></td>
                                                                <td align="center" valign="middle"> <strong><?php echo $total; ?></strong></td>
                                                                <td align="center" valign="middle"><strong><?php echo $pershit; ?></strong></td>
                                                                <td align="center" valign="middle"><strong><?php echo $total * $pershit; $grand_total += $total * $pershit; ?></strong></td>
                                                                <td align="center" valign="middle" id="non-printable">
                                                                    <?php if($total!='0') { ?>
                                                                        <a href="demo_accounts.php?id=<?php echo $sql_isset_count->id;?>" class="btn btn-primary" id="non-printable" >Send</a>
                                                                    <?php } if($sql_isset_count->thursday == 'A') { ?>
                                                                        <a href="?id=<?php echo $res['id'];?>&delete=true" class="btn btn-warning" onclick="return confirmBox()">Remove</a>
                                                                    <?php } ?>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                            $total = '0';
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
                                                            <td colspan="2" align="center" valign="middle"><h3><?php echo $grand_total;?></h3></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Container fluid  -->
                <!-- ============================================================== -->
            </div>
        </div>  
        <!-- End Page wrapper  -->
    </div>
</div>
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
<script src="assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js"></script>
<script src="dist/js/sidebarmenu.js"></script>
<!--Custom JavaScript -->
<script src="dist/js/custom.min.js"></script>
<!-- This Page JS -->
<script src="assets/extra-libs/DataTables/datatables.min.js"></script>
<script src="dist/js/pages/datatable/datatable-basic.init.js"></script>
<!-- Wave Effects -->
<script src="dist/js/waves.js"></script>
<!-- ============================================================== -->
<!-- Chart JS -->
<script src="assets/libs/flot/excanvas.js"></script>
<script src="assets/libs/flot/jquery.flot.js"></script>
<script src="assets/libs/flot/jquery.flot.pie.js"></script>
<script src="assets/libs/flot/jquery.flot.time.js"></script>
<script src="assets/libs/flot/jquery.flot.stack.js"></script>
<script src="assets/libs/flot/jquery.flot.crosshair.js"></script>
<script src="assets/libs/flot.tooltip/js/jquery.flot.tooltip.min.js"></script>
<script src="dist/js/pages/chart/chart-page-init.js"></script>

</body>
</html>