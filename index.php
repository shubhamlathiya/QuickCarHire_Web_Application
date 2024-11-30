<!DOCTYPE html>
<html lang="en">
    <head>
        <title>QuickCarHire | Home</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <?php
        include 'headlink.php';
        include "DatabaseConnection.php";
        include "Header.php";
        ?>
    </head>
    <body>
        <div class="hero-wrap ftco-degree-bg" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
            <div class="overlay"></div>
            <div class="container">
                <div class="row no-gutters slider-text justify-content-start align-items-center justify-content-center">
                    <div class="col-lg-8 ftco-animate">
                        <div class="text w-100 text-center mb-md-5 pb-md-5">
                            <h1 class="mb-4">Fast &amp; Easy Way To Rent A Car</h1>
                            <p style="font-size: 18px;">A small river named Duden flows by their place and supplies it with the necessary regelialia. It is a paradisematic country, in which roasted parts</p>
                            <a href="#" class="icon-wrap popup-vimeo d-flex align-items-center mt-4 justify-content-center">
                                <div class="icon d-flex align-items-center justify-content-center">
                                    <span class="ion-ios-play"></span>
                                </div>
                                <div class="heading-title ml-5" id="book">

                                    <span>Easy steps for renting a car</span>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <section class="ftco-section ftco-no-pt bg-light" id="howtowork">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-12 featured-top">
                        <div class="row no-gutters">
                            <div class="col-md-4 d-flex align-items-center">
                                <form class="request-form ftco-animate bg-primary" action="car.php" method="post" enctype="multipart/form-data" style="height: 30rem;">
                                    <h2>Make your trip</h2>
                                    <div class="form-group">
                                        <select id="mySelectCity" class="form-select" aria-label="Default select example" name="City" style="background-color: #1089ff;color: white;border: none;"  required>
                                            <?php
                                            $query = "SELECT * FROM city";
                                            $result = $conn->query($query);
                                            $id = 1;
                                            while ($row = mysqli_fetch_array($result)) {
                                                $city = $row['City'];
                                                $City_Id = $row['City_Id'];
                                                ?>
                                                <option id='tr_<?= $id ?>' value="<?= $City_Id; ?>">
                                                    <?= $city; ?>
                                                </option>
                                                <?php
                                                $id++;
                                            }
                                            ?>
                                        </select>
                                    </div>
<!--                                    <script>-->
                                    <!--                                        $(document).ready(function() {-->
                                    <!--                                            // Attach an event listener to the select element-->
                                    <!--                                            $('#mySelectCity').on('change', function() {-->
                                    <!--                                                // Retrieve the selected option value-->
                                    <!--                                                var selectedOption = $(this).val();-->
                                    <!---->
                                    <!--                                                // Save the selected option value in localStorage-->
                                    <!--                                                localStorage.setItem('selectedOption', selectedOption);-->
                                    <!--                                            });-->
                                    <!--                                        });-->
                                    <!--                                    </script>-->
                                    <div class="d-flex">
                                        <div class="form-group mr-2">

                                            <label for="start-date" class="label">Pick-up Date:</label>
                                            <input type="text" class="form-control" id="start-date" placeholder="Date" name="Start_Date" autocomplete="off" required>
                                        </div>
                                        <div class="form-group ml-2">
                                            <label for="end-date" class="label">Drop-off Date:</label>
                                            <input type="text" class="form-control" id="end-date" placeholder="Date" name="End_Date"  autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="d-flex">
                                        <div class="form-group ml-2">
                                            <label for="start-time" class="label">Pick-up Time:</label>
                                            <input type="time" class="form-control" id="start-time" name="Start_Time"  autocomplete="off" required>
                                        </div>
                                        <div class="form-group ml-2">
                                            <label for="end-time" class="label">Drop-off Time:</label>
                                            <input type="time" class="form-control" id="end-time" name="End_Time" onchange="calculateDaysAndHours()"  autocomplete="off" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <span id="result" style="color: white">
                                        </span><br/>
                                        <span id="error" style="color: red">
                                        </span>
                                    </div>
                                    <input type="hidden" name="totalhrs" id="totalhrs">
                                    <div class="form-group">
                                        <input type="submit" id="Submit" name="Submit" value="Quick Car Hire" class="btn btn-secondary py-3 px-4">
                                    </div>
                                </form>
                            </div>

                            <div class="col-md-8 d-flex align-items-center">
                                <div class="services-wrap rounded-right w-100">
                                    <h3 class="heading-section mb-4">Better Way to Rent Your Perfect Cars</h3>
                                    <div class="row d-flex mb-4">
                                        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                            <div class="services w-100 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-route"></span></div>
                                                <div class="text w-100">
                                                    <h3 class="heading mb-2">Choose Your Pickup Location</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                            <div class="services w-100 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-handshake"></span></div>
                                                <div class="text w-100">
                                                    <h3 class="heading mb-2">Select the Best Deal</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 d-flex align-self-stretch ftco-animate">
                                            <div class="services w-100 text-center">
                                                <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-rent"></span></div>
                                                <div class="text w-100">
                                                    <h3 class="heading mb-2">Reserve Your Rental Car</h3>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <p><a href="#" class="btn btn-primary py-3 px-4">Reserve Your Perfect Car</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </section>
        <section class="row row--grid">
            <div class="container">
                <script type="text/javascript">

                    $(function () {
                        var dateToday = new Date();
                        var minDate = new Date(dateToday.getTime() + (1 * 24 * 60 * 60 * 1000));
                        var maxDate = new Date(dateToday.getTime() + (60 * 24 * 60 * 60 * 1000));                        //2 months from current date
                        var startDateInput = $("#start-date");
                        var endDateInput = $("#end-date");

                        startDateInput.datepicker({
                            dateFormat: "yy-mm-dd",
                            minDate: minDate,
                            maxDate: maxDate,
                            onSelect: function (selectedDate) {
                                var startDate = new Date(selectedDate);
                                var minEndDate = new Date(startDate.getTime() + (1*24 * 60 * 60 * 1000)); //one day after start date
                                var maxEndDate = new Date(startDate.getTime() + (7 * 24 * 60 * 60 * 1000)); //7 days after start date
                                endDateInput.datepicker("option", "minDate", minEndDate);
                                endDateInput.datepicker("option", "maxDate", maxEndDate);
                                endDateInput.val("");
                            }
                        });

                        endDateInput.datepicker({
                            dateFormat: "yy-mm-dd",
                            onSelect: function (selectedDate) {
                                var endDate = new Date(selectedDate);
                                var maxStartDate = new Date(endDate.getTime() - (24 * 60 * 60 * 1000)); //one day before end date
                                var minStartDate = new Date(endDate.getTime() - (24 * 60 * 60 * 1000)); //7 days before end date
//                                startDateInput.datepicker("option", "minDate", minStartDate);
//                                startDateInput.datepicker("option", "maxDate", maxStartDate);
                            }
                        });

                        endDateInput.datepicker("option", "maxDate", maxDate);

                        startDateInput.on("change", function () {
                            endDateInput.val("");

                        });
                    });


                    function calculateDaysAndHours() {
                        // Get the input values
                        const startDate = new Date(document.getElementById("start-date").value);
                        const endDate = new Date(document.getElementById("end-date").value);
                        const startTime = new Date(`2000-01-01T${document.getElementById("start-time").value}:00`);
                        const endTime = new Date(`2000-01-01T${document.getElementById("end-time").value}:00`);

                        // Calculate the difference in milliseconds between the start and end times
                        const timeDiff = endDate.getTime() - startDate.getTime() + endTime.getTime() - startTime.getTime();
                        // Calculate the number of days in the time difference
                        const daysDiff = Math.floor(timeDiff / (1000 * 60 * 60 * 24));
                        // Calculate the remaining hours
                        const hoursDiff = Math.floor((timeDiff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        // Display the result
                        //                        alert(`Days: ${daysDiff}\nHours: ${hoursDiff}`);
                        $("#result").text(daysDiff + " Days " + hoursDiff + " hrs");

                        const totalHrs = (daysDiff * 24) + hoursDiff;
                        $("#totalhrs").val(totalHrs);
                    }
                </script>

                <div class="col-12">
                    <div class="main__title">
                        <h2>Get started with 4 simple steps</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="step1">
                            <span class="step1__icon step1__icon--pink">
                                <i class="fa-solid fa-user-plus" style="color: #d33d8b;"></i>
                            </span>
                            <h3 class="step1__title">Create a profile</h3>
                            <p class="step1__text">If you are going to use a passage of Lorem Ipsum, you need to be sure. <br/>
                                <a href="login.php">Get started</a>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="step1">
                            <span class="step1__icon">
                                <i class="fa-solid fa-car" style="color: #189cf4;"></i>
                            </span>
                            <h3 class="step1__title">Tell us what car you want</h3>
                            <p class="step1__text">Various versions have evolved over the years, sometimes by accident, sometimes on purpose
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="step1">
                            <span class="step1__icon step1__icon--green">
                                <i class="fa-solid fa-user-check" style="color:#29b474;"></i>
                            </span>
                            <h3 class="step1__title">Match with seller</h3>
                            <p class="step1__text">It to make a type specimen book. It has survived not only five centuries, but also the leap into electronic
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3">
                        <div class="step1">
                            <span class="step1__icon step1__icon--purple">
                                <i class="fa-solid fa-file-pen" style="color: #8254d5;"></i>
                            </span>
                            <h3 class="step1__title">Make a deal</h3>
                            <p class="step1__text">There are many variations of passages of Lorem available, but the majority have suffered alteration
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

<!--        <section class="ftco-section ftco-no-pt bg-light">-->
        <!--            <div class="container">-->
        <!--                <div class="row justify-content-center">-->
        <!--                    <div class="col-md-12 heading-section text-center ftco-animate mb-5"><br/><br/>-->
        <!--                        <h2 class="mb-2">Offers</h2>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--                <div class="row">-->
        <!--                    <div class="col-md-12">-->
        <!--                        <div class="carousel-car owl-carousel">-->
        <!--                            --><?php
//                            $offer = "SELECT * FROM offer WHERE Status = 'Active'";
//                            $offerresult = $conn->query($offer);
//                            while ($rowOffer = mysqli_fetch_array($offerresult)) {
//                                $i++;
//                                $Offer_Code = $rowOffer['Code'];
//                                $Offer_Name = $rowOffer['Name'];
//                                $Image = $rowOffer['Image'];
//                                $Offer_Amount = $rowOffer['Percentage'];
//                                
        ?>
        <!--                                <div class="card">-->
        <!--                                    <div class="bg-image hover-overlay ripple" data-mdb-ripple-color="light">-->
        <!--                                        <img src="https://mdbootstrap.com/img/new/standard/nature/111.webp" class="img-fluid" />-->
        <!--                                        <a href="#!">-->
        <!--                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15)"></div>-->
        <!--                                        </a>-->
        <!--                                    </div>-->
        <!--                                    <div class="card-header">Featured</div>-->
        <!--                                    <div class="card-body">-->
        <!--                                        <h5 class="card-title">--><?php //= $i;  ?><!--</h5>-->
        <!--                                        <button type="button" class="btn btn-primary">Button</button>-->
        <!--                                    </div>-->
        <!--                                    <div class="card-footer">2 days ago</div>-->
        <!--                                </div>-->
        <!--                                --><?php
//                            }
//                            
        ?>
        <!--                        </div>-->
        <!--                    </div>-->
        <!--                </div>-->
        <!--            </div>-->
        <!--        </section>-->

        <section class="ftco-section ftco-no-pt bg-light">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-12 heading-section text-center ftco-animate mb-5"><br/><br/>
                        <h2 class="mb-2">Featured Cars</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="carousel-car owl-carousel">
                            <?php
                            $query = "SELECT * FROM car WHERE Hire_Cost > 23;";
                            $result = $conn->query($query);
                            while ($row = mysqli_fetch_array($result)) {
                                $Status = $row['Status'];
                                if ($Status == 'Deactive') {
                                    
                                } else {
                                    $Registration_no = $row['Registration_No'];
                                    $Car_name = $row['Name'];
                                    $ModelYear = $row['ModelYear'];
                                    $Image = $row['Image'];
                                    $Car_hire_cost = $row['Hire_Cost'];
                                    $Speed = $row['Speed'];
                                    $Category_id = $row['Category_Id'];
                                    $Category = $conn->prepare("SELECT * FROM car_category WHERE Category_Id =? ");
                                    $Category->bind_param("s", $Category_id);
                                    $Category->execute();
                                    $resultCategory = $Category->get_result()->fetch_all(MYSQLI_ASSOC);
                                    if (count($resultCategory) > 0) {
                                        foreach ($resultCategory as $row) {
                                            $Seats = $row['Seats'];
                                            $Fuel = $row['Fuel'];

                                            $Transmission = $row['Transmission'];
                                        }
                                    } else {
                                        echo "<script>alert('not a Category_id');</script>";
                                    }
                                    ?>

                                    <div class="item">
                                        <div class="car-wrap rounded ftco-animate" >
                                            <div class="splide splide--card car__slider splide--loop splide--ltr splide--draggable is-active is-initialized" id="splide02">
                                                <div class="splide__track" id="splide02-track" style="padding-left: 0px; padding-right: 0px;">
                                                    <img src="Admin/CarImg/<?php echo $Image; ?>" style="height: 200px;" alt="hy">
                                                </div>
                                            </div>
                                            <div class="car__title">
                                                <h3 class="car__name">
                                                  <?= $Car_name; ?>
                                                </h3>
                                                <span class="car__year"><?= $ModelYear; ?></span>
                                            </div>
                                            <ul class="car__list">
                                                <li>
                                                    <i class="fa-solid fa-user-group" style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                    <span><?php echo $Seats; ?> People</span>
                                                </li>
                                                <li>
                                                    <i class="fa-solid fa-gas-pump" style="color: #189cf4;"></i>&nbsp;&nbsp;
                                                    <span><?php echo $Fuel; ?></span>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path d="M19.088,4.95453c-.00732-.00781-.00952-.01819-.01715-.02582s-.01819-.00995-.02606-.01733a9.97886,9.97886,0,0,0-14.08948,0c-.00787.00738-.01837.00964-.02606.01733s-.00983.018-.01715.02582a10,10,0,1,0,14.1759,0ZM12,20a7.9847,7.9847,0,0,1-6.235-3H9.78027a2.9636,2.9636,0,0,0,4.43946,0h4.01532A7.9847,7.9847,0,0,1,12,20Zm-1-5a1,1,0,1,1,1,1A1.001,1.001,0,0,1,11,15Zm8.41022.00208L19.3999,15H15a2.99507,2.99507,0,0,0-2-2.81573V9a1,1,0,0,0-2,0v3.18427A2.99507,2.99507,0,0,0,9,15H4.6001l-.01032.00208A7.93083,7.93083,0,0,1,4.06946,13H5a1,1,0,0,0,0-2H4.06946A7.95128,7.95128,0,0,1,5.68854,7.10211l.65472.65473A.99989.99989,0,1,0,7.75732,6.34277l-.65466-.65466A7.95231,7.95231,0,0,1,11,4.06946V5a1,1,0,0,0,2,0V4.06946a7.95231,7.95231,0,0,1,3.89734,1.61865l-.65466.65466a.99989.99989,0,1,0,1.41406,1.41407l.65472-.65473A7.95128,7.95128,0,0,1,19.93054,11H19a1,1,0,0,0,0,2h.93054A7.93083,7.93083,0,0,1,19.41022,15.00208Z"></path>
                                                    </svg>
                                                    <span><?php echo $Speed; ?></span>
                                                </li>
                                                <li>
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                                                    <path d="M12,12a1,1,0,1,0,1,1A1,1,0,0,0,12,12Zm9.71-2.36a0,0,0,0,1,0,0,10,10,0,0,0-19.4,0,0,0,0,0,1,0,0,9.75,9.75,0,0,0,0,4.72,0,0,0,0,1,0,0A10,10,0,0,0,9.61,21.7h0a9.67,9.67,0,0,0,4.7,0h0a10,10,0,0,0,7.31-7.31,0,0,0,0,1,0,0,9.75,9.75,0,0,0,0-4.72ZM12,4a8,8,0,0,1,7.41,5H4.59A8,8,0,0,1,12,4ZM4,12a8.26,8.26,0,0,1,.07-1H6v2H4.07A8.26,8.26,0,0,1,4,12Zm5,7.41A8,8,0,0,1,4.59,15H7a2,2,0,0,1,2,2Zm4,.52A8.26,8.26,0,0,1,12,20a8.26,8.26,0,0,1-1-.07V18h2ZM13.14,16H10.86A4,4,0,0,0,8,13.14V11h8v2.14A4,4,0,0,0,13.14,16ZM15,19.41V17a2,2,0,0,1,2-2h2.41A8,8,0,0,1,15,19.41ZM19.93,13H18V11h1.93A8.26,8.26,0,0,1,20,12,8.26,8.26,0,0,1,19.93,13Z"></path>
                                                    </svg>
                                                    <span><?php echo $Transmission; ?></span>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <?php
                                }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section ftco-about">
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center" style="background-image: url(images/about.jpg);">
                    </div>
                    <div class="col-md-7 wrap-about ftco-animate">
                        <div class="heading-section heading-section-white pl-md-5">
                            <?php
                            $about = 'ABOUT';
                            $query = $conn->prepare("SELECT * FROM Page where Page_type=?");
                            $query->bind_param("s", $about);
                            $result = $query->execute();
                            $result = $query->get_result()->fetch_all(MYSQLI_ASSOC);

                            foreach ($result as $row) {
                                $Page_id = $row['Page_id'];
                                $Page_name = $row['Page_name'];
                                $Page_type = $row['Page_type'];
                                $Page_details = $row['Page_details'];
                            }
                            ?>
                            <span class="subheading"><?= $Page_name ?></span>
<?= $Page_details; ?>
                            <p><a href="index.php" class="btn btn-primary py-3 px-4">Search Car</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="ftco-section">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-7 text-center heading-section ftco-animate">
                        <span class="subheading">Services</span>
                        <h2 class="mb-3">Our Latest Services</h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="services services-2 w-100 text-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-wedding-car"></span></div>
                            <div class="text w-100">
                                <h3 class="heading mb-2">Wedding Ceremony</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="services services-2 w-100 text-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                            <div class="text w-100">
                                <h3 class="heading mb-2">City Transfer</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="services services-2 w-100 text-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-car"></span></div>
                            <div class="text w-100">
                                <h3 class="heading mb-2">Airport Transfer</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="services services-2 w-100 text-center">
                            <div class="icon d-flex align-items-center justify-content-center"><span class="flaticon-transportation"></span></div>
                            <div class="text w-100">
                                <h3 class="heading mb-2">Whole City Tour</h3>
                                <p>A small river named Duden flows by their place and supplies it with the necessary regelialia.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section class="ftco-section testimony-section bg-light">
            <div class="container">
                <div class="row justify-content-center mb-5">
                    <div class="col-md-7 text-center heading-section ftco-animate">
                        <span class="subheading">Testimonial</span>
                        <h2 class="mb-3">Happy Clients</h2>
                    </div>
                </div>
                <div class="row ftco-animate">
                    <div class="col-md-12">
                        <div class="carousel-testimony owl-carousel ftco-owl">
                            <div class="item">
                                <div class="testimony-wrap rounded text-center py-4 pb-5">
                                    <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                                    </div>
                                    <div class="text pt-4">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Marketing Manager</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap rounded text-center py-4 pb-5">
                                    <div class="user-img mb-2" style="background-image: url(images/person_2.jpg)">
                                    </div>
                                    <div class="text pt-4">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Interface Designer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap rounded text-center py-4 pb-5">
                                    <div class="user-img mb-2" style="background-image: url(images/person_3.jpg)">
                                    </div>
                                    <div class="text pt-4">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <p class="name">Roger Scott</p>
                                        <span class="position">UI Designer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap rounded text-center py-4 pb-5">
                                    <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                                    </div>
                                    <div class="text pt-4">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <p class="name">Roger Scott</p>
                                        <span class="position">Web Developer</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item">
                                <div class="testimony-wrap rounded text-center py-4 pb-5">
                                    <div class="user-img mb-2" style="background-image: url(images/person_1.jpg)">
                                    </div>
                                    <div class="text pt-4">
                                        <p class="mb-4">Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                                        <p class="name">Roger Scott</p>
                                        <span class="position">System Analyst</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="script.js"></script>

        <?php include 'footerlink.php'; ?>
    </body>
</html>