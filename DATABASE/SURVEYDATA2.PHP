<?PHP
// Connect to Database
require "CONNECTDB.PHP";

//empty existing surveydata table
$surveyanswer = "TRUNCATE surveyanswer";
if (mysqli_query($CON, $surveyanswer)) {
  echo "<p>surveyanswer data deleted</p>";
} else {
  echo "Error deleting surveyanswer data: " . mysqli_error($CON);
}

// TODO Random skills not yet implemented
$numSkills = 11;
$rarity = 2.0;

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
$surveydata = 'INSERT INTO surveyanswer (stu_ID,stu_hc,stu_js,stu_php,stu_java,stu_c,stu_cpp,stu_oc,stu_db,stu_u3,stu_ui,stu_se) VALUES
(216856084' . randomSkills() . '),
(216116590' . randomSkills() . '),
(216600366' . randomSkills() . '),
(216030213' . randomSkills() . '),
(216252283' . randomSkills() . '),
(216822724' . randomSkills() . '),
(216420635' . randomSkills() . '),
(216830213' . randomSkills() . '),
(216988272' . randomSkills() . '),
(216986348' . randomSkills() . '),
(216147717' . randomSkills() . '),
(216901983' . randomSkills() . '),
(216469334' . randomSkills() . '),
(216152608' . randomSkills() . '),
(216207865' . randomSkills() . '),
(216746852' . randomSkills() . '),
(216337658' . randomSkills() . '),
(216232216' . randomSkills() . '),
(216429653' . randomSkills() . '),
(216909984' . randomSkills() . '),
(216463558' . randomSkills() . '),
(216592291' . randomSkills() . '),
(216786574' . randomSkills() . '),
(216983844' . randomSkills() . '),
(216528480' . randomSkills() . '),
(216314056' . randomSkills() . '),
(216965849' . randomSkills() . '),
(216275552' . randomSkills() . '),
(216779566' . randomSkills() . '),
(216412040' . randomSkills() . '),
(216762187' . randomSkills() . '),
(216498622' . randomSkills() . '),
(216567433' . randomSkills() . '),
(216249111' . randomSkills() . '),
(216168384' . randomSkills() . '),
(216883858' . randomSkills() . '),
(216427960' . randomSkills() . '),
(216391202' . randomSkills() . '),
(216360811' . randomSkills() . '),
(216902992' . randomSkills() . '),
(216292829' . randomSkills() . '),
(216720992' . randomSkills() . '),
(216765045' . randomSkills() . '),
(216440236' . randomSkills() . '),
(216249197' . randomSkills() . '),
(216828121' . randomSkills() . '),
(216671593' . randomSkills() . '),
(216587493' . randomSkills() . '),
(216782631' . randomSkills() . '),
(216949905' . randomSkills() . '),
(216656298' . randomSkills() . '),
(216685859' . randomSkills() . '),
(216543826' . randomSkills() . '),
(216454582' . randomSkills() . '),
(216242484' . randomSkills() . '),
(216636419' . randomSkills() . '),
(216275634' . randomSkills() . '),
(216184964' . randomSkills() . '),
(216440367' . randomSkills() . '),
(216402248' . randomSkills() . '),
(216674327' . randomSkills() . '),
(216734638' . randomSkills() . '),
(216380225' . randomSkills() . '),
(216800271' . randomSkills() . '),
(216585007' . randomSkills() . '),
(216021355' . randomSkills() . '),
(216049775' . randomSkills() . '),
(216836356' . randomSkills() . '),
(216510372' . randomSkills() . '),
(216254575' . randomSkills() . '),
(216375217' . randomSkills() . '),
(216498790' . randomSkills() . '),
(216708060' . randomSkills() . '),
(216425301' . randomSkills() . '),
(216848062' . randomSkills() . '),
(216435225' . randomSkills() . '),
(216510246' . randomSkills() . '),
(216935793' . randomSkills() . '),
(216181579' . randomSkills() . '),
(216040637' . randomSkills() . '),
(216926394' . randomSkills() . '),
(216817132' . randomSkills() . '),
(216390639' . randomSkills() . '),
(216072283' . randomSkills() . '),
(216270368' . randomSkills() . '),
(216120029' . randomSkills() . '),
(216333608' . randomSkills() . '),
(216608767' . randomSkills() . '),
(216725302' . randomSkills() . '),
(216843094' . randomSkills() . '),
(216553948' . randomSkills() . '),
(216801834' . randomSkills() . '),
(216338930' . randomSkills() . '),
(216542434' . randomSkills() . '),
(216899114' . randomSkills() . '),
(216446129' . randomSkills() . '),
(216026988' . randomSkills() . '),
(216776800' . randomSkills() . '),
(216820558' . randomSkills() . '),
(216043880' . randomSkills() . ')
';

if (mysqli_query($CON,$surveydata)) {
  echo "<P>Sample surveyanswer data inserted</P>";
} else {
  echo "Error inserting sample surveyanswer data: " . mysqli_error($CON);
}
?>
