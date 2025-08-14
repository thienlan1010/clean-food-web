<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        
        main{
              flex: 1; /* tương ứng với chiều cao của header */
              margin-top: 170px;
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

        /* Tên sản phẩm */
        .product-card .card-title {
            font-size: 20px;
            font-weight: 600;
            color: #222;
            margin: 5px 0;
        }

        /* Giá */
        .product-card .card-text {
            font-size: 0.95rem;
            color:black;

            margin: 3px 0;
        }
        .text{
            color: black;
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
        .donvi{
            font-size: 13px;
            font-weight: 400;
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
        /**tiêu đề tìm kiếm */
        /**tiêu đề */
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
    </style>
</head>
<body>
    <main>


<!-- tìm kiếm sản phẩm -->
<?php
 echo '<div class="container mt-3">
            <div style="text-align: center;">
                <div class="featured-title">Kết quả tìm kiếm</div>
             </div>
        <div class="row">';
// Biến để kiểm tra số lượng sản phẩm còn hàng
$hasAvailableProducts = false;

 if(count($dstk) > 0){
    //   echo '<div class="row d-flex justify-content-center">'; // Ra ngoài vòng lặp
    foreach ($dstk as $sp) {
    if (isset($sp['SP_TRANGTHAI']) && $sp['SP_TRANGTHAI'] === 'Còn kinh doanh') {
        $hasAvailableProducts = true; // Đặt cờ thành true nếu có sản phẩm còn hàng
             echo '
       
                        <div class="col-lg-3 col-md-4 col-sm-6 mb-3 mt-4">
                            <div class="card product-card" data-id="' . htmlspecialchars($sp['SP_MASP']) . '">
                                <a href="index.php?act=chitiet&msp=' . htmlspecialchars($sp['SP_MASP']) . '">
                                    <img src="./images/' . htmlspecialchars($sp['SP_HINH']) . '" class="card-img-top" alt="' . htmlspecialchars($sp['SP_TENSP']) . '">
                                </a>
                               
                                <div class="card-body text-center">
                                    <h5 class="card-title">' . htmlspecialchars($sp['SP_TENSP']) . '</h5>
                                    <p class="card-text old-price d-none"><strong>Giá cũ: </strong>0đ</p>
                                    <p class="card-text"><strong>Giá: </strong>' . htmlspecialchars($sp['DG_GIAMOI']) . 'đ/<span class="donvi">'.$sp['SP_DONVI'].'</span></p>
                                    <p class="card-text"><strong>Số lượng còn lại:</strong> ' . htmlspecialchars($sp['SP_SLTON']) . '</p>            
                                   
                                    <input type="hidden" name="id" value="' . htmlspecialchars($sp['SP_MASP']) . '">
                                        <input type="hidden" name="tensp" value="' . htmlspecialchars($sp['SP_TENSP']) . '">
                                        <input type="hidden" name="gia" value="' . htmlspecialchars($sp['DG_GIAMOI']) . '">
                                        <input type="hidden" name="hinh" value="' . htmlspecialchars($sp['SP_HINH']) . '">
                                        <div class="form-group nho">
                                            <label for="soluong-' . htmlspecialchars($sp['SP_MASP']) . '">Số lượng:</label>
                                            <input type="number" id="soluong-' . htmlspecialchars($sp['SP_MASP']) . '" name="sl" min="1" max="' . htmlspecialchars($sp['SP_SLTON']) . '" value="1" class="form-control">
                                        </div>';                
                                        if (isset($_SESSION['idcustomer'])){
                                            echo '<input onclick="themVaoGio('.$sp['SP_MASP'].')" type="submit" value="Mua" name="addcart" class="btn btn-primary">';
                                       } else{
                                           echo' <input onclick="thevaogiohang(this)" type="submit" value="Mua" name="addcart" class="btn btn-primary">';
                                       }    
                                   
                    echo'            </div>
                            </div>
                        </div>';
        }
    }
} 
// Chỉ hiển thị thông báo nếu không có sản phẩm nào còn hàng
if (count($dstk) === 0 || !$hasAvailableProducts) {// nếu ko co sp nào trả về và ko có sản phẩm
    echo "<p class='text-center my-4 text'>Không tìm thấy sản phẩm nào khớp với từ khóa tìm kiếm.</p>";
}

echo '</div></div>';
 ?>
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