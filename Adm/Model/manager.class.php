<?php
require 'conexao.class.php';

class Manager extends Conexao{
    
    public function contatoNew($dados){
        $sql = "INSERT INTO contato (nome, email, telefone, assunto, mensagem, status) VALUES ('{$dados['nome']}', '{$dados['email']}', '{$dados['telefone']}', '{$dados['assunto']}', '{$dados['mensagem']}', 2)";
        /*
        1 - lido
        2 - não lido
        */
        $res = $this->connect()->query($sql);
        if($res){
            return $res;
        }else{
            return $res;
        }
    }

    public function contatoListLida(){
        $dados = array();
        $dados["result"] = 0;
        $sql = "SELECT * FROM contato WHERE status = 1";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                $dados[$i]["nome"] = $row["nome"];
                $dados[$i]["email"] = $row["email"];
                $dados[$i]["telefone"] = $row["telefone"];
                $dados[$i]["assunto"] = $row["assunto"];
                $dados[$i]["mensagem"] = $row["mensagem"];
                $dados[$i]["status"] = $row["status"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $this->connect()->close();
            return $dados;
        }
    }

    public function contatoListNLida(){
        $dados = array();
        $dados["result"] = 0;
        $sql = "SELECT * FROM contato WHERE status = 2";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                $dados[$i]["nome"] = $row["nome"];
                $dados[$i]["email"] = $row["email"];
                $dados[$i]["telefone"] = $row["telefone"];
                $dados[$i]["assunto"] = $row["assunto"];
                $dados[$i]["mensagem"] = $row["mensagem"];
                $dados[$i]["status"] = $row["status"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $this->connect()->close();
            return $dados;
        }
    }

    public function avaliacaoList(){
        $dados = array();
        $dados["result"] = 0;
        $sql = "SELECT * FROM comentarios WHERE status = 1";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                $dados[$i]["id_ser"] = $row["id_ser"];
                $dados[$i]["id_cli"] = $row["id_cli"];
                $dados[$i]["estrela"] = $row["estrela"];
                $dados[$i]["mensagem"] = $row["mensagem"];
                $dados[$i]["status"] = $row["status"];

                $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados[$i]["id_ser"]}'";
                $resSer = $this->connect()->query($sqlSer); // Use $resSer
                if($resSer->num_rows > 0){
                    while($rowSer = $resSer->fetch_assoc()){
                        $dados[$i]["nomeSer"] = $rowSer["nome"];
                    }
                }

                $sqlCli = "SELECT nome FROM cliente WHERE id = '{$dados[$i]["id_cli"]}'";
                $resCli = $this->connect()->query($sqlCli); // Use $resSer
                if($resCli->num_rows > 0){
                    while($rowCli = $resCli->fetch_assoc()){
                        $dados[$i]["nomeCli"] = $rowCli["nome"];
                    }
                }

                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $this->connect()->close();
            return $dados;
        }
    }

    public function mudarStatusContato($id, $statusChange){
        if($statusChange == "NLparaL"){ // não lido para lido
            $sql = "UPDATE contato SET status = 1 WHERE id = $id";
        } else { // lido para não lido
            $sql = "UPDATE contato SET status = 2 WHERE id = $id";
        }
        $res = $this->connect()->query($sql);
        if($res){
            $this->connect()->close();            
            return $res;
        }else{
            $this->connect()->close();            
            return $res;
        }
    }

    public function AdmVerificar($dados){
        $dados['result'] = 0;
        $sql = "SELECT * FROM Administrador WHERE email = '{$dados['email']}' AND senha = '{$dados['senha']}' AND status = 1";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados['result'] = 1;
            while($row = $res->fetch_assoc()){
                $dados["id"] = $row["id"];
                $dados["nome"] = $row["nome"];
                $dados["email"] = $row["email"];
                $dados["poder"] = $row["poder"];
            }
            $this->connect()->close();            
        }
        return $dados;
    }

    public function AdmPuxar($id){
        $dados['result'] = 0;
        $sql = "SELECT * FROM Administrador WHERE id = $id";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados['result'] = 1;
            while($row = $res->fetch_assoc()){
                $dados["id"] = $row["id"];
                $dados["nome"] = $row["nome"];
                $dados["email"] = $row["email"];
                $dados["poder"] = $row["poder"];
                $dados["status"] = $row["status"];
            }
            $this->connect()->close();            
        }
        return $dados;
    }

    public function CliPuxar($id){
        $dados['result'] = 0;
        $sql = "SELECT * FROM cliente WHERE id = $id";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados['result'] = 1;
            while($row = $res->fetch_assoc()){
                $dados["id"] = $row["id"];
                $dados["foto_perfil"] = $row["foto_perfil"];
                $dados["nome"] = $row["nome"];
                $dados["email"] = $row["email"];
                $dados["telefone"] = $row["telefone"];
                $dados["nascimento"] = $row["nascimento"];
                $dados["cpf"] = $row["cpf"];
                $dados["data_insercao"] = $row["data_insercao"];
                $dados["status"] = $row["status"];
            }
            $this->connect()->close();            
        }
        return $dados;
    }

    public function AdmConfirEmail($dados){
        $sql = "SELECT * FROM Administrador WHERE email = '{$dados['email']}' AND id != '{$dados['id']}'";
        $res = $this->connect()->query($sql);
        $this->connect()->close();       
        if($res->num_rows > 0){
            return 1;
        } else {
            return 0;
        }
    }

    public function cliConfirEmail($dados){
        $sql = "SELECT * FROM cliente WHERE email = '{$dados['email']}' AND id != '{$dados['id']}'";
        $res = $this->connect()->query($sql);
        $this->connect()->close();       
        if($res->num_rows > 0){
            return 1;
        } else {
            return 0;
        }
        
    }

    public function agendamentoListar(){
        $dados = array();
        $codVerifyListados1 = array();
        $codVerifyListados2 = array();
        $codVerifyListados3 = array();

        $sql1 = "SELECT * FROM agendamento WHERE status = 1"; // aceito/pago - em espera
        $sql2 = "SELECT * FROM agendamento WHERE status = 2"; // pendente/falta de informação
        $sql3 = "SELECT * FROM agendamento WHERE status = 3"; // concluido

        $res1 = $this->connect()->query($sql1);
        if($res1->num_rows > 0){
            $dados["result"] = 1;
            $i = 1;
            while($row = $res1->fetch_assoc()){
                if (in_array($row["codVerify"], $codVerifyListados1)) {
                    continue; //se ja tiver um codVerify, pula
                }
    
                $codVerifyListados1[] = $row["codVerify"];

                $dados[$i]["id"] = $row["id"];
                $dados[$i]["id_servico"] = $row["id_servico"];
                $dados[$i]["id_int"] = $row["id_int"];
                $dados[$i]["id_cli"] = $row["id_cli"];
                $dados[$i]["preco"] = $row["preco"];
                $dados[$i]["quantInt"] = $row["quantInt"];
                $dados[$i]["quantHoras"] = $row["quantHoras"];
                $dados[$i]["cidade"] = $row["cidade"];
                $dados[$i]["codVerify"] = $row["codVerify"];
                $dados[$i]["data"] = $row["data"];
                $dados[$i]["data_insercao"] = $row["data_insercao"];
                $dados[$i]["status"] = $row["status"];

                $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados[$i]["id_servico"]}'";
                $resSer = $this->connect()->query($sqlSer); // Use $resSer
                if($resSer->num_rows > 0){
                    while($rowSer = $resSer->fetch_assoc()){
                        $dados[$i]["nomeSer"] = $rowSer["nome"];
                    }
                }

                $sqlCli = "SELECT nome FROM cliente WHERE id = '{$dados[$i]["id_cli"]}'";
                $resCli = $this->connect()->query($sqlCli); // Use $resSer
                if($resCli->num_rows > 0){
                    while($rowCli = $resCli->fetch_assoc()){
                        $dados[$i]["nomeCli"] = $rowCli["nome"];
                    }
                }
                
                $i++;
            }
            $dados["num"] = count($codVerifyListados1);

            
        } else {
            $dados["num"] = 0;
        }

        $res2 = $this->connect()->query($sql2);
        if($res2->num_rows > 0){
            $dados["result2"] = 1;
            $i = 1;
            while($row = $res2->fetch_assoc()){
                if (in_array($row["codVerify"], $codVerifyListados2)) {
                    continue; //se ja tiver um codVerify, pula
                }
    
                $codVerifyListados2[] = $row["codVerify"];

                $dados[$i]["id2"] = $row["id"];
                $dados[$i]["id_servico2"] = $row["id_servico"];
                $dados[$i]["id_int2"] = $row["id_int"];
                $dados[$i]["id_cli2"] = $row["id_cli"];
                $dados[$i]["preco2"] = $row["preco"];
                $dados[$i]["quantInt2"] = $row["quantInt"];
                $dados[$i]["quantHoras2"] = $row["quantHoras"];
                $dados[$i]["cidade2"] = $row["cidade"];
                $dados[$i]["codVerify2"] = $row["codVerify"];
                $dados[$i]["data2"] = $row["data"];
                $dados[$i]["data_insercao2"] = $row["data_insercao"];
                $dados[$i]["status2"] = $row["status"];

                
                $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados[$i]["id_servico2"]}'";
                $resSer = $this->connect()->query($sqlSer); // Use $resSer
                if($resSer->num_rows > 0){
                    while($rowSer = $resSer->fetch_assoc()){
                        $dados[$i]["nomeSer2"] = $rowSer["nome"];
                    }
                }

                $sqlCli = "SELECT nome FROM cliente WHERE id = '{$dados[$i]["id_cli2"]}'";
                $resCli = $this->connect()->query($sqlCli); // Use $resSer
                if($resCli->num_rows > 0){
                    while($rowCli = $resCli->fetch_assoc()){
                        $dados[$i]["nomeCli2"] = $rowCli["nome"];
                    }
                }
                
                $i++;
            }
            $dados["num2"] = count($codVerifyListados2);

        } else {
            $dados["num2"] = 0;
        }

        $res3 = $this->connect()->query($sql3);
        if($res3->num_rows > 0){
            $dados["result3"] = 1;
            $i = 1;
            while($row = $res3->fetch_assoc()){
                if (in_array($row["codVerify"], $codVerifyListados3)) {
                    continue; //se ja tiver um codVerify, pula
                }
    
                $codVerifyListados3[] = $row["codVerify"];

                $dados[$i]["id3"] = $row["id"];
                $dados[$i]["id_servico3"] = $row["id_servico"];
                $dados[$i]["id_int3"] = $row["id_int"];
                $dados[$i]["id_cli3"] = $row["id_cli"];
                $dados[$i]["preco3"] = $row["preco"];
                $dados[$i]["quantInt3"] = $row["quantInt"];
                $dados[$i]["quantHoras3"] = $row["quantHoras"];
                $dados[$i]["cidade3"] = $row["cidade"];
                $dados[$i]["codVerify3"] = $row["codVerify"];
                $dados[$i]["data3"] = $row["data"];
                $dados[$i]["data_insercao3"] = $row["data_insercao"];
                $dados[$i]["status3"] = $row["status"];

                
                $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados[$i]["id_servico3"]}'";
                $resSer = $this->connect()->query($sqlSer); // Use $resSer
                if($resSer->num_rows > 0){
                    while($rowSer = $resSer->fetch_assoc()){
                        $dados[$i]["nomeSer3"] = $rowSer["nome"];
                    }
                }

                $sqlCli = "SELECT nome FROM cliente WHERE id = '{$dados[$i]["id_cli3"]}'";
                $resCli = $this->connect()->query($sqlCli); // Use $resSer
                if($resCli->num_rows > 0){
                    while($rowCli = $resCli->fetch_assoc()){
                        $dados[$i]["nomeCli3"] = $rowCli["nome"];
                    }
                }
                
                $i++;
            }
            $dados["num3"] = count($codVerifyListados3);

            
        } else {
            $dados["num3"] = 0;
        }

        $this->connect()->close();
        return $dados;
    }

    public function AdmListar(){
        $dados = array();
        $sql = "SELECT * FROM administrador";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                $dados[$i]["nome"] = $row["nome"];
                $dados[$i]["email"] = $row["email"];
                $dados[$i]["poder"] = $row["poder"];
                $dados[$i]["status"] = $row["status"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        }
    }
    public function cliListar(){
        $dados = array();
        $sql = "SELECT * FROM cliente";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                $dados[$i]["foto_perfil"] = $row["foto_perfil"];
                $dados[$i]["nome"] = $row["nome"];
                $dados[$i]["email"] = $row["email"];
                $dados[$i]["telefone"] = $row["telefone"];
                $dados[$i]["nascimento"] = $row["nascimento"];
                $dados[$i]["cpf"] = $row["cpf"];
                $dados[$i]["data_insercao"] = $row["data_insercao"];
                $dados[$i]["status"] = $row["status"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        }
    }

    public function AdmEdit($dados){
        if(!isset($dados["senha"]) || $dados["senha"] == ""){
            $sql = "UPDATE administrador set nome = '{$dados["nome"]}',email = '{$dados["email"]}',poder = '{$dados["poder"]}', status = {$dados["status"]} WHERE id = {$dados["id"]}";
        }else{
            $sql = "UPDATE administrador set nome = '{$dados["nome"]}',email = '{$dados["email"]}',poder = '{$dados["poder"]}',senha = '{$dados["senha"]}',status = {$dados["status"]} WHERE id = {$dados["id"]}";
        }

        $res = $this->connect()->query($sql);
        $this->connect()->close();
        return $res;   
    }

    public function cliEdit($dados){
        if(!isset($dados["senha"]) || $dados["senha"] == ""){
            $sql = "UPDATE cliente SET nome = '{$dados["nome"]}', email = '{$dados["email"]}', telefone = '{$dados["telefone"]}', nascimento = '{$dados["nascimento"]}', cpf = '{$dados["cpf"]}', status = {$dados["status"]}";
        }else{
            $sql = "UPDATE cliente SET nome = '{$dados["nome"]}', email = '{$dados["email"]}', telefone = '{$dados["telefone"]}', nascimento = '{$dados["nascimento"]}', cpf = '{$dados["cpf"]}', senha = '{$dados["senha"]}', status = {$dados["status"]}";
        }

        if (isset($dados['foto_perfil']) && $dados['foto_perfil'] != "") {
            $sql .= ", foto_perfil = '{$dados['foto_perfil']}'";
        }

        $sql .= " WHERE id = {$dados["id"]}";

        $res = $this->connect()->query($sql);
        $this->connect()->close();
        return $res;   
    }

    public function cliEditCC($dados){
       $sql = "UPDATE cliente SET nome = '{$dados["nome"]}', email = '{$dados["email"]}', telefone = '{$dados["telefone"]}', nascimento = '{$dados["nascimento"]}'";
        
        if (isset($dados["fotoMT"]) && $dados["fotoMT"] != "") {
            $sql .= ", foto_perfil = '{$dados["fotoMT"]}'";
        }

        $sql .= " WHERE id = {$dados["id_cli"]}";

        $res = $this->connect()->query($sql);
        $this->connect()->close();
        return $res;   
    }

    public function AdmNew($dados){
        $sql = "INSERT INTO administrador (nome,email,senha,poder,status) VALUES ('{$dados["nome"]}','{$dados["email"]}','{$dados["senha"]}','{$dados["poder"]}','{$dados["status"]}')";
        $res = $this->connect()->query($sql);
        if($res == true){
            $this->connect()->close();
            return $res;
        }else{
            $this->connect()->close();
            return $res;
        }
    }

    public function AdmDel($id){
        $sql = "DELETE FROM administrador WHERE id = {$id}";
        $res = $this->connect()->query($sql);
        $this->connect()->close();
        return $res;
    }

    public function updateSenhaAdm($id ,$email, $senhaCrip){
        $sql = "UPDATE administrador SET senha = '{$senhaCrip}' WHERE email = '{$email}'";
        $res = $this->connect()->query($sql);
        if($res){
            $sql = "UPDATE chamado_adm SET status = '1' WHERE email_adm = '{$email}' AND id = {$id}";
            $res = $this->connect()->query($sql);
        }
        $this->connect()->close();
        return $res;
    }


    public function confirmEmailAdm($email){
        $sql = "SELECT * FROM administrador WHERE email = '{$email}'";
        $res = $this->connect()->query($sql);
       
        if($res->num_rows > 0){
            $this->connect()->close();
            return true; // pode continuar
        } else {
            $this->connect()->close();
            return false; // erro
        }
    }

    public function confirmChamadoEmailAdm($email){
        $sql = "SELECT * FROM chamado_adm WHERE email_adm = '{$email}'";
        $res = $this->connect()->query($sql);
       
        if($res->num_rows > 0){
            $this->connect()->close();
            return true; // deu ruim
        } else {
            $this->connect()->close();
            return false; // pode continuar
        }
    }

    public function abrirChamadoSenha($email){
        $sql = "INSERT INTO chamado_adm (email_adm, assunto, status) VALUES ('{$email}', 1, 2)";
        $res = $this->connect()->query($sql);
        
        if($res){
            $this->connect()->close();
            return $res; // true
        } else {
            $this->connect()->close();
            return $res; // false
        }
    }

    public function admChamadoListar(){
        $dados = array();
        $sql = "SELECT * FROM chamado_adm WHERE status = 2";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                //$dados[$i]["id_adm"] = $row["id_adm"];
                $dados[$i]["email_adm"] = $row["email_adm"];
                $dados[$i]["assunto"] = $row["assunto"];
                $dados[$i]["status"] = $row["status"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        }
    }


    public function CarrosselList(){
        $dados = array();
        $sql = "SELECT * FROM carrossel";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                $dados[$i]["imggd"] = $row["imggd"];
                $dados[$i]["altgd"] = $row["altgd"];
                $dados[$i]["imgpq"] = $row["imgpq"];
                $dados[$i]["altpq"] = $row["altpq"];
                $dados[$i]["status"] = $row["status"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        }
    }

    public function CarrosselNew($dados){
        $sql = "INSERT INTO carrossel (imgpq, altpq, imggd, altgd,status) VALUES ('{$dados["imgMTPq"]}', '{$dados["altpq"]}', '{$dados["imgMTGd"]}', '{$dados["altgd"]}','{$dados["status"]}')";
        $res = $this->connect()->query($sql);
        if($res == true){//certo
            $this->connect()->close();
            return $res;
        }else{//errado
            $this->connect()->close();
            return $res;
        }
    }

    public function CarrosselEdit($dados){
        $sql = "UPDATE carrossel SET status = '{$dados["status"]}', altpq = '{$dados["altpq"]}', altgd = '{$dados["altgd"]}'";

        if (isset($dados['imgMTPq']) && $dados['imgMTPq'] != "") {
            $sql .= ", imgpq = '{$dados['imgMTPq']}'";
        }

        if (isset($dados['imgMTGd']) && $dados['imgMTGd'] != "") {
            $sql .= ", imggd = '{$dados['imgMTGd']}'";
        }

        $sql .= " WHERE id = {$dados['id']}";

        $res = $this->connect()->query($sql);
        if($res == true){//certo
            $this->connect()->close();
            return $res;
        }else{//errado
            $this->connect()->close();
            return $res;
        }
    }

    public function CarrosselDel($id){
        $sql = "DELETE FROM carrossel WHERE id = {$id}";
        $res = $this->connect()->query($sql);
        $this->connect()->close();
        return $res;
    }

    public function CarrosselPuxar($id){
        $dados['result'] = 0;
        $sql = "SELECT * FROM carrossel WHERE id = $id";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados['result'] = 1;
            while($row = $res->fetch_assoc()){
                $dados["id"] = $row["id"];
                $dados["imggd"] = $row["imggd"];
                $dados["altgd"] = $row["altgd"];
                $dados["imgpq"] = $row["imgpq"];
                $dados["altpq"] = $row["altpq"];
                $dados["status"] = $row["status"];
            }
            $this->connect()->close();            
        }
        return $dados;
    }

    public function servicosListar(){
        $dados = array();
        $sql = "SELECT * FROM servico";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                $dados[$i]["nome"] = $row["nome"];
                $dados[$i]["sobre"] = $row["sobre"];
                $dados[$i]["serve"] = $row["serve"];
                $dados[$i]["preco"] = $row["preco"];
                $dados[$i]["status"] = $row["status"];
    
                $dados["status"] = $row["status"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        } 
    }

    public function servicosListar_Status(){
        $dados = array();
        $sql = "SELECT * FROM servico where status != 0";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["id"] = $row["id"];
                $dados[$i]["nome"] = $row["nome"];
                $dados[$i]["sobre"] = $row["sobre"];
                $dados[$i]["serve"] = $row["serve"];
                $dados[$i]["preco"] = $row["preco"];

                $dados[$i]["status"] = $row["status"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        } 
    }

    public function avaliacaoNew($dados){
        $sql = "INSERT INTO comentarios(estrela, mensagem, id_ser, id_cli, datahora, status) VALUES ('{$dados["estrelas"]}', '{$dados["comentario"]}', '{$dados["id_ser"]}', '{$dados["id_cli"]}', now(), 1)";
        $res = $this->connect()->query($sql);
        $this->connect()->close();
        
        return $res;

    }

    public function listarComentario($id_ser){
        $dadosComentario = array();
        $sql = "SELECT * FROM comentarios WHERE id_ser = $id_ser";
        $resComentario = $this->connect()->query($sql);
        if($resComentario->num_rows > 0){
            $dadosComentario["num"] = $resComentario->num_rows;
            $dadosComentario["result"] = 1;
            $i = 1;
            while($row = $resComentario->fetch_assoc()){
                $dadosComentario[$i]["id"] = $row["id"];
                $dadosComentario[$i]["id_ser"] = $row["id_ser"];
                $dadosComentario[$i]["id_cli"] = $row["id_cli"];
                $dadosComentario[$i]["estrela"] = $row["estrela"];
                $dadosComentario[$i]["mensagem"] = $row["mensagem"];
                $dadosComentario[$i]["datahora"] = $row["datahora"];
                $dadosComentario[$i]["status"] = $row["status"];

                $id_cli = $row["id_cli"];
                $sqlCliente = "SELECT nome FROM cliente WHERE id = $id_cli";
                $resCliente = $this->connect()->query($sqlCliente);

                if ($resCliente->num_rows > 0) {
                    $rowCliente = $resCliente->fetch_assoc();
                    $dadosComentario[$i]["nome_cli"] = $rowCliente["nome"];
                } else {
                    $dadosComentario[$i]["nome_cli"] = "Cliente não encontrado";
                }

                $i++;
            }
            $this->connect()->close();
            return $dadosComentario;
        }else{
            $dadosComentario["result"] = 0;
            $this->connect()->close();
            return $dadosComentario;
        }
    }


    public function servicoNew($dados){
        $sql = "INSERT INTO servico(nome, sobre, serve, preco, status) 
        VALUES ('{$dados["nome"]}', '{$dados["sobre"]}', '{$dados["serve"]}', '{$dados["preco"]}', '{$dados["status"]}')";

        $res = $this->connect()->query($sql);

        if($res == true){
            $this->connect()->close();
            return $res;
        } else {
            $this->connect()->close();
            return $res;
        }
    }

    public function servicoDel($id){
        $sql = "DELETE FROM servico WHERE id = {$id}";
        $res = $this->connect()->query($sql);
        $this->connect()->close();
        return $res;
    }

    public function servicoPuxar($id){
        $dados['result'] = 0;
        $sql = "SELECT * FROM servico WHERE id = $id";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados['result'] = 1;
            while($row = $res->fetch_assoc()){
                $dados["id"] = $row["id"];
                $dados["nome"] = $row["nome"];
                $dados["sobre"] = $row["sobre"];
                $dados["serve"] = $row["serve"];
                $dados["preco"] = $row["preco"];
    
                $dados["status"] = $row["status"];
            }
            $this->connect()->close();            
        }
        return $dados;
    }

    public function servicoEdit($dados){
        $sql = "UPDATE servico SET nome = '{$dados['nome']}', sobre = '{$dados['sobre']}', serve = '{$dados['serve']}', preco = '{$dados['preco']}', status = '{$dados['status']}' ";

        $sql .= " WHERE id = {$dados['id']}";

        $res = $this->connect()->query($sql);
        if($res == true){//certo
            $this->connect()->close();
            return $res;
        }else{//errado
            $this->connect()->close();
            return $res;
        }
    }

    // PORFAVOR N MEXER NISSO, ESSA PORRA FOI CHATA DE MAIS DE FAZER
    public function intEservicoAtualizar($dados, $servicosCOMint) {
        $id_int = $dados['id_int'];
       
        $sqlServicosAtuais = "SELECT id_servico FROM interprete_servico WHERE id_int = '$id_int'";
        $resSelect = $this->connect()->query($sqlServicosAtuais);
    
        $servicosAtuais = [];
        if ($resSelect && $resSelect->num_rows > 0) {
            while ($row = $resSelect->fetch_assoc()) {
                $servicosAtuais[] = $row['id_servico'];
            }
        }
    
        $servicosParaAdicionar = array_diff($servicosCOMint, $servicosAtuais);
        foreach ($servicosParaAdicionar as $servicoId) {
            $sqlAddServico = "INSERT INTO interprete_servico (id_int, id_servico) VALUES ('$id_int', '$servicoId')";
            $resInsert = $this->connect()->query($sqlAddServico);
            if (!$resInsert) {
                return 0; // errou
            }
        }
    
        $servicosParaRemover = array_diff($servicosAtuais, $servicosCOMint);
        foreach ($servicosParaRemover as $servicoId) {
            $sqlRemoveServico = "DELETE FROM interprete_servico WHERE id_int = '$id_int' AND id_servico = '$servicoId'";
            $resDelete = $this->connect()->query($sqlRemoveServico);
            if (!$resDelete) {
                return 0; // errou
            }
        }
    
        $this->connect()->close();
        return 1;
    }
    
    

    public function intEservico($dados, $servicosCOMint) {
        $totalServicos = count($servicosCOMint);
    
        // Loop for para inserir cada serviço
        for ($i = 0; $i < $totalServicos; $i++) {
            $idServicoSeguro = $servicosCOMint[$i];

    
            $sql = "INSERT INTO interprete_servico (id_int, id_servico, status)
                    VALUES
                    ('{$dados["id_int"]}', '{$idServicoSeguro}', '1')";
    
            $res = $this->connect()->query($sql);
    
            if (!$res) {
                $this->connect()->close();
                return $res;
            }
        }
    
        $this->connect()->close();
        return $res;
    }
    
    public function interpreteServico($dados) {
        $dadosIS['result'] = 0;
        $dadosIS['id_servico'] = []; // Inicializa como array vazio
    
        $sql = "SELECT * FROM interprete_servico WHERE id_int = {$dados['id']}";
        $res = $this->connect()->query($sql);
    
        if ($res->num_rows > 0) {
            $dadosIS['result'] = 1;
    
            while ($row = $res->fetch_assoc()) {
                $dadosIS['id'] = $row['id'];
                $dadosIS['id_int'] = $row['id_int'];
    
                $servicos = explode(',', $row['id_servico']);
                $dadosIS['id_servico'] = array_merge($dadosIS['id_servico'], $servicos);
    
                $dadosIS['status'] = $row['status'];
            }
        }
    
        $this->connect()->close();
        return $dadosIS;
    }
    

    public function cliVerificar($dados){
        $dados['result'] = 0;
        $sql = "SELECT * FROM cliente WHERE email = '{$dados['email']}' AND senha = '{$dados['senha']}' AND status = 1";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados['result'] = 1;
            while($row = $res->fetch_assoc()){
                $dados["id"] = $row["id"];
                $dados["foto_perfil"] = $row["foto_perfil"];
                $dados["nome"] = $row["nome"];
                $dados["email"] = $row["email"];
                $dados["telefone"] = $row["telefone"];
                $dados["nasc"] = $row["nascimento"];
                $dados["cpf"] = $row["cpf"];
                $dados["status"] = $row["status"];
                
            }
            $this->connect()->close();            
        }
        return $dados;
    }

    public function cliVerificarCadastro($dados){
        $dados['result'] = 0;
        $sql = "SELECT * FROM cliente WHERE email = '{$dados['email']}' OR cpf = '{$dados['cpf']}'";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            //erro
            return 1;
        } else {
            //ta bala
            return 0;
        }
    }

    public function cliNew($dados){
        $sql = "INSERT INTO cliente (nome, email, senha, telefone, nascimento, cpf, data_insercao, status) VALUES ('{$dados["nome"]}', '{$dados["email"]}', '{$dados["senha"]}', '{$dados["telefone"]}', '{$dados["nasc"]}', '{$dados["cpf"]}', now() ,1)";

        $res = $this->connect()->query($sql);
        if($res == true){
            $this->connect()->close();
            return $res;
        }else{
            $this->connect()->close();
            return $res;
        }
    }

    public function updCliFoto($fotoPerfilMT, $idCli){
        $sql = "UPDATE cliente SET foto_perfil = '{$fotoPerfilMT}' WHERE id = '{$idCli}' ";
        $res = $this->connect()->query($sql);
        if($res == true){
            $this->connect()->close();
            return $res;
        }else{
            $this->connect()->close();
            return $res;
        }
    }

    public function cliUpdate($dados){
        $sql = "UPDATE cliente SET nome = '{$dados["nomeCli"]}', email = '{$dados["emailCli"]}', telefone = '{$dados["telCli"]}', nascimento = '{$dados["nascCli"]}' WHERE id = '{$dados["idCli"]}' ";
        $res = $this->connect()->query($sql);
       
        $this->connect()->close();
        return $res;
        
    }

    public function verifyEmailCli($email){
        $sql = "SELECT * FROM cliente WHERE email = '{$email}' AND status = 1 ";
        $res = $this->connect()->query($sql);
        if($res->num_rows == 1){
            $this->connect()->close();
            return 1;
        } else {
            $this->connect()->close();
            return 0;
        }
    }

    public function verifyEmailInt($email){
        $sql = "SELECT * FROM interprete WHERE email = '{$email}' AND status != 0  ";
        $res = $this->connect()->query($sql);
        if($res->num_rows == 1){
            $this->connect()->close();
            return 1;
        } else {
            $this->connect()->close();
            return 0;
        }
    }

    public function intPuxarFoto($id){
        $sql = "SELECT foto_perfil FROM interprete_perfil WHERE id_int = '{$id}'";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["result"] = 1;
            while($row = $res->fetch_assoc()){
                $dados["foto_perfil"] = $row["foto_perfil"];
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        }
    }

    public function intPuxarFotoAll(){
        $sql = "SELECT foto_perfil FROM interprete_perfil WHERE status = 1";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["num"] = $res->num_rows;
            $dados["result"] = 1;
            $i = 1;
            while($row = $res->fetch_assoc()){
                $dados[$i]["foto_perfil"] = $row["foto_perfil"];
                $i++;
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        } 
    }

    public function cliPuxarFoto($id){
        $sql = "SELECT foto_perfil FROM cliente WHERE id = '{$id}'";
        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados["result"] = 1;
            while($row = $res->fetch_assoc()){
                $dados["foto_perfil"] = $row["foto_perfil"];
            }
            $this->connect()->close();
            return $dados;
        }else{
            $dados["result"] = 0;
            $this->connect()->close();
            return $dados;
        }
    }

    public function updCliSenha($dados){
        if(isset($dados["verifier"]) && $dados["verifier"] == 1){
            $sql = "UPDATE cliente SET senha = '{$dados["senhaCrip"]}' WHERE email = '{$dados["emailCli"]}' ";
        } else {
            $sql = "UPDATE cliente SET senha = '{$dados["senhaCrip"]}' WHERE id = '{$dados["idCli"]}' ";
        }
       
        $resp = $this->connect()->query($sql);

        if($resp){
            if(isset($dados["verifier"]) && $dados["verifier"] == 1){
                $sqlDel = "DELETE FROM cli_mudarsenha WHERE cli_identifier = '{$dados["cli_identifier"]}' ";
            } else {
                $sqlDel = "DELETE FROM cli_mudarsenha WHERE id_cli = '{$dados["idCli"]}' ";
            }

            $respDel = $this->connect()->query($sqlDel);
            
            if($respDel){
                $this->connect()->close();
                return $respDel;
            } else {
                $this->connect()->close();
                return $respDel;
            }
        }else{
            $this->connect()->close();
            return $resp;
        }
    }

    public function updIntSenha($dados){
        if(isset($dados["verifier"]) && $dados["verifier"] == 1){
            $sql = "UPDATE interprete SET senha = '{$dados["senhaCrip"]}' WHERE email = '{$dados["emailInt"]}' ";
        } else {
            $sql = "UPDATE interprete SET senha = '{$dados["senhaCrip"]}' WHERE id = '{$dados["idInt"]}' ";
        }
       
        $resp = $this->connect()->query($sql);

        if($resp){
            if(isset($dados["verifier"]) && $dados["verifier"] == 1){
                $sqlDel = "DELETE FROM int_mudarsenha WHERE int_identifier = '{$dados["int_identifier"]}' ";
            } else {
                $sqlDel = "DELETE FROM int_mudarsenha WHERE id_int = '{$dados["idInt"]}' ";
            }

            $respDel = $this->connect()->query($sqlDel);
            
            if($respDel){
                $this->connect()->close();
                return $respDel;
            } else {
                $this->connect()->close();
                return $respDel;
            }
        }else{
            $this->connect()->close();
            return $resp;
        }
    }

    public function cliCdastrarCodigo($dados){
        if(isset($dados["emailVerify"]) && $dados["emailVerify"] == true){
            $sql = "INSERT INTO cli_mudarsenha (cli_identifier, codigo) VALUES ('{$dados["cli_identifier"]}', '{$dados["codigo"]}')";
        } else {
            $sql = "INSERT INTO cli_mudarsenha (id_cli, codigo) VALUES ('{$dados["idCli"]}', '{$dados["codigo"]}')";
        }

        $res = $this->connect()->query($sql);
        if($res){
            $this->connect()->close();
            return $res;
        }else{
            $this->connect()->close();
            return $res;
        }
    }

    public function IntCdastrarCodigo($dados){
        if(isset($dados["emailVerify"]) && $dados["emailVerify"] == true){
            $sql = "INSERT INTO int_mudarsenha (int_identifier, codigo) VALUES ('{$dados["int_identifier"]}', '{$dados["codigo"]}')";
        } else {
            $sql = "INSERT INTO int_mudarsenha (id_int, codigo) VALUES ('{$dados["idInt"]}', '{$dados["codigo"]}')";
        }

        $res = $this->connect()->query($sql);
        if($res){
            $this->connect()->close();
            return $res;
        }else{
            $this->connect()->close();
            return $res;
        }
    }

    public function cliConfirmCod($dados){
        if(isset($dados["emailVerify"]) && $dados["emailVerify"] == 1){ 
            $sql = "SELECT * FROM cli_mudarsenha WHERE cli_identifier = '{$dados['cli_identifier']}' AND codigo = '{$dados['codigo']}' ";
        } else{
            $sql = "SELECT * FROM cli_mudarsenha WHERE id_cli = '{$dados['idCli']}' AND codigo = '{$dados['codigo']}' ";
        }

        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $this->connect()->close();
            return 1;
        } else {
            $this->connect()->close();
            return 0;
        }
    }

    public function intConfirmCod($dados){
        if(isset($dados["verifier"]) && $dados["verifier"] == 1){ 
            $sql = "SELECT * FROM int_mudarsenha WHERE int_identifier = '{$dados['int_identifier']}' AND codigo = '{$dados['codigo']}' ";
        } else{
            $sql = "SELECT * FROM int_mudarsenha WHERE id_int = '{$dados['idInt']}' AND codigo = '{$dados['codigo']}' ";
        }

        $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $this->connect()->close();
            return 1;
        } else {
            $this->connect()->close();
            return 0;
        }
    }


//INTERPRETE
public function intVerificar($dados){
    $dados['result'] = 0;
    $sql = "SELECT * FROM Interprete WHERE email = '{$dados['email']}' AND senha = '{$dados['senha']}' AND status IN (1,2,3)";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados['result'] = 1;
        while($row = $res->fetch_assoc()){
            $dados["id"] = $row["id"];
            $dados["nome"] = $row["nome"];
            $dados["email"] = $row["email"];
            $dados["status"] = $row["status"];
        }
        $this->connect()->close();            
    }
    return $dados;
}

public function intVerificarCadastro($dados){
    $dados['result'] = 0;
    $sql = "SELECT * FROM interprete WHERE email = '{$dados['email']}' AND cpf = '{$dados['cpf']}' AND status = 1";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        //erro
        return 1;
    } else {
        //ta bala
        return 0;
    }
}

public function intNew_TEMP($dados){
    $sql = "INSERT INTO interprete_temp (nome, email, senha, telefone, nascimento, cpf, estado, cidade, curriculo, video, status) VALUES ('{$dados["nome"]}', '{$dados["email"]}', '{$dados["senha"]}', '{$dados["telefone"]}', '{$dados["nasc"]}', '{$dados["cpf"]}', '{$dados["estado"]}', '{$dados["cidade"]}', '{$dados["cvMT"]}', '{$dados["videoMT"]}', 1)";

    $res = $this->connect()->query($sql);
    if($res == true){
        $this->connect()->close();
        return $res;
    }else{
        $this->connect()->close();
        return $res;
    }
}

public function intEdit($dados){
    $sql = "UPDATE interprete SET nome = '{$dados['nome']}', email = '{$dados['email']}', telefone = '{$dados['telefone']}', nascimento = '{$dados['nascimento']}', cidade = '{$dados['cidade']}'";

    if (isset($dados['videoMT']) && $dados['videoMT'] != "") {
        $sql .= ", video = '{$dados['videoMT']}'";
    }

    $sql .= ", data_hora = now() WHERE id = {$dados['id']}";

    $res = $this->connect()->query($sql);
    if($res == true){
        $this->connect()->close();
        return $res;
    }else{
        $this->connect()->close();
        return $res;
    }
}

public function updFotoint($dados){
    $sql = "UPDATE interprete_perfil set foto_perfil = '{$dados['fotoMT']}' WHERE id_int = '{$dados['id']}'";
    $res = $this->connect()->query($sql);
    
    $this->connect()->close();
    return $res;
}

public function intAlterarSenha($dados){
    $sql = "UPDATE interprete SET senha = '{$dados['senhaCrip']}' WHERE id = {$dados['id']}";
    $res = $this->connect()->query($sql);
    
    $this->connect()->close();
    return $res;
    
}

public function cliAlterarSenha($dados){
    $sql = "UPDATE interprete SET senha = '{$dados['senhaCrip']}' WHERE id = {$dados['id']}";
    $res = $this->connect()->query($sql);
    
    $this->connect()->close();
    return $res;
    
}
public function intListar(){
    $dados = array();
    $sql = "SELECT * FROM interprete";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["num"] = $res->num_rows;
        $dados["result"] = 1;
        $i = 1;
        while($row = $res->fetch_assoc()){
            $dados[$i]["id"] = $row["id"];
            $dados[$i]["nome"] = $row["nome"];
            $dados[$i]["email"] = $row["email"];
            $dados[$i]["cv"] = $row["curriculo"];
            $dados[$i]["video"] = $row["video"];
            $dados[$i]["status"] = $row["status"];
            $i++;
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    }
}

public function int_TEMPListar(){
    $dados = array();
    $sql = "SELECT * FROM interprete_temp";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["num"] = $res->num_rows;
        $dados["result"] = 1;
        $i = 1;
        while($row = $res->fetch_assoc()){
            $dados[$i]["id"] = $row["id"];
            $dados[$i]["nome"] = $row["nome"];
            $dados[$i]["email"] = $row["email"];
            $dados[$i]["cv"] = $row["curriculo"];
            $dados[$i]["video"] = $row["video"];
            $i++;
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    }
}

public function intDP_TEMPListar(){
    $dados = array();
    $sql = "SELECT * FROM interprete_documentos_temp";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["num"] = $res->num_rows;
        $dados["result"] = 1;
        $i = 1;
        while($row = $res->fetch_assoc()){
            $dados[$i]["id"] = $row["id"];
            $dados[$i]["id_int"] = $row["id_int"];
            $dados[$i]["rg_frente"] = $row["rg_frente"];
            $dados[$i]["rg_verso"] = $row["rg_verso"];
            $dados[$i]["comp_resi"] = $row["comp_resi"];
            $dados[$i]["car_trabalho"] = $row["car_trabalho"];
            $dados[$i]["ante_criminais"] = $row["ante_criminais"];
            $dados[$i]["db1"] = $row["db1"];
            $dados[$i]["db2"] = $row["db2"];
            $dados[$i]["db3"] = $row["db3"];
            $dados[$i]["status"] = $row["status"];
            $i++;
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    }
}

public function intDPpuxar($id){
    $dados = array();
    $sql = "SELECT * FROM interprete_documentos WHERE id_int = '{$id}'";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["result"] = 1;
        while($row = $res->fetch_assoc()){
            $dados["id"] = $row["id"];
            $dados["id_int"] = $row["id_int"];
            $dados["rg_frente"] = $row["rg_frente"];
            $dados["rg_verso"] = $row["rg_verso"];
            $dados["comp_resi"] = $row["comp_resi"];
            $dados["car_trabalho"] = $row["car_trabalho"];
            $dados["ante_criminais"] = $row["ante_criminais"];
            $dados["db1"] = $row["db1"];
            $dados["db2"] = $row["db2"];
            $dados["db3"] = $row["db3"];
            $dados["status"] = $row["status"];
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    }
}

public function intPpuxar($id){
    $dados = array();
    $sql = "SELECT * FROM interprete_perfil WHERE id_int = '{$id}'";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["result"] = 1;
        while($row = $res->fetch_assoc()){
            $dados["id"] = $row["id"];
            $dados["id_int"] = $row["id_int"];
            $dados["foto_perfil"] = $row["foto_perfil"];
            $dados["video_apre"] = $row["video_apre"];
            $dados["texto_apre"] = $row["texto_apre"];
            $dados["formacao"] = $row["formacao"];
            $dados["tempo_exp"] = $row["tempo_exp"];
            $dados["genero"] = $row["genero"];
            $dados["corRaca"] = $row["corRaca"];
            $dados["data_hora"] = $row["data_hora"];
            $dados["status"] = $row["status"];
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    }
}

public function intP_TEMPListar(){
    $dados = array();
    $sql = "SELECT * FROM interprete_perfil_temp";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["num"] = $res->num_rows;
        $dados["result"] = 1;
        $i = 1;
        while($row = $res->fetch_assoc()){
            $dados[$i]["id"] = $row["id"];
            $dados[$i]["id_int"] = $row["id_int"];
            $dados[$i]["foto_perfil"] = $row["foto_perfil"];
            $dados[$i]["video_apre"] = $row["video_apre"];
            $dados[$i]["texto_apre"] = $row["texto_apre"];
            $dados[$i]["formacao"] = $row["formacao"];
            $dados[$i]["tempo_exp"] = $row["tempo_exp"];
            $dados[$i]["genero"] = $row["genero"];
            $dados[$i]["corRaca"] = $row["corRaca"];
            $dados[$i]["data_hora"] = $row["data_hora"];
            $dados[$i]["status"] = $row["status"];
            $i++;
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    }
}

public function intPEdit($dados){
    $sql = "UPDATE interprete_perfil SET texto_apre = '{$dados['texto_apre']}', formacao = '{$dados['formacao']}', tempo_exp = '{$dados['tempo_exp']}', genero = '{$dados['genero']}', corRaca = '{$dados['corRaca']}'";

    if (isset($dados['fotoPerfilMT']) && $dados['fotoPerfilMT'] != "") {
        $sql .= ", foto_perfil = '{$dados['fotoPerfilMT']}'";
    }

    if (isset($dados['videoMT']) && $dados['videoMT'] != "") {
        $sql .= ", video = '{$dados['videoMT']}'";
    }

    $sql .= ", data_hora = now() WHERE id_int = {$dados['id_int']}";

    $res = $this->connect()->query($sql);
    if($res == true){//certo
        $this->connect()->close();
        return $res;
    }else{//errado
        $this->connect()->close();
        return $res;
    }
}

public function intTEMP_para_int($id) {
    $sql = "SELECT * FROM interprete_temp WHERE id = $id";
    $res = $this->connect()->query($sql);
    
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $sqlInsert = "INSERT INTO interprete (nome, email, telefone, nascimento, cpf, estado, cidade, curriculo, video, senha,data_hora, status)
                          VALUES ('".$row["nome"]."', '".$row["email"]."', '".$row["telefone"]."', '".$row["nascimento"]."', '".$row["cpf"]."', '".$row["estado"]."', '".$row["cidade"]."', '".$row["curriculo"]."', '".$row["video"]."', '".$row["senha"]."', now() , '2')";

            if ($this->connect()->query($sqlInsert)) {
                $sqlDelete = "DELETE FROM interprete_temp WHERE id = $id";
                $this->connect()->query($sqlDelete);
            } else {
                return false;
            }
        }
        $this->connect()->close();
        return true; 
    } else {
        $this->connect()->close();
        return false; 
    }
}

public function int_TEMPDel($id){
    $sql = "DELETE FROM interprete_temp WHERE id = {$id}";
    $res = $this->connect()->query($sql);
    $this->connect()->close();
    return $res;
}

public function interprete_documentos_temp($dados){
    $sql = "INSERT INTO interprete_documentos_temp (id_int, rg_frente, rg_verso, comp_resi, car_trabalho, ante_criminais, db1, db2, db3, data_hora ,status) VALUES ('{$dados["id"]}', '{$dados["ffMT"]}', '{$dados["fvMT"]}', '{$dados["crMT"]}', '{$dados["ctMT"]}', '{$dados["cacMT"]}', '{$dados["b1"]}', '{$dados["b2"]}', '{$dados["b3"]}', now(), 1)";

    $res = $this->connect()->query($sql);
    if($res == true){
        $this->connect()->close();
        return $res;
    }else{
        $this->connect()->close();
        return $res;
    }
}

public function interprete_perfil_temp($dados){
    $sql = "INSERT INTO interprete_perfil_temp (
            id_int, foto_perfil, video_apre, texto_apre, formacao, tempo_exp, genero, corRaca, data_hora, status
        ) VALUES (
            '{$dados["id_int"]}', 
            '{$dados["fpMT"]}', 
            '{$dados["vaMT"]}', 
            '{$dados["tv"]}', 
            '{$dados["formacao"]}', 
            '{$dados["te"]}', 
            '{$dados["genero"]}', 
            '{$dados["corRaca"]}', 
            now(),
            '1'
        )"; 

    $res = $this->connect()->query($sql);
    if($res == true){
            $sqlUpdate = "UPDATE interprete SET status = '3' WHERE id = '{$dados["id_int"]}' ";

            if ($this->connect()->query($sqlUpdate)){
                $this->connect()->close();
                return $res;
            }
    }else{
        $this->connect()->close();
        return $res;
    }
}
        
public function intDPTEMP_para_intDP($id) {
    $sql = "SELECT * FROM interprete_documentos_temp WHERE id = $id";
    $res = $this->connect()->query($sql);
    
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $sqlInsert = "INSERT INTO interprete_documentos (id_int, rg_frente, rg_verso, comp_resi, car_trabalho, ante_criminais, db1, db2, db3, data_hora ,status) 
            VALUES
            ('{$row["id_int"]}', '{$row["rg_frente"]}', '{$row["rg_verso"]}', '{$row["comp_resi"]}', '{$row["car_trabalho"]}', '{$row["ante_criminais"]}', '{$row["db1"]}', '{$row["db2"]}', '{$row["db3"]}', now(), 1)";

            if ($this->connect()->query($sqlInsert)) {
                $sqlDelete = "DELETE FROM interprete_documentos_temp WHERE id = $id";
                if($this->connect()->query($sqlDelete)){
                    $verify = $this->confirmIntStatusDPeP($id, $row["id_int"]);
                    if ($verify == true){
                        return 10;
                    }
                    return true;
                }
            } else {
                return false;
            }
        }
        $this->connect()->close();
        return true; 
    } else {
        $this->connect()->close();
        return false; 
    }
}



public function intPTEMP_para_intP($id) {
    $sql = "SELECT * FROM interprete_perfil_temp WHERE id = $id";
    $res = $this->connect()->query($sql);
    
    if($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            $sqlInsert = "INSERT INTO interprete_perfil (
                id_int, foto_perfil, video_apre, texto_apre, formacao, tempo_exp, genero, corRaca, data_hora, status
            ) VALUES (
                '{$row["id_int"]}', 
                '{$row["foto_perfil"]}', 
                '{$row["video_apre"]}', 
                '{$row["texto_apre"]}', 
                '{$row["formacao"]}', 
                '{$row["tempo_exp"]}', 
                '{$row["genero"]}', 
                '{$row["corRaca"]}', 
                NOW(), 
                '1'
            )";

            if ($this->connect()->query($sqlInsert)) {
                // Deleta o registro temporário após a inserção bem-sucedida
                $sqlDelete = "DELETE FROM interprete_perfil_temp WHERE id = $id";
                if ($this->connect()->query($sqlDelete)) {

                    // Verifica o status após a transferência
                    $verify = $this->confirmIntStatusDPeP($id, $row["id_int"]);
                    if ($verify == true) {
                        return 10;
                    }
                    
                    return true;
                }
            } else {
                return false;
            }
        }
        $this->connect()->close();
        return true;
    } else {
        $this->connect()->close();
        return false;
    }
}

//confirma se os dados tão do DP e P estão fora do temp
public function confirmIntStatusDPeP($id, $id_int) {
    $sqlS1 = "SELECT id_int FROM interprete_perfil WHERE id_int = $id_int";
    $resS1 = $this->connect()->query($sqlS1); 

    if($resS1 && $resS1->num_rows > 0) {
        $sqlS2 = "SELECT id_int FROM interprete_documentos WHERE id_int = $id_int";
        $resS2 = $this->connect()->query($sqlS2); 

        if($resS2 && $resS2->num_rows > 0) {
            $sqlUp = "UPDATE interprete SET status = '1' WHERE id = '$id_int' ";
            $this->connect()->query($sqlUp);
            return true; 
        }
        $this->connect()->close();
        return true; 
    } else {
        $this->connect()->close();
        return false; 
    }
}

//n me pergunte mais porque eu n sei, eu to louco HAHAHAHAHAHAHAHAHHAHHAHAHAHAHAHHAHAHAHAHHAHA
public function puxarIntByCidade($cidade, $servicoId) {
    $sql = "
        SELECT i.id, i.nome 
        FROM interprete i
        JOIN interprete_servico iserv ON i.id = iserv.id_int
        WHERE i.cidade = '{$cidade}' AND iserv.id_servico = '{$servicoId}'
    ";

    $res = $this->connect()->query($sql);

    $interpretes = [];
    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $interpretes[] = $row;
        }
    }

    $this->connect()->close();
    return $interpretes;
}

public function countInt(){
    $sql = "SELECT COUNT(id) AS total FROM interprete;";

    $res = $this->connect()->query($sql);

    if ($res) {
        $row = $res->fetch_assoc();
        $total = $row['total']; 
        
        $this->connect()->close();
        
        return $total;
    } else {
        return 0;
    }
}

public function somaPreco(){
    $sql = "SELECT preco, quantInt, quantHoras FROM agendamento"; 
    $result = $this->connect()->query($sql);
     
    if ($result) {
        $total = 0; 
         
        while ($row = $result->fetch_assoc()) {
            $total += $row['preco'] * $row['quantHoras'] ; 
        }
         
        $this->connect()->close();
         
        return $total;
     } else {
        return 0;
    }
}



public function graficoInt() {
    $sql = "
        SELECT 
            MONTH(data_hora) AS mes, 
            COUNT(id) AS total_usuarios,
            status
        FROM interprete 
        WHERE YEAR(data_hora) = YEAR(CURDATE()) 
            AND status = '1'
        GROUP BY MONTH(data_hora)
        ORDER BY mes;

    ";

    $res = $this->connect()->query($sql);

    $dados_usuarios = [];
    $meses = [
        'January' => 'Janeiro', 'February' => 'Fevereiro', 'March' => 'Março', 'April' => 'Abril', 'May' => 'Maio', 'June' => 'Junho', 'July' => 'Julho', 'August' => 'Agosto', 'September' => 'Setembro', 'October' => 'Outubro', 'November' => 'Novembro', 'December' => 'Dezembro'
    ];

    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            // Traduz o mês para o português
            $mes = date('F', mktime(0, 0, 0, $row['mes'], 10)); // Mês em inglês
            $mes_portugues = $meses[$mes]; // Traduz para o português
            $dados_usuarios[] = [$mes_portugues, (int)$row['total_usuarios']];
        }

        return $dados_usuarios;
    } else {
        echo "Nenhum dado encontrado.";
    }

    $this->connect()->close();
}

public function graficoCli() {
    $sql = "
        SELECT 
            MONTH(data_insercao) AS mes, 
            COUNT(id) AS total_usuarios,
            status
        FROM cliente 
        WHERE YEAR(data_insercao) = YEAR(CURDATE()) 
            AND status = '1'
        GROUP BY MONTH(data_insercao)
        ORDER BY mes;

    ";

    $res = $this->connect()->query($sql);

    $dados_usuarios = [];
    $meses = [
        'January' => 'Janeiro', 'February' => 'Fevereiro', 'March' => 'Março', 'April' => 'Abril', 'May' => 'Maio', 'June' => 'Junho', 'July' => 'Julho', 'August' => 'Agosto', 'September' => 'Setembro', 'October' => 'Outubro', 'November' => 'Novembro', 'December' => 'Dezembro'
    ];

    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            // Traduz o mês para o português
            $mes = date('F', mktime(0, 0, 0, $row['mes'], 10)); // Mês em inglês
            $mes_portugues = $meses[$mes]; // Traduz para o português
            $dados_usuarios[] = [$mes_portugues, (int)$row['total_usuarios']];
        }

        return $dados_usuarios;
    } else {
        echo "Nenhum dado encontrado.";
    }

    $this->connect()->close();
}

public function graficoAge() {
    $sql = "
        SELECT 
            MONTH(data_insercao) AS mes, 
            COUNT(id) AS total_usuarios,
            status
        FROM agendamento 
        WHERE YEAR(data_insercao) = YEAR(CURDATE()) 
            AND status != '0'
        GROUP BY MONTH(data_insercao)
        ORDER BY mes;

    ";

    $res = $this->connect()->query($sql);

    $dados_usuarios = [];
    $meses = [
        'January' => 'Janeiro', 'February' => 'Fevereiro', 'March' => 'Março', 'April' => 'Abril', 'May' => 'Maio', 'June' => 'Junho', 'July' => 'Julho', 'August' => 'Agosto', 'September' => 'Setembro', 'October' => 'Outubro', 'November' => 'Novembro', 'December' => 'Dezembro'
    ];

    if ($res->num_rows > 0) {
        while($row = $res->fetch_assoc()) {
            // Traduz o mês para o português
            $mes = date('F', mktime(0, 0, 0, $row['mes'], 10)); // Mês em inglês
            $mes_portugues = $meses[$mes]; // Traduz para o português
            $dados_usuarios[] = [$mes_portugues, (int)$row['total_usuarios']];
        }

        return $dados_usuarios;
    } else {
        echo "Nenhum dado encontrado.";
    }

    $this->connect()->close();
}



public function intPuxar($dados){
    $dados['result'] = 0;
    $sql = "SELECT * FROM Interprete WHERE id = '{$dados['id']}' AND status IN (1,2,3)";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados['result'] = 1;
        while($row = $res->fetch_assoc()){
            $dados["id"] = $row["id"];
            $dados["nome"] = $row["nome"];
            $dados["email"] = $row["email"];
            $dados["telefone"] = $row["telefone"];
            $dados["nascimento"] = $row["nascimento"];
            $dados["cpf"] = $row["cpf"];
            $dados["estado"] = $row["estado"];
            $dados["cidade"] = $row["cidade"];
            $dados["curriculo"] = $row["curriculo"];
            $dados["video"] = $row["video"];
            $dados["status"] = $row["status"];
        }
        $this->connect()->close();            
    }
    return $dados;
}

public function agendamento($dados, $interpretes) {

    foreach ($interpretes as $id_int) {
        $sql = "INSERT INTO agendamento 
        (id_servico, id_int, id_cli, preco, quantInt, quantHoras, cidade, horaComeca ,codVerify, data, data_insercao, status) 
        VALUES 
        ('{$dados['id_ser']}', '$id_int', '{$dados['id_cli']}', '{$dados['preco']}', '{$dados['quantInt']}','{$dados['quantHoras']}', '{$dados['cidade']}', '{$dados['horaComeca']}','{$dados['codVerify']}','{$dados['data']}', now(), '2')";
        
        /**
        status = 4 = serviço rejeitado
        status = 3 = serviço concluido
        status = 2 = serviço pendente/falta de informação. 
        status = 1 = serviço aceito/pago
        status = 0 = serviço cancelado
        */
        $res = $this->connect()->query($sql);
        if (!$res) {
            $this->connect()->close();
            return 0; // deu erro. OBS: a quantidade de erro q isso me deu pqp, vai se fude
        }
    }

    $this->connect()->close();
    return 1; // so sucesso 
}


public function agendamentoLocal($dados, $idInterpretes) {
    foreach ($idInterpretes as $id_int) {
        $sql = "INSERT INTO agendamentoLocal 
        (id_cli, id_int,cep, rua, numero, bairro, cidade, estado, complemento, infor_adicionais, codVerify, status) 
        VALUES 
        ('{$dados['id_cli']}', {$id_int}, '{$dados['cep']}', '{$dados['rua']}', '{$dados['numero']}', '{$dados['bairro']}', '{$dados['cidade']}', '{$dados['estado']}', '{$dados['complemento']}', '{$dados['infor_adicionais']}', '{$dados['codVerify']}', '2')";


        /**
            status = 4 = serviço rejeitado
            status = 3 = serviço concluido
            status = 2 = serviço pendente/falta de informação. 
            status = 1 = serviço aceito/pago
            status = 0 = serviço cancelado
        */
             
        $res = $this->connect()->query($sql);
        if (!$res) {
            $this->connect()->close();
            return 0; // deu erro
        }
    }
   
    $this->connect()->close();
    return 1; // so sucesso 
}

public function getIdInterprete($codVerify){
    $sql = "SELECT id_int FROM agendamento WHERE codVerify = '{$codVerify}'";
    $res = $this->connect()->query($sql);
    $idInterpretes = [];  // Array para armazenar todos os id_int

    if ($res->num_rows > 0) {
        while ($row = $res->fetch_assoc()) {
            $idInterpretes[] = $row['id_int'];  // Adiciona o id_int ao array
        }
    }

    return $idInterpretes;  // Retorna o array com todos os id_int encontrados
}

public function agendamentoFinalizar($codVerify, $modoPagamento, $idCli){
    $sqlPag = "INSERT INTO pagamento (id_cli, codVerify, modoPagamento, status) VALUES ('{$idCli}', '{$codVerify}', '{$modoPagamento}', '1')";
    $res = $this->connect()->query($sqlPag);

    if($res || $res == 1){
        $sqlAge = "UPDATE agendamento SET status = '1' WHERE codVerify = '{$codVerify}'";    
        $res = $this->connect()->query($sqlAge);

        if ($res || $res == 1) {
            $sqlAgeLocal = "UPDATE agendamentoLocal SET status = '1' WHERE codVerify = '{$codVerify}'"; 
            $res = $this->connect()->query($sqlAgeLocal);   

            if($res || $res == 1){
                $this->connect()->close();
                return true;
            }
        }
        $this->connect()->close();
        return false;
    }

    $this->connect()->close();
    return false;

}

public function agendamentoLocalVerify($dados){
    $sql = "SELECT * FROM agendamento WHERE codVerify = '{$dados['codVerify']}' AND id_cli = '{$dados['id_cli']}'";
    $res = $this->connect()->query($sql);

    if($res->num_rows > 0){
        $this->connect()->close();     
        return 1; // ta bala       
    }

    $this->connect()->close();     
    return 0; //erro
}

public function agendamentoALLPuxar($dados){
    $dados['result'] = 0;
    $countSucRes = 0; // conta quantos $res foram certos
    $dados['interpretes'] = [];

    $sqlAge = "SELECT * FROM agendamento WHERE codVerify = '{$dados['codVerify']}'";
    $res = $this->connect()->query($sqlAge);
    if($res->num_rows > 0){
        $countSucRes += 1;
        while($row = $res->fetch_assoc()){
            $dados["idA"] = $row["id"];
            $dados["id_ser"] = $row["id_servico"];
            $dados["id_cli"] = $row["id_cli"];
            $dados["preco"] = $row["preco"];
            $dados["quantInt"] = $row["quantInt"];
            $dados["quantHoras"] = $row["quantHoras"];
            $dados["cidade"] = $row["cidade"];
            $dados["data"] = $row["data"];
            $dados["status"] = $row["status"];

            $dados['interpretes'][] = $row["id_int"];
        }         
    } else {
        $this->connect()->close();     
        return $dados;
    }

    $sqlAgeLocal = "SELECT * FROM agendamentoLocal WHERE codVerify = '{$dados['codVerify']}'";
    $res = $this->connect()->query($sqlAgeLocal);
    if($res->num_rows > 0){
        $countSucRes += 1;
        while($row = $res->fetch_assoc()){
            $dados["idB"] = $row["id"];
            $dados["cep"] = $row["cep"];
            $dados["rua"] = $row["rua"];
            $dados["numero"] = $row["numero"];
            $dados["bairro"] = $row["bairro"];
            $dados["cidade"] = $row["cidade"];
            $dados["estado"] = $row["estado"];
            $dados["status"] = $row["status"];
        }
    } else {
        $this->connect()->close();     
        return $dados;
    }

    $sqlCli = "SELECT nome FROM cliente WHERE id = '{$dados['id_cli']}'";
    $res = $this->connect()->query($sqlCli);
    if($res->num_rows > 0){
        $countSucRes += 1;
        while($row = $res->fetch_assoc()){
            $dados["nomeCli"] = $row["nome"];
        }
    } else {
        $this->connect()->close();     
        return $dados;
    }

    $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados['id_ser']}'";
    $res = $this->connect()->query($sqlSer);
    if($res->num_rows > 0){
        $countSucRes += 1;
        while($row = $res->fetch_assoc()){
            $dados["nomeSer"] = $row["nome"];
        }
    } else {
        $this->connect()->close();     
        return $dados;
    }

    $dados['nomes_interpretes'] = [];
    foreach($dados['interpretes'] as $id_int) {
        $sqlInt = "SELECT nome FROM interprete WHERE id = '{$id_int}'";
        $res = $this->connect()->query($sqlInt);

        if($res->num_rows > 0){
            $countSucRes += 1;
            while($row = $res->fetch_assoc()){
                $dados['nomes_interpretes'][] = $row["nome"];
            }
        }
    }

    if($countSucRes >= 5){
        $dados['result'] = 1;
    }

    $this->connect()->close();
    return $dados;
}

public function listarHistoricoAgendamentoConcluido($id_cli) {
    $dados = array();
    $dados['result'] = 0;
    $countSucRes = 0; // conta quantos $res foram certos
    $codVerifyListadosA = array(); // Array para armazenar os codVerify já exibidos
    $codVerifyListadosL = array(); // Array para armazenar os codVerify já exibidos

    $iA = 1;
    $iL = 1;

    $sqlAge = "SELECT * FROM agendamento WHERE id_cli = '{$id_cli}' AND status = 3 ";
    $resAge = $this->connect()->query($sqlAge);
    if($resAge->num_rows > 0){
        $countSucRes += 1;
       
        while($row = $resAge->fetch_assoc()){
            if (in_array($row["codVerify"], $codVerifyListadosA)) {
                continue; //se ja tiver um codVerify, pula
            }

            $codVerifyListadosA[] = $row["codVerify"];

            $dados["idA"][$iA] = $row["id"];
            $dados["id_ser"][$iA] = $row["id_servico"];
            $dados["id_cli"][$iA] = $row["id_cli"];
            $dados["preco"][$iA] = $row["preco"];
            $dados["quantInt"][$iA] = $row["quantInt"];
            $dados["quantHoras"][$iA] = $row["quantHoras"];
            $dados["horaComeca"][$iA] = $row["horaComeca"];

            $dados["cidadeA"][$iA] = $row["cidade"];
            $dados["data"][$iA] = $row["data"];
            $dados["statusA"][$iA] = $row["status"];

            $dados["codVerify"][$iA] = $row["codVerify"]; 

            $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados["id_ser"][$iA]}'";
            $resSer = $this->connect()->query($sqlSer);
            if($resSer->num_rows > 0){
                $countSucRes += 1;
                while($row = $resSer->fetch_assoc()){
                    $dados["nomeSer"][$iA] = $row["nome"];
                }
            } 

            $iA++;
        }   
        $dados["numA"] = count($codVerifyListadosA);
      
    }

    $sqlAgeLocal = "SELECT * FROM agendamentoLocal WHERE id_cli = '{$id_cli}' AND status = 3";
    $resAgeLocal = $this->connect()->query($sqlAgeLocal);
    if($resAgeLocal->num_rows > 0){
        $countSucRes += 1;

        while($row = $resAgeLocal->fetch_assoc()){
            if (in_array($row["codVerify"], $codVerifyListadosL)) {
                continue; //se ja tiver um codVerify, pula
            }

            $codVerifyListadosL[] = $row["codVerify"];


            $dados["idL"][$iL] = $row["id"];
            $dados["id_cliL"][$iL] = $row["id_cli"];
            $dados["cep"][$iL] = $row["cep"];
            $dados["rua"][$iL] = $row["rua"];
            $dados["numero"][$iL] = $row["numero"];
            $dados["bairro"][$iL] = $row["bairro"];
            $dados["cidadeL"][$iL] = $row["cidade"];
            $dados["estado"][$iL] = $row["estado"];
            $dados["statusL"][$iL] = $row["status"];

            $dados["codVerify"][$iL] = $row["codVerify"];

            $iL++;
        }
        $dados["numL"] = count($codVerifyListadosL);

    }    

    if($countSucRes > 0){
        $dados['result'] = 1;
    }
    $this->connect()->close();
    return $dados;
}

public function listarHistoricoAgendamentoAndamento($id_cli) {
    $dados = array();
    $dados['result'] = 0;
    $countSucRes = 0; // conta quantos $res foram certos
    $codVerifyListadosA = array(); // Array para armazenar os codVerify já exibidos
    $codVerifyListadosL = array(); // Array para armazenar os codVerify já exibidos

    $iA = 1;
    $iL = 1;

    $sqlAge = "SELECT * FROM agendamento WHERE id_cli = '{$id_cli}' AND status = 1 ";
    $resAge = $this->connect()->query($sqlAge);
    if($resAge->num_rows > 0){
        $countSucRes += 1;
       
        while($row = $resAge->fetch_assoc()){
            if (in_array($row["codVerify"], $codVerifyListadosA)) {
                continue; //se ja tiver um codVerify, pula
            }

            $codVerifyListadosA[] = $row["codVerify"];

            $dados["idA"][$iA] = $row["id"];
            $dados["id_ser"][$iA] = $row["id_servico"];
            $dados["id_cli"][$iA] = $row["id_cli"];
            $dados["preco"][$iA] = $row["preco"];
            $dados["quantInt"][$iA] = $row["quantInt"];
            $dados["quantHoras"][$iA] = $row["quantHoras"];
            $dados["horaComeca"][$iA] = $row["horaComeca"];

            $dados["cidadeA"][$iA] = $row["cidade"];
            $dados["data"][$iA] = $row["data"];
            $dados["statusA"][$iA] = $row["status"];

            $dados["codVerify"][$iA] = $row["codVerify"]; 

            $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados["id_ser"][$iA]}'";
            $resSer = $this->connect()->query($sqlSer);
            if($resSer->num_rows > 0){
                $countSucRes += 1;
                while($row = $resSer->fetch_assoc()){
                    $dados["nomeSer"][$iA] = $row["nome"];
                }
            } 

            $iA++;
        }         
        $dados["numA"] = count($codVerifyListadosA);

    }

    $sqlAgeLocal = "SELECT * FROM agendamentoLocal WHERE id_cli = '{$id_cli}' AND status = 1";
    $resAgeLocal = $this->connect()->query($sqlAgeLocal);
    if($resAgeLocal->num_rows > 0){
        $countSucRes += 1;

        while($row = $resAgeLocal->fetch_assoc()){
            if (in_array($row["codVerify"], $codVerifyListadosL)) {
                continue; //se ja tiver um codVerify, pula
            }

            $codVerifyListadosL[] = $row["codVerify"];


            $dados["idL"][$iL] = $row["id"];
            $dados["id_cliL"][$iL] = $row["id_cli"];
            $dados["cep"][$iL] = $row["cep"];
            $dados["rua"][$iL] = $row["rua"];
            $dados["numero"][$iL] = $row["numero"];
            $dados["bairro"][$iL] = $row["bairro"];
            $dados["cidadeL"][$iL] = $row["cidade"];
            $dados["estado"][$iL] = $row["estado"];
            $dados["statusL"][$iL] = $row["status"];

            $dados["codVerify"][$iL] = $row["codVerify"];

            $iL++;
        }
        $dados["numL"] = count($codVerifyListadosL);

    }    

    if($countSucRes > 0){
        $dados['result'] = 1;
    }
    $this->connect()->close();
    return $dados;
}

public function listarHistoricoAgendamentoConcluidoInt($id_int) {
    $dados = array();
    $dados['result'] = 0;
    $countSucRes = 0; // conta quantos $res foram certos
    $codVerifyListadosA = array(); // Array para armazenar os codVerify já exibidos
    $codVerifyListadosL = array(); // Array para armazenar os codVerify já exibidos

    $iA = 1;
    $iL = 1;

    $sqlAge = "SELECT * FROM agendamento WHERE id_int = '{$id_int}' AND status = 3 ";
    $resAge = $this->connect()->query($sqlAge);
    if($resAge->num_rows > 0){
        $countSucRes += 1;
       
        while($row = $resAge->fetch_assoc()){
            if (in_array($row["codVerify"], $codVerifyListadosA)) {
                continue; //se ja tiver um codVerify, pula
            }

            $codVerifyListadosA[] = $row["codVerify"];

            $dados["idA"][$iA] = $row["id"];
            $dados["id_ser"][$iA] = $row["id_servico"];
            $dados["id_cli"][$iA] = $row["id_cli"];
            $dados["preco"][$iA] = $row["preco"];
            $dados["quantInt"][$iA] = $row["quantInt"];
            $dados["quantHoras"][$iA] = $row["quantHoras"];
            $dados["horaComeca"][$iA] = $row["horaComeca"];

            $dados["cidadeA"][$iA] = $row["cidade"];
            $dados["data"][$iA] = $row["data"];
            $dados["statusA"][$iA] = $row["status"];

            $dados["codVerify"][$iA] = $row["codVerify"]; 

            $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados["id_ser"][$iA]}'";
            $resSer = $this->connect()->query($sqlSer);
            if($resSer->num_rows > 0){
                $countSucRes += 1;
                while($row = $resSer->fetch_assoc()){
                    $dados["nomeSer"][$iA] = $row["nome"];
                }
            } 

            $iA++;
        }     
        $dados["numA"] = count($codVerifyListadosA);
    
    }

    $sqlAgeLocal = "SELECT * FROM agendamentoLocal WHERE id_int = '{$id_int}' AND status = 3";
    $resAgeLocal = $this->connect()->query($sqlAgeLocal);
    if($resAgeLocal->num_rows > 0){
        $countSucRes += 1;

        while($row = $resAgeLocal->fetch_assoc()){
            if (in_array($row["codVerify"], $codVerifyListadosL)) {
                continue; //se ja tiver um codVerify, pula
            }

            $codVerifyListadosL[] = $row["codVerify"];


            $dados["idL"][$iL] = $row["id"];
            $dados["id_cliL"][$iL] = $row["id_cli"];
            $dados["cep"][$iL] = $row["cep"];
            $dados["rua"][$iL] = $row["rua"];
            $dados["numero"][$iL] = $row["numero"];
            $dados["bairro"][$iL] = $row["bairro"];
            $dados["cidadeL"][$iL] = $row["cidade"];
            $dados["estado"][$iL] = $row["estado"];
            $dados["statusL"][$iL] = $row["status"];

            $dados["codVerify"][$iL] = $row["codVerify"];

            $iL++;
        }
        $dados["numL"] = count($codVerifyListadosL);

    }    

    if($countSucRes > 0){
        $dados['result'] = 1;
    }
    $this->connect()->close();
    return $dados;
}

public function listarHistoricoAgendamentoAndamentoInt($id_int) {
    $dados = array();
    $dados['result'] = 0;
    $countSucRes = 0; // conta quantos $res foram certos

    $codVerifyListadosA = array(); // Array para armazenar os codVerify já exibidos
    $codVerifyListadosL = array(); // Array para armazenar os codVerify já exibidos

    $sqlAge = "SELECT * FROM agendamento WHERE id_int = '{$id_int}' AND status = 1 ";
    $resA = $this->connect()->query($sqlAge);
    if($resA->num_rows > 0){
        $countSucRes += 1;
        $i = 1;
        while($row = $resA->fetch_assoc()){
            if (in_array($row["codVerify"], $codVerifyListadosA)) {
                continue; //se ja tiver um codVerify, pula
            }
            $codVerifyListadosA[] = $row["codVerify"];

            $dados["idA"][$i] = $row["id"];
            $dados["id_ser"][$i] = $row["id_servico"];
            $dados["id_cli"][$i] = $row["id_cli"];
            $dados["preco"][$i] = $row["preco"];
            $dados["quantInt"][$i] = $row["quantInt"];
            $dados["quantHoras"][$i] = $row["quantHoras"];
            $dados["horaComeca"][$i] = $row["horaComeca"];

            $dados["cidadeA"][$i] = $row["cidade"];
            $dados["data"][$i] = $row["data"];
            $dados["statusA"][$i] = $row["status"];

            $dados["codVerify"][$i] = $row["codVerify"]; 

            $sqlSer = "SELECT nome FROM servico WHERE id = '{$dados["id_ser"][$i]}'";
            $resSer = $this->connect()->query($sqlSer); // Use $resSer
            if($resSer->num_rows > 0){
                while($rowSer = $resSer->fetch_assoc()){
                    $dados["nomeSer"][$i] = $rowSer["nome"];
                }
            }

            $i++;
        }         
        $dados["numA"] = count($codVerifyListadosA);

    }

    $sqlAgeLocal = "SELECT * FROM agendamentoLocal WHERE id_int = '{$id_int}' AND status = 1";
    $resAL = $this->connect()->query($sqlAgeLocal);
    if($resAL->num_rows > 0){
        $countSucRes += 1;
        $j = 1;
        while($row = $resAL->fetch_assoc()){
            if (in_array($row["codVerify"], $codVerifyListadosL)) {
                continue; //se ja tiver um codVerify, pula
            }
            $codVerifyListadosL[] = $row["codVerify"];

            $dados["idL"][$j] = $row["id"];
            $dados["id_cliL"][$j] = $row["id_cli"];
            $dados["cep"][$j] = $row["cep"];
            $dados["rua"][$j] = $row["rua"];
            $dados["numero"][$j] = $row["numero"];
            $dados["bairro"][$j] = $row["bairro"];
            $dados["cidadeL"][$j] = $row["cidade"];
            $dados["estado"][$j] = $row["estado"];
            $dados["codVerify"][$j] = $row["codVerify"];
            $dados["statusL"][$j] = $row["status"];

            $dados["codVerify"][$j] = $row["codVerify"]; 


            $j++;
        }
        $dados["numL"] = count($codVerifyListadosL);

    }

    if($countSucRes > 0){
        $this->connect()->close();
        $dados['result'] = 1;
    }
    $this->connect()->close();
    return $dados;
}


public function atualizarStatusComData(){
    $dataAtual = date("Y-m-d");

    // Atualiza o status na tabela agendamento
    $sqlAgendamento = "
    UPDATE agendamento
    SET status = 3
    WHERE data < '{$dataAtual}' AND status = 1";

    // Atualiza o status na tabela agendamentolocal usando o codVerify
    $sqlAgendamentoLocal = "
    UPDATE agendamentoLocal al
    JOIN agendamento a ON al.codVerify = a.codVerify
    SET al.status = 3
    WHERE a.data < '{$dataAtual}'";

    // Executa as duas queries
    $resAgendamento = $this->connect()->query($sqlAgendamento);
    $resAgendamentoLocal = $this->connect()->query($sqlAgendamentoLocal);

    // Verifica o resultado das duas operações
    if($resAgendamento && $resAgendamentoLocal){
        $this->connect()->close();
        return 1; // Sucesso em ambas as operações
    } else {
        $this->connect()->close();
        return 0; // Falha em uma ou ambas as operações
    }
}


public function puxarInt(){
    $dados = array();
    $sql = "SELECT * FROM interprete WHERE status = 1";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["num"] = $res->num_rows;
        $dados["result"] = 1;
        $i = 1;
        while($row = $res->fetch_assoc()){
            $dados[$i]["id"] = $row["id"];
            $dados[$i]["nome"] = $row["nome"];
            $dados[$i]["email"] = $row["email"];
            $dados[$i]["telefone"] = $row["telefone"];
            $dados[$i]["nascimento"] = $row["nascimento"];
            $dados[$i]["cpf"] = $row["cpf"];
            $dados[$i]["cidade"] = $row["cidade"];
            $dados[$i]["curriculo"] = $row["curriculo"];
            $dados[$i]["video"] = $row["video"];
            $dados[$i]["status"] = $row["status"];
            
            $i++;
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    } 
}

public function puxarIntComFoto(){
    $dados = array();
    $sql = "SELECT * FROM interprete WHERE status = 1";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["num"] = $res->num_rows;
        $dados["result"] = 1;
        $i = 1;
        while($row = $res->fetch_assoc()){
            $dados[$i]["id"] = $row["id"];
            $dados[$i]["nome"] = $row["nome"];
            $dados[$i]["email"] = $row["email"];
            $dados[$i]["telefone"] = $row["telefone"];
            $dados[$i]["nascimento"] = $row["nascimento"];
            $dados[$i]["cpf"] = $row["cpf"];
            $dados[$i]["cidade"] = $row["cidade"];
            $dados[$i]["curriculo"] = $row["curriculo"];
            $dados[$i]["video"] = $row["video"];
            $dados[$i]["status"] = $row["status"];
            
            $sql_foto = "SELECT foto_perfil FROM interprete_perfil WHERE id_int = {$row["id"]}";
            $res_foto = $this->connect()->query($sql_foto);
            if($res_foto->num_rows > 0) {
                $foto_row = $res_foto->fetch_assoc();
                $dados[$i]["foto_perfil"] = $foto_row["foto_perfil"];
            } else {
                $dados[$i]["foto_perfil"] = null; // Caso não tenha foto
            }
            
            $i++;
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    } 
}


public function listIntALL($nomeInt){
    $dados = array();
    $sql = "SELECT * FROM interprete WHERE nome = '{$nomeInt}'";
    $res = $this->connect()->query($sql);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $dados["id"] = $row["id"];
            $dados["nome"] = $row["nome"];
            $dados["email"] = $row["email"];
            $dados["telefone"] = $row["telefone"];
            $dados["nascimento"] = $row["nascimento"];
            $dados["cpf"] = $row["cpf"];
            $dados["cidade"] = $row["cidade"];
            $dados["curriculo"] = $row["curriculo"];
            $dados["video"] = $row["video"];
            $dados["status"] = $row["status"];
        }
    }

    $sql = "SELECT * FROM interprete_perfil WHERE id_int = '{$dados["id"]}'";
    $res = $this->connect()->query($sql);
    
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $dados["idIP"] = $row["id"];
            $dados["foto_perfil"] = $row["foto_perfil"];
            $dados["video_apre"] = $row["video_apre"];
            $dados["texto_apre"] = $row["texto_apre"];
            $dados["formacao"] = $row["formacao"];
            $dados["tempo_exp"] = $row["tempo_exp"];
            $dados["genero"] = $row["genero"];
            $dados["corRaca"] = $row["corRaca"];
        }
    }

    $dados['id_IntSer'] = [];
    $sql = "SELECT id_servico FROM interprete_servico WHERE id_int = '{$dados["id"]}'";
    $res = $this->connect()->query($sql);

    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $dados['id_IntSer'][] = $row["id_servico"];
        }
    }

    $dados['nome_ser'] = [];
    foreach($dados['id_IntSer'] as $id_ser) {
        $sql = "SELECT id, nome, sobre, serve FROM servico WHERE id = '{$id_ser}'";
        $res = $this->connect()->query($sql);

        if($res->num_rows > 0){
            while($row = $res->fetch_assoc()){
                $dados['id_ser'][] = $row["id"];
                $dados['nome_ser'][] = $row["nome"];
                $dados['sobre_ser'][] = $row["sobre"];
                $dados['serve_ser'][] = $row["serve"];
            }
        }
    }

    $this->connect()->close();   
    return $dados;

}

public function listarCarousel(){
    $dados = array();
    $sql = "SELECT * FROM carrossel";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        $dados["num"] = $res->num_rows;
        $dados["result"] = 1;
        $i = 1;
        while($row = $res->fetch_assoc()){
            $dados[$i]["id"] = $row["id"];

            $dados[$i]["imggd"] = $row["imggd"];
            $dados[$i]["altgd"] = $row["altgd"];
            $dados[$i]["imgpq"] = $row["imgpq"];
            $dados[$i]["altpq"] = $row["altpq"];

            $dados["status"] = $row["status"];
            $i++;
        }
        $this->connect()->close();
        return $dados;
    }else{
        $dados["result"] = 0;
        $this->connect()->close();
        return $dados;
    } 
}

public function puxarAgendamento($codVerify){
    $dados = array();
    $sql = "SELECT * FROM agendamento WHERE codVerify = '{$codVerify}' LIMIT 1";
    $res = $this->connect()->query($sql);
        if($res->num_rows > 0){
            $dados['result'] = 1;
            while($row = $res->fetch_assoc()){
                $dados["id"] = $row["id"];
                $dados["id_ser"] = $row["id_servico"];
                $dados["id_cli"] = $row["id_cli"];
                $dados["preco"] = $row["preco"];
                $dados["quantInt"] = $row["quantInt"];
                $dados["quantHoras"] = $row["quantHoras"];
                $dados["cidade"] = $row["cidade"];
                $dados["horaComeca"] = $row["horaComeca"];
                $dados["codVerify"] = $row["codVerify"];
                $dados["data"] = $row["data"];
                $dados["data_insercao"] = $row["data_insercao"];
                $dados["status"] = $row["status"];
               
            }
            $this->connect()->close();            
        }
        return $dados;

}

public function nomeServico($dados){
    $dadosSNome = array();
    $sql = "SELECT nome FROM servico WHERE id = '{$dados['id_ser']}' ";
    $res = $this->connect()->query($sql);
    if($res->num_rows > 0){
        while($row = $res->fetch_assoc()){
            $dadosSNome['nome_ser'] = $row["nome"];
        }
    }

    return $dadosSNome;
}

public function notaFiscal($dados){
    $compra = array();
    $sql = "SELECT * FROM agendamento WHERE codVerify = '{$dados["codVerify"]}' LIMIT 1";
    $resA = $this->connect()->query($sql);
    if($resA->num_rows > 0){
        while($row = $resA->fetch_assoc()){
            $compra["id_ser"] = $row["id_servico"];
            $compra["preco"] = $row["preco"];
            $compra["quantInt"] = $row["quantInt"];
            $compra["quantHoras"] = $row["quantHoras"];
            $compra["cidade"] = $row["cidade"];
            $compra["data"] = $row["data"];
            $compra["horaComeca"] = $row["horaComeca"];
        }
    }

    $sql = "SELECT * FROM agendamentoLocal WHERE codVerify = '{$dados["codVerify"]}' LIMIT 1";
    $resL = $this->connect()->query($sql);
    if($resL->num_rows > 0){
        while($row = $resL->fetch_assoc()){
            $compra["cep"] = $row["cep"];
            $compra["rua"] = $row["rua"];
            $compra["numero"] = $row["numero"];
            $compra["bairro"] = $row["bairro"];
            $compra["cidade"] = $row["cidade"];
            $compra["estado"] = $row["estado"];
            
        }
    }

    $sql = "SELECT nome FROM servico WHERE id = '{$compra["id_ser"]}' LIMIT 1";
    $resS = $this->connect()->query($sql);
    if($resS->num_rows > 0){
        while($row = $resS->fetch_assoc()){
            $compra["nome_ser"] = $row["nome"];
            
        }
    }

    return $compra;
}


public function avaliDel($id){
    $sql = "DELETE FROM comentarios WHERE id = $id";
    $res = $this->connect()->query($sql);
    
    $this->connect()->close();
    return $res;
}

public function intDel($id){
    $sql = "DELETE FROM interprete WHERE id = $id";
    $res = $this->connect()->query($sql);
    
    $this->connect()->close();
    return $res;
}








































}



