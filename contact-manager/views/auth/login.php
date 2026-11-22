<h2>Admin login</h2>
<?php if ($error): ?><p class="err"><?= e($error) ?></p><?php endif; ?>
<form method="post">
 <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
 <label>Username <input name="username" required></label>
 <label>Password <input type="password" name="password" required></label>
 <p><button type="submit">Login</button></p>
</form>
