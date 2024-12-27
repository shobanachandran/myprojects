<?php
session_start();
error_reporting(E_ALL);
$zconn = mysqli_connect("localhost", "shankargroups_erp", "Gk&4201gy", "shankargroups_erp");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit;
}

// ... (Other definitions and configurations)

// Check if the selected option is 'fabric'
if (isset($_POST['selectedOption']) && $_POST['selectedOption'] === 'fabric') {
    // Fetch supplier names from the database for 'fabric'
    $sql = "SELECT supplier_id, supplier_name FROM suppliers WHERE supplier_type_id = (SELECT supplier_type_id FROM supplier_types WHERE supplier_type = 'fabric')";
    
    // Execute the query
    $result = $zconn->query($sql);

    if (!$result) {
        // Handle query errors
        $error = 'Query error: ' . $zconn->error;
        echo json_encode(array('error' => $error));
        exit;
    }

    $suppliers = array();

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $suppliers[] = $row;
        }
    }

    // Set the header to indicate JSON response
    header('Content-Type: application/json');

    // Return supplier names as JSON response
    echo json_encode($suppliers);

    // Close the database connection
    $zconn->close();
} else {
    // Return an empty JSON response or handle other cases if needed
    echo json_encode(array());
}
?>
