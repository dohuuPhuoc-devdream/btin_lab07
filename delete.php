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
        // Cập nhật tiêu đề bản tin có tiêu đề "Sự thay đổi cách thức mua sắm..." thành một tiêu đề mới
        $query = "UPDATE tbl_bantin 
                  SET tieude = 'Tiêu đề mới cho bản tin' 
                  WHERE tieude = 'Sự thay đổi cách thức mua sắm của khách hàng trong thời kỳ khủng hoảng điện tử'";
        break;
    case "2":
        // Cập nhật nội dung các bình luận chứa từ khóa "ngốc nghếch" về bản tin Apple
        $query = "UPDATE tbl_binhluan bl
                  JOIN tbl_bantin bt ON bl.id_bantin = bt.id_bantin
                  SET bl.noidung = 'Nội dung mới cho bình luận'
                  WHERE bt.tieude = 'Thoái trào tất yếu của Apple trước cạnh tranh trên thị trường smartphone'
                  AND bl.noidung LIKE '%ngốc nghếch%'";
        break;
    case "3":
        // Cập nhật nội dung bản tin mới
        $query = "UPDATE tbl_bantin 
                  SET tieude = 'Bản tin mới về công nghệ AI đã được cập nhật'
                  WHERE id_bantin = 167";
        break;
    default:
        die("Không có truy vấn được chọn");
}

// Thực thi truy vấn
$result = chayTruyVanKhongTraVeDL($link, $query);

// Kiểm tra kết quả
if ($result) {
    echo "Thực hiện truy vấn thành công!";
    
    // Hiển thị số hàng bị ảnh hưởng (chỉ với UPDATE và DELETE)
    if ($action != "select") {
        echo "<br>Số hàng bị ảnh hưởng: " . mysqli_affected_rows($link);
    }
} else {
    echo "Lỗi khi thực hiện truy vấn: " . mysqli_error($link);
}

// Đóng kết nối
mysqli_close($link);
?>
