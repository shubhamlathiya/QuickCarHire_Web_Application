<?php
include 'DatabaseConnection.php';

    $number1 = $_POST['number1'];
    $number2 = $_POST['number2'];
    $number3 = $_POST['number3'];
    $number4 = $_POST['number4'];
    $number5 = $_POST['number5'];
    $number6 = $_POST['number6'];
    $number7 = $_POST['number7'];


$otp = $number1 . $number2 . $number3 . $number4 . $number5 . $number6 . $number7;






$Emailid = $_SESSION['Emailid'] ;
    // Fetch the OTP from the database

$query = "SELECT * FROM customer WHERE Email = '$Emailid'";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    // Email exists, verify OTP
    $row = $result->fetch_assoc();
    $storedOTP = $row['otp'];

    if ($otp == $storedOTP) {
        // OTP is correct, perform further actions

        // Update the status of the OTP to indicate it has been verified
        $sql = "UPDATE customer SET varify='1' WHERE Email =  '$Emailid'";
        mysqli_query($conn, $sql);
        echo "<script>window.location.href='EditProfile.php'</script>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Invalid OTP.</div>";
    }
}
