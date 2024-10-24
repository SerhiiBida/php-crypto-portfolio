<?php

use App\validators\GlobalValidator;


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['portfolio-coins-filter-form'])) {
    // Сырые данные
    $rawData = [
        'filter-price' => [
            'type' => 'str',
            'value' => $_POST['filter-price'] ?? null,
        ],
        'sort' => [
            'type' => 'str',
            'value' => $_POST['sort'] ?? null,
        ],
        'search-name' => [
            'type' => 'str',
            'value' => $_POST['search-name'] ?? null,
            'peculiarity' => 'empty'
        ],
    ];

    // Валидация
    $validator = new GlobalValidator($rawData);

    $check = $validator->validate();

    if ($check) {
        // Сохраняем настройки фильтрации, сортировки, поиска
        $filterPrice = $_SESSION['portfolio']['filterPrice'] = trim($_POST['filter-price']);
        $sort = $_SESSION['portfolio']['sort'] = trim($_POST['sort']);
        $searchName = $_SESSION['portfolio']['searchName'] = trim($_POST['search-name']);

    } else {
        // Обнуляем фильтрацию
        $_SESSION['portfolio'] = null;
    }
}
