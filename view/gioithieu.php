<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <title>Document</title>
    <style>
        .card {
            transition: all 0.3s ease;
            border: 1px solid #eee;
            border-radius: 12px;
        }

        .card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0, 0, 0, 0.1);
            border-color: #38d850;
        }

        .card-title {
            font-weight: bold;
            color: #333;
            transition: color 0.3s ease;
        }

        .card:hover .card-title {
            color: #fd7e14;
        }

        .card-text {
            color: #555;
            font-size: 15px;
            line-height: 1.6;
        }
        .text{
            color:rgb(7, 3, 0);
        }
        /**backgroud */
        .image-section {
            padding: 40px 20px;
            border-radius: 16px;
            /* box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); */
            margin-bottom: 40px;
            transition: background 0.4s ease;
        }


        .image-section img {
            border-radius: 12px;
            transition: transform 0.4s ease;
        }

        .image-section img:hover {
            transform: scale(1.03);
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
    <main>
        <div class="container">
            <div class="row mt-5">
                <div class="col-sm-5">
                    <img src="images/gt.jpg" alt="" width="450px" height="400px">
                </div>
                <div class="col-sm-7">
                    <h2>Chào Mừng Đến Với Website Của Chúng Tôi</h2><br>
                    <p class="text">Nơi cung cấp những sản phẩm tươi ngon, an toàn và giàu dinh dưỡng cho mọi gia đình. Với sứ mệnh mang đến bữa ăn chất lượng, chúng tôi cam kết chỉ cung cấp thực phẩm có nguồn gốc rõ ràng, không chất bảo quản, được kiểm định nghiêm ngặt trước khi đến tay người tiêu dùng. Hãy cùng chúng tôi xây dựng lối sống lành mạnh từ những điều đơn giản nhất – bắt đầu từ thực phẩm sạch mỗi ngày.

                    Chúng tôi không chỉ đơn thuần là một nơi bán hàng, mà là người bạn đồng hành đáng tin cậy trong hành trình chăm sóc sức khỏe của cả gia đình bạn. Đội ngũ của chúng tôi luôn nỗ lực tìm kiếm, chọn lọc và hợp tác với các nhà cung cấp uy tín, nhằm mang đến những sản phẩm chất lượng cao, thân thiện với môi trường và tốt cho sức khỏe.

                    Chúng tôi tin rằng sự hài lòng của khách hàng không chỉ đến từ chất lượng sản phẩm mà còn từ dịch vụ tận tâm, giao hàng nhanh chóng và hỗ trợ kịp thời. Mỗi sản phẩm được đóng gói kỹ lưỡng, giữ nguyên độ tươi ngon như vừa được hái từ nông trại.

                    Chọn chúng tôi là bạn đã chọn một lối sống lành mạnh, chọn sự an tâm và chọn những bữa cơm trọn vẹn cho gia đình mình.</p>
                </div>
                <!-- backgroud -->
                <div class="row image-section">
                    <div class="col-sm-6">
                        <img src="images/bg6.jpg" alt="" class="img-fluid rounded shadow">
                    </div>
                    <div class="col-sm-6">
                        <img src="images/bg7.jpg" alt="" class="img-fluid rounded shadow">
                    </div>
                </div>

                <div class="col-sm-12">
                    <h2 class="text-center mb-5">Tại sao chọn chúng tôi?</h2>
                </div>

                <div class="row mb-5">
                    <div class="col-sm-3 col-lg-3">
                        <div class="card text-center h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-truck text-warning me-2"></i>Vận chuyển</h5>
                                <p class="card-text">Chúng tôi hỗ trợ giao hàng nhanh chóng và tận nơi, đảm bảo thực
                                    phẩm đến tay khách hàng luôn tươi mới và an toàn.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <div class="card text-center h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-certificate text-warning me-2"></i>Chất lượng
                                </h5>
                                <p class="card-text">Tất cả sản phẩm đều được tuyển chọn kỹ lưỡng, đảm bảo đạt chuẩn an
                                    toàn vệ sinh thực phẩm và có nguồn gốc rõ ràng.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <div class="card text-center h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fa-solid fa-sack-dollar text-warning me-2"></i>Giá cả
                                </h5>
                                <p class="card-text">Giá cả hợp lý, cạnh tranh, phù hợp với mọi gia đình, đảm bảo chất
                                    lượng xứng đáng với từng đồng chi trả.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3 col-lg-3">
                        <div class="card text-center h-100 shadow-sm">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-handshake text-warning me-2"></i>Đối tác cung
                                    cấp</h5>
                                <p class="card-text">Chúng tôi hợp tác trực tiếp với các nông trại sạch, đạt tiêu chuẩn
                                    VietGAP và hữu cơ, không qua trung gian.</p>
                            </div>
                        </div>
                    </div>
                </div>
                

            </div>

        </div>

 <!-- chatbot -->
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