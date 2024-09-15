<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Register</title>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <main>
            <div class="container form-group w-25">
                <br>
                <h2>Register</h2>
                <?php if (isset($error)): ?>
                    <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form action="index.php?action=register" method="post">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" id="username" name="username" class="form-control" required value="<?php htmlspecialchars($username ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" id="email" name="email" class="form-control" required value="<?php htmlspecialchars($email ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm password</label>
                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required value="<?php htmlspecialchars($name ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" id="country" name="country" class="form-control" required value="<?php htmlspecialchars($country ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone number</label>
                        <input type="tel" id="phone" name="phone" class="form-control" required value="<?php htmlspecialchars($phone ?? ''); ?>">
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select id="role" name="role" class="form-control" required>
                            <option value="Customer" <?php echo (isset($role) && $role === 'Customer') ? 'selected' : ''; ?>>Customer</option>
                            <option value="Admin" <?php echo (isset($role) && $role === 'Customer') ? 'selected' : ''; ?>>Admin</option>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <p class="mt-3">Already have an account? <a href="index.php?action=show_login_form">Login here</a>.</p>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>