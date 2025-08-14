<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
    .center-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            margin-top: 40px;
            margin-bottom: 40px;

        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            max-width: 480px;
            width: 100%;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }

        .login-container h2 {
            color: #198754;
            margin-bottom: 20px;
            
            font-weight: bold;
        }

        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-size: 14px;
            color: #555;
        }

        .form-group input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            box-sizing: border-box;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            border-color: #198754;
            outline: none;
        }

        .login-btn {
            width: 30%;
            padding: 12px;
            background-color: #198754;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-btn:hover {
            background-color: #157347;
        }

        .login-btn:active {
            transform: scale(0.98);
        }
        .error-message{
            color: red;
        }
        main{
            flex: 1;
            margin-top: 170px;
        }
    </style>
</head>
<body>
    <main>
        
<div class="center-wrapper">
        <div class="login-container">
            <h2>Đăng Nhập</h2>
            <?php
                    if (isset($txt) && !empty($txt)) {
                        echo '<br><div class="error-message">' . htmlspecialchars($txt) . '</div>';
                    }
                ?>
            <form action="index.php?act=login" method="post">
           
                <div class="form-group">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="user" required>
                </div>
                <div class="form-group">
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="pass" required>
                </div>
                <!-- Thêm liên kết quên mật khẩu ngay trên nút đăng nhập -->
                <div class="form-group">
                    <a href="index.php?act=forgot_password" class="forgot-password-link">Quên mật khẩu?</a>
                    <a href="index.php?act=dangki" class="forgot-password-link">Tạo tài khoản</a>
                </div>
                <input name="login" type="submit" class="login-btn" value="Đăng nhập">
                
            </form>
        </div>
    </div>

    </main>
</body>
</html>