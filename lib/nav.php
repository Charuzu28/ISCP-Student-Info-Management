<nav class="navbar navbar-light bg-light">
    <a href="#" class="ml-5">
        <img src="img/iscp-logo.png" alt="Logo" class="me-2" style="width: 70px; height: 70px; padding: 10px;">
    </a>
    <div class="ms-auto d-flex align-items-center">
        <?php if (isset($_SESSION['fname'])): ?>
            <span class="me-3">Welcome, <?php echo htmlspecialchars($_SESSION['fname']); ?></span>
        <?php endif; ?>

        <?php if (isset($_SESSION['profile_pic']) && !empty($_SESSION['profile_pic'])): ?>
            <img src="img/<?php echo htmlspecialchars($_SESSION['profile_pic']); ?>" alt="Profile Picture" class="profile-pic" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;" />
        <?php else: ?>
            <i class="fas fa-user" style="font-size: 30px; margin-right: 10px;"></i>
        <?php endif; ?>

        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="padding: 10px;">
                Account
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="update-profile.php">Account Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                        <button onclick="logout()" type="submit" class="dropdown-item">Log Out</button>
                </li>
            </ul>
        </div>
    </div>
</nav>
