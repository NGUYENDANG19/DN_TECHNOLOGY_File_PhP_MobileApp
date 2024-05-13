<?php
include "Connect.php";
$query = "SELECT * FROM `sanphammoi` ORDER BY id DESC";
$data = mysqli_query($conn, $query);
$result = array();
while ($row = mysqli_fetch_assoc($data)) {
    $result[] = ($row);
    //code...
}

if (!empty($result)) {

    $arr = [
        'success' => true,
        'message' => "thanhcong",
        'result' => $result // Fix: Changed double quote to single quote
    ];

} else {
    $arr = [
        'success' => false,
        'message' => "khong thanh cong",
        'result' => $result // Fix: Changed double quote to single quote
    ];
}
print_r(json_encode($arr));

?>