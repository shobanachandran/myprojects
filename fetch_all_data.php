<?php
// Include your database configuration file
include('includes/config.php');

// Get the selected style_no from the POST request
$selectedStyle = $_POST['style_no']; // Assuming it's passed from your JavaScript

// Query to fetch data based on selected criteria
$query = "SELECT * FROM process_production1 WHERE   sent_to = 'To_Production' AND status = 'open'";
$result = mysqli_query($zconn, $query);

if (!$result) {
    die("Query failed: " . mysqli_error($zconn));
}

// Check if there is any data
if (mysqli_num_rows($result) > 0) {

 echo '<link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">';

 echo '<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>';

     echo '<div class="table-responsive">';
    echo '<form method="post">'; // Add a form to handle the "Accept" button
    echo '<table id="example" class="table table-striped table-bordered" style="width:100%">';
    echo '<thead style="background-color: #626F80; color: #fff; font-size: 16px;">';
    echo '<tr>';
    echo '<th style="width: 5%">S.NO</th>';
	 echo '<th style="width: 15%">STYLE NO</th>';
    echo '<th style="width: 15%">FABRIC NAME</th>';
    echo '<th style="width: 15%">DATE</th>';
    echo '<th style="width: 10%">DIA</th>';
    echo '<th style="width: 10%">GSM</th>';
    echo '<th style="width: 10%">KG</th>';
    echo '<th style="width: 10%">COLOR</th>';
    echo '<th style="width: 10%">DO YOU WANT TO?</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';

    $sno = 1; // Initialize a counter for S.NO
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>' . $sno . '</td>';
		 echo '<td>' . $row['style_no'] . '</td>';
        echo '<td>' . $row['fabric_name'] . '</td>';
        echo '<td>' . $row['date'] . '</td>';
        echo '<td>' . $row['dia'] . '</td>';
        echo '<td>' . $row['gsm'] . '</td>';
        echo '<td>' . $row['entered_wgt'] . '</td>';
        echo '<td>' . $row['color'] . '</td>';
        echo '<td>' . $row['do_you_want_to'] . ' <button class="btn btn-success accept-button" name="accept_id" value="' . $row['id'] . '">Accept</button></td>';
        echo '</tr>';
        $sno++; // Increment the S.NO counter
    }

    echo '</tbody>';
    echo '</table>';
    echo '</form>';
    echo '</div>';
	echo "<script>
$(document).ready(function() {
    $('#example').DataTable();
});
</script>";
} else {
    echo 'No details found for the selected style_no.';
}
// Close the database connection
mysqli_close($zconn);
?>
