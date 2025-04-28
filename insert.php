<?php
require_once "db_module.php";

taoKetNoi($link);

// Khai báo biến nha
$id_bantin = 111;
$id_danhmuc = 2;
$tieude = "Tin thể thao nóng hổi";
$hinhanh = "thethao.jpg";
$noidung = "Chi tiết về trận đấu...";
$tukhoa = "thể thao, bóng đá";
$nguontin = "24h.com.vn";
$like = 80;
$rating = 4.7;

// Gán vào SQL
$sql = "INSERT INTO tbl_bantin (id_bantin, id_danhmuc, tieude, hinhanh, noidung, tukhoa, nguontin, `like` , rating)
        VALUES ($id_bantin, $id_danhmuc, '$tieude', '$hinhanh', '$noidung', '$tukhoa', '$nguontin', $like, $rating)";

$result = chayTruyVanKhongTraVeDL($link, $sql);

if ($result) {
    echo "Thêm bản tin thành công!";
} else {
    echo "Lỗi khi thêm bản tin!";
}

giaiPhongBoNho($link, $result);
?>
