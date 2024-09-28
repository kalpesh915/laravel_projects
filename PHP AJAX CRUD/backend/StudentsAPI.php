<?php
require_once("Students.class.php");

if (isset($_POST["add_student"])) {
    $fname = $student->filterData($_POST["fname"]);
    $lname = $student->filterData($_POST["lname"]);
    $city = $student->filterData($_POST["city"]);
    $email = $student->filterData($_POST["email"]);
    $gender = $student->filterData($_POST["gender"]);

    if (empty($fname) || empty($lname) || empty($city) || empty($email) || empty($gender)) {
        $response = [
            "code" => 422,
            "message" => "All Fields are must required"
        ];
    } else {
        $id = $student->addNewStudent($fname, $lname, $city, $email, $gender);

        if ($id == false) {
            $response = [
                "code" => 434,
                "message" => "$email is already registered with us"
            ];
        } else if (($id != null) && $id > 1) {
            $response = [
                "code" => 200,
                "message" => "New Student Created with $id Id "
            ];
        } else {
            $response = [
                "code" => 500,
                "message" => "Server Error while createing new record on server"
            ];
        }
    }

    echo json_encode($response);
    return;
} else if (isset($_POST["update_student"])) {
    $id = $student->filterData($_POST["id"]);
    $fname = $student->filterData($_POST["fname"]);
    $lname = $student->filterData($_POST["lname"]);
    $city = $student->filterData($_POST["city"]);
    $email = $student->filterData($_POST["email"]);
    $gender = $student->filterData($_POST["gender"]);

    if (empty($id) || empty($fname) || empty($lname) || empty($city) || empty($email) || empty($gender)) {
        $response = [
            "code" => 422,
            "message" => "All Fields are must required"
        ];
    } else if ($student->updateStudent($id, $fname, $lname, $city, $email, $gender)) {
        $response = [
            "code" => 200,
            "message" => "Student Updated with $id Id "
        ];
    } else {
        $response = [
            "code" => 434,
            "message" => "$email is already registered with us"
        ];
    }

    echo json_encode($response);
    return;
}else if(isset($_POST["delete_student"])){
    $id = $student->filterData($_POST["id"]);
    $count = $student->deleteStudent($id);
    if($count >= 1){
        $response = [
            "code" => 200,
            "message" => "Student Data Deleted with id $id"
        ];
    }else{
        $response = [
            "code" => 404,
            "message" => "No Student Data Deleted with id $id"
        ];
    }
    echo json_encode($response);
    return;
}else if(isset($_GET["id"])){
    $id = $student->filterData($_GET["id"]);
    $result = $student->getStudent($id);   
    if(!empty($result)){
        $response = [
            "code" => 200,
            "message" => "Student data found with id $id",
            "studentdata" => $result->fetch_assoc()
        ];
    }else{
        $response = [
            "code" => 404,
            "message" => "No student data found with id $id"
        ];
    }

    echo json_encode($response);
    return;
}
