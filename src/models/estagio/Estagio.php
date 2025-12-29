<?php
require_once __DIR__ . "/../aluno/Aluno.php";
require_once __DIR__ . "/../documento/Documento.php";
require_once __DIR__ . "/../usuario/Usuario.php";
require_once __DIR__ . "/../curso/Curso.php";
require_once __DIR__ . "/../foto/Foto.php";
require_once __DIR__ . "/../professor/Professor.php";
require_once __DIR__ . "/../Model.php";

class Estagio extends Model
{
  public static array $column_names = ["id", "id_aluno", "id_professor", "hora_semana", "nome_empresa", "cnpj_empresa", "data_inicio", "data_fim", "area_empresa", "email_empresa", "nome_representante", "cargo_representante", "cpf_representante", "orgao_expedidor", "data_expedicao", "telefone_empresa", "turno", "modalidade"];

  // primary key
  public ?int $id;

  // foreign keys
  public ?int $id_aluno;
  public ?int $id_professor;

  // regular columns
  public ?string $data_inicio;
  public ?string $data_fim;
  public ?string $turno;
  public ?string $modalidade;

  public ?string $nome_empresa;
  public ?string $cnpj_empresa;
  public ?string $area_empresa;
  public ?string $email_empresa;
  public ?string $telefone_empresa;

  public ?string $nome_representante;
  public ?string $cargo_representante;
  public ?string $cpf_representante;

  public ?string $orgao_expedidor;
  public ?string $data_expedicao;

  public ?float $hora_semana;

  public function __construct(
    ?int $id_aluno = null,
    ?int $id_professor = null,

    ?float $hora_semana = null,

    ?string $data_inicio = null,
    ?string $data_fim = null,
    ?string $turno = null,
    ?string $modalidade = null,

    ?string $nome_empresa = null,
    ?string $cnpj_empresa = null,
    ?string $area_empresa = null,
    ?string $email_empresa = null,
    ?string $telefone_empresa = null,

    ?string $nome_representante = null,
    ?string $cargo_representante = null,
    ?string $cpf_representante = null,

    ?string $orgao_expedidor = null,
    ?string $data_expedicao = null

  ) {

    $this->id_aluno = $id_aluno;
    $this->id_professor = $id_professor;


    $this->data_inicio = $data_inicio;
    $this->data_fim = $data_fim;
    $this->turno = $turno;
    $this->modalidade = $modalidade;

    $this->nome_empresa = $nome_empresa;
    $this->cnpj_empresa = $cnpj_empresa;
    $this->area_empresa = $area_empresa;
    $this->email_empresa = $email_empresa;
    $this->telefone_empresa = $telefone_empresa;

    $this->nome_representante = $nome_representante;
    $this->cargo_representante = $cargo_representante;
    $this->cpf_representante = $cpf_representante;

    $this->orgao_expedidor = $orgao_expedidor;
    $this->data_expedicao = $data_expedicao;

    $this->hora_semana = $hora_semana;
  }

  public function save()
  {
    $conexao = new MySQL();

    if (isset($this->id)) {
      $sql = $this->generateUpdateSql("Estagio", "id", $this->id);
    } else {
      $sql = $this->generateInsertSql("Estagio");
    }

    echo $sql;

    return $conexao->executa($sql);
  }

  public static function instanciarArray($result, ?string $prefixo = null)
  {
    $prefixo = $prefixo ? "$prefixo." : "";

    $estagio = new Estagio(
      isset($result[$prefixo . "id_aluno"]) ? $result[$prefixo . "id_aluno"] : null,
      isset($result[$prefixo . "id_professor"]) ? $result[$prefixo . "id_professor"] : null,

      isset($result[$prefixo . "hora_semana"]) ? (float) $result[$prefixo . "hora_semana"] : null,

      isset($result[$prefixo . "data_inicio"]) ? $result[$prefixo . "data_inicio"] : null,
      isset($result[$prefixo . "data_fim"]) ? $result[$prefixo . "data_fim"] : null,
      isset($result[$prefixo . "turno"]) ? $result[$prefixo . "turno"] : null,
      isset($result[$prefixo . "modalidade"]) ? $result[$prefixo . "modalidade"] : null,

      isset($result[$prefixo . "nome_empresa"]) ? $result[$prefixo . "nome_empresa"] : null,
      isset($result[$prefixo . "cnpj_empresa"]) ? $result[$prefixo . "cnpj_empresa"] : null,
      isset($result[$prefixo . "area_empresa"]) ? $result[$prefixo . "area_empresa"] : null,
      isset($result[$prefixo . "email_empresa"]) ? $result[$prefixo . "email_empresa"] : null,
      isset($result[$prefixo . "telefone_empresa"]) ? $result[$prefixo . "telefone_empresa"] : null,

      isset($result[$prefixo . "nome_representante"]) ? $result[$prefixo . "nome_representante"] : null,
      isset($result[$prefixo . "cargo_representante"]) ? $result[$prefixo . "cargo_representante"] : null,
      isset($result[$prefixo . "cpf_representante"]) ? $result[$prefixo . "cpf_representante"] : null,

      isset($result[$prefixo . "orgao_expedidor"]) ? $result[$prefixo . "orgao_expedidor"] : null,
      isset($result[$prefixo . "data_expedicao"]) ? $result[$prefixo . "data_expedicao"] : null,
    );

    $estagio->id = $result[$prefixo . 'id'] ?? null;
    return $estagio;
  }

  public static function find($id)
  {
    $conexao = new MySQL();
    $sql = "SELECT * FROM Estagio WHERE id = {$id}";
    $result = $conexao->consulta($sql);

    return Estagio::instanciarArray($result[0]);
  }

  public function delete(): bool
  {
    if (!isset($this->id)) return false; // se não tiver ID, não dá para deletar
    $conexao = new MySQL();
    $sql = "DELETE FROM Estagio WHERE id = {$this->id}";
    return $conexao->executa($sql); // retorna true se deletou, false se falhou
  }


  public static function findByAluno($id)
  {
    $conexao = new MySQL();
    $estagio_join_sql = Model::getJoinFieldsSql("e", Estagio::$column_names);
    $aluno_join_sql = Model::getJoinFieldsSql("a", Aluno::$column_names);
    $usuario_join_sql = Model::getJoinFieldsSql("u", Usuario::$column_names);
    $curso_join_sql = Model::getJoinFieldsSql("c", Curso::$column_names);


    $sql = "SELECT $estagio_join_sql, $aluno_join_sql, $usuario_join_sql, $curso_join_sql
    FROM Estagio e
    JOIN aluno a ON a.ID_Aluno=e.id_aluno
    JOIN usuario u ON u.ID_Usuario = a.ID_Aluno
    JOIN curso c ON c.ID_Curso = a.ID_Curso
    JOIN foto f ON f.ID_Foto = u.ID_Foto
    WHERE e.id_aluno = {$id}";
    $result = $conexao->consulta($sql);

    $estagios = [];

    foreach ($result as $e) {
      $estagio = Estagio::instanciarArray($e, "e");
      $aluno = Aluno::instanciarArray($e, "a");
      $usuario = Usuario::instanciarArray($e, "u");
      $curso = Curso::instanciarArray($e, "c");

      $estagios[$estagio->id]["estagio"] = $estagio;
      $estagios[$estagio->id]["aluno"] = $aluno;
      $estagios[$estagio->id]["usuario"] = $usuario;
      $estagios[$estagio->id]["curso"] = $curso;
    }

    return $estagios;
  }

  public static function findByProfessor($id)
  {
    $conexao = new MySQL();
    $estagio_join_sql = Model::getJoinFieldsSql("e", Estagio::$column_names);
    $aluno_join_sql = Model::getJoinFieldsSql("a", Aluno::$column_names);
    $usuario_join_sql = Model::getJoinFieldsSql("u", Usuario::$column_names);
    $curso_join_sql = Model::getJoinFieldsSql("c", Curso::$column_names);


    $sql = "SELECT $estagio_join_sql, $aluno_join_sql, $usuario_join_sql, $curso_join_sql
    FROM Estagio e
    JOIN aluno a ON a.ID_Aluno=e.id_aluno
    JOIN usuario u ON u.ID_Usuario = a.ID_Aluno
    JOIN curso c ON c.ID_Curso = a.ID_Curso
    JOIN foto f ON f.ID_Foto = u.ID_Foto
    WHERE id_professor = {$id}";
    $result = $conexao->consulta($sql);


    $estagios = [];

    foreach ($result as $e) {
      $estagio = Estagio::instanciarArray($e, "e");
      $aluno = Aluno::instanciarArray($e, "a");
      $usuario = Usuario::instanciarArray($e, "u");
      $curso = Curso::instanciarArray($e, "c");

      $estagios[$estagio->id]["estagio"] = $estagio;
      $estagios[$estagio->id]["aluno"] = $aluno;
      $estagios[$estagio->id]["usuario"] = $usuario;
      $estagios[$estagio->id]["curso"] = $curso;
    }

    return $estagios;
  }

  public static function findProfessorNome($id_professor)
  {
    $conexao = new MySQL();

    $sql = "
        SELECT u.Nome, u.Sobrenome
        FROM professor p
        JOIN usuario u ON u.ID_Usuario = p.ID_Professor
        WHERE p.ID_Professor = {$id_professor}
    ";

    $result = $conexao->consulta($sql);

    if (empty($result)) {
      return null; // professor não encontrado
    }

    return $result[0]["Nome"] . " " . $result[0]["Sobrenome"];
  }


  public static function findJoinAlunoUsuarioDocumento($id)
  {
    $conexao = new MySQL();
    $estagio_join_sql = Model::getJoinFieldsSql("e", Estagio::$column_names);
    $aluno_join_sql = Model::getJoinFieldsSql("a", Aluno::$column_names);
    $usuario_join_sql = Model::getJoinFieldsSql("u", Usuario::$column_names);
    $documento_join_sql = Model::getJoinFieldsSql("d", Documento::$column_names);


    $sql = "SELECT $estagio_join_sql, $aluno_join_sql, $usuario_join_sql, $documento_join_sql
    FROM Estagio e
    JOIN aluno a ON a.ID_Aluno=e.id_aluno
    LEFT JOIN Documento d ON d.id_estagio=e.id
    JOIN usuario u ON u.ID_Usuario = a.ID_Aluno
    WHERE e.id = {$id}";

    // var_dump($sql);

    $result = $conexao->consulta($sql);



    $estagios = [];


    $estagio = Estagio::instanciarArray($result[0], "e");
    $aluno = Aluno::instanciarArray($result[0], "a");
    $usuario = Usuario::instanciarArray($result[0], "u");

    $estagios["estagio"] = $estagio;
    $estagios["aluno"] = $aluno;
    $estagios["usuario"] = $usuario;
    $estagios["documentos"] = [];

    foreach ($result as $e) {
      $documento = Documento::instanciarArray($e, "d");
      $estagios["documentos"][$documento->tipo] = $documento;
    }

    return $estagios;
  }

  public static function findJoinProfessorUsuario($id)
  {
    $conexao = new MySQL();
    $estagio_join_sql = Model::getJoinFieldsSql("e", Estagio::$column_names);
    $professor_join_sql = Model::getJoinFieldsSql("p", Professor::$column_names);
    $usuario_join_sql = Model::getJoinFieldsSql("u", Usuario::$column_names);
    $documento_join_sql = Model::getJoinFieldsSql("d", Documento::$column_names);


    $sql = "SELECT $estagio_join_sql, $professor_join_sql, $usuario_join_sql, $documento_join_sql
    FROM Estagio e
    JOIN professor p ON p.ID_Professor=e.id_professor
    LEFT JOIN Documento d ON d.id_estagio=e.id
    JOIN usuario u ON u.ID_Usuario = p.ID_Professor
    WHERE e.id = {$id}";

    // var_dump($sql);

    $result = $conexao->consulta($sql);



    $estagios = [];


    $estagio = Estagio::instanciarArray($result[0], "e");
    $professor = Professor::instanciarArray($result[0], "a");
    $usuario = Usuario::instanciarArray($result[0], "u");

    $estagios["estagio"] = $estagio;
    $estagios["professor"] = $professor;
    $estagios["usuario"] = $usuario;
    $estagios["documentos"] = [];

    foreach ($result as $e) {
      $documento = Documento::instanciarArray($e, "d");
      $estagios["documentos"][$documento->tipo] = $documento;
    }

    return $estagios;
  }
  public static function searchByProfessor($id_professor, $nomeAluno)
  {

    $conexao = new MySQL();

    $estagio_join_sql = Model::getJoinFieldsSql("e", Estagio::$column_names);
    $aluno_join_sql = Model::getJoinFieldsSql("a", Aluno::$column_names);
    $usuario_join_sql = Model::getJoinFieldsSql("u", Usuario::$column_names);
    $curso_join_sql = Model::getJoinFieldsSql("c", Curso::$column_names);

    $sql = "SELECT $estagio_join_sql, $aluno_join_sql, $usuario_join_sql, $curso_join_sql
            FROM Estagio e
            JOIN aluno a ON a.ID_Aluno = e.id_aluno
            JOIN usuario u ON u.ID_Usuario = a.ID_Aluno
            JOIN curso c ON c.ID_Curso = a.ID_Curso
            JOIN foto f ON f.ID_Foto = u.ID_Foto
            WHERE e.id_professor = {$id_professor}
              AND (u.Nome LIKE '%{$nomeAluno}%' 
                   OR u.Sobrenome LIKE '%{$nomeAluno}%')";

    $result = $conexao->consulta($sql);

    $estagios = [];

    foreach ($result as $e) {

      $estagio = Estagio::instanciarArray($e, "e");
      $aluno = Aluno::instanciarArray($e, "a");
      $usuario = Usuario::instanciarArray($e, "u");
      $curso = Curso::instanciarArray($e, "c");

      $estagios[$estagio->id]["estagio"] = $estagio;
      $estagios[$estagio->id]["aluno"] = $aluno;
      $estagios[$estagio->id]["usuario"] = $usuario;
      $estagios[$estagio->id]["curso"] = $curso;
    }

    return $estagios;
  }
}
