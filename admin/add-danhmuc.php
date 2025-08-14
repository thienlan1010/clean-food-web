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
            max-width: 600px;
            margin: 50px auto;
            padding: 30px;
            background: #f9fff6;
            border: 1px solid #d0e6d0;
            border-radius: 10px;
            box-shadow: 0 8px 16px rgba(0, 100, 0, 0.1);
            font-family: 'Segoe UI', sans-serif;
        }

        form label {
            display: block;
            margin-top: 15px;
            font-weight: 600;
            color: #2d572c;
        }

        form input[type="text"],
        form input[type="number"],
        form input[type="file"],
        form input[type="date"],
        form select
       {
            width: 100%;
            padding: 10px 12px;
            margin-top: 5px;
            border: 1px solid #c9e2c9;
            border-radius: 6px;
            font-size: 16px;
            background-color: #ffffff;
            transition: border-color 0.3s;
        }

       

        form input:focus,
        form select:focus:focus {
            outline: none;
            border-color: #66bb6a;
            box-shadow: 0 0 5px rgba(102, 187, 106, 0.4);
        }

        form input[type="submit"] {
            display: block;
            margin: 30px auto 0; /* căn giữa và thêm khoảng cách phía trên */
            padding: 12px 30px;
            background: #4caf50;
            color: #fff;
            font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: fit-content;
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
                    <i class="fas fa-bell" style="font-size: 20px;"></i> -->
                    <!-- Hiển thị số lượng thông báo -->
                    <!-- <span class="badge bg-danger position-absolute top-0 start-100 translate-middle rounded-pill">
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
                    <h2 class="mb-3">Thêm danh mục</h2>
                       <form action="index.php?act=addm-db" method="post">
                            <label for="tendm">Tên danh mục</label>
                            <input type="text" name="tendm" id="tendm" placeholder="Nhập tên danh mục" required>
                            <input type="submit" value="Thêm" name="themdm">
                       </form>
                  

                       
                </div>
            </div>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    
   

</body>
</html>