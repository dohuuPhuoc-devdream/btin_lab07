<?php
// Kết nối đến cơ sở dữ liệu
$link = mysqli_connect("localhost", "root", "", "db_bangtin"); 

// Kiểm tra kết nối
if (!$link) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Hàm chạy truy vấn không trả về dữ liệu
function chayTruyVanKhongTraVeDL($link, $q)
{
    $result = mysqli_query($link, $q);
    return $result;
}

// Chọn truy vấn bạn muốn thực hiện
$action = "1"; // Thay đổi thành "1", "2", "3" tùy theo truy vấn bạn muốn chạy

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

// Đóng kết nối
mysqli_close($link);
?>