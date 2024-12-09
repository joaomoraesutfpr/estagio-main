<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Registro</title>
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

    #resultadoRegistroUsuario {
        margin-bottom: 10px;
    }

    .footer-custom {
        background-color: #8fbc8f;
        color: white;
        padding: 10px 0;
        text-align: center;
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
    </style>
</head>

<body>
    <nav class="navbar navbar-custom">
        <span class="navbar-brand navbar-brand-custom">EstágioOn</span>
    </nav>

    <div class="container px-4 text-center mt-4">
        <div class="d-flex align-content-center flex-wrap justify-content-center">
            <div class="card card-custom" style="width: 300px;">
                <h3 class="mb-3">Registro de Usuário</h3>

                <div id="resultadoRegistroUsuario"></div>

                <form id="formRegistroUsuario" method="post" action="/estagio-main/control/processar_registro.php">
                    <table class="table table-borderless">
                        <tbody>
                            <tr>
                                <td><input type="text" id="username" name="username" required
                                        placeholder="Nome de usuário" class="form-control mb-2"></td>
                            </tr>
                            <tr>
                                <td><input type="password" id="password" name="password" required placeholder="Senha"
                                        class="form-control mb-2"></td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="tipo_usuario">
                                        <h5>Tipo de Usuário:</h5>
                                    </label>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo_usuario"
                                            id="selectCandidato" value="1" checked>
                                        <label class="form-check-label" for="selectCandidato">Candidato</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="radio" name="tipo_usuario"
                                            id="selectEmpresa" value="2">
                                        <label class="form-check-label" for="selectEmpresa">Empresa</label>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-custom w-100 mb-2">Registrar</button>
                    <a href="/estagio-main/index.php">
                        <button type="button" class="btn btn-outline-danger w-100">Cancelar</button>
                    </a>
                </form>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

    <script>
    document.getElementById('formRegistroUsuario').addEventListener('submit', function(event) {
        event.preventDefault();

        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var tipo_usuario = document.querySelector('input[name="tipo_usuario"]:checked').value;

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    document.getElementById('resultadoRegistroUsuario').innerHTML = xhr.responseText;
                } else {
                    console.error('Ocorreu um erro ao enviar a solicitação.');
                }
            }
        };

        xhr.open("POST", "/estagio-main/control/processar_registro.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("username=" + username + "&password=" + password + "&tipo_usuario=" + tipo_usuario);
    });
    </script>
</body>

</html>