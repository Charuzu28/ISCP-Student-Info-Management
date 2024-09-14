<?php
session_start();
?>

<script>
    if (confirm('Are you sure you want to log out?')) {
        <?php
        session_unset();
        session_destroy();
        ?>
        alert('You have been logged out!');
        window.location.href = 'login.php';
    } else {
        alert('Logout canceled.');
        window.location.href = 'dashboard.php'; 
    }
</script>

<?php
exit;
?>
