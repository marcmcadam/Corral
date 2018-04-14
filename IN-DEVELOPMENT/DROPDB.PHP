<?PHP
REQUIRE('CONNECT.PHP');
?>

<?PHP

$DROP = "DROP DATABASE CORRAL_PROJECT";
if (mysql_query($DROP)) {
    echo "Database CORRAL_PROJECT was successfully dropped\n";
} else {
    echo 'Error dropping database: ' . mysql_error() . "\n";
}
?>
