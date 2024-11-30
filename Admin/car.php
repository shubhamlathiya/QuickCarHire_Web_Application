<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Car</title>
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
            <script>
                function Checkboxseleted() {
                    alert('Please Select any one check box!');
                }
                $(document).ready(function () {
                    $('#Car').DataTable();
                });
            </script>
            <div id="content-wrapper" class="d-flex flex-column">
                <?php
                include './Design/header.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <form method="post" enctype="multipart/form-data">
                            <!-- DataTales Example -->
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <h2 class="m-0 font-weight-bold text-primary">Car</h2>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="AddCar.php" class="btn btn-primary">+Add Car</a>
                                            <input type="submit" class="btn btn-primary" name="Car_delete" id="but_delete" value="Delete Car">
                                        </div>
                                    </div>
                                </div>

                                <?php
                                if (isset($_GET["Status"]) && $_GET["Status"] == 'Deactive') {
                                    $id = $_GET["id"];
                                    // Activate user
                                    $sql = "UPDATE car SEt Status= 'active' WHERE Registration_no = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='car.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }


                                if (isset($_GET["Status"]) && $_GET["Status"] == 'active') {
                                    $id = $_GET["id"];
                                    // Activate user
                                    $sql = "UPDATE car SEt Status= 'Deactive' WHERE Registration_No = '$id'";
                                    if (mysqli_query($conn, $sql)) {
                                        echo "<script>window.location.href='car.php'</script>";
                                    } else {
                                        echo "Error activating user: " . mysqli_error($conn);
                                    }
                                }
                                ?>
                                <div id="Reportresult"></div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr style=" position: sticky;">
                                                    <th scope="col"></th>
                                                    <th scope="col">R. No</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Brand</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Category</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Hire Cost</th>
                                                    <th scope="col">Mileage</th>
                                                    <th scope="col">Booking Status</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody >
                                                <?php
                                                $query = "SELECT * FROM car";
                                                $result = $conn->query($query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $R_no = $row['Registration_No'];
                                                    $Car_name = $row['Name'];
                                                    $Car_brand = $row['Brand'];
                                                    $Image = $row['Image'];
                                                    $City = $row['City_Id'];
                                                    $Category_id = $row['Category_Id'];
                                                    $Car_Status = $row['Status'];
                                                    $Car_hire_cost = $row['Hire_Cost'];
                                                    $Speed = $row['Speed'];
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><input type='checkbox' name='delete[]' value='<?= $R_no ?>'></td>
                                                        <td><?= $R_no ?></td>
                                                        <td><?= $Car_name ?></td>
                                                        <td><?= $Car_brand ?></td>
                                                        <td>
                                                            <img src="images/CarImg/<?php echo $Image; ?>" width="100px" height="100px"><br/>
                                                            <?php // echo $Image  ?>
                                                        </td>
                                                        <td><?= $City ?></td>
                                                        <td><?= $Category_id ?></td>
                                                        <td>
                                                            <?php
                                                            if ($Car_Status == 'Deactive') {
                                                                echo "<a href='car.php?id=$R_no&Status=Deactive'><span class='badge badge-secondary'>$Car_Status</span></a>";
                                                            } else {
                                                                echo "<a href='car.php?id=$R_no&Status=active'><span class='badge badge-success'>$Car_Status</span></a>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><?= $Car_hire_cost ?></td>
                                                        <td><?= $Speed ?></td>
                                                        <td>
                                                            <?php
                                                            $current_date = date("Y-m-d");
                                                            $sql1234 = "SELECT car.Registration_No, booking.Registration_No,booking.End_Date  FROM car INNER JOIN booking ON car.Registration_No = booking.Registration_No WHERE car.Registration_No = '$R_no'";
                                                            $result123 = mysqli_query($conn, $sql1234);
                                                            $row12 = mysqli_fetch_assoc($result123);
                                                            $end_date = $row12['End_Date'];

                                                            if ($end_date < $current_date) {
                                                                echo "<span class='badge badge-success'>Not Booked</spen>";
                                                            } else {

                                                                echo "<span class='badge badge-danger'>Booked </span>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><a href="editCar.php?Rid=<?= base64_encode($R_no); ?>"><i class="fa fa-edit"></i></a>

                                                            <i class="fa fa-trash-alt text-danger"></i></td>
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
                        <?php
                        if (isset($_POST['Car_delete'])) {

                            if (isset($_POST['delete'])) {
                                foreach ($_POST['delete'] as $deleteid) {
//                                    $query = "SELECT * FROM car";
//                                    $result = $conn->query($query);
//                                    foreach ($result as $row) {
//                                        $Image = $row['Image'];
//                                    }
                                    $deleteCar = $conn->prepare("DELETE from car WHERE Registration_No=?");
                                    $deleteCar->bind_param("s", $deleteid);
                                    try {
                                        $deleteCar->execute();
                                    } catch (mysqli_sql_exception $e) {
                                        $errorMessage = $e->getMessage();
                                        echo "<script>alert('$errorMessage');</script>";
                                    }
                                }
//                                unlink("CarImg/$Image");
                                echo "<script>window.location.href='car.php'</script>";
                            } else {
                                echo '<script>Checkboxseleted();</script>';
                            }
                        }

//                        if(){
////                            DELETE FROM `car` WHERE `Registration_No` =
//                        }
                        ?>
                    </main>
                </div>
            </div>
        </div>
    </div>
    <?PHP include './Design/footerLinks.php'; ?>

</body>
</html>