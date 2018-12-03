<?php
 	$PageTitle = "Student Survey";
	require "../PAGES/HEADER_STUDENT.PHP";
    
    function skillOptions($title, $key)
    {
        echo "<tr>
            <td>$title</td>
            <td><select name='$key'>
                <option value='4'>Expert</option>
                <option value='3'>High</option>
                <option value='2'>Intermediate</option>
                <option value='1'>Novice</option>
                <option value='0' selected>None</option>
            </select></td>
            </tr>";
    }
?>

<h2>Student Survey</h2>
<form action="../SURVEY/surveyprocess" method="post">

<p>Project skills</p>
<table>
<?php
    skillOptions("HTML/CSS", "hc");
    skillOptions("JavaScript", "js");
    skillOptions("PHP", "php");
    skillOptions("Java", "java");
    skillOptions("C", "c");
    skillOptions("C++", "cpp");
    skillOptions("Objective-C", "oc");
    skillOptions("Database", "db");
    skillOptions("Unity", "u3");
    skillOptions("UI", "ui");
    skillOptions("Security", "se");
?>
</table>
<input type="submit" value="Send Responses">
</form>

<?php require "../PAGES/FOOTER_STUDENT.PHP"; ?>
