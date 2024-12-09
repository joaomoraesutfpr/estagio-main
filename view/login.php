<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Login</title>
    <style>
    body {
        background-color: #f0f8f5;
        font-family: Arial, sans-serif;
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
    }

    .btn-custom:hover {
        background-color: #76c776;
        color: white;
    }

    .card-custom {
        border: none;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
    }

    .footer-custom {
        background-color: #8fbc8f;
        color: white;
        padding: 10px 0;
        text-align: center;
    }
    </style>
</head>

<body>
    <nav class="navbar navbar-custom">
        <span class="navbar-brand navbar-brand-custom">EstágioOn</span>
    </nav>
    <div class="container px-4 text-center mt-5">
        <div class="d-flex align-content-center flex-wrap justify-content-center">
            <div class="card card-custom p-4" style="width: 300px;">
                <h3 class="mb-3">Login</h3>
                <form id="loginForm" action="/estagio-main/control/processar_login.php" method="POST">
                    <div class="mb-3">
                        <input type="text" id="username" name="username" class="form-control" required
                            placeholder="Usuário">
                    </div>
                    <div class="mb-3">
                        <input type="password" id="password" name="password" class="form-control" required
                            placeholder="Senha">
                    </div>
                    <button type="submit" class="btn btn-custom w-100 mb-2">Login</button>
                    <a href="/estagio-main/view/registro.php">
                        <button type="button" class="btn btn-outline-primary w-100">Cadastre-se</button>
                    </a>
                </form>
            </div>
        </div>
    </div>

    <?php include "footer.php"; ?>

</body>

</html>