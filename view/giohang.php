<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
   main {
    flex: 1;
}
.tieude th{
    background-color: #28a745;
    text-align: center;
}

h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
}

.bang {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 12px;
    text-align: center;
}


td img {
    width: 80px;
    height: auto;
    border-radius: 6px;
}
td input[type="number"] {
    width: 85px;
    height: auto;
    
}
td a{
    text-decoration: none;
}
.num {
    text-align: center;
}
.nums {
    text-align: center;
}
.cart-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
/**xóa đơn */
.delete-all {
    background-color: #ff0000; /* Màu đỏ */
    color: white; /* Màu chữ trắng */
    padding: 8px 12px; /* Khoảng cách bên trong nút */
    border: none; /* Xóa viền mặc định */
    border-radius: 4px; /* Bo góc cho nút */
    cursor: pointer; /* Hiệu ứng khi hover chuột */
    text-decoration: none; /* Xóa gạch chân của link */
}

.delete-all:hover {
    background-color:rgb(244, 78, 78); /* Màu đỏ đậm hơn khi hover */
}

main{
              flex: 1; /* tương ứng với chiều cao của header */
              margin-top: 170px;
        }

.cart-actions {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 20px;
}

.order-btn-center {
    flex: 1;
    text-align: center;
    margin-bottom: 20px;
}

.delete-btn-right {
    text-align: right;
   
   
}

.submit-btn, .delete-btn {
    padding: 10px 20px;
    font-size: 16px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
}

.submit-btn {
    background-color: #28a745;
    color: white;
}

.delete-btn {
    background-color: #dc3545;
    color: white;
}
.img-cart {
    display: flex;
    justify-content: center;
    align-items: center;
    text-align: center;
}
   
/* .heading-cart {
  color: red;
  font-weight: bold;
  text-align: center;
  margin-bottom: 30px;
  background-color:rgb(67, 220, 53);
} */
.heading-cart-wrapper {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.heading-cart {
    background: linear-gradient(to right, #009688, #8BC34A);
    color: white;
    font-weight: bold;
    font-size: 22px;
    text-align: center;
    padding: 12px 30px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    max-width: 200px;
    width: 100%;
    margin-bottom: 25px;
}

    </style>
</head>
<body>
    <main>
    <div class="container">
        <div class="row mt-3">
              <div class="heading-cart-wrapper">
                <h2 class="heading-cart">Giỏ Hàng</h2>
            </div>


            <?php
            if (isset($_SESSION['username'])) {
                if (isset($gh) && is_array($gh) && count($gh) > 0) {
              
                    echo' <table class="cart-table mt-3">
                        <tr class="tieude">
                            <th>STT</th>
                            <th>Tên sản phẩm</th>
                            <th>Hình</th>
                            <th>Số lượng</th>
                            <th>Đơn giá</th>
                            <th>Thành tiền</th>
                            <th>Hành động</th>
                        </tr>';

                    $i = 0;
                    $tong = 0;
                    foreach ($gh as $item) {
                        // Lấy dữ liệu từ phần tử $item
                        $masp = htmlspecialchars($item['SP_MASP']);
                        $ten = htmlspecialchars($item['SP_TENSP']);
                        $hinh = htmlspecialchars($item['SP_HINH']);
                        $soluong = (int)$item['CTGH_SOLUONG'];
                        $gia = (float)$item['CTGH_DONGIA'];
                        $thanhtien = $gia * $soluong;
                        $tong += $thanhtien;

                        echo '<tr>
                            <td>' . ($i + 1) . '</td>
                            <td>' . $ten . '</td>
                            <td><img src="./images/' . $hinh . '" alt="product image" class="product-img"></td>
                            <td>
                                <input type="number" value="' . $soluong . '" min="1" class="nums" name="sl[' . $i . ']" onchange="capNhatSoLuong('.$masp.', this.value)" data-masp="' . $masp . '">
                                <input type="hidden" name="tensp[' . $i . ']" value="' . $ten . '">
                            </td>
                            <td>' . number_format($gia, 3) . 'đ</td>
                            <td>' . number_format($thanhtien, 3) . 'đ</td>
                            <td><a href="index.php?act=delcart&i=' . $masp . '" class="delete-btn">Xóa</a></td>
                        </tr>';
                        $i++;
                    }

                    echo '<tr>
                        <td colspan="5" class="total-label">Tổng cộng</td>
                        <td class="total-amount">' . number_format($tong, 3). 'đ</td>
                        <td></td>
                    </tr>';
                    echo '</table>';

                    echo '<div class="order-btn-center mt-3">
                        <form action="index.php?act=dathang" method="POST">
                           
                            <input type="submit" value="Đặt hàng" name="thanhtoan" class="submit-btn">
                        </form>
                    </div>';
                    
                } else {
                    // Giỏ hàng rỗng
                    echo "
                    <div class='img-cart'>
                        <img src='images/giohang.webp' alt='giohang' width='300px' height='300px'>
                    </div>";
                }
            } else {
                // Nếu chưa đăng nhập thì dùng giỏ hàng từ JS sessionStorage
                ?>
                <table class="bang">
                    <thead></thead>
                    <tbody id="mycart"></tbody>
                </table>

                <div class="cart-actions" id="cartActions" style="display: none;">
                    <!-- <div class="delete-btn-right">
                        <button class="delete-btn" onclick="xoaall()">Xóa giỏ hàng</button>
                    </div> -->
                    <form action="index.php?act=login" method="POST" onsubmit="return guiGioHang();">
                        <div class="order-btn-center">
                            <input type="hidden" name="dangdat" value="1"> <!--dùng để kt login -->
                            <input type="hidden" name="data_giohang" id="data_giohang">
                            <input type="submit" value="Đặt hàng" name="thanhtoan" class="submit-btn">
                        </div>
                    </form>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</main>

<script>
    function guiGioHang() {
        var giohang = sessionStorage.getItem("giohang");
        document.getElementById("data_giohang").value = giohang;
        return true; // Cho phép gửi form
    }

//     function capNhatSoLuong(masp, soluong) {
//     fetch('index.php?act=capnhat_soluong', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/x-www-form-urlencoded'
//         },
//         body: `masp=${masp}&soluong=${soluong}`
//     })
//     .then(response => response.text())
//     .then(data => {
//         //console.log(data);  có thể xử lý thông báo hoặc reload lại trang
//         location.reload();
//     });
// }
function capNhatSoLuong(masp, soluong) {
    fetch('index.php?act=check_slton_ajax', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: `masp=${masp}&sl=${soluong}`
    })
    .then(res => {
        if (!res.ok) {
            throw new Error("HTTP lỗi " + res.status);
        }
        return res.text();
    })
    .then(data => {
        console.log("Server trả về:", data); // 👀 Debug
        const slTon = parseInt(data.trim());
        soluong = parseInt(soluong);//mới thêm
        if (!isNaN(slTon)) {
            if (soluong > slTon) {
                alert(`Chỉ còn lại ${slTon} sản phẩm trong kho.`);
                const input = document.querySelector(`input[data-masp="${masp}"]`);
                if (input) input.value = slTon;
                soluong = slTon;
            }

            fetch('index.php?act=capnhat_soluong', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `masp=${masp}&soluong=${soluong}`
            })
            .then(response => response.text())
            .then(data => {
                location.reload();
            });
        } else {
            alert("Lỗi dữ liệu từ server: " + data);
        }
    })
    .catch(err => {
        console.error('Lỗi khi kiểm tra tồn kho:', err);
        alert('Không kiểm tra được số lượng tồn kho!');
    });
}


</script>



</body>
</html>