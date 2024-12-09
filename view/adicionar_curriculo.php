<?php

// Inclua o arquivo SessionManager.php
require __DIR__ . '/../vendor/autoload.php';

// Crie uma instância da classe SessionManager
$sessionManager = new SessionManager();

// Chame o método checkSession() para verificar a sessão
$sessionManager->checkSessionCliente();

?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Adicionar Currículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body {
        background-color: #f0f8f5;
        font-family: Arial, sans-serif;
        overflow-y: auto;
        margin: 0;
        padding: 0;
    }

    .navbar-custom {
        background-color: #8fbc8f;
        display: flex;
        justify-content: center;
    }

    .navbar-brand-custom {
        font-size: 2em;
        font-weight: bold;
        color: white;
        text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.2);
    }

    .btn-custom {
        background-color: #90ee90;
        color: white;
        border: none;
        padding: 8px;
    }

    .btn-custom:hover {
        background-color: #76c776;
        color: white;
    }

    .card-custom {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        padding: 20px;
    }

    .form-control {
        padding: 8px;
        font-size: 14px;
    }

    .form-check-label {
        font-size: 14px;
    }

    .w-100 {
        width: 100%;
    }

    .mb-2 {
        margin-bottom: 10px;
    }

    .footer-custom {
        background-color: #8fbc8f;
        color: white;
        padding: 10px 0;
        text-align: center;
    }

    textarea.form-control {
        min-height: 150px;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom">
        <span class="navbar-brand navbar-brand-custom">EstágioOn</span>
    </nav>

    <div class="container px-4 text-center mt-4">
        <div class="d-flex align-content-center flex-wrap justify-content-center">
            <div class="card card-custom" style="width: 500px;">
                <h3 class="mb-3">Adicionar Currículo</h3>
                <div id="resultadoAdicionarCurriculo"></div>

                <form id="formAdicionarCurriculo" action="/estagio-main/control/processar_curriculo.php" method="post">
                    <div class="mb-2">
                        <label for="descricao" class="form-label">Nome completo:</label>
                        <input id="descricao" name="descricao" class="form-control" required
                            placeholder="Digite seu nome completo">
                    </div>
                    <div class="mb-2">
                        <label for="cargo" class="form-label">Cargo desejado:</label>
                        <input type="text" id="cargo" name="cargo" class="form-control" required
                            placeholder="Digite o cargo desejado">
                    </div>
                    <div class="mb-2">
                        <label for="experiencias" class="form-label">E-mail de contato:</label>
                        <input type="email" id="experiencias" name="experiencias" class="form-control" required
                            placeholder="Digite seu e-mail">
                    </div>
                    <div class="mb-2">
                        <label for="salario" class="form-label">Salário desejado:</label>
                        <input type="text" id="salario" name="salario" class="form-control" required
                            placeholder="Informe o salário desejado">
                    </div>
                    <button type="submit" class="btn btn-custom w-100 mb-2">Adicionar Currículo</button>
                    <a href="/estagio-main/view/busca_vagas.php">
                        <input type="button" class="btn btn-outline-danger w-100 mb-2" value="Voltar">
                    </a>
                </form>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script>
    document.getElementById('formAdicionarCurriculo').addEventListener('submit', function(event) {
        event.preventDefault(); // Evita o comportamento padrão do formulário

        // Obtém os dados do formulário
        var descricao = document.getElementById('descricao').value;
        var cargo = document.getElementById('cargo').value;
        var experiencias = document.getElementById('experiencias').value;
        var salario = document.getElementById('salario').value;

        // Cria uma nova solicitação AJAX
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Exibe o resultado na div correspondente
                    document.getElementById('resultadoAdicionarCurriculo').innerHTML = xhr.responseText;
                } else {
                    console.error('Ocorreu um erro ao enviar a solicitação.');
                }
            }
        };

        // Abre a conexão e envia os dados do formulário
        xhr.open("POST", "/estagio-main/control/processar_curriculo.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("descricao=" + descricao + "&cargo=" + cargo + "&experiencias=" + experiencias + "&salario=" +
            salario);
    });

    $(document).ready(function() {
        // Verificar sessão ao carregar a página
        verificarSessao();

        // Função para verificar sessão
        function verificarSessao() {
            $.ajax({
                url: 'verificar_sessao.php',
                method: 'GET',
                success: function(response) {
                    alert('Sessão está ativa.');
                },
                error: function(xhr, status, error) {
                    alert('Sessão não está ativa ou expirou.');
                }
            });
        }
    });
    </script>
</body>

</html>