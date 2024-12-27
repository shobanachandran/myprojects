
 <!-- Add the appropriate action attribute for your form -->
	
							
							
							
							
							<?php


    
        if (isset($_POST['order'])) { // Check if an "order_no" is set in the form
            $orderNo = $_POST['order']; // Use the selected "order" value

            // Fetch data from the cutting_balance table for the selected department and specific order_no
            $query = "SELECT * FROM triming_workdone WHERE `order_no` = '$orderNo'";
            $result = mysqli_query($zconn, $query);

            if ($result) {
                // Process and display the data within the existing table
                echo '<table class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th style="width: 5%">S.NO</th>
                            <th style="width: 10%">ORDER NO</th>';
                
                // Retrieve unique size IDs for the selected order_no
                $uniqueSizeIds = array();

                $sectBrnQry = "SELECT DISTINCT size_id FROM triming_workdone WHERE order_no='" . $_REQUEST['order'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueSizeIds[] = $coldata['size_id'];
                }

                // Create table headers for color names
                echo '<th style="width: 10%">Color</th>';

                // Create table headers for each size ID
                foreach ($uniqueSizeIds as $sizeId) {
                    echo '<th>' . $sizeId . '</th>';
                }

                // Add total column header
                echo '<th>Total</th>
                    </tr>
                </thead>
                <tbody>';

                $i = 1;

                // Initialize arrays to store color-wise totals
                $colorTotals = array();

                // Retrieve unique colors for the selected order_no
                $uniqueColors = array();

                $sectBrnQry = "SELECT DISTINCT color FROM triming_workdone WHERE order_no='" . $_REQUEST['order'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueColors[] = $coldata['color'];
                }

                // Create an array to store color-wise quantities for each size ID
                $colorQuantities = array();

                foreach ($uniqueSizeIds as $sizeId) {
                    $colorQuantities[$sizeId] = array();
                }

                // Retrieve and organize the color-wise quantities for each size ID
                $sectBrnQry = "SELECT * FROM triming_workdone WHERE order_no='" . $_REQUEST['order'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $colorQuantities[$coldata['size_id']][$coldata['color']] = $coldata['qty_val'];
                }

                // Loop through the colors and display quantities for each size ID in rows
                foreach ($uniqueColors as $color) {
                    echo '<tr>';
                    echo '<td style="width: 2%">' . $i . '</td>';
                    echo '<td style="width: 10%">' . $_REQUEST['order'] . '</td>';
                    echo '<td>' . $color . '</td>';

                    // Initialize the color-wise total for this row
                    $colorTotal = 0;

                    // Loop through unique size IDs and display quantities for each color
                    foreach ($uniqueSizeIds as $sizeId) {
                        $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;
                        echo '<td>' . $quantity . '</td>';

                        // Add the quantity to the color-wise total for this row
                        $colorTotal += $quantity;
                    }

                    // Display the color-wise total for this row
                    echo '<td>' . $colorTotal . '</td>';
                    echo '</tr>';
                    $i++;
                }

                echo '</tbody>
                </table>'; ?>
												
<div class="table-responsive">
    <div class="col-12 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Balance Quantity Details</h5>
    </div>
 
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">S.NO</th>
                <th style="width: 10%">Color</th>
                <?php
                // Retrieve unique size IDs for the selected order_no
                $uniqueSizeIds = array();
                $sectBrnQry = "SELECT DISTINCT size_id FROM triming_workdone WHERE order_no='" . $_REQUEST['order'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);
                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueSizeIds[] = $coldata['size_id'];
                }
                // Create table headers for each size ID
                foreach ($uniqueSizeIds as $sizeId) {
                    echo '<th style="width: 5%">' . $sizeId . '</th>';
                }
                // Add a heading for the "Total" column and increase its width
                echo '<th style="width: 10%">Total</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            // Initialize an array to store color-wise totals
            $colorTotals = array();
            // Retrieve unique colors for the selected order_no
            $uniqueColors = array();
            $sectBrnQry = "SELECT DISTINCT color FROM cutting_quantity_details WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);
            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $uniqueColors[] = $coldata['color'];
            }
            // Initialize an array to store the 'bal_qty' for each order, color, and size combination
            $balQtyData = array();
            // Retrieve and organize data from cutting_quantity_details
            $cuttingQuantityData = array();
            $sectBrnQry = "SELECT order_no, color, size_id, qty_val FROM triming_workdone WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);
            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $cuttingQuantityData[$coldata['order_no']][$coldata['color']][$coldata['size_id']] = $coldata['qty_val'];
            }
            // Retrieve and organize data from cutting_balance
            $cuttingBalanceData = array();
            $sectBrnQry = "SELECT order_no, color, size_id, SUM(qty_val) AS total_qty FROM checking_workassign1 WHERE order_no='" . $_REQUEST['order'] . "' GROUP BY order_no, color, size_id";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);
            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $cuttingBalanceData[$coldata['order_no']][$coldata['color']][$coldata['size_id']] = $coldata['total_qty'];
            }
            // Loop through the colors and display quantities for each size ID in rows
            foreach ($uniqueColors as $color) {
                echo '<tr>';
                echo '<td style="width: 2%">' . $i . '</td>';
                echo '<td>' . $color . '</td>';
                // Initialize the color-wise total for this row
                $colorTotal = 0;
                // Loop through unique size IDs and create input fields for each color and size combination
                foreach ($uniqueSizeIds as $sizeId) {
                    // Calculate 'bal_qty' for this order, color, and size combination
                    $cuttingQuantity = isset($cuttingQuantityData[$_REQUEST['order']][$color][$sizeId]) ? $cuttingQuantityData[$_REQUEST['order']][$color][$sizeId] : 0;
                    $cuttingBalance = isset($cuttingBalanceData[$_REQUEST['order']][$color][$sizeId]) ? $cuttingBalanceData[$_REQUEST['order']][$color][$sizeId] : 0;
                    $balQty = $cuttingQuantity - $cuttingBalance;
                    $balQtyData[$_REQUEST['order']][$color][$sizeId] = $balQty;
                    // Display 'bal_qty' in the table
                    echo '<td>' . $balQty . '</td>';
                }
                // Display the color-wise total for this row
                echo '<td>' . $colorTotal . '</td>';
                echo '</tr>';
                $i++;
            }
            ?>
        </tbody>
    </table>
</div>
				
               <?php // Include the second <div> block here
                echo '
				<div class="table-responsive">
                    <div class="col-12 d-flex no-block align-items-center">
                        <h5 class="page-title" style="margin-left: 390px;">Enter Quantity Details</h5>
                    </div>
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th style="width: 5%">S.NO</th>
                                    <th style="width: 10%">ORDER NO</th>';
                
                // ... (Rest of your code for the second table headers) ...
				 $uniqueSizeIds = array();

                    $sectBrnQry = "SELECT DISTINCT size_id FROM triming_workdone WHERE order_no='" . $_REQUEST['order'] . "'";
                    $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                    while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                        $uniqueSizeIds[] = $coldata['size_id'];
                    }

                    // Create table headers for color names
                    echo '<th style="width: 10%">Color</th>';

                    // Create table headers for each size ID
                    foreach ($uniqueSizeIds as $sizeId) {
                        // Decrease the column width for sizes
                        echo '<th style="width: 5%">' . $sizeId . '</th>';
                    }

                    // Add a heading for the "Total" column and increase its width
                    echo '<th style="width: 10%">Total</th>';


                echo '</thead>
                <tbody>';


                $i = 1;
				
				$insertData = array();

                // Initialize an array to store color-wise totals
                $colorTotals = array();

                // Retrieve unique colors for the selected order_no
                $uniqueColors = array();

                $sectBrnQry = "SELECT DISTINCT color FROM triming_workdone WHERE order_no='" . $_REQUEST['order'] . "'";
                $secBrnResource = mysqli_query($zconn, $sectBrnQry);

                while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                    $uniqueColors[] = $coldata['color'];
                }

                // Loop through the colors and display quantities for each size ID in rows
                foreach ($uniqueColors as $color) {
                    echo '<tr>';
                    echo '<td style="width: 2%">' . $i . '</td>';
                    echo '<td style="width: 10%">' . $_REQUEST['order'] . '</td>';
                //  echo '<td style="width: 10%">' . $_REQUEST['style'] . '</td>';
					
                    echo '<td>' . $color . '</td>';

                    // Initialize the color-wise total for this row
                    $colorTotal = 0;

                    // Loop through unique size IDs and create input fields for each color and size combination
                   foreach ($uniqueSizeIds as $sizeId) {
    // Calculate 'bal_qty' for this order, color, and size combination
        $cuttingQuantity = isset($cuttingQuantityData[$_REQUEST['order']][$color][$sizeId]) ? $cuttingQuantityData[$_REQUEST['order']][$color][$sizeId] : 0;
        $cuttingBalance = isset($cuttingBalanceData[$_REQUEST['order']][$color][$sizeId]) ? $cuttingBalanceData[$_REQUEST['order']][$color][$sizeId] : 0;
        $balQty = $cuttingQuantity - $cuttingBalance;
        $balQtyData[$_REQUEST['order']][$color][$sizeId] = $balQty;

        // Check if balQty is 0 for this sizeId
        if ($balQty == 0) {
            $isReadOnly = 'readonly'; // Set as readonly if balQty is 0
        } else {
            $isReadOnly = ''; // Not readonly if balQty is not 0
        }

        // Create a unique inputName for each input field
        $inputName = 'qty[' . $color . '][' . $sizeId . ']';

        // Display the input field
        echo '<td><input type="text" style="width: 100%" class="form-control" name="' . $inputName . '" value="" ' . $isReadOnly . ' onkeyup="updateColorTotal(\'' . $color . '\')" /></td>';


    // Set the qty_val based on the form input
    $qty_val = isset($_POST['qty'][$color][$sizeId]) ? (int)$_POST['qty'][$color][$sizeId] : 0;

    // Debugging statement to inspect the value of qty_val
  //  echo 'Qty_val to be inserted: ' . $qty_val . '<br>';

    // Store the data for database insertion
    $insertData[] = array(
        'style_no' => $_POST['style'],
        'order_no' => $_POST['order'],
        'dc_no' => $_POST['dc_no'],
        'to_contractor' => $_POST['to_contractor'],
        'from' => $_POST['from'],
        'dc_date' => $_POST['dc_date'],
        'size_id' => $sizeId,
        'color' => $color,
        'qty_val' => $qty_val
  
		
							
                        );
                        // Calculate the color-wise total within this loop
                        $colorTotal += isset($_POST['qty'][$color][$sizeId]) ? (int)$_POST['qty'][$color][$sizeId] : 0;
                    
}
                   // Display the color-wise total for this row
                    echo '<td><span class="color-total" id="' . $color . '-total">' . $colorTotal . '</span></td>';
                    // Store the color-wise total in the array
                    $colorTotals[$color] = $colorTotal;
                    echo '</tr>'; 
                    $i++;
                }
	            echo '</tbody>
                </table>
              
                </div>
				
									                                  <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save" class="btn btn-success">Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
</div>
</form>'; // Closing the second <div>
                mysqli_free_result($result);
            } 
			else {
                echo "Error fetching data from the Singer table.";
            }
        } 
		else {
            echo "Please select an order number.";
        }
   // } 
	//else {
     //   echo "You selected a department other than STICKERING. No data to fetch.";
   // }



if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
    // Database connection settings
    include('includes/config.php');

    // Assuming $insertData is an array containing the data to be inserted
    if (!empty($insertData)) {
        foreach ($insertData as $data) {
            // Escape and retrieve data
            $style_no = mysqli_real_escape_string($zconn, $data['style_no']);
            $order_no = mysqli_real_escape_string($zconn, $data['order_no']);
            $dc_no = mysqli_real_escape_string($zconn, $data['dc_no']);
            $to_contractor = mysqli_real_escape_string($zconn, $data['to_contractor']);
            $from = mysqli_real_escape_string($zconn, $data['from']);
            $dc_date = mysqli_real_escape_string($zconn, $data['dc_date']);
            $size_id = mysqli_real_escape_string($zconn, $data['size_id']);
            $color = mysqli_real_escape_string($zconn, $data['color']);
            $qty_val = (int)$data['qty_val'];

            // Session handling
            $user_id = $_SESSION['userid']; // Assuming 'userid' is the session variable that stores the user's ID

            // Query to retrieve the UNAME from the 'users' table
            $unameQuery = "SELECT UNAME FROM users WHERE USERID = '$user_id'";
            $result = mysqli_query($zconn, $unameQuery);

            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $uname = $row['UNAME'];
            } else {
                // Handle the case where the user's data is not found
                $uname = ''; // Provide a default value or handle this case accordingly
            }

            // Insert data into the 'checking_workassign1' table
            $insertQuery = "INSERT INTO checking_workassign1 (style_no, order_no, dc_no, to_contractor, `from`, dc_date, size_id, color, qty_val, `session_entry`) VALUES ('$style_no', '$order_no', '$dc_no', '$to_contractor', '$from', '$dc_date', '$size_id', '$color', $qty_val, '$uname')";

            $result = mysqli_query($zconn, $insertQuery);

            if (!$result) {
                // Log the error for reference
                error_log("Error: " . mysqli_error($zconn));
                die("An error occurred while inserting data into checking_workassign1.");
            }

            // Insert data into the 'workassign_dc' table
            $insertWorkAssignQuery = "INSERT INTO workassign_dc (style_no, order_no, dc_no, size_id, color, qty_val, `from`, to_contractor, dc_date, session_entry) VALUES ('$style_no', '$order_no', '$dc_no', '$size_id', '$color', $qty_val, '$from', '$to_contractor', '$dc_date', '$uname')";

            $resultWorkAssign = mysqli_query($zconn, $insertWorkAssignQuery);

            if (!$resultWorkAssign) {
                // Log the error for reference
                error_log("Error: " . mysqli_error($zconn));
                die("An error occurred while inserting data into workassign_dc.");
            }
        }
    } else {
        // Display a JavaScript alert as a warning
        echo '<script>alert("Warning: Stock is not positive. Data not inserted.");</script>';
    }
}

?>
							
				
						