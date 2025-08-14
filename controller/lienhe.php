<?php
        // $mail->Password = 'osqn nihz cxli';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'libs/src/PHPMailer.php';
require 'libs/src/SMTP.php';
require 'libs/src/Exception.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['thong_bao'])) {
    $ten = $_POST['name'];
    $sdt = $_POST['sdt'];
    $email = $_POST['email'];
    $diachi = $_POST['diachi'];
    $noidung = $_POST['noidung'];

    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'nhatlan677@gmail.com';
        $mail->Password = 'dryb nrbg ovyk rqex';//thay mk 
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        $mail->CharSet = 'UTF-8'; // Đảm bảo hỗ trợ tiếng Việt
        $mail->setFrom('nhatlan677@gmail.com', 'Website thực phẩm sạch');
        $mail->addAddress('nhatlan677@gmail.com');//có thể bất kì mail nào
        $mail->addReplyTo($email, $ten);

        $mail->isHTML(true);
        
        $mail->Subject = "📩 Liên hệ từ khách hàng: $ten";
        $mail->Body = "
            <strong>Họ và tên:</strong> $ten<br>
            <strong>Số điện thoại:</strong> $sdt<br>
            <strong>Email:</strong> $email<br>
            <strong>Địa chỉ:</strong> $diachi<br>
            <strong>Nội dung:</strong><br>$noidung
        ";

        $mail->send();
         // ✅ Gửi thành công → hiện alert và quay về trang liên hệ
        echo "<script>
                alert('✅ Gửi liên hệ thành công!');
                window.location.href = 'index.php?act=lienhe';
              </script>";
        exit();
    } catch (Exception $e) {
        echo "<script>
                alert('❌ Gửi không thành công: " . $mail->ErrorInfo . "');
                window.location.href = 'index.php?act=lienhe';
              </script>";
        exit();
    }

    // include "index.php?act=lienhe"; // form + thông báo
    // Sau khi xử lý gửi mail
        // header('Location: index.php?act=lienhe&status=success');
        // exit();
}

?>