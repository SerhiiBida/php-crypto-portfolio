<form
        action="<?php echo $_SERVER['PHP_SELF'] ?>?page-id=<?php echo $_GET['page-id']; ?>"
        method="post"
        class="delete-coins-form"
>
    <input type="hidden" name="delete-coins-form" value="true">
    <input type="hidden" name="page-id" value="<?php echo $_GET['page-id']; ?>">
    <input type="hidden" name="coin-id" value="<?php echo $coin['id']; ?>">
    <button type="submit" class="delete-coins-form-button submit-btn">
        DELETE
    </button>
</form>