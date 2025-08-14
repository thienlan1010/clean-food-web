<?php
// Đếm số lượng tài khoản với role = 0 (khách hàng mới đã đăng ký)
function count_accounts_by_role() {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    
    // Truy vấn SQL với tham số ngày bắt đầu và ngày kết thúc
    $sql = "SELECT COUNT(*) FROM tai_khoan WHERE TK_VAITRO = 1";//1 là kh
    
    $stmt = $conn->prepare($sql);
    
    // Gán giá trị cho các tham số
    $stmt->execute(); // Thực thi truy vấn
    
    return $stmt->fetchColumn(); // Trả về số lượng tài khoản với role = 0 trong khoảng thời gian
}
//đếm số lượng đơn hàng
function count_id_order() {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    
    // Truy vấn SQL để đếm số đơn hàng trong khoảng thời gian cụ thể
    $sql = "SELECT COUNT(*) FROM don_hang";
    $stmt = $conn->prepare($sql);
    
    // Gán giá trị cho tham số ngày bắt đầu và ngày kết thúc
    $stmt->execute(); // Thực thi truy vấn
    
    return $stmt->fetchColumn(); // Trả về số lượng đơn hàng
}
//tính tổng doanh thu
function count_revenue() {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    
    // Truy vấn SQL để tính tổng doanh thu 
    $sql = "SELECT SUM(DH_TONGTIEN) FROM don_hang dh, lich_su_don_hang ls
    WHERE dh.DH_MADH = ls.DH_MADH 
    AND ls.TT_MATT = 4";
    $stmt = $conn->prepare($sql);
    // Gán giá trị cho tham số ngày bắt đầu và ngày kết thúc
   
    $stmt->execute(); // Thực thi truy vấn
    return $stmt->fetchColumn(); // Trả về tổng doanh thu
}
//đếm đánh giá
function count_danhgia() {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    
    // Truy vấn SQL để tính tổng doanh thu 
    $sql = "SELECT COUNT(DGSP_ID) FROM danhgia_sanpham";
    $stmt = $conn->prepare($sql);
    // Gán giá trị cho tham số ngày bắt đầu và ngày kết thúc
   
    $stmt->execute(); // Thực thi truy vấn
    return $stmt->fetchColumn(); // Trả về tổng doanh thu
}
//lấy thông tin của admin
function get_employee_info($idtk){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT nv.*, BP_TENBP FROM nhan_vien nv, bo_phan bp 
    WHERE nv.BP_MABP = bp.BP_MABP
    AND TK_ID = :idtk";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idtk', $idtk, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetch();
    return $dm; 
}
//câp nhật thông tin nhân viên
function update_info_employee($employee_id, $name, $sdt, $diachi, $email){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE nhan_vien SET NV_HOTEN = :name, NV_SODIENTHOAI = :sdt, NV_EMAIL = :email, NV_DIACHI = :diachi WHERE NV_ID = :employee_id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':employee_id', $employee_id, PDO::PARAM_INT);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':sdt', $sdt);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':diachi', $diachi);

    
    // Thực thi câu lệnh
    $stmt->execute();
}
//lấy doanh thu theo tháng
function getYearlyMonthlyRevenue() {
    $conn = ketnoidb();
   
    $sql = "SELECT YEAR(DH_NGAYDAT) AS year, MONTH(DH_NGAYDAT) AS month, SUM(DH_TONGTIEN) AS total_revenue 
            FROM don_hang dh, lich_su_don_hang ls
            WHERE dh.DH_MADH = ls.DH_MADH
            AND ls.TT_MATT = 4
            GROUP BY YEAR(DH_NGAYDAT), MONTH(DH_NGAYDAT) 
            ORDER BY YEAR(DH_NGAYDAT), MONTH(DH_NGAYDAT)";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll();
    
    // Tạo mảng doanh thu cho các năm và tháng (tối đa 12 tháng mỗi năm)
    $yearly_monthly_revenue = [];

    foreach ($kq as $row) {
        $year = $row['year'];
        $month = $row['month'] - 1; // Lưu ý rằng tháng trong cơ sở dữ liệu là 1-12, nhưng mảng PHP bắt đầu từ 0
        $total_revenue = (float)$row['total_revenue'];

        if (!isset($yearly_monthly_revenue[$year])) {
            $yearly_monthly_revenue[$year] = array_fill(0, 12, 0); // Khởi tạo mảng doanh thu cho năm mới
        }

        $yearly_monthly_revenue[$year][$month] = $total_revenue; // Gán doanh thu vào tháng tương ứng của năm
    }

    return $yearly_monthly_revenue; // Trả về doanh thu theo năm và tháng
}
//đơn hàng theo từng tháng
function getYearlyMonthlyOrders() {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Truy vấn lấy số lượng đơn hàng theo năm và tháng
    $sql = "SELECT YEAR(DH_NGAYDAT) AS year, MONTH(DH_NGAYDAT) AS month, COUNT(DH_MADH) AS total_order
            FROM don_hang
            GROUP BY YEAR(DH_NGAYDAT), MONTH(DH_NGAYDAT)
            ORDER BY YEAR(DH_NGAYDAT), MONTH(DH_NGAYDAT)";  // Sắp xếp theo năm và tháng

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); 

    // Tạo mảng số lượng đơn hàng cho các năm và tháng (tối đa 12 tháng mỗi năm)
    $yearly_monthly_orders = [];

    // Duyệt qua kết quả và lưu trữ số lượng đơn hàng vào mảng theo năm và tháng
    foreach ($kq as $row) {
        $year = $row['year'];
        $month = $row['month'] - 1; // Lưu ý rằng tháng trong cơ sở dữ liệu là 1-12, nhưng mảng PHP bắt đầu từ 0
        $total_order = $row['total_order'];

        // Nếu năm chưa có trong mảng, khởi tạo mảng số lượng đơn hàng cho năm đó
        if (!isset($yearly_monthly_orders[$year])) {
            $yearly_monthly_orders[$year] = array_fill(0, 12, 0); // Khởi tạo mảng số lượng đơn hàng cho năm mới
        }

        // Gán số lượng đơn hàng vào tháng tương ứng của năm
        $yearly_monthly_orders[$year][$month] = $total_order;
    }

    return $yearly_monthly_orders;  // Trả về số lượng đơn hàng theo năm và tháng
}
// Hàm lấy số lượng khách hàng theo từng năm và tháng
function getYearlyMonthlyCustomers() {
    $conn = ketnoidb(); // Kết nối đến cơ sở dữ liệu

    // Truy vấn lấy số lượng khách hàng đăng ký theo năm và tháng
    $sql = "SELECT YEAR(KH_NGAYDANGKY) AS year, MONTH(KH_NGAYDANGKY) AS month, COUNT(KH_ID) AS total_customer 
            FROM khach_hang 
            GROUP BY YEAR(KH_NGAYDANGKY), MONTH(KH_NGAYDANGKY) 
            ORDER BY YEAR(KH_NGAYDANGKY), MONTH(KH_NGAYDANGKY)"; // Sắp xếp theo năm và tháng

    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $kq = $stmt->fetchAll(); 

    // Tạo mảng số lượng khách hàng cho các năm và tháng (tối đa 12 tháng mỗi năm)
    $yearly_monthly_customers = [];

    // Duyệt qua kết quả và lưu trữ số lượng khách hàng vào mảng theo năm và tháng
    foreach ($kq as $row) {
        $year = $row['year'];
        $month = $row['month'] - 1; // Lưu ý rằng tháng trong cơ sở dữ liệu là 1-12, nhưng mảng PHP bắt đầu từ 0
        $total_customer = $row['total_customer'];

        // Nếu năm chưa có trong mảng, khởi tạo mảng số lượng khách hàng cho năm đó
        if (!isset($yearly_monthly_customers[$year])) {
            $yearly_monthly_customers[$year] = array_fill(0, 12, 0); // Khởi tạo mảng số lượng khách hàng cho năm mới
        }

        // Gán số lượng khách hàng vào tháng tương ứng của năm
        $yearly_monthly_customers[$year][$month] = $total_customer;
    }

    return $yearly_monthly_customers;  // Trả về số lượng khách hàng theo năm và tháng
}
//lấy ds sản phẩm cho admin
// function getall_sanpham(){
//     $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
//     $sql = "SELECT sp.*, dg_new.DG_GIAMOI, dm.DM_TENDM
//             FROM san_pham sp
//             JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
//             JOIN (
//                 SELECT d1.*
//                 FROM don_gia d1
//                 WHERE d1.DG_ID = (
//                     SELECT d2.DG_ID
//                     FROM don_gia d2
//                     WHERE d2.SP_MASP = d1.SP_MASP
//                     ORDER BY d2.DG_NGAYAPDUNG DESC, d2.DG_ID DESC
//                     LIMIT 1
//                 )
//             ) dg_new ON sp.SP_MASP = dg_new.SP_MASP";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute();

//     $stmt->setFetchMode(PDO::FETCH_ASSOC);
//     $kq = $stmt->fetchAll(); 
    
//     return $kq; 
// }
function getall_sanpham($start = 0, $limit = 20, $iddm = '') {
    $conn = ketnoidb();

    // Tạo SQL cơ bản
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
            ) dg_new ON sp.SP_MASP = dg_new.SP_MASP";

    // Nếu có lọc theo danh mục
    if ($iddm !== '') {
        $sql .= " WHERE dm.DM_MADM = :iddm";
    }

    // Thêm phân trang
    $sql .= " LIMIT :start, :limit";

    $stmt = $conn->prepare($sql);

    // Gán giá trị
    if ($iddm !== '') {
        $stmt->bindValue(':iddm', $iddm, PDO::PARAM_INT);
    }
    $stmt->bindValue(':start', (int)$start, PDO::PARAM_INT);
    $stmt->bindValue(':limit', (int)$limit, PDO::PARAM_INT);

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}


// Kiểm tra trùng danh mục khi thêm
function check_danhmuc($tendm) {
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT COUNT(*) FROM danh_muc WHERE DM_TENDM = :tendm"; // Sử dụng tham số
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tendm', $tendm); // Gán tham số
    $stmt->execute();
    
    // Lấy kết quả
    $count = $stmt->fetchColumn(); // Lấy giá trị đếm
    return $count > 0; // Trả về true nếu tên danh mục đã tồn tại
}
//them danh mục
function themdanhmuc($tendm, $trangthai){
    $conn = ketnoidb();
    $sql = "INSERT INTO danh_muc (DM_TENDM, DM_TRANGTHAI) VALUES (:tendm, :trangthai)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tendm', $tendm);
    $stmt->bindParam(':trangthai', $trangthai);

    $stmt->execute();
}
//lấy dm theo id
function get_dm_theo_id($iddm){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM danh_muc WHERE DM_MADM = :iddm";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':iddm', $iddm);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetch(); 
    
    return $dm; 
}
//cap nhật dm
function capnhat_danhmuc($madm, $tendm, $trangthai){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE danh_muc SET DM_TENDM = :tendm, DM_TRANGTHAI = :trangthai WHERE DM_MADM = :madm";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':trangthai', $trangthai,);
    $stmt->bindParam(':tendm', $tendm);
    $stmt->bindParam(':madm', $madm);
    $stmt->execute();
}
//xóa danh mục
// function xoa_dm($iddm){
//     $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
//     $sql = "UPDATE danh_muc SET DM_TRANGTHAI = 'Ngừng kinh doanh' WHERE DM_MADM = :iddm";
//     $stmt = $conn->prepare($sql);
//     $stmt->bindParam(':iddm', $iddm);

//     $stmt->execute();
// }
//thêm sản phẩm
function them_sanpham($tensp, $img, $tonkho, $mota, $trangthai, $madm, $ngayphathanh, $donvi, $trongluong){
    $conn = ketnoidb();
    $sql = "INSERT INTO san_pham(SP_TENSP, SP_HINH, SP_SLTON, SP_MOTA, SP_TRANGTHAI, DM_MADM, SP_PHATHANH, SP_DONVI, SP_TRONGLUONG) 
            VALUES (:tensp, :img, :tonkho, :mota, :trangthai, :madm, :ngayphathanh, :donvi, :trongluong)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tensp', $tensp);
    $stmt->bindParam(':img', $img);
    $stmt->bindParam(':tonkho', $tonkho);
    $stmt->bindParam(':mota', $mota);
    $stmt->bindParam(':trangthai', $trangthai);
    $stmt->bindParam(':madm', $madm);
    $stmt->bindParam(':ngayphathanh', $ngayphathanh);
    $stmt->bindParam(':donvi', $donvi);
    $stmt->bindParam(':trongluong', $trongluong);


   

    $stmt->execute();
    $last_id = $conn->lastInsertId();
    return $last_id;
}

//thêm đơn giá cho sp new
function add_dongia_sp_new($idsp_new, $gia, $ngayphathanh){
     $conn = ketnoidb();
    $sql = "INSERT INTO don_gia(SP_MASP, DG_GIAMOI, DG_NGAYAPDUNG) 
            VALUES (:idsp_new, :gia, :ngayphathanh)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp_new', $idsp_new);
    $stmt->bindParam(':gia', $gia);
    $stmt->bindParam(':ngayphathanh', $ngayphathanh);
    
    $stmt->execute();
}
//lấy thông tin của sản phẩm theo mã sp
function get_sp_theo_id($idsp){
    $conn = ketnoidb(); 
    $sql = "SELECT sp.*, dg_new.DG_GIAMOI, dm.DM_MADM, dm.DM_TENDM
            FROM san_pham sp
            JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
            JOIN (
                SELECT d1.*
                FROM don_gia d1
                WHERE (d1.SP_MASP, d1.DG_NGAYAPDUNG, d1.DG_ID) IN (
                    SELECT d2.SP_MASP, MAX(d2.DG_NGAYAPDUNG), MAX(d2.DG_ID)
                    FROM don_gia d2
                    GROUP BY d2.SP_MASP
                )
            ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
            WHERE sp.SP_MASP = :idsp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idsp', $idsp);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sp = $stmt->fetch(); 
    
    return $sp; 
}
//cập nhật sản phẩm
function update_sanpham($id, $tensp, $mota, $anh, $madm, $tonkho, $ngayphathanh, $donvi, $trangthai,$trongluong) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE san_pham SET SP_TENSP = :tensp, SP_MOTA = :mota, SP_TRANGTHAI = :trangthai,  SP_HINH = :anh, SP_SLTON = :tonkho, SP_PHATHANH = :ngayphathanh, DM_MADM = :madm, SP_DONVI = :donvi, SP_TRONGLUONG = :trongluong WHERE SP_MASP = :id";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':tensp', $tensp);
    $stmt->bindParam(':mota', $mota);
    $stmt->bindParam(':anh', $anh);
    $stmt->bindParam(':tonkho', $tonkho);
    $stmt->bindParam(':ngayphathanh', $ngayphathanh);
    $stmt->bindParam(':madm', $madm);
    $stmt->bindParam(':donvi', $donvi);
    $stmt->bindParam(':trangthai', $trangthai);
    $stmt->bindParam(':trongluong', $trongluong);
    $stmt->bindParam(':id', $id);

    $stmt->execute();
}
//cập nhật giá
function insert_gia_sp($idsp, $gia) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "INSERT INTO don_gia (SP_MASP, DG_GIAMOI) 
            VALUES (:idsp, :gia)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':idsp', $idsp);
    $stmt->bindParam(':gia', $gia);

    $stmt->execute();
}


//lấy khu vực
function get_all_khuvuc(){
    $conn = ketnoidb(); 
    $sql = "SELECT kv.KV_MAKV, nv.NV_HOTEN, px.P_TENPHUONGXA, kv.KV_TRANGTHAI
            FROM khu_vuc kv, nhan_vien nv, phuong_xa px
            WHERE kv.P_ID = px.P_ID
            AND nv.NV_ID = kv.NV_ID";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll(); 
    
    return $dm;
}
//lấy all nhân viên giao hàng
function  get_all_nv_giaohang(){
     $conn = ketnoidb(); 
    $sql = "SELECT *
            FROM nhan_vien nv, bo_phan bp
            WHERE nv.BP_MABP = bp.BP_MABP
            AND bp.BP_TENBP = 'Giao hàng'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll(); 
    
    return $dm;
}
//them kv
function add_khuvuc($kv, $nv){
    $conn = ketnoidb();
    $sql = "INSERT INTO khu_vuc (NV_ID, P_ID) VALUES (:nv, :kv)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bindParam(':nv', $nv);
    $stmt->bindParam(':kv', $kv);

    $stmt->execute();
}
function get_kv_cansua($idkv){
    $conn = ketnoidb(); 
    $sql = "SELECT nv.NV_HOTEN, px.P_TENPHUONGXA, kv.KV_TRANGTHAI, kv.P_ID
            FROM nhan_vien nv, khu_vuc kv, phuong_xa px
            WHERE nv.NV_ID = kv.NV_ID
            AND kv.P_ID = px.P_ID
            AND kv.KV_MAKV = :idkv";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkv', $idkv);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetch(); 
    
    return $dm;
}
//update kh
function update_kv($makv, $idphuong, $idnv, $status_kv){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu
    $sql = "UPDATE khu_vuc SET NV_ID = :idnv, P_ID = :idphuong, KV_TRANGTHAI = :status_kv WHERE KV_MAKV = :makv";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(':makv', $makv);
    $stmt->bindParam(':idphuong', $idphuong);
    $stmt->bindParam(':idnv', $idnv);
    $stmt->bindParam(':status_kv', $status_kv);

  
    // Thực thi câu lệnh
    $stmt->execute();
}
function get_phuong_duoc_giao() {
    $conn = ketnoidb();
    $sql = "SELECT DISTINCT px.P_ID, px.P_TENPHUONGXA
            FROM khu_vuc kv
            JOIN phuong_xa px ON kv.P_ID = px.P_ID
            WHERE kv.KV_TRANGTHAI = 'Còn hoạt động'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

?>