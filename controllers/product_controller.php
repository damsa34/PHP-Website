<?php
    class ProductController {
        public function list_all_products() {
            $productDB = new ProductDB();
            $products = $productDB->find_all();
            include_once './views/product/home_page.php';
        }

        public function show_product($productID) {
            $productDB = new ProductDB();
            $product = $productDB->find_by_id($productID);
            include_once './views/product/product.php';
        }

        public function filter_products($search_string) {
            $productDB = new ProductDB();
            $products = $productDB->find_by_name($search_string);
            include_once './views/product/product_list.php';
        }   

        public function add_product() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = filter_input(INPUT_POST, 'name');
                $description = filter_input(INPUT_POST, 'description');
                $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
                $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/';
                    $file_name = basename($_FILES['image']['name']);
                    $target_file = $upload_dir . $file_name;

                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                        $image_path = $target_file;
                        echo "The file " . htmlspecialchars($file_name) . " has been uploaded.";
                    } else {
                        echo "There was an error uploading your file.";
                        exit;
                    }
                } else {
                    echo "No file was uploaded or there was an error.";
                }

                $productDB = new ProductDB();
                $productDB->create($name, $description, $price, $categoryID, $image_path, htmlspecialchars($_SESSION['userID']));
                echo "Product added successfully.";
                header('Location: index.php');
                exit;
            } else {
                $this->show_add_product_form();
            }
        }

        public function show_add_product_form() {
            $categoryDB = new CategoryDB();
            $categories = $categoryDB->find_all();
            include_once './views/product/add_product_form.php';
        }

        public function edit_product() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $productID = filter_input(INPUT_POST, 'productID', FILTER_VALIDATE_INT);
                $name = filter_input(INPUT_POST, 'name');
                $description = filter_input(INPUT_POST, 'description');
                $price = filter_input(INPUT_POST, 'price', FILTER_VALIDATE_FLOAT);
                $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
                $image_path = null;

                if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                    $upload_dir = 'uploads/';
                    $file_name = basename($_FILES['image']['name']);
                    $target_file = $upload_dir . $file_name;

                    if (!is_dir($upload_dir)) {
                        mkdir($upload_dir, 0777, true);
                    }

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $target_file)) {
                        $image_path = $target_file;
                    } else {
                        echo "There was an error uploading your file.";
                        exit;
                    }
                }

                $productDB = new ProductDB();
                $productDB->update($productID, $name, $description, $price, $categoryID, $image_path);
                echo "Product updated successfully.";
                header('Location: index.php?action=show_product&productID=' . $productID);
                exit;
            } else {
                $productID = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT);
                $productDB = new ProductDB();
                $product = $productDB->find_by_id($productID);
                $categoryDB = new CategoryDB();
                $categories = $categoryDB->find_all();
                include_once './views/product/edit_product_form.php';
            }
        }

        public function show_edit_product_form() {
            $productID = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT);

            if (isset($productID)) {
                $productDB = new ProductDB();
                $product = $productDB->find_by_id($productID);
                if (isset($product)) {
                    $categoryDB = new CategoryDB();
                    $categories = $categoryDB->find_all();
                    include_once './views/product/edit_product_form.php';
                } else {
                    echo "Product not found.";
                }
            } else {
                echo "Invalid product ID.";
            }
        }

        public function delete_product() {
            $productID = filter_input(INPUT_GET, 'productID', FILTER_VALIDATE_INT);

            if (isset($productID)) {
                $productDB = new ProductDB();
                $productDB->delete($productID);
                echo "Product deleted successfully.";
                header('Location: index.php?action=home_page');
                exit;
            } else {
                echo "Invalid product ID.";
            }
        }
    }