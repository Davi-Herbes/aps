<?php
function castValue($value, ?string $type)
{

  if ($value === null || $type === null) {
    return $value;
  }

  switch ($type) {
    case 'integer':
      return (int)$value;
    case 'float':
      return (float)$value;
    case 'bool':
      return filter_var($value, FILTER_VALIDATE_BOOL);
    case 'string':
      return (string)$value;
    default:
      // se for algum tipo de objeto → não tenta instanciar
      return $value;
  }
}
