<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        /* Chi tiết sản phẩm */
        .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #222;
        }

        .card-text {
            font-size: 16px;
            margin-bottom: 10px;
            color: #555;
        }


        input[type="number"].form-control {
            width: 100px;
            display: inline-block;
            font-size: 16px;
            padding: 5px 10px;
        }

        .btn-primary {
            background-color: #007bff;
            border: none;
            font-weight: bold;
            padding: 10px 20px;
            border-radius: 6px;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .card-img-top {
            height: 200px; /* hoặc 180px, tùy thiết kế */
            object-fit: cover;
            width: 100%;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
        }
        /* Nút Chọn mua */
        .product-card .btn-primary {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 6px;
            border-radius: 50px;
            border: 1px solid #28a745;
            color: #28a745;
            background-color: transparent;
            font-weight: 600;
            font-size: 0.9rem;
            padding: 4px 12px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .product-card .btn-primary:hover {
            background-color: #28a745;
            color: white;
        }
        .review {
            background: #f8f9fa;
            border-left: 5px solid #fd7e14;
            padding: 15px 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.05);
            transition: background 0.3s;
        }

        .review:hover {
            background: #fff3e0;
        }

        .review h5 {
            margin-bottom: 10px;
            font-weight: bold;
            color: #343a40;
            font-size: 1.3rem;
        }

        .review p {
            margin: 4px 0;
            color: #555;
            font-size: 1rem;
        }
        .text{
            color: black;
        }
        main {
            flex: 1;
            margin-top: 170px;
        }
        .form-group.nho {
            display: flex;
            align-items: center;
            justify-content: center; /* Căn giữa ngang */
            gap: 8px;
            max-width: 200px;
            margin: 0 auto; /* Căn giữa khối theo bố cục */
        }

        .form-group.nho label {
            font-size: 14px;
            margin-bottom: 0;
            white-space: nowrap;
        }

        .form-group.nho input[type="number"] {
            width: 60px;
            padding: 4px 6px;
            font-size: 14px;
            text-align: center; /* Căn giữa số trong ô input */
        }
        .product-card {
            border: 1px solid #ddd;
            border-radius: 12px;
            overflow: hidden;
            background-color: #fff;
            text-align: center;
            transition: box-shadow 0.3s ease, transform 0.3s ease;
            padding: 10px;
        }
        .product-card:hover {
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.12);
            transform: translateY(-4px);
        }

        .product-card img {
            width: 100%;
            height: 200px;
            object-fit: contain;
            padding: 5px;
        }
       /* CARD SẢN PHẨM RIÊNG */
/* .custom-product-card {
  max-width: 350px !important;
  margin: 0 auto !important;
  border: 1px solid #ddd !important;
  border-radius: 8px !important;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1) !important;
  background-color: #fff !important;
  padding-bottom: 1rem !important;
}

.custom-product-card img {
  border-top-left-radius: 8px !important;
  border-top-right-radius: 8px !important;
  max-height: 280px !important;
  object-fit: cover !important;
  width: 100% !important;
}

.custom-product-card .card-body {
  padding: 1rem 1.5rem !important;
  display: flex !important;
  flex-direction: column !important;
  align-items: center !important;
}

.custom-product-card .card-title {
  font-size: 1.3rem !important;
  font-weight: 700 !important;
  margin-bottom: 0.75rem !important;
  color: #222 !important;
  text-align: center !important;
}

.custom-product-card .card-text {
  font-size: 1rem !important;
  margin-bottom: 0.5rem !important;
  color: #333 !important;
}

.custom-product-card .old-price {
  color: #888 !important;
  text-decoration: line-through !important;
  font-size: 0.9rem !important;
}

.custom-product-card .form-group.nho {
  width: 100% !important;
  max-width: 120px !important;
  margin: 0.5rem 0 1rem 0 !important;
}

.custom-product-card .form-group.nho label {
  font-weight: 600 !important;
  font-size: 0.95rem !important;
  display: block !important;
  margin-bottom: 0.25rem !important;
  color: #444 !important;
}

.custom-product-card .form-group.nho input[type="number"] {
  width: 100% !important;
  padding: 6px 10px !important;
  border: 1px solid #ccc !important;
  border-radius: 5px !important;
  font-size: 1rem !important;
  box-sizing: border-box !important;
}

.custom-product-card .btn-primary {
  border: 1px solid #28a745;
  color: #28a745;
  padding: 4px 12px;
  font-weight: 600;
  font-size: 0.9rem;
  border-radius: 50px;
  cursor: pointer !important;
  transition: background-color 0.3s ease !important;
 
}

.custom-product-card .btn-primary:hover {
    background-color: #28a745;
    color: white;
} */

/* MÔ TẢ SẢN PHẨM RIÊNG */
/* Box mô tả sản phẩm */
        #mota {
            background-color: #fdfdfd;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease-in-out;
            margin-bottom: 20px;
        }

       
        #mota h3 {
            font-weight: bold;
            color: #333;
            margin-bottom: 15px;
        }
        #mota p{
            color: #333;
        }
        .product-detail-box {
            padding-left: 100px;
            padding-top: 20px;
            padding-bottom: 20px;
            background-color: #fdfdfd;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            border-radius: 12px;
        }

        .product-detail-box .card-title {
            font-size: 20px;
            font-weight: 600;
            color: black;
        }

        .product-detail-box .btn-primary {
            padding: 10px 30px;
            font-size: 16px;
            border-radius: 8px;
        }



        .image-wrapper {
            width: 100%;
            max-width: 300px;
            height: 300px;
            overflow: hidden;
            border-radius: 10px;
            border: 1px solid #ddd;
            margin: 0 auto; /* canh giữa ảnh */
        }

        .product-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease-in-out;
            display: block;
        }

        .product-img:hover {
            transform: scale(1.1);
        }



        /**tiêu đề các sản phẩm liên quan*/
        .featured-title {
            display: inline-block;
            background: linear-gradient(to right, #009688, #8BC34A);
            color: white;
            font-weight: bold;
            font-size: 20px;
            text-align: center;
            padding: 10px 25px;
            border-radius: 10px 10px 0 0;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.2);
            margin: 20px auto;
        }

        /**đơn vị */
        .donvi{
            font-size: 13px;
            font-weight: 400;
        }
        /**tên sp và các thông tin khác */
        .card-body h3,
        .card-body p {
            color: #000; /* hoặc color: black; */
        }
        .list-thetrang {
            list-style: none; /* Bỏ dấu chấm mặc định */
            padding-left: 0;
            margin: 0;
            font-size: 17px;
        }
        /* CHATBOT */
        .chat-container {
                position: fixed;
                bottom: 40px;
                right: 30px;
                width: 350px;
                background-color: white;                 
                border: 1px solid #ddd;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                border-radius: 10px;
                overflow: hidden;
                display: none; /* Ẩn mặc định, chỉ hiển thị khi nhấn vào */
                z-index: 9000; /* Giảm giá trị nếu popup có giá trị cao hơn */
            }
           

            /* Tiêu đề chatbot */
            .chat-container h2 {
                background-color: #28a745;
                color: white;
                padding: 12px;
                margin: 0;
                text-align: center;
                font-size: 18px;
                font-weight: bold;
                border-radius: 10px 10px 0 0;
            }

            /* Khu vực chat */
            .chat-box {
                height: 250px;
                overflow-y: auto;
                padding: 10px;
                background-color: #f9f9f9;
                display: flex;
                flex-direction: column;
                gap: 10px;
                max-height: 300px;

                /* Thêm font mặc định rõ ràng */
                font-family: 'Segoe UI', sans-serif;
                font-size: 14px;
                color: #222; /* màu mặc định rõ ràng */
            }

            /* Ô nhập tin nhắn */
            .input-box {
                width: calc(100% - 60px);
                padding: 10px;
                border: 1px solid #ddd;
                border-radius: 5px;
                margin: 10px 5px;
            }

            /* Nút gửi */
            button.gui {
                padding: 10px;
                background-color:rgb(224, 155, 71);
                color: white;
                border: none;
                border-radius: 5px;
                cursor: pointer;
                font-size: 14px;
            }

            /* Nút gửi hover */
            button.gui[type=submit]:hover {
                background-color:rgb(162, 117, 11);
            }

            /* Hiển thị icon chatbot */
            .custom-chat-icon {
                position: fixed;
                bottom: 40px;
                right: 40px;
                width: 70px;
                height: 70px;
                /* background-color: #25D366; */
                background-color: white;
                padding: 15px;
                color: white;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 24px;
                cursor: pointer;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
                z-index: 1000; /* Đảm bảo cao hơn footer */
            }
            .custom-chat-icon img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                border-radius: 50%;
            }

            /* Nút đóng chat */
            .custom-chat-close {
                position: absolute;
                top: 8px;
                right: 12px;
                cursor: pointer;
                font-size: 18px;
                color: white;
            }

            /* Định dạng chung */
            .chat {
                max-width: 75%;
                padding: 10px 14px;
                border-radius: 10px;
                word-wrap: break-word;
                line-height: 1.5;
                font-weight: 500;
            }

            /* Tin nhắn của user bên phải */
            .chat.user {
                 align-self: flex-end;
                background-color: #25D366;
                color: white; /* CHỮ TRẮNG trên nền xanh đậm */
                text-align: right;
                font-size: 16px;
            }

            /* Tin nhắn của bot bên trái */
            .chat.bot {
                background-color: #e9ecef;
                color: #222 !important;
                
                padding: 10px;
                border-radius: 10px;
                border: 1px solid #ccc;
                opacity: 1 !important;
                font-size: 16px;
            }
       
    </style>
</head>
<body>
    <main>
        <?php
            if (isset($spct) && is_array($spct)) {
                // Kiểm tra trạng thái sản phẩm
                if ($spct['SP_TRANGTHAI'] === 'Còn kinh doanh') {
                echo '
                <div class="container mt-5">
                    <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card h-100 product-card custom-product-card product-detail-box" data-id="' . htmlspecialchars($spct['SP_MASP']) . '">
                        <div class="row g-4 align-items-center">
                            <div class="col-md-5 image-wrapper">
                                <a href="index.php?act=chitiet&msp=' . htmlspecialchars($spct['SP_MASP']) . '">
                                    <img src="./images/' . htmlspecialchars($spct['SP_HINH']) . '" class="i product-img" alt="' . htmlspecialchars($spct['SP_TENSP']) . '">
                                </a>
                            </div>
                            <div class="col-md-7">
                                <div class="card-body">
                                    <h3 class="card-title">' . htmlspecialchars($spct['SP_TENSP']) . '</h3>
                                    <p class="card-text old-price d-none"><strong>Giá cũ: </strong>0đ</p>
                                    <p class="card-text"><strong>Giá: </strong>' . htmlspecialchars($spct['DG_GIAMOI']) . 'đ/<span class="donvi">' . htmlspecialchars($spct['SP_DONVI']) . '</span></p>
                                    <p class="card-text"><strong>Số lượng còn lại:</strong> ' . htmlspecialchars($spct['SP_SLTON']) . '</p>
                                    
                                    <div class="form-group mb-3">
                                        <label for="soluong-' . htmlspecialchars($spct['SP_MASP']) . '">Số lượng:</label>
                                        <input type="number" id="soluong-' . htmlspecialchars($spct['SP_MASP']) . '" name="sl" min="1" max="' . htmlspecialchars($spct['SP_SLTON']) . '" value="1" class="form-control w-40">
                                    </div>';
                                    
                                    if (isset($_SESSION['idcustomer'])) {
                                        echo '<input onclick="themVaoGio(' . $spct['SP_MASP'] . ')" type="submit" value="Mua" name="addcart" class="btn btn-primary">';
                                    } else {
                                        echo '<input onclick="thevaogiohang(this)" type="submit" value="Mua" name="addcart" class="btn btn-primary">';
                                    }

                                echo '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> ';    

                       echo '
                       <hr class= "custom-hr mt-2 mb-4">
                        <div class="tab-buttons d-flex justify-content-center gap-3 mb-3">
                            <button class="btn btn-outline-success active" onclick="showTab(\'mota\', this)">Mô tả sản phẩm</button>
                            <button class="btn btn-outline-success" onclick="showTab(\'danhgia\', this)">Nhân xét & đánh giá</button>
                        </div>
                        ';


                  
              echo'      <div id="mota" class="tab-content">
                            <div class="col-12 mt-4">
                              
                                <p class="product-description custom-product-description">
                                '.$spct['SP_MOTA'].'
                                </p>

                            </div>
                            <hr>';
                            if (!empty($thetrang)) {
                                echo '<div class="mt-4 ">';
                                echo '<h4>Phù hợp với thể trạng:</h4>';
                                echo '<ul class="list-thetrang">';
                                foreach ($thetrang as $tt) {
                                    echo '<li>✔️ ' . htmlspecialchars($tt['TTRANG_TEN']);
                                    if (!empty($tt['PH_MOTA'])) {
                                        echo ' – <em>' . htmlspecialchars($tt['PH_MOTA']) . '</em>';
                                    }
                                    echo '</li>';
                                }
                                echo '</ul></div>';
                            }
                   echo'         <hr>
                             <div class="col-12 mt-2">
                                <h4 class="mb-2">Thành phần dinh dưỡng</h4>      ';           
                               if ($dinhduong && is_array($dinhduong)) {
                                    echo "<ul class='list-thetrang'>";
                                    echo "<li>Năng lượng: " . $dinhduong['DD_CALO'] . " kcal</li>";
                                    echo "<li>Chất đạm: " . $dinhduong['DD_DAM'] . " g</li>";
                                    echo "<li>Chất béo: " . $dinhduong['DD_CHATBEO'] . " g</li>";
                                    echo "<li>Đường: " . $dinhduong['DD_DUONG'] . " g</li>";
                                    echo "<li>Natri: " . $dinhduong['DD_NATRI'] . " mg</li>";
                                    echo "<li>Chất xơ: " . $dinhduong['DD_CHATXO'] . " mg</li>";
                                    echo "</ul>";
                                } else {
                                    echo "<p><em>Không có thông tin dinh dưỡng cho sản phẩm này.</em></p>";
                                }

                  echo'         </div>
                    </div>';
                   
echo'<div id="danhgia" class="tab-content" style="display: none;">
    <div class="container">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="mt-3 mb-3">NHẬN XÉT</h2>';
                
                if (isset($reviews) && count($reviews) > 0) {
                    foreach ($reviews as $sp) {
                        echo '<div class="review">';
                        echo '<h5>' . htmlspecialchars($sp['TK_TENDANGNHAP']) . '</h5>';
                        echo '<p>Đánh giá: ' . str_repeat('⭐', $sp['DGSP_SOSAO']) . '</p>';
                        echo '<p>Nội dung: ' . htmlspecialchars($sp['DGSP_NOIDUNG']) . '</p>';
                        echo '<p>Ngày: ' . date('d/m/Y', strtotime($sp['DGSP_NGAYDANHGIA'])) . '</p>';
                        echo '</div>';
                    }
                        echo "<a href='index.php?act=all-danhgia&masp=" . $sp['SP_MASP'] . "' class='btn btn-outline-primary'>Xem tất cả đánh giá</a>";
                } else {
                    echo '<p class="text">Chưa có nhận xét nào.</p>';
                }
               
       echo'     </div>
        </div>
    </div>
</div>  '; ?>               
                 <!-- SẢN PHẨM LIÊN QUAN -->
                    <div class="row">
                        <div class="col-md-12">
                            <div style="text-align: center;">
                            <div class="featured-title">CÁC SẢN PHẨM LIÊN QUAN</div>
                        </div>
                        <div class="row">
                             <!-- <p class="card-text"><strong>Số lượng còn lại:</strong> ' . htmlspecialchars($spct['SL_TON']) . '</p> -->
             
       <?php         if (isset($related_products) && is_array($related_products)) {
                    foreach ($related_products as $product) {
                    
                        echo '
                        <div class="col-md-3 mb-4">
                            <div class="card h-100 product-card" data-id="' . htmlspecialchars($product['SP_MASP']) . '">
                                <a href="index.php?act=chitiet&msp=' . htmlspecialchars($product['SP_MASP']) . '">
                                    <img  src="./images/' . htmlspecialchars($product['SP_HINH']) . '" class="card-img-top" alt="' . htmlspecialchars($product['SP_TENSP']) . '">
                                </a>
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . htmlspecialchars($product['SP_TENSP']) . '</h5>
                                    <p class="card-text old-price d-none"><strong>Giá cũ: </strong>0đ</p>
                                    <p class="card-text"><strong>Giá: </strong>' . htmlspecialchars($product['DG_GIAMOI']) . 'đ/<span class="donvi">'.$product['SP_DONVI'].'</span></p>
                                    <p class="card-text"><strong>Số lượng còn lại:</strong> ' . htmlspecialchars($product['SP_SLTON']) . '</p>            
                                        <div class="form-group nho">
                                            <label for="soluong-' . htmlspecialchars($product['SP_MASP']) . '">Số lượng:</label>
                                            <input type="number" id="soluong-' . htmlspecialchars($product['SP_MASP']) . '" name="sl" min="1" max="' . htmlspecialchars($product['SP_SLTON']) . '" value="1" class="form-control">       
                                        </div>';                  
                                        if (isset($_SESSION['idcustomer'])){
                                            echo '<input onclick="themVaoGio('.$product['SP_MASP'].')" type="submit" value="Mua" name="addcart" class="btn btn-primary">';
                                       } else{
                                           echo' <input onclick="thevaogiohang(this)" type="submit" value="Mua" name="addcart" class="btn btn-primary">';
                                       }       
                                   
                             echo'</div>
                            </div>
                        </div>';
                    
                }
                } else {
                    echo '<p>Không có sản phẩm liên quan.</p>';
                }

                echo '
                            </div>
                        </div>
                    </div>
                </div>';
            }
            } else {
                echo '<div class="container mt-4"><p class="alert alert-danger">Không tìm thấy thông tin sản phẩm.</p></div>';
            }

?>
        <!-- đánh giá sản phẩm -->
        
        <!-- <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <h2 class = "mt -3 mb-3">Các đánh giá</h2>
                    
                    if (isset($reviews) && count($reviews) > 0) {
                       
                        foreach ($reviews as $sp) {
                            echo '<div class="review">';
                            echo '<h5>' . htmlspecialchars($sp['TK_TENDANGNHAP']) . '</h5>';
                            echo '<p>Đánh giá: ' . htmlspecialchars($sp['DGSP_SOSAO']) . ' sao</p>';
                            echo '<p>Nội dung: ' . htmlspecialchars($sp['DGSP_NOIDUNG']) . '</p>';
                            echo '<p>Thời gian: ' . htmlspecialchars($sp['DGSP_NGAYDANHGIA']) . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p class="text">Chưa có nhận xét nào.</p>'; // Thêm thông báo khi không có đánh giá
                    }
                    ?>
                </div>
            </div>
        </div> -->
<!-- CHATBOT -->
          <div class="chat-container">
                <h2>Chat với Bot</h2>
                <div class="chat-box" id="chatBox"></div>
                <form id="chatForm">
                    <input type="text" id="userInput" class="input-box" placeholder="Nhập tin nhắn..." required>
                    <!-- <button id="micro-icon" type="button"><i class="fa-solid fa-microphone "></i></button> -->
                    <button class="gui" type="submit">Gửi</button>
                </form>
        </div>
    </main>

   <script>
        function showTab(tabId, button) {
            // Ẩn cả hai tab
            document.getElementById('mota').style.display = 'none';
            document.getElementById('danhgia').style.display = 'none';

            // Hiện tab được chọn
            document.getElementById(tabId).style.display = 'block';

            // Gỡ class 'active' khỏi tất cả nút
            const buttons = document.querySelectorAll('.tab-buttons button');
            buttons.forEach(btn => btn.classList.remove('active'));

            // Thêm class active vào nút đang click
            button.classList.add('active');
        }

//         // chatbox
//         function toggleChatbox() {
//         const chatbox = document.getElementById('chatbox');
//         chatbox.style.display = (chatbox.style.display === 'none' || chatbox.style.display === '') ? 'flex' : 'none';
//     }

//     function sendChat() {
//     const input = document.getElementById('chat-input');
//     const messages = document.getElementById('chat-messages');
//     const question = input.value.trim();
//     if (!question) return;

//     // Thêm câu hỏi người dùng
//     // messages.innerHTML += `<div><strong>Bạn:</strong> ${question}</div>`;
//     messages.innerHTML += `<div class="message user"><strong>Bạn:</strong> ${question}</div>`;


//     // Hiện dòng đang trả lời
//     const typingId = 'typing-indicator';
//     messages.innerHTML += `<div id="${typingId}"><em>Bot đang trả lời...</em></div>`;
//     messages.scrollTop = messages.scrollHeight;
//     input.value = '';

//     // Gửi tới chatbot.php
//     fetch("view/chatbot.php", {
//     method: "POST",
//     headers: {
//         'Content-Type': 'application/x-www-form-urlencoded',
//         'X-Requested-With': 'XMLHttpRequest'
//     },
//     body: `question=${encodeURIComponent(question)}`
// })
// .then(res => res.json())
// .then(data => {
//     const typingDiv = document.getElementById(typingId);
//     if (typingDiv) typingDiv.remove();

//     messages.innerHTML += `<div><strong>Bot:</strong> ${data.answer || "Không có phản hồi."}</div>`;
//     messages.scrollTop = messages.scrollHeight;
// })
// .catch(error => {
//     const typingDiv = document.getElementById(typingId);
//     if (typingDiv) typingDiv.remove();

//     // messages.innerHTML += `<div><strong>Bot:</strong> ❌ Đã xảy ra lỗi khi kết nối.</div>`;
//     // const formattedAnswer = (data.answer || "Không có phản hồi.").replace(/\n/g, "<br>");
//     // messages.innerHTML += `<div><strong>Bot:</strong> ${formattedAnswer}</div>`;
//     const formattedAnswer = (data.answer || "Không có phản hồi.")
//     .replace(/\n/g, "<br>")
//     .replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>");

//     messages.innerHTML += `<div class="message bot"><strong>Bot:</strong> ${formattedAnswer}</div>`;



// });

//}
</script>


<script>
         
            document.getElementById("chatForm").onsubmit = async function (e) {
            e.preventDefault();
            let userMessage = document.getElementById("userInput").value;
            let chatBox = document.getElementById("chatBox");

            // Hiển thị tin nhắn của user trong div riêng
            chatBox.innerHTML += `<div class="chat user" id="textbox"><div><strong>Bạn:</strong> ${userMessage}</div></div>`;

            // Gửi tin nhắn đến PHP để gọi Rasa API
            let response = await fetch("view/chatbot-rasa.php", {
                method: "POST",
                body: new URLSearchParams({ message: userMessage }),
                headers: { "Content-Type": "application/x-www-form-urlencoded" }
            });

            let botReplies = await response.text();

            // Hiển thị tin nhắn bot trong div riêng
            // chatBox.innerHTML += `<div class="chat bot">${botReplies}</div>`;
            chatBox.innerHTML += `<div class="chat bot"><strong>Bot:</strong> ${botReplies}</div>`;



            document.getElementById("userInput").value = "";
            chatBox.scrollTop = chatBox.scrollHeight;
        };

            //bật/tắt chatbot
            document.addEventListener("DOMContentLoaded", function() {
            const chatContainer = document.querySelector(".chat-container");
            const chatIcon = document.createElement("div");
            
            chatIcon.classList.add("custom-chat-icon");
            // Thêm hình ảnh vào icon
            const img = document.createElement("img");
            img.src = "images/chatbot2.jpg";  // Thay bằng đường dẫn ảnh của bạn
            img.alt = "Chat Icon";
            img.style.width = "140%";  
            img.style.height = "140%";  
            img.style.borderRadius = "50%"; 


            chatIcon.appendChild(img);
            document.body.appendChild(chatIcon);
            
            chatIcon.addEventListener("click", function() {
                chatContainer.style.display = "block";
                chatIcon.style.display = "none";
            });

            const closeButton = document.createElement("span");
            closeButton.classList.add("custom-chat-close");
            closeButton.innerHTML = "✖";
            chatContainer.prepend(closeButton);

            closeButton.addEventListener("click", function() {
                chatContainer.style.display = "none";
                chatIcon.style.display = "flex";
        });
    });

           

    </script>

</body>
</html>