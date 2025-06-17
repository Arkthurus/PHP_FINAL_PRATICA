<?php 

function formNotSent() {
    return $_SERVER['REQUEST_METHOD'] !== 'POST';
}

function blankForm() {
    return empty($_POST['usuario']) || empty($_POST['senha']);
}

function blankGame() {
    return empty($_POST['jogo']) || empty($_POST['nota']);
}

function NumInput(){
    return ctype_digit($_POST['nota']);
}


function errorsTreatment() {

    if (!isset($_GET['code'])) {
        return;
    }

    $code = (int)$_GET['code'];

    switch($code) {

        case 0: 
            $erro = '<h3 style="color: red";>Você não n deveria tentar acessar essaa página 0-0</h3>';
            break;
        
        case 1:
            $erro = '<h3 style="color: red";>Usuário ou senha estão errados fih.</h3>';
            break;

        case 2:
            $erro = '<h3 style="color: red";>Preenche o Form todo né pô</h3>';
            break;

        case 3:
            $erro = '<h3 style="color: red";>Erro ao executar consulta ao banco de dados. 
                    Tente novamente mais tarde, ou contate o suporte kkkkkkk</h3>';
            break;

        case 4:
            $erro = '<h3 style="color: red";>>Erro ao "Bindar parametros"</h3>';

            break;

        case 5:
            $erro = '<h3 style="color: red";>Erro ao executar stmt SQL</h3>';

            break;

        case 6:
            $erro = '<h3 style="color: red";>Email ja cadastrado! use outro</h3>';

        break;
        
        case 7:
            $erro = '<h3 style="color: red";>O Campo nota deve ser um Numero</h3>';

        break;
        
        default:
            $erro = "";
            break;
    }

    echo $erro;


}

?>