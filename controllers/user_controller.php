<?php
    class UserController {
        public function show_profile() {
            $userID = filter_input(INPUT_GET, 'userID', FILTER_VALIDATE_INT);
            if (!is_int($userID)) {
                require './errors/invalid_input.php';
                exit;
            }

            $userDB = new UserDB();
            $user = $userDB->find_by_id($userID);
            if (!$user) {
                require './errors/user_not_found.php';
                exit;
            }

            include_once './views/user/profile.php';
        }

        public function register() {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');
            $confirm_password = filter_input(INPUT_POST, 'confirm_password');
            $email = filter_input(INPUT_POST, 'email');
            $name = filter_input(INPUT_POST, 'name');
            $country = filter_input(INPUT_POST, 'country');
            $phone = filter_input(INPUT_POST, 'phone');
            $role = filter_input(INPUT_POST, 'role');
            
            if (empty($username) || empty($password) || empty($email) || empty($name) || empty($country) || empty($phone)) {
                $error = 'All fields are required.';
                include_once './views/user/register.php';
                return;
            }

            if ($password !== $confirm_password) {
                $error = "Passwords don't match.";
                include_once './views/user/register.php';
                return;
            }

            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $userDB = new UserDB();
            $userDB->create($username, $hashed_password, $email, $name, $country, $phone, $role);
            $user = $userDB->find_by_username($username);
            if ($user) {
                session_start();
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['role'] = $user['role'];

                setcookie('username', $user['username'], time() + 86400 * 30, '/', '', true, true);
                setcookie('role', $user['role'], time() + 86400 * 30, '/', '', true, true);

                header('Location: index.php?action=home_page');
                exit;
            } else {
                $error = "Registration failed. Try again.";
                include_once './views/user/register.php';
            }
        }

        public function show_register_form() {
            include_once './views/user/register.php';
        }

        public function login() {
            $username = filter_input(INPUT_POST, 'username');
            $password = filter_input(INPUT_POST, 'password');

            if (empty($username) || empty($password)) {
                $error = "Please enter your username and password.";
                include_once './views/user/login.php';
                exit;
            }

            $userDB = new UserDB();
            $user = $userDB->find_by_username($username);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['userID'] = $user['userID'];
                $_SESSION['role'] = $user['role'];

                setcookie('username', $user['username'], time() + 86400 * 30, '/', '', true, true);
                setcookie('role', $user['role'], time() + 86400 * 30, '/', '', true, true);

                header('Location: index.php?action=home_page');
                exit;
            } else {
                $error = "Invalid username or password.";
                include_once './views/user/login.php';
            }
        }

        public function show_login_form() {
            include_once './views/user/login.php';
        }

        public function logout() {
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
                        
            session_destroy();
            
            setcookie('username', '', time() - 3600, '/', '', true, true);
            setcookie('role', '', time() - 3600, '/', '', true, true);
            setcookie(session_name(), '', time() - 3600, '/', '', true, true);
            header('Location: index.php');
            exit();
        }
    }