<?php
class Thuoc
{
    private $idDonThuoc ;
    private $idThuoc;

    public function __construct($idDonThuoc, $idThuoc)
    {
        $this->idDonThuoc = $idDonThuoc;
        $this->idThuoc = $idThuoc;
    }

    public function getidDonThuoc()
    {
        return $this->idDonThuoc;
    }

    public function getidThuoc()
    {
        return $this->idThuoc;
    }
    public function setidDonThuoc($idDonThuoc)
    {

        $this->idDonThuoc = $idDonThuoc; 
    }

    public function setidThuoc($idThuoc)
    {
        $this->idThuoc = $idThuoc;
    }

    public function deleteThuoc($pdo){
        
        $query = "DELETE FROM chitietdonthuoc WHERE idDonThuoc = ? AND idThuoc = ?";
    
        // Chuẩn bị câu truy vấn
        $stmt = $pdo->prepare($query);
        
        // Kiểm tra lỗi khi chuẩn bị câu truy vấn
        if ($stmt === false) {
            echo "Lỗi chuẩn bị câu truy vấn: " . $pdo->error;
            exit();
        }
    
        // Bind các tham số
        $stmt->bind_param("ii", $this->idDonThuoc, $this->idThuoc);
    
        // Thực thi câu truy vấn
        $result = $stmt->execute();
    
        // Kiểm tra và thông báo kết quả xóa
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
?>