<?php

/* 328/students-pdo/index.php
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

//Define query
$sql = "SELECT * FROM student";

//Prepare
$statement = $dbh->prepare($sql);

//Execute
$statement->execute();

//Process
echo "<h1>Student List</h1>";
echo "<ol>";
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $row) {
    echo "<li>".$row['first'].", ".$row['last']."</li>";
}
echo "</ol>";

//Add student
?>

<h1>Add New Student</h1>
<form action="submit.php" method="POST">
    <div>
        <label for="student-sid">SID</label>
        <input type="number" class="form-control" name="student-sid" id="student-sid">
    </div>
    <div>
        <label for="student-last">Last</label>
        <input type="text" class="form-control" name="student-last" id="student-last">
    </div>
    <div>
        <label for="student-first">First</label>
        <input type="text" class="form-control" name="student-first" id="student-first">
    </div>
    <div>
        <label for="student-birth">Birthdate</label>
        <input type="date" class="form-control" name="student-birth" id="student-birth"
            placeholder="2024-05-23">
    </div>
    <div>
        <label for="student-gpa">GPA</label>
        <input type="text" class="form-control" name="student-gpa" id="student-gpa">
    </div>
    <div>
        <label for="student-advisor">Advisor</label>
        <input type="number" class="form-control" name="student-advisor" id="student-advisor">
    </div>
    <button type="submit">Submit</button>
</form>


