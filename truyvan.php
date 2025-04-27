<?php
require_once "db_module.php"; // Gọi module kết nối
taoKetNoi($link); // Gọi hàm tạo kết nối

// Chọn truy vấn bạn muốn thực hiện
$action = "all"; // Có thể là "1", "2", "3", "4" hoặc "all" để chạy tất cả

if($action == "1" || $action == "all") {
    // (1) Xóa tất cả các bình luận của bản tin có tiêu đề "Sự thay đổi cách thức mua sắm..."
    $sql_1 = "DELETE bl FROM tbl_binhluan bl
              JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
              WHERE bt.tieude = 'Sự thay đổi cách thức mua sắm của khách hàng trong thời kỳ khủng hoảng điện tử'";
    
    $result_1 = chayTruyVanKhongTraVeDL($link, $sql_1);
    if($result_1) {
        echo "<h2>Truy vấn (1) thực hiện thành công</h2>";
        echo "Đã xóa " . mysqli_affected_rows($link) . " bình luận của bản tin có tiêu đề 'Sự thay đổi cách thức mua sắm của khách hàng...'<br><br>";
    } else {
        echo "<h2>Truy vấn (1) thất bại</h2>";
        echo "Lỗi: " . mysqli_error($link) . "<br><br>";
    }
}

if($action == "2" || $action == "all") {
    // (2) Xóa các bình luận chứa từ khóa "ngốc nghếch" về bản tin Apple
    $sql_2 = "DELETE bl FROM tbl_binhluan bl
              JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
              WHERE bt.tieude = 'Thoái trào tất yếu của Apple trước cạnh tranh trên thị trường smartphone'
              AND bl.noidung LIKE '%ngốc nghếch%'";
    
    $result_2 = chayTruyVanKhongTraVeDL($link, $sql_2);
    if($result_2) {
        echo "<h2>Truy vấn (2) thực hiện thành công</h2>";
        echo "Đã xóa " . mysqli_affected_rows($link) . " bình luận có từ khóa 'ngốc nghếch' của bản tin về Apple<br><br>";
    } else {
        echo "<h2>Truy vấn (2) thất bại</h2>";
        echo "Lỗi: " . mysqli_error($link) . "<br><br>";
    }
}

if($action == "3" || $action == "all") {
    // (3) Đặt lại tất cả lượt like về 0
    $sql_3 = "UPDATE tbl_bantin SET `like` = 0";
    
    $result_3 = chayTruyVanKhongTraVeDL($link, $sql_3);
    if($result_3) {
        echo "<h2>Truy vấn (3) thực hiện thành công</h2>";
        echo "Đã đặt lại lượt like về 0 cho " . mysqli_affected_rows($link) . " bản tin<br><br>";
    } else {
        echo "<h2>Truy vấn (3) thất bại</h2>";
        echo "Lỗi: " . mysqli_error($link) . "<br><br>";
    }
}

if($action == "4" || $action == "all") {
    // (4) Xóa bản tin mới được thêm vào danh mục "Công nghệ"
    $sql_4 = "DELETE FROM tbl_bantin 
              WHERE id_bantin = 167 
              AND id_danhmuc = 1 
              AND tieude = 'Bản tin mới về công nghệ AI'";
    
    $result_4 = chayTruyVanKhongTraVeDL($link, $sql_4);
    if($result_4) {
        echo "<h2>Truy vấn (4) thực hiện thành công</h2>";
        echo "Đã xóa " . mysqli_affected_rows($link) . " bản tin mới về công nghệ AI<br><br>";
    } else {
        echo "<h2>Truy vấn (4) thất bại</h2>";
        echo "Lỗi: " . mysqli_error($link) . "<br><br>";
    }
}

// Giải phóng tài nguyên
giaiPhongBoNho($link, null);
?>