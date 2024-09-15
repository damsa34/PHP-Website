<?php    
    $is_logged_in = isset($_SESSION['userID']);
    $user_role = $_SESSION['role'] ?? 'Customer';

    $categoryDB = new CategoryDB();
    $categories = $categoryDB->find_all();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <header>
            <nav class="navbar navbar-expand-sm bg-dark fixed-top">
                <div class="container">
                    <form action="index.php?action=filter_products" method="post" class="d-flex ms-2">
                        <input class="form-control me-2" type="text" id="search" name="search" placeholder="Search">
                    </form>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=home_page">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="index.php?action=show_categories">Categories</a>
                            </li>
                            <?php if ($is_logged_in && $user_role === 'Customer'): ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=view_user_orders">Your orders</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                        
                        <ul class="navbar-nav ms-auto">
                            <?php if ($is_logged_in): ?>
                                <?php if ($user_role === 'Customer'): ?>
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php?action=show_cart">Your cart</a>
                                    </li>
                                <?php endif; ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=profile&userID=<?php echo htmlspecialchars($_SESSION['userID']); ?>"><?php echo htmlspecialchars($_COOKIE['username']); ?></a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=logout">Logout</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=show_register_form">Register</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="index.php?action=show_login_form">Login</a>
                                </li>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
    </body>
</html>
