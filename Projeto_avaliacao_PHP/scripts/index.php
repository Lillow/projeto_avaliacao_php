<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Contas a Pagar</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: center;
        }
    </style>
</head>
<body>
    <h2>Adicionar/Editar Conta a Pagar</h2>
    <form action="processa_conta.php" method="post">
        <label for="empresa">Empresa:</label>
        <select id="empresa" name="empresa">
            <?php
            // Conexão com o banco de dados
            $mysqli = new mysqli("localhost", "root", "root", "controle_financeiro");
            if ($mysqli->connect_errno) {
                echo "Falha ao conectar ao MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
            }

            // Consulta para listar empresas
            $result = $mysqli->query("SELECT id_empresa, nome FROM tbl_empresa ORDER BY nome");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id_empresa']}'>{$row['nome']}</option>";
            }
            $result->free();
            ?>
        </select><br><br>
        <label for="data_pagar">Data a Pagar:</label>
        <input type="date" id="data_pagar" name="data_pagar" required><br><br>
        <label for="valor">Valor a Pagar:</label>
        <input type="number" id="valor" name="valor" step="0.01" required><br><br>
        <input type="submit" value="Inserir / Editar">
    </form>

    <hr>
    <h2>Contas a Pagar</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Empresa</th>
                <th>Data a Pagar</th>
                <th>Valor</th>
                <th>Pago</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Consulta para listar contas a pagar
            $result_contas = $mysqli->query("SELECT cp.id_conta_pagar, e.nome AS empresa, cp.data_pagar, cp.valor, cp.pago FROM tbl_conta_pagar cp INNER JOIN tbl_empresa e ON cp.id_empresa = e.id_empresa ORDER BY cp.data_pagar");
            while ($row_conta = $result_contas->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row_conta['id_conta_pagar']}</td>";
                echo "<td>{$row_conta['empresa']}</td>";
                echo "<td>{$row_conta['data_pagar']}</td>";
                echo "<td>R$ " . number_format($row_conta['valor'], 2, ',', '.') . "</td>";
                echo "<td>" . ($row_conta['pago'] ? 'Sim' : 'Não') . "</td>";
                echo "<td><button onclick=\"editarConta({$row_conta['id_conta_pagar']})\">Editar</button> ";
                echo "<button onclick=\"excluirConta({$row_conta['id_conta_pagar']})\">Excluir</button> ";
                echo "<button onclick=\"marcarPago({$row_conta['id_conta_pagar']})\">Marcar Pago</button></td>";
                echo "</tr>";
            }
            $result_contas->free();
            $mysqli->close();
            ?>
        </tbody>
    </table>

    <script>
        function editarConta(id) {
            // Implementar a função de edição
            alert('Implementar função de edição para o ID: ' + id);
        }

        function excluirConta(id) {
            // Implementar a função de exclusão
            alert('Implementar função de exclusão para o ID: ' + id);
        }

        function marcarPago(id) {
            // Implementar a função de marcar como pago
            alert('Implementar função de marcar como pago para o ID: ' + id);
        }
    </script>
</body>
</html>
