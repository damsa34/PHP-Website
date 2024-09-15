<?php 
    enum Role {
        case Customer;
        case Admin;
    };

    class User {
        private int $userID;
        private string $username;
        private string $password;
        private string $email;
        private string $name;
        private string $country;
        private string $phone;
        private Role $role;

        private function __construct($username, $email, $password, $name, $country, $phone, $role = Role::Customer) {
            $this->username = $username;
            $this->email = $email;
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
            $this->password = $hashedPassword;
            $this->name = $name;
            $this->country = $country;
            $this->phone = $phone;
            $this->role = $role;
        }

        public function get_userID(): int { return $this->userID; }

        public function set_userID($userID): void { $this->userID = $userID; }

        public function get_username(): string { return $this->username; }

        public function set_username($username): void { $this->username = $username; }

        public function set_password($password): void { 
            $new_hashed_password = password_hash($password, PASSWORD_BCRYPT);
            $this->password = $new_hashed_password; 
        }

        public function get_password(): string { return $this->password; }

        public function get_email(): string { return $this->email; }

        public function set_email($email): void { $this->email = $email; }

        public function get_name(): string { return $this->name; }

        public function set_name($name): void { $this->name = $name; }

        public function get_country(): string { return $this->country; }

        public function set_country($country): void { $this->country = $country; }

        public function get_phone(): string { return $this->phone; }

        public function set_phone($phone): void { $this->phone = $phone; }

        public function get_role(): string { 
            switch ($this->role) {
                case Role::Admin:
                    return 'Admin';
                
                case Role::Customer:
                default:
                    return 'Customer';
            }
        }

        public function set_role($role): void { $this->role = $role; }
    }