<?php
// Отображение ошибок и старых данных
require __DIR__ . '/../../../utils/form/display_data.php';
require __DIR__ . '/../../../utils/form/display_errors.php';
require __DIR__ . '/../display_auth_errors.php';
?>
<!--action - на текущую страницу-->
<form
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"
        method="post"
        class="login-form"
>
    <div class="login-form-username custom-input-wrapper <?php echo getClassBorderError('username') ?>">
        <label for="username"
               class="login-form-username-label custom-input-label <?php echo getClassError('username') ?>">
            Username
        </label>
        <input
                type="text"
                name="username"
                id="username"
                placeholder="food228"
                class="login-form-username-input custom-input"
                minlength="6"
                maxlength="18"
                value="<?php echo formTextValue('username'); ?>"
                required
        >
    </div>
    <p class="login-form-username-error custom-input-error">
        <?php echo getFieldError('username'); ?>
    </p>
    <div class="login-form-password custom-input-wrapper <?php echo getClassBorderError('password') ?>">
        <label for="password"
               class="login-form-password-label custom-input-label <?php echo getClassError('password') ?>">
            Password
        </label>
        <input
                type="password"
                name="password"
                id="password"
                placeholder="********"
                class="login-form-password-input custom-input"
                minlength="8"
                maxlength="16"
                value="<?php echo formTextValue('password'); ?>"
                required
        >
    </div>
    <p class="login-form-password-error custom-input-error">
        <?php echo getFieldError('password'); ?>
    </p>
    <div class="login-form-terms">
        <label>
            <input
                    type="checkbox"
                    name="terms"
                <?php echo formRadioCheckboxValue('terms', 'on'); ?>
            >
            Remember me
        </label>
    </div>
    <p class="auth-error">
        <?php echo getAuthError(); ?>
    </p>
    <button type="submit" class="login-form-submit submit-btn">
        Log in
    </button>
</form>
