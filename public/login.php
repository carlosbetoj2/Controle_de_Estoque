<?php
defined('CONTROL') or die('Acesso negado!');

$erro = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $usuario = $_POST['usuario'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if(empty($usuario) || empty($senha)){
        $erro = "Usuário e senha são obrigatórios!";
    } else {
        $usuarios = require_once __DIR__ . '/../inc/usuarios.php';
        $encontrado = false;

        foreach($usuarios as $user){
            if($user['usuario'] == $usuario && password_verify($senha, $user['senha'])){
                $_SESSION['usuario'] = $usuario;
                header('location: index.php?rota=home');
                exit;
            }
        }

        $erro = "Usuário e/ou senha inválidos!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
            background-image: linear-gradient(45deg, cyan, yellow)
        }

        #tela_login {
            background-color: rgba(0, 0, 0, 0.9);
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            padding: 80px;
            border-radius: 15px;
            color: #fff;
        }

        #login input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
        }

        #login button {
            background-color: dodgerblue;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: #fff;
            font-size: 15px;
        }

        #login button:hover {
            background-color: deepskyblue;
            cursor: pointer;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="row">
        <div class="col-md-6">
            <form id="tela_login" class="mt-2" action="index.php?rota=login" method="post">
                <div id="login" class="d-grid gap-2">
                    <h1 class="text-center">Login</h1>
                    <input type="email" placeholder="E-mail" name="usuario" id="usuario"
                           class="form-control mb-2 <?php echo !empty($erro) ? 'is-invalid' : ''; ?>" required>
                    <input type="password" placeholder="Senha" name="senha" id="senha"
                           class="form-control mb-2 <?php echo !empty($erro) ? 'is-invalid' : ''; ?>" required>

                    <?php if (!empty($erro)) : ?>
                        <div class="invalid-feedback">
                            <?php echo $erro; ?>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary">Entrar</button>
                </div>

                <div class="mt-3">
                    <div class="d-grid gap-2">
                        <button type="button" class="btn btn-link" data-bs-toggle="modal"
                                data-bs-target="#cadastro_usuario">Seu primeiro acesso? Cadastre-se!
                        </button>
                        <button type="button" class="btn btn-link">Esqueci minha senha</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<?php if(!empty($erro)) : ?>
    <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
        <?php echo $erro; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php endif; ?>

<script src="../js/bootstrap.bundle.min.js"></script>
</body>
</html>
