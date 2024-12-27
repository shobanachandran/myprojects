<?php 
include('includes/config.php');
extract($_REQUEST);
if($_SESSION['userid']==''){
	echo "<script>window.location.href='login.php';</script>";
}

/*echo "<pre>";
print_r($_REQUEST);
echo "/pre>";*/
    // Fetch the maximum po_no
    $query = "SELECT MAX(po_no) AS max_po_no FROM general_po";
    $result = mysqli_query($zconn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $po_no = $row['max_po_no'] + 1;
    } else {
        $po_no = 1;
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
    <label for="selectOption" class="col-sm-3 text-right control-label col-form-label">To Process</label>
    <div class="col-sm-6">
    <!-- Your form -->
 <!-- HTML form with JavaScript to retain selected option -->
<!-- Your form with the dropdown -->
<form method="post" action="">
    <select class="form-control" id="selectOption" name="to_process" onchange="this.form.submit()">
        <option value="">Select</option>
        <option value="fabric" <?php echo ($_POST['to_process'] === 'fabric') ? 'selected' : ''; ?>>Fabric</option>
        <option value="yarn" <?php echo ($_POST['to_process'] === 'yarn') ? 'selected' : ''; ?>>Yarn</option>
        <option value="store" <?php echo ($_POST['to_process'] === 'store') ? 'selected' : ''; ?>>Store</option>
        <option value="others" <?php echo ($_POST['to_process'] === 'others') ? 'selected' : ''; ?>>Others</option>
		
		
        <!-- Add other options here -->
    </select>
</form>
				</div>
							</div>
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
										
									</div>
						</div>
						<div class="card" style="width:50%; float:left; right: 50px;">
				<div class="form-group row">
										<label for="cono1" class="col-sm-3 text-right control-label col-form-label">Received Date</label>
										<div class="col-sm-6">
											<input type="date" class="form-control" id="receive_date" name="received_date" autocomplete="off" required>
										</div>
									</div>
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
							
		
					</div>
					</div>
<!-- PHP code to display based on selection after form submission -->
<?php
if (isset($_POST['to_process']) && $_POST['to_process'] !== '0') {
    $selectedDepartment = $_POST['to_process'];
    if ($selectedDepartment === 'fabric') {
        // Display fabric details form
 		include('generalpo/fabric.php');

    } elseif ($selectedDepartment === 'yarn') {
        // Include a file with yarn details
        include('generalpo/yarn.php');
    } else if ($selectedDepartment === 'store'){ 
        // Add other conditions as needed
		        include('generalpo/store.php');

    } else{
		        include('generalpo/others.php');

		
	}
}
							 

										 

											 
											
							

                                      //   }

    ?>


</div>
	    </div>
</div>
						</div>
					</div>


					
					
					
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
      function addRow() {
    const tableBody = document.getElementById('fabricTableBody');
    const newRow = document.createElement('tr');

    // Create table cells (td) for each input field
    const cells = [
        '<td><input name="style_no[]" type="text" class="form-control" /></td>',
        '<td><input name="fabric_name[]" type="text" class="form-control" /></td>',
        '<td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>',
        '<td><input name="hsn[]" type="text" class="form-control" /></td>',
        '<td><input name="gsm[]" type="text" class="form-control" /></td>',
        '<td><input name="dia[]" type="text" class="form-control" /></td>',
		'<td><input name="color[]" type="text" class="form-control" /></td>',
		'<td><input name="pcs_wgt[]" type="text" class="form-control" /></td>',
		'<td><input name="price[]" type="text" class="form-control" /></td>',
		' <td><button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeRow(this)"><i class="fas fa-minus-circle fa-lg"></i></button></td>',
        // Add other fields similarly...
    ];

    // Combine cells and append them to the new row
    newRow.innerHTML = cells.join('');
    tableBody.appendChild(newRow);
}
		 function removeRow(button) {
        const row = button.closest('tr');
        row.remove();
    }
		

    </script>


<script>
    function addRow1() {
        const tableBody = document.getElementById('yarnTableBody');
        const newRow = document.createElement('tr');

        // Create table cells (td) for each input field
        const cells = [
            '<td><input name="style_no[]" type="text" class="form-control" /></td>',
            '<td><input name="fabric_name[]" type="text" class="form-control" /></td>',
            '<td><input name="yarn_name[]" type="text" class="form-control" /></td>',
            '<td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>',
            '<td><input name="content[]" type="text" class="form-control" /></td>',
            '<td><input name="hsn[]" type="text" class="form-control" /></td>',
            '<td><input name="gsm[]" type="text" class="form-control" /></td>',
            '<td><input name="dia[]" type="text" class="form-control" /></td>',
            '<td><input name="color[]" type="text" class="form-control" /></td>',
            '<td><input name="pcs_wgt[]" type="text" class="form-control" /></td>',
            '<td><input name="price[]" type="text" class="form-control" /></td>',
			' <td><button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeRow1(this)"><i class="fas fa-minus-circle fa-lg"></i></button></td>'
			 
            // Add other fields similarly...
        ];

        // Combine cells and append them to the new row
        newRow.innerHTML = cells.join('');
        tableBody.appendChild(newRow);
	}
 
	 function removeRow1(button) {
        const row = button.closest('tr');
        row.remove();
    }
	
	
	
		</script>


<script>
    function addRow2() {
        const tableBody = document.getElementById('storeTableBody');
        const newRow = document.createElement('tr');

        // Create table cells (td) for each input field
        const cells = [
            '<td><input name="style_no[]" type="text" class="form-control" /></td>',
            '<td><input name="accessories_name[]" type="text" class="form-control" /></td>',
           
            '<td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>',
            
            '<td><input name="pcs_wgt[]" type="text" class="form-control" /></td>',
            '<td><input name="price[]" type="text" class="form-control" /></td>',
			' <td><button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeRow(this)"><i class="fas fa-minus-circle fa-lg"></i></button></td>'
			 
            // Add other fields similarly...
        ];

        // Combine cells and append them to the new row
        newRow.innerHTML = cells.join('');
        tableBody.appendChild(newRow);
	}
 
	 function removeRow(button) {
        const row = button.closest('tr');
        row.remove();
    }
	
	
	
		</script>



<script>
    function addRow3() {
        const tableBody = document.getElementById('othersTableBody');
        const newRow = document.createElement('tr');

        // Create table cells (td) for each input field
        const cells = [
            '<td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>',
            '<td><input name="pcs_wgt[]" type="text" class="form-control" /></td>',
            '<td><input name="price[]" type="text" class="form-control" /></td>',
			' <td><button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeRow(this)"><i class="fas fa-minus-circle fa-lg"></i></button></td>'
			 
            // Add other fields similarly...
        ];

        // Combine cells and append them to the new row
        newRow.innerHTML = cells.join('');
        tableBody.appendChild(newRow);
	}
 
	 function removeRow(button) {
        const row = button.closest('tr');
        row.remove();
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



 </script>
</body>
</html>