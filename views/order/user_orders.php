<?php
    require_once './models/order_db.php';

    $userID = $_SESSION['userID']; 
    $orderDB = new OrderDB();
    $orders = $orderDB->get_orders_by_user($userID);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./views/main.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <title>Your Orders</title>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br>
        <main>
            <div class="container mt-5">
                <h1>Your Orders</h1><hr>
                <?php if (!empty($orders)): ?>
                    <table class="table table-bordered table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th scope="col">Order ID</th>
                                <th scope="col">Total Cost</th>
                                <th scope="col-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?php echo $order['orderID']; ?></td>
                                    <td>$<?php echo number_format($order['total_cost'], 2); ?></td>
                                    <td>
                                        <a href="index.php?action=view_order&orderID=<?php echo htmlspecialchars($order['orderID']); ?>" class="btn btn-primary btn-sm">View</a>
                                        <form action="index.php?action=remove_order" method="post" class="d-inline">
                                            <input type="hidden" name="orderID" value="<?php echo htmlspecialchars($order['orderID']); ?>">
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <div class="alert alert-info" role="alert">
                        No orders found.
                    </div>
                <?php endif; ?>
            </div>
        </main>
        <?php include_once './views/footer.php'; ?>
    </body>
</html>
