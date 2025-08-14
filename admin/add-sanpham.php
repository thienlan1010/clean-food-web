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
        /* form {
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
        }*/

        form input[type="submit"] {
            background: #4caf50;
            color: #fff;
            /* font-size: 16px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: background 0.3s ease;
            width: fit-content; */
        }


        form input[type="submit"]:hover {
            background: #388e3c;
            color: #fff;
        }
        .shadow-box{
           box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        /* *textarea */
       .ck-editor__editable_inline {
            min-height: 300px;
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

           <div class="container mt-3">
            <h2 class="mb-3">Thêm sản phẩm</h2>
                <form action="index.php?act=add-sp-db" method="post" enctype="multipart/form-data">
                    <div class="row g-4">
                    <!-- Box 1: Thông tin sản phẩm -->
                    <div class="col-md-7">
                        <div class="bg-light p-4 rounded shadow-box">
                        <h4 class="mb-3 text-success">Thông tin sản phẩm</h4>

                        <div class="mb-3">
                            <label class="form-label">🏷️ Tên sản phẩm</label>
                            <input type="text" name="tensp" class="form-control"  required>
                        </div>

                        <div class="mb-3">
                            <label for="des" class="form-label">📝 Mô tả sản phẩm</label>
                            <textarea name="des-sp" id="editor" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">🖼️ Tải ảnh lên</label>
                            <input type="file" name="anh" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">📂 Danh mục</label>
                            <select name="madm" class="form-select" required>
                            <option value="">--Chọn danh mục--</option>
                            <?php foreach ($dm as $d): ?>
                                <option value="<?= $d['DM_MADM'] ?>"><?= $d['DM_TENDM'] ?></option>
                            <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">📦 Tồn kho</label>
                            <input type="number" name="tonkho" class="form-control" min=0 required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">💰 Giá</label>
                            <input type="number" name="gia" class="form-control" min=0  placeholder="0.000" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">⚖️ Đơn vị</label>
                            <input type="text" name="donvi" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">⚖️ Trọng lượng</label>
                            <input type="text" name="trongluong" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">📅 Ngày phát hành</label>
                            <input type="date" name="date" class="form-control" required>
                        </div>
                        </div>
                    </div>

                    <!-- Box 2: Thông tin dinh dưỡng -->
                    <div class="col-md-5">
                        <div class="bg-light p-4 rounded shadow-box">
                        <h4 class="mb-3 text-success">Thông tin dinh dưỡng</h4>

                        <div class="mb-3">
                            <label class="form-label">⚡ Năng lượng (kcal)</label>
                            <input type="number" step="0.1" name="calo" class="form-control" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">🍗 Chất đạm (g)</label>
                            <input type="number" step="0.1" name="dam" class="form-control" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">🧈 Chất béo (g)</label>
                            <input type="number" step="0.1" name="chatbeo" class="form-control" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">🍬 Đường (g)</label>
                            <input type="number" step="0.1" name="duong" class="form-control" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">🌾 Chất xơ (g)</label>
                            <input type="number" step="0.1" name="chatxo" class="form-control" min="0" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">🧂 Natri (mg)</label>
                            <input type="number" step="1" name="natri" class="form-control" min="0" required>
                        </div>

                        </div>
                        <!-- thể trạng -->
                        <div class="bg-light p-4 rounded shadow-box mt-4">
                            <h4 class="mb-3 text-success">🩺 Thể trạng phù hợp</h4>
                            <?php foreach ($thetrang as $tt): ?>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="thetrang[]" value="<?= $tt['TTRANG_MA'] ?>" id="tt<?= $tt['TTRANG_MA'] ?>">
                                <label class="form-check-label" for="tt<?= $tt['TTRANG_MA'] ?>">
                                <?= $tt['TTRANG_TEN'] ?>
                                </label>
                                <!-- Ô nhập mô tả tương ứng -->
                            <input type="text" class="form-control mt-1" name="mota_phuhop" placeholder="Mô tả lý do phù hợp (nếu có)">
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- THỂ TRẠNG -->
                     <!-- Box 3: Thể trạng phù hợp -->
                    <!-- <div class="col-md-5">
                    <div class="bg-light p-4 rounded shadow-box">
                        <h4 class="mb-3 text-success">🩺 Thể trạng phù hợp</h4>

                        <?php foreach ($thetrang as $tt): ?>
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="thetrang[]" value="<?= $tt['TTRANG_MA'] ?>" id="tt<?= $tt['TTRANG_MA'] ?>">
                            <label class="form-check-label" for="tt<?= $tt['TTRANG_MA'] ?>">
                            <?= $tt['TTRANG_TEN'] ?>
                            </label>
                        </div>
                        <?php endforeach; ?>

                    </div>
                    </div> -->


                    <!-- Nút thêm -->
                    <div class="col-12 text-center mb-5 mt-5">
                        <input type="submit" name="themsp" value="Thêm sản phẩm" class="btn px-4">
                    </div>
                    </div>
                </form>
            </div>
        <!-- 2 cái div này là của tổng -->
        </div>
    </div>


<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
<script>



    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['undo', 'redo', '|', 'heading', '|', 'bold', 'italic', 'link', 'bulletedList', 'numberedList', 'blockQuote'],
            // Đặt chiều cao mong muốn:
            height: '400px'
        })
        .then(editor => {
            editor.ui.view.editable.element.style.minHeight = '300px'; // 👈 chính xác dòng này để chỉnh chiều cao!
        })
        .catch(error => {
            console.error(error);
        });


</script>
</body>
</html>
<!-- <form action="index.php?act=add-sp-db" method="post" enctype="multipart/form-data">
                        <label for="pro-tle">Tên sản phẩm</label>
                        <input type="text" name="tensp" placeholder="Nhập tên sản phẩm" required>
                        <label for="des">Mô tả sản phẩm</label>
                        <textarea name="des-sp" id="editor"></textarea>
                        <label for="anh">Tải ảnh lên</label>
                        <input type="file" name="anh" id="anh" value="tải ảnh" required>
                        <select name="madm" id="quan" required>
                            <option value="">--Chọn danh mục--</option>
                             foreach ($dm as $d): ?>
                                <option  required value="<$d['DM_MADM'] ?>">= $d['DM_TENDM'] ?></option>
                          endforeach; ?>
                        </select>
                        <label for="tonkho">Tồn kho</label>
                        <input type="number" name="tonkho" id="tonkho" min=0 required>
                        <label for="gia">Giá</label>
                        <input type="number" name="gia" id="gia" min=0 required>
                        <label for="donvi">Đơn vị</label>
                        <input type="text" name="donvi" id="donvi" required>
                        <label for="date">Ngày phát hành</label>
                        <input type="date" name="date" id="date" required>
                        <input type="submit" value="Thêm" name="themsp">
                    </form> placeholder="Nhập tên sản phẩm"-->