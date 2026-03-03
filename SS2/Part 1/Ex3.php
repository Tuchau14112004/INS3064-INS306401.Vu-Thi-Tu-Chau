<?php
$str = "25.50";

// Cast sang float
$floatVal = (float)$str;

// Cast sang int
$intVal = (int)$floatVal;

// In kết quả theo format yêu cầu
echo gettype($floatVal) . "(" . $floatVal . "), ";
echo gettype($intVal) . "(" . $intVal . ")";
?>
