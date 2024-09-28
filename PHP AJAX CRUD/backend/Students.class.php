<?php
require_once("Connection.class.php");

class Student extends Connection
{
    public function addNewStudent($fname, $lname, $city, $email, $gender)
    {
        $sqlQuery = "select * from students where email = '$email'";
        $result = $this->connection->query($sqlQuery);
        if ($result->num_rows > 0) {
            return false;
        } else {
            $sqlQuery = "insert into students (fname, lname, city, email, gender) values ('$fname', '$lname', '$city', '$email', '$gender')";
            $this->connection->query($sqlQuery);
            return $this->connection->insert_id;
        }
    }

    public function getAllStudents()
    {
        $sqlQuery = "select * from students";
        return $this->connection->query($sqlQuery);
    }

    public function getStudent($id)
    {
        $sqlQuery = "select * from students where id = $id";
        return $this->connection->query($sqlQuery);
    }

    public function deleteStudent($id)
    {
        $sqlQuery = "delete from students where id = $id";
        $this->connection->query($sqlQuery);

        return $this->connection->affected_rows;
    }

    public function updateStudent($id, $fname, $lname, $city, $email, $gender)
    {
        /*$sqlQuery = "select * from students where email = '$email'";
        $result = $this->connection->query($sqlQuery);
        if ($result->num_rows > 0) {
            return false;
        } else {
            $sqlQuery = "update students set fname = '$fname', lname = '$lname', city = '$city', email = '$email', gender = '$gender' where id = $id";
            $this->connection->query($sqlQuery);
            return true;
        }*/

        $sqlQuery = "update students set fname = '$fname', lname = '$lname', city = '$city', email = '$email', gender = '$gender' where id = $id";
        $this->connection->query($sqlQuery);
        return true;
    }
}

$student = new Student();
