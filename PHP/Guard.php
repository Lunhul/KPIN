<?php
namespace entities;

// trait pro ověřování uživatelských vstupů
trait Guard {
  // Jednoduchá ochrana proti XSS útokům
  public function check($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
}

?>