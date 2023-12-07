<?php
// Function to get available medications from the database
function getAvailableMedications($conn) {
    // Query to retrieve medications
    $query = "SELECT idThuoc, tenThuoc FROM thuoc";

    // Execute the query
    $result = $conn->query($query);

    // Check for errors
    if (!$result) {
        die("Lỗi truy vấn: " . $conn->error);
    }

    // Fetch medications into an array
    $medications = [];
    while ($row = $result->fetch_assoc()) {
        $medications[] = $row;
    }

    return $medications;
}

// Create a database connection
$conn = new mysqli("localhost", "root", "", "cnpm", "3306");

// Check connection
if ($conn->connect_errno) {
    die("Kết nối MYSQLi lỗi: " . $conn->connect_error);
}

// Lấy giá trị idDonThuoc từ URL
$idDonThuoc = isset($_GET['idDonThuoc']) ? $_GET['idDonThuoc'] : null;

// Call the function to get available medications
$availableMedications = getAvailableMedications($conn);

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
    <title>Trang đăng nhập</title>
    <!-- Thay đổi đường dẫn của tệp CSS và hình ảnh -->
</head>
<body>
    <div id="header">
        <div class="logo">
            <img src="images/logo.png" alt="">
        </div>
        <div class="menu"><h2>Thuốc</h2> </div>
    </div>
    <div class="container">
        <div class="t">
        <form class="thuoc"  action="them.php" method="GET">
        <input type="hidden" name="idDonThuoc" value="<?php echo $idDonThuoc; ?>">
        <!-- Assuming $availableMedications is an array of available medications -->
        <label for="idThuoc">Chọn Thuốc:</label>
        <select name="idThuoc" required>
            <option value="">Chọn thuốc</option>
            <?php foreach ($availableMedications as $medication): ?>
                <option value="<?php echo $medication['idThuoc']; ?>"><?php echo $medication['tenThuoc']; ?></option>
            <?php endforeach; ?>
        </select>

                <!-- Assuming $dosageLimits is an array with dosage limits -->
                <label for="soLuongUongTrenMotLan">Số Lượng Uống Trên Một Lần </label>
                <input type="number" name="soLuongUongTrenMotLan" required><br>

                <label for="soLanUongTrenMotNgay">Số Lần Uống Trên Một Ngày </label>
                <input type="number" name="soLanUongTrenMotNgay"  required><br>


                    <label for="soLuong">Số Lượng:</label>
                    <input type="number" name="soLuong" required><br>

                    <label for="donVi">Đơn Vị:</label>
                    <input type="text" name="donVi" required><br>

                    <label for="doiTuongSuDung">Đối Tượng Sử Dụng:</label>
                    <input type="text" name="doiTuongSuDung" required><br>
                    <div class="nut">
                     <input style=" font-size: 20px;" type="submit" value="Thêm Thuốc">
                    </div>
                </form>
        </div>
            
     </div>
           
     <footer>
        <div class="footer-container">
            <div class="footer-column">
                <h4>Theo dõi chúng tôi</h4>
                <ul class="social-icons">
                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2023 Trang web bán hàng. Tất cả các quyền được bảo lưu.</p>
        </div>
    </footer>
    </div>



</body>
</html>