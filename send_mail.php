<?php
    require_once './config.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require './vendor/autoload.php';

    function send_order_confirmation_email($recipientEmail, $recipientName, $orderID, $total_cost) {
        $mail = new PHPMailer(true);
        
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = MAILHOST;
            $mail->SMTPAuth = true;
            $mail->Username = USERNAME;     
            $mail->Password = PASSWORD;     
            $mail->SMTPSecure = SMTP_ENCRYPTION;   
            $mail->Port = MAILPORT;

            // Sender and recipient settings
            $mail->setFrom(USERNAME, 'ECommerce Company');   
            $mail->addAddress($recipientEmail, $recipientName);  

            $userID = $_SESSION['userID'];
            $orderDB = new OrderDB();
            $user_order_count = $orderDB->count_user_orders($userID);
            $user_order_number = $user_order_count + 1;

            // Email content
            $mail->isHTML(true);
            $mail->Subject = "Order Confirmation #{$user_order_number}";
            $mail->Body = "<h1>Thank you for your order!</h1>";
            $mail->Body .= "<p>Your order with ID #{$user_order_number} has been successfully placed.</p>";
            $mail->Body .= "<p>The total amount is $" . number_format($total_cost, 2) . ".</p>";

            // Send the email
            $mail->send();
            return true;
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            return false;
        }
    }