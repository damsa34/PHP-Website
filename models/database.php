<?php
    class Database {
        private static string $dsn = 'mysql:host=localhost;dbname=projectdatabase';
        private static string $username = 'dame';
        private static string $password = 'CyJsr2CM3rkcCxrV';
        private static PDO $db;

        private function __construct() {}

        public static function get_db(): PDO {
            if (!isset(self::$db)) {
                try {
                    self::$db = new PDO(
                        self::$dsn,
                        self::$username,
                        self::$password
                    );
                } catch (PDOException $e) {
                    $error = $e->getMessage();
                    echo dirname(__DIR__) . '/errors/database_error.php';
                    include dirname(__DIR__) . '/errors/database_error.php';
                    exit;
                }
            }

            return self::$db;
        }
    }