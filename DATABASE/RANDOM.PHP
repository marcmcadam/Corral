<?php
    require_once("../SOLVER/HASH.PHP");
    
    function randomSkill($s)
    {
        global $rarity;
        $m = (int)floor(pow($rarity, 5.0));
        $r = hashRandom16($s, $m);
        return 4 - (int)floor(log($r) / log($rarity));
    }

    function randomSkills($s)
    {
        global $numSkills;
        $skills = [];
        for ($i = 0; $i < $numSkills; $i += 1)
            array_push($skills, randomSkill(($i << 11) | $s));
        return $skills;
    }

    function randomImportance($s)
    {
        global $rarity;
        $r = hashRandom16($s, (int)floor(100 + $rarity));
        return (int)floor(min(max($r - $rarity, 0.0), 100.9));
    }

    function randomImportances($s)
    {
        global $numSkills;
        $skills = [];
        for ($i = 0; $i < $numSkills; $i += 1)
            array_push($skills, randomImportance(($i << 11) | $s));
        return $skills;
    }

    function randomProject($p, &$importance)
    {
        global $numSkills;
        $skills = randomImportances($p + 1000);
        $total = 0.0;
        foreach ($skills as $skill)
            $total += $skill;
        if ($total > 0)
            $importance = (int)round(1000000 / $total);
        else
            $importance = 0;
        return $skills;
    }
?>
