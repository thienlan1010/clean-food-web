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
        /* Bảng sản phẩm */
        table {
            width: 100%;
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
            border-radius: 4px;
            object-fit: cover;
        }

        /* Hover dòng */
        table tr:hover {
            background-color: #f1f1f1;
        }

        /* Nút Sửa / Xóa */
       
        .adddm{
            background-color:rgb(69, 205, 62); /* màu cam */
            color: white;
            border: none;
            padding: 10px 18px;
            font-size: 16px;
            border-radius: 8px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }
        
        .adddm:hover {
            background-color: rgb(46, 181, 38); /* cam đậm hơn khi hover */
            transform: scale(1.05);
        }
/**TÌM KIẾM */
        /* Container của form tìm kiếm */
        .search-form {
            max-width: 400px;
           margin-bottom: 20px;
           
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
        /* NÚT CHI TIẾT */
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
            background-color:rgb(228, 161, 29);
        }
        /**SO SAO */
      .stat-box {
            background: #ffffff;
            border-radius: 15px;
            padding: 20px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.2s ease, box-shadow 0.3s ease;
            height: 100%;
        }
        .stat-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.1);
        }

        .stat-info {
            display: flex;
            flex-direction: column;
        }
        .stat-title {
            font-size: 14px;
            color: #6c757d;
        }
        .stat-count {
            font-size: 32px;
            font-weight: bold;
            color:rgb(108, 176, 40);
        }
        .stat-sub {
            font-size: 13px;
            color: #adb5bd;
        }
        .stat-icon {
            background-color: #e9f2ff;
            padding: 12px;
            border-radius: 10px;
            font-size: 28px;
            color:rgb(212, 189, 57);
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
                    <h2 class="m-0">ql đánh giá</h2>

                    <!-- BOX THỐNG KÊ -->
                    <div class="row justify-content-center g-4 mb-4">
                        <?php
                        // Tạo mảng map [sosao => soluong]
                        $map = [];
                        foreach ($dem_so_danhgia as $row) {
                            $map[$row['DGSP_SOSAO']] = $row['soluong'];
                        }

                        $sosao = [5, 4, 3, 2, 1];
                        foreach ($sosao as $sao) {
                            $soluong = $map[$sao] ?? 0;
                            echo '
                            <div class="col-md-4">
                                <div class="stat-box">
                                    <div class="stat-info">
                                        <div class="stat-title">'.$sao.' sao</div>
                                        <div class="stat-count">'.$soluong.'</div>
                                        <div class="stat-sub">Số đánh giá</div>
                                    </div>
                                    <div class="stat-icon"><i class="fas fa-star"></i></div>
                                </div>
                            </div>';
                        }

                        // Box đánh giá ẩn
                        echo '
                        <div class="col-md-4">
                            <div class="stat-box">
                                <div class="stat-info">
                                    <div class="stat-title">Ẩn</div>
                                    <div class="stat-count">'.$danhgia_an['tong_an'].'</div>
                                    <div class="stat-sub">Số đánh giá Ẩn</div>
                                </div>
                                <div class="stat-icon"><i class="fas fa-eye-slash"></i></div>
                            </div>
                        </div>';
                        ?>
                    </div>
                    <!-- tìm kiếm  -->
                     <br>
                <div class="search-filter-wrap d-flex align-items-center gap-3">
                    <form class="search-form d-flex flex-grow-1" action="index.php?act=search-danhgia" method="post" onsubmit="return validateSearch()">
                        <input class="form-control me-2 short-search" type="search" name="nhaptim" placeholder="Tìm kiếm đánh giá..." aria-label="Search">
                        <button class="btn btn-outline-primary" type="submit" name="timkiem">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                        <!-- BỘ LỌC -->
                    <form method="GET" action="index.php" class="filter-form" style="margin-bottom: 15px;">
                        <input type="hidden" name="act" value="list_sao">
                        <select name="role" onchange="this.form.submit()" class="form-select" style="min-width: 150px;">
                            <option value="" >Tất cả</option>
                            <option value="5" <?= (isset($_GET['role']) && $_GET['role'] === '5') ? 'selected' : '' ?>>5 sao</option>
                            <option value="4" <?= (isset($_GET['role']) && $_GET['role'] === '4') ? 'selected' : '' ?>>4 sao</option>
                            <option value="3" <?= (isset($_GET['role']) && $_GET['role'] === '3') ? 'selected' : '' ?>>3 sao</option>
                            <option value="2" <?= (isset($_GET['role']) && $_GET['role'] === '2') ? 'selected' : '' ?>>2 sao</option>
                            <option value="1" <?= (isset($_GET['role']) && $_GET['role'] === '1') ? 'selected' : '' ?>>1 sao</option>
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

                   
                    <?php 
                            if(isset($danhgia) && (count($danhgia) > 0)){
                echo '<table>
                        <tr class="text-center">
                                <th>STT</th>  
                                <th>Mã đánh giá</th>                          
                                <th>Tên KH</th>
                                <th>Mã DH</th>
                                <th>Số sao</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                        </tr>';
                        //>1 tức có dl 
                                $i=1;
                                foreach ($danhgia as $dg) {
                                    echo '<tr class="text-center mb-2">
                                            <td>'.$i.'</td>                                        
                                            <td>'.$dg['DGSP_ID'].'</td>
                                            <td>'.$dg['KH_HOTEN'].'</td>
                                            <td>'.$dg['DH_MADH'].'</td>
                                            <td>'.$dg['DGSP_SOSAO'].'</td>
                                            <td>                                          
                                                    <input type="hidden" name="nv_id" value="' . $dg['DGSP_ID'] . '">
                                                    <select name="trangthai" class="form-select form-select-sm" onChange="capNhatTrangThaiDG('.$dg['DGSP_ID'].', this.value)">
                                                        <option value="Hiện" ' . ($dg['DGSP_TRANGTHAI'] === 'Hiện' ? 'selected' : '') . '>HIện</option>
                                                        <option value="Ẩn" ' . ($dg['DGSP_TRANGTHAI'] === 'Ẩn' ? 'selected' : '') . '>Ẩn</option>
                                                    </select>                        
                                            </td>
                                            <td><a class="btn-edit" href="index.php?act=detail-dg&id='.$dg['DGSP_ID'].'&idkh='.$dg['KH_ID'].'"><i class="fa-solid fa-eye"></i></a>
                                            <a href="index.php?act=xoa-dg&id='.$dg['DGSP_ID'].'&idkh='.$dg['KH_ID'].'" class="btn btn-sm btn-danger" title="Xóa đánh giá" onclick="return confirm(\'Bạn có chắc muốn xóa đánh giá này không?\')">
                                                <i class="fa-solid fa-trash"></i>
                                            </a>                                            
                                            </td>
                                        </tr>';
                                        $i++;
                                }
                            }else{
                                echo '<p>Chưa có đánh giá nào!</p>';
                            }
                            ?>                                                      
                    </table>
                  

                       
                </div>
            </div>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    
   
<script>

            function capNhatTrangThaiDG(madg, trangthai) {
            fetch('index.php?act=capnhat_danhgia', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `madg=${madg}&trangthai=${trangthai}`
            })
            .then(response => response.text())
            .then(data => {
                alert("Cập nhật trạng thái đánh giá thành công!");
                location.reload();
            });
        }

</script>

</body>
</html>