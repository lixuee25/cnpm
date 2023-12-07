<?php
// Lấy giá trị idDonThuoc từ URL
$idDonThuoc = isset($_GET['idDonThuoc']) ? $_GET['idDonThuoc'] : null;
$conn = new mysqli("localhost", "root", "", "cnpm", "3306");

// Check connection
if ($conn->connect_errno) {
    echo "Kết nối MYSQLi lỗi" . $conn->connect_error;
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // ... (previous code)

    // Validate and initialize dosage variables
    $soLuongUongTrenMotLan = isset($_GET["soLuongUongTrenMotLan"]) ? intval($_GET["soLuongUongTrenMotLan"]) : 0;
    $soLanUongTrenMotNgay = isset($_GET["soLanUongTrenMotNgay"]) ? intval($_GET["soLanUongTrenMotNgay"]) : 0;
    $idThuoc = isset($_GET["idThuoc"]) ? intval($_GET["idThuoc"]) : 0; // Assuming this is the medication ID

    // Perform dosage validation
    if ($soLuongUongTrenMotLan <= 0 || $soLanUongTrenMotNgay <= 0) {
        die("Lỗi: Số lượng uống trên 1 lần hoặc số lần uống trên 1 ngày không hợp lệ.");
    }

    // Retrieve medication dosage information from the database
    $getDosageInfoQuery = $conn->prepare("SELECT maxSoLuongUongTrenMotLan, maxSoLanUongTrenMotNgay FROM lieudung WHERE idThuoc = ?");
    
    if (!$getDosageInfoQuery) {
        die("Lỗi: " . $conn->error); // Print the error message
    }

    $getDosageInfoQuery->bind_param("i", $idThuoc);
    $getDosageInfoQuery->execute();
    $getDosageInfoQuery->bind_result($maxSoLuongUongTrenMotLanDB, $maxSoLanUongTrenMotNgayDB);
    $getDosageInfoQuery->fetch();
    $getDosageInfoQuery->close();

    // Check against dosage limits
    if ($soLuongUongTrenMotLan > $maxSoLuongUongTrenMotLanDB) {
        echo '<div style="color: red;">Lỗi: Số lượng uống trên 1 lần vượt quá giới hạn. Giới hạn: ' . $maxSoLuongUongTrenMotLanDB . '</div>';
        echo '<button onclick="closePage(' . $idDonThuoc . ')">Thoát</button>';
        echo '<script>
        function closePage(idDonThuoc) {
            // Redirect to thuoc.php?idDonThuoc=<your_idDonThuoc>
            window.location.href = "thuoc.php?idDonThuoc=" + idDonThuoc;
        }
      </script>';

        die();
    }
    
    // The rest of your code...
    

    if ($soLanUongTrenMotNgay > $maxSoLanUongTrenMotNgayDB) {
        echo '<div style="color: red;">Lỗi: Số lần uống trên 1 ngày vượt quá giới hạn. Giới hạn: ' .  $maxSoLuongUongTrenMotNgayDB. '</div>';
        echo '<button onclick="closePage(' . $idDonThuoc . ')">Thoát</button>';
        echo '<script>
        function closePage(idDonThuoc) {
            // Redirect to thuoc.php?idDonThuoc=<your_idDonThuoc>
            window.location.href = "thuoc.php?idDonThuoc=" + idDonThuoc;
        }
      </script>';

        die();
    }

    

    // If validation passes, proceed with linking the medication
    $linkMedicationQuery = $conn->prepare("INSERT INTO chitietdonthuoc (idDonThuoc, idThuoc) VALUES (?, ?)");

    if (!$linkMedicationQuery) {
        die("Lỗi: " . $conn->error); // Print the error message
    }

    $linkMedicationQuery->bind_param("ii", $idDonThuoc, $idThuoc);

    if ($linkMedicationQuery->execute()) {
        echo "Thuốc đã được thêm thành công.";
        header("Location: donke.php?idDonThuoc=" . $idDonThuoc);
        
        exit();
    } else {
        echo '<div style="color: red;">Lỗi khi liên kết thuốc với đơn thuốc: ' . $linkMedicationQuery->error . '</div>';
        echo '<button onclick="closePage(' . $idDonThuoc . ')">Thoát</button>';
        echo '<script>
        function closePage(idDonThuoc) {
            // Redirect to thuoc.php?idDonThuoc=<your_idDonThuoc>
            window.location.href = "thuoc.php?idDonThuoc=" + idDonThuoc;
        }
      </script>';


    }

    // Close the linking query
    $linkMedicationQuery->close();

    // Close the medication dosage query
    $getDosageInfoQuery->close();
} else {
    die("Lỗi: Phương thức yêu cầu không hợp lệ.");
}

// Close the check query
$checkDonThuocQuery->close();
$conn->close();
?>
<script>
    function closePage() {
        // Redirect to thuoc.php?idDonThuoc=<your_idDonThuoc>
        window.location.href = "thuoc.php?idDonThuoc=" + <?php echo json_encode($idDonThuoc); ?>;
    }
</script>