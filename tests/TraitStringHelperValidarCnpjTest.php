<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperValidarCnpjTest extends TestCase
{
    use StringHelper;

    public function testValidarCnpjSucesso()
    {
        $cnpj = '74456225000193';

        $this->assertTrue($this->validarCnpj($cnpj));
    }

    public function testValidarCnpjInvalido()
    {
        $cnpj = '14456225000193';

        $this->assertFalse($this->validarCnpj($cnpj));
    }

    public function testValidarCnpjComMascara()
    {
        $cnpj = '74.456.225/0001-93';

        $this->assertTrue($this->validarCnpj($cnpj));
    }

    public function testValidarCnpjQtdeDigitosInvalida()
    {
        $cnpj = '0000000000000';

        $this->assertFalse($this->validarCnpj($cnpj));
    }

    public function testValidarCnpjDigitosIguais()
    {
        $cnpj = '00000000000000';

        $this->assertFalse($this->validarCnpj($cnpj));
    }

    public function testValidarCnpjCaracteresInvalidos()
    {
        $cnpj = 'a';

        $this->assertFalse($this->validarCnpj($cnpj));
    }

    public function testValidarCnpjStringVazia()
    {
        $cnpj = '';

        $this->assertFalse($this->validarCnpj($cnpj));
    }
}