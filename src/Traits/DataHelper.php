<?php

namespace MotaMonteiro\Helpers\Traits;


trait DataHelper
{
    public $FORMATO_DATA_BR = 'd/m/Y';
    public $FORMATO_DATA_HORA_BR = 'd/m/Y H:i:s';
    public $FORMATO_DATA_HORA_SQL = 'Y-m-d H:i:s';
    public $DATA_HORA_SQL_SEM_FORMATO = 'YmdHis';

    /**
     * Validar se uma data no formato 'd/m/Y' é válida ou nao.
     *
     * @param \DateTime|string $data
     * @return bool
     */
    public function validarDataFormatoBr($data)
    {
        return $this->validarDataPorFormato($data, $this->FORMATO_DATA_BR);
    }

    /**
     * Validar se uma data no formato 'd/m/Y H:i:s' é válida ou nao.
     *
     * @param \DateTime|string $data
     * @return bool
     */
    public function validarDataHoraFormatoBr($data)
    {
        return $this->validarDataPorFormato($data, $this->FORMATO_DATA_HORA_BR);
    }

    /**
     * Validar se uma data no formato informado é válida ou nao.
     *
     * @param \DateTime|string $data
     * @return bool
     */
    public function validarDataPorFormato($data, $formato)
    {
        $data = (!$data instanceof \DateTime) ? \DateTime::createFromFormat($formato, $data) : $data;
        if(!$data){
            return false;
        }
        return ($data->format($formato));
    }

    /**
     * Converter uma data de um formato origem para um formato destino.
     *
     * @param \DateTime|string $data
     * @param $formatoOrigem
     * @param $formatoDestino
     * @return false|string
     */
    public function dataFormatoOrigemDestino($data, $formatoOrigem, $formatoDestino)
    {
        $data = (!$data instanceof \DateTime) ? \DateTime::createFromFormat($formatoOrigem, $data) : $data;
        if(!$data){
            return false;
        }
        return ($data->format($formatoDestino));
    }

    /**
     * Converter uma data de um formato 'Ymd' ou 'Y-m-d' para um formato 'd/m/Y'.
     *
     * @param \DateTime|string $data
     * @return false|string
     */
    public function dataFormatoSqlParaBr($data)
    {
        if (gettype($data) == 'string') {
            $pos = strpos($data, '-');
            if ($pos === false) {
                return $this->dataFormatoOrigemDestino($data, 'Ymd', $this->FORMATO_DATA_BR);
            }
        }

        return $this->dataFormatoOrigemDestino($data, 'Y-m-d', $this->FORMATO_DATA_BR);
    }

    /**
     * Converter uma data de um formato 'YmdHis' ou 'Y-m-d H:i:s' para um formato 'd/m/Y H:i:s'.
     *
     * @param \DateTime|string $data
     * @return false|string
     */
    public function dataHoraFormatoSqlParaBr($data)
    {
        if (gettype($data) == 'string') {
            $pos = strpos($data, '-');
            if ($pos === false) {
                return $this->dataFormatoOrigemDestino($data, $this->DATA_HORA_SQL_SEM_FORMATO, $this->FORMATO_DATA_HORA_BR);
            }
        }

        return $this->dataFormatoOrigemDestino($data, $this->FORMATO_DATA_HORA_SQL, $this->FORMATO_DATA_HORA_BR);
    }

    /**
     * Converter uma data de um formato 'd/m/Y' para um formato 'Y-m-d'.
     *
     * @param \DateTime|string $data
     * @return false|string
     */
    public function dataFormatoBrParaSql($data)
    {
        return $this->dataFormatoOrigemDestino($data, $this->FORMATO_DATA_BR, 'Y-m-d');
    }

    /**
     * Converter uma data de um formato 'd/m/Y H:i:s' para um formato 'Y-m-d H:i:s'.
     *
     * @param \DateTime|string $data
     * @return false|string
     */
    public function dataHoraBrParaSql($data)
    {
        return $this->dataFormatoOrigemDestino($data, $this->FORMATO_DATA_HORA_BR, $this->FORMATO_DATA_HORA_SQL);
    }

    /**
     * Obter um intervalo entre datas do formato 'd/m/Y'.
     *
     * @param \DateTime|string $data1
     * @param \DateTime|string $data2
     * @return false|\DateInterval
     */
    public function intervaloEntreDatasBr($data1, $data2)
    {

        $data1 = (!$data1 instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_BR, $data1) : $data1;
        $data2 = (!$data2 instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_BR, $data2) : $data2;

        if ((!$data1) || (!$data2)) {
            return false;
        }

        return date_diff($data1, $data2);
    }

    /**
     * Obter um intervalo entre datas completas do formato 'd/m/Y H:i:s'.
     *
     * @param \DateTime|string $data1
     * @param \DateTime|string $data2
     * @return false|\DateInterval
     */
    public function intervaloEntreDatasHoraBr($data1, $data2)
    {

        $data1 = (!$data1 instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_HORA_BR, $data1) : $data1;
        $data2 = (!$data2 instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_HORA_BR, $data2) : $data2;

        if ((!$data1) || (!$data2)) {
            return false;
        }

        return date_diff($data1, $data2);
    }

    /**
     * Somar dias, meses ou anos de uma determinada data no formato 'd/m/Y'.
     *
     * @param \DateTime|string $data
     * @param int $dias
     * @param int $meses
     * @param int $anos
     * @param int $horas
     * @param int $mins
     * @param int $segs
     * @return string
     */
    public function somarDataFormatoBr($data, $dias=0, $meses=0, $anos=0, $horas=0, $mins=0, $segs=0)
    {

        $data = (!$data instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_BR, $data) : $data;

        if (!$data || !$data->format($this->FORMATO_DATA_BR)){
            return '01/01/1900';
        }

        $data = explode('/', $data->format($this->FORMATO_DATA_BR));
        return date($this->FORMATO_DATA_BR, mktime($horas, $mins, $segs, $data[1] + $meses, $data[0] + $dias, $data[2] + $anos));
    }

    /**
     * Somar dias, meses ou anos de uma determinada data no formato 'd/m/Y H:i:s'.
     *
     * @param \DateTime|string $data
     * @param int $dias
     * @param int $meses
     * @param int $anos
     * @param int $horas
     * @param int $mins
     * @param int $segs
     * @return string
     */
    public function somarDataHoraFormatoBr($data, $dias=0, $meses=0, $anos=0, $horas=0, $mins=0, $segs=0)
    {

        $data = (!$data instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_HORA_BR, $data) : $data;

        if (!$data || !$data->format($this->FORMATO_DATA_HORA_BR)) {
            return '01/01/1900 00:00:00';
        }

        $dataCompleta = explode(" ", $data->format($this->FORMATO_DATA_HORA_BR));
        $data = explode("/", $dataCompleta[0]);
        $hora = explode(":", $dataCompleta[1]);

        $d = $data[0];
        $m = $data[1];
        $y = $data[2];

        $h = $hora[0];
        $i = $hora[1];
        $s = $hora[2];

        return date("d/m/Y H:i:s", mktime($h + $horas, $i + $mins, $s + $segs, $m + $meses, $d + $dias, $y + $anos));
    }

    /**
     * Comparar duas datas no formato 'd/m/Y' de acordo com o simbolo informado ('==', '<', '>', '<=', '>=').
     *
     * @param \DateTime|string $data1
     * @param string $simbolo
     * @param \DateTime|string $data2
     * @return bool
     */
    public function compararDataFormatoBr($data1, $simbolo, $data2)
    {

        $data1 = (!$data1 instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_BR, $data1) : $data1;
        $data2 = (!$data2 instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_BR, $data2) : $data2;

        if ((!$data1) || (!$data2)) {
            return false;
        }

        return $this->compararDatasFormatado($data1, $simbolo, $data2);

    }

    /**
     * Comparar duas datas no formato 'd/m/Y H:i:s' de acordo com o simbolo informado ('==', '<', '>', '<=', '>=').
     *
     * @param \DateTime|string $data1
     * @param string $simbolo
     * @param \DateTime|string $data2
     * @return bool
     */
    public function compararDataHoraFormatoBr($data1, $simbolo, $data2)
    {

        $data1 = (!$data1 instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_HORA_BR, $data1) : $data1;
        $data2 = (!$data2 instanceof \DateTime) ? \DateTime::createFromFormat($this->FORMATO_DATA_HORA_BR, $data2) : $data2;

        if ((!$data1) || (!$data2)) {
            return false;
        }

        $data1 = $data1->format($this->DATA_HORA_SQL_SEM_FORMATO);
        $data2 = $data2->format($this->DATA_HORA_SQL_SEM_FORMATO);

        return $this->compararDatasFormatado($data1, $simbolo, $data2);

    }

    /**
     * @param \DateTime $data1
     * @param string $simbolo
     * @param \DateTime $data2
     * @return bool
     */
    private function compararDatasFormatado($data1, $simbolo, $data2)
    {
        switch ($simbolo) {
            case '==':
                $resposta = ($data1 == $data2);
                break;
            case '<':
                $resposta = ($data1 < $data2);
                break;
            case '>':
                $resposta = ($data1 > $data2);
                break;
            case '<=':
                $resposta = ($data1 <= $data2);
                break;
            case '>=':
                $resposta = ($data1 >= $data2);
                break;
            default:
                $resposta = false;
        }

        return $resposta;
    }
}