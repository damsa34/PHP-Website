<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Add Product</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include './views/header.php'; ?>
        <br><br>
        <main>
            <div class="container form-group w-25">
                <h1>Add New Product</h1>
                <form action="index.php?action=add_product" method="post" enctype="multipart/form-data">
                    <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea id="description" name="description" class="form-control" required></textarea>
                    </div>

                    <div class="form-group">
                        <label for="price">Price</label>
                        <input type="number" id="price" name="price" class="form-control" step="0.01" required>
                    </div>

                    <div class="form-group">
                        <label for="categoryID">Category</label>
                        <select id="categoryID" name="categoryID" class="form-control" required>
                            <?php foreach ($categories as $category): ?>
                                <option value="<?php echo htmlspecialchars($category['categoryID']); ?>">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="image">Image</label>
                        <input type="file" id="image" name="image" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Add Product</button>
                </form>
            </div>
        </main>

        <?php include './views/footer.php'; ?>
    </body>
</html>
