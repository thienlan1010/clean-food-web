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
            margin-top: 210px;
            margin-bottom: 40px;

        }
        .login-container {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
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
            border-color: #157347;
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
            bbackground-color: #157347;
        }

        .login-btn:active {
            transform: scale(0.98);
        }
    </style>
</head>
<body>
<div class="center-wrapper">
        <div class="login-container">
            <h2>Quên Mật Khẩu</h2>
            <form action="index.php?act=update_password" method="post">
            <div class="form-group">
                <label for="email">Nhập tên đăng nhập:</label>
                <input type="text" id="name" name="name" placeholder="Tên đăng nhập hiện tại" required>
            </div>
            <div class="form-group">
                <label for="email">Nhập email:</label>
                <input type="text" id="email" name="email" placeholder="Email của bạn" required>
            </div>
                <div class="form-group">
                    <label for="password">Nhập mật khẩu mới:</label>
                    <input type="password" id="password" name="re-password" placeholder="Mật khẩu mới" required>
                </div>   
                <input name="capnhatmk" type="submit" class="login-btn" value="Đặt lại">
                
            </form>
        </div>
    </div>
</body>
</html>
