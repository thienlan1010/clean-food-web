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
        .container h2 {
            color: #2c3e50;
            font-weight: bold;
        }

        .img-user {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 50%;
            box-shadow: 0 2px 6px rgba(0,0,0,0.3);
        }

        .bg-white {
            background-color: #fff;
        }

        .shadow {
            box-shadow: 0 0 10px rgba(0,0,0,0.15);
        }

        .text-primary {
            color: #007bff;
        }
        /**các box */
        .info-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            padding: 20px 24px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: 0.3s ease;
            min-height: 100px;
        }

        .info-card-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
        }

        .info-text h5 {
            font-size: 16px;
            margin-bottom: 8px;
            color: #666;
        }

        .info-text .number {
            font-size: 32px;
            font-weight: bold;
            color: #111;
            margin: 0;
        }

        .info-icon {
            background-color: #f0f4f8;
            padding: 14px;
            border-radius: 12px;
            font-size: 28px;
            display: flex;
            align-items: center;
            justify-content: center;
            min-width: 56px;
            min-height: 56px;
        }

        /* Màu tùy chỉnh */
        .custom-blue .info-icon { background: #e0f0ff; color: #007bff; }
        .custom-green .info-icon { background: #dcfce7; color: #28a745; }
        .custom-red .info-icon { background: #ffe2e2; color: #dc3545; }

        .info-card:hover {
            transform: translateY(-4px);
        }
        /* form login */
        .login-update-form {
            /* background-color: #f9f9f9; */
            padding: 20px;
            /* border-radius: 12px; */
            /* box-shadow: 0 0 10px rgba(0,0,0,0.05); */
        }

        .login-update-form p {
            margin-bottom: 15px;
        }

        .login-update-form label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }

        .login-update-form input[type="text"] {
            width: 100%;
            padding: 8px 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: border-color 0.3s ease;
        }

        .login-update-form input[type="text"]:focus {
            border-color: #0d6efd; /* Bootstrap primary */
            outline: none;
        }

        .btn-center {
            text-align: center;
            margin-top: 15px;
        }

        .btn-update {
            background-color: #0d6efd;
            color: white;
            padding: 8px 24px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .btn-update:hover {
            background-color: #084dbf;
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
            
            <!-- <div class="container">
                <div class="row m-3">
                    <h2 class="mb-5">Chi tiết nhân viên</h2>
                    <div class="col-sm-7 bg-anhten">                     
                         <div class="anh-ten">
                            <img class="img-user" src="images/user.jpg" alt="ảnh đại diện">                      
                            <h3><?php echo $nv['NV_HOTEN']?></h3>
                          </div>
                    </div>
                   <div class="col-sm-4 info ms-5"> 
                        <h2>Thông tin</h2>
                        <label for="diachi">Địa chỉ</label>
                        <p><?php echo $nv['NV_DIACHI']?></p>
                        <label for="email">Email</label>
                        <p><?php echo $nv['NV_EMAIL']?></p>
                        <label for="sdt">Số điện thoại</label>
                        <p><?php echo $nv['NV_SODIENTHOAI']?></p>
                        <label for="bp">Bộ Phận</label>
                        <p><?php echo $nv['BP_TENBP']?></p>
                    </div>      
                </div>
             </div> -->
             
             <div class="container mt-4">
               
                <h2 class="mb-4 text-center">Chi tiết nhân viên</h2>
                <div class="row shadow p-4 rounded bg-white m-3 ">
                    <!-- Ảnh + tên -->
                    <div class="col-md-4 text-center border-end">
                        <img class="img-fluid rounded-circle shadow-sm mb-3" src="images/user.jpg" alt="ảnh đại diện" style="width: 150px; height: 150px;">
                        <h4 class="fw-bold"><?= htmlspecialchars($nv['NV_HOTEN']) ?></h4>
                    </div>

                    <!-- Thông tin cá nhân -->
                    <div class="col-md-4 border-end">
                        <h5 class="mb-3 text-primary">Thông tin cá nhân</h5>
                        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($nv['NV_DIACHI']) ?></p>
                        <p><strong>Email:</strong> <?= htmlspecialchars($nv['NV_EMAIL']) ?></p>
                        <p><strong>SĐT:</strong> <?= htmlspecialchars($nv['NV_SODIENTHOAI']) ?></p>
                        <p><strong>Bộ phận:</strong> <?= htmlspecialchars($nv['BP_TENBP']) ?></p>
                      <?php 
                        if (isset($khuvuc) && isset($khuvuc[0]) && $khuvuc[0]['BP_TENBP'] == 'Giao Hàng') {
                            echo '<p><strong>Khu vực:</strong> ';
                            $ten_khuvuc = array_map(function($kv) {
                                return $kv['P_TENPHUONGXA'];
                            }, $khuvuc);
                            echo implode(', ', $ten_khuvuc);
                            echo '</p>'; // Đóng thẻ luôn trong if
                        }
                        ?>
                    </div> 
                        <!-- Thông tin đăng nhập và cập nhật mật khẩu -->
                        <div class="col-md-4">
                            <h5 class="mb-3 text-primary">Thông tin đăng nhập</h5>
                            <form method="POST" action="index.php?act=up-login-nv" class="login-update-form">
                                <p>
                                    <label><strong>Tên đăng nhập:</strong></label>
                                    <input type="text" name="ten_dang_nhap" value="<?= htmlspecialchars($nv['TK_TENDANGNHAP']) ?>" required>
                                </p>
                                <p>
                                    <label><strong>Mật khẩu:</strong></label>
                                    <input type="text" name="mat_khau" value="<?= htmlspecialchars($nv['TK_MK']) ?>" required>
                                </p>
                                <div class="btn-center">
                                    <input type="submit" name="capnhat" value="Cập nhật" class="btn-update">
                                </div>
                                <input type="hidden" name="idtk" value="<?= htmlspecialchars($nv['TK_ID']) ?>">
                                <input type="hidden" name="idnv" value="<?= htmlspecialchars($nv['NV_ID']) ?>">
                            </form>
                        </div>

                </div>
            </div>
        <!-- các bõ -->
         <?php if($nv['BP_TENBP'] != "Quản trị viên"){ ?>

         
         <div class="container">    
                <div class="row m-3">
                    <div class="row text-center mt-4">
                    <div class="col-md-4">
                        <div class="info-card custom-green">
                        <div class="info-card-content">
                            <div class="info-text">
                            <h5>Đã giao thành công</h5>
                            <p class="number"><?php echo $so_don_thanh_cong; ?></p>
                            </div>
                            <div class="info-icon">
                            <i class="fa-solid fa-check-circle"></i>
                            </div>
                        </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="info-card custom-red">
                            <div class="info-card-content">
                                <div class="info-text">
                                    <h5>Giao thất bại</h5>
                                    <p class="number"><?php echo $so_don_that_bai; ?></p>
                                </div>
                                    <div class="info-icon">
                                    <i class="fa-solid fa-xmark-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    </div>
                </div>
            </div>
       <?php } ?>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    
   
          

</body>
</html>