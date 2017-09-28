<?php

use MotaMonteiro\Helpers\Traits\DataHelper;
use PHPUnit\Framework\TestCase;

class ValidarDataHoraFormatoBrTest extends TestCase
{
    use DataHelper;

    public function testValidarDataHoraFormatoBrSucesso()
    {
        $this->assertTrue($this->validarDataHoraFormatoBr('21/10/1982 08:00:00'));
    }

    public function testValidarDataHoraFormatoBrInvalido()
    {
        $this->assertFalse($this->validarDataHoraFormatoBr('21/13/1982 08:00:00'));
    }

    public function testValidarDataHoraFormatoBrCaracteresInvalidos()
    {
        $this->assertFalse($this->validarDataHoraFormatoBr('21-10-1982 08:00:00'));
    }

    public function testValidarDataHoraFormatoBrStringVazia()
    {
        $this->assertFalse($this->validarDataHoraFormatoBr(''));
    }
}