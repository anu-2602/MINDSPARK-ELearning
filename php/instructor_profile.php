<?php
session_start();

// Redirect to login if not an instructor
if (!isset($_SESSION["user_id"]) || $_SESSION["user_type"] !== "instructor") {
    header("Location: index.php");
    exit();
}

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

// Fetch instructor data
$user_id = $_SESSION["user_id"];
$sql = "SELECT * FROM instructor WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

// Fetch courses for the instructor
$courses_sql = "SELECT * FROM addcourse WHERE id = ?"; // Adjust this query as needed
$stmt = $conn->prepare($courses_sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$courses_result = $stmt->get_result();

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }
        .profile-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            color: #001F3F;
            text-align: center;
            margin-bottom: 20px;
        }
        .user-info {
            background: #f9f9f9;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
        .user-info p {
            margin: 10px 0;
            font-size: 1.1rem;
        }
        .user-info strong {
            color: #001F3F;
        }
        .section {
            margin-top: 20px;
        }
        .section h2 {
            color: #001F3F;
            border-bottom: 2px solid #001F3F;
            padding-bottom: 10px;
            margin-bottom: 20px;
        }
        .courses-list {
            list-style: none;
            padding: 0;
        }
        .courses-list li {
            background: #f9f9f9;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .courses-list li:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        .courses-list li strong {
            color: #001F3F;
            font-size: 1.2rem;
        }
        .courses-list li p {
            margin: 5px 0;
            color: #555;
        }
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background: #001F3F;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background: #003366;
        }
    </style>
</head>
<body>
    <div class="profile-container">
        <h1>Welcome, <?php echo $user["fname"] . " " . $user["lname"]; ?></h1>
        
        <div class="user-info">
            <p><strong>Email:</strong> <?php echo $user["email"]; ?></p>
            <p><strong>Username:</strong> <?php echo $user["username"]; ?></p>
            <p><strong>Role:</strong> Instructor</p>
            <p><strong>Expertise:</strong> <?php echo $user["expertise"]; ?></p>
        </div>

        <div class="section">
            <h2>My Courses</h2>
            <?php if ($courses_result->num_rows > 0): ?>
                <ul class="courses-list">
                    <?php while ($course = $courses_result->fetch_assoc()): ?>
                        <li>
                            <strong><?php echo $course["course_title"]; ?></strong>
                            <p><?php echo $course["course_description"]; ?></p>
                            <p><strong>Category:</strong> <?php echo $course["course_category"]; ?></p>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php else: ?>
                <p>No courses found.</p>
            <?php endif; ?>
        </div>

        <a href="#" class="btn">Edit Profile</a>
    </div>
</body>
</html>