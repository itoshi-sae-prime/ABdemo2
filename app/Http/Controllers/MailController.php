<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
    public function sendMail()
    {
        $mail = new PHPMailer(true);

        try {
            // Cấu hình máy chủ SMTP
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'tukien951@gmail.com';  // Địa chỉ Gmail của bạn
            $mail->Password   = 'nagw pgbh iegy hdbw';     // Mật khẩu ứng dụng
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

            // Cấu hình người gửi và người nhận
            $mail->setFrom('tukien951@gmail.com', 'LungTungStudio');
            $mail->addAddress('tukien159@gmail.com');  // Địa chỉ email người nhận

            // Lấy giỏ hàng từ session
            $cart = session()->get('cart', []);
            $total = 0;

            // Tạo nội dung email từ giỏ hàng
            $emailContent = '<h1>Your Shopping Cart</h1>';
            $emailContent .= '<p>Dear Customer,</p>'; // Lời chào
            $emailContent .= '<p>Thank you for shopping with us! Here are the items in your cart:</p>'; // Lời cảm ơn

            foreach ($cart as $item) {
                $emailContent .= "<p><img src=\"{$item['img']}\" alt=\"Product Image\"></p>";
                $emailContent .= "<p>Product: {$item['name']}</p>";
                $emailContent .= "<p>Price: \${$item['price']}</p>";
                $emailContent .= "<p>Quantity: {$item['quantity']}</p>";
                $emailContent .= "<hr>";
                $total += ($item['price'] ?? 0) * ($item['quantity'] ?? 1);
            }

            $emailContent .= "<p><strong>Total: \${$total}</strong></p>";
            $emailContent .= '<p>We appreciate your business!</p>'; // Lời cảm ơn thêm
            $emailContent .= '<p>Best Regards,<br>Your Company Name</p>'; // Kết thúc với lời chào

            // Nội dung email
            $mail->isHTML(true);
            $mail->Subject = 'Your Shopping Cart Summary';
            $mail->Body    = $emailContent;
            $mail->AltBody = 'Your shopping cart details.';

            // Gửi email
            $mail->send();
            return back()->with('success', 'Email has been sent successfully');
        } catch (Exception $e) {
            return back()->with('error', "Email could not be sent. Error: {$mail->ErrorInfo}");
        }
    }
}
