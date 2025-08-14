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
                    <h2 class="mb-3">Phân công giao hàng</h2>
                     <?php 
                            //>1 tức có dl 
                                foreach ($nv as $n) {
                                                        $id = $n['NV_ID'];
                                                        if (!isset($ds_nv[$id])) {
                                                            $ds_nv[$id] = [
                                                                'hoten' => $n['NV_HOTEN'],
                                                                'kv' => []
                                                            ];
                                                        }
                                                        $ds_nv[$id]['kv'][] = $n['P_TENPHUONGXA'];
                            }
                           echo '<div class="card mb-4 p-3 shadow-sm border">
                            <h5 class="mb-3 text-primary"><i class="fas fa-users"></i> Nhân viên & Khu vực phụ trách</h5>
                            <div class="row">';
                    foreach ($ds_nv as $id => $nv_data) {
                        echo '<div class="col-md-4 mb-3">
                                <div class="p-3 border rounded bg-light">
                                    <strong><i class="fas fa-user text-success"></i> ' . htmlspecialchars($nv_data['hoten']) . '</strong>
                                    <p class="mb-0">
                                        <i class="fas fa-map-marker-alt text-danger"></i> ' . implode(', ', $nv_data['kv']) . '
                                    </p>
                                </div>
                            </div>';
                    }
                    echo '</div></div>';

                        if(isset($dh) && (count($dh) > 0)){        
               echo'     <form method="post" action="index.php?act=auto_phancong">
                        <button type="submit" class="btn btn-success mb-3">Tự động phân công</button>
                    </form>';
                    
                   
                 echo'       <table>
                        <tr class="text-center">
                                <th>STT</th>  
                                <th>Mã DH</th>                          
                                <th>Ngày đặt</th>
                                <th>Mã KH</th>
                                <th>Tên KH</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Phân công</th>
                                <th>Hành động</th>


                        </tr>';
                        
                                $i=1;
                                foreach ($dh as $d) {
                                    echo '<tr class="text-center mb-2">
                                     <form method="post" action="index.php?act=luu_phancong">
                                            <td>'.$i.'</td>                                        
                                            <td>'.$d['DH_MADH'].'</td>
                                            <td>'.$d['DH_NGAYDAT'].'</td>
                                            <td>'.$d['KH_ID'].'</td>
                                            <td>'.$d['KH_HOTEN'].'</td>
                                           <td>'.$d['DH_DIACHINHAN'].'</td>
                                            <td>'.$d['TT_TENTT'].'</td>
                                            <td>                                       
                                            
                                                <input type="hidden" name="madon" value="'.$d['DH_MADH'].'">                                                                                    
                                              <select name="nv_giaohang" class="form-select" required>
                                                        <option value="">-- Chọn NV --</option>';
                                                        foreach ($ds_nv as $id => $nv_data) {
                                                            echo '<option value="'.$id.'">'
                                                                .$nv_data['hoten'].'</option>';
                                                        }

                                               echo'     </select>

                                            </td>
                                               <td><button type="submit" name="luu-pc" class="btn btn-sm btn-primary mt-1">Phân công</button></td>
                                            </form>                            
                                        </tr>';
                                        $i++;
                                }
                            }else{
                                echo "Chưa có đơn hàng!!!";
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
                                            <a class="page-link" href="index.php?act=daphancong&page=<?= $p ?>"><?= $p ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                       
                </div>
            </div>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    
   

</body>
</html>