<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Laboratorio</title>
</head>
<body>
    <section>
        <div>
            <h1>Deixe seu comentário</h1>
            <form id="form1">
                <label for="name">Nome</label><br>
                <input type="text"name="name" id="name"><br>
                <label for="comment">Comentário</label><br>
                <input type="text"name="comment" id="comment"><br>
                <input type="submit" form="form1"><br>
            </form>
        </div>
        <div class="conteudo">
            
        </div>
    </section>
    <script src="js/jquery.js"></script>
    <script src="js/scripts.js"></script>

<style>

    .conteudo {
        display: block;
        font-size: large;
        padding: 20px;
        gap: 20px;
    }
    .nome {
        text-align: center;
        border: 1px solid;
        padding: 5px 15px;
        font-size: 13px;
    }
    .cont {
        display: flex;
        height: max-content;
    }
    .para {
        text-align: center;
        padding: 5px 15px;
        font-size: 12px;
    }
</style>
</body>
</html>
