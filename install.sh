#!/usr/bin/env bash

composer install
mkdir ~/.code_generation
echo "{}" > ~/.code_generation/map.json
mkdir ~/.code_generation/profiles
