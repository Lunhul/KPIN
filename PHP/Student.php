<?php

namespace entities;

require "Guard.php";

use entities;

class Student {

  use Guard;

  // Základní informace
  private $_prijmeni;
  private $_osobni_cislo;
  private $_rocnik;
  private $_pocet_kreditu;

  // Odpovědi na dotazník
  private $_favourites;
  private $_hobby;
  private $_sex;
  private $_hero;

  // Gettery
  function get_prijmeni() { return $this->_prijmeni; }
  function get_osobni_cislo() { return $this->_osobni_cislo; }
  function get_rocnik() {return $this->_rocnik; }
  function get_pocet_kreditu() { return $this->_pocet_kreditu; }

  function get_favourites() { return $this->_favourites; }
  function get_hobby() { return $this->_hobby; }
  function get_sex() { return $this->_sex; }
  function get_hero() { return $this->_hero; }

  // Settery
  function set_prijmeni($value) { $this->_prijmeni = $this->check($value); }
  function set_osobni_cislo($value) { $this->_osobni_cislo = $this->check($value); }
  function set_rocnik($value) { $this->_rocnik = $this->check($value); }
  function set_pocet_kreditu($value) { $this->_pocet_kreditu = $this->check($value); }

  function set_favourites($value) { $this->_favourites = $this->check($value); }
  function set_hobby($value) { $this->_hobby = $this->check($value); }
  function set_sex($value) { $this->_sex = $this->check($value); }
  function set_hero($value) { $this->_hero = $this->check($value); }

  // Konstruktor
  public function __construct($prijmeni, $osobni_cislo, $rocnik, $pocet_kreditu, $favourites, $hobby, $sex, $hero) {
    $this->set_prijmeni($prijmeni);
    $this->set_osobni_cislo($osobni_cislo);
    $this->set_rocnik($rocnik);
    $this->set_pocet_kreditu($pocet_kreditu);

    $this->set_favourites($favourites);
    $this->set_hobby($hobby);
    $this->set_sex($sex);
    $this->set_hero($hero);
  }

  // Metoda pro změnu ročníku
  public function zmen_rocnik() {
    if ($pocet_kreditu / $rocnik < 60) {
      $this->_rocnik = 1; // propadá a začíná znovu
    }
    else {
      $this->_rocnik++; // postupuje do dalšího ročníku
    }
  }

  // Metoda pro získání kreditů
  public function ziskej_kredity($pocet_kreditu) {
    if(rand(0, 1) == 0) {
      return false; // nepodařilo se získat kredity
    }
    $this->_pocet_kreditu += $pocet_kreditu;
    return true; // kedity se podařilo získat
  }

  // Metoda pro zobrazení údajů o studentovi
  public function zobraz_udaje() {
    echo("<h3>Vaše údaje</h3><table><tr><td>osobní číslo</td><td>{$this->get_osobni_cislo()}</td></tr><tr><td>příjmení</td><td>{$this->get_prijmeni()}</td></tr><tr><td>ročník</td><td>{$this->get_rocnik()}</td></tr><tr><td>počet kreditů</td><td>{$this->get_pocet_kreditu()}</td></tr></table>");
  }

  // Metoda pro usnadnění exportu dat
  public function export() {
    return array("Prijmeni" => $this->get_prijmeni(), "OsobniCislo" => $this->get_osobni_cislo(), "Rocnik" => $this->get_rocnik(), "PocetKreditu" => $this->get_pocet_kreditu(), "Oblibene" => $this->get_favourites(), "Hobby" => $this->get_hobby(), "Pohlavi" => $this->get_sex(), "Superhrdina" => $this->get_hero());
  }
}

?>