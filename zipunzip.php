<?php

/*================script for unZip All=============================*/
// $zip = new ZipArchive;
// $res = $zip->open('project.zip');
// if ($res === TRUE) {
//   $zip->extractTo('./');
//   $zip->close();
//   echo 'done!';
// } else {
//   echo 'error!';
// }

/*================script for Zip All=============================*/


$rootPath = realpath('./');

$zip = new ZipArchive();
$zip->open('Mominsara_'.date('d-m-Y').'.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

$files = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($rootPath),
    RecursiveIteratorIterator::LEAVES_ONLY
);

foreach ($files as $name => $file){
    if (!$file->isDir()){
        $filePath = $file->getRealPath();
        $relativePath = substr($filePath, strlen($rootPath) + 1);

        $zip->addFile($filePath, $relativePath);
    }
}
$zip->close();
echo 'done';











?>