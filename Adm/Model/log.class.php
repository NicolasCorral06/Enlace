<?php
class Log{

    public $texto;

    public function setTexto($string){
        $today = date("Y-m-d H:i:s");
        $this->texto = $today . " - " . $string;
    }

    public function fileName(){
        $mes = date("m"); 
        $ano = date("Y");
        $nameFile = $ano . "_" . $mes . ".txt";
        return $nameFile;
    }

    public function fileWriter(){
        $nameFile = $this->fileName();
        $arquivo = fopen("../view/log/{$nameFile}","a");
        fwrite($arquivo, $this->texto);
        fclose($arquivo);
    }

}

?>