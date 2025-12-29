<?php

class Model
{

  protected function generateUpdateSql(string $table_name, string $updateByKey, string $updateByValue)
  {
    $sql = "UPDATE $table_name SET ";

    $filtered_fields = [];

    foreach ($this as $key => $value) {
      if (is_object($value)) {
        continue;
      }

      if ($key === "id") {
        continue;
      }

      if ($value === null) {
        continue;
      }

      // if ($value == "") {
      //   continue;
      // }

      $filtered_fields[] = "$key = " . (gettype($value) === "integer" || gettype($value) === "float" ? $value : "'$value'");
    }

    $sql = $sql . join(",", $filtered_fields);
    $sql = $sql . " WHERE $updateByKey = $updateByValue";

    return $sql;
  }

  protected function generateInsertSql($table_name)
  {
    $sql = "INSERT INTO $table_name ";


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



  public static function getJoinFieldsSql($prefixo, $column_names)
  {
    $sql = "";

    foreach ($column_names as $field) {
      $result_name = $prefixo . "." . $field;
      $sql = $sql . $result_name . " AS '$result_name', ";
    }

    $sql = substr($sql, 0, strlen($sql) - 2);

    return $sql;
  }
}
