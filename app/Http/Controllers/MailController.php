<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailController extends Controller
{
    public function sendMail(Request $request)
    {
        $email = $request->input('email');
        $name = $request->input('full_name');
        $phone = $request->input('phone');
        $address = $request->input('address');
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
            session()->save();
            // Lấy giỏ hàng từ session
            $cart = session()->get('cart', []);
            $total = 0;
            // Cấu hình người gửi và người nhận
            $mail->setFrom('tukien951@gmail.com', 'LungTungStudio');
            $mail->addAddress($email); // Địa chỉ email người nhận




            // Tạo nội dung email từ giỏ hàng
            $emailContent = '<h1>Your Order Confirmation</h1>';
            $emailContent .= '<p>Dear ' . $name . ',</p>';
            $emailContent .= '<p>Thank you for your recent purchase with [Your Company Name]. We appreciate your business.</p>';
            $emailContent .= '<p>**Shipping Address:**</p>';
            $emailContent .= '<p>' . $address . '</p>';
            $emailContent .= '<p>**Phone Number:**</p>';
            $emailContent .= '<p>' . $phone . '</p>';

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
            session()->forget('cart');
            return redirect()->route('all.search')->with('success', 'Email has been sent successfully');
        } catch (Exception $e) {
            return back()->with('error', "Email could not be sent. Error: {$mail->ErrorInfo}");
        }
    }
}
