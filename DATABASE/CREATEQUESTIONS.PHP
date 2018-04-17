<?PHP
REQUIRE('CONNECTDB.PHP');
?>

<?PHP
//QUESTIONS DETAILS
$QUESTION = "INSERT INTO QUESTION (QUESTION_ID, QUESTION)
VALUES      (1, 'WHICH CAMPUS ARE YOU LOCATED AT?'),
            (2, 'DO YOU WORK FULL TIME, PART TIME OR NO WORK?'),
            (3, 'WILL YOU BE STUDYING SIT302 NEXT TRIMESTER?'),
            (4, 'WHAT COURSE ARE YOU CURRENTLY STUDYING?'),
            (5, 'SELECT THE MOST RELEVANT SKILLS TO YOU'),
            (6, 'ANOTHER QUESTION'),
            (7, ''),
            (8, ''),
            (9, ''),
            (10, ''),
            (11, ''),
            (12, ''),
            (13, ''),
            (14, '')";

            //EXECUTE QUERY
            IF (MYSQLI_QUERY($CON,$QUESTION)) {
              ECHO "<P>QUESTION ENTRIES CREATED SUCCESSFULLY</P>";
            } ELSE {
              ECHO "ERROR CREATING QUESTION ENTRIES: " . MYSQLI_ERROR($CON);
            }

?>
