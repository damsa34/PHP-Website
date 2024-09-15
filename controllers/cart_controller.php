<?php
    class CartController {
        public function add_product() {
            $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

            if (isset($_SESSION['userID']) && isset($productID) && isset($quantity)) {
                $cart_db = new CartDB();
                $cart_db->add_to_cart($_SESSION['userID'], $productID, $quantity);
                header("Location: index.php?action=home_page");
            } else {
                require './errors/invalid_input.php';
            }
        }

        public function update_quantity() {
            $userID = filter_input(INPUT_POST, 'userID', FILTER_VALIDATE_INT);
            $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
            $quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT);

            if (isset($userID) && isset($productID) && isset($quantity)) {
                $cart_db = new CartDB();
                $cart_db->add_to_cart($userID, $productID, $quantity);
                header("Location: index.php?action=show_cart");
            } else {
                require './errors/invalid_input.php';
            }
        }

        public function remove_product() {
            $userID = filter_input(INPUT_POST, 'userID', FILTER_VALIDATE_INT);
            $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);

            if (isset($userID) && isset($productID)) {
                $cart_db = new CartDB();
                $cart_db->remove_from_cart($userID, $productID);
                header("Location: index.php?action=show_cart");
            } else {
                require './errors/invalid_input.php';
            }
        }

        public function clear_cart() {
            $userID = filter_input(INPUT_POST, 'userID', FILTER_VALIDATE_INT);

            if (isset($userID)) {
                $cart_db = new CartDB();
                $cart_db->clear_cart($userID);
                header("Location: index.php?action=show_cart");
            } else {
                require './errors/invalid_input.php';
            }
        }

        public function show_cart() {
            include_once './views/cart/cart_view.php';
        }

        public function checkout() {
            if (!isset($_SESSION['userID'])) {
                header("Location: index.php?action=login");
                exit;
            }
    
            $userID = $_SESSION['userID'];
    
            $cart_db = new CartDB();
            $cart_items = $cart_db->get_cart_items($userID);
    
            if (empty($cart_items)) {
                header("Location: index.php?action=show_cart");
                exit;
            }
    
            $total_cost = 0;
            foreach ($cart_items as $item) {
                $total_cost += $item['price'] * $item['quantity'];
            }
    
            $order_db = new OrderDB(); 
            $orderID = $order_db->create_order($userID, $total_cost); 
    
            $cart_db->clear_cart($userID);
    
            header("Location: index.php?action=order_confirmation&orderID=" . $orderID);
            exit;
        }
    }