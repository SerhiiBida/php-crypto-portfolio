<?php
// Отображение ошибок и старых данных
require __DIR__ . '/../../utils/form/display_data.php';
require __DIR__ . '/../../utils/form/display_errors.php';
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
