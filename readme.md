[![Build Status](https://travis-ci.org/motamonteiro/helpers.svg?branch=master)](https://travis-ci.org/motamonteiro/helpers)
[![Coverage Status](https://coveralls.io/repos/github/motamonteiro/helpers/badge.svg)](https://coveralls.io/github/motamonteiro/helpers)
[![Total Downloads](https://poser.pugx.org/motamonteiro/helpers/downloads)](https://packagist.org/packages/motamonteiro/helpers)
[![Latest Stable Version](https://poser.pugx.org/motamonteiro/helpers/v/stable)](https://packagist.org/packages/motamonteiro/helpers)
[![License](https://poser.pugx.org/motamonteiro/helpers/license)](https://packagist.org/packages/motamonteiro/helpers)

# helpers

O pacote helpers disponibiliza funcionalidades comuns que podem ser usadas em qualquer projeto PHP 7.

## Instalação

```sh
$ composer require motamonteiro/helpers

```

## Utilização com  `traits`

```php
use MotaMonteiro\Helpers\Traits\UtilHelper;
 
class MyClass
{
    use UtilHelper;
    
    public function myFunction()
    {
        $cpf = '43354377224';
        if ($this->validarCpf($cpf)) {
            ...
        }
    }
    
    public function myOtherFunction()
    {
        $data = '21/10/1982';
        if ($this->validarDataFormatoBr($data)) {
            ...
        }
    }
}
```

## Utilização com `classes`

```php
use MotaMonteiro\Helpers\UtilHelper;
 
class MyClass
{
    public function myFunction()
    {
        $util = new UtilHelper();
        
        $cpf = '43354377224';
        if ($util->validarCpf($cpf))
        {
            ...
        }
    }
}
```

## Teste

Para efetuar os testes basta executar o comando abaixo no terminal:

```sh
$ ./vendor/bin/phpunit
```

Exemplo de saída:

```
PHPUnit 5.7.21 by Sebastian Bergmann and contributors.

Runtime:       PHP 7.1.6 with Xdebug 2.5.4
Configuration: /Users/alexandre/Documents/github/motamonteiro/helpers/phpunit.xml

..........................                                        26 / 26 (100%)

Time: 411 ms, Memory: 6.00MB

OK (26 tests, 26 assertions)

Generating code coverage report in Clover XML format ... done

```

## Package

https://packagist.org/packages/motamonteiro/helpers

## Licença

MIT License

Copyright (c) 2017 

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all
copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
SOFTWARE.
