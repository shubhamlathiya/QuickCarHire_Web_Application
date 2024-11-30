<!DOCTYPE html>
<html lang="en">
    <head>
    <head>
        <title>QuickCarHire | History</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
        include 'headlink.php';
        include "DatabaseConnection.php";
        include "Sessionwithoutlogin.php";
        include "Header.php";
        ?>
        <style>
            .alert {
                padding: 15px;
                border: 1px solid transparent;
                border-radius: 4px;
            }

            .alert-success {
                background-color: #d4edda;
                color: #155724;
                border-color: #c3e6cb;
            }
        </style>
    </head>
</head>
<body>
    <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
        <div class="overlay"></div>
        <div class="container">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start">
                <div class="col-md-9 ftco-animate pb-5">
                    <p class="breadcrumbs"><span class="mr-2"><a href="index.html">Home <i class="ion-ios-arrow-forward"></i></a></span> <span>My Booking<i class="ion-ios-arrow-forward"></i></span></p>
                    <h1 class="mb-3 bread">My Booking</h1>
                </div>
            </div>
        </div>
    </section>


    <section>
        <div class="container" style="max-width: 1590px;margin-top: 2rem;margin-bottom: 2rem;text-align: center;">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Registration No</th>
                        <th scope="col">Name</th>
                        <th scope="col">Img</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Address</th>
                        <th scope="col">Offer</th>
                        <th scope="col">Total Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $CustomerEmail = $_SESSION['CustomerEmail'];
                    $currentDate = date('Y-m-d');
                    //                    $query = "SELECT * FROM bookings WHERE booking_date = '$currentDate'";
                    $sql1 = $conn->prepare("SELECT * FROM booking WHERE Email = ? ORDER BY Booking_Date DESC");
                    $sql1->bind_param("s", $CustomerEmail);
                    $sql1->execute();
                    $history = $sql1->get_result()->fetch_all(MYSQLI_ASSOC);

                    if (count($history) > 0) {
                        $i = 0;
                        foreach ($history as $row) {
                            $car = $row['Registration_No'];
//          SELECT Image FROM car WHERE Registration_No = GJ01DS4434;
                            $sql = $conn->prepare("SELECT * FROM car WHERE Registration_No = ?");
                            $sql->bind_param("s", $car);
                            $sql->execute();
                            $carimg = $sql->get_result()->fetch_all(MYSQLI_ASSOC);
                            foreach ($carimg as $row1) {
                                $name = $row1['Name'];
                                $img = $row1['Image'];
                            }
                            $i++;
                            ?>
                            <tr id='tr_<?= $i; ?>'>
                                <td><b><?= $i; ?></b></td>
                                <td><?= $row['Registration_No']; ?></td>
                                <td><?= $name; ?></td>
                                <td>
                                    <img src="Admin/CarImg/<?= $img; ?>" width="100px" height="100px" alt="hy"><br/>
                                </td>
                                <td><?= date("d-m-Y", strtotime($row['Start_Date'])); ?></td>
                                <td><?= date("d-m-Y", strtotime($row['End_Date'])); ?></td>
                                <td>
                                    <?php
                                    $sql2 = $conn->prepare("SELECT Address FROM city JOIN booking ON city.City_Id = booking.City_Id WHERE booking.Booking_Id = ?");
                                    $sql2->bind_param("s", $row['Booking_Id']);
                                    $sql2->execute();
                                    $address = $sql2->get_result()->fetch_assoc()['Address'];
                                    echo $address;
                                    ?>
                                </td>
                                <td><?= $row['Offer']; ?></td>
                                <td><b><?= $row['Amount']; ?></b></td>
                            </tr>
                            <?php
                        }
                    } else {
                                echo '<div class="alert alert-success" role="alert" style="margin-top:1rem; ">No Any Booking found!</div>';
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </section>

    <?php
    include 'footerlink.php';
    ?>
</body>
</html>