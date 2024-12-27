<?php include('includes/config.php');
?>


<div class="table-responsive">
    <div class="col-8 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Planning Quantity Details</h5>
    </div>
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">S.NO</th>
                <!--th style="width: 10%">ORDER NO</th-->
                <?php
                // Retrieve unique size IDs for the selected order_no
                $uniqueSizeIds = array();

                $sectBrnQry = "SELECT DISTINCT size_id FROM checking_workassign1 WHERE order_no='" . $_REQUEST['order'] . "'";
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
                echo '<th>Total</th>';
                ?>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;

            // Initialize arrays to store color-wise totals
            $colorTotals = array();

            // Retrieve unique colors for the selected order_no
            $uniqueColors = array();

            $sectBrnQry = "SELECT DISTINCT color FROM checking_workassign1 WHERE order_no='" . $_REQUEST['order'] . "'";
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
            $sectBrnQry = "SELECT * FROM checking_workassign1 WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);

            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $colorQuantities[$coldata['size_id']][$coldata['color']] = $coldata['qty_val'];
            }
								// Initialize the grand total
$grandTotal = 0;

            // Loop through the colors and display quantities for each size ID in rows
            foreach ($uniqueColors as $color) {
                echo '<tr>';
                echo '<td style="width: 2%">' . $i . '</td>';
               // echo '<td style="width: 10%">' . $_REQUEST['order'] . '</td>';
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
// Add the color-wise total to the grand total
    $grandTotal += $colorTotal;
                echo '</tr>';
                $i++;
            }
								// Display the grand total row
echo '<tr>';
echo '<td colspan="' . (count($uniqueSizeIds) + 2) . '">Grand Total</td>';
echo '<td>' . $grandTotal . '</td>';
echo '</tr>';
            ?>
        </tbody>
    </table>
</div>
										
										
                                        
                                        
                                <div class="table-responsive">
    <div class="col-12 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Work Done Quantity Details</h5>
    </div>
    <table class="table table-striped table-bordered text-center">
        <thead>
            <tr>
                <th style="width: 5%">S.NO</th>
                <!--th style="width: 10%">ORDER NO</th-->
                <?php
                // Retrieve unique size IDs for the selected order_no
                $uniqueSizeIds = array();

                $sectBrnQry = "SELECT DISTINCT size_id FROM checking_workdone1 WHERE order_no='" . $_REQUEST['order'] . "'";
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
                echo '<th>Total</th>';
                ?>
            </tr>
        </thead>
        <tbody>
           <?php
$i = 1;

// Initialize arrays to store color-wise totals
$colorTotals = array();

// Retrieve unique colors for the selected order_no
$uniqueColors = array();

$sectBrnQry = "SELECT DISTINCT color FROM checking_workdone1 WHERE order_no='" . $_REQUEST['order'] . "'";
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
$sectBrnQry = "SELECT * FROM checking_workdone1 WHERE order_no='" . $_REQUEST['order'] . "'";
$secBrnResource = mysqli_query($zconn, $sectBrnQry);

while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
    $colorQuantities[$coldata['size_id']][$coldata['color']] = isset($colorQuantities[$coldata['size_id']][$coldata['color']]) ?
        $colorQuantities[$coldata['size_id']][$coldata['color']] + $coldata['qty_val'] : $coldata['qty_val'];
}

// Initialize the grand total
$grandTotal = 0;

// Loop through the colors and display quantities for each size ID in rows
foreach ($uniqueColors as $color) {
    echo '<tr>';
    echo '<td style="width: 2%">' . $i . '</td>';
    echo '<td>' . $color . '</td>';

    // Initialize an array to store size-wise totals for this color
    $sizeTotals = array();

    foreach ($uniqueSizeIds as $sizeId) {
        $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;

        // Display the quantity in a table cell
        echo '<td>' . $quantity . '</td>';

        // Add the quantity to the size-wise total for this color
        if (!isset($sizeTotals[$sizeId])) {
            $sizeTotals[$sizeId] = 0;
        }
        $sizeTotals[$sizeId] += $quantity;
    }

    // Loop through unique size IDs and display the size-wise totals
    foreach ($uniqueSizeIds as $sizeId) {
      //  echo '<td>' . $sizeTotals[$sizeId] . '</td>';
    }

    // Finally, display the color-wise total for this row
    echo '<td>' . array_sum($sizeTotals) . '</td>';
    echo '</tr>';
    $i++;
}

// Display the grand total row
echo '<tr>';
echo '<td colspan="' . (count($uniqueSizeIds) + 2) . '">Grand Total</td>';

// Calculate the grand total based on size-wise totals
$grandTotal = 0;
foreach ($uniqueSizeIds as $sizeId) {
    $sizeTotal = array_reduce($uniqueColors, function ($carry, $color) use ($colorQuantities, $sizeId) {
        $quantity = isset($colorQuantities[$sizeId][$color]) ? $colorQuantities[$sizeId][$color] : 0;
        return $carry + $quantity;
    }, 0);
  //  echo '<td>' . $sizeTotal . '</td>';
    $grandTotal += $sizeTotal;
}

// Display the overall grand total
echo '<td>' . $grandTotal . '</td>';
echo '</tr>';
?>

        </tbody>
    </table>
</div>
										
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
                $sectBrnQry = "SELECT DISTINCT size_id FROM checking_workassign1 WHERE order_no='" . $_REQUEST['order'] . "'";
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
            $sectBrnQry = "SELECT DISTINCT color FROM checking_workassign1 WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);
            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $uniqueColors[] = $coldata['color'];
            }
            // Initialize an array to store the 'bal_qty' for each order, color, and size combination
            $balQtyData = array();
            // Retrieve and organize data from cutting_quantity_details
            $cuttingQuantityData = array();
            $sectBrnQry = "SELECT order_no, color, size_id, qty_val FROM checking_workassign1 WHERE order_no='" . $_REQUEST['order'] . "'";
            $secBrnResource = mysqli_query($zconn, $sectBrnQry);
            while ($coldata = mysqli_fetch_array($secBrnResource, MYSQLI_ASSOC)) {
                $cuttingQuantityData[$coldata['order_no']][$coldata['color']][$coldata['size_id']] = $coldata['qty_val'];
            }
            // Retrieve and organize data from cutting_balance
            $cuttingBalanceData = array();
            $sectBrnQry = "SELECT order_no, color, size_id, SUM(qty_val) AS total_qty FROM checking_workdone1 WHERE order_no='" . $_REQUEST['order'] . "' GROUP BY order_no, color, size_id";
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

<div class="table-responsive">
    <div class="col-12 d-flex no-block align-items-center">
        <h5 class="page-title" style="margin-left: 390px;">Enter  Quantity Details</h5>
    </div>

    
        <table class="table table-striped table-bordered text-center">
            <thead>
                <tr>
                    <th style="width: 5%">S.NO</th>
                    <th style="width: 10%">Color</th>
                    <?php
                    // Create table headers for each size ID
                    foreach ($uniqueSizeIds as $sizeId) {
                        // Decrease the column width for sizes
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
$colorTotals = array();
$insertData = array();

foreach ($uniqueColors as $color) {
    echo '<tr>';
    echo '<td style="width: 2%">' . $i . '</td>';
    echo '<td>' . $color . '</td>';

    $colorTotal = 0;

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
		
		  // Debugging statement to inspect the value of qty_val
   // echo 'Qty_val to be inserted: ' . $qty_val . '<br>';

        // Display the input field
        echo '<td><input type="text" style="width: 100%" class="form-control" name="' . $inputName . '" value="" ' . $isReadOnly . ' onkeyup="updateColorTotal(\'' . $color . '\')" /></td>';
		
		    $qty_val = isset($_POST['qty'][$color][$sizeId]) ? (int)$_POST['qty'][$color][$sizeId] : 0;


                        // Store the data for database insertion
                        $insertData[] = array(
                            'style_no' => $_REQUEST['style'],
                            'order_no' => $_REQUEST['order'],
							'dc_no' => $_REQUEST['dc_no'],
                            'party_dc_no' => $_POST['party_dc_no'],
                            'to_contractor' => $_POST['to_contractor'],
                            'from' => $_POST['from'],
                            'dc_out_date' => $_POST['dc_out_date'],
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
								
							
						

								
                ?>
            </tbody>
        </table>
        <div class="card" style="width:100%">
                                    <div class="border-top">
                                        <div class="card-body" style="margin-left: 400px;">
                                            <button type="submit" name="save" class="btn btn-success" >Save</button>
                                            <button type="reset" class="btn btn-primary">Reset</button>
                                        </div>
                                    </div>
                                </div>
    
</div>

<?php  
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['save'])) {
   // var_dump($_POST); // Add this line to check the received POST data
    // ...

    // Database connection settings
    include('includes/config.php');
    
    if (!empty($insertData)) {
        foreach ($insertData as $data) {
            $style_no = mysqli_real_escape_string($zconn, $data['style_no']);
            $order_no = mysqli_real_escape_string($zconn, $data['order_no']);
            $dc_no = mysqli_real_escape_string($zconn, $data['dc_no']);
            $party_dc_no = mysqli_real_escape_string($zconn, $data['party_dc_no']);
            $to_contractor = mysqli_real_escape_string($zconn, $data['to_contractor']);
            $from = mysqli_real_escape_string($zconn, $data['from']);
            $dc_date = mysqli_real_escape_string($zconn, $data['dc_out_date']);
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
                $uname = ''; // You should provide a default value or handle this case accordingly
            }

            // Insert data into the 'checking_workdone1' table
            $insertCheckingWorkdoneQuery = "INSERT INTO checking_workdone1 (style_no, order_no, dc_no, party_dc_no, to_contractor, `from`, dc_out_date, size_id, color, qty_val, `session_entry`) VALUES ('$style_no', '$order_no', '$dc_no','$party_dc_no', '$to_contractor', '$from', '$dc_date', '$size_id', '$color', $qty_val, '$uname')";

            $resultCheckingWorkdone = mysqli_query($zconn, $insertCheckingWorkdoneQuery);

            // Insert data into the 'dc' table
            $insertDcQuery = "INSERT INTO dc (style_no, order_no, dc_no, size_id, color, qty_val, party_dc_no, `from`, to_contractor, dc_out_date, created_at, status, shipment, session_entry, pay_id, bal_qty) VALUES ('$style_no', '$order_no', '$dc_no', '$size_id', '$color', $qty_val, '$party_dc_no', '$from', '$to_contractor', '$dc_date', NOW(), 'pending', 'not_shipped', '$uname', 1, $qty_val)";

            $resultDc = mysqli_query($zconn, $insertDcQuery);

            if (!$resultCheckingWorkdone || !$resultDc) {
                // Log the error for reference
                error_log("Error: " . mysqli_error($zconn));
                die("An error occurred while inserting data.");
            }
        }
    } else {
        // Display a JavaScript alert as a warning
        echo '<script>alert("Warning: Stock is not positive. Data not inserted.");</script>';
    }
}
?>
