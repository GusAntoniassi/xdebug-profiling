<?php

function ola()
{
    echo 'Olá mundo!<br/>';
}

function calc() {
    for ($i = 0; $i < 8000; $i++) {
        sqrt(sqrt(sqrt(sqrt(3.14))));
    }
}

function slow() {
    for ($i = 0; $i < 10; $i++) {
        calc();
    }
}

function tchau() {
    echo 'Até mais!<br/>';
}

ola();
calc();
slow();
tchau();