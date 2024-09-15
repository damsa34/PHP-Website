<?php
    class OrderDB {
        public function create_order($userID, $total_cost) {
            $query = "INSERT INTO orders (userID, total_cost)
            VALUES (:userID, :total_cost)";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->bindValue(':total_cost', $total_cost);
            $statement->execute();
            $orderID = Database::get_db()->lastInsertId();
            $statement->closeCursor();

            return $orderID;
        }

        public function remove_order($orderID) {
            $query = "DELETE FROM orders
            WHERE orderID = :orderID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':orderID', $orderID);
            $statement->execute();
            $statement->closeCursor();
        }

        public function get_order_by_id($orderID) {
            $query = "SELECT * FROM orders 
            WHERE orderID = :orderID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':orderID', $orderID);
            $statement->execute();
            $order = $statement->fetch();
            $statement->closeCursor();
            return $order;
        }

        public function get_orders_by_user($userID) {
            $query = "SELECT * FROM orders 
            WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $orders = $statement->fetchAll();
            $statement->closeCursor();
            return $orders;
        }

        public function count_user_orders($userID) {
            $query = "SELECT COUNT(*) AS order_count
            FROM orders
            WHERE userID = :userID";
            $statement = Database::get_db()->prepare($query);
            $statement->bindValue(':userID', $userID);
            $statement->execute();
            $result = $statement->fetch();
            $statement->closeCursor();

            return $result['order_count'];
        }
    }