<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperValidaCpfTest extends TestCase
{
    use StringHelper;

    public function testValidaCpfSucesso()
    {
        $cpf = '43354377224';

        $this->assertTrue($this->validarCpf($cpf));
    }

    public function testValidaCpfComMascara()
    {
        $cpf = '433.543.772-24';

        $this->assertTrue($this->validarCpf($cpf));
    }

    public function testValidaCpfQtdeDigitosInvalida()
    {
        $cpf = '0000000000';

        $this->assertFalse($this->validarCpf($cpf));
    }

    public function testValidaCpfDigitosIguais()
    {
        $cpf = '00000000000';

        $this->assertFalse($this->validarCpf($cpf));
    }

    public function testValidaCpfCaracteresInvalidos()
    {
        $cpf = 'a';

        $this->assertFalse($this->validarCpf($cpf));
    }
}