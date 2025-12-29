<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();

require_once(__DIR__ . '/../../src/models/professor/Professor.php');


if(!isset($_SESSION["user"])) {
    header("location: ../home/professor/index.php");
    exit;
}
$user = $_SESSION["user"];


?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Professor</title>
</head>
<body>
    <div class="perfil-container">
    <div class="perfil-card">
        <h2>Perfil do Usuário</h2>
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p><strong>Idade:</strong> <?php echo htmlspecialchars($usuario['idade']); ?> anos</p>
    </div>

    <?php if ($professor) { ?>
    <div class="perfil-card">
        <h2>Informações do Professor</h2>
        <p><strong>Disciplina:</strong> <?php echo htmlspecialchars($professor['disciplina']); ?></p>
        <p><strong>Experiência:</strong> <?php echo htmlspecialchars($professor['experiencia']); ?> anos</p>
    </div>
    <?php } else { ?>
    <p>Este usuário não é professor.</p>
    <?php } ?>
</div>
</body>
</html>