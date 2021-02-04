<?php

if (!empty($_POST['checkbox'])) {

  $filename = 'emails.csv';
  $export_data = $_POST['checkbox'];

  $file = fopen($filename, "w");

  fputcsv($file, $export_data);

  fclose($file);

  header("Content-Description: File Transfer");
  header("Content-Disposition: attachment; filename=" . $filename);
  header("Content-Type: application/csv; ");

  readfile($filename);

  unlink($filename);
  exit();
}
