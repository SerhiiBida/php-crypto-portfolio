<?php
// Отображение ошибок и старых данных
require_once __DIR__ . '/../../utils/form/display_data.php';
require_once __DIR__ . '/../../utils/form/display_errors.php';

$formName = 'change-portfolio-form-' . $portfolioId;
?>
<form
        action="<?php echo $_SERVER['PHP_SELF'] ?>"
        method="post"
        class="change-portfolio-form"
>
    <div class="change-portfolio-form-wrapper">
        <span class="material-symbols-outlined change-portfolio-form-icon opacity-60">
            work
        </span>
        <div class="change-portfolio-form-input-wrapper">
            <div class="change-portfolio-form-input-wrapper custom-input-wrapper <?php echo getClassBorderError('name', $formName) ?>">
                <label>
                    <input
                            type="text"
                            name="name"
                            placeholder="Name"
                            class="change-portfolio-form-input custom-input"
                            value="<?php echo formTextValue('name', $formName, $portfolioName); ?>"
                            minlength="6"
                            maxlength="18"
                            required
                    >
                </label>
            </div>
            <p class="change-portfolio-form-input-error custom-input-error">
                <?php
                echo getFieldError('name', $formName);

                // Удаляем проверочное значение
                unset($_POST[$formName]);
                ?>
            </p>
        </div>
        <input type="hidden" name="portfolio-id" value="<?php echo $portfolioId; ?>">
        <input type="hidden" name="<?php echo $formName; ?>" value="true">
        <button
                type="submit"
                class="change-portfolio-form-change-button"
                name="submit-button"
                value="change"
        >
            <span class="material-symbols-outlined">
                check
            </span>
        </button>
        <button
                type="submit"
                class="change-portfolio-form-delete-button"
                name="submit-button"
                value="delete"
        >
            <span class="material-symbols-outlined">
                delete
            </span>
        </button>
    </div>
</form>
