<?php
    require_once './vendor/autoload.php';

    define('MAILHOST', 'smtp.gmail.com');
    define('MAILPORT', 587);
    define('USERNAME', 'testmail@gmail.com');
    define('PASSWORD', 'testpassword');
    define('SMTP_ENCRYPTION', 'tls');
    define("SEND_FROM", 'testmail@gmail.com');
    define("SEND_FROM_NAME", "ECommerce Company");