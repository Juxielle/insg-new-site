<?php
$zip = new ZipArchive();
if ($zip->open('../insg-gabon2.zip') === true) {
    $stat = $zip->statName('insg-gabon2/assets/css/custom.css');
    echo "Size in zip: " . $stat['size'] . " bytes\n";
    $currSize = filesize('public/assets/css/custom.css');
    echo "Current public size: $currSize bytes\n";
    $zip->close();
}

