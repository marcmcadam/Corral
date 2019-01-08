<?php
    // functions that do not access the database and can be used with generating database entries

    function shuffleIndices($size)
    {
        $indices = range(0, $size - 1);
        $choices = $indices;
        $shuffled = [];
        $choicesRemaining = sizeof($choices);
        foreach ($indices as $index)
        {
            $last = $choicesRemaining - 1;
            $chosen = random_int(0, $last);
            $choice = $choices[$chosen];
            $shuffled[$choice] = $index;
            if ($chosen < $last);
                $choices[$chosen] = $choices[$last];
            unset($choices[$last]);
            $choicesRemaining -= 1;
        }
        if ($choicesRemaining != 0)
        {
            echo "Shuffle failed";
            die;
        }
        return $shuffled;
    }

    function distribute($distribution, $count)
    {
        // proportionally distribute $count number of indices according to relative sizes of $distribution elements
        $total = array_sum($distribution);
        $remaining = (int)$count;
        $allocations = [];
        foreach ($distribution as $i => $v)
        {
            if ($total == 0)
                $proportion = 0.0;
            else
                $proportion = $v / $total;

            $take = (int)round($remaining * $proportion);
            $remaining -= $take;
            $total -= $v;
            $allocations[$i] = $take;
        }
        if ($total != 0 || $remaining != 0)
        {
            echo "Proportional distribution failed";
            die;
        }
        return $allocations;
    }
?>
