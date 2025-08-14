<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
/* CSS Custom cho form */
.form-label {
    font-weight: bold;
    text-align: left; /* Căn trái cho label */
}

.row {
    margin-bottom: 1rem; /* Khoảng cách giữa các hàng */
}

.col-form-label {
    text-align: left; /* Căn trái cho label */
    margin-bottom: 0; /* Loại bỏ khoảng cách bên dưới label */
    line-height: 1.5; /* Tăng khoảng cách giữa các dòng text */
}

.form-control {
    border-radius: 0.25rem; /* Đường viền input */
    border: 1px solid #ced4da; /* Màu đường viền */
}

.card {
    border-radius: 0.5rem; /* Bo góc cho card */
    box-shadow: 0 0 0.5rem rgba(0, 0, 0, 0.1); /* Đổ bóng cho card */
}

.card-body {
    padding: 2rem; /* Padding cho card body */
}

.btn-primary {
    background-color: #007bff; /* Màu nền cho nút */
    border: 1px solid #007bff; /* Màu viền cho nút */
    padding: 0.75rem 1.25rem; /* Padding cho nút */
    font-size: 1rem; /* Kích thước font */
    border-radius: 0.25rem; /* Bo góc cho nút */
}

.btn-primary:hover {
    background-color: #0056b3; /* Màu nền khi hover */
    border-color: #0056b3; /* Màu viền khi hover */
}
main{
    margin-top: 170px;
}
    </style>
</head>
<body>
    
</body>
</html>
<main>
<?php

    if(isset($login) && !empty($login)){
        $tk=$login;

    echo '
    <div class="container mt-5 mb-4">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <h2 class="text-center mb-4">Thông Tin Tài Khoản</h2>
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="index.php?act=update-tk">

                        <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Tên đăng nhập</label>
                                <div class="col-md-8">
                                    <input type="text" class="form-control" id="name" name="login" value="' . htmlspecialchars($tk['TK_TENDANGNHAP']) . '" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Mật Khẩu hiện tại</label>
                                <div class="col-md-8">
                                    <input type="password"  class="form-control" id="name" name="passold" placeholder="Nhập mật khẩu hiện tại" required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="name" class="col-md-4 col-form-label">Mật Khẩu mới</label>
                                <div class="col-md-8">
                                    <input type="password" class="form-control" id="name" name="passnew" placeholder="Nếu không đổi thì bạn nhập mật khẩu cũ nhé" required>
                                </div>
                            </div>

                            <input type="hidden" name="user_id" value="' . htmlspecialchars($tk['TK_ID']) . '">


                            <div class="text-center">
                                <input name="capnhat" type="submit" class="btn btn-primary" value="Cập nhật"></a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>';
    
} else {
    echo '<div class="container mt-5"><div class="alert alert-warning">Không tìm thấy thông tin người dùng.</div></div>';
}
?>



</main>
    
