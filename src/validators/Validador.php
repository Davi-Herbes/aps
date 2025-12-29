<?php
class Validador
{
  public bool $valido = true;

  public array $errors = ["generico" => ""];
  public array $data = [];
  protected array $rules;

  private ?string $redirect_in_failure = null;

  public function validate()
  {
    foreach ($this->rules as $field => $fieldRules) {
      foreach ($fieldRules as $rule) {
        $result = $rule->validate($this->data[$field] ?? null);

        if ($result !== true) {
          if ($this->errors[$field]) {
            continue;
          }

          $this->errors[$field] = $result;
          $this->valido = false;
        }
      }
    }

    if ($this->redirect_in_failure !== null && !$this->valido) {

      $_SESSION["validador"] = $this;
      navegar($this->redirect_in_failure);
    }
  }

  public function setFailureURL(string $redirect_in_failure)
  {
    $this->redirect_in_failure = $redirect_in_failure;
  }

  protected function define_errors()
  {
    foreach ($this->rules as $key => $value) {
      $this->errors[$key] = "";
    }
  }

  public function gerarErroGenerico()
  {
    $this->errors["generico"] = "Ocorreu um erro na consulta.";
  }
}
