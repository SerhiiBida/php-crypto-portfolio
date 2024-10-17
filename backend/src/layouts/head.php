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
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&icon_names=login"/>
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=deployed_code"/>
    <link rel="stylesheet" href="<?php echo $links['mainStyle'] ?>">
    <link rel="stylesheet" href="<?php echo $links['mediaStyle'] ?>">
    <title>
        Crypto Portfolio
    </title>
</head>
