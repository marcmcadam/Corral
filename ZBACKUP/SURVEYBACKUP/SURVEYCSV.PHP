<?php

require('../DATABASE/CONNECTDB.PHP');

//Get All Survey
$query = "SELECT * FROM SURVEYANSWER";
if (!$result = mysqli_query($CON, $query)) {
    exit(mysqli_error($CON));
}
else{

//Load Student Survey Heading
$survey = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $survey[] = $row;
    }
	header('Content-Type: text/csv; charset=utf-8');
header('Content-Disposition: attachment; filename=All_SURVEY.csv');
$output = fopen('php://output', 'w');
fputcsv($output, array('SURVEY_ID', 'STUDENT_ID', 'LOCATION', 'CURRENT_COURSE', 'ROLE1', 'ROLE2', 'ROLE3', 'TECHNICAL_SKILLS1',
'TECHNICAL_SKILLS2', 'TECHNICAL_SKILLS3', 'TECHNICAL_RATING1', 'TECHNICAL_RATING2', 'TECHNICAL_RATING3',
'SOFT_SKILLS1', 'SOFT_SKILLS2', 'SOFT_SKILLS3', 'SOFT_RATING1', 'SOFT_RATING2', 'SOFT_RATING3', 'PROJECT_PREFERENCE1',
'PROJECT_PREFERENCE2', 'PROJECT_PREFERENCE3', 'STUDENT_PERMISSION', 'STUDENT_ASPIRATION', 'STUDENT_COMMENT'));

//Load Student Surevey Flieds
if (count($survey) > 0) {
    foreach ($survey as $row) {
        fputcsv($output, $row);
    }
}
}
}
?>
