<?php
// session_start();
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
// function bo_dau_tieng_viet($str) {
//     $str = mb_strtolower($str, 'UTF-8');
//     $str = preg_replace([
//         "/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/u",
//         "/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/u",
//         "/(ì|í|ị|ỉ|ĩ)/u",
//         "/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/u",
//         "/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/u",
//         "/(ỳ|ý|ỵ|ỷ|ỹ)/u",
//         "/(đ)/u",
//     ], [
//         "a", "e", "i", "o", "u", "y", "d"
//     ], $str);
//     return $str;
// }

// function kiem_tra_sanpham($cau_hoi, $sanphams) {
//     $cau_hoi_khong_dau = bo_dau_tieng_viet(trim($cau_hoi));
//     $sp_tim_thay = [];

//     foreach ($sanphams as $sp) {
//         $ten_sp_khong_dau = bo_dau_tieng_viet(trim($sp['ten']));

//         if (strpos($cau_hoi_khong_dau, $ten_sp_khong_dau) !== false) {
//             $sp_tim_thay[] = $sp['ten']; // giữ tên có dấu để phản hồi đẹp
//         }
//     }

//     return array_unique($sp_tim_thay);
// }

// // ----------- Xử lý khi người dùng gửi câu hỏi -----------
// if ($_SERVER['REQUEST_METHOD'] === 'POST') {
//     $question = $_POST['question'] ?? '';

//     // Đọc file sản phẩm 1 lần
//    $json = file_get_contents("../database/sanpham.json");
//     if (!$json) {
//         echo json_encode(['answer' => "❌ Không đọc được file sanpham.json"]);
//         exit;
//     }

//     $sanphams = json_decode($json, true);
//     if (!$sanphams) {
//         echo json_encode(['answer' => "❌ Lỗi khi đọc dữ liệu JSON"]);
//         exit;
//     }


//     // Tìm sản phẩm có trong câu hỏi
//     $ds_sanpham_mention = kiem_tra_sanpham($question, $sanphams);
//     $phanhoi_sp = '';
    


//     if (!empty($ds_sanpham_mention)) {
//         foreach ($ds_sanpham_mention as $ten_sp) {
//             $tim_duoc = false;
//             foreach ($sanphams as $sp) {
//                 if (mb_strtolower($sp['ten'], 'UTF-8') === mb_strtolower($ten_sp, 'UTF-8')) {
//                     $phanhoi_sp .= "✔️ {$sp['ten']} ({$sp['donvi']}), giá: {$sp['gia']}đ\n";
//                     $tim_duoc = true;
//                     break;
//                 }
//             }
//             if (!$tim_duoc) {
//                 $phanhoi_sp .= "❌ Không có thông tin giá cho {$ten_sp}.\n";
//             }
//         }
//     }

//     // Tạo prompt cho AI
//     $messages = [];

//     if (!empty($ds_sanpham_mention)) {
//         $messages[] = [
//             "role" => "system",
//             "content" => "Bạn là nhân viên tư vấn sản phẩm tại cửa hàng thực phẩm sạch. Trả lời bằng tiếng Việt, thân thiện, chỉ dựa trên danh sách sau. Nếu khách hỏi sản phẩm không có trong danh sách, hãy trả lời: 'Xin lỗi, cửa hàng hiện không có sản phẩm này.'\n\nDanh sách sản phẩm:\n$phanhoi_sp"
//         ];
//     } else {
//         if (preg_match('/(giá|bao nhiêu|mua|bán|đặt hàng)/iu', $question)) {
//             echo json_encode(['answer' => "Xin lỗi, cửa hàng hiện không có sản phẩm này."]);
//             exit;
//         } else {
//             $messages[] = [
//                 "role" => "system",
//                 "content" => "Bạn là nhân viên tư vấn sản phẩm tại cửa hàng thực phẩm sạch. Tất cả câu trả lời PHẢI bằng **tiếng Việt**. Trả lời ngắn gọn, thân thiện, dễ hiểu. Chỉ trả lời dựa trên danh sách sản phẩm sau. Nếu khách hỏi về sản phẩm không có trong danh sách, hãy trả lời: 'Xin lỗi, cửa hàng hiện không có sản phẩm này.'\n\nDanh sách sản phẩm:\n$phanhoi_sp"
//             ];

//         }
//     }

//     $messages[] = [
//         "role" => "user",
//         "content" => $question
//     ];

//     // Gửi tới FastAPI
//     $ch = curl_init('http://localhost:8000/chat');
//     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//     curl_setopt($ch, CURLOPT_POST, true);
//     curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
//     curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['messages' => $messages]));
//     $response = curl_exec($ch);

//     if ($response === false) {
//         $error = curl_error($ch);
//         curl_close($ch);
//         echo json_encode(['answer' => "❌ Lỗi kết nối AI: $error"]);
//         exit;
//     }

//     curl_close($ch);
//     $data = json_decode($response, true);
//     $answer = $data['answer'] ?? 'Không nhận được phản hồi.';
//     echo json_encode(['answer' => $answer]);
//     exit;
// }
?>
<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);

function kiem_tra_sanpham($cau_hoi, $sanphams) {
    $cau_hoi = mb_strtolower(trim($cau_hoi), 'UTF-8');
    $cau_hoi = preg_replace('/[^a-z0-9àáạảãăâèéẹẻẽêìíịỉòóọỏõôơùúụủũưỳýỵỷỹđ\s]/iu', '', $cau_hoi);
    $sp_tim_thay = [];

    foreach ($sanphams as $sp) {
        $ten_sp = mb_strtolower(trim($sp['ten']), 'UTF-8');
        if (preg_match('/\b' . preg_quote($ten_sp, '/') . '\b/u', $cau_hoi)) {
            $sp_tim_thay[] = $sp['ten'];
        }
    }

    return array_unique($sp_tim_thay);
}

$the_trang_keywords = [
    'tiểu đường', 'cao huyết áp', 'giảm cân', 'béo phì', 'mỡ máu cao', 'người già', 'trẻ em', 'bà bầu'
];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = $_POST['question'] ?? '';

    $json = file_get_contents("../database/sanpham.json");
    if (!$json) {
        echo json_encode(['answer' => "❌ Không đọc được file sanpham.json"]);
        exit;
    }

    $sanphams = json_decode($json, true);
    if (!$sanphams) {
        echo json_encode(['answer' => "❌ Lỗi khi đọc dữ liệu JSON"]);
        exit;
    }

    // --- Kiểm tra có từ khóa thể trạng không ---
    $question_lower = mb_strtolower($question, 'UTF-8');
    $che_do_yeu_cau = null;

    foreach ($the_trang_keywords as $keyword) {
        if (mb_strpos($question_lower, $keyword) !== false) {
            $che_do_yeu_cau = $keyword;
            break;
        }
    }

    $messages = [];

    if ($che_do_yeu_cau) {
        $gợi_ý = [];
        foreach ($sanphams as $sp) {
            if (in_array($che_do_yeu_cau, $sp['che_do_phu_hop'])) {
                $gợi_ý[] = "- {$sp['ten']} ({$sp['donvi']}, {$sp['gia']}đ)";
            }
        }

        if (!empty($gợi_ý)) {
            $danhsach = implode("\n", $gợi_ý);
            $messages[] = [
                "role" => "system",
                "content" => "Bạn là chuyên gia dinh dưỡng. Trả lời bằng tiếng Việt, thân thiện, ngắn gọn, dễ hiểu. Chỉ được tư vấn dựa trên danh sách sản phẩm dưới đây. Tuyệt đối không được bịa thêm sản phẩm khác nếu không có trong danh sách. Nếu không có sản phẩm phù hợp thì hãy nói 'Hiện tại chưa có sản phẩm phù hợp'.\n\nDanh sách sản phẩm phù hợp với \"$che_do_yeu_cau\":\n$danhsach"
            ];

        } else {
            echo json_encode(['answer' => "❌ Hiện tại chưa có sản phẩm nào phù hợp với \"$che_do_yeu_cau\"."]);
            exit;
        }
    } else {
        // --- Nếu không phải câu hỏi thể trạng → kiểm tra tên sản phẩm ---
        $ds_sp = kiem_tra_sanpham($question, $sanphams);
        $phanhoi_sp = '';

        if (!empty($ds_sp)) {
            foreach ($ds_sp as $ten_sp) {
                foreach ($sanphams as $sp) {
                    if (mb_strtolower($sp['ten'], 'UTF-8') === mb_strtolower($ten_sp, 'UTF-8')) {
                        $phanhoi_sp .= "✔️ {$sp['ten']} ({$sp['donvi']}), giá: {$sp['gia']}đ\n";
                        break;
                    }
                }
            }

            $messages[] = [
                "role" => "system",
                "content" => "Bạn là nhân viên tư vấn tại cửa hàng thực phẩm sạch. Tất cả câu trả lời phải bằng tiếng Việt, ngắn gọn, dễ hiểu. Chỉ trả lời dựa trên danh sách sản phẩm sau:\n$phanhoi_sp"
            ];
        } else {
            // Không nhận diện sản phẩm cũng không phải thể trạng → trả lời tự do
            $messages[] = [
                "role" => "system",
                "content" => "Bạn là chuyên gia dinh dưỡng và tư vấn sản phẩm. Hãy tư vấn bằng tiếng Việt, giọng thân thiện, ngắn gọn, không dùng từ chuyên môn phức tạp."
            ];
        }
    }

    $messages[] = [
        "role" => "user",
        "content" => $question
    ];

    // --- Gửi prompt đến LLaMA3 qua FastAPI ---
    $ch = curl_init('http://localhost:8000/chat');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(['messages' => $messages]));
    $response = curl_exec($ch);

    if ($response === false) {
        $error = curl_error($ch);
        curl_close($ch);
        echo json_encode(['answer' => "❌ Lỗi kết nối AI: $error"]);
        exit;
    }

    curl_close($ch);
    $data = json_decode($response, true);
    $answer = $data['answer'] ?? 'Không nhận được phản hồi.';
    echo json_encode(['answer' => $answer]);
    exit;
}
?>
