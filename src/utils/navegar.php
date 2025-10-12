<?php

function navegar(string $path)
{
  header("Location: $path");
  exit;
}
