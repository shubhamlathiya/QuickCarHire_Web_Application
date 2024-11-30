<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuickCarHire | Car</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
        include 'headlink.php';
        include "DatabaseConnection.php";
        include "Header.php";
        ?>
        <style>

            .nav-tabs:not(.nav-tabs-neutral)>.nav-item>.nav-link.active {
                box-shadow: 0px 5px 35px 0px rgba(0, 0, 0, 0.3);
                background-color: #444;
                color: white;
            }
            .nav-tabs>.nav-item>.nav-link {
                color: #888888;
                padding: 3px;
                margin: 0;
                margin-right: 5px;
                background-color: transparent;
                border: 1px solid transparent;
                border-radius: 30px;
                font-size: 14px;
                font-size: medium;
                tab-size: 30px;
                padding: 11px 23px;
                line-height: 1.5;
            }
        </style>
    </head>
    <body>
        <?php
        $City = $_POST['City'];
        $sdate = $_POST['Start_Date'];
        $edate = $_POST['End_Date'];
        $stime = $_POST['Start_Time'];
        $etime = $_POST['End_Time'];

        $totalhrs = $_POST['totalhrs'];

        $_SESSION['City'] = $City;
        $_SESSION['Start_Date'] = $sdate;
        $_SESSION['End_Date'] = $edate;
        $_SESSION['Start_Time'] = $stime;
        $_SESSION['End_Time'] = $etime;

        $totalkm8 = $totalhrs * 8;
        $totalkm15 = $totalhrs * 11;
        $totalkm20 = $totalhrs * 15;
        ?>


        <section class="hero-wrap hero-wrap-2 js-fullheight" style="background-image: url('images/bg_3.jpg');" data-stellar-background-ratio="0.5">
            <div class="row no-gutters slider-text js-fullheight align-items-end justify-content-start" style="margin-left: 10rem;">
                <div class="col-md-auto ftco-animate pb-5">
                    <form method="post" class="home__search">
                        <div class="home__group">
                            <label for="search1">City</label>
                            <input type="text" class="form-control" id="Start_Date" name="Start_Date" placeholder="Date"   disabled="disabled"  value="<?= $City ?>">
                        </div>
                        <div class="home__group">
                            <label for="search1">Pick-up date</label>
                            <input type="text" class="form-control" id="Start_Date" name="Start_Date" placeholder="Date"  disabled="disabled"   value="<?= $sdate ?>">
                        </div>
                        <div class="home__group">
                            <label for="search2">Drop-off date</label>
                            <input type="text" class="form-control" id="End_Date" name="End_Date" placeholder="Date"   disabled="disabled"  value="<?= $edate ?>">
                        </div>
                        <div class="home__group">
                            <label for="search3">Pick-up time</label>
                            <input type="time" class="form-control" name="Start_Time" placeholder="Time"   disabled="disabled"  value="<?= $stime ?>">
                        </div>
                        <div class="home__group">
                            <label for="search1">Drop-off time</label>
                            <input type="time" class="form-control"  name="End_Time" placeholder="Time"   disabled="disabled" value="<?= $etime ?>">
                        </div>
                    </form>
                </div>
                <div class="col-md-auto ftco-animate pb-5">
                    <div class="container" style="background-color: rgb(238, 243, 249);border-radius: 10px;margin-left: 6rem;text-align: center">
                        <label>Km plan</label>
                        <ul class="nav nav-tabs justify-content-center" role="tablist" style="padding: 10px;">
                            <li class="nav-item">
                                <button class="nav-link active" data-toggle="tab" href="#home" role="tab" value="<?= $totalkm8 ?>">
                                    <?= $totalkm8 ?> KMS
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-toggle="tab" href="#profile" role="tab" value="<?= $totalkm15 ?>">
                                    <?= $totalkm15 ?> KMS
                                </button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-toggle="tab" href="#messages" role="tab" value="<?= $totalkm20 ?>">
                                    <?= $totalkm20 ?> KMS
                                </button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <script>
            $(document).ready(function () {
                // Ajax function
                $.ajax({
                    url: 'ajaxcar.php',
                    type: 'POST',
                    data: {button_value: <?= $totalkm8 ?>},
                    success: function (response) {
                        $("#cars").html(response);
                    },
                    error: function () {
                        alert("error");
                    }
                });
            });
        </script>
        <script>
            $(document).ready(function () {
                $("button").click(function () {
                    var buttonId = $(this).attr('id');
                    var buttonValue = $(this).val();
                    $.ajax({
                        url: 'ajaxcar.php',
                        type: 'post',
                        data: {button_value: buttonValue},
                        success: function (response) {
                            $("#cars").html(response);
                            // Handle the response from server
                        },
                        error: function () {
                            alert("error");
                        }
                    });
                });
            });
        </script>
        <section class=" bg-light">
            <div class="container">
                <section class="row row--grid">
                    <div class="col-12">
                        <div class="main__title main__title--first">
                            <h2>Available Cars</h2>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="main__title main__title--first" id="cars" >
                        </div>
                    </div>
                </section>
                <br/><br/>
            </div>
        </section>
        <?php include 'footerlink.php' ?>
    </body>
</html>