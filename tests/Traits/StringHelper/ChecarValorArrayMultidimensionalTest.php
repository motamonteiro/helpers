<?php

use MotaMonteiro\Helpers\Traits\StringHelper;
use PHPUnit\Framework\TestCase;

class ChecarValorArrayMultidimensionalTest extends TestCase
{
    use StringHelper;

    public function testChecarIdComValorDoisSucesso()
    {
        $data = [
            ['id' => '1', 'name' => 'John'],
            ['id' => '2', 'name' => 'Ana'],

        ];
        $this->assertTrue($this->checarValorArrayMultidimensional('id', '2', $data));
    }

    public function testChecarIdComValorTresNaoEncontrado()
    {
        $data = [
            ['id' => '1', 'name' => 'John'],
            ['id' => '2', 'name' => 'Ana'],

        ];
        $this->assertFalse($this->checarValorArrayMultidimensional('id', '3', $data));
    }

    public function testChecarComKeyInexistente()
    {
        $data = [
            ['id' => '1', 'name' => 'John'],
            ['id' => '2', 'name' => 'Ana'],

        ];
        $this->assertFalse($this->checarValorArrayMultidimensional('ident', '1', $data));
    }
}