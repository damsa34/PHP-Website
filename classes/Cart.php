<?php   
    class Cart {
        private int $cartID;
        private int $userID;
        private int $productID;
        private int $quantity;

        private function __construct($userID, $productID, $quantity) {
            $this->userID = $userID;
            $this->productID = $productID;
        }

        public function get_cartID(): int { return $this->cartID; }

        public function set_cartID($cartID): void { $this->cartID = $cartID; }

        public function get_userID(): int { return $this->userID; }

        public function set_userID($userID): void { $this->userID = $userID; }

        public function get_productID(): int { return $this->productID; }

        public function set_productID($productID): void { $this->productID = $productID; }

        public function get_quantity(): int { return $this->quantity; }

        public function set_quantity($quantity): void { $this->quantity = $quantity; }
    }