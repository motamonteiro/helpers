<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperValidarIeTest extends TestCase
{
    use StringHelper;

    public function testValidarIeSucesso()
    {
        $ie = '080123456';

        $this->assertTrue($this->validarIe($ie));
    }

    public function testValidarIeInvalido()
    {
        $ie = '0801234567';

        $this->assertFalse($this->validarIe($ie));
    }

    public function testValidarIeComMascara()
    {
        $ie = '080.123.45-6';

        $this->assertTrue($this->validarIe($ie));
    }

    public function testValidarIeQtdeDigitosInvalida()
    {
        $ie = '000000000';

        $this->assertFalse($this->validarIe($ie));
    }

    public function testValidarIeDigitosIguais()
    {
        $ie = '000000000';

        $this->assertFalse($this->validarIe($ie));
    }

    public function testValidarIeCaracteresInvalidos()
    {
        $ie = 'a';

        $this->assertFalse($this->validarIe($ie));
    }

    public function testValidarIeStringVazia()
    {
        $ie = '';

        $this->assertFalse($this->validarIe($ie));
    }
}