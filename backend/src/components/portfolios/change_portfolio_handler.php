<?php

use App\database\tables\Portfolios;
use App\validators\GlobalValidator;


// Обнуляем
$formErrors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['change-portfolio-form'])) {
    $formErrors = [];
}
