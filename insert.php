<?php
require_once "db_module.php";

taoKetNoi($link);

// Câu lệnh INSERT: thêm một bản tin mới
$sql = "INSERT INTO tbl_bantin ($id_danhmuc, $tieude, $hinhanh, $noidung, $tukhoa, $nguontin, $like, $rating)
        VALUES (110, 1, 'Tin công nghệ mới nhất', 'tech_new.jpg', 'Nội dung tin công nghệ...', 'công nghệ, AI', 'VnExpress', 55, 4.2)";

// Thực thi câu lệnh
$result = chayTruyVanKhongTraVeDL($link, $sql);

if ($result) {
    echo "Thêm bản tin thành công!";
} else {
    echo "Thêm bản tin thất bại!";
}

// Giải phóng tài nguyên
giaiPhongBoNho($link, $result);
?>