<?php

class Ferramentas{

    public $param;
    public $senha;

    public function antiInjection($param){
        $strParam = strlen($param);
        $palavras = array("from","select","insert","delete","where","drop","table","show","update","declare","exec","set","alter","cst","union","column","*","%","\"","'","\\","--");
        //$palavras2 = array("FROM","SELECT","INSERT","DELETE","WHERE","DROP","TABLE","SHOW","UPDATE","DECLARE","EXEC","SET","ALTER","CST","UNION","COLUMN","*","%","\"","'","\\","--");
        $paramL = strtolower($param);
		//$paramU = strtoupper($param);
        $str = str_replace($palavras,"",$paramL);
        $strParams = strlen($str);
        if($strParam != $strParams){
			return 0;
		}else{
            return 1;
        }
    }

    public function sha256($senha){
        $senhaCript = hash('sha256', $senha);
        return $senhaCript;
    }

    public function geradorStringRandom($length){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $var_size = strlen($chars);
        $random_str = "";
        for( $x = 0; $x < $length; $x++ ) {  
            $random_str .= $chars[ rand( 0, $var_size - 1 ) ];  
        }
        return $random_str;
    }

    public function geradorIdentifier(){
        $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
        $var_size = strlen($chars);
        $length = 9;
        $random_str = "";
        for( $x = 0; $x < $length; $x++ ) {  
            $random_str .= $chars[ rand( 0, $var_size - 1 ) ];  
        }
        return $random_str;
    }

    public function geradorCodigoRandom(){
        $chars = "0123456789";
        $var_size = strlen($chars);
        $length = 5;
        $random_str = "";
        for( $x = 0; $x <= $length; $x++ ) {  
            $random_str .= $chars[ rand( 0, $var_size - 1 ) ];  
        }
        return $random_str;
    }

    public function geradorMicroTime(){
        $time = microtime(true);
        $valor = explode('.',$time);
        return $valor[0];
    }
    
    public function pegaExtensao($arq){
        $ext = explode('.',$arq);
        return $ext[1];
    }

}
?>