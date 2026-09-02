<?php
$arquivo = 'db.json';

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, '[]');
}

$dados = json_decode(file_get_contents($arquivo), true) ?? [];
$nomePesquisa = trim($_POST['nome'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Lista de Clientes</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 1100px; margin: 40px auto; padding: 20px; }
        h1 { text-align: center; }
        form { text-align: center; margin-bottom: 20px; }
        input, button { padding: 10px; font-size: 16px; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #999; padding: 9px; text-align: left; }
        th { font-weight: bold; }
        .links { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <h1>Clientes cadastrados</h1>

    <form action="lista.php" method="post">
        <label for="nome">Digite o nome:</label>
        <input id="nome" type="text" name="nome"
               value="<?= htmlspecialchars($nomePesquisa) ?>">
        <button type="submit">Pesquisar</button>
        <a href="lista.php">Limpar</a>
    </form>

    <table>
        <tr>
            <th>Nome</th>
            <th>Idade</th>
            <th>Ativo</th>
            <th>E-mail</th>
            <th>Telefone</th>
            <th>Cidade</th>
            <th>Profissão</th>
        </tr>

        <?php
        foreach ($dados as $valor) {
            $nome = $valor['nome'] ?? '';

            if ($nomePesquisa === '' || stripos($nome, $nomePesquisa) !== false) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($nome) . '</td>';
                echo '<td>' . htmlspecialchars((string)($valor['idade'] ?? '')) . '</td>';
                echo '<td>' . htmlspecialchars($valor['ativo'] ?? '') . '</td>';
                echo '<td>' . htmlspecialchars($valor['email'] ?? '') . '</td>';
                echo '<td>' . htmlspecialchars($valor['telefone'] ?? '') . '</td>';
                echo '<td>' . htmlspecialchars($valor['cidade'] ?? '') . '</td>';
                echo '<td>' . htmlspecialchars($valor['profissao'] ?? '') . '</td>';
                echo '</tr>';
            }
        }
        ?>
    </table>

    <div class="links">
        <a href="cadastro.php">Cadastrar novo cliente</a>
    </div>
</body>
</html>
