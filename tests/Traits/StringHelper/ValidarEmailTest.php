<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class ValidarEmailTest extends TestCase
{
    use StringHelper;

    public function testValidarEmailSucesso()
    {
        $teste = 'aaa@aaa.com';

        $this->assertTrue($this->validarEmail($teste));
    }

    public function testValidarEmailComUnderlineSucesso()
    {
        $teste = 'a_a@aaa.com';

        $this->assertTrue($this->validarEmail($teste));
    }

    public function testValidarEmailMaiusculasMinusculasSucesso()
    {
        $teste = 'aAa@aaa.com';

        $this->assertTrue($this->validarEmail($teste));
    }

    public function testValidarEmailStringVazia()
    {
        $teste = '';

        $this->assertFalse($this->validarEmail($teste));
    }

    public function testValidarEmailNomeComMenosdeDoisCaracteres()
    {
        $teste = 'aa@aaa.com';

        $this->assertFalse($this->validarEmail($teste));
    }

    public function testValidarEmailDominioComMenosdeDoisCaracteres()
    {
        $teste = 'aaa@aa.com';

        $this->assertFalse($this->validarEmail($teste));
    }

    public function testValidarEmailCaracteresEspeciais()
    {
        $teste = 'a*a@aa.com';

        $this->assertFalse($this->validarEmail($teste));
    }

}