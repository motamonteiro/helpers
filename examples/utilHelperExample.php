<?php

use MotaMonteiro\Helpers\UtilHelper;

require_once __DIR__ . '/../vendor/autoload.php';

$util = new UtilHelper();

echo ($util->validarCpf('32878192834')) ? 'valido' : 'invalido';