<?php

require_once __DIR__ . '/../vendor/autoload.php';

$util = new \MotaMonteiro\Helpers\UtilHelper();

echo ($util->validarCpf('32878192834')) ? 'valido' : 'invalido';