<?php

use MotaMonteiro\Helpers\Traits\DataHelper;
use PHPUnit\Framework\TestCase;

class TraitDataHelperValidarDataFormatoBrTest extends TestCase
{
    use DataHelper;

    public function testValidarDataFormatoBrSucesso()
    {
        $this->assertTrue($this->validarDataFormatoBr('21/10/1982'));
    }

    public function testValidarDataFormatoBrInvalido()
    {
        $this->assertFalse($this->validarDataFormatoBr('21/13/1982'));
    }

    public function testValidarDataFormatoBrCaracteresInvalidos()
    {
        $this->assertFalse($this->validarDataFormatoBr('21-10-1982'));
    }

    public function testValidarDataFormatoBrStringVazia()
    {
        $this->assertFalse($this->validarDataFormatoBr(''));
    }
}