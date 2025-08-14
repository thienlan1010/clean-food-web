<!-- <!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quét mã QR</title>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script type="module">
        import QrScanner from "https://unpkg.com/qr-scanner@1.4.2/qr-scanner.min.js";

        window.addEventListener("DOMContentLoaded", () => {
            const imageInput = document.getElementById('qr-image');
            const imageResult = document.getElementById('image-result');

            imageInput.addEventListener('change', async (event) => {
                const file = event.target.files[0];
                if (!file) return;

                const result = await QrScanner.scanImage(file, { returnDetailedScanResult: true }).catch(() => null);

                if (result) {
                    const qrText = result.data;
                    imageResult.innerHTML = `✅ Mã ảnh: <a href="${qrText}" target="_blank">${qrText}</a>`;
                    window.location.href = qrText;
                } else {
                    imageResult.textContent = "❌ Không tìm thấy mã QR trong ảnh.";
                }
            });
        });
    </script>
    <style>
        body { font-family: Arial; padding: 20px; }
        h2 { margin-bottom: 10px; }
        #reader { width: 300px; margin-top: 20px; }
        #result, #image-result { margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>

<h2>📷 Quét mã QR từ hóa đơn</h2>
<p>➤ Đưa camera vào mã QR để tích điểm.</p>

<div id="reader"></div>
<div id="result"></div>

<hr>

<h3>🖼️ Hoặc tải ảnh QR từ máy tính:</h3>
<input type="file" id="qr-image" accept="image/*">
<div id="image-result"></div>

<script>
    const scanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });

    scanner.render((decodedText, decodedResult) => {
        document.getElementById("result").innerHTML = `✅ Mã quét được: <a href="${decodedText}" target="_blank">${decodedText}</a>`;
        window.location.href = decodedText;
        scanner.clear();
    });
</script>

</body>
</html> -->
<?php
session_start();
include "view/header.php";
?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Quét mã QR</title>
  <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
  <script type="module">
    import QrScanner from "https://unpkg.com/qr-scanner@1.4.2/qr-scanner.min.js";

    window.addEventListener("DOMContentLoaded", () => {
      const imageInput = document.getElementById('qr-image');
      const imageResult = document.getElementById('image-result');

      imageInput.addEventListener('change', async (event) => {
        const file = event.target.files[0];
        if (!file) return;

        const result = await QrScanner.scanImage(file, { returnDetailedScanResult: true }).catch(() => null);

        if (result) {
          const qrText = result.data;
          imageResult.innerHTML = `✅ Mã ảnh: <a href="${qrText}" target="_blank">${qrText}</a>`;
          window.location.href = qrText;
        } else {
          imageResult.textContent = "❌ Không tìm thấy mã QR trong ảnh.";
        }
      });
    });
  </script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
      font-family: Arial, sans-serif;
    }
    main{
        margin-top: 170px;
    }
    h2, h3 {
      color: #343a40;
    }
    #reader {
      width: 100%;
      max-width: 350px;
      margin: 20px auto;
    }
    #result, #image-result {
      margin-top: 15px;
      font-weight: bold;
      color: #198754;
      text-align: center;
    }
    .file-upload {
      text-align: center;
      margin-top: 30px;
    }
    input[type="file"] {
      margin-top: 10px;
    }
    hr {
      margin: 40px 0;
    }
  </style>
</head>
<body>
<main>
<div class="container text-center">
  <h2>📷 Quét mã QR từ hóa đơn</h2>
  <p class="text-muted">➤ Đưa camera vào mã QR để tích điểm.</p>

  <div id="reader"></div>
  <div id="result"></div>

  <hr>

  <!-- <div class="file-upload">
    <h3>🖼️ Hoặc tải ảnh QR từ máy tính</h3>
    <input type="file" id="qr-image" accept="image/*" class="form-control w-50 mx-auto">
    <div id="image-result"></div>
  </div> -->
</div>

<script>
  const scanner = new Html5QrcodeScanner("reader", { fps: 10, qrbox: 250 });

  scanner.render((decodedText, decodedResult) => {
    document.getElementById("result").innerHTML = `✅ Mã quét được: <a href="${decodedText}" target="_blank">${decodedText}</a>`;
    window.location.href = decodedText;
    scanner.clear();
  });
</script>
</main>
</body>
</html>
<?php
    include "view/footer.php";
?>