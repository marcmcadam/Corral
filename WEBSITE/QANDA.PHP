<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >

<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

<link rel="stylesheet" href="../styles/styles.css" >

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<?PHP
REQUIRE('CONNECTDB.PHP');

ECHO 'Which Campus Do You Attend';
//ANSWER QUERIES
$QUERY = "SELECT * FROM ANSWER WHERE ANSWER_ID BETWEEN 1 AND 6";
$RESULT = $MYSQLI->QUERY( $QUERY );

echo "<br>";
ECHO '<SELECT ID="ANSWER" NAME="ANSWER" CLASS="TXTBOX">';
ECHO '<OPTION VALUE="">-SELECT-</OPTION>';
WHILE ($ROW = $RESULT->FETCH_ASSOC()){
?>
    <OPTION VALUE="<?PHP ECHO $ROW['ANSWER']; ?>"><?PHP ECHO $ROW['ANSWER']; ?></OPTION>

<?PHP
}

ECHO "</SELECT>";

//BREAK
echo "<br>";
echo "<br>";
//BREAK

ECHO 'Are You Working?';
//ANSWER QUERIES
$QUERY = "SELECT * FROM ANSWER WHERE ANSWER_ID BETWEEN 7 AND 9";
$RESULT = $MYSQLI->QUERY( $QUERY );

echo "<br>";
ECHO '<SELECT ID="ANSWER" NAME="ANSWER" CLASS="TXTBOX">';
ECHO '<OPTION VALUE="">-SELECT-</OPTION>';
WHILE ($ROW = $RESULT->FETCH_ASSOC()){
?>
    <OPTION VALUE="<?PHP ECHO $ROW['ANSWER']; ?>"><?PHP ECHO $ROW['ANSWER']; ?></OPTION>
<?PHP
}

ECHO "</SELECT>";
//BREAK
echo "<br>";
echo "<br>";
//BREAK


?>
