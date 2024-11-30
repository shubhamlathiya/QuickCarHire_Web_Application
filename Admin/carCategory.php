<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Car Category</title>
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
                        <div class="card shadow mb-4">
                            <form method="post" enctype="multipart/form-data">
                                <div class="card-header py-3">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <h2 class="m-0 font-weight-bold text-primary">Car Category</h2>
                                        </div>
                                        <div class="col-lg-4">
                                            <a href="AddCategory.php" class="btn btn-primary">+Add Category</a>
                                            <input type="submit" class="btn btn-primary" name="Category" id="but_delete" value="Delete Category">
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Category Id</th>
                                                    <th scope="col">Category Name</th>
                                                    <th scope="col">Seats</th>
                                                    <th scope="col">Fuel</th>
                                                    <th scope="col">Transmission</th>
                                                    <th scope="col">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM car_category";
                                                $result = $conn->query($query);
                                                $id = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $Category_id = $row['Category_Id'];
                                                    $Category_name = $row['Category_Name'];
                                                    $Seats = $row['Seats'];
                                                    $Fuel = $row['Fuel'];
                                                    $Transmission = $row['Transmission'];
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><input type='checkbox' name='delete[]' value='<?= $Category_id ?>'></td>
                                                        <td><?= $Category_id ?></td>
                                                        <td><?= $Category_name ?></td>
                                                        <td><?= $Seats ?></td>
                                                        <td><?= $Fuel ?></td>
                                                        <td><?= $Transmission ?></td>
                                                        <td><a href="editCarCategory.php?id=<?= base64_encode($Category_id); ?>"><i class="fa fa-edit"></i></a></td>
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
                        <?php
                        if (isset($_POST['Category'])) {

                            if (isset($_POST['delete'])) {
                                foreach ($_POST['delete'] as $deleteid) {
                                    $deleteCategory = $conn->prepare("DELETE from car_category WHERE Category_Id=?");
                                    $deleteCategory->bind_param("s", $deleteid);
                                    try {
                                        $deleteCategory->execute();
                                    } catch (mysqli_sql_exception $e) {
//                                       $errorMessage = $e->getMessage();
                                        echo "<script> alert('this $deleteid Car Category not be deleted!');  </script>";
                                    }
                                }
                                echo "<script>window.location.href='carCategory.php'</script>";
                            } else {
                                echo '<script>Checkboxseleted();</script>';
                            }
                        }
                        ?>
                    </main>
                </div>
            </div>
        </div>
        <!-- End of Main Content -->
        <?PHP include './Design/footerLinks.php'; ?>


    </body>
</html>