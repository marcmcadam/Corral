<?php
require_once "remake.php";

require_once "../connectdb.php";
require "random.php";
require_once "../functions.php";

require_once "names.php";

$unitID = "SIT302T119";

// NB: Now that foreign keys are in place, the order in which table data is
// deleted (and created) is relevant.

/* -- relying on remake to reset the data before sampledata
//empty existing surveydata table
$surveyanswer = "DELETE from surveyanswer";
if (mysqli_query($CON, $surveyanswer)) {
  echo "<p>surveyanswer data deleted</p>";
} else {
  echo "<p>Error deleting surveyanswer data: " . mysqli_error($CON) . "</p>";
}

//empty existing project table
$project = "DELETE from project";
if (mysqli_query($CON, $project)) {
  echo "<p>Project data deleted</p>";
} else {
  echo "<p>Error deleting project data: " . mysqli_error($CON) . "</p>";
}

//empty existing unit table
$unit = "DELETE from unit";
if (mysqli_query($CON, $unit)) {
  echo "<p>Unit data deleted</p>";
} else {
  echo "<p>Error deleting unit data: " . mysqli_error($CON) . "</p>";
}

//empty existing staff table
$staff = "DELETE from staff";
if (mysqli_query($CON, $staff)) {
  echo "<P>Staff data deleted</P>";
} else {
  echo "<p>Error deleting staff data: " . mysqli_error($CON) . "</p>";
}

//empty existing student table
$student = "DELETE from student";
if (mysqli_query($CON, $student)) {
  echo "<P>Student data deleted</P>";
} else {
  echo "<p>Error deleting student data: " . mysqli_error($CON) . "</p>";
}
*/

if (isset($_GET["sr"])) // students who are random
    $studentsRandom = min(max((int)$_GET["sr"], 0), 10000); // number of students who fill in their surveys randomly
else if (isset($_GET["sv"]))
    $studentsRandom = 0;
else
    $studentsRandom = 1000;

if (isset($_GET["sv"])) // students for validation
    $studentsValidation = min(max((int)$_GET["sv"], 0), 10000); // number of students with ideal survey responses for a project
else
    $studentsValidation = 0;

$totalStudents = $studentsRandom + $studentsValidation; // the number of students

if (isset($_GET["pr"])) // projects that are random
    $projectsRandom = min(max((int)$_GET["pr"], 0), 10000); // number of random projects
else
    $projectsRandom = (int)($totalStudents / 5);

$totalProjects = $projectsRandom;


//insert student data
$studentIDs = [];
$insert = "INSERT INTO student (stu_ID, stu_FirstName, stu_LastName, stu_Campus, stu_Email, stu_Password) VALUES ";
for ($i = 0; $i < $totalStudents; $i += 1)
{
    $id = 216000000 + ((49999 * $i) % 1000000);

    $first = trim((($i % 2) == 0) ? $male[random_int(0, sizeof($male) - 1)] : $female[random_int(0, sizeof($female) - 1)]);
    $first = ucfirst(strtolower($first));

    $last = trim($surnames[random_int(0, sizeof($surnames) - 1)]);
    $last = ucfirst(strtolower($last));

    $user = strtolower($first[0] . substr($last, 0, 6) . $i);
    $email = "$user@deakin.edu.au";
    $campus = random_int(1, 3);

    if ($i > 0)
        $insert .= ", ";
    $insert .= "($id, '$first', '$last', $campus, '$email', 'RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09')"; //changed password to match aes256cbc

    array_push($studentIDs, $id);
}
if (mysqli_query($CON, $insert)) {
  echo "<p>Sample student data inserted</p>";
} else {
  echo "<p>Error inserting sample student data: " . mysqli_error($CON) . "</p>";
}

//insert sample staff data----changed password to match aes256cbc
$insert = 'INSERT INTO staff (sta_ID, sta_FirstName, sta_LastName, sta_Campus, sta_Email, sta_Password) VALUES
(1,"Staff","User",1,"staffuser@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(2,"Blair","Bowes",1,"bbowes@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(3,"Onur","Ritter",2,"oritter@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(4,"Elsie-Rose","Garcia",1,"ergarcia@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(5,"Etta","Gough",1,"egough@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(6,"Kayleigh","Bradford",2,"kbradford@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(7,"Emma","Bassett",1,"ebassett@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(8,"Layla","Battle",2,"lbattle@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(9,"Fletcher","Lynch",2,"flynch@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09"),
(10,"Kaiden","Figueroa",3,"kfigueroa@deakin.edu.au","RW44Vm0xcEVXVXRkUDVWZkxucWhJdz09")';
if (mysqli_query($CON, $insert)) {
  echo "<P>Sample staff data inserted</P>";
} else {
  echo "<p>Error inserting sample staff data: " . mysqli_error($CON) . "</p>";
}

function unitskills() {
  $skills = "";
  for ($i = 0; $i < 20; $i++)
    $skills .= ", skill_" . sprintf("%02d", $i);
  return $skills;
}
function unitnames($skillNames) {
  $names = "";
  for ($i = 0; $i < 20; $i++)
    $names .= ", '$skillNames[$i]'";
  return $names;
}

//insert sample unit data
$skillNames = ["HTML/CSS", "JavaScript", "PHP", "Java", "C#", "C++", "Python", "Database", "Networking", "Unity", "Cyber Security", "Cloud", "Artificial Intelligence", "User Interface", "Mathematics", "Media", "Project Management", "Written Communication", "Verbal Communication", "Presentation"];
$units = "INSERT INTO unit (unit_ID, unit_Name, sta_ID, survey_open".unitskills().") VALUES ";

$units .= "('SIT302T218', 'Project Delivery',           '3', '0'".unitnames($skillNames)."),";
$units .= "('SIT702T218', 'Project Delivery Postgrad',  '2', '0'".unitnames($skillNames)."),";
$units .= "('SIT374T218', 'Project Design',             '3', '0'".unitnames($skillNames)."),";
$units .= "('SIT774T218', 'Project Design Postgrad',    '2', '0'".unitnames($skillNames)."),";

$units .= "('SIT302T318', 'Project Delivery',           '1', '0'".unitnames($skillNames)."),";
$units .= "('SIT702T318', 'Project Delivery Postgrad',  '2', '0'".unitnames($skillNames)."),";
$units .= "('SIT374T318', 'Project Design',             '1', '0'".unitnames($skillNames)."),";
$units .= "('SIT774T318', 'Project Design Postgrad',    '2', '0'".unitnames($skillNames)."),";

$units .= "('SIT302T119', 'Project Delivery',           '1', '1'".unitnames($skillNames)."),";
$units .= "('SIT702T119', 'Project Delivery Postgrad',  '2', '1'".unitnames($skillNames)."),";
$units .= "('SIT374T119', 'Project Design',             '1', '1'".unitnames($skillNames)."),";
$units .= "('SIT774T119', 'Project Design Postgrad',    '2', '1'".unitnames($skillNames).")";

if (mysqli_query($CON, $units)) {
  echo "<P>Sample unit data inserted</P>";
} else {
  echo "<p>Error inserting sample unit data: " . mysqli_error($CON) . "</p>";
}

//insert project data and sample surveyanswer data

$projectNamesA = ["Vehicle", "Game", "Formation", "Health", "Financial", "Future", "AI"];
$projectNamesB = ["Design", "Control", "Automation", "Analysis"];
$projectNamesC = ["Project", "Tool", "Web Site", "System"];

$numSkills = 20;

$PROJECT = "INSERT INTO project (unit_ID, pro_title, pro_brief, pro_leader, pro_email, pro_min, pro_max, pro_imp";
for ($i = 0; $i < $numSkills; $i += 1)
    $PROJECT .= ", pro_skill_" . sprintf("%02d", $i);
for ($i = 0; $i < $numSkills; $i += 1)
    $PROJECT .= ", pro_bias_" . sprintf("%02d", $i);
$PROJECT .= ") VALUES ";

$surveydata = "INSERT INTO surveyanswer (unit_ID, submitted, stu_ID";
for ($i = 0; $i < $numSkills; $i += 1)
    $surveydata .= ", stu_skill_" . sprintf("%02d", $i);
$surveydata .= ") VALUES ";

$shuffledStudentIDs = $studentIDs;
shuffle($shuffledStudentIDs);

$projectSizes = [];
$projectSkills = [];
for ($i = 0; $i < $totalProjects; $i += 1)
{
    if ($i > 0)
        $PROJECT .= ', ';
    $a = $projectNamesA[random_int(0, sizeof($projectNamesA) - 1)];
    $b = $projectNamesB[random_int(0, sizeof($projectNamesB) - 1)];
    $c = $projectNamesC[random_int(0, sizeof($projectNamesC) - 1)];
    $min = random_int(2, 8);
    array_push($projectSizes, $min);
    $max = 0;
    $rarity = 8; // 200;
    randomProject($skills, $imp, $biases);
    array_push($projectSkills, $skills);
    $status = randomProjectStatus();
    $PROJECT .= "('$unitID', '$a $b $c', 'Lorem Ipsum','Project Leader','projectleader@deakin.edu.au', $min, $max, $imp, " . join(", ", $skills) . ", " . join(", ", $biases) . ')';
}

// proportionally distribute students
$projectStudents = distribute($projectSizes, $studentsValidation);

$i = 0;
foreach ($projectStudents as $p => $size)
{
    // convert project skills (0...4) to survey skills (0...4)
    $skills = [];
    foreach ($projectSkills[$p] as $s => $z)
        $skills[$s] = $z; // with projects limited to 0...4 this 1:1, otherwise it needs scaling // min(max((int)floor($z * 4.9 / 100), 0), 4);

    for ($j = 0; $j < $size; $j += 1)
    {
        if ($i > 0)
            $surveydata .= ",";
        $studentID = $shuffledStudentIDs[$i];
        $surveydata .= "('$unitID', " . (($studentID == 216000000) ? 0 : 1) . ", $studentID, " . join(", ", $skills) . ")";
        $i += 1;
    }
}
if ($i != $studentsValidation)
    die("Incorrect number of validation responses created.");

for ($j = 0; $j < $studentsRandom; $j += 1)
{
    if ($i > 0)
        $surveydata .= ",";
    $rarity = 2.0;
    $skills = randomSkills();
    $studentID = $shuffledStudentIDs[$i];
    $surveydata .= "('$unitID', " . (($studentID == 216000000) ? 0 : 1) . ", $studentID, " . join(", ", $skills) . ")";
    $i += 1;
}

if ($i != $totalStudents)
    echo("Not all students had a survey created.");

// Insert sample data into table
if (mysqli_query($CON,$PROJECT)) {
  echo "<p>Sample projects inserted</p>";
} else {
  echo "Error inserting project data: " . mysqli_error($CON);
}

if (mysqli_query($CON,$surveydata)) {
  echo "<P>Sample surveyanswer data inserted</P>";
} else {
  echo "Error inserting sample surveyanswer data: " . mysqli_error($CON);
}

?>
