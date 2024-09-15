<?php
    class ProductDB {
        public function create($name, $description, $price, $categoryID, $image, $userID) {
            $query = "INSERT INTO products (name, description, price, categoryID, image, userID) 
            VALUES (:name, :description, :price, :categoryID, :image, :userID)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':image', $image);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $statement->closeCursor();
        }

        public function find_all() {
            $query = "SELECT * FROM products";
            $statement = Database::get_db()->prepare($query);
            $statement->execute();
            $products = $statement->fetchAll();
            $statement->closeCursor();
            return $products;
        }

        public function find_by_name($name) {
            $query = "SELECT products.*, categories.name AS category_name
            FROM products
            JOIN categories ON products.categoryID = categories.categoryID
            WHERE LOWER(products.name) LIKE LOWER(:name)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':name', '%' . $name . '%');
            $statement->execute();
            $names = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $names;
        }

        public function find_by_id($productID) {
            $query = "SELECT * FROM products
            WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $product = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $product;
        }

        public function find_by_category($categoryID) {
            $query = "SELECT * FROM products
            WHERE categoryID = :categoryID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->execute();
            $products = $statement->fetchAll();
            $statement->closeCursor();
            return $products;
        }

        public function find_by_review($reviewID) {
            $query = "SELECT products.* FROM products
            JOIN reviews ON products.productID = reviews.productID
            WHERE reviews.reviewID = :reviewID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':reviewID', $reviewID);
            $statement->execute();
            $product = $statement->fetch();
            $statement->closeCursor();
            return $product;
        }

        public function get_products_by_user_id($userID) {
            $query = "SELECT * FROM products
            WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $products = $statement->fetchAll(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $products;
        }

        public function get_user_of_product($productID) {
            $query = "SELECT * FROM users
            JOIN products ON products.userID = users.userID
            WHERE products.productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID, PDO::PARAM_INT);
            $statement->execute();
            $user = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
            return $user;
        }

        public function update($productID, $name, $description, $price, $categoryID, $image) {
            $query = "UPDATE products 
            SET name = :name, description = :description, price = :price, categoryID = :categoryID, image = :image
            WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->bindValue(':name', $name);
            $statement->bindValue(':description', $description);
            $statement->bindValue(':price', $price);
            $statement->bindValue(':categoryID', $categoryID);
            $statement->bindValue(':image', $image);
            $statement->execute();
            $statement->closeCursor();
        }

        public function delete($productID) {
            $query = "DELETE FROM products
            WHERE productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $statement->closeCursor();
        }
    }