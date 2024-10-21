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
            <div class="change-portfolio-form-input-wrapper custom-input-wrapper <?php echo getClassBorderError('name') ?>">
                <label>
                    <input
                            type="text"
                            name="name"
                            placeholder="Name"
                            class="change-portfolio-form-input custom-input"
                            minlength="6"
                            maxlength="18"
                            value="<?php echo formTextValue('name', 'change-portfolio-form'); ?>"
                            required
                    >
                </label>
            </div>
            <p class="change-portfolio-form-input-error custom-input-error">
                <?php echo getFieldError('name'); ?>
            </p>
        </div>
        <input type="hidden" name="change-portfolio-form" value="true">
        <button type="submit" class="change-portfolio-form-change-button">
            <span class="material-symbols-outlined">
                check
            </span>
        </button>
        <button type="submit" class="change-portfolio-form-delete-button">
            <span class="material-symbols-outlined">
                delete
            </span>
        </button>
    </div>
</form>
