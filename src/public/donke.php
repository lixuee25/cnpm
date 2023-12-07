<?php
function getPrescriptionData($idDonThuoc)
{
    $conn = new mysqli("localhost", "root", "", "cnpm", "3306");

    // Check connection
    if ($conn->connect_errno) {
        echo "Kết nối MYSQLi lỗi" . $conn->connect_error;
        exit();
    }

    // Truy vấn để lấy thông tin đơn thuốc và thuốc
    $query = "SELECT dt.idDonThuoc, dt.TenDonThuoc, dt.chuandoan, dt.keluan, dt.ngayKeDon, t.idThuoc, t.tenThuoc, t.soLuongUongTrenMotLan, t.soLanUongTrenMotNgay, t.soLuong, t.donVi, t.doiTuongSuDung, b.tenBenhNhan,
    b.tuoi,b.gioiTinh,b.diaChi,b.soDienThoai,b.nhomMau,b.canNang
    FROM donthuoc dt
    JOIN chitietdonthuoc ctdt ON dt.idDonThuoc = ctdt.idDonThuoc
    JOIN thuoc t ON ctdt.idThuoc = t.idThuoc
    JOIN hosobenhnhan b ON dt.idHoSoBenhNhan = b.idHoSoBenhNhan
    WHERE dt.idDonThuoc = $idDonThuoc";


    // Execute the query
    $result = $conn->query($query);

    if ($result !== false) {
        $donThuocList = []; // Initialize an empty array to store the prescription data

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                // Build the prescription data
                $donThuoc = [
                    'idDonThuoc' => $row['idDonThuoc'],
                    'idThuoc' => $row['idThuoc'],
                    'tenBenhNhan' => $row['tenBenhNhan'],
                    'tuoi' => $row['tuoi'],
                    'gioiTinh' => $row['gioiTinh'],
                    'diaChi' => $row['diaChi'],
                    'soDienThoai' => $row['soDienThoai'],
                    'nhomMau' => $row['nhomMau'],
                    'canNang' => $row['canNang'],
                    'TenDonThuoc' => $row['TenDonThuoc'],
                    'chuandoan' => $row['chuandoan'],
                    'keluan' => $row['keluan'],
                    'ngayKeDon' => $row['ngayKeDon'],
                    
                    'tenThuoc' => $row['tenThuoc'],
                    'soLuongUongTrenMotLan' => $row['soLuongUongTrenMotLan'],
                    'soLanUongTrenMotNgay' => $row['soLanUongTrenMotNgay'],
                    'soLuong' => $row['soLuong'],
                    'donVi' => $row['donVi'],
                    'doiTuongSuDung' => $row['doiTuongSuDung']
                ];

                // Add the prescription to the list
                $donThuocList[] = $donThuoc;
            }
        } else {
            echo "<tr><td colspan='9'>Không có dữ liệu</td></tr>";
        }
    } else {
        echo "Query execution failed: " . $conn->error;
    }

    // Close the database connection
    $conn->close();

    return $donThuocList;
}

// Example usage: Pass the idDonThuoc as a parameter to retrieve the prescription data
$idDonThuoc = $_GET["idDonThuoc"];
$prescriptionData = getPrescriptionData($idDonThuoc);

// You can then use the $prescriptionData array as needed
// For example, you can iterate over it and display the values in a table
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/1147679ae7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="CSS/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Trang đăng nhập</title>
    <!-- Thay đổi đường dẫn của tệp CSS và hình ảnh -->
</head>
<body>
    <div class="container">
        <div id="header">
            <div class="logo">
                <img src="images/logo.png" alt="">
            </div>
            <div class="menu">
                <h2>Kê đơn thuốc</h2>
            </div>
        </div>
            <div class="kedon">
            <h3>Đơn thuốc</h3>
                <ul class="bn row">
        
                <li><b>Tên bệnh nhân: </b><?php echo $prescriptionData[0]["tenBenhNhan"]; ?></li>
                <li><b>Tuổi:</b> <?php echo $prescriptionData[0]["tuoi"]; ?></li>
                <li><b>Giới tính:</b> <?php echo $prescriptionData[0]["gioiTinh"]; ?></li>
                <li><b>Địa chỉ:</b> <?php echo $prescriptionData[0]["diaChi"]; ?></li>
                <li><b>Số điện thoại: </b><?php echo $prescriptionData[0]["soDienThoai"]; ?></li>
                <li><b>Nhóm máu: </b><?php echo $prescriptionData[0]["nhomMau"]; ?></li>
                <li><b>Cân nặng: </b> <?php echo $prescriptionData[0]["canNang"]; ?> kg</li>
                <li></li>
                </ul>

                <ul class="bn row">
                    <li><b> Chuẩn đoán: </b> 
                        <span id="chuandoan"><?php echo $prescriptionData[0]["chuandoan"]; ?></span>
                        <button style="color: #73cada; "  onclick="editDiagnosis()"><i class="fa-solid fa-wrench"></i>
                    </button>
                    </li>
                    <li><b>Kết luận:</b> 
                        <span id="keluan"><?php echo $prescriptionData[0]["keluan"]; ?></span>
                        <button style="color: #73cada; " onclick="editConclusion()"><i class="fa-solid fa-wrench"></i></button>
                    </li>
                    <li><b>Ngày kê đơn:</b> 
                        <span id="ngayKeDon"><?php echo $prescriptionData[0]["ngayKeDon"]; ?></span>
                        <button style="color: #73cada; " onclick="editPrescriptionDate()"><i class="fa-solid fa-wrench"></i></button>

                    </li>
                </ul>

                <h3>Thuốc điều trị</h3>
                <div class="dt">
                    <table>
                        <tr>
                            <th>STT</th>
                            <th>Mã thuốc</th>
                            <th>Tên Thuốc</th>
                            <th>Số lượng trên một ngày</th>
                            <th>Số lần uống trên một ngày</th>
                            <th>Số lượng</th>
                            <th>Đơn vị</th>
                            <th>Đối tượng sử dụng</th>
                            <th></th>
                        </tr>
                        <?php
                        if (count($prescriptionData) > 0) {
                            // Hiển thị dữ liệu trong bảng
                            $stt = 1;
                            foreach ($prescriptionData as $donThuoc) {
                                echo "<tr>";
                                echo "<td>" . $stt . "</td>";
                                echo "<td>" . $donThuoc["idThuoc"] . "</td>";
                                echo "<td>" . $donThuoc["tenThuoc"] . "</td>";
                                echo "<td>" . $donThuoc["soLuongUongTrenMotLan"] . "</td>";
                                echo "<td>" . $donThuoc["soLanUongTrenMotNgay"] . "</td>";
                                echo "<td>" . $donThuoc["soLuong"] . "</td>";
                                echo "<td>" . $donThuoc["donVi"] . "</td>";
                                echo "<td>" . $donThuoc["doiTuongSuDung"] . "</td>";
                                echo '<td>
                                <form action="xoa.php" method="POST" onsubmit="return confirm(\'Bạn có chắc muốn xóa thuốc này không?\');">
                                    <input type="hidden" name="idDonThuoc" value="' . $donThuoc["idDonThuoc"] . '">
                                    <input type="hidden" name="idThuoc" value="' . $donThuoc["idThuoc"] . '">
                                    <button type="submit" name="delete" style="border:none; background:none; cursor:pointer;">
                                        <i class="fa-solid fa-delete-left" style="color:#73cada;"></i>
                                    </button>
                                </form>
                                </td>';
                                echo "</tr>";
                                $stt++;
                            }
                            echo '<td colspan=\'10\'>
                            <a style="color: #73cada;" href="thuoc.php?idDonThuoc=' . $donThuoc["idDonThuoc"] . '">
                                <i class="fa-solid fa-plus"></i>
                            </a>
                            </td>';
                            } else {
                            echo "<tr><td colspan='10'>Không có dữ liệu</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class="bottom row">
                    <button style="color: aliceblue;" class="nut1"> <a href="http://localhost/thicuoiki/danhsachbn.php ">Thoát</a></button>
                    <button style="color: aliceblue;" class="nut2"><a href="http://localhost/thicuoiki/danhsachbn.php">Xuất đơn</a> </button>
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
                <p>&copy; 2023 Trang web kê đơn. Tất cả các quyền được bảo lưu.</p>
            </div>
        </footer>
    </div>
<script>
                function editDiagnosis() {
                    var diagnosis = prompt("Edit Diagnosis:", document.getElementById("chuandoan").innerText);
                    if (diagnosis !== null) {
                        // Send an AJAX request to update the database with the new diagnosis
                        updatePrescriptionData('chuandoan', diagnosis);
                    }
                }

                function editConclusion() {
                    var conclusion = prompt("Edit Conclusion:", document.getElementById("keluan").innerText);
                    if (conclusion !== null) {
                        // Send an AJAX request to update the database with the new conclusion
                        updatePrescriptionData('keluan', conclusion);
                    }
                }
                        function editPrescriptionDate() {
            var prescriptionDate = prompt("Edit Prescription Date:", document.getElementById("ngayKeDon").innerText);

            if (prescriptionDate !== null) {
                // Send an AJAX request to update the database with the new prescription date
                updatePrescriptionData('ngayKeDon', prescriptionDate);
            }
           }

                function updatePrescriptionData(field, value, prescriptionDate , ) {
                    var idDonThuoc = <?php echo $prescriptionData[0]["idDonThuoc"]; ?>;
                    var xhr = new XMLHttpRequest();

                    xhr.onreadystatechange = function() {
                    if (xhr.readyState == 4 && xhr.status == 200) {
                        // Handle the response if needed

                        // Redirect to donke.php after successful update
                        window.location.href = "donke.php?idDonThuoc=" + idDonThuoc;
                    }
                };

                xhr.open("POST", "suakl.php", true);
                xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                xhr.send("idDonThuoc=" + idDonThuoc + "&field=" + field + "&value=" + value + "&prescriptionDate=" + prescriptionDate);
}

 </script>
</body>
</html>