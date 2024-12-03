<?php
// As you scan through the corrupted memory, you notice that some of the conditional statements are also still intact. 
// If you handle some of the uncorrupted conditional statements in the program, you might be able to get an even more accurate result.
//
// There are two new instructions you'll need to handle:
//
// The do() instruction enables future mul instructions.
// The don't() instruction disables future mul instructions.
// Only the most recent do() or don't() instruction applies. At the beginning of the program, mul instructions are enabled.
//
// For example:
//
// xmul(2,4)&mul[3,7]!^don't()_mul(5,5)+mul(32,64](mul(11,8)undo()?mul(8,5))
// This corrupted memory is similar to the example from before, but this time the mul(5,5) and mul(11,8) instructions are disabled because there is a don't() instruction before them. 
// The other mul instructions function normally, including the one at the end that gets re-enabled by a do() instruction.
//
// This time, the sum of the results is 48 (2*4 + 8*5).
//
// Handle the new instructions; what do you get if you add up all of the results of just the enabled multiplications?

// Your puzzle answer was 111762583.

$input = file_get_contents('input_day3.txt');

if ($input === false) {
    die("Kon het bestand niet lezen.");
}

preg_match_all('/(do\(\)|don\'t\(\)|mul\((\d+),(\d+)\))/', $input, $matches);


$total = 0;
$mul_enabled = true;

foreach ($matches[0] as $match) {
    if ($match === 'do()') {
        $mul_enabled = true;
    } elseif ($match === "don't()") {
        $mul_enabled = false;
    } elseif (preg_match('/mul\((\d+),(\d+)\)/', $match, $mul_match)) {
        if ($mul_enabled) {
            $x = (int)$mul_match[1];
            $y = (int)$mul_match[2];
            $total += $x * $y;
        }
    }
}

echo "Totaal van alle vermenigvuldigingen: " . $total . "\n";

echo "<script>console.log('Totaal van alle vermenigvuldigingen: " . $total . "');</script>";
?>