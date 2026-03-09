<?php

function calculateBMI($kg, $m) {
    $bmi = $kg / ($m * $m);

    if ($bmi < 18.5) {
        $category = "Under";
    } elseif ($bmi < 25) {
        $category = "Normal";
    } else {
        $category = "Over";
    }

    return "BMI: " . round($bmi, 1) . " (" . $category . ")";
}

$result = calculateBMI(68, 1.75);

echo $result;

?>
