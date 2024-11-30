<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Customer</title>
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
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h2 class="m-0 font-weight-bold text-primary">Customer</h2>
                            </div>

                            <?php
                            if (isset($_GET["Status"]) && $_GET["Status"] == 'Deactive') {
                                $id = $_GET["id"];
                                // Activate user
                                $sql = "UPDATE customer SEt Status= 'active' WHERE Email = '$id'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>window.location.href='customer.php'</script>";
                                } else {
                                    echo "Error activating user: " . mysqli_error($conn);
                                }
                            }

                            if (isset($_GET["Status"]) && $_GET["Status"] == 'active') {
                                $id = $_GET["id"];
                                // Activate user
                                $sql = "UPDATE customer SEt Status= 'Deactive' WHERE Email = '$id'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>window.location.href='customer.php'</script>";
                                } else {
                                    echo "Error activating user: " . mysqli_error($conn);
                                }
                            }
                            ?>
                            <form method="post">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Id</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Mobile No</th>
                                                    <th scope="col">Date Of Birth</th>
                                                    <th scope="col">Driving Licence</th>
                                                    <th scope="col">AadharCard Number</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM customer";
                                                $result = $conn->query($query);
                                                $id = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><?= $row['Customer_Id']; ?></td>
                                                        <td><?= $row['Name']; ?></td>
                                                        <td><?= $Email = $row['Email']; ?></td>
                                                        <td><?= $row['Mobile']; ?></td>
                                                        <td><?= $row['Date_Of_Birth']; ?></td>
                                                        <td><?= $row['Driving_Licence']; ?></td>
                                                        <td><?= $row['AadharCard']; ?></td>
                                                        <td>
                                                            <?php
                                                            $Status = $row['Status'];
                                                            if ($Status == 'Deactive') {
                                                                echo "<a href='customer.php?id=$Email&Status=Deactive'><span class='badge badge-secondary'>$Status</span></a>";
                                                            } else {
                                                                echo "<a href='customer.php?id=$Email&Status=active'><span class='badge badge-success'>$Status</span></a>";
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $id++;
                                                }
                                                ?>
                                                <?php
                                                if (isset($_POST['customer_delete'])) {

                                                    if (isset($_POST['delete'])) {
                                                        foreach ($_POST['delete'] as $deleteid) {
                                                            $deleteCustomer = $conn->prepare("DELETE from customer WHERE Email=?");
                                                            $deleteCustomer->bind_param("s", $deleteid);
                                                            $deleteCustomer->execute();
                                                        }
                                                        echo "<script>window.location.href='customer.php'</script>";
                                                    } else {
                                                        echo '<script>Checkboxseleted();</script>';
                                                    }
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