<?PHP
// Connect to Database
require "connectdb.php";

//empty existing project table
$project = "TRUNCATE project";
if (mysqli_query($CON, $project)) {
  echo "<p>Project data deleted</p>";
} else {
  echo "Error deleting project data: " . mysqli_error($CON);
}


$numSkills = 20;
$rarity = 200;

require_once "RANDOM.PHP";

// Insert sample data into table
$PROJECT = "INSERT INTO project (pro_title, pro_brief, pro_leader, pro_email, pro_status, pro_min, pro_max, pro_imp";
for ($i = 0; $i < 20; $i += 1)
    $PROJECT .= ", pro_skill_" . sprintf("%02d", $i);
for ($i = 0; $i < 20; $i += 1)
    $PROJECT .= ", pro_bias_" . sprintf("%02d", $i);
$PROJECT .= ") VALUES ";
for ($i = 0; $i < 20; $i += 1)
{
    if ($i > 0)
        $PROJECT .= ', ';
    $min = rand(3, 10); // rand(0, 5);
    $max = $min; // + rand(0, 10);
    $skills = randomProject($i, $imp, $biases);
    $status = randomProjectStatus();
    $PROJECT .= '("Project ' . $i . '"' . ",'Lorem Ipsum','Project Leader','projectleader@deakin.edu.au','".$status."',$min,$max,$imp," . join(", ", $skills) . ", " . join(", ", $biases) . ')';
}

if (mysqli_query($CON,$PROJECT)) {
  echo "<p>Sample projects inserted</p>";
} else {
  echo "Error inserting project data: " . mysqli_error($CON);
}
?>
