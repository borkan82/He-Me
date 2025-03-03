<?php

/**
 * SecretVisitorsLog Class
 */
class VisitorsLog {

    private $table = 'tab_visitors_log';
    private $db;

    /**
     * @param DbPDO $db
     */
    public function __construct(DbPDO $db)
    {
        $this->db = $db;
    }

    /**
     * Function to insert page visitors
     * @param $data
     * @return bool
     */
    public function insertVisitor($data){
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

}