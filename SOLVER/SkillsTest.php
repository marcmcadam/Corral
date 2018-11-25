<!DOCTYPE html>
<html>
<body>

<?php
	require "Hungarian.php";
	
	class SkillDemand
	{
		public $MaxDifficulty;
		public $Importance;
	}
	
	echo "<div style='width: 100%; text-align: center; font-family: consolas; font-size: 0.75em;'><br>";
	
	$numSkills = 8;
	$numStudents = 49;
	$numProjects = 7;
	$numTasks = $numStudents;
	$displayOutput = max($numStudents, $numTasks) < 20;
	$randomisation = 1; // tiny randomisation bypasses an endless loop, caused by excessive identical values, in our acquired Hungarian algorithm code
	$discretisation = 100; // multiply everything so some decimals are preserved
	
	$numDummyStudents = max($numTasks - $numStudents, 0);
	$numDummyTasks = max($numStudents - $numTasks, 0); // avoid having these. the costs for dummy tasks make no sense
	
	$students = [];
	$projects = [];
	$tasks = [];
	$tasksProject = [];
	
	for ($i = 0; $i < $numStudents; $i += 1)
	{
		$student = [];
		for ($s = 0; $s < $numSkills; $s += 1)
		{
			$rarity = 10 + (int)($s * 20 / $numSkills); // low $s are more common
			$skill = max(rand(0, $rarity + 10) - $rarity, 0);
			array_push($student, $skill);
		}
		array_push($students, $student);
	}
	for ($i = 0; $i < $numDummyStudents; $i += 1)
		array_push($students, array_fill(0, $numSkills, 0)); // fill dummy students with minimum ability - they cannot satisfy any demands
	
	for ($i = 0; $i < $numProjects; $i += 1)
	{
		$project = [];
		$total = 0.0;
		for ($s = 0; $s < $numSkills; $s += 1)
		{
			//$rarity = 10 + (int)(($numSkills - 1 - $s) * 20 / $numSkills); // high $s are more common
			$rarity = 20;
			$skill = new SkillDemand();
			$skill->MaxDifficulty = max(rand(0, $rarity + 10) - $rarity, 0);
			$skill->Importance = $skill->MaxDifficulty; // for this test importance is the same as difficulty. sorta makes sense, but importance will be divided by the total, so that this task isn't biased
			array_push($project, $skill);
			$total += $skill->Importance;
		}
		// commented - it makes sense for more restrictive skills to require more attention from the solver
		// however as these skills are fulfilled the demand cost should be reduced to avoid demanding all members will that skill
		//if ($total > 0)
		//{
		//	for ($s = 0; $s < $numSkills; $s += 1)
		//		$project[$s]->Importance = (int)($project[$s]->Importance * $discretisation / $total);
		//}
		array_push($projects, $project);
	}
	
	for ($i = 0; $i < $numTasks; $i += 1)
	{
		$p = $i % $numProjects;
		$task = $projects[$p];
		array_push($tasks, $task);
		$tasksProject[$i] = $p;
	}
	for ($i = 0; $i < $numDummyTasks; $i += 1)
		array_push($tasks, array_fill(0, $numSkills, new SkillDemand())); // dummy tasks should not be used
	
	echo "Student Skills<br>";
	for ($i = 0; $i < sizeof($students); $i += 1)
	{
		echo "R-" . $i . ": ";
		for ($s = 0; $s < $numSkills; $s += 1)
			echo $students[$i][$s] . ", ";
		echo "<br>";
	}
	echo "<br>";
	echo "Project Skills<br>";
	for ($p = 0; $p < sizeof($projects); $p += 1)
	{
		echo "Difficulty: ";
		for ($s = 0; $s < $numSkills; $s += 1)
			echo $projects[$p][$s]->MaxDifficulty . ", ";
		echo "<br>";
		echo "Importance: ";
		for ($s = 0; $s < $numSkills; $s += 1)
			echo $projects[$p][$s]->Importance . ", ";
		echo "<br><br>";
	}
	echo "<br>";
	
	$matrix = array();
	for ($y = 0; $y < sizeof($students); $y += 1)
	{
		$row = array();
		for ($x = 0; $x < sizeof($tasks); $x += 1)
		{
			$c = 0;
			for ($s = 0; $s < $numSkills; $s += 1)
			{
				$demand = $tasks[$x][$s];
				$max = $demand->MaxDifficulty;
				$importance = $demand->Importance;
				if ($max > 0)
				{
					$d = max(1.0 - $students[$y][$s] / $max, 0.0);
					$c += (int)($d * $d * $importance);
				}
			}
			$row[$x] = $c + rand(0, $randomisation);
		}
		$matrix[$y] = $row;
	}
	$copy = $matrix;
	
	$h = new RPFK\Hungarian\Hungarian($matrix);
	$assignments = $h->solve($displayOutput, 10000);
	
	foreach ($h->takeOutput() as $text)
		echo $text;
	if ($displayOutput)
		echo "<hr><br>";
	
	$relevantAssignments = [];
	foreach ($h->rowAssignments() as $row => $column)
	{
		if ($row < $numStudents) // not a dummy student
			$relevantAssignments[$row] = $column;
	}
	$cost = $h->cost($relevantAssignments);
	$mean = $cost / $numStudents;
	
	echo "Cost: " . $cost . "<br>";
	printf("Mean: %.2f<br>", $mean);
	echo "<br>";
	
	$projectStudents = array_fill(0, $numProjects, []);
	foreach ($assignments as $x => $y)
	{
		$p = $tasksProject[$y];
		array_push($projectStudents[$p], $x);
	}
	
	for ($p = 0; $p < $numProjects; $p += 1)
	{
		echo "Project:<br>";
		for ($s = 0; $s < $numSkills; $s += 1)
			echo $projects[$p][$s]->MaxDifficulty . ", ";
		echo "<br><br>";
		echo "Students:<br>";
		foreach ($projectStudents[$p] as $i)
		{
			echo "R-" . $i . ": ";
			for ($s = 0; $s < $numSkills; $s += 1)
				echo $students[$i][$s] . ", ";
			echo "<br>";
		}
		echo "<br><br>";
	}
	
	$h->outputMatrix($copy);
	foreach ($h->takeOutput() as $text)
		echo $text;
	
	echo "</div><br><br>";
?>

</body>
</html>
