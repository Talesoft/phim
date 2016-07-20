<?php

$colors = array_map(function($line) {
    
    return explode(':', $line);
}, file(__DIR__.'/colors'));

$finalColors = [];
foreach ($colors as $array) {
    
    list($name, $hex) = $array;
    $finalColors[strtolower(preg_replace('/[^a-z0-9]/i', '', $name))] = strtolower(trim($hex));
}

ksort($finalColors);

file_put_contents(__DIR__.'/colors', implode("\n", array_map(function($name, $hex) {

    return "$name:$hex";
}, array_keys($finalColors), $finalColors)));

foreach ($finalColors as $name => $hex) {

    echo "const ".strtoupper($name)." = '$hex';\n";
}

echo "\n\n";

foreach ($finalColors as $name => $hex) {

    echo "      '$name' => self::".strtoupper($name).",\n";
}

echo "\n\n";

foreach ($finalColors as $name => $hex) {

    echo "      '$name' => '$hex',\n";
}