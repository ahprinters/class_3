<?php
$success = get_flash('success');
$errors = get_flash('errors');
$info = get_flash('info');
?>
<?php if ($success): ?>
    <div class="alert-clean alert-success-clean"><?= e($success) ?></div>
<?php endif; ?>

<?php if ($info): ?>
    <div class="alert-clean alert-info-clean"><?= e($info) ?></div>
<?php endif; ?>

<?php if (!empty($errors) && is_array($errors)): ?>
    <div class="alert-clean alert-error-clean">
        <ul>
            <?php foreach ($errors as $error): ?>
                <li><?= e($error) ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>
