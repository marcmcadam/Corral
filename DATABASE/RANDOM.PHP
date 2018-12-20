<?php
    require_once "../hash.php";

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

    function randomBias($s)
    {
        $r = hashRandom16($s, 8);
        if ($r < 1)
            return 1;
        else if ($r < 3)
            return -1;
        else
            return 0;
    }

    function randomBiases($s)
    {
        global $numSkills;
        $biases = [];
        for ($i = 0; $i < $numSkills; $i += 1)
            array_push($biases, randomBias((($i + 100) << 11) | $s));
        return $biases;
    }

    function randomProject($p, &$importance, &$biases)
    {
        global $numSkills;
        $skills = randomImportances($p + 1000);
        $biases = randomBiases($p + 1000);
        $total = 0.0;
        foreach ($skills as $skill)
            $total += $skill;
        /*if ($total > 0)
            $importance = (int)round(10000 / $total);
        else
            $importance = 0;*/
        $importance = 20;
        return $skills;
    }

    function randomProjectStatus()
    {
      $choice = rand(0,3);
      switch ($choice) {
        case 0:
          $status = "Active";
          break;
        case 1:
          $status = "Inactive";
          break;
        case 2:
          $status = "Planning";
          break;
        case 3:
          $status = "Cancelled";
          break;
      }
      return $status;
    }
?>
