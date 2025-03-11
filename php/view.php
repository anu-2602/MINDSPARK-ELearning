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

// Get the user ID from URL
$id = intval($_GET['id']);

// Fetch user data
$sql = "SELECT * FROM student WHERE id = $id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div class="container">
        <h1 style="color:red">Data of <?php echo $user['fname']; ?></h1>
        <p><strong>First Name:</strong> <?php echo $user['fname']; ?></p>
        <p><strong> Last Name:</strong> <?php echo $user['lname']; ?></p>
        <p><strong>User Name:</strong> <?php echo $user['username']; ?></p>
        <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
        <p><strong>Password:</strong> <?php echo $user['pass']; ?></p>
        <!-- <p><strong>Hobbies:</strong> <?php echo $user['feddback']; ?></p>
       <p><strong>Resume:</strong> <a href="uploads/<?php echo $user['resume']; ?>" target="_blank">Download</a></p>
        <a href="fetch.php">Back to Records</a>-->
    </div>
</body>
</html>

<?php
$conn->close();
?>
