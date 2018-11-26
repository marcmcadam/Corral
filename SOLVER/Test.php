<!DOCTYPE html>
<html>
<body>

<?php
    require "Hungarian.php";
    
    $n = 10;
    $displayOutput = true; // set to false for maximum speed

    $matrix = array();
    for ($y = 0; $y < $n; $y += 1)
    {
        $row = array();
        for ($x = 0; $x < $n; $x += 1)
        {
            $z = rand(1, 100) + rand(1, 100);
            $row[$x] = $z * $z;
        }
        $matrix[$y] = $row;
    }
    $copy = $matrix;
    
    $h = new RPFK\Hungarian\Hungarian($matrix);
    echo "<div style='width: 100%; text-align: center; font-family: consolas; font-size: 0.75em;'><br>";
    $assignments = $h->solve($displayOutput);
    
    foreach ($h->takeOutput() as $text)
        echo $text;
    if ($displayOutput)
        echo "<hr><br>";
    
    $cost = $h->cost($h->rowAssignments());
    echo "Cost: " . $cost . "<br>";
    echo "<br>";
    
    ksort($assignments);
    foreach ($assignments as $x => $y)
        echo "R-" . $x . " -> C-" . $y . "<br>";
    echo "<br><br>";
    
    $h->outputMatrix($copy);
    foreach ($h->takeOutput() as $text)
        echo $text;
    
    echo "</div><br><br>";
?>

</body>
</html>
