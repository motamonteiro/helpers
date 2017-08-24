<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class FiltrarSomenteNumerosTest extends TestCase
{
    use StringHelper;

    public function testFiltrarSomenteNUmerosStringLetrasComNumeros()
    {
        $teste = 'a1b2c3d4';

        $this->assertTrue($this->filtrarSomenteNumeros($teste) == '1234');
    }

    public function testFiltrarSomenteNUmerosStringNumeros()
    {
        $teste = '1234';

        $this->assertTrue($this->filtrarSomenteNumeros($teste) == '1234');
    }

    public function testFiltrarSomenteNUmerosStringNumerosDecimaisFormatoSql()
    {
        $teste = '12.34';

        $this->assertTrue($this->filtrarSomenteNumeros($teste) == '1234');
    }

    public function testFiltrarSomenteNUmerosStringNumerosDecimaisFormatoBr()
    {
        $teste = '12,34';

        $this->assertTrue($this->filtrarSomenteNumeros($teste) == '1234');
    }

    public function testFiltrarSomenteNUmerosStringVazia()
    {
        $teste = '';

        $this->assertTrue($this->filtrarSomenteNumeros($teste) == '');
    }

    public function testFiltrarSomenteNUmerosValorInteiro()
    {
        $teste = 1234;

        $this->assertTrue($this->filtrarSomenteNumeros($teste) == '1234');
    }

    public function testFiltrarSomenteNUmerosValorDecimal()
    {
        $teste = 12.34;

        $this->assertTrue($this->filtrarSomenteNumeros($teste) == '1234');
    }


}