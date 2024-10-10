<?php
require 'settings.php';
require 'layouts/head.php';
require 'layouts/header.php';
require 'layouts/menu.php';
require 'layouts/footer.php';
?>

<!--HEAD-->
<?php includeHead(); ?>

<body>
<!--Заголовок-->
<?php includeHeader(); ?>

<main>
    <!--Меню-->
    <?php includeMenu(); ?>

</main>

<!--Подвал-->
<?php includeFooter(); ?>
</body>
