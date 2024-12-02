<?php
// php -S localhost:8000

// The unusual data (your puzzle input) consists of many reports, one report per line. Each report is a list of numbers called levels that are separated by spaces. For example:
//
// 7 6 4 2 1
// 1 2 7 8 9
// 9 7 6 2 1
// 1 3 2 4 5
// 8 6 4 4 1
// 1 3 6 7 9
// This example data contains six reports each containing five levels.
//
// The engineers are trying to figure out which reports are safe. The Red-Nosed reactor safety systems can only tolerate levels that are either gradually increasing or gradually decreasing. So, a report only counts as safe if both of the following are true:
//
// The levels are either all increasing or all decreasing.
// Any two adjacent levels differ by at least one and at most three.
// In the example above, the reports can be found safe or unsafe by checking those rules:
//
// 7 6 4 2 1: Safe because the levels are all decreasing by 1 or 2.
// 1 2 7 8 9: Unsafe because 2 7 is an increase of 5.
// 9 7 6 2 1: Unsafe because 6 2 is a decrease of 4.
// 1 3 2 4 5: Unsafe because 1 3 is increasing but 3 2 is decreasing.
// 8 6 4 4 1: Unsafe because 4 4 is neither an increase or a decrease.
// 1 3 6 7 9: Safe because the levels are all increasing by 1, 2, or 3.
// So, in this example, 2 reports are safe.
//
// Analyze the unusual data from the engineers. How many reports are safe?
//
// Your puzzle answer was 407.

$input = file_get_contents('input_day2.txt');

if ($input === false) {
    die("Kon het bestand niet lezen.");
}

$reports = explode("\n", trim($input));

function isSafeReport($report) {
    $levels = array_map('intval', explode(' ', trim($report)));
    $increasing = true;
    $decreasing = true;

    for ($i = 0; $i < count($levels) - 1; $i++) {
        $diff = $levels[$i + 1] - $levels[$i];
        if ($diff < -3 || $diff > 3 || $diff == 0) {
            return false;
        }
        if ($diff < 0) {
            $increasing = false;
        }
        if ($diff > 0) {
            $decreasing = false;
        }
    }

    return $increasing || $decreasing;
}

$safeCount = 0;
foreach ($reports as $report) {
    if (isSafeReport($report)) {
        $safeCount++;
    }
}

echo "Aantal veilige rapporten: " . $safeCount . "\n";

echo "<script>console.log('Aantal veilige rapporten: " . $safeCount . "');</script>";
?>