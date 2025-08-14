<!-- <div class="mb-3">
                            <label class="form-label">Quận</label>
                            <select name="quan_id" id="quan" class="form-select" required>
                                <option value="">-- Chọn Quận --</option>
                                <?php foreach ($quan as $q): ?>
                                    <option value="<?= $q['Q_ID'] ?>"><?= $q['Q_TENQUANHUYEN'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div> -->
                         <!-- <td class="total-amount" id="diemTru"><?= number_format($max_diem_dung, 0, ',', '.') ?>đ</td> -->
<script>
                         document.getElementById("quan").addEventListener("change", function () {
        var quan_id = this.value;
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "index.php?act=loadphuong&quan_id=" + quan_id, true);
        xhr.onload = function () {
            if (this.status == 200) {
                document.getElementById("phuong").innerHTML = this.responseText;
            }
        };
        xhr.send();
    });

      // const tong = <?= $tong + (int)str_replace('.', '', $phigiao) ?>; // Số nguyên trong tích ô use điểm

        //checkbox
            // document.addEventListener("DOMContentLoaded", function () {
            //         const checkbox = document.getElementById("chkDiemTichLuy");
            //         checkbox.addEventListener("change", function () {
            //             if (checkbox.checked) {
            //                 console.log("☑ Checkbox đã được chọn");
            //             } else {
            //                 console.log("☐ Checkbox đã bị bỏ chọn");
            //             }
            //         });
            //     });
            /**tính khoảng cách */

    // document.addEventListener("DOMContentLoaded", function () {
    // const phuongSelect = document.getElementById("phuong");
    // const diaChiInput = document.querySelector('input[name="address_chitiet"]');
    // const khoangCachSpan = document.getElementById("khoangCach");

//     function tinhKhoangCach() {
//         const phuongId = phuongSelect.value;
//         const diaChiChiTiet = diaChiInput.value.trim();

//         if (phuongId && diaChiChiTiet !== '') {
//             khoangCachSpan.innerText = 'Đang tính...';
//             fetch('model/ors_model.php', {
//                 method: 'POST',
//                 headers: {
//                     'Content-Type': 'application/x-www-form-urlencoded'
//                 },
//                 body: `phuong_id=${phuongId}&diachi=${encodeURIComponent(diaChiChiTiet)}`
//             })
//             .then(response => response.text())
//             .then(data => {
//                 khoangCachSpan.innerText = data.includes('km') ? data : `${data}km`;
//             })
//             .catch(err => {
//                 khoangCachSpan.innerText = 'Không tính được';
//                 console.error(err);
//             });
//         } else {
//             khoangCachSpan.innerText = 'Chưa đủ thông tin';
//         }
//     }

//     phuongSelect.addEventListener("change", tinhKhoangCach);
//     diaChiInput.addEventListener("input", function () {
//         clearTimeout(window.delayTimer);
//         window.delayTimer = setTimeout(tinhKhoangCach, 700);
//     });
// });



.then(phi  => {
                        // console.log("DATA từ tinhphi.php:", data); // thêm dòng này
                        // console.log('Phi:', data.phi);
                        // console.log('parseInt:', parseInt(data.phi));
                        // console.log('Tong tien:', tongTien);                  
                        // phiGiaoHangSpan.innerText = phi + 'đ';
                        // //cộng phí vào tổng thanh toán
                        // const phiNumber = parseInt(phiGiaoHangSpan.textContent.replace(/\D/g, ''));
                        // const tongnew = tongTien + phiNumber;
                        // tongCuoi.innerText = formatVND(tongnew) + 'đ';
                            const phiNumber = parseInt(phi);
                            // const phiNumber = parseInt(data.phi);
                            // const soKm = data.soKm;
                            // const trongLuong = data.trongLuong;
                            // const ngayApdung = data.ngayApdung;
                                                         
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
                            // document.getElementById('phidelivery').value = phiNumber; 
                            // document.getElementById("idkc").value = soKm;
                            // document.getElementById("idtl").value = trongLuong;
                            // document.getElementById("ngayapdung").value = ngayApDung; // nhớ phải lấy đúng ngày đang dùng

                    })
                    // document.addEventListener("DOMContentLoaded", function () {
        //     const chk = document.getElementById('chkDiemTichLuy');
        //     const rowDiem = document.getElementById('rowDiemTichLuy');
        //     const diemTru = document.getElementById('diemTru');
        //     const tongCuoi = document.getElementById('tongcuoi');//tổng sau khi + phí giao
        //     //const tongtienhang = document.getElementById('tonghang');lấy tổng tiền hàng chưa có phí
        //     const diemsudung = document.getElementById('diemdung');//lấy điểm dùng
            
          
        //     // const tong = <?php $tong ?>
        //     // const diemDung = <?php $max_diem_dung ?>;
        //     const tongTien = parseInt(tongCuoi.textContent.replace(/\D/g, ''));
        //     //  const tongTien = Number(tongCuoi.textContent.replace(/[^\d]/g, ''));
        //     const diemDung = parseInt(diemsudung.value.replace(/\D/g, ''));
        //     // const diemDung = Number(diemsudung.value.replace(/[^\d]/g, ''));
        //     function formatVND(number) {
        //         return new Intl.NumberFormat('vi-VN').format(number);
        //     }

        //     chk.addEventListener('change', function () {
        //         // const tongTien = Number(tongtienhang.textContent.replace(/\./g, '').replace('đ', '').trim());
        //         //  const diemDung = Number(diemsudung.value.replace(/\./g, '').replace('đ', '').trim());

        //         if (this.checked) {
               

        //             rowDiem.style.display = 'table-row';
        //             diemTru.textContent = formatVND(diemDung) + 'đ';

        //             let tongMoi = tongTien - diemDung;
        //             if (tongMoi < 0) tongMoi = 0;
        //             tongCuoi.textContent = formatVND(tongMoi) + 'đ';
        //         } else {
        //             rowDiem.style.display = 'none';
        //             tongCuoi.textContent = formatVND(tongMoi) + 'đ';
        //         }
        //     });
        // });
    </script>

    