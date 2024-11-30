<?php
// Place this file in the same directory as your main PHP file

// Create a database connection (assuming you have already established a connection)

include_once '../Design/databaseConnection.php';


$query = "SELECT * FROM car";
$result = $conn->query($query);
while ($row = mysqli_fetch_array($result)) {
    $R_no = $row['Registration_No'];
    $Car_name = $row['Name'];
    $Car_brand = $row['Brand'];
    $Image = $row['Image'];
    $City = $row['City_Id'];
    $Category_id = $row['Category_Id'];
    $Car_Status = $row['Status'];
    $Car_hire_cost = $row['Hire_Cost'];
    $Speed = $row['Speed'];
?>
    // Generate the table rows dynamically
    <tr id='tr_$R_no'>
    <td><input type='checkbox' name='delete[]' value='$R_no'></td>
        <td><?= $R_no ?></td>
        <td><?= $Car_name ?></td>
        <td><?= $Car_brand ?></td>
    <td><img src='images/CarImg/<?=$Image?>' width='100px' height='100px'><br/></td>
        <td><?= $City ?></td>
        <td><?= $Category_id ?></td>
    <td><?php
    if ($Car_Status == 'Deactive') {
        echo "<a href='car.php?id=$R_no&Status=Deactive'><span class='badge badge-secondary'>$Car_Status</span></a>";
    } else {
        echo "<a href='car.php?id=$R_no&Status=active'><span class='badge badge-success'>$Car_Status</span></a>";
    }?>
    </td>
        <td><?= $Car_hire_cost ?></td>
        <td><?= $Speed ?></td>
    <td><?php
    $current_date = date("Y-m-d");
    $sql1234 = "SELECT car.Registration_No, booking.Registration_No,booking.End_Date FROM car INNER JOIN booking ON car.Registration_No = booking.Registration_No WHERE car.Registration_No = '$R_no'";
    $result123 = mysqli_query($conn, $sql1234);
    $row12 = mysqli_fetch_assoc($result123);
    $end_date = $row12['End_Date'];
    if ($end_date < $current_date) {
        echo "<span class='badge badge-success'>Not Booked</span>";
    } else {
        echo "<span class='badge badge-danger'>Booked</span>";
    } ?>
    </td>
        <td><a href="editCar.php?Rid=<?= base64_encode($R_no); ?>"><i class="fa fa-edit"></i></a>
    <i class='fa fa-trash-alt text-danger'></i></td>
    </tr>
<?php
}
?>
