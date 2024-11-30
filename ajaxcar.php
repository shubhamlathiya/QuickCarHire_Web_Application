<?php
include "DatabaseConnection.php";

$City = $_SESSION['City'];
//$kms = $_POST['submit'];
$kms = $_POST['button_value'];
$_SESSION['kms'] = $kms;
$sdate = $_SESSION['Start_Date'];
$edate = $_SESSION['End_Date'];
//echo $kms;
//$sql = $conn->prepare("SELECT * FROM car WHERE City =? ");
//$sql->bind_param("s", $City);

$sql = $conn->prepare("SELECT * FROM car WHERE City_Id = ? AND Registration_No NOT IN (SELECT Registration_No FROM booking  WHERE City_Id =? AND start_date <= ? AND end_date >= ?);");
$sql->bind_param("ssss", $City, $City, $sdate, $edate);
$sql->execute();
$resultCar = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

if (count($resultCar) > 0) {
    foreach ($resultCar as $row) {
        $Status = $row['Status'];
        if ($Status == 'Deactive') {
            
        } else {
            $Registration_no = $row['Registration_No'];
            $Car_name = $row['Name'];
            $ModelYear = $row['Brand'];
            $Image = $row['Image'];
            $Car_hire_cost = $row['Hire_Cost'];
            $Speed = $row['Speed'];
            $Category_id = $row['Category_Id'];
            $Category = $conn->prepare("SELECT * FROM car_category WHERE Category_id =? ");
            $Category->bind_param("s", $Category_id);
            $Category->execute();
            $resultCategory = $Category->get_result()->fetch_all(MYSQLI_ASSOC);
            if (count($resultCategory) > 0) {
                foreach ($resultCategory as $row) {
                    $Seats = $row['Seats'];
                    $Fuel = $row['Fuel'];
                    $Laggage = $row['Laggage'];
                    $Transmission = $row['Transmission'];
                }
            } else {
                echo "<script>alert('not a Category_id');</script>";
            }
            ?>


            <div class="col-12 col-md-6 col-xl-4">
                <div class="car">
                    <div class="splide splide--card car__slider splide--loop splide--ltr splide--draggable is-active is-initialized" id="splide02">
                        <div class="splide__track" id="splide02-track" style="padding-left: 0px; padding-right: 0px;">
                            <img src="Admin/images/CarImg/<?php echo $Image; ?>" style="height: 200px;" alt="hy">
                        </div>
                    </div>
                    <div class="car__title">
                        <h3 class="car__name">
                            <!--                            <a href="Booking.php?id=--><?php //= $Registration_no;  ?><!--" >-->
                            <?php echo $Car_name; ?>
                            <!--                            </a>-->
                        </h3>
                        <span class="car__year"><?php echo $ModelYear; ?></span>
                    </div>
                    <ul class="car__list">
                        <li>
                            <i class="fa-solid fa-user-group" style="color: #189cf4;"></i>&nbsp;&nbsp;
                            <span><?php echo $Seats; ?> People</span>
                        </li>
                        <li>
                            <i class="fa-solid fa-gas-pump" style="color: #189cf4;"></i>&nbsp;&nbsp;
                            <span><?php echo $Fuel; ?></span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M19.088,4.95453c-.00732-.00781-.00952-.01819-.01715-.02582s-.01819-.00995-.02606-.01733a9.97886,9.97886,0,0,0-14.08948,0c-.00787.00738-.01837.00964-.02606.01733s-.00983.018-.01715.02582a10,10,0,1,0,14.1759,0ZM12,20a7.9847,7.9847,0,0,1-6.235-3H9.78027a2.9636,2.9636,0,0,0,4.43946,0h4.01532A7.9847,7.9847,0,0,1,12,20Zm-1-5a1,1,0,1,1,1,1A1.001,1.001,0,0,1,11,15Zm8.41022.00208L19.3999,15H15a2.99507,2.99507,0,0,0-2-2.81573V9a1,1,0,0,0-2,0v3.18427A2.99507,2.99507,0,0,0,9,15H4.6001l-.01032.00208A7.93083,7.93083,0,0,1,4.06946,13H5a1,1,0,0,0,0-2H4.06946A7.95128,7.95128,0,0,1,5.68854,7.10211l.65472.65473A.99989.99989,0,1,0,7.75732,6.34277l-.65466-.65466A7.95231,7.95231,0,0,1,11,4.06946V5a1,1,0,0,0,2,0V4.06946a7.95231,7.95231,0,0,1,3.89734,1.61865l-.65466.65466a.99989.99989,0,1,0,1.41406,1.41407l.65472-.65473A7.95128,7.95128,0,0,1,19.93054,11H19a1,1,0,0,0,0,2h.93054A7.93083,7.93083,0,0,1,19.41022,15.00208Z"></path>
                            </svg>
                            <span><?php echo $Speed; ?></span>
                        </li>
                        <li>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                <path d="M12,12a1,1,0,1,0,1,1A1,1,0,0,0,12,12Zm9.71-2.36a0,0,0,0,1,0,0,10,10,0,0,0-19.4,0,0,0,0,0,1,0,0,9.75,9.75,0,0,0,0,4.72,0,0,0,0,1,0,0A10,10,0,0,0,9.61,21.7h0a9.67,9.67,0,0,0,4.7,0h0a10,10,0,0,0,7.31-7.31,0,0,0,0,1,0,0,9.75,9.75,0,0,0,0-4.72ZM12,4a8,8,0,0,1,7.41,5H4.59A8,8,0,0,1,12,4ZM4,12a8.26,8.26,0,0,1,.07-1H6v2H4.07A8.26,8.26,0,0,1,4,12Zm5,7.41A8,8,0,0,1,4.59,15H7a2,2,0,0,1,2,2Zm4,.52A8.26,8.26,0,0,1,12,20a8.26,8.26,0,0,1-1-.07V18h2ZM13.14,16H10.86A4,4,0,0,0,8,13.14V11h8v2.14A4,4,0,0,0,13.14,16ZM15,19.41V17a2,2,0,0,1,2-2h2.41A8,8,0,0,1,15,19.41ZM19.93,13H18V11h1.93A8.26,8.26,0,0,1,20,12,8.26,8.26,0,0,1,19.93,13Z"></path>
                            </svg>
                            <span><?php echo $Transmission; ?></span>
                        </li>

                    </ul>
                    <div class="car__footer">
                        <span class="car__price">
                            <i class="fa-solid fa-indian-rupee-sign"></i>
                            <?php
                            $price = $Car_hire_cost * $kms;
                            echo $price;
                            ?>
                        </span>
                        <a href="Booking.php?id=<?= base64_encode($Registration_no); ?>&P=<?= base64_encode($price); ?>&city=<?= base64_encode($City); ?>" class="car__more">
                            <span>Rent now</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php
        }
    }
} else {
    echo "<script>alert('Not avaliber car');</script>";
}
?>