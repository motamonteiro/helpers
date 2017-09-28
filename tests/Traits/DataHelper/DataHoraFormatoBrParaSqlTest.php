<?php

use MotaMonteiro\Helpers\Traits\DataHelper;
use PHPUnit\Framework\TestCase;

class DataHoraFormatoBrParaSqlTest extends TestCase
{
    use DataHelper;

    public function testStringSucesso()
    {
        //todo refatorar o nome do metodo de dataHoraBrParaSql para dataHoraFormatoBrParaSql
        $this->assertTrue($this->dataHoraBrParaSql('21/10/1982 23:59:59') == '1982-10-21 23:59:59');
    }

    public function testFormatoBrInvalido()
    {
        $this->assertFalse($this->dataHoraBrParaSql('1982-10-21 23:59:59'));
    }


    public function testStringVazia()
    {
        $this->assertFalse($this->dataHoraBrParaSql(''));
    }
}