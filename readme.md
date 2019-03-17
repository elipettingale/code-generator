# Code Generator

## Install

Add the following alias to your bash_profile:

    alias gen='php {path to composer}/vendor/elipettingale/code-generator/run.php `pwd` $1'

Navigate to the installed directory and run the install script:

    cd {path to composer}/vendor/elipettingale/code-generator
    ./install.sh

## Use

To run the generator use the following command:

    gen {generator name}


This will look for a generator with that name, scan it's stubs for parameters and then prompt you to enter them. After that the files will be generated with the defined parameters.

## Profiles

Profiles allow you to define multiple setups for generating code. When a generator is run for the first time you will be prompted to select a profile, this profile will then be used from now on when in that directory. 

To define a profile create a new directory in the 'profiles' folder. Inside that include a profile.json file and your stubs. And example profile.json file is included below:

    {
    	"name": "Laravel Modules",
    	"generators": [
    		{
    			"name": "entity-with-presenter",
    			"stubs": [
    				{
    					"name": "entity-with-presenter",
    					"path": "entity/entity-with-presenter.stub",
    					"target": {
    						"directory": "Modules/$MODULE_UPPER_CAMEL_CASE$/Entities",
    						"file_name": "$ENTITY_UPPER_CAMEL_CASE$.php"
    					}
    				},
    				{
    					"name": "presenter",
    					"path": "entity/presenter.stub",
    					"target": {
    						"directory": "Modules/$MODULE_UPPER_CAMEL_CASE$/Presenters",
    						"file_name": "$ENTITY_UPPER_CAMEL_CASE$Presenter.php"
    					}
    				}
    			]
    		}
    	]
    }

## Stubs

Stubs are templates that are used to generate files. They are located within a 'stubs' directory within each 'profile'. Within these files you can define parameters that are filled in when the stub is generated. You can define parameters as follows:

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
