# helpers

O pacote helpers disponibiliza funcionalidades comuns que podem ser usadas em qualquer projeto PHP.

Existem 2 maneiras de se usar esse pacote:

## Instalação 1 - `traits`

```sh
$ composer require MotaMonteiro/helpers

```

```php
use MotaMonteiro\Helpers\Traits\StringHelper;
 
class MyClass
{
    use StringHelper;
    
    public function myFunction()
    {
        $cpf = '43354377224';
        if ($this->validarCpf($cpf))
        {
            ...
        }
    }
}
```

## Instalação 2 - `functions`

```sh
$ composer require MotaMonteiro/helpers

```

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
 
Runtime:       PHP 7.0.15 with Xdebug 2.5.0
Configuration: /Users/pablo/Documents/repositorios/github/fork/helpers/phpunit.xml
 
..........                                                        10 / 10 (100%)
 
Time: 401 ms, Memory: 6.00MB
 
OK (10 tests, 10 assertions)
 
Generating code coverage report in Clover XML format ... done
```

## Package

https://packagist.org/packages/MotaMonteiro/helpers

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
