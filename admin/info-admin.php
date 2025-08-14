<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="view/CSS/ketoan.css">
    
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
       }

        #wrapper {
            display: flex;
        }

        #sidebar {
            width: 250px;
            height: 100vh;
            position: fixed;
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
            background-color: #a855f7;
            color: white !important;
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
        /**PHẦN NỘI DUNG */
        /* Container box styling */
        .box {
            background: #ffffff;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: 30px;
        }

        /* Tiêu đề căn giữa, in đậm */
        h3.text-center {
            font-weight: bold;
            color:rgb(1, 4, 8);
            margin-bottom: 30px;
            font-size: 35px;
        }

        /* Table styling */
        .table th {
            width: 200px;
            vertical-align: middle;
            font-weight: 600;
            color: #343a40;
            
            border-top: none;
            /*border-bottom: 1px solid #dee2e6;*/
        }

        .table td {
            border-top: none;
            /* border-bottom: 1px solid #dee2e6; */
        }

        /* Input styling */
        .form-control {
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 16px;
        }

        /* Nút cập nhật */
        .btn-primary {
            /* background: linear-gradient(135deg, #0d6efd, #0b5ed7); */
            background-color: green;
            border: none;
            padding: 10px 30px;
            font-size: 16px;
            border-radius: 25px;
            transition: 0.3s ease;
        }

        .btn-primary:hover {
            /* background: linear-gradient(135deg, #0b5ed7, #084298); */
            background-color:rgb(9, 77, 29);
            transform: scale(1.05);
        }

        /* Responsive - làm cho form nhìn đẹp trên mobile */
        @media (max-width: 576px) {
            .table th,
            .table td {
                display: block;
                width: 100%;
            }

            .table th {
                background-color: transparent;
                font-weight: bold;
                /* border-bottom: none; */
            }

            .table td {
                padding-bottom: 15px;
            }
        }

    </style>
</head>
<body>
     <!-- Sidebar -->
     <div class="d-flex" id="wrapper">
        <div class="bg-dark text-white p-3" id="sidebar">
            <div class="d-flex align-items-center">
                <img src="images/logo.jpg" alt="Logo" class="img-fluid me-2" style="max-height: 50px; border-radius: 50px;">
                <h4 class="mb-0">ADMIN</h4>
            </div>

            <ul class="nav flex-column">
                <br>
                <li class="nav-item"><a href="index.php?act=admin" class="nav-link text-white"><i class="fas fa-home"></i> Trang chủ</a></li>
                <li class="nav-item"><a href="index.php?act=qlsp" class="nav-link text-white"><i class="fas fa-box-open"></i> Quản lý sản phẩm</a></li>
                <li class="nav-item"><a href="index.php?act=qldm" class="nav-link text-white"><i class="fas fa-tags"></i> Quản lý danh mục</a></li>
                <li class="nav-item"><a href="index.php?act=qlkhang" class="nav-link text-white"><i class="fas fa-users"></i> Quản lý khách hàng</a></li>
                <li class="nav-item"><a href="index.php?act=qlnhanvien" class="nav-link text-white"><i class="fas fa-user-tie"></i> Quản lý nhân viên</a></li>
                <li class="nav-item"><a href="index.php?act=qltaikhoan" class="nav-link text-white"><i class="fas fa-user-cog"></i> Quản lý tài khoản</a></li>
                <li class="nav-item"><a href="index.php?act=xem-order" class="nav-link text-white"><i class="fas fa-shopping-cart"></i> Quản lý đơn hàng</a></li>
                <li class="nav-item"><a href="index.php?act=phancong" class="nav-link text-white"><i class="fas fa-route"></i> Phân công giao hàng</a></li>
                <li class="nav-item"><a href="index.php?act=daphancong" class="nav-link text-white"><i class="fas fa-check-circle"></i> Đơn đã phân công</a></li>
                <li class="nav-item"><a href="index.php?act=qldg" class="nav-link text-white"><i class="fas fa-star-half-alt"></i> Quản lí đánh giá</a></li>
                <li class="nav-item"><a href="index.php?act=qlkv" class="nav-link text-white"><i class="fas fa-map-marker-alt"></i> Quản lí khu vực giao hàng</a></li>
                <li class="nav-item"><a href="index.php?act=qlpg" class="nav-link text-white"><i class="fas fa-truck"></i> Quản lí phí giao hàng</a></li>

            </ul>
        </div>

        <!-- Content -->
        <div id="page-content" class="w-100">
           <nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow-sm">
                <div class="container-fluid px-3">
                    <!-- Bên trái có thể để tên trang hoặc để trống -->
                    <div class="flex-grow-1"></div>
                    <!-- chuông thông báo -->
                    <!-- <div class="notification-icon me-3">
                        <a href="index.php?act=xemthongbao" class="text-light position-relative" title="Thông báo">
                            <i class="fas fa-bell" style="font-size: 20px;"></i>
                          
                            <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">
                                3
                            </span>
                        </a>
                    </div> -->

                    <!-- thông tin admin -->
                    <div class="dropdown">
                        <a class="btn btn-outline-light dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="images/admin.jpg" alt="Avatar" class="rounded-circle" style="width: 30px; height: 30px;">
                            <span>Chào, <span class="username"><?php echo $_SESSION['name_admin'] ?></span></span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuLink">
                            <li><a class="dropdown-item" href="index.php?act=info-admin">Thông tin cá nhân</a></li>
                            <li><a class="dropdown-item" href="index.php?act=out">Thoát</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- nội dung -->
            <div class="container mt-4">
                <h3 class="text-center">Thông tin cá nhân</h3>
                <div class="row box">
                 <form method="POST" action="index.php?act=capnhat-admin">
                    <table class="table">
                        <tr>
                            <th>Mã Nhân Viên</th>
                            <!-- Hiển thị mã nhân viên, không cho phép chỉnh sửa -->
                            <td class="ps-4"><?php echo htmlspecialchars($info_admin['NV_ID']); ?></td>
                        </tr>
                        <tr>
                            <th>Họ Tên</th>
                            <!-- Input cho họ tên để chỉnh sửa -->
                            <td>
                                <input type="text" name="hoten" class="form-control" value="<?php echo htmlspecialchars($info_admin['NV_HOTEN']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Số Điện Thoại</th>
                            <!-- Input cho số điện thoại để chỉnh sửa -->
                            <td>
                                <input type="text" name="sodienthoai" class="form-control" value="<?php echo htmlspecialchars($info_admin['NV_SODIENTHOAI']); ?>" required>
                            </td>
                        </tr>
                        <tr>
                            <th>Chức Vụ</th>
                            <!-- Input cho chức vụ để chỉnh sửa -->
                            <td class="ps-4">
                                <?php echo htmlspecialchars($info_admin['BP_TENBP']); ?>
                                <!-- <input type="text" name="chucvu" class="form-control" value="<?php echo htmlspecialchars($info_admin['BP_TENBP']); ?>" required readonly> -->
                            </td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <!-- Input cho email để chỉnh sửa -->
                            <td>
                                <input type="email" name="email" class="form-control" value="<?php echo htmlspecialchars($info_admin['NV_EMAIL']); ?>" required>
                            </td>
                        </tr>
                         <tr>
                            <th>Địa chỉ</th>
                            <!-- Input cho email để chỉnh sửa -->
                            <td>
                                <input type="text" name="diachi" class="form-control" value="<?php echo htmlspecialchars($info_admin['NV_DIACHI']); ?>" required>
                            </td>
                        </tr>
                    </table>

                    <!-- Thêm hidden input chứa mã nhân viên để biết admin nào đang cập nhật -->
                    <input type="hidden" name="manv" value="<?php echo htmlspecialchars($info_admin['NV_ID']); ?>">

                    <div class="text-center">
                        <input name="capnhat-admin" type="submit" class="btn btn-primary" value="Cập nhật">
                    </div>
                    </form>   
                    
                </div>
            </div>

        </div>
    </div>


</body>
</html>