<?PHP
// Connect to Database
require('../DATABASE/CONNECTDB.PHP');

//PROJECT TABLE
$PROJECT = "DROP TABLE PROJECT";

// Drop existing table project
IF (MYSQLI_QUERY($CON, $PROJECT)) {
  ECHO "<P>project table dropped successfully</P>";
} ELSE {
  ECHO "error dropping project table: " . MYSQLI_ERROR($CON);
}

// PROJECTS TABLE
$PROJECT = "CREATE TABLE project (
pro_num int(11) NOT NULL AUTO_INCREMENT,
pro_title varchar(25) NOT NULL,
pro_brief varchar(256) NOT NULL,
pro_leader varchar(25) NOT NULL,
pro_email varchar(25) NOT NULL,
pro_status varchar(20) NOT NULL,
pro_hc int(11) NOT NULL,
pro_js int(11) NOT NULL,
pro_php int(11) NOT NULL,
pro_java int(11) NOT NULL,
pro_c int(11) NOT NULL,
pro_cpp int(11) NOT NULL,
pro_oc int(11) NOT NULL,
pro_db int(11) NOT NULL,
pro_u3 int(11) NOT NULL,
pro_ui int(11) NOT NULL,
pro_se int(11) NOT NULL,
PRIMARY KEY (pro_num))";

//EXECUTE QUERY
IF (MYSQLI_QUERY($CON,$PROJECT)) {
  ECHO "<P>PROJECT TABLES CREATED SUCCESSFULLY</P>";
} ELSE {
  ECHO "ERROR CREATING PROJECT TABLE: " . MYSQLI_ERROR($CON);
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

IF (MYSQLI_QUERY($CON,$PROJECT)) {
  ECHO "<P>Sample projects Inserted</P>";
} ELSE {
  ECHO "Error inserting project: " . MYSQLI_ERROR($CON);
}
?>
