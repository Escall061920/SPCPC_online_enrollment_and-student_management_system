<?php
require_once(LIB_PATH.DS.'database.php');


class StudentSubjects {
    protected static  $tblname = "studentsubjects";

    function dbfields() {
        global $mydb;
        return $mydb->getfieldsononetable(self::$tblname);
    }

    function listofStudentSubjects() {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname);
        return $cur;
    }

    function find_StudentSubjects($id = "", $name = "") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname . " WHERE STUDSUBJ_ID = {$id} OR LNAME = '{$name}'");
        $cur = $mydb->executeQuery();
        $row_count = $mydb->num_rows($cur);
        return $row_count;
    }

    function find_all_StudentSubjects($name = "") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname . " WHERE LNAME = '{$name}'");
        $cur = $mydb->executeQuery();
        $row_count = $mydb->num_rows($cur);
        return $row_count;
    }

    function single_StudentSubjects($id = "") {
        global $mydb;
        $mydb->setQuery("SELECT * FROM " . self::$tblname . " WHERE STUDSUBJ_ID= '{$id}' LIMIT 1");
        $cur = $mydb->loadSingleResult();
        return $cur;
    }

    /*---Instantiation of Object dynamically---*/
    static function instantiate($record) {
        $object = new self;

        foreach($record as $attribute => $value) {
            if($object->has_attribute($attribute)) {
                $object->$attribute = $value;
            }
        }
        return $object;
    }

    /*--Cleaning the raw data before submitting to Database--*/
    private function has_attribute($attribute) {
        return array_key_exists($attribute, $this->attributes());
    }

    protected function attributes() {
        global $mydb;
        $attributes = array();
        foreach($this->dbfields() as $field) {
            if(property_exists($this, $field)) {
                $attributes[$field] = $this->$field;
            }
        }
        return $attributes;
    }

    protected function sanitized_attributes() {
        global $mydb;
        $clean_attributes = array();
        foreach($this->attributes() as $key => $value) {
            $clean_attributes[$key] = $mydb->escape_value($value);
        }
        return $clean_attributes;
    }

    /*--Create, Update and Delete methods--*/
    public function save() {
        return isset($this->id) ? $this->update() : $this->create();
    }

    public function create() {
        global $mydb;
        $attributes = $this->sanitized_attributes();
        $sql = "INSERT INTO " . self::$tblname . " (";
        $sql .= join(", ", array_keys($attributes));
        $sql .= ") VALUES ('";
        $sql .= join("', '", array_values($attributes));
        $sql .= "')";
        
        $mydb->setQuery($sql);

        if($mydb->executeQuery()) {
            $this->id = $mydb->insert_id();
            return true;
        } else {
            return false;
        }
    }

    public function update($id = 0) {
        global $mydb;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . self::$tblname . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE STUDSUBJ_ID=" . $id;
        $mydb->setQuery($sql);
        if(!$mydb->executeQuery()) return false; 
    }

    public function updateSubject($sid = 0, $idno = 0) {
        global $mydb;
        $attributes = $this->sanitized_attributes();
        $attribute_pairs = array();
        foreach($attributes as $key => $value) {
            $attribute_pairs[] = "{$key}='{$value}'";
        }
        $sql = "UPDATE " . self::$tblname . " SET ";
        $sql .= join(", ", $attribute_pairs);
        $sql .= " WHERE SUBJ_ID=" . $sid . " AND IDNO=" . $idno;
        $mydb->setQuery($sql);
        if(!$mydb->executeQuery()) return false; 
    }

    public function delete($id = 0) {
        global $mydb;
        $sql = "DELETE FROM " . self::$tblname;
        $sql .= " WHERE STUDSUBJ_ID=" . $id;
        $sql .= " LIMIT 1 ";
        $mydb->setQuery($sql);

        if(!$mydb->executeQuery()) return false; 
    }

    // New Method to Update Student Status Based on Average
    public function updateStudentStatusBasedOnAverage($idno) {
        global $mydb;

        $sql = "SELECT AVERAGE FROM " . self::$tblname . " WHERE IDNO = " . $idno;
        $result = mysqli_query($mydb->conn, $sql);

        $hasFailed = false;

        // Loop through the results to check if the student has failed any subject
        while ($row = mysqli_fetch_assoc($result)) {
            if ($row['AVERAGE'] >= 3) {
                $hasFailed = true;
                break; // Exit loop on the first failure
            }
        }

        // Update the student's status based on failure
        $student = new Student(); // Ensure Student class exists and is correctly implemented
        $student->student_status = $hasFailed ? 'Irregular' : 'Regular';
        return $student->update($idno); // Ensure this updates the correct student's status
    }
}
?>
