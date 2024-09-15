<?php 
    require_once './models/cart_db.php';
    $userID = $_SESSION['userID'];
    $cartDB = new CartDB();
    $cart_items = $cartDB->get_cart_items($userID);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <title>Your Cart</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include './views/header.php'; ?>
        <main>
            <div class="container mt-5 pt-5">
                <h1>Your Cart</h1>
                <?php if (empty($cart_items)): ?>
                    <p>Your cart is empty.</p>
                <?php else: ?>
                    <form action="index.php?action=clear_cart" method="post" class="mb-3">
                        <input type="hidden" name="userID" value="<?php echo htmlspecialchars($userID); ?>">
                        <button type="submit" class="btn btn-danger">Clear Cart</button>
                    </form>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Product</th>
                                <th scope="col">Quantity</th>
                                <th scope="col">Price</th>
                                <th scope="col">Total</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($cart_items as $item): ?>
                                <tr>
                                    <td>
                                        <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="<?php echo htmlspecialchars($item['name']); ?>" style="width: 100px; height: auto;">
                                        <?php echo htmlspecialchars($item['name']); ?>
                                    </td>
                                    <td>
                                        <?php echo htmlspecialchars($item['quantity']); ?>
                                    </td>
                                    <td>
                                        $<?php echo number_format($item['price'], 2); ?>
                                    </td>
                                    <td>
                                        $<?php echo number_format($item['price'] * $item['quantity'], 2); ?>
                                    </td>
                                    <td>
                                        <form action="index.php?action=update_quantity" method="post" class="d-flex">
                                            <input type="hidden" name="userID" value="<?php echo htmlspecialchars($userID); ?>">
                                            <input type="hidden" name="productID" value="<?php echo htmlspecialchars($item['productID']); ?>">
                                            <input type="number" name="quantity" class="form-control me-2">
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="index.php?action=remove_from_cart" method="post" class="mt-2">
                                            <input type="hidden" name="userID" value="<?php echo htmlspecialchars($userID); ?>">
                                            <input type="hidden" name="productID" value="<?php echo htmlspecialchars($item['productID']); ?>">
                                            <button type="submit" class="btn btn-danger">Remove</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <a href="index.php?action=checkout" class="btn btn-primary">Proceed to checkout</a>
                <?php endif; ?>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>
