<?php

use MotaMonteiro\Helpers\Traits\DataHelper;
use PHPUnit\Framework\TestCase;

class DataFormatoSqlParaBrTest extends TestCase
{
    use DataHelper;

    public function testStringComHifenSucesso()
    {
        $this->assertTrue($this->dataFormatoSqlParaBr('1982-10-21') == '21/10/1982');
    }

    public function testStringSemHifenSucesso()
    {
        $this->assertTrue($this->dataFormatoSqlParaBr('19821021') == '21/10/1982');
    }

    public function testFormatoBrInvalido()
    {
        $this->assertFalse($this->dataFormatoSqlParaBr('21/10/1982'));
    }


    public function testStringVazia()
    {
        $this->assertFalse($this->dataFormatoSqlParaBr(''));
    }
}