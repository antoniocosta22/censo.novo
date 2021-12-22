$('#form1').submit(function(e){
    e.preventDefault();

    // capturar valores do form
    var name = $('#name').val();
    var comment = $('#comment').val();
    console.log(name, comment);

    // requisitar via ajax
    $.ajax({
        // direciona os dados para o arquivo citado
            url: 'request.php',
            // metodo de formulario
            method: 'POST',
            // dados do form
            data: {name: name, comment: comment},
            // tipo de dados
            dataType: 'json'
            // inicio
    }).done(function(result){
        // limpa os campos
            $('#name').val('');
            $('#comment').val('');
            buscarComentario();
    });
});
// script para buscar dados no banco
function buscarComentario(){
    $.ajax({
        // direciona os dados para o arquivo citado
            url: 'selecionar.php',
            // metodo de formulario
            method: 'GET',
            // tipo de dados
            dataType: 'json'
    }).done(function(result){
            // estrutura de repetição
            for (var i = 0; i < result.length; i++){
                $('.conteudo').prepend('<div class="cont"><h4 class="nome">'+ result[i].nome +'</h4><p class="para">'+ result[i].comentario +'</p></div>')
            };

    });
}
buscarComentario();