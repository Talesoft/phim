<?php

use Tale\Inflector;

include __DIR__.'/../vendor/autoload.php';

$in = fopen(__DIR__.'/colors.csv', 'r');
$out = fopen(__DIR__.'/colors-out.php', 'w');

$colors = [];
while ($row = fgetcsv($in)) {

    $name = $row[0];
    $canonicalName = strtolower(preg_replace('/[^a-z0-9]+/i', '', $name));
    $constName = strtoupper($canonicalName);

    $colors[$canonicalName] = "self::$constName";

    fwrite($out, "const $constName = '$row[1]';\n");
}

fwrite($out, "\n\n");

foreach ($colors as $name => $const) {

    fwrite($out, "\t\t'$name' => $const,\n");
}

fclose($in);
fclose($out);

