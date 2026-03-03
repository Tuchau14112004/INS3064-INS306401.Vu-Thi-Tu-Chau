<?php
$a = 5;      // integer
$b = "5";    // string

$equal = ($a == $b);        // So sánh giá trị
$identical = ($a === $b);   // So sánh giá trị + kiểu dữ liệu

echo "Equal (" . ($equal ? "True" : "False") . "), ";
echo "Identical (" . ($identical ? "True" : "False") . ")";
?>
