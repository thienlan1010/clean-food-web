<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .review-container {
            max-width: 700px;
            margin: 40px auto;
            padding: 25px;
            background: #f9f9f9;
            border-radius: 15px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }

        .review-header {
            display: flex;
            align-items: center;
        }

        .review-header img {
            width: 120px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            margin-right: 20px;
        }

        .product-name {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .review-stars {
            color: #ffcc00;
            font-size: 20px;
            margin-top: 8px;
        }

        .review-content {
            margin-top: 20px;
            font-size: 16px;
        }

        .review-time {
            margin-top: 15px;
            font-size: 14px;
            color: #666;
        }
        main {
            margin-top: 170px;
        }
         .page-title {
            font-size: 30px;
            text-align: center;
            margin: 10px 0 30px;
            color: #000;
        }

    </style>
</head>
<body>
    <main>
         <div class="review-container">
            <h3 class="page-title">Nội dung đánh giá</h3>
        <div class="review-header">
            <img src="images/<?= htmlspecialchars($review['SP_HINH']) ?>" alt="<?= htmlspecialchars($review['SP_TENSP']) ?>">
            <div>
                <div class="product-name"><?= htmlspecialchars($review['SP_TENSP']) ?></div>
                <div class="review-stars">
                    <?php
                        $stars = (int)$review['DGSP_SOSAO'];
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $stars ? '<i class="fas fa-star"></i>' : '<i class="far fa-star"></i>';
                        }
                    ?>
                </div>
            </div>
        </div>

        <div class="review-content">
            <?= nl2br(htmlspecialchars($review['DGSP_NOIDUNG'])) ?>
        </div>

        <div class="review-time">
            Thời gian đánh giá: <?= date('d/m/Y H:i', strtotime($review['DGSP_NGAYDANHGIA'])) ?>
        </div>
    </div>
</main>
</body>
</html>