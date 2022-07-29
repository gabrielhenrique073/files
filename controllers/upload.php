<?php

require_once '../app.php';

if(!isset($_FILES['file']))
    return http_response_code(400);

$uploadName = pathinfo($_FILES['file']['name'], PATHINFO_FILENAME);
$uploadExt = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
$uploadPath = $_FILES['file']['tmp_name'];
$uploadError = $_FILES['file']['error'];

if($uploadError)
    return http_response_code(500);

$pointerName = md5(date('d-m-Y H:i:s') . $uploadName . $uploadExt);
$pointerExt = 'json';
$pointerPath = DATA_FOLDER . "/$pointerName.$pointerExt";
$pointerContent = null;

$fileName = $pointerName;
$fileExt = $uploadExt;
$filePath = DATA_FOLDER . "/$fileName.$fileExt";

if(!file_exists(DATA_FOLDER))
    mkdir(DATA_FOLDER, 0777, true);

$isMoved = move_uploaded_file($uploadPath, $filePath);

if(!$isMoved)
    return http_response_code(500);

$isWrote = file_put_contents($pointerPath, 
    json_encode(
        [
            'file' => [
                'uploaded' => [
                    'name' => $uploadName,
                    'extension' => $uploadExt,
                    'date' => time(),
                ],
                'storaged' => [
                    'name' => $fileName,
                    'extension' => $fileExt
                ]
            ]
        ]
    )
);

if(!$isWrote){
    @unlink($filePath);
    return http_response_code(500);
}

http_response_code(201);
echo $fileName;