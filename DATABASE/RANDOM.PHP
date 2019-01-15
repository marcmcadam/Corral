<?php
    function randomSkill()
    {
        global $rarity;
        $m = (int)floor(pow($rarity, 5.0));
        $r = random_int(0, $m - 1);
        return 4 - (int)floor(log($r) / log($rarity));
    }

    function randomSkills()
    {
        global $numSkills;
        $skills = [];
        for ($i = 0; $i < $numSkills; $i += 1)
            array_push($skills, randomSkill());
        return $skills;
    }

    function randomImportance()
    {
        global $rarity;
        $r = random_int(0, (int)floor(100 + $rarity) - 1);
        return (int)floor(min(max($r - $rarity, 0.0), 100.9));
    }

    function randomImportances()
    {
        global $numSkills;
        $skills = [];
        for ($i = 0; $i < $numSkills; $i += 1)
            array_push($skills, randomImportance());
        return $skills;
    }

    function randomBias()
    {
        $r = random_int(0, 7);
        if ($r < 1)
            return 1;
        else if ($r < 3)
            return -1;
        else
            return 0;
    }

    function randomBiases()
    {
        global $numSkills;
        $biases = [];
        for ($i = 0; $i < $numSkills; $i += 1)
            array_push($biases, randomBias());
        return $biases;
    }

    function randomProject(&$skills, &$importance, &$biases)
    {
        global $numSkills;
        $skills = randomImportances();
        $biases = randomBiases();
        $importance = 20;
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
