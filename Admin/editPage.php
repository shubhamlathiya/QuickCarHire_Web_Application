<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Page</title>

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

    </head>

    <body>
        <!-- Page Wrapper -->
        <div id="wrapper">

            <?php
            include './DatabaseConnection.php';
            //            include './Sessionwithoutlogin.php';
            include './header.php';
            ?>
            <!-- Begin Page Content -->
            <div class="container-fluid">
                <main>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Edit Pages</h6>
                        </div>

                        <form method="post">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable">
                                        <thead>
                                            <tr style=" position: sticky;">
                                                <th scope="col"></th>
                                                <th scope="col">Page Name</th>
                                                <th scope="col">Page type</th>
                                                <th scope="col">Page Edit</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $query = "SELECT * FROM Page";
                                            $result = $conn->query($query);
                                            $id = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                                $Page_id = $row['Page_id'];
                                                $Page_name = $row['Page_name'];
                                                $Page_type = $row['Page_type'];
                                                ?>
                                                <tr id='tr_<?= $id ?>'>
                                                    <td><input type='checkbox' name='delete[]' value='<?= $Page_id ?>'></td>
                                                    <td><?= $Page_name ?></td>
                                                    <td><?= $Page_type ?></td>
                                                    <td><a href="editPage.php?Pid=<?= base64_encode($Page_id); ?>"><i class="fa fa-edit"></i></a></td>
                                                </tr>
                                                <?php
                                                $id++;
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                    <a href="AddPage.php" class="btn btn-primary">+Add Page</a>
                                    <input type="submit" class="btn btn-primary" name="Page_delete" id="but_delete" value="Delete Pages">
                                    <?php
                                    if (isset($_POST['Page_delete'])) {

                                        if (isset($_POST['delete'])) {
                                            foreach ($_POST['delete'] as $deleteid) {
                                                $deleteOffer = $conn->prepare("DELETE from Page WHERE Page_id=?");
                                                $deleteOffer->bind_param("s", $deleteid);
                                                $deleteOffer->execute();
                                            }
                                            echo "<script>window.location.href='Page.php'</script>";
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
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    </div>


    <?php include './footerLink.php'; ?>


</body>

</html>