<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<?php
include 'DatabaseConnection.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Edit Profile</title>
        <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
        <link rel="stylesheet" type="text/css" href="css/customerprofile.css">
        <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    </head>
    <body>
        <div class="container emp-profile">
            <form method="post" enctype="multipart/form-data">
                <div class="row">
                    <div class="col-md-4">
                        <div class="container">
                            <div class="picture-container">
                                <div class="picture">
                                    <img src="https://lh3.googleusercontent.com/LfmMVU71g-HKXTCP_QWlDOemmWg4Dn1rJjxeEsZKMNaQprgunDTtEuzmcwUBgupKQVTuP0vczT9bH32ywaF7h68mF-osUSBAeM6MxyhvJhG6HKZMTYjgEv3WkWCfLB7czfODidNQPdja99HMb4qhCY1uFS8X0OQOVGeuhdHy8ln7eyr-6MnkCcy64wl6S_S6ep9j7aJIIopZ9wxk7Iqm-gFjmBtg6KJVkBD0IA6BnS-XlIVpbqL5LYi62elCrbDgiaD6Oe8uluucbYeL1i9kgr4c1b_NBSNe6zFwj7vrju4Zdbax-GPHmiuirf2h86eKdRl7A5h8PXGrCDNIYMID-J7_KuHKqaM-I7W5yI00QDpG9x5q5xOQMgCy1bbu3St1paqt9KHrvNS_SCx-QJgBTOIWW6T0DHVlvV_9YF5UZpN7aV5a79xvN1Gdrc7spvSs82v6gta8AJHCgzNSWQw5QUR8EN_-cTPF6S-vifLa2KtRdRAV7q-CQvhMrbBCaEYY73bQcPZFd9XE7HIbHXwXYA=s200-no" class="picture-src" id="wizardPicturePreview" title="">
                                    <input type="file" id="wizard-picture" name="photo" class="">
                                </div>
                                <h6 class="">Choose Picture</h6>

                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                // Prepare the preview for profile picture
                                $("#wizard-picture").change(function () {
                                    readURL(this);
                                });
                            });
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();

                                    reader.onload = function (e) {
                                        $('#wizardPicturePreview').attr('src', e.target.result).fadeIn('slow');
                                    }
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                            <h5>
                                <?php echo $_SESSION['Emailid']; ?>
                            </h5>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Name</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="fullname" class="form-control" placeholder="Full Name" onkeypress="return (event.charCode > 64 &&
                                                        event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode > 31 && event.charCode < 33)" required>
                                    </div>
                                </div><br/>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>DOB Date</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="date" name="DOB" id="DOB" class="form-control" placeholder="dd-mm-yyyy" required value="<?php if (isset($_POST["DOB"])) echo $_POST["DOB"]; ?>" min="<?php echo date('Y-m-d', strtotime('-100 years')); ?>" max="<?php echo date('Y-m-d', strtotime('-18 years')); ?>">
                                    </div>
                                </div><br/>
                                <script>
                                    $(document).ready(function () {
                                        $("#DOB").datepicker({
                                            changeMonth: true,
                                            changeYear: true,
                                            yearRange: "1980",
                                            maxDate: "-18y"
                                        });
                                    });
                                </script>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Driving Licence</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="licence_number" id="licence_number" class="form-control licence_number" placeholder="GJ0000000000000" maxlength="15" required>
                                    </div>
                                </div><br/>
                                <script>
                                    $(document).ready(function () {
                                        $("#licence_number").keyup(function (e) {
                                            $("#ErrorR_no").html('');

                                            var validstr = '';
                                            var dInput = $(this).val();
                                            var numpattern = /^\d+$/;
                                            var alphapattern = /^[A-Z]+$/;

                                            for (var i = 0; i < dInput.length; i++) {

                                                if ((i == 2 || i == 3 || i == 4 || i == 5 || i == 6 || i == 7 || i == 8 || i == 9 || i == 10 || i == 11 || i == 12 || i == 13 || i == 14 || i == 15)) {
                                                    if (numpattern.test(dInput[i])) {
                                                        // console.log('validnum' + dInput[i]);
                                                        validstr += dInput[i];
                                                    } else {
                                                        $("#ErrorR_no").html("Only Digits").show();

                                                    }
                                                }

                                                if ((i == 0 || i == 1)) {
                                                    if (alphapattern.test(dInput[i])) {
                                                        // console.log('validword' + dInput[i]);
                                                        validstr += dInput  [i];
                                                    } else {
                                                        $("#ErrorR_no").html("Only Capital Alpahbets").show();

                                                    }
                                                }

                                            }

                                            $(this).val(validstr);
                                            return false;
                                        });
                                    });

                                </script>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Phone</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="MobileNo" id="MobileNo" class="form-control MobileNo" placeholder="Mobile Number" required maxlength="10">
                                    </div>
                                </div><br/>
                                <script>
                                    $(document).ready(function () {
                                        $('#MobileNo').on('keypress', function (e) {
                                            var $this = $(this);
                                            var regex = new RegExp("^[0-9\b]+$");
                                            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                                            // for 10 digit number only
                                            if ($this.val().length > 9) {
                                                e.preventDefault();
                                                return false;
                                            }
                                            if (e.charCode < 54 && e.charCode > 47) {
                                                if ($this.val().length == 0) {
                                                    e.preventDefault();
                                                    return false;
                                                } else {
                                                    return true;
                                                }
                                            }
                                            if (regex.test(str)) {
                                                return true;
                                            }
                                            e.preventDefault();
                                            return false;
                                        });
                                    });
                                </script>
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Aadhar No</label>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" name="Aadharcard" class="form-control Aadharcard" placeholder="000000000000" required>
                                    </div>
                                </div>
                                <script>
                                    $(document).ready(function () {
                                        $('.Aadharcard').on('keypress', function (e) {
                                            var $this = $(this);
                                            var regex = new RegExp("^[0-9\b]+$");
                                            var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
                                            // for 10 digit number only
                                            if ($this.val().length > 11) {
                                                e.preventDefault();
                                                return false;
                                            }
                                            if (e.charCode < 50 && e.charCode > 47) {
                                                if ($this.val().length == 0) {
                                                    e.preventDefault();
                                                    return false;
                                                } else {
                                                    return true;
                                                }
                                            }
                                            if (regex.test(str)) {
                                                return true;
                                            }
                                            e.preventDefault();
                                            return false;
                                        });
                                    });
                                </script>
                                <div class="row">
                                    <input type="submit" name="AddCustomer" class="btn btn-primari"  value="Save" style="margin-left: 10rem;width: 10rem;" >
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <?php
        if (isset($_POST['AddCustomer'])) {
            $Emailid = $_SESSION['Emailid'];
            $password = $_SESSION['password'];
            $fullname = $_POST['fullname'];
            $mobile = $_POST['MobileNo'];
            $DOB = $_POST['DOB'];
            $licence_number = $_POST['licence_number'];
            $Aadharcard = $_POST['Aadharcard'];

            $file_name = $_FILES["photo"]["name"];
            $extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
            $imgname = $fullname . "." . $extension;
            $Registration_Date = date('Y-m-d');

            $customer = $conn->prepare("UPDATE customer SET Name= ? ,Mobile=?,Date_Of_Birth=?,Driving_Licence=?,AadharCard=?,Image=?,Registration_Date=? WHERE Email=?");
            $customer->bind_param("ssssssss", $fullname,  $mobile, $DOB, $licence_number, $Aadharcard, $imgname, $Registration_Date,$Emailid);
            try{
                $Addcustomer = $customer->execute();
                if ($Addcustomer > 0) {
                    move_uploaded_file($_FILES["photo"]["tmp_name"], "Customer/customerP/" . $imgname);
                    echo "<script>window.location.href='index.php'</script>";
                } else {
                    echo "Error: " . $customer . "<br>" . $conn->error;
                }
            }catch (mysqli_sql_exception $e){
                echo "<script> alert('$e');  </script>";
            }
        }
        ?>
    </body>
</html>
