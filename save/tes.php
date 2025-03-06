<?php 
$tgl1 = strtotime("2022-01-01"); 
$tgl2 = strtotime("2022-04-07"); 

$jarak = $tgl2 - $tgl1;

$hari = $jarak / 60 / 60 / 24;
echo $hari;
?>