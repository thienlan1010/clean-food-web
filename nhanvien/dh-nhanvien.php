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
    <script src="view/JS/calendar.js"></script>
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

        /* Hover dòng */
        table tr:hover {
            background-color: #f1f1f1;
        }
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
        .in-hd {
            padding: 6px 12px;
            margin: 2px;
            display: inline-block;
            font-size: 14px;
            text-decoration: none;
            border-radius: 4px;
            transition: background-color 0.2s ease;
            color: #fff;
            background-color:rgb(222, 79, 18);
        }
        .in-hd:hover{
            background-color:rgb(171, 70, 20);
        }
        /**DROPDOWN TRẠNG THÁI */
        select {
            padding: 6px 12px;
            border-radius: 6px;
            border: 1px solid #ccc;
            background-color: #f8f9fa;
            color: #333;
            font-size: 14px;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            cursor: pointer;
        }

        select:hover {
            border-color:rgb(193, 172, 155);
            box-shadow: 0 0 5px rgba(253, 126, 20, 0.3);
        }

        select:focus {
            outline: none;
            border-color:rgb(164, 132, 106);
            box-shadow: 0 0 8px rgba(253, 126, 20, 0.5);
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
                    <h2>Đơn hàng cần giao</h2>
                    <!-- Đơn hàng cần giao  -->
                     <?php
                     if(isset($dh) && (count($dh) > 0)){
                        echo '
                         <table>
                        <tr class="text-center">
                                <th>STT</th>  
                                <th>ID đơn</th>                          
                                <th>Tên KH</th>
                                <th>Địa chỉ</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                        </tr>';
                       
                                $i=1;
                                foreach ($dh as $d) {
                                    echo '<tr class="text-center mb-2">
                                            <td>'.$i.'</td>                                        
                                            <td>'.$d['DH_MADH'].'</td>
                                            <td>'.$d['ten_khach'].'</td>
                                            <td>'.$d['dia_chi'].'</td>
                                           <td>                                       
                                                <input type="hidden" name="madon" value="'.$d['DH_MADH'].'">
                                                <select name="trangthai" onchange="capNhatTrangthaiNv('.$d['DH_MADH'].', this.value)">';
                                                    // Duyệt qua các trạng thái từ bảng trang_thai
                                                    foreach ($trangthai as $tt) {
                                                        $selected = ($d['TT_MATT'] == $tt['TT_MATT']) ? 'selected' : '';
                                                        echo '<option value="'.$tt['TT_MATT'].'" '.$selected.'>'.$tt['TT_TENTT'].'</option>';
                                                    }

                                echo        '</select>
                                           
                                        </td>
                                            <td><a class="btn-edit" href="index.php?act=det-dh-nv&id='.$d['DH_MADH'].'">Chi tiết</a> 
                                            <a class="in-hd" href="index.php?act=xuat-hd&id='.$d['DH_MADH'].'">Xuất DH</a>                                           
                                            </td>
                                        </tr>';
                                        $i++;
                                }
                            
                                                                             
             echo'       </table>
                            
                  ';
                            }       
                     ?>

                </div>
                </div>
            <!-- lịch -->       
           
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>
   <script>
    function capNhatTrangthaiNv(madh, trangthai) {
        fetch('index.php?act=capnhat_trangthai', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `madh=${madh}&trangthai=${trangthai}`
    })
    .then(response => response.text())
    .then(data => {
        alert("Cập nhật trạng thái thành công!");
        location.reload();
    });
    }
</script>

    
</body>
</html>