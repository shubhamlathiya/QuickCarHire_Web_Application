<?php
include 'DatabaseConnection.php';
$code = $_POST['offerCode'];
$price = $_POST['price'];

$query = $conn->prepare("SELECT * FROM offer where Code=?");
$query->bind_param("s", $code);
$result = $query->execute();
$result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
if (count($result) > 0) {
    foreach ($result as $row) {
        $Offer_Code = $row['Code'];
        $Offer_Amount = $row['Percentage'];
        $Offer_Status = $row['Status'];
    }
    $applyoffer = $_POST['offerCode'];
    if ($Offer_Code == $applyoffer) {
        if ($Offer_Status == 'Active') {
            $book = $price * $Offer_Amount / 100;
            $_SESSION['OfferCode'] = $book;
            ?>
            <div class="row">
                <div class="col-sm">
                    <h6>Offer Amount</h6>
                </div>
                <div class="col-sm">
                    <?= $book ?>
                </div>
            </div>
            <?php
        } else {
            echo '<div class="alert alert-danger" role="alert">Invalid Offer Code</div>';
        }
    } else {
        
    }
} else {
    
}
?>