<?php

namespace MotaMonteiro\Helpers\Traits;


trait StringHelper
{
    /**
     * Retornar somente os números de uma determinada string
     *
     * @param $string
     * @return mixed
     */
    public function filtrarSomenteNumeros($string)
    {
        return preg_replace('/[^0-9]/', '', (string)$string);
    }

    /**
     * Validar se o e-mail é válido ou não.
     *
     * @param $email
     * @return bool
     */
    public function validarEmail($email)
    {
        return (preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(\.[[:lower:]]{2,3})(\.[[:lower:]]{2})?$/",
                $email) == 1);
    }

    /**
     * Validar se o cpf é válido ou não.
     *
     * @param string $cpf
     * @return bool
     */
    public function validarCpf($cpf)
    {
        $cpf = $this->filtrarSomenteNumeros($cpf);

        // Valida tamanho e caracteres repetidos 00000000000, 11111111111, ..., 99999999999
        if ((strlen($cpf) != 11) || (preg_match('/(\d)\1{10}/', $cpf))) {
            return false;
        }
        
        // Calcula os DVs para verificar se o CPF é verdadeiro
        for ($i = 9; $i < 11; $i++) {
            $j = 0;
            for ($k = 0; $k < $i; $k++) {
                $j += $cpf{$k} * (($i + 1) - $k);
            }
            $j = ((10 * $j) % 11) % 10;
            if ($cpf{$k} != $j) {
                return false;
            }
        }

        return true;
    }

    /**
     * Validar se o cnpj é válido ou não.
     *
     * @param string $cnpj
     * @return bool
     */
    public function validarCnpj($cnpj)
    {
        $cnpj = $this->filtrarSomenteNumeros($cnpj);

        // Valida tamanho e caracteres repetidos 00000000000000, 11111111111111, ..., 99999999999999
        if ((strlen($cnpj) != 14) || (preg_match('/(\d)\1{13}/', $cnpj))) {
            return false;
        }

        //Primeiro dígito verificador
        $soma = 0;
        $j = 5;
        for ($i = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        //Segundo dígito verificador
        $soma = 0;
        $j = 6;
        for ($i = 0; $i < 13; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;

        return $cnpj{13} == ($resto < 2 ? 0 : 11 - $resto);
    }

    /**
     * Validar se a inscrição estadual do Espírito Santo é válida ou não.
     *
     * @param string $inscricaoEstadual
     * @return bool
     */
    public function validarIe($inscricaoEstadual)
    {
        //Retira possível mascara
        $inscricaoEstadual = $this->filtrarSomenteNumeros($inscricaoEstadual);

        // Valida tamanho e caracteres repetidos 000000000, 111111111, ..., 999999999
        if ((strlen($inscricaoEstadual) != 9) || (preg_match('/(\d)\1{8}/', $inscricaoEstadual))) {
            return false;
        }

        return true;
    }

    /**
     * Converter um numero de um formato '12.345.678,00' para um formato '12345678.00'.
     *
     * @param string $numero
     * @return false|mixed
     */
    public function numeroFormatoBrParaSql($numero)
    {
        //Retira espaços
        $numero = trim($numero);

        //Retira separador de milhar com o ponto
        $numero = str_replace(".", "", $numero);

        //Substitui separador de decimal de virgula para ponto
        $numero = str_replace(",", ".", $numero);

        if (!is_numeric($numero)) {
            return false;
        }

        return $numero;
    }

    /**
     * Converter um numero de um formato '12345678.00' para um formato '12.345.678,00' com ou sem casas decimais.
     *
     * @param $numero
     * @return false|string
     */
    public function numeroFormatoSqlParaBr($numero)
    {
        //Retira espaços
        $numero = trim($numero);

        //Retira separador de milhar com a virgula
        $numero = str_replace(",", "", $numero);

        if (!is_numeric($numero)) {
            return false;
        }

        //Se não tiver ponto
        if (strpos($numero, '.') === false) {
            return number_format($numero, 0, ",", ".");
        }

        return number_format($numero, 2, ",", ".");
    }

    /**
     * Converter um numero de um formato '12345678' para um formato '12.345.678,00' sempre com casas decimais.
     *
     * @param $numero
     * @return false|string
     */
    public function numeroFormatoSqlParaMoedaBr($numero)
    {
        //Retira espaços
        $numero = trim($numero);

        //Retira separador de milhar com a virgula
        $numero = str_replace(",", "", $numero);

        if(!is_numeric($numero)){
            return false;
        }

        return number_format($numero, 2, ",", ".");
    }

    /**
     * Converter um numero de um formato '2345678,00' para um formato '12.345.678,00' sempre com casas decimais.
     *
     * @param string $numero
     * @return false|mixed
     */
    public function numeroFormatoBrParaMoedaBr($numero)
    {
        //Retira espaços
        $numero = trim($numero);

        //Retira separador de milhar com a virgula
        $numero = str_replace(".", "", $numero);

        //transforma para numero
        $numero = str_replace(",", ".", $numero);

        if(!is_numeric($numero)){
            return false;
        }
        return number_format($numero, 2, ",", ".");
    }

    /**
     * Checar se um valor existe em um array multidimensional
     *
     * @param string $key
     * @param string $value
     * @param array $array
     * @return bool
     */
    public function checarValorArrayMultidimensional($key, $value, array $array)
    {
        foreach ($array as $a) {
            if (isset($a[$key]) && $a[$key] == $value) {
                return true;
            }
        }
        return false;
    }

    /**
     * Setar chave do array caso não exista.
     * Ex.: $array['chave'] = (isset($array['chave'])) ? $array['chave'] : '';
     *
     * @param array $array
     * @param array $chaves
     * @return array
     */
    function atribuirValorArray(array $array, array $chaves)
    {
        $results = [];
        foreach ($chaves as $chave) {
            $results[$chave] = (isset($array[$chave])) ? $array[$chave] : '';
        }
        return $results;
    }

    /**
     * Converter um valor de acordo com o formato desejado. Exemplo de formato de cpf: '###.###.###-##'.
     *
     * @param string $valor
     * @param string $formato
     * @return string string
     */
    function formatarValor($valor, $formato)
    {
        $tamanhoValor = strlen($valor);
        $tamanhoFormato = substr_count($formato, '#');

        if ($tamanhoValor < $tamanhoFormato) {
            $diferenca = $tamanhoFormato - $tamanhoValor;
            $valor = $valor . str_repeat('#', $diferenca);
        }

        if ($tamanhoValor > $tamanhoFormato) {
            $valor = substr($valor, 0, $tamanhoFormato);
        }

        $formato = str_replace('#', '%s', $formato);
        return vsprintf($formato, str_split($valor));
    }

    /**
     * Converter um numero de Cpf '32878192834' para o formato '328.781.928-34'.
     *
     * @param $valor
     * @return string
     */
    function formatarCpf($valor)
    {
        return $this->formatarValor($valor, '###.###.###-##');
    }

    /**
     * Converter um numero de Cnpj '06178318000143' para o formato '06.178.318/0001-43'.
     *
     * @param $valor
     * @return string
     */
    function formatarCnpj($valor)
    {
        return $this->formatarValor($valor, '##.###.###/####-##');
    }

    /**
     * Converter um numero de Inscricao Estadual '080123456' para o formato '080.123.45-6'.
     *
     * @param $valor
     * @return string
     */
    function formatarIe($valor)
    {
        return $this->formatarValor($valor, '###.###.##-#');
    }

    /**
     * Converter um numero para os formatos de Inscricao Estadual, Cpf ou Cnpj, de acordo com o tamanho do parametro informado.
     *
     * @param $valor
     * @return string
     */
    function formatarIeCpfCnpj($valor)
    {
        if (strlen($valor) == 9) {
            return $this->formatarIe($valor);
        }

        if (strlen($valor) == 11) {
            return $this->formatarCpf($valor);
        }

        return $this->formatarCnpj($valor);
    }

    /**
     * Converter um numero para os formatos de telefone simples, telefone com ddd ou telefone celular, de acordo com o tamanho do parametro informado.
     *
     * @param $valor
     * @return string
     */
    function formatarTelefone($valor)
    {
        if (strlen($valor) < 10) {
            return $this->formatarValor($valor, '####-####');
        }

        if (strlen($valor) == 10) {
            return $this->formatarValor($valor, '(##) ####-####');
        }

        return $this->formatarValor($valor, '(##) #####-####');
    }

    /**
     * Converter um cep '29123456' para o formato '29123-456'
     *
     * @param $valor
     * @return string
     */
    function formatarCep($valor)
    {
        return $this->formatarValor($valor, '#####-###');
    }

    /**
     * Converter uma placa 'ABC1234' para o formato 'ABC-1234'
     *
     * @param $valor
     * @return string
     */
    function formatarPlaca($valor)
    {
        return $this->formatarValor($valor, '###-####');
    }

    /**
     * Html
     *
     */
    public function imprimirSrcImagem($type, $file)
    {
        return 'data:' . $type . ';base64,' . $file;
    }

}