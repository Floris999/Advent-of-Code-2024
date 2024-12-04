<?php
// php -S localhost:8000

// --- Part Two ---
// The Elf looks quizzically at you. Did you misunderstand the assignment?
//
// Looking for the instructions, you flip over the word search to find that this isn't actually an XMAS puzzle; it's an X-MAS puzzle in which you're supposed to find two MAS in the shape of an X. 
// One way to achieve that is like this:
//
// M.S
// .A.
// M.S
// Irrelevant characters have again been replaced with . in the above diagram. Within the X, each MAS can be written forwards or backwards.
//
// Here's the same example from before, but this time all of the X-MASes have been kept instead:
//
// .M.S......
// ..A..MSMS.
// .M.S.MAA..
// ..A.ASMSM.
// .M.S.M....
// ..........
// S.S.S.S.S.
// .A.A.A.A..
// M.M.M.M.M.
// ..........
// In this example, an X-MAS appears 9 times.
//
// Flip the word search from the instructions back over to the word search side and try again. How many times does an X-MAS appear?

// Your puzzle answer was 2644.


function countXMAS($grid)
{
    $rows = count($grid);
    $cols = count($grid[0]);
    $count = 0;


    function matchesMASorSAM($diagonal)
    {
        return $diagonal === "MAS" || $diagonal === "SAM";
    }

    for ($i = 1; $i < $rows - 1; $i++) {
        for ($j = 1; $j < $cols - 1; $j++) {
            $topLeftToBottomRight = $grid[$i - 1][$j - 1] . $grid[$i][$j] . $grid[$i + 1][$j + 1];
            $topRightToBottomLeft = $grid[$i - 1][$j + 1] . $grid[$i][$j] . $grid[$i + 1][$j - 1];

            if (matchesMASorSAM($topLeftToBottomRight) && matchesMASorSAM($topRightToBottomLeft)) {
                $count++;
            }
        }
    }

    return $count;
}

$input = file_get_contents('input/input_day4.txt');
$grid = array_map('str_split', explode(PHP_EOL, trim($input)));

// var_dump($grid);
// die();

$totalCount = countXMAS($grid);

echo "Aantal keren X-MAS: " . $totalCount . "\n";

echo "<script>console.log('Aantal keren X-MAS: " . $totalCount . "');</script>";
