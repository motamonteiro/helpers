<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperFormatarCpfTest extends TestCase
{
    use StringHelper;

    public function testFormatarValorSucesso()
    {
        $this->assertEquals($this->formatarCpf('01234567890'), '012.345.678-90');
    }

    public function testFormatarTamanhoValorMenorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarCpf('012345678'), '012.345.678-##');
    }

    public function testFormatarTamanhoValorMaiorQueTamanhoFormato()
    {
        $this->assertEquals($this->formatarCpf('01234567890123'), '012.345.678-90');
    }

    public function testFormatarValorVazio()
    {
        $this->assertEquals($this->formatarCpf(''), '###.###.###-##');
    }
}