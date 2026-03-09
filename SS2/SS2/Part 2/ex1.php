<?php

$input = 85;

if ($input >= 90) {
    $grade = "A";
} elseif ($input >= 80) {
    $grade = "B";
} elseif ($input >= 70) {
    $grade = "C";
} else {
    $grade = "F";
}

echo "Grade: " . $grade;

?>
