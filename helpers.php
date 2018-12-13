<?php

function error(string $text): void
{
    echo "\033[31m{$text}\033[0m";
}

function info(string $text): void
{
    echo "\033[34m{$text}\033[0m";
}

function ask(string $text)
{
    echo "\n";
    echo " \033[32mEnter {$text}:\033[0m \n";
    return readline(' > ');
}
