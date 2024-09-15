<?php
    class ReviewDB {
        public function add_review($userID, $productID, $rating, $comment) {
            $query = "INSERT INTO reviews (userID, productID, rating, comment)
                  VALUES (:userID, :productID, :rating, :comment)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':productID', $productID);
            $statement->bindValue(':rating', $rating);
            $statement->bindValue(':comment', $comment);
            $statement->execute();
            $statement->closeCursor();
        }

        public function get_review_user($reviewID) {
            $query = "SELECT users.* FROM users
            JOIN reviews ON reviews.userID = users.userID
            WHERE reviews.reviewID = :reviewID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':reviewID', $reviewID);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();

            return $user;
        }

        public function get_reviews_by_product($productID) {
            $query = "SELECT reviews.*, users.username 
            FROM reviews 
            JOIN users ON reviews.userID = users.userID
            WHERE reviews.productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $reviews = $statement->fetchAll();
            $statement->closeCursor();

            return $reviews;
        }

        public function get_review_by_id($reviewID) {
            $query = "SELECT * FROM reviews 
            WHERE reviewID = :reviewID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':reviewID', $reviewID);
            $statement->execute();
            $review = $statement->fetch();
            $statement->closeCursor();

            return $review;
        }

        public function update_review($reviewID, $rating, $comment) {
            $query = "UPDATE reviews
                  SET rating = :rating, comment = :comment
                  WHERE reviewID = :reviewID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':reviewID', $reviewID);
            $statement->bindValue(':rating', $rating);
            $statement->bindValue(':comment', $comment);
            $statement->execute();
            $statement->closeCursor();
        }

        public function delete_review($reviewID) {
            $query = "DELETE FROM reviews 
            WHERE reviewID = :reviewID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':reviewID', $reviewID);
            $statement->execute();
            $statement->closeCursor();
        }

        public function get_average_rating_by_product($productID) {
            $query = "SELECT AVG(rating) as average_rating 
            FROM reviews 
            WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();

            return $result['average_rating'];
        }

        public function get_reviews_by_user($userID) {
            $query = "SELECT * FROM reviews 
            WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $reviews = $statement->fetchAll();
            $statement->closeCursor();

            return $reviews;
        }

        public function get_top_rated_products() {
            $query = "SELECT products.productID, products.name, AVG(reviews.rating) as average_rating
            FROM products JOIN reviews ON products.productID = reviews.productID
            GROUP BY products.productID
            ORDER BY average_rating DESC";
            $statement = Database::get_db()->prepare($query);
            $statement->execute();
            $top_rated_products = $statement->fetchAll();
            $statement->closeCursor();

            return $top_rated_products;
        }
    }