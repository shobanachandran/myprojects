<?php
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $po_no = $_POST['po_no'];
    $status = $_POST['status'];

    try {
        // Update the status in the database
        $updateQuery = "UPDATE general_po SET status = '$status' WHERE po_no = '$po_no'";
        echo 'SQL Query: ' . $updateQuery . '<br>'; // Output SQL query for debugging

        $result = mysqli_query($zconn, $updateQuery);

        if ($result) {
            echo 'success';
        } else {
			echo $result;
            echo 'error executing query: '; // Log MySQL error
        }
    } catch (Exception $e) {
        echo 'exception occurred: ' . $e->getMessage() . '<br>';
        echo 'Error code: ' . $e->getCode() . '<br>';
        // Add more logging or diagnostic information as needed
    }
}
?>
