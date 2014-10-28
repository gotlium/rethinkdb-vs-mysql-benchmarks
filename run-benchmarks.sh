#!/bin/bash

function run_bench() {
    echo ">>> $1"
    time php "./$1"

    echo ""
    echo "------"
    echo ""
}

cd src/

run_bench insert.php
run_bench select.php
run_bench group.php
run_bench selectGroup.php
