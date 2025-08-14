$(document).ready(function() {
    // Sự kiện thay đổi
    $(".nums").change(function(e) { //class="num" tại ô input => đại diện cho số lượng sản phẩm.
        e.preventDefault();//Ngăn chặn hành vi mặc định (nếu có), để đảm bảo không có sự cố không mong muốn.
        
        // Lấy giá trị tại nút change
        var sl = parseInt(this.value); // Giá trị của ô nhập liệu hiện tại, chuyển thành số nguyên bằng parseInt
        var tr = $(this).closest('tr'); //  Lấy hàng (tr) chứa ô nhập liệu số lượng.
        
        // Lấy đơn giá
        var dongia = tr.children("td").eq(4).text().replace('$', '').replace(',', ''); //  Lấy giá trị từ cột thứ 5 (eq(4) tính từ 0) trong dòng hiện tại. Đây là nơi chứa đơn giá. Loại bỏ ký hiệu $ và dấu , trong giá trị đơn giá để chuẩn bị cho việc chuyển đổi.
        var price = parseFloat(dongia); // Chuyển đổi thành số thực
        
        // Kiểm tra nếu giá trị đơn giá hợp lệ
        if (!isNaN(price) && sl > 0) {//Đảm bảo đơn giá là một số hợp lệ. và sl > 0
            // Tính toán thành tiền
            var tt = price * sl; // Thành tiền
            
            // Cập nhật thành tiền trong bảng
            tr.children("td").eq(5).text(tt.toFixed(3)); // Cập nhật giá trị thành tiền trong cột thứ 6 (eq(5)), làm tròn đến 2 chữ số thập phân.
            
            // Cập nhật tổng cộng
            var total = 0;//Biến lưu tổng cộng giá trị của giỏ hàng.
            $(".cart-table tbody tr").each(function() {//Duyệt qua từng dòng trong bảng (tbody tr):
                var subtotal = $(this).children("td").eq(5).text().replace(',', ''); //Lấy giá trị thành tiền từ cột thứ 6 (bỏ dấu , nếu có).
                total += parseFloat(subtotal) || 0; // Cộng dồn, Nếu subtotal không phải số hợp lệ, thêm giá trị 0.
            });
            $(".total-amount").text(total.toFixed(3)); // .total-amount: Là lớp của phần tử hiển thị tổng tiền. Cập nhật tổng tiền trong phần tử có class "total-amount".
        }
    });
});

