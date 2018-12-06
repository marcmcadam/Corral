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
?>
