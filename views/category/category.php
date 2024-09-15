<?php
    require_once './models/product_db.php';

    $productDB = new ProductDB();
    $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
    
    $products = $productDB->find_by_category($categoryID);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Category Products</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <main class="container mt-5 pt-5">
            <h2>Category products</h2><hr>  
            <?php if (!empty($products)): ?>
                <div class="row row-cols-1 row-cols-md-2 g-4">
                    <?php foreach ($products as $product): ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="./<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top img-fluid" alt="<?php echo htmlspecialchars($product['name']); ?>" style="object-fit: cover; height: 200px;">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                                    <p class="card-text"><?php echo htmlspecialchars($product['description']); ?></p>
                                    <p class="h5">Price: $<?php echo number_format($product['price'], 2); ?></p>
                                    <div class="mt-3 pt-3 d-inline">
                                    <a href="index.php?action=show_product&productID=<?php echo htmlspecialchars($product['productID']); ?>" class="btn btn-primary btn-sm">View Product</a>
                                    </div>
                                    <?php if ($is_logged_in && $user_role == 'Admin'): ?>
                                        <div class="mt-3 pt-3 d-inline">
                                            <a href="index.php?action=edit_product&productID=<?php echo htmlspecialchars($product['productID']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                            <form action="index.php?action=delete_product" method="post" class="d-inline">
                                                <input type="hidden" name="productID" value="<?php echo htmlspecialchars($product['productID']); ?>">
                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                            </form>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="alert alert-warning mt-5" role="alert">
                    No products found in this category.
                </div>
            <?php endif; ?>
            <br>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>