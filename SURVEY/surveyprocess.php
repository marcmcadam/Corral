<?php
 	$PageTitle = "Student Survey";
	require "../PAGES/HEADER_STUDENT.PHP";
	require('../DATABASE/CONNECTDB.PHP');

    function interpret($key, &$variable)
    {
        $variable = min(max((int)$_POST[$key], 0), 4);
    }
    
    interpret("hc", $hc);
    interpret("js", $js);
    interpret("php", $php);
    interpret("java", $java);
    interpret("c", $c);
    interpret("cpp", $cpp);
    interpret("oc", $oc);
    interpret("db", $db);
    interpret("u3", $u3);
    interpret("ui", $ui);
    interpret("se", $se);
    
    $sql = "INSERT INTO surveyanswer (stu_ID,stu_hc,stu_js,stu_php,stu_java,stu_c,stu_cpp,stu_oc,stu_db,stu_u3,stu_ui,stu_se)
                                VALUES ('$id','$hc','$js','$php','$java','$c','$cpp','$oc','$db','$u3','$ui','$se')";

    $b = mysqli_query($CON,$sql);

    if(!$b){
        echo "<p>Failed to create a answer</p>";
    }else{
        if(mysqli_affected_rows($CON)>0){
            echo "<p>Survey successfully created</p>";
        }else{
            return "<p>not affected rows</p>";
        }
    }

    mysqli_close($CON);
?>
<h2>Thank for completing the survey</h2>
<p>Please log out</p>
<?php require "../PAGES/FOOTER_STUDENT.PHP"; ?>
