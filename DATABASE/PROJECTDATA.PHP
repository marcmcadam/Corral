<?PHP
// Connect to Database
require "../DATABASE/CONNECTDB.PHP";

//empty existing project table
$project = "TRUNCATE project";
if (mysqli_query($CON, $project)) {
  echo "<p>Project data deleted</p>";
} else {
  echo "Error deleting project data: " . mysql_error($CON);
}


$numSkills = 11;
$rarity = 3.0;

function randomSkill()
{
    global $rarity;
    return 4 - (int)floor(log(rand(0, (int)floor(pow($rarity, 5.0)) - 1)) / log($rarity));
}

function randomSkills()
{
    global $numSkills;
    $text = "";
    for ($i = 0; $i < $numSkills; $i += 1)
        $text .= "," . randomSkill();
    return $text;
}

// Insert sample data into table
$PROJECT = 'INSERT INTO project (pro_title, pro_hc, pro_js, pro_php, pro_java, pro_c, pro_cpp, pro_oc, pro_db, pro_u3, pro_ui, pro_se) VALUES
("Project 1"' . randomSkills() . '),
("Project 2"' . randomSkills() . '),
("Project 3"' . randomSkills() . '),
("Project 4"' . randomSkills() . '),
("Project 5"' . randomSkills() . '),
("Project 6"' . randomSkills() . '),
("Project 7"' . randomSkills() . '),
("Project 8"' . randomSkills() . '),
("Project 9"' . randomSkills() . '),
("Project 10"' . randomSkills() . '),
("Project 11"' . randomSkills() . '),
("Project 12"' . randomSkills() . '),
("Project 13"' . randomSkills() . '),
("Project 14"' . randomSkills() . '),
("Project 15"' . randomSkills() . ')
';

if (mysqli_query($CON,$PROJECT)) {
  echo "<p>Sample projects inserted</p>";
} else {
  echo "Error inserting project data: " . mysql_error($CON);
}
?>
