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
$fname = $_POST['fname'];
$lname = $_POST['lname'];
$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['pass'];
$expertise = $_POST['expertise'];

// Insert data into database
$sql = "INSERT INTO instructor (fname, lname, username, email, pass, expertise) VALUES ('$fname', '$lname', '$username' , '$email' , '$password', '$expertise')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. You can now login as an instructor.
    <a href='./../pages/login.html'>Click here to login</a>";
    // Redirect to login page after successful registration 
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
