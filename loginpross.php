<?php

include './DatabaseConnection.php';

if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
}

if (isset($_SESSION['last_login_attempt_time']) && ($_SESSION['remaining_attempts'] == 0)) {
    $current_time = time();
    $last_login_attempt_time = $_SESSION['last_login_attempt_time'];
    if ($current_time - $last_login_attempt_time < 60) { // 10 minutes = 600 seconds
        $remaining_time = 60 - ($current_time - $last_login_attempt_time);
        $timemessage =  'Too many wrong attempts. Please try again after ' . $remaining_time . ' seconds.';
        echo "<div class='alert alert-danger' role='alert'>$timemessage</div>";
        exit;

    }
}


if (isset($_POST['CustomerEmail']) && isset($_POST['Customerpassword'])) {
    $CustomerEmail = $_POST['CustomerEmail'];
    $Customerpassword = $_POST['Customerpassword'];

    $sql = $conn->prepare("SELECT * FROM customer WHERE Email = ? &&  Password = ?");
    $sql->bind_param("ss", $CustomerEmail , $Customerpassword);
    $sql->execute();
    $result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

    if (count($result) == 1) {
        foreach ($result as $row) {
            $user_email = $row['Name'];
            $curr_status = $row['Status'];
        }
        if ($curr_status == 'Deactive') {
            echo '<div class="alert alert-danger" role="alert">Your account is inactive, Please contact the car shop");</div>';
        } else {
            unset($_SESSION['login_attempts']);
            $_SESSION['loggedin'] = true;
            $_SESSION['CustomerEmail'] = $CustomerEmail;
            echo "<script>window.location.href='index.php'</script>";
        }
    }else{
        $_SESSION['login_attempts']++; // Increment login attempts
        $_SESSION['last_login_attempt_time'] = time(); // Store current time as last login attempt time
        $_SESSION['remaining_attempts'] = 3 - $_SESSION['login_attempts'];
        $message =  'Wrong Email id or password. ' .$_SESSION['remaining_attempts'] . ' attempt(s) remaining.';
        echo "<div class='alert alert-danger' role='alert'>$message</div>";
    }
}else{
    echo "invalid requies";
}
?>