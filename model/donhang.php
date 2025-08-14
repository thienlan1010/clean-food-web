<?php
function add_donhang($idgh, $phuong_id, $idkh, $pttt, $hoten, $sdt, $diachi_daydu, $tongdonhang, $dungdiem, $diemcong, $id_kc, $id_tl, $date_apdung){
    $conn = ketnoidb();
    $sql = "INSERT INTO don_hang (GH_ID, P_ID, KH_ID, PTTT_ID, DH_TENNGUOINHAN, DH_SDT, DH_DIACHINHAN, DH_TONGTIEN, DH_DIEMDADUNG, DH_DIEMCONG, KC_ID, TL_ID, PG_NGAYAPDUNG)
            VALUES (:idgh, :phuong_id, :idkh, :pttt, :hoten, :sdt, :diachi_daydu, :tongdonhang, :dungdiem, :diemcong, :id_kc, :id_tl, :date_apdung)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idgh', $idgh);
    $stmt->bindParam(':phuong_id', $phuong_id);
    $stmt->bindParam(':idkh', $idkh);
    $stmt->bindParam(':pttt', $pttt);
    $stmt->bindParam(':hoten', $hoten);
    $stmt->bindParam(':sdt', $sdt);
    $stmt->bindParam(':diachi_daydu', $diachi_daydu);
    $stmt->bindParam(':tongdonhang', $tongdonhang);
    $stmt->bindParam(':dungdiem', $dungdiem);
    $stmt->bindParam(':diemcong', $diemcong);
    $stmt->bindParam(':id_kc', $id_kc);
    $stmt->bindParam(':id_tl', $id_tl);
    $stmt->bindParam(':date_apdung', $date_apdung);

    $stmt->execute();

    $last_id = $conn->lastInsertId();
    return $last_id; // Trả về ID đơn hàng
}

//lấy quận
// function get_quan(){
//     $conn = ketnoidb(); 
//     $sql = "SELECT * FROM quan_huyen";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();
//     $stmt->setFetchMode(PDO::FETCH_ASSOC);
//     $dm = $stmt->fetchAll();
    
//     return $dm; 
// }
//lấy phường
function get_phuong(){
    $conn = ketnoidb(); 
    $sql = "SELECT *
            FROM phuong_xa px
            WHERE px.P_ID NOT IN (
            SELECT kv.P_ID
            FROM khu_vuc kv
            WHERE kv.KV_TRANGTHAI = 'Còn hoạt động')";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    
    return $dm; 
}
//cập nhật điểm đã dùng của khách hàng
function update_diem($idkh, $dungdiem){
    $conn = ketnoidb(); 

    $sql = "UPDATE khach_hang SET KH_DIEMTICHLUY = KH_DIEMTICHLUY - :dungdiem WHERE KH_ID = :idkh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh, PDO::PARAM_INT);
    $stmt->bindParam(':dungdiem', $dungdiem, PDO::PARAM_INT); 

    $stmt->execute();
        
}

//lấy tên phường 
function get_name_phuong($phuong_id){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "SELECT P_TENPHUONGXA FROM phuong_xa WHERE P_ID = :phuong_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':phuong_id', $phuong_id, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result ? $result['P_TENPHUONGXA'] : null;
}
//lấy tên quận
// function get_name_quan($quan_id){
//     $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
//     $sql = "SELECT Q_TENQUANHUYEN FROM quan_huyen WHERE Q_ID = :quan_id";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':quan_id', $quan_id, PDO::PARAM_INT);
//     $stmt->execute();
//     $result = $stmt->fetch(PDO::FETCH_ASSOC);
//     return $result ? $result['Q_TENQUANHUYEN'] : null;
// }
//lấy thông tin đơn hàng
function get_info_donhang($idgh){
    $conn = ketnoidb(); 
    $sql = "SELECT DH_TENNGUOINHAN, DH_SDT, DH_DIACHINHAN FROM don_hang dh WHERE DH_MADH = :idgh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idgh', $idgh);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetch();
    
    return $dm; 
}
function add_detail_donhang($iddh, $masp, $sl, $dg){
     $conn = ketnoidb();
    $sql = "INSERT INTO chitiet_donhang (DH_MADH, SP_MASP, CTDH_SOLUONG, CTDH_DONGIA)
            VALUES (:iddh, :masp, :sl, :dg)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddh', $iddh);
    $stmt->bindParam(':masp', $masp);
    $stmt->bindParam(':sl', $sl);
    $stmt->bindParam(':dg', $dg);
   
    $stmt->execute();
}
//cập nhật điểm tích lũy cho khách hàng sau khi đặt hàng => hiện tại cứ vậy sau này phát triển tới mã QR -> liên quan tới admin và đơn hàng giao thành công
function update_diem_tich_luy($idkh, $diemcong){
     $conn = ketnoidb(); 

    $sql = "UPDATE khach_hang SET KH_DIEMTICHLUY = KH_DIEMTICHLUY + :diemcong WHERE KH_ID = :idkh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh, PDO::PARAM_INT);
    $stmt->bindParam(':diemcong', $diemcong, PDO::PARAM_INT); 

    $stmt->execute();
}
//cập nhật sản phẩm trong DB
function capnhat_sl_sp($idsp, $soluong){
    $conn = ketnoidb(); 
    $sql = "UPDATE san_pham SET SP_SLTON = SP_SLTON - :soluong WHERE SP_MASP = :idsp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':soluong', $soluong, PDO::PARAM_INT);
    $stmt->bindParam(':idsp', $idsp, PDO::PARAM_INT); 

    $stmt->execute();
}
//lấy số lượng tồn của sản phẩm trong giỏ hàng
function getall_item($idsp){
     $conn = ketnoidb(); 
    $sql = "SELECT SP_SLTON FROM san_pham WHERE SP_MASP = :idsp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp', $idsp);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetch();
    return $dm; 
}
//lấy trạng thái đơn hàng
function get_status_order($iddh){
    $conn = ketnoidb(); 
    $sql = "SELECT tt.TT_TENTT
            FROM don_hang dh
            JOIN (
                SELECT ls1.DH_MADH, ls1.TT_MATT
                FROM lich_su_don_hang ls1
                WHERE ls1.LSDH_THOIDIEM = (
                    SELECT MAX(ls2.LSDH_THOIDIEM)
                    FROM lich_su_don_hang ls2
                    WHERE ls2.DH_MADH = ls1.DH_MADH
                )
            ) latest_ls ON dh.DH_MADH = latest_ls.DH_MADH
            JOIN trang_thai tt ON latest_ls.TT_MATT = tt.TT_MATT
            WHERE dh.DH_MADH = :iddh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddh', $iddh);
    $stmt->execute();
    $dm = $stmt->fetch(PDO::FETCH_ASSOC);
    return $dm['TT_TENTT'] ?? ''; 
}
//thêm trạng thái đơn hàng
function add_statue_order($iddh){
    $conn = ketnoidb();
    $sql = "INSERT INTO lich_su_don_hang (DH_MADH, TT_MATT)
            VALUES (:iddh, 1)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddh', $iddh);
   
    $stmt->execute();
}
//lấy all đơn hàng chưa phân công
function get_order_chua_phancong($start, $limit){
    $conn = ketnoidb(); 
    $sql = "SELECT 
            dh.DH_MADH, 
            dh.DH_NGAYDAT, 
            dh.KH_ID, 
            kh.KH_HOTEN, 
            dh.DH_DIACHINHAN, 
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
        ) ls ON dh.DH_MADH = ls.DH_MADH
        JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
        WHERE tt.TT_TENTT NOT IN ('Giao thành công', 'Hủy đơn') 
        AND dh.NV_ID IS NULL
        ";
    $sql .= " LIMIT :start, :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    return $dm; 
}
//lấy nhân viên
function get_nv_giaohang(){
    $conn = ketnoidb(); 
    $sql = "SELECT nv.*, kv.*, px.* FROM nhan_vien nv, khu_vuc kv, phuong_xa px
    WHERE nv.NV_ID = kv.NV_ID
    AND px.P_ID = kv.P_ID
    AND BP_MABP = 1 AND NV_TRANGTHAI = 'Còn làm'
    AND kv.KV_TRANGTHAI = 'Còn hoạt động'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    return $dm; 
}
//phân công nhân viên giao hàng
function phancong_giaohang($madon, $nv_id){
    $conn = ketnoidb(); 

    $sql = "UPDATE don_hang SET NV_ID =  :nv_id WHERE DH_MADH = :madon";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nv_id', $nv_id, PDO::PARAM_INT);
    $stmt->bindParam(':madon', $madon, PDO::PARAM_INT);
    
    $stmt->execute();
}
//lấy đơn hàng đã phân công
function get_don_da_phancong($start, $limit){
    $conn = ketnoidb(); 
   $sql = "SELECT 
                dh.DH_MADH, 
                dh.DH_NGAYDAT, 
                dh.KH_ID, 
                kh.KH_HOTEN, 
                dh.DH_DIACHINHAN, 
                tt.TT_TENTT,
                tt.TT_MATT,
                nv.NV_HOTEN
            FROM don_hang dh
            JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
            JOIN nhan_vien nv ON dh.NV_ID = nv.NV_ID
            JOIN (
                SELECT * FROM lich_su_don_hang ls
                WHERE LSDH_THOIDIEM = (
                    SELECT MAX(LSDH_THOIDIEM) 
                    FROM lich_su_don_hang 
                    WHERE DH_MADH = ls.DH_MADH
                )
            ) ls ON dh.DH_MADH = ls.DH_MADH
            JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
            WHERE dh.NV_ID IS NOT NULL
            ";
    $sql .= " LIMIT :start, :limit";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    return $dm; 
}
//phân công đơn hàng tự động
function phancong_tudong() {
    $conn = ketnoidb();

    // 1. Lấy danh sách đơn hàng chưa được phân công
    $sql = "SELECT dh.DH_MADH, dh.P_ID, px.P_TENPHUONGXA
            FROM don_hang dh
            JOIN phuong_xa px ON dh.P_ID = px.P_ID           
            WHERE dh.NV_ID IS NULL";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $donhangs = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // 2. Duyệt qua từng đơn hàng để phân công
    foreach ($donhangs as $dh) {
        $madh = $dh['DH_MADH'];
        $px_id = $dh['P_ID'];

        // Tìm nhân viên giao hàng phụ trách quận này
        $sql_nv = "SELECT NV_ID FROM khu_vuc WHERE P_ID = :px_id LIMIT 1";
        $stmt_nv = $conn->prepare($sql_nv);
        $stmt_nv->bindParam(':px_id', $px_id, PDO::PARAM_STR);
        $stmt_nv->execute();
        $nv = $stmt_nv->fetch(PDO::FETCH_ASSOC);

        if ($nv) {
            // Cập nhật nhân viên vào đơn hàng
            $sql_update = "UPDATE don_hang SET NV_ID = :nv_id WHERE DH_MADH = :madh";
            $stmt_upd = $conn->prepare($sql_update);
            $stmt_upd->bindParam(':nv_id', $nv['NV_ID'], PDO::PARAM_INT);
            $stmt_upd->bindParam(':madh', $madh, PDO::PARAM_INT);
            $stmt_upd->execute();
        }
    }
}
//tìm đơn hàng đã phân công
function search_dh_dapc_by_id($kyw){
    $conn = ketnoidb(); 
   $sql = "SELECT 
                dh.DH_MADH, 
                dh.DH_NGAYDAT, 
                dh.KH_ID, 
                kh.KH_HOTEN, 
                dh.DH_DIACHINHAN, 
                tt.TT_TENTT,
                tt.TT_MATT,
                nv.NV_HOTEN
            FROM don_hang dh
            JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
            JOIN nhan_vien nv ON dh.NV_ID = nv.NV_ID
            JOIN (
                SELECT * FROM lich_su_don_hang ls
                WHERE LSDH_THOIDIEM = (
                    SELECT MAX(LSDH_THOIDIEM) 
                    FROM lich_su_don_hang 
                    WHERE DH_MADH = ls.DH_MADH
                )
            ) ls ON dh.DH_MADH = ls.DH_MADH
            JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
            WHERE dh.NV_ID IS NOT NULL AND dh.DH_MADH = :kyw
            ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':kyw', $kyw, PDO::PARAM_INT);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    return $dm; 
}
//lấy all đánh giá
function get_all_danhgia(){
    $conn = ketnoidb(); 
    $sql = "SELECT kh.KH_ID, kh.KH_HOTEN, dh.DH_MADH, dg.DGSP_ID, dg.DGSP_SOSAO, dg.DGSP_TRANGTHAI
            FROM danhgia_sanpham dg, don_hang dh, khach_hang kh
            WHERE dg.DH_MADH = dh.DH_MADH 
            AND dh.KH_ID = kh.KH_ID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    return $dm; 
}
//lấy số trạng thái -> biểu đồ trong
function get_count_status_order(){
    $conn = ketnoidb(); 
    $sql = "SELECT trang_thai.TT_TENTT, COUNT(*) as soluong
            FROM don_hang
            JOIN (
                SELECT DH_MADH, TT_MATT
                FROM lich_su_don_hang ls1
                WHERE LSDH_THOIDIEM = (
                    SELECT MAX(ls2.LSDH_THOIDIEM)
                    FROM lich_su_don_hang ls2
                    WHERE ls2.DH_MADH = ls1.DH_MADH
                )
            ) AS ls ON don_hang.DH_MADH = ls.DH_MADH
            JOIN trang_thai ON trang_thai.TT_MATT = ls.TT_MATT
            GROUP BY trang_thai.TT_TENTT;
            ";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    return $dm; 
}
//lấy số sao đánh giá
function get_count_sosao_danhgia() {
    $conn = ketnoidb(); 
    $sql = "SELECT DGSP_SOSAO, COUNT(*) AS total 
            FROM danhgia_sanpham  
            WHERE DGSP_TRANGTHAI != 'Ẩn' 
            GROUP BY DGSP_SOSAO";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetchAll();

    // Mặc định khởi tạo 5 sao từ 1 đến 5 với giá trị = 0
    $sosao_counts = array_fill(1, 5, 0);

    foreach ($result as $row) {
        $sao = (int)$row['DGSP_SOSAO'];
        $sosao_counts[$sao] = (int)$row['total'];
    }

    return $sosao_counts; // Mảng kiểu [1 => số, 2 => số, ..., 5 => số]
}
//lấy tất cả đánh giá của khách hàng
function get_review_canhan($idkh){
    $conn = ketnoidb(); 
    $sql = "SELECT 
                kh.KH_ID, 
                kh.KH_HOTEN, 
                dh.DH_MADH, 
                dg.DGSP_ID, 
                dg.DGSP_SOSAO, 
                dg.DGSP_TRANGTHAI, 
                sp.SP_HINH
            FROM danhgia_sanpham dg
            JOIN don_hang dh ON dg.DH_MADH = dh.DH_MADH
            JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
            JOIN san_pham sp ON sp.SP_MASP = dg.SP_MASP
            WHERE kh.KH_ID = :idkh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    return $dm; 
}
//lấy đơn hàng cần sửa
function get_order_cansua($iddh){
$conn = ketnoidb(); 
    $sql = "SELECT 
                dh.DH_MADH, 
                dh.DH_NGAYDAT, 
                dh.KH_ID, 
                kh.KH_HOTEN, 
                dh.DH_DIACHINHAN, 
                tt.TT_TENTT,
                tt.TT_MATT,
                nv.NV_HOTEN,
                nv.NV_ID,
                bp.BP_TENBP
            FROM don_hang dh
            JOIN khach_hang kh ON dh.KH_ID = kh.KH_ID
            JOIN (
                SELECT * FROM lich_su_don_hang ls
                WHERE LSDH_THOIDIEM = (
                    SELECT MAX(LSDH_THOIDIEM) 
                    FROM lich_su_don_hang 
                    WHERE DH_MADH = ls.DH_MADH
                )
            ) ls ON dh.DH_MADH = ls.DH_MADH
            JOIN trang_thai tt ON tt.TT_MATT = ls.TT_MATT
            JOIN nhan_vien nv ON nv.NV_ID = dh.NV_ID
            JOIN bo_phan bp ON bp.BP_MABP = nv.BP_MABP
            WHERE dh.DH_MADH = :iddh
        ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddh', $iddh);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    return $dm; 
}
//tìm tên khu vực
function search_kv_by_name($kyw){
    $conn = ketnoidb(); 
    $sql = "SELECT * 
            FROM phuong_xa px
            JOIN khu_vuc kv ON px.P_ID = kv.P_ID
            JOIN nhan_vien nv ON kv.NV_ID = nv.NV_ID
            WHERE px.P_TENPHUONGXA LIKE :kyw";

    $stmt = $conn->prepare($sql);

    // Gắn % ở đây thay vì trong SQL
    $keyword = "%$kyw%";
    $stmt->bindParam(':kyw', $keyword);

    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    
    return $dm; 
}
//lấy trọng lượng đơn hàng
function get_trongluong_sanpham($idsp){
    $conn = ketnoidb(); 
    $sql = "SELECT SP_TRONGLUONG FROM san_pham WHERE SP_MASP = :idsp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp', $idsp);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $result = $stmt->fetch();
    
    return $result ? $result['SP_TRONGLUONG'] : 0;
}

?>