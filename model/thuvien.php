<?php
//Tạo hàm kết nối cơ sở dữ liệu
function ketnoidb() {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "luanvan";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        // Thiết lập chế độ lỗi PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //echo "thành công";
        return $conn;
    } catch (PDOException $e) {
        echo "Kết nối thất bại: " . $e->getMessage();
       
    }
}
//lấy sản phẩm giảm giá
function getall_discount(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    // Thêm điều kiện JOIN để kiểm tra trạng thái của danh mục
    $sql = "SELECT sp.*, dg_moi.DG_GIAMOI AS GiaMoi, dg_cu.DG_GIAMOI AS GiaTruoc
            FROM san_pham sp

            -- Giá mới nhất
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
            ) dg_moi ON sp.SP_MASP = dg_moi.SP_MASP

            -- Giá cũ: chọn bản ghi có DG_ID < DG_ID mới nhất
            LEFT JOIN (
                SELECT d3.*
                FROM don_gia d3
                WHERE (d3.SP_MASP, d3.DG_ID) IN (
                    SELECT d4.SP_MASP, MAX(d4.DG_ID)
                    FROM don_gia d4
                    WHERE (d4.SP_MASP, d4.DG_ID) NOT IN (
                        SELECT d5.SP_MASP, MAX(d5.DG_ID)
                        FROM don_gia d5
                        GROUP BY d5.SP_MASP
                    )
                    GROUP BY d4.SP_MASP
                )
            ) dg_cu ON sp.SP_MASP = dg_cu.SP_MASP

            JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM

            WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'
                AND sp.SP_TRANGTHAI = 'Còn kinh doanh'
                AND dg_cu.DG_GIAMOI IS NOT NULL
                AND dg_moi.DG_GIAMOI < dg_cu.DG_GIAMOI
                ORDER BY dg_moi.DG_NGAYAPDUNG DESC
                ";
// check sp còn hàng thì bên show check rùi
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $products = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    
    return $products; // Trả về danh sách sản phẩm
}

//lay produce mới nhất và nhiều lược xem
// function getall_sp($view){
//     $conn = ketnoidb();
//     if ($conn) {
//         $sql = "SELECT sp.*, dg_new.DG_GIAMOI
//                 FROM san_pham sp
//                 JOIN danh_muc dm ON sp.DM_MADM = dm.DM_MADM
//                 JOIN (
//                     SELECT d1.*
//                     FROM don_gia d1
//                     WHERE d1.DG_NGAYAPDUNG = (
//                         SELECT MAX(d2.DG_NGAYAPDUNG)
//                         FROM don_gia d2
//                         WHERE d2.SP_MASP = d1.SP_MASP
//                     )
//                 ) dg_new ON sp.SP_MASP = dg_new.SP_MASP
//                 WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh'";

//         if ($view == 1) {
//             $sql .= " ORDER BY SP_LUOTXEM DESC";
//         } else {
//             $sql .= " ORDER BY SP_MASP DESC";
//         }

//         $stmt = $conn->prepare($sql);
//         $stmt->execute();

//         $stmt->setFetchMode(PDO::FETCH_ASSOC);
//         return $stmt->fetchAll();
//     }
// }
function getall_sp($view){
    $conn = ketnoidb();
    if ($conn) {
        $sql = "SELECT sp.*, dg_new.DG_GIAMOI
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
                WHERE dm.DM_TRANGTHAI = 'Còn kinh doanh' AND sp.SP_TRANGTHAI ='Còn kinh doanh'";

        // Sắp xếp theo lượt xem hoặc mã sản phẩm
        if ($view == 1) {
            $sql .= " ORDER BY sp.SP_LUOTXEM DESC";
        } else {
            $sql .= " ORDER BY sp.SP_MASP DESC";
        }

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

//lấy thông tin chi tiết sản phẩm
function getall_detail_product($id) {
    $conn = ketnoidb();
    $sql = "SELECT sp.*, dg_new.DG_GIAMOI
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
                WHERE sp.SP_MASP = :id ";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetch(); // Fetch một hàng duy nhất
}
//cập nhật lược xem
function update_view_count($id) {
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Cập nhật lượt xem cho sản phẩm có MASP là $id
    $sql = "UPDATE san_pham SET SP_LUOTXEM = SP_LUOTXEM + 1 WHERE SP_MASP = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT); 
    $stmt->execute();
        

}
//lấy sản phẩm liên quan and trừ đi sp hiện tại
function get_related_products($category_id, $exclude_id) {
    $conn = ketnoidb(); 
    $sql = "SELECT sp.*, dg_new.DG_GIAMOI
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
        WHERE dm.DM_MADM = :category_id
          AND sp.SP_MASP != :exclude_id";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->bindParam(':exclude_id', $exclude_id, PDO::PARAM_INT);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    return $stmt->fetchAll();
}
//lấy thông tin đánh giá 
function get_reviews($id) {
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    
    $sql = "SELECT dgsp.*, tk.TK_TENDANGNHAP
            FROM danhgia_sanpham dgsp
            JOIN don_hang dh ON dgsp.DH_MADH = dh.DH_MADH
            JOIN khach_hang kh ON kh.KH_ID = dh.KH_ID
            JOIN tai_khoan tk ON tk.TK_ID = kh.TK_ID
            WHERE dgsp.SP_MASP = :id AND dgsp.DGSP_TRANGTHAI = 'Hiện'
            ORDER BY dgsp.DGSP_NGAYDANHGIA DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $reviews = $stmt->fetchAll();
    
    return $reviews; 
}
//lay ALL danh muc
function getall_dm(){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT * FROM danh_muc WHERE DM_TRANGTHAI='Còn kinh doanh'";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    
    return $dm; // Trả về danh sách sản phẩm
}
//lấy all danh kể cả ko còn kinh doanh
function getall_dm_luon(){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM danh_muc";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    
    return $dm; // Trả về danh sách sản phẩm
}
//lay ten danh muc theo ma dm
function get_name_dm($id){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT DM_TENDM FROM danh_muc WHERE DM_MADM = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    
    // Lấy kết quả chỉ cần một tên danh mục
    $dm = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $dm['DM_TENDM'] ?? ''; // Trả về tên danh mục hoặc chuỗi rỗng nếu không tìm thấy
}
//lấy all sản phẩm thuôc danh mục
function getall_product($MADANHMUC){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT sp.*, dm.DM_TRANGTHAI, dg_new.DG_GIAMOI
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
            WHERE sp.DM_MADM = :MADANHMUC AND sp.SP_TRANGTHAI ='Còn kinh doanh'
            ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':MADANHMUC', $MADANHMUC, PDO::PARAM_INT);
    $stmt->execute();
    // Lấy kết quả dưới dạng mảng kết hợp
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $sp = $stmt->fetchAll(); // Đổi tên biến để phù hợp với nội dung
    
    return $sp; // Trả về danh sách sản phẩm
}
//kiểm tra tên đăng nhập có trùng hay không
function check_username_login($name) {
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT COUNT(*) FROM tai_khoan WHERE TK_TENDANGNHAP = :name"; // Sử dụng tham số thay vì nối chuỗi
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':name', $name); // Gán tham số
    $stmt->execute();
    
    // Lấy kết quả
    $count = $stmt->fetchColumn(); // Lấy giá trị đếm
    return $count > 0; // Trả về true nếu tên đăng nhập đã tồn tại
}
//kiểm tra email đã tồn tại chưa
function check_email_exists($email) {
    $conn = ketnoidb();
    $sql = "SELECT COUNT(*) FROM khach_hang WHERE KH_EMAIL = :email";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchColumn() > 0; // Trả về true nếu tồn tại
}

// thêm tài khoản cho khách hàng vừa đăng kí
function register_user($username, $password) {
    $conn = ketnoidb();
    $sql = "INSERT INTO tai_khoan (TK_TENDANGNHAP, TK_MK, TK_VAITRO, TK_TRANGTHAI)
            VALUES (:username, :password, 1, 'Còn hoạt động')";
    
    $stmt = $conn->prepare($sql); // Thiếu bước này trong phiên bản của bạn
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    $last_id = $conn->lastInsertId();
    return $last_id; // Trả về TK_ID vừa thêm
}
//Add customer and return ID of customer
function insert_customer_info($tkid, $name, $email, $sdt, $address) {
    $conn = ketnoidb();

    $sql = "INSERT INTO khach_hang (TK_ID, KH_HOTEN, KH_EMAIL, KH_SODIENTHOAI, KH_DIACHI, KH_DIEMTICHLUY)
            VALUES (:tkid, :name, :email, :sdt, :address, 0)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':tkid', $tkid);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':sdt', $sdt);
    $stmt->bindParam(':address', $address);

    $stmt->execute();
}
//lấy phương sthuwcs tahnh toán
function get_ptth(){
    $conn = ketnoidb(); 
    $sql = "SELECT * FROM phuongthuc_thanhtoan";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    
    return $dm; 
}
//lấy điểm tích lũy
function get_diem_tich_luy($idkh){
    $conn = ketnoidb(); // Gán kết nối cơ sở dữ liệu vào biến
    $sql = "SELECT KH_DIEMTICHLUY FROM khach_hang WHERE KH_ID = :idkh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':idkh', $idkh, PDO::PARAM_INT);
    $stmt->execute();
    
    // Lấy kết quả chỉ cần một tên danh mục
    $dm = $stmt->fetch(PDO::FETCH_ASSOC);
    
    return $dm['KH_DIEMTICHLUY'] ?? ''; // Trả về tên danh mục hoặc chuỗi rỗng nếu không tìm thấy
}
//lấy sl tồn của từng sản phẩm trong đơn hàng
function get_all_slsp_in_dh($madh){
    $conn = ketnoidb(); 
    $sql = "SELECT dh.DH_MADH, ct.SP_MASP, ct.CTDH_SOLUONG FROM don_hang dh, chitiet_donhang ct
    WHERE dh.DH_MADH = ct.DH_MADH
    AND dh.DH_MADH = :madh";
    $stmt = $conn->prepare($sql);
     $stmt->bindParam(':madh', $madh);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    
    return $dm;
}
//cộng sl tồn
function update_sltonkho($masp, $sl){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Cập nhật lượt xem cho sản phẩm có MASP là $id
    $sql = "UPDATE san_pham SET SP_SLTON = SP_SLTON  + :sl WHERE SP_MASP = :masp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sl', $sl, PDO::PARAM_INT); 
    $stmt->bindParam(':masp', $masp, PDO::PARAM_INT); 
    $stmt->execute();
}
//trừ sl tồn
function update_tru_slton($masp, $sl){
    $conn = ketnoidb(); // Kết nối cơ sở dữ liệu

    // Cập nhật lượt xem cho sản phẩm có MASP là $id
    $sql = "UPDATE san_pham SET SP_SLTON = SP_SLTON  - :sl WHERE SP_MASP = :masp";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':sl', $sl, PDO::PARAM_INT); 
    $stmt->bindParam(':masp', $masp, PDO::PARAM_INT); 
    $stmt->execute();
}
//lấy trạng thái mới nhất cảu dh
function get_trangthai_donhang($madh){
    $conn = ketnoidb();
    $sql = "SELECT tt.TT_MATT
        FROM don_hang dh
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
        WHERE dh.DH_MADH = :madh";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':madh', $madh);
    $stmt->execute();
    return $stmt->fetchColumn(); // Trả về đúng TT_MATT
}
//lấy lịch sử trạng thái của 1 đơn hàng
function get_ls_status($madh){
    $conn = ketnoidb(); 
    $sql = "SELECT tt.TT_TENTT, ls.LSDH_THOIDIEM
            FROM lich_su_don_hang ls
            JOIN trang_thai tt ON ls.TT_MATT = tt.TT_MATT
            WHERE ls.DH_MADH = :madh
            ORDER BY ls.LSDH_THOIDIEM ASC";
    $stmt = $conn->prepare($sql);
     $stmt->bindParam(':madh', $madh);
    $stmt->execute();
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $dm = $stmt->fetchAll();
    
    return $dm;
}
?>