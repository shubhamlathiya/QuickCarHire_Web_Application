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
                                <h4 class="m-0 font-weight-bold text-primary">Add Category</h4>
                            </div>
                        </div>
                    </div>
                    <form method="post">
                        <div class="card-body">
                            <div class="table-responsive">
                                <div class="card-body">

                                    <form method="post" enctype="multipart/form-data">

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="Category_Id" name="Category_Id" type="text"
                                                   placeholder="Category Id"
                                                   onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 47 && event.charCode < 58)"
                                                   MAXLENGTH="10" required/>
                                            <label for="Category_Id">Category Id</label>
                                            <span id="Exit_Id"></span>
                                        </div>

                                        <div class="form-floating mb-3" >
                                            <select class="form-select" name="Category_Name" required>
                                                <option selected>Sedan</option>
                                                <option>SUV</option>
                                                <option>MUV</option>
                                                <option>Hatchback</option>
                                            </select>
                                            <label for="Category_Name">Category Name</label>
                                        </div>

                                        <div class="form-floating mb-3" >
                                            <select class="form-select" name="Seats" required>
                                                <option selected>4</option>
                                                <option>5</option>
                                                <option>6</option>
                                                <option>7</option>
                                                <option>8</option>
                                            </select>
                                            <label for="Seats">Seats</label>
                                        </div>

                                        <div class="form-floating mb-3" >
                                            <select class="form-select" name="Fuel" required>
                                                <option selected>Petrol</option>
                                                <option>CNG</option>
                                                <option>Diesel</option>
                                                <option>Electric</option>
                                            </select>
                                            <label for="Fuel">Fuel</label>
                                        </div>

                                        <div class="form-floating mb-3" >
                                            <select class="form-select" name="Transmission" required>
                                                <option selected>Manual</option>
                                                <option>Automatic</option>
                                            </select>
                                            <label for="Transmission">Transmission</label>
                                        </div>
                                        <div class="d-grid gap-2">
                                            <input type="submit" name="Categorysubmit" id="Categorysubmit" class="btn btn-primary btn-lg"
                                                   value="Add Category">
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </form>
                </div>

                <script type="text/javascript">
                    function alreadyexistId() {
                        $("#Exit_Id").append("This Category Id is already exist!");
                        $("#Exit_Id").css("color", "red");
                    }
                </script>
                <?php
                if (isset($_POST['Categorysubmit'])) {
                    $Category_Id = $_POST['Category_Id'];
                    $Category_Name = $_POST['Category_Name'];
                    $Seats = $_POST['Seats'];
                    $Fuel = $_POST['Fuel'];
                    $Transmission = $_POST['Transmission'];

                    $CheckP = $conn->prepare("SELECT * FROM car_category WHERE Category_Id = ?");
                    $CheckP->bind_param("s", $Category_Id);
                    $result = $CheckP->execute();
                    $result = $CheckP->get_result()->fetch_all(MYSQLI_ASSOC);
                    //                  print_r($result);
                    //                  exit();
                    if (!count($result) > 0) {
                        $category = $conn->prepare("INSERT INTO car_category VALUES (?,?,?,?,?)");
                        $category->bind_param("sssss", $Category_Id, $Category_Name, $Seats, $Fuel, $Transmission);
                        $Addcategory = $category->execute();
                        if ($Addcategory > 0) {
                            echo "<script>window.location.href='CarCategory.php'</script>";
                        } else {
                            echo "<script> alert('$conn->error');</script>";
                        }
                    } else {
                        echo "<script>alreadyexistId();</script>";
                    }
                }
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