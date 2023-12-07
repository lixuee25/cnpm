<?php

include '../connection/database.php';
include '../models/admin_model.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $dpo = getConnection();
    // Thực hiện xử lý đăng nhập ở đây
    $admin = new Admin(1, $username, $password);
    if ($admin->checkLogin($dpo,$username,$password) == true) {
        header('Location: ../public/danhsachbn.php');
    } else {
        echo "<script>alert('Đăng nhập thất bại');</script>";
        header('Location: ../public/dangnhap.php');
    }

    // Chuyển hướng hoặc hiển thị thông báo thành công/ thất bại
}
?>