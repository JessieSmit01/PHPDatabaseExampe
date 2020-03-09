<?php
/**************************************
 * File Name: student-api.php
 * User: cst231
 * Date: 2019-10-23
 * Project: CWEB280
 *this file will handle the post, get, delete and put requests from the student-ui
 * and return the appropriate json
 *
 **************************************/
//add require for all objects used in this file;
require_once "Student.php";
require_once "Repository.php";

//if the formdata javascript object is not used (in the ui) when posting php will not fill the $POST
//we have to get to json data from 'php://input'
//$_REQUEST contains all params from $_GET and $_POST - we can check if any params exist in $_REQUEST if not use php://input
$requestData = empty($_REQUEST) ? json_decode(file_get_contents('php://input'), true) : $_REQUEST;


//MINICISE 22: use the new db object we created to get all the students from the database
//output a JSON array of objects
$repo = new Repository('../../../db/students-alt.db');
switch($_SERVER['REQUEST_METHOD']){
    case "GET":
        $resultToJSONEncode = handleGET($repo);
        break;
    case "POST":
        //deserialize JSON into studnet object
        // call handle post function
        $student = (new Student())->parseArray($requestData);

        $resultToJSONEncode = handlePOST($student, $repo);
       break;

    case "PUT":
        //get student object from  db
        $student = (new Student())->parseArray($requestData);
        $resultToJSONEncode = handlePUT($student, $repo);
        break;
    case "DELETE":
        $student = new Student();
        //delette from axios sends URL params Example localhost:8000/student-api.php?id=949 - we need to look in $_GET
        $student->studentID=$requestData['id']; //just need the id/primary key to delete a student
        $resultToJSONEncode = handleDelete($student, $repo);
        break;
    default:
        $resultToJSONEncode = 'METHOD NOT SUPPORTED';
        header('http/1.1 405 Method Not Allowed');
}


//GET- ALL Students from DB
function handleGET($repo)
{
    return $repo->select(new Student()); //empty student will return all students in the database
}

//POST- New Student
function handlePOST($student, $repo){
    //at this point we need an ID and a username to save into the database
    $student->studentID = rand(1001, 9999);  //use random number of id for now - later use autoincrementing db field
    $student->userName = strtolower($student->familyName) . rand(1000, 9999);
    return $repo->insert($student) ? 'Added Student to DB' : 'Error: Could not add student';
}

//PUT - Edit student
function handlePUT($student, $repo)
{
    //code update function in repo
    //return update result
   return $repo->update($student) ? 'Updated Student to DB' : 'Error: Could not update student';
}

//PUT - Edit student
function handleDELETE($student, $repo)
{
    //code delete function in repo
    //return delete result
    return $repo->delete($student) ? 'Deleted Student to DB' : 'Error: Could not delete student';
}

//outputJSON
header('Content-type:application/json');
echo json_encode($resultToJSONEncode);























