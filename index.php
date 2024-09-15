<?php
    session_start();

    include './models/database.php';

    include './classes/User.php';
    include './classes/Product.php';
    include './classes/Category.php';
    include './classes/Cart.php';
    include './classes/Review.php';
    include './classes/Order.php';

    include './models/user_db.php';
    include './models/product_db.php';
    include './models/category_db.php';
    include './models/cart_db.php';
    include './models/review_db.php';
    include './models/order_db.php';

    include './controllers/user_controller.php';
    include './controllers/product_controller.php';
    include './controllers/category_controller.php';
    include './controllers/cart_controller.php';
    include './controllers/review_controller.php';
    include './controllers/order_controller.php';

    $method = filter_input(INPUT_SERVER, 'REQUEST_METHOD');
    $action = filter_input(INPUT_POST, 'action');    

    //$https = filter_input(INPUT_SERVER, 'HTTPS');
    /*
    if (!$https) {
        $host = filter_input(INPUT_SERVER, 'HTTP_HOST');
        $uri = filter_input(INPUT_SERVER, 'REQUEST_URI');
        $url = 'https://' . $host . $uri;
        header("Location: " . $url);
        exit;
    }
    */

    if ($action == NULL) {
        $action = filter_input(INPUT_GET, 'action');
        if ($action == NULL) {
            $action = 'home_page';
        }
    }

    $controller = null;
    switch ($action) {
        // Product routes
        case 'home_page':
            $controller = new ProductController();
            $controller->list_all_products();
            break;
        
        case 'show_add_product_form':
            $controller = new ProductController();
            $controller->show_add_product_form();
            break;

        case 'add_product':
            $controller = new ProductController();
            $controller->add_product();
            break;

        case 'edit_product':
            $controller = new ProductController();
            $controller->edit_product();
            break;

        case 'delete_product':
            $controller = new ProductController();
            $controller->delete_product();
            break;

        case 'show_product':
            $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
            $controller = new ProductController();
            if (!isset($productID)) { $productID = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT); }
            $controller->show_product($productID);
            break;

        case 'filter_products':
            $search = filter_input(INPUT_POST, 'search');
            $controller = new ProductController();
            $controller->filter_products($search);
            break;
        
        // Category routes
        case 'show_categories':
            $controller = new CategoryController();
            $controller->show_all_categories();
            break;

        case 'show_category_products':
            $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
            $controller = new CategoryController();
            $controller->show_category_products($categoryID);
            break;

        case 'show_add_category_form':
            $controller = new CategoryController();
            $controller->show_add_category_form();
            break;

        case 'add_category':
            $controller = new CategoryController();
            $controller->add_category();
            break;

        case 'show_edit_category_form':
            $controller = new CategoryController();
            $controller->show_edit_category_form();
            break;
            
        case 'edit_category':
            $controller = new CategoryController();
            $controller->edit_category();
            break;

        case 'delete_category':
            $controller = new CategoryController();
            $controller->delete_category();
            break;

        // Profile routes
        case 'show_register_form':
            $controller = new UserController();
            $controller->show_register_form();
            break;

        case 'register':
            $controller = new UserController();
            $controller->register();
            break;

        case 'show_login_form':
            $controller = new UserController();
            $controller->show_login_form();
            break;

        case 'login':
            $controller = new UserController();
            $controller->login();
            break;

        case 'logout':
            $controller = new UserController();
            $controller->logout();
            break;

        case 'profile':
            $controller = new UserController();
            $controller->show_profile();
            break;

        // Cart routes
        case 'show_cart':
            $controller = new CartController();
            $controller->show_cart();
            break;

        case 'add_to_cart':
            $controller = new CartController();
            $controller->add_product();
            break;

        case 'remove_from_cart':
            $controller = new CartController();
            $controller->remove_product();
            break;
        
        case 'update_quantity':
            $controller = new CartController();
            $controller->update_quantity();
            break;

        case 'clear_cart':
            $controller = new CartController();
            $controller->clear_cart();
            break;

        // Order routes
        case 'checkout':
            $controller = new OrderController();
            $controller->checkout();
            break;

        case 'remove_order':
            $orderID = filter_input(INPUT_POST, 'orderID', FILTER_VALIDATE_INT);
            $controller = new OrderController();
            $controller->remove_order($orderID);
            break;

        case 'view_order':
            $orderID = filter_input(INPUT_POST, 'orderID', FILTER_VALIDATE_INT);
            $controller = new OrderController();
            $controller->view_order($orderID);
            break;

        case 'view_user_orders':
            $userID = filter_input(INPUT_POST, 'userID', FILTER_VALIDATE_INT);
            $controller = new OrderController();
            $controller->view_user_orders($userID);
            break;

        // Review routes
        case 'edit_review':
            $reviewID = filter_input(INPUT_POST, 'reviewID', FILTER_VALIDATE_INT);
            $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
            $comment = filter_input(INPUT_POST, 'comment');
            if (isset($reviewID) && isset($rating) && isset($comment)) {
                $controller = new ReviewController();
                $controller->update_review($reviewID, $rating, $comment);
            }
            break;

        case 'show_edit_review_form':
            $controller = new ReviewController();
            $controller->show_edit_review_form();
            break;

        case 'delete_review':
            $reviewID = filter_input(INPUT_POST, 'reviewID', FILTER_VALIDATE_INT);
            $controller = new ReviewController();
            $controller->delete_review($reviewID);
            break;

        case 'add_review':
            $userID = filter_input(INPUT_POST, 'userID', FILTER_VALIDATE_INT);
            $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
            $rating = filter_input(INPUT_POST, 'rating', FILTER_VALIDATE_INT);
            $comment = filter_input(INPUT_POST, 'comment');
            $controller = new ReviewController();
            $controller->create_review($userID, $productID, $rating, $comment);
            break;

        // Error default route
        default:
            include_once './errors/404.php';
            break;
    }