<?php
$host = "localhost";
$user = "dialogues_media";
$password = "DialogueDB@1234";
$database = "dialogues_media_db";

try {
    // Attempt to establish a connection
    $conn = mysqli_connect($host, $user, $password, $database);

    // Check connection
    if (!$conn) {
        throw new Exception("Failed to connect to the database: " . mysqli_connect_error());
    }
} catch (Exception $e) {
    // Handle the exception (display an error message)
    echo "Connection failed: " . $e->getMessage();
}

