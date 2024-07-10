<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <style>
    /* Estilos CSS adicionais */
    .icon-button {
      background: none;
      border: none;
      padding: 0;
    }
    .header-container {
      display: flex;
      align-items: center;
    }
    .add-icon, .edit-icon, .delete-icon {
      width: 24px;
      height: 24px;
    }
  </style>
  <title>SmartShopManager</title>
</head>
<body>

  <?php require 'nav.php' ?>

  <div class="container-xxl">
    <div class="main">
      <div class="header-container d-flex justify-content-between align-items-center">
        <h2>Clientes</h2>
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#cadastro-clientes">Cadastrar</button>
      </div>
    </div>
  </div>

  <?php require '../inc/clientes.php' ?>
  
  <div class="container-xxl">
    <table class="table tabela_clientes">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Contato</th>
          <th>Endereço</th>
          <th>CPF</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($clientes as $cliente) {
            echo "<tr>";
            echo "<tr data-id='{$cliente['id']}'>";
            echo "<td>{$cliente['id']}</td>";
            echo "<td>{$cliente['nome']}</td>";
            echo "<td>{$cliente['email']}</td>";
            echo "<td>{$cliente['contato']}</td>";
            echo "<td>{$cliente['endereco']}</td>";
            echo "<td>{$cliente['cpf']}</td>";
            echo '<td><button class="icon-button delete-button"><img src="../img/icodelete.png" class="delete-icon" alt="delete"></button> <img src="../img/icoedit.png" alt="edit" class="edit-icon"></td>';
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>

  <div class="container-xxl">
    <button class="icon-button">
      <img src="../img/icoadd.png" alt="Adicionar" class="add-icon" data-bs-toggle="modal" data-bs-target="#cadastro-clientes">
    </button>
  </div>

    <!-- Modal Adicionar Cliente -->
    <div class="modal fade" id="cadastro-clientes" tabindex="-1" aria-labelledby="adicionarClienteModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="adicionarClienteModalLabel">Adicionar Cliente</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body" id="cadastro-clientes-form">
            <form id="formCadastroClientes" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="mb-3">
                <label for="nomeCliente" class="form-label">Nome Completo</label>
                <input type="text" class="form-control" id="nomeCliente" name="nomeCliente" placeholder="Seu nome completo">
              </div>
              <div class="mb-3">
                <label for="emailCliente" class="form-label">E-mail</label>
                <input type="email" class="form-control" id="emailCliente" name="emailCliente" placeholder="Seu endereço de e-mail">
              </div>
              <div class="mb-3">
                <label for="contatoCliente" class="form-label">Contato</label>
                <input type="text" class="form-control" id="contatoCliente" name="contatoCliente" placeholder="(xx) xxxxx-xxxx">
              </div>
              <div class="mb-3">
                <label for="enderecoCliente" class="form-label">Endereço</label>
                <input type="text" class="form-control" id="enderecoCliente" name="enderecoCliente" placeholder="Seu endereço">
              </div>
              <div class="mb-3">
                <label for="cpfCliente" class="form-label">CPF</label>
                <input type="text" class="form-control" id="cpfCliente" name="cpfCliente" placeholder="xxx.xxx.xxx-xx">
              </div>
              <div class="col-12">
                <input type="submit" class="btn btn-outline-success" id="cadastro-clientes-btn" value="Cadastrar">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/validarCadastroCliente.js" defer></script>
  <script src="../js/deleteCliente.js" defer></script>

</body>
</html>