<?php
require_once 'dompdf/autoload.inc.php';
use Dompdf\Dompdf;
use Dompdf\Options;

// Lấy thông tin đơn hàng
$kh_ten = $info_hd[0]['KH_HOTEN'];
$madon = $info_hd[0]['DH_MADH'];
$ngaydat = $info_hd[0]['DH_NGAYDAT'] ?? date('Y-m-d');
$phigiao = $info_hd[0]['PG_DONGIA'] ?? 0;
$diem_dadung = $info_hd[0]['DH_DIEMDADUNG'] ?? 0;
$diemcong = $info_hd[0]['DH_DIEMCONG'] ?? 0;


$html = '
<style>
    body { font-family: DejaVu Sans, sans-serif; font-size: 13px; }
    h2 { text-align: center; margin-bottom: 10px; }
    table { width: 100%; border-collapse: collapse; margin-top: 10px; border: none;}
    th, td { border: 1px solid #000; padding: 6px; text-align: center; border: none;}
    p { margin: 4px 0; }
</style>

<h2>HÓA ĐƠN BÁN HÀNG</h2>
<p><strong>Khách hàng:</strong> '.$kh_ten.'</p>
<p><strong>Mã đơn hàng:</strong> '.$madon.'</p>
<p><strong>Ngày đặt hàng:</strong> '.$ngaydat.'</p>

<table>
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
            <th>Thành tiền</th>
        </tr>
    </thead>
    <tbody>';

// Chi tiết sản phẩm
$tong = 0;
foreach ($info_hd as $sp) {
    $tensp = $sp['SP_TENSP'];
    $soluong = $sp['CTDH_SOLUONG'];
    $dongia = (int)str_replace('.', '', $sp['CTDH_DONGIA']); 
    $thanhtien = $soluong * $dongia;
    $tong += $thanhtien;

    $html .= "
        <tr>
            <td>$tensp</td>
            <td>$soluong</td>
            <td>" . number_format($dongia, 0, ',', '.') . "đ</td>
            <td>" . number_format($thanhtien, 0, ',', '.') . "đ</td>
        </tr>";
}


$html .= '
    </tbody>
</table>';

// Tính tổng tiền
 //$giamgia = $diem_dadung * 1000; giả sử 1 điểm = 1.000đ
$thanhtiencuoi = $tong + $phigiao - $diem_dadung;

// $html .= '
//     <p style="text-align: right;"><strong>Tạm tính:</strong> '.number_format($tong, 3).'đ</p>
//     <p style="text-align: right;"><strong>Phí giao hàng:</strong> '.number_format($phigiao).'đ</p>
//     <p style="text-align: right;"><strong>Giảm giá từ điểm đã dùng ('.$diem_dadung.' điểm):</strong> -'.number_format($giamgia).'đ</p>
//     <p style="text-align: right; font-weight: bold;">Tổng cộng thanh toán: '.number_format($thanhtiencuoi).'đ</p>';
$html .= '  
    <p style="margin-top: 20px; margin-right: 50px; font-weight: bold; font-size: 14px; text-align: right;">Thông tin thanh toán</p>
    <table style="width: 60%; float: right; margin-top: 10px; font-size: 13px; border: none;">
        <tr>
            <td style="text-align: left; border: none;">Tiền hàng:</td>
            <td style="text-align: right; border: none;">'.number_format($tong, 0, ',', '.').'đ</td>
        </tr>
        <tr>
            <td style="text-align: left; border: none;">Phí giao hàng:</td>
            <td style="text-align: right; border: none;">'.number_format($phigiao, 0, ',', '.').'đ</td>
        </tr>
        <tr>
            <td style="text-align: left; border: none;">Giảm giá từ điểm đã dùng:</td>
            <td style="text-align: right; border: none;">-'.$diem_dadung.'</td>
        </tr>
        <tr>
            <td style="text-align: left; border: none;">Điểm cộng:</td>
            <td style="text-align: right; border: none;">'.$diemcong.' điểm</td>
        </tr>
        <tr>
            <td style="text-align: left; font-weight: bold; border: none;">Tổng cộng thanh toán:</td>
            <td style="text-align: right; font-weight: bold; border: none;">'.number_format($thanhtiencuoi, 0, ',', '.').'đ</td>
        </tr>
    </table>';


// Thêm mã QR nếu có
$qr_filename = 'qrcode_' . $madon . '.png';
$qr_folder = '../qrcode/'; // đường dẫn cho <img src="">
$qr_path = $qr_folder . $qr_filename;
$qr_full_path = __DIR__ . '/../qrcode/' . $qr_filename; // đường dẫn vật lý

if (file_exists($qr_full_path)) {
    $qr_base64 = base64_encode(file_get_contents($qr_full_path));
    $html .= "<p style='text-align:center; margin-top:30px;'>
                <strong>Quét mã QR để tích điểm:</strong><br>
                <img src='data:image/png;base64,$qr_base64' width='120'><br>
                <small>Hạn QR: 3 ngày từ ngày giao</small>
              </p>";
}




// Xuất PDF
$options = new Options();
$options->set('defaultFont', 'DejaVu Sans');
$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A5', 'portrait');
$dompdf->render();
$dompdf->stream("hoadon_$madon.pdf", ["Attachment" => false]);
exit;
?>
