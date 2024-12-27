<?php 
include('includes/config.php');
extract($_REQUEST);
if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_REQUEST);
echo "/pre>";*/


if (isset($_POST['save'])) {
    // Check if necessary fields are set
    if (isset($_POST['fabric_name']) && isset($_POST['hsn']) && isset($_POST['dia']) && isset($_POST['gsm']) && isset($_POST['color']) && isset($_POST['pcs_wgt']) && isset($_POST['price']) && isset($_POST['style_no'])) {

        // Fetch the maximum po_no or start with 1 if no records exist
        $query = "SELECT MAX(po_no) AS max_po_no FROM general_po";
        $result = mysqli_query($zconn, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            // Increment the last po_no by 1 to get the new po_no
            $po_no = $row['max_po_no'] + 1;
        } else {
            // If there are no existing po_no records, start with 1
            $po_no = 1;
        }

        // Extract other variables
        $po_date = mysqli_real_escape_string($zconn, $_POST['po_date']);
        $con_name = mysqli_real_escape_string($zconn, $_POST['to_address']);
        $style_no = mysqli_real_escape_string($zconn, $_POST['igst']);
        $order_no = mysqli_real_escape_string($zconn, $_POST['comments']);
        $from = mysqli_real_escape_string($zconn, $_POST['to_process']);

        // Construct and execute the SQL query within a loop
        for ($i = 0; $i < count($_POST['price']); $i++) {
            $fabric_name = mysqli_real_escape_string($zconn, $_POST['fabric_name'][$i]);
            $hsn = mysqli_real_escape_string($zconn, $_POST['hsn'][$i]);
            $dia = mysqli_real_escape_string($zconn, $_POST['dia'][$i]);
            $gsm = mysqli_real_escape_string($zconn, $_POST['gsm'][$i]);
            $color = mysqli_real_escape_string($zconn, $_POST['color'][$i]);
            $wgt = mysqli_real_escape_string($zconn, $_POST['pcs_wgt'][$i]);
            $stock = mysqli_real_escape_string($zconn, $_POST['price'][$i]);
            $delivery_wgt = mysqli_real_escape_string($zconn, $_POST['style_no'][$i]);

            $sql = "INSERT INTO general_po 
                (`po_no`, `po_date`, `to_address`, `comments`, `igst`, `to_process`, `style_no`, `fabric_name`, `pcs_wgt`, `price`, `hsn`, `gsm`, `color`, `dia`, `created_at`)  
                VALUES ('$po_no', NOW(), '$hsn', '$con_name', '$style_no', '$from', '$order_no', '$fabric_name', '$wgt', '$stock', '$dia', '$gsm', '$color', '$delivery_wgt', NOW())";

            if (mysqli_query($zconn, $sql)) {
                echo "Data inserted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($zconn);
            }
        }
    } else {
        echo "Required fields are not set.";
    }
}





//if(isset($_REQUEST['save'])) {
    // Existing code to get max_po_no and retrieve fixed form fields...

    
// Fetch the maximum po_no or start with 1 if no records exist
//$query = "SELECT MAX(po_no) AS max_po_no FROM general_po";
//$result = mysqli_query($zconn, $query);

//if ($result && mysqli_num_rows($result) > 0) {
   // $row = mysqli_fetch_assoc($result);
    // Increment the last po_no by 1 to get the new po_no
   // $po_no = $row['max_po_no'] + 1;
//} else {
    // If there are no existing po_no records, start with 1
  //  $po_no = 1;
//}
	








	
//$style_nos = $_REQUEST['price'];
	//var_dump($style_nos);
	
//for ($i = 0; $i < count($_REQUEST['price']); $i++) {
    // Perform the insertion for e
  // if (!empty($_REQUEST['price'][$i])) {
		
		//echo $_REQUEST['price'][$i]; 
					
	
	 // Construct your SQL INSERT query with actual field names and values
     //  $sql = "INSERT INTO general_po 
     //   (`po_no`, `po_date`, `to_address`, `comments`, `delivery_to`, `cgst`, `sgst`, `igst`, `to_process`, `received_date`, `style_no`, `desc`, `fabric_name`, `yarn_name`, `accessories_name`, `pcs_wgt`, `price`, `content`, `hsn`, `gsm`, `color`, `dia`, `status`, `pay_status`, `created_at`) 
      // VALUES 
    //  ('$po_no','".$_REQUEST['po_date']."', '".$_REQUEST['to_address']."', '".$_REQUEST['comments']."', '".$_REQUEST['delivery_to']."', '".$_REQUEST['cgst']."', '".$_REQUEST['sgst']."', '".$_REQUEST['igst']."', '".$_REQUEST['to_process']."', '".$_REQUEST['received_date']."', '".$_REQUEST['style_no'][$i]."', '".$_REQUEST['desc'][$i]."', '".$_REQUEST['fabric_name'][$i]."', '".$_REQUEST['yarn_name'][$i]."', '".$_REQUEST['accessories_name'][$i]."', '".$_REQUEST['pcs_wgt'][$i]."', '".$_REQUEST['price'][$i]."', '".$_REQUEST['content'][$i]."', '".$_REQUEST['hsn'][$i]."', '".$_REQUEST['gsm'][$i]."', '".$_REQUEST['color'][$i]."', '".$_REQUEST['dia'][$i]."','pending', 'pending',NOW())";
						//    }
	
						
					//}
	//var_dump($_REQUEST);
	//print_r($sql);
						
						
					//	if (!mysqli_query($zconn, $sql)) {
           // echo "Error: " . $sql . "<br>" . mysqli_error($zconn);
    
						//	}// Handle the error as per your application's logic
   
//}
 // }
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
    <title><?php echo SITE_TITLE;?> - General PO</title>
    <!-- Custom CSS -->
	<!--  datatables CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">    
    <link href="dist/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="dist/css/style.min.css" rel="stylesheet"> 
	<link href="dist/css/bootstrap-datepicker.css" rel="stylesheet">
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
	<link href="https://cdn.rawgit.com/harvesthq/chosen/gh-pages/chosen.min.css" rel="stylesheet"/>
	<script src="dist/js/jquery.min.js"></script>
	<script src="dist/js/chosen.jquery.min.js"></script>
	<style>
		th{font-size:12px; font-weight:bold; background-color:#626F80; text-align:center;}
	</style>

<style>
        /* CSS for the container */
        .scroll-container {
            width: 100%; /* Set the width as needed */
            overflow-x: auto; /* Enable horizontal scrolling */
        }
    </style>
	
	


</head>

<body>
    <div id="main-wrapper">
        <!-- Topbar header - style you can find in pages.scss -->
        <?php include('includes/header.php');?>
        <!-- End Topbar header -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
		<?php include('includes/sidebar.php');?>
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- Page wrapper  -->
        <div class="page-wrapper">
            <!-- Bread crumb and right sidebar toggle -->
             <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h4 class="page-title">Geaneral PO</h4>
                    </div>
                </div>
            </div>
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- Container fluid  -->
            <div class="container-fluid">
            <form name="costing_list" id="costing_list" method="post">
<!--==============================================================-->
                <!-- Sales chart -->

               
				<div class="card" style="width:100%">
				<div class="card-body" style="width:100%">
					<div class="card" style="width:50%; float:left; left: 50px; ">
					
					  <input type="hidden" name="dynamicRowData" id="hiddenFieldForDynamicRows">


						<div class="form-group row">
							<label for="fname" class="col-sm-3 text-right control-label col-form-label">PO No</label>
						<div class="col-sm-6">
							<?php
							$po = mysqli_fetch_array(mysqli_query($zconn,"select max(po_no) as id from general_po"));
							$id=$po['id']+1;
							?>
							<input type="text" autocomplete="off" required class="form-control" id="po" name="po_no"  name="costing_date" value="<?php echo $id;?>"  >
						</div>
						</div>
					<div class="form-group row">
						<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Yarn PO Date</label>
						<div class="col-sm-6">
							<input type="text" autocomplete="off" required class="form-control" id="po_date"  name="po_date" value="<?php echo date('d/m/Y');?>" >
						</div>
					</div>
					<div class="form-group row">
					<div id="supp_msg" class="col-sm-6 text-right" style="color:red; font-size:12px;"></div></div>
						<div class="form-group row">
								<label for="lname" class="col-sm-3 text-right control-label col-form-label">To Address</label>
								<div class="col-sm-6" >
									<span id="supp_list">
									<select class="select2 form-control custom-select " id="to_address" name="to_address" required>
									<option value="">--Select--</option>
									<?php 
				$tocompe = mysqli_query($zconn,"SELECT * FROM  `suppliers` where status='0'");
					 while($tocompe_res=mysqli_fetch_object($tocompe)){ ?>
						<option value="<?php echo $tocompe_res->supplier_name;?>"><?php echo $tocompe_res->supplier_name;?></option>
					<?php }?>
										 </select>
										
										</span>

										</div>
									</div>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Received Date</label>
										<div class="col-sm-6">
											<input type="date" class="form-control" id="receive_date" name="received_date" autocomplete="off" required>
										</div>
									</div>
			



									<div class="form-group row">
										
									</div>
						</div>
						<div class="card" style="width:50%; float:left; right: 50px;">
				
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Comments</label>
										<div class="col-sm-6">
											<input type="text" class="form-control" id="comments" name="comments"  placeholder="Comments" >
										</div>
									</div>
									<div class="form-group row">
										<label for="fname" class="col-sm-3 text-right control-label col-form-label" >Deleivery To</label>
										
										<div class="col-sm-6" >
									<span id="supp_list">
									<select class="select2 form-control custom-select chosen-select" id="delivery" name="delivery_to" required>
									<option value="">--Select--</option>
									<?php 
				$tocompe = mysqli_query($zconn,"SELECT * FROM  `process_customer` where status='0'");
					 while($tocompe_res=mysqli_fetch_object($tocompe)){ ?>
						<option value="<?php echo $tocompe_res->party_name;?>">
						<?php echo $tocompe_res->party_name;?></option>
					<?php }?>
										 </select>
										 <script type="text/javascript">
												$(".chosen-select").chosen({
											  	no_results_text: "Oops, nothing found!"
												})
											</script>
										</span>

										</div>
										
									</div>
									<div id="div1" style="display: none;">
									<?php 
									$state = mysqli_query($zconn,"SELECT * FROM  `suppliers` where state_id='21'");
									?>
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">CGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" id="cgst" name="cgst" autocomplete="off" required placeholder="style no" value="0"> -->
											<select class="select2 form-control custom-select" id="cgst" name="cgst" >
									<option value="0">--Select--</option>
									<?php 
				$tocompe1 = mysqli_query($zconn,"SELECT * FROM  `gst` where gst_name='cgst'");
					 while($tocompe_res1=mysqli_fetch_object($tocompe1)){ ?>
						<option value="<?php echo $tocompe_res1->gst_value;?>">
						<?php echo $tocompe_res1->gst_value;?></option>
					<?php }?>
										 </select>
										</div>
									</div>
									
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">SGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" id="sgst" name="sgst" autocomplete="off" required placeholder="style no" value="0"> -->
											<select class="select2 form-control custom-select" id="sgst" name="sgst" >
									<option value="0">--Select--</option>
									<?php 
				$tocompe2 = mysqli_query($zconn,"SELECT * FROM  `gst` where gst_name='sgst'");
					 while($tocompe_res2=mysqli_fetch_object($tocompe2)){ ?>
						<option value="<?php echo $tocompe_res2->gst_value;?>">
						<?php echo $tocompe_res2->gst_value;?></option>
					<?php }?>
										 </select>
										</div>
									</div>
									</div>
									<div id="div2" style="display: none;">
									<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">IGST(%)</label>
										<div class="col-sm-6">
											<!-- <input type="text" class="form-control" id="igst" name="igst" autocomplete="off" required placeholder="style no" value="0"> -->
											<select class="select2 form-control custom-select" id="igst" name="igst" >
									<option value="0">--Select--</option>
									<?php 
				$tocompe3 = mysqli_query($zconn,"SELECT * FROM  `gst` where gst_name='igst'");
					 while($tocompe_res3=mysqli_fetch_object($tocompe3)){ ?>
						<option value="<?php echo $tocompe_res3->gst_value;?>">
						<?php echo $tocompe_res3->gst_value;?></option>
					<?php }?>
										 </select>
										</div>
									</div>
									</div>
							
			<div class="form-group row">
    <label for="selectOption" class="col-sm-3 text-right control-label col-form-label">To Process</label>
    <div class="col-sm-6">
        <select class="form-control" id="selectOption" name="to_process">
            <option value="">Select</option>
			
            <option value="fabric">Fabric</option>
            <option value="yarn">Yarn</option>
            <option value="store">Store</option>
            <option value="others">Others</option>
        </select>
    </div>
</div>
						</div>
					</div>
					<?php

	
		//if($bal!=0){

				
	?>
						<div id="fabricTable" style="display:none;">
    <!-- Fabric table content here -->
    <legend>Fabric Details</legend>
                            
                            <div class="row-fluid">
                            <div class="span12">
                                <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>STYLE NO</th>			
                <th>FABRIC NAME</th>
                <th>PARTICULARS</th>
                <th>HSN</th>
                <th>GSM</th>
				   <th>DIA</th>
                <!--th scope="col" width="14%">COMBO</th-->
                <th>COLOR</th>
                <th>WGT</th>
                <th>RATE</th>
				
             
    <th width="5%">
                    <!--a href="#" onclick="addRow()">
                        <i class="fas fa-plus-circle fa-lg"></i>
                    </a-->
                    <button type="button" class="btn btn-danger btn-sm ml-2" onclick="addRow()"><i class="fas fa-plus-circle fa-lg"></i></button>
                </th>			</tr>
        </thead>
        <tbody id="fabricTableBody">
            <tr>
                <td><input name="style_no[]" type="text" class="form-control" /></td>
                <td><input name="fabric_name[]" type="text" class="form-control" /></td>
                <td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>
                <td><input name="hsn[]" type="text" class="form-control" /></td>
                <td><input name="gsm[]" type="text" class="form-control" /></td>
				<td><input name="dia[]" type="text" class="form-control" /></td>
                <!--td>
                    <select name="color[]" class="form-control">
                        
                    </select>
                </td-->
                <td><input name="color[]" type="text" class="form-control" /></td>
                <td><input name="pcs_wgt[]" type="text" class="form-control" /></td>
                  <td><input name="price[]" type="text" class="form-control" /></td>
              
            </tr>
          
        </tbody>
    </table>								</div>
							</div>
                           </div>

<div id="yarnTable" style="display:none;">
    <!-- Yarn table content here -->
	
      <legend>Yarn Details</legend>
                            
                            <div class="row-fluid">
                            <div class="span12">
                                <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>STYLE NO</th>			
                <th>FABRIC NAME</th>
                <th>YARN NAME</th>
                <th>PARTICULARS</th>
				  <th>CONTENT</th>
                <th>HSN</th>
                <th>GSM</th>
				   <th>DIA</th>
                <!--th scope="col" width="14%">COMBO</th-->
                <th>COLOR</th>
                <th>WGT</th>
                <th>RATE</th>
				
             
    <th width="5%">
                    <!--a href="#" onclick="addRow()">
                        <i class="fas fa-plus-circle fa-lg"></i>
                    </a-->
                    <button type="button" class="btn btn-danger btn-sm ml-2" onclick="addRow()"><i class="fas fa-plus-circle fa-lg"></i></button>
                </th>			</tr>
        </thead>
        <tbody id="yarnTableBody">
            <tr>
                <td><input name="style_no[]" type="text" class="form-control" /></td>
                <td><input name="fabric_name[]" type="text" class="form-control" /></td>
                <td><input name="yarn_name[]" type="text" class="form-control" /></td>
                <td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>
                <td><input name="content[]" type="text" class="form-control" /></td>
				
                <td><input name="hsn[]" type="text" class="form-control" /></td>
                <td><input name="GSM[]" type="text" class="form-control" /></td>
				<td><input name="dia[]" type="text" class="form-control" /></td>
                <!--td>
                    <select name="color[]" class="form-control">
                        
                    </select>
                </td-->
                <td><input name="color[]" type="text" class="form-control" /></td>
                <td><input name="pcs_wgt[]" type="text" class="form-control" /></td>
                  <td><input name="price[]" type="text" class="form-control" /></td>
              
            </tr>
          
        </tbody>
    </table>								</div>
							</div>
  
</div>

<div id="storeTable" style="display:none;">
    <!-- Store table content here -->
    <legend>Store Details</legend>
                            
                            <div class="row-fluid">
                            <div class="span12">
                                <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>STYLE NO</th>			
                <th>ACCESSARIES NAME</th>
                <th>PARTICULARS</th>
                
                <!--th scope="col" width="14%">COMBO</th-->
                
                <th>Qty</th>
                <th>RATE</th>
				
             
    <th width="5%">
                    <!--a href="#" onclick="addRow()">
                        <i class="fas fa-plus-circle fa-lg"></i>
                    </a-->
                    <button type="button" class="btn btn-danger btn-sm ml-2" onclick="addRow()"><i class="fas fa-plus-circle fa-lg"></i></button>
                </th>			</tr>
        </thead>
        <tbody id="storeTableBody">
            <tr>
                <td><input name="style_no[]" type="text" class="form-control" /></td>
                <td><input name="accessories_name[]" type="text" class="form-control" /></td>
                <td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>
                
               
                <td><input name="pcs_wgt[]" type="text" class="form-control" /></td>
                  <td><input name="price[]" type="text" class="form-control" /></td>
              
            </tr>
          
        </tbody>
    </table>								</div>
							</div>

</div>

<div id="othersTable" style="display:none;">
    <!-- Others table content here -->
    <legend>Other Details</legend>
                            
                            <div class="row-fluid">
                            <div class="span12">
                                <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
              
                <th>PARTICULARS</th>
               
                <th>QTY</th>
                <th>RATE</th>
				
             
    <th width="5%">
                    <!--a href="#" onclick="addRow()">
                        <i class="fas fa-plus-circle fa-lg"></i>
                    </a-->
                    <button type="button" class="btn btn-danger btn-sm ml-2" onclick="addRow()"><i class="fas fa-plus-circle fa-lg"></i></button>
                </th>			</tr>
        </thead>
        <tbody id="othersTableBody">
            <tr>
             
                <td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>
               
                <td><input name="pcs_wgt[]" type="text" class="form-control" /></td>
                  <td><input name="price[]" type="text" class="form-control" /></td>
              
            </tr>
          
        </tbody>
    </table>								</div>
							</div>

</div>
					
					
					
					<div class="border-top">
						<div class="card-body" style="margin-left: 500px;">
							<!-- <button type="submit" name="save" class="btn btn-success">Save</button> -->
							<button type="submit" name="save" class="btn btn-success">Save
								<!-- <a href="javascript:;" onclick="costing_sheet(<?php echo $coldata['id']; ?>);">Print</a> -->
							</button>
							<button type="reset" class="btn btn-primary">Reset</button>
							<a href="yarn_po_list.php"><button type="button" class="btn btn-danger">Back</button></a>
						</div>
						
					</div>

					<?php
			//}
				//} ?>
				</div>
                <!-- Sales chart -->
            </div>
            <!-- End Container fluid  -->
            <!-- footer -->
           <?php include('includes/footer.php');?>
            <!-- End footer -->
        </div>
        <!-- End Page wrapper  -->
    </div>
</form>
<br>
<br>
<br>
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <script src="assets/libs/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="assets/libs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="assets/libs/perfect-scrollbar/dist/perfect-scrollbar.jquery.min.js"></script>
    <!--Wave Effects -->
    <!--Menu sidebar -->
    <script src="dist/js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="dist/js/custom.min.js"></script>
	<!--datatables JavaScript -->
	<script src="dist/js/bootstrap-datepicker.js"></script>
    <script src="dist/js/jquery.dataTables.min.js"></script>
    <script src="dist/js/dataTables.bootstrap4.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


<script>
    $(document).ready(function () {
        $('#selectOption').change(function () {
            var selectedOption = $(this).val();
            $('div[id$="Table"]').hide(); // Hide all tables
            $('#' + selectedOption + 'Table').show(); // Show the selected table
        });
    });
</script>

	<!-- Bootstrap JS and jQuery CDN links -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
       // function addRow() {
           
       // }
    </script>


<script>
    function addRow() {
        // ... (existing code to add rows)
		
		
		 var selectedOption = document.getElementById('selectOption').value;
            var numCols = 0;

            // Determine the number of columns based on the selected table
  if (selectedOption === 'fabric') {
                numCols = 9;
            } else if (selectedOption === 'yarn') {
                numCols = 11;
            } else if (selectedOption === 'store') {
                numCols = 5; // Change this for Table 3
            } else if (selectedOption === 'others') {
                numCols = 3; // Change this for Table 4
            }
            var tblBody = document.getElementById(selectedOption + 'TableBody');
            var newRow = tblBody.insertRow();

            for (var i = 0; i < numCols; i++) {
                var cell = newRow.insertCell();
                var input = document.createElement('input');
                input.type = 'text';
                input.name = selectedOption + 'Column[]';
                input.className = 'form-control';
                cell.appendChild(input);
            }

            var removeCell = newRow.insertCell();
            var removeBtn = document.createElement('button');
            removeBtn.className = 'btn btn-danger';
            removeBtn.innerHTML = '<i class="fas fa-minus-circle"></i>';
            removeBtn.onclick = function () {
                var row = this.parentNode.parentNode;
                row.parentNode.removeChild(row);
            };
            removeCell.appendChild(removeBtn);

    // Find or create a hidden input field in the form to store dynamically added row values
        var hiddenField = document.getElementById('hiddenFieldForDynamicRows');

        // Serialize the values of dynamically added rows and store them in the hidden field
        var serializedRows = JSON.stringify(getSerializedRows());
        hiddenField.value = serializedRows;
    }

    // Function to serialize the dynamically added rows
    function getSerializedRows() {
        var selectedOption = document.getElementById('selectOption').value;
        var numCols = 0;

        // Determine the number of columns based on the selected table
        if (selectedOption === 'fabric') {
            numCols = 9;
        } else if (selectedOption === 'yarn') {
            numCols = 11;
        } else if (selectedOption === 'store') {
            numCols = 5; // Change this for Table 3
        } else if (selectedOption === 'others') {
            numCols = 3; // Change this for Table 4
        }

        var tblBody = document.getElementById(selectedOption + 'TableBody');
        var rows = tblBody.getElementsByTagName('tr');
        var serializedData = [];

        // Loop through the rows and collect values
        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('input');
            var rowData = {};

            for (var j = 0; j < numCols; j++) {
                rowData['column_' + j] = cells[j].value;
            }

            serializedData.push(rowData);
        }

        return serializedData;
    }
</script>

	
	
	
		<script>
	$(document).ready(function() {
		$('#example').DataTable();
	});

	function DeleteUsrId(ID){
	  var UsrStatus = confirm("Are you sure to delete this company details ?");
	  if(UsrStatus){
	  $('#delete_'+ID).hide();
	  }
	}

	function fill_qty(rw){
		if($('#chk_'+rw).is(":checked")){
			$('#counts'+rw).attr("required", "required");
			$('#now'+rw).attr("required", "required");
			$('#rate'+rw).attr("required", "required");
		} else {
			$('#counts'+rw).removeAttr("required");
			$('#now'+rw).removeAttr("required");
			$('#rate'+rw).removeAttr("required");
		}
		var tq = document.getElementById('counts'+rw).value;
		var bal = document.getElementById('consumption'+rw).value;
	}

	


function calculateWeight(rowId) {
    var bagValue = parseFloat(document.getElementById("bag" + rowId).value) || 0;
    var totalBagValue = parseFloat(document.getElementById("total_bag" + rowId).value) || 0;
    var totalQuantity = bagValue * totalBagValue;

    // Update the "now" input field for the current row with the calculated total quantity
    var nowTotalInput = document.getElementById('now' + rowId);
    nowTotalInput.value = totalQuantity;

    // Initialize variables for the row's total and the grand total
    var rowTotal = 0;
    var grandTotal = 0;

    var nowValue = parseFloat(nowTotalInput.value);
    var balQty = parseFloat(document.getElementById('balqty' + rowId).value);

    if (!isNaN(nowValue)) {
        if (nowValue <= balQty) {
            var remainingBalance = balQty - nowValue;
            $('#balance' + rowId).val(remainingBalance);
            rowTotal += nowValue; // Calculate the row's total
        } else {
            // Set the balance to 0 if nowValue is greater than balQty
            $('#balance' + rowId).val(0);
            alert("Warning , Enter po qty excess than planning qty for row " + rowId);
            nowTotalInput.value = nowValue.toFixed(2); // Set the "now" input to the current row's value
        }
    }

    // Loop through all rows to calculate the grand total
    $('input[name^="now"]').each(function(index, element) {
        var inputValue = parseFloat(element.value) || 0;
        grandTotal += inputValue;
    });

    // Update the "grant_total" input field for the grand total
    document.getElementById("grant_total").value = grandTotal;

    // Here, you can return the row's total if needed.
    return rowTotal;
}



	
		function check_rate(id){
			var or_price = $('#rate1'+id).val();
			var nw_price = $('#rate'+id).val();
			if(parseFloat(nw_price)>parseFloat(or_price)){
				alert("Rate less then or equal to "+or_price);
				$('#rate'+id).val(or_price);
				return false;
			}
		}

 </script>
 <script>
	$(document).ready(function() {
  $('#to_address').on('change', function() {
    var selectedOption = $(this).val();

    // Send AJAX request to PHP script
    $.ajax({
      url: 'gst_show.php',
      type: 'POST',
      data: { option: selectedOption },
      success: function(response) {
		//alert(response)
        // Handle the response from the PHP script
        if (response === 'div1') {
          $('#div1').show();
          $('#div2').hide();
        } else if (response === 'div2') {
          $('#div1').hide();
          $('#div2').show();
        } else {
          $('#div1').hide();
          $('#div2').hide();
        }
      },
      error: function(xhr, status, error) {
        console.log(error);
      }
    });
  });
});

// function updateBalanceQty(rowId) {
//     $.ajax({
//         url: 'update_balance_qty.php',
//         type: 'POST',
//         data: { rowId: rowId },
//         success: function(data) {
//             // Update the balance quantity in the frontend
//             var updatedBalanceQty = parseFloat(data.balance_qty);
//             var balanceInput = document.getElementById('balance' + rowId);
//             balanceInput.value = updatedBalanceQty;
//         },
//         error: function(error) {
//             console.error('Failed to update balance_qty:', error);
//         }
//     });
// }

 </script>
</body>
</html>