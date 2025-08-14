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
        /**PHẦN CSS CỦA NỘI DUNG */
        form {
            max-width: 500px;
            margin: 20px auto;
            background: #f9f9f9;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }

        form h2 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
            color: #555;
        }

        form input[type="number"],
        form input[type="date"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
            transition: 0.3s;
        }

        /* form input[type="number"]:focus,
        form input[type="date"]:focus {
            border-color: #fd7e14;
            outline: none;
            box-shadow: 0 0 5px #fd7e14aa;
        } */

        form input[type="submit"] {
            width: 15%;
            padding: 12px;
            margin: 30px auto 0; /* căn giữa và thêm khoảng cách phía trên */
            background: #4caf50;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.3s ease;
            display: block;
        }

        form input[type="submit"]:hover {
            background: #388e3c;
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
                    Hiển thị số lượng thông báo 
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
            
            <div class="container">
                <div class="row m-3">
                    <h2 class="mb-3">Sửa thông tin phí giao</h2>
                    <form action="index.php?act=update-fee" method="post">
                        <label for="kc_cantren">Khoảng cách từ (km)</label>
                        <input type="number" id="kc_cantren" name="kc-cantren" value="<?= $info_fee['KC_CANTREN'] ?? '' ?>" placeholder="Nhập khoảng cách đến" step="any" required>

                        <label for="kc_canduoi">Đến khoảng cách (km)</label>
                        <input type="number" id="kc_canduoi" name="kc-canduoi" value="<?= $info_fee['KC_CANDUOI'] ?? '' ?>" placeholder="Nhập khoảng cách từ" step="any" required>

                        <label for="tl_cantren">Trọng lượng từ (g)</label>
                        <input type="number" id="tl_cantren" name="tl-cantren" value="<?= $info_fee['TL_CANTREN'] ?? '' ?>" placeholder="Nhập trọng lượng đến" step="any" required>

                        <label for="tl_canduoi">Đến trọng lượng (g)</label>
                        <input type="number" id="tl_canduoi" name="tl-canduoi" value="<?= $info_fee['TL_CANDUOI'] ?? '' ?>" placeholder="Nhập trọng lượng từ" step="any" required>

                        <label for="phi">Phí giao (VNĐ)</label>
                        <input type="number" id="phi" name="phi" value="<?= number_format($info_fee['PG_DONGIA'], 0, ',', '.') ?>" placeholder="Nhập phí giao" step="any" required>

                        <label for="ngay">Ngày áp dụng</label>
                        <input type="date" id="ngay" value="<?= $info_fee['PG_NGAYAPDUNG'] ?? '' ?>" name="ngay" required>

                        <input type="hidden" name="idkc" value="<?= $info_fee['KC_ID']?>">
                        <input type="hidden" name="idtl" value="<?= $info_fee['TL_ID']?>">
                        <input type="hidden" name="ngayhientai" value="<?= $info_fee['PG_NGAYAPDUNG']?>">
                        <input type="submit" name="upfee" value="Cập nhật" name="capnhatphi">
                    </form>

                </div>
            </div>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    


</body>
</html>