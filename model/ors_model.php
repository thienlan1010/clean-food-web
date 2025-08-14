<?php

include_once "thuvien.php"; // thêm dòng này ở trên cùng

function layTenPhuong($phuong_id) {
    $conn = ketnoidb();
    $stmt = $conn->prepare("SELECT P_TENPHUONGXA FROM phuong_xa WHERE P_ID = ?");
    $stmt->execute([$phuong_id]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row ? $row['P_TENPHUONGXA'] : '';
}

function get_coordinates($address) {
    $apiKey = 'eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6ImFkNmNjNzljNzMxMDRkNTM4OGU0ODM4MjY1Y2U4ODM4IiwiaCI6Im11cm11cjY0In0=';
    $url = "https://api.openrouteservice.org/geocode/search?api_key=$apiKey&text=" . urlencode($address);
    $response = file_get_contents($url);
    $data = json_decode($response, true);
    if (isset($data['features'][0]['geometry']['coordinates'])) {
        $coordinates = $data['features'][0]['geometry']['coordinates'];
        return ['lng' => $coordinates[0], 'lat' => $coordinates[1]];
    }
    return false;
}

function get_distance_from_store($toLat, $toLng) {
    $apiKey = 'eyJvcmciOiI1YjNjZTM1OTc4NTExMTAwMDFjZjYyNDgiLCJpZCI6ImFkNmNjNzljNzMxMDRkNTM4OGU0ODM4MjY1Y2U4ODM4IiwiaCI6Im11cm11cjY0In0=';
    //tọa độ của chợ bến thành -> là cửa hàng 
    $storeLat = 10.772718;
    $storeLng = 106.697362;
    $postData = json_encode([
        'coordinates' => [[$storeLng, $storeLat], [$toLng, $toLat]]
    ]);
    $ch = curl_init("https://api.openrouteservice.org/v2/directions/driving-car");
    curl_setopt_array($ch, [
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $postData,
        CURLOPT_HTTPHEADER => [
            "Authorization: $apiKey",
            "Content-Type: application/json"
        ]
    ]);
    $response = curl_exec($ch);
    curl_close($ch);
    $data = json_decode($response, true);
    if (isset($data['routes'][0]['summary']['distance'])) {
        return round($data['routes'][0]['summary']['distance'] / 1000, 2); // km
    }
    return false;
}

if (isset($_POST['phuong_id']) && isset($_POST['diachi'])) {
    $tenPhuong = layTenPhuong($_POST['phuong_id']);
    $fullAddress = $_POST['diachi'] . ', ' . $tenPhuong . ', TP Hồ Chí Minh';

    $coords = get_coordinates($fullAddress);
    if ($coords) {
        $distance = get_distance_from_store($coords['lat'], $coords['lng']);
        if ($distance !== false) {
            echo $distance;
        } else {
            echo 'Không tính được';
        }
    } else {
        echo 'Không tìm được tọa độ';
    }
}
?>
