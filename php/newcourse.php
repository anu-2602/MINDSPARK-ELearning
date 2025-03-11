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
$course_title = $_POST['course_title'];
$course_category = $_POST['course_category'];
$course_description = $_POST['course_description'];
$course_thumbnail = $_FILES['course_thumbnail']['name'];
$video_link = $_POST['video_link'];
$pdfFileInput = $_FILES['pdfFileInput']['name'];
$handwrittenFileInput = $_FILES['handwrittenFileInput']['name'];

// ✅ Set the correct upload path
$target_dir = __DIR__ . "/../uploads/";

// ✅ Move course thumbnail to uploads folder
$target_file_thumbnail = $target_dir . basename($_FILES['course_thumbnail']['name']);
move_uploaded_file($_FILES["course_thumbnail"]["tmp_name"], $target_file_thumbnail);

// ✅ Move PDF file to uploads folder
$target_file_pdf = $target_dir . basename($_FILES['pdfFileInput']['name']);
move_uploaded_file($_FILES["pdfFileInput"]["tmp_name"], $target_file_pdf);

// ✅ Move handwritten notes to uploads folder
$target_file_handwritten = $target_dir . basename($_FILES['handwrittenFileInput']['name']);
move_uploaded_file($_FILES["handwrittenFileInput"]["tmp_name"], $target_file_handwritten);

// ✅ Insert data into database (with file paths)
$sql = "INSERT INTO addcourse (course_title, course_category, course_description, course_thumbnail, video_link, pdfFileInput, handwrittenFileInput) 
        VALUES ('$course_title', '$course_category', '$course_description' , '$course_thumbnail' , '$video_link' , '$pdfFileInput', '$handwrittenFileInput')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. <a href='fetch.php'>View Records</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
