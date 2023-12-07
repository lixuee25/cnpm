<?php
use PHPUnit\Framework\TestCase;
include '../connection/database.php';
include '../models/admin_model.php';


class AdminTest extends TestCase {
    private $adminSuccess;
    private $pdo;

    protected function setUp(): void {
        $this->adminSuccess = new Admin(1, 'admin', 'password');
        $this->pdo = getConnection();

    }

    public function testCheckLoginSuccess() {
        $this->assertTrue($this->adminSuccess->checkLogin('admin', '12345', $this->pdo));
    }


}
?>