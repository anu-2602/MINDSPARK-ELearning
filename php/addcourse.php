<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mindspark_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// Fetch courses with instructor names
$sql = "SELECT addcourse.*, instructor.username AS instructor_name 
        FROM addcourse 
        JOIN instructor ON addcourse.id = instructor.id 
        ORDER BY course_category";
$result = $conn->query($sql);

$coursesByCategory = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $category = $row['course_category'];
        if (!isset($coursesByCategory[$category])) {
            $coursesByCategory[$category] = [];
        }
        $coursesByCategory[$category][] = $row;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Categories - MindSpark Admin</title>
    <link rel="stylesheet" href="./../css/navbar.css">
    <link rel="stylesheet" href="./../css/footer.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, #f4f4f9, #e0e0e8);
            color: #333;
            padding: 20px;
        }

        /* Container */
        .course-categories {
            max-width: 1200px;
            margin: 0 auto;
        }

        /* Category Section */
        .category-section {
            margin-bottom: 60px;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 0.8s ease-out;
        }

        .category-section h2 {
            font-size: 32px;
            color: #2575fc;
            margin-bottom: 30px;
            font-weight: bold;
            text-align: center;
            position: relative;
        }

        .category-section h2::after {
            content: '';
            width: 100px;
            height: 4px;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            border-radius: 2px;
        }

        /* Category Description */
        .category-description {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Course Cards Grid */
        .course-cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        /* Course Card */
        .card {
            background: rgba(255, 255, 255, 0.9);
            border-radius: 20px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.2);
        }

        /* Card Image */
        .card-image {
            width: 100%;
            height: 300px; /* Increased height for larger thumbnails */
            overflow: hidden;
            position: relative;
            border-bottom: 1px solid rgba(0, 0, 0, 0.1); /* Optional: Add a border for better separation */
        }

        .card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .card:hover .card-image img {
            transform: scale(1.1);
        }

        /* Card Content */
        .card-content {
            padding: 20px;
        }

        .card-content h3 {
            font-size: 24px;
            color: #2575fc;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .card-content p {
            font-size: 14px;
            color: #555;
            line-height: 1.6;
            margin-bottom: 15px;
        }

        .card-content ul {
            list-style: none;
            margin-bottom: 15px;
        }

        .card-content ul li {
            font-size: 14px;
            color: #555;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
        }

        .card-content ul li i {
            color: #2575fc;
            margin-right: 8px;
            font-size: 12px;
        }

        /* Instructor Section */
        .instructor-info {
            display: flex;
            align-items: center;
            margin-top: 15px;
        }

        .instructor-info img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
            border: 2px solid #2575fc;
        }

        .instructor-info p {
            font-size: 14px;
            color: #555;
        }

        .instructor-info p strong {
            color: #2575fc;
        }

        /* View Course Button */
        .view-course-btn {
            display: inline-block;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            padding: 10px 20px;
            border-radius: 25px;
            text-decoration: none;
            text-align: center;
            font-size: 14px;
            transition: background 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .view-course-btn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Animations */
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .course-cards {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            }

            .category-section h2 {
                font-size: 28px;
            }

            .card-image {
                height: 200px; /* Adjust height for smaller screens */
            }
        }

        @media (max-width: 480px) {
            .card-image {
                height: 150px; /* Adjust height for very small screens */
            }
        }
    </style>
</head>
<body>
<nav class="navbar">
        <div class="logo-container">
            <img src="../img/logo.webp" alt="MindSpark Logo" class="logo-img">
            <div class="logo">MindSpark</div>
        </div>
        <div class="menu-icon" onclick="toggleMenu()">☰</div>
        <ul class="nav-links">
            <li><a href="../index.html">Home</a></li>
            <li><a href="#">Start Here ▼</a>
                <div class="dropdown-menu">
                    <a href="../pages/roadmaps.html">Roadmaps</a>
                    <a href="../pages/new-user-guide.html">New User Guide</a>
                    <a href="../pages/faq.html">FAQs</a>
                </div>
            </li>
            <li><a href="#">Student Courses ▼</a>
                <div class="dropdown-menu">
                    <a href="#">Beginner Courses</a>
                    <a href="#">Intermediate Courses</a>
                    <a href="#">Advanced Courses</a>
                </div>
            </li> 
            <li><a href="#">Teacher Training</a></li>
            <li><a href="#">Library ▼</a>
                <div class="dropdown-menu">
                    <a href="#">E-BOOKS</a>
                    <a href="#">Audio-Books</a>
                    <a href="#">Resources</a>
                </div>
            </li>
            <li><a href="#">More ▼</a>
                <div class="dropdown-menu">
                    <a href="../pages/about.html">About Us</a>
                    <a href="../pages/contact.html">Contact</a>
                    <a href="#">Blog</a>
                </div>
            </li>
            <li>
                <div class="auth-buttons">
                    <a href="./../index.html" class="signin"><i class="fas fa-sign-in-alt"></i> LogOut</a>
                    <a href="#" class="register"><i class="fas fa-user-plus"></i> profile</a>
                </div>
            </li>
        </ul>
    </nav>
    <div class="course-categories">
        <?php
        // Define the sequence of categories
        $categoriesInSequence = ['Beginner', 'Intermediate', 'Advanced'];
        foreach ($categoriesInSequence as $category):
            if (isset($coursesByCategory[$category])):
        ?>
                <div class="category-section">
                    <!-- Category Heading -->
                    <h2><?php echo htmlspecialchars($category); ?> Courses</h2>

                    <!-- Category Description -->
                    <p class="category-description">
                        <?php
                        // Add a description for each category
                        if ($category === 'Beginner') {
                            echo "Start your learning journey with our beginner-friendly courses. Perfect for those new to the subject. 🌱";
                        } elseif ($category === 'Intermediate') {
                            echo "Take your skills to the next level with our intermediate courses. Build on your existing knowledge. 🚀";
                        } elseif ($category === 'Advanced') {
                            echo "Master the subject with our advanced courses. Designed for experienced learners. 🏆";
                        } else {
                            echo "Explore our courses in this category to enhance your knowledge and skills. 📚";
                        }
                        ?>
                    </p>

                    <!-- Course Cards Grid -->
                    <div class="course-cards">
                        <?php foreach ($coursesByCategory[$category] as $course): ?>
                            <div class="card">
                                <!-- Card Image -->
                                <div class="card-image">
                                    <img src="../uploads/<?php echo htmlspecialchars($course['course_thumbnail']); ?>" alt="<?php echo htmlspecialchars($course['course_title']); ?>">
                                </div>

                                <!-- Card Content -->
                                <div class="card-content">
                                    <h3><?php echo htmlspecialchars($course['course_title']); ?></h3>
                                    <p><?php echo htmlspecialchars($course['course_description']); ?></p>
                                    <ul>
                                        <li><i class="fas fa-check"></i>Includes Video Lectures</li>
                                        <li><i class="fas fa-check"></i>Downloadable PDF Notes</li>
                                        <li><i class="fas fa-check"></i>Handwritten Notes</li>
                                    </ul>

                                    <!-- Instructor Info -->
                                    <div class="instructor-info">
                                        <p><strong>Instructor:</strong> <?php echo htmlspecialchars($course['instructor_name']); ?></p>
                                    </div>

                                    <!-- View Course Button -->
                                    <a href="course_details.php?id=<?php echo $course['id']; ?>" class="view-course-btn">View Course</a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
    <footer class="footer">
        <div class="footer-container">
            <div class="footer-row">
                <div class="footer-section about">
                    <h3>About MindSpark</h3>
                    <p>Your go-to platform for innovation, learning, and growth. Join us to explore new technologies and ideas.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="../pages/about.html">About</a></li>
                        <li><a href="../pages/courses.html">Courses</a></li>
                        <li><a href="../pages/contact.html">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><a href="mailto:Undeanushka2602@gmail.com"><i class="fas fa-envelope"></i> Undeanushka2602@gmail.com</a></li>
                        <li><a href="tel:+918262866596"><i class="fas fa-phone"></i> (+91) 8262866596</a></li>
                        <li><i class="fas fa-map-marker-alt"></i> Nashik, India</li>
                    </ul>
                </div>
                <div class="footer-section social">
                    <h3>Follow Us</h3>
                    <ul>
                        <li><a href="https://github.com" target="_blank"><i class="fab fa-github"></i> GitHub</a></li>
                        <li><a href="https://linkedin.com" target="_blank"><i class="fab fa-linkedin"></i> LinkedIn</a></li>
                        <li><a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i> Facebook</a></li>
                        <li><a href="https://twitter.com" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>
                        <li><a href="https://youtube.com" target="_blank"><i class="fab fa-youtube"></i> YouTube</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            &copy; 2025 MindSpark. All Rights Reserved.
        </div>
    </footer>
    <script>
        function toggleMenu() {
            const navbar = document.querySelector('.navbar');
            navbar.classList.toggle('active');
        }
    </script>
</body>
</html>