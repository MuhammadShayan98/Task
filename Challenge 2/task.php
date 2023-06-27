<?php
function findDuplicates($arr)
{
    $frequency = array();

    foreach ($arr as $num) {
        if (!isset($frequency[$num])) {
            $frequency[$num] = 1;
        } else {
            $frequency[$num]++;
        }
    }

    $duplicates = array();
    foreach ($frequency as $num => $count) {
        if ($count > 1) {
            $duplicates[] = $num;
        }
    }

    return $duplicates;
}

$arr = array(2, 3, 1, 2, 3);
$duplicates = findDuplicates($arr);
echo "Duplicate Found: " . implode(" ", $duplicates);
