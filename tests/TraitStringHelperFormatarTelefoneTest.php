<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperFormatarTelefoneTest extends TestCase
{
    use StringHelper;

    public function testFormatarTelefoneSimples()
    {
        $this->assertEquals($this->formatarTelefone('01234567'), '0123-4567');
    }

    public function testFormatarTelefoneDdd()
    {
        $this->assertEquals($this->formatarTelefone('0123456789'), '(01) 2345-6789');
    }

    public function testFormatarTelefoneCelular()
    {
        $this->assertEquals($this->formatarTelefone('01234567890'), '(01) 23456-7890');
    }

    public function testFormatarTelefoneVazio()
    {
        $this->assertEquals($this->formatarTelefone(''), '####-####');
    }
}