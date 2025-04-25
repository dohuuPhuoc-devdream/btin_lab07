<?php
require_once "db_module.php"; // Gọi module kết nối

taoKetNoi($link); // Gọi hàm tạo kết nối

// Viết câu truy vấn SELECT
$sql = "SELECT * FROM tbl_bantin WHERE `like` > 80";

// Thực thi truy vấn
$result = chayTruyVanTraVeDL($link, $sql);

// Duyệt và in kết quả
echo "<h2>Danh sách bài viết có lượt like > 80:</h2>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<strong>Tiêu đề:</strong> " . $row['tieude'] . "<br>";
    echo "<strong>Lượt like:</strong> " . $row['like'] . "<br><br>";
    echo "Seclect thành công<br>";
}

// Giải phóng tài nguyên
giaiPhongBoNho($link, $result);
?>
