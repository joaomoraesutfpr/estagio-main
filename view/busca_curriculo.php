<?php
// Inclua o arquivo SessionManager.php
require __DIR__ . '/../vendor/autoload.php';

// Crie uma instância da classe SessionManager
$sessionManager = new SessionManager();

// Chame o método checkSession() para verificar a sessão
$sessionManager->checkSessionEmpresa();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Currículo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    body {
        background-color: #f0f8f5;
        font-family: Arial, sans-serif;
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
        <h2>Buscar Currículo</h2>
        <form id="formBusca" class="mb-4">
            <div class="mb-2">
                <label for="cargo" class="form-label">Cargo:</label>
                <input type="text" id="cargo" name="cargo" class="form-control"
                    placeholder="Informe o cargo que a empresa busca...">
            </div>
            <button type="submit" class="btn btn-custom w-100">Buscar</button>
        </form>

        <div id="resultadoBusca"></div>
        <a href="/estagio-main/view/adicionar_vaga.php">
            <button class="btn btn-outline-danger w-100">Voltar</button>
        </a>
    </div>

    <?php include "footer.php"; ?>

    <script>
    document.getElementById('formBusca').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o comportamento padrão do formulário

        var cargo = document.getElementById('cargo').value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var curriculos = JSON.parse(xhr.responseText);
                    var resultadoHTML = "";

                    if (curriculos.length > 0) {
                        curriculos.forEach(function(curriculo) {
                            resultadoHTML += "<div class='card card-custom mb-3'>";
                            resultadoHTML += "<div class='card-body'>";
                            resultadoHTML += "<p class='card-text'>Nome do candidato: " +
                                curriculo
                                .descricao + "</p>";
                            resultadoHTML += "<p class='card-text'>Cargo desejado: " + curriculo
                                .cargo + "</p>";
                            resultadoHTML += "<p class='card-text'>E-mail para contato: " +
                                curriculo
                                .experiencia + "</p>";
                            resultadoHTML += "<p class='card-text'>Salário desejado: " + curriculo
                                .salario + "</p>";
                            resultadoHTML += "</div>";
                            resultadoHTML += "</div>";
                        });
                    } else {
                        resultadoHTML = "<p>Nenhum currículo encontrado para o cargo informado.</p>";
                    }

                    document.getElementById('resultadoBusca').innerHTML = resultadoHTML;
                } else {
                    console.error('Erro ao buscar currículos');
                    alert('Ocorreu um erro ao buscar os currículos.');
                }
            }
        };

        xhr.open("GET", "/estagio-main/control/processar_curriculo.php?cargo=" + cargo, true);
        xhr.send();
    });
    </script>
</body>

</html>