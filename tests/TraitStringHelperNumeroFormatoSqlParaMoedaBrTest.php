<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperNumeroFormatoSqlParaMoedaBrTest extends TestCase
{
    use StringHelper;

    public function testNumeroComCasaDeMilharComCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoSqlParaMoedaBr('12,345,678.00') === '12.345.678,00');
    }

    public function testNumeroComCasaDeMilharSemCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoSqlParaMoedaBr('12,345,678') === '12.345.678,00');
    }

    public function testNumeroSemCasaDeMilharComCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoSqlParaMoedaBr('12345678.00') === '12.345.678,00');
    }

    public function testNumeroSemCasaDeMilharSemCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoSqlParaMoedaBr('12345678') === '12.345.678,00');
    }

    public function testNumeroInvalido()
    {
        $this->assertFalse($this->numeroFormatoSqlParaMoedaBr('12 345678'));
    }

}