<?php
class crud
{
    private $db;

    function __construct($DB_con)
    {
        $this->db = $DB_con;
    }

    public function create($table, $fieldArr)
    {
        try {
            if ($fieldArr != '') {
                foreach ($fieldArr as $key => $val) {
                    $fieldArr1[] = '?';
                    $fieldArr2[] = '`'.$key.'`';
                    $valueArr[] = $val;
                }
                $field = implode(",", $fieldArr1);
                $field1 = implode(",", $fieldArr2);
                $stmt = $this->db->prepare("INSERT INTO $table ($field1) VALUES($field)");
               /* for ($i = 0; $i < count($valueArr); $i++) {
                    $stmt->bindparam(':' . $fieldArr2[$i], $valueArr[$i]);
                }*/
                 // print_r($stmt);
                $stmt->execute($valueArr);

                $lastid = $this->db->lastInsertId();
            }
            return $lastid;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function update($table, $fieldArr, $id)
    {
        try {
            if ($fieldArr != '') {
                foreach ($fieldArr as $key => $val) {
                    $fieldArr1[] = ':' . $key;
                    $fieldArr2[] = '`'.$key.'`';
                    $valueArr[] = $val;
                }
               
                for ($i = 0; $i < count($valueArr); $i++) {
                    $stmt = $this->db->prepare("UPDATE $table SET $fieldArr2[$i]='" . $valueArr[$i] . "' where `Clé_Affilié` ='" . $id . "'");

                   // $stmt->bindparam(':'.$fieldArr2[$i], $valueArr[$i]);
                    $stmt->execute();

                   
                }
                 
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
     public function updateContact($table, $fieldArr, $id)
    {
        try {
            if ($fieldArr != '') {
                foreach ($fieldArr as $key => $val) {
                    $fieldArr1[] = ':' . $key;
                    $fieldArr2[] = '`'.$key.'`';
                    $valueArr[] = $val;
                }
               
                for ($i = 0; $i < count($valueArr); $i++) {
                    $stmt = $this->db->prepare("UPDATE $table SET $fieldArr2[$i]='" . $valueArr[$i] . "' where `N°` ='" . $id . "'");

                   // $stmt->bindparam(':'.$fieldArr2[$i], $valueArr[$i]);
                    $stmt->execute();

                   
                }
                 
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
     public function updateAffilie($table, $fieldArr, $id)
    {
        try {
            if ($fieldArr != '') {
                foreach ($fieldArr as $key => $val) {
                    $fieldArr1[] = ':' . $key;
                    $fieldArr2[] = '`'.$key.'`';
                    $valueArr[] = $val;
                }
               
                for ($i = 0; $i < count($valueArr); $i++) {
                    $stmt = $this->db->prepare("UPDATE $table SET $fieldArr2[$i]='" . $valueArr[$i] . "' where `Clé Affiliation` ='" . $id . "'");

                   // $stmt->bindparam(':'.$fieldArr2[$i], $valueArr[$i]);
                    $stmt->execute();

                   
                }
                 
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
      public function updateUser($table, $fieldArr, $id)
    {
        try {
            if ($fieldArr != '') {
                foreach ($fieldArr as $key => $val) {
                    $fieldArr1[] = ':' . $key;
                    $fieldArr2[] = $key;
                    $valueArr[] = $val;
                }
               
                for ($i = 0; $i < count($valueArr); $i++) {
                    $stmt = $this->db->prepare("UPDATE $table SET $fieldArr2[$i]='" . $valueArr[$i] . "' where id='" . $id . "'");

                   // $stmt->bindparam(':'.$fieldArr2[$i], $valueArr[$i]);
                    $stmt->execute();

                   
                }
                 
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function BuildingUpdate($table, $fieldArr, $id)
    {
        try {
            if ($fieldArr != '') {
                foreach ($fieldArr as $key => $val) {
                    $fieldArr1[] = ':' . $key;
                    $fieldArr2[] = $key;
                    $valueArr[] = $val;
                }
                for ($i = 0; $i < count($valueArr); $i++) {
                    $stmt = $this->db->prepare("UPDATE $table SET $fieldArr2[$i]='" . $valueArr[$i] . "' where zoho_batiment_id='" . $id . "'");
                  //  $stmt->bindparam(':' . $fieldArr2[$i], $valueArr[$i]);
                    $stmt->execute();
                }
            }
            return true;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }
    public function getID($table, $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $table WHERE `Clé_Affilié`=:id");
        $stmt->execute(array(":id" => $id));
        $editRow = $stmt->fetch(PDO::FETCH_ASSOC);
        return $editRow;
    }
    public function delete($table, $id)
    {
        $stmt = $this->db->prepare("Delete from $table WHERE  `Clé_Affilié`=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
     
        return true;
    }
        public function deleteContacts($table, $id)
    {
        $stmt = $this->db->prepare("Delete from $table WHERE  `N°`=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
     
        return true;
    }
     public function deleteAffiliation($table, $id)
    {
        $stmt = $this->db->prepare("Delete from $table WHERE  `Clé Affiliation`=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
     
        return true;
    }
    public function deleteCompanys($table, $id)
    {
        $stmt = $this->db->prepare("DELETE FROM $table WHERE zoho_company_id=:id");
        $stmt->bindparam(":id", $id);
        $stmt->execute();
        return true;
    }



public function updateUsers($table, $fieldArr, $id)
{
    try {
        if ($fieldArr != '') {
            foreach ($fieldArr as $key => $val) {
                $fieldArr1[] = ':' . $key;
                $fieldArr2[] = '`'.$key.'`';
                $valueArr[] = $val;
            }
           
            for ($i = 0; $i < count($valueArr); $i++) {
                $stmt = $this->db->prepare("UPDATE $table SET $fieldArr2[$i]='" . $valueArr[$i] . "' where `N°` ='" . $id . "'");

               // $stmt->bindparam(':'.$fieldArr2[$i], $valueArr[$i]);
                $stmt->execute();

               
            }
             
        }
        return true;
    } catch (PDOException $e) {
        echo $e->getMessage();
        return false;
    }
}
}