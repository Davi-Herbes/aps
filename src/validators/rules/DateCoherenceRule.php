<?php
class DateCoherenceRule
{
  public string $minor_date;

  public function __construct(string $minor_date)
  {
    $this->minor_date = $minor_date;
  }

  public function validate($major_date)
  {
    if (!$major_date) {
      return true;
    }

    $formato = "Y-m-d";
    $d1 = DateTime::createFromFormat($formato, $major_date);
    $d2 = DateTime::createFromFormat($formato, $this->minor_date);

    if (!($d1 > $d2)) {
      return "A data de início não pode ser superior a data de conclusão.";
    }

    return true;
  }
}
