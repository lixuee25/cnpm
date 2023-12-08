<?php

include '../connection/database.php';
include '../models/thuoc_model.php';

$idDonThuoc = isset($_POST['idDonThuoc']) ? $_POST['idDonThuoc'] : null;
$idThuoc = isset($_POST['idThuoc']) ? $_POST['idThuoc'] : null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $idDonThuoc = $_POST['idDonThuoc'];
    $idThuoc = $_POST['idThuoc'];
    $dpo = getConnection();
    $thuoc = new Thuoc($idDonThuoc, $idThuoc);
    if ($thuoc->deleteThuoc($dpo)) {
        header("Location: ../public/donke.php?idDonThuoc=" . $idDonThuoc);
    } else {
        echo "Lỗi khi xóa thuốc: ";
    }
}
?>