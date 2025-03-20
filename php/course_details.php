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

// Fetch specific course data
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Invalid ID");
}
$id = intval($_GET['id']);

$stmt = $conn->prepare("SELECT * FROM addcourse WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$course = $result->fetch_assoc();

if (!$course) {
    die("Course not found");
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Course Details - MindSpark Admin</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="./../css/navbar.css">
    <link rel="stylesheet" href="./../css/footer.css">
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
        .course-details {
            max-width: 1200px;
            margin: 0 auto;
            background: white;
            border-radius: 20px;
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 30px;
            position: relative;
        }

        /* Course Image */
        .course-image {
            width: 100%;
            height: 350px;
            overflow: hidden;
            border-radius: 15px;
            margin-bottom: 30px;
            position: relative;
        }

        .course-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .course-image:hover img {
            transform: scale(1.1);
        }

        /* Course Content */
        .course-content h2 {
            font-size: 32px;
            color: #2575fc;
            margin-bottom: 15px;
            font-weight: bold;
            text-align: center;
        }

        .course-content p {
            font-size: 16px;
            color: #555;
            line-height: 1.8;
            margin-bottom: 30px;
            text-align: center;
        }

        /* Section Headings */
        .section-heading {
            font-size: 26px;
            color: #2575fc;
            margin-bottom: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
            justify-content: center;
        }

        .section-heading i {
            font-size: 32px;
            color: #6a11cb;
        }

        /* Embedded Video */
        .video-container {
            margin-bottom: 40px;
            background: rgba(245, 245, 245, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .video-container iframe {
            width: 100%;
            height: 400px;
            border: none;
            border-radius: 15px;
        }

        .video-info {
            font-size: 14px;
            color: #777;
            margin-top: 15px;
            text-align: center;
        }

        /* Embedded PDF */
        .pdf-container {
            margin-bottom: 40px;
            background: rgba(245, 245, 245, 0.8);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .pdf-container iframe {
            width: 100%;
            height: 500px;
            border: none;
            border-radius: 15px;
        }

        .pdf-info {
            font-size: 14px;
            color: #777;
            margin-top: 15px;
            text-align: center;
        }

        /* Back Button */
        .back-btn {
            display: inline-block;
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            color: white;
            padding: 12px 24px;
            border-radius: 30px;
            text-decoration: none;
            text-align: center;
            font-size: 16px;
            transition: background 0.3s ease, transform 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: absolute;
            top: 20px;
            left: 20px;
        }

        .back-btn:hover {
            background: linear-gradient(135deg, #2575fc, #6a11cb);
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
        }

        /* Enhanced Info Sections */
.video-info, .pdf-info {
    background: rgba(245, 245, 245, 0.9);
    padding: 20px;
    border-radius: 15px;
    margin-top: 20px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    animation: fadeIn 1s ease-out;
}

.video-info p, .pdf-info p {
    font-size: 16px;
    color: #444;
    line-height: 1.6;
    margin-bottom: 15px;
}

.video-info ul, .pdf-info ul {
    list-style-type: none;
    padding: 0;
    margin: 15px 0;
}

.video-info ul li, .pdf-info ul li {
    font-size: 14px;
    color: #555;
    margin-bottom: 10px;
    display: flex;
    align-items: center;
    gap: 10px;
}

.video-info ul li i, .pdf-info ul li i {
    color: #6a11cb;
    font-size: 16px;
}

.highlight {
    background: linear-gradient(135deg, #ff9a9e, #fad0c4); /* Soft pink to peach gradient */
    color: #333; /* Dark text for contrast */
    padding: 10px;
    border-radius: 10px;
    text-align: center;
    margin-top: 15px;
    font-weight: bold;
    animation: pulse 2s infinite;
    border: 1px solid rgba(255, 255, 255, 0.3); /* Subtle border for depth */
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Soft shadow */
}

@keyframes pulse {
    0% { transform: scale(1); }
    50% { transform: scale(1.05); }
    100% { transform: scale(1); }
}

/* Responsive Design */
@media (max-width: 768px) {
    .video-info, .pdf-info {
        padding: 15px;
    }

    .video-info p, .pdf-info p {
        font-size: 14px;
    }

    .video-info ul li, .pdf-info ul li {
        font-size: 13px;
    }
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

        .course-details {
            animation: fadeIn 0.8s ease-out;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .course-image {
                height: 250px;
            }

            .course-content h2 {
                font-size: 28px;
            }

            .section-heading {
                font-size: 22px;
            }

            .video-container iframe {
                height: 300px;
            }

            .pdf-container iframe {
                height: 400px;
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
                    <a href="./../addcourse.php">Beginner Courses</a>
                    <a href="./../addcourse.php">Intermediate Courses</a>
                    <a href="./../addcourse.php">Advanced Courses</a>
                </div>
            </li> 
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
                    <a href="../blogs.html">Blog</a>
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
    <div class="course-details">

        <!-- Course Image -->
        <div class="course-image">
            <img src="../uploads/<?php echo htmlspecialchars($course['course_thumbnail']); ?>" alt="<?php echo htmlspecialchars($course['course_title']); ?>">
        </div>

        <!-- Course Content -->
        <div class="course-content">
            <h2><?php echo htmlspecialchars($course['course_title']); ?></h2>
            <p><?php echo htmlspecialchars($course['course_description']); ?></p>

            <!-- Embedded Video -->
            <div class="video-container">
    <div class="section-heading">
        <i class="fas fa-video"></i>
        <h3>Video Lecture 🎥</h3>
    </div>
    <?php if (!empty($course['video_link'])): ?>
        <iframe 
            src="<?php echo htmlspecialchars($course['video_link']); ?>" 
            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
            allowfullscreen
            title="Course Video Lecture"
        ></iframe>
    <?php else: ?>
        <p class="video-error">Video lecture not available.</p>
    <?php endif; ?>
    <div class="video-info">
        <p>
            <i class="fas fa-lightbulb"></i> <strong>Unlock the Power of Knowledge!</strong> This video lecture dives deep into the core concepts of the course, providing you with a clear and engaging explanation. Watch it to:
        </p>
        <ul>
            <li><i class="fas fa-check-circle"></i> Understand complex topics with ease.</li>
            <li><i class="fas fa-brain"></i> Strengthen your conceptual foundation.</li>
            <li><i class="fas fa-clock"></i> Learn at your own pace with pause and rewind options.</li>
        </ul>
        <p class="highlight">
            <i class="fas fa-star"></i> Pro Tip: Take notes while watching to maximize your learning!
        </p>
    </div>
</div>

            <!-- Embedded PDF Notes -->
            <div class="pdf-container">
    <div class="section-heading">
        <i class="fas fa-file-pdf"></i>
        <h3>PDF Notes 📄</h3>
    </div>
    <iframe src="../uploads/<?php echo htmlspecialchars($course['pdfFileInput']); ?>"></iframe>
    <div class="pdf-info">
        <p>
            <i class="fas fa-book-open"></i> <strong>Your Ultimate Study Companion!</strong> These PDF notes are meticulously crafted to help you:
        </p>
        <ul>
            <li><i class="fas fa-check-circle"></i> Quickly revise key concepts.</li>
            <li><i class="fas fa-highlighter"></i> Highlight important points for last-minute preparation.</li>
            <li><i class="fas fa-download"></i> Download and study offline anytime, anywhere.</li>
        </ul>
        <p class="highlight">
            <i class="fas fa-star"></i> Pro Tip: Print these notes for a handy physical copy!
        </p>
    </div>
</div>

            <!-- Embedded Handwritten Notes -->
            <div class="pdf-container">
    <div class="section-heading">
        <i class="fas fa-file-alt"></i>
        <h3>Handwritten Notes ✍️</h3>
    </div>
    <iframe src="../uploads/<?php echo htmlspecialchars($course['handwrittenFileInput']); ?>"></iframe>
    <div class="pdf-info">
        <p>
            <i class="fas fa-pencil-alt"></i> <strong>Personalized Learning Experience!</strong> These handwritten notes offer a unique perspective on the course material. They are perfect for:
        </p>
        <ul>
            <li><i class="fas fa-check-circle"></i> Visual learners who prefer a more personal touch.</li>
            <li><i class="fas fa-lightbulb"></i> Gaining additional insights and tips from the author.</li>
            <li><i class="fas fa-download"></i> Downloading and annotating for a customized study experience.</li>
        </ul>
        <p class="highlight">
            <i class="fas fa-star"></i> Pro Tip: Use these notes alongside the video lectures for a comprehensive understanding!
        </p>
    </div>
</div>
 </div>
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