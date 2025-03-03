<?php

/**
 * SecretRequests Class
 */
class SecretRequests
{
    private $table = 'secret_requests';
    private $db;

    /**
     * @param DbPDO $db
     */
    public function __construct(DbPDO $db)
    {
        $this->db = $db;
    }

    /**
     * @param $data
     * @return void
     */
    public function insertData($data)
    {
        if (!empty($data)) {
            $fields = [];
            $values = [];
            foreach ($data as $fieldKey => $fieldValue) {
                $fields[] = "`" . $fieldKey . "`";
                $values[] = "'" . $fieldValue . "'";
            }

            $sql = "INSERT INTO " . $this->table . " (" . implode(",", $fields) . ") VALUES (" . implode(",", $values) . ")";
            $this->db->insert($sql);

            return true;
        }
        return false;
    }

    /**
     * @return mixed|string
     */
    public function getIpAddress()
    {
        $ip = "";

        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            $ip = $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
        } elseif (!empty($_SERVER['REMOTE_ADDR'])) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }

        return $ip;
    }
}