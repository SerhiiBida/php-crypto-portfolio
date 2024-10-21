<?php
// Отображение ошибок и старых данных
require_once __DIR__ . '/../../utils/form/display_data.php';
require_once __DIR__ . '/../../utils/form/display_errors.php';
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
                    value="<?php echo formTextValue('name', 'add-portfolio-form'); ?>"
                    minlength="6"
                    maxlength="18"
                    required
            >
        </label>
    </div>
    <p class="add-portfolio-form-input-error custom-input-error">
        <?php
        echo getFieldError('name', 'add-portfolio-form');
        // Удаляем проверочное значение для запуска обработки формы
        unset($_POST['add-portfolio-form']);
        ?>
    </p>
    <input type="hidden" name="add-portfolio-form" value="true">
    <button type="submit" class="add-portfolio-form-submit submit-btn">
        ADD
    </button>
</form>
