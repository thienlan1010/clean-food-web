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
            width: 100% ;
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
        /**các box*/
        .custom-stat-card {
            background: linear-gradient(to bottom right, #ffffff, #f1f1f1);
            border: 1px solid #ddd;
            border-radius: 12px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        .custom-stat-card h5 {
            font-weight: bold;
            color: #333;
            margin-bottom: 10px;
            font-size: 18px;
        }

        .custom-stat-card p {
            font-size: 24px;
            font-weight: bold;
            color: #198754; /* màu xanh Bootstrap */
        }

        .custom-stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
        }
        /**các box */
    
    .dashboard-cards {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: space-between;
        padding-right: 20px;
        padding-left: 5px;

    }

    .card-box {
        flex: 1 1 calc(25% - 20px);
        display: flex;
        align-items: center;
        background: #ffffff;
        border-radius: 15px;
        padding: 20px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.2);
        transition: transform 0.3s ease;
    }

    .card-box:hover {
        transform: translateY(-5px);
    }

    .card-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
        margin-right: 15px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.15);
    }
    /**BOX BIG CỦA BIỂU ĐỒ */
    .box-big{
        display: flex;
        margin-right: 20px;
        margin-left: 5px;
    }
     .chart-container {
        width: 350px;
        height: 350px;
        margin-top: 0px;
    }
.chart-containers {
        width: 430px;
        height: 430px;
        margin-top: 0px;
    }
    .charts-wrapper {
        display: flex;
        justify-content: center;
        gap: 250px;
        margin-top: 40px;
        align-items: center;
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
            <div class="container mt-4">
                <h3>Dashboard</h3>              
                   <div class="dashboard-cards">
                        <div class="card-box">
                            <div class="card-icon bg-success text-white">
                                <i class="fas fa-coins"></i>
                            </div>
                            <div>
                                <h5>Doanh thu</h5>
                                <p class="text-success fs-4">
                                    <?php 
                                        echo (isset($total_revenue) && is_numeric($total_revenue)) 
                                            ? number_format($total_revenue, 3) . ' đ' 
                                            : '0 đ';
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="card-box">
                            <div class="card-icon bg-primary text-white">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <div>
                                <h5>Đơn hàng</h5>
                                <p class="text-primary fs-4"><?php echo $total_orders; ?></p>
                            </div>
                        </div>

                        <div class="card-box">
                            <div class="card-icon bg-info text-white">
                                <i class="fas fa-users"></i>
                            </div>
                            <div>
                                <h5>Người dùng</h5>
                                <p class="text-primary fs-4"><?php echo $new_accounts_count; ?></p>
                            </div>
                        </div>

                        <div class="card-box">
                            <div class="card-icon bg-warning text-white">
                                <i class="fas fa-eye"></i>
                            </div>
                            <div>
                                <h5>Đánh giá</h5>
                                <p class="text-warning fs-4"><?php echo $danhgia; ?></p>
                            </div>
                        </div>
                    </div>

                
                <!-- BIỂU ĐỒ TRÒN -> TRẠNG THÁI  -->
              <div class="charts-wrapper">
                <div class="chart-containers">
                    <canvas id="donutTrangThai"></canvas>
                </div>
           


                <script>
                const labelsStatus = <?= json_encode($labels_status) ?>;
                const dataStatus = <?= json_encode($data_status) ?>;
                const ctxDonut = document.getElementById('donutTrangThai').getContext('2d');
                const donutChart = new Chart(ctxDonut, {
                    type: 'doughnut',
                    data: {
                        labels: labelsStatus,
                        datasets: [{
                            label: 'Tỷ lệ trạng thái',
                            data: dataStatus,
                            backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#17a2b8', '#6f42c1'], // Thêm màu nếu có nhiều trạng thái hơn
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            title: {
                                display: true,
                                text: '📊 Tỷ lệ trạng thái đơn hàng',
                                font: {
                                    size: 18,
                                    weight: 'bold',
                                    family: 'Arial'
                                },
                                    padding: {
                                        top: 50
                                     
                                    },
                                    margin:{
                                        
                                    },
                                color: '#0d6efd'
                            },
                            legend: {
                                position: 'right',
                                labels: {
                                    boxWidth: 20,
                                    padding: 15,
                                    font: {
                                        size: 14,
                                        family: 'Arial',
                                        weight: 'bold'
                                    },
                                    color: '#333'
                                }
                            }
                        }
                    }
                });

                </script>
                <!-- BIỂU ĐỒ TRONG CHO SOSAO -->
                 <div class="chart-container">
                    <canvas id="ratingChart"></canvas>
                </div>
                </div>
                <script>
                     const ratingData = <?= json_encode($ratingData) ?>;
                    const ctxRating = document.getElementById('ratingChart').getContext('2d');
                    const ratingChart = new Chart(ctxRating, {
                        type: 'doughnut',
                        data: {
                            labels: ['1 Sao', '2 Sao', '3 Sao', '4 Sao', '5 Sao'],
                            datasets: [{
                                label: 'Số sao',
                                data: ratingData, // Từ PHP đổ ra
                                backgroundColor: ['#dc3545', '#fd7e14', '#ffc107', '#0d6efd', '#28a745'],
                                borderWidth: 1
                            }]
                        },
                        options: {
                            responsive: true,
                            plugins: {
                                title: {
                                    display: true,
                                    text: '⭐ Tỷ lệ đánh giá sản phẩm',
                                    color: '#0d6efd',
                                    font: {
                                        size: 18,
                                        weight: 'bold'
                                    },
                                    padding: {
                                        top: 10,
                                        bottom: 30
                                    }
                                },
                                legend: {
                                    position: 'right',
                                    labels: {
                                        padding: 15,
                                        font: {
                                            size: 14,
                                            family: 'Arial',
                                            weight: 'bold'
                                        },
                                    color: '#333'
                                    }
                                }
                            }
                        }
                    });
                </script>


                <!-- BIỂU ĐỒ DƯỜNG CHO KHÁCH HÀNG ĐĂNG KÝ -->
            <div class="card mt-4 box-big">
            <div class="card-body" style="background-color: #f1f8ff;">
                <h5>Khách Hàng Đăng Ký Theo Tháng</h5>
                <div class="d-flex justify-content-between align-items-center mb-2">
                <button id="prevYearKH" class="btn  btn-sm">&lt;</button>
                <h5 id="yearKHLabel">Năm 2025</h5>
                <button id="nextYearKH" class="btn  btn-sm">&gt;</button>
                </div>
                <canvas id="customerChart"></canvas>
            </div>
           
        </div>
            <script>
            const customerCtx = document.getElementById('customerChart').getContext('2d');
            const customerData = <?php echo json_encode($yearly_monthly_customers); ?>;
            const monthLabels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

            let currentYearKH = 2025;
            let khChart = new Chart(customerCtx, {
                type: 'line',
                data: {
                    labels: monthLabels,
                    datasets: [{
                        label: `Số lượng khách hàng - ${currentYearKH}`,
                        data: customerData[currentYearKH] || Array(12).fill(0),
                        borderColor: '#0d6efd',
                        backgroundColor: 'rgba(13, 110, 253, 0.2)',
                        tension: 0.3,
                        fill: true,
                        pointBackgroundColor: '#0d6efd',
                        pointRadius: 4
                    }]
                },
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top'
                        },
                        tooltip: {
                            callbacks: {
                                label: (tooltipItem) => `${tooltipItem.raw} khách`
                            }
                        }
                    },
                    scales: {
                        y: {
                            beginAtZero: true,
                            title: {
                                display: true,
                                text: 'Số lượng KH'
                            }
                        },
                        x: {
                            title: {
                                display: true,
                                text: 'Tháng'
                            }
                        }
                    }
                }
            });

            // Cập nhật dữ liệu khi chuyển năm
            function updateCustomerChart(year) {
                document.getElementById('yearKHLabel').innerText = `Năm ${year}`;
                khChart.data.datasets[0].label = `Số lượng khách hàng - ${year}`;
                khChart.data.datasets[0].data = customerData[year] || Array(12).fill(0);
                khChart.update();
            }

            // Nút điều hướng năm
            document.getElementById('prevYearKH').addEventListener('click', () => {
                currentYearKH--;
                updateCustomerChart(currentYearKH);
            });
            document.getElementById('nextYearKH').addEventListener('click', () => {
                currentYearKH++;
                updateCustomerChart(currentYearKH);
            });
            </script>

                 <!-- DOANH THU THEO THÁNG -->
                 
            <div class="card mt-5 box-big">
                <div class="card-body" style="background-color: #f1f8ff; color: rgb(3, 5, 14);">
                    <h5>Doanh Thu Theo Tháng</h5> <!-- Tiêu đề cho biểu đồ -->
                    <!-- nút <> -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button id="prevYear" class="btn btn-light">&lt;</button> <!-- Mũi tên lùi -->
                        <h5 id="yearLabel">Năm 2025</h5> <!-- Hiển thị năm hiện tại -->
                        <button id="nextYear" class="btn btn-light">&gt;</button> <!-- Mũi tên tiến -->
                    </div>
                    <canvas id="revenueChart"></canvas>
                   
                </div>
                
                <script>
                    const ctx = document.getElementById('revenueChart').getContext('2d');

                    // Dữ liệu từ PHP
                    const yearlyData = <?php echo json_encode($yearly_monthly_revenue); ?>;
                    // Định dạng dữ liệu thành số có 2 chữ số thập phân
                    function formatRevenueData(dataArray) {
                        return dataArray.map(value => parseFloat(value).toFixed(3));
                    }
                    const chartLabels = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

                    // Khởi tạo biểu đồ với dữ liệu ban đầu
                    let currentYear = 2025; // Năm hiện tại (mặc định là 2025)
                    let chartData = {
                        labels: chartLabels,
                        datasets: [{
                            label: `Doanh thu (VNĐ) - Năm ${currentYear}`,
                            data: formatRevenueData(yearlyData[currentYear]) || Array(12).fill(0), // Nếu không có dữ liệu cho năm hiện tại, sử dụng mảng 0
                            backgroundColor: 'rgb(228, 213, 124)', // Màu cột
                            borderColor: 'rgb(228, 213, 124)', // Màu viền cột
                            borderWidth: 1
                        }]
                    };

                    const revenueChart = new Chart(ctx, {
                        type: 'bar', // Loại biểu đồ: cột
                        data: chartData,
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true // Bắt đầu từ 0
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true, // Hiển thị chú thích
                                    position: 'top' // Vị trí chú thích
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.raw.toLocaleString(); // Định dạng số liệu với dấu phẩy
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Thay đổi dữ liệu khi nhấn mũi tên
                    document.getElementById('prevYear').addEventListener('click', function() {
                        currentYear--; // Lùi lại 1 năm
                        if (!yearlyData[currentYear]) {
                            yearlyData[currentYear] = Array(12).fill(0); // Nếu không có dữ liệu, set mặc định là 0 cho tất cả tháng
                        }

                        // Cập nhật lại biểu đồ với dữ liệu của năm mới
                        updateChart(currentYear);
                    });

                    document.getElementById('nextYear').addEventListener('click', function() {
                        currentYear++; // Tiến lên 1 năm
                        if (!yearlyData[currentYear]) {
                            yearlyData[currentYear] = Array(12).fill(0); // Nếu không có dữ liệu, set mặc định là 0 cho tất cả tháng
                        }

                        // Cập nhật lại biểu đồ với dữ liệu của năm mới
                        updateChart(currentYear);
                    });

                    // Hàm cập nhật biểu đồ
                    function updateChart(year) {
                        // Cập nhật tiêu đề năm
                        document.getElementById('yearLabel').innerText = `Năm ${year}`;

                        // Cập nhật dữ liệu của biểu đồ
                        revenueChart.data.datasets[0].label = `Doanh thu (VNĐ) - Năm ${year}`;
                        revenueChart.data.datasets[0].data = yearlyData[year] || Array(12).fill(0); // Nếu không có dữ liệu thì mặc định 0 cho tất cả tháng

                        // Vẽ lại biểu đồ với dữ liệu mới
                        revenueChart.update();
                    }
                </script>

            </div>

            <!-- ĐƠN HÀNG THEO THÁNG -->  
            <div class="card mt-5 box-big mb-4">
                <div class="card-body" style="background-color: #f1f8ff; color: rgb(3, 5, 14);">
                    <h5>Tổng Đơn Hàng Theo Tháng</h5> <!-- Tiêu đề cho biểu đồ -->
                    <!-- nút <> -->
                    <div class="d-flex justify-content-between align-items-center">
                        <button id="prevYearOrders" class="btn btn-light">&lt;</button> <!-- Mũi tên lùi -->
                        <h5 id="yearLabelOrders">Năm 2025</h5> <!-- Hiển thị năm hiện tại -->
                        <button id="nextYearOrders" class="btn btn-light">&gt;</button> <!-- Mũi tên tiến -->
                    </div>
                    <canvas id="ordersChart"></canvas>
                </div>

                <script>
                   const ctxOrders = document.getElementById('ordersChart').getContext('2d');
                    // Dữ liệu từ PHP
                    const yearlyDataOrders = <?php echo json_encode($yearly_monthly_orders); ?>;

                    const orderChartLabels  = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

                    // Khởi tạo biểu đồ với dữ liệu ban đầu
                    let currentYearOrders = 2025; // Năm hiện tại (mặc định là 2025)
                    let chartDataOrders = {
                        labels: orderChartLabels ,
                        datasets: [{
                            label: `Tổng Đơn Hàng - Năm ${currentYearOrders}`,
                            data: yearlyDataOrders[currentYearOrders] || Array(12).fill(0), // Nếu không có dữ liệu cho năm đó thì dùng mảng 0
                            backgroundColor: 'rgb(228, 213, 124)', // Màu cột
                            borderColor: 'rgb(228, 213, 124)', // Màu viền cột
                            borderWidth: 1
                        }]
                    };

                    const ordersChart = new Chart(ctxOrders, {
                        type: 'bar', // Loại biểu đồ: cột
                        data: chartDataOrders,
                        options: {
                            responsive: true,
                            scales: {
                                y: {
                                    beginAtZero: true // Bắt đầu từ 0
                                }
                            },
                            plugins: {
                                legend: {
                                    display: true, // Hiển thị chú thích
                                    position: 'top' // Vị trí chú thích
                                },
                                tooltip: {
                                    callbacks: {
                                        label: function(tooltipItem) {
                                            return tooltipItem.raw.toLocaleString(); // Định dạng số liệu với dấu phẩy
                                        }
                                    }
                                }
                            }
                        }
                    });

                    // Thay đổi dữ liệu khi nhấn mũi tên
                    document.getElementById('prevYearOrders').addEventListener('click', function() {
                        currentYearOrders--; // Lùi lại 1 năm
                        if (!yearlyDataOrders[currentYearOrders]) {
                            // Nếu không có dữ liệu cho năm đó thì dùng mảng 0 cho tất cả tháng
                            yearlyDataOrders[currentYearOrders] = Array(12).fill(0);
                        }

                        // Cập nhật lại biểu đồ với dữ liệu của năm mới
                        updateChartOrders(currentYearOrders);
                    });

                    document.getElementById('nextYearOrders').addEventListener('click', function() {
                        currentYearOrders++; // Tiến lên 1 năm
                        if (!yearlyDataOrders[currentYearOrders]) {
                            // Nếu không có dữ liệu cho năm đó thì dùng mảng 0 cho tất cả tháng
                            yearlyDataOrders[currentYearOrders] = Array(12).fill(0);
                        }

                        // Cập nhật lại biểu đồ với dữ liệu của năm mới
                        updateChartOrders(currentYearOrders);
                    });

                    // Hàm cập nhật biểu đồ
                    function updateChartOrders(year) {
                        // Cập nhật tiêu đề năm
                        document.getElementById('yearLabelOrders').innerText = `Năm ${year}`;

                        // Cập nhật dữ liệu của biểu đồ
                        ordersChart.data.datasets[0].label = `Tổng Đơn Hàng - Năm ${year}`;
                        ordersChart.data.datasets[0].data = yearlyDataOrders[year]; // Cập nhật dữ liệu

                        // Vẽ lại biểu đồ với dữ liệu mới
                        ordersChart.update();
                    }

                   
                </script>
            </div>

            <!-- BIỂU ĐỒ TỔNG TÀI KHOẢN KHÁCH HÀNG -->
                        <!-- <div class="card mt-5 mb-5 box-big">
                            <div class="card-body" style="background-color: rgb(213, 235, 228); color: rgb(3, 5, 14);">
                                <h5>Tổng Tài Khoản Khách Hàng Đăng Ký Theo Tháng</h5> Tiêu đề cho biểu đồ -->
                                <!-- nút <> 
                                <div class="d-flex justify-content-between align-items-center">
                                    <button id="prevYearAccounts" class="btn btn-light">&lt;</button> 
                                    <h5 id="yearLabelAccounts">Năm 2025</h5>
                                    <button id="nextYearAccounts" class="btn btn-light">&gt;</button> 
                                </div>
                                <canvas id="accountsChart"></canvas>
                            </div>

                            <script>
                                const ctxAccounts = document.getElementById('accountsChart').getContext('2d');

                                // Dữ liệu từ PHP
                                const yearlyDataAccounts = <?php echo json_encode($yearly_monthly_customers); ?>;

                                const chartCustomer = ['Tháng 1', 'Tháng 2', 'Tháng 3', 'Tháng 4', 'Tháng 5', 'Tháng 6', 'Tháng 7', 'Tháng 8', 'Tháng 9', 'Tháng 10', 'Tháng 11', 'Tháng 12'];

                                // Khởi tạo biểu đồ với dữ liệu ban đầu
                                let currentYearAccounts = 2025; // Năm hiện tại (mặc định là 2024)
                                let chartDataAccounts = {
                                    labels: chartCustomer,
                                    datasets: [{
                                        label: `Tổng Tài Khoản - Năm ${currentYearAccounts}`,
                                        data: yearlyDataAccounts[currentYearAccounts] || Array(12).fill(0), // Lấy dữ liệu tổng tài khoản của năm hiện tại
                                        backgroundColor: 'rgb(228, 213, 124)', // Màu cột
                                        borderColor: 'rgb(228, 213, 124)', // Màu viền cột
                                        borderWidth: 1
                                    }]
                                };

                                const accountsChart = new Chart(ctxAccounts, {
                                    type: 'bar', // Loại biểu đồ: cột
                                    data: chartDataAccounts,
                                    options: {
                                        responsive: true,
                                        scales: {
                                            y: {
                                                beginAtZero: true // Bắt đầu từ 0
                                            }
                                        },
                                        plugins: {
                                            legend: {
                                                display: true, // Hiển thị chú thích
                                                position: 'top' // Vị trí chú thích
                                            },
                                            tooltip: {
                                                callbacks: {
                                                    label: function(tooltipItem) {
                                                        return tooltipItem.raw.toLocaleString(); // Định dạng số liệu với dấu phẩy
                                                    }
                                                }
                                            }
                                        }
                                    }
                                });

                                // Thay đổi dữ liệu khi nhấn mũi tên
                                document.getElementById('prevYearAccounts').addEventListener('click', function() {
                                    currentYearAccounts--; // Lùi lại 1 năm
                                    updateChartAccounts(currentYearAccounts);
                                });

                                document.getElementById('nextYearAccounts').addEventListener('click', function() {
                                    currentYearAccounts++; // Tiến lên 1 năm
                                    updateChartAccounts(currentYearAccounts);
                                });

                                // Hàm cập nhật biểu đồ
                                function updateChartAccounts(year) {
                                    // Kiểm tra xem có dữ liệu cho năm không
                                    if (!yearlyDataAccounts[year]) {
                                        // Nếu không có dữ liệu, thay thế bằng mảng 0
                                        yearlyDataAccounts[year] = Array(12).fill(0);
                                    }

                                    // Cập nhật tiêu đề năm
                                    document.getElementById('yearLabelAccounts').innerText = `Năm ${year}`;

                                    // Cập nhật dữ liệu của biểu đồ
                                    accountsChart.data.datasets[0].label = `Tổng Tài Khoản - Năm ${year}`;
                                    accountsChart.data.datasets[0].data = yearlyDataAccounts[year]; // Cập nhật dữ liệu

                                    // Vẽ lại biểu đồ với dữ liệu mới
                                    accountsChart.update();
                                }
                            </script>
                        </div> -->

           

        </div>
    </div>
    
   
<!-- API -->
 <!-- <p>eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6ImFkNmNjNzljNzMxMDRkNTM4OGU0ODM4MjY1Y2U4ODM4IiwiaCI6Im11cm11cjY0In0=</p> -->

</body>
</html>