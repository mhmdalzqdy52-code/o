<h2><?= e($title) ?></h2>
<?php foreach ($errors as $err): ?><p class="err"><?= e($err) ?></p><?php endforeach; ?>
<form method="post">
 <input type="hidden" name="csrf" value="<?= e($_SESSION['csrf']) ?>">
 <label>Name <input name="name" value="<?= e($contact['name']) ?>" required></label>
 <label>Email <input type="email" name="email" value="<?= e($contact['email']) ?>" required></label>
 <label>Phone <input name="phone" value="<?= e($contact['phone']) ?>" required></label>
 <p><button type="submit">Save</button></p>
</form>
