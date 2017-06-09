<?php

namespace MotaMonteiro\Helpers\Traits;


trait DataHelper
{
    /**
     * Validar se uma data no formato 'd/m/Y' é válida ou nao.
     *
     * @param \DateTime|string $data
     * @return bool
     */
    public function validarDataFormatoBr($data)
    {
        $data = (!$data instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y', $data) : $data;
        $data = ($data) ? $data->format('d/m/Y') : false;

        if (!$data) {
            return false;
        }
        return true;
    }

    /**
     * Validar se uma data no formato 'd/m/Y H:i:s' é válida ou nao.
     *
     * @param \DateTime|string $data
     * @return bool
     */
    public function validarDataHoraFormatoBr($data)
    {
        $data = (!$data instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y H:i:s', $data) : $data;
        $data = ($data) ? $data->format('d/m/Y H:i:s') : false;

        if (!$data) {
            return false;
        }
        return true;
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
        $data = ($data) ? $data->format($formato) : false;

        if (!$data) {
            return false;
        }
        return true;
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

        return ($data) ? $data->format($formatoDestino) : false;
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
                return $this->dataFormatoOrigemDestino($data, 'Ymd', 'd/m/Y');
            }
        }

        return $this->dataFormatoOrigemDestino($data, 'Y-m-d', 'd/m/Y');
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
                return $this->dataFormatoOrigemDestino($data, 'YmdHis', 'd/m/Y H:i:s');
            }
        }

        return $this->dataFormatoOrigemDestino($data, 'Y-m-d H:i:s', 'd/m/Y H:i:s');
    }

    /**
     * Converter uma data de um formato 'd/m/Y' para um formato 'Y-m-d'.
     *
     * @param \DateTime|string $data
     * @return false|string
     */
    public function dataFormatoBrParaSql($data)
    {
        return $this->dataFormatoOrigemDestino($data, 'd/m/Y', 'Y-m-d');
    }

    /**
     * Converter uma data de um formato 'd/m/Y H:i:s' para um formato 'Y-m-d H:i:s'.
     *
     * @param \DateTime|string $data
     * @return false|string
     */
    public function dataHoraBrParaSql($data)
    {
        return $this->dataFormatoOrigemDestino($data, 'd/m/Y H:i:s', 'Y-m-d H:i:s');
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

        $data1 = (!$data1 instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y', $data1) : $data1;
        $data2 = (!$data2 instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y', $data2) : $data2;

        if ((!$data1) || (!$data2)) {
            return false;
        }

        $interval = date_diff($data1, $data2);

        return $interval;
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

        $data1 = (!$data1 instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y H:i:s', $data1) : $data1;
        $data2 = (!$data2 instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y H:i:s', $data2) : $data2;

        if ((!$data1) || (!$data2)) {
            return false;
        }

        $interval = date_diff($data1, $data2);

        return $interval;
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

        $data = (!$data instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y', $data) : $data;
        $data = ($data) ? $data->format('d/m/Y') : false;

        if (!$data) {
            return '01/01/1900';
        }

        $data = explode("/", $data);
        $nova_data = date("d/m/Y", mktime($horas, $mins, $segs, $data[1] + $meses, $data[0] + $dias, $data[2] + $anos));
        return $nova_data;
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

        $data = (!$data instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y H:i:s', $data) : $data;
        $data = ($data) ? $data->format('d/m/Y H:i:s') : false;

        if (!$data) {
            return '01/01/1900 00:00:00';
        }

        $dataCompleta = explode(" ", $data);
        $data = explode("/", $dataCompleta[0]);
        $hora = explode(":", $dataCompleta[1]);

        $d = $data[0];
        $m = $data[1];
        $y = $data[2];

        $h = $hora[0];
        $i = $hora[1];
        $s = $hora[2];

        $nova_data = date("d/m/Y H:i:s", mktime($h + $horas, $i + $mins, $s + $segs, $m + $meses, $d + $dias, $y + $anos));
        return $nova_data;
    }

    /**
     *  Comparar duas datas no formato 'd/m/Y' de acordo com o simbolo informado ('==', '<', '>', '<=', '>=').
     *
     * @param \DateTime|string $data1
     * @param string $simbolo
     * @param \DateTime|string $data2
     * @return bool
     */
    public function compararDatasFormatoBr($data1, $simbolo, $data2)
    {

        $data1 = (!$data1 instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y', $data1) : $data1;
        $data2 = (!$data2 instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y', $data2) : $data2;

        if ((!$data1) || (!$data2)) {
            return false;
        }

        $data1 = $data1->format("Ymd");
        $data2 = $data2->format("Ymd");

        $resposta = false;
        switch ($simbolo) {
            case '==':
                if ($data1 == $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
            case '<':
                if ($data1 < $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
            case '>':
                if ($data1 > $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
            case '<=':
                if ($data1 <= $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
            case '>=':
                if ($data1 >= $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
        }

        return $resposta;

    }

    /**
     *  Comparar duas datas no formato 'd/m/Y H:i:s' de acordo com o simbolo informado ('==', '<', '>', '<=', '>=').
     *
     * @param \DateTime|string $data1
     * @param string $simbolo
     * @param \DateTime|string $data2
     * @return bool
     */
    public function compararDatasHoraFormatoBr($data1, $simbolo, $data2)
    {

        $data1 = (!$data1 instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y H:i:s', $data1) : $data1;
        $data2 = (!$data2 instanceof \DateTime) ? \DateTime::createFromFormat('d/m/Y H:i:s', $data2) : $data2;

        if ((!$data1) || (!$data2)) {
            return false;
        }

        $data1 = $data1->format("YmdHis");
        $data2 = $data2->format("YmdHis");

        $resposta = false;
        switch ($simbolo) {
            case '==':
                if ($data1 == $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
            case '<':
                if ($data1 < $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
            case '>':
                if ($data1 > $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
            case '<=':
                if ($data1 <= $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
            case '>=':
                if ($data1 >= $data2) {
                    $resposta = true;
                } else {
                    $resposta = false;
                }
                break;
        }

        return $resposta;

    }
}