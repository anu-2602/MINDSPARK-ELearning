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

// Function to handle file upload
function uploadFile($file, $target_dir) {
    $target_file = $target_dir . basename($file['name']);
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        return $target_file;
    } else {
        return false;
    }
}

// ✅ Move course thumbnail to uploads folder
$target_file_thumbnail = uploadFile($_FILES['course_thumbnail'], $target_dir);
if (!$target_file_thumbnail) {
    die("Error uploading course thumbnail.");
}

// ✅ Move PDF file to uploads folder
$target_file_pdf = uploadFile($_FILES['pdfFileInput'], $target_dir);
if (!$target_file_pdf) {
    die("Error uploading PDF file.");
}

// ✅ Move handwritten notes to uploads folder
$target_file_handwritten = uploadFile($_FILES['handwrittenFileInput'], $target_dir);
if (!$target_file_handwritten) {
    die("Error uploading handwritten notes.");
}

// ✅ Insert data into database (with file paths)
$sql = "INSERT INTO addcourse (course_title, course_category, course_description, course_thumbnail, video_link, pdfFileInput, handwrittenFileInput) 
        VALUES ('$course_title', '$course_category', '$course_description', '$course_thumbnail', '$video_link', '$pdfFileInput', '$handwrittenFileInput')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully. <a href='coursefetch.php'>View Records</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
