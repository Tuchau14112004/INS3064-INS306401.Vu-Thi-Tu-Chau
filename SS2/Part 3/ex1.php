<?php

function greet(string $name): string {
    return "Hello, " . $name . "!";
}

$input = greet("Sam");

echo $input;

?>
