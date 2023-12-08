<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include __DIR__ . '/../connection/database.php';
include __DIR__ .'/../models/thuoc_model.php';

class ThuocTest extends TestCase {
    private $thuoc;
    private $pdo;

    protected function setUp(): void {

        $this->pdo = getConnection();
        $query = $this->pdo->prepare('INSERT INTO chitietdonthuoc (idDonThuoc, idThuoc) VALUES (1, 1)');
        $query->execute();
        $this->thuoc = new Thuoc(1,1);
    }

    public function tearDown(): void {
        $this->pdo = null;
        $this->thuoc = null;
    }

    public function testDeleteSuccess(): void {
        $this->assertTrue($this->thuoc->deleteThuoc($this->pdo));
    }

    public function testDeleteFail(): void {
        $this->assertFalse($this->thuoc->deleteThuoc($this->pdo));
    }
    
}
?>