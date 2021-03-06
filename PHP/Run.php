<?php
use entities as e;

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
    $student = new e\Student($prijmeni, $osobni_cislo, $rocnik, $pocet_kreditu, $_POST['favourites'], $_POST['hobby'], $_POST['sex'], $_POST['hero']);
    $studenti = new e\Studenti();
    if(!file_exists(EXPORT_FILENAME)) {
      $studenti->append($student);
    }
    else {
      $studenti->import(EXPORT_FILENAME);
      $studenti->append($student);
    }
    $studenti->export();
  echo "<div style='background-color: limegreen; padding: 25px 0; text-align: center;'>Děkuji za vyplnění dotazníku!</div>";
  }
  else {
    echo $err;
  }
}

?>