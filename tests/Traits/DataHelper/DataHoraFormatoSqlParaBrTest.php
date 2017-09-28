<?php

use MotaMonteiro\Helpers\Traits\DataHelper;
use PHPUnit\Framework\TestCase;

class DataHoraFormatoSqlParaBrTest extends TestCase
{
    use DataHelper;

    public function testStringComHifenSucesso()
    {
        $this->assertTrue($this->dataHoraFormatoSqlParaBr('1982-10-21 23:59:59') == '21/10/1982 23:59:59');
    }

    public function testStringSemHifenSucesso()
    {
        $this->assertTrue($this->dataHoraFormatoSqlParaBr('19821021235959') == '21/10/1982 23:59:59');
    }

    public function testFormatoBrInvalido()
    {
        $this->assertFalse($this->dataHoraFormatoSqlParaBr('21/10/1982 23:59:59'));
    }


    public function testStringVazia()
    {
        $this->assertFalse($this->dataHoraFormatoSqlParaBr(''));
    }
}