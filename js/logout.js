
    function logout(){
        if (confirm('Are you sure you want to log out?')) {
            // Redirect to the PHP file that handles the logout
            alert("You've been logout successfully!")
            window.location.href = 'logout.php';
        } else {
            // Redirect to the dashboard if the user cancels
            alert('Logout canceled.');
            window.location.href = 'dashboard.php';
        }
    }


   

