<!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHPWebPage.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Quick Car hire | Login</title>
        <link rel="stylesheet" type="text/css" href="css/login.css">
        <script src="newjavascript.js" type="text/javascript"></script>
        <!--        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">-->
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
        <p class="tip"></p>
        <div class="cont" style="height: 35rem;">
            <form method="post" id="login-form" enctype="multipart/form-data">
                <div class="form sign-in">
                    <h2>Welcome back,</h2>
                    <div id="login-result"></div>
                    <label>
                        <span>Email</span>
                        <input type="email" name="CustomerEmail" id="CustomerEmail"/>
                    </label>
                    <label>
                        <span>Password</span>
                        <input type="password" name="Customerpassword"  id="Customerpassword"/>
                    </label>
                    <p class="forgot-pass">Forgot password?</p>
                    <button type="submit" class="submit" name="Customersubmit">Log In</button>
                    <button type="submit" class="fb-btn">Connect with <span>Google</span></button><br/><br/>
                    <br/>
                    <a href="index.php" style="text-align: left;Text-decoration:none;">Go To Home</a>
                </div>
            </form>
            <div class="sub-cont">
                <div class="img">
                    <div class="img__text m--up">
                        <h2>New here?</h2>
                        <p>Registration Youself</p>
                    </div>
                    <div class="img__text m--in">
                        <h2>One of us?</h2>
                        <p>If you already has an account, just sign in.</p>
                    </div>
                    <div class="img__btn" style="width: 10rem;">
                        <span class="m--up">Registration</span>
                        <span class="m--in">Log In</span>
                    </div>
                </div>
                <form method="post" id="Registration-form" enctype="multipart/form-data">
                    <div class="form sign-up">
                        <h2>Registration</h2>
                        <div id="Registration-result"></div>
                        <label>
                            <span>Email</span>
                            <input type="email" name="Emailid" id="Emailid"/>
                        </label>
                        <label>
                            <span>Password</span>
                            <input type="password" name="password" id="password"/>
                        </label>
                        <label>
                            <span>Confirm Password</span>
                            <input type="password" name="retypepassword" id="retypepassword"/>
                        </label>
                        <button type="submit" class="submit" name="Registration">Registration</button>
                        <button type="submit" class="fb-btn">Join with <span>Google</span></button><br/>
                        <a href="index.php" style="text-align: right;margin-left: 30rem;Text-decoration:none;">Go To Home</a>
                    </div>
                </form>
            </div>
        </div>
        <script>
            document.querySelector('.img__btn').addEventListener('click', function () {
                document.querySelector('.cont').classList.toggle('s--signup');
            });
        </script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(function () {
                $('#login-form').submit(function (event) {
                    event.preventDefault();
                    var CustomerEmail = $('#CustomerEmail').val();
                    var Customerpassword = $('#Customerpassword').val();
                    $.ajax({
                        url: 'loginpross.php',
                        type: 'POST',
                        data: {CustomerEmail: CustomerEmail, Customerpassword: Customerpassword},
                        success: function (response) {
                            $('#login-result').html(response);
                        }
                    });
                });
            });
        </script>
        <!--  Registration-form ajax function      -->
        <script>
            $(function () {
                $('#Registration-form').submit(function (event) {
                    event.preventDefault();
                    var Emailid = $('#Emailid').val();
                    var password = $('#password').val();
                    var retypepassword = $('#retypepassword').val();
                    $.ajax({
                        url: 'registerpross.php',
                        type: 'POST',
                        data: {Emailid: Emailid, password: password, retypepassword: retypepassword},
                        success: function (response) {
                            $('#Registration-result').html(response);
                        }
                    });
                });
            });
        </script>
    </body>
</html>
