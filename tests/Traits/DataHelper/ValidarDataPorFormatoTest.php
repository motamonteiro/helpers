<?php

use MotaMonteiro\Helpers\Traits\DataHelper;
use PHPUnit\Framework\TestCase;

class ValidarDataPorFormatoTest extends TestCase
{
    use DataHelper;

    public function testValidarDataPorFormatoSucesso()
    {
        $this->assertTrue($this->validarDataPorFormato('21/10/1982', $this->FORMATO_DATA_BR));
    }

    public function testValidarDataPorFormatoInvalido()
    {
        $this->assertFalse($this->validarDataPorFormato('22/10/1982', $this->FORMATO_DATA_HORA_BR));
    }

    public function testValidarDataPorFormatoCaracteresInvalidos()
    {
        $this->assertFalse($this->validarDataPorFormato('21-10-1982', $this->FORMATO_DATA_BR));
    }

    public function testValidarDataPorFormatoStringDataVazia()
    {
        $this->assertFalse($this->validarDataPorFormato('', $this->FORMATO_DATA_HORA_BR));
    }

    public function testValidarDataPorFormatoStringFormatoVazia()
    {
        $this->assertFalse($this->validarDataPorFormato('21/10/1982', ''));
    }
}