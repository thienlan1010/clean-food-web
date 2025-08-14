<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/CSS/ketoan.css">
    <link rel="icon" href="images/logo.jpg">
    <!-- boostrap 5 -->
    <!-- Bootstrap 5.3.3 từ jsDelivr (ĐỦ: CSS + JS Bundle có Popper) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- biểu đồ -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <title>Thực phẩm sạch</title>
    <style>
       html, body {
            font-family: Arial, sans-serif;
            height: 100%; /* Ensure html and body take full height */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
            overflow-y: auto;
            overflow-x: hidden;
            background-color: #f0f2f5;
       }

        #wrapper {
            display: flex;

        }

        #sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
           background-color: #f8f9fa; /* Màu nền sáng dễ nhìn */
        }

        #page-content {
            margin-left: 250px;
            width: 100%;
        }

       /* Bỏ khoảng trắng quanh navbar */
        .navbar {

            border-bottom: 1px solid #dee2e6;
            padding: 10px;
            margin: 0px;

        }

        /* Bo tròn avatar */
        .navbar img {
            border: 2px solid #ddd;
        }

        /* Hiệu ứng hover cho nav link */
        .nav-link {
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .nav-link:hover {
            background-color:rgb(219, 205, 233);
            color: black;
        }

        /* Chuông thông báo */
        .notification-icon {
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Badge thông báo */
        .badge {
            top: -10px;
            right: -10px;
        }

        /**PHẦN CSS CỦA NỘI DUNG */
         /* Tiêu đề */
    h2.mb-3 {
        font-weight: bold;
        color: #333;
        border-bottom: 2px solid #dee2e6;
        padding-bottom: 10px;
        text-align: center;
    }

    /* Bảng thông tin */
    .table th {
        width: 180px;
        background-color: #ffffff;
        color: #333;
        vertical-align: middle;
    }

    .table td {
        background-color: #ffffff;
    }

    /* Input form */
    .form-control {
        border-radius: 8px;
        padding: 8px 12px;
        border: 1px solid #ccc;
        transition: border-color 0.3s ease;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    /* Container chính */
    .container {
        margin-top: 30px;
        margin-bottom: 50px;
    }

    /* Nút cập nhật căn giữa */
    .submit-btn-wrapper {
        text-align: center;
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #007bff;
        border: none;
        padding: 10px 20px;
        font-weight: bold;
        border-radius: 6px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #0056b3;
    }

    @media (max-width: 768px) {
        .table th, .table td {
            display: block;
            width: 100%;
        }

        .table tr {
            margin-bottom: 1rem;
            border-bottom: 1px solid #ccc;
        }
    }
    /**BOX */
    .box{
        background: #ffffff;
        padding: 10px;
        border-radius: 10px;
        box-shadow: 1px 4px 8px rgba(0,0,0,0.2);
    }
    </style>
</head>
<body>
     <!-- Sidebar -->
     <div class="d-flex" id="wrapper">
        <div class="bg-light text p-3" id="sidebar">
            <div class="d-flex align-items-center">
                <img src="images/logo.jpg" alt="Logo" class="img-fluid me-2" style="max-height: 50px; border-radius: 50px;">
                <h4 class="mb-0">NHÂN VIÊN GIAO HÀNG</h4>
            </div>

            <ul class="nav flex-column">
                <br>
                <li class="nav-item"><a href="index.php?act=nhanvien" class="nav-link text-dark"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="nav-item"><a href="index.php?act=dsdh" class="nav-link text-dark"><i class="fas fa-file-invoice-dollar"></i> Danh sách đơn hàng</a></li>
                <li class="nav-item"><a href="index.php?act=lsgh" class="nav-link text-dark"><i class="fas fa-receipt"></i> Lịch sử giao hàng</a></li>
            </ul>
        </div>

        <!-- Content -->
        <div id="page-content" class="w-100">
           <nav class="navbar navbar-expand-lg navbar-dark bg-light shadow-sm">
        <div class="container-fluid px-3">
            <!-- Bên trái có thể để tên trang hoặc để trống -->
            <div class="flex-grow-1"></div>


            <!-- thông tin admin -->
            <div class="dropdown">
                <a class="btn btn-outline-dark dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="images/admin.jpg" alt="Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                    <span>Chào, <span class="username"><?php echo $_SESSION['name_nv'] ?></span></span>
                </a>

                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                    <li><a class="dropdown-item" href="index.php?act=info-nv">Thông tin cá nhân</a></li>
                    <li><a class="dropdown-item" href="index.php?act=cut">Thoát</a></li>
                </ul>
            </div>
        </div>
    </nav>

            <!-- nội dung -->
            <div class="container">
                <div class="row m-3 box">
                    <h2 class="mb-3">Thông tin cá nhân</h2>
                    <form method="POST" action="index.php?act=capnhat-nhanvien">
                    <table class="table">
                        <tr>
                            <th>Mã Nhân Viên</th>
                            <!-- Hiển thị mã nhân viên, không cho phép chỉnh sửa -->
                            <td><?php echo htmlspecialchars($info['NV_ID']); ?></td>
                        </tr>
                        <tr>
                            <th>Họ Tên</th>
                            <!-- Input cho họ tên để chỉnh sửa -->
                            <td>
                                <input type="text" name="hoten" class="form-control" value="<?php echo htmlspecialchars($info['NV_HOTEN']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Số Điện Thoại</th>
                            <!-- Input cho số điện thoại để chỉnh sửa -->
                            <td>
                                <input type="text" name="sodienthoai" class="form-control" value="<?php echo htmlspecialchars($info['NV_SODIENTHOAI']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Bộ phận</th>
                            <!-- Input cho chức vụ để chỉnh sửa -->
                            <td class="pt-2">
                                <?php echo htmlspecialchars($info['BP_TENBP']); ?>
                                <!-- <input type="text" name="chucvu" class="form-control" value="<?php echo htmlspecialchars($info['BP_TENBP']); ?>" required readonly> -->
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <!-- Input cho email để chỉnh sửa -->
                            <td>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($info['NV_EMAIL']); ?>" required>
                            </td>
                        </tr>
                         <tr>
                            <th>Địa chỉ</th>
                            <!-- Input cho email để chỉnh sửa -->
                            <td>
                                <input type="text" name="diachi" class="form-control" value="<?php echo htmlspecialchars($info['NV_DIACHI']); ?>" required>
                            </td>
                        </tr>


                    </table>
                    <input type="hidden" name="manv" value="<?php echo htmlspecialchars($info['NV_ID']); ?>">
                        <div class="submit-btn-wrapper">                       
                            <input type="submit" value="Cập nhật"  class="btn btn-success" name="capnhat">
                        </div>
                    </form>
                </div>
            </div>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>

   <!-- <script>

    function capNhatThongTin(manv) {
    fetch('index.php?act=capnhat_nhanvien', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `madh=${manv}`
    })
    .then(response => response.text())
    .then(data => {
        alert("Cập nhật thông tin thành công!");
        location.reload();
    });
}

</script> -->
</body>
</html>