<?php
if ($_SERVER['SCRIPT_NAME'] === '/index.php') {
    $links = [
        'icon' => './src/assets/favicon.ico',
        'mainStyle' => './src/assets/css/main.css',
        'mediaStyle' => './src/assets/css/media.css',
    ];
} else {
    $links = [
        'icon' => '../assets/favicon.ico',
        'mainStyle' => '../assets/css/main.css',
        'mediaStyle' => '../assets/css/media.css',
    ];
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="<?php echo $links['icon'] ?>">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet"/>
    <link rel="stylesheet" href="<?php echo $links['mainStyle'] ?>">
    <link rel="stylesheet" href="<?php echo $links['mediaStyle'] ?>">
    <title>
        Crypto Portfolio
    </title>
</head>
