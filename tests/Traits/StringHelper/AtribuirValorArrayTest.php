<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class AtribuirValorArrayTest extends TestCase
{
    use StringHelper;

    public function testAtribuirKeysAindaNaoExistentes()
    {
        $chaves = ['id', 'name', 'age'];
        $array = ['name' => 'Ana'];
        $array = $this->atribuirValorArray($array, $chaves);
        $arrayEsperado = ['id' => '', 'name' => 'Ana', 'age' => ''];

        $this->assertEquals($array, $arrayEsperado);
    }
}