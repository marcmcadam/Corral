<?php

//Database Access
$host = 'localhost';
$user = 'root';
$pass = '';
$db = 'mydb';

//Connect to Database
$CON = mysqli_connect($host, $user, $pass, $db);
$sid = $_POST['sid'];

//Get Student Survey
$query = "SELECT * FROM survey WHERE sid='$sid'";
if (!$result = mysqli_query($CON, $query)) {
    exit(mysqli_error($CON));
}
//Load Student Survey Heading
else{
$survey = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $survey[] = $row;
    }
	header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename='.$sid.'.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('Survey ID', 'Student ID', 'Student Location', 'Student Employment Status', 'Student Enrolled in Capstone', 'Student Current Course', 'Student Programmer Level', 'Student UX/UI Designer Level' ,'Student Security Specialist Level', 'Student Database Developer Level', 'Student Web Developer Level', 'Student Cloud Service Developer Level', 'Student App Developer Level', 'Student Network Engineer Level', 'Student VR/Game Developer Level', 'Student 3D Artist/Animator Level', 'Student Technical Artist Level', 'Student Project Manager Level', 'Student Interactive Media Developer Level', 'Student Business Analyst Level', 'Student Technical Skill 1', 'Student Technical Skill 2', 'Student Technical Skill 3', 'Student Technical Skill 4', 'Student Technical Skill 5', 'Student Technical Skill 6', 'Student Technical Skill Proficiency 1', 'Student Technical Skill Proficiency 2', 'Student Technical Skill Proficiency 3', 'Student Technical Skill Proficiency 4', 'Student Technical Skill Proficiency 5', 'Student Technical Skill Proficiency 6', 'Student Soft Skill 1', 'Student Soft Skill 2', 'Student Soft Skill 3', 'Student Soft Skill 4', 'Student Soft Skill 5', 'Student Soft Skill 6', 'Student Soft Skill Proficiency 1', 'Student Soft Skill Proficiency 2', 'Student Soft Skill Proficiency 3', 'Student Soft Skill Proficiency 4', 'Student Soft Skill Proficiency 5', 'Student Soft Skill Proficiency 6', 'Student Project Title 1', 'Student Project Title 2', 'Student Project Title 3', 'Student Aspiration', 'Student Profile', 'Student Entrepreneurship', 'Permission to use Survey Data internally', 'Student Final Words'));

//Load Stident Surevey Flieds 
if (count($survey) > 0) {
    foreach ($survey as $row) {
        fputcsv($output, $row);
    }
}
}
}
?>

