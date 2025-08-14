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
            width: 80px;
            height: auto;
            border-radius: 4px;
            object-fit: cover;
        }

        /* Hover dòng */
        table tr:hover {
            background-color: #f1f1f1;
        }

        /**BẢNG TÓM TẮT */
        .summary-box {
           
            border: 1px solid #ddd;
            padding: 20px;
            font-family: Arial, sans-serif;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
           
        }

            .summary-box h2 {
            font-size: 20px;
            font-weight: bold;
            margin-bottom: 20px;
            }

            .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
            }

            .summary-row .discount {
            color: red;
            }

            .summary-row.total {
            font-size: 18px;
            margin-top: 15px;
            }
            .status-history-box{
                border: 1px solid #ccc; 
                border-radius: 10px; 
                padding: 20px; 
                margin: 25px; 
               box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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
                <div class="row m-3">               
                   <?php 
                   if(isset($dh) && (count($dh) > 0)){
                    echo '
                        <h2 class="mb-3">📦 Đơn hàng '.$dh[0]['DH_MADH'].'</h2>
                        <h4 class="mb-3">🆔 Mã KH: '.$dh[0]['KH_ID'].'</h4>                   
                        <table class="mt-4">
                            <tr class="text-center">
                                    <th>Tên SP</th>  
                                    <th>Hình</th>                          
                                    <th>Số lượng</th>
                                    <th>giá</th>
                                    <th>Tổng</th>
                        </tr>';
   
                                $tong=0;
                                foreach ($dh as $d) {
                                    $soluong = (int)$d['CTDH_SOLUONG'];
                                    $gia = (float)$d['CTDH_DONGIA'];
                                    $thanhtien = $gia * $soluong;
                                    $tong += $thanhtien;
                                    echo '<tr class="text-center mb-2">                                  
                                            <td>'.$d['SP_TENSP'].'</td>
                                            <td><img src="./images/' . $d['SP_HINH'] . '" alt="product image" class="product-img"></td>
                                            <td>'.$d['CTDH_SOLUONG'].'</td>
                                            <td>'.$d['CTDH_DONGIA'].'</td>
                                            <td>'.number_format($thanhtien, 3).'</td>
                                         </tr>';
                                    
                                }
                                // echo '<tr>
                                //     <td colspan="4" class="total-label">Tổng cộng</td>
                                //     <td class="total-amount">' .number_format($tong, 3). 'đ</td>
                                // </tr>';
                            }
                            ?>                                                      
                    </table>
                  

                       
                </div>
            </div>
            <!-- bảng tóm tắt -->
            <?php 
                if(isset($dh) && (count($dh) > 0)){
                echo'<div class="container mt-4">
                        <div class="d-flex gap-1 m-3">  
                            <div class="col-sm-6 summary-box ">
                                <h2>Chi tiết thanh toán</h2>
                                <div class="summary-row">
                                    <span>Tổng đơn :</span>
                                    <span>'.number_format($tong, 3).'</span>
                                </div>
                                <div class="summary-row">
                                    <span>Điểm dùng :</span>
                                    <span class="discount">- '.$dh[0]['DH_DIEMDADUNG'].'</span>
                                </div>
                                <div class="summary-row">
                                    <span>Phí ship :</span>
                                    <span>'.$dh[0]['PG_DONGIA'].'</span>
                                </div>                      
                                <hr>
                                <div class="summary-row total">
                                    <strong>Tổng cộng :</strong>
                                    <strong>'.$dh[0]['DH_TONGTIEN'].'đ</strong>
                                </div>
                            </div>

                          
                            <div class="col-sm-6 summary-box">                             
                                    <h2>Thông tin đơn hàng</h2>
                                    <div>
                                        <span>Phương thức thanh toán:</span>
                                        <span>'.$dh[0]['PTTT_TENPT'].'</span>
                                    </div><br>
                                    <div>
                                        <span>Trạng thái:</span>
                                    <span class="discount">'.$dh[0]['TT_TENTT'].'</span>
                                    </div> <br>
                                    <div>
                                        <span>Địa chỉ:</span>
                                    <span class="discount">'.$dh[0]['DH_DIACHINHAN'].'</span>
                                    </div>                                                      
                            </div>
                        </div>
                    </div>';
            }
      ?>
<!-- LỊCH SỬ ĐƠN HÀNG -->
            <div class="status-history-box">
            <h4 class="text-success mb-3">📜 Lịch sử trạng thái đơn hàng</h4>
                <?php if (!empty($ls_status)) : ?>
                    <ul style="list-style: none; padding-left: 0;">
                        <?php foreach ($ls_status as $ls) : ?>
                            <li style="padding: 10px 0; border-bottom: 1px dashed #ccc;">
                                <strong>🕒 <?= date('d/m/Y H:i:s', strtotime($ls['LSDH_THOIDIEM'])) ?></strong><br>
                                ➤ Trạng thái: <span style="color: #007bff; font-weight: bold;"><?= $ls['TT_TENTT'] ?></span>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php else : ?>
                    <p>Không có lịch sử trạng thái nào cho đơn hàng này.</p>
                <?php endif; ?>
            </div>
                </div>
                </div>
            <!-- lịch -->       
                    
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    <script src="view/JS/calendar.js"></script>
</body>
</html>