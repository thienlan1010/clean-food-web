<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Thực Phẩm Sạch</title>
    <style>
        .bg {
            background-color: #445c5f;
        }

        .bgf {
            background-color: black;
            color: #fff;
            text-align: center;
        }

        h3 {
            color: #fff;
            margin-top: 10px;
        }

        p {
            color: #c3cbc8ed;
            font-size: 18px;
        }

        .Social-icons {
            display: flex;
            gap: 10px;
            margin-top: 10px;
        }

        .Social-icons a {
            display: inline-flex;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: #ffffff10;
            /* màu nền nhẹ */
            color: #fd7e14;
            justify-content: center;
            align-items: center;
            text-decoration: none;
            font-size: 20px;
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .Social-icons a:hover {
            background-color: #fd7e14;
            /* màu cam nổi bật khi hover */
            color: white;
            transform: scale(1.1);
            border-color: #fff;
        }

        .payment-icons {
            display: flex;
            gap: 10px;
            margin-top: 20px;
        }

        .payment-icons i {
            font-size: 20px;
            color: #ffffffcc;
            /* Màu trắng nhạt để nổi bật trên nền tối */
            transition: all 0.3s ease;
            background-color: #ffffff10;
            /* Nền nhẹ nhàng */
            padding: 5px;
            border-radius: 8px;
            border: 1px solid transparent;
        }

        .payment-icons i:hover {
            color: #fd7e14;
            /* Màu cam khi hover */
            transform: scale(1.1);
            border-color: #fff;
            background-color: #ffffff20;
        }
        .nav-link:hover p {
        color: #fd7e14; /* Màu khi hover (cam sáng, bạn có thể đổi) */
    }
    .nav-link:hover{
        color: #fd7e14;
    }
    .logo-img{
            border-radius: 100px;
            margin-bottom: 5px;
        }
       

/**CÁC TRANG LIÊN KẾT */
.my-nav-link {
    color: #c3cbc8ed;
    padding: 8px 16px;
    display: block;
   
    text-decoration: none;
    font-size: 18px;
}

.my-nav-link:hover,
.my-nav-link:focus {
    background-color: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

.my-dropdown-menu {
    background-color:rgb(229, 237, 238);
    border: none;
    width: 200px;
}

.my-dropdown-item {
    color: #f8f9fa;
    font-weight: 500;
}

.my-dropdown-item:hover {
    background-color: rgba(255, 255, 255, 0.1);
    color: #ffffff;
}

/* Xử lý danh sách */
ul.navbar-nav {
    list-style-type: none;
    padding-left: 0;
}





    </style>
</head>

<body>
  
    <!-- phân chân  trang -->
    <footer class="">
        <div class="container-fluid bg">
            <div class="container"> <!-- Nội dung canh giữa -->
            <div class="row ">
                <div class="col-md-4 col-sm-6">
                    <h3>Quy chế</h3>
                    <p>Giờ mở cửa:</p>
                    <p>Monday - Sunday: 7.AM - 10.PM</p>
                    <!-- <a class="nav-link" href="index.php?act=quyche">
                        <p>Quy chế web</p>
                    </a> -->
                    <a class="nav-link" href="index.php?act=xem-fee">
                        <p>Phí giao hàng</p>
                    </a>
                    <br>
                    <img class="logo-img" src="images/logo.jpg" alt="logo" width="100"
                        height="100">

                </div>
                <div class="col-md-4 col-sm-6">
                    <h3>Các trang khác</h3>
                    <!-- <p><a class="nav-link" href="index.php?act=trangchu">Trang Chủ</a></p>
                     <p><a class="nav-link" href="index.php?act=gioithieu">Sản Phẩm</a></p> 
                     <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="sanphamDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sản phẩm
                        </a>    
                        <ul class="dropdown-menu" aria-labelledby="sanphamDropdown">
                            <?php foreach ($dsdm as $dm): ?>
                                <li>
                                    <a class="dropdown-item" href="index.php?act=sanpham&id=<?= $dm['DM_MADM'] ?>">
                                        <?= htmlspecialchars($dm['DM_TENDM']) ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </li>

                    <p><a class="nav-link" href="index.php?act=gioithieu">Giới Thiệu</a></p>
                    <p><a class="nav-link" href="index.php?act=lienhe">Liên Hệ</a></p> -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="my-nav-link" href="index.php?act=trangchu">Trang Chủ</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="my-nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown">Sản phẩm</a>
                            <ul class="my-dropdown-menu dropdown-menu">
                                <?php foreach ($dsdm as $dm): ?>
                                    <li><a class="my-dropdown-item dropdown-item" href="index.php?act=sanpham&id=<?= $dm['DM_MADM'] ?>">
                                        <?= $dm['DM_TENDM'] ?></a></li>
                                <?php endforeach; ?>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="my-nav-link" href="index.php?act=gioithieu">Giới Thiệu</a>
                        </li>
                        <li class="nav-item">
                            <a class="my-nav-link" href="index.php?act=lienhe">Liên Hệ</a>
                        </li>
                    </ul>

                </div>
                <div class="col-md-4 col-sm-6">
                    <h3>Liên hệ</h3>
                    <p>Địa chỉ: Phan Chu Trinh, P. Bến Thành, Quận 1, TP. Hồ Chí Minh</p>
                    <p>Email: Paionus@gmail.com</p>
                    <p>SĐT: 0985632413</p>
                    <p>Chấp nhận các hình thức thanh toán</p>
                    <div class="payment-icons">
                        <i class="fab fa-cc-visa"></i>
                        <i class="fab fa-cc-mastercard"></i>
                        <i class="fab fa-cc-amex"></i>
                        <i class="fab fa-cc-paypal"></i>
                        <i class="fab fa-cc-discover"></i>
                    </div>

                    <p>Social Network</p>
                    <div class="Social-icons">
                        <a href="#"> <i class="fa-brands fa-youtube"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"> <i class="fa-brands fa-tiktok"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
        <!-- Dòng bản quyền -->

        <div class="row">
            <div class="col-md-12 bgf">
                <p class="copyright mt-2">© Bản quyền thuộc về Paionus, 2025</p>
            </div>
        </div>

    </footer>
    
    </div>
    <script src="view/JS/ad_cart.js"></script>
    <script src="view/JS/showcart.js"></script>
</body>

</html>