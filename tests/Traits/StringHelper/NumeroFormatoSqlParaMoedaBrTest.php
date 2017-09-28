<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class NumeroFormatoSqlParaMoedaBrTest extends TestCase
{
    use StringHelper;

    public $VALOR_ESPERADO = '12.345.678,00';

    public function testNumeroComCasaDeMilharComCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoSqlParaMoedaBr('12,345,678.00') === $this->VALOR_ESPERADO);
    }

    public function testNumeroComCasaDeMilharSemCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoSqlParaMoedaBr('12,345,678') === $this->VALOR_ESPERADO);
    }

    public function testNumeroSemCasaDeMilharComCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoSqlParaMoedaBr('12345678.00') === $this->VALOR_ESPERADO);
    }

    public function testNumeroSemCasaDeMilharSemCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoSqlParaMoedaBr('12345678') === $this->VALOR_ESPERADO);
    }

    public function testNumeroInvalido()
    {
        $this->assertFalse($this->numeroFormatoSqlParaMoedaBr('12 345678'));
    }

}