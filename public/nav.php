<?php
defined('CONTROL') or die('Acesso negado!');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <style>
    .custom-navbar {
      background-color: #3d3d3d; /* fundo preto */
      color: #ffffff; /* texto branco */
      padding: 20px; /* espaço interno */
    }
  </style>
</head>
<body>
  <div class="mb-5" >
    <nav class="d-flex justify-content-between align-items-center custom-navbar">
      <div>
        <a class="btn btn-link text-white" href="?rota=home">Home</a>
        <a class="btn btn-link text-white" href="?rota=produtos">Produtos</a>
        <a class="btn btn-link text-white" href="?rota=fornecedores">Fornecedores</a>
      </div>
      <div>
        <span class="text-white">Usuário: <strong><?= $_SESSION['usuario']?></strong></span>
        <span>
          <a class="text-white" href="?rota=logout">Sair</a>
        </span>
      </div>
    </nav>
  </div>
</body>
</html>
