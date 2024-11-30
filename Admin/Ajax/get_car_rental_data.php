<?php

include_once '../Design/databaseConnection.php';


// Query the database to retrieve the car rental data
$sql = "SELECT Booking_Id, Registration_No, Start_Date, End_Date, Status FROM booking";
$result = mysqli_query($conn, $sql);

// Create an array to store the car rental data
$carRentalData = array();
while ($row = mysqli_fetch_assoc($result)) {
    $bookingId = $row['Booking_Id'];
    $current_date = date('Y-m-d');
    $Booking_start_date = $row['Start_Date'];
    $Booking_end_date = $row['End_Date'];

    if ($current_date < $Booking_start_date) {
        $booking_status = 'Pending';
    } elseif ($current_date >= $Booking_start_date && $current_date <= $Booking_end_date) {
        $booking_status = 'Current';
    } elseif ($current_date > $Booking_end_date) {
        $booking_status = 'Completed';
    }

    $sql_update = "UPDATE booking SET Status='$booking_status' WHERE  Booking_Id ='$bookingId'";
    if ($conn->query($sql_update) === TRUE) {
        
    } else {
        echo "<script>alert(Error updating booking record: . $conn->error)</script>";
    }

    $carRentalData[] = array(
        'id' => $row['Booking_Id'],
        'title' => 'Car ' . $row['Registration_No'],
        'start' => $row['Start_Date'],
        'end' => $row['End_Date'],
        'color' => ($row['Status'] == 'Completed') ? 'green' : (($row['Status'] == 'Pending') ? 'red' : 'blue')
    );
}

// Encode the car rental data as JSON and return it
echo json_encode($carRentalData);

// Close the database connection
mysqli_close($conn);
?>
