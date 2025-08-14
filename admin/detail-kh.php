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
        .anh-ten {
            display: flex;
            align-items: center;
            gap: 15px;
            }

        .img-user {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin-right: 10px;
        }

        .bg-anhten {
            padding: 15px;
            background-color:rgb(251, 252, 253); /* màu nền nhẹ nếu bạn muốn */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }
        .bg-anhten label{
            font-size: 20px;
            font-weight: bold;
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
        /* Hover dòng */
        table tr:hover {
            background-color: #f1f1f1;
        }
        .info {
            background-color:rgb(251, 252, 253); /* nền sáng nhẹ */
            padding: 20px;
            border-radius: 10px;
             box-shadow: 0 0 10px rgba(0, 0, 0, 0.2)/* đổ bóng nhẹ */
            }

            .info h2 {
            margin-bottom: 20px;
            font-size: 24px;
            font-weight: bold;
            }

            .info label {
            display: block;
            margin-top: 10px;
            font-weight: 600;
            color: #333;
            }

            .info p {
            margin: 5px 0 10px;
            color: #555;
            padding-left: 10px;
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
            
            <div class="container">
                <div class="row m-3">
                    <h2 class="mb-5">Chi tiết khách hàng</h2>
                    <div class="col-sm-7 bg-anhten ">                     
                         <div class="anh-ten">
                            <img class="img-user" src="images/user.jpg" alt="ảnh đại diện">                      
                            <h3><?php echo $kh['KH_HOTEN']?></h3>
                          </div>
                    </div>
                   <div class="col-sm-4 info ms-5">  <!--cách trái 10px -->
                        <h2>Thông tin</h2>
                        <label for="diachi">Địa chỉ</label>
                        <p><?php echo $kh['KH_DIACHI']?></p>
                        <label for="email">Email</label>
                        <p><?php echo $kh['KH_EMAIL']?></p>
                        <label for="sdt">Số điện thoại</label>
                        <p><?php echo $kh['KH_SODIENTHOAI']?></p>
                    </div>      
                </div>
             </div>
                <!-- đon hàng -->   
            <div class="container">
                <div class="row m-3 mt-5">
                    <h3>📦 Đơn hàng (<?php echo $sodon ?>)</h3>
                <?php       
                if(isset($dh)&& (count($dh) > 0)){
                echo'    <table>
                        <tr>
                            <th>Mã DH</th>
                            <th>Tổng tiền</th>
                            <th>Trạng thái</th>
                            <th>Phương thức thanh toán</th>
                            <th>Ngày đặt</th>
                        </tr>';
                        
                       
                                $i=1;
                                foreach ($dh as $d) {
                                    echo '<tr class="text-center mb-2">
                                          <td>'.$d['DH_MADH'].'</td>
                                          <td>'.$d['DH_TONGTIEN'].'</td>
                                          <td>'.$d['TT_TENTT'].'</td>
                                          <td>'.$d['PTTT_TENPT'].'</td>
                                          <td>'.$d['DH_NGAYDAT'].'</td>                                                                        
                                        </tr>';
                                        $i++;
                                }
                            }
                            ?>
                    </table>
                </div>
            </div>
                 <!-- đánh giá -->
           
                            
                           <div class="container">
                                <div class="row m-3">                          
                                 <h3>⭐ Đánh giá (<?php echo $so_review ?>)</h3>
                                
                   <?php                      
                            if(isset($review) && (count($review) > 0)){   
                             echo' <table>
                                        <tr>
                                            <th>Mã đánh giá</th>
                                            <th>Tên sản phẩm</th>
                                            <th>Số sao</th>
                                            <th>Ngày dánh giá</th>
                                            <th>Xem nội dung</th>
                                        </tr>';
                                               
                                foreach ($review as $d) {
                                    echo '<tr class="text-center mb-2">
                                          <td>'.$d['DGSP_ID'].'</td>
                                          <td>'.$d['SP_TENSP'].'</td>
                                          <td>'.$d['DGSP_SOSAO'].'</td>
                                          <td>'.$d['DGSP_NGAYDANHGIA'].'</td>
                                          <td><a class="btn-edit" href="index.php?act=content-review&id='.$d['DGSP_ID'].'&idkh='.$kh['KH_ID'].'">Xem nội dung</a>                                            
                                            </td>                                                                    
                                        </tr>';                               
                                }
                            }
                            ?>
                </table>
            </div>
           </div>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    
   
          \
</body>
</html>