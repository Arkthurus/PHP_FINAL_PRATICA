<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.6/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-4Q6Gf2aSP4eDXB8Miphtr37CMZZQ5oXLH2yaXMJ2w8e2ZtHTl7GptT4jmndRuHDT" crossorigin="anonymous">
</head>
<body class="container">
    <a href="index.php"><button>Voltar</button></a>
    <h1>Cadastro de Usuario</h1>

     <h2>Informe os dados para o cadastro:</h2>
    
    <?php 
    
       require_once 'funcoes.php';

       errorsTreatment();   
    
    ?>


    <form action="inserirUser.php" method="post">

        <p>
            <label for="usuarioC">Usuário:</label><br>
            <input type="text" name="usuarioC" id="usuarioC">
        </p>

        <p>
            <label for="senhaC">Senha:</label><br>
            <input type="password" name="senhaC" id="senhaC">
        </p>
        <p>
            <label for="emailC">Email</label><br>
            <input type="email" name="emailC" id="emailC">
        </p>
        <button type="submit" class="btn btn-success">Cadastrar</button>

    </form>
</body>
</html>