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
            </script>
            <div id="content-wrapper" class="d-flex flex-column">
                <?php
                include './Design/header.php';
                ?>
                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <main>
                        <form method="post" ENCTYPE="multipart/form-data">
                        <!-- DataTales Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row">
                                    <div class="col-lg-9">
                                        <h2 class="m-0 font-weight-bold text-primary">Offer</h2>
                                    </div>
                                    <div class="col-lg-3">
                                        <a href="addOffer.php" class="btn btn-primary">+Add Offer</a>
                                        <input type="submit" class="btn btn-primary" name="Offers_delete" id="but_delete" value="Delete Offers">
                                    </div>
                                </div>
                            </div>
                            <?php
                            if (isset($_GET["Status"]) && $_GET["Status"] == 'Deactive') {
                                $id = $_GET["id"];
                                // Activate user
                                $sql = "UPDATE offer SET Status='active' WHERE Code = '$id'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>window.location.href='offer.php'</script>";
                                } else {
                                    echo "Error activating user: " . mysqli_error($conn);
                                }
                            }

                            if (isset($_GET["Status"]) && $_GET["Status"] == 'active') {
                                $id = $_GET["id"];
                                // Activate user
                                $sql = "UPDATE offer SET Status='Deactive' WHERE Code = '$id'";
                                if (mysqli_query($conn, $sql)) {
                                    echo "<script>window.location.href='offer.php'</script>";
                                } else {
                                    echo "Error activating user: " . mysqli_error($conn);
                                }
                            }
                            ?>

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col"></th>
                                                    <th scope="col">Code</th>
                                                    <th scope="col">Name</th>
                                                    <th scope="col">Image</th>
                                                    <th scope="col">Percentage</th>
                                                    <th scope="col">Start Date</th>
                                                    <th scope="col">End Date</th>
                                                    <th scope="col">City</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM offer";
                                                $result = $conn->query($query);
                                                $id = 1;
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $Oid = $row['Code'];
                                                    $Offer_Code = $row['Code'];
                                                    $Offer_Name = $row['Name'];
                                                    $Image = $row['Image'];
                                                    $Offer_Amount = $row['Percentage'];
                                                    $Offer_Start_Date = $row['Start_Date'];
                                                    $Offer_End_Date = $row['End_Date'];
                                                    $Offer_Status = $row['Status'];
                                                    $Offer_City = $row['City_Id'];
                                                    $current_date = date("Y-m-d");


                                                    if (strtotime($Offer_Start_Date) == strtotime($current_date)) {
                                                        $Status = 'Current';
                                                        $StartOffer = $conn->prepare(" UPDATE offer SET Status=? WHERE Code =?");
                                                        $StartOffer->bind_param("ss", $Status, $Oid);
                                                        $StartOffer->execute();
                                                    }

                                                    if ($current_date >= $Offer_End_Date) {
                                                        $Status = 'Completed';
                                                        $EndOffer = $conn->prepare(" UPDATE offer SET Status=? WHERE Code =?");
                                                        $EndOffer->bind_param("ss", $Status, $Oid);
                                                        $EndOffer->execute();
                                                    }
                                                    ?>
                                                    <tr id='tr_<?= $id ?>'>
                                                        <td><input type='checkbox' name='delete[]' value='<?= $Offer_Code ?>'></td>
                                                        <td><?= $Offer_Code ?></td>
                                                        <td><?= $Offer_Name ?></td>
                                                        <td>
                                                            <img src="images/Offerimg/<?php echo $Image; ?>" width="100px" height="100px"><br/>
                                                        </td>
                                                        <td><?= $Offer_Amount . "%" ?></td>
                                                        <td><?= $Offer_Start_Date ?></td>
                                                        <td><?= $Offer_End_Date ?></td>
                                                        <?php

                                                            $sqlc = "SELECT City FROM city WHERE City_Id = '$Offer_City'";
                                                            $acity = $conn->query($sqlc);
                                                            while ($nc = mysqli_fetch_array($acity)) {
                                                                $c = $nc['City'];
                                                        }
                                                        ?>
                                                        <td><?= $c ?></td>
                                                        <td>
                                                            <?php
                                                            if ($Offer_Status == 'Completed') {
                                                                echo "<a href='offer.php?id=$Offer_Code&Status=Deactive'><span class='badge badge-secondary'>$Offer_Status</span>";
                                                            } else {
                                                                echo "<a href='offer.php?id=$Offer_Code&Status=active'><span class='badge badge-success' >$Offer_Status</span>";
                                                            }
                                                            ?>
                                                        </td>
                                                        <td><a href="editOffer.php?id=<?= base64_encode($Offer_Code); ?>"><i class="fa fa-edit"></i></a></td>
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
                        if (isset($_POST['Offers_delete'])) {

                            if (isset($_POST['delete'])) {
                                foreach ($_POST['delete'] as $deleteid) {
                                    $deleteOffer = $conn->prepare("DELETE from offer WHERE Code=?");
                                    $deleteOffer->bind_param("s", $deleteid);
                                    try {
                                        $deleteOffer->execute();
                                    } catch (mysqli_sql_exception $e) {
                                        $errorMessage = $e->getMessage();
                                        echo "<script>alert('$errorMessage');</script>";
                                    }
                                }
                                echo "<script>window.location.href='offer.php'</script>";
                                $msg = "Offer record deleted successfully";
                            } else {
                                echo '<script>Checkboxseleted();</script>';
                            }
                        }
                        ?>
                    </main>
                </div>
            </div>
            <!-- End of Main Content -->
            <?PHP include './Design/footerLinks.php'; ?>
    </body>
</html>