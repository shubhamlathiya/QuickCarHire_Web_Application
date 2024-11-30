<!DOCTYPE html>
<html>
    <body>
        <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
            <div class="container">
                <a class="navbar-brand" href="index.php">Quick<span>Car</span>Hire</a>
                <!--                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="oi oi-menu"></span> Menu
                                </button>-->

                <div class="collapse navbar-collapse" id="ftco-nav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"><a href="index.php" class="nav-link">Home</a></li>
                        <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
                        <!--<li class="nav-item"><a href="pricing.php" class="nav-link">Pricing</a></li>-->
                        <!--<li class="nav-item"><a href="car.php" class="nav-link">Cars</a></li>-->
                        <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
                        <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) { ?>

                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Profile
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="profile.php">My Account</a>
                                    <a class="dropdown-item" href="History.php">My Booking</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="logout.php">Log Out</a>
                                </div>
                            </li>
                            <?php
                        } else {
                            echo '<li class="nav-item"><a href="login.php" class="nav-link">Login/Registration</a></li>';
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END nav -->
    </body>
</html>
