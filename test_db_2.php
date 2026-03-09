<?php
try {
    $conn = new mysqli('localhost', 'root', '');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    echo "Connected successfully to MySQL!";
    $conn->close();
} catch (Exception $e) {
    echo "Connection error: " . $e->getMessage();
}
?>
