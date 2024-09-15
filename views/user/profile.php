<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Your Profile</title>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <main class="container mt-3 pt-3">
            <br><br><br><br>
            <h1 class="mb-4">Welcome, <?php echo htmlspecialchars($user['name']); ?>!</h1>
            <div class="list-group">
                <div class="list-group-item">
                    <h5>Name</h5>
                    <p><?php echo htmlspecialchars($user['name']); ?></p>
                </div>
                <div class="list-group-item">
                    <h5>Email</h5>
                    <p><?php echo htmlspecialchars($user['email']); ?></p>
                </div>
                <div class="list-group-item">
                    <h5>Country</h5>
                    <p><?php echo htmlspecialchars($user['country']); ?></p>
                </div>
                <div class="list-group-item">
                    <h5>Phone</h5>
                    <p><?php echo htmlspecialchars($user['phone']); ?></p>
                </div>
                <br>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>