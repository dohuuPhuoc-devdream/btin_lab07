<?php
require_once "config.php";

function taoKetNoi(&$link)
{
	$link = mysqli_connect(HOST, USER, PASSWORD, DB);
	if (mysqli_connect_errno()) {
		echo "Lỗi kết nối đến máy chủ: " . mysqli_connect_error();
		exit();
	}
}

function chayTruyVanTraVeDL($link, $q)
{
	$result = mysqli_query($link, $q);
	return $result;
}

function chayTruyVanKhongTraVeDL($link, $q)
{
	$result = mysqli_query($link, $q);
	return $result;
}

function giaiPhongBoNho($link, $result)
{
	try {
		mysqli_close($link);
		mysqli_free_result($result);
	} catch (TypeError $e) {
	}
}

// Chọn truy vấn bạn muốn thực hiện
$action = "1"; // Thay đổi thành "1", "2", "3", hoặc "4" tùy theo truy vấn bạn muốn chạy

switch($action) {
    case "1":
        // Xóa tất cả các bình luận của bản tin có tiêu đề "Sự thay đổi cách thức mua sắm..."
        $query = "DELETE bl FROM tbl_binhluan bl
                  JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
                  WHERE bt.tieude = 'Sự thay đổi cách thức mua sắm của khách hàng trong thời kỳ khủng hoảng điện tử'";
        break;
    case "2":
        // Xóa các bình luận chứa từ khóa "ngốc nghếch" về bản tin Apple
        $query = "DELETE bl FROM tbl_binhluan bl
                  JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
                  WHERE bt.tieude = 'Thoái trào tất yếu của Apple trước cạnh tranh trên thị trường smartphone'
                  AND bl.noidung LIKE '%ngốc nghếch%'";
        break;
    case "3":
        // Đặt lại lượt like về 0
        $query = "UPDATE tbl_bantin SET `like` = 0";
        break;
    case "4":
        // Xóa bản tin mới thêm vào
        $query = "DELETE FROM tbl_bantin 
                  WHERE id_bantin = 167 
                  AND id_danhmuc = 1 
                  AND tieude = 'Bản tin mới về công nghệ AI'";
        break;
    default:
        die("Không có truy vấn được chọn");
}

// Thực thi truy vấn
$result = chayTruyVanKhongTraVeDL($link, $query);

// Kiểm tra kết quả
if ($result) {
    echo "Thực hiện truy vấn thành công!";
    
    // Hiển thị số hàng bị ảnh hưởng (chỉ với DELETE và UPDATE)
    if ($action != "select") {
        echo "<br>Số hàng bị ảnh hưởng: " . mysqli_affected_rows($link);
    }
} else {
    echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($link);
}

