<?php

/**
 * GenderRequests Class
 */
class GenderRequests
{
    private $table = 'gender_requests';
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

    public function checkName($nameToCheck) {
        $sql = "SELECT  count(*) as rowNum, 
                        gender_names.name AS nameToCheck, 
                        gender_types.name 
                FROM gender_names
                LEFT JOIN gender_types ON gender_types.id = gender_names.gender_id 
                WHERE gender_names.name LIKE '". $nameToCheck ."' 
                AND gender_types.name IS NOT NULL
                GROUP BY gender_id;";

        $nameRowFound = $this->db->fetch($sql);

        $nameLength = strlen($nameToCheck);
        if ($nameLength > 4){
            $halfNameLength = round($nameLength / 2);

            $firstHalf = substr($nameToCheck, 0, $halfNameLength);

            $sql = "SELECT  gender_names.name AS nameToCheck, 
                            gender_types.name 
                    FROM gender_names 
                    LEFT JOIN gender_types ON gender_types.id = gender_names.gender_id
                    WHERE gender_names.name LIKE '". $firstHalf ."%' 
                    AND LENGTH(gender_names.name) <= " . $nameLength . " 
                    AND gender_types.name IS NOT NULL
                    GROUP BY gender_names.name";

            $similarNamesRows = $this->db->fetch($sql);
        }

        $nameFound = "Not found";
        $percentArr = [
            "Male"      => "0%",
            "Female"    => "0%",
            "Other"     => "0%"
        ];

        if(!empty($nameRowFound)) {
            $tempNamesCount = 0;
            $totalNames = 0;
            foreach ($nameRowFound as $rowKey => $rowVal) {
                if($rowVal['rowNum'] > $tempNamesCount) {
                    $tempNamesCount = $rowVal['rowNum'];
                    $nameFound      = $rowVal['name'];
                }
            }
        }

        $similarNames = 'No similar names';
        if(!empty($similarNamesRows)) {
            $similarNames = '';
            $namesCounter = 0;
            foreach ($similarNamesRows as $key => $value) {
                $namesCounter++;
                $similarNames .= "<br>" . ucfirst($value['nameToCheck']); //$similarNames .= "<br>" . ucfirst($value['nameToCheck'])." : ". $value['name'];
                if($namesCounter >= 5){
                    break; 
                }
            }
        }

        $response = "Name: <strong>". ucfirst(strtolower($nameToCheck)) . "</strong><br><br>";
        $response .= "Gender: <strong>". $nameFound . "</strong><br><br>";
        $response .= "Similar names: <strong>". $similarNames . "</strong><br><br>";
        $response .= "Length: <strong>". strlen($nameToCheck) . "</strong><br>";

        return $response;
    }
}