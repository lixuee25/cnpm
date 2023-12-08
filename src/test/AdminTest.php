<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;

include __DIR__ . '/../connection/database.php';
include __DIR__ .'/../models/admin_model.php';

class AdminTest extends TestCase {
    private $adminSuccess;

    private $adminFailue;
    private $pdo;

    protected function setUp(): void {

        $this->pdo = getConnection();
        $this->adminSuccess = new Admin(1,"admin","12345");
        $this->adminFailue = new Admin(1,"admin","aaa");
    }

    public function tearDown(): void {
        $this->pdo = null;
        $this->adminSuccess = null;
    }

    public function testCheckLoginSuccess() {
        $this->assertTrue($this->adminSuccess->checkLogin($this->pdo,"admin","12345"));
    }

    public function testCheckLoginFailue() {
        $this->assertFalse($this->adminFailue->checkLogin($this->pdo,"admin","aaaa"));
    }
}
?>