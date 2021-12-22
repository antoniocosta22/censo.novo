<?php 

//verificar se clicou no botão
require_once './classes/usuarios.php';
$u = new usuario;
$idcarro = $_GET['f'];
?>

<script src="https://kit.fontawesome.com/a80650ecc6.js" crossorigin="anonymous"></script>
<script src="js/jquery-2.1.3.js"></script>
<script src="js/mascaras.js"></script>

<div class="cardbox">
                <!--Cards de conteudo-->
<?php

$vendedor = $pdo->prepare(" SELECT * FROM frota_automovel where id_automovel = $idcarro");
$vendedor->execute();
while($vender = $vendedor->fetch(PDO::FETCH_ASSOC)){
    $carro = $vender['modelo'];
    $placa = $vender['placa'];
    $respo = $vender['responsavel'];
    $cid = $vender['cidade'];

}
?>               
                <!--fim dos cards-->
            </div>
            <!--detalhe-->
            <div class="detalhes">
                <div class="recentesobs">
                    <div class="cardheader">
                        <h2>CHECKLIST - <?=$carro?></h2>
                        <div class="cardheader">
                        <a class="voltar" href="principal.php?p=gestao_frota.php" style="margin-right: 5px;;">Voltar</a>
                        <label id="att" for="attu" class="botao" value="button">Lançar</label>
                        </div>
                    </div>
                    <!--  inicio  -->
                    <form method="POST" >
                        <!-- nome do cliente -->
                        
                        <?php

                        $res = $pdo->prepare(" SELECT nome FROM usuarios where id = $respo");
                        $res->execute();
                        while($resp = $res->fetch(PDO::FETCH_ASSOC)){
                            $nome_resp = $resp['nome'];

                        }
                        ?>
            
                    <!-- buzina -->
                    <div class="cardheader">
                            
                        <select name="buzina" class="cidade_b">
                        <option value="x">BUZINA</option>
                        <option value="S">SIM</option>
                        <option value="N">NÃO</option>
                        </select>
                        <select name="s_buzina" class="cidade_c">
                        <option value="x">ESTADO</option>
                        <option value="OK">OK</option>
                        <option value="QM">QUEIMADA</option>
                        <option value="DF">DEFEITO</option>
                        <option value="NT">NÃO TEM</option>
                        </select>
                        
                        <input name="info_buzina" class="equipamento" type="text" placeholder="Informações" required>
                    </div>
                    <!-- cinto de segurança -->
                    <div class="cardheader">
                                
                            <select name="cinto" class="cidade_b">
                            <option value="x">CINTO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_cinto" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                           
                            <input name="info_cinto" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--qubra sol-->
                        <div class="cardheader">
                                
                            <select name="q_sol" class="cidade_b">
                            <option value="x">QUEBRA SOL</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_q_sol" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                        
                            <input name="info_q_sol" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                            <!--Retrovisor interno-->
                        <div class="cardheader">
                                
                            <select name="retro_int" class="cidade_b">
                            <option value="x">RETROVISOR INTERNO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_retro_int" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                          
                            <input name="info_retro_int" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                                <!--Retrovisor d/e-->
                        <div class="cardheader">
                            
                            <select name="retro_d_e" class="cidade_b">
                            <option value="x">RETROVISORES EXTERNOS</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_retro_d_e" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_retro_d_e" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--limpador de parabrisa-->
                        <div class="cardheader">
                            
                            <select name="limp_br" class="cidade_b">
                            <option value="x">LIMPADOR PARA-BRISA</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_limp_br" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_limp_br" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--LIMPADOR DE PARABRISA TRASEIRO-->
                        <div class="cardheader">
                            
                            <select name="limp_br_tr" class="cidade_b">
                            <option value="x">LIMPADOR PARA-BRISA TRASEIRO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_limp_br_tr" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_limp_br_tr" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--FAROL BAIXO-->
                        <div class="cardheader">
                            
                            <select name="farol_bx" class="cidade_b">
                            <option value="x">FAROL BAIXO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_farol_bx" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_farol_bx" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--FAROL ALTO-->
                        <div class="cardheader">
                            
                            <select name="farol_alt" class="cidade_b">
                            <option value="x">FAROL ALTO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_farol_alt" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_farol_alt" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--MEIA LUZ-->
                        <div class="cardheader">
                            
                            <select name="meia_luz" class="cidade_b">
                            <option value="x">MEIA LUZ</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_meia_luz" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_meia_luz" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--LUZ DE FREIO-->
                        <div class="cardheader">
                            
                            <select name="luz_freio" class="cidade_b">
                            <option value="x">LUZ DE FREIO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_luz_freio" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_luz_freio" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--LUZ DE RÉ-->
                        <div class="cardheader">
                            
                            <select name="luz_re" class="cidade_b">
                            <option value="x">LUZ DE RÉ</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_luz_re" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_luz_re" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--LUZ DA PLACA-->
                        <div class="cardheader">
                            
                            <select name="luz_placa" class="cidade_b">
                            <option value="x">LUZ DA PLACA</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_luz_placa" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_luz_placa" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--LUZ painel-->
                        <div class="cardheader">
                            
                            <select name="luz_painel" class="cidade_b">
                            <option value="x">LUZ PAINEL</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_luz_painel" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_luz_painel" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--SETAS-->
                        <div class="cardheader">
                            
                            <select name="setas" class="cidade_b">
                            <option value="x">SETAS</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_setas" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_setas" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--PISCA ALERTA-->
                        <div class="cardheader">
                            
                            <select name="pisca_alr" class="cidade_b">
                            <option value="x">PISCA ALERTA</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_pisca_alr" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_pisca_alr" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--luz interna-->
                        <div class="cardheader">
                            
                            <select name="luz_inter" class="cidade_b">
                            <option value="x">LUZ INTERNA</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_luz_inter" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_luz_inter" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--VELOCIMETRO-->
                        <div class="cardheader">
                            
                            <select name="velocimetro" class="cidade_b">
                            <option value="x">VELOCIMETRO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_velocimetro" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_velocimetro" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--freios-->
                        <div class="cardheader">
                            
                            <select name="freios" class="cidade_b">
                            <option value="x">FREIOS</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_freios" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_freios" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--macaco-->
                        <div class="cardheader">
                            
                            <select name="macaco" class="cidade_b">
                            <option value="x">MACACO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_macaco" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_macaco" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--chave de roda-->
                        <div class="cardheader">
                            
                            <select name="chave_rd" class="cidade_b">
                            <option value="x">CHAVE DE RODA</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_chave_rd" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_chave_rd" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--triangulo de sinalização-->
                        <div class="cardheader">
                            
                            <select name="tr_sinal" class="cidade_b">
                            <option value="x">TRIANGULO DE SINALIZAÇÃO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_tr_sinal" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_tr_sinal" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--EXTINTOR DE INCENDIO-->
                        <div class="cardheader">
                            
                            <select name="extintor" class="cidade_b">
                            <option value="x">EXTINTOR</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_extintor" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_extintor" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--TRAVAS/PORTAS-->
                        <div class="cardheader">
                            
                            <select name="port_trav" class="cidade_b">
                            <option value="x">PORTAS - TRAVAS</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_port_trav" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_port_trav" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--alarme-->
                        <div class="cardheader">
                            
                            <select name="alarme" class="cidade_b">
                            <option value="x">ALARME</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_alarme" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_alarme" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--fechamento das janelas-->
                        <div class="cardheader">
                            
                            <select name="fx_janelas" class="cidade_b">
                            <option value="x">FECHAMENTO JANELAS</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_fx_janelas" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_fx_janelas" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--para-brisa-->
                        <div class="cardheader">
                            
                            <select name="parabrisa" class="cidade_b">
                            <option value="x">PARA-BRISA</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_parabrisa" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="DF">DEFEITO</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_parabrisa" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--ÓLEO DO MOTOR-->
                        <div class="cardheader">
                            
                            <select name="oleo_motor" class="cidade_b">
                            <option value="x">ÓLEO DO MOTOR</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_oleo_motor" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="BM">BOM</option>
                            <option value="RM">RUIM</option>
                            </select>
                         
                            <input name="info_oleo_motor" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--ÓLEO DO FREIO-->
                        <div class="cardheader">
                            
                            <select name="oleo_freio" class="cidade_b">
                            <option value="x">ÓLEO DO FREIO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_oleo_freio" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="BM">BOM</option>
                            <option value="RM">RUIM</option>
                            </select>
                         
                            <input name="info_oleo_freio" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--nivel de agua-->
                        <div class="cardheader">
                            
                            <select name="agua_rd" class="cidade_b">
                            <option value="x">AGUA RADIADOR</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_agua_rd" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="BM">BOM</option>
                            <option value="RM">RUIM</option>
                            </select>
                         
                            <input name="info_agua_rd" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--PNEUS - CALIBRAGEM-->
                        <div class="cardheader">
                            
                            <select name="pneu_clb" class="cidade_b">
                            <option value="x">PNEUS/CALIBRAGEM</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_pneu_clb" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="BM">BOM</option>
                            <option value="RM">RUIM</option>
                            </select>
                         
                            <input name="info_pneu_clb" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--PNEUS - estepe-->
                        <div class="cardheader">
                            
                            <select name="pneu_estepe" class="cidade_b">
                            <option value="x">PNEUS/ESPETE</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_pneu_estepe" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_pneu_estepe" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--BANCO ENCOSTO-->
                        <div class="cardheader">
                            
                            <select name="bnc_encost" class="cidade_b">
                            <option value="x">BANCO ENCOSTO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_bnc_encost" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="NT">NÃO TEM</option>
                            </select>
                         
                            <input name="info_bnc_encost" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--PARA CHOQUE DIANTEIRO-->
                        <div class="cardheader">
                            
                            <select name="parachq_d" class="cidade_b">
                            <option value="x">PARA-CHOQUE DIANTEIRO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_parachq_d" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="BM">BOM</option>
                            <option value="RM">RUIM</option>
                            </select>
                         
                            <input name="info_parachq_d" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                        <!--PARA CHOQUE TRASEIRO-->
                        <div class="cardheader">
                            
                            <select name="parachoq_t" class="cidade_b">
                            <option value="x">PARA-CHOQUE TRASEIRO</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_parachoq_t" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="BM">BOM</option>
                            <option value="RM">RUIM</option>
                            </select>
                         
                            <input name="info_parachoq_t" class="equipamento" type="text" placeholder="Informações" required> 
                        </div>
                        <!--LATARIA-->
                        <div class="cardheader">
                            
                            <select name="lataria" class="cidade_b">
                            <option value="x">LATARIA</option>
                            <option value="S">SIM</option>
                            <option value="N">NÃO</option>
                            </select>
                            <select name="s_lataria" class="cidade_c">
                            <option value="x">ESTADO</option>
                            <option value="OK">OK</option>
                            <option value="BM">BOM</option>
                            <option value="RM">RUIM</option>
                            </select>
                         
                            <input name="info_lataria" class="equipamento" type="text" placeholder="Informações" required>
                        </div>
                    <!-- botão de submit -->
                    <input type="submit" id="attu" >
                    </form>


<!--fim-->
                </div>
                
            </div>


<?php 

//verifica se clicou
if (isset($_POST["info_buzina"])){

    $idcarro;
    $buzina = $_POST["buzina"];
    $buzina_s = $_POST["s_buzina"];
    $buzina_info = $_POST["info_buzina"];
    $cinto = $_POST["cinto"];
    $cinto_s = $_POST["s_cinto"];
    $cinto_info = $_POST["info_cinto"];
    $q_sol = $_POST["q_sol"];
    $q_sol_s = $_POST["s_q_sol"];
    $q_sol_info = $_POST["info_q_sol"];
    $retro_int = $_POST["retro_int"];
    $retro_int_s = $_POST["s_retro_int"];
    $retro_int_info = $_POST["info_retro_int"];
    $retro_d_e = $_POST["retro_d_e"];
    $retro_d_e_s = $_POST["s_retro_d_e"];
    $retro_d_e_info = $_POST["info_retro_d_e"];
    $limp_br = $_POST["limp_br"];
    $limp_br_s = $_POST["s_limp_br"];
    $limp_br_info = $_POST["info_limp_br"];
    $limp_br_tr = $_POST["limp_br_tr"];
    $limp_br_tr_s = $_POST["s_limp_br_tr"];
    $limp_br_tr_info = $_POST["info_limp_br_tr"];
    $farol_bx = $_POST["farol_bx"];
    $farol_bx_s = $_POST["s_farol_bx"];
    $farol_bx_info = $_POST["info_farol_bx"];
    $farol_alt = $_POST["farol_alt"];
    $farol_alt_s = $_POST["s_farol_alt"];
    $farol_alt_info = $_POST["info_farol_alt"];
    $meia_luz = $_POST["meia_luz"];
    $meia_luz_s = $_POST["s_meia_luz"];
    $meia_luz_info = $_POST["info_meia_luz"];
    $luz_freio = $_POST["luz_freio"];
    $luz_freio_s = $_POST["s_luz_freio"];
    $luz_freio_info = $_POST["info_luz_freio"];
    $luz_re = $_POST["luz_re"];
    $luz_re_s = $_POST["s_luz_re"];
    $luz_re_info = $_POST["info_luz_re"];
    $luz_placa = $_POST["luz_placa"];
    $luz_placa_s = $_POST["s_luz_placa"];
    $luz_placa_info = $_POST["info_luz_placa"];
    $luz_painel = $_POST["luz_painel"];
    $luz_painel_s = $_POST["s_luz_painel"];
    $luz_painel_info = $_POST["info_luz_painel"];
    $setas = $_POST["setas"];
    $setas_s = $_POST["s_setas"];
    $setas_info = $_POST["info_setas"];
    $pisca_alr = $_POST["pisca_alr"];
    $pisca_alr_s = $_POST["s_pisca_alr"];
    $pisca_alr_info = $_POST["info_pisca_alr"];
    $luz_inter = $_POST["luz_inter"];
    $luz_inter_s = $_POST["s_luz_inter"];
    $luz_inter_info = $_POST["info_luz_inter"];
    $velocimetro = $_POST["velocimetro"];
    $velocimetro_s = $_POST["s_velocimetro"];
    $velocimetro_info = $_POST["info_velocimetro"];
    $freios = $_POST["freios"];
    $freios_s = $_POST["s_freios"];
    $freios_info = $_POST["info_freios"];
    $macaco = $_POST["macaco"];
    $macaco_s = $_POST["s_macaco"];
    $macaco_info = $_POST["info_macaco"];
    $chave_rd = $_POST["chave_rd"];
    $chave_rd_s = $_POST["s_chave_rd"];
    $chave_rd_info = $_POST["info_chave_rd"];
    $tr_sinal = $_POST["tr_sinal"];
    $tr_sinal_s = $_POST["s_tr_sinal"];
    $tr_sinal_info = $_POST["info_tr_sinal"];
    $extintor = $_POST["extintor"];
    $extintor_s = $_POST["s_extintor"];
    $extintor_info = $_POST["info_extintor"];
    $port_trav = $_POST["port_trav"];
    $port_trav_s = $_POST["s_port_trav"];
    $port_trav_info = $_POST["info_port_trav"];
    $alarme = $_POST["alarme"];
    $alarme_s = $_POST["s_alarme"];
    $alarme_info = $_POST["info_alarme"];
    $fx_janelas = $_POST["fx_janelas"];
    $fx_janelas_s = $_POST["s_fx_janelas"];
    $fx_janelas_info = $_POST["info_fx_janelas"];
    $parabrisa = $_POST["parabrisa"];
    $parabrisa_s = $_POST["s_parabrisa"];
    $parabrisa_info = $_POST["info_parabrisa"];
    $oleo_motor = $_POST["oleo_motor"];
    $oleo_motor_s = $_POST["s_oleo_motor"];
    $oleo_motor_info = $_POST["info_oleo_motor"];
    $oleo_freio = $_POST["oleo_freio"];
    $oleo_freio_s = $_POST["s_oleo_freio"];
    $oleo_freio_info = $_POST["info_oleo_freio"];
    $agua_rd = $_POST["agua_rd"];
    $agua_rd_s = $_POST["s_agua_rd"];
    $agua_rd_info = $_POST["info_agua_rd"];
    $pneu_clb = $_POST["pneu_clb"];
    $pneu_clb_s = $_POST["s_pneu_clb"];
    $pneu_clb_info = $_POST["info_pneu_clb"];
    $pneu_estepe = $_POST["pneu_estepe"];
    $pneu_estepe_s = $_POST["s_pneu_estepe"];
    $pneu_estepe_info = $_POST["info_pneu_estepe"];
    $bnc_encost = $_POST["bnc_encost"];
    $bnc_encost_s = $_POST["s_bnc_encost"];
    $bnc_encost_info = $_POST["info_bnc_encost"];
    $parachq_d = $_POST["parachq_d"];
    $parachq_d_s = $_POST["s_parachq_d"];
    $parachq_d_info = $_POST["info_parachq_d"];
    $lataria = $_POST["lataria"];
    $lataria_s = $_POST["s_lataria"];
    $lataria_info = $_POST["info_lataria"];
    $data_alt = date("Y-m-d H:i:s");

        $u->conectar("censo.cas","localhost", "root", "");

        if($u->msgerro == "")//conexão ok

        {   


                if($u->checklist(
                    $idcarro,
                    $buzina,
                    $buzina_s,
                    $buzina_info,
                    $cinto,
                    $cinto_s,
                    $cinto_info,
                    $q_sol,
                    $q_sol_s,
                    $q_sol_info,
                    $retro_int,
                    $retro_int_s,
                    $retro_int_info,
                    $retro_d_e,
                    $retro_d_e_s,
                    $retro_d_e_info,
                    $limp_br,
                    $limp_br_s,
                    $limp_br_info,
                    $limp_br_tr,
                    $limp_br_tr_s,
                    $limp_br_tr_info,
                    $farol_bx,
                    $farol_bx_s,
                    $farol_bx_info,
                    $farol_alt,
                    $farol_alt_s,
                    $farol_alt_info,
                    $meia_luz,
                    $meia_luz_s,
                    $meia_luz_info,
                    $luz_freio,
                    $luz_freio_s,
                    $luz_freio_info,
                    $luz_re,
                    $luz_re_s,
                    $luz_re_info,
                    $luz_placa,
                    $luz_placa_s,
                    $luz_placa_info,
                    $luz_painel,
                    $luz_painel_s,
                    $luz_painel_info,
                    $setas,
                    $setas_s,
                    $setas_info,
                    $pisca_alr,
                    $pisca_alr_s,
                    $pisca_alr_info,
                    $luz_inter,
                    $luz_inter_s,
                    $luz_inter_info,
                    $velocimetro,
                    $velocimetro_s,
                    $velocimetro_info,
                    $freios,
                    $freios_s,
                    $freios_info,
                    $macaco,
                    $macaco_s,
                    $macaco_info,
                    $chave_rd,
                    $chave_rd_s,
                    $chave_rd_info,
                    $tr_sinal,
                    $tr_sinal_s,
                    $tr_sinal_info,
                    $extintor,
                    $extintor_s,
                    $extintor_info,
                    $port_trav,
                    $port_trav_s,
                    $port_trav_info,
                    $alarme,
                    $alarme_s,
                    $alarme_info,
                    $fx_janelas,
                    $fx_janelas_s,
                    $fx_janelas_info,
                    $parabrisa,
                    $parabrisa_s,
                    $parabrisa_info,
                    $oleo_motor,
                    $oleo_motor_s,
                    $oleo_motor_info,
                    $oleo_freio,
                    $oleo_freio_s,
                    $oleo_freio_info,
                    $agua_rd,
                    $agua_rd_s,
                    $agua_rd_info,
                    $pneu_clb,
                    $pneu_clb_s,
                    $pneu_clb_info,
                    $pneu_estepe,
                    $pneu_estepe_s,
                    $pneu_estepe_info,
                    $bnc_encost,
                    $bnc_encost_s,
                    $bnc_encost_info,
                    $parachq_d,
                    $parachq_d_s,
                    $parachq_d_info,
                    $lataria,
                    $lataria_s,
                    $lataria_info,
                    $data_alt,
                    $user
                )){
            

                    ?>

                    <div id="msgsucess" style="text-align: center; padding: 10px; width: fit-content; margin: 10px auto; background-color: rgb(47, 165, 63); border: 1px solid white; ">

                    Checklist Registrado!

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



?>


<!-- fim do script de cadastro de venda -->



<style>
.voltar{
    position: relative;
    padding: 5px 10px;
    background: white;
    color: black;
    border-radius: 5px;
    cursor: pointer;
    text-decoration: none;
}
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
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.form_b {
    margin: 10px 0 0 0;
    background: white;
    border: none;
    font-size: small;
    font-weight: bold;
    display: block;
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
    border-radius: 5px;
    cursor: pointer;
    outline: none;
    padding: 5px;
    width: 100%;
}
.form_a {
    margin: 10px 0 0 3px;
    background: white;
    border: none;
    border-radius: 5px;
    outline: none;
    padding: 5px;
    width: 100%;
}
.form_d {
    margin: 10px 0 0 3px;
    background: white;
    border: none;
    outline: none;
    border-radius: 5px;
    padding: 4px;
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
        border-radius: 5px;
        padding: 4.5px;
        margin: 9.5px 0px 1px 3px;
        border: none;
    }
.cidade_b {
    width: 15%;
    background: white;
    padding: 4.5px;
    border-radius: 5px;
    margin: 9.5px 0px 1px 0px;
    border: none;
}
.cidade_c {
    width: 15%;
    background: white;
    padding: 4.5px;
    border-radius: 5px;
    margin: 9.5px 0px 1px 3px;
    border: none;
}
.cidade_a {
    width: 100%;
    background: white;
    padding: 4.5px;
    border-radius: 5px;
    margin: 9.5px 0px 1px 0px;
    border: none;
}
.equipamento {
    width: 70%;
    border-radius: 5px;
    background: white;
    padding: 4.5px;
    margin: 9.5px 0px 1px 3px;
    border: none;
}

</style>
