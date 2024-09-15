<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Add Category</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br>
        <main>
            <div class="container form-group w-25">
                <h1 class="mb-4">Add a New Category</h1>
                <form action="index.php?action=add_category" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Category Name</label>
                        <input type="text" id="name" name="name" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Category Description</label>
                        <textarea id="description" name="description" class="form-control"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>