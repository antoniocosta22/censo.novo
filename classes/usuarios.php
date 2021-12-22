<?php 
//inicio da classe usuario
class usuario{

    //deixa a classe privada para os elementos dentro dela

    private $pdo;

    //mensagem de erro caso não consiga conexão com o DB

    public $msgerro = "";

    //função conectar com os parametros necessários do PDO

    public function conectar($db, $host, $usuario, $senha){

        global $pdo;

        try {
            $pdo = new PDO('mysql:host=192.168.12.150;dbname=censo.cas;charset=utf8', $usuario, $senha);
        } catch (PDOException $e) {
            $msgerro = $e->getMessage();
        }

    }
    
    public function logar($email, $senha){
        global $pdo;
        //já esta cadastrado? sim, entar
        $sql = $pdo->prepare(" SELECT id, usuario, senha FROM usuarios WHERE usuario = :e AND senha = :s ");
        $sql->bindValue(":e",$email);
        $sql->bindValue(":s",$senha);
        $sql->execute();
        if($sql->rowCount() > 0)
        {
            $dado = $sql->fetch();
            session_start();
            $_SESSION['id_user'] = $dado['id'];
            return true;
        }

        else {
             //caso não, cadastrar
             return false;
        }
       
    }
    // observação dos funcionários

    public function observar($usuario, $tipo, $func, $data_ocor, $obs, $data_cad, $just){
        global $pdo;
        // sql de cadastro da obs
        $sql = $pdo->prepare(" INSERT INTO obs (cadastradopor, tipo, func, data_ocor, obs, data_cad, just) VALUES (:cadpor, :tipo, :func, :dataocor, :obs, :data_cad, :just)");
        
        $sql->bindValue(":cadpor",$usuario);
        $sql->bindValue(":tipo",$tipo);
        $sql->bindValue(":func",$func);
        $sql->bindValue(":dataocor",$data_ocor);
        $sql->bindValue(":obs",$obs);
        $sql->bindValue(":data_cad",$data_cad);
        $sql->bindValue(":just",$just);
        $sql->execute();
        return true;
    
    }
    
    // km
    
    public function lancar_km($user, $ocorrencia, $carro, $km, $obs, $data_cad){
        global $pdo;
        // sql de cadastro da obs
        $sql = $pdo->prepare(" INSERT INTO km_trocas (id_ocorrencia, veiculo, obss, desc_oc, user, data_time) VALUES (:ocorrencia, :veiculo, :obss, :descr, :user, :data_time)");
        
        $sql->bindValue(":ocorrencia", $ocorrencia);
        $sql->bindValue(":veiculo", $carro);
        $sql->bindValue(":obss", $km);
        $sql->bindValue(":descr", $obs);
        $sql->bindValue(":user", $user);
        $sql->bindValue(":data_time", $data_cad);
        $sql->execute();
        return true;
    
    }
    public function lancar_oleo($user, $ocorrencia, $carro, $km_oleo, $km_troca, $obs, $data_cad){
        global $pdo;
        // sql de cadastro da obs
        $sql = $pdo->prepare(" INSERT INTO frota_ocorrencia (id_ocorrencia, veiculo, obs, km, desc_oc, user, data_time) VALUES (:ocorrencia, :veiculo, :obss, :km, :descr, :user, :data_time)");
        
        $sql->bindValue(":ocorrencia", $ocorrencia);
        $sql->bindValue(":veiculo", $carro);
        $sql->bindValue(":obss", $km_oleo);
        $sql->bindValue(":km", $km_troca);
        $sql->bindValue(":descr", $obs);
        $sql->bindValue(":user", $user);
        $sql->bindValue(":data_time", $data_cad);
        $sql->execute();
        return true;
    
    }
    // lançar pontos
    public function pontuar($user, $funcs, $ano_func, $mes_func, $frequ, $pontus, $obs, $data_cad){
        global $pdo;
        // sql de cadastro da obs
        $sql = $pdo->prepare(" INSERT INTO resumo_ponto (func, mes, ano, freq, pont, obs, data_cad, cadastradopor) VALUES 
        (:func, :mes, :ano, :freq, :pont, :obs, :datac, :cadp)");
        
        $sql->bindValue(":func", $funcs);
        $sql->bindValue(":mes", $mes_func);
        $sql->bindValue(":ano", $ano_func);
        $sql->bindValue(":freq", $frequ);
        $sql->bindValue(":pont", $pontus);
        $sql->bindValue(":obs", $obs);
        $sql->bindValue(":datac", $data_cad);
        $sql->bindValue(":cadp", $user);
        $sql->execute();
        return true;
    
    }

    public function cadastrar($indicacao, $indicador, $user, $tipo, $nome, $apelido, $mae, $sexo, $pai, $ender, $ref, $bairro, $cidade, $uf, $cep, $datanasc, $rg, $cpf, $natur, $estcivil, $profi, $fone1, $fone2, $email, $plano, $equip, $neg, $ccred, $parc, $vend, $obs, $datacad, $consolidada){
        global $pdo;
     
            $sql = $pdo->prepare(" INSERT INTO vendas (cadastradopor, tipo, nome, sexo, apelido, pai, mae, ender, ref, bairro, cidade, uf, cep, data_nasc, rg, cpf, natur, estcivil, profi, fone1, fone2, email, plano, equip, neg, ccred, parc, vend, obs, data_cad, indicacao, indicador_nome, consolidada) values ('".$user."','".$tipo."','".$nome."','".$sexo."','".$apelido."','".$pai."','".$mae."','".$ender."','".$ref."','".$bairro."','".$cidade."','".$uf."','".$cep."','".$datanasc."','".$rg."','".$cpf."','".$natur."','".$estcivil."','".$profi."','".$fone1."','".$fone2."','".$email."','".$plano."','".$equip."','".$neg."','".$ccred."','".$parc."','".$vend."','".$obs."','".$datacad."','".$indicacao."','".$indicador."','".$consolidada."')");
            
            $sql->execute();
            return true;
   
    
    }
    public function cadastrar_j($indicacao, $indicador, $user, $tipo, $nome, $apelido, $mae, $sexo, $pai, $ender, $ref, $bairro, $cidade, $uf, $cep, $datanasc, $rg, $cpf, $natur, $estcivil, $profi, $fone1, $fone2, $email, $plano, $equip, $neg, $ccred, $parc, $vend, $obs, $datacad, $consolidada){
        global $pdo;
        //verificar se ja esta cadastrado

            //caso não, cadastrar
            $sql = $pdo->prepare(" INSERT INTO vendas (cadastradopor, tipo, nome, sexo, apelido, pai, mae, ender, ref, bairro, cidade, uf, cep, data_nasc, rg, cpf, natur, estcivil, profi, fone1, fone2, email, plano, equip, neg, ccred, parc, vend, obs, data_cad, indicacao, indicador_nome, consolidada) values ('".$user."','".$tipo."','".$nome."','".$sexo."','".$apelido."','".$pai."','".$mae."','".$ender."','".$ref."','".$bairro."','".$cidade."','".$uf."','".$cep."','".$datanasc."','".$rg."','".$cpf."','".$natur."','".$estcivil."','".$profi."','".$fone1."','".$fone2."','".$email."','".$plano."','".$equip."','".$neg."','".$ccred."','".$parc."','".$vend."','".$obs."','".$datacad."','".$indicacao."','".$indicador."','".$consolidada."') ");
            
            $sql->execute();
            return true;
   
    
    }
    public function atualizar_frota($status, $responsavel, $user, $data_alt, $idcarro, $cidade){
        global $pdo;
        
            //caso não, cadastrar
            $sql = $pdo->prepare(" UPDATE frota_automovel SET stat= :stats, responsavel=:resp, usr_alt=:user_alt, data_alt=:data_alt, cidade=:cidade WHERE id_automovel=:id_carro ");

            $sql->execute(array(
                    ':stats'   => $status,
                    ':resp' => $responsavel,
                    ':user_alt' => $user,
                    ':data_alt' => $data_alt,
                    ':cidade' => $cidade,
                    ':id_carro' => $idcarro
                ));
               
            return true;
    
    }
    // atualizar ferramenta
    public function atualizar_tool($respo, $responsavel, $user, $data_alt, $idtool, $cidade, $tipo_ocorrencia, $descricao){
        global $pdo;

            // insert
            
            //caso não, cadastrar
            $sql = $pdo->prepare(" UPDATE ferramenta_cadastro SET responsavel=:resp, cidade=:cidade WHERE id_ferramenta=:idtool ");

            $sql->execute(array(
                    ':resp' => $responsavel,
                    ':cidade' => $cidade,
                    ':idtool' => $idtool
                ));

        
                    $sql2 = $pdo->prepare(" INSERT INTO ferramenta_ocorrencia (id_ferramenta, tipo_ocorrencia, descricao, usr_origem, usr_dest, data_cad, usr_cad) values ('".$idtool."','".$tipo_ocorrencia."','".$descricao."','".$respo."','".$responsavel."','".$data_alt."','".$user."') ");
    
                    $sql2->execute();
                    return true;
             

            
    
    }
    // entregar ferramenta
    public function entregar_tool($respo, $responsavel, $user, $data_alt, $idtool, $cidade, $tipo_ocorrencia, $descricao){
        global $pdo;

            // atualizar a ferramenta
            $sql = $pdo->prepare(" UPDATE ferramenta_cadastro SET responsavel=:resp, cidade=:cidade WHERE id_ferramenta=:idtool ");

            $sql->execute(array(
                    ':resp' => $responsavel,
                    ':cidade' => $cidade,
                    ':idtool' => $idtool
                ));

                    $sql2 = $pdo->prepare(" INSERT INTO ferramenta_ocorrencia (id_ferramenta, tipo_ocorrencia, descricao, usr_origem, usr_dest, data_cad, usr_cad) values ('".$idtool."','".$tipo_ocorrencia."','".$descricao."','".$user."','".$responsavel."','".$data_alt."','".$user."') ");
                    $sql2->execute();
                    return true;
             
    }
    // atualizar senha do usuario
    public function atualizar_senha($user, $senha){
        global $pdo;
        
            $sql = $pdo->prepare(" UPDATE usuarios SET senha= :pass WHERE id=:id ");

            $sql->execute(array(
                    ':pass'   => $senha,
                    ':id' => $user
                ));
               
            return true;
    
    }
    // atualizar status
    public function atualizar_status($user, $status, $data_alt, $idcarro){
        global $pdo;
        
            //caso não, cadastrar
            $sql = $pdo->prepare(" UPDATE usuarios SET status= :stat, alt_usuario= :usr_alt, alt_data= :data_alt WHERE id=:id ");

            $sql->execute(array(
                    ':stat'   => $status,
                    ':usr_alt' => $user,
                    ':data_alt' => $data_alt,
                    ':id' => $idcarro
                    
                ));
               
            return true;
    
    }
    // cadastrar solicitação
    public function solicitar_serviço($user, $instit, $depart, $solicitacao, $central, $tipo, $descr, $status, $datacad, $repart, $resp){
        global $pdo;

            // insert
            $sql2 = $pdo->prepare(" INSERT INTO solicitacoes (usuario, instit, depart, solicitacao, central, resp, tipo, descr, status, datacad) values ('".$user."','".$instit."','".$depart."','".$solicitacao."','".$central."','".$resp."','".$tipo."','".$descr."','".$status."','".$datacad."') ");
    
            $sql2->execute();
                   
                    
                $sql3 = $pdo->prepare(" INSERT INTO movimento (usuario, solicitacao, central, setor, resp, tipo, descr, dtmov, acao) values ('".$user."','".$solicitacao."','".$central."','".$repart."','".$resp."','".$tipo."','".$descr."','".$datacad."','ABERTA') ");
        
                $sql3->execute();

                        return true;
    
    }
    // cadastrar checklist
    public function checklist( $idcarro, $buzina, $buzina_s, $buzina_info, $cinto, $cinto_s, $cinto_info, $q_sol, $q_sol_s, $q_sol_info, $retro_int, $retro_int_s, $retro_int_info, $retro_d_e, $retro_d_e_s, $retro_d_e_info, $limp_br, $limp_br_s, $limp_br_info, $limp_br_tr, $limp_br_tr_s, $limp_br_tr_info, $farol_bx, $farol_bx_s, $farol_bx_info, $farol_alt, $farol_alt_s, $farol_alt_info, $meia_luz, $meia_luz_s, $meia_luz_info, $luz_freio, $luz_freio_s, $luz_freio_info, $luz_re, $luz_re_s, $luz_re_info, $luz_placa, $luz_placa_s, $luz_placa_info, $luz_painel, $luz_painel_s, $luz_painel_info, $setas, $setas_s, $setas_info, $pisca_alr, $pisca_alr_s, $pisca_alr_info, $luz_inter, $luz_inter_s, $luz_inter_info, $velocimetro, $velocimetro_s, $velocimetro_info, $freios, $freios_s, $freios_info, $macaco, $macaco_s, $macaco_info, $chave_rd, $chave_rd_s, $chave_rd_info, $tr_sinal, $tr_sinal_s, $tr_sinal_info, $extintor, $extintor_s, $extintor_info, $port_trav, $port_trav_s, $port_trav_info, $alarme, $alarme_s, $alarme_info, $fx_janelas, $fx_janelas_s, $fx_janelas_info, $parabrisa, $parabrisa_s, $parabrisa_info, $oleo_motor, $oleo_motor_s, $oleo_motor_info, $oleo_freio, $oleo_freio_s, $oleo_freio_info, $agua_rd, $agua_rd_s, $agua_rd_info, $pneu_clb, $pneu_clb_s, $pneu_clb_info, $pneu_estepe, $pneu_estepe_s, $pneu_estepe_info, $bnc_encost, $bnc_encost_s, $bnc_encost_info, $parachq_d, $parachq_d_s, $parachq_d_info, $lataria, $lataria_s, $lataria_info, $data_alt, $user){
        global $pdo;

        //caso não, cadastrar
        $sql = $pdo->prepare(" INSERT INTO checklist_veiculo 
        ( id_carro, 
        buzina, 
        buzina_s, 
        buzina_info, 
        cinto, 
        cinto_s, 
        cinto_info, 
        q_sol, 
        q_sol_s, 
        q_sol_info, 
        retro_int, 
        retro_int_s, 
        retro_int_info, 
        retro_d_e, 
        retro_d_e_s, 
        retro_d_e_info, 
        limp_br, 
        limp_br_s, 
        limp_br_info, 
        limp_br_tr, 
        limp_br_tr_s, 
        limp_br_tr_info, 
        farol_bx, 
        farol_bx_s, 
        farol_bx_info, 
        farol_alt, 
        farol_alt_s, 
        farol_alt_info, 
        meia_luz, 
        meia_luz_s, 
        meia_luz_info, 
        luz_freio, 
        luz_freio_s, 
        luz_freio_info, 
        luz_re, 
        luz_re_s, 
        luz_re_info, 
        luz_placa, 
        luz_placa_s, 
        luz_placa_info, 
        luz_painel, 
        luz_painel_s, 
        luz_painel_info, 
        setas, 
        setas_s, 
        setas_info, 
        pisca_alr, 
        pisca_alr_s, 
        pisca_alr_info, 
        luz_inter, 
        luz_inter_s, 
        luz_inter_info, 
        velocimetro, 
        velocimetro_s, 
        velocimetro_info, 
        freios, 
        freios_s, 
        freios_info, 
        macaco, 
        macaco_s, 
        macaco_info, 
        chave_rd, 
        chave_rd_s, 
        chave_rd_info, 
        tr_sinal, 
        tr_sinal_s, 
        tr_sinal_info, 
        extintor, 
        extintor_s, 
        extintor_info, 
        port_trav, 
        port_trav_s, 
        port_trav_info, 
        alarme, 
        alarme_s, 
        alarme_info, 
        fx_janelas, 
        fx_janelas_s, 
        fx_janelas_info, 
        parabrisa, 
        parabrisa_s, 
        parabrisa_info, 
        oleo_motor, 
        oleo_motor_s, 
        oleo_motor_info, 
        oleo_freio, 
        oleo_freio_s, 
        oleo_freio_info, 
        agua_rd, 
        agua_rd_s, 
        agua_rd_info, 
        pneu_clb, 
        pneu_clb_s, 
        pneu_clb_info, 
        pneu_estepe, 
        pneu_estepe_s, 
        pneu_estepe_info, 
        bnc_encost, 
        bnc_encost_s, 
        bnc_encost_info, 
        parachq_d, 
        parachq_d_s, 
        parachq_d_info, 
        lataria, 
        lataria_s, 
        lataria_info, 
        data_cad, 
        user_cad ) VALUES 
        ('".$idcarro."',
        '".$buzina."',
        '".$buzina_s."',
        '".$buzina_info."',
        '".$cinto."',
        '".$cinto_s."',
        '".$cinto_info."',
        '".$q_sol."',
        '".$q_sol_s."',
        '".$q_sol_info."',
        '".$retro_int."',
        '".$retro_int_s."',
        '".$retro_int_info."',
        '".$retro_d_e."',
        '".$retro_d_e_s."',
        '".$retro_d_e_info."',
        '".$limp_br."',
        '".$limp_br_s."',
        '".$limp_br_info."',
        '".$limp_br_tr."',
        '".$limp_br_tr_s."',
        '".$limp_br_tr_info."',
        '".$farol_bx."',
        '".$farol_bx_s."',
        '".$farol_bx_info."',
        '".$farol_alt."',
        '".$farol_alt_s."',
        '".$farol_alt_info."',
        '".$meia_luz."',
        '".$meia_luz_s."',
        '".$meia_luz_info."',
        '".$luz_freio."',
        '".$luz_freio_s."',
        '".$luz_freio_info."',
        '".$luz_re."',
        '".$luz_re_s."',
        '".$luz_re_info."',
        '".$luz_placa."',
        '".$luz_placa_s."',
        '".$luz_placa_info."',
        '".$luz_painel."',
        '".$luz_painel_s."',
        '".$luz_painel_info."',
        '".$setas."',
        '".$setas_s."',
        '".$setas_info."',
        '".$pisca_alr."',
        '".$pisca_alr_s."',
        '".$pisca_alr_info."',
        '".$luz_inter."',
        '".$luz_inter_s."',
        '".$luz_inter_info."',
        '".$velocimetro."',
        '".$velocimetro_s."',
        '".$velocimetro_info."',
        '".$freios."',
        '".$freios_s."',
        '".$freios_info."',
        '".$macaco."',
        '".$macaco_s."',
        '".$macaco_info."',
        '".$chave_rd."',
        '".$chave_rd_s."',
        '".$chave_rd_info."',
        '".$tr_sinal."',
        '".$tr_sinal_s."',
        '".$tr_sinal_info."',
        '".$extintor."',
        '".$extintor_s."',
        '".$extintor_info."',
        '".$port_trav."',
        '".$port_trav_s."',
        '".$port_trav_info."',
        '".$alarme."',
        '".$alarme_s."',
        '".$alarme_info."',
        '".$fx_janelas."',
        '".$fx_janelas_s."',
        '".$fx_janelas_info."',
        '".$parabrisa."',
        '".$parabrisa_s."',
        '".$parabrisa_info."',
        '".$oleo_motor."',
        '".$oleo_motor_s."',
        '".$oleo_motor_info."',
        '".$oleo_freio."',
        '".$oleo_freio_s."',
        '".$oleo_freio_info."',
        '".$agua_rd."',
        '".$agua_rd_s."',
        '".$agua_rd_info."',
        '".$pneu_clb."',
        '".$pneu_clb_s."',
        '".$pneu_clb_info."',
        '".$pneu_estepe."',
        '".$pneu_estepe_s."',
        '".$pneu_estepe_info."',
        '".$bnc_encost."',
        '".$bnc_encost_s."',
        '".$bnc_encost_info."',
        '".$parachq_d."',
        '".$parachq_d_s."',
        '".$parachq_d_info."',
        '".$lataria."',
        '".$lataria_s."',
        '".$lataria_info."',
        '".$data_alt."',
        '".$user."')");
        $sql->execute();
        return true;
   
    }

    // cadastrar movimentação 
    public function movimento_chaveiro($user, $chave, $tipo, $func, $data_ocor, $obs, $data_cad){
        global $pdo;

        $sql2 = $pdo->prepare(" UPDATE chave_chaveiros SET resp= :resp, data_alt= :data_alt WHERE id= :id ");

            $sql2->execute(array(
                    ':resp' => $func,
                    ':data_alt' => $data_cad,
                    ':id' => $chave 
                ));

        $sql3 = $pdo->prepare(" INSERT INTO chaveiro_ocorrencia (id_chaveiro, tipo_ocor, id_usr, descr, usr_dest, data_ocor, data_cad) VALUES ('".$chave."', '".$tipo."', '".$user."', '".$obs."', '".$func."', '".$data_ocor."', '".$data_cad."')");
            $sql3->execute();

     
        return true;

    }
    // consolidar venda
    public function consolidar_venda($id_venda, $user, $consolidada, $data_consol, $detalhe_consol, $data_cad_consol){
        global $pdo;
        
            $sql = $pdo->prepare(" UPDATE vendas SET consolidada= :cons, data_consol= :data_con, detalhe_consol= :det_con, usr_consol= :user_con, data_cad_consol= :data_cadc WHERE id=:id ");
            $sql->execute(array(
                    ':cons'   => $consolidada,
                    ':data_con'   => $data_consol,
                    ':det_con'   => $detalhe_consol,
                    ':user_con' => $user,
                    ':data_cadc' => $data_cad_consol,
                    ':id' => $id_venda
                ));
               
            return true;
    
    }
    // consolidar venda
    public function cancelar_venda($id_venda, $user, $consolidada, $data_consol, $detalhe_consol, $data_cad_consol){
        global $pdo;
        
            $sql = $pdo->prepare(" UPDATE vendas SET consolidada= :cons, data_consol= :data_con, detalhe_consol= :det_con, usr_consol= :user_con, data_cad_consol= :data_cadc WHERE id=:id ");
            $sql->execute(array(
                    ':cons'   => $consolidada,
                    ':data_con'   => $data_consol,
                    ':det_con'   => $detalhe_consol,
                    ':user_con' => $user,
                    ':data_cadc' => $data_cad_consol,
                    ':id' => $id_venda
                ));
               
            return true;
    
    }
    // confirmar venda
    public function confirmar_venda($id_venda, $user, $confirmada, $data_conf){
        global $pdo;
        
            $sql = $pdo->prepare(" UPDATE vendas SET confirmada= :conf, data_confir= :data_con, usr_confir= :usr_conf WHERE id=:id ");
            $sql->execute(array(
                    ':conf'   => $confirmada,
                    ':data_con'   => $data_conf,
                    ':usr_conf'   => $user,
                    ':id' => $id_venda
                ));
               
            return true;
    
    }
    // atualizar venda física
    public function atualizar_venda($user, $nome, $apelido, $mae, $sexo, $pai, $ender, $ref, $bairro, $cidade, $cep, $datanasc, $rg, $cpf, $natur, $estcivil, $profi, $fone1, $fone2, $email, $plano, $equip, $neg, $ccred, $parc, $vend, $obs, $datacad, $id_cliente, $indicacao, $indicador){
        global $pdo;
            //caso não, cadastrar
            $sql = $pdo->prepare(" UPDATE vendas SET nome= :nome, sexo= :sexo, apelido= :apelido, pai= :pai, mae= :mae, ender= :ender, ref= :ref, bairro= :bairro, cidade= :cidade, cep= :cep, data_nasc= :data_nasc, rg= :rg, cpf= :cpf, natur= :naturalidade, estcivil= :estcv, profi= :prof, fone1= :fone1, fone2= :fone2, email= :email, plano= :plano, equip= :equipe, neg= :neg, ccred= :ccred, parc= :parce, vend= :vendedor, obs= :obs, indicacao= :indica, indicador_nome= :ind_nome WHERE id= :id");
            $sql->execute(array(
                ':nome'         => $nome,
                ':sexo'         => $sexo,
                ':apelido'      => $apelido,
                ':pai'          => $pai,
                ':mae'          => $mae,
                ':ender'        => $ender,
                ':ref'          => $ref,
                ':bairro'       => $bairro,
                ':cidade'       => $cidade,
                ':cep'          => $cep,
                ':data_nasc'    => $datanasc,
                ':rg'           => $rg,
                ':cpf'          => $cpf,
                ':naturalidade' => $natur,
                ':estcv'        => $estcivil,
                ':prof'         => $profi,
                ':fone1'        => $fone1,
                ':fone2'        => $fone2,
                ':email'        => $email,
                ':plano'        => $plano,
                ':equipe'       => $equip,
                ':neg'          => $neg,
                ':ccred'        => $ccred,
                ':parce'        => $parc,
                ':vendedor'     => $vend,
                ':obs'          => $obs,
                ':indica'       => $indicacao,
                ':ind_nome'     => $indicador,
                ':id'           => $id_cliente
            ));
            
            return true;
        }
        // atualizar venda juridica
    public function atualizar_venda_j($user, $nome, $apelido, $ender, $ref, $bairro, $cidade, $uf, $cep, $datanasc, $rg, $cpf, $natur, $profi, $fone1, $fone2, $email, $plano, $equip, $neg, $ccred, $parc, $vend, $obs, $consolidada, $id_cliente, $indicacao, $indicador){
        global $pdo;
            //caso não, cadastrar
            $sql = $pdo->prepare(" UPDATE vendas SET nome= :nome, apelido= :apelido, ender= :ender, ref= :ref, bairro= :bairro, cidade= :cidade, cep= :cep, data_nasc= :data_nasc, rg= :rg, cpf= :cpf, fone1= :fone1, fone2= :fone2, email= :email, plano= :plano, equip= :equipe, neg= :neg, ccred= :ccred, parc= :parce, vend= :vendedor, obs= :obs, indicacao= :indica, indicador_nome= :ind_nome WHERE id= :id");
            $sql->execute(array(
                ':nome'         => $nome,
                ':apelido'      => $apelido,
                ':ender'        => $ender,
                ':ref'          => $ref,
                ':bairro'       => $bairro,
                ':cidade'       => $cidade,
                ':cep'          => $cep,
                ':data_nasc'    => $datanasc,
                ':rg'           => $rg,
                ':cpf'          => $cpf,
                ':fone1'        => $fone1,
                ':fone2'        => $fone2,
                ':email'        => $email,
                ':plano'        => $plano,
                ':equipe'       => $equip,
                ':neg'          => $neg,
                ':ccred'        => $ccred,
                ':parce'        => $parc,
                ':vendedor'     => $vend,
                ':obs'          => $obs,
                ':indica'       => $indicacao,
                ':ind_nome'     => $indicador,
                ':id'           => $id_cliente
            ));
            
            return true;
        }
        // movimentar solicitação
    public function movimentar_soli($solicitacao, $data_mo, $soli, $user, $status, $nome_depart, $recebido, $user_dest, $central, $detalhe_consol, $data_cad_consol, $acao){
        global $pdo;
 
            //atualziar as informações da solicitação
            $sql = $pdo->prepare(" UPDATE solicitacoes SET central=:cent, data=:data_mo, resp=:resp, status=:stat WHERE solicitacao=:soli ");   
            $sql->execute(array(
                    ':cent' => $central,
                    ':data_mo' => $data_mo,
                    ':resp' => $user_dest,
                    ':stat' => $status,
                    ':soli' => $soli
                ));

                    $sql2 = $pdo->prepare(" INSERT INTO movimento (usuario, solicitacao, central, setor, resp, recebido, tipo, descr, dtmov, acao) 
                    VALUES ('".$user."','".$soli."','".$central."','".$nome_depart."','".$user_dest."','".$recebido."','".$solicitacao."','".$detalhe_consol."','".$data_cad_consol."','".$acao."') ");
                    $sql2->execute();
                    return true;
  
    }
    // encerrar solicitação
    public function encerrar_soli($user, $resp, $soli, $status, $central, $setor, $tipop, $descr, $dtmov, $recebido, $recebedor, $acao, $cobrado, $valor_cobrado, $tipo_problema, $obs_enc){
        global $pdo;

        $sql2 = $pdo->prepare(" INSERT INTO movimento (usuario, solicitacao, central, setor, resp, recebido, tipo, descr, dtmov, acao, recebedor, dtreceb) 
        VALUES ('".$user."','".$soli."','".$central."','".$setor."','".$resp."','".$recebido."','".$tipop."','".$obs_enc."','".$dtmov."','".$acao."','".$recebedor."','".$dtmov."') ");
        $sql2->execute();
        
            $sql = $pdo->prepare(" UPDATE solicitacoes SET resp=:res, status=:stat, cobrado=:cobrado, valor_cobrado=:valor_c, finalizador=:finali WHERE solicitacao=:soli ");   
            $sql->execute(array(
                    ':res' => $user,
                    ':stat' => $status,
                    ':cobrado' => $cobrado,
                    ':valor_c' => $valor_cobrado,
                    ':finali' => $user,
                    ':soli' => $soli
                ));
                    
                    return true;
  
    }
    // atualizar status
    public function alterar_perm($idcarro, $user, $inserir2, $alterar2, $consultar2, $excluir2, $adm2, $fun_mes2, $gerente2, $supervisor2, $vend_meta2, $data_alt){
        global $pdo;
        
            //caso não, cadastrar
            $sql = $pdo->prepare(" UPDATE usuarios SET inserir= '".$inserir2."', alterar= '".$alterar2."', consultar= '".$consultar2."', excluir= '".$excluir2."', adm= '".$adm2."', gvend= '".$gerente2."', supervend= '".$supervisor2."', venda_meta= '".$vend_meta2."', func_mes= '".$fun_mes2."', alt_usuario= '".$user."', alt_data= '".$data_alt."' WHERE id= '".$idcarro."' ");

            $sql->execute();
               
            return true;
    
    }
    // cadastrar usuario
    public function cad_user($data_cad, $uf, $status, $user, $nome, $cidade, $bairro, $ender, $cel1, $cel2, $datanasc, $central, $setor, $funcao, $cargo, $usuario, $senha, $func_mes, $vendedor, $alterar, $consultar, $excluir, $adm, $gerente, $supervisor, $mvend, $patrimonio, $meta_os, $central_cas){
        global $pdo;
        //  cadastro de novos usuários

            $sql = $pdo->prepare(" INSERT INTO usuarios 
            (cadastradopor, status, nome, ender, bairro, cidade, uf, datanasc, cel, fone, instit, depart, cargo, usuario, senha, alterar, consultar, excluir, adm, gvend, supervend, vend, venda_meta, datacad, central, funcao, os_meta, func_mes, patrimonio_adm) VALUES 
            ('".$user."', '".$status."', '".$nome."', '".$ender."', '".$bairro."', '".$cidade."', '".$uf."', '".$datanasc."', '".$cel1."', '".$cel2."', '".$central."', '".$setor."', '".$cargo."', '".$usuario."', '".$senha."', '".$alterar."', '".$consultar."', '".$excluir."', '".$adm."', '".$gerente."', '".$supervisor."', '".$vendedor."', '".$mvend."', '".$data_cad."', '".$central_cas."', '".$funcao."', '".$meta_os."', '".$func_mes."', '".$patrimonio."') ");
            
            $sql->execute();
            
            return true;
    
    }
    // avaliar OS
    public function avaliar_soli($finalizador, $user, $soli, $central, $tipop, $setor, $resp,  $status_r, $recebido_r, $acao_r, $status, $recebido, $data_atual, $acao, $resultado, $avaliacao, $obs_enc){
        global $pdo;

        if ($resultado == 'N'){
            $sql = $pdo->prepare(" INSERT INTO movimento (usuario, solicitacao, central, resp, descr, dtmov, recebido, acao) 
            VALUES ('".$user."', '".$soli."', '".$central."', '".$user."', '".$obs_enc."', '".$data_atual."', '".$recebido_r."', '".$acao_r."') ");
            $sql->execute();

            $sql2 = $pdo->prepare(" UPDATE solicitacoes SET status='".$status_r."', avaliar='".$avaliacao."', finalizador='".$finalizador."', data_finaliz='".$data_atual."' WHERE solicitacao = '".$soli."' ");
            $sql2->execute();
        }else{
            $sql = $pdo->prepare(" INSERT INTO movimento (usuario, solicitacao, central, resp, descr, dtmov, recebido, recebedor, dtreceb, acao) 
            VALUES ('".$user."', '".$soli."', '".$central."', '".$user."', '".$obs_enc."', '".$data_atual."', '".$recebido."', '".$user."', '".$data_atual."', '".$acao."') ");
            $sql->execute();

            $sql2 = $pdo->prepare(" UPDATE solicitacoes SET status='".$status."', avaliar='".$avaliacao."', finalizador='".$finalizador."', data_finaliz='".$data_atual."' WHERE solicitacao = '".$soli."' ");
            $sql2->execute();
        }
           
            return true;
    
    }
    // atualizar chaveiro
    public function atualizar_chaveiro($nome_c, $cidade_c, $chave){
        global $pdo;
        
            $sql = $pdo->prepare(" UPDATE chave_chaveiros SET nome_chaveiro= '".$nome_c."', cidade= '".$cidade_c."' WHERE id= '".$chave."' ");

            $sql->execute();
               
            return true;
    
    }
    // cadastrar frota
    public function cadfrota( $tipo, $marca, $modelo, $placa, $renavam, $chassi, $km, $ano_fab, $ano_mod, $cor, $consumo, $data_compra, $responsavel, $valor_compra, $direcao_h, $som, $ar, $v_eletrico, $alarme, $flex, $f_neb, $obs, $user, $data_completa){
        global $pdo;
        //  cadastro de novos usuários

            $sql2 = $pdo->prepare(" INSERT INTO frota_automovel (tipo, marca, modelo, placa, renavan, chassi, KM, ano_fab, ano_mod, cor, dh, som, ar, ve, alarme, flex, farol_neblina, consumo, valor_compra, data_compra, responsavel, descr, usr_cad, data_cad) 
            VALUES (:tipo, :marca, :modelo, :placa, :renavan, :chassi, :km, :anof, :anom, :cor, :dh, :som, :ar, :vh, :alarme, :flex, :fneb, :cons, :vc, :dc, :resp, :obs, :ucad, :dcom) ");
            $sql2->bindValue(":tipo",$tipo);
            $sql2->bindValue(":marca",$marca);
            $sql2->bindValue(":modelo",$modelo);
            $sql2->bindValue(":placa",$placa);
            $sql2->bindValue(":renavan",$renavam);
            $sql2->bindValue(":chassi",$chassi);
            $sql2->bindValue(":km",$km);
            $sql2->bindValue(":anof",$ano_fab);
            $sql2->bindValue(":anom",$ano_mod);
            $sql2->bindValue(":cor",$cor);
            $sql2->bindValue(":dh",$direcao_h);
            $sql2->bindValue(":som",$som);
            $sql2->bindValue(":ar",$ar);
            $sql2->bindValue(":vh",$v_eletrico);
            $sql2->bindValue(":alarme",$alarme);
            $sql2->bindValue(":flex",$flex);
            $sql2->bindValue(":fneb",$f_neb);
            $sql2->bindValue(":cons",$consumo);
            $sql2->bindValue(":vc",$valor_compra);
            $sql2->bindValue(":dc",$data_compra);
            $sql2->bindValue(":resp",$responsavel);
            $sql2->bindValue(":obs",$obs);
            $sql2->bindValue(":ucad",$user);
            $sql2->bindValue(":dcom",$data_completa);
            $sql2->execute();
            
            return true;
    
    }
    // atualizar chaveiro
    public function atualizar_usuario($nome2, $cidade2, $datanasc2, $endereco2, $bairro2, $cel1, $cel2, $instit2, $depart2, $funcao2, $cargo2, $usuario2, $senha2, $user, $data_atual, $usuario){
        global $pdo;
        
            $sql = $pdo->prepare(" UPDATE usuarios SET nome= :nome, ender= :ender, bairro= :bairro, cidade= :cidade, datanasc= :datanas, cel= :cel1, fone= :cel2, instit= :inst, depart= :depart, cargo= :cargo, usuario= :usuario, senha= :senha, funcao= :funcao, alt_usuario= :alt_u, alt_data= :data_al WHERE id= :user_ids ");
            $sql->execute(array(
                ':nome'          => $nome2,
                ':ender'         => $endereco2,
                ':bairro'        => $bairro2,
                ':cidade'        => $cidade2,
                ':datanas'       => $datanasc2,
                ':cel1'          => $cel1,
                ':cel2'          => $cel2,
                ':inst'          => $instit2,
                ':depart'        => $depart2,
                ':cargo'         => $cargo2,
                ':usuario'       => $usuario2,
                ':senha'         => $senha2,
                ':funcao'        => $funcao2,
                ':alt_u'         => $user,
                ':data_al'       => $data_atual,
                ':user_ids'      => $usuario,
            ));
            $sql->execute();
               
            return true;
    
    }
    // cadastrar tool
    public function cadtool($ferramenta, $descr, $tombo, $nserie, $fabricante, $fornecedor, $notaf, $valor, $data_compra, $cidade, $obs, $data_completa, $user){
        global $pdo;
        //  cadastro de novos usuários

            $sql2 = $pdo->prepare(" INSERT INTO ferramenta_cadastro (ferramenta, descricao, tombo, sn, fabricante, fornecedor, nf, valor_cad, data_compra, valor_atual, cidade, obs, data_cad, usr_cad) 
            VALUES (:tool, :descr, :tombo, :sn, :fab, :forn, :nf, :v_cad, :data_c, :v_atu, :cidade, :obs, :data_cad, :usr_c) ");
            $sql2->bindValue(":tool",$ferramenta);
            $sql2->bindValue(":descr",$descr);
            $sql2->bindValue(":tombo",$tombo);
            $sql2->bindValue(":sn",$nserie);
            $sql2->bindValue(":fab",$fabricante);
            $sql2->bindValue(":forn",$fornecedor);
            $sql2->bindValue(":nf",$notaf);
            $sql2->bindValue(":v_cad",$valor);
            $sql2->bindValue(":data_c",$data_compra);
            $sql2->bindValue(":v_atu",$valor);
            $sql2->bindValue(":cidade",$cidade);
            $sql2->bindValue(":obs",$obs);
            $sql2->bindValue(":data_cad",$data_completa);
            $sql2->bindValue(":usr_c",$user);
            $sql2->execute();
            
            return true;
    
    }
    
    // atualizar chaveiro
    public function atttool($ferramenta2, $descr2, $tombo2, $nserie2, $fabricante2, $fornecedor2, $notaf2, $valor_cad2, $valor_atual2, $data_c2, $cidade2, $obs2, $data_completa, $user, $tool){
        global $pdo;
        
            $sql = $pdo->prepare(" UPDATE ferramenta_cadastro SET ferramenta= :fr, descricao= :descr, tombo= :tb, sn= :sn, fabricante= :fb, fornecedor= :forn, nf= :nf, valor_cad= :vcad, data_compra= :d_com, valor_atual= :v_at, cidade= :cid, obs= :obs, data_alt= :d_alt, usr_alt= :u_alt WHERE id_ferramenta= :tool_id ");
            $sql->execute(array(
                ':fr'    => $ferramenta2,
                ':descr'         => $descr2,
                ':tb'        => $tombo2,
                ':sn'        => $nserie2,
                ':fb'   => $fabricante2,
                ':forn' => $fornecedor2,
                ':nf'   => $notaf2,
                ':vcad'          => $valor_cad2,
                ':d_com'        => $data_c2,
                ':v_at'         => $valor_atual2,
                ':cid'       => $cidade2,
                ':obs'         => $obs2,
                ':d_alt'        => $data_completa,
                ':u_alt'         => $user,
                ':tool_id'      => $tool,
            ));
            $sql->execute();
            
            return true;

    }
    // observar soli
    public function observar_soli($movimento, $user, $obs, $data_mo){
        global $pdo;
            // novo
            $sql = $pdo->prepare(" UPDATE movimento SET obs=:obs, dtobs=:data_mo, usrobs=:resp WHERE id=:soli ");
            $sql->execute(array(
                ':obs' => $obs,
                ':data_mo' => $data_mo,
                ':resp' => $user,
                ':soli' => $movimento
            ));
            $sql->execute();
            
            return true;
    }
    // cancelar soli
    public function cancelar_soli($status, $soli,  $user, $obs, $data_mo){
        global $pdo;
            // novo
            $sql = $pdo->prepare(" UPDATE solicitacoes SET obs=:obs, status=:stats, dtobs=:data_mo, usrobs=:resp WHERE id=:soli ");
            $sql->execute(array(
                ':obs' => $obs,
                ':data_mo' => $data_mo,
                ':resp' => $user,
                ':stats' => $status,
                ':soli' => $soli
            ));
            $sql->execute();
            
            return true;
    }
  // lançar metas

  public function lancar_metas($id_equipe, $tipo_meta, $situacao_meta, $obs_meta, $ano_meta, $mes_meta){
    global $pdo;
        // sql de cadastro da obs
        $sql = $pdo->prepare(" INSERT INTO metas_equipes ( id_equipe, tipo_meta, situacao_meta, obs_meta, ano_meta, mes_meta) VALUES ('".$id_equipe."', '".$tipo_meta."', '".$situacao_meta."', '".$obs_meta."', '".$ano_meta."', '".$mes_meta."')");
        
        $sql->execute();
        return true;

    }
    // fim das obs
 

}
//fim da classe usuario
?>