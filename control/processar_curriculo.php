<?php

require __DIR__ . '/../vendor/autoload.php';
require_once 'C:\xampp\htdocs\estagio-main\models\curriculo_model.php'; 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    
    $curModel = new CurriculoModel();
    $cargo = $_GET['cargo'] ?? '';

    $curriculos = $curModel->buscarCurriculosPorCargo($cargo);
    echo json_encode($curriculos);
}

// Verifica se a requisição é do tipo POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $descricao = $_POST['descricao'] ?? '';
    $cargo = $_POST['cargo'] ?? '';
    $experiencias = $_POST['experiencias'] ?? '';
    $salario = $_POST['salario'] ?? '';

    if ($descricao == null || $cargo == null || $experiencias == null || $salario == null){
        echo "Preencha todos os campos com dados";
    }elseif (strlen($descricao) > 255) {
        echo "O perfil pessoal é muito longo!";
    } elseif (strlen($cargo) > 20) {
        echo "O nome do cargo é muito longo!";
    } elseif (strlen($descricao) < 5) {
        echo "Preencha o perfil pessoal!";
    } elseif (strlen($cargo) < 2) {
        echo "O nome do cargo é muito curto!";
    } elseif (strlen($experiencias) > 255) {
        echo "O campo de experiencias excedeu o limite de caracteres!";
    } elseif (!is_numeric($salario)) {
        echo "O valor do salário não é numérico!";
    } else {
        $curModel = new CurriculoModel($descricao, $cargo, $experiencias, $salario);

        $curModel->adicionarCurriculo($descricao, $cargo, $experiencias, $salario);
    }
    
   
}
?>