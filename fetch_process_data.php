<?php
// Include your database connection code here
include('includes/config.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve the selected Style No from the form
    $styleNo = $_POST['style_no'];

    // Perform a database query to fetch data based on the selected Style No and from_addr
    $query = "SELECT * FROM process_dc_in WHERE style_no = '$styleNo' ORDER BY date DESC LIMIT 1";
    $result = mysqli_query($zconn, $query);

    if (!$result) {
        die("Database query failed: " . mysqli_error($zconn));
    }

    // Fetch the data into an associative array
    $row = mysqli_fetch_assoc($result);

    // Convert the data to JSON and return it
    echo json_encode($row);
} else {
    // Handle invalid requests
    echo json_encode(['error' => 'Invalid request']);
}
?>
