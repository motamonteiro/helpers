<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class ValidarStringAcentuacaoTest extends TestCase
{
    use StringHelper;

    public function testRemoverAcentuacaoSucesso()
    {
        $string = 'áéíóúçÀÊÍÕÚÇ';

        $this->assertTrue($this->removerAcentuacao($string) == 'aeioucAEIOUC');
    }
}