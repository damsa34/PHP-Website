<?php   
    class Category {
        private int $categoryID;
        private string $name;
        private string $description;

        private function __construct($name, $description) {
            $this->name = $name;
            $this->description = $description;
        }

        public function get_categoryID(): int { return $this->categoryID; }

        public function set_categoryID($categoryID): void { $this->categoryID = $categoryID; }

        public function get_name(): string { return $this->name; }

        public function set_name($name): void { $this->name = $name; }

        public function get_description(): string { return $this->description; }

        public function set_description($description): void { $this->description = $description; }
    }