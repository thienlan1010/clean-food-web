<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <title>Tích điểm</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: #f8f9fa;
      font-family: 'Segoe UI', sans-serif;
    }
    main{
        margin-top: 120px;
    }
    .point-box {
      background: #fff;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 10px rgba(0,0,0,0.2);
      text-align: center;
      margin-top: 90px;
      margin-bottom: 30px;
    }
    .point-box h3 {
      color: #dc3545;
      margin-bottom: 20px;
    }
    .btn-scan {
      background-color: #198754;
      color: white;
      padding: 10px 20px;
      font-size: 16px;
      border-radius: 8px;
      transition: 0.3s;
    }
    .btn-scan:hover {
      background-color: #157347;
    }
  </style>
</head>
<body>

<main>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="point-box">
          <h3>Điểm đã tích lũy: <?php echo $diem_da_tich; ?></h3>
          <a href="scan_qr.php">
            <button class="btn btn-scan">📷 Quét mã để tích điểm</button>
          </a>
        </div>
      </div>
    </div>
  </div>
</main>

</body>
</html>
