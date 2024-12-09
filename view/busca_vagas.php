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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Vagas</title>
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

    .textarea.form-control {
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
                <h3 class="mb-3">Busca de Vagas</h3>
                <form id="formBusca">
                    <div class="mb-2">
                        <label for="cargo" class="form-label">Cargo:</label>
                        <input type="text" class="form-control" id="cargo" name="cargo"
                            placeholder="Digite o cargo desejado">
                    </div>
                    <button type="submit" class="btn btn-custom w-100 mb-2">Buscar</button>
                </form>

                <div id="resultadoBusca" class="mt-3">
                    <!-- Resultados das vagas serão mostrados aqui -->
                </div>

                <div class="mt-3">
                    <a href="/estagio-main/view/adicionar_curriculo.php">
                        <button class="btn btn-outline-warning w-100 mb-2">Cadastrar Currículo</button>
                    </a>
                    <a href="/estagio-main/control/logout.php">
                        <button class="btn btn-outline-danger w-100 mb-2">Sair</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script>
    document.getElementById('formBusca').addEventListener('submit', function(event) {
        event.preventDefault();
        var cargo = document.getElementById('cargo').value;
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var vagas = JSON.parse(xhr.responseText);
                    var resultadoHTML = "";
                    if (vagas.length > 0) {
                        for (var i = 0; i < vagas.length; i++) {
                            resultadoHTML += "<div class='card card-custom mb-3'>";
                            resultadoHTML += "<p><strong>Descrição:</strong> " + vagas[i].descricao +
                                "</p>";
                            resultadoHTML += "<p><strong>Cargo:</strong> " + vagas[i].cargo + "</p>";
                            resultadoHTML += "<p><strong>Salário:</strong> " + vagas[i].salario + "</p>";
                            resultadoHTML += "</div>";
                        }
                    } else {
                        resultadoHTML = "<p>Nenhuma vaga encontrada.</p>";
                    }
                    document.getElementById('resultadoBusca').innerHTML = resultadoHTML;
                } else {
                    console.error('Erro ao buscar vagas.');
                }
            }
        };
        xhr.open("GET", "/estagio-main/control/processar_vaga.php?cargo=" + cargo, true);
        xhr.send();
    });
    </script>
</body>

</html>