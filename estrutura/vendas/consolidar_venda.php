<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;

                                $frota = $pdo->prepare(" SELECT * FROM usuarios where id = $user ORDER BY id");
                                $frota->execute();
                                if($frota->rowCount() > 0){
                                while($carros = $frota->fetch(PDO::FETCH_ASSOC)){
                                    $usuario = $carros["id"];
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
                        <h2>Lançar observação</h2>
                        <label id="att" for="attu" class="botao" value="button">Cadastrar</label>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- select tipo de solicitação -->
                        <select name="tipo" class="cidade" >
                                <option value="x">Tipo de observação</option>
                                <option value="p">Positiva</option>
                                <option value="n">Negativa</option>
                        </select>
                        <!-- select funcionario -->
                        <select name="func" class="cidade" >
                                <option value="x">Funcionário</option>
                                <?php

                                    $vendedor = $pdo->prepare(" SELECT * FROM usuarios WHERE central = '1' AND func_mes = 'S' AND status = 'A' ORDER BY nome ASC");
                                    $vendedor->execute();
                                    if($vendedor->rowCount() > 0){
                                    while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
                                    
                                    ?>
                                <option value="<?=$vender['id'];?>"><?=$vender['nome'];?></option>


                            <?php }} ?>
                        </select>

                    <input class="form" id="data" name="data_ocor" type="text" placeholder="Data ocorrência" REQUIRED>

                    <textarea class="textarea" name="obs" rows="5" type="textarea" placeholder="Observações" REQUIRED></textarea>
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>
                
<!-- script de confirmação do positivo -->

<script>
document.getElementById('att').onclick = function(){
	swal({
	title: 'Confirma?',
	type: 'warning',
	showCancelButton: true,
	confirmButtonColor: '#3085d6',
	cancelButtonColor: '#d33',
	confirmButtonText: 'Sim!',
	cancelButtonText: 'Cancelar'
	}).then((result) => {
	  if (result.value) {
		swal(
		  'Certo!',
		  'ação confirmada!',
		  'success'
		)
	  }
	})
  };
</script>

<!-- fim do sccript -->
            </div>
<?php
                                }}
?>

<?php 

//verifica se clicou
if (isset($_POST["tipo"])){   
    $usuario;
    $tipo = $_POST["tipo"];
    $func = $_POST["func"];
    $obs = $_POST["obs"];
    $data_cad = date("Y-m-d H:i:s");
    $just = 'n';

    // data ocorrencia com explode
    $data_ocor = $_POST["data_ocor"]; 
			$d1 = explode ('/', $data_ocor);
			$data_ocor = $d1[2]."-".$d1[1]."-".$d1[0];

    //verificar se esta vazio algum dado
    if( $tipo != 'x' AND $func != 'x' AND !empty($obs) AND !empty($data_ocor)){

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->observar($usuario, $tipo, $func, $data_ocor, $obs, $data_cad, $just)){



                    ?>

                    <div id="msgsucess" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(47, 165, 63); border: 1px solid white; ">

                    Cadastrado com sucesso!

                    </div>

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

        <div class="msgerro" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(199, 63, 90); border: 1px solid white; ">

        Preencha todos os campos!

        </div>

        <?php

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
