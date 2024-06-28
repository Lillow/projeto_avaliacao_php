<?php
// Conexão com o banco de dados
$mysqli = new mysqli("localhost", "root", "root", "controle_financeiro");
if ($mysqli->connect_errno) {
    echo "Falha ao conectar ao MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

// Receber dados do formulário
$id_conta_pagar = $_POST['id_conta_pagar'] ?? null; // Se editar, receberá o ID
$empresa = $_POST['empresa'];
$data_pagar = $_POST['data_pagar'];
$valor = $_POST['valor'];

// Validar e tratar os dados conforme necessário

// Inserir ou atualizar a conta a pagar
if ($id_conta_pagar) {
    // Atualização
    $query = "UPDATE tbl_conta_pagar SET id_empresa = $empresa, data_pagar = '$data_pagar', valor = $valor WHERE id_conta_pagar = $id_conta_pagar";
} else {
    // Inserção
    $query = "INSERT INTO tbl_conta_pagar (id_empresa, data_pagar, valor) VALUES ($empresa, '$data_pagar', $valor)";
}

if ($mysqli->query($query)) {
    echo "Operação realizada com sucesso!";
} else {
    echo "Erro ao executar a operação: (" . $mysqli->errno . ") " . $mysqli->error;
}

$mysqli->close();
?>
