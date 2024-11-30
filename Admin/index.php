<!DOCTYPE html>
<html lang="en">
    <head>
        <title>Login</title>
        <?PHP include './Design/headerlinks.php'; ?>
    </head>
    <body class="bg-gradient-primary">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card1 o-hidden border-0 shadow-lg my-5">
                        <div class="card-body">
                            <div id="login-result"></div>
                            <div class="p-5" style="width: 30em">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Welcome Back!</h1>
                                </div>
                                <form class="user" id="login-form" enctype="multipart/form-data" method="post">
                                    <div class="form-group">
                                        <input type="email"  id="Email" name="Email"  class="form-control form-control-user"
                                               id="exampleInputEmail" aria-describedby="emailHelp"
                                               placeholder="Enter Email Address...">
                                    </div>
                                    <div class="form-group">
                                        <input type="password" id="password" name="password" class="form-control form-control-user"
                                               id="exampleInputPassword" placeholder="Password">
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Remember Me</label>
                                        </div>
                                    </div>
                                    <input type="submit" name="submit" id="submit" class="btn btn-primary btn-user btn-block" value="Login">
                                </form>
                                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                                <script>
                                    $(function () {
                                        $('#login-form').submit(function (event) {
                                            event.preventDefault();
                                            var Email = $('#Email').val();
                                            var password = $('#password').val();
                                            $.ajax({
                                                url: 'Ajax/ajaxlogin.php',
                                                type: 'POST',
                                                data: {Email: Email, password: password},
                                                success: function (response) {
                                                    $('#login-result').html(response);
                                                }
                                            });
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?PHP include './Design/footerlinks.php'; ?>
    </body>
</html>