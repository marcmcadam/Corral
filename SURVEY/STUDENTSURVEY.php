<?php
 	$PageTitle = "Student Survey";
	require "../PAGES/HEADER_STUDENT.PHP";
    
    function skillOptions($title, $key)
    {
        /*echo "<tr>
                <td>$title</td>
                <td><select name='$key'>
                    <option value='4'>Expert</option>
                    <option value='3'>High</option>
                    <option value='2'>Intermediate</option>
                    <option value='1'>Novice</option>
                    <option value='0' selected>None</option>
                </select></td>
            </tr>";*/
        echo "<tr>
                <th>$title</th>
                <td><label for='4$key'><div>
                    <br><input type='radio' id='4$key' name='$key' value='4'><br>&nbsp;
                </div></label></td>
                <td><label for='3$key'><div>
                    <br><input type='radio' id='3$key' name='$key' value='3'><br>&nbsp;
                </div></label></td>
                <td><label for='2$key'><div>
                    <br><input type='radio' id='2$key' name='$key' value='2'><br>&nbsp;
                </div></label></td>
                <td><label for='1$key'><div>
                    <br><input type='radio' id='1$key' name='$key' value='1'><br>&nbsp;
                </div></label></td>
                <td><label for='0$key'><div>
                    <br><input type='radio' id='0$key' name='$key' value='0' checked><br>&nbsp;
                </div></label></td>
            </tr>";
    }
?>

<style>
    table { border-collapse: collapse; }
    td, th {
        text-align: center;
        width: 96px;
        border-right: thin solid #808080;
        border-bottom: thin solid #808080;
        padding: 0;
    }
    td div {
        width: 100%;
        height: 100%;
    }
    .inputSubmit {
        font-size: 1.5em;
        padding: 16px;
    }
</style>

<div style="text-align: center;">
    <h1>Skills Survey</h1>
    <form action="../SURVEY/surveyprocess" method="post">
    
    <table align="center"><tr>
    <th>&nbsp;</th>
    <th>Expert</th>
    <th>High</th>
    <th>Intermediate</th>
    <th>Novice</th>
    <th>None</th>
    </tr>
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
    <br>
    <input type="submit" value="Submit Responses" class="inputSubmit">
    </form>
</div>
<?php require "../PAGES/FOOTER_STUDENT.PHP"; ?>
