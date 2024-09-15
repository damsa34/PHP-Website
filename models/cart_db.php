<?php
    class CartDB {
        public function get_cart_items($userID) {
            $query = "SELECT * FROM cart
            JOIN products ON cart.productID = products.productID
            WHERE cart.userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $cart_items = $statement->fetchAll();
            $statement->closeCursor();

            return $cart_items;
        }

        public function add_to_cart($userID, $productID, $quantity) {
            $query = "INSERT INTO cart (userID, productID, quantity)
            VALUES (:userID, :productID, :quantity)
            ON DUPLICATE KEY UPDATE quantity = quantity + :quantity";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':productID', $productID);
            $statement->bindValue(':quantity', $quantity);
            $statement->execute();
            $statement->closeCursor();
        }

        public function update_cart_quantity($userID, $productID, $quantity) {
            $query = "UPDATE cart
            SET quantity = :quantity
            WHERE userID = :userID
            AND productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':productID', $productID);
            $statement->bindValue(':quantity', $quantity);
            $statement->execute();
            $statement->closeCursor();
        }

        public function remove_from_cart($userID, $productID) {
            $query = "DELETE FROM cart
            WHERE userID = :userID
            AND productID = :productID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':productID', $productID);
            $statement->execute();
            $statement->closeCursor();
        }

        public function clear_cart($userID) {
            $query = "DELETE FROM cart
            WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $statement->closeCursor();
        }

        public function calculate_cart_total($userID) {
            $query = "SELECT SUM(products.price * cart.quantity) AS total_cost 
                      FROM cart 
                      JOIN products ON cart.productID = products.productID 
                      WHERE cart.userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            $statement->closeCursor();
    
            return $result['total_cost'];
        }
    }