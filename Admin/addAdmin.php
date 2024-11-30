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
        ?>

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <main>
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <div class="row">
                            <div>
                                <h4 class="m-0 font-weight-bold text-primary">Add Admin</h4>
                            </div>
                        </div>
                    </div>

                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="card-body">

                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Admin_Name" name="Admin_Name" type="text" placeholder="Admin Name" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 31 && event.charCode < 33)" required/>
                                            <label for="Admin_Name">Admin Name</label>
                                            <span id="name"></span>

                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Admin_Email_Id" name="Admin_Email_Id" type="email" placeholder="Admin Email Id" required/>
                                            <label for="Admin_Email_Id">Admin Email Id</label>
                                            <span id="Email"></span>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Admin_Password" name="Admin_Password" type="password" placeholder="Admin Password" title="Password must be at least 8 characters and contain at least one number and one special symbol." required/>
                                            <label for="Admin_Password">Admin Password</label>
                                            <span id="pass"></span>
                                        </div>

                                        <div class="form-floating mb-3" >
                                            <select class="form-select" name="Status" required>
                                                <option selected>Active</option>
                                                <option>Deactive</option>
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
                                            <input type="submit" name="Adminsubmit" id="Adminsubmit" class="btn btn-primary btn-lg"
                                                   value="Add Admin">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>
                <?php
                if (isset($_POST['Adminsubmit'])) {
                    $Admin_Name = $_POST['Admin_Name'];
                    $Admin_Email_Id = $_POST['Admin_Email_Id'];
                    $Admin_Password = $_POST['Admin_Password'];
                    $Status = $_POST['Status'];
                    $Role = $_POST['Role1'];
                    $city = $_POST['city'];

                    $uppercase = preg_match('@[A-Z]@', $Admin_Password);
                    $lowercase = preg_match('@[a-z]@', $Admin_Password);
                    $number = preg_match('@[0-9]@', $Admin_Password);
                    $specialChars = preg_match('@[^\w]@', $Admin_Password);

                    $CheckP = $conn->prepare("SELECT * FROM admin WHERE Email = ?");
                    $CheckP->bind_param("s", $Admin_Email_Id);
                    $result = $CheckP->execute();
                    $result = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);
//                  print_r($result);
//                  exit();
                    if (!count($result) > 0) {
                        if (!$uppercase || !$lowercase || !$number || !$specialChars || strlen($Admin_Password) < 8) {
                            echo "<script>pass();</script>";
                        } else {
                                $stmt = $conn->prepare("CALL AddAdminProcedure(?,?,?,?,?,?)");
                                $stmt->bind_param("ssssss", $Admin_Name, $Admin_Email_Id, $Admin_Password, $Role, $city ,$Status);
                                $AddAdmin = $stmt->execute();

                            if ($AddAdmin > 0) {
                                echo "<script>window.location.href='Admin.php'</script>";
                            } else {
                                echo "<script> alert('$conn->error');</script>";
                            }
                        }
                    } else {
                        echo "<script>alreadyexistEmail();</script>";
                    }
                }
                $conn->close();
                ?>
            </main>
        </div>
        <!-- End admin -->
    </div>
</div>
<!-- End of Main Content -->
<?PHP include 'Design/footerLinks.php'; ?>
</body>
</html>