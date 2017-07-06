<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperValidaCnpjTest extends TestCase
{
    use StringHelper;

    public function testValidaCnpjSucesso()
    {
        $cnpj = '74456225000193';

        $this->assertTrue($this->validarCnpj($cnpj));
    }

    public function testValidaCnpjComMascara()
    {
        $cnpj = '74.456.225/0001-93';

        $this->assertTrue($this->validarCnpj($cnpj));
    }

    public function testValidaCnpjQtdeDigitosInvalida()
    {
        $cnpj = '0000000000000';

        $this->assertFalse($this->validarCnpj($cnpj));
    }

    public function testValidaCnpjDigitosIguais()
    {
        $cnpj = '00000000000000';

        $this->assertFalse($this->validarCnpj($cnpj));
    }

    public function testValidaCnpjCaracteresInvalidos()
    {
        $cnpj = 'a';

        $this->assertFalse($this->validarCnpj($cnpj));
    }

    public function testValidaCnpjStringVazia()
    {
        $cnpj = '';

        $this->assertFalse($this->validarCnpj($cnpj));
    }
}