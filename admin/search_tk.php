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
        .dashboard-cards {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 20px;
            }

            .card-box {
            flex: 1 1 calc(25% - 20px);
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.2);
            transition: transform 0.2s ease;
            }

            .card-box:hover {
            transform: translateY(-5px);
            }

            .card-content h5 {
            margin: 0;
            font-size: 16px;
            color: #6c757d;
            }

            .card-content h2 {
            margin: 5px 0;
            font-size: 28px;
            font-weight: bold;
            color: #343a40;
            }

            .card-content p {
            margin: 0;
            font-size: 14px;
            color: #adb5bd;
            }

            .card-icon {
            font-size: 32px;
            padding: 12px;
            border-radius: 10px;
            color: #fff;
            }

            .card-box.blue .card-icon {
            background-color: #d0e1ff;
            color: #007bff;
            }

            .card-box.red .card-icon {
            background-color: #ffe0e0;
            color: #dc3545;
            }

            .card-box.green .card-icon {
            background-color: #d4edda;
            color: #28a745;
            }

            .card-box.gray .card-icon {
            background-color: #e2e3e5;
            color: #6c757d;
            }
            /**TÌM KIẾM */
           
        .search-form {
            max-width: 400px;
           margin-bottom: 20px;
           margin-left: 20px;
        }

        /* Input tìm kiếm */
        .short-search {
            border: 2px solid rgb(212, 184, 113);
            border-radius: 25px;
            padding: 8px 15px;
            transition: 0.3s ease;
            font-size: 15px;
        }

        /* Khi focus vào input */
        .short-search:focus {
            outline: none;
            box-shadow: 0 0 5px rgba(197, 167, 77, 0.77);
            border-color:rgb(212, 154, 47);
        }

        /* Nút tìm kiếm */
        .search-form button {
            border-radius: 50%;
            width: 40px;
            height: 40px;
            padding: 0;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s ease, transform 0.2s;
        }

        /* Hover nút tìm */
        .search-form button:hover {
            background-color:rgb(234, 201, 134);
            color: white;
            border-color: #fd7e14;
            transform: scale(1.05);
        }
        .btn-outline-primary {
            color: #fd7e14;
            border-color: #fd7e14;
            transition: 0.3s;
        }
       
        /**TABLE */
        table {
            width: calc(100% - 40px); /* Trừ 20px mỗi bên */
            margin-left: 20px;
            margin-right: 20px;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            overflow: hidden;
            
        }

        /* Header bảng */
        table th {
            background-color:rgb(172, 236, 99);
            color: #fff;
            padding: 12px;
            text-align: center;
            font-weight: bold;
        }

        /* Dòng dữ liệu */
        table td {
            padding: 10px;
            text-align: center;
            vertical-align: middle;
            border-bottom: 1px solid #ddd;
        }

        /* Hình ảnh */
        table td img {
            width: 80px;
            height: auto;
            border-radius: 4px;
            object-fit: cover;
        }

        /* Hover dòng */
        table tr:hover {
            background-color: #f1f1f1;
        }
        /**NÚT CHI TIẾT */
        /* Nút Sửa / Xóa */
        .btn-edit {
            padding: 6px 12px;
            margin: 2px;
            display: inline-block;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            color: #fff;
            background-color:rgb(238, 191, 96);
        }
        .btn-edit:hover{
            background-color:rgb(241, 166, 17);
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
             <h2 class="m-3">Tài khoản</h2>
            <!-- CÁC BOX -->
            <div class="dashboard-cards">
                <div class="card-box blue">
                    <div class="card-content">
                    <h5>Nhân viên</h5>
                    <h2><?php echo $tknv ?></h2>
                    <p>Tổng số tài khoản</p>
                    </div>
                    <div class="card-icon">
                    <i class="fas fa-user-tie"></i>
                    </div>
                </div>

                <div class="card-box red">
                    <div class="card-content">
                    <h5>Admin</h5>
                    <h2><?php echo $tkadmin ?></h2>
                    <p>Tổng số tài khoản</p>
                    </div>
                    <div class="card-icon">
                    <i class="fas fa-user-shield"></i>
                    </div>
                </div>

                <div class="card-box green">
                    <div class="card-content">
                    <h5>Khách hàng</h5>
                    <h2><?php echo $tkkh ?></h2>
                    <p>Tổng số tài khoản</p>
                    </div>
                    <div class="card-icon">
                    <i class="fas fa-user"></i>
                    </div>
                </div>

                <div class="card-box gray">
                    <div class="card-content">
                    <h5>Bị khóa</h5>
                    <h2><?php echo $tkbk ?></h2>
                    <p>Trạng thái tài khoản</p>
                    </div>
                    <div class="card-icon">
                    <i class="fas fa-user-slash"></i>
                    </div>
                </div>
            </div>
           <div class="search-filter-wrap d-flex align-items-center gap-3">
            <!-- TÌM KIẾM -->
            <form class="search-form d-flex flex-grow-1" action="index.php?act=search-tk" method="post" onsubmit="return validateSearch()">
                <input class="form-control me-2 short-search" type="search" name="nhaptim" placeholder="Tìm kiếm tài khoản theo mã..." aria-label="Search">
                <button class="btn btn-outline-primary" type="submit" name="timkiem">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <!-- BỘ LỌC -->
            <form method="GET" action="index.php" class="filter-form" style="margin-bottom: 15px;">
                <input type="hidden" name="act" value="list_taikhoan">
                <select name="role" onchange="this.form.submit()" class="form-select" style="min-width: 150px;">
                    <option value="">Tất cả</option>
                    <option value="0" <?= (isset($_GET['role']) && $_GET['role'] === '0') ? 'selected' : '' ?>>Nhân viên</option>
                    <option value="1" <?= (isset($_GET['role']) && $_GET['role'] === '1') ? 'selected' : '' ?>>Khách hàng</option>
                    <option value="2" <?= (isset($_GET['role']) && $_GET['role'] === '2') ? 'selected' : '' ?>>Admin</option>
                </select>
            </form>
        </div>

                    <script>
                        function validateSearch() {
                            var keyword = document.querySelector('input[name="nhaptim"]').value.trim();
                            if (keyword === "") {
                                alert("Vui lòng nhập từ khóa tìm kiếm!");
                                return false; // Ngăn không cho gửi form
                            }
                            return true;
                        }
                    </script>
          
                     <!-- SHOW TÀI KHOẢN TÌM KIẾM -->
                        
                            <?php
                                if (isset($tk) && $tk) {
                                    echo '<table>
                                        <tr>                                                              
                                            <th>ID tài khoản</th>
                                            <th>Họ tên</th>                  
                                            <th>Email</th>                  
                                            <th>Vai trò</th>                  
                                            <th>Trạng thái</th>                  
                                            <th>Hành động</th>';
                                           

                                    // Xác định vai trò
                                    if ($tk['TK_VAITRO'] == 0) {
                                        $vaitro = "Nhân viên";
                                    } elseif ($tk['TK_VAITRO'] == 1) {
                                        $vaitro = "Khách hàng";
                                    } elseif ($tk['TK_VAITRO'] == 2) {
                                        $vaitro = "Quản trị";
                                    } else {
                                        $vaitro = "Không xác định";
                                    }

                                    echo '<tr>
                                            <td>' . $tk['TK_ID'] . '</td>';
                                            if ($tk['TK_VAITRO'] == 0 || $tk['TK_VAITRO'] == 2) {
                                            // Là nhân viên hoặc quản trị
                                            echo '<td>' . ($tk['NV_HOTEN'] ?? 'Không có') . '</td>';
                                            echo '<td>' . ($tk['NV_EMAIL'] ?? 'Không có') . '</td>';
                                        } elseif ($tk['TK_VAITRO'] == 1) {
                                            // Là khách hàng
                                            echo '<td>' . ($tk['KH_HOTEN'] ?? 'Không có') . '</td>';
                                            echo '<td>' . ($tk['KH_EMAIL'] ?? 'Không có') . '</td>';
                                        } else {
                                            // Trường hợp không xác định
                                            echo '<td>Không có</td>';
                                            echo '<td>Không có</td>';
                                        }
                                     echo'       <td>' . $vaitro . '</td>
                                            <td>' . ($tk['TK_TRANGTHAI'] ?? 'Không rõ') . '</td>';
                                            if ($tk['TK_VAITRO'] == 0 || $tk['TK_VAITRO'] == 2) {
                                                echo' <td><a class="btn-edit" href="index.php?act=detail-tk&id=' . $tk['NV_ID'] . '&vaitro=' . $tk['TK_VAITRO'] . '">Chi tiết</a></td>';
                                            }else{
                                                echo'  <td><a class="btn-edit" href="index.php?act=detail-tk&id=' . $tk['KH_ID'] . '&vaitro=' . $tk['TK_VAITRO'] . '">Chi tiết</a></td>';
                                            }
                                  echo'      </tr>';
                                    echo '</table>';
                                } else {
                                    echo '<p style="margin-left: 20px;">Không tìm thấy kết quả</p>';
                                }
                            
                            ?>

                    
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    
   
            <!-- <script>
                function confirmDelete() {
                    return confirm("Bạn có chắc chắn muốn xóa danh mục này không?");
                }
            </script> -->

</body>
</html>