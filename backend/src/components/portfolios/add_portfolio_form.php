<?php
// Отображение ошибок и старых данных
use App\validators\GlobalValidator;

require __DIR__ . '/../../utils/form/display_data.php';
require __DIR__ . '/../../utils/form/display_errors.php';

// Обнуляем
$formErrors = [];

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add-portfolio-form'])) {
    // Сырые данные
    $rawData = [
        'name' => [
            'type' => 'str',
            'value' => $_POST['name'] ?? null,
        ]
    ];

    // Валидация
    $validator = new GlobalValidator($rawData);

    $check = $validator->validate();

    if ($check) {
        // Дополнительная валидация
        if (strlen($_POST['name']) < 6 || strlen($_POST['name']) > 18) {
            $formErrors['name'] = 'The required length is from 6 to 18';

        } else {
            // Сохраняем
        }

    } else {
        // Сохраняем ошибки
        $formErrors = $validator->errors;
    }
}

?>
<form
        action="<?php echo $_SERVER['PHP_SELF'] ?>"
        method="post"
        class="add-portfolio-form"
>
    <div class="add-portfolio-form-input-wrapper custom-input-wrapper <?php echo getClassBorderError('name') ?>">
        <label>
            <input
                    type="text"
                    name="name"
                    placeholder="Name"
                    class="add-portfolio-form-input custom-input"
                    minlength="6"
                    maxlength="18"
                    value="<?php echo formTextValue('name', 'add-portfolio-form'); ?>"
                    required
            >
        </label>
    </div>
    <p class="add-portfolio-form-input-error custom-input-error">
        <?php echo getFieldError('name'); ?>
    </p>
    <input type="hidden" name="add-portfolio-form" value="true">
    <button type="submit" class="add-portfolio-form-submit submit-btn">
        ADD
    </button>
</form>
