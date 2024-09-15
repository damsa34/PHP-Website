<?php
    class Review {
        private int $reviewID;
        private int $userID;
        private int $productID;
        private int $rating;
        private string $comment;

        private function __construct($userID, $productID, $rating, $comment) {
            $this->userID = $userID;
            $this->productID = $productID;
            $this->rating = $rating;
            $this->comment = $comment;
        }

        public function get_reviewID(): int { return $this->reviewID; }

        public function set_reviewID($reviewID): void { $this->reviewID = $reviewID; }

        public function get_userID(): int { return $this->userID; }

        public function set_userID($userID): void { $this->userID = $userID; }

        public function get_productID(): int { return $this->productID; }

        public function set_productID($productID): void { $this->productID = $productID; }

        public function get_rating(): string { return $this->rating; }

        public function set_rating($rating): void { $this->rating = $rating; }

        public function get_comment(): string { return $this->comment; }

        public function set_comment($comment): void { $this->comment = $comment; }
    }