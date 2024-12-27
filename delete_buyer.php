<?php
include("includes/config.php");

if (isset($_POST['buyer_id'])) {
    $buyer_id = intval($_POST['buyer_id']); // Ensure it's an integer to prevent SQL injection

    $deleteQuery = "DELETE FROM cash WHERE id = $buyer_id";

    if (mysqli_query($zconn, $deleteQuery)) {
        echo "success"; // Send a success response
    } else {
        echo "error"; // Send an error response
    }
} else {
    echo "invalid_request"; // Handle invalid requests
}
?>
