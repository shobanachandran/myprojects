<?php
session_start();
error_reporting(E_ALL);
include('includes/config.php');

// Check if the form is submitted
if (isset($_POST['submit'])) {
   // Extract form data
$payee = $_POST['payee'];
$date = $_POST['date'];
$cheque_date = $_POST['cheque_date'];
$bill_no = $_POST['bill_no'];
$amount = $_POST['amount'];
$bank = $_POST['bank'];
$payee_type = isset($_POST['payee_type']) ? "A/C Payee" : ""; // Checkbox value
$desc = $_POST['desc'];

// Ensure you validate and sanitize the input data to prevent SQL injection.
// For example, you can use functions like filter_var or regular expressions.

// Create your SQL query
$sql = "INSERT INTO cheque_payments (payee, date, cheque_date, bill_no, amount, bank, payee_type, description) VALUES ('$payee', '$date', '$cheque_date', '$bill_no', '$amount', '$bank', '$payee_type', '$desc')";

// Execute the query
if (mysqli_query($zconn, $sql)) {
    echo "Record inserted successfully.";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($zconn);
}

}
?>


