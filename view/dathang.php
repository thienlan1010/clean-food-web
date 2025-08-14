<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        
/* Bảng sản phẩm */
table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 30px;
}

table th, table td {
    padding: 12px;
    border: 1px solid #ddd;
    text-align: center;
}

table th {
    background-color:rgb(44, 207, 50);
    color: white;
    font-weight: bold;
}

.product-img {
    width: 60px;
    height: auto;
    border-radius: 6px;
}

    /* Tổng tiền */
    .total-label {
        text-align: right;
        font-weight: bold;
        background-color: #f0f0f0;
    }

    .total-amount {
        font-weight: bold;
        color: #e60000;
    }
        
        .box {
            max-width: 1000px;
            margin: 30px auto; 
            padding: 20px;
            background-color: #f9f9f9;
            border-radius: 12px;
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.1);
            font-family: 'Segoe UI', sans-serif;
           
        }
.text{
    color: #e60000;
    text-align: center;
    margin-bottom: 30px;
}
main{
    margin-top: 170px;
}
    </style>
</head>
<body>
    <main>
         <div class="container box">
            <div class="row">
                <h3 class="text">Đơn Hàng</h3>
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>     
                    </tr>
                    <?php
                        if ((isset($gh)) && (count($gh) > 0)) {
                        $i = 0;
                        $tong = 0;
                            foreach ($gh as $item) {    
                                    // $tt = $item['CTGH_SOLUONG'] * $item['CTGH_DONGIA'];
                                   $dongia = (float)str_replace('.', '', $item['CTGH_DONGIA']);

                                    $soluong = (int)$item['CTGH_SOLUONG'];
                                    $tt = $soluong * $dongia;

                                        $tong += $tt;
                                        echo '<tr>
                                                <td>' . ($i + 1) . '</td>
                                                <td>' . $item['SP_TENSP'] . '</td>
                                                <td><img src="./images/' . $item['SP_HINH'] . '" alt="product image" class="product-img"></td>
                                                <td>' . $item['CTGH_SOLUONG'] . '</td>                                               
                                                <td>' . number_format($dongia, 0, '', '.') . 'đ</td>                                                                     
                                            </tr>
                                            
                                            ';

                                    $i++;
                                }
                                echo '
                                            <tr>
                                                <td colspan="4" class="total-label">Tổng thanh toán</td>
                                                <td>' . $tongdonhang . 'đ</td>                                              
                                            </tr>';          
                            }
                    ?>
                                       
                </table>
                <div class="row">
                    <h3 class="text">Thông tin nhận hàng</h3>
                    <table>
                        <tr>
                            <td>Người nhận: <?= htmlspecialchars($info_donhang['DH_TENNGUOINHAN']); ?></td>
                        </tr>
                        <tr>
                            <td>SDT: <?= htmlspecialchars($info_donhang['DH_SDT']); ?></td>
                        </tr>
                        <tr>
                            <td>Địa chỉ: <?= htmlspecialchars($info_donhang['DH_DIACHINHAN']); ?></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const badge = document.querySelector('.cart-badge');
            if (badge) {
                badge.textContent = '0';
            }
        });
    </script>
</body>
</html> -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đơn hàng đã đặt thành công</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #f2f2f2;
            font-family: 'Segoe UI', sans-serif;
            margin: 0;
            padding: 0;
        }

        main {
            margin-top: 170px;
        }

        .box {
            max-width: 1300px;
            margin: 30px auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .text {
            text-align: center;
            color: #28a745;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th, table td {
            padding: 12px;
            border: 1px solid #dee2e6;
            text-align: center;
        }

        table th {
            background-color: #28a745;
            color: white;
            font-weight: 600;
        }

        .product-img {
            width: 60px;
            height: auto;
            border-radius: 4px;
        }

        .total-label {
            text-align: right;
            font-weight: bold;
            background-color: #f8f9fa;
        }

        .total-amount {
            font-weight: bold;
            color: #dc3545;
        }

        .shipping-info h3 {
            color: #007bff;
            margin-bottom: 20px;
            font-size: 20px;
        }

        .shipping-info table td {
            text-align: left;
            padding: 10px;
            background-color: #fdfdfd;
            border-left: 4px solid #007bff;
        }

        .thank-you {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: #555;
        }
    </style>
</head>
<body>
    <main>
        <div class="box">
            <h3 class="text">✅ Đơn hàng của bạn đã được đặt thành công!</h3>

            <table>
                <tr>
                    <th>STT</th>
                    <th>Tên sản phẩm</th>
                    <th>Hình</th>
                    <th>Số lượng</th>
                    <th>Đơn giá</th>
                </tr>
                <?php
                    if ((isset($gh)) && (count($gh) > 0)) {
                        $i = 0;
                        $tong = 0;
                        foreach ($gh as $item) {
                            $dongia = (float)str_replace('.', '', $item['CTGH_DONGIA']);
                            $soluong = (int)$item['CTGH_SOLUONG'];
                            $tt = $soluong * $dongia;
                            $tong += $tt;
                            echo '<tr>
                                    <td>' . ($i + 1) . '</td>
                                    <td>' . $item['SP_TENSP'] . '</td>
                                    <td><img src="./images/' . $item['SP_HINH'] . '" alt="product image" class="product-img"></td>
                                    <td>' . $item['CTGH_SOLUONG'] . '</td>
                                    <td>' . number_format($dongia, 0, '', '.') . 'đ</td>
                                  </tr>';
                            $i++;
                        }

                        echo '<tr>
                                <td colspan="4" class="total-label">Tổng thanh toán</td>
                                <td class="total-amount">' . $tongdonhang . 'đ</td>
                              </tr>';
                    }
                ?>
            </table>

            <div class="shipping-info">
                <h3>📦 Thông tin nhận hàng</h3>
                <table>
                    <tr>
                        <td><strong>Người nhận:</strong> <?= htmlspecialchars($info_donhang['DH_TENNGUOINHAN']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Số điện thoại:</strong> <?= htmlspecialchars($info_donhang['DH_SDT']); ?></td>
                    </tr>
                    <tr>
                        <td><strong>Địa chỉ:</strong> <?= htmlspecialchars($info_donhang['DH_DIACHINHAN']); ?></td>
                    </tr>
                </table>
            </div>

            <div class="thank-you">
                🎉 Cảm ơn bạn đã mua hàng! Chúng tôi sẽ liên hệ với bạn sớm nhất.
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const badge = document.querySelector('.cart-badge');
            if (badge) badge.textContent = '0';
        });
    </script>
</body>
</html>
