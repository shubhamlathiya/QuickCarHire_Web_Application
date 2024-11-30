<?php

include 'DatabaseConnection.php';

// query the database to get the booking amounts for each month in 2023
$sql = "SELECT SUM(Amount) AS total_booking_amount, MONTH(Booking_Date) AS booking_month FROM booking WHERE YEAR(Booking_Date) = 2023 GROUP BY MONTH(Booking_Date)";
$result = mysqli_query($conn, $sql);

// create an array to store the booking data
$booking_data = array(
    'labels' => array(),
    'counts' => array()
);

// loop through the query result and add the data to the array
while ($row = mysqli_fetch_assoc($result)) {
    $booking_data['labels'][] = date('M', mktime(0, 0, 0, $row['booking_month'], 1));
    $booking_data['counts'][] = intval($row['total_booking_amount']);
}

// encode the array as a JSON object and return it to the Ajax request
echo json_encode($booking_data);

// close the database connection
mysqli_close($conn);
?>