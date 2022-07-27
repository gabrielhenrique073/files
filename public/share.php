<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Share It</title>

        <link rel="stylesheet" href="/public/css/share.css">
        <script src="/public/js/share.js" defer></script>
    </head>
    <body>
        <form method="post" action="/controllers/share.php" id="fileUploader">
            <progress value="0" max="100" width="100"></progress>
            <span></span>
            <input type="file" name="file">
            <input type="submit" name="action" value="upload">
        </form>
        <a id="fileLink"></a>
    </body>
</html>