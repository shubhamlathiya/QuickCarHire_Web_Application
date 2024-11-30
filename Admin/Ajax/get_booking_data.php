<?php

include_once '../Design/databaseConnection.php';


// initialize the arrays
$labels = array();
$counts = array();

// fetch the booking data month-wise from the database
$sql = "SELECT MONTH(Booking_Date) as month, COUNT(*) as count FROM booking WHERE YEAR(Booking_Date) = '2023' GROUP BY MONTH(Booking_Date)";
$result = mysqli_query($conn, $sql);

// loop through the results and populate the arrays
while ($row = mysqli_fetch_assoc($result)) {
    $month = date('M', mktime(0, 0, 0, $row['month'], 1));
    $labels[] = $month;
    $counts[] = $row['count'];
}

// create the data array
$booking_data = array(
    'labels' => $labels,
    'counts' => $counts
);

// return the data as JSON
header('Content-Type: application/json');
echo json_encode($booking_data);

// close the database connection
mysqli_close($conn);
