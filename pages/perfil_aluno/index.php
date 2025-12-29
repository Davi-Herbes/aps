<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();


require_once __DIR__."..\src\models\aluno\Aluno.php";


if(!isset($_SESSION["ID_Usuario"])) {
    header("location: ..\pages\aluno\Index.php");
    exit;
}

$user = $_SESSION["user"];

?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Perfil do Aluno</title>
</head>
<body>
    <h2>Olá <?echo $nome ?></h2>
    <img src="<?php echo $ID_Foto; ?>" alt="Foto de perfil"><br><br>
    <strong>Nome:</strong> <?php echo $nome; ?><br>
    <strong>Email:</strong> <?php echo $email; ?><br><br>
    <a href="editar.php">Editar Perfil</a>
</body>
</html>
