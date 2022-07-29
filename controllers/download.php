<?php

require_once '../app.php';

if(!isset($_GET['fileId']))
    return http_response_code(400);

$pointerName = $_GET['fileId'];
$pointerExt = 'json';
$pointerPath = DATA_FOLDER . "/$pointerName.$pointerExt";

if(!file_exists($pointerPath))
    return http_response_code(404);

$pointerContent = @file_get_contents($pointerPath);
$pointerContent = @json_decode($pointerContent, true);

if(!$pointerContent)
    return http_response_code(500);

$uploadedFileName = $pointerContent['file']['uploaded']['name'];
$uploadedFileExt = $pointerContent['file']['uploaded']['extension'];

$storagedFileName = $pointerContent['file']['storaged']['name'];
$storagedFileExt = $pointerContent['file']['storaged']['extension'];
$storagedFilePath = DATA_FOLDER . "/$storagedFileName.$storagedFileExt";
$storagedFileSize = filesize($storagedFilePath);

$storagedFileHandler = fopen($storagedFilePath, 'r');
$storagedFileContent = fread($storagedFileHandler, $storagedFileSize);

header('Content-Type: image/jpeg');
header("Content-Disposition: attachment; filename=\"$uploadedFileName.$uploadedFileExt\"");
header("Cache-Control: public, max-age=0");

print $storagedFileContent;