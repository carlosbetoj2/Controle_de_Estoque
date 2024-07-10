<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validação dos dados recebidos (exemplo básico)
    $nomeProduto = $_POST["nomeProduto"];
    $codigoProduto = $_POST["codigoProduto"];
    $precoCompraProduto = $_POST["precoCompraProduto"];
    $precoVendaProduto = $_POST["precoVendaProduto"];
    $qtdProduto = $_POST["qtdProduto"];
    $previsaoLucroProduto = $_POST["previsaoLucroProduto"];

    // Verifica se todos os campos foram preenchidos
    if (empty($nomeProduto) || empty($codigoProduto) || empty($precoCompraProduto) || empty($precoVendaProduto) || empty($qtdProduto) || empty($previsaoLucroProduto)) {
        $response = array("status" => "error", "message" => "Todos os campos são obrigatórios.");
    } else {
        // Validação adicional
        if (strlen($codigoProduto) !== 4) {
            $response = array("status" => "error", "message" => "O código do produto deve ter exatamente 4 caracteres.");
        } elseif (!is_numeric($precoCompraProduto) || !is_numeric($precoVendaProduto) || !is_numeric($previsaoLucroProduto)) {
            $response = array("status" => "error", "message" => "Os campos de preço e previsão de lucro devem conter apenas números.");
        } else {
            // Formatar os valores para "R$ X,00"
            $precoCompraFormatado = 'R$ ' . number_format($precoCompraProduto, 2, ',', '.');
            $precoVendaFormatado = 'R$ ' . number_format($precoVendaProduto, 2, ',', '.');
            $previsaoLucroFormatado = 'R$ ' . number_format($previsaoLucroProduto, 2, ',', '.');

            // Simulação de salvar o produto no array $produtos
            $produtosFile = __DIR__ . '/../inc/produtos.php';
            include_once $produtosFile;

            // Gerar novo ID
            $novoId = count($produtos) > 0 ? end($produtos)['id'] + 1 : 1;

            $novoProduto = array(
                "id" => $novoId,
                "nome" => $nomeProduto,
                "codigo" => $codigoProduto,
                "preco_de_compra" => $precoCompraFormatado,
                "preco_de_venda" => $precoVendaFormatado,
                "qtd" => $qtdProduto,
                "previsao_de_lucro" => $previsaoLucroFormatado
            );

            // Adicionar o novo Produto ao array $produtos
            $produtos[] = $novoProduto;

            // Salvar o array $produtos de volta no arquivo produtos.php
            file_put_contents($produtosFile, '<?php $produtos = ' . var_export($produtos, true) . ';');

            // Retornar mensagem de sucesso
            $response = array("status" => "success", "message" => "Produto cadastrado com sucesso!", "data" => $novoProduto, "produtos" => $produtos);
        }
    }

    // Retorna a resposta em JSON
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
