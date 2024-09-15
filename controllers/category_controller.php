<?php
    class CategoryController {
        public function add_category() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $name = filter_input(INPUT_POST, 'name');
                $description = filter_input(INPUT_POST, 'description');
                
                $categoryDB = new CategoryDB();
                $categoryDB->create($name, $description);

                header('Location: index.php?action=show_categories');
                exit;
            } else {
                include_once './views/category/add_category_form.php';
            }
        }

        public function show_all_categories() {
            $categoryDB = new CategoryDB();
            $categories = $categoryDB->find_all();
            include_once './views/category/categories.php';
        }

        public function show_add_category_form() {
            include_once './views/category/add_category_form.php';
        }

        public function edit_category() {
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $categoryID = filter_input(INPUT_POST, 'categoryID', FILTER_VALIDATE_INT);
                $name = filter_input(INPUT_POST, 'name');
                $description = filter_input(INPUT_POST, 'description');
    
                if ($categoryID && $name && $description) {
                    $categoryDB = new CategoryDB();
                    $categoryDB->update($categoryID, $name, $description);
    
                    header('Location: index.php?action=show_categories');
                    exit;
                } else {    
                    header('Location: index.php?action=show_edit_category_form&categoryID=' . $categoryID);
                    exit;
                }
            } else {
                header('Location: index.php?action=show_categories');
                exit;
            }
        }

        public function show_edit_category_form() {
            $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
            if ($categoryID) {
                $categoryDB = new CategoryDB();
                $category = $categoryDB->find_by_id($categoryID);
                include_once './views/category/edit_category_form.php';
            } else {
                header('Location: index.php?action=show_categories');
                exit;
            }
        }

        public function delete_category() {
            $categoryID = filter_input(INPUT_GET, 'categoryID', FILTER_VALIDATE_INT);
            if ($categoryID) {
                $categoryDB = new CategoryDB();
                $categoryDB->delete($categoryID);
    
                header('Location: index.php?action=show_categories');
                exit;
            } else {
                header('Location: index.php?action=show_categories');
                exit;
            }
        }

        public function show_category_products($categoryID) {
            include './views/category/category.php';
        }
    }