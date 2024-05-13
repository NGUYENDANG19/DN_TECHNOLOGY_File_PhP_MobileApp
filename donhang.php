<?php
include "connect.php";

// Nhận dữ liệu từ POST
$sdt = $_POST['sdt'];
$email = $_POST['email'];
$tongtien = $_POST['tongtien'];
$iduser = $_POST['iduser'];
$diachi = $_POST['diachi'];
$soluong = $_POST['soluong'];
$chitiet = $_POST['chitiet'];

// Thực hiện truy vấn INSERT INTO để thêm thông tin đơn hàng vào bảng `donhang`
$query = 'INSERT INTO `donhang`(`iduser`,`diachi`, `sodienthoai`, `email`, `soluong`, `tongtien`) VALUES ('.$iduser.',"'.$diachi.'", "'.$sdt.'", "'.$email.'", '.$soluong.', '.$tongtien.')';
$data = mysqli_query($conn, $query);

if ($data) {
    // Lấy ID của đơn hàng vừa được thêm vào
    $query = 'SELECT id AS iddonhang FROM `donhang` WHERE `iduser` = '.$iduser.' ORDER BY id DESC LIMIT 1';
    $data = mysqli_query($conn, $query);

    if ($data && mysqli_num_rows($data) > 0) {
        $row = mysqli_fetch_assoc($data);
        $iddonhang = $row['iddonhang'];

        // Chuyển đổi chuỗi JSON của chi tiết đơn hàng thành mảng PHP
        $chitiet = json_decode($chitiet, true);

        // Thêm thông tin chi tiết đơn hàng vào bảng `chitietdonhang`
        foreach ($chitiet as $value) {
            $truyvan = 'INSERT INTO `chitietdonhang`(`iddonhang`, `idsp`, `soluong`, `gia`) VALUES ('.$iddonhang.', '.$value['idsp'].', '.$value['soluong'].', "'.$value['giasp'].'")';
            $data = mysqli_query($conn, $truyvan);
        }

        if ($data) {
            $arr = [
                'success' => true,
                'message' => "Thành công"
            ];
        } else {
            $arr = [
                'success' => false,
                'message' => "Không thành công khi thêm chi tiết đơn hàng"
            ];
        }
    } else {
        $arr = [
            'success' => false,
            'message' => "Không tìm thấy ID đơn hàng mới"
        ];
    }
} else {
    $arr = [
        'success' => false,
        'message' => "Không thành công khi thêm đơn hàng"
    ];
}

// Trả về kết quả dưới dạng JSON
print_r(json_encode($arr));
?>
