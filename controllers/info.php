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

header('content-type: application/json');
echo json_encode(
    [
        'name' => $pointerContent['file']['uploaded']['name'],
        'type' => $pointerContent['file']['uploaded']['type'],
        'extension' => $pointerContent['file']['uploaded']['extension'],
        'date' => $pointerContent['file']['uploaded']['date'],
    ]
);