<?php
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Verifica se o ID é maior ou igual a 10
    if ($id > 10) {
        // Inclui o array de produtos
        $produtosFile = __DIR__ . '/../inc/produtos.php'; 
        include_once $produtosFile;

        // Filtra os produtos para remover o produto com o ID fornecido
        $produtos = array_filter($produtos, function($produto) use ($id) {
            return $produto['id'] != $id;
        });

        // Salvar o array atualizado de volta no arquivo produtos.php
        file_put_contents($produtosFile, '<?php $produtos = ' . var_export($produtos, true) . ';');

        // Retornar mensagem de sucesso
        $response = array("status" => "success", "message" => "Produto deletado com sucesso!");
    } else {
        // Retornar mensagem de erro se o ID for menor que 10
        $response = array("status" => "error", "message" => "Não é permitido excluir produtos com ID menor que 10.");
    }
} else {
    $response = array("status" => "error", "message" => "ID de produto não fornecido.");
}

// Envia a resposta em formato JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
