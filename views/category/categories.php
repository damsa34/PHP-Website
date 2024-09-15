<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Categories</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <main class="container form-group w-25">
            <br>
            <h2>Categories</h2>
            <?php if ($is_logged_in && $user_role == 'Admin'): ?>
                <a href="index.php?action=show_add_category_form" class="btn btn-primary">Add new category</a>
                <hr>
            <?php endif; ?>
            <?php if (!empty($categories)): ?>
                <?php foreach ($categories as $category): ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo htmlspecialchars($category['name']); ?></h5>
                            <p class="card-text"><?php echo htmlspecialchars($category['description']); ?></p>                            
                            <a href="index.php?action=show_category_products&categoryID=<?php echo htmlspecialchars($category['categoryID']); ?>" class="btn btn-secondary">View Products</a>
                            <?php if ($is_logged_in && $user_role == 'Admin'): ?>
                                <a href="index.php?action=show_edit_category_form&categoryID=<?php echo htmlspecialchars($category['categoryID']); ?>" class="btn btn-warning">Edit</a>
                                
                                <form action="index.php?action=delete_category" method="post" class="d-inline">
                                    <input type="hidden" name="categoryID" value="<?php echo htmlspecialchars($category['categoryID']); ?>">
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No categories available.</p>
            <?php endif; ?>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>