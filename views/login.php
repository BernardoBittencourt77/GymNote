<?php

require_once "../controllers/UsuarioController.php";

$mensagem = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = $_POST["email"];
    $senha = $_POST["senha"];

    $controller = new UsuarioController();

    $usuario = $controller->login($email, $senha);

    if ($usuario != null) {
        $mensagem = "Login realizado com sucesso! Bem-vindo, " . $usuario->getNome() . ".";
    } else {
        $mensagem = "Email ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>GymNote - Login</title>
</head>

<body>

    <h1>GymNote</h1>

    <form method="POST">

        <label>Email:</label>
        <input type="email" name="email" required>

        <br><br>

        <label>Senha:</label>
        <input type="password" name="senha" required>

        <br><br>

        <button type="submit">Entrar</button>

    </form>

    <?php if ($mensagem != ""): ?>
        <p><?php echo $mensagem; ?></p>
    <?php endif; ?>

</body>

</html>