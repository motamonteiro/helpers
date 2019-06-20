<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class NumeroFormatoBrParaMoedaBrTest extends TestCase
{
    use StringHelper;

    public function testNumeroComCasaDeMilharComCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoBrParaMoedaBr('12.345.678,01') === '12.345.678,01');
    }

    public function testNumeroComCasaDeMilharSemCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoBrParaMoedaBr('12.345.678') === '12.345.678,00');
    }

    public function testNumeroSemCasaDeMilharComCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoBrParaMoedaBr('12345678,02') === '12.345.678,02');
    }

    public function testNumeroSemCasaDeMilharSemCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoBrParaMoedaBr('12345678') === '12.345.678,00');
    }

    public function testNumeroInvalido()
    {
        $this->assertFalse($this->numeroFormatoBrParaMoedaBr('12 345678'));
    }

}