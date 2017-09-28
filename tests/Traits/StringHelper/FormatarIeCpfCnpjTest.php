<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class FormatarIeCpfCnpjTest extends TestCase
{
    use StringHelper;

    public function testFormatarIe()
    {
        $this->assertEquals($this->formatarIeCpfCnpj('012345678'), '012.345.67-8');
    }

    public function testFormatarCpf()
    {
        $this->assertEquals($this->formatarIeCpfCnpj('01234567890'), '012.345.678-90');
    }

    public function testFormatarCnpj()
    {
        $this->assertEquals($this->formatarIeCpfCnpj('01234567890123'), '01.234.567/8901-23');
    }

    public function testFormatarValorVazio()
    {
        $this->assertEquals($this->formatarIeCpfCnpj(''), '##.###.###/####-##');
    }
}