<?php
    class Product {
        private int $productID;
        private int $categoryID;
        private string $name;
        private string $description;
        private float $price;
        private string $image_path;
        private int $userID;

        private function __construct($categoryID, $name, $description, $price, $image_path) {
            $this->categoryID = $categoryID;
            $this->name = $name;
            $this->description = $description;
            $this->price = $price;
            $this->image_path = $image_path;
        }

        public function get_productID(): int { return $this->productID; }

        public function set_productID($productID): void { $this->productID = $productID; }

        public function get_categoryID(): int { return $this->categoryID; }

        public function set_categoryID($categoryID): void { $this->categoryID = $categoryID; }

        public function get_userID(): int { return $this->userID; }

        public function set_userID($userID): void { $this->userID = $userID; }

        public function get_name(): string { return $this->name; }

        public function set_name($name): void { $this->name = $name; }

        public function get_description(): string { return $this->description; }

        public function set_description($description): void { $this->description = $description; }

        public function get_price(): float { return $this->price; }

        public function set_price($price): void { $this->price = $price; }

        public function get_image_path(): string { return $this->image_path; }

        public function set_image_path($image_path): void { $this->image_path = $image_path; }
    }