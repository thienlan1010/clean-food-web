<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .contact-info p{
            color: black;
        }
        .social-icons {
            display: flex;
            gap: 5px;
            margin-top: 10px;
        }
        .social-icons a {
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
        .social-icons a:hover {
            background-color: #fd7e14;
            /* màu cam nổi bật khi hover */
            color: white;
            transform: scale(1.1);
            border-color: #fff;
        }
        .rounder{
            border-radius: 10px;
        }
        .text-coler{
            /* color:rgb(81, 182, 14); */
            color: black;

        }
        main {
            flex: 1;
            margin-top: 170px;
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
    <!-- ✅ THÔNG BÁO SAU KHI GỬI FORM -->

    <!-- phần nội dung -->
    <main>
        <div class="container mt-3 bg-light rounder mb-5">
            <div class="row mb-4">
                <div class="col-md-12 text-center mt-3">
                    <h2 class="text-coler">Liên Hệ Với Chúng Tôi</h2>
                </div>
            </div>
            <!-- Liên hệ -->
            <div class="row">
                <!-- Phần Contact -->
                <div class="col-md-4 contact-info">
                    <p><i class="fa-solid fa-location-pin"></i> Địa chỉ: Phan Chu Trinh, P. Bến Thành, Quận 1, TP. Hồ Chí Minh</p>
                    <p><i class="fa-solid fa-envelope"></i> Email: Paionus@gmail.com</p>
                    <p><i class="fa-solid fa-phone"></i> SĐT: 0985632413</p>
                    <p><i class="fa-solid fa-share-alt"></i> Trang mạng xã hội</p>
                    <div class="social-icons">
                        <a href="#"><i class="fa-brands fa-youtube"></i></a>
                        <a href="#"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
    
                <!-- Phần Form -->
                <div class="col-md-8">
                    <form class="yeucau" action="index.php?act=thongbao" method="post">
                        <div class="mb-3">
                            <label for="name">Họ và tên:</label>
                            <input type="text" class="form-control" id="name" placeholder="Nhập tên" name="name" required>
                        </div>
                        <div class="mb-3">
                            <label for="sdt">Số điện thoại:</label>
                            <input type="tel" class="form-control" id="sdt" placeholder="Nhập số điện thoại" name="sdt" required>
                        </div>
                        <div class="mb-3">
                            <label for="email">Email:</label>
                            <input type="email" class="form-control" id="email" placeholder="Nhập email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="diachi">Địa chỉ:</label>
                            <input type="text" class="form-control" id="diachi" placeholder="Nhập địa chỉ" name="diachi" required>
                        </div>
                        <div class="mb-3">
                            <label for="comment">Nội dung:</label>
                            <textarea class="form-control" rows="5" id="comment" name="noidung" required></textarea>
                        </div>
                        <input type="submit" name="thong_bao" class="btn btn-primary" value="Gửi">
                    </form>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-4 mb-4">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d23763.527146003315!2d106.62834816545228!3d10.771438100972093!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31752dbd36514669%3A0xed26b43bf2268fab!2zVGjhu7FjIFBo4bqpbSBT4bqhY2g!5e0!3m2!1svi!2s!4v1754066213008!5m2!1svi!2s" 
                        width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe></iframe>
                </div>
            </div>
        </div>

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
  
    <!-- CHATBOT -->
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