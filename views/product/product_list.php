<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="./views/main.css">
        <style>
            td {
                text-align: center;
            }
            td.description {
                max-width: 250px;
                white-space: nowrap;
                overflow: hidden;
                text-overflow: ellipsis;
            }
        </style>
        <title>Product List</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include './views/header.php'; ?>
        <main>
            <div class="container mt-5 pt-5">
                <h1>Product List</h1>
                <hr>
                <?php if (empty($products)): ?>
                    <p>No products found.</p>
                <?php else: ?>
                    <table class="table table-striped">
                        <thead>
                            <tr class="text-center">
                                <th scope="col">Product</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Category</th>
                                <th scope="col">Price</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($products as $product): ?>
                                <tr class="text-center">
                                    <td>
                                        <img src="<?php echo htmlspecialchars($product['image']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" style="width: 100px; height: auto;">
                                    </td>
                                    <td><?php echo htmlspecialchars($product['name']); ?></td>
                                    <td class="description"><?php echo htmlspecialchars($product['description']); ?></td>
                                    <td><?php echo htmlspecialchars($product['category_name']); ?></td> 
                                    <td>$<?php echo number_format($product['price'], 2); ?></td>
                                    <td>
                                        <div class="container">
                                        <a href="index.php?action=show_product&productID=<?php echo $product['productID']; ?>" class="btn btn-info">View</a>
                                        <?php if (isset($_SESSION['userID']) && $_SESSION['role'] === 'Admin'): ?>
                                        <a href="index.php?action=edit_product&productID=<?php echo $product['productID']; ?>" class="btn btn-warning">Edit</a>
                                        <a href="index.php?action=delete_product&productID=<?php echo $product['productID']; ?>" class="btn btn-danger">Delete</a>
                                        <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endif; ?>
            </div>
        </main>

        <?php include './views/footer.php'; ?>
    </body>
</html>
