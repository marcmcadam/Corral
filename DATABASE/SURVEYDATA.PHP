<?PHP
// Connect to Database
require('../DATABASE/CONNECTDB.PHP');

// Drop existing table surveyanswer
$SURVEYANSWER = "DROP TABLE SURVEYANSWER";
IF (MYSQLI_QUERY($CON, $SURVEYANSWER)) {
  ECHO "<P>'surveyanswer' table dropped successfully</P>";
} ELSE {
  ECHO "error dropping 'surveyanswer' table: " . MYSQLI_ERROR($CON);
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
  ECHO "<P>'surveyanswer' table created successfully</P>";
} ELSE {
  ECHO "Error creating 'surveyanswer' table: " . MYSQLI_ERROR($CON);
}

// Insert sample data into table
$SURVEYDATA = 'INSERT INTO surveyanswer (student_firstname,stu_hc,stu_js,stu_php,stu_java,stu_c,stu_cpp,stu_oc,stu_db,stu_u3,stu_ui,stu_se,project_num) VALUES
("Timothy",2,1,0,1,1,2,3,0,1,3,4,0),
("Larry",0,3,1,0,0,0,4,0,4,3,0,0),
("Catherine",0,3,0,2,3,1,0,1,1,4,2,0),
("Lisa",3,3,2,2,1,4,4,0,2,1,0,0),
("Pamela",1,3,3,2,0,2,0,0,2,3,0,0),
("Cynthia",3,2,2,4,2,2,0,3,4,1,4,0),
("Jonathan",4,4,3,1,1,4,2,1,4,2,2,0),
("Brandon",4,1,4,0,0,2,4,0,1,3,0,0),
("Nancy",4,3,4,2,3,1,4,2,2,2,1,0),
("Dennis",2,0,0,0,0,1,4,1,0,1,0,0),
("Amy",4,3,0,0,0,1,3,2,1,1,2,0),
("Jack",0,1,4,0,3,3,0,3,1,3,0,0),
("James",0,1,4,0,4,3,0,3,3,2,0,0),
("Richard",4,4,3,2,3,1,2,2,2,4,3,0),
("Paul",0,0,3,0,2,2,1,0,0,2,1,0),
("Donna",4,2,2,2,0,0,3,1,0,1,0,0),
("Kimberly",0,2,1,3,2,3,2,3,3,3,2,0),
("Anna",2,3,2,0,0,3,1,1,1,0,3,0),
("David",2,0,4,1,2,0,0,3,0,2,3,0),
("Stephanie",2,2,3,4,2,2,2,2,0,4,4,0),
("Steven",1,3,4,4,3,3,1,3,4,1,4,0),
("Christine",0,1,3,4,1,0,0,1,2,4,4,0),
("Nicholas",4,0,3,2,0,4,3,0,4,1,0,0),
("Justin",2,1,2,3,1,1,2,2,3,0,3,0),
("Samuel",2,0,1,4,3,2,0,4,2,2,1,0),
("Kathleen",4,2,3,0,3,4,4,4,3,4,3,0),
("Linda",1,0,3,1,0,0,3,1,2,4,3,0),
("Amanda",3,4,0,1,4,2,3,1,3,2,0,0),
("Deborah",4,0,2,1,4,1,3,4,2,1,0,0),
("Gary",2,0,3,3,4,4,3,3,1,1,3,0),
("Carolyn",4,2,0,3,3,3,3,1,0,3,2,0),
("Patricia",1,2,4,4,0,1,1,2,2,1,4,0),
("Daniel",2,2,2,4,4,1,3,1,1,4,2,0),
("Frank",3,0,2,0,3,1,2,3,3,2,0,0),
("Angela",4,0,3,3,2,4,2,4,0,4,0,0),
("Ruth",1,2,0,4,4,1,1,4,4,3,1,0),
("Patrick",3,0,4,1,1,2,0,1,3,1,0,0),
("Jacob",1,4,4,4,3,1,2,4,0,4,3,0),
("Benjamin",0,2,2,1,1,3,4,2,1,1,4,0),
("Brenda",2,1,3,4,2,3,0,2,4,4,1,0),
("Jeffrey",3,4,1,2,1,4,1,4,4,0,0,0),
("Kevin",1,3,0,1,2,3,2,2,3,4,2,0),
("Carol",3,3,0,3,0,3,3,2,3,4,1,0),
("Melissa",1,4,0,0,2,2,1,3,4,1,3,0),
("Nicole",4,1,3,0,2,2,2,0,4,1,1,0),
("Mary",2,1,1,2,3,3,0,4,3,2,4,0),
("Margaret",0,2,4,3,0,2,4,1,3,4,0,0),
("Barbara",4,2,0,0,1,3,3,2,3,3,3,0),
("Karen",3,0,1,0,1,0,2,4,4,1,4,0),
("Jason",1,3,1,1,3,3,0,2,1,1,2,0),
("Rebecca",3,0,3,4,4,0,1,0,0,1,1,0),
("Katherine",0,3,1,0,4,0,4,2,0,1,3,0),
("William",2,2,3,4,3,2,4,2,3,2,0,0),
("Thomas",3,0,1,1,3,4,4,3,1,2,4,0),
("Sarah",2,0,0,4,4,1,4,2,2,4,2,0),
("Emily",1,3,2,3,4,2,1,1,1,0,0,0),
("Mark",3,0,2,3,3,2,0,4,0,1,2,0),
("Sharon",4,2,3,0,2,4,2,2,1,0,3,0),
("Ronald",1,0,0,4,3,1,4,0,3,1,4,0),
("Anthony",1,0,1,4,1,2,3,2,0,0,2,0),
("Alexander",0,1,1,3,4,1,0,0,3,0,4,0),
("Kenneth",3,3,1,2,4,3,0,2,4,3,4,0),
("Christopher",3,1,2,0,3,4,0,3,1,0,4,0),
("John",2,1,0,3,3,2,4,1,0,2,3,0),
("Andrew",2,4,0,3,1,2,1,4,1,4,4,0),
("Michelle",3,4,2,0,2,2,4,4,4,0,3,0),
("Joseph",0,4,2,3,1,3,3,0,2,0,2,0),
("Shirley",0,1,2,1,2,1,2,2,3,4,0,0),
("Edward",0,4,1,1,2,0,4,3,3,0,4,0),
("Betty",3,3,4,4,3,2,1,2,1,3,4,0),
("Scott",4,4,2,1,1,2,2,3,2,2,2,0),
("Ashley",2,2,3,2,1,4,4,4,4,4,3,0),
("Ryan",1,3,4,3,3,1,1,3,1,0,1,0),
("Dorothy",1,4,1,4,1,3,3,3,0,2,4,0),
("Elizabeth",2,2,4,1,0,0,2,0,4,4,2,0),
("Matthew",2,3,0,0,1,0,3,4,2,1,0,0),
("Robert",3,3,4,1,2,2,3,2,0,3,3,0),
("Samantha",3,1,2,0,4,2,2,4,0,1,1,0),
("Helen",0,0,2,2,3,0,2,2,1,4,0,0),
("Jerry",3,3,4,4,0,1,2,1,0,3,4,0),
("Virginia",0,3,4,3,0,3,0,1,4,4,1,0),
("Susan",2,3,2,3,4,2,0,3,1,2,2,0),
("Gregory",2,1,4,2,2,4,4,1,3,0,3,0),
("Michael",4,0,3,2,0,4,3,1,2,0,3,0),
("Sandra",2,4,1,1,0,1,2,2,0,2,1,0),
("Brian",1,3,1,3,4,0,1,1,0,2,1,0),
("Rachel",1,0,4,2,0,0,4,4,0,4,2,0),
("Laura",2,0,1,3,3,0,2,1,2,4,0,0),
("Emma",0,2,2,1,0,0,2,0,3,0,0,0),
("Charles",2,4,1,2,3,3,4,0,2,0,2,0),
("Joshua",4,0,1,0,0,3,4,3,3,4,3,0),
("Donald",0,2,2,3,0,1,4,2,4,4,2,0),
("Jessica",1,2,0,0,4,2,4,0,3,4,1,0),
("Eric",3,3,2,1,0,3,3,1,3,2,0,0),
("Raymond",4,1,2,4,1,1,2,1,4,2,1,0),
("Jennifer",2,2,0,3,2,2,4,2,4,4,1,0),
("Janet",1,3,0,3,3,1,4,2,1,0,4,0),
("George",2,4,3,3,1,3,1,4,4,0,2,0),
("Stephen",0,3,4,4,3,1,1,1,4,4,3,0),
("Debra",4,1,2,1,0,0,0,4,3,1,0,0)
';

IF (MYSQLI_QUERY($CON,$SURVEYDATA)) {
  ECHO "<P>Sample survey data inserted</P>";
} ELSE {
  ECHO "Error inserting sample survey data: " . MYSQLI_ERROR($CON);
}
?>
