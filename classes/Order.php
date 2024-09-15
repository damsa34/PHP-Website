<?php   
    class Order {
        private int $orderID;
        private int $userID;
        private int $total;

        private function __construct($userID, $total) {
            $this->userID = $userID;
            $this->total = $total;
        }

        public function get_orderID(): int { return $this->orderID; }

        public function set_orderID($orderID): void { $this->orderID = $orderID; }

        public function get_userID(): int { return $this->userID; }

        public function set_userID($userID): void { $this->userID = $userID; }

        public function get_total(): int { return $this->total; }

        public function set_total($total): void { $this->total = $total; }
    }