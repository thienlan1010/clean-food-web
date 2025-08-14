//đếm số lượng sản phẩm

function show_sl_sp() {
    var gh = sessionStorage.getItem("giohang");
    var giohang = gh ? JSON.parse(gh) : [];

    // số lượng loại sản phẩm là số phần tử trong mảng
    document.getElementById("countsp").innerText = giohang.length;
}

document.addEventListener('DOMContentLoaded', show_sl_sp);


// function showgiohang() {
//     var gh = sessionStorage.getItem("giohang");
//     var giohang = JSON.parse(gh) || []; // Nếu null thì để []

//     var ttgh = "";
//     var tong = 0;

//     if (giohang.length === 0) {
//         ttgh = '<tr><td colspan="5">Giỏ hàng trống.</td></tr>';
//     } else {
        
//         for (let i = 0; i < giohang.length; i++) {
//             var tt = parseInt(giohang[i][4]) * parseInt(giohang[i][2]);
//             tong += tt;
//             ttgh += '<tr>' +
//                 '<td>' + (i+1) + '</td>' +
//                 '<td>' + giohang[i][1] + '</td>' +
//                 '<td><img src="' + giohang[i][3] + '" width="100px" height="100px"></td>' +
//                 '<td>' + giohang[i][4] + '</td>' +
//                 '<td>' + giohang[i][2] + 'đ</td>' +
//                 '<td>' + tt + 'đ</td>' +
//                 '<td>'+'<button onclick="xoasp(this)">Xóa</button>'+'</td>' +
//                 '</tr>';
               
//         }

//         ttgh += '<tr>' +
//             '<th colspan="4" style="text-align: right;">Tổng đơn:</th>' +
//             '<th>' + tong + 'đ</th>' +
//             '</tr>';
//     }

//     document.getElementById("mycart").innerHTML = ttgh;
// }
function showgiohang() {
    var gh = sessionStorage.getItem("giohang");
    var giohang = gh ? JSON.parse(gh) : [];

    var ttgh = "";
    var tong = 0;

    if (giohang.length === 0) {
        // Nếu giỏ hàng trống → hiển thị ảnh hoặc dòng thông báo
        ttgh = '<tr><td colspan="7" style="text-align:center;">' +
       '<img src="images/giohang.webp" alt="Giỏ hàng trống" style="width: 200px; height: 200px;">' +
       '</td></tr>';

    } else {
        // Nếu có sản phẩm → hiển thị tiêu đề trước
        ttgh += '<tr class="tieude">' +
            '<th>STT</th>' +
            '<th>Tên SP</th>' +
            '<th>Hình</th>' +
            '<th>Số lượng</th>' +
            '<th>Đơn giá</th>' +
            '<th>Thành tiền</th>' +
            '<th>Hành động</th>' +
            '</tr>';

       for (let i = 0; i < giohang.length; i++) {
                var sl = parseInt(giohang[i][4].toString().replace(/\./g, ''));
                var dongia = parseInt(giohang[i][2].toString().replace(/\./g, ''));
                var tt = sl * dongia;
                tong += tt;

                ttgh += '<tr>' +
                    '<td>' + (i + 1) + '</td>' +
                    '<td>' + giohang[i][1] + '</td>' +
                    '<td><img src="' + giohang[i][3] + '" width="100px" height="100px"></td>' +
                    '<td><input type="number" class="num" min="1" value="' + giohang[i][4] + '" data-index="' + i + '"></td>' +
                    '<td>' + dongia.toLocaleString('vi-VN') + 'đ</td>' +
                    '<td>' + tt.toLocaleString('vi-VN') + 'đ</td>' +
                    '<td><button class="delete-all" onclick="xoasp(this)">Xóa</button></td>' +
                    '</tr>';
            }



        // Hiển thị tổng
        ttgh += '<tr>' +
            '<td colspan="6" style="text-align: right;"><strong>Tổng đơn:</strong></td>' +
            '<td colspan="1"><strong>' + tong.toLocaleString('vi-VN') + 'đ</strong></td>' +
            '</tr>';
            // Hiện nút nếu có sản phẩm
        document.getElementById("cartActions").style.display = "block";
    }

    document.getElementById("mycart").innerHTML = ttgh;
}




showgiohang();

//xóa giỏ hàng
function xoasp(x){
    var gh = sessionStorage.getItem("giohang");
    var giohang = gh ? JSON.parse(gh) : [];
    //xóa tr
   
    var tr = x.parentElement.parentElement;
    var tenpr = tr.children[1].innerHTML;
    tr.remove();
    //alert(tenpr);
    //xóa sp trong mảng sessionstorage
    for (let i = 0; i < giohang.length; i++) {
        if(giohang[i][1] == tenpr){
            giohang.splice(i,1);
        }
        
    }
    // 🔥 Cập nhật lại sessionStorage
    sessionStorage.setItem("giohang", JSON.stringify(giohang));

    // Gọi lại showgiohang để render lại giao diện đúng
    showgiohang();
    show_sl_sp();
   
}

//xóa all giỏ hàng
function xoaall(){
    var gh = sessionStorage.getItem("giohang");
    var giohang = gh ? JSON.parse(gh) : [];

    giohang = [];

    sessionStorage.setItem("giohang", JSON.stringify(giohang));

    // Gọi lại showgiohang để render lại giao diện đúng
    showgiohang();
    show_sl_sp();
    

}

//cập nhật lại slsp
// $(document).ready(function() {
//     $(document).on('change', '.num', function() {
//         var sl = parseInt($(this).val());
//         if (sl < 1) sl = 1; // tránh số lượng < 1
//         var idx = $(this).data('index');

//         // Lấy giỏ hàng từ sessionStorage
//         var gh = sessionStorage.getItem('giohang');
//         var giohang = gh ? JSON.parse(gh) : [];

//         if (giohang[idx]) {
//             giohang[idx][4] = sl;  // cập nhật số lượng 
//             sessionStorage.setItem('giohang', JSON.stringify(giohang));
//             showgiohang(); // cập nhật lại giao diện
//         }
//     });
// });
$(document).ready(function () {
    $(document).on('change', '.num', function () {
        var slNhap = parseInt($(this).val());
        if (slNhap < 1) slNhap = 1;

        var idx = $(this).data('index');

        // Lấy giỏ hàng từ sessionStorage
        var gh = sessionStorage.getItem('giohang');
        var giohang = gh ? JSON.parse(gh) : [];

        if (!giohang[idx]) return;

        var masp = giohang[idx][0]; // Lấy mã sản phẩm để kiểm tra SL tồn

        // Gọi PHP để lấy SL tồn mới nhất từ DB
        fetch('index.php?act=get_slton&masp=' + masp)
            .then(res => res.text())
            .then(slTon => {
                slTon = parseInt(slTon);

                if (slNhap > slTon) {
                    alert('Chỉ còn ' + slTon + ' sản phẩm trong kho!');
                    // Reset về SL tối đa cho phép
                    giohang[idx][4] = slTon;
                    $(this).val(slTon);
                } else {
                    giohang[idx][4] = slNhap;
                }

                // Lưu lại và cập nhật lại giao diện
                sessionStorage.setItem('giohang', JSON.stringify(giohang));
                showgiohang();
            })
            .catch(err => {
                console.error(err);
                alert('Lỗi khi kiểm tra số lượng tồn kho.');
            });
    });
});
