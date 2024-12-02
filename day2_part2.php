<?php
// php -S localhost:8000

// --- Part Two ---
// The engineers are surprised by the low number of safe reports until they realize they forgot to tell you about the Problem Dampener.
//
// The Problem Dampener is a reactor-mounted module that lets the reactor safety systems tolerate a single bad level in what would otherwise be a safe report. It's like the bad level never happened!
//
// Now, the same rules apply as before, except if removing a single level from an unsafe report would make it safe, the report instead counts as safe.
//
// More of the above example's reports are now safe:
//
// 7 6 4 2 1: Safe without removing any level.
// 1 2 7 8 9: Unsafe regardless of which level is removed.
// 9 7 6 2 1: Unsafe regardless of which level is removed.
// 1 3 2 4 5: Safe by removing the second level, 3.
// 8 6 4 4 1: Safe by removing the third level, 4.
// 1 3 6 7 9: Safe without removing any level.
// Thanks to the Problem Dampener, 4 reports are actually safe!
//
// Update your analysis by handling situations where the Problem Dampener can remove a single level from unsafe reports. How many reports are now safe?

// Your puzzle answer was 407.

$input = file_get_contents('input_day2.txt');

if ($input === false) {
    die("Kon het bestand niet lezen.");
}

$reports = explode("\n", trim($input));

function isSafeReport($report)
{
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

function canBeMadeSafeByRemovingOneLevel($report)
{
    $levels = array_map('intval', explode(' ', trim($report)));

    for ($i = 0; $i < count($levels); $i++) {
        $modifiedLevels = $levels;
        array_splice($modifiedLevels, $i, 1);
        if (isSafeReport(implode(' ', $modifiedLevels))) {
            return true;
        }
    }

    return false;
}

$safeCount = 0;
foreach ($reports as $report) {
    if (isSafeReport($report) || canBeMadeSafeByRemovingOneLevel($report)) {
        $safeCount++;
    }
}

echo "Aantal veilige rapporten: " . $safeCount . "\n";

echo "<script>console.log('Aantal veilige rapporten: " . $safeCount . "');</script>";
