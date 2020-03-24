<?php
class DateLibrary {
    public static function doubleParaMoeda($valor) {
        return number_format($valor, 2, ',', '.');
    }

    public static function moedaParaDouble($valor) {
        $valor = str_replace(",", "-", $valor);
        $valor = str_replace(".", "", $valor);
        $valor = str_replace("-", ".", $valor);
        return $valor;
    }

    public static function doubleParaPercentual($valor) {
        return number_format($valor, 1, ',', '.');
    }

    public static function percentualParaDouble($valor) {
        $valor = str_replace(",", ".", $valor);
        return $valor;
    }

    public static function dataMysqlParaDataBrasileira($data) {
        $resultado = null;
        $novaData = substr(trim($data), 0, 10);
        if (strlen($novaData) == 10) {
            $vetor = explode("-", $novaData);
            if (count($vetor) == 3) {
                $resultado = $vetor[2]."/".$vetor[1]."/".$vetor[0];
            } else {
                $resultado = $novaData;
            }
        }
        return $resultado.substr($data, 10);
    }

    public static function dataBrasileiraParaDataMysql($data) {
        $resultado = null;
        $novaData = substr(trim($data), 0, 10);
        if (strlen($novaData) == 10) {
            $vetor = explode("/", $novaData);
            if (count($vetor) == 3) {
                $resultado = $vetor[2]."-".$vetor[1]."-".$vetor[0];
            } else {
                $resultado = $novaData;
            }
        }
        return $resultado.substr($data, 10);
    }

    public static function dataHoraMysqlParaDataHoraBrasileira($data_hora) {
        if ($data_hora) {
            $data_hora_array = explode(" ", $data_hora);
            $data = $data_hora_array[0];
            $hora = $data_hora_array[1];
            $tmp = explode("-", $data);
            $data = $tmp[2]."/".$tmp[1]."/".$tmp[0];
            return $data." ".$hora;
        } else {
            return "Não Encontrado";
        }
    }
    
    public static function nomeCompletoParaPrimeiroNome($nome) {
        $tmp = explode(" ", $nome);
        return $tmp[0];
    }

    public static function horaCompletaParaHoraSemSegundos($hora) {
        $tmp = substr($hora, -5);
        return $tmp;
    }
    
    /*
        Converte uma data no padrão aaaa-mm-dd para dd/mm/aaaa
        @param string $data Data no formato brasileiro (dd/mm/aaaa)
        @return string
    */
    public static function dateNowPtBr($data) {
        $resultado = null;
        $novaData = substr(trim($data), 0, 10);
        if (strlen($novaData) == 10) {
            $vetor = explode("-", $novaData);
            if (count($vetor) == 3) {
                $resultado = $vetor[2]."/".$vetor[1]."/".$vetor[0];
            } else {
                $resultado = $novaData;
            }
        }
        return $resultado.substr($data, 10);
    }
    
    /*
        Retorna a data atual no fuso horário de Brasília, independente das configurações do servidor.
        @param string $strFormato Formato da data a ser retornado
        @return string
    */
    public static function dateNow($strFormato = "Y-m-d H:i:s") {
        $intDesvio = 3;
        if (date("I") == "1") {
            $intDesvio -= 1;
        }
        $data = date($strFormato, mktime(gmdate("H") - $intDesvio, gmdate("i"), gmdate("s"), gmdate("m"), gmdate("d"), gmdate("Y")));
        return $data;
    }

    /*
        Extrai somente a data de uma string com data e hora
        @param string $strData Data e Hora
        @return string
    */
    public static function getData($strData) {
        $arrDados = explode(" ", $strData);
        return $arrDados['0'];
    }

    /*
        Extrai somente a hora de uma string com data e hora
        @param string $strData Data e Hora
        @return string
    */
    public static function getHora($strData) {
        $arrDados = explode(" ", $strData);
        return $arrDados['1'];
    }
    
    /*
        Verifica o nome do mês
        @param int $intMes Mês
        @return string
    */
    public static function retornaNomeMes($intMes) {
        if (strlen($intMes) <= 2) {
            $intMes = intval($intMes);
        } else {
            $data = self::dataBrasileiraParaDataMysql($intMes);
            $vetData = explode("-", $data);
            $intMes = intval($vetData['1']);
        }

        if ($intMes >= 1 && $intMes <= 12) {
            $arrMes = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
            return $arrMes[$intMes];
        }
    }
    
    /*
        Retorna a data por extenso (Ex: Junho de 2016)
        @param string $data Data
        @return string
    */
    public static function retornaMesAno($data) {
        $data = self::dataBrasileiraParaDataMysql($data);
        $nomeMes = self::retornaNomeMes($data);
        $nomeMes = substr($nomeMes, 0);
        $vetData = explode("-", $data);
        $anoData = substr($vetData['0'], - 4);
        return $nomeMes." de ".$anoData;
    }
    
    /*
        Retorna o mês para uma determinada data
        @param string $data Data
        @return string
    */
    public static function retornaMes($data) {
        $data = self::dataBrasileiraParaDataMysql($data);
        $vetData = explode("-", $data);
        $intAno = intval($vetData['1']);
        return $intAno;
    }
    
    /**
     * Retorna o ano para uma determinada data
     *
     * @param string $date Data
     *
     * @return string
     */
    public static function returnYear($date) {
        $date = self::dateNow($date);
        $vetDate = explode("-", $date);
        $intYear = intval($vetDate['0']);
        return $intYear;
    }
    
    /*
        Retorna a data por extenso
        @param string $data Data
        @param boolean $bolExibirDiaDaSemana Se irá exibir o dia da semana ou não
        @return string
    */
    public static function exibirDataEmTexto($data = null, $bolExibirDiaDaSemana = true) {
        if (strlen($data) > 0) {
            $data = self::dataBrasileiraParaDataMysql($data);
        } else {
            $data = date("Y-m-d");
        }
        $vetData = explode("-", $data);
        if (count($vetData) == 3) {
            $data_dia = $vetData['2'];
            $data_mes = $vetData['1'];
            $data_ano = $vetData['0'];
            $novaData = mktime(0, 0, 0, $data_mes, $data_dia, $data_ano);
            $dia = date("d", $novaData); //Representação numérica do dia do mês (1 a 31)
            $diaSemana = date("w", $novaData); // representação numérica do dia da semana com 0 (para Domingo) a 6 (para Sabado)
            $mes = date("n", $novaData); // Representação numérica de um mês (1 a 12)
            $ano = date("Y", $novaData); // Ano com 4 digitos, lógico, né?
            $nomeDia = array(0 => "Domingo", "Segunda-feira", "Terça-feira", "Quarta-feira", "Quinta-feira", "Sexta-feira", "Sábado");
            $nomeMes = array(1 => "Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho", "Agosto", "Setembro", "Outubro", "Novembro", "Dezembro");
            $strDiaSemana = ($bolExibirDiaDaSemana) ? "{$nomeDia[$diaSemana]}, " : null;
            return "{$strDiaSemana}{$dia} de {$nomeMes[$mes]} de {$ano}";
        }
    }
    
    /*
        Retorna uma mensagem de cumprimento com base na hora atual (bom dia, boa tarde, boa noite, boa madrugada)
        @return string
    */
    public static function exibirMensagemCumprimento() {
        $hora_do_dia = date("H");
        if (($hora_do_dia >= 6) && ($hora_do_dia < 12)) {
            return "Bom Dia!";
        } else if (($hora_do_dia >= 12) && ($hora_do_dia < 18)) {
            return "Boa Tarde!";
        } else if (($hora_do_dia >= 18) && ($hora_do_dia <= 24)) {
            return "Boa Noite!";
        } else {
            return "Boa Madrugada!";
        }
    }
}