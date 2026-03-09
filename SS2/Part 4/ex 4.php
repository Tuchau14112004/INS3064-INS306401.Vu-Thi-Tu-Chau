<?php

$scores = [60, 70, 80, 90, 75];

$sum = 0;
$max = $scores[0];
$min = $scores[0];

foreach ($scores as $score) {
    $sum += $score;

    if ($score > $max) {
        $max = $score;
    }

    if ($score < $min) {
        $min = $score;
    }
}

$avg = $sum / count($scores);

$top = [];

foreach ($scores as $score) {
    if ($score > $avg) {
        $top[] = $score;
    }
}

echo "Avg: " . round($avg) . ", Top: [" . implode(", ", $top) . "]";

?>
