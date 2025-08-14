<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Document</title>
    <style>
        main {
            flex: 1;
            margin-top: 170px;
        }
        .card-img-top {
            /* height: 200px; /* hoặc 180px, tùy thiết kế 
            object-fit: cover;
            width: 100%;
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem; */
            width: 100%;
            height: 200px;
            object-fit: contain;
            padding: 5px;
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
        .product-card p{
            color: black;
            font-size: 16px;
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
    </style>
</head>
<body>
    <main>
      
 <?php
     echo '<div class="container mt-3">
     <div style="text-align: center;">
                            <div class="featured-title">Sản phẩm thuộc danh mục '.$name_dm.'</div>
                        </div>
     
      <div class="row">';
      if(isset($dssp) && is_array($dssp) && count($dssp) > 0) {
        $hasProduct = false; // Biến để kiểm tra xem có sản phẩm nào hiển thị không
    foreach ($dssp as $sp) {
      if (isset($sp['DM_TRANGTHAI']) && $sp['DM_TRANGTHAI'] === 'Còn kinh doanh') {
        $hasProduct = true; // Đánh dấu rằng có ít nhất 1 sản phẩm hiển thị
        echo '<div class="col-lg-3 col-md-4 col-sm-6 mb-3 mt-4">
                        <div class="card product-card" data-id="' . htmlspecialchars($sp['SP_MASP']) . '">
                            <a href="index.php?act=chitiet&msp=' . htmlspecialchars($sp['SP_MASP']) . '">
                                <img src="./images/' . htmlspecialchars($sp['SP_HINH']) . '" class="card-img-top" alt="' . htmlspecialchars($sp['SP_TENSP']) . '">
                            </a>
                            <div class="card-body text-center">
                                    <h5 class="card-title">' . htmlspecialchars($sp['SP_TENSP']) . '</h5>
                                    <p class="card-text old-price d-none"><strong>Giá cũ: </strong>0đ</p>
                                    <p class="card-text"><strong>Giá: </strong>' . htmlspecialchars($sp['DG_GIAMOI']) . 'đ/<span class="donvi">'.$sp['SP_DONVI'].'</span></p>
                                    <p class="card-text"><strong>Số lượng còn lại:</strong> ' . htmlspecialchars($sp['SP_SLTON']) . '</p>  
                                        <div class="form-group nho">
                                            <label for="soluong-' . htmlspecialchars($sp['SP_MASP']) . '">Số lượng:</label>
                                            <input type="number" id="soluong-' . htmlspecialchars($sp['SP_MASP']) . '" name="sl" min="1" max="' . htmlspecialchars($sp['SP_SLTON']) . '" value="1" class="form-control">
                                        </div>';                             
                                       if (isset($_SESSION['idcustomer'])){
                                            echo '<input onclick="themVaoGio('.$sp['SP_MASP'].')" type="submit" value="Mua" name="addcart" class="btn btn-primary">';
                                       } else{
                                           echo' <input onclick="thevaogiohang(this)" type="submit" value="Mua" name="addcart" class="btn btn-primary">';
                                       }                          
                          echo'      </div>
                        </div>
                    </div>';
    }
  }
  // Nếu không có sản phẩm nào được hiển thị
  if (!$hasProduct) {
    echo '<p style="text-align: center; color: #fd7e14; font-size: 20px;">Hiện danh mục không có sản phẩm</p>';


}
}
    echo '</div></div>';
?>

<!-- CHATBOT LLAMA3-->
         <!-- Nút mở chatbot -->
        <!-- <div id="chat-icon" onclick="toggleChatbox()">
        <img src="images/chatbot2.jpg" alt="Chatbot">
        </div> -->

        <!-- Khung chatbot -->
        <!-- <div id="chatbox">
        <div class="chat-header">
            <span>Chat với Bot</span>
            <span class="close-btn" onclick="toggleChatbox()">✖</span>
        </div>
        <div id="chat-messages"></div>
        <div class="chat-input-area">
            <input type="text" id="chat-input" placeholder="Nhập câu hỏi...">
            <button onclick="sendChat()">Gửi</button>
        </div>
        </div> -->

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
    <!-- CHATBOT -->
<!-- <script>
    function toggleChatbox() {
        const chatbox = document.getElementById('chatbox');
        chatbox.style.display = (chatbox.style.display === 'none' || chatbox.style.display === '') ? 'flex' : 'none';
    }

    function sendChat() {
    const input = document.getElementById('chat-input');
    const messages = document.getElementById('chat-messages');
    const question = input.value.trim();
    if (!question) return;

    // Thêm câu hỏi người dùng
    // messages.innerHTML += `<div><strong>Bạn:</strong> ${question}</div>`;
    messages.innerHTML += `<div class="message user"><strong>Bạn:</strong> ${question}</div>`;


    // Hiện dòng đang trả lời
    const typingId = 'typing-indicator';
    messages.innerHTML += `<div id="${typingId}"><em>Bot đang trả lời...</em></div>`;
    messages.scrollTop = messages.scrollHeight;
    input.value = '';

    // Gửi tới chatbot.php
    fetch("view/chatbot.php", {
    method: "POST",
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
        'X-Requested-With': 'XMLHttpRequest'
    },
    body: `question=${encodeURIComponent(question)}`
})
.then(res => res.json())
.then(data => {
    const typingDiv = document.getElementById(typingId);
    if (typingDiv) typingDiv.remove();

    messages.innerHTML += `<div><strong>Bot:</strong> ${data.answer || "Không có phản hồi."}</div>`;
    messages.scrollTop = messages.scrollHeight;
})
.catch(error => {
    const typingDiv = document.getElementById(typingId);
    if (typingDiv) typingDiv.remove();

    // messages.innerHTML += `<div><strong>Bot:</strong> ❌ Đã xảy ra lỗi khi kết nối.</div>`;
    // const formattedAnswer = (data.answer || "Không có phản hồi.").replace(/\n/g, "<br>");
    // messages.innerHTML += `<div><strong>Bot:</strong> ${formattedAnswer}</div>`;
    const formattedAnswer = (data.answer || "Không có phản hồi.")
    .replace(/\n/g, "<br>")
    .replace(/\*\*(.*?)\*\*/g, "<strong>$1</strong>");

    messages.innerHTML += `<div class="message bot"><strong>Bot:</strong> ${formattedAnswer}</div>`;



});

}

</script> -->

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