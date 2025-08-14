<?php
//lấy thông tin cho xuất hóa đơn
function get_info_hoadon($madon){
    $conn = ketnoidb();
    $sql = "SELECT  kh.KH_ID, kh.KH_HOTEN, dh.DH_MADH, dh.DH_NGAYDAT, ct.CTDH_SOLUONG, ct.CTDH_DONGIA, sp.SP_TENSP, pg.PG_DONGIA, dh.DH_DIEMDADUNG, dh.DH_DIEMCONG FROM don_hang dh 
            JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
            JOIN chitiet_donhang ct ON ct.DH_MADH = dh.DH_MADH
            JOIN san_pham sp ON sp.SP_MASP = ct.SP_MASP
            JOIN phi_giao pg ON pg.PG_NGAYAPDUNG = dh.PG_NGAYAPDUNG 
            WHERE dh.DH_MADH = :madon
            AND dh.KC_ID = pg.KC_ID
            AND dh.TL_ID = pg.TL_ID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':madon', $madon, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_diem_datich($makh){
    $conn = ketnoidb();
    $sql = "SELECT KH_DIEMTICHLUY FROM khach_hang WHERE KH_ID = :makh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':makh', $makh, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchColumn(); // Sửa đúng tại đây
}
//lấy 3 đánh giá
function get_3_danhgia($masp) {
    $conn = ketnoidb();
    $sql = "SELECT dgsp.*, tk.TK_TENDANGNHAP
            FROM danhgia_sanpham dgsp
            JOIN don_hang dh ON dgsp.DH_MADH = dh.DH_MADH
            JOIN khach_hang kh ON kh.KH_ID = dh.KH_ID
            JOIN tai_khoan tk ON tk.TK_ID = kh.TK_ID
            WHERE dgsp.SP_MASP = :masp AND dgsp.DGSP_TRANGTHAI = 'Hiện'
            ORDER BY dgsp.DGSP_NGAYDANHGIA DESC
            LIMIT 3";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':masp' => $masp]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Hàm lấy đánh giá theo trang + lọc sao
function get_reviews_paginated($id, $start, $limit, $sao = '') {
    $conn = ketnoidb();

    $sql = "SELECT dgsp.*, tk.TK_TENDANGNHAP, kh.KH_HOTEN, sp.SP_TENSP
            FROM danhgia_sanpham dgsp
            JOIN don_hang dh ON dgsp.DH_MADH = dh.DH_MADH
            JOIN khach_hang kh ON kh.KH_ID = dh.KH_ID
            JOIN tai_khoan tk ON tk.TK_ID = kh.TK_ID
            JOIN san_pham sp ON sp.SP_MASP = dgsp.SP_MASP
            WHERE dgsp.SP_MASP = :id
              AND dgsp.DGSP_TRANGTHAI = 'Hiện'";

    // Nếu có lọc theo số sao
    if ($sao !== '') {
        $sql .= " AND dgsp.DGSP_SOSAO = :sao";
    }

    $sql .= " ORDER BY dgsp.DGSP_NGAYDANHGIA DESC
              LIMIT :start, :limit";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':id', $id, PDO::PARAM_INT);
    if ($sao !== '') {
        $stmt->bindValue(':sao', $sao, PDO::PARAM_INT);
    }
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Đếm số lượng đánh giá
function count_reviews($masp, $sao = '') {
    $conn = ketnoidb();
    $sql = "SELECT COUNT(*) FROM danhgia_sanpham WHERE SP_MASP = :masp";
    if ($sao !== '') {
        $sql .= " AND DGSP_SOSAO = :sao";
    }

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':masp', $masp, PDO::PARAM_INT);
    if ($sao !== '') {
        $stmt->bindValue(':sao', $sao, PDO::PARAM_INT);
    }
    $stmt->execute();

    return $stmt->fetchColumn();
}
//đếm sl đánh giá theo sao
function get_rating_statistics($masp) {
    $conn = ketnoidb();
    $sql = "SELECT DGSP_SOSAO, COUNT(*) as total
            FROM danhgia_sanpham 
            WHERE SP_MASP = :masp AND DGSP_TRANGTHAI = 'Hiện'
            GROUP BY DGSP_SOSAO";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':masp' => $masp]);

    $stats = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $stats[$row['DGSP_SOSAO']] = $row['total'];
    }

    return $stats;
}
//tình avg sao
function get_avg_rating($masp) {
    $conn = ketnoidb();
    $sql = "SELECT AVG(DGSP_SOSAO) as avg_star, COUNT(*) as total
            FROM danhgia_sanpham 
            WHERE SP_MASP = :masp AND DGSP_TRANGTHAI = 'Hiện'";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':masp' => $masp]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
//lấy tên sp
function get_tensp($masp){
    $conn = ketnoidb();
    $sql = "SELECT SP_TENSP
            FROM san_pham
            WHERE SP_MASP = :masp";

    $stmt = $conn->prepare($sql);
    $stmt->execute([':masp' => $masp]);
    return $stmt->fetchColumn(); // Chỉ cần fetchColumn() là đủ
}
function get_soluong_trong_gio($idgh, $masp) {
    $conn = ketnoidb();
    $sql = "SELECT CTGH_SOLUONG FROM chi_tiet_gio_hang WHERE GH_ID = ? AND SP_MASP = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$idgh, $masp]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? intval($row['CTGH_SOLUONG']) : 0;
}
function get_soluong_ton($masp) {
    $conn = ketnoidb();
    $sql = "SELECT SP_SLTON FROM san_pham WHERE SP_MASP = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$masp]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? intval($row['SP_SLTON']) : 0;
}
//lấy id tl, kc, ngày áp dụng và đơn giá
function get_phi_giao($km, $trongluong) {
    $conn = ketnoidb();

    // 1. Tìm phạm vi khoảng cách phù hợp
    $sql1 = "SELECT KC_ID FROM dinhmuc_khoangcach WHERE KC_CANTREN <= :km AND KC_CANDUOI >= :km LIMIT 1";
    $stmt1 = $conn->prepare($sql1);
    $stmt1->execute([':km' => $km]);
    $row1 = $stmt1->fetch(PDO::FETCH_ASSOC);
    $phamvi_id = $row1 ? $row1['KC_ID'] : null;

    // 2. Tìm phạm vi khối lượng phù hợp
    $sql2 = "SELECT TL_ID FROM dinhmuc_trongluong WHERE TL_CANTREN <= :tl AND TL_CANDUOI >= :tl LIMIT 1";
    $stmt2 = $conn->prepare($sql2);
    $stmt2->execute([':tl' => $trongluong]);
    $row2 = $stmt2->fetch(PDO::FETCH_ASSOC);
    $khoiluong_id = $row2 ? $row2['TL_ID'] : null;

    if ($phamvi_id && $khoiluong_id) {
        // 3. Tìm dòng phí giao hàng mới nhất
        $sql3 = "SELECT KC_ID, TL_ID, PG_NGAYAPDUNG
                 FROM phi_giao 
                 WHERE KC_ID = :kc_id AND TL_ID = :tl_id
                 ORDER BY PG_NGAYAPDUNG DESC
                 LIMIT 1";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute([
            ':kc_id' => $phamvi_id,
            ':tl_id' => $khoiluong_id
        ]);
        $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

        return $row3; // Trả về mảng chứa KC_ID, TL_ID, PG_NGAYAPDUNG
    }

    return null; // Trường hợp không tìm thấy
}
function get_phigiao($start, $limit){
    $conn = ketnoidb();
    $sql = "SELECT  kc.KC_CANTREN, kc.KC_CANDUOI, tl.TL_CANTREN, tl.TL_CANDUOI, pg.PG_DONGIA, pg.PG_NGAYAPDUNG, pg.KC_ID, pg.TL_ID
            FROM phi_giao pg 
            JOIN dinhmuc_khoangcach kc ON kc.KC_ID = pg.KC_ID
            JOIN dinhmuc_trongluong tl ON tl.TL_ID = pg.TL_ID
            ORDER BY kc.KC_CANTREN ASC, kc.KC_CANDUOI ASC, tl.TL_CANTREN ASC, tl.TL_CANDUOI ASC";                
           // Thêm phân trang
    $sql .= " LIMIT :start, :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function get_phigiao_two($start, $limit){
    $conn = ketnoidb();
    $sql = "SELECT 
            kc.KC_CANTREN, kc.KC_CANDUOI,
            tl.TL_CANTREN, tl.TL_CANDUOI,
            pg.PG_DONGIA, pg.PG_NGAYAPDUNG,
            pg.KC_ID, pg.TL_ID
            FROM phi_giao pg
            JOIN (
                SELECT KC_ID, TL_ID, MAX(PG_NGAYAPDUNG) AS max_date
                FROM phi_giao
                GROUP BY KC_ID, TL_ID
            ) latest ON pg.KC_ID = latest.KC_ID AND pg.TL_ID = latest.TL_ID AND pg.PG_NGAYAPDUNG = latest.max_date
            JOIN dinhmuc_khoangcach kc ON kc.KC_ID = pg.KC_ID
            JOIN dinhmuc_trongluong tl ON tl.TL_ID = pg.TL_ID
            ORDER BY kc.KC_CANTREN ASC, kc.KC_CANDUOI ASC, tl.TL_CANTREN ASC, tl.TL_CANDUOI ASC";                
           // Thêm phân trang
    $sql .= " LIMIT :start, :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function add_phigiao($kc_ct, $kc_cd, $tl_ct, $tl_cd, $phi, $ngay) {
    $conn = ketnoidb();

    // 1. Thêm khoảng cách
    // Kiểm tra xem khoảng cách đã tồn tại chưa
    $sqlCheckKC = "SELECT KC_ID FROM dinhmuc_khoangcach 
                WHERE KC_CANTREN = :kc_ct AND KC_CANDUOI = :kc_cd";
    $stmtCheckKC = $conn->prepare($sqlCheckKC);
    $stmtCheckKC->bindParam(':kc_ct', $kc_ct);
    $stmtCheckKC->bindParam(':kc_cd', $kc_cd);
    $stmtCheckKC->execute();

    if ($stmtCheckKC->rowCount() > 0) {
        $kc_id = $stmtCheckKC->fetchColumn(); // lấy KC_ID đã tồn tại
    } else {
        // Chưa có thì insert mới
        $sqlInsertKC = "INSERT INTO dinhmuc_khoangcach (KC_CANTREN, KC_CANDUOI)
                        VALUES (:kc_ct, :kc_cd)";
        $stmtInsertKC = $conn->prepare($sqlInsertKC);
        $stmtInsertKC->bindParam(':kc_ct', $kc_ct);
        $stmtInsertKC->bindParam(':kc_cd', $kc_cd);
        $stmtInsertKC->execute();
        $kc_id = $conn->lastInsertId();
    }


    // 2. Thêm trọng lượng
    // Kiểm tra trọng lượng đã tồn tại chưa
    $sqlCheckTL = "SELECT TL_ID FROM dinhmuc_trongluong 
                WHERE TL_CANTREN = :tl_ct AND TL_CANDUOI = :tl_cd";
    $stmtCheckTL = $conn->prepare($sqlCheckTL);
    $stmtCheckTL->bindParam(':tl_ct', $tl_ct);
    $stmtCheckTL->bindParam(':tl_cd', $tl_cd);
    $stmtCheckTL->execute();

    if ($stmtCheckTL->rowCount() > 0) {
        $tl_id = $stmtCheckTL->fetchColumn(); // lấy TL_ID đã tồn tại
    } else {
        // Chưa có thì insert mới
        $sqlInsertTL = "INSERT INTO dinhmuc_trongluong (TL_CANTREN, TL_CANDUOI)
                        VALUES (:tl_ct, :tl_cd)";
        $stmtInsertTL = $conn->prepare($sqlInsertTL);
        $stmtInsertTL->bindParam(':tl_ct', $tl_ct);
        $stmtInsertTL->bindParam(':tl_cd', $tl_cd);
        $stmtInsertTL->execute();
        $tl_id = $conn->lastInsertId();
    }

    // 3. Thêm phí giao tương ứng
    $sql3 = "INSERT INTO phi_giao (KC_ID, TL_ID, PG_DONGIA, PG_NGAYAPDUNG)
             VALUES (:kc_id, :tl_id, :phi, :ngay)";
    $stmt3 = $conn->prepare($sql3);
    $stmt3->bindParam(':kc_id', $kc_id);
    $stmt3->bindParam(':tl_id', $tl_id);
    $stmt3->bindParam(':phi', $phi);
    $stmt3->bindParam(':ngay', $ngay);
    $stmt3->execute();
}
function get_info_fee($date, $idkc, $idtl){
    $conn = ketnoidb();
    $sql = "SELECT kc.KC_ID, kc.KC_CANTREN, kc.KC_CANDUOI,
                   tl.TL_ID, tl.TL_CANTREN, tl.TL_CANDUOI,
                   pg.PG_DONGIA, pg.PG_NGAYAPDUNG
            FROM phi_giao pg 
            JOIN dinhmuc_khoangcach kc ON kc.KC_ID = pg.KC_ID
            JOIN dinhmuc_trongluong tl ON tl.TL_ID = pg.TL_ID
            WHERE pg.PG_NGAYAPDUNG = :date
              AND pg.KC_ID = :idkc
              AND pg.TL_ID = :idtl";

    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':idkc', $idkc);
    $stmt->bindValue(':idtl', $idtl);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function update_phigiao($kc_cantren, $kc_canduoi, $tl_cantren, $tl_canduoi, $idkc, $idtl, $phi, $ngay, $ngayhientai){
    $conn = ketnoidb(); 

    // Cập nhật bảng phi_giao
    $sql_phi = "UPDATE phi_giao 
                SET PG_DONGIA = :phi, PG_NGAYAPDUNG = :ngay
                WHERE KC_ID = :idkc AND TL_ID = :idtl";
    $stmt_phi = $conn->prepare($sql_phi);
    $stmt_phi->bindParam(':phi', $phi);
    $stmt_phi->bindParam(':ngay', $ngay);
    $stmt_phi->bindParam(':idkc', $idkc);
    $stmt_phi->bindParam(':idtl', $idtl);
    $stmt_phi->execute();

    // Cập nhật bảng khoang_cach
    $sql_kc = "UPDATE dinhmuc_khoangcach 
               SET KC_CANTREN = :kc_cantren, KC_CANDUOI = :kc_canduoi
               WHERE KC_ID = :idkc";
    $stmt_kc = $conn->prepare($sql_kc);
    $stmt_kc->bindParam(':kc_cantren', $kc_cantren);
    $stmt_kc->bindParam(':kc_canduoi', $kc_canduoi);
    $stmt_kc->bindParam(':idkc', $idkc);
    $stmt_kc->execute();

    // Cập nhật bảng trong_luong
    $sql_tl = "UPDATE dinhmuc_trongluong 
               SET TL_CANTREN = :tl_cantren, TL_CANDUOI = :tl_canduoi
               WHERE TL_ID = :idtl";
    $stmt_tl = $conn->prepare($sql_tl);
    $stmt_tl->bindParam(':tl_cantren', $tl_cantren);
    $stmt_tl->bindParam(':tl_canduoi', $tl_canduoi);
    $stmt_tl->bindParam(':idtl', $idtl);
    $stmt_tl->execute();
}
//lất all tên sp
function check_name_product($tensp){
    $conn = ketnoidb();
    $sql = "SELECT * FROM san_pham WHERE SP_TENSP = :tensp"; 
            
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tensp', $tensp, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->rowCount() > 0; // true nếu có trùng, false nếu chưa
}
function get_id_nv($idtk){
    $conn = ketnoidb();
    $sql = "SELECT NV_ID FROM nhan_vien WHERE TK_ID = :idtk"; 
            
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idtk', $idtk, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchColumn(); // Trả về giá trị NV_ID
}
function get_img_cu($idsp){
     $conn = ketnoidb();
    $sql = "SELECT SP_HINH FROM san_pham WHERE SP_MASP = :idsp"; 
            
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp', $idsp, PDO::PARAM_STR);
    $stmt->execute();

    return $stmt->fetchColumn(); // Trả về giá trị NV_ID
}
?>