<?php
class Connection
{
    private string $host;
    private string $dbname;
    private string $username;
    private string $password;
    private ?PDO $db = null; // Make it nullable to handle initialization

    public function __construct()
    {
        $this->host = 'localhost';
        $this->dbname = 'manager';
        $this->username = 'root';
        $this->password = '';

        try {
            $this->db = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    public function getDb(): PDO
    {
        if ($this->db === null) {
            throw new RuntimeException('Database connection not initialized');
        }

        return $this->db;
    }
}
