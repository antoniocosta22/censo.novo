<?php 

require_once './classes/usuarios.php';
$u = new usuario;

?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>
<script src="/js/swalert.js"></script>
<script>

$("#cpf").mask("000.000.000-00");
$("#data").mask("00/00/0000");
$("#rg").mask("000.000.000.000-00");
$("#cep").mask("00000-000");
$("#celular").mask("(00)00000-0000");
$("#celular2").mask("(00)00000-0000");

</script>




<div class="cardbox">
                <!--Cards de conteudo-->
                
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>Lançar Metas </h2>
                        <div class="dropdown">
                        <label id="att" for="attu" class="botao" value="button">Incluir</label>
                        <a href="javascript:window.close()" title="Fechar" class="dropbtn" style="padding: 7px 16px; border-radius: 5px; background: red; color: white; text-decoration: none; "> <strong> X </strong></a>
                        </div>
                    </div>
                    <!--  inicio  -->
                    <form action="" method="POST" >
                    <div class="cardheader">
                        <!-- EQUIPE -->
                    <select name="equipe" class="cidade">
                                        <option value="x">EQUIPE</option>
                                        <option value="1">MAGNATAS</option>
                                        <option value="2">VISIONÁRIOS</option>
                    </select>
                    <!-- META -->
                    <select name="meta" class="equipamento">
                                        <option value="x">META</option>
                                        <option value="1">COBRANÇA</option>
                                        <option value="2">MIGRAÇÃO</option>
                                        <option value="3">CRESCIMENTO</option>
                                        <option value="4">RESGATE</option>
                                        <option value="5">RECLAMAÇÃO</option>
                    </select>
                    </div>
                    <div class="cardheader">
                        <!-- EQUIPE -->
                    <select name="situacao" class="cidade">
                                        <option value="x">SITUAÇÃO</option>

                                        <option value="SIM">BATEU A META</option>
                                        <option value="SIM+">SUPEROU A META ADVERSÁRIA</option>
                                        <option value="NAO">NÃO BATEU A MEYA</option>
                    </select>
                    <!-- META -->
                    <input name="obs" type="text" class="equipamento" placeholder="Observação">
                    </div>
                    <div class="cardheader">
                        <!-- EQUIPE -->
                    <select name="ano" class="cidade">
                                        <option value="<?= date('Y')?>">ANO</option>

                                        <option value="<?= date('Y')?>" selected><?= date('Y')?></option>
                                        <option value="<?= date('Y') -1?>"><?= date('Y') -1?></option>
                                    
                    </select>
                    <!-- META -->
                    <select name="mes" class="equipamento">
                                        <option value="x">MÊS</option>

                                        <option value="1">JANEIRO</option>
                                        <option value="2">FEVEREIRO</option>
                                        <option value="3">MARÇO</option>
                                        <option value="4">ABRIL</option>
                                        <option value="5">MAIO</option>
                                        <option value="6">JUNHO</option>
                                        <option value="7">JULHO</option>
                                        <option value="8">AGOSTO</option>
                                        <option value="9">SETEMBRO</option>
                                        <option value="10">OUTUBRO</option>
                                        <option value="11">NOVEMBRO</option>
                                        <option value="12">DEZEMBRO</option>
                                    
                    </select>
                    </div>
                    <input type="submit" id="attu" >
                    </form>
<!--fim-->
                </div>

</div>

<?php 

//verifica se clicou
if (isset($_POST['equipe'])){   
    $id_equipe = $_POST['equipe'];
    $tipo_meta = $_POST['meta'];
    $situacao_meta = $_POST['situacao'];
    $obs_meta = $_POST['obs'];
    $ano_meta = $_POST['ano'];
    $mes_meta = $_POST['mes'];

    // busca

    $solis = $pdo->prepare("SELECT id_equipe, ano_meta, mes_meta FROM metas_equipes WHERE id_equipe = $id_equipe AND tipo_meta = $tipo_meta AND ano_meta = $ano_meta AND mes_meta = $mes_meta ");
    $solis->execute();
    if ($solis->rowCount() > 0){
        ?>
      <script src="./js/swalert.js"></script>
      <script>
          swal("Erro!", "Dados já cadastrados!","error").then( () => {
              history.back();
          })
      </script>

    <?php 
    }else {

    // fim biusca

        //verificar se esta vazio algum dado
        if($id_equipe != 'x' AND $tipo_meta != 'x' AND $situacao_meta != 'x' AND $ano_meta != 'x' AND $mes_meta != 'x'){

            $u->conectar("censo.cas","localhost", "root", "");

            if($u->msgerro == "")//conexão ok
            {   
                    if($u->lancar_metas($id_equipe, $tipo_meta, $situacao_meta, $obs_meta, $ano_meta, $mes_meta)){

                        ?>

                        <script src="./js/swalert.js"></script>
                        <script>
                            swal("Feito!", "Meta registrada!","success").then( () => {
                                history.back();
                            })
                        </script>

                        <?php

                    }
                    else{

                        ?>
                        <div class="msgerro" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(199, 63, 90); border: 1px solid white; ">
                        O CPF já existe no nosso banco de dados!
                        </div>
                        <?php

                    }
            }

            else{
                ?>
                <div class="msgerro" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(199, 63, 90); border: 1px solid white; ">

                    <?php echo "Erro: ".$u->msgerro;?>

                </div>
                <?php
            }
        }
        else{

            ?>
                <script src="./js/swalert.js"></script>
                <script>
                    swal("Erro!", "Preencha todos os campos!","error").then( () => {
                        history.back();
                    })
                </script>
            <?php
        }

    }

}



?>


<!-- fim do script de cadastro de venda -->



<style>
#att {
    position: relative;
    padding: 5px 10px;
    background: white;
    color: black;
    cursor: pointer;
    text-decoration: none;
}
input[type="submit"]{
    display: none;
}
.form {
    margin: 10px 0 0 0;
    background: white;
    border: none;
    cursor: pointer;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.textarea {
    margin: 10px 0 0 0;
    background: white;
    border: none;
    resize: none;
    cursor: pointer;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.dropbtn {
    color: black;
    font-size: 14px;
    border-radius: 5px;
    border: none;
    cursor: pointer;
}
.cardheader h2 {
    color: white;
}
.cardbox {
    padding: 10px;
}
.detalhes {
    position: relative;
    width: 100%;
    padding: 20px;
    padding-top: 0;
    display: grid;
    grid-gap: 20px;
    grid-template-columns: 1fr;
}
.detalhes .recentesobs {
    position: relative;
    height: auto;
    min-height: auto;
    background: rgb(19, 103, 182);
    padding: 20px;
}
select {
    outline: none;
}
.sexo {
        width: 100%;
        background: white;
        padding: 4.5px;
        border-radius: 5px;
        margin: 9.5px 0px 1px 3px;
        border: none;
    }
.cidade {
    width: 100%;
    background: white;
    cursor: pointer;
    border-radius: 5px;
    padding: 4.5px;
    margin: 9.5px 0px 1px 0px;
    border: none;
}
.equipamento {
    width: 100%;
    border-radius: 5px;
    background: white;
    padding: 4.5px;
    margin: 9.5px 0px 1px 3px;
    border: none;
}
@media (max-width: 480px) 
{
    .form {
    margin: 10px 0 0 0;
    background: white;
    border: none;
    cursor: pointer;
    height: 40px;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
    }
    .cidade {
    width: 100%;
    background: white;
    cursor: pointer;
    height: 40px;
    border-radius: 5px;
    padding: 4.5px;
    margin: 9.5px 0px 1px 0px;
    border: none;
    }
}

</style>
