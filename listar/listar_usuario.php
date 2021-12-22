<?php
include_once "conexao.php";

$pagina = filter_input(INPUT_POST, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$qnt_result_pg = filter_input(INPUT_POST, 'qnt_result_pg', FILTER_SANITIZE_NUMBER_INT);
//calcular o inicio visualização
$inicio = ($pagina * $qnt_result_pg) - $qnt_result_pg;

//consultar no banco de dados
$result_usuario = "SELECT * FROM vendas ORDER BY id DESC LIMIT $inicio, $qnt_result_pg";
$resultado_usuario = mysqli_query($conn, $result_usuario);


//Verificar se encontrou resultado na tabela "usuarios"
if(($resultado_usuario) AND ($resultado_usuario->num_rows != 0)){
	?>
	<table class="table table-striped table-bordered table-hover">
		<thead>
			<tr>
				<th>ID</th>
				<th>Nome</th>
				<th>E-mail</th>
			</tr>
		</thead>
		<tbody>
			<?php
			while($row_usuario = mysqli_fetch_assoc($resultado_usuario)){
				?>
				<tr>
					<th><?php echo $row_usuario['id']; ?></th>
					<td><?php echo $row_usuario['nome']; ?></td>
					<td><?php echo $row_usuario['email']; ?></td>
				</tr>
				<?php
			}?>
		</tbody>
	</table>
<?php
//Paginação - Somar a quantidade de usuários
$result_pg = "SELECT COUNT(id) AS num_result FROM vendas";
$resultado_pg = mysqli_query($conn, $result_pg);
$row_pg = mysqli_fetch_assoc($resultado_pg);

//Quantidade de pagina
$quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

//Limitar os link antes depois
$max_links = 2;

echo "<a href='#' onclick='listar_usuario(1, $qnt_result_pg)'>Primeira</a> ";

for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++){
	if($pag_ant >= 1){
		echo " <a href='#' onclick='listar_usuario($pag_ant, $qnt_result_pg)'>$pag_ant </a> ";
	}
}

echo " $pagina ";

for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
	if($pag_dep <= $quantidade_pg){
		echo " <a href='#' onclick='listar_usuario($pag_dep, $qnt_result_pg)'>$pag_dep</a> ";
	}
}

echo " <a href='#' onclick='listar_usuario($quantidade_pg, $qnt_result_pg)'>Última</a>";
}else{
	echo "<div class='alert alert-danger' role='alert'>Nenhum usuário encontrado!</div>";
}
