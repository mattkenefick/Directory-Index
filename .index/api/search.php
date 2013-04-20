<?php

$root    = '../../';
$search  = $_GET['txtQuery'];

// Don't search for nothing
if (strlen($search) > 3) {
    $command = "find $root -name \"$search\"";

    $result  = shell_exec($command);
    $result  = explode("\n", $result);
    array_pop($result);
}

// Output
die(json_encode($result));