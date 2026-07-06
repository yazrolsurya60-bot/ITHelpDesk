<?php
$conn = new mysqli('localhost', 'root', '', 'it_helpdesk');
$conn->query("ALTER TABLE users ADD foto VARCHAR(255) DEFAULT NULL");
if (!is_dir('uploads/profil')) {
    mkdir('uploads/profil', 0777, true);
}
echo "Database updated and folder created.\n";
?>
