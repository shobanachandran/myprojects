<?php
// Database connection parameters
include('includes/config.php');

// Fetch all "cheque_dates" from your database
$sql = "SELECT cheque_date, payee FROM cheque_payments"; // Replace with your specific query to select "cheque_dates" and "payee"
$result = $zconn->query($sql);

if ($result->num_rows > 0) {
    $chequeDates = array(); // Create an array to store the "cheque_dates"
    $today = date('Y-m-d');
    $tomorrow = date('Y-m-d', strtotime('+1 day'));

    // Fetch all "cheque_dates" and "payee" and check if any are due tomorrow
    while ($row = $result->fetch_assoc()) {
        if ($row["cheque_date"] == $tomorrow) {
            $chequeDates[] = array(
                "cheque_date" => $row["cheque_date"],
                "payee" => $row["payee"]
            );
        }
    }

    // Check if there are any due "cheque_dates"
    if (!empty($chequeDates)) {
        // Prepare the response with due dates and payees
        $response = array("due_cheque_dates" => $chequeDates);

        // Return the response as JSON
        header("Content-Type: application/json");
        echo json_encode($response);
    } else {
        // No due dates found
        echo "No due cheque_dates found for tomorrow.";
    }
} else {
    // No data found
    echo "No data found";
}

// Close the database connection
$zconn->close();
?>
