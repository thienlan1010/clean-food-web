<?php
// function get_cart_quantity() {
//     if (isset($_SESSION['giohang'])) {
//         return count($_SESSION['giohang']);
//     }
//     return 0;
// }
// $cart_count = get_cart_quantity();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.jpg">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <script src="view/JS/thuvien.js"></script>


    <title>Thực Phẩm Sạch</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html,
        body {
            height: 100%;
            margin: 0;
            min-height: 100vh;
            overflow-y: auto;
            overflow-x: hidden; 
           
        }

        .wrapper {
            display: flex;
            flex-direction: column;

            z-index: 999; /* đảm bảo nổi lên trên các phần khác */
            width: 100%;
            min-height: 100vh;  /*100% chiều cao trình duyệt */
        }
        /* Màu nền phần header */
        .color-header {
            /* background: linear-gradient(90deg,rgb(166, 233, 168),rgb(209, 234, 210)); */
            background-color: white;
            color: white;
        }

        /* Logo căn giữa trong khối */
        .logo-container {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Logo ảnh thu nhỏ gọn đẹp */
        .logo-img {
            max-width: 90px;
            height: auto;
        }

        /* Điều hướng menu */
        .nav .nav-link {
            color: black;
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s ease;
            font-size: 18px
        }

        .nav .nav-link:hover {
            color: red;
        }

        /* Giỏ hàng biểu tượng */
        .nav-icon {
            color: #198754;
            font-size: 20px;
            margin-left: 15px;
        }

        /* Form tìm kiếm */
        .search-form {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 500px;
            position: relative;
        }

        .search-form input[type="search"] {
            border-radius: 25px 0 0 25px;
            padding: 8px 15px;
            border: none;
            outline: none;
            background-color: #ffffff;
            color: #333;
            flex: 1;
        }

        .search-form button {
            border: none;
            background: #ffffff;
            color: #4CAF50;
            padding: 8px 12px;
            cursor: pointer;
            font-size: 16px;
        }

        .search-form #micro-icon {
            border-radius: 0;
            background: #ffffff;
            padding: 6px 10px; /* tùy chỉnh nếu muốn nút to hơn */
        }
        .search-form #micro-icon i {
            font-size: 20px; /* tăng từ mặc định (thường là 16px) lên lớn hơn */
            color: #198754;  /* tuỳ chọn màu xanh hoặc màu bạn muốn */
        }
        .search-form #tim {
            border-radius: 25px ;
            background-color: #388E3C;
            color: white;
            transition: background-color 0.3s ease;

        }

        .search-form #tim:hover {
            background-color: #2e7d32;
        }

        /* Gợi ý tìm kiếm (nếu dùng) */
        #suggestion-box {
            position: absolute;
            top: 100%;
            left: 0;
            background: white;
            border: 1px solid #ccc;
            width: 100%;
            z-index: 1000;
            display: none;
        }

        /* Nút đăng nhập / đăng ký */
        .auth-button {
            /* background-color: transparent; */
            background-color:rgb(63, 187, 67);
            border: 2px solid rgb(63, 187, 67);
            color: white;
            padding: 6px 12px;
            margin: 0 5px;
            border-radius: 25px;
            transition: all 0.3s ease;
        }

        .auth-button:hover {
            background-color: white;
            color:rgb(44, 141, 47);
        }
        .logo-img{
            border-radius: 100px;
            box-shadow: 0 3px 8px rgba(0,0,0,0.5);
        }
        /**login */
        .modal-content {
  background: #ffffff;
  border-radius: 1rem;
  padding-top: 10px;
}

.modal-title {
  color: #198754;
  font-weight: bold;
}

.form-control{
  border-color: #198754;
  box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);


}

.btn-success {
  background-color: #198754;
  border-color: #198754;
  font-weight: bold;
  transition: all 0.3s ease;
}

.btn-success:hover {
  background-color: #157347;
  border-color: #146c43;
}

.btn-close {
  background: none;
  border: none;
}
/**menu drop */
.nav-item {
    position: relative;
}

.dropdown-menu {
    display: none; /* Ẩn menu khi không hover */
    position: absolute;
    top: 100%;
    left: 0;
    background-color: white;
    border-radius: 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    padding: 0;
    list-style: none;
    /* Thêm phần này để giới hạn chiều cao và bật cuộn */
    max-height: 200px;         /* hoặc giá trị khác tùy ý */
    overflow-y: auto;
    overflow-x: hidden;
    z-index: 1000;
}

.dropdown:hover .dropdown-menu {
    display: block;
   /* Hiển thị menu khi hover */
}

.dropdown-menu li {
    padding: 10px 20px;
}

.dropdown-menu li a {
    color: #333;
    text-decoration: none;
}

.dropdown-menu li a:hover {
    background-color: #34AD54;
    border-radius: 20px;
}
/**AVATA */
.avatar {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    margin-right: 10px; /* Adds space between the avatar and the username */
}

.username {
    font-size: 18px;
    color: black;
    margin-top: 8px;
    vertical-align: middle; /* Căn chỉnh dọc của phần tử để nó nằm giữa các phần tử khác, như ảnh đại diện (avatar) */
}
.cart-icon-container {
    position: relative;
    display: inline-block;
}

.cart-badge {
    position: absolute;
    top: -8px;
    right: -10px;
    background-color: red;
    color: white;
    border-radius: 50%;
    padding: 2px 6px;
    font-size: 12px;
    font-weight: bold;
}
.info-store{
    background-color: rgb(63, 187, 67);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 5px; /* hoạt động đúng cả trên & dưới */
    text-align: center;
    font-size: 14px;

}
.info-store p {
    margin: 0;
    color: white;
}
.custom-hr {
  width: 40%;               /* Chiều dài mong muốn, ví dụ 30% */
  margin: 0 auto;        /* Canh giữa theo chiều ngang */
  border: 1px solid black;   /* Màu và độ dày của đường kẻ */
}
/**header cố định */
.main-header{
    position: fixed;
    top: 0;
    left: 0;
    right: 0;
    width: 99%;
    z-index: 1000;
}

    </style>
</head>

<body>
    <!-- phần đầu -->
    <div class="wrapper">

        <header class="main-header">
                    <!-- THONG TIN GÌ ĐÓ ĐỂ KO CÓ TRẮNG -->
                             <div class="info-store">
                                <p>Số điện thoại: 0985632413 | Email: Paionus@gmail.com | Địa chỉ: 123A, Quận 7, TP. Hồ Chí Minh</p>
                             </div>
            <div class="container-fluid color-header">
                <div class="row">
                    <!-- logo -->
                    <div class=" col-md-3 col-sm- 4 p-3   logo-container">
                        <img class="logo-img" src="images/logo.jpg" alt="logo" width="100" height="100">
                    </div>
                    <!-- tìm kiếm -->
                    <!-- Cột Liên Kết Điều Hướng và Tìm Kiếm -->
                    <div class="col-md-6 col-sm- 4 p-3 d-flex flex-column align-items-center flex-grow-1">
                        <nav class="mb-2">
                            <ul class="nav">
                                <li class="nav-item"><a href="index.php?act=trangchu" class="nav-link">Trang Chủ</a>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        Sản Phẩm
                                    </a>
                                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php
                                            foreach ($dsdm as $dm) {
                                                echo '
                                                    <li><a class="dropdown-item" href="index.php?act=sanpham&id=' . htmlspecialchars($dm['DM_MADM']) . '">' . htmlspecialchars($dm['DM_TENDM']) . '</a></li>
                                                ';
                                            }

                                        ?>
                                    </ul>
                                </li>
                                <li class="nav-item"><a href="index.php?act=gioithieu" class="nav-link">Giới Thiệu</a>
                                </li>
                                <li class="nav-item"><a href="index.php?act=lienhe" class="nav-link">Liên Hệ</a></li>
                                <li class="nav-item"><a href="index.php?act=giohang" class="nav-icon">
                                    <i class="fa-solid fa-cart-shopping"></i>
                                    <?php if (isset($_SESSION['idcustomer']) && isset($_SESSION['slsp'])): ?>
                                        <span class="cart-badge"><?= $_SESSION['slsp'] ?></span>
                                    <?php else: ?>
                                        <span class="cart-badge" id="countsp">0</span>
                                    <?php endif; ?>

                                    </a></li>

                            </ul>
                        </nav>

                        <form class="search-form" action="index.php?act=timkiem" method="post"
                            onsubmit="return validateSearch()">
                            <input id="output" class="form-control me-2 rounded-5" type="search" name="nhaptim"
                                placeholder="Tìm kiếm sản phẩm..." aria-label="Search">
                            <button id="micro-icon" type="button"><i class="fa-solid fa-microphone "></i></button>
                            <button id="tim" class="btn btn-outline-light" type="submit" name="timkiem"><i
                                    class="fa-solid fa-magnifying-glass"></i></button>
                            <div id="suggestion-box"></div>
                        </form>
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

                    </div>
                    <!-- login & sign in -->
                    <div class=" col-md-3 col-sm- 4 p-3 d-flex justify-content-center align-items-center">
                        <!-- đang nhâp -->
                 <?php
                 //kiểm tra session có tồn tại không và khác rỗng không
                    if(isset($_SESSION['username']) && ($_SESSION['username'] !="")){

                        echo '<div class="dropdown user-menu">
                            <img src="images/user.jpg" alt="User Avatar" class="avatar dropdown-toggle shadow" data-bs-toggle="dropdown">
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="index.php?act=info_user">Thông tin cá nhân</a></li>
                                <li><a class="dropdown-item" href="index.php?act=info_taikhoan">Tài khoản</a></li>
                                <li><a class="dropdown-item" href="index.php?act=lichsu-order">Lịch sử đơn hàng</a></li>
                                <li><a class="dropdown-item" href="index.php?act=xem-danhgia">Xem tất cả đánh giá</a></li>
                                <li><a class="dropdown-item" href="index.php?act=tich-diem">Điểm tích lũy</a></li>
                                <li><a class="dropdown-item" href="index.php?act=thoat">Thoát</a></li>
                            </ul>
                        </div>
                        <p class="username">Chào, ' . htmlspecialchars($_SESSION['username']) . '</p>';
                    }else{
                    ?>
                        <a href="index.php?act=dangnhap"><button class="auth-button" name="login">Đăng nhập</button></a>
                        <a href="index.php?act=dangki"><button class="auth-button">Đăng ký</button></a>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
                     <hr class="custom-hr">

            <!-- Xử lý tìm bằng giọng nói -->
            <script>
                const startButton = document.getElementById('micro-icon');
                const output = document.getElementById('output'); // Đây là thẻ <input>
                const searchForm = document.querySelector('.search-form'); // Lấy form tìm kiếm

                const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
                if (!SpeechRecognition) {
                    alert("Trình duyệt của bạn không hỗ trợ Web Speech API!");
                } else {
                    const recognition = new SpeechRecognition();
                    recognition.lang = 'vi-VN'; // Nhận diện tiếng Việt

                    // Bắt đầu nhận diện khi nhấn nút micro
                    startButton.addEventListener('click', () => {
                        console.log("Bắt đầu nhận diện giọng nói...");
                        recognition.start();
                    });

                    // Xử lý kết quả nhận diện
                    recognition.onresult = (event) => {
                        console.log("Nhận diện giọng nói thành công!");
                        const transcript = event.results[0][0].transcript; // Kết quả giọng nói
                        console.log('Từ khóa tìm kiếm:', transcript.trim());
                        output.value = transcript; // Gán vào ô tìm kiếm

                        // Đợi 1 giây trước khi gửi form
                        setTimeout(() => {
                            searchForm.submit(); // Gửi form sau thời gian chờ
                        }, 1000); // Thời gian chờ 1000ms (1 giây)
                    };

                    // Xử lý lỗi
                    recognition.onerror = (event) => {
                        console.error("Lỗi:", event.error); // Hiển thị lỗi nhận diện
                        alert("Đã xảy ra lỗi trong quá trình nhận diện giọng nói!");
                    };
                }
            </script>
        </header>
       <!-- xóa js giỏ hàng  -->

</body>

</html>