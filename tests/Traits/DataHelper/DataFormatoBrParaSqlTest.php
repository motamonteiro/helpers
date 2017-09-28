<?php

use MotaMonteiro\Helpers\Traits\DataHelper;
use PHPUnit\Framework\TestCase;

class DataFormatoBrParaSqlTest extends TestCase
{
    use DataHelper;

    public function testStringSucesso()
    {
        $this->assertTrue($this->dataFormatoBrParaSql('21/10/1982') == '1982-10-21');
    }

    public function testFormatoBrInvalido()
    {
        $this->assertFalse($this->dataFormatoBrParaSql('1982-10-21'));
    }


    public function testStringVazia()
    {
        $this->assertFalse($this->dataFormatoBrParaSql(''));
    }
}