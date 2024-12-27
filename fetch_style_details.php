<?php
// Include your database configuration file
include('includes/config.php');

// Get the selected style_no from the POST request
$selectedStyle = $_POST['style_no']; // Assuming it's passed from your JavaScript

// Query to fetch data based on selected criteria
$query = "SELECT * FROM process_production WHERE style_no = '$selectedStyle' AND sent_to = 'To_Production' AND status = 'open'";
$result = mysqli_query($zconn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($zconn));
}

// Check if there is any data
if (mysqli_num_rows($result) > 0) {
    echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
    echo '<thead>';
    echo '<tr>';
    echo '<th>Style No</th>';
    echo '<th>Fabric Name</th>';
    echo '<th>Date</th>';
    echo '<th>DIA</th>';
    echo '<th>GSM</th>';
    echo '<th>KG</th>';
    echo '<th>Color</th>';
    echo '<th>Action</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $row['style_no'] . '</td>';
        echo '<td>' . $row['fabric_name'] . '</td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['dia'] . '</td>';
        echo '<td>' . $row['gsm'] . '</td>';
        echo '<td>' . $row['entered_wgt'] . '</td>';
        echo '<td>' . $row['color'] . '</td>';
        echo '<td><button class="btn btn-success accept-button" name="accept_id" value="' . $row['id'] . '">Accept</button></td>';
        echo '</tr>';
    }

    echo '</tbody>';
    echo '</table>';
} else {
    echo 'No details found for the selected Style No.';
}

// Close the database connection
mysqli_close($zconn);
?>
