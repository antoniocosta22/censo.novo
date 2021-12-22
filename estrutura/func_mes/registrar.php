<?php
// enviar pontos dos funcionários
require_once './classes/usuarios.php';
$u = new usuario;

$func2 = $_GET['func'];
$mesatual = $_GET['mes'];
$anoatual = $_GET['ano'];

// select do usuario
$vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE id = $func2 ");
$vendedor->execute();
while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){

$meta_venda = $vender['venda_meta'];
$meta_oss = $vender['os_meta'];

        // solicitações ótimas
        $os_cont = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND finalizador = $func2 AND avaliar = 4 AND MONTH(data_finaliz) = $mesatual AND YEAR(data_finaliz) = $anoatual");
        $os_cont->execute();
        $cont_os = $os_cont->rowCount($os_cont);
        if ($cont_os < $meta_oss) { $pos = "-1"; }
        elseif ($cont_os == $meta_oss) { $pos = "1"; }
        elseif ($cont_os > $meta_oss) { $pos = "2"; }	
            
        //  solicitações regulares
        $os_reg = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND  finalizador = $func2 AND avaliar = 2 AND MONTH(data_finaliz) = $mesatual AND YEAR(data_finaliz) = $anoatual");
        $os_reg->execute();
        $cont_reg = $os_reg->rowCount($os_reg);

        // solicitações ruins
        $os_ruim = $pdo->prepare(" SELECT id FROM solicitacoes WHERE status = 'EN' AND  finalizador = $func2 AND avaliar = 1 AND MONTH(data_finaliz) = $mesatual AND YEAR(data_finaliz) = $anoatual");
        $os_ruim->execute();
        $cont_ruim = $os_ruim->rowCount($os_ruim);

        // conta as vendas
        $vend_cont = $pdo->prepare(" SELECT id FROM vendas WHERE vend = $func2 AND consolidada = 's' and MONTH(data_consol) = $mesatual and YEAR(data_consol) = $anoatual");
        $vend_cont->execute();
        $cont_vend = $vend_cont->rowCount($vend_cont);
        if ($cont_vend < $meta_venda) { $p_vend = "-1"; }
        elseif ($cont_vend == $meta_venda) { $p_vend = "1"; }
        elseif ($cont_vend > $meta_venda) { $p_vend = "2"; }	

        // soma as observações positivas do usuário
        $obs_p = $pdo->prepare(" SELECT id FROM obs WHERE func = $func2 and MONTH(data_ocor)=$mesatual and YEAR(data_ocor)=$anoatual and tipo = 'p'");
        $obs_p->execute();
        $cont_posi = $obs_p->rowCount($obs_p);

        // soma as observações negativas do usuário
        $obs_n = $pdo->prepare(" SELECT id FROM obs WHERE func = $func2 and MONTH(data_ocor)=$mesatual and YEAR(data_ocor)=$anoatual and tipo = 'n'");
        $obs_n->execute();
        $cont_neg = $obs_n->rowCount($obs_n);

        // pontos de frequencia
        $freq = $pdo->prepare(" SELECT freq FROM resumo_ponto WHERE func = $func2 AND mes= $mesatual AND ano = $anoatual ");
        $freq->execute();
        while($s_freq = $freq->fetch(PDO::FETCH_ASSOC)){
            $pontos_f = $s_freq['freq'];
        }

        // pontos de pontualidade
        $pont = $pdo->prepare(" SELECT pont FROM resumo_ponto WHERE func = $func2 AND mes= $mesatual AND ano = $anoatual ");
        $pont->execute();
        while($s_pont = $pont->fetch(PDO::FETCH_ASSOC)){
            $pontos_p = $s_pont['pont'];
        }

        // Soma o resultado se o funcionário bão bater a meta	   
        if ($cont_vend < $meta_venda) { 
            $pvend = "1"; 
            $r1 = $pvend + $cont_neg + $cont_ruim + $cont_reg;
            $r2 = $pos + $cont_posi + $pontos_f + $pontos_p;
            $total = $r2 - $r1;
            }
            
            // Soma o resultado se o funcionário bater a meta
            elseif ($cont_vend == $meta_venda) { 
            $pvend = "1";
            $r1 = $cont_neg + $cont_ruim + $cont_reg;
            $r2 = $pos + $pvend + $cont_posi + $pontos_f + $pontos_p;
            $total = $r2 - $r1;
            }
            
            // Soma o resultado se o funcionário superar a meta
            elseif ($cont_vend > $meta_venda) { 
            $pvend = "2"; 
            $r1 = $cont_neg + $cont_ruim + $cont_reg;
            $r2 = $pos + $pvend + $cont_posi + $pontos_f + $pontos_p;
            $total = $r2 - $r1;
            }
}
// data atual
    $data_cad = date("Y-m-d H:i:s");


// selecionar dados
    $funcio_mes = $pdo->prepare("SELECT ano, mes, func FROM func_mes WHERE func = $func2 AND mes = $mesatual AND ano = $anoatual");
    $funcio_mes->execute();
    if ($funcio_mes->rowCount() > 0){
        ?>
      <script src="./js/swalert.js"></script>
      <script>
          swal("Erro!", "Dados já cadastrados!","error").then( () => {
              history.back();
          })
      </script>

    <?php 
    }else {
        //caso não, cadastrar
      $sql = $pdo->prepare("INSERT INTO func_mes (ano, mes, func, osotimas, os_meta, os_pontos, osregulares, osruins, vendas, meta, pontos, obspos, obsneg, freq, pont, total, cadastradopor, data_cad) VALUES (:ano, :mes, :func, :osotima, :osmeta, :pontoos, :osreg, :osruim, :vendas, :mvend, :pvend, :posis, :negs, :freq, :pontua, :totais, :cads, :datacad)");
      $sql->bindValue(":ano",$anoatual);
      $sql->bindValue(":mes",$mesatual);
      $sql->bindValue(":func",$func2);
      $sql->bindValue(":osotima",$cont_os);
      $sql->bindValue(":osmeta",$meta_oss);
      $sql->bindValue(":pontoos",$pos);
      $sql->bindValue(":osreg",$cont_reg);
      $sql->bindValue(":osruim",$cont_ruim);
      $sql->bindValue(":vendas",$cont_vend);
      $sql->bindValue(":mvend",$meta_venda);
      $sql->bindValue(":pvend",$p_vend);
      $sql->bindValue(":posis",$cont_posi);
      $sql->bindValue(":negs",$cont_neg);
      $sql->bindValue(":freq",$pontos_f);
      $sql->bindValue(":pontua",$pontos_p);
      $sql->bindValue(":totais",$total);
      $sql->bindValue(":cads",$user);
      $sql->bindValue(":datacad",$data_cad);
     
      $sql->execute();

      ?>
      <script src="./js/swalert.js"></script>
      <script>
        swal("Feito!", "Dados cadastrados!","success").then( () => {
            window.close();
        })
    </script>

    <?php
    }

