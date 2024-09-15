<?php
    require_once './models/order_db.php';
    require_once './models/cart_db.php';
    require_once './send_mail.php';

    class OrderController {
        public function view_order($orderID) {
            $orderDB = new OrderDB();
            $order = $orderDB->get_order_by_id($orderID);
            include './views/order/show_order.php';
        }

        public function view_user_orders($userID) {
            $orderDB = new OrderDB();
            $orders = $orderDB->get_orders_by_user($userID);
            include './views/order/user_orders.php';
        }

        public function remove_order($orderID) {
            $orderDB = new OrderDB();
            $orderDB->remove_order($orderID);
            header("Location: index.php?action=view_user_orders&userID=" . $_SESSION['userID']);
            exit();
        }

        public function checkout() {
            $userID = $_SESSION['userID']; 
            $cartDB = new CartDB();
            $orderDB = new OrderDB();
    
            $total_cost = $cartDB->calculate_cart_total($userID);
    
            if ($total_cost > 0) {
                
                $orderID = $orderDB->create_order($userID, $total_cost);
                $cartDB->clear_cart($userID);
                
                $userDB = new UserDB();
                $user = $userDB->find_by_id($userID);
                $user_email = $user['email'];
                $user_name = $user['name'];
    
                if (filter_var($user_email, FILTER_VALIDATE_EMAIL)) {
                    $success = send_order_confirmation_email($user_email, $user_name, $orderID, $total_cost);
                    if ($success) {
                        header("Location: index.php?action=view_order&orderID=" . $orderID);
                        exit();
                    } else {
                        echo 'Error sending confirmation email.';
                    }
                } else {
                    echo 'Invalid email address.';
                }
            } else {
                echo "Error: Cart is empty or an error occurred.";
            }
        }
    }