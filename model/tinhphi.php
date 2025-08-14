<?php
include_once "thuvien.php"; 

if (isset($_POST['km']) && isset($_POST['trongluong'])) {
    $km = floatval($_POST['km']);
    $trongluong = floatval($_POST['trongluong']);

    $conn = ketnoidb(); // PDO connection

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
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $ngayDatHang = date('Y-m-d'); // Lấy ngày hiện tại
        $sql3 = "SELECT PG_DONGIA
                 FROM phi_giao 
                 WHERE KC_ID = :kc_id AND TL_ID = :tl_id
                 AND PG_NGAYAPDUNG <= :ngay_dat
                 ORDER BY PG_NGAYAPDUNG DESC
                 LIMIT 1";
        $stmt3 = $conn->prepare($sql3);
        $stmt3->execute([
            ':kc_id' => $phamvi_id,
            ':tl_id' => $khoiluong_id,
            ':ngay_dat' => $ngayDatHang
        ]);
        $row3 = $stmt3->fetch(PDO::FETCH_ASSOC);

        if ($row3) {
            // echo number_format($row3['PG_DONGIA'], 0, ',', '.'); // ví dụ: 25.000
            echo $row3['PG_DONGIA']; // trả về số thô, ví dụ: 25000

        } else {
            echo 'Không có bảng giá phù hợp';
        }
        // if ($row3) {
        //     echo json_encode([
        //         'phi' => $row3['PG_DONGIA'],
        //         'kc_id' => $phamvi_id,
        //         'tl_id' => $khoiluong_id,
        //         'ngay_ap_dung' => $row3['PG_NGAYAPDUNG']
        //     ]);
        // } else {
        //     echo json_encode(['error' => 'Không có bảng giá phù hợp']);
        // }
    } else {
        echo 'Không xác định được phạm vi hoặc khối lượng';
    }
} else {
    echo 'Thiếu dữ liệu';
}
?>
