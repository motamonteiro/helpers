<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperFormatarIeTest extends TestCase
{
    use StringHelper;

    public function testFormatarValorSucesso()
    {
        $this->assertEquals($this->formatarIe('012345678'), '012.345.67-8');
    }

    public function testFormatarTamanhoValorMenorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarIe('0123456'), '012.345.6#-#');
    }

    public function testFormatarTamanhoValorMaiorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarIe('012345678901'), '012.345.67-8');
    }

    public function testFormatarValorVazio()
    {
        $this->assertEquals($this->formatarIe(''), '###.###.##-#');
    }
}