<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperFormatarValorTest extends TestCase
{
    use StringHelper;

    private $MASCARA = '###.###';

    public function testFormatarValorSucesso()
    {
        $this->assertEquals($this->formatarValor('123456', $this->MASCARA), '123.456');
    }

    public function testFormatarTamanhoValorMenorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarValor('12345', $this->MASCARA), '123.45#');
    }

    public function testFormatarTamanhoValorMaiorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarValor('1234567', $this->MASCARA), '123.456');
    }

    public function testFormatarValorVazio()
    {
        $this->assertEquals($this->formatarValor('', $this->MASCARA), $this->MASCARA);
    }
}