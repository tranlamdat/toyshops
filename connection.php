<?php
$host = "ec2-52-2-167-43.compute-1.amazonaws.com";      // Change this if your PostgreSQL server is running on a different host
$port = "5432";           // Change this if your PostgreSQL server is using a different port
$dbname = "db8kcirniejsr8";
$user = "hihuqumtalddnt";
$password = "51d5997a22bf94a9c5f91377eabb63b98d70cf9c806fb1525758e423a34b68ad";

// Connect to the PostgreSQL database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    // Handle connection error
    echo "Failed to connect to PostgreSQL: " . pg_last_error();
    exit;
}

// Connected successfully, perform database operations here

?>