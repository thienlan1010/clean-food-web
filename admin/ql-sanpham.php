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
        .btn-edit {
            padding: 6px 12px;
            margin: 2px;
            display: inline-block;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            color: #fff;
        }

        .btn-edit[href*="update-sp-form"] {
            background-color: #ffc107; /* vàng */
        }

        .btn-edit[href*="xoa-sp"] {
            background-color: #dc3545; /* đỏ */
        }

        .btn-edit:hover {
            opacity: 0.85;
            text-decoration: none;
            color: #fff;
        }

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
        .btn-outline-primary {
            color: #fd7e14;
            border-color: #fd7e14;
            transition: 0.3s;
        }
        .btn-add {
            background: rgb(69, 205, 62); /* hiệu ứng gradient xanh mát */
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            border-radius: 10px;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
            font-weight: 600;
            margin-bottom: 20px;
        }

        .btn-add:hover {
            background: rgb(46, 181, 38); /* đổi màu khi hover */
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* phân trang */
        .page-item.active .page-link {
            background-color:rgb(187, 202, 194);
            border-color: rgb(187, 202, 194);
            color: #fff;
        }
        .page-link {
            color: rgb(187, 202, 194);
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
                    <h2 class="mb-3">Sản phẩm</h2>
                     <div class="search-filter-wrap d-flex align-items-center gap-3">
                        <form class="search-form d-flex flex-grow-1" action="index.php?act=search-admin" method="post" onsubmit="return validateSearch()">
                            <input class="form-control me-2 short-search" type="search" name="nhaptim" placeholder="Tìm kiếm sản phẩm bằng tên..." aria-label="Search">
                            <button class="btn btn-outline-primary" type="submit" name="timkiem">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </form>
                    <!-- BỘ LỌC -->
                     <p>Lọc theo danh mục</p>
                        <form method="GET" action="index.php" class="filter-form" style="margin-bottom: 15px;">
                            <input type="hidden" name="act" value="list_sp">
                            
                            <select name="iddm" onchange="this.form.submit()" class="form-select" style="min-width: 150px;">
                                <option value="" <?= (!isset($_GET['iddm']) || $_GET['iddm'] == '') ? 'selected' : '' ?>>Tất cả</option>
                                <?php foreach ($all_dm as $dm): ?>
                                    <option value="<?= $dm['DM_MADM'] ?>" <?= (isset($_GET['iddm']) && $_GET['iddm'] == $dm['DM_MADM']) ? 'selected' : '' ?>>
                                        <?= htmlspecialchars($dm['DM_TENDM']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            </div>
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
                    <!-- nút thêm sp -->
                       <div>
                            <a href="index.php?act=add_product" class="btn-add">
                                <i class="fa-solid fa-plus"></i> Thêm sản phẩm
                            </a>
                        </div>


                        <table>
                            <tr class="text-center">
                                <th>STT</th>
                                <th>ID</th>                            
                                <th>Tên sản phẩm</th>
                                <th>Hình</th>
                                <th>Giá</th>     
                                <th>Danh mục</th>
                                <th>Tồn kho</th>  
                                <th>Trạng thái</th>
                                <th>Phát hành</th>                           
                                <th>Hành động</th>
                            </tr>
                            <?php 
                            if(isset($kq) && (count($kq) > 0)){//>1 tức có dl 
                                $i=1;
                                foreach ($kq as $sp) {
                                    // $dongia = (int)str_replace('.', '', $sp['DG_GIAMOI']);
                                    echo '<tr class="text-center mb-2">
                                            <td>'.$i.'</td>         
                                            <td>'.$sp['SP_MASP'].'</td>
                                            <td>'.$sp['SP_TENSP'].'</td>
                                            <td><img src="images/'.$sp['SP_HINH'].'" width="80px" height="60px"></td>
                                            <td>'.$sp['DG_GIAMOI'].'</td>
                                            <td>'.$sp['DM_TENDM'].'</td>                                                                                                            
                                            <td>'.$sp['SP_SLTON'].'</td>                                    
                                            <td>'.$sp['SP_TRANGTHAI'].'</td>
                                            <td>'.$sp['SP_PHATHANH'].'</td>
                                            <td><a class="btn-edit" href="index.php?act=update-sp-form&id='.$sp['SP_MASP'].'"><i class="fa-solid fa-pencil"></i></a> 
                                            </td>
                                        </tr>';
                                        $i++;
                                }
                            }
                            ?>
                        </table>
                        <!-- Phân trang -->
                         <?php if ($total_pages > 1): ?>
                        <div class="text-center mt-4">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                                        <li class="page-item <?= ($p == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="index.php?act=qlsp&page=<?= $p ?>"><?= $p ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                </div>
            </div>

        </div>
    </div>
    
   


</body>
</html>