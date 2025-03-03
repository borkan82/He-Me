<?php

/**
 * Class DbParams
 * TODO add to gitignore
 */
class DbParams
{

    private $hostname = '127.0.0.1';
    private $username = '';
    private $password = '';
    private $dbName   = '';

    private static $conn;

    public function __construct()
    {

        try {
            self::$conn = new PDO("mysql:host={$this->hostname};dbname=$this->dbName;charset=utf8", $this->username, $this->password);
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $exc) {
            die("Connection error: " . $exc->getMessage());
        }
    }
    //ukoliko negde treba konekcija sto ne verujem da ce ti trebati mimo klasa sa upitima

    public function getConnection()
    {
        return self::$conn;
    }
}