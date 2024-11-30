<?php

session_start();
include '../Design/DatabaseConnection.php';
$Admin_email_id = $_POST['Email'];
$Admin_password = $_POST['password'];

$sql = $conn->prepare("SELECT * FROM admin WHERE Email = ? ");
$sql->bind_param("s", $Admin_email_id);
$sql->execute();
$result = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

if (count($result) > 0) {
    $sql = $conn->prepare("SELECT * FROM admin WHERE Email =? && Password = ? ");
    $sql->bind_param("ss", $Admin_email_id, $Admin_password);
    $sql->execute();
    $resultPassword = $sql->get_result()->fetch_all(MYSQLI_ASSOC);

    if (count($resultPassword) > 0) {
        foreach ($result as $row) {
            $user_email = $row['Name'];
            $curr_status = $row['Status'];
            $role_id = $row['Role_Id'];
            $city_id = $row['City_Id'];
        }
        if ($curr_status == 'Deactive') {
            echo '<div class="alert border-bottom-danger" role="alert">Sorry, your account is temporarily deactivated by the admin.</div>';
        } else {
            $_SESSION['Admin_name'] = $result[0]['Name'];
            $_SESSION['islogin'] = true;
            $_SESSION['role_id'] = $role_id;
            $_SESSION['city_id'] = $city_id;

            echo "<script>window.location.href='./dashboard.php'</script>";
        }
    } else {
        echo '<div class="alert border-bottom-danger" role="alert">Please enter valid login data!.</div>';
    }
} else {
    echo '<div class="alert border-bottom-danger" role="alert">Please enter valid login data!.</div>';
}

$conn->close();
?>