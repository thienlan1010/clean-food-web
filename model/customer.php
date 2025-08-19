<?php
//lấy info kh và số đơn hàng kể cả kh ko đặt hàng thì = 0
function show_kh_admin(){
    $conn = ketnoidb(); 
    $sql = "SELECT 
        kh.KH_ID, 
        kh.KH_HOTEN, 
        kh.KH_EMAIL, 
        kh.KH_SODIENTHOAI,
        kh.KH_DIACHI,
        COUNT(dh.DH_MADH) AS SODON 
    FROM khach_hang kh
    LEFT JOIN don_hang dh ON kh.KH_ID = dh.KH_ID
    GROUP BY kh.KH_ID, kh.KH_HOTEN, kh.KH_EMAIL, kh.KH_SODIENTHOAI, kh.KH_DIACHI";
    
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    
    return $kq; 
}
//tìm kiếm khách hàng
function search_customer_by_keyword($kyw){
    $conn = ketnoidb(); 
    $sql = "SELECT 
        kh.KH_ID, 
        kh.KH_HOTEN, 
        kh.KH_EMAIL, 
        kh.KH_SODIENTHOAI,
        kh.KH_DIACHI,
        COUNT(dh.DH_MADH) AS SODON 
    FROM khach_hang kh
    LEFT JOIN don_hang dh ON kh.KH_ID = dh.KH_ID
    WHERE kh.KH_ID = :kyw
    GROUP BY kh.KH_ID, kh.KH_HOTEN, kh.KH_EMAIL, kh.KH_SODIENTHOAI, kh.KH_DIACHI";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':kyw', $kyw);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}
//lấy đơn hàng của khách hàng theo mã kh
function get_dh_customer($idkh){
    $conn = ketnoidb(); 
    $sql = "SELECT dh.*, pt.PTTT_TENPT, tt.TT_TENTT
            FROM don_hang dh
            JOIN phuongthuc_thanhtoan pt ON dh.PTTT_ID = pt.PTTT_ID
            JOIN (
                SELECT * FROM lich_su_don_hang ls
                WHERE LSDH_THOIDIEM = (
                    SELECT MAX(LSDH_THOIDIEM) 
                    FROM lich_su_don_hang 
                    WHERE DH_MADH = ls.DH_MADH
                )
            ) ls ON ls.DH_MADH = dh.DH_MADH
            JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
            WHERE dh.KH_ID = :idkh";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//đếm số đơn của khách hàng
function count_don_hang_by_khachhang($idkh) {
    $conn = ketnoidb(); 
    $sql = "SELECT COUNT(*) AS SODON FROM don_hang WHERE KH_ID = :idkh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['SODON'];
}
//lấy đánh giá của khách hàng
function get_review($idkh){
    $conn = ketnoidb(); 
    $sql = "SELECT dg.*, sp.SP_TENSP
            FROM don_hang dh, danhgia_sanpham dg, san_pham sp      
            WHERE dg.SP_MASP = sp.SP_MASP AND dh.DH_MADH = dg.DH_MADH
            AND dh.KH_ID = :idkh";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//lấy nội dung đánh giá qua id đánh giá
function get_review_iddg($iddg){
    $conn = ketnoidb(); 
    $sql = "SELECT dg.*, sp.SP_TENSP, sp.SP_HINH
            FROM don_hang dh, danhgia_sanpham dg, san_pham sp      
            WHERE dg.SP_MASP = sp.SP_MASP AND dh.DH_MADH = dg.DH_MADH
            AND dg.DGSP_ID = :iddg";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddg', $iddg);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
// Đếm số đánh giá của khách hàng
function count_review($idkh) {
    $conn = ketnoidb(); 
    $sql = "SELECT COUNT(*) AS SOREVIEW
            FROM don_hang dh, danhgia_sanpham dg, san_pham sp      
            WHERE dg.SP_MASP = sp.SP_MASP 
              AND dh.DH_MADH = dg.DH_MADH
              AND dh.KH_ID = :idkh";
              
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result['SOREVIEW']; // đúng key
}
//lấy all đơn hàng
function get_all_order($start, $limit, $idtt = ''){
    $conn = ketnoidb(); 
    $sql = "SELECT 
                dh.DH_MADH, 
                dh.DH_TONGTIEN, 
                dh.DH_NGAYDAT, 
                kh.KH_ID, 
                kh.KH_HOTEN, 
                tt.TT_TENTT,
                tt.TT_MATT

            FROM don_hang dh
            JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
            JOIN (
                SELECT * FROM lich_su_don_hang ls
                WHERE LSDH_THOIDIEM = (
                    SELECT MAX(LSDH_THOIDIEM) 
                    FROM lich_su_don_hang 
                    WHERE DH_MADH = ls.DH_MADH
                )
            ) ls ON ls.DH_MADH = dh.DH_MADH
            JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
            "; 
        // Nếu có lọc theo danh mục
    if ($idtt !== '') {
        $sql .= " WHERE tt.TT_MATT = :idtt";
    }

    $sql .= " LIMIT :start, :limit";
    $stmt = $conn->prepare($sql);
    // Gán giá trị
    if ($idtt !== '') {
        $stmt->bindValue(':idtt', $idtt, PDO::PARAM_INT);
    }
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//lấy chi tiết đơn hàng
function get_detail_donhang($iddh){
    $conn = ketnoidb(); 
    $sql = "SELECT 
    dh.DH_MADH, dh.KH_ID, dh.DH_DIEMDADUNG, dh.DH_DIACHINHAN, PG_DONGIA, dh.DH_TONGTIEN, dh.DH_SDT,
    ct.CTDH_SOLUONG,
    ct.CTDH_DONGIA, 
    sp.SP_HINH,
    sp.SP_TENSP, 
    pt.PTTT_TENPT, 
    tt.TT_TENTT

FROM don_hang dh
JOIN chitiet_donhang ct ON dh.DH_MADH = ct.DH_MADH
JOIN san_pham sp ON ct.SP_MASP = sp.SP_MASP
JOIN phuongthuc_thanhtoan pt ON dh.PTTT_ID = pt.PTTT_ID

-- Lấy trạng thái mới nhất từ lịch sử
JOIN (
    SELECT ls1.DH_MADH, ls1.TT_MATT
    FROM lich_su_don_hang ls1
    INNER JOIN (
        SELECT DH_MADH, MAX(LSDH_THOIDIEM) AS latest
        FROM lich_su_don_hang
        GROUP BY DH_MADH
    ) ls2 ON ls1.DH_MADH = ls2.DH_MADH AND ls1.LSDH_THOIDIEM = ls2.latest
) ls ON dh.DH_MADH = ls.DH_MADH

JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
JOIN phi_giao pg ON pg.PG_NGAYAPDUNG = dh.PG_NGAYAPDUNG


WHERE dh.DH_MADH = :iddh
AND dh.KC_ID = pg.KC_ID
AND dh.TL_ID = pg.TL_ID";

    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddh', $iddh);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//lấy all nhân viên
function get_all_nv(){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM nhan_vien nv, bo_phan bp
            WHERE nv.BP_MABP = bp.BP_MABP";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//tìm kiếm nhân viên
function search_employee_by_keyword($kyw){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM nhan_vien nv, bo_phan bp
            WHERE nv.BP_MABP = bp.BP_MABP
            AND nv.NV_ID = :kyw"; 
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':kyw', $kyw);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}
//tìm đánh giá
function search_danhgia_by_keyword($kyw){
    $conn = ketnoidb(); 
    $sql = "SELECT kh.KH_ID, kh.KH_HOTEN, dh.DH_MADH, dg.DGSP_ID, dg.DGSP_SOSAO, dg.DGSP_TRANGTHAI
            FROM danhgia_sanpham dg, don_hang dh, khach_hang kh
            WHERE dg.DH_MADH = dh.DH_MADH
            AND dh.KH_ID= kh.KH_ID
            AND dg.DGSP_ID = :kyw"; 
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':kyw', $kyw);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}
//tìm kiếm đơn hàng
function search_dh_by_id($kyw){
    $conn = ketnoidb(); 
    $sql = "SELECT 
                dh.DH_MADH, 
                dh.DH_TONGTIEN, 
                dh.DH_NGAYDAT, 
                kh.KH_ID, 
                kh.KH_HOTEN, 
                tt.TT_TENTT,
                tt.TT_MATT

            FROM don_hang dh
            JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
            JOIN (
                SELECT * FROM lich_su_don_hang ls
                WHERE LSDH_THOIDIEM = (
                    SELECT MAX(LSDH_THOIDIEM) 
                    FROM lich_su_don_hang 
                    WHERE DH_MADH = ls.DH_MADH
                )
            ) ls ON ls.DH_MADH = dh.DH_MADH
            JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
            WHERE dh.DH_MADH = :kyw
            "; 
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':kyw', $kyw);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}
//lấy info nv
function get_info_nv($idnv){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM nhan_vien nv, bo_phan bp, tai_khoan tk
            WHERE nv.BP_MABP = bp.BP_MABP
            AND tk.TK_ID = nv.TK_ID
            AND nv.NV_ID = :idnv";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idnv', $idnv);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}

//đếm tk nv giao hàng
function count_all_tk_nv(){
    $conn = ketnoidb();
    $sql = "SELECT COUNT(*) FROM tai_khoan WHERE TK_VAITRO = 0"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count; 
}
//đếm tk nv admin
function count_all_tk_admin(){
    $conn = ketnoidb(); 
    $sql = "SELECT COUNT(*) FROM tai_khoan WHERE TK_VAITRO = 2"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count; 
}
//đếm tk nv kh
function count_all_tk_kh(){
    $conn = ketnoidb(); 
    $sql = "SELECT COUNT(*) FROM tai_khoan WHERE TK_VAITRO = 1"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count; 
}
//đếm tk nv admin
function count_all_tk_bk(){
    $conn = ketnoidb(); 
    $sql = "SELECT COUNT(*) FROM tai_khoan WHERE TK_TRANGTHAI = 'Bị khóa'"; 
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $count = $stmt->fetchColumn();
    return $count; 
}
function search_tk_by_id($tk_id){
    $conn = ketnoidb(); 

    // Lấy thông tin tài khoản trước
    $sql = "SELECT * FROM tai_khoan WHERE TK_ID = :tk_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tk_id', $tk_id);
    $stmt->execute();
    $tk = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$tk) return null; // Không tìm thấy tài khoản

    // Tùy theo vai trò tài khoản
    if ($tk['TK_VAITRO'] == 0 || $tk['TK_VAITRO'] == 2) {
        $sql_nv = "SELECT * 
                   FROM nhan_vien nv
                   JOIN bo_phan bp ON nv.BP_MABP = bp.BP_MABP
                   WHERE nv.TK_ID = :tk_id";
        $stmt = $conn->prepare($sql_nv);
        $stmt->bindParam(':tk_id', $tk_id);
        $stmt->execute();
        $nv = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($nv) {
            return array_merge($tk, $nv); // Ghép dữ liệu nếu có
        } else {
            return $tk; // Chỉ trả về tài khoản nếu không tìm thấy nhân viên
        }
    } 
    elseif ($tk['TK_VAITRO'] == 1) {
        $sql_kh = "SELECT * 
                   FROM khach_hang 
                   WHERE TK_ID = :tk_id";
        $stmt = $conn->prepare($sql_kh);
        $stmt->bindParam(':tk_id', $tk_id);
        $stmt->execute();
        $kh = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($kh) {
            return array_merge($tk, $kh);
        } else {
            return $tk;
        }
    }

    // Trường hợp khác (admin chẳng hạn)
    return $tk;
}
//lấy all bộ phận      
function get_bophan(){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM bo_phan";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//thêm tài khoản cho nhân viên
function add_tk_nv($username, $password, $vaitro){
    $conn = ketnoidb();
    $trangthai = "Còn hoạt động";
    $sql = "INSERT INTO tai_khoan (TK_TENDANGNHAP, TK_MK, TK_VAITRO, TK_TRANGTHAI) VALUES (:username, :password, :vaitro, :trangthai)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':vaitro', $vaitro);
     $stmt->bindParam(':trangthai', $trangthai); 
    $stmt->execute();
    $last_id = $conn->lastInsertId();
    return $last_id; // Trả về ID giỏ hàng vừa thêm
}
 //thêm nhân viên
function add_nv($bophan, $hoten, $gioitinh, $sdt, $email, $diachi, $idtk) {
    $conn = ketnoidb();
    $trangthai = "Còn làm";

    $sql = "INSERT INTO nhan_vien (
                BP_MABP, NV_HOTEN, NV_GIOITINH, 
                NV_SODIENTHOAI, NV_EMAIL, NV_DIACHI, 
                NV_TRANGTHAI, TK_ID
            ) VALUES (
                :bophan, :hoten, :gioitinh, 
                :sdt, :email, :diachi, 
                :trangthai, :idtk
            )";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':bophan', $bophan);
    $stmt->bindParam(':hoten', $hoten);
    $stmt->bindParam(':gioitinh', $gioitinh);
    $stmt->bindParam(':sdt', $sdt);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':diachi', $diachi);
    $stmt->bindParam(':trangthai', $trangthai);
    $stmt->bindParam(':idtk', $idtk);
    
    $stmt->execute();
}
//tìm danh mục
function search_dm_by_id($kyw){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM danh_muc WHERE DM_TENDM LIKE :kyw";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':kyw', "%$kyw%");
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
//lấy all tài khoản
function get_all_tai_khoan() {
    $conn = ketnoidb();
    $sql = "SELECT 
                tk.TK_ID,
                tk.TK_TENDANGNHAP,
                tk.TK_VAITRO,
                tk.TK_TRANGTHAI,
                nv.NV_ID AS IDLIENKET,
                nv.NV_HOTEN AS HOTEN,
                nv.NV_EMAIL AS EMAIL
            FROM tai_khoan tk
            JOIN nhan_vien nv ON tk.TK_ID = nv.TK_ID
            WHERE tk.TK_VAITRO IN (0, 2)

            UNION

            SELECT 
                tk.TK_ID,
                tk.TK_TENDANGNHAP,
                tk.TK_VAITRO,
                tk.TK_TRANGTHAI,
                kh.KH_ID AS IDLIENKET,
                kh.KH_HOTEN AS HOTEN,
                kh.KH_EMAIL AS EMAIL
            FROM tai_khoan tk
            JOIN khach_hang kh ON tk.TK_ID = kh.TK_ID
            WHERE tk.TK_VAITRO = 1";

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//chi tiết kh
function get_kh($id){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM khach_hang kh, tai_khoan tk 
    WHERE tk.TK_ID = kh.TK_ID
    AND KH_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}
//chi tiết nv
function get_nv($id){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM nhan_vien nv, tai_khoan tk, bo_phan bp
    WHERE nv.TK_ID = tk.TK_ID 
    AND nv.BP_MABP = bp.BP_MABP
    AND NV_ID = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $result;
}
//lấy all trạng thái
function get_tt(){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM trang_thai";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    return $result;
}
//cập nhật trạng thái đơn hàng
// function update_stutas_order($madh, $trangthai){ 
//     $conn = ketnoidb();
//     // Ghi vào bảng lịch sử trạng thái
//     $sql = "INSERT INTO lich_su_don_hang (DH_MADH, TT_MATT)
//              VALUES (:madh, :trangthai)";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([':madh' => $madh, ':trangthai' => $trangthai]);
// }
function update_stutas_order($madh, $trangthai,$trangthai_cu) {
    $conn = ketnoidb();

    // 1. Ghi vào bảng lịch sử trạng thái
    $sql = "INSERT INTO lich_su_don_hang (DH_MADH, TT_MATT)
            VALUES (:madh, :trangthai)";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':madh' => $madh, ':trangthai' => $trangthai]);

    // 2. Nếu trạng thái là 'Giao thành công' thì cập nhật hạn QR
    if ($trangthai == 4) { // thay bằng mã trạng thái thực tế
        // Lấy thời điểm vừa insert vào LSDH
        $sql_time = "SELECT LSDH_THOIDIEM 
                     FROM lich_su_don_hang 
                     WHERE DH_MADH = :madh 
                       AND TT_MATT = :trangthai
                     ORDER BY LSDH_ID DESC LIMIT 1";
        $stmt_time = $conn->prepare($sql_time);
        $stmt_time->execute([':madh' => $madh, ':trangthai' => $trangthai]);
        $row = $stmt_time->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            // Tính ngày hết hạn QR = LSDH_THOIDIEM + 3 ngày
            $expiry = date('Y-m-d H:i:s', strtotime($row['LSDH_THOIDIEM'] . ' +3 days'));

            // Cập nhật vào bảng đơn hàng
            $sql_update = "UPDATE don_hang 
                           SET DH_HANQR = :expiry 
                           WHERE DH_MADH = :madh";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->execute([':expiry' => $expiry, ':madh' => $madh]);
        }
    }
    // 3. Nếu trạng thái chuyển từ GIAO_THANH_CONG → trạng thái khác thì đặt DH_HANQR = NULL
    if ($trangthai_cu == 'GIAO_THANH_CONG' && $trangthai != 'GIAO_THANH_CONG') {
        $sql_update = "UPDATE don_hang SET DH_HANQR = NULL WHERE DH_MADH = :madh";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->execute([':madh' => $madh]);
    }
}

//cập nhật trạng thái nhân viên
function update_stutas_employee($manv, $trangthai){ 
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE nhan_vien SET NV_TRANGTHAI = :trangthai WHERE NV_ID = :manv";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':manv', $manv);
    $stmt->bindParam(':trangthai', $trangthai);
    $stmt->execute();
}
//cập nhật trạng thái tài khoản
function update_stutas_tk($idtk, $trangthai){ 
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE tai_khoan SET TK_TRANGTHAI = :trangthai WHERE TK_ID = :idtk";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':idtk', $idtk );
    $stmt->bindParam(':trangthai', $trangthai);
    $stmt->execute();
}

?>