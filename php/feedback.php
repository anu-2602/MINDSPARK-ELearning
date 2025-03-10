<?php
$servername = "localhost"; // Change if your server is different
$username = "root"; // Change according to your configuration
$password = ""; // Change according to your configuration
$dbname = "mindspark_db"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Collecting form data
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];

// Insert data into database
$sql = "INSERT INTO feedback (name, email, message) VALUES ('$name', '$email' , '$message')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. <a href='fetch.php'>View Records</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
