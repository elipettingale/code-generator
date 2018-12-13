# Code Generator

## Install

Add the following alias to your bash_profile:

    alias gen='php ~/.composer/vendor/elipettingale/code-generator/run.php `pwd` $1'

Navigate to the installed directory and run the install script:

    cd ~/.composer/vendor/elipettingale/code-generator
    ./install.sh

## Use

To run the generator use the following command:

    gen {generator name}
