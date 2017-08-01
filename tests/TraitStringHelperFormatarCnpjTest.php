<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperFormatarCnpjTest extends TestCase
{
    use StringHelper;

    public function testFormatarValorSucesso()
    {
        $this->assertEquals($this->formatarCnpj('01234567890123'), '01.234.567/8901-23');
    }

    public function testFormatarTamanhoValorMenorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarCnpj('01234567890'), '01.234.567/890#-##');
    }

    public function testFormatarTamanhoValorMaiorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarCnpj('01234567890123456'), '01.234.567/8901-23');
    }

    public function testFormatarValorVazio()
    {
        $this->assertEquals($this->formatarCnpj(''), '##.###.###/####-##');
    }
}