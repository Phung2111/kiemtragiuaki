<style>
    /* Các quy tắc CSS khác */
    table {
        border-collapse: collapse;
        width: 50%;
    }

    th, td {
        padding: 8px;
        text-align: center;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
        color: red; /* Màu chữ đỏ cho hàng đầu */
    }

    tr:nth-child(even) {
        background-color: #f2f2f2; /* Màu nền vàng cho hàng chẵn */
    }

    tr:nth-child(odd) {
        background-color: #ffffff; /* Màu nền trắng cho hàng lẻ */
    }

    tr:hover {
        background-color: #ddd;
    }

    .pagination {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .pagination a {
        color: black;
        float: left;
        padding: 8px 16px;
        text-decoration: none;
        transition: background-color .3s;
        border: 1px solid #ccc; /* Khung xung quanh */
        margin-right: 5px; /* Khoảng cách giữa các liên kết */
    }

    .pagination a.active {
        background-color: dodgerblue;
        color: white;
        border: 1px solid dodgerblue; /* Khung xung quanh cho trang hiện tại */
    }

    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
</style>
<?php


// Include file entities/nhanvien.class.php and config/db.class.php
require_once("entities/nhanvien.class.php");
require_once("config/db.class.php");

// Số nhân viên trên mỗi trang
$records_per_page = 5;

// Tính toán số trang dựa trên tổng số nhân viên và số nhân viên trên mỗi trang
$total_records = Nhanvien::count_nhanvien();
$total_pages = ceil($total_records / $records_per_page);

// Lấy trang hiện tại từ tham số truyền vào
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;

// Tính offset để lấy dữ liệu từ database cho trang hiện tại
$offset = ($current_page - 1) * $records_per_page;

// Lấy danh sách nhân viên cho trang hiện tại
$prods = Nhanvien::list_nhanvien_paging($offset, $records_per_page);

// Hiển thị dữ liệu nhân viên
echo "<table border='1'>";
echo "<tr>";
echo "<th>Mã nhân viên</th>";
echo "<th>Tên Nhân Viên</th>";
echo "<th>Phái</th>";
echo "<th>Nơi Sinh</th>";
echo "<th>Mã Phòng</th>";
echo "<th>Lương</th>";
echo "<th>Thao tác</th>"; 
echo "</tr>";
foreach ($prods as $item) {
    echo "<tr>";
    echo "<td>".$item["Ma_NV"]."</td>";
    echo "<td>".$item["Ten_NV"]."</td>";
    echo "<td>";
    if ($item["Phai"] == "NAM") {
        echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcStVoKlv3fNnK0Vw_27GMSaJ0-yihsM63eOlBGiDyyWGQ&s" alt="Nam" width="50" height="50">';
    } else {
        echo '<img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSvcPzmRxFEM5bBy1vR0B7-IJt83NDrcHsCWSRAwPt3pQ&s" alt="Nữ" width="50" height="50">';
    }
    echo "</td>";
    echo "<td>".$item["Noi_Sinh"]."</td>";
    echo "<td>".$item["Ma_Phong"]."</td>";
    echo "<td>".$item["Luong"]."</td>";
    echo "<td><a href='delete.php?id=".$item["Ma_NV"]."'>Xóa</a> | <a href='edit.php?id=".$item["Ma_NV"]."'>Sửa</a></td>";
  
    echo "</tr>";
}
echo "</table>";

// Hiển thị các liên kết phân trang
echo "<div>";
echo "Trang: ";
for ($i = 1; $i <= $total_pages; $i++) {
    if ($i == $current_page) {
        echo "<strong>$i</strong> ";
    } else {
        echo "<a href='?page=$i'>$i</a> ";
    }
}
echo "</div>";


?>
