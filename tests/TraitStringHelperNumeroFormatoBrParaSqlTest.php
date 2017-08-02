<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class TraitStringHelperNumeroFormatoBrParaSqlTest extends TestCase
{
    use StringHelper;

    public function testNumeroComCasaDeMilharComCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoBrParaSql('12.345.678,00') === '12345678.00');
    }

    public function testNumeroComCasaDeMilharSemCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoBrParaSql('012.345.678') === '012345678');
    }

    public function testNumeroSemCasaDeMilharComCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoBrParaSql('12345678,00') === '12345678.00');
    }

    public function testNumeroSemCasaDeMilharSemCasaDecimal()
    {
        $this->assertTrue($this->numeroFormatoBrParaSql('12345678') === '12345678');
    }

    public function testNumeroInvalido()
    {
        $this->assertFalse($this->numeroFormatoBrParaSql('12 345678'));
    }

}