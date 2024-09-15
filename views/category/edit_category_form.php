<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Edit Category</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <div class="container form-group w-25">
            <h2>Edit Category</h2>
            <?php if (!empty($category)): ?>
                <form action="index.php?action=edit_category" method="post">
                    <input type="hidden" name="categoryID" value="<?php echo htmlspecialchars($category['categoryID']); ?>">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($category['description']); ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Save Changes</button>
                    <a href="index.php?action=show_categories" class="btn btn-secondary">Cancel</a>
                </form>
            <?php else: ?>
                <div class="alert alert-warning" role="alert">
                    Category not found.
                </div>
            <?php endif; ?>
        </div>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>