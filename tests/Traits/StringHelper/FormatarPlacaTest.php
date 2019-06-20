<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class FormatarPlacaTest extends TestCase
{
    use StringHelper;

    public function testFormatarValorSucesso()
    {
        $this->assertEquals($this->formatarPlaca('ABC0123'), 'ABC-0123');
    }

    public function testFormatarTamanhoValorMenorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarPlaca('ABC012'), 'ABC-012#');
    }

    public function testFormatarTamanhoValorMaiorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarPlaca('ABC0123456'), 'ABC-0123');
    }

    public function testFormatarValorVazio()
    {
        $this->assertEquals($this->formatarPlaca(''), '###-####');
    }
}