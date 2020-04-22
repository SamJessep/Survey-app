<?php
require "makeHtmlTable.php";
$data = makeTable();
$spreadsheet = $data['sheet'];
$filename = $data['name'];
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel");



$writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('php://output');
echo ob_get_clean();

 ?>
