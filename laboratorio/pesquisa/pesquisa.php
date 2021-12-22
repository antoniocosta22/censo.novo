<script>
        $(document).ready(function() {
            $('#pesquisa').DataTable({
                "language": {
                    "url": "json/Portuguese-Brasil.json"
                }
            });
        } );

        
    </script>
<?php
	//recebemos nosso par�metro vindo do form
	$parametro = isset($_POST['pesquisaCliente']) ? $_POST['pesquisaCliente'] : null;
	$msg = "";
	//come�amos a concatenar nossa tabela
	$msg .="<table class='table table-hover' id='pesquisa'>";
	$msg .="	<thead>";
	$msg .="		<tr>";
	$msg .="			<th>#</th>";
	$msg .="			<th>Nome:</th>";
	$msg .="			<th>E-mail:</th>";
	$msg .="		</tr>";
	$msg .="	</thead>";
	$msg .="	<tbody>";
				
				//requerimos a classe de conex�o
				require_once('class/Conexao.class.php');
					try {
						$pdo = new Conexao(); 
						$resultado = $pdo->select("SELECT * FROM vendas WHERE nome LIKE '$parametro%' ORDER BY nome ASC");
						$pdo->desconectar();
								
						}catch (PDOException $e){
							echo $e->getMessage();
						}	
						//resgata os dados na tabela
						if(count($resultado)){
							foreach ($resultado as $res) {

	$msg .="				<tr>";
	$msg .="					<td>".$res['id']."</td>";
	$msg .="					<td>".$res['nome']."</td>";
	$msg .="					<td>".$res['email']."</td>";
	$msg .="				</tr>";
							}	
						}else{
							$msg = "";
							$msg .="Nenhum resultado foi encontrado...";
						}
	$msg .="	</tbody>";
	$msg .="</table>";
	//retorna a msg concatenada
	echo $msg;
?>