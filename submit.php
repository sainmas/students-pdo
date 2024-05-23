<?php
/* 328/students-pdo/submit.php
 *
 */

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

try {
    //Define PDO database object

    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
    //echo "<h1>i am connected</h1>";
} catch (PDOException $e){
    die( "it broke" );
}

//var_dump($_POST);

//Define
$sql = "INSERT INTO student (sid, last, first, birthdate, gpa, advisor)
        VALUES (:sid, :last, :first, :birthdate, :gpa, :advisor)";

//Prepare
$statement = $dbh->prepare($sql);

//Binding parameters...
$sid = $_POST['student-sid'];
$last = $_POST['student-last'];
$first = $_POST['student-first'];
$birth = $_POST['student-birth'];
$gpa = $_POST['student-gpa'];
$advisor = $_POST['student-advisor'];


$statement->bindParam("sid", $sid, PDO::PARAM_INT);
$statement->bindParam("last", $last);
$statement->bindParam("first", $first);
$statement->bindParam("birthdate", $birth);
$statement->bindParam("gpa", $gpa);
$statement->bindParam("advisor", $advisor, PDO::PARAM_INT);

//Execute
$statement->execute();

//Process (with a query!)
//Statement
$sql = "SELECT * FROM student WHERE sid = :sid";

//Prepare
$statement = $dbh->prepare($sql);

//Bind
$statement->bindParam("sid", $sid);

//Execute
$statement->execute();

//Process
$row = $statement->fetch(PDO::FETCH_ASSOC);
//var_dump($row);
echo "<p>Student: First: ".$row['first'].", Last: ".$row['last'].", ID: ".$row['sid']." was inserted properly!</p>";