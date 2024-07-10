<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <style>
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
        <h2>Fornecedores</h2>
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#cadastro-fornecedores">Cadastrar</button>
      </div>
    </div>
  </div>

  <?php require '../inc/fornecedores.php' ?>
  
  <div class="container-xxl">
    <table class="table tabela_fornecedores">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>E-mail</th>
          <th>Contato</th>
          <th>Endereço</th>
          <th>CNPJ</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($fornecedores as $fornecedor) {
            echo "<tr data-id='{$fornecedor['id']}'>";
            echo "<td>{$fornecedor['id']}</td>";
            echo "<td>{$fornecedor['nome']}</td>";
            echo "<td>{$fornecedor['email']}</td>";
            echo "<td>{$fornecedor['contato']}</td>";
            echo "<td>{$fornecedor['endereco']}</td>";
            echo "<td>{$fornecedor['cnpj']}</td>";
            echo '<td><button class="icon-button delete-button"><img src="../img/icodelete.png" class="delete-icon" alt="delete"></button> <img src="../img/icoedit.png" alt="edit" class="edit-icon"></td>';
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>

  <div class="container-xxl">
    <button class="icon-button">
      <img src="../img/icoadd.png" alt="Adicionar" class="add-icon" data-bs-toggle="modal" data-bs-target="#cadastro-fornecedores">
    </button>
  </div>

  <!-- Modal Adicionar Fornecedor -->
  <div class="modal fade" id="cadastro-fornecedores" tabindex="-1" aria-labelledby="adicionarFornecedorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="adicionarFornecedorModalLabel">Adicionar Fornecedor</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
        </div>
        <div class="modal-body" id="cadastro-fornecedores-form">
          <form id="formCadastroFornecedores" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
            <div class="mb-3">
              <label for="nomeFornecedor" class="form-label">Nome</label>
              <input type="text" class="form-control" id="nomeFornecedor" name="nomeFornecedor" placeholder="Nome do fornecedor">
            </div>
            <div class="mb-3">
              <label for="emailFornecedor" class="form-label">E-mail</label>
              <input type="email" class="form-control" id="emailFornecedor" name="emailFornecedor" placeholder="Endereço de e-mail do fornecedor">
            </div>
            <div class="mb-3">
              <label for="contatoFornecedor" class="form-label">Contato</label>
              <input type="text" class="form-control" id="contatoFornecedor" name="contatoFornecedor" placeholder="(xx) xxxxx-xxxx">
            </div>
            <div class="mb-3">
              <label for="enderecoFornecedor" class="form-label">Endereço</label>
              <input type="text" class="form-control" id="enderecoFornecedor" name="enderecoFornecedor" placeholder="Endereço do fornecedor">
            </div>
            <div class="mb-3">
              <label for="cnpjFornecedor" class="form-label">CNPJ</label>
              <input type="text" class="form-control" id="cnpjFornecedor" name="cnpjFornecedor" placeholder="xx.xxx.xxx/xxxx-xx">
            </div>
            <div class="col-12">
              <input type="submit" class="btn btn-outline-success" id="cadastro-fornecedores-btn" value="Cadastrar">
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/validarCadastroFornecedor.js" defer></script>
  <script src="../js/deleteFornecedor.js" defer></script>

</body>
</html>
