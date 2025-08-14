<?php
function count_don_hang_chua_giao($idtk) {
    $conn = ketnoidb();
    $sql = "SELECT COUNT(*) 
FROM don_hang dh
JOIN (
    SELECT ls1.DH_MADH, ls1.TT_MATT
    FROM lich_su_don_hang ls1
    WHERE ls1.LSDH_THOIDIEM = (
        SELECT MAX(ls2.LSDH_THOIDIEM) 
        FROM lich_su_don_hang ls2 
        WHERE ls2.DH_MADH = ls1.DH_MADH
    )
) ls ON dh.DH_MADH = ls.DH_MADH
JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
WHERE tt.TT_TENTT NOT IN ('Giao thành công', 'Đã hủy')
  AND dh.NV_ID = (SELECT NV_ID FROM nhan_vien WHERE TK_ID = :idtk)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idtk', $idtk);
    $stmt->execute();
    return $stmt->fetchColumn();
}
//đếm đơn hàng giao thành công
function count_don_hang_thanh_cong($idtk) {
    $conn = ketnoidb();
    $sql = "SELECT COUNT(*) 
FROM don_hang dh
JOIN (
    SELECT ls1.DH_MADH, ls1.TT_MATT
    FROM lich_su_don_hang ls1
    WHERE ls1.LSDH_THOIDIEM = (
        SELECT MAX(ls2.LSDH_THOIDIEM) 
        FROM lich_su_don_hang ls2 
        WHERE ls2.DH_MADH = ls1.DH_MADH
    )
) ls ON dh.DH_MADH = ls.DH_MADH
JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
WHERE tt.TT_TENTT = 'Giao thành công' 
  AND dh.NV_ID = (SELECT NV_ID FROM nhan_vien WHERE TK_ID = :idtk);
";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idtk', $idtk);
    $stmt->execute();
    return $stmt->fetchColumn();
}
//đếm đơn hàng bị hủy
function count_don_hang_bi_huy($idtk) {
    $conn = ketnoidb();
    $sql = "SELECT COUNT(*) 
FROM don_hang dh
JOIN (
    SELECT ls1.DH_MADH, ls1.TT_MATT
    FROM lich_su_don_hang ls1
    WHERE ls1.LSDH_THOIDIEM = (
        SELECT MAX(ls2.LSDH_THOIDIEM) 
        FROM lich_su_don_hang ls2 
        WHERE ls2.DH_MADH = ls1.DH_MADH
    )
) ls ON dh.DH_MADH = ls.DH_MADH
WHERE ls.TT_MATT IN ('Đã hủy') 
  AND dh.NV_ID = (SELECT NV_ID FROM nhan_vien WHERE TK_ID = :idtk)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idtk', $idtk);
    $stmt->execute();
    return $stmt->fetchColumn();
}
//lấy thông tin nhân viên
function get_info_nv_giaohang($idtk){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM nhan_vien nv, bo_phan bp
            WHERE nv.BP_MABP = bp.BP_MABP
            AND nv.TK_ID = :idtk";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idtk', $idtk);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
//lấy đơn hàng chưa giao của mỗi nhân viên
function get_dh_chua_giao_hang($idtk){
    $conn = ketnoidb(); 
    $sql = "SELECT 
    dh.DH_MADH,
    kh.KH_HOTEN AS ten_khach,
    dh.DH_DIACHINHAN AS dia_chi,
    tt.TT_TENTT,
    tt.TT_MATT
FROM don_hang dh
JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
JOIN nhan_vien nv ON dh.NV_ID = nv.NV_ID
JOIN (
    SELECT ls1.DH_MADH, ls1.TT_MATT
    FROM lich_su_don_hang ls1
    WHERE ls1.LSDH_THOIDIEM = (
        SELECT MAX(ls2.LSDH_THOIDIEM)
        FROM lich_su_don_hang ls2
        WHERE ls2.DH_MADH = ls1.DH_MADH
    )
) AS ls ON dh.DH_MADH = ls.DH_MADH
JOIN trang_thai tt ON ls.TT_MATT = tt.TT_MATT
WHERE tt.TT_TENTT NOT IN ('Giao thành công', 'Đã huỷ')
  AND nv.TK_ID = :idtk;
";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idtk', $idtk);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//lấy đơn hàng đã giao thành công
function get_dh_da_giao_tahnhcong($idtk){
    $conn = ketnoidb(); 
    // $sql = "SELECT 
    //         dh.DH_MADH,
    //         kh.KH_HOTEN AS ten_khach,
    //         kh.KH_DIACHI AS dia_chi,
    //         ls.LSDH_THOIDIEM AS thoi_diem,
    //         tt.TT_TENTT AS trang_thai
    //     FROM lich_su_don_hang ls
    //     JOIN don_hang dh ON ls.DH_MADH = dh.DH_MADH
    //     JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
    //     JOIN nhan_vien nv ON dh.NV_ID = nv.NV_ID
    //     JOIN trang_thai tt ON ls.TT_MATT = tt.TT_MATT
    //     WHERE nv.TK_ID = :idtk AND tt.TT_TENTT = 'Giao Thành công' OR tt.TT_TENTT = 'Đã hủy'
    //     ORDER BY ls.LSDH_THOIDIEM DESC, ls.LSDH_ID DESC";
    $sql = "
            SELECT 
                dh.DH_MADH,
                kh.KH_HOTEN AS ten_khach,
                kh.KH_DIACHI AS dia_chi,
                ls.LSDH_THOIDIEM AS thoi_diem,
                tt.TT_TENTT AS trang_thai
            FROM lich_su_don_hang ls
            JOIN (
                SELECT DH_MADH, MAX(LSDH_ID) AS max_lsdh_id
                FROM lich_su_don_hang
                GROUP BY DH_MADH
            ) newest ON ls.DH_MADH = newest.DH_MADH AND ls.LSDH_ID = newest.max_lsdh_id
            JOIN don_hang dh ON ls.DH_MADH = dh.DH_MADH
            JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
            JOIN nhan_vien nv ON dh.NV_ID = nv.NV_ID
            JOIN trang_thai tt ON ls.TT_MATT = tt.TT_MATT
            WHERE nv.TK_ID = :idtk
            AND (tt.TT_TENTT = 'Giao thành công' OR tt.TT_TENTT = 'Đã hủy')
            ORDER BY ls.LSDH_THOIDIEM DESC, ls.LSDH_ID DESC;
            ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idtk', $idtk);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//lộc nhân viên
function get_all_accounts($role = '') {
    $conn = ketnoidb();

    if ($role === '') {
        // Không lọc vai trò, lấy tất cả
        $sql = "
            SELECT 
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
            WHERE tk.TK_VAITRO = 1
        ";

        $stmt = $conn->prepare($sql);
    } else {
        // Có lọc vai trò
        switch ($role) {
            case '0': // Nhân viên
            case '2': // Admin
                $sql = "
                    SELECT 
                        tk.TK_ID,
                        tk.TK_TENDANGNHAP,
                        tk.TK_VAITRO,
                        tk.TK_TRANGTHAI,
                        nv.NV_ID AS IDLIENKET,
                        nv.NV_HOTEN AS HOTEN,
                        nv.NV_EMAIL AS EMAIL
                    FROM tai_khoan tk
                    JOIN nhan_vien nv ON tk.TK_ID = nv.TK_ID
                    WHERE tk.TK_VAITRO = :role
                ";
                break;

            case '1': // Khách hàng
                $sql = "
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
                    WHERE tk.TK_VAITRO = :role
                ";
                break;

            default:
                return []; // Nếu role không hợp lệ
        }

        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//lấy dinh dưỡng sản phẩm
function get_dinhduong($idsp){
    $conn = ketnoidb();
    $sql = "SELECT * FROM dinh_duong
            WHERE SP_MASP = :idsp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp', $idsp);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result;
}
//thêm dinh dưỡng
function add_dinhduong($idsp, $calo, $dam, $chatbeo, $duong, $chatxo, $natri) {
    $conn = ketnoidb(); // Gọi hàm kết nối CSDL

    if ($conn) {
        $sql = "INSERT INTO dinh_duong (SP_MASP, DD_CALO, DD_DAM, DD_CHATBEO, DD_DUONG, DD_CHATXO, DD_NATRI)
                VALUES (:idsp, :calo, :dam, :chatbeo, :duong, :chatxo, :natri)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':idsp', $idsp);
        $stmt->bindParam(':calo', $calo);
        $stmt->bindParam(':dam', $dam);
        $stmt->bindParam(':chatbeo', $chatbeo);
        $stmt->bindParam(':duong', $duong);
        $stmt->bindParam(':chatxo', $chatxo);
        $stmt->bindParam(':natri', $natri);

        $stmt->execute();
    }
}
//cập nhật dinh dưỡng
function update_dinhduong($idsp, $calo, $dam, $chatbeo, $duong, $chatxo, $natri){
    $conn = ketnoidb(); 

    $sql = "UPDATE dinh_duong SET DD_CALO = :calo, DD_DAM = :dam, DD_CHATBEO = :chatbeo, DD_DUONG = :duong, DD_CHATXO = :chatxo, DD_NATRI = :natri   WHERE SP_MASP = :idsp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':calo', $calo);
    $stmt->bindParam(':dam', $dam);
    $stmt->bindParam(':chatbeo', $chatbeo); 
    $stmt->bindParam(':duong', $duong);  
    $stmt->bindParam(':chatxo', $chatxo); 
    $stmt->bindParam(':natri', $natri); 
    $stmt->bindParam(':idsp', $idsp); 


    $stmt->execute();
}
//lấy thể trạng
function get_thetrang_phuhop($idsp) {
    $conn = ketnoidb(); // hàm kết nối CSDL
    $sql = "SELECT tt.TTRANG_MA, tt.TTRANG_TEN, ph.PH_MOTA
            FROM phuhop ph
            JOIN the_trang tt ON ph.TTRANG_MA = tt.TTRANG_MA
            WHERE ph.SP_MASP = :idsp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp', $idsp);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//lấy thể trạng
function get_thetrang(){
     $conn = ketnoidb();
    $sql = "SELECT * FROM the_trang";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//thêm thể trạng cho sp
function add_phuhop($ttrang_ma, $sp_masp, $mota) {
    $conn = ketnoidb(); // Hàm kết nối CSDL

    $sql = "INSERT INTO phuhop (TTRANG_MA, SP_MASP, PH_MOTA)
            VALUES (:ttrang_ma, :sp_masp, :mota)";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':ttrang_ma', $ttrang_ma);
    $stmt->bindParam(':sp_masp', $sp_masp);
    $stmt->bindParam(':mota', $mota);
    $stmt->execute();
}
//xóa thể trạng phù hợp
function xoa_phuhop_theo_sp($idsp) {
    $conn = ketnoidb();
    $sql = "DELETE FROM phuhop WHERE SP_MASP = :idsp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp', $idsp);
    $stmt->execute();
}
//xóa đánh giá
function xoa_danhgia($iddg) {
    $conn = ketnoidb();
    $sql = "DELETE FROM danhgia_sanpham WHERE DGSP_ID = :iddg";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddg', $iddg);
    $stmt->execute();
}
//cập nhật trạng thói đánh giá
function capnhat_statue_danhgia($madg, $trangthai){
    $conn = ketnoidb(); 

    $sql = "UPDATE danhgia_sanpham SET DGSP_TRANGTHAI = :trangthai WHERE DGSP_ID = :madg";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':trangthai', $trangthai);
    $stmt->bindParam(':madg', $madg);

    $stmt->execute();
}
//lấy khu vực nân viên phụ trách
function get_khuvuc_nv($idnv){
    $conn = ketnoidb();
    $sql = "SELECT  bp.BP_TENBP, px.P_TENPHUONGXA FROM khu_vuc kv, nhan_vien nv, bo_phan bp, phuong_xa px
    WHERE kv.NV_ID = nv.NV_ID 
    AND bp.BP_MABP = nv.BP_MABP
    AND px.P_ID = kv.P_ID
    AND nv.NV_ID = :idnv AND bp.BP_TENBP = 'Giao hàng'
    AND kv.KV_TRANGTHAI = 'Còn hoạt động'";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idnv', $idnv);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    return $result;
}
//lấy số sao
function get_count_sosao_danhgia_canhan() {
    $conn = ketnoidb(); 
    $sql = "SELECT DGSP_SOSAO, COUNT(*) AS soluong
            FROM danhgia_sanpham
            WHERE DGSP_TRANGTHAI = 'Hiện'
            GROUP BY DGSP_SOSAO
            ORDER BY DGSP_SOSAO DESC;
            ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_count_sosao_an() {
    $conn = ketnoidb(); 
    $sql = "SELECT COUNT(*) AS tong_an
            FROM danhgia_sanpham
            WHERE DGSP_TRANGTHAI = 'Ẩn';
            ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
//lấy đánh giá theo bộ lộc
function get_review_cuthe($role) {
    $conn = ketnoidb(); 

    if ($role != '') {
        $sql = "SELECT kh.KH_ID, kh.KH_HOTEN, dh.DH_MADH, dg.DGSP_ID, dg.DGSP_SOSAO, dg.DGSP_TRANGTHAI
                FROM danhgia_sanpham dg
                JOIN don_hang dh ON dg.DH_MADH = dh.DH_MADH
                JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
                WHERE dg.DGSP_SOSAO = :role";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':role', $role, PDO::PARAM_INT);
    } else {
        $sql = "SELECT kh.KH_ID, kh.KH_HOTEN, dh.DH_MADH, dg.DGSP_ID, dg.DGSP_SOSAO, dg.DGSP_TRANGTHAI
                FROM danhgia_sanpham dg
                JOIN don_hang dh ON dg.DH_MADH = dh.DH_MADH
                JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID";
        $stmt = $conn->prepare($sql);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
//lấy lịch sử giá
function get_lichsu_gia($sp_id) {
    $conn = ketnoidb();
    $sql = "SELECT DG_GIAMOI, DG_NGAYAPDUNG FROM don_gia 
            WHERE SP_MASP = :sp_id ORDER BY DG_NGAYAPDUNG DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sp_id', $sp_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function update_login_employee($idtk, $username, $pass){
    $conn = ketnoidb(); 
    $sql = "UPDATE tai_khoan 
            SET TK_TENDANGNHAP = :username, TK_MK = :pass 
            WHERE TK_ID = :idtk";     
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':pass', $pass);
    $stmt->bindParam(':idtk', $idtk);

    $stmt->execute();
}

?>