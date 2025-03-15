<div class="container">
        
        
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

$sql = "SELECT id, fname, lname, username, email, pass,expertise FROM instructor";
$results = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Records</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body { font-family: Arial, sans-serif; }
       table { width: 100%; border-collapse: collapse; }
       th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
       th { background-color: #f4f4f4; }

       body {
   font-family: Arial, sans-serif;
   margin: 0;
   padding: 0;
   background-color: #f4f4f4;
   color: #333;
}

/* Header */
header {
   background-color: #3498db;
   color: white;
   padding: 15px 20px;
   display: flex;
   justify-content: space-between;
   align-items: center;
   box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}

header h1 {
   margin: 0;
   font-size: 24px;
}

/* Navigation Links in Header */
.nav-links {
   display: flex;
   gap: 25px;
   align-items: center;
}

.nav-links a {
   color: rgb(236, 233, 233);
   text-decoration: none;
   font-size: 18px;
   padding: 10px 15px;
   border-radius: 5px;
   transition: all 0.3s ease;
   background-color: rgba(255, 255, 255, 0.1);
}

.nav-links a:hover {
   background-color: rgba(255, 255, 255, 0.2);
   transform: translateY(-2px);
   box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
}

.nav-links a:active {
   transform: translateY(0);
   box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
}

/* Admin Profile Section */
.admin-profile {
   display: flex;
   align-items: center;
   gap: 10px;
   cursor: pointer;
}

.admin-profile img {
   width: 40px;
   height: 40px;
   border-radius: 50%; /* Circular profile picture */
   object-fit: cover;
   border: 2px solid white;
}

.admin-profile .admin-name {
   font-size: 16px;
}

/* Menu Button (☰) */
.menu-btn {
   background: none;
   border: none;
   color: white;
   font-size: 24px;
   cursor: pointer;
   margin-left: 10px; /* Space between admin name and button */
}

.menu-btn:hover {
   color: #f1c40f; /* Change color on hover */
}

/* Admin Sidebar (Right Side) */
.admin-sidebar {
   width: 300px;
   background-color: #2c3e50;
   height: 100vh;
   position: fixed;
   top: 0;
   right: -3000px; /* Hide sidebar by default */
   padding: 20px;
   transition: right 0.3s ease;
   box-shadow: -2px 0 5px rgba(0, 0, 0, 0.1);
   z-index: 1000;
   display: flex;
   flex-direction: column;
   align-items: center;
}

.admin-sidebar.active {
   right: 0; /* Show sidebar */
}

/* Close Button at Top of Sidebar */
.admin-sidebar .close-btn {
   position: absolute;
   top: 10px;
   right: 10px;
   background: none;
   border: none;
   color: white;
   font-size: 24px;
   cursor: pointer;
}

.admin-sidebar .close-btn:hover {
   color: #e74c3c; /* Change color on hover */
}

/* Admin Profile at Top of Sidebar */
.admin-sidebar .sidebar-profile {
   text-align: center;
   margin-bottom: 20px;
}

.admin-sidebar .sidebar-profile img {
   width: 100px;
   height: 100px;
   border-radius: 100%;
   object-fit: cover;
   border: 3px solid #3498db;
}

.admin-sidebar .sidebar-profile .admin-name {
   font-size: 20px;
   margin-top: 10px;
   color: white;
}

/* Admin Details */
.admin-sidebar .admin-details {
   width: 100%;
   color: white;
}

.admin-sidebar .admin-details p {
   margin: 15px 0;
   font-size: 16px;
}

.admin-sidebar .admin-details p strong {
   color: #3498db;
}

/* Logout Button */
.admin-sidebar .logout-btn {
   background-color: #e74c3c;
   color: white;
   border: none;
   padding: 10px 20px;
   border-radius: 4px;
   cursor: pointer;
   width: 100%;
   margin-top: 20px; /* Push to the bottom */
   font-size: 16px;
   transition: background-color 0.3s ease;
}

.admin-sidebar .logout-btn:hover {
   background-color: #c0392b;
}

/* Main Content */
.main-content {
   margin-right: 0;
   padding: 20px;
   transition: margin-right 0.3s ease;
}

.main-content.active {
   margin-right: 300px; /* Adjust content when sidebar is visible */
}

/* Tables */
table {
   width: 100%;
   border-collapse: collapse;
   margin-top: 20px;
   background-color: white;
   box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

th, td {
   padding: 12px 15px;
   text-align: left;
   border-bottom: 1px solid #ddd;
}

th {
   background-color: #3498db;
   color: white;
}

tr:hover {
   background-color: #f1f1f1;
}

tr:nth-child(even) {
   background-color: #f9f9f9;
}

/* Responsive Design */
@media (max-width: 768px) {
   .nav-links {
       display: none; /* Hide navigation links on small screens */
   }

   .admin-sidebar {
       width: 100%;
       right: -100%; /* Hide sidebar by default on small screens */
   }

   .admin-sidebar.active {
       right: 0; /* Show sidebar on small screens */
   }

   .main-content.active {
       margin-right: 0;
   }
}
   
</style>
<body>
</head>
<header>
<h1> <a href="fadmin.php" style="text-decoration: none; color: white;">Mind-Spark Admin Panel</a></h1>
        <div class="nav-links">
            <a href="studfetch.php">Students</a>
            <a href="instfetch.php">Instructors</a>
            <a href="#courses">Courses</a>
            <a href="feedbackfetch.php">Feedback</a>
            <a href="contfetch.php">Contact</a>
        </div>
        <div class="admin-profile">
            <img src="./../img/logo.png" alt="Admin Profile">
            <div class="admin-name">Admin Name</div>
            <button class="menu-btn" onclick="toggleAdminSidebar()">☰</button>
        </div>
    </header>

    <!-- Admin Sidebar (Right Side) -->
    <div class="admin-sidebar" id="adminSidebar">
        <!-- Close Button at Top -->
        <button class="close-btn" onclick="toggleAdminSidebar()">×</button>

        <!-- Admin Profile at Top -->
        <div class="sidebar-profile">
            <img src="./../img/logo.png" alt="Admin Profile">
            <div class="admin-name">Admin Name</div>
        </div>

        <!-- Admin Details -->
        <div class="admin-details">
            <p><strong>Name:</strong> Admin Name</p>
            <p><strong>Email:</strong> admin@example.com</p>
            <p><strong>Role:</strong> Administrator</p>
        </div>

        <!-- Logout Button -->
        <button class="logout-btn" onclick="logout()">Logout</button>
    </div>
    <div>
<h1 >Registered Instructors</h1>
        <table border="1" cellpadding="10" cellspacing="0" width="100%">
            <tr>
              <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>User Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Expertise</th>
                <th>View</th>
            </tr>
            <?php if ($results->num_rows > 0): ?>
                <?php while($row = $results->fetch_assoc()): ?>
                    <tr>
                    <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['fname']; ?></td>
                        <td><?php echo $row['lname']; ?></td>
                        <td><?php echo $row['username']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['pass']; ?></td>
                        <td><?php echo $row['expertise']; ?></td>
                        <td><a href="instview.php?id=<?php echo $row['id']; ?>">View</a></td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No records found.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div>
    </body>
    <script src="./../js/admin1.js"></script>
</html>

<?php
$conn->close();
?>