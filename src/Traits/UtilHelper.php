<?php

namespace MotaMonteiro\Helpers\Traits;


trait UtilHelper
{
    use DataHelper;

    /**
     * Validar se o e-mail é válido ou não.
     *
     * @param string $email
     * @return bool
     */
    public function validarEmail($email)
    {
        if (preg_match("/^([[:alnum:]_.-]){3,}@([[:lower:][:digit:]_.-]{3,})(\.[[:lower:]]{2,3})(\.[[:lower:]]{2})?$/", $email)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Validar se o cpf é válido ou não.
     *
     * @param string $cpf
     * @return bool
     */
    public function validarCpf($cpf)
    {
        //Retira possível mascara
        $cpf = preg_replace('/[^0-9]/', '', (string) $cpf);

        //Valida tamanho
        if (strlen($cpf) != 11) {
            return false;
        }

        //Valida números iguais
        for ($i = 0; $i <= 10; $i++) {
            if ($cpf == str_repeat($i, 11)) {
                return false;
            }
        }

        //Primeiro dígito verificador
        for ($i = 0, $j = 10, $soma = 0; $i < 9; $i++, $j--) {
            $soma += $cpf{$i} * $j;
        }

        $resto = $soma % 11;
        if ($cpf{9} != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        //Segundo dígito verificador
        for ($i = 0, $j = 11, $soma = 0; $i < 10; $i++, $j--) {
            $soma += $cpf{$i} * $j;
        }

        $resto = $soma % 11;
        return $cpf{10} == ($resto < 2 ? 0 : 11 - $resto);
    }

    /**
     * Validar se o cnpj é válido ou não.
     *
     * @param string $cnpj
     * @return bool
     */
    public function validarCnpj($cnpj)
    {
        //Retira possível mascara
        $cnpj = preg_replace('/[^0-9]/', '', (string) $cnpj);

        //Valida tamanho
        if (strlen($cnpj) != 11) {
            return false;
        }

        //Valida números iguais
        for ($i = 0; $i <= 10; $i++) {
            if ($cnpj == str_repeat($i, 14)) {
                return false;
            }
        }

        //Primeiro dígito verificador
        for ($i = 0, $j = 5, $soma = 0; $i < 12; $i++) {
            $soma += $cnpj{$i} * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $resto = $soma % 11;
        if ($cnpj{12} != ($resto < 2 ? 0 : 11 - $resto)) {
            return false;
        }

        //Segundo dígito verificador
        for ($i = 0, $j = 6, $soma = 0; $i < 13; $i++)
        {
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
        $inscricaoEstadual = preg_replace('/[^0-9]/', '', (string) $inscricaoEstadual);

        //Valida tamanho
        if (strlen($inscricaoEstadual) != 9) {
            return false;
        }

        //Valida números iguais
        for ($i = 0; $i <= 10; $i++) {
            if ($inscricaoEstadual == str_repeat($i, 9)) {
                return false;
            }
        }

        return true;
    }


    /**
     * Converter um numero de um formato '12.345.678,00' para um formato '12345678.00'.
     *
     * @param string $numero
     * @return bool|mixed
     */
    public function numeroFormatoBrParaSql($numero)
    {
        $numero = str_replace(".", "", $numero);
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
     * @return bool|string
     */
    public function numeroFormatoSqlParaBr($numero)
    {
        //Retira espaços
        $numero = trim($numero);

        //Retira separador de milhar com a virgula
        $numero = str_replace(",", "", $numero);

        //Se não tiver ponto
        if (strpos($numero, '.') === false) {
            return (is_numeric($numero)) ? number_format($numero, 0, ",",".") : false;
        }

        return (is_numeric($numero)) ? number_format($numero, 2, ",",".") : false;
    }


    /**
     * Converter um numero de um formato '12345678' para um formato '12.345.678,00' sempre com casas decimais.
     *
     * @param $numero
     * @return bool|string
     */
    public function numeroFormatoSqlParaMoedaBr($numero)
    {
        //Retira espaços
        $numero = trim($numero);

        //Retira separador de milhar com a virgula
        $numero = str_replace(",", "", $numero);

        return (is_numeric($numero)) ? number_format($numero, 2, ",",".") : false;
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
     * Html
     *
     */
    public function imprimirSrcImagem($type, $file)
    {
        return 'data:' . $type . ';base64,' . $file;
    }



    /**
     * Função para formatar o valor de acordo com a mascara passada.
     * @param string $valor Valor a ser formatado.
     * @param string $mascara Nome da formatacao que sera aplicada. Valores validos: "moeda", "inteiro", "cpf", "telefone", "telefoneSimples", "data", "referencia", "cep" e "placa".
     * @return string Retorna o valor formatado de acordo com a mascara.
     * @author by Alexandre Mota Monteiro
     * @version 16/09/2013 13:00
     */
    public function mascara($valor, $mascara) {

        if(trim($valor) == '') return '';

        $nmeMascara = $mascara;
        switch ($mascara) {
            case "moeda":
                $valor = str_replace(".", ",", $valor);
                $valor = str_replace(",", ".", $valor);
                if (($valor != "") && (is_numeric($valor))) {
                    return number_format($valor, 2, ",",".");
                } else {
                    return "Valor vazio ou não numérico";
                }
                break;
            case "vrte":
                $valor = str_replace(".", ",", $valor);
                $valor = str_replace(",", ".", $valor);
                if (($valor != "") && (is_numeric($valor))) {
                    return number_format($valor, 4, ",",".");
                } else {
                    return "Valor vazio ou não numérico";
                }
                break;
            case "inteiro":
                if (($valor != "") && (is_numeric($valor))) {
                    return number_format($valor, 0, ",",".");
                } else {
                    return "Valor vazio ou não numérico";
                }
                break;
            case "inteiroK":
                if (($valor != "") && (is_numeric($valor))) {

                    if ($valor > 10000) {
                        $valor = round($valor/1000, 1). "K";
                    }

                    return $valor;
                } else {
                    return "Valor vazio ou não numérico";
                }
                break;
            case "ieCpfCnpj":
                $valor = limparMascara($valor);
                if (validarCpf($valor)) {
                    $mascara = "###.###.###-##";
                }elseif (validarCnpj($valor)) {
                    $mascara = "##.###.###/####-##";
                } else {
                    $mascara = "###.###.##-#";
                }
                break;
            case "cpf":
                $mascara = "###.###.###-##";
                break;
            case "cnpj":
                $mascara = "##.###.###/####-##";
                break;
            case "ie":
                $mascara = "###.###.##-#";
                break;
            case "telefone":
                $mascara = "(##)####-####";
                break;
            case "telefoneSimples":
                $mascara = "####-####";
                break;
            case "data":
                $mascara = "##/##/####";
                break;
            case "referencia":
                $mascara = "##/####";
                break;
            case "cep":
                $mascara = "#####-###";
                break;
            case "placa":
                $mascara = "###-####";
                break;
        }

        //Verifica se o número de caracteres do valor é igual ao numero de caracteres da mascara.
        if (strlen($valor) != substr_count($mascara, "#")) {
            return "Tamanho(". strlen($valor) .") invalido para a máscara ".$nmeMascara." escolhida(". substr_count($mascara, "#") .").";
        }
        $j = 0;
        $valorFormatado = "";
        for ($i = 0; $i < strlen($mascara); $i++) {
            if (substr($mascara, $i, 1) == "#") {
                $valorFormatado .= substr($valor, $j, 1);
                $j++;
            } else {
                $valorFormatado .= substr($mascara, $i, 1);
            }
        }
        $valorFormatado = strtoupper($valorFormatado);
        return $valorFormatado;
    }

    /**
     * Função para limpar as mascaras inseridas pela funcao "mascara($valor, $mascara)".
     * @param string $valorFormatado Valor formatado.
     * @return string Retorna o valor sem a nenhum caracter utulizado na funcao mascara: ".", "-", "/", "(", ")"
     * @author by Alexandre Mota Monteiro
     * @version 16/09/2013 13:00
     */
    public function limparMascara($valorFormatado) {

        $valor = $valorFormatado;
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("-", "", $valor);
        $valor = str_replace("(", "", $valor);
        $valor = str_replace(")", "", $valor);
        $valor = str_replace("/", "", $valor);

        return $valor;
    }



}