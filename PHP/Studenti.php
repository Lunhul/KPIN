<?php
namespace entities;
// Konstantní cesta k souboru se zaznamenanými studenty (ve formátu xml)
define("EXPORT_FILENAME", "export.xml", false);

use SimpleXML;

class Studenti {

  use Guard;

  // Seznam všech zaznamenaných studentů
  private $_studenti;

  // Konstruktor
  public function __construct() {
    $this->_studenti = array();
  }

  // Metoda pro přidání studenta do zaznamenaných
  public function append($student) {
    array_push($this->_studenti, $student);
  }

  // Metoda pro výpis informace o každém zaznamenaném studentovi
  public function get_students_info() {
    foreach($this->_studenti as $st) {
      $st->zobraz_udaje();
    }
  }

  // Metoda pro export do souboru (na konstantní cestě)
  public function export() {
    $xml = new SimpleXMLElement("<?xml version='1.0' encoding='UTF-8'?><Studenti/>");
    foreach($this->_studenti as $student) {
      $st = $xml->addChild("Student");
      foreach($student->export() as $attribute => $value) {
        $st->addChild($attribute, $value);
      }
    }
    $xml.asXML(EXPORT_FILENAME);
  }

  // Metoda pro import studentů z xml souboru (struktura je shodná s exportovanou strukturou)
  public function import($file_path) {
    $xml = simplexml_load_file($file_path) or die("Parsing xml error");
    foreach($xml as $student) {
      array_push($this->_studenti, new Student($student->Prijmeni, $student->OsobniCislo, $student->Rocnik, $student->PocetKreditu, $student->Oblibene, $student->Hobby, $student->Pohlavi, $student->Superhrdina));
    }
  }
}

?>