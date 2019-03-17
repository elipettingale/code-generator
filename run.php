<?php

spl_autoload_register(function ($class) {
    include str_replace('\\', '/',
        str_replace('EliPett\\CodeGeneration', 'src', $class)
    ) . '.php';
});

use EliPett\CodeGeneration\CodeGenerator;

$generator = new CodeGenerator();

if ($generator->load($argv[1])) {
    $generator->run($argv[2]);
}
