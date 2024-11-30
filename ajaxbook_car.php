<?php

//include 'DatabaseConnection.php';
//
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: POST');
//header('Access-Control-Allow-Headers: Content-Type');
//
////if (!isset($_POST['BOOKCARNOW'])) {
////    $response = array('success' => false, 'message' => 'Invalid request');
////    header('Content-Type: application/json');
////    echo json_encode($response);
////    exit;
////}
//
//$email = $_POST['CustomerEmail'];
//$R_no = $_POST['id'];
//$Start_Date = $_POST['Start_Date'];
//$End_Date = $_POST['End_Date'];
//$Start_Time = $_POST['Start_Time'];
//$End_Time = $_POST['End_Time'];
//$price = $_POST['price'];
//$securityD = $_POST['securityD'];
//
//
//
//if (isset($_POST['ApplySubmit']) && isset($_POST['ApplySubmit']) == true) {
//    $Offerbook = $_SESSION['OfferCode'];
//    $TotalAmount = $_SESSION['TotalAmount'];
//} else {
//    $Offerbook = 0;
//    $TotalAmount = $securityD + $price;
//}
//
//$booking12 = $conn->prepare("INSERT INTO booking(Email,Registration_No,Start_Date, End_Date,Start_Time,End_Time, Security_Deposit,Offer, Amount) VALUES (?,?,?,?,?,?,?,?,?);");
//$booking12->bind_param("sssssssss", $email, $R_no, $Start_Date, $End_Date, $Start_Time, $End_Time, $securityD, $Offerbook, $TotalAmount);
//$booking1 = $booking12->execute();
//
//if ($booking1 > 0) {
//    unset($_SESSION['OfferCode']);
//    unset($_SESSION['TotalAmount']);
//    $response = array('success' => true, 'message' => 'Booking successful');
//} else {
//    $response = array('success' => false, 'message' => 'Booking failed');
//}
//
//header('Content-Type: application/json');
//echo json_encode($response);
//
//
?>
<?php

session_start();
include('DatabaseConnection.php');

$email = $_POST['CustomerEmail'];
$R_no = $_POST['id'];
$Start_Date = $_POST['Start_Date'];
$End_Date = $_POST['End_Date'];
$Start_Time = $_POST['Start_Time'];
$End_Time = $_POST['End_Time'];
$price = $_POST['price'];
$securityD = $_POST['securityD'];

if (isset($_POST['isApplySubmitClicked']) == true) {
    $Offerbook = $_SESSION['OfferCode'];
    $TotalAmount = $_SESSION['TotalAmount'];
} else {
    $Offerbook = 0;
    $TotalAmount = $securityD + $price;
}

$booking12 = $conn->prepare("INSERT INTO booking(Email, Registration_No, Start_Date, End_Date, Start_Time, End_Time, Security_Deposit, Offer, Amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);");
$booking12->bind_param("sssssssss", $email, $R_no, $Start_Date, $End_Date, $Start_Time, $End_Time, $securityD, $Offerbook, $TotalAmount);
$booking1 = $booking12->execute();

if ($booking1 > 0) {
    unset($_SESSION['OfferCode']);
    unset($_SESSION['TotalAmount']);
    $response = array('success' => true, 'message' => 'Booking successful');
    echo json_encode($response);
} else {
    $response = array('success' => false, 'message' => 'Booking failed');
    echo json_encode($response);
}
?>
