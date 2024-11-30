<!DOCTYPE html>
<html lang="en">
    <head>
        <title>City</title>
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
                    $('#Booking').DataTable();
                });
            </script>
            <div id="content-wrapper" class="d-flex flex-column">
                <?php
                include './Design/header.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <div class="card shadow mb-4">
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-9">
                                            <h2 class="m-0 font-weight-bold text-primary">City</h2>
                                        </div>
                                        <div class="col-lg-3">
                                            <a href="AddCity.php" class="btn btn-primary">+Add City</a>
                                            <input type="submit" class="btn btn-primary" name="City" id="but_delete" value="Delete City">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr style=" position: sticky;">
                                                    <th scope="col"></th>
                                                    <th scope="col">City Code</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Mobile</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Address</th>
                                                    <th scope="col"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM city";
                                                $result = $conn->query($query);
                                                $id = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <tr id='tr_<?= $row['City_Id']; ?>'>
                                                        <td><input type='checkbox' name='delete[]' value='<?= $row['City_Id']; ?>'></td>
                                                        <td><?= $row['City_Id']; ?></td>
                                                        <td><?= $row['City']; ?></td>
                                                        <td><?= $row['Mobile']; ?></td>
                                                        <td><?= $row['Email']; ?></td>
                                                        <td><?= $row['Address']; ?></td>
                                                        <td><a href="editCity.php?cityid=<?= $row['City_Id']; ?>"><i class="fa fa-edit"></i></a></td>
                                                    </tr>
                                                    <?php
                                                    $id++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                        <?php
                                        if (isset($_POST['City'])) {
                                            if (isset($_POST['delete'])) {
                                                foreach ($_POST['delete'] as $deleteid) {
                                                    $deleteCar = $conn->prepare("DELETE from city WHERE City_Id=?");
                                                    $deleteCar->bind_param("s", $deleteid);
                                                    try {
                                                        $deleteCar->execute();
                                                    } catch (mysqli_sql_exception $e) {
                                                        $errorMessage = $e->getMessage();
                                                        echo "<script>alert('$errorMessage');</script>";
                                                    }
                                                }
                                                echo "<script>window.location.href='city.php'</script>";
                                            } else {
                                                echo '<script>Checkboxseleted();</script>';
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </main>
                </div>
                <!-- End city -->
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './Design/footerLinks.php'; ?>
    </body>
</html>