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

// Insert sample data into table
$PROJECT = 'INSERT INTO project (pro_title, pro_hc, pro_js, pro_php, pro_java, pro_c, pro_cpp, pro_oc, pro_db, pro_u3, pro_ui, pro_se) VALUES 
("Awesome Source",          4, 3, 1, 0, 1, 0, 0, 0, 0, 0, 0),
("Gamers Anonymous",        2, 4, 2, 2, 0, 1, 0, 0, 1, 0, 0),
("HD Certainty Calculator", 0, 1, 0, 2, 0, 0, 1, 0, 0, 3, 0),
("The X Files",             0, 0, 1, 0, 3, 0, 1, 1, 0, 2, 1),
("Algorythms",              1, 0, 0, 2, 0, 1, 0, 0, 3, 0, 4),
("Team Encoding",           0, 2, 0, 3, 0, 1, 4, 1, 0, 0, 0),
("Project 7",           0, 0, 1, 0, 4, 2, 1, 4, 2, 4, 0),
("Project 8",           0, 2, 0, 3, 0, 0, 2, 2, 2, 1, 2),
("Project 9",           1, 0, 0, 0, 0, 1, 0, 0, 0, 0, 1),
("Project 10",           0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
("Project 11",           0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
("Project 12",           4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
("Project 13",           0, 0, 0, 0, 0, 0, 0, 0, 4, 0, 0),
("Project 14",           1, 2, 3, 4, 3, 2, 1, 0, 0, 0, 0),
("Project 15",           0, 0, 0, 0, 1, 2, 3, 4, 3, 2, 1)
';

IF (MYSQLI_QUERY($CON,$PROJECT)) {
  ECHO "<P>Sample projects Inserted</P>";
} ELSE {
  ECHO "Error inserting project: " . MYSQLI_ERROR($CON);
}
?>