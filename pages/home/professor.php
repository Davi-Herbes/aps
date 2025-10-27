<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Professor</title>
</head>
<body>
    <h1>Cadastrar novo estágio</h1>
    <form action="../../src/controllers/professor/cadastrar_estagio.php" method="POST">
        <label for="aluno">Aluno:</label><br>
        <input type="text" id="aluno" name="aluno" required><br><br>

        <label for="modalidade">Modalidade:</label><br>
         <input type="text" id="modalidade" name="modalidade" required><br><br>

        <label for="valorBolsa">Valor da bolsa:</label><br>
        <input type="text" id="valorBolsa" name="valorBolsa" required><br><br>

        <label for="turno">Turno:</label><br>
        <select name="turno" id="turno">
        <option value="manha">Manhã</option>
        <option value="tarde">Tarde</option>
        <option value="noite">Noite</option>
        </select required><br><br>

        <label for="dataInicio">Data de início:</label><br>
        <input type="date" id="dataInicio" name="dataInicio" required><br><br>

        <label for="dataFim">Data de conclusão:</label><br>
        <input type="date" id="dataFim" name="dataFim" required><br><br>

        <label for="cargaHoraria">Carga Horária:</label><br>
        <input type="date" id="cargaHoraria" name="cargaHoraria" required><br><br>

        <input type="submit" value="Informações da empresa">
</body>
</html>