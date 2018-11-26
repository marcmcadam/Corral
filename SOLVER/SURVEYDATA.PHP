<?PHP
// Connect to Database
require('../DATABASE/CONNECTDB.PHP');

//SURVEYANSWER TABLE
$SURVEYANSWER = "DROP TABLE SURVEYANSWER";

// Drop existing table surveyanswer
IF (MYSQLI_QUERY($CON, $SURVEYANSWER)) {
  ECHO "<P>surveyanswer table dropped successfully</P>";
} ELSE {
  ECHO "error dropping surveyanswer table: " . MYSQLI_ERROR($CON);
}

// Create new table surveyanswer
$SURVEYANSWER = "CREATE TABLE surveyanswer (
survey_id int(11) NOT NULL AUTO_INCREMENT,
student_firstname varchar(35) NOT NULL,
stu_hc int(11) NOT NULL,
stu_js int(11) NOT NULL,
stu_php int(11) NOT NULL,
stu_java int(11) NOT NULL,
stu_c int(11) NOT NULL,
stu_cpp int(11) NOT NULL,
stu_oc int(11) NOT NULL,
stu_db int(11) NOT NULL,
stu_u3 int(11) NOT NULL,
stu_ui int(11) NOT NULL,
stu_se int(11) NOT NULL,
project_num int(11),
PRIMARY KEY (`survey_id`))";

IF (MYSQLI_QUERY($CON,$SURVEYANSWER)) {
  ECHO "<P>surveyanswer table created successfully</P>";
} ELSE {
  ECHO "Error creating surveyanswer table: " . MYSQLI_ERROR($CON);
}

$numSkills = 11;
$rarity = 4;

function randomSkill()
{
    global $rarity;
    return max(rand(0, 4 + $rarity) - $rarity, 0);
}

function randomSkills()
{
    global $numSkills;
    $text = "";
    for ($i = 0; $i < $numSkills; $i += 1)
        $text .= "," . randomSkill();
        
    $text .= ',null'; // project number
    return $text;
}

// Insert sample data into table
$SURVEYDATA = 'INSERT INTO surveyanswer (student_firstname,stu_hc,stu_js,stu_php,stu_java,stu_c,stu_cpp,stu_oc,stu_db,stu_u3,stu_ui,stu_se,project_num) VALUES 
("Timothy"' . randomSkills() . '),
("Larry"' . randomSkills() . '),
("Catherine"' . randomSkills() . '),
("Lisa"' . randomSkills() . '),
("Pamela"' . randomSkills() . '),
("Cynthia"' . randomSkills() . '),
("Jonathan"' . randomSkills() . '),
("Brandon"' . randomSkills() . '),
("Nancy"' . randomSkills() . '),
("Dennis"' . randomSkills() . '),
("Amy"' . randomSkills() . '),
("Jack"' . randomSkills() . '),
("James"' . randomSkills() . '),
("Richard"' . randomSkills() . '),
("Paul"' . randomSkills() . '),
("Donna"' . randomSkills() . '),
("Kimberly"' . randomSkills() . '),
("Anna"' . randomSkills() . '),
("David"' . randomSkills() . '),
("Stephanie"' . randomSkills() . '),
("Steven"' . randomSkills() . '),
("Christine"' . randomSkills() . '),
("Nicholas"' . randomSkills() . '),
("Justin"' . randomSkills() . '),
("Samuel"' . randomSkills() . '),
("Kathleen"' . randomSkills() . '),
("Linda"' . randomSkills() . '),
("Amanda"' . randomSkills() . '),
("Deborah"' . randomSkills() . '),
("Gary"' . randomSkills() . '),
("Carolyn"' . randomSkills() . '),
("Patricia"' . randomSkills() . '),
("Daniel"' . randomSkills() . '),
("Frank"' . randomSkills() . '),
("Angela"' . randomSkills() . '),
("Ruth"' . randomSkills() . '),
("Patrick"' . randomSkills() . '),
("Jacob"' . randomSkills() . '),
("Benjamin"' . randomSkills() . '),
("Brenda"' . randomSkills() . '),
("Jeffrey"' . randomSkills() . '),
("Kevin"' . randomSkills() . '),
("Carol"' . randomSkills() . '),
("Melissa"' . randomSkills() . '),
("Nicole"' . randomSkills() . '),
("Mary"' . randomSkills() . '),
("Margaret"' . randomSkills() . '),
("Barbara"' . randomSkills() . '),
("Karen"' . randomSkills() . '),
("Jason"' . randomSkills() . '),
("Rebecca"' . randomSkills() . '),
("Katherine"' . randomSkills() . '),
("William"' . randomSkills() . '),
("Thomas"' . randomSkills() . '),
("Sarah"' . randomSkills() . '),
("Emily"' . randomSkills() . '),
("Mark"' . randomSkills() . '),
("Sharon"' . randomSkills() . '),
("Ronald"' . randomSkills() . '),
("Anthony"' . randomSkills() . '),
("Alexander"' . randomSkills() . '),
("Kenneth"' . randomSkills() . '),
("Christopher"' . randomSkills() . '),
("John"' . randomSkills() . '),
("Andrew"' . randomSkills() . '),
("Michelle"' . randomSkills() . '),
("Joseph"' . randomSkills() . '),
("Shirley"' . randomSkills() . '),
("Edward"' . randomSkills() . '),
("Betty"' . randomSkills() . '),
("Scott"' . randomSkills() . '),
("Ashley"' . randomSkills() . '),
("Ryan"' . randomSkills() . '),
("Dorothy"' . randomSkills() . '),
("Elizabeth"' . randomSkills() . '),
("Matthew"' . randomSkills() . '),
("Robert"' . randomSkills() . '),
("Samantha"' . randomSkills() . '),
("Helen"' . randomSkills() . '),
("Jerry"' . randomSkills() . '),
("Virginia"' . randomSkills() . '),
("Susan"' . randomSkills() . '),
("Gregory"' . randomSkills() . '),
("Michael"' . randomSkills() . '),
("Sandra"' . randomSkills() . '),
("Brian"' . randomSkills() . '),
("Rachel"' . randomSkills() . '),
("Laura"' . randomSkills() . '),
("Emma"' . randomSkills() . '),
("Charles"' . randomSkills() . '),
("Joshua"' . randomSkills() . '),
("Donald"' . randomSkills() . '),
("Jessica"' . randomSkills() . '),
("Eric"' . randomSkills() . '),
("Raymond"' . randomSkills() . '),
("Jennifer"' . randomSkills() . '),
("Janet"' . randomSkills() . '),
("George"' . randomSkills() . '),
("Stephen"' . randomSkills() . '),
("Debra"' . randomSkills() . ')
';

IF (MYSQLI_QUERY($CON,$SURVEYDATA)) {
  ECHO "<P>Sample Survey Data Inserted</P>";
} ELSE {
  ECHO "Error inserting Survey Data: " . MYSQLI_ERROR($CON);
}
?>