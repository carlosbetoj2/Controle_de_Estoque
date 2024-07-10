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
      width: 24px; /* Ajuste o tamanho do ícone conforme necessário */
      height: 24px; /* Ajuste o tamanho do ícone conforme necessário */
    }
  </style>
  <title>SmartShopManager</title>
</head>
<body>

  <?php require 'nav.php' ?>

  <div class="container-xxl">
    <div class="main">
      <div class="header-container d-flex justify-content-between align-items-center">
        <h2>Produtos</h2>
        <button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#cadastro-produtos">Cadastrar</button>
      </div>
    </div>
  </div>

  <?php require '../inc/produtos.php' ?>
  
  <div class="container-xxl">
    <table class="table tabela_produtos">
      <thead class="thead-dark">
        <tr>
          <th>#</th>
          <th>Nome</th>
          <th>Código</th>
          <th>Preço de Compra R$</th>
          <th>Preço de Venda R$</th>
          <th>QTD.</th>
          <th>Previsão de Lucro R$</th>
        </tr>
      </thead>
      <tbody>
        <?php
          foreach ($produtos as $produto) {
            echo "<tr data-id='{$produto['id']}'>";
            echo "<td>{$produto['id']}</td>";
            echo "<td>{$produto['nome']}</td>";
            echo "<td>{$produto['codigo']}</td>";
            echo "<td>{$produto['preco_de_compra']}</td>";
            echo "<td>{$produto['preco_de_venda']}</td>";
            echo "<td>{$produto['qtd']}</td>";
            echo "<td>{$produto['previsao_de_lucro']}</td>";
            echo '<td><button class="icon-button delete-button"><img src="../img/icodelete.png" class="delete-icon" alt="delete"></button> <img src="../img/icoedit.png" alt="edit" class="edit-icon"></td>';
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>

  <div class="container-xxl">
    <button class="icon-button">
      <img src="../img/icoadd.png" alt="Adicionar" class="add-icon" data-bs-toggle="modal" data-bs-target="#cadastro-produtos">
    </button>
  </div>

    <!-- Modal Adicionar Produto -->
    <div class="modal fade" id="cadastro-produtos" tabindex="-1" aria-labelledby="adicionarProdutoModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="adicionarProdutoModalLabel">Adicionar Produto</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
          </div>
          <div class="modal-body" id="cadastro-produtos-form">
            <form id="formCadastroProdutos" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
              <div class="mb-3">
                <label for="nomeProduto" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nomeProduto" name="nomeProduto" placeholder="Nome do produto">
              </div>
              <div class="mb-3">
                <label for="codigoProduto" class="form-label">Código</label>
                <input type="text" class="form-control" id="codigoProduto" name="codigoProduto" placeholder="xxxx" maxlength="4">
              </div>
              <div class="mb-3">
                <label for="precoCompraProduto" class="form-label">Preço de Compra</label>
                <input type="number" class="form-control" id="precoCompraProduto" name="precoCompraProduto" placeholder="Valor de compra">
              </div>
              <div class="mb-3">
                <label for="precoVendaProduto" class="form-label">Preço de Venda</label>
                <input type="number" class="form-control" id="precoVendaProduto" name="precoVendaProduto" placeholder="Valor de venda">
              </div>
              <div class="mb-3">
                <label for="qtdProduto" class="form-label">QTD.</label>
                <input type="number" class="form-control" id="qtdProduto" name="qtdProduto" placeholder="Quantidade">
              </div>
              <div class="mb-3">
                <label for="previsaoLucroProduto" class="form-label">Previsão de Lucros</label>
                <input type="number" class="form-control" id="previsaoLucroProduto" name="previsaoLucroProduto" placeholder="Lucro esperado">
              </div>
              <div class="col-12">
                <input type="submit" class="btn btn-outline-success" id="cadastro-produtos-btn" value="Cadastrar">
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  <script src="../js/bootstrap.bundle.min.js"></script>
  <script src="../js/validarCadastroProduto.js" defer></script>
  <script src="../js/deleteProduto.js" defer></script>

</body>
</html>
