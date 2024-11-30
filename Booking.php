<!DOCTYPE html>
<html lang="en">
    <head>
    <head>
        <title>QuickCarHire | Book</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <style>
            .alert {
                padding: 15px;
                border: 1px solid transparent;
                border-radius: 4px;
            }

            .alert-danger {
                color: #721c24;
                background-color: #f8d7da;
                border-color: #f5c6cb;
            }
        </style>
        <?php
        include 'headlink.php';
        include "DatabaseConnection.php";
        include "Sessionwithoutlogin.php";
        include "Header.php";
        ?>

    </head>
</head>
<body>
    <?php
    $id = base64_decode(strval($_GET['id']));
    $price = base64_decode(strval($_GET['P']));
    $city = base64_decode(strval($_GET['city']));
    $sql = $conn->prepare("SELECT * FROM car WHERE Registration_No =? ");
    $sql->bind_param("s", $id);
    $sql->execute();
    $resultCar = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
    $book = 0;

    if (count($resultCar) > 0) {
        foreach ($resultCar as $row) {
            $Status = $row['Status'];
            if ($Status == 'Deactive') {
                
            } else {
                $Registration_no = $row['Registration_No'];
                $Car_brand = $row['Brand'];
                $Car_name = $row['Name'];
                $ModelYear = $row['ModelYear'];
                $Image = $row['Image'];
                $Car_hire_cost = $row['Hire_Cost'];
                $Speed = $row['Speed'];
                $Category_id = $row['Category_Id'];
                $Category = $conn->prepare("SELECT * FROM car_category WHERE Category_Id =? ");
                $Category->bind_param("s", $Category_id);
                $Category->execute();
                $resultCategory = $Category->get_result()->fetch_all(MYSQLI_ASSOC);
                if (count($resultCategory) > 0) {
                    foreach ($resultCategory as $row) {
                        $Seats = $row['Seats'];
                        $Fuel = $row['Fuel'];
                        $Transmission = $row['Transmission'];
                    }
                } else {
                    echo "<script>alert('not a Category_id');</script>";
                }
                if ($Car_hire_cost > 20) {
                    $securityD = 3000;
                } else {
                    $securityD = 2000;
                }
            }
        }
    }
    ?>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>Car details <i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">Car Details</h1>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section ftco-car-details">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="car-details">
                        <div class="img rounded" style="background-image: url(Admin/images/CarImg/<?= $Image; ?>);"></div>
                        <div class="text text-center">
                            <span class="subheading"><?= $Car_brand ?></span>
                            <h2><?= $Car_name ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services">
                        <div class="media-body py-md-4">
                            <div class="d-flex mb-3 align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-dashboard"></span></div>
                                <div class="text">
                                    <h3 class="heading mb-0 pl-3">
                                        Mileage
                                        <span><?= $Speed ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services">
                        <div class="media-body py-md-4">
                            <div class="d-flex mb-3 align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-pistons"></span></div>
                                <div class="text">
                                    <h3 class="heading mb-0 pl-3">
                                        Transmission
                                        <span><?= $Transmission ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services">
                        <div class="media-body py-md-4">
                            <div class="d-flex mb-3 align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car-seat"></span></div>
                                <div class="text">
                                    <h3 class="heading mb-0 pl-3">
                                        Seats
                                        <span><?= $Seats ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md d-flex align-self-stretch ftco-animate">
                    <div class="media block-6 services">
                        <div class="media-body py-md-4">
                            <div class="d-flex mb-3 align-items-center">
                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-diesel"></span></div>
                                <div class="text">
                                    <h3 class="heading mb-0 pl-3">
                                        Fuel
                                        <span><?= $Fuel ?></span>
                                    </h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm">
                    <form method="post" id="OfferSubmit" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="" class="label">Offer Code</label>
                            <input type="text" class="form-control" name="offercode" id="offercode" placeholder="Offer code" size="15"  onkeypress="return (event.charCode > 64 && event.charCode < 91)">
                        </div>
                        <div class="form-group">
                            <input type="submit"  name="ApplySubmit"  id="ApplySubmit" value="Apply Offer" class="btn btn-secondary py-3 px-4">
                        </div>
                    </form>
<!--                    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->
                    <script>
                        $(document).ready(function () {
                            $("#OfferSubmit").submit(function (event) {
                                // Stop form from submitting normally
                                event.preventDefault();

                                // Get form data
                                var code12 = document.getElementById("offercode").value;
                                // Submit form data using AJAX
                                $.ajax({
                                    type: "POST",
                                    url: "ajaxOffer.php",
                                    data: {offerCode: code12, price: <?= $price; ?>},
                                    success: function (response) {
                                        $("#Offerresult").html(response);
                                        $.ajax({
                                            type: "POST",
                                            url: "ajaxbooking.php",
                                            data: {offerCode: code, price: <?= $price; ?>, securityD: <?= $securityD; ?>},
                                            success: function (response) {
                                                $("#Bookingresult").html(response);
                                            },
                                            error: function () {
                                                alert("Error selecting records");
                                            }
                                        });

                                    },
                                    error: function () {
                                        alert("Error selecting records");
                                    }
                                });


                            });
                        });
                    </script>
                </div>
                <div class="col-sm">
                    <div class="row">
                        <div class="col-sm">
                            <h6>Booking Amount</h6>
                        </div>
                        <div class="col-sm">
                            <?= $price; ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6>Insurance & All taxes</h6>
                        </div>
                        <div class="col-sm">
                            (Included)
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6>Refundable security deposit</h6>
                        </div>
                        <div class="col-sm">
                            <?= $securityD; ?>
                        </div>
                    </div>

                    <p id='Offerresult'></p>

                    <b><hr style="height: 6px;"></b>
                    <div class="row">
                        <div class="col-sm">
                            <h5>Total Amount</h5>
                        </div>
                        <div class="col-sm">
                            <?php
                            $TotalAmount = $securityD + $price;
                            ?>
                            <h4 id="Bookingresult">
                                <?php echo $TotalAmount; ?>
                            </h4>
                        </div>
                    </div>
                    <form method="post" enctype="multipart/form-data">
                        <div class="col-md-12">
                            <input type="submit" name="BOOKCARNOW" id="BOOKCARNOW" value="Book Now" class="btn btn-secondary py-3 px-4">
                        </div>
                    </form>
                </div>
                <div class="col-sm">
                    <div class="row">
                        <div class="col-sm">
                            <h6>PICK-UP &<br/> DROP-OFF Address:</h6>
                        </div>
                        <?php
                        $cityAddress = $conn->prepare("SELECT * FROM city WHERE City =? ");
                        $cityAddress->bind_param("s", $_SESSION['City']);
                        $cityAddress->execute();
                        $resultcity = $cityAddress->get_result()->fetch_all(MYSQLI_ASSOC);

                        foreach ($resultcity as $row) {
                            $City_Id = $row['City_Id'];
                            $PICKUP = $row['Address'];
                        }
                        ?>
                        <div class="col-sm">
                            <h6><?= $PICKUP; ?></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6>Total KMS:</h6>
                        </div>
                        <div class="col-sm">
                            <h6><?= $_SESSION['kms']; ?> KMS</h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm">
                            <h6>Extra kms charge:</h6>
                        </div>
                        <div class="col-sm">
                            <h6><i class="fa-solid fa-indian-rupee-sign"></i> <?= $Car_hire_cost; ?> (per KMS)</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>

    </script>
    <?php
    if (isset($_POST['BOOKCARNOW'])) {
        $email = $_SESSION['CustomerEmail'];
        $R_no = $id;

        $Start_Date = $_SESSION['Start_Date'];
        $End_Date = $_SESSION['End_Date'];
        $Start_Timehm = $_SESSION['Start_Time'];
        $End_Timehm = $_SESSION['End_Time'];

        $Start_Time = date("H:i:s", strtotime($Start_Timehm));
        $End_Time = date("H:i:s", strtotime($End_Timehm));
        if (isset($_SESSION['OfferCode'])) {
            $Offerbook = $_SESSION['OfferCode'];
            $TotalAmount = $_SESSION['TotalAmount'];
        } else {
            $Offerbook = 0;
            $TotalAmount = $securityD + $price;
        }

        $current_date = date('Y-m-d');
        $booking_id = strval(rand(100000, 999999));

        if ($current_date < $Start_Date) {
            $booking_status = 'Pending';
        } elseif ($current_date >= $Start_Date && $current_date <= $End_Date) {
            $booking_status = 'Current';
        } elseif ($current_date > $End_Date) {
            $booking_status = 'Completed';
        }

        $Selected_Kms = $_SESSION['kms'];
        $booking12 = $conn->prepare("INSERT INTO booking(Booking_Id,Email,Registration_No,City_Id,Start_Date, End_Date,Start_Time,End_Time, Security_Deposit,Selected_Kms,Offer, Amount,Booking_Date,Status) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?);");
        $booking12->bind_param("ssssssssssddss", $booking_id, $email, $R_no, $City_Id, $Start_Date, $End_Date, $Start_Time, $End_Time, $securityD, $Selected_Kms, $Offerbook, $TotalAmount, $current_date, $booking_status);
        $booking1 = $booking12->execute();

        if ($booking1 > 0) {
            unset($_SESSION['OfferCode']);
//            unset($_SESSION['TotalAmount']);
            echo "<script>alert('Booking succesfull');</script>";
            echo "<script>window.location.href='History.php'</script>";
        } else {
            echo "<script>alert('not a booking');</script>";
        }
    }
    ?>

    <section class="ftco-section ftco-no-pt" style="margin-top: 4rem;">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12 heading-section text-center ftco-animate mb-5">
                    <span class="subheading">Choose Car</span>
                    <h2 class="mb-2">Related Cars</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="carousel-car owl-carousel">
                        <?php
                        $sql = $conn->prepare("SELECT * FROM car WHERE City_Id =?");
                        $sql->bind_param("s", $city);
                        $sql->execute();
                        $resultCar = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
                        $counter = 0;
                        if (count($resultCar) > 0) {
                            foreach ($resultCar as $row ) {
                                $counter++;
                                if ($counter >= 5) {
                                    break;
                                }
                                $Status = $row['Status'];
                                if ($Status == 'Deactive') {
                                    
                                } else {
                                    $Registration_no = $row['Registration_No'];
                                    $Car_name = $row['Name'];
                                    $ModelYear = $row['ModelYear'];
                                    $Image = $row['Image'];
                                    $Car_hire_cost = $row['Hire_Cost'];
                                    $Speed = $row['Speed'];
                                    $Category_id = $row['Category_Id'];
                                    $Category = $conn->prepare("SELECT * FROM car_category WHERE Category_Id =? ");
                                    $Category->bind_param("s", $Category_id);
                                    $Category->execute();
                                    $resultCategory = $Category->get_result()->fetch_all(MYSQLI_ASSOC);
                                    if (count($resultCategory) > 0) {
                                        foreach ($resultCategory as $row) {
                                            $Seats = $row['Seats'];
                                            $Fuel = $row['Fuel'];
                                            $Transmission = $row['Transmission'];
                                        }
                                    } else {
                                        echo "<script>alert('not a Category_id');</script>";
                                    }
                                    ?>
                                    <div class="item">
                                        <div class="car-wrap rounded ftco-animate" >
                                            <div class="splide splide--card car__slider splide--loop splide--ltr splide--draggable is-active is-initialized" id="splide02">
                                                <div class="splide__track" id="splide02-track" style="padding-left: 0px; padding-right: 0px;">
                                                    <img src="Admin/images/CarImg/<?php echo $Image; ?>" style="height: 200px;" alt="hy">
                                                </div>
                                            </div>
                                            <div class="car__title">
                                                <h3 class="car__name">
                                                    <a href="car.php" ><?= $Car_name; ?></a>
                                                </h3>
                                                <span class="car__year"><?= $ModelYear; ?></span>
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
                                                    $price = $Car_hire_cost * 192;
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
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include 'footerlink.php';
    ?>
</body>
</html>