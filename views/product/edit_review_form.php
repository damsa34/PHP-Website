<?php
    require_once './models/review_db.php';

    $reviewID = filter_input(INPUT_GET, 'reviewID', FILTER_VALIDATE_INT);

    if (!$reviewID) {
        echo "Invalid review ID.";
        exit();
    }

    $reviewDB = new ReviewDB();
    $review = $reviewDB->get_review_by_id($reviewID);

    if (!$review) {
        echo "Review not found.";
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="./views/main.css">
        <title>Edit Review</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>
    <body>
        <?php include_once './views/header.php'; ?>
        <br>
        <main class="container form-group w-25">
            <h2>Edit Review</h2>
            
            <form action="index.php?action=edit_review" method="post">
                <input type="hidden" name="reviewID" value="<?php echo htmlspecialchars($review['reviewID']); ?>">

                <div class="form-group">
                    <label for="rating">Rating (1-10):</label>
                    <input type="number" id="rating" name="rating" class="form-control" min="1" max="10" value="<?php echo htmlspecialchars($review['rating']); ?>" required>
                </div>

                <div class="form-group">
                    <label for="comment">Comment:</label>
                    <textarea id="comment" name="comment" class="form-control" rows="4" required><?php echo htmlspecialchars($review['comment']); ?></textarea>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Update Review</button>
            </form>

            <div class="mt-3">
                <a href="index.php?action=show_product&productID=<?php echo htmlspecialchars($review['productID']); ?>" class="btn btn-secondary">Cancel</a>
            </div>
        </main>

        <?php include_once './views/footer.php'; ?>
    </body>
</html>
