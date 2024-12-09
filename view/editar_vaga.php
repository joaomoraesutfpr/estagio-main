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
    <title>Editar Vaga</title>
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
                <h3 class="mb-3">Editar Vaga</h3>
                <div id="resposta"></div>

                <form id="editForm">
                    <div class="mb-2">
                        <label for="descricao" class="form-label">Descrição:</label>
                        <input type="text" class="form-control" id="descricao" name="descricao" required
                            placeholder="Descreva a vaga aqui...">
                    </div>
                    <div class="mb-2">
                        <label for="cargo" class="form-label">Cargo:</label>
                        <input type="text" class="form-control" id="cargo" name="cargo" required
                            placeholder="Digite o cargo da vaga">
                    </div>
                    <div class="mb-2">
                        <label for="salario" class="form-label">Salário:</label>
                        <input type="text" class="form-control" id="salario" name="salario" required
                            placeholder="Informe o salário">
                    </div>
                    <button type="submit" class="btn btn-custom w-100 mb-2">Salvar</button>
                    <a href="/estagio-main/view/adicionar_vaga.php">
                        <button type="button" class="btn btn-outline-danger w-100 mb-2">Voltar</button>
                    </a>
                </form>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script>
    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault(); // Impede o comportamento padrão do formulário
        var form = this;
        var formData = new FormData(form);

        var request = new XMLHttpRequest();
        request.onreadystatechange = function() {
            if (request.readyState === XMLHttpRequest.DONE) {
                if (request.status === 200) {
                    document.getElementById('resposta').innerText = request.responseText;
                } else {
                    console.error('Erro ao editar vaga');
                    alert('Erro ao editar vaga');
                }
            }
        };

        request.open("PUT", "/estagio-main/control/processar_vaga.php?id=" + vagaId, true);
        request.setRequestHeader("Content-Type", "application/json");
        request.send(JSON.stringify(Object.fromEntries(formData)));
    });
    </script>
</body>

</html>