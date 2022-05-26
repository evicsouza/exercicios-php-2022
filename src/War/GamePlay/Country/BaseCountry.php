<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay\Country;

/**
 * Defines a country, that is also a player.
 */
class BaseCountry implements CountryInterface {

  /**
   * The name of the country.
   *
   * @var string
   */
  protected $name;

  /**
   * Builder.
   *
   * @param string $name
   *   The name of the country.
   */
  public function __construct(string $name) {
    $this->name = $name;
  }
  
  public function getName(): string {
    return $this -> name;
  }

  public function getNeighbors(): array {
    return $this -> newighbors;
  }

  public function setNeighbors(array $neighbors): void{
    $this -> neighbors;
  }

  public function getNumberOfTroops(): int {
    return $this -> numberOfTroops;
  }

  public function isConquered(): bool {
    if($this -> getNumberOfTroops === 0){
      return true;
    }
    return false;
  }

  public function conquer(CountryInterface $conqueredCountry): void {
    $conqueredCountry -> getNeighbors();
    $auxVar = [];
    foreach($conqueredCountry as $neighbors){
      if($neighbors -> getName() != $this -> getName()){
        $auxVar = $neighbors;
      }
    }
    foreach($this -> getNeighbors() as $neighbors){
      if ($neighbors->getName() != $conqueredCountry -> getName()){
        $auxVar = $neighbors;
      }
    }

    $this -> neighbors = $auxVar;
    if(property_exists($this, "numberOfConquered") == FALSE){
      $this -> numberOfConquered = 1;
    }
    else
      $this -> numberOfConquered++;   


  }

  public function killTroops(int $killedTroops): void {
    $numberTroops = $this -> getNumberOfTroops();
    $this -> numberOfTroops = $numberTroops - $killedTroops;
  }
}
