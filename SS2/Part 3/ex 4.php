<?php

function safeDiv(float $a, float $b): ?float {
    if ($b == 0) {
        return null;
    }

    return $a / $b;
}

$input = safeDiv(10, 0);

var_export($input);

?>
