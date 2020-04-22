<?php
include "mysqliDB.php";
require_once './vendor/autoload.php';
function makeTable(){

  $d = getdate();
  $filename ="surveyResults_".$d['mday']."-".$d['mon']."-".$d['year'].".xls";
  $data = getAll('testSurvey');
  $headings = '';
  $values = '';
  foreach ($data[0] as $key => $value) {
    $headings .= "<th>$key</th>";
  }

  foreach ($data as $key => $value) {
    $values .= "<tr>";
      foreach ($value as $key => $value) {
        $values .= "<td>$value</td>";
      }
      $values .= "</tr>";
  }
  $table = "
  <table>
    <tr>
    $headings
    </tr>
    $values
  </table>
  ";

  $reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
  $spreadsheet = $reader->loadFromString($table);
  $result = array('sheet'=>$spreadsheet, 'name'=>$filename, 'table'=>$table);
  return $result;
}
?>
