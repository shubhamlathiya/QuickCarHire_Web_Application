<?php
include_once '../Design/databaseConnection.php';


$To = $_POST['ToDate'];
$From = $_POST['FromDate'];

$sql = "SELECT * FROM booking WHERE Start_Date BETWEEN '$To' AND '$From'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Display records
    ?>
    <table class="table" border="10" style="margin-top:3rem; ">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Email Id</th>
                <th scope="col">Car Number</th>
                <th scope="col">Total Amount</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $total = 0;
            $i = 0;
            while ($row = $result->fetch_assoc()) {
                $i++;
                ?>
                <tr>
                    <th scope="row"><?= $i ?></th>
                    <td><?= $row["Email"] ?></td>
                    <td><?= $row["Registration_No"] ?></td>
                    <td><?php
                        echo $row["Amount"];
                        $total = $row["Amount"] + $total;
                        ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <th colspan="3" style="text-align: center">Total Amount</th>
                <th><?= $total ?></th>
            </tr>
        </tbody></table>
    <?php
} else {
    echo '<div class="alert alert-success" role="alert" style="margin-top:1rem; ">No records found!</div>';
}

// Close database connection
$conn->close();
?>