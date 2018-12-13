# Code Generator

## Install

Add the following alias to your bash_profile:

    alias gen='php ~/.composer/vendor/elipettingale/code-generator/run.php `pwd` $1'

Navigate to the installed directory and run the install script:

    cd ~/.composer/vendor/elipettingale/code-generator
    ./install.sh

## Stubs

Stubs are templates that are used to generate files. Within these files you can define parameters that are filled in when the stub is generated. You can define parameters as follows:

    $PARAMETER_CONVERSION$

The parameter is the name of the parameter and the conversion defines how that parameter will be manipulated when generated. For example:

    $ENTITY_UPPER_CAMEL_CASE$

In addition you can use any of the following special parameters:

    $NOW$

## Conversions

The following is a list of all the possible conversions:

    NO_CASE
    LOWER_CASE
    UPPER_CASE
    TIGHT_CASE
    LOWER_SNAKE_CASE
    UPPER_SNAKE_CASE
    LOWER_CAMEL_CASE
    UPPER_CAMEL_CASE
    LOWER_HYPHEN_CASE
    UPPER_HYPHEN_CASE

## Use

To run the generator use the following command:

    gen {generator name}
