<!DOCTYPE html>
<html lang="en">
<head>
    <title>Admin</title>
    <?php
    include 'Design/headerLinks.php';
    include 'Design/sessionWithoutLogin.php';
    include 'Design/databaseConnection.php';
    ?>
</head>
<body id="page-top">
<div id="wrapper">
    <?php
    include 'Design/sidebar.php';
    ?>
    <div id="content-wrapper" class="d-flex flex-column">
        <?php
        include 'Design/header.php';

        $id = base64_decode(strval($_GET['id']));
        $query = $conn->prepare("SELECT * FROM admin where Email=?");
        $query->bind_param("s", $id);
        $result = $query->execute();
        $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);
        foreach ($result as $row) {
        $Admin_name = $row['Name'];
        $Admin_email_id = $row['Email'];
        $Status = $row['Status'];
        $Role = $row['Role_Id'];

        $City_Id = $row['City_Id'];

        }
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div>
                                <h4 class="m-0 font-weight-bold text-primary">Edit Admin</h4>
                            </div>
                        </div>
                    </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="card-body">

                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Admin_Name" name="Admin_Name" type="text" placeholder="Admin Name"
                                                  value="<?= $Admin_name ?>" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 31 && event.charCode < 33)" required/>
                                            <label for="Admin_Name">Admin Name</label>
                                            <span id="name"></span>

                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Admin_Email_Id" name="Admin_Email_Id"   disabled="disabled"  type="email" placeholder="Admin Email Id" value="<?= $Admin_email_id ?>" autocomplete="off" required/>
                                            <label for="Admin_Email_Id">Admin Email Id</label>
                                            <span id="Email"></span>
                                        </div>

                                        <div class="form-floating mb-3" >
                                            <select class="form-select" name="Status" required>
                                                <?php
                                                if ($Status == 'Deactive') {
                                                    echo "<option>Active</option><option selected>Deactive</option>";
                                                } else {
                                                    echo "<option selected>Active</option><option>Deactive</option>";
                                                }
                                                ?>
                                            </select>
                                            <label for="Status">Status</label>
                                        </div>

                                        <div class="form-floating mb-3" >
                                            <select class="form-select" name="Role1" required>
                                                <?php
                                                $query = "SELECT * FROM role_menu";
                                                $result = $conn->query($query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $Rname = $row['Name'];
                                                    $Role_Id = $row['Role_Id'];
                                                    ?>
                                                    <option  value="<?= $Role_Id ?>">
                                                        <?= $Rname; ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <label for="Role">Role</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <select class="form-select" name="city" required>
                                                <?php
                                                $query = "SELECT City_Id, City FROM city";
                                                $result = $conn->query($query);
                                                while ($row = mysqli_fetch_array($result)) {
                                                    $cityId = $row['City_Id'];
                                                    $cityName = $row['City'];
                                                    ?>
                                                    <option value="<?= $cityId ?>">
                                                        <?= $cityName ?>
                                                    </option>
                                                    <?php
                                                }
                                                ?>
                                            </select>
                                            <label for="City">City</label>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <input type="submit" name="Adminupdate" id="Adminupdate" class="btn btn-primary btn-lg"
                                                   value="Edit Admin">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    <?php
                    if (isset($_POST['Adminupdate'])) {
                        $Admin_Name = $_POST['Admin_Name'];
                        $Status = $_POST['Status'];
                        $Role1 = $_POST['Role1'];
                        $city1 = $_POST['city'];

                        $admin = $conn->prepare("CALL UpdateAdmin(?,?,?,?,?)");
                        $admin->bind_param("sisss", $Admin_Name,  $Role1, $city1, $Status, $Admin_email_id);
                        $Addadmin = $admin->execute();
                        if ($Addadmin == 1) {

                            echo "<script>window.location.href='admin.php'</script>";
                        } else {
                            echo "<script> alert('$conn->error');</script>";
                        }
                    }
                    $conn->close();
                    ?>
                </div>

            </main>
        </div>
        <!-- End admin -->
    </div>
</div>
<!-- End of Main Content -->
<?PHP include 'Design/footerLinks.php'; ?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.6/jquery.min.js" type="text/javascript"></script>
<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js" type="text/javascript"></script>
<link href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/start/jquery-ui.css" rel="Stylesheet" type="text/css"/>

</body>
</html>