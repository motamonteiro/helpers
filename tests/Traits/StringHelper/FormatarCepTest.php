<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class FormatarCepTest extends TestCase
{
    use StringHelper;

    public function testFormatarValorSucesso()
    {
        $this->assertEquals($this->formatarCep('01234567'), '01234-567');
    }

    public function testFormatarTamanhoValorMenorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarCep('0123'), '0123#-###');
    }

    public function testFormatarTamanhoValorMaiorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarCep('01234567890'), '01234-567');
    }

    public function testFormatarValorVazio()
    {
        $this->assertEquals($this->formatarCep(''), '#####-###');
    }
}