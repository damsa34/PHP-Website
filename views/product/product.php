<?php
    require_once './models/review_db.php';
    require_once './models/product_db.php';

    $productDB = new ProductDB();
    $reviewDB = new ReviewDB();

    $productID = $_GET['productID'] ?? null;
    $product = $productDB->find_by_id($productID);
    $reviews = $reviewDB->get_reviews_by_product($productID);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>        
        <title><?php echo htmlspecialchars($product['name']); ?></title>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br><br>
        <main class="container mt-5">
            <div class="row">
                <div class="col-md-8 mx-auto">
                    <?php if (!empty($product)): ?>
                        <div class="row">
                            <div class="col-md-6">
                                <img src="./<?php echo htmlspecialchars($product['image']); ?>" class="img-fluid product-image" alt="<?php echo htmlspecialchars($product['name']); ?>">
                            </div>
                            <div class="col-md-5">
                                <h2><?php echo htmlspecialchars($product['name']); ?></h2>
                                <p class="h5"><?php echo "<div class='card-text'>" . htmlspecialchars($product['description']) . "</div>"; ?></p>
                                <p class="h4">Price: <?php echo "<span class='badge bg-success'>$" . number_format($product['price'], 2) . "</span>"; ?></p>
                                <div class="mt-1">
                                    <?php if ($is_logged_in): ?>
                                        <?php if ($user_role == 'Customer'): ?>
                                            <form action="index.php?action=add_to_cart" method="post" class="d-inline">
                                                <input type="hidden" name="productID" value="<?php echo htmlspecialchars($product['productID']); ?>">
                                                <input type="number" name="quantity" min="1" class="form-control" placeholder="Quantity"><hr>
                                                <button type="submit" class="btn btn-primary btn">Add to Cart</button>
                                            </form>
                                        <?php endif; ?>
                                        <?php if ($is_logged_in && $user_role == 'Admin'): ?>
                                            <a href="index.php?action=edit_product&productID=<?php echo htmlspecialchars($product['productID']); ?>" class="btn btn-warning btn-lg me-2">Edit</a>
                                            <a href="index.php?action=delete_product&productID=<?php echo htmlspecialchars($product['productID']); ?>" class="btn btn-danger btn-lg">Delete</a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                            <div class="row">
                                <?php if (isset($_SESSION['userID'])): ?>
                                    <div class="col-md-8 pt-2 mt-2">
                                        <h4>Leave a Review</h4>
                                        <form action="index.php?action=add_review" method="post">
                                            <?php if ($is_logged_in): ?>
                                                <input type="hidden" id="userID" name="userID" value="<?php echo htmlspecialchars($_SESSION['userID']); ?>">
                                            <?php endif; ?>
                                            <input type="hidden" id="productID" name="productID" value="<?php echo htmlspecialchars($product['productID']); ?>">
                                            <div class="form-group">
                                                <label for="rating">Rating (1-10):</label>
                                                <input type="number" id="rating" name="rating" class="form-control" min="1" max="10" required>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="comment">Comment:</label>
                                                <textarea id="comment" name="comment" class="form-control" rows="3" required></textarea>
                                            </div>
                                            <button type="submit" class="btn btn-primary mt-2">Submit Review</button>
                                            <?php if (isset($error)): ?>
                                                <div class="alert alert-danger mt-2"><?php echo htmlspecialchars($error); ?></div>
                                            <?php endif; ?>
                                        </form>
                                    </div>
                                <?php endif; ?>

                                <div class="col-md-8 mt-2 pt-2">
                                    <h4>Reviews</h4>
                                    <?php if (!empty($reviews)): ?>
                                        <ul class="list-group">
                                            <?php foreach ($reviews as $review): ?>
                                                <li class="list-group-item">
                                                    <div>
                                                        <strong><?php echo htmlspecialchars($review['username']); ?>:</strong>
                                                        <span class="badge bg-warning"><?php echo number_format($review['rating'], 1); ?></span>
                                                        <p><?php echo htmlspecialchars($review['comment']); ?></p>

                                                        <?php $review_user = $reviewDB->get_review_user($review['reviewID']); ?>
                                                        <?php if ($is_logged_in && $review_user['userID'] == $_SESSION['userID']): ?>
                                                            <a href="index.php?action=show_edit_review_form&reviewID=<?php echo htmlspecialchars($review['reviewID']); ?>" class="btn btn-warning btn-sm">Edit</a>
                                                            <form action="index.php?action=delete_review" method="post" class="d-inline">
                                                                <input type="hidden" name="reviewID" value="<?php echo htmlspecialchars($review['reviewID']); ?>">
                                                                <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                                            </form>
                                                        <?php endif; ?>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p>No reviews yet.</p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>                        
                    <?php else: ?>
                        <div class="alert alert-warning" role="alert">
                            Product not found.
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
</body>
</html>
