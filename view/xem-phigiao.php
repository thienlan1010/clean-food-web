<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        main{
            margin-top: 200px;
        }
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

        /* Hình ảnh */
        table td img {
            border-radius: 4px;
            object-fit: cover;
        }

        /* Hover dòng */
        table tr:hover {
            background-color: #f1f1f1;
        }
        .h2fee{
            margin-bottom: 15px;
            text-align: center;
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
        <div class="container">
            <div class="row">
                <h2 class="h2fee">Phí giao hàng</h2>
           
        <?php 
                if(isset($phi) && (count($phi) > 0))  {
                  echo'  <table>
                        <tr class="text-center">
                                <th>STT</th>  
                                <th>Khoảng cách từ</th>                          
                                <th>Đến khoảng cách</th>
                                <th>Trọng lượng từ</th>
                                <th>Đến trọng lượng</th>
                                <th>Phí giao</th>
                                <th>Ngày áp dụng</th>                              
                        </tr>';
                        
                                $i=1;
                                foreach ($phi as $pg) {
                                    echo '<tr class="text-center mb-2">
                                            <td>'.$i.'</td>                                        
                                            <td>'.$pg['KC_CANTREN'].'km</td>
                                            <td>'.$pg['KC_CANDUOI'].'km</td>
                                            <td>'.number_format($pg['TL_CANTREN'], 0, ',', '.').'g</td>
                                            <td>'.number_format($pg['TL_CANDUOI'], 0, ',', '.').'g</td>
                                            <td>' . number_format($pg['PG_DONGIA'], 0, ',', '.') . 'đ</td>
                                            <td>'.$pg['PG_NGAYAPDUNG'].'</td>
                                            </td>
                                        </tr>';
                                        $i++;
                                }
                            }
                            ?>                                                      
                    </table>
                  
                        <!-- Phân trang -->
                         <?php if ($total_pages > 1): ?>
                        <div class="text-center mt-4">
                            <nav>
                                <ul class="pagination justify-content-center">
                                    <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                                        <li class="page-item <?= ($p == $page) ? 'active' : '' ?>">
                                            <a class="page-link" href="index.php?act=xem-fee&page=<?= $p ?>"><?= $p ?></a>
                                        </li>
                                    <?php endfor; ?>
                                </ul>
                            </nav>
                        </div>
                    <?php endif; ?>
                     </div>
        </div>
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