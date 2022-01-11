<?php
use entities;

require "Guard.php";
require "Student.php";
require "Studenti.php";

$err = "Povinné položky nebyly vyplněny, vrať se prosím <a href='index.html'>zpět</a>";

if($_SERVER["REQUEST_METHOD"] == "POST") {
  $osobni_cislo = $_POST['osobni_cislo'];
  $prijmeni = $_POST['prijmeni'];
  $rocnik = $_POST['rocnik'];
  $pocet_kreditu = $_POST['pocet_kreditu'];
  if(!empty($osobni_cislo) || !empty($prijmeni) || !empty($rocnik) || !empty($pocet_kreditu)) {
    $student = new Student($prijmeni, $osobni_cislo, $rocnik, $pocet_kreditu, $_POST['favourites'], $_POST['hobby'], $_POST['sex'], $_POST['hero']);
    $studenti = new Studenti();
    if(!file_exists(EXPORT_FILENAME)) {
      $studenti->append($student);
    }
    else {
      $studenti->import(EXPORT_FILENAME);
      $studenti->append($student);
    }
    $studenti->export();
  echo "<div style='width: 100%; background-color: limegreen; height: 50px;'>Děkuji za vyplnění dotazníku!</div>";
  }
  else {
    echo $err;
  }
}

?>