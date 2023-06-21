<?php
$host = "ec2-34-236-103-63.compute-1.amazonaws.com";      // Change this if your PostgreSQL server is running on a different host
$port = "5432";           // Change this if your PostgreSQL server is using a different port
$dbname = "dcljkn9969g8si";
$user = "iomiqwbnnigjwo";
$password = "7a873b91d11c2853ff776dbc933992eea722b35beba4fb224a964763dc0481b9";

// Connect to the PostgreSQL database
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    // Handle connection error
    echo "Failed to connect to PostgreSQL: " . pg_last_error();
    exit;
}

// Connected successfully, perform database operations here

?>