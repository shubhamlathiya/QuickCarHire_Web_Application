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

            <div id="content-wrapper" class="d-flex flex-column">
                <?php
                include './Design/header.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h2 class="m-0 font-weight-bold text-primary">Customer Contact</h2>
                            </div>

                            <?php
                            if (isset($_GET["id"])) {
                                $id = $_GET["id"];
                                // Activate user
                                $sql = "UPDATE Contact SET Status='Read' WHERE Contact_Id='$id'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>window.location.href = 'Contact.php'</script>";
                                } else {
                                    echo "Error activating user: " . mysqli_error($conn);
                                }
                            }
                            ?>

                            <form method="post">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr style=" position: sticky;">
                                                    <th scope="col">No</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Email</th>
                                                    <th scope="col">Subject</th>
                                                    <th scope="col">Message</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM contact";
                                                $result = $conn->query($query);
                                                $id = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $No = $row['Contact_Id'];
                                                    $Name = $row['Name'];
                                                    $Email = $row['Email'];
                                                    $sub = $row['Subject'];
                                                    $message = $row['Message'];
                                                    $Status = $row['Status'];
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><?= $No ?></td>
                                                        <td><?= $Name ?></td>
                                                        <td><?= $Email ?></td>
                                                        <td><?= $sub ?></td>
                                                        <td><?= $message ?></td>
                                                        <?php if ($Status == 'Read') {
                                                            ?><td>Read</td>
                                                        <?php } else { ?>
                                                            <td><a href="Contact.php?id=<?= $id; ?>" onclick="return confirm('Do you really want to read')">UnRead</a>
                                                            </td>
                                                        <?php } ?>
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
        <?PHP include './Design/footerLinks.php'; ?>
    </body>
</html>