<nav class="navbar navbar-light bg-light">
        <a href="#" class="ml-5"><img src="img/iscp-logo.png" alt="Logo" class="me-2" style="width: 50px; height: 50px;"></a>
        <div class="dropdown">
            <button class="btn btn-light dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                <!-- <img src="img/hamburger-icon.png" alt="Menu" style="width: 30px; height: 30px;"> -->
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
                <li><a class="dropdown-item" href="#">Account Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form action="logout.php" method="post">
                        <button type="submit" class="dropdown-item">Log Out</button>
                    </form>
                </li>
            </ul>
        </div>
    </nav>