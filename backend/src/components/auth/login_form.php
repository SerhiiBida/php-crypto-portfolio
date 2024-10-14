<?php
require 'login_handler.php';
?>
<!--action - на текущую страницу-->
<form
        action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>"
        method="post"
        class="login-form"
>
    <div class="login-form-username custom-input-wrapper">
        <label for="username" class="login-form-username-label custom-input-label">
            Username
        </label>
        <input
                type="text"
                name="username"
                id="username"
                placeholder="food228"
                class="login-form-username-input custom-input"
                minlength="5"
                maxlength="32"
                required
        >
        <p class="login-form-username-error custom-input-error"></p>
    </div>
    <div class="login-form-password custom-input-wrapper">
        <label for="password" class="login-form-password-label custom-input-label">
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
                required
        >
        <p class="login-form-password-error custom-input-error"></p>
    </div>
    <button type="submit" class="login-form-submit submit-btn">
        Log in
    </button>
</form>
