<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
.box {
    width: 100%;
    margin: 30px auto;
    padding: 20px;
    background-color: #f9f9f9;
    border-radius: 12px;
    box-shadow: 0 0 12px rgba(0, 0, 0, 0.2);
    font-family: 'Segoe UI', sans-serif;
}

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
    background-color: #f9f9f9;
}

.total-amount {
    font-weight: bold;
    color: #e60000;
}

/* Form thanh toán */
h3 {
    margin-bottom: 15px;

}

.order-table input[type="text"] {
    width: 100%;
    padding: 10px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 6px;
    font-size: 14px;
}

.order-table input[type="radio"] {
    margin: 5px;
    float: left;
}

.order-table input[type="checkbox"] {
    margin: 5px;
    float: left;
}
.submit-btn {
    width: 20%;
    background-color: #28a745;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-size: 16px;
    cursor: pointer;
    margin-top: 10px;
    transition: background-color 0.3s;
}

.submit-btn:hover {
    background-color: #218838;
}

/* Responsive */
@media (max-width: 768px) {
    .product-img {
        width: 40px;
    }

    table th, table td {
        font-size: 12px;
        padding: 8px;
    }

    .submit-btn {
        font-size: 14px;
        padding: 10px;
    }
}
span, .left {
    float: left;
}
.tieude{
    color: black;
}
.free{
    float: left;
    color:rgb(197, 153, 11);
}
#quan, #phuong, label{
    float: left;
    font-size: 17px;
}
main{
    margin-top: 50px;
}


    </style>
</head>
<body>
    <main>
        <div class="container ">
            <h2 style="text-align: center; margin-bottom: 20px;">Xác nhận đơn hàng</h2>
            <div class="row box">
                <table>
                    <tr>
                        <th>STT</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình</th>
                        <th>Số lượng</th>
                        <th>Trọng lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
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
                                                <td>' . $item['SP_TRONGLUONG'] . 'g</td>
                                                <td>' . number_format($dongia, 0, '', '.') . 'đ</td>
                                                <td>' . number_format($tt, 0, '', '.') . 'đ</td>
                                            </tr>';

                                    $i++;
                                }


                                    $max_diem_dung = ($diem > $tong) ? $tong : $diem;
                                 echo '
                                    <tr>
                                        <td colspan="6" class="total-label" style="border: none;">Tổng cộng</td>
                                        <td style="border: none;" class="total-amount" id="tongTienHang">' . number_format($tong, 0, ',', '.'). 'đ</td>

                                    </tr>
                                    <tr>
                                        <td style="border: none;" colspan="6" class="total-label">Trọng lượng</td>
                                        <td style="border: none;" class="total-amount">' . $tong_trongluong. 'g</td>

                                    </tr>
                                    <tr>
                                        <td style="border: none;" colspan="6" class="total-label">Khoảng cách</td>
                                        <td style="border: none;" class="total-amount" id="khoangCach">Chờ bạn nhập...</td>
                                    </tr>

                                    <tr>
                                        <td style="border: none;" colspan="6" class="total-label">Phí giao</td>
                                        <td style="border: none;" class="total-amount" id="phiGiaoHang">Đang chờ bạn...</td>

                                    </tr>
                                    <tr id="rowDiemTichLuy" style="display: none;">
                                        <td style="border: none;" colspan="6" class="total-label">Dùng điểm tích lũy</td>                                 
                                        <td style="border: none;" class="total-amount" id="diemTru">' . number_format($max_diem_dung, 0, ',', '.') . 'đ</td>
                                    </tr>

                                    <tr>
                                        <td style="border: none;" colspan="6" class="total-label">Tổng thanh toán</td>
                                        <td style="border: none;" class="total-amount" id="tongcuoi">'. number_format($tong, 0, ',', '.').'đ</td>
                                    </tr>

                                ';
                            }
                    ?>

                </table>
            </div>
                            <?php
                                // $max_diem_dung = ($diem > $tong) ? number_format($tong, 3) : $diem;
                            ?>
<!-- ---------------------------------------- -->
            <div class="row justify-content-center mb-4">
                <div class="col-md-8">
                    <h3 class="text-center mb-4 text-success fw-bold">THÔNG TIN ĐẶT HÀNG</h3>
                    <form action="index.php?act=xacnhan" method="post" class="p-4 rounded shadow bg-light">
                        <input type="hidden" name="tongdonhang" id="tonghang" value="<?= $tong ?>">
                        <input type="hidden" name="phidelivery" id="phidelivery" value=""> <!--lấy phí giao -->
                        <input type="hidden" name="total-tl" id="total-tl" value="<?= $tong_trongluong ?>"> <!--lấy total trong lượng đơn hàng-->
                        <input type="hidden" name="idkc" id="khoangcach">
                        <input type="hidden" name="idtl" id="trongluong">                      


                        <div class="mb-3">
                            <label class="form-label">Họ tên</label>
                            <input type="text" name="hoten" value="<?= $info['KH_HOTEN'] ?? '' ?>" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Số điện thoại</label>
                            <input type="text" name="tel" value="<?= $info['KH_SODIENTHOAI'] ?? '' ?>" required class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Thành phố</label>
                            <input type="text" name="thanhpho" value="TP Hồ Chí Minh" readonly class="form-control bg-light">
                        </div>



                        <div class="mb-3">
                            <label class="form-label">Phường</label>
                            <select name="phuong_id" id="phuong" class="form-select" required>
                                <option value="">-- Chọn Phường --</option>
                                <?php foreach ($phuong as $p): ?>
                                    <option value="<?= $p['P_ID'] ?>"><?= $p['P_TENPHUONGXA'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Địa chỉ chi tiết</label>
                            <input type="text" name="address_chitiet" required class="form-control" placeholder="Nhập số nhà, đường...">
                        </div>

                        <div class="mb-3">
                        <p class="mb-2 text-dark">Phương thức thanh toán</p>
                            <?php foreach ($pttt as $item): ?>
                                <div class="form-check d-block">
                                    <input class="form-check-input" type="radio" name="pttt" value="<?= $item['PTTT_ID'] ?>" required>
                                    <label class="form-check-label"><?= $item['PTTT_TENPT'] ?></label>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" name="diemtichluy" value="chon" id="chkDiemTichLuy">
                            <label class="form-check-label" for="chkDiemTichLuy">
                                Dùng <?= number_format($max_diem_dung, 0, ',', '.') ?> điểm tích lũy
                            </label>
                            <input type="hidden" name="diem_dung" id="diemdung" value="<?= number_format($max_diem_dung, 0, ',', '.') ?>">
                        </div>

                        <!-- <div class="mb-3">
                            <?php if ($tong >= 300000): ?>
                                <p class="text-success">✅ Phí giao là <strong>0đ</strong> cho đơn hàng từ 300.000đ</p>
                            <?php endif; ?>
                        </div> -->

                        <div class="text-center">
                            <button type="submit" name="xacnhan" class="btn btn-success px-4">Xác nhận đặt hàng</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <!-- để lấy trọng lượng -->
        <input type="hidden" id="trongLuong" value="<?= $tong_trongluong ?>">

</main>


<script>
document.addEventListener("DOMContentLoaded", function () {
    const phuongSelect = document.getElementById("phuong");
    const diaChiInput = document.querySelector('input[name="address_chitiet"]');
    const khoangCachSpan = document.getElementById("khoangCach");
    const trongLuongInput = document.getElementById("trongLuong");
    const phiGiaoHangSpan = document.getElementById("phiGiaoHang");
    const tongCuoi = document.getElementById('tongcuoi');//lấy tổng cuối
    const tongTien = parseInt(tongCuoi.textContent.replace(/\D/g, ''));

    function formatVND(number) {
                return new Intl.NumberFormat('vi-VN').format(number);
            }
    function tinhKhoangCach() {
        const phuongId = phuongSelect.value;
        const diaChiChiTiet = diaChiInput.value.trim();

        if (phuongId && diaChiChiTiet !== '') {
            khoangCachSpan.innerText = 'Đang tính...';
            fetch('model/ors_model.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `phuong_id=${phuongId}&diachi=${encodeURIComponent(diaChiChiTiet)}`
            })
            .then(response => response.text())
            .then(data => {
                 console.log("Kết quả từ ors_model.php:", data); // Thêm dòng này
                const soKm = parseFloat(data);
                if (!isNaN(soKm)) {
                    khoangCachSpan.innerText = `${soKm} km`;

                    const trongLuong = parseFloat(trongLuongInput.value);

                    // Gán giá trị vào input hidden
                    document.getElementById('khoangcach').value = soKm;
                    document.getElementById('trongluong').value = trongLuong;

                    // Gọi API tính phí giao hàng
                    fetch('model/tinhphi.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/x-www-form-urlencoded'
                        },
                        body: `km=${soKm}&trongluong=${trongLuong}`
                    })
                    .then(res => res.text())
                    .then(phi => {

                            const phiNumber = parseInt(phi);
                           
                                                         
                            const diemDung = parseInt(document.getElementById('diemdung').value.replace(/\D/g, '')) || 0;
                            const chk = document.getElementById('chkDiemTichLuy');

                            let tongMoi = tongTien + phiNumber;

                            if (chk.checked) {
                                tongMoi -= diemDung;
                                if (tongMoi < 0) tongMoi = 0;
                            }

                            phiGiaoHangSpan.innerText = formatVND(phiNumber) + 'đ';
                            tongCuoi.innerText = formatVND(tongMoi) + 'đ';
                            // Ở chỗ tính phí giao – ngay sau khi bạn đã có const phiNumber = 25000;
                            //để gửi form qua php
                            document.getElementById('phidelivery').value = phiNumber; 
                           

                    })
                    .catch(err => {
                        phiGiaoHangSpan.innerText = 'Không tính được phí';
                        console.error(err);
                    });
                } else {
                    khoangCachSpan.innerText = 'Không xác định';
                    phiGiaoHangSpan.innerText = 'Không tính được phí';
                }
            })
            .catch(err => {
                khoangCachSpan.innerText = 'Không tính được';
                phiGiaoHangSpan.innerText = 'Không tính được phí';
                console.error(err);
            });
        } else {
            khoangCachSpan.innerText = 'Chưa đủ thông tin';
            phiGiaoHangSpan.innerText = 'Không tính được phí';
        }
    }

    phuongSelect.addEventListener("change", tinhKhoangCach);
    diaChiInput.addEventListener("input", function () {
        clearTimeout(window.delayTimer);
        window.delayTimer = setTimeout(tinhKhoangCach, 100);
    });
});

 

</script>

<script>
        
        document.addEventListener("DOMContentLoaded", function () {
    const chk = document.getElementById('chkDiemTichLuy');
    const rowDiem = document.getElementById('rowDiemTichLuy');
    const diemTru = document.getElementById('diemTru');
    const tongCuoi = document.getElementById('tongcuoi');
    const diemsudung = document.getElementById('diemdung');

    function formatVND(number) {
        return new Intl.NumberFormat('vi-VN').format(number);
    }

    chk.addEventListener('change', function () {
        const diemDung = parseInt(diemsudung.value.replace(/\D/g, '')) || 0;
        let tongTienHienTai = parseInt(tongCuoi.textContent.replace(/\D/g, '')) || 0;

        if (this.checked) {
            rowDiem.style.display = 'table-row';
            diemTru.textContent = formatVND(diemDung) + 'đ';

            let tongMoi = tongTienHienTai - diemDung;
            if (tongMoi < 0) tongMoi = 0;
            tongCuoi.textContent = formatVND(tongMoi) + 'đ';
        } else {
            rowDiem.style.display = 'none';

            // Phục hồi lại tổng cũ = tổng hiện tại + điểm đã trừ
            let tongMoi = tongTienHienTai + diemDung;
            tongCuoi.textContent = formatVND(tongMoi) + 'đ';
        }
    });
});

</script>
 
</body>
</html>