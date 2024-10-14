<!--Подвал-->
<?php
if ($_SERVER['SCRIPT_NAME'] === '/index.php') {
    $links = [
        'mainScript' => './src/assets/js/main.js',
    ];
} else {
    $links = [
        'mainScript' => '../assets/js/main.js',
    ];
}
?>
<script src="<?php echo $links['mainScript'] ?>"></script>