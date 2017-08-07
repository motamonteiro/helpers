<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperValidarCpfTest extends TestCase
{
    use StringHelper;

    public function testValidarCpfSucesso()
    {
        $cpf = '43354377224';

        $this->assertTrue($this->validarCpf($cpf));
    }

    public function testValidarCpfInvalido()
    {
        $cpf = '43354377223';

        $this->assertFalse($this->validarCpf($cpf));
    }

    public function testValidarCpfComMascara()
    {
        $cpf = '433.543.772-24';

        $this->assertTrue($this->validarCpf($cpf));
    }

    public function testValidarCpfQtdeDigitosInvalida()
    {
        $cpf = '0000000000';

        $this->assertFalse($this->validarCpf($cpf));
    }

    public function testValidarCpfDigitosIguais()
    {
        $cpf = '00000000000';

        $this->assertFalse($this->validarCpf($cpf));
    }

    public function testValidarCpfCaracteresInvalidos()
    {
        $cpf = 'a';

        $this->assertFalse($this->validarCpf($cpf));
    }

    public function testValidarCpfStringVazia()
    {
        $cpf = '';

        $this->assertFalse($this->validarCpf($cpf));
    }
}