<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        /* Gói toàn bộ khung đăng ký */
        .content-wrapper {
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 40px 20px;
        min-height: 100vh;
        /* background: linear-gradient(to right, #e0f7fa, #fff); */
        }

        /* Khung form */
        .register-container {
        background-color: #ffffff;
        padding: 30px 40px;
        border-radius: 12px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        width: 100%;
        max-width: 480px;
        }

        /* Tiêu đề */
        .register-container h2 {
        text-align: center;
        color: #198754;
        margin-bottom: 25px;
        font-weight: bold;
        }

        /* Form group spacing */
        .form-group {
        margin-bottom: 18px;
        }

        /* Label */
        .form-group label {
        display: block;
        margin-bottom: 6px;
        color: #333;
        /* font-weight: 500; */
        }

        /* Input */
        .form-group input {
        width: 100%;
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 6px;
        font-size: 15px;
        transition: border-color 0.3s;
        }

        .form-group input:focus {
        border-color: #198754;
        outline: none;
        }

        /* Nút đăng ký */
        .register-btn {
            width: 30%;
            padding: 12px;
            background-color: #198754;
            border: none;
            color: #fff;
            font-weight: bold;
            font-size: 16px;
            border-radius: 6px;
            cursor: pointer;
            transition: background-color 0.3s;
            display: block;
            margin: 20px auto 0 auto;
        }

        .register-btn:hover {
        background-color: #157347;
        }

        /* Thông báo lỗi */
        .error-msg {
        margin-top: 12px;
        color: #dc3545;
        font-weight: 500;
        text-align: center;
        }
        main {
            flex: 1;
            margin-top: 170px;
        }
    </style>
</head>
<body>
    <main>
        <div class="content-wrapper">
            <div class="register-container">
                <h2>Đăng Ký</h2>
                <form action="index.php?act=xulu-dangki" method="post">
                    <div class="form-group">
                        <label for="username">Tên đăng nhập</label>
                        <input type="text" id="username" name="user" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Mật khẩu</label>
                        <input type="password" id="password" name="pass" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Họ và tên</label>
                        <input type="text" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="address">Địa chỉ</label>
                        <input type="text" id="address" name="address" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Số điện thoại</label>
                        <input type="text" id="phone" name="phone" required>
                    </div>
                    <input name="dangki" type="submit" value ="Đăng kí" class="register-btn">
                    
                </form>
                <?php
                        // if(isset($txt) && $txt != ""){
                        //     echo "<p class='error-msg'>$txt</p>";
                        // }
                        // thông báo đăng kí thành công
                    //     if (isset($_GET['msg']) && $_GET['msg'] == 'dangky_thanhcong') {
                    //     echo '
                    //     <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                    //         <strong>Thông báo!</strong> Bạn đã đăng kí thành công.
                    //         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    //     </div>';
                    // }

                    ?>
            </div>
        </div>
</main>
</body>
</html>