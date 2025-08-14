<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        main{
            flex: 1;
           margin-top: 170px;
        }
        .page-title {
            font-size: 30px;
           
            text-align: center;
            margin: 40px 0 30px;
            color: #000;
        }

.cart-table {
    width: 90%;
    margin: 0 auto 50px;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.cart-table thead {
    background:rgb(19, 198, 82);
    color: white;
    font-size: 16px;
}

.cart-table th,
.cart-table td {
    padding: 14px 18px;
    text-align: center;
    font-size: 15px;
    border-bottom: 1px solid #eee;
}

.cart-table tbody tr:nth-child(even) {
    background-color: #f8f9fa;
}

.cart-table tbody tr:hover {
    background-color: #eef6ff;
    transition: background-color 0.3s ease;
}

.empty-cart {
    text-align: center;
    font-size: 18px;
    margin-top: 50px;
    color: #6c757d;
}

.empty-cart a {
    color:rgb(35, 185, 115);
    font-weight: 600;
    text-decoration: none;
    margin-left: 5px;
}

.empty-cart a:hover {
    text-decoration: underline;
}

/* Trạng thái đơn hàng (màu sắc tuỳ trạng thái) */
.cart-table td.status-processing {
    color: #e67e22;
    font-weight: 600;
}

.cart-table td.status-completed {
    color: #27ae60;
    font-weight: 600;
}

.cart-table td.status-cancelled {
    color: #e74c3c;
    font-weight: 600;
}
.btn-edit {
    display: inline-block;
    padding: 8px;
    background: rgb(19, 198, 82);
    color: #fff;
    font-size: 14px;
    border: none;
    border-radius: 10px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

.btn-edit:hover {
    background: rgb(14, 148, 61);
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}


    </style>
</head>
<body>
    <main>
        <div class="container mt-3">
            <div class="row">
        <?php
    echo "<h2 class='page-title'>Lịch Sử Đơn Hàng Của Bạn</h2>";
    
  
        if (isset($lichsu) && count($lichsu) > 0) {
            echo '<table class="cart-table">
                <thead>
                    <tr>                  
                        <th>ID đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Người nhận</th>
                        <th>Tổng tiền</th>
                        <th>Phương thức</th>
                        <th>Địa chỉ giao</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>

                    </tr>
                </thead>
                <tbody>';
    
            $i = 1;
            foreach ($lichsu as $item) {
                echo '<tr>
                        
                        <td>' . htmlspecialchars($item['DH_MADH']) . '</td>
                        <td>' . htmlspecialchars($item['DH_NGAYDAT']) . '</td>
                        <td>' . htmlspecialchars($item['DH_TENNGUOINHAN']) . '</td>                       
                        <td>' . htmlspecialchars($item['DH_TONGTIEN']). '</td>
                        <td>' . htmlspecialchars($item['PTTT_TENPT']) . '</td>
                        <td>' . htmlspecialchars($item['DH_DIACHINHAN']) . '</td>
                        <td>' . htmlspecialchars($item['TT_TENTT']) . '</td>
                        <td><a class="btn-edit" href="index.php?act=detail-dh&id='.$item['DH_MADH'].'">Chi tiết</a></td>                                              
                    </tr>';
                $i++;
            }
    
            echo '</tbody>
            </table>';
        } else {
            echo "<p class='empty-cart mb-5'>Bạn chưa có đơn hàng! <a href='index.php'>Bạn có muốn đặt hàng không?</a></p>";
        }
   
    
?>
</div>
        </div>
</main>
</body>
</html>