<?php

include __DIR__ . '/src/CodeGenerator.php';

use EliPett\CodeGeneration\CodeGenerator;

$generator = new CodeGenerator();

if ($generator->load($argv[1])) {
    $generator->run($argv[2]);
}
