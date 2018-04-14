<?PHP
REQUIRE('CONNECTDB.PHP');
?>

<?PHP
//ANSWER DETAILS
$ANSWER = "INSERT INTO ANSWER (ANSWER_ID, ANSWER)
VALUES      ('1',  'GEELONG'),
            ('2',  'BURWOOD'),
            ('3',  'CLOUD - CANNOT ACCESS GEELONG OR BURWOOD CAMPUSES'),
            ('4',  'CLOUD - CAN TRAVEL TO GEELONG CAMPUS EASILY'),
            ('5',  'CLOUD - CAN TRAVEL TO BURWOOD CAMPUS EASILY'),
            ('6',  'CLOUD - LOCATED OUTSIDE OF AUSTRALIA'),
            ('7',  'FULL TIME'),
            ('8',  'PART TIME'),
            ('9',  'NO WORK'),
            ('10', 'BLANK')";

            //EXECUTE QUERY
            IF (MYSQLI_QUERY($CON,$ANSWER)) {
              ECHO "<P>ANSWER ENTRIES CREATED SUCCESSFULLY</P>";
            } ELSE {
              ECHO "ERROR CREATING ANSWER ENTRIES: " . MYSQLI_ERROR($CON);
            }

?>
