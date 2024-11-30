<?php
echo "jy";
include 'DatabaseConnection.php';
echo 11;
// prepare and execute query
$stmt = $conn->prepare("SELECT * FROM role_menu ");
$stmt->execute();
echo 'hy';
// fetch column names
$columns = array();
foreach ($stmt->fetch(PDO::FETCH_ASSOC) as $column_name => $value) {
    $columns[] = $column_name;
}

//// fetch row values
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

// output column names and row values
echo "<h2>Column names:</h2>";
echo "<ul>";
foreach ($columns as $column) {
    echo "<li>$column</li>";
}
echo "</ul>";

echo "<h2>Row values:</h2>";
echo "<table>";
foreach ($rows as $row) {
    echo "<tr>";
    foreach ($row as $value) {
        echo "<td>$value</td>";
    }
    echo "</tr>";
}
echo "</table>";

?>
