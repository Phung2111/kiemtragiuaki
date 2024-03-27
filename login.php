<?php
session_start();

require_once("user.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Kiểm tra đăng nhập
    $user = User::getUserByUsername($username);
    if ($user && $user->password === $password) {
        // Đăng nhập thành công, lưu thông tin người dùng vào session
        $_SESSION["user"] = $user;
        header("Location: list_nhanvien.php"); // Chuyển hướng đến trang danh sách nhân viên
        exit();
    } else {
        // Đăng nhập không thành công
        echo "Invalid username or password";
    }
}
?>
