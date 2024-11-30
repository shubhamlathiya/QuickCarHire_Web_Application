<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Booking</title>
        <?php
        include './Design/headerLinks.php';
        include './Design/sessionWithoutLogin.php';
        include './Design/databaseConnection.php';
        ?>
    </head>
    <body id="page-top">
        <div id="wrapper">
            <?php
            include './Design/sidebar.php';
            ?>
            <div id="content-wrapper" class="d-flex flex-column">
                <?php
                include './Design/header.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h2 class="m-0 font-weight-bold text-primary">Booking</h2>
                            </div>

                            <form method="post" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr style=" position: sticky;">
                                                    <th scope="col">Email Id</th>
                                                    <th scope="col">Registration no</th>
                                                    <th scope="col">Start date</th>
                                                    <th scope="col">End date</th>
                                                    <th scope="col">Start meter</th>
                                                    <th scope="col">end meter</th>
                                                    <th scope="col">start time</th>
                                                    <th scope="col">End time</th>
                                                    <th scope="col">Security deposit</th>
                                                    <th scope="col">Booking amount</th>
                                                    <th scope="col">Booking_Date</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM booking";
                                                $result = $conn->query($query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $bookingId = $row['Booking_Id'];
                                                    $Email_id = $row['Email'];
                                                    $Booking_start_date = $row['Start_Date'];
                                                    $Booking_end_date = $row['End_Date'];
                                                    $Start_meter = $row['Start_Meter'];
                                                    $End_meter = $row['End_Meter'];
                                                    $Start_time = $row['Start_Time'];
                                                    $End_time = $row['End_Time'];
                                                    $Security_deposit = $row['Security_Deposit'];
                                                    $Booking_amount = $row['Amount'];
                                                    $R_no = $row['Registration_No'];
                                                    $CheckP = $conn->prepare("SELECT * FROM car WHERE Registration_No = ?");
                                                    $CheckP->bind_param("s", $R_no);
                                                    $result1 = $CheckP->execute();
                                                    $result1 = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);
                                                    foreach ($result1 as $row1) {
                                                        $img = $row1['Image'];
                                                    }

                                                    $current_date = date('Y-m-d');

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

                                                    $Status = $row['Status'];
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><?= $Email_id ?></td>
                                                        <td><img src="images/CarImg/<?php echo $img; ?>" width="100px" height="100px"><br/><?= $R_no ?></td>
                                                        <td><?= $Booking_start_date ?></td>
                                                        <td><?= $Booking_end_date ?></td>
                                                        <td><?= $Start_meter ?></td>
                                                        <td><?= $End_meter ?></td>
                                                        <td><?= $Start_time ?></td>
                                                        <td><?= $End_time ?></td>
                                                        <td><?= $Security_deposit ?></td>
                                                        <td><?= $Booking_amount ?></td>
                                                        <td><?= $row['Booking_Date']; ?></td>
                                                        <td>
                                                            <?php
                                                            if ($Status == 'Current') {
                                                                echo "<span class='badge badge-primary'>$Status</span>";
                                                            } elseif ($Status == 'Completed') {
                                                                echo "<span class='badge badge-success' >$Status</span>";
                                                            } elseif ($Status == 'Pending') {
                                                                echo "<span class='badge badge-warning' >$Status</span>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            if ($Status == 'Completed') {

                                                            } elseif ($Status == 'Pending') {

                                                            } elseif ($Status == 'Current') {
                                                                ?><a href="editBooking.php?Bid=<?= base64_encode($bookingId); ?>"><i class="fa fa-edit"></i></a>
                                                                <?php }
                                                                ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $id++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </main>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './Design/footerLinks.php'; ?>
    </body>
</html>