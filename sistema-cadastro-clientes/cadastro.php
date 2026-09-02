<?php
$arquivo = 'db.json';

if (!file_exists($arquivo)) {
    file_put_contents($arquivo, '[]');
}

$dados = json_decode(file_get_contents($arquivo), true) ?? [];
$mensagem = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $novoElemento = [
        "nome" => trim($_POST['nome'] ?? ''),
        "idade" => (int)($_POST['idade'] ?? 0),
        "ativo" => $_POST['ativo'] ?? 'não',
        "email" => trim($_POST['email'] ?? ''),
        "telefone" => trim($_POST['telefone'] ?? ''),
        "cidade" => trim($_POST['cidade'] ?? ''),
        "profissao" => trim($_POST['profissao'] ?? '')
    ];

    if ($novoElemento['nome'] === '') {
        $mensagem = 'Informe o nome do cliente.';
    } else {
        $dados[] = $novoElemento;
        file_put_contents(
            $arquivo,
            json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE),
            LOCK_EX
        );
        $mensagem = 'Cliente cadastrado com sucesso!';
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Cadastro de Clientes</title>
    <style>
        body { font-family: Arial, sans-serif; max-width: 700px; margin: 40px auto; padding: 20px; }
        h1 { text-align: center; }
        form { display: grid; gap: 12px; }
        label { font-weight: bold; }
        input, select, button { padding: 10px; font-size: 16px; }
        button { cursor: pointer; }
        .mensagem { padding: 10px; margin-bottom: 15px; background: #eee; }
        .links { margin-top: 20px; text-align: center; }
    </style>
</head>
<body>
    <h1>Cadastro de Clientes</h1>

    <?php if ($mensagem): ?>
        <div class="mensagem"><?= htmlspecialchars($mensagem) ?></div>
    <?php endif; ?>

    <form method="post" action="cadastro.php">
        <div>
            <label for="nome">Nome</label>
            <input id="nome" name="nome" type="text" required>
        </div>

        <div>
            <label for="idade">Idade</label>
            <input id="idade" name="idade" type="number" min="0">
        </div>

        <div>
            <label for="ativo">Ativo</label>
            <select id="ativo" name="ativo">
                <option value="sim">Sim</option>
                <option value="não">Não</option>
            </select>
        </div>

        <div>
            <label for="email">E-mail</label>
            <input id="email" name="email" type="email">
        </div>

        <div>
            <label for="telefone">Telefone</label>
            <input id="telefone" name="telefone" type="text">
        </div>

        <div>
            <label for="cidade">Cidade</label>
            <input id="cidade" name="cidade" type="text">
        </div>

        <div>
            <label for="profissao">Profissão</label>
            <input id="profissao" name="profissao" type="text">
        </div>

        <button type="submit">Cadastrar cliente</button>
    </form>

    <div class="links">
        <a href="lista.php">Ver clientes cadastrados</a>
    </div>
</body>
</html>
