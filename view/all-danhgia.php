<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        main {
            margin-top: 180px;
        }
    </style>
</head>
<body>
    <main>
         <div class="container">
        <h2 class="mb-4 text-center">Tất cả đánh giá sản phẩm <?php echo $tensp?></h2>
        <!-- TÓM GỌN ĐÁNH GIÁ -->
        <?php
        $total_reviews = $avg_data['total'];
        $avg_star = round($avg_data['avg_star'], 1);
        ?>
        <div style="display: flex; align-items: center; gap: 40px; margin-top: 20px;">
            <!-- Bên trái: trung bình sao -->
            <div style="min-width: 190px; text-align: center;">
                <div style="font-size: 36px; font-weight: bold; color: #111;">
                    ⭐ <?= $avg_star ?>/5
                </div>
                <div style="color: gray; font-size: 15px;">
                    <?= number_format($total_reviews) ?> đánh giá
                </div>
            </div>

            <!-- Bên phải: thanh đánh giá -->
            <div style="flex: 1;">
                <?php for ($i = 5; $i >= 1; $i--): 
                    $count = $stats[$i] ?? 0;
                    $percent = ($total_reviews > 0) ? round(($count / $total_reviews) * 100, 1) : 0;
                ?>
                <div style="display: flex; align-items: center; margin-bottom: 8px;">
                    <span style="width: 20px; font-size: 15px;"><?= $i ?></span>
                    <span style="color: orange; font-size: 15px; margin-left: 4px;">★</span>
                    <div style="flex: 1; background-color: #eee; border-radius: 10px; margin: 0 10px; height: 8px;">
                        <div style="width: <?= $percent ?>%; background-color: #66b3ff; height: 100%; border-radius: 10px;"></div>
                    </div>
                    <span style="width: 50px; text-align: right;"><?= $percent ?>%</span>
                </div>
                <?php endfor; ?>
            </div>
        </div>

        <!-- Bộ lọc đánh giá -->
        <form method="get" class="mb-4 d-flex justify-content-left">
            <input type="hidden" name="act" value="all-danhgia">
            <input type="hidden" name="masp" value="<?= htmlspecialchars($idsp) ?>">
            <label class="me-2">Lọc theo sao:</label>
            <select name="sao" onchange="this.form.submit()" class="form-select w-auto">
                <option value="">Tất cả</option>
                <?php for ($i = 5; $i >= 1; $i--): ?>
                    <option value="<?= $i ?>" <?= (isset($_GET['sao']) && $_GET['sao'] == $i) ? 'selected' : '' ?>>
                        <?= $i ?> sao
                    </option>
                <?php endfor; ?>
            </select>
        </form>

        <!-- Hiển thị danh sách đánh giá -->
        <?php if (!empty($reviews)): ?>
            <?php foreach ($reviews as $rv): ?>
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($rv['KH_HOTEN']) ?></h5>
                        <p class="card-text"><?= str_repeat('⭐', $rv['DGSP_SOSAO']) ?></p>
                        <p class="card-text" style="color: black;"><?= nl2br(htmlspecialchars($rv['DGSP_NOIDUNG'])) ?></p>
                        <p class="text-muted small">Ngày: <?= date('d/m/Y', strtotime($rv['DGSP_NGAYDANHGIA'])) ?></p>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center text-muted">Hiện tại chưa có đánh giá.</p>
        <?php endif; ?>

        <!-- Phân trang -->
        <?php if ($total_pages > 1): ?>
            <nav>
                <ul class="pagination justify-content-center mt-4">
                    <?php for ($p = 1; $p <= $total_pages; $p++): ?>
                        <li class="page-item <?= ($p == $page) ? 'active' : '' ?>">
                            <a class="page-link" href="index.php?act=all-danhgia&masp=<?= $idsp ?>&page=<?= $p ?><?= isset($_GET['sao']) ? '&sao=' . $_GET['sao'] : '' ?>">
                                <?= $p ?>
                            </a>
                        </li>
                    <?php endfor; ?>
                </ul>
            </nav>
        <?php endif; ?>
    </div>
    </main>
</body>
</html>