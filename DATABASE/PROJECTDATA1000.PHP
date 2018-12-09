<?PHP
// Connect to Database
require "../DATABASE/CONNECTDB.PHP";

//empty existing project table
$project = "TRUNCATE project";
if (mysqli_query($CON, $project)) {
  echo "<p>Project data deleted</p>";
} else {
  echo "Error deleting project data: " . mysqli_error($CON);
}


$numSkills = 11;
$rarity = 200;

require_once "RANDOM.PHP";

// Insert sample data into table
$PROJECT = "INSERT INTO project (pro_title, pro_min, pro_max, pro_imp, pro_skill_01, pro_skill_02, pro_skill_03, pro_skill_04, pro_skill_05, pro_skill_06, pro_skill_07, pro_skill_08, pro_skill_09, pro_skill_10, pro_skill_11) VALUES ";
for ($i = 0; $i < 200; $i += 1)
{
    if ($i > 0)
        $PROJECT .= ', ';
    $min = rand(3, 10); //rand(0, 5);
    $max = $min; // + rand(0, 10);
    $skills = randomProject($i, $imp);
    $PROJECT .= '("Project ' . $i . '"' . ", $min, $max, $imp, " . join(", ", $skills) . ')';
}

if (mysqli_query($CON,$PROJECT)) {
  echo "<p>Sample projects inserted</p>";
} else {
  echo "Error inserting project data: " . mysqli_error($CON);
}
?>
