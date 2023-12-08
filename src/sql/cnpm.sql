CREATE TABLE hosobenhnhan (
    idHoSoBenhNhan INT AUTO_INCREMENT NOT NULL,
    tenBenhNhan VARCHAR(255) NOT NULL,
    tuoi INT NOT NULL,
    gioiTinh VARCHAR(20) NOT NULL,
    diaChi VARCHAR(255) NOT NULL,
    soDienThoai VARCHAR(11) NOT NULL,
    nhomMau VARCHAR(10),
    canNang FLOAT,
    PRIMARY KEY (idHoSoBenhNhan)
);

INSERT INTO hosobenhnhan (tenBenhNhan, tuoi, gioiTinh, diaChi, soDienThoai, nhomMau, canNang)
VALUES
    ('Nguyễn Văn A', 25, 'Nam', '123 Đường ABC, Quận XYZ, Thành phố HCM', '0123456789', 'A', 60.5),
    ('Lê Thị B', 30, 'Nữ', '456 Đường DEF, Quận UVW, Thành phố Hà Nội', '0987654321', 'B', 55.2),
    ('Trần Văn C', 40, 'Nam', '789 Đường GHI, Quận MNO, Thành phố Đà Nẵng', '0369852147', 'AB', 70.0),
    ('Phạm Thị D', 35, 'Nữ', '321 Đường JKL, Quận PQR, Thành phố Hải Phòng', '0765432198', 'O', 65.8),
    ('Hoàng Văn E', 28, 'Nam', '654 Đường STU, Quận IJK, Thành phố Cần Thơ', '0912345678', 'B', 62.1),
    ('Vũ Thị F', 42, 'Nữ', '987 Đường VWX, Quận YZA, Thành phố Nha Trang', '0543219876', 'A', 68.7),
    ('Đặng Văn G', 50, 'Nam', '159 Đường OPQ, Quận RST, Thành phố Huế', '0321654987', 'AB', 75.3),
    ('Ngô Thị H', 33, 'Nữ', '753 Đường UVW, Quận XYZ, Thành phố Vũng Tàu', '0876543210', 'B', 58.9),
    ('Lý Văn I', 45, 'Nam', '258 Đường KLM, Quận NOP, Thành phố Đà Lạt', '0654321098', 'O', 63.4),
    ('Hồ Thị K', 29, 'Nữ', '951 Đường EFG, Quận HIJ, Thành phố Đồng Nai', '0987654321', 'A', 61.7);

CREATE TABLE thuoc (
    idThuoc INT AUTO_INCREMENT NOT NULL,
    tenThuoc VARCHAR(525) NOT NULL,
    soLuongUongTrenMotLan FLOAT NOT NULL,
    soLanUongTrenMotNgay INT NOT NULL,
    soLuong FLOAT NOT NULL,
    donVi VARCHAR(50) NOT NULL,
    doiTuongSuDung VARCHAR(50) NOT NULL,
    PRIMARY KEY (idThuoc)
);

INSERT INTO thuoc (tenThuoc, soLuongUongTrenMotLan, soLanUongTrenMotNgay, soLuong, donVi, doiTuongSuDung)
VALUES
    ('Paracetamol', 1, 3, 30, 'Viên', 'Người lớn'),
    ('Amoxicillin', 1, 2, 20, 'Viên', 'Người lớn'),
    ('Omeprazole', 1, 1, 15, 'Viên', 'Người lớn'),
    ('Loperamide', 2, 3, 25, 'Viên', 'Người lớn'),
    ('Dexchlorpheniramine', 1, 2, 18, 'Viên', 'Người lớn'),
    ('Ibuprofen', 1, 3, 30, 'Viên', 'Người lớn'),
    ('Cetirizine', 1, 1, 12, 'Viên', 'Người lớn'),
    ('Metformin', 1, 2, 20, 'Viên', 'Người lớn'),
    ('Diazepam', 1, 1, 10, 'Viên', 'Người lớn'),
    ('Aspirin', 1, 2, 15, 'Viên', 'Người lớn');
CREATE TABLE lieudung (
    idlieudung INT AUTO_INCREMENT NOT NULL,
    idThuoc INT NOT NULL,
    maxSoLuongUongTrenMotLan INT NOT NULL,
    minSoLuongUongTrenMotLan INT NOT NULL,
    maxSoLanUongTrenMotNgay INT NOT NULL,
    minSoLanUongTrenMotNgay INT NOT NULL,
    PRIMARY KEY (idlieudung),
    FOREIGN KEY (idThuoc) REFERENCES thuoc (idThuoc)
);
INSERT INTO lieudung (idThuoc, maxSoLuongUongTrenMotLan, minSoLuongUongTrenMotLan, maxSoLanUongTrenMotNgay, minSoLanUongTrenMotNgay)
VALUES
    (1, 1, 3, 3, 1),
    (2, 1, 2, 2, 1),
    (3, 1, 1, 1, 1),
    (4, 2, 3, 3, 2),
    (5, 1, 2, 2, 1),
    (6, 1, 3, 3, 1),
    (7, 1, 1, 1, 1),
    (8, 1, 2, 2, 1),
    (9, 1, 1, 1, 1),
    (10, 1, 2, 2, 1);
CREATE TABLE donthuoc (
    idDonThuoc INT AUTO_INCREMENT NOT NULL,
    idHoSoBenhNhan INT NOT NULL,
    TenDonThuoc VARCHAR(50) NOT NULL,
    chuandoan VARCHAR(255) NOT NULL,
    keluan VARCHAR(255) NOT NULL,
    ngayKeDon DATE NOT NULL,
    PRIMARY KEY (idDonThuoc),
    FOREIGN KEY (idHoSoBenhNhan) REFERENCES hosobenhnhan (idHoSoBenhNhan)
);
INSERT INTO donthuoc (idHoSoBenhNhan, TenDonThuoc, chuandoan, keluan, ngayKeDon)
VALUES
    (1, 'Đơn thuốc 1', 'Sốt cao', 'Đau đầu, mệt mỏi', '2023-11-01'),
    (2, 'Đơn thuốc 2', 'Viêm họng', 'Đau họng, ho', '2023-11-02'),
    (3, 'Đơn thuốc 3', 'Tiểu đường', 'Mệt mỏi, đau chân', '2023-11-03'),
    (4, 'Đơn thuốc 4', 'Cảm lạnh', 'Sổ mũi, ho', '2023-11-04'),
    (5, 'Đơn thuốc 5', 'Đau lưng', 'Đau lưng, khó di chuyển', '2023-11-05'),
    (6, 'Đơn thuốc 6', 'Tiêu chảy', 'Buồn nôn, mất nước', '2023-11-06'),
    (7, 'Đơn thuốc 7', 'Huyết áp cao', 'Chóng mặt, đau đầu', '2023-11-07'),
    (8, 'Đơn thuốc 8', 'Đau răng', 'Đau răng, sưng nướu', '2023-11-08'),
    (9, 'Đơn thuốc 9', 'Mất ngủ', 'Khó ngủ, mệt mỏi', '2023-11-09'),
    (10, 'Đơn thuốc 10', 'Viêm khớp', 'Đau khớp, khó di chuyển', '2023-11-10');
CREATE TABLE chitietdonthuoc (
    idDonThuoc INT NOT NULL,
    idThuoc INT NOT NULL,
    FOREIGN KEY (idDonThuoc) REFERENCES donthuoc (idDonThuoc),
    FOREIGN KEY (idThuoc) REFERENCES thuoc (idThuoc),
    PRIMARY KEY (idDonThuoc, idThuoc)
);
INSERT INTO chitietdonthuoc (idDonThuoc, idThuoc)
VALUES
    (1, 1),
    (1, 2),
    (2, 3),
    (2, 4),
    (3, 5),
    (3, 6),
    (4, 7),
    (4, 8),
    (5, 9),
    (6, 1),
    (10, 2),
    (8, 3),
    (7, 4),
    (9, 5),
    (7, 6),
    (6, 7),
    (10, 8),
    (8, 9),
    (9, 5),
    (5, 10);
    
CREATE TABLE Admin (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(20) NOT NULL,
  password VARCHAR(50) NOT NULL
);

-- Insert Data into Admin Table
INSERT INTO Admin (name, password) VALUES
('admin', '12345');