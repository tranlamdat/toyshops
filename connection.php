<?php
$host = "ec2-52-2-167-43.compute-1.amazonaws.com";      // Change this if your PostgreSQL server is running on a different host
$port = "5432";           // Change this if your PostgreSQL server is using a different port
$dbname = "deugjphov0ten7";
$user = "qklvaqhwxzsgov";
$password = "29c3a6d9fe80d0342e275374ac0ca1b0fdbbc2649c710b01f76d0f89c5a4742b";

// Connect to the PostgreSQL database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    // Handle connection error
    echo "Failed to connect to PostgreSQL: " . pg_last_error();
    exit;
}

// Connected successfully, perform database operations here

?>