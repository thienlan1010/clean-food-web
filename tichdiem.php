

<?php
session_start();
include 'model/thuvien.php'; // Gồm hàm ketnoidb()
include "view/header.php";
$conn = ketnoidb();

$madon = $_GET['madon'] ?? null;
$makh_qr = $_GET['makh'] ?? null;
$makh_dangnhap = $_SESSION['idcustomer'] ?? null;

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Tích điểm</title>
    <style>
        .center-message {
            text-align: center;
            margin-top: 100px;
            font-family: Arial, sans-serif;
        }

        .center-message h2 {
            color: #28a745;
            font-size: 24px;
        }

        .center-message h3 {
            color: #dc3545;
            font-size: 20px;
        }

        .center-message p {
            font-size: 18px;
            margin-top: 10px;
        }

        .center-message a {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 16px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .center-message a:hover {
            background-color: #0056b3;
        }
        main {
            margin-top: 130px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<main>
<div class="center-message">
<?php
// // Kiểm tra thiếu dữ liệu
// if (!$madon || !$makh_qr) {
//     echo "<h3>⚠️ Thiếu dữ liệu mã đơn hoặc khách hàng.</h3>";
// } elseif ($makh_qr != $makh_dangnhap) {
//     // ❗ KH không phải chủ đơn
//     echo "<h3>🚫 Mã QR này không thuộc về bạn.</h3>";
// } else {
//     // Truy vấn thông tin đơn hàng
//     $sql = "SELECT dh.DH_TICHDIEM, tt.TT_MATT
//             FROM don_hang dh
//             JOIN lich_su_don_hang ls ON ls.DH_MADH = dh.DH_MADH
//             JOIN trang_thai tt ON ls.TT_MATT = tt.TT_MATT
//             WHERE dh.DH_MADH = :madon
//             AND dh.KH_ID = :makh
//             ORDER BY ls.LSDH_ID DESC
//             LIMIT 1";
//     $stmt = $conn->prepare($sql);
//     $stmt->execute([':madon' => $madon, ':makh' => $makh_qr]);
//     $row = $stmt->fetch(PDO::FETCH_ASSOC);

//     if (!$row) {
//         echo "<h3>⚠️ Không tìm thấy đơn hàng.</h3>";
//     } elseif ($row['TT_MATT'] != 4) {
//         echo "<h3>🚫 Đơn hàng chưa được giao thành công. Không thể tích điểm.</h3>";
//     } elseif ($row['DH_TICHDIEM'] == 1) {
//         echo "<h3>✅ Đơn hàng này đã được tích điểm trước đó.</h3>";
//     } else {
//         // ✅ Cộng điểm
//         $sql_tong = "SELECT DH_DIEMCONG FROM don_hang WHERE DH_MADH = :madon";
//         $stmt_tong = $conn->prepare($sql_tong);
//         $stmt_tong->execute([':madon' => $madon]);
//         $diem_them = $stmt_tong->fetchColumn();

//         // Cập nhật điểm
//         $sql_updiem = "UPDATE khach_hang SET KH_DIEMTICHLUY = KH_DIEMTICHLUY + :diem WHERE KH_ID = :makh";
//         $stmt_up = $conn->prepare($sql_updiem);
//         $stmt_up->execute([':diem' => $diem_them, ':makh' => $makh_qr]);

//         // Đánh dấu đã tích điểm
//         $sql_mark = "UPDATE don_hang SET DH_TICHDIEM = 1 WHERE DH_MADH = :madon";
//         $stmt_mark = $conn->prepare($sql_mark);
//         $stmt_mark->execute([':madon' => $madon]);

//         echo "<h2>🎉 Tích điểm thành công!</h2>";
//         echo "<h3>Bạn được cộng <strong>$diem_them điểm</strong> vào tài khoản.</h3>";
//     }
// }
?>
<?php
// Giả sử $madon, $makh_qr, $makh_dangnhap được truyền vào trước đó

$message = '';  // Biến chứa thông báo
$diem_them = 0; // Điểm cộng nếu thành công

if (!$madon || !$makh_qr) {
    $message = "⚠️ Thiếu dữ liệu mã đơn hoặc khách hàng.";
} elseif ($makh_qr != $makh_dangnhap) {
    $message = "🚫 Mã QR này không thuộc về bạn.";
} else {
    // Lấy thông tin đơn hàng
    $sql = "SELECT DH_TICHDIEM, DH_HANQR, DH_DIEMCONG
            FROM don_hang
            WHERE DH_MADH = :madon AND KH_ID = :makh";
    $stmt = $conn->prepare($sql);
    $stmt->execute([':madon' => $madon, ':makh' => $makh_qr]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row) {
        $message = "⚠️ Không tìm thấy đơn hàng.";
    } else {
        // Kiểm tra trạng thái giao thành công dựa vào lịch sử mới nhất
        $sql_tt = "SELECT tt.TT_MATT
                   FROM lich_su_don_hang ls
                   JOIN trang_thai tt ON ls.TT_MATT = tt.TT_MATT
                   WHERE ls.DH_MADH = :madon
                   ORDER BY ls.LSDH_ID DESC
                   LIMIT 1";
        $stmt_tt = $conn->prepare($sql_tt);
        $stmt_tt->execute([':madon' => $madon]);
        $tt_row = $stmt_tt->fetch(PDO::FETCH_ASSOC);

        if (!$tt_row || $tt_row['TT_MATT'] != 4) { // 4 = GIAO_THANH_CONG
            $message = "🚫 Đơn hàng chưa được giao thành công. Không thể tích điểm.";
        } elseif (!$row['DH_HANQR'] || date('Y-m-d H:i:s') > $row['DH_HANQR']) {
            $message = "🚫 Mã QR đã hết hạn.";
        } elseif ($row['DH_TICHDIEM'] == 1) {
            $message = "✅ Đơn hàng này đã được tích điểm trước đó.";
        } else {
            // Cộng điểm cho khách hàng
            $diem_them = $row['DH_DIEMCONG'];
            $sql_updiem = "UPDATE khach_hang 
                            SET KH_DIEMTICHLUY = KH_DIEMTICHLUY + :diem 
                            WHERE KH_ID = :makh";
            $stmt_up = $conn->prepare($sql_updiem);
            $stmt_up->execute([':diem' => $diem_them, ':makh' => $makh_qr]);

            // Đánh dấu đơn đã tích điểm
            $sql_mark = "UPDATE don_hang SET DH_TICHDIEM = 1 WHERE DH_MADH = :madon";
            $stmt_mark = $conn->prepare($sql_mark);
            $stmt_mark->execute([':madon' => $madon]);

            $message = "<h2>🎉 Tích điểm thành công!</h2>
                        <h3>Bạn được cộng <strong>$diem_them điểm</strong> vào tài khoản.</h3>";
        }
    }
}

?>
    <h3 style="font-size:1.3em; text-align:center;"><?php echo $message; ?></h3>
    <a href='index.php?act=tich-diem'>Quay về lại</a>
</div>
</main>
</body>
</html>
<?php include "view/footer.php"; ?>
