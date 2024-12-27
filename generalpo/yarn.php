
<?php
											if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the form was submitted
    if (isset($_POST['save'])) {
        // Get data from the form
        if (isset($_POST['style_no']) && isset($_POST['desc']) && isset($_POST['fabric_name']) && isset($_POST['yarn_name']) && isset($_POST['content']) && isset($_POST['hsn'])&& isset($_POST['gsm']) && isset($_POST['pcs_wgt']) && isset($_POST['price']) && isset($_POST['color']) && isset($_POST['dia'])) {

			//if ($stock2 > 0) {
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
            $to_address = mysqli_real_escape_string($zconn, $_POST['to_address']);
            
            $comments = mysqli_real_escape_string($zconn, $_POST['comments']);
            $delivery_to = mysqli_real_escape_string($zconn, $_POST['delivery_to']);
            
            $received_date = mysqli_real_escape_string($zconn, $_POST['received_date']);
            $cgst = mysqli_real_escape_string($zconn, $_POST['cgst']);
            $sgst = mysqli_real_escape_string($zconn, $_POST['sgst']);
            $igst = mysqli_real_escape_string($zconn, $_POST['igst']);
			
		
			
			

            // Construct and execute the SQL query within a loop
            for ($i = 0; $i < count($_POST['style_no']); $i++) {
                // Get data from the arrays
                $style_no = mysqli_real_escape_string($zconn, $_POST['style_no'][$i]);

                $fabric_name = mysqli_real_escape_string($zconn, $_POST['fabric_name'][$i]);
                $yarn_name = mysqli_real_escape_string($zconn, $_POST['yarn_name'][$i]);
				
                $desc = mysqli_real_escape_string($zconn, $_POST['desc'][$i]);
                $content = mysqli_real_escape_string($zconn, $_POST['content'][$i]);
                $hsn = mysqli_real_escape_string($zconn, $_POST['hsn'][$i]);
				
                $dia = mysqli_real_escape_string($zconn, $_POST['dia'][$i]);
                $gsm = mysqli_real_escape_string($zconn, $_POST['gsm'][$i]);
                $color = mysqli_real_escape_string($zconn, $_POST['color'][$i]);
                $pcs_wgt = mysqli_real_escape_string($zconn, $_POST['pcs_wgt'][$i]);
                $price = mysqli_real_escape_string($zconn, $_POST['price'][$i]);


              // Construct the SQL query
$sql = "INSERT INTO  `general_po`(`po_no`, `po_date`, `received_date`,`to_address`, `comments`, `delivery_to`, 
`to_process`, `cgst`,`sgst`,`igst`, `style_no`, `desc`, `fabric_name`,`yarn_name`,  `pcs_wgt`, `price`, `content`,`hsn`, 
`gsm`, `color`, `dia`, `status`, `pay_status`)
  VALUES ('$po_no',  NOW(), '$received_date','$to_address', '$comments', '$delivery_to', '$to_process','$cgst','$sgst','$igst','$style_no', 
  '$desc', '$fabric_name','$yarn_name', '$pcs_wgt', '$price', '$content', '$hsn', '$gsm', '$color', '$dia','pending','pending')";



                // Execute the query
                if (mysqli_query($zconn, $sql)) {
                    echo "Data inserted successfully!";
                } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($zconn);
                }
				 }
            } 
			else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($zconn);
				
                             // Display a JavaScript alert as a warning
               // echo '<script>alert("Warning: Stock is not positive. Data not inserted.");</script>';
            }
            //}

            // Close the database connection
            // mysqli_close($zconn);
      //  }
    }
}



echo'

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
                   <th>COLOR</th>
                <th>WGT</th>
                <th>RATE</th>
				
<th width="5%">
    <button type="button" class="btn btn-danger btn-sm ml-2" onclick="addRow1()">
        <i class="fas fa-plus-circle fa-lg"></i>
    </button>
</th>


				</tr>
        </thead>
        <tbody id="yarnTableBody">
            <tr>
                <td><input name="style_no[]" type="text" class="form-control" /></td>
                <td><input name="fabric_name[]" type="text" class="form-control" /></td>
                <td><input name="yarn_name[]" type="text" class="form-control" /></td>
                <td><textarea name="desc[]" class="form-control" rows="2"></textarea></td>
                <td><input name="content[]" type="text" class="form-control" /></td>
				
                <td><input name="hsn[]" type="text" class="form-control" /></td>
                <td><input name="gsm[]" type="text" class="form-control" /></td>
				<td><input name="dia[]" type="text" class="form-control" /></td>
              
                <td><input name="color[]" type="text" class="form-control" /></td>
                <td><input name="pcs_wgt[]" type="text" class="form-control" /></td>
                  <td><input name="price[]" type="text" class="form-control" /></td>
				  <td><button type="button" class="btn btn-danger btn-sm ml-2" onclick="removeRow1(this)"><i class="fas fa-minus-circle fa-lg"></i></button></td>
              
            </tr>
          
        </tbody>
    </table>	
					               
			
								</div>
							</div>
								
  '; ?>
<div class="border-top">
						<div class="card-body" style="margin-left: 500px;">
							<!-- <button type="submit" name="save" class="btn btn-success">Save</button> -->
							<button type="submit" name="save" class="btn btn-success">Save
								<!-- <a href="javascript:;" onclick="costing_sheet(<?php echo $coldata['id']; ?>);">Print</a> -->
							</button>
							<button type="reset" class="btn btn-primary">Reset</button>
							<a href="yarn_po_list.php"><button type="button" class="btn btn-danger">Back</button></a>
						</div>