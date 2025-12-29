<?php

class Model
{

  public function generateUpdateSql(string $updateByKey, string $updateByValue)
  {
    $sql = "UPDATE Estagio SET ";

    $filtered_fields = [];

    foreach ($this as $key => $value) {
      if (is_object($value)) {
        continue;
      }

      if ($value == null) {
        continue;
      }

      if ($value == "") {
        continue;
      }

      $filtered_fields[] = "$key = " . (gettype($value) == "integer" || gettype($value) == "float" ? $value : "'$value'");
    }

    $sql = $sql . join(",", $filtered_fields);
    $sql = $sql . " WHERE $updateByKey = '$updateByValue'";

    return $sql;
  }

  public function generateInsertSql()
  {
    $sql = "INSERT INTO Estagio ";


    $filtered_keys = [];
    $filtered_values = [];

    foreach ($this as $key => $value) {
      if (is_object($value)) {
        continue;
      }

      if ($value == null) {
        continue;
      }

      if ($value == "") {
        continue;
      }


      $filtered_keys[] = "$key";
      $filtered_values[] = gettype($value) == "integer" || gettype($value) == "float" ? $value : "'$value'";
    }


    $sql = $sql . "(" . join(",", $filtered_keys) . ") VALUES (" . join(",", $filtered_values) . ")";

    return $sql;
  }
}
