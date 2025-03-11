
        // Function to toggle admin sidebar
        function toggleAdminSidebar() {
            const adminSidebar = document.getElementById('adminSidebar');
            const mainContent = document.getElementById('mainContent');
            adminSidebar.classList.toggle('active');
            mainContent.classList.toggle('active');
        }

        // Function to handle logout
        function logout() {
            alert('Logging out...'); // Replace with actual logout logic
            window.location.href = '/logout'; // Redirect to logout page
        }