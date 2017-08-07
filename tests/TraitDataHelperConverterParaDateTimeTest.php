<?php

use MotaMonteiro\Helpers\Traits\DataHelper;
use PHPUnit\Framework\TestCase;

class TraitDataHelperConverterParaDateTimeTest extends TestCase
{
    use DataHelper;

    public function testConverterParaDateTimeSucesso()
    {
        $data = $this->converterParaDateTime('21/10/1982', $this->FORMATO_DATA_BR);
        $this->assertTrue(($data instanceof \DateTime));
    }

    public function testConverterParaDateTimeInvalido()
    {
        $this->assertFalse($this->converterParaDateTime('21/12/1982', $this->FORMATO_DATA_HORA_BR));
    }

    public function testConverterParaDateTimeCaracteresInvalidos()
    {
        $this->assertFalse($this->converterParaDateTime('21-10-1982', $this->FORMATO_DATA_BR));
    }

    public function testConverterParaDateTimeStringVazia()
    {
        $this->assertFalse($this->converterParaDateTime('', $this->FORMATO_DATA_BR));
    }
}