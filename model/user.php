<?php
//kiểm tra xem ai login
function get_user_info($user, $pass){
        $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
        $sql = "SELECT * FROM tai_khoan WHERE TK_TENDANGNHAP ='".$user."' AND TK_MK='".$pass."' AND TK_TRANGTHAI = 'Còn hoạt động'";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        
        // Lấy kết quả dưới dạng mảng kết hợp
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $kq = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
        return $kq; // 0 là user, 1 là admin
}
//lấy mã khách hàng từ TK_ID
function get_customer_id_from_account($taikhoan_id) {
        $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
        $sql = "SELECT KH_ID FROM khach_hang WHERE TK_ID = :taikhoan_id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':taikhoan_id', $taikhoan_id, PDO::PARAM_INT);
        $stmt->execute();
    
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['KH_ID']; // Trả về mã khách hàng đã đăng nhập
}
//lấy thông tin của khách hàng đăng nhập
function get_customer_id_from_customer($kh_id) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT * FROM khach_hang WHERE KH_ID = :kh_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':kh_id', $kh_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result; // Trả về thông tin của khách hàng
}
//lấy thông tin tài khoản từ mã kh
function get_info_taikhoan($taikhoan_id) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT * FROM tai_khoan WHERE TK_ID = :taikhoan_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':taikhoan_id', $taikhoan_id, PDO::PARAM_INT);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result; // Trả về thông tin của khách hàng
}
//lấy đơn hàng của khách hàng đã đăng nhập
function get_customer_order_history($idcustomer) {
    $conn = ketnoidb();
    $sql = "SELECT d.*, pt.PTTT_TENPT, tt.TT_TENTT
            FROM don_hang d
            INNER JOIN phuongthuc_thanhtoan pt ON d.PTTT_ID = pt.PTTT_ID
            INNER JOIN (
                SELECT ls1.*
                FROM lich_su_don_hang ls1
                INNER JOIN (
                    SELECT DH_MADH, MAX(LSDH_THOIDIEM) AS max_time
                    FROM lich_su_don_hang
                    GROUP BY DH_MADH
                ) ls2 ON ls1.DH_MADH = ls2.DH_MADH AND ls1.LSDH_THOIDIEM = ls2.max_time
            ) ls ON d.DH_MADH = ls.DH_MADH
            INNER JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
            WHERE d.KH_ID = :idcustomer
            ORDER BY d.DH_MADH DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idcustomer', $idcustomer, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}

function get_dtail_order($iddh){
    $conn = ketnoidb();
    $sql = "SELECT dh.DH_MADH, dh.DH_NGAYDAT, dh.DH_DIEMCONG, dh.DH_DIEMDADUNG, dh.DH_TONGTIEN, 
                   CTDH_DONGIA, CTDH_SOLUONG, (CTDH_DONGIA * CTDH_SOLUONG) AS TongTien, SP_TENSP, sp.SP_MASP, pg.PG_DONGIA
            FROM don_hang dh
            INNER JOIN chitiet_donhang ct ON dh.DH_MADH = ct.DH_MADH
            INNER JOIN san_pham sp ON sp.SP_MASP = ct.SP_MASP          
			INNER JOIN phi_giao pg ON pg.PG_NGAYAPDUNG = dh.PG_NGAYAPDUNG       
            WHERE dh.DH_MADH = :iddh 
            AND dh.KC_ID = pg.KC_ID
            AND dh.TL_ID = pg.TL_ID";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddh', $iddh, PDO::PARAM_INT); // ✅ đúng tên biến truyền vào
    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();

    return $kq;
}
//thêm đánh giá
function add_review($masp, $madh, $sao, $nd, $tthai) {
    $conn = ketnoidb();
    $sql = "INSERT INTO danhgia_sanpham (DH_MADH, SP_MASP, DGSP_NOIDUNG, DGSP_SOSAO, DGSP_TRANGTHAI) 
            VALUES (:madh, :masp, :nd, :sao, :tthai)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':madh', $madh);
    $stmt->bindParam(':masp', $masp);
    $stmt->bindParam(':nd', $nd);
    $stmt->bindParam(':sao', $sao);
    $stmt->bindParam(':tthai', $tthai);
    $stmt->execute();
}


//hàm tìm kiến sản phẩm
function search_product_by_keyword($kyw) {
    $conn = ketnoidb(); 
    $sql = "SELECT sp.*, dg_new.DG_GIAMOI, dm.DM_TENDM
        FROM san_pham sp
        JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
        JOIN (
            SELECT d1.*
            FROM don_gia d1
            WHERE d1.DG_ID = (
                SELECT d2.DG_ID
                FROM don_gia d2
                WHERE d2.SP_MASP = d1.SP_MASP
                ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
                LIMIT 1
            )
        ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
        WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
        AND LOWER(sp.SP_TENSP) LIKE LOWER(:kyw)";

    // Chuẩn bị câu lệnh SQL
    $stmt = $conn->prepare($sql);
    $kyw = "%" . $kyw . "%";
    $stmt->bindParam(':kyw', $kyw, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result; // Trả về danh sách sản phẩm
}
//kiểm tra tên đăng nhập và email có trùng hay không
function check_username_email_login($name, $email) {
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT tk.* FROM tai_khoan tk 
    JOIN khach_hang kh ON kh.TK_ID = tk.TK_ID
    WHERE TK_TENDANGNHAP = :name AND kh_EMAIL = :email AND tk.TK_TRANGTHAI = 'Còn hoạt động'"; // Sử dụng tham số thay vì nối chuỗi
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name); // Gán tham số
    $stmt->bindParam(':email', $email);
    $stmt->execute();
    
    // Lấy kết quả
    $kq = $stmt->fetchColumn(); // Lấy giá trị đếm
    return $kq; // Trả về true nếu tên đăng nhập đã tồn tại
}
//cập nhật lại mật khẩu
function update_password($name, $pass) {
    // Kết nối cơ sở dữ liệu
    $conn = ketnoidb();
    $sql = "UPDATE tai_khoan SET TK_MK = :pass WHERE TK_TENDANGNHAP = :name";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':pass', $pass, PDO::PARAM_STR);
    $stmt->bindParam(':name', $name, PDO::PARAM_STR);
    
    // Thực thi câu lệnh
    $stmt->execute();
}
//kiểm tra email có ai sử dụng trước chưa
function check_email($email, $idkh) {
    $conn = ketnoidb();
    $sql = "SELECT COUNT(*) FROM khach_hang WHERE KH_EMAIL = :email AND KH_ID != :idkh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':idkh', $idkh, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchColumn(); // Trả về true nếu tồn tại
}
// Kiểm tra tên đăng nhập có bị trùng không
function check_username_exists($username, $tkid) {
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT COUNT(*) FROM tai_khoan WHERE TK_TENDANGNHAP = :username AND TK_ID != :tkid"; // Sử dụng tham số thay vì nối chuỗi
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':tkid', $tkid); // Gán tham số
    $stmt->execute();
    
    // Lấy kết quả
    $count = $stmt->fetchColumn(); // Lấy giá trị đếm
    return $count ; // Trả về true nếu tên đăng nhập đã tồn tại
}
//kiêm tra số điên thoại
function check_sdt($sdt, $user_id){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT COUNT(*) FROM khach_hang WHERE KH_SODIENTHOAI = :sdt AND KH_ID != :user_id"; // Sử dụng tham số thay vì nối chuỗi
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sdt', $sdt);
    $stmt->bindParam(':user_id', $user_id); // Gán tham số
    $stmt->execute();
    
    // Lấy kết quả
    $count = $stmt->fetchColumn(); // Lấy giá trị đếm
    return $count ; // Trả về true nếu tên đăng nhập đã tồn tại
}
//cập nhật thông tin khách hàng
function update_info_customer($name, $sdt, $address, $email, $user_id) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE khach_hang SET KH_HOTEN = :name, KH_SODIENTHOAI= :sdt, KH_DIACHI = :address, KH_EMAIL = :email WHERE KH_ID = :user_id";
    $stmt = $conn->prepare($sql);
    // Bind các tham số
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':sdt', $sdt);
    $stmt->bindParam(':address', $address);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    
    // Thực thi câu lệnh
    $stmt->execute();
}
//kiêm tra mật khẩu cũ
function check_mk_cu($passold, $tkid){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT COUNT(*) FROM tai_khoan WHERE TK_MK = :passold AND TK_ID = :tkid"; // Sử dụng tham số thay vì nối chuỗi
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':passold', $passold);
    $stmt->bindParam(':tkid', $tkid); // Gán tham số
    $stmt->execute();
    
    // Lấy kết quả
    $count = $stmt->fetchColumn(); // Lấy giá trị đếm
    return $count ; // Trả về true nếu tên đăng nhập đã tồn tại
}
//cập nhật mật khẩu
function update_mk($tendangnhap, $namenew, $tkid){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE tai_khoan SET TK_TENDANGNHAP = :tendangnhap, TK_MK= :namenew WHERE TK_ID = :tkid";

    $stmt = $conn->prepare($sql);
    // Bind các tham số 
    $stmt->bindParam(':tendangnhap', $tendangnhap);
    $stmt->bindParam(':namenew', $namenew);
    $stmt->bindParam(':tkid', $tkid);
    
    // Thực thi câu lệnh
    $stmt->execute();
}
//thêm giỏ hàng
function tao_giohang($idkh){
    $conn = ketnoidb();
    $sql = "INSERT INTO gio_hang (KH_ID) VALUES (:idkh)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh);
    $stmt->execute();

    $last_id = $conn->lastInsertId();
    return $last_id; // Trả về ID giỏ hàng vừa thêm
}
//thêm chi tiết giỏ hàng
function themChiTietGioHang($gh_id, $sp_id, $soluong, $gia) {
    $conn = ketnoidb();

    // Kiểm tra xem đã có sản phẩm này trong giỏ hàng chưa
    $sql = "SELECT COUNT(*) FROM chi_tiet_gio_hang WHERE GH_ID = :gh_id AND SP_MASP = :sp_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':gh_id' => $gh_id, ':sp_id' => $sp_id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        // Nếu đã có thì cập nhật số lượng
        $sql = "UPDATE chi_tiet_gio_hang 
                SET CTGH_SOLUONG = :soluong 
                WHERE GH_ID = :gh_id AND SP_MASP = :sp_id";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':soluong' => $soluong,
            ':gh_id' => $gh_id,
            ':sp_id' => $sp_id
        ]);
    } else {
        // Nếu chưa có thì thêm mới
        $sql = "INSERT INTO chi_tiet_gio_hang (GH_ID, SP_MASP, CTGH_SOLUONG, CTGH_DONGIA) 
                VALUES (:gh_id, :sp_id, :soluong, :gia)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([
            ':gh_id' => $gh_id,
            ':sp_id' => $sp_id,
            ':soluong' => $soluong,
            ':gia' => $gia
        ]);
    }
}

//lấy sản phẩm từ giỏ hàng
function get_giohang($idgh){
    $conn = ketnoidb();
    $sql = "SELECT sp.SP_MASP, sp.SP_TENSP, sp.SP_HINH, ct.CTGH_SOLUONG, ct.CTGH_DONGIA, sp.SP_TRONGLUONG
            FROM san_pham sp
            JOIN chi_tiet_gio_hang ct ON sp.SP_MASP = ct.SP_MASP
            WHERE ct.GH_ID = :idgh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idgh', $idgh, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


//kiểm tra giỏ hàng có đặt hàng chưa
function get_giohang_chua_dat($idcustomer){
    $conn = ketnoidb();

    // Lấy giỏ hàng mới nhất của khách hàng
    $sql = "SELECT GH_ID
            FROM gio_hang
            WHERE KH_ID = :idcustomer
            ORDER BY GH_ID DESC
            LIMIT 1";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idcustomer', $idcustomer);
    $stmt->execute();
    $idgh = $stmt->fetchColumn(); // lấy GH_ID gần nhất

    // Nếu chưa có giỏ hàng nào thì return false
    if (!$idgh) return false;

    // Kiểm tra xem giỏ hàng đó đã nằm trong đơn hàng chưa
    $sql2 = "SELECT COUNT(*) FROM don_hang WHERE GH_ID = :idgh";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->bindParam(':idgh', $idgh);
    $stmt2->execute();
    $count = $stmt2->fetchColumn();

    // Nếu đã tồn tại trong đơn hàng -> return false (đã đặt rồi)
    if ($count > 0) {
        return false;
    }

    // Nếu chưa từng nằm trong đơn hàng -> return id giỏ hàng này
    return $idgh;
}
//xóa sản phẩm cá nhân trong database
function xoa_sp_canhan($idsp, $idkh) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    $sql = "DELETE ct
            FROM chi_tiet_gio_hang ct
            JOIN gio_hang gh ON ct.GH_ID = gh.GH_ID
            WHERE ct.SP_MASP = :idsp AND gh.KH_ID = :idkh";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp', $idsp);
    $stmt->bindParam(':idkh', $idkh);
    $stmt->execute();
}
//cập nhật sl sp trong DB
function capNhatSoLuongSanPham($idgh, $masp, $soluong) {
    $conn = ketnoidb();
    $sql = "UPDATE chi_tiet_gio_hang 
            SET CTGH_SOLUONG = :soluong 
            WHERE GH_ID = :idgh AND SP_MASP = :masp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':soluong', $soluong);
    $stmt->bindParam(':idgh', $idgh);
    $stmt->bindParam(':masp', $masp);
    $stmt->execute();
}
//lấy giá sp theo mã sp
function get_gia($masp){ 
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT dg_new.DG_GIAMOI
                FROM san_pham sp
                JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
                JOIN (
                    SELECT d1.*
                    FROM don_gia d1
                    WHERE d1.DG_NGAYAPDUNG = (
                        SELECT MAX(d2.DG_NGAYAPDUNG)
                        FROM don_gia d2
                        WHERE d2.SP_MASP = d1.SP_MASP
                    )
                ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
                WHERE sp.SP_MASP = :masp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':masp', $masp, PDO::PARAM_INT);
    $stmt->execute();
    $gia = $stmt->fetch(PDO::FETCH_ASSOC);
    return $gia; // Trả về mảng
}
//cập nhật or thêm sp vào giỏ hàng DB
function themHoacCapNhatSanPhamVaoGio($idgh, $masp, $soluong, $gia) {
    $conn = ketnoidb();

    // Kiểm tra sản phẩm đã tồn tại chưa
    $check = $conn->prepare("SELECT * FROM chi_tiet_gio_hang WHERE GH_ID = :idgh AND SP_MASP = :masp");
    $check->bindParam(':idgh', $idgh);
    $check->bindParam(':masp', $masp);
    $check->execute();

    if ($check->rowCount() > 0) {
        // Đã có ⇒ tăng số lượng
        $stmt = $conn->prepare("UPDATE chi_tiet_gio_hang 
                                SET CTGH_SOLUONG = CTGH_SOLUONG + :soluong 
                                WHERE GH_ID = :idgh AND SP_MASP = :masp");
        $stmt->bindParam(':soluong', $soluong);
        $stmt->bindParam(':idgh', $idgh);
        $stmt->bindParam(':masp', $masp);
    } else {
        // Chưa có ⇒ thêm mới (đặt tên tham số khác để tránh lỗi)
        $stmt = $conn->prepare("INSERT INTO chi_tiet_gio_hang(GH_ID, SP_MASP, CTGH_SOLUONG, CTGH_DONGIA)
                                VALUES(:idgh, :masp1, :soluong, :gia)");
        $stmt->bindParam(':idgh', $idgh);
        $stmt->bindParam(':masp1', $masp);
        $stmt->bindParam(':soluong', $soluong);
        $stmt->bindParam(':gia', $gia);
    }

    $stmt->execute();
}
//đếm sl sp trong giỏ hàng của từng khách hàng
function count_sp_gh($idgh){
    $conn = ketnoidb();

    $sql = "SELECT COUNT(*) 
            FROM chi_tiet_gio_hang 
            WHERE GH_ID = :idgh"; 
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idgh', $idgh, PDO::PARAM_INT);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    
    return $count; 
}



?>