<!-- filepath: c:\Users\admin\Desktop\MINDSPARK-ELearning\pages\signin.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mindspark_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email' AND password='$pass'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "Sign-in successful";
    } else {
        echo "Invalid email or password";
    }
}

$conn->close();
?>