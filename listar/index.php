<!DOCTYPE HTML>
<html lang="pt-br">  
    <head>  
        <meta charset="utf-8">
        <title>Celke - Listar com JavaScript</title>
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    </head>
    <body>
		<div class="container">
			<h2>Listar Vendas</h2>
			<span id="conteudo"></span>
		</div>
		
		<script>
			var qnt_result_pg = 25; //quantidade de registro por página
			var pagina = 1; //página inicial
			$(document).ready(function () {
				listar_usuario(pagina, qnt_result_pg); //Chamar a função para listar os registros
			});
			
			function listar_usuario(pagina, qnt_result_pg){
				var dados = {
					pagina: pagina,
					qnt_result_pg: qnt_result_pg
				}
				$.post('listar_usuario.php', dados , function(retorna){
					//Subtitui o valor no seletor id="conteudo"
					$("#conteudo").html(retorna);
				});
			}
		</script>
    </body>
</html>
