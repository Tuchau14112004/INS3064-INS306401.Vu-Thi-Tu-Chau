<?php

function isAdult(?int $age): bool {
    if ($age === null) {
        return false;
    }

    return $age >= 18;
}

$input = isAdult(null);

var_export($input);

?>
