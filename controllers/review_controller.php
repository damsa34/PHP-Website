<?php
    class ReviewController {
        public function create_review($userID, $productID, $rating, $comment) {
            if ($rating < 1 || $rating > 10) {
                throw new Exception("Rating must be between 1 and 10.");
            }
    
            $reviewDB = new ReviewDB();
            $reviewDB->add_review($userID, $productID, $rating, $comment);
            header("Location: index.php?action=show_product&productID=" . $productID);
            exit();
        }
    
        public function get_reviews_by_product($productID) {
            $reviewDB = new ReviewDB();
            return $reviewDB->get_reviews_by_product($productID);
        }
    
        public function get_review_by_id($reviewID) {
            $reviewDB = new ReviewDB();
            return $reviewDB->get_review_by_id($reviewID);
        }

        public function show_edit_review_form() {
            include_once './views/product/edit_review_form.php';
        }
    
        public function update_review($reviewID, $rating, $comment) {
            if ($rating < 1 || $rating > 10) {
                throw new Exception("Rating must be between 1 and 10.");
            }
        
            $reviewDB = new ReviewDB();
            $reviewDB->update_review($reviewID, $rating, $comment);
        
            $productDB = new ProductDB();
            $product = $productDB->find_by_review($reviewID);
        
            if ($product) {
                header("Location: index.php?action=show_product&productID=" . $product['productID']);
            } else {
                throw new Exception("Product not found for this review.");
            }
            exit();
        }
    
        public function delete_review($reviewID) {
            $reviewDB = new ReviewDB();
            $review = $reviewDB->get_review_by_id($reviewID);
            if ($review) {
                $productID = $review['productID'];
                $reviewDB->delete_review($reviewID);
        
                if ($productID) {
                    header("Location: index.php?action=show_product&productID=" . $productID);
                } else {
                    throw new Exception("Product not found for this review.");
                }
                exit();
            } else {
                throw new Exception("Review not found.");
            }
        }
    
        public function get_average_rating_by_product($productID) {
            $reviewDB = new ReviewDB();
            return $reviewDB->get_average_rating_by_product($productID);
        }
    
        public function get_reviews_by_user($userID) {
            $reviewDB = new ReviewDB();
            return $reviewDB->get_reviews_by_user($userID);
        }
    
        public function get_top_rated_products() {
            $reviewDB = new ReviewDB();
            return $reviewDB->get_top_rated_products();
        }
    }