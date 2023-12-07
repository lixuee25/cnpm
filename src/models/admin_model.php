<?php
class Admin
{
    private $id;
    private $name;
    private $password;

    public function __construct($id, $name, $password)
    {
        $this->id = $id;
        $this->name = $name;
        $this->password = $password;
    }
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }


    public function checkLogin($pdo, $username, $password)
    {
        $query = "SELECT * FROM Admin WHERE name = ? AND password = ?";
        $statement = $pdo->prepare($query);
        $statement->bind_param("ii",$username,$password);
        $statement->execute();

        // Lấy kết quả
        $result = $statement->get_result();

        // Fetch the associative array
         $row = $result->fetch_assoc();

         if ($row) {
            return true;
        } else {
            return false;
        }
        return false;
    }
}
?>