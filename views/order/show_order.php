<?php
    require_once './models/order_db.php';
    require_once './models/product_db.php';

    $orderID = $_GET['orderID'] ?? null;
    $orderDB = new OrderDB();
    $order = $orderDB->get_order_by_id($orderID);    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./views/main.css">
        <title>Order Details</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br>
        <main>
            <div class="container mt-5">
                <h1>Order Details</h1>
                <?php if ($order): ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order #<?php echo $orderID; ?></h5>
                            <p class="card-text"><strong>Total Cost:</strong> $<?php echo number_format($order['total_cost'], 2); ?></p>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="alert alert-warning" role="alert">
                        Order not found.
                    </div>
                <?php endif; ?>
                <a href="index.php?action=view_user_orders" class="btn btn-secondary mt-3">Back to Orders</a>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>
