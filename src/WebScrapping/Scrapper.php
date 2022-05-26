<?php

namespace Galoa\ExerciciosPhp2022\WebScrapping;

use DOMXPath;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;
use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;




/**
 * Does the scrapping of a webpage.
 */
class Scrapper { 

  /**
   * Loads paper information from the HTML and creates a XLSX file.
   */
  public function scrap(\DOMDocument $dom): void {
    $domXPath = new DOMXPath($dom);
    $dataTitle = [];
    $dataType = [];
    $dataAuthor = [];
    $dataInstitution = [];

    $auxVariable = $domXPath -> query('.//[@id="mainTitle"]');
    foreach($auxVariable as $elemento){
      $dataTitle[] = $elemento -> textContent. PHP_EOL;
    }
    $auxVariable = $domXPath -> query('.//li[@id="type"]');
    foreach($auxVariable as $elemento){
      $dataTitle[] = $elemento -> textContent. PHP_EOL;
    }
    $auxVariable = $domXPath -> query('.//li[@id="authors"]');
    foreach($auxVariable as $elemento){
      $dataTitle[] = $elemento -> textContent. PHP_EOL;
    }
    $authorTitle = $domXPath -> query('.//li[@class="authors"]//span');
    $author = [];

    $filePath = '.src/WebScrapping/origin.xlsx';
    $writer = WriterEntityFactory::createODSWriter();
    $writer -> setShouldCreateNewSheetsAutomatically(true);
    $writer -> openToFile($filePath);


    $head = ['Id','Title,"Type'];
    for ($i=0; $i < max($author); $i++) { 
      # code...
      $auxVariable = 'Author ';
      $auxVariable .= $i++;
      $head[] = $auxVariable;
    }

    $row =  WriterEntityFactory::createRowFromArray($head);
    $writer -> addRow($row);


    $writer -> close();

    

    print $dom->saveHTML();
  }
/*
  public function convert(): void {

  $dadosXls = ""; 
  $dadosXls .= " <table border='1' >"; 
  $dadosXls .= " <tr>"; 
  $dadosXls .= " <th>Id</th>"; 
  $dadosXls .= " <th>Nome</th>"; 
  $dadosXls .= " <th>Email</th>"; 
  $dadosXls .= " </tr>"; //incluimos nossa conexão 
  include_once('Conexao.class.php'); //instanciamos 
  $pdo = new Main(); //mandamos nossa query para nosso método dentro de conexao dando um return 
  $stmt->fetchAll(PDO::FETCH_ASSOC); $result = $pdo->select("SELECT id,nome,email FROM cadastro"); //varremos o array com o foreach para pegar os dados 
  foreach($result as $res){ 
    $dadosXls .= " <tr>"; 
    $dadosXls .= " <td>".$res['id']."</td>"; 
    $dadosXls .= " <td>".$res['nome']."</td>"; 
    $dadosXls .= " <td>".$res['email']."</td>"; 
    $dadosXls .= " </tr>"; } 
    $dadosXls .= " </table>"; // Definimos o nome do arquivo que será exportado 
    $arquivo = "MinhaPlanilha.xls"; // Configurações header para forçar o download 
    header('Content-Type: application/vnd.ms-excel'); 
    header('Content-Disposition: attachment;filename="'.$arquivo.'"'); 
    header('Cache-Control: max-age=0'); // Se for o IE9, isso talvez seja necessário 
    header('Cache-Control: max-age=1'); // Envia o conteúdo do arquivo echo $dadosXls; exit;
  }*/
}