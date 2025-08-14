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
        .info-card {
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
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

            /**LỊCH */
            .calendar {
            max-width: 700px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', sans-serif;
            overflow: hidden;
            }

            .calendar header {
            background: linear-gradient(45deg, #4a90e2, #007bff);
            color: white;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            }

            .calendar header h3 {
            font-size: 1.5rem;
            margin: 0;
            }

            .calendar header button {
            background: white;
            color: #007bff;
            border: none;
            padding: 8px 12px;
            margin-left: 5px;
            border-radius: 8px;
            cursor: pointer;
            font-weight: bold;
            transition: background 0.3s;
            }

            .calendar header button:hover {
            background: #e0eaff;
            }

            .calendar section {
            padding: 20px;
            }

            .days, .dates {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 10px;
            list-style: none;
            padding: 0;
            margin: 0;
            }

            .days li {
            text-align: center;
            font-weight: bold;
            color: #555;
            }

            .dates li {
            text-align: center;
            padding: 12px 0;
            border-radius: 8px;
            cursor: pointer;
            color: #333;
            background: #f9f9f9;
            transition: background 0.2s;
            }

            .dates li:hover {
            background: #e0f0ff;
            color: #007bff;
            }

            .dates li.today {
            background: #007bff;
            color: white;
            font-weight: bold;
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
                    <div class="row text-center mt-4">

                    <div class="col-md-4">
                        <div class="info-card custom-blue">
                            <div class="info-card-content">
                                <div class="info-text">
                                <h5>Đơn hàng cần giao</h5>
                                <p class="number"><?php echo $don_hang_hom_nay; ?></p>
                                </div>
                                <div class="info-icon">
                                <i class="fa-solid fa-calendar-day"></i>
                                </div>
                            </div>
                        </div>
                    </div>

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
                                    <h5>Đơn bị hủy</h5>
                                    <p class="number"><?php echo $so_don_that_bai; ?></p>
                                </div>
                                    <div class="info-icon">
                                    <i class="fa-solid fa-xmark-circle"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-4">
                        <div class="info-card custom-red">
                            <div class="info-card-content">
                                <div class="info-text">
                                    <h5>Khu vực phụ trách</h5>
                                    <p class="number">
                                    <?php 
                                        if (isset($khuvuc) && isset($khuvuc[0]) && $khuvuc[0]['BP_TENBP'] == 'Giao Hàng') {
                                            echo '<p> ';
                                            $ten_khuvuc = array_map(function($kv) {
                                                return $kv['P_TENPHUONGXA'];
                                            }, $khuvuc);
                                            echo implode(', ', $ten_khuvuc);
                                            echo '</p>'; // Đóng thẻ luôn trong if
                                        }
                                        ?>
                                    </p>
                                </div>
                                    <div class="info-icon">
                                    <i class="fa-solid fa-location-dot"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!-- lịch -->       
            <div class="calendar">
                        <header>
                            <h3></h3>
                            <nav>
                                <button id="prev"><</button>
                                <button id="next">></button>
                            </nav>
                        </header>
                <section>
                    <ul class="days">
                        <li>Sun</li>
                        <li>Mon</li>
                        <li>Tue</li>
                        <li>Wed</li>
                        <li>Thu</li>
                        <li>Fri</li>
                        <li>Sat</li>
                    </ul>
                    <ul class="dates"></ul>
                </section>
            </div>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
    <script src="view/JS/calendar.js"></script>
</body>
</html>