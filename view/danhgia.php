<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        main {
            flex: 1;
            margin-top: 170px;
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
/**box sp */
body {
    margin: 0;
    padding: 0;
    background-color: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

.product-detail-box {
    display: flex;
    justify-content: center;
    align-items: center;
    max-width: 700px;
    min-height: 200px;
    margin: 30px auto; /* canh giữa trang */
    background-color: #fff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    gap: 30px;
}

.product-image-box {
    flex: 1;
}

.product-image {
    width: 100%;
    max-width: 400px;
    border-radius: 10px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

.product-info-box {
    flex: 1;
}

.product-name {
    font-size: 28px;
    font-weight: bold;
    color: #333;
    margin-bottom: 20px;
}

.product-price {
    font-size: 24px;
    color: #e91e63;
    font-weight: 600;
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

    </style>
</head>
<body>
   <main>
    <?php if (isset($info_sp) && is_array($info_sp)): ?>
        <?php if ($info_sp['SP_TRANGTHAI'] === 'Còn kinh doanh'): ?>
            <div class="container">
                <div style="text-align: center;">
                    <div class="featured-title">Nhận Xét Đánh Giá Sản Phẩm</div>
                </div>
                <div class="product-detail-box">
                    <div class="product-image-box">
                        <img src="./images/<?= htmlspecialchars($info_sp['SP_HINH']) ?>" alt="<?= htmlspecialchars($info_sp['SP_TENSP']) ?>" class="product-image">
                    </div>
                    <div class="product-info-box">
                        <h2 class="product-name"><?= htmlspecialchars($info_sp['SP_TENSP']) ?></h2>
                        <p class="product-price">Giá: <?= $info_sp['DG_GIAMOI']?>đ</p>
                    </div>
                </div>


                <hr>

                <div class="row mt-4 mb-5"   >
                    <div class="col-md-8">
                        <h3>Nhận xét và đánh giá</h3>
                        <?php if (isset($reviews) && count($reviews) > 0): ?>
                            <?php foreach ($reviews as $sp): ?>
                                <div class="review">
                                    <h5><?= htmlspecialchars($sp['TK_TENDANGNHAP']) ?></h5>
                                    <p>Đánh giá: <strong><?= htmlspecialchars($sp['DGSP_SOSAO']) ?> sao</strong></p>
                                    <p>Nội dung: <?= htmlspecialchars($sp['DGSP_NOIDUNG']) ?></p>
                                    <p class="text-muted">Thời gian: <?= htmlspecialchars($sp['DGSP_NGAYDANHGIA']) ?></p>
                                </div>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <p class="text-muted">Chưa có nhận xét nào.</p>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-4">
                        <div class="bg-white p-3 border rounded shadow-sm">
                            <p class="mb-3 text">Chúng tôi mong nhận được ý kiến của bạn để cải thiện chất lượng sản phẩm.</p>
                            <form action="index.php?act=xuly-nhanxet" method="POST">
                                <div class="mb-3">
                                    <label for="rating" class="form-label">Đánh giá:</label>
                                    <select class="form-select" id="rating" name="rating" required>
                                        <option value="5">5 sao</option>
                                        <option value="4">4 sao</option>
                                        <option value="3">3 sao</option>
                                        <option value="2">2 sao</option>
                                        <option value="1">1 sao</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="review" class="form-label">Nhận xét của bạn:</label>
                                    <textarea class="form-control" id="review" name="review" rows="4" required></textarea>
                                </div>
                                <input type="hidden" name="masp" value="<?= $masp?>">
                                <input type="hidden" name="madh" value="<?= htmlspecialchars($id) ?>">
                                <div style="text-align: center;">
                                    <input type="submit" name="guinhanxet" value="Gửi Nhận Xét" class="btn btn-success w-40">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php else: ?>
        <div class="container mt-4">
            <div class="alert alert-danger">Không tìm thấy thông tin sản phẩm.</div>
        </div>
    <?php endif; ?>
</main>

</body>
</html>