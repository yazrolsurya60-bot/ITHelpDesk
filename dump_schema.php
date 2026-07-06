<?php
$conn = new mysqli('localhost', 'root', '', 'it_helpdesk');
$res = $conn->query("DESCRIBE users");
while($row = $res->fetch_assoc()) {
    echo $row['Field'] . " - " . $row['Type'] . "\n";
}
?>
