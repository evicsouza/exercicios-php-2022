<?php

namespace Galoa\ExerciciosPhp2022\War\GamePlay;

use Galoa\ExerciciosPhp2022\War\GamePlay\Country\CountryInterface;

/**
 * A manager that will roll the dice and compute the winners of a battle.
 */
class Battlefield implements BattlefieldInterface {

    public function rollDice(CountryInterface $country, bool $isAtacking): array {
       $numberTroops =  $country -> getNumberOfTroops();
       $results = [];
       if ($isAtacking == TRUE){
            $numberTroops -= 1;
            for ($i = 1; $i <= $numberTroops; $i++){
                $diceResult = rand(1,6);
                $results[] = $diceResult;
            }
            return $results;
       }
       for ($i = 1; $i <= $numberTroops; $i++){
            $diceResult = rand(1,6);
            $results[] = $diceResult;
       }
       return $results;
        
    }

    public function computeBattle(CountryInterface $attackingCountry, array $attackingDice, CountryInterface $defendingCountry, array $defendingDice): void {
        $qtde = min(sizeof($attackingDice), sizeof($defendingDice));
        $attackPoints = 0;
        $defendingPoints = 0;
        for($i = 0; $i < $qtde; $i++){
          if($attackingDice[$i] > $defendingDice[$i])
            $attackPoints++;
          else
            $defendingPoints++;
        }
        $attackingCountry -> killTroops($defendingPoints);
        $defendingCountry -> killTroops($attackPoints);
        
    }
}
