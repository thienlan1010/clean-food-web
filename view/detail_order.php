<?php
//kiêm tra đã đánh giá chưa
function da_danh_gia($madon, $masp) {
    $conn = ketnoidb();
    $sql = "SELECT COUNT(*) FROM danhgia_sanpham WHERE DH_MADH = :madon AND SP_MASP = :masp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':madon', $madon);
    $stmt->bindParam(':masp', $masp);
    $stmt->execute();
    return $stmt->fetchColumn() > 0;
}

?>
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
    font-weight: 700;
    text-align: center;
    margin: 40px 0 30px;
    color: #2c3e50;
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
    background: rgb(213, 178, 62);
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
    background: rgb(167, 133, 25);
    transform: scale(1.05);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.2);
}

.reviewed{
  display: inline-block;
  padding: 6px 6px;
  background-color:rgb(127, 160, 29); /* xám nhạt */
  color: white;
  font-weight: bold;
  border-radius: 6px;
  font-size: 14px;
  text-align: center;
  border: none;
  cursor: not-allowed;
  box-shadow: inset 0 0 3px rgba(0, 0, 0, 0.2);


}

/* thông tin đơn hàng */
.summary-row {
    border: none !important;
    background-color: transparent !important;
}

.summary-row td {
    border: none !important;
    padding: 8px 10px;
    font-size: 16px;
}

.summary-row .label-cell {
    text-align: right;
    font-weight: bold;
    color: #333;
}

.summary-row .value-cell {
    text-align: center;
    color: #000;
}

.summary-row .value-cell.tongcong {
    color: red;
    font-weight: bold;
    font-size: 18px;
}
#tongcong {
    color: red;
    font-size: 18px;
}



    </style>
</head>
<body>
    <main>
        <div class="container">
            <div class="row">
        <?php
    echo "<h2 class='page-title'>Chi tiết đơn hàng</h2>";
    
  
        if (isset($ls_dh) && count($ls_dh) > 0) {
            echo '<table class="cart-table">
                <thead>
                    <tr>                  
                        <th>ID đơn hàng</th>
                        <th>Ngày đặt hàng</th>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>';
                        if($status == "Giao thành công"){
                        echo'    <th>Hành động</th>';
                        }          
                echo'   </tr>
                </thead>
                <tbody>';
    
            $i = 1;
            foreach ($ls_dh as $item) {
                $madon = $item['DH_MADH'];
                $masp = $item['SP_MASP'];
                echo '<tr>
                        <td>' . htmlspecialchars($item['DH_MADH']) . '</td>
                        <td>' . htmlspecialchars($item['DH_NGAYDAT']) . '</td>
                        <td>' . htmlspecialchars($item['SP_TENSP']) . '</td>                       
                        <td>' . htmlspecialchars($item['CTDH_SOLUONG']). '</td>
                        <td>' . htmlspecialchars($item['CTDH_DONGIA']) . '</td>';
                        
                        if($status == "Giao thành công"){
                            if (da_danh_gia($madon, $masp)) {
                            echo '<td><span class="reviewed">Đã đánh giá</span></td>';

                        }else {
                    echo '<td>
                        <form method="post" action="index.php?act=danhgia">
                            <input type="hidden" name="id" value="'.$madon.'">
                            <input type="hidden" name="masp" value="'.$masp.'">
                            <input type="submit" name="danhgia" class="btn btn-outline-primary btn-sm" value="Đánh giá">
                        </form>

                        </td>';
                }
                    }
                        
               echo'     </tr>';
                $i++;
            }
            if($status == "Giao thành công"){
                echo '
                    <tr class="summary-row">
                                <td colspan="5" class="total-label label-cell"><strong>Tiền hàng</strong></td>
                                <td class="total-amount value-cell">' . htmlspecialchars($item['TongTien']) . '</td>
                                
                            </tr>
                             <tr class="summary-row">
                                <td colspan="5" class="total-label label-cell"><strong>Điểm đã dùng</strong></td>
                                <td class="total-amount value-cell">' . htmlspecialchars($item['DH_DIEMDADUNG']) . '</td>
                                
                         </tr>
                        <tr class="summary-row">
                            <td colspan="5" class="total-label label-cell"><strong>Phí giao</strong></td>
                            <td class="total-amount value-cell">' . number_format($item['PG_DONGIA'], 0, ',', '.') . 'đ</td>
                        </tr>
                        <tr class="summary-row">
                            <td colspan="5" class="total-label label-cell"><strong>Điểm cộng</strong></td>
                            <td class="total-amount value-cell">' . htmlspecialchars($item['DH_DIEMCONG']) . '</td>
                            
                        </tr>';
                        echo' <tr class="summary-row">
                                <td colspan="5" class="label-cell" id="tongcong"><strong>Tổng cộng</strong></td>
                                <td class="value-cell tongcong">' . htmlspecialchars($item['DH_TONGTIEN']) . '</td>
                            </tr>';
                    
                        }else{
                            echo '
                            <tr class="summary-row">
                                <td colspan="4" class="total-label label-cell"><strong>Tiền hàng</strong></td>
                                <td class="total-amount value-cell">' . htmlspecialchars($item['TongTien']) . '</td>
                                
                            </tr>
                             <tr class="summary-row">
                                <td colspan="4" class="total-label label-cell"><strong>Điểm đã dùng</strong></td>
                                <td class="total-amount value-cell">' . htmlspecialchars($item['DH_DIEMDADUNG']) . '</td>
                                
                         </tr>
                        <tr class="summary-row">
                            <td colspan="4" class="total-label label-cell"><strong>Phí giao</strong></td>
                            <td class="total-amount value-cell">' . number_format($item['PG_DONGIA'], 0, ',', '.') . 'đ</td>

                            
                        </tr>
                        <tr class="summary-row">
                            <td colspan="4" class="total-label label-cell"><strong>Điểm cộng</strong></td>
                            <td class="total-amount value-cell">' . htmlspecialchars($item['DH_DIEMCONG']) . '</td>
                            
                        </tr>';
                echo '
                    <tr class="summary-row">
                        <td colspan="4" class="label-cell" id="tongcong"><strong>Tổng cộng</strong></td>
                        <td class="value-cell tongcong">' . htmlspecialchars($item['DH_TONGTIEN']) . '</td>
                    </tr>

                    ';
                        }
            echo '</tbody>
            
            </table>';
        } else {
            echo "<p class='empty-cart'>Bạn chưa có đơn hàng! <a href='index.php'>Bạn có muốn đặt hàng tiếp không?</a></p>";
        }
   
    
?>
</div>
        </div>
</main>
 <!-- echo'    <td><a href="index.php?act=danhgia&id=' . $item['SP_MASP'] . '&iddh=' . $item['DH_MADH'] . '" class="btn-edit delete-btn">Đánh giá</a></td>'; -->
</body>
</html>