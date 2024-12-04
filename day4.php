<?php
// php -S localhost:8000

// As the search for the Chief continues, a small Elf who lives on the station tugs on your shirt; she'd like to know if you could help her with her word search (your puzzle input). 
// She only has to find one word: XMAS.
//
// This word search allows words to be horizontal, vertical, diagonal, written backwards, or even overlapping other words. 
// It's a little unusual, though, as you don't merely need to find one instance of XMAS - you need to find all of them. 
// Here are a few ways XMAS might appear, where irrelevant characters have been replaced with .:
//
// ..X...
// .SAMX.
// .A..A.
// XMAS.S
// .X....
// The actual word search will be full of letters instead. For example:
//
// MMMSXXMASM
// MSAMXMSMSA
// AMXSXMAAMM
// MSAMASMSMX
// XMASAMXAMM
// XXAMMXXAMA
// SMSMSASXSS
// SAXAMASAAA
// MAMMMXMMMM
// MXMXAXMASX
// In this word search, XMAS occurs a total of 18 times; here's the same word search again, but where letters not involved in any XMAS have been replaced with .:
//
// ....XXMAS.
// .SAMXMS...
// ...S..A...
// ..A.A.MS.X
// XMASAMX.MM
// X.....XA.A
// S.S.S.S.SS
// .A.A.A.A.A
// ..M.M.M.MM
// .X.X.XMASX
// Take a look at the little Elf's word search. How many times does XMAS appear?

// Your puzzle answer was 2644.

$input = file_get_contents('input/input_day4.txt');

if ($input === false) {
    die("Kon het bestand niet lezen.");
}

$grid = explode("\n", trim($input));
$rows = count($grid);
$cols = strlen($grid[0]);

$word = "XMAS";
$wordLength = strlen($word);
$totalCount = 0;

function checkWord($grid, $word, $startRow, $startCol, $dirRow, $dirCol)
{
    $wordLength = strlen($word);
    for ($i = 0; $i < $wordLength; $i++) {
        $row = $startRow + $i * $dirRow;
        $col = $startCol + $i * $dirCol;
        if ($row < 0 || $row >= count($grid) || $col < 0 || $col >= strlen($grid[0]) || $grid[$row][$col] !== $word[$i]) {
            return false;
        }
    }
    return true;
}

for ($row = 0; $row < $rows; $row++) {
    for ($col = 0; $col < $cols; $col++) {
        if (checkWord($grid, $word, $row, $col, 0, 1)) $totalCount++;
        if (checkWord($grid, $word, $row, $col, 0, -1)) $totalCount++;
        if (checkWord($grid, $word, $row, $col, 1, 0)) $totalCount++;
        if (checkWord($grid, $word, $row, $col, -1, 0)) $totalCount++;
        if (checkWord($grid, $word, $row, $col, 1, 1)) $totalCount++;
        if (checkWord($grid, $word, $row, $col, -1, -1)) $totalCount++;
        if (checkWord($grid, $word, $row, $col, -1, 1)) $totalCount++;
        if (checkWord($grid, $word, $row, $col, 1, -1)) $totalCount++;
    }
}

echo "Aantal keren XMAS: " . $totalCount . "\n";


echo "<script>console.log('Aantal keren dat XMAS voorkomt: " . $totalCount . "');</script>";
