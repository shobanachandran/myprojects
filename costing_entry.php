<?php 
include('includes/config.php');
include('includes/base_functions.php');
extract($_REQUEST);

if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_REQUEST);
echo "</pre>";*/
//exit;
if($_REQUEST['id']==''){
	$cost_no = get_max_costno();
	/*$sel_costing = mysqli_fetch_array(mysqli_query($zconn,"select max(id) as COSTNO from costing_entry_master"));
	if($sel_costing['COSTNO']=='' || $sel_costing['COSTNO']==NULL){
		$cost_no ='001';
	} else {
		$cost_no = $sel_costing['COSTNO']+1;
	}
	$cost_no = "00".$cost_no;*/
	$action="saveCosting";
}


if($_REQUEST['id']!='' ){
	$action="updateCosting";
	$cost_sql = mysqli_query($zconn,"select * from costing_entry_master where id='".$_REQUEST['id']."'");
	$res_cost = mysqli_fetch_array($cost_sql,MYSQLI_ASSOC);
	$cost_no = $res_cost['costing_no'];
	$res_cost['costing_date'];
	$cost_date = date_from_db($res_cost['costing_date']);
}

if($_POST['save_costing']=='saveCosting'){
	$costing_date = date_to_db($costing_date);
	
	
// Convert the dd-mm-yyyy format to yyyy-mm-dd
$mysql_formatted_date = date('Y-m-d', strtotime(str_replace('-', '/', $costing_date)));

	
	$sel_buyer_det = explode("~~", $_POST['sel_buyer']);
$buyer_code = substr($sel_buyer_det[0], 0, 12);
$cost_no = $buyer_code . '-' . get_max_costno();


	$sel_insert = mysqli_query($zconn,"insert into costing_entry_master(buyer_id,costing_no,order_no,style_no,
	total_value,total_weight1,costing_date,created_by,created_date,goldseal_no,cost_type) values
	('".$sel_buyer_det[1]."','".$cost_no."','".$order_no."','".$style_no."','".$grand_total."',
	'".$total_weight1."','".$costing_date."','".$_SESSION['userid']."',now(),'".$goldseal_no."','".$cost_type."')");
	//print_r($sel_insert);
	//exit();
	var_dump($sel_insert);
	$costing_id = mysqli_insert_id($zconn);
echo $costing_id;
	if($sel_insert){
		$trows = count($_POST['yname']);
		for($tr=0;$tr<$trows;$tr++){
		$ins_details = mysqli_query($zconn, "
    INSERT INTO costing_entry_details (
        costing_id, costing_no, yarn_name, yarn_count, yarn_type, yarn_colour,
        yarn_content, fabric_name, f_color, comp_group, comp_id, consumption_value,
        consumption_percent, pcs_weight, uom_id, yarn_rate, yarn_total, brand,
        sub_brand, season, goldseal_no,gsm,cost_type,dia
    ) VALUES (
        '" . $costing_id . "', '" . $cost_no . "', '" . $_POST['yname'][$tr] . "',
        '" . addslashes($_POST['ycount'][$tr]) . "', '" . $_POST['ytype'][$tr] . "',
        '" . $_POST['ycolor'][$tr] . "', '" . $_POST['content'][$tr] . "',
        '" . $_POST['fab_name'][$tr] . "', '" . $_POST['f_color'][$tr] . "',
        '" . $_POST['comp_group'][$tr] . "', '" . $_POST['ycomp'][$tr] . "',
        '" . $_POST['consumption_val'][$tr] . "', '" . $_POST['consumption_per'][$tr] . "',
        '" . $_POST['pcs_weight'][$tr] . "', '" . $_POST['uom'][$tr] . "',
        '" . $_POST['yrate'][$tr] . "', '" . $_POST['ytotal'][$tr] . "',
        '" . $_POST['brand'] . "', '" . $_POST['sub_brand'] . "',
        '" . $_POST['season'] . "', '" . $_POST['goldseal_no'] . "', '" . $_POST['gsm'][$tr] . "','" . $_POST['cost_type'] . "','" . $_POST['dia'][$tr] . "'
    )
");

var_dump($ins_details);
	 if (!$ins_details) {
            echo "Error inserting data into costing_entry_details: " . mysqli_error($zconn);
            // Add any additional error handling or logging here
        }
    }
} else {
    echo "Error inserting data into costing_entry_master: " . mysqli_error($zconn);
    // Add any additional error handling or logging here
}

}


if($_POST['save_costing']=='updateCosting'){
	$sel_buyer_det = explode("~~",$_POST['sel_buyer']);
	$sel_update = mysqli_query($zconn,"update costing_entry_master set buyer_id='".$sel_buyer_det[1]."',order_no='".$orer_no."', 
	style_no='".$style_no."',total_value='".$grand_total."',total_weight1='".$total_weight1."' where id='".$cost_id."'");

if($sel_update){
		$trows = count($_POST['yname']);
		$del_datas = mysqli_query($zconn,"delete from costing_entry_details where costing_id='".$cost_id."'");
		if($del_datas){
		for($tr=0;$tr<$trows;$tr++){
			$ins_details = mysqli_query($zconn,"insert into costing_entry_details(costing_id,yarn_name,yarn_count,yarn_type,
			yarn_colour,yarn_content,fabric_name,f_color,comp_group,comp_id,consumption_value,
			consumption_percent,pcs_weight,uom_id,yarn_rate,yarn_total,brand,sub_brand,season,goldseal_no,cost_type) values('".$cost_id."',
			'".$_POST['yname'][$tr]."','".addslashes($_POST['ycount'][$tr])."','".$_POST['ytype'][$tr]."','".$_POST['ycolor'][$tr]."',
			'".$_POST['content'][$tr]."','".$_POST['fab_name'][$tr]."','".$_POST['f_color'][$tr]."','".$_POST['comp_group'][$tr]."',
			'".$_POST['ycomp'][$tr]."','".$_POST['consumption_val'][$tr]."','".$_POST['consumption_per'][$tr]."',
			'".$_POST['pcs_weight'][$tr]."','".$_POST['uom'][$tr]."','".$_POST['yrate'][$tr]."','".$_POST['ytotal'][$tr]."',
			'".$_POST['brand']."',,'".$_POST['sub_brand']."',,'".$_POST['season']."','".$_POST['goldseal_no']."','".$_POST['cost_type']."')");
		}
		}
	}

	if($sel_update){
		echo "<script>alert('Updated Successfully!!!');</script>";
		echo "<script>window.location.href='costing_list.php';</script>";
	}
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
    <title><?php echo SITE_TITLE;?> - Costing Entry</title>
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet">
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">

	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>

	<style>
        /* CSS for the container */
        .scroll-container {
            width: 100%; /* Set the width as needed */
            overflow-x: auto; /* Enable horizontal scrolling */
        }
		.hidden {
    display: none;
}
.table-container {
            width: 100%; /* Set the width as needed */
            overflow-x: auto; /* Enable horizontal scrolling */
            white-space: nowrap; /* Prevent text wrapping */
        }

        th {
            font-size: 12px;
            font-weight: bold;
            background-color: #626F80;
            color: #fff;
            text-align: center;
        }

    </style>
</head>
<body>
    <div id="main-wrapper" data-sidebartype="full">
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
                        <h4 class="page-title">Costing Entry</h4>
						&nbsp;&nbsp;&nbsp;&nbsp; <a href="costing.php"> <button type="button" class="btn btn-info">Costing Process</button></a>

                        <div class="ml-auto text-right">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
									<li class="breadcrumb-item"><a style="background-color:#626F80; color:#fff; color:#fff; margin:10px; padding:10px;" href="costing_list.php">Back  </a></li>
                                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
									<li class="breadcrumb-item"><a href="#">Merch</a></li>
                                    <li class="breadcrumb-item active" aria-current="page"><a href="costing.php">Costing</a></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
			<form name="costing_entry" id="costing_entry" method="post">
			   <input type="hidden" name="cost_no" id="cost_no" value="<?php echo $cost_no;?>">
				<input type="hidden" name="cost_id" id="cost_id" value="<?php echo $_REQUEST['id'];?>">
                <div class="row" style="padding-top:20px;">
                    <div class="col-md-12">
                        <div class="card">
								<div class="card-body" style="width:100%; padding:0px;">
								<div class="card-body" style="width:100%">
								
								<div class="card" style="width:50%; float:left; left: 50px; ">
								
								<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label">Buyer Name</label>
										<div class="col-sm-6">
											<select class="select2 form-control custom-select chosen-select" 
											name="sel_buyer" id="sel_buyer" onchange="buyer_costing(this.value);" required>
											<option value="">Select</option>
										<?php $sel_buyer = mysqli_query($zconn,"select * from buyer_master where status='0'");
										while($res_buyer = mysqli_fetch_array($sel_buyer,MYSQLI_ASSOC)){
										if($res_cost['buyer_id']==$res_buyer['buyer_id']){	?>
										<option selected value="<?php echo $res_buyer['buyer_short_name']."~~".$res_buyer['buyer_id'];?>"><?php echo $res_buyer['buyer_name'];?></option>
										<?php } 

										else { ?>
										<option value="<?php echo $res_buyer['buyer_short_name']."~~".$res_buyer['buyer_id'];?>"><?php echo $res_buyer['buyer_name'];?></option>
										<?php } ?>
										<?php } ?>
											</select>
											<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
										</div>
									</div>
									
								<div class="form-group row">
    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Costing No</label>
    <div class="col-sm-6">
    <?php 
        if ($_REQUEST['id'] != '' || $_REQUEST['sel_buyer'] != '') {
            $cost_no1 = $cost_no;
        }
    ?>
        <input type="text" class="form-control" id="costing_no" name="costing_no" required autocomplete="off"  value="<?php echo $cost_no1?>">
    </div>
</div>
<div class="form-group row">
    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Costing Type</label>
    <div class="col-sm-6" >
      <select  name="cost_type" class="form-control  custom-select">
         <option value="yarn">Yarn</option>
         <option value="fabric">Fabric</option>
      </select>	
</div>
</div>						
		<!-- Your HTML form -->
<div class="form-group row">
    <label for="brand" class="col-sm-3 text-right control-label col-form-label">Brand name</label>
    <div class="col-sm-6">
        <select id="brand" name="brand" class="form-control" onchange="updateSubBrandOptions()">
            <option value="">Select Brand</option>
            <option value="Allen solly">Allen Solly</option>
            <option value="Van Heusen">Van Heusen</option>
            <option value="Peter England">Peter England</option>
            <option value="Silmon Carter">Silmon Carter</option>
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="sub_brand" class="col-sm-3 text-right control-label col-form-label">Sub Brand</label>
    <div class="col-sm-6">
        <select id="sub_brand" name="sub_brand" class="form-control">
            <option value="">Select Sub Brand</option>
        </select>
    </div>
</div>

<script>
    function updateSubBrandOptions() {
        var brandSelect = document.getElementById("brand");
        var subBrandSelect = document.getElementById("sub_brand");
        var selectedBrand = brandSelect.value;

        // Clear previous options
        subBrandSelect.innerHTML = '<option value="">Select Sub Brand</option>';

        // Define options for each brand
        var subBrandOptions = {
            'Allen solly': ['Allen solly Main Line', 'Allen solly Prime', 'Allen solly Juniors'],
            'Van Heusen': ['Van Heusen Sports', 'Van Heusen Denim Labs', 'VDOT', 'VH Flex', 'VH Main Line'],
            'Peter England': ['PE Blue', 'PE Red'],
            'Silmon Carter': ['Simon Carter']
            // Add more brands and their respective sub brands as needed
        };

        // Add options based on the selected brand
        if (selectedBrand in subBrandOptions) {
            subBrandOptions[selectedBrand].forEach(function(subBrand) {
                var option = document.createElement("option");
                option.value = subBrand;
                option.text = subBrand;
                subBrandSelect.appendChild(option);
            });
        }
    }
</script>

									<div class="form-group row">
    <label for="fname" class="col-sm-3 text-right control-label col-form-label">Season</label>
    <div class="col-sm-6">
   <select id="season" name="season" class="form-control">
	   <option value="">Select</option>
    <option value="SS24">SS24</option>
	   <option value="SS24 ECOM">SS24 ECOM</option>
	   <option value="SS24 ECOM">AW24</option>
	   <option value="SS24 ECOM">SS23</option>
	   <option value="SS24 ECOM">AW23</option>
	   
	   
   
</select>
    </div>
</div>
								</div>
								</div>
									
								
								<div class="card" style="width:50%; float:left; right: 50px;">
									<div class="form-group row">
    <label for="style_no" class="col-sm-3 text-right control-label col-form-label">Style Code</label>
    <div class="col-sm-6">
        <select class="select2 form-control custom-select chosen-select" id="style_no" name="style_no" required>
            <option value="">Select Style</option>
            <?php
            // Assuming you have a database connection and execute the query
            $style_query = mysqli_query($zconn, "SELECT * FROM style_code");
            while ($row = mysqli_fetch_assoc($style_query)) {
                $selected = ($res_cost['style_no'] == $row['style_no']) ? 'selected' : '';
                echo "<option value='" . $row['style_no'] . "' $selected>" . $row['style_no'] . "</option>";
            }
            ?>
        </select>
    </div>
</div>
		<div class="form-group row">
    <label for="order_no" class="col-sm-3 text-right control-label col-form-label">Indent No</label>
    <div class="col-sm-6">
        <select class="select2 form-control custom-select chosen-select" id="order_no" name="order_no" required>
            <option value="">Select Indent No</option>
            <?php
            // Assuming you have a database connection and execute the query
            $indent_query = mysqli_query($zconn, "SELECT indent_no FROM indent_no");
            while ($row = mysqli_fetch_assoc($indent_query)) {
                $selected = ($res_cost['order_no'] == $row['indent_no']) ? 'selected' : '';
                echo "<option value='" . $row['indent_no'] . "' $selected>" . $row['indent_no'] . "</option>";
            }
            ?>
        </select>
    </div>
</div>
									
										<div class="form-group row">
    <label for="order_no" class="col-sm-3 text-right control-label col-form-label">Gold seal number</label>
    <div class="col-sm-6">
        <select class="select2 form-control custom-select chosen-select" id="goldseal_no" name="goldseal_no" required>
            <option value="">Select GoldSeal No</option>
            <?php
            // Assuming you have a database connection and execute the query
            $indent_query = mysqli_query($zconn, "SELECT goldseal_no FROM gold_seal");
            while ($row = mysqli_fetch_assoc($indent_query)) {
                $selected = ($res_cost['goldseal_no'] == $row['goldseal_no']) ? 'selected' : '';
                echo "<option value='" . $row['goldseal_no'] . "' $selected>" . $row['goldseal_no'] . "</option>";
            }
            ?>
        </select>
		<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
    </div>
</div>

									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Date</label>
										<div class="col-sm-6">
											<input type="text" autocomplete="off" required class="form-control" id="costing_date" name="costing_date" value="<?php echo $cost_date;?>" >
										</div>
									</div>
								</div>
											
								<script>
    // Get the current date in YYYY-MM-DD format
var currentDate = new Date().toISOString().slice(0, 10);

// Format the date as dd-mm-yyyy
var formattedDate = currentDate.split('-').reverse().join('-');

// Set the input field's value to the formatted date
document.getElementById('costing_date').value = formattedDate;

</script>

	<div class="row" style="float:left; padding:10px;">
				<!--h4 class="page-title"><b>Material Details</b></h4-->
			
											</div>
											
			
		<div class="table-container" >
			<table id="example"  style="width:150%">
				<thead style="background-color: #626F80; color: #fff; padding: 0px; font-size: 16px;">
				<tr align="center" valign="middle">
					<th style="width:10%">Yarn Name</th>
					<th style="width:8%">Count</th>
					<th style="width:8%">Type</th>
					<th style="width:10%">YarnColour</th>
					<th style="width:10%">Content</th>
					<th>GSM</th>
					<th>DIA</th>
					
					<th style="width:10%">Fabric Name</th>
					<th style="width:10%">Fabric Color</th>
					<th style="width:10%">Component</th>
					<th style="width:5%">Pcs.Weight</th>
					<th style="width:8%">UOM</th>
					<th style="width:5%">Rate</th>
					<th style="width:12%">Total</th>
					<th style="width:10%"><button type="button" class="btn btn-info add-new"><i class="fa fa-plus"></i></button></th>
				</tr>
				</thead>
				<tbody>
					<?php
					if($_REQUEST['id']!=''){
					$cost_det = mysqli_query($zconn,"select * from costing_entry_details where costing_id='".$res_cost['id']."'");
					$rec=0;
					while($res_cost_det = mysqli_fetch_array($cost_det,MYSQLI_ASSOC)){
					?>
					<tr id="delete_<?php echo $rec;?>">
								<td>
									<select class="select2 form-control custom-select "   id="yname0" name="yname[]">
										<option>Select</option>
										<?php 
	$sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
				while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
					  if($res_yname['yarn_name']==$res_cost_det['yarn_name']){ ?>
								<option selected="selected" value="<?php echo $res_yname['yarn_name'];?>"><?php echo $res_yname['yarn_name'];?></option>
								<?php } else { ?>
								<option value="<?php echo $res_yname['yarn_name'];?>"><?php echo $res_yname['yarn_name'];?></option>
								<?php } ?>
							<?php } ?>
									 </select>
								   </td>
								  <td>
									<select class="select2 form-control custom-select "  id="ycount0" name="ycount[]">
										<option>Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
										if($res_ycounts['counts_name']==$res_cost_det['yarn_count']){
										?>
											<option selected='selected' value="<?php echo $res_ycounts['counts_name'];?>"><?php echo $res_ycounts['counts_name'];?></option>
										<?php } else { ?>
											<option value="<?php echo $res_ycounts['counts_name'];?>"><?php echo $res_ycounts['counts_name'];?></option>
										<?php } ?>
										<?php } ?>
									 </select>
							</td>
							<td>
							<select class="select2 form-control custom-select " id="ytype<?php echo $rec;?>"  name="ytype[]" onchange="sel_ytype(this.value,'<?php echo $rec;?>');">
							<option value="">Select</option>
							<?php $sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
							while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
							if($res_ycounts['yarn_type_name']==$res_cost_det['yarn_type']){
											?>
									<option selected value="<?php echo $res_ycounts['yarn_type_name'];?>"><?php echo $res_ycounts['yarn_type_name'];?></option>
									<?php } else { ?>
									<option value="<?php echo $res_ycounts['yarn_type_name'];?>"><?php echo $res_ycounts['yarn_type_name'];?></option>
									<?php } ?>
										<?php } ?>
										</select>
										</td>
										<td>
						<?php if($res_cost_det['yarn_type']=='Cora'){ $ytype_disp ='disabled'; } else {$ytype_disp =''; }?>

					<select <?php echo $ytype_disp;?> class="select2 form-control custom-select" name="ycolor[]" id="ycolor<?php echo $rec;?>">
					<option>Select</option>
							<?php $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
							while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
										if($res_ycolor['colour_name']==$res_cost_det['yarn_colour']){
											?>
											<option selected value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
										<?php } else { ?>
											<option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
										<?php } ?>
										<?php } ?>
									</select>
									</td>
									
									<td>
									<select name="content[]" id="content<?php echo $rec;?>" class="select2 form-control custom-select ">
									<option>Select</option>
									<?php $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
									while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
										if($res_content['content_name']==$res_cost_det['yarn_content']){
									?>
									<option selected value="<?php echo $res_content['content_name'];?>"><?php echo $res_content['content_name'];?></option>
									<?php } else { ?>
									<option value="<?php echo $res_content['content_name'];?>"><?php echo $res_content['content_name'];?></option>
									<?php } ?>
									<?php } ?>
									</select>
								</td>
								<td>
													<select class="select2 form-control custom-select chosen-select" name="gsm[]"  style="width:100px;">
														<option>Select</option>
<?php $sel_fabric = mysqli_query($zconn,"select * from gsm_master where status='0'");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['gsm_name'];?>"><?php echo $res_fabric['gsm_name'];?></option>
							<?php } ?>														
													</select>
												</td>
						<td>
													<select class="select2 form-control custom-select chosen-select" name="dia[]"  style="width:100px;">
														<option>Select</option>
<?php $sel_fabric = mysqli_query($zconn,"select * from dia_master where status='0'");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['dia_name'];?>"><?php echo $res_fabric['dia_name'];?></option>
							<?php } ?>														
													</select>
												</td>
			
			<td>
						<select name="fab_name[]" class="form-control" >
							<option>--Select--</option>
						<?php $sel_fabs = mysqli_query($zconn,"select * from fabric_master where status='0'");
						
						while($res_fab = mysqli_fetch_array($sel_fabs,MYSQLI_ASSOC)){
							if($res_fab['fabric_name']==$res_cost_det['fabric_name']){
							?>
						<option value="<?php echo $res_fab['fabric_name'];?>" selected><?php echo $res_fab['fabric_name'];?></option>
							<?php } else { ?>
						<option value="<?php echo $res_fab['fabric_name'];?>" ><?php echo $res_fab['fabric_name'];?></option>

							<?php } ?>
						<?php } ?>
						</select>
						<script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
			</td>

			<td>
											<select class="select2 form-control custom-select " name="f_color[]" id="f_color0">
											<option value="">Select</option>
									<?php
										$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
										while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
											if($res_ycolor['colour_name']==$res_cost_det['f_color']){
							?>
						<option value="<?php echo $res_ycolor['colour_name'];?>" selected><?php echo $res_ycolor['colour_name'];?></option>
							<?php } else { ?>
						<option value="<?php echo $res_ycolor['colour_name'];?>" ><?php echo $res_ycolor['colour_name'];?></option>

							<?php } ?>
						<?php } ?>
											</select>
												</td>
						<td>
					<select class="select2 form-control custom-select " name="ycomp[]" id="ycomp<?php echo $rec;?>">
					<option>Select</option>
					<?php $selcomp = mysqli_query($zconn,"select * from components where status='0'");
					while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
					if($res_comp['comp_name']==$res_cost_det['comp_id']){
					?>
					<option selected value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
					<?php } else { ?>
					<option value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
					<?php } } ?>
					</select>
			</td>

			
			<!-- <td>
				<input type="text" class="form-control" id="consumption_val<!?php echo $rec; ?>" name="consumption_val[]" autocomplete="off" value="<?php echo $res_cost_det['consumption_value'];?>" onkeyup="cal_yarn_pcs('<?php echo $rec; ?>');">
			</td>
			<td>
			<input type="text" class="form-control" id="consumption_per<!?php echo $rec; ?>" name="consumption_per[]" placeholder="%" onkeyup="cal_yarn_pcs('<?php echo $rec; ?>');" value="<?php echo $res_cost_det['consumption_percent'];?>" autocomplete="off">
			</td> -->

			
			<td>
			<input type="number" step="0.01" class="form-control totl1" id="pcs_weight<?php echo $rec; ?>" name="pcs_weight[]" placeholder="PCs Wt" onkeyup="cal_amount('<?php echo $rec;?>');" onblur="cal_amount1('<?php echo $rec;?>');" value="<?php echo $res_cost_det['pcs_weight'];?>" autocomplete="off">
			</td>
			<td>
			<select class="select2 form-control custom-select chosen-select" name="uom[]" id="uom<?php echo $rec; ?>">
			<option value="">Select</option>
			<?php 
			$sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
			while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
					if($res_uom['uom_name']==$res_cost_det['uom_id']){
					?>
					<option value="<?php echo $res_uom['uom_name'];?>" selected><?php echo $res_uom['uom_name'];?></option>
					<?php } else {?>
					<option value="<?php echo $res_uom['uom_name'];?>"><?php echo $res_uom['uom_name'];?></option>
					<?php } ?>
					<?php } ?>
					</select>
					</td>
					<td>
				<input type="text" class="form-control" id="yrate<?php echo $rec;?>" name="yrate[]" placeholder="Rate" autocomplete="off" onkeyup="cal_amount('<?php echo $rec;?>');" onblur="cal_amount('<?php echo $rec;?>');" value="<?php echo $res_cost_det['yarn_rate']; ?>">
				</td>
				<td>
					<input type="text" class="form-control totl" id="ytotal<?php echo $rec; ?>" name="ytotal[]" placeholder="Total" autocomplete="off" value="<?php echo $res_cost_det['yarn_total'];?>">
				</td>
				<td>
					<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
				</td>
			</tr>
					<?php $rec++;}
					} else {
							?>
							<tr id="delete_0">
								<td>
									<select class="select2 form-control custom-select chosen-select"  id="yname0" name="yname[]">
										<option value="">Select</option>
										<?php
										$sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
										while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_yname['yarn_name'];?>"><?php echo $res_yname['yarn_name'];?></option>
										<?php } ?>
									 </select>
								   </td>
								  <td>
									<select class="select2 form-control custom-select chosen-select" id="ycount0" name="ycount[]">
										<option value="">Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_ycounts['counts_name'];?>"><?php echo $res_ycounts['counts_name'];?></option>
										<?php } ?>
									 </select>
								</td>
								<td>
										<select class="select2 form-control custom-select chosen-select" id="ytype0" name="ytype[]" onchange="sel_ytype(this.value,'0');">
										<option value="">Select</option>
										<?php $sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
										while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_ycounts['yarn_type_name'];?>"><?php echo $res_ycounts['yarn_type_name'];?></option>
										<?php } ?>
										</select>
									</td>
										<td>
											<select class="select2 form-control custom-select chosen-select" name="ycolor[]" id="ycolor0">
											<option value="">Select</option>
									<?php
										$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
										while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
										<?php } ?>
											</select>
												</td>
												<td>
												<select name="content[]" id="content0" class="select2 form-control custom-select chosen-select">
												<option>Select</option>
									<?php $sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
									while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){ ?>
									<option value="<?php echo $res_content['content_name'];?>"><?php echo $res_content['content_name'];?></option>
									<?php } ?>
									</select>
							</td>

							<td style="padding:0px; margin:0px;">
													<select class="select2 form-control custom-select chosen-select" name="gsm[]"  style="width:100px;">
														<option>Select</option>
<?php $sel_fabric = mysqli_query($zconn,"select * from gsm_master where status='0'");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['gsm_name'];?>"><?php echo $res_fabric['gsm_name'];?></option>
							<?php } ?>														
													</select>
												</td>
									<td>
													<select class="select2 form-control custom-select chosen-select" name="dia[]"  style="width:100px;">
														<option>Select</option>
<?php $sel_fabric = mysqli_query($zconn,"select * from dia_master where status='0'");
			while($res_fabric=mysqli_fetch_array($sel_fabric,MYSQLI_ASSOC)){ ?>
							<option value="<?php echo $res_fabric['dia_name'];?>"><?php echo $res_fabric['dia_name'];?></option>
							<?php } ?>														
													</select>
												</td>
									
						<td>
						<select name="fab_name[]" class="select2 form-control custom-select chosen-select" >
							<option>--Select--</option>
						<?php $sel_fabs = mysqli_query($zconn,"select * from fabric_master where status='0'");
						while($res_fab = mysqli_fetch_array($sel_fabs,MYSQLI_ASSOC)){?>
						<option value="<?php echo $res_fab['fabric_name'];?>"><?php echo $res_fab['fabric_name'];?></option>
						<?php } ?>
						</select>
	
						</td>
								
						<td>
											<select class="select2 form-control custom-select chosen-select" name="f_color[]" id="f_color0">
											<option value="">Select</option>
									<?php
										$sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
										while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){?>
											<option value="<?php echo $res_ycolor['colour_name'];?>"><?php echo $res_ycolor['colour_name'];?></option>
										<?php } ?>
											</select>
								</td>
								<td>
										<select class="select2 form-control custom-select chosen-select" name="ycomp[]" id="ycomp0">
										<option value="">Select</option>
										<?php $selcomp = mysqli_query($zconn,"select * from components where status='0'");
										while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
										?>
										<option value="<?php echo $res_comp['comp_name'];?>"><?php echo $res_comp['comp_name'];?></option>
										<?php } ?>
										</select>
										</td>
						<!-- <td>
						<input type="text" class="form-control" id="consumption_val0" name="consumption_val[]" autocomplete="off" onkeyup="cal_yarn_pcs('0');">
						</td>
						<td>
						<input type="text" class="form-control" id="consumption_per0" name="consumption_per[]" placeholder="(%)" onkeyup="cal_yarn_pcs('0');" autocomplete="off">
						</td> -->
						<td>
						<input type="text" class="form-control totl1" id="pcs_weight0"    name="pcs_weight[]"  placeholder="PCs Wt" autocomplete="off" onkeyup="cal_amount1('0');" onblur="cal_amount1('<?php echo $rec;?>');">
						</td>
				<td>
				<select class="select2 form-control custom-select chosen-select" name="uom[]" id="uom0">
				<option value="">Select</option>
				<?php $sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
					while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){	?>
						<option value="<?php echo $res_uom['uom_name'];?>"><?php echo $res_uom['uom_name'];?></option>
						<?php } ?>
				</select>
				
						</td>
						<td>
							<input type="text" class="form-control" id="yrate0" name="yrate[]" placeholder="Rate" autocomplete="off" onkeyup="cal_amount('0');">
						</td>
						<td>
							<input type="text" class="form-control totl" id="ytotal0" name="ytotal[]" placeholder="Total" autocomplete="off" value="0">
						</td>
						<td>
							<a class="delete" title="Delete"><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a>
						</td>
					</tr>
					<?php } ?>
										</tbody>
										<tbody>
											<tr align="center" id="">
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td></td>
												<td>
												  <h6  valign="middle" class="page-title">Total Weight:</h6></td>
												<td>
											<input type="text" class="form-control" id="total_weight1" name="total_weight1" readonly placeholder="" style="border: 1px solid #000;" value="<?php echo $res_cost['total_weight1'];?>">
												</td>
												<td></td>
												<td>
												  <h6  valign="middle" class="page-title">Yarn Total:</h6></td>
												<td>
											<input type="text" class="form-control" id="grand_total" name="grand_total" readonly placeholder="" style="border: 1px solid #000;" value="<?php echo $res_cost['total_value'];?>">
												</td>
												<td>
												</td>
											</tr>
										</tbody>
					</table>
					</div>
					</div>
					</div>
					</div>
					</div>
					</div>
							<div class="border-top">
								<div class="card-body" style="margin-left: 450px;">
									<button type="submit" name="save_costing" class="btn btn-success" value="<?php echo $action;?>">Save</button>
									<button type="reset" class="btn btn-primary">Reset</button>
									<a href="costing_list.php"><button type="button" class="btn btn-danger">List</button></a>
								</div>
							</div>
							
                        
					
					

                <!-- Sales chart -->
         <!-- ============================================================== -->
				
				</form>
            <!-- End Container fluid  -->
         <!-- ============================================================== -->
       
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    
            <!-- footer -->
           
			
		</div>

		<br>
  <br>
  <br>
  <br>
  <?php include('includes/footer.php');?>
  </div>

  <br>
  <br>
  <br>
  <br>
  <?php include('includes/footer.php');?>
					</div>
            <!-- End footer -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/popper.js/dist/umd/popper.min.js"></script>
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <script src="assets/extra-libs/sparkline/sparkline.js"></script>
    <!--Wave Effects -->
	<script src="dist/js/bootstrap-datepicker.js"></script>
    <script src="dist/js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<?php
		 $sel_yname = mysqli_query($zconn,"select * from yarn_names where status='0'");
		 $ynamelist= '';
		 while($res_yname = mysqli_fetch_array($sel_yname,MYSQLI_ASSOC)){
		  $ynamelist .='<option value="'.$res_yname['yarn_name'].'">'.$res_yname['yarn_name'].'</option>';
		  } 

		 $sel_ycounts = mysqli_query($zconn,"select * from counts_master where status='0'");
		 $ycountlist= '';
		 while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ycountlist .='<option value="'.addslashes($res_ycounts['counts_name']).'">'.addslashes($res_ycounts['counts_name']).'</option>';
		 }

		$sel_ycounts = mysqli_query($zconn,"select * from yarn_types where status='0'");
		$ytypes ='';
		while($res_ycounts = mysqli_fetch_array($sel_ycounts,MYSQLI_ASSOC)){
			$ytypes .='<option value="'.$res_ycounts['yarn_type_name'].'">'.$res_ycounts['yarn_type_name'].'</option>';
		}

	   $sel_ycolor = mysqli_query($zconn,"select * from color_master where status='0'");
	   $color_list='';
		while($res_ycolor = mysqli_fetch_array($sel_ycolor,MYSQLI_ASSOC)){
			$color_list .='<option value="'.$res_ycolor['colour_name'].'">'.$res_ycolor['colour_name'].'</option>';
		}

		$sel_content = mysqli_query($zconn,"select * from content_master where status='0'");
		$content_list='';
		while($res_content = mysqli_fetch_array($sel_content,MYSQLI_ASSOC)){
			$content_list .='<option value="'.$res_content['content_name'].'">'.$res_content['content_name'].'</option>';
		 }

		$selcomp = mysqli_query($zconn,"select * from components where status='0'");
		$comp_list='';
		while($res_comp = mysqli_fetch_array($selcomp,MYSQLI_ASSOC)){
			$comp_list .='<option value="'.$res_comp['comp_name'].'">'.$res_comp['comp_name'].'</option>';
		}

		$sql_uom = mysqli_query($zconn,"select * from uom_master where status='0'");
		$uom_list ='';
		while($res_uom =mysqli_fetch_array($sql_uom,MYSQLI_ASSOC)){
			$uom_list .='<option value="'.$res_uom['uom_name'].'">'.$res_uom['uom_name'].'</option>';
		}

		$sel_fabs = mysqli_query($zconn,"select * from fabric_master where status='0'");
		$fab_list='';
		while($res_fab = mysqli_fetch_array($sel_fabs,MYSQLI_ASSOC)){ 
			$fab_list .='<option value="'.$res_fab['fabric_name'].'">'.$res_fab['fabric_name'].'</option>';
		}
		$sel_gsm = mysqli_query($zconn,"select * from gsm_master");
		$gsm_list='';
		while($res_color=mysqli_fetch_array($sel_gsm,MYSQLI_ASSOC)){ 
			$gsm_list .='<option value="'.$res_color['gsm_name'].'">'.$res_color['gsm_name'].'</option>';
			}
	$sel_dia = mysqli_query($zconn,"select * from dia_master");
		$dia_list='';
		while($res_color=mysqli_fetch_array($sel_dia,MYSQLI_ASSOC)){ 
			$dia_list .='<option value="'.$res_color['dia_name'].'">'.$res_color['dia_name'].'</option>';
			}

		?>
<script type="text/javascript">
$(document).ready(function(){
	//$('.left-sidebar').slideToggle();
});

$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	var actions = $("table td:last-child").html();
	// Append table with add row form on add new button click
    $(".add-new").click(function(){
		var index = $("table tbody tr:last-child").index();
		var newc = parseInt(index)+parseInt(1);
        var row = '<tr >' +
            '<td><select class="select2 form-control custom-select" id="yname'+newc+'" name="yname[]"><option>Select</option><?php echo $ynamelist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="ycount'+newc+'" name="ycount[]"><option> Select</option><?php echo $ycountlist;?></select></td>' +
            '<td><select class="select2 form-control custom-select" id="ytype'+newc+'" name="ytype[]" onchange="sel_ytype(this.value,\''+newc+'\');"><option>Select</option><?php echo $ytypes;?></select></td>' +
            '<td><select class="select2 form-control custom-select" name="ycolor[]" id="ycolor'+newc+'"><option>Select</option><?php echo $color_list;?></select></td>' +
            '<td><select class="select2 form-control custom-select" name="content[]" id="content'+newc+'"><option>Select</option><?php echo $content_list;?></select></td>' +
			'<td><select class="select2 form-control custom-select" name="gsm[]" id="gsm'+newc+'"><option>Select</option><?php echo $gsm_list;?></select></td>'+
			'<td><select class="select2 form-control custom-select" name="dia[]" id="dia'+newc+'"><option>Select</option><?php echo $dia_list;?></select></td>'+
			'<td><select class="select2 form-control custom-select" name="fab_name[]" id="fab_name'+newc+'"><option>Select</option><?php echo $fab_list;?></select></td>'+
			'<td><select class="select2 form-control custom-select" name="f_color[]" id="f_color'+newc+'"><option>Select</option><?php echo $color_list;?></select></td>' +
				'<td><select class="select2 form-control custom-select" name="ycomp[]" id="ycomp'+newc+'"><option>Select</option><?php echo $comp_list;?></select></td>'+
            // '<td><input type="text" class="form-control" name="consumption_val[]" id="consumption_val'+newc+'"></td>' +
            // '<td><input type="text" class="form-control" name="consumption_per[]" id="consumption_per'+newc+'" placeholder="(%)" onkeyup="cal_yarn_pcs('+newc+');"></td>' +
            '<td><input type="text" class="form-control totl1" id="pcs_weight'+newc+'" name="pcs_weight[]" placeholder="PCs Wt" onkeyup="cal_amount1('+newc+');"></td>' +
            '<td><select class="select2 form-control custom-select" name="uom[]" id="uom'+newc+'"><option>Select</option><?php echo $uom_list;?></select></td>' +
            '<td><input type="text" class="form-control" id="yrate'+newc+'" name="yrate[]" placeholder="Rate" onkeyup="cal_amount('+newc+');"></td>' +
            '<td><input type="text" class="form-control totl" id="ytotal'+newc+'" placeholder="Total" name="ytotal[]" value="0"></td>' +
			'<td><a class="delete" title="Delete" ><button type="button" class="btn btn-info add-new"><i class="fa fa-minus"></i></button></a></td>' +
        '</tr>';
    	$("table").append(row);
		$("table tbody tr").eq(index + 1).find(".add, .edit").toggle();
        $('[data-toggle="tooltip"]').tooltip();
    });

	// Add row on add button click
	$(document).on("click", ".add", function(){
		var empty = false;
		var input = $(this).parents("tr").find('input[type="text"]');
        input.each(function(){
		});
		$(this).parents("tr").find(".error").first().focus();
		if(!empty){
			input.each(function(){
				$(this).parent("td").html($(this).val());
			});
			$(this).parents("tr").find(".add, .edit").toggle();
			$(".add-new").removeAttr("disabled");
			sum_grand();
		}
    });
	// Edit row on edit button click
	$(document).on("click", ".edit", function(){
        $(this).parents("tr").find("td:not(:last-child)").each(function(){
			$(this).html('<input type="text" class="form-control" value="' + $(this).text() + '">');
		});
		$(this).parents("tr").find(".add, .edit").toggle();
		$(".add-new").attr("disabled", "disabled");
		sum_grand();
    });
	// Delete row on delete button click
	$(document).on("click", ".delete", function(){
        $(this).parents("tr").remove();
		//$(".add-new").removeAttr("disabled");
		sum_grand();
    });
});

// To get buyer short name for costing number
function sum_grand() {
    var sum = 0;
    $('.totl').each(function () {
        var value = parseFloat($(this).val());
        if (!isNaN(value)) {
            sum += value;
        }
    });

    $('#grand_total').val(sum);
}

function sum_grand1(){
	var sum = 0;
	$('.totl1').each(function(){
		sum += parseFloat($(this).val());  // Or this.innerHTML, this.innerText
	});
	if(sum==NaN){
		$('#total_weight1').val('0');	
	} else {
		$('#total_weight1').val(sum);
	}
}

function buyer_costing(sh_name){
    var sname = sh_name.split('~~');
    var cno = $('#cost_no').val();
    var buyer_name = sname[0]; // Get the buyer name

    // Extract the first 5 characters of the buyer name
    var firstFive = buyer_name.substring(0, 12);

    // Concatenate the first 5 characters of the buyer name with the existing cno
    var nc = firstFive + "-" + cno;

    $('#costing_no').val(nc);
    sum_grand();
}


// function cal_yarn_pcs(id){
//     var t1 = document.getElementById('consumption_val'+id).value;
// 	var t2 = document.getElementById('consumption_per'+id).value;
//     var t3 = ((parseFloat(t1))*(parseFloat(t2)/100));
// 	document.getElementById('pcs_weight'+id).value=parseFloat(t3).toFixed(3);
// 	//input_sum_calculate_yarn_amount(id);
// 	sum_grand();
// }

function cal_amount(id) {
    var t1 = document.getElementById('pcs_weight'+id).value;
    var t2 = document.getElementById('yrate'+id).value;
    var t3 = parseFloat(t1)*parseFloat(t2);
	document.getElementById('ytotal'+id).value = parseFloat(t3).toFixed(3);
//    input_sum_calculate_yarn();
  sum_grand();
}

function cal_amount1(id) {
    var t1 = document.getElementById('pcs_weight'+id).value;
  
	//  document.getElementById('total_weight1'+id).value = parseFloat(t1).toFixed(3);
  
  sum_grand1();
}

$('#costing_date').datepicker({
	format:'dd-mm-yyyy',
      autoclose: true
    })

function sel_ytype(yt,rw){
	if(yt=='Cora'){
		$('#ycolor'+rw).attr('disabled',true);
	} else {
		$('#ycolor'+rw).attr('disabled',false);
	}
}
</script>
</body>
</html>