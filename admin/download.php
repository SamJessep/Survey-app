<?php
include "db.php";
$d = getdate();
$filename ="surveyResults_".$d['mday']."-".$d['mon']."-".$d['year'].".xls";
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");

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
$table = <<<feof
<style>
table {
  border-collapse: collapse;
}

table, th, td {
  border: 1px solid black;
}
</style>
<table>
  <tr>
  $headings
  </tr>
  $values
</table>
feof;

require_once '..\vendor\autoload.php';
//echo $table;
$reader = new \PhpOffice\PhpSpreadsheet\Reader\Html();
$spreadsheet = $reader->loadFromString($table);


$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
echo ob_get_clean();
 ?>
