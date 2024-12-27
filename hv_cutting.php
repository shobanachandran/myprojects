<?php 
include('includes/config.php');
$colid = $_GET['id'];
if($_SESSION['userid']==''){
echo "<script>window.location.href='login.php';</script>";
}

$action = 'buyeradd';
$breadcrumb = 'Add';
$sucessMsg = 'Buyer Information Added Successfully';
if(isset($colid)){
    $sucessMsg = 'Buyer Information Updated Successfully';
    $action = 'buyeredit';
    $breadcrumb = 'Edit';
    $edtColQry = "SELECT * FROM buyer_master WHERE buyer_id='".$colid."'";
    $edtColResource = mysqli_query($zconn,$edtColQry);
    $colData = mysqli_fetch_array($edtColResource,MYSQLI_ASSOC);
    $colid = $colData['buyer_id'];
    $buyer_name = $colData['buyer_name'];
    $buyer_short_name = $colData['buyer_short_name'];
    $buyer_desc = $colData['buyer_desc'];
    $status = $colData['status'];
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
    <title>
        <?php echo SITE_TITLE;?> - Cutting add
    </title>
    <link href="dist/css/style.min.css" rel="stylesheet">
</head>

<body>
    <div id="main-wrapper">
        <?php include('includes/header.php');?>
        <?php include('includes/sidebar.php');?>

        <div class="page-wrapper" style="min-height: 100%; height: auto;padding-bottom: 50px; overflow-y: auto;">
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Cutting Add</h4>
                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="buyer.php">Cutting Info</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">

               
                <form name="colInfo" id="colInfo" method="post" enctype="multipart/form-data" action="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nik_no">NIK NO:</label>
                                                <!--input type="text" class="form-control" id="nik_no" name="nik_no" placeholder="Enter NIK No"-->
                                                <select class="form-control select2"  tabindex="6"  name="nik_no" id="nik_no" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                       $typQuery = "SELECT * FROM nik_no";
                                                       $typResource = mysqli_query($zconn,$typQuery);
                                                       while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
                                                    ?>
                                                     <option value="<?php echo $typdata['id']; ?>" <?php if($typeid==$typdata['id']){ ?> selected <?php } ?>><?php echo $typdata['nik_no']; ?></option>
                                                     <?php
                                                      }
                                                     ?>
                                                   </select>
                                            </div>
                                        </div>

                                        
                                    </div>

                                    <div class="row">
                                       
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="style-number">STYLE NUMBER:</label>
                                                 <!--input type="text" class="form-control" id="nik_no" name="nik_no" placeholder="Enter NIK No"-->
                                                 <select class="form-control select2"  tabindex="6"  name="style_no" id="style_no" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                       $typQuery = "SELECT * FROM style_code";
                                                       $typResource = mysqli_query($zconn,$typQuery);
                                                       while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
                                                    ?>
                                                     <option value="<?php echo $typdata['id']; ?>" <?php if($typeid==$typdata['id']){ ?> selected <?php } ?>><?php echo $typdata['style_no']; ?></option>
                                                     <?php
                                                      }
                                                     ?>
                                                   </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="style">STYLE:</label>
                                                <input type="text" id="style" class="form-control" name="style" placeholder="Enter Style">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="nik-id">NIK ID:</label>
                                                <select class="form-control select2"  tabindex="6"  name="style_no" id="style_no" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                       $typQuery = "SELECT * FROM nik_id";
                                                       $typResource = mysqli_query($zconn,$typQuery);
                                                       while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
                                                    ?>
                                                     <option value="<?php echo $typdata['id']; ?>" <?php if($typeid==$typdata['id']){ ?> selected <?php } ?>><?php echo $typdata['nik_id']; ?></option>
                                                     <?php
                                                      }
                                                     ?>
                                                   </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="color">COLOR:</label>
                                                <select class="form-control select2"  tabindex="6"  name="style_no" id="style_no" style="width: 100%;">
                                                    <option value="">Select</option>
                                                    <?php
                                                       $typQuery = "SELECT * FROM color_master";
                                                       $typResource = mysqli_query($zconn,$typQuery);
                                                       while($typdata=mysqli_fetch_array($typResource,MYSQLI_ASSOC)){
                                                    ?>
                                                     <option value="<?php echo $typdata['id']; ?>" <?php if($typeid==$typdata['id']){ ?> selected <?php } ?>><?php echo $typdata['colour_name']; ?></option>
                                                     <?php
                                                      }
                                                     ?>
                                                   </select>
                                            </div>
                                        </div>
                                    </div>


                                   

                                    <div class="row">
                                      
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="plan">Plan:</label>
                                                <input type="date" id="plan" class="form-control" name="plan" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="actual">Actual:</label>
                                                <input type="date" id="actual" class="form-control" name="actual" value="<?php echo date('Y-m-d');?>">
                                            </div>
                                        </div>
                                    </div>

                                   

                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border-top">
                        <div class="card-body" style="text-align: center;">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="reset" class="btn btn-primary">Reset</button>
                            <a href="hv_fabric_report.php"><button type="button" class="btn btn-danger">Back</button></a>
                        </div>
                        <input type="hidden" name="action" id="action" value="<?php echo $action ?>" />
                        <?php if(isset($userid)){ ?>
                        <input type="hidden" name="userid" id="userid" value="<?php echo $userid ?>" />
                        <?php  } ?>
                </form>

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
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<script src="dist/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

	

</body>
</html>
