    <!DOCTYPE html>
<!--
Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
Click nbfs://nbhost/SystemFileSystem/Templates/Project/PHP/PHPProject.php to edit this template
-->
<html>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>OTP Verification Form</title>
        <link rel="stylesheet" href="style.css" />
        <!-- Boxicons CSS -->
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
        <script src="script.js" defer></script>
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
        <div class="container">
            <header>
                <i class="bx bxs-check-shield"></i>
            </header>
            <h4>Enter OTP Code</h4>
            <div id="result"></div>
            <form method="post"  id="otpForm" enctype="multipart/form-data">
                <div class="input-field">
                    <input type="number" name="number1" />
                    <input type="number" name="number2" disabled />
                    <input type="number" name="number3" disabled />
                    <input type="number" name="number4" disabled />
                    <input type="number" name="number5" disabled />
                    <input type="number" name="number6" disabled />
                    <input type="number" name="number7" disabled />
                </div>
                <button type="submit">Verify OTP</button>
            </form>
        </div>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#otpForm').on('submit', function(e) {
                    e.preventDefault();

                    var formData = new FormData(this);

                    $.ajax({
                        type: 'POST',
                        url: 'ajaxOtpVerify.php',
                        data: formData,
                        processData: false,
                        contentType: false,
                        success: function(response) {
                            $('#result').html(response);
                        }
                    });
                });
            });
        </script>

    </body>
</html>
