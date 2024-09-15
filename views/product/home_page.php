<?php 
    require_once './models/database.php';
    require_once './models/product_db.php';

    $is_logged_in = isset($_SESSION['userID']);
    $user_role = $_SESSION['role'] ?? 'Customer';

    $product_db = new ProductDB();
    if ($is_logged_in) {
        $user_products = $product_db->get_products_by_user_id($_SESSION['userID']);
    } else {
        $user_products = array();
    }
    $products = $product_db->find_all();

    $reviewDB = new ReviewDB();
    $top_rated_products = $reviewDB->get_top_rated_products();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br>
        <main>
            <div class="container mt-3 pt-3">
                <div class="row">
                    <div class="col-md-9">
                        <div class="row">
                            <?php if ($is_logged_in && !empty($user_products)): ?>
                                <h2>Your products</h2>
                                <?php foreach($user_products as $user_product): ?>
                                    <div class="col-md-4 mb-4">
                                        <div class="card">
                                            <img src="<?php echo htmlspecialchars($user_product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <?php echo htmlspecialchars($user_product['name']); ?>
                                                </h5>
                                                <p class="card-text">
                                                    <?php
                                                        $short_description = substr($user_product['description'], 0, 100);
                                                        echo htmlspecialchars($short_description);

                                                        if (strlen($user_product['description']) > 100) {
                                                            echo '...';
                                                        }
                                                    ?>
                                                </p>
                                                <p class="cart-text">
                                                    Rating: <?php echo '<span class="badge bg-success">' . number_format($reviewDB->get_average_rating_by_product($user_product['productID']), 1) . '</span>'; ?>
                                                </p>
                                                <p class="card-text">
                                                    <strong>
                                                        Price: <?php echo "<span class='badge bg-info'>$" . number_format($user_product['price'], 2) . "</span>"; ?>
                                                    </strong>
                                                </p>
                                                <a href="index.php?action=show_product&productID=<?php echo $user_product['productID']; ?>" class="btn btn-info">View</a>

                                                <?php if ($is_logged_in): ?>
                                                    <a href="index.php?action=edit_product&productID=<?php echo $user_product['productID']; ?>" class="btn btn-warning">Edit</a>
                                                    <a href="index.php?action=delete_product&productID=<?php echo $user_product['productID']; ?>" class="btn btn-danger">Delete</a>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                <hr>
                            <?php endif; ?>
                        </div>
                        <h2>All products</h2>
                        <div class="row">
                            <?php foreach ($products as $product): ?>
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="<?php echo htmlspecialchars($product['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($product['name']); ?>">
                                        <div class="card-body">
                                            <h5 class="card-title">
                                                <?php echo htmlspecialchars($product['name']); ?>
                                            </h5>
                                            <p class="card-text">
                                                <?php
                                                    $short_description = substr($product['description'], 0, 100);
                                                    echo htmlspecialchars($short_description);

                                                    if (strlen($product['description']) > 100) {
                                                        echo '...';
                                                    }
                                                ?>
                                            </p>
                                            <p class="cart-text">
                                                Rating: <?php echo '<span class="badge bg-success">' . number_format($reviewDB->get_average_rating_by_product($product['productID']), 1) . '</span>'; ?>
                                            </p>
                                            <p class="card-text">
                                                <strong>
                                                    Price: <?php echo "<span class='badge bg-info'>$" . number_format($product['price'], 2) . "</span>"; ?>
                                                </strong>
                                            </p>
                                            <p>
                                                <?php $user = $product_db->get_user_of_product($product['productID']); ?>
                                                <strong>
                                                    Published by: <?php echo "<span class='badge bg-info'>" . htmlspecialchars($user['username']) . "</span>"; ?>
                                                </strong>
                                            </p>
                                            <a href="index.php?action=show_product&productID=<?php echo $product['productID']; ?>" class="btn btn-info">View</a>

                                            <?php if ($is_logged_in && $user_role == 'Customer'): ?>
                                                <form action="index.php?action=add_to_cart" method="post" class="d-inline">
                                                    <input type="hidden" name="userID" value="<?php echo $_SESSION['userID']; ?>">
                                                    <input type="hidden" name="productID" value="<?php echo $product['productID'] ?>">
                                                    <input type="hidden" name="quantity" value="1">
                                                    <button type="submit" class="btn btn-primary">Add to cart</button>
                                                </form>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div>
                            <h5>Top Rated Products</h5>
                            <ul class="list-group">
                                <?php foreach ($top_rated_products as $top_product): ?>
                                    <li class="list-group-item">
                                        <a href="index.php?action=show_product&productID=<?php echo htmlspecialchars($top_product['productID']); ?>">
                                            <?php echo htmlspecialchars($top_product['name']); ?>
                                        </a>
                                        <span class="badge bg-success float-end"><?php echo number_format($top_product['average_rating'], 1); ?></span>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php if($is_logged_in): ?>
                    <hr>
                    <a href="index.php?action=show_add_product_form" class="btn btn-primary">Add new product</a>                
                <?php endif; ?>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>
